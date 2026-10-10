<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\QrTrack;
use App\Models\ReviewLinksAnalytics;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Integration;
use Illuminate\Support\Facades\Auth;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DateTime;

use Carbon\Carbon;

class QrController extends Controller
{
    public function links_analytics(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $fromDate = $request->input('from_date');
                $toDate = $request->input('to_date');
                $type = $request->input('type');
            
    
            // Total Scans and Today's Scans
            $array['total_count'] = ReviewLinksAnalytics::where('user_id', $userId)->count();
            $array['today_count'] = ReviewLinksAnalytics::where('user_id', $userId)
                ->whereDate('created_at', date('Y-m-d'))
                ->count();
    
                
                // Fetch Month-Wise Data
                $array['typeWiseData'] = ReviewLinksAnalytics::selectRaw('type, COUNT(*) as total')
                ->where('user_id', $userId)
                ->groupBy('type')
                ->orderBy('type')
                ->get()
                ->map(function ($item) {
                    return [
                        'name' => $item->type, // Use the `type` field for the label
                        'y' => (int)$item->total // Total count for each type
                    ];
                });
            

                    $array['pieChart'] = ReviewLinksAnalytics::whereYear('created_at', now()->year)
                    ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->where('user_id', $userId)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get()
                    ->map(function ($item) {
                        return ['name' => DateTime::createFromFormat('!m', $item->month)->format('F'), 'y' => $item->count];
                    });
            
                // Fetch Date-Wise Data (based on search filters)
                $query = ReviewLinksAnalytics::selectRaw('DATE(created_at) as date, type, COUNT(*) as total')
                ->where('user_id', $userId)
                ->groupBy('date', 'type')
                ->orderBy('date', 'ASC');
            
            if ($fromDate) {
                $query->whereDate('created_at', '>=', $fromDate);
            }
            
            if ($toDate) {
                $query->whereDate('created_at', '<=', $toDate);
            }
            
            if ($type && $type !== 'all') {
                $query->where('type', $type);
            }
            
            $array['dateTypeWiseData'] = $query->get()
                ->map(function ($item) {
                    return [
                        'date' => $item->date,
                        'type' => $item->type,
                        'total' => (int)$item->total
                    ];
                });
            
    
            return view('user.analytics.links_analytics', $array);
        }
    }
    public function qr_analytics(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $now = Carbon::now();
    
            // 1. Core Counts - STRICTLY FOR LOGGED IN USER
            $array['total_scan'] = (int)QrTrack::where('user_id', $userId)->sum('qr_count') ?: (int)QrTrack::where('user_id', $userId)->count();
            if ($array['total_scan'] === 0 && QrTrack::where('user_id', $userId)->count() > 0) {
                $array['total_scan'] = (int)QrTrack::where('user_id', $userId)->count();
            }

            $array['today_scan'] = (int)QrTrack::where('user_id', $userId)
                ->whereDate('created_at', Carbon::today())
                ->sum('qr_count') ?: (int)QrTrack::where('user_id', $userId)
                ->whereDate('created_at', Carbon::today())
                ->count();

            $array['this_week_scan'] = (int)QrTrack::where('user_id', $userId)
                ->whereBetween('created_at', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])
                ->count();

            $array['this_month_scan'] = (int)QrTrack::where('user_id', $userId)
                ->whereYear('created_at', $now->year)
                ->whereMonth('created_at', $now->month)
                ->count();

            $array['unique_scans'] = (int)QrTrack::where('user_id', $userId)
                ->distinct('ip_address')
                ->count('ip_address');

            // 2. Month-Wise Total Scans (Historical for this user)
            $array['monthWiseData'] = QrTrack::where('user_id', $userId)
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get()
                ->map(function ($item) {
                    $formattedName = $item->month;
                    try {
                        $formattedName = Carbon::createFromFormat('Y-m', $item->month)->format('M Y');
                    } catch (\Exception $e) {}
                    return ['name' => $formattedName, 'y' => (int)$item->total];
                });

            // 3. Current Year Month-Wise Pie Chart (for this user)
            $array['pieChart'] = QrTrack::where('user_id', $userId)
                ->whereYear('created_at', $now->year)
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get()
                ->map(function ($item) {
                    $monthName = DateTime::createFromFormat('!m', $item->month)->format('F');
                    return ['name' => $monthName, 'y' => (int)$item->count];
                });

            // 4. Monthly Trend Data (12 Months of Current Year)
            $rawMonthly = QrTrack::where('user_id', $userId)
                ->whereYear('created_at', $now->year)
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();

            $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            $monthlyTrendSeries = [];
            for ($m = 1; $m <= 12; $m++) {
                $monthlyTrendSeries[] = (int)($rawMonthly[$m] ?? 0);
            }
            $array['monthNames'] = $monthNames;
            $array['monthlyTrendSeries'] = $monthlyTrendSeries;

            // 5. Day-of-the-Week Analysis (Mon to Sun)
            // MySQL DAYOFWEEK: 1=Sun, 2=Mon, 3=Tue, 4=Wed, 5=Thu, 6=Fri, 7=Sat
            $rawDow = QrTrack::where('user_id', $userId)
                ->selectRaw('DAYOFWEEK(created_at) as dow, COUNT(*) as count')
                ->groupBy('dow')
                ->pluck('count', 'dow')
                ->toArray();

            $dowDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $dowMapping = [2, 3, 4, 5, 6, 7, 1];
            $dowSeries = [];
            $maxDowCount = -1;
            $peakDowName = 'N/A';

            foreach ($dowMapping as $idx => $dowNum) {
                $cnt = (int)($rawDow[$dowNum] ?? 0);
                $dowSeries[] = $cnt;
                if ($cnt > $maxDowCount && $cnt > 0) {
                    $maxDowCount = $cnt;
                    $peakDowName = $dowDays[$idx];
                }
            }
            $array['dowDays'] = $dowDays;
            $array['dowSeries'] = $dowSeries;
            $array['peakDow'] = $peakDowName !== 'N/A' ? $peakDowName . " (" . $maxDowCount . " scans)" : "No scans yet";

            // 6. Hourly / Time-of-Day Distribution
            $rawHourly = QrTrack::where('user_id', $userId)
                ->selectRaw('HOUR(created_at) as hr, COUNT(*) as count')
                ->groupBy('hr')
                ->pluck('count', 'hr')
                ->toArray();

            $hourlyCategories = [];
            $hourlySeries = [];
            $timeOfDayBuckets = [
                'Morning' => 0,   // 6 AM - 12 PM
                'Afternoon' => 0, // 12 PM - 5 PM
                'Evening' => 0,   // 5 PM - 9 PM
                'Night' => 0      // 9 PM - 6 AM
            ];

            for ($h = 0; $h < 24; $h++) {
                $cnt = (int)($rawHourly[$h] ?? 0);
                $hourlyCategories[] = date("g A", strtotime("$h:00"));
                $hourlySeries[] = $cnt;

                if ($h >= 6 && $h < 12) {
                    $timeOfDayBuckets['Morning'] += $cnt;
                } elseif ($h >= 12 && $h < 17) {
                    $timeOfDayBuckets['Afternoon'] += $cnt;
                } elseif ($h >= 17 && $h < 21) {
                    $timeOfDayBuckets['Evening'] += $cnt;
                } else {
                    $timeOfDayBuckets['Night'] += $cnt;
                }
            }
            $array['hourlyCategories'] = $hourlyCategories;
            $array['hourlySeries'] = $hourlySeries;
            $array['timeOfDayBuckets'] = $timeOfDayBuckets;

            // 7. Date-Wise Filtered Data (strictly for THIS USER)
            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            $query = QrTrack::where('user_id', $userId)
                ->selectRaw('DATE(created_at) as scan_date, COUNT(*) as total')
                ->groupBy('scan_date')
                ->orderBy('scan_date', 'ASC');

            if ($fromDate) {
                $query->whereDate('created_at', '>=', $fromDate);
            }

            if ($toDate) {
                $query->whereDate('created_at', '<=', $toDate);
            }

            $array['dateWiseData'] = $query->get()
                ->map(function ($item) {
                    return [
                        'name' => Carbon::parse($item->scan_date)->format('d M Y'),
                        'y' => (int)$item->total
                    ];
                });

            // Peak Scan Date
            $peakDateRow = QrTrack::where('user_id', $userId)
                ->selectRaw('DATE(created_at) as scan_date, COUNT(*) as total')
                ->groupBy('scan_date')
                ->orderBy('total', 'DESC')
                ->first();
            $array['peakDate'] = $peakDateRow ? Carbon::parse($peakDateRow->scan_date)->format('d M Y') . " (" . $peakDateRow->total . " scans)" : "No scans yet";

            // 8. Analyzed Section: Recent Scans Log (THIS USER ONLY)
            $array['recentScans'] = QrTrack::where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->take(15)
                ->get();

            // 9. Double QR Facility Permission & Settings
            $user = Auth::user();
            $has_double_qr = false;
            if ($user->double_qr_access === 'YES') {
                $has_double_qr = true;
            } else {
                $activePayment = Payment::select('payments.*', 'services.plan_type', 'services.double_qr_access')
                    ->join('services', 'services.id', 'payments.service_id')
                    ->where('payments.user_id', $userId)
                    ->orderBy('payments.id', 'desc')
                    ->first();
                if ($activePayment && ($activePayment->double_qr_access === 'Y' || in_array($activePayment->plan_type, ['premium', 'pro']))) {
                    $has_double_qr = true;
                }
            }
            if ($user->type === 'admin') {
                $has_double_qr = true;
            }
            $array['has_double_qr'] = $has_double_qr;
            $array['active_style'] = $user->qr_style ?: 'style1';

            // Secondary QR settings from integrations
            $array['doubleQrSettings'] = Integration::where('user_id', $userId)->where('type', 'double_qr')->first();

            // Google review link from existing integration if available
            $googleInt = Integration::where('user_id', $userId)->where('type', 'google')->first();
            $array['googleReviewUrl'] = $googleInt && !empty($googleInt->review_links) ? $googleInt->review_links : '';

            return view('user.analytics.qr_analytics', $array);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function activate_qr_style(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $style = $request->input('style', 'style1');

            if (!in_array($style, ['style1', 'style2'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid QR style selected.'
                ], 422);
            }

            // Check if user has double QR access for style2
            if ($style === 'style2') {
                $hasAccess = ($user->double_qr_access === 'YES' || $user->type === 'admin');
                if (!$hasAccess) {
                    $activePayment = Payment::select('payments.*', 'services.plan_type', 'services.double_qr_access')
                        ->join('services', 'services.id', 'payments.service_id')
                        ->where('payments.user_id', $user->id)
                        ->orderBy('payments.id', 'desc')
                        ->first();
                    if ($activePayment && ($activePayment->double_qr_access === 'Y' || in_array($activePayment->plan_type, ['premium', 'pro']))) {
                        $hasAccess = true;
                    }
                }

                if (!$hasAccess) {
                    return response()->json([
                        'status' => 'error',
                        'premium_required' => true,
                        'message' => 'Option 2 is an exclusive Premium Plan feature. Please upgrade your plan to unlock multiple QR options!'
                    ], 403);
                }
            }

            User::where('id', $user->id)->update(['qr_style' => $style]);

            $optionName = $style === 'style2' ? 'Option 2' : 'Option 1';

            return response()->json([
                'status' => 'success',
                'active_style' => $style,
                'message' => $optionName . ' activated successfully as your active QR code!'
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
    }

    public function save_double_qr_settings(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $user = Auth::user();

            $hasAccess = ($user->double_qr_access === 'YES' || $user->type === 'admin');
            if (!$hasAccess) {
                $activePayment = Payment::select('payments.*', 'services.plan_type', 'services.double_qr_access')
                    ->join('services', 'services.id', 'payments.service_id')
                    ->where('payments.user_id', $userId)
                    ->orderBy('payments.id', 'desc')
                    ->first();
                if ($activePayment && ($activePayment->double_qr_access === 'Y' || in_array($activePayment->plan_type, ['premium', 'pro']))) {
                    $hasAccess = true;
                }
            }

            if (!$hasAccess) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Double QR Standee is an exclusive Premium Plan feature. Please upgrade to unlock.'
                ], 403);
            }

            Integration::updateOrCreate(
                ['user_id' => $userId, 'type' => 'double_qr'],
                [
                    'name' => $request->name ?? 'Pay / Connect',
                    'url' => $request->url ?? '',
                    'review_links' => $request->preset_type ?? 'upi'
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Double QR configuration saved successfully!'
            ]);
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
    }

    public function print_double_qr(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $user = Auth::user();

            $hasAccess = ($user->double_qr_access === 'YES' || $user->type === 'admin');
            if (!$hasAccess) {
                $activePayment = Payment::select('payments.*', 'services.plan_type', 'services.double_qr_access')
                    ->join('services', 'services.id', 'payments.service_id')
                    ->where('payments.user_id', $userId)
                    ->orderBy('payments.id', 'desc')
                    ->first();
                if ($activePayment && ($activePayment->double_qr_access === 'Y' || in_array($activePayment->plan_type, ['premium', 'pro']))) {
                    $hasAccess = true;
                }
            }

            if (!$hasAccess) {
                $notification = array(
                    'messege' => 'Double QR Standee is an exclusive Premium feature. Please upgrade your plan to unlock it.',
                    'alert-type' => 'error'
                );
                return redirect('admin/qr_analytics')->with($notification);
            }

            $array['doubleQrSettings'] = Integration::where('user_id', $userId)->where('type', 'double_qr')->first();
            $array['user'] = $user;

            return view('admin.print_double_qr_code', $array);
        }

        return redirect('login');
    }
}
