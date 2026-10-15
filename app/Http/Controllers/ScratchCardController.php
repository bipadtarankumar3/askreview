<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Payment;
use App\Models\ScratchCard;
use App\Models\ScratchCardLead;

class ScratchCardController extends Controller
{
    /**
     * Check if a given user has access to Scratch Card functionality
     */
    public static function hasAccess($user)
    {
        if (!$user) return false;
        if ($user->type === 'admin') return true;
        if (($user->scratch_card_access ?? 'NO') === 'YES') return true;

        // Check active payment plan
        $activePayment = Payment::select('payments.*', 'services.scratch_card_access')
            ->join('services', 'services.id', '=', 'payments.service_id')
            ->where('payments.user_id', $user->id)
            ->where('payments.status', 'success')
            ->orderBy('payments.id', 'desc')
            ->first();

        if ($activePayment && ($activePayment->scratch_card_access ?? 'N') === 'Y') {
            return true;
        }

        return false;
    }

    /**
     * User panel: Scratch card management and leads dashboard
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        $hasAccess = self::hasAccess($user);

        $cards = ScratchCard::where('user_id', $user->id)
            ->withCount([
                'leads',
                'leads as claimed_count' => function ($q) {
                    $q->where('status', 'claimed');
                },
                'leads as redeemed_count' => function ($q) {
                    $q->where('status', 'redeemed');
                }
            ])
            ->orderBy('id', 'desc')
            ->get();

        $activeCard = ScratchCard::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        // Search and filter query for leads table
        $leadQuery = ScratchCardLead::with('scratchCard')->where('user_id', $user->id);

        if ($request->filled('card_id')) {
            $leadQuery->where('scratch_card_id', $request->card_id);
        }

        if ($request->filled('search')) {
            $s = trim($request->search);
            $leadQuery->where(function ($q) use ($s) {
                $q->where('customer_name', 'like', "%{$s}%")
                  ->orWhere('customer_phone', 'like', "%{$s}%")
                  ->orWhere('customer_email', 'like', "%{$s}%")
                  ->orWhere('coupon_code', 'like', "%{$s}%")
                  ->orWhere('offer_won', 'like', "%{$s}%");
            });
        }
        if ($request->filled('status')) {
            $leadQuery->where('status', $request->status);
        }

        $leads = $leadQuery->orderBy('id', 'desc')->paginate(15);

        // Comprehensive stats
        $totalScratches = ScratchCard::where('user_id', $user->id)->sum('scratch_count');
        $totalLeads = ScratchCardLead::where('user_id', $user->id)->count();
        $stats = [
            'total_cards' => $cards->count(),
            'active_card' => $activeCard ? $activeCard->title : 'None Active',
            'total_scratches' => max($totalScratches, $totalLeads),
            'total_leads' => $totalLeads,
            'claimed_leads' => ScratchCardLead::where('user_id', $user->id)->where('status', 'claimed')->count(),
            'redeemed_leads' => ScratchCardLead::where('user_id', $user->id)->where('status', 'redeemed')->count(),
        ];

        return view('user.scratch_card.index', compact('hasAccess', 'cards', 'activeCard', 'leads', 'stats', 'user'));
    }

    /**
     * Store or update a scratch card
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        if (!self::hasAccess($user)) {
            return back()->with([
                'messege' => 'Scratch Card feature is locked for your account. Please upgrade your subscription.',
                'alert-type' => 'error'
            ]);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'offer_text' => 'required|string|max:255',
            'coupon_code' => 'nullable|string|max:100',
            'card_theme' => 'nullable|string|in:gold,emerald,sapphire,crimson,violet',
            'status' => 'nullable|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120'
        ]);

        $shouldActivate = $request->status === 'active';

        // Client requirement: Can have multiple scratch cards, but can active any 1!
        if ($shouldActivate) {
            ScratchCard::where('user_id', $user->id)->update(['status' => 'inactive']);
        }

        $data = [
            'title' => $request->title,
            'offer_text' => $request->offer_text,
            'coupon_code' => $request->coupon_code ? strtoupper(trim($request->coupon_code)) : null,
            'description' => $request->description,
            'card_theme' => $request->card_theme ?? 'gold',
            'status' => $shouldActivate ? 'active' : 'inactive',
        ];

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imgName = 'scratch_' . time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $destDir = public_path('uploads/scratch_cards');
            if (!file_exists($destDir)) {
                mkdir($destDir, 0755, true);
            }
            $imageFile->move($destDir, $imgName);
            $data['image'] = 'uploads/scratch_cards/' . $imgName;
        }

        if ($request->filled('id')) {
            $card = ScratchCard::where('user_id', $user->id)->where('id', $request->id)->first();
            if ($card) {
                // If replacing image and old image exists, remove old file
                if ($request->hasFile('image') && !empty($card->image) && file_exists(public_path($card->image))) {
                    @unlink(public_path($card->image));
                }
                $card->update($data);
                $msg = 'Scratch card updated successfully!';
            } else {
                return back()->with(['messege' => 'Card not found', 'alert-type' => 'error']);
            }
        } else {
            $data['user_id'] = $user->id;
            
            // If this is user's first card, activate it automatically by default
            $existingCount = ScratchCard::where('user_id', $user->id)->count();
            if ($existingCount === 0) {
                $data['status'] = 'active';
            }

            ScratchCard::create($data);
            $msg = 'New scratch card created successfully!';
        }

        return back()->with([
            'messege' => $msg,
            'alert-type' => 'success'
        ]);
    }

    /**
     * Activate a specific scratch card (deactivates all others)
     */
    public function activate($id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        if (!self::hasAccess($user)) {
            return response()->json(['success' => false, 'message' => 'Feature locked.'], 403);
        }

        $card = ScratchCard::where('user_id', $user->id)->where('id', $id)->first();
        if (!$card) {
            return back()->with(['messege' => 'Scratch card not found.', 'alert-type' => 'error']);
        }

        // Deactivate all other scratch cards for this user
        ScratchCard::where('user_id', $user->id)->update(['status' => 'inactive']);

        // Activate the chosen card
        $card->update(['status' => 'active']);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Scratch Card '{$card->title}' is now active on your public page!",
                'active_id' => $card->id
            ]);
        }

        return back()->with([
            'messege' => "Scratch Card '{$card->title}' is now active on your public page! (Only 1 card active at a time)",
            'alert-type' => 'success'
        ]);
    }

    /**
     * Deactivate a scratch card
     */
    public function deactivate($id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $card = ScratchCard::where('user_id', $user->id)->where('id', $id)->first();
        if ($card) {
            $card->update(['status' => 'inactive']);
        }

        return back()->with([
            'messege' => 'Scratch card deactivated.',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Delete a scratch card
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        $card = ScratchCard::where('user_id', $user->id)->where('id', $id)->first();
        if ($card) {
            // Block deletion if leads exist
            $leadsCount = ScratchCardLead::where('scratch_card_id', $card->id)->count();
            if ($leadsCount > 0) {
                return redirect()->route('scratch_cards.index', ['card_id' => $card->id])->with([
                    'messege' => "Cannot delete scratch card '{$card->title}'! It currently has {$leadsCount} customer lead(s). Please delete all associated leads first.",
                    'alert-type' => 'error'
                ]);
            }

            if (!empty($card->image) && file_exists(public_path($card->image))) {
                @unlink(public_path($card->image));
            }
            $card->delete();
            return back()->with([
                'messege' => 'Scratch card deleted successfully.',
                'alert-type' => 'success'
            ]);
        }

        return back()->with(['messege' => 'Card not found', 'alert-type' => 'error']);
    }

    /**
     * Delete a single customer lead
     */
    public function destroyLead($id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        $lead = ScratchCardLead::where('user_id', $user->id)->where('id', $id)->first();
        if ($lead) {
            $lead->delete();
            return back()->with([
                'messege' => 'Customer lead deleted successfully.',
                'alert-type' => 'success'
            ]);
        }

        return back()->with(['messege' => 'Customer lead not found.', 'alert-type' => 'error']);
    }

    /**
     * AJAX Delete a customer lead
     */
    public function destroyLeadAjax(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $lead = ScratchCardLead::where('user_id', $user->id)->where('id', $request->lead_id)->first();
        if ($lead) {
            $cardId = $lead->scratch_card_id;
            $lead->delete();
            $remaining = ScratchCardLead::where('scratch_card_id', $cardId)->count();
            return response()->json([
                'success' => true,
                'message' => 'Customer lead deleted.',
                'remaining_leads' => $remaining
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Lead not found.'], 404);
    }

    /**
     * Delete all leads for a specific scratch card
     */
    public function destroyAllLeadsForCard($id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        $card = ScratchCard::where('user_id', $user->id)->where('id', $id)->first();
        if ($card) {
            $count = ScratchCardLead::where('user_id', $user->id)->where('scratch_card_id', $card->id)->count();
            ScratchCardLead::where('user_id', $user->id)->where('scratch_card_id', $card->id)->delete();
            return back()->with([
                'messege' => "Deleted {$count} lead(s) for '{$card->title}'. You can now delete this scratch card.",
                'alert-type' => 'success'
            ]);
        }

        return back()->with(['messege' => 'Card not found.', 'alert-type' => 'error']);
    }

    /**
     * Card-wise deep analytics and lead breakdown
     */
    public function cardAnalytics($id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $card = ScratchCard::where('user_id', $user->id)->where('id', $id)->first();
        if (!$card) {
            return response()->json(['success' => false, 'message' => 'Card not found'], 404);
        }

        $leads = ScratchCardLead::where('scratch_card_id', $card->id)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($lead) {
                return [
                    'id' => $lead->id,
                    'customer_name' => $lead->customer_name,
                    'customer_phone' => $lead->customer_phone,
                    'customer_email' => $lead->customer_email,
                    'offer_won' => $lead->offer_won,
                    'coupon_code' => $lead->coupon_code,
                    'status' => $lead->status,
                    'date_time' => $lead->created_at ? $lead->created_at->format('d M Y, h:i A') : 'N/A',
                    'date_relative' => $lead->created_at ? $lead->created_at->diffForHumans() : '',
                ];
            });

        return response()->json([
            'success' => true,
            'card' => [
                'id' => $card->id,
                'title' => $card->title,
                'offer_text' => $card->offer_text,
                'coupon_code' => $card->coupon_code,
                'description' => $card->description,
                'card_theme' => $card->card_theme,
                'image' => $card->image ? asset($card->image) : null,
                'status' => $card->status,
                'created_at' => $card->created_at ? $card->created_at->format('d M Y, h:i A') : 'N/A',
                'scratch_count' => max($card->scratch_count, $leads->count()),
                'leads_count' => $leads->count(),
                'claimed_count' => $leads->where('status', 'claimed')->count(),
                'redeemed_count' => $leads->where('status', 'redeemed')->count(),
            ],
            'leads' => $leads
        ]);
    }

    /**
     * Toggle lead status (claimed / redeemed)
     */
    public function updateLeadStatus(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $lead = ScratchCardLead::where('user_id', $user->id)->where('id', $request->lead_id)->first();
        if ($lead) {
            $lead->status = $request->status === 'redeemed' ? 'redeemed' : 'claimed';
            $lead->save();

            return response()->json([
                'success' => true,
                'status' => $lead->status,
                'message' => 'Lead status updated to ' . ucfirst($lead->status)
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Lead not found.'], 404);
    }

    /**
     * Export customer leads to CSV
     */
    public function exportLeads()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        $leads = ScratchCardLead::where('user_id', $user->id)->orderBy('id', 'desc')->get();

        $filename = "scratch_card_leads_" . date('Y-m-d_H-i') . ".csv";
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['ID', 'Customer Name', 'Phone Number', 'Email', 'Offer Won', 'Coupon Code', 'Status', 'Date & Time'];

        $callback = function () use ($leads, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($leads as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->customer_name,
                    $row->customer_phone,
                    $row->customer_email ?? 'N/A',
                    $row->offer_won ?? 'N/A',
                    $row->coupon_code ?? 'N/A',
                    ucfirst($row->status),
                    $row->created_at ? $row->created_at->format('Y-m-d H:i') : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Public AJAX endpoint: Customer scratches card and submits lead details
     */
    public function submitCustomerLead(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'customer_name' => 'required|string|min:2|max:255',
            'customer_phone' => [
                'required',
                'string',
                'regex:/^(?:(?:\+|0{0,2})91[\s-]?)?[0]?[6-9]\d{9}$/'
            ],
            'customer_email' => 'nullable|email|max:255',
            'scratch_card_id' => 'required|integer',
        ], [
            'customer_name.required' => 'Please enter your full name.',
            'customer_name.min' => 'Please enter at least 2 characters for your name.',
            'customer_phone.required' => 'Please enter your 10-digit mobile number.',
            'customer_phone.regex' => 'Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        // Normalize phone number to clean 10-digit string
        $cleanPhone = preg_replace('/[^0-9]/', '', $request->customer_phone);
        if (strlen($cleanPhone) === 12 && str_starts_with($cleanPhone, '91')) {
            $cleanPhone = substr($cleanPhone, 2);
        } elseif (strlen($cleanPhone) === 11 && str_starts_with($cleanPhone, '0')) {
            $cleanPhone = substr($cleanPhone, 1);
        }

        $user = null;
        if ($request->filled('user_id')) {
            $user = User::find($request->user_id);
        }
        if (!$user && $request->filled('user_name')) {
            $user = User::where('name_url', $request->user_name)->first();
        }

        if (!$user) {
            return response()->json([
                'success' => false,
                'status' => false,
                'message' => 'Business profile not found.'
            ], 404);
        }

        // Verify active scratch card
        $card = ScratchCard::where('user_id', $user->id)
            ->where('id', $request->scratch_card_id)
            ->where('status', 'active')
            ->first();

        if (!$card) {
            return response()->json([
                'success' => false,
                'status' => false,
                'message' => 'This scratch card offer is currently inactive.'
            ], 400);
        }

        $ip = $request->ip();

        // Check if customer already submitted from this phone or this IP address
        $existing = ScratchCardLead::where('user_id', $user->id)
            ->where('scratch_card_id', $card->id)
            ->where(function($q) use ($cleanPhone, $ip) {
                $q->where('customer_phone', $cleanPhone);
                if (!empty($ip)) {
                    $q->orWhere('ip_address', $ip);
                }
            })
            ->first();

        if ($existing) {
            return response()->json([
                'success' => true,
                'status' => true,
                'already_claimed' => true,
                'message' => 'You have already claimed this offer from this device/IP!',
                'coupon_code' => $existing->coupon_code,
                'offer_won' => $existing->offer_won
            ]);
        }

        // Save new lead with normalized phone and IP address
        $lead = ScratchCardLead::create([
            'user_id' => $user->id,
            'scratch_card_id' => $card->id,
            'customer_name' => trim($request->customer_name),
            'customer_phone' => $cleanPhone,
            'customer_email' => $request->customer_email ? trim($request->customer_email) : null,
            'offer_won' => $card->offer_text,
            'coupon_code' => $card->coupon_code,
            'ip_address' => $ip,
            'status' => 'claimed'
        ]);

        // Record scratch IP log if not already recorded
        if (!empty($ip)) {
            $alreadyLogged = DB::table('scratch_card_ip_logs')
                ->where('scratch_card_id', $card->id)
                ->where('ip_address', $ip)
                ->exists();
            if (!$alreadyLogged) {
                DB::table('scratch_card_ip_logs')->insert([
                    'user_id' => $user->id,
                    'scratch_card_id' => $card->id,
                    'ip_address' => $ip,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'status' => true,
            'message' => 'Congratulations! Your reward has been unlocked.',
            'lead_id' => $lead->id,
            'coupon_code' => $card->coupon_code,
            'offer_won' => $card->offer_text,
            'terms' => $card->description
        ]);
    }

    /**
     * Public AJAX endpoint: Increment scratch count when customer starts scratching
     * Enforces: 1 IP can scratch 1 time only.
     */
    public function trackScratch(Request $request)
    {
        if ($request->filled('scratch_card_id')) {
            $card = ScratchCard::find($request->scratch_card_id);
            if ($card) {
                $ip = $request->ip();

                if (!empty($ip)) {
                    $alreadyScratched = DB::table('scratch_card_ip_logs')
                        ->where('scratch_card_id', $card->id)
                        ->where('ip_address', $ip)
                        ->exists();

                    if ($alreadyScratched) {
                        return response()->json([
                            'success' => false,
                            'allowed' => false,
                            'already_scratched' => true,
                            'message' => '1 IP can scratch 1 time only. You have already scratched this card.'
                        ]);
                    }

                    // Record IP log
                    DB::table('scratch_card_ip_logs')->insert([
                        'user_id' => $card->user_id,
                        'scratch_card_id' => $card->id,
                        'ip_address' => $ip,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $card->increment('scratch_count');
                return response()->json(['success' => true, 'allowed' => true, 'scratches' => $card->scratch_count]);
            }
        }
        return response()->json(['success' => false, 'allowed' => false], 400);
    }
}
