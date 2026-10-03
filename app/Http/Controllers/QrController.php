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
use Illuminate\Support\Facades\Auth;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DateTime;

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
    
            // Total Scans and Today's Scans
            $array['total_scan'] = QrTrack::where('user_id', $userId)->count();
            $array['today_scan'] = QrTrack::where('user_id', $userId)
                ->whereDate('created_at', date('Y-m-d'))
                ->count();
    
                $fromDate = $request->input('from_date');
                $toDate = $request->input('to_date');
            
                // Fetch Month-Wise Data
                $array['monthWiseData'] = QrTrack::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get()
                    ->map(function ($item) {
                        return ['name' => $item->month, 'y' => $item->total];
                    });

                    $array['pieChart'] = QRTrack::whereYear('created_at', now()->year)
                    ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get()
                    ->map(function ($item) {
                        return ['name' => DateTime::createFromFormat('!m', $item->month)->format('F'), 'y' => $item->count];
                    });
            
                // Fetch Date-Wise Data (based on search filters)
                $query = QrTrack::selectRaw('created_at as date, COUNT(*) as total')
                    ->groupBy('date')
                    ->orderBy('date');
            
                if ($fromDate) {
                    $query->where('created_at', '>=', $fromDate);
                }
            
                if ($toDate) {
                    $query->where('created_at', '<=', $toDate);
                }
            
                $array['dateWiseData'] = $query->get()
                    ->map(function ($item) {
                        return ['name' => $item->date, 'y' => $item->total];
                    });
    
            return view('user.analytics.qr_analytics', $array);
        }
    }
    
}
