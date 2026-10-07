<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\Wallets;
use App\Models\Camping;
use App\Models\SpinnerForm;
use App\Models\ip_skip;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionResult;
use App\Models\MyForm;
use App\Models\feedback_form_submit;
use App\Models\privateReview;
use App\Models\TemplateCategory;
use App\Models\video_testimonial;
use App\Models\Integration;
use App\Models\ReviewLinksAnalytics;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Str;

use Config;
use Mail;
use App\Mail\adminForgotPassMail;
use App\Mail\OtpVerifyMail;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Http;


class UserController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function redirectToGoogle(Request $request)
    {
        $clientId = env('GOOGLE_CLIENT_ID');
        $redirectUri = url('/auth/google/callback');
        
        if (empty($clientId)) {
            $notification = array(
                'messege' => 'Google Login is ready! To connect your live Google Cloud Console app, please add GOOGLE_CLIENT_ID & GOOGLE_CLIENT_SECRET to your .env configuration.',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }

        $state = Str::random(40);
        Session::put('oauth_state', $state);

        $query = http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => $redirectUri,
            'response_type' => 'code',
            'scope' => 'openid profile email',
            'access_type' => 'offline',
            'state' => $state,
            'prompt' => 'select_account'
        ]);

        return redirect('https://accounts.google.com/o/oauth2/v2/auth?' . $query);
    }

    public function handleGoogleCallback(Request $request)
    {
        if ($request->has('error')) {
            $notification = array(
                'messege' => 'Google Sign In was cancelled or failed.',
                'alert-type' => 'error'
            );
            return redirect('/login')->with($notification);
        }

        $code = $request->get('code');
        if (empty($code)) {
            $notification = array(
                'messege' => 'Invalid authorization code from Google.',
                'alert-type' => 'error'
            );
            return redirect('/login')->with($notification);
        }

        $clientId = env('GOOGLE_CLIENT_ID');
        $clientSecret = env('GOOGLE_CLIENT_SECRET');
        $redirectUri = url('/auth/google/callback');

        try {
            $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
                'code' => $code,
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri' => $redirectUri,
                'grant_type' => 'authorization_code',
            ]);

            if (!$response->successful()) {
                $notification = array(
                    'messege' => 'Google token exchange failed. Please verify your Google API Client credentials in .env.',
                    'alert-type' => 'error'
                );
                return redirect('/login')->with($notification);
            }

            $tokenData = $response->json();
            $accessToken = $tokenData['access_token'] ?? null;

            if (!$accessToken) {
                $notification = array(
                    'messege' => 'No access token received from Google.',
                    'alert-type' => 'error'
                );
                return redirect('/login')->with($notification);
            }

            $userResponse = Http::withToken($accessToken)->get('https://www.googleapis.com/oauth2/v3/userinfo');
            if (!$userResponse->successful()) {
                $notification = array(
                    'messege' => 'Failed to fetch user profile from Google.',
                    'alert-type' => 'error'
                );
                return redirect('/login')->with($notification);
            }

            $googleUser = $userResponse->json();
            return $this->loginOrCreateGoogleUser($googleUser);

        } catch (\Exception $e) {
            $notification = array(
                'messege' => 'Google Login Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect('/login')->with($notification);
        }
    }

    public function handleGoogleOneTap(Request $request)
    {
        $credential = $request->input('credential');
        if (empty($credential)) {
            $notification = array(
                'messege' => 'Missing Google credential.',
                'alert-type' => 'error'
            );
            return redirect('/login')->with($notification);
        }

        try {
            $response = Http::get('https://oauth2.googleapis.com/tokeninfo', [
                'id_token' => $credential
            ]);

            if ($response->successful()) {
                $payload = $response->json();
                $googleUser = [
                    'sub' => trim($payload['sub'] ?? ''),
                    'email' => strtolower(trim($payload['email'] ?? '')),
                    'name' => trim($payload['name'] ?? ($payload['email'] ?? 'Google User')),
                    'picture' => $payload['picture'] ?? null,
                ];

                return $this->loginOrCreateGoogleUser($googleUser);
            }

            $notification = array(
                'messege' => 'Invalid Google credential token.',
                'alert-type' => 'error'
            );
            return redirect('/login')->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'messege' => 'Google Authentication Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect('/login')->with($notification);
        }
    }

    public function loginOrCreateGoogleUser($googleUser)
    {
        $googleId = trim($googleUser['sub'] ?? '');
        $email = strtolower(trim($googleUser['email'] ?? ''));
        $name = trim($googleUser['name'] ?? ($googleUser['email'] ?? 'Google User'));
        $avatar = $googleUser['picture'] ?? '';

        if (empty($email)) {
            $notification = array(
                'messege' => 'Google email not found in profile response.',
                'alert-type' => 'error'
            );
            return redirect('/login')->with($notification);
        }

        // Search for existing user by normalized email OR google_id
        $user = User::where(function($query) use ($email, $googleId) {
            $query->whereRaw('LOWER(TRIM(email)) = ?', [$email]);
            if (!empty($googleId)) {
                $query->orWhere('google_id', $googleId);
            }
        })->first();

        if ($user) {
            if (!empty($googleId) && empty($user->google_id)) {
                $user->google_id = $googleId;
            }
            if (!empty($avatar) && empty($user->avatar)) {
                $user->avatar = $avatar;
            }
            $user->save();

            if ($user->status != 'active') {
                $notification = array(
                    'messege' => 'Your account is inactive. Please contact administrator.',
                    'alert-type' => 'error'
                );
                return redirect('/login')->with($notification);
            }

            if (empty($user->phone)) {
                Session::put('needs_google_onboarding', true);
            }

            Auth::login($user, true);
            $notification = array(
                'messege' => 'Welcome back, ' . $user->name . '!',
                'alert-type' => 'success'
            );
            return redirect('admin/dashboard')->with($notification);
        }

        // Strict guard: ensure email is not already present before creating
        $existingByEmail = User::whereRaw('LOWER(TRIM(email)) = ?', [$email])->first();
        if ($existingByEmail) {
            if (!empty($googleId) && empty($existingByEmail->google_id)) {
                $existingByEmail->google_id = $googleId;
                $existingByEmail->save();
            }
            Auth::login($existingByEmail, true);
            return redirect('admin/dashboard');
        }

        // First time Google Sign in / Registration: USER TYPE MUST BE 'user'
        $nameUrl = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '_', trim($name)));
        if (empty($nameUrl)) {
            $nameUrl = 'user_' . rand(1000, 9999);
        }
        $count = User::where('name_url', $nameUrl)->count();
        if ($count > 0) {
            $nameUrl = $nameUrl . '_' . rand(100, 999);
        }

        $superAdmin = User::where('email', 'digitalvyapariofficial@gmail.com')->first() ?? User::first();
        $parentUserId = $superAdmin ? $superAdmin->id : 1;

        $lastUser = User::where('user_id', $parentUserId)->orderBy('id', 'desc')->first();
        $formattedNumber = '001';
        if ($lastUser && is_numeric($lastUser->user_unique_id)) {
            $formattedNumber = sprintf('%03d', (int)$lastUser->user_unique_id + 1);
        }

        $TemplateCategory = TemplateCategory::orderBy('id', 'desc')->first();
        $presentDate = date('Y-m-d');
        $futureDate = date('Y-m-d', strtotime($presentDate . ' + 7 days'));

        $newUser = User::create([
            'user_unique_id' => $formattedNumber,
            'name' => $name,
            'name_url' => $nameUrl,
            'email' => $email,
            'google_id' => $googleId,
            'avatar' => $avatar,
            'password' => Hash::make(Str::random(24)),
            'phone' => '',
            'type' => 'user', // FIRST TIME LOGIN WITH GOOGLE USER TYPE WILL BE USER
            'status' => 'active',
            'expiry_date' => $futureDate,
            'seven_day_trial' => 'YES',
            'user_create_limit' => 10,
            'front_page_text' => '',
            'default_background' => 'Yes',
            'facebook_share' => 'Yes',
            'wp_share' => 'Yes',
            'template_category_id' => $TemplateCategory ? $TemplateCategory->id : '',
            'user_create_type' => 'google',
            'private_page_text' => 'Leave us a review, it will help us grow and better serve our customers like you.',
            'dynamic_page_text' => 'Leave us a review, it will help us grow and better serve our customers like you.',
            'google_page_text' => 'We want our customers to be 100% satisfied. Please let us know why you had a bad experience, so we can improve our service. Leave your email to be contacted.',
            'user_id' => $parentUserId
        ]);

        try {
            MyForm::create([
                'form_name' => 'Give Us Your Feedback',
                'desc' => 'Your opinion is very important to us. We appreciate your feedback and will use it to serve you better and make improvements in our management.',
                'customer_support' => 'How Was Your Experience?',
                'rate_text' => 'Rate Our Staff Behaviour:',
                'feedback_text' => 'Your Feedback',
                'active_status' => 'active',
                'user_id' => $newUser->id
            ]);
        } catch (\Exception $e) {
            // MyForm created if table available
        }

        Session::put('needs_google_onboarding', true);
        Auth::login($newUser, true);
        $notification = array(
            'messege' => 'Registration successful via Google! Please complete your business profile.',
            'alert-type' => 'success'
        );
        return redirect('admin/dashboard')->with($notification);
    }

    public function complete_google_onboarding(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => ['required', 'string', 'regex:/^(?:(?:\+|0{0,2})91[\s-]?)?[0]?[6-9]\d{9}$/'],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120'
        ], [
            'phone.regex' => 'Please enter a valid 10-digit Indian mobile number.'
        ]);

        $user = User::find(Auth::id());
        $user->name = trim($request->business_name);
        // Prevent changing email if registered or logged in with Google
        if (empty($user->google_id) && $user->user_create_type != 'google' && !empty($request->email)) {
            $user->email = trim($request->email);
        }
        $user->phone = trim($request->phone);

        $nameUrl = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '_', trim($request->business_name)));
        if (!empty($nameUrl)) {
            $existing = User::where('name_url', $nameUrl)->where('id', '!=', $user->id)->count();
            if ($existing > 0) {
                $nameUrl = $nameUrl . '_' . rand(100, 999);
            }
            $user->name_url = $nameUrl;
        }

        // Handle Optional Logo Upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = 'logo_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('upload/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $fileName);
            $user->logo = url('upload/' . $fileName);
        }

        $user->save();
        Session::forget('needs_google_onboarding');

        $notification = array(
            'messege' => 'Business profile setup completed successfully! Welcome to your dashboard.',
            'alert-type' => 'success'
        );

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully!',
                'redirect' => url('admin/dashboard')
            ]);
        }

        return redirect('admin/dashboard')->with($notification);
    }

    public function login_post(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            if (Auth::user()->type == 'super_admin') {
                return redirect('admin/dashboard');
            }

            if (Auth::user()->status == 'active') {
                return redirect('admin/dashboard');
            } else {
                $notification = array(
                    'messege'=>'You are inactive please contact with admin.',
                    'alert-type'=>'error'
                );
                return back()->with($notification);
            }
             
        }
  
        $notification = array(
            'messege'=>'Login details are Invalid',
            'alert-type'=>'error'
        );
        return back()->with($notification);
    }

    public function dashboard()
    {
        if(Auth::check()){

            $presend_day = date('Y-m-d');
            $presend_month = date('m');
            $data['Users'] = User::where('type','user')->where('user_id',Auth::user()->id)->count();
            $data['ActiveUsers'] = User::where('type','user')->where('user_id',Auth::user()->id)->where('status','active')->count();
            $data['Question'] = Question::where('user_id',Auth::user()->id)->count();
            $data['feedback_form_submit'] = feedback_form_submit::where('user_id',Auth::user()->id)->count();
            $data['privateReview'] = privateReview::where('user_id',Auth::user()->id)->count();
            $data['InactiveUsers'] = User::where('type','user')->where('user_id',Auth::user()->id)->where('status','inactive')->count();
            $data['presend_day'] = date('Y-m-d');
            $data['expiredUsers'] = User::where('type','user')->where('user_id',Auth::user()->id)->whereDate('expiry_date','<',$presend_day)->count();
            $data['video_testimonial'] = video_testimonial::where('user_id',Auth::user()->id)->whereMonth('created_at',$presend_month)->count();
            $data['google_reviews_count'] = ReviewLinksAnalytics::where('user_id', Auth::user()->id)->where('type', 'google')->count();
            // $Camping = Camping::where('created_by',Auth::user()->id)->count();
            // $CampingList = Camping::where('created_by',Auth::user()->id)->select('id')->get()->toArray();

            $data['resallers'] = User::where('type','admin')->where('user_id',Auth::user()->id)->count();
            $data['active_resallers'] = User::where('type','admin')->where('user_id',Auth::user()->id)->where('status','active')->count();
            $data['inactive_resallers'] = User::where('type','admin')->where('user_id',Auth::user()->id)->where('status','inactive')->count();
            $data['expired_resallers'] = User::where('type','admin')->where('user_id',Auth::user()->id)->whereDate('expiry_date','<',$presend_day)->count();

            // Recent activity for richer dashboards
            $data['recent_feedbacks'] = feedback_form_submit::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->take(5)->get();
            $data['recent_users'] = User::where('type', 'user')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->take(5)->get();
            $data['recent_resellers'] = User::where('type', 'admin')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->take(5)->get();

            return view('admin.dashboard',$data);
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    


    public function logout(){

        Session::flush();
      // $class=DB::table('class')->get();
       return redirect('/login');
    }


    public function sub_user_list(Request $request){

        if(Auth::check() && Auth::user()->type == 'admin'){


            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(users.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(users.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['user'] = User::where('type','user')->where('user_id',Auth::user()->id)->whereRaw($where)->orderBy('id','desc')->get();
            // dd($user);
            return view('admin.user.list',$array);
        }else{
            return redirect('/');
        }
    }

    public function expiry_sub_user(Request $request){

        if(Auth::check()){

            $date = date('Y-m-d');

            $array['user'] = User::where('type','user')->where('user_id',Auth::user()->id)->whereDate('expiry_date','<=',$date)->get();
            // dd($user);
            return view('admin.user.expiry_user_list',$array);
        }
    }

    public function add_sub_user_page(){

        if(Auth::check()){
            $array['TemplateCategory'] = TemplateCategory::get();
            return view('admin.user.create',$array);
        }
    }

    public function downloadUserPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $user_id = $request->checkbox;
            if ($user_id != null) {
                $array['user'] = User::whereIn('id',$user_id )->get();
            $pdf = PDF::loadView('admin.user.userPdf', $array);
        
            return $pdf->download('user.pdf');
            } else {
                return back();
            }
                  
        }
    }

    public function user_name_checking(Request $request){

        //dd($request->all());

        $user = User::where('name_url',$request->name)->first();
        if ($user) {
            $user_status = 'exist';
        } else {
            $user_status = 'not_exist';
        }
        return $user_status;
    }

    public function add_sub_user(Request $request){

        
        if(Auth::check()){

            $name_url = str_replace(' ', '_',$request->name_url);
            $nameurl = strtolower($name_url);
            
            if ($request->id !='') {
                

                $user = User::find($request->id);

                if(!empty($user->password) && $request->password != null){
                    $user->password = Hash::make($request->password);
                }
                
                $user->name = $request->name;
                $user->name_url = $request->name_url;
                if (empty($user->google_id) && $user->user_create_type != 'google' && !empty($request->email)) {
                    $user->email = $request->email;
                }
                $user->phone = $request->phone;

                if ($request->template_category_id != '') {
                    $user->template_category_id = $request->template_category_id;
                }
                if ($request->status != '') {
                    $user->status = $request->status;
                }
                // if ($request->expiry_date != '') {
                //     $user->expiry_date = $request->expiry_date;
                // }

                if ($request->note != '') {
                    $user->note = $request->note;
                }
                if ($request->background_color != '') {
                    $user->background_color = $request->background_color;
                }
                if ($request->default_background != '') {
                    $user->default_background = $request->default_background;
                }
                if ($request->review_show_option != '') {
                    $user->review_show_option = $request->review_show_option;
                }
                if ($request->front_page_text != '') {
                    $user->front_page_text = $request->front_page_text;
                }
                if ($request->private_page_text != '') {
                    $user->private_page_text = $request->private_page_text;
                }
                if ($request->dynamic_page_text != '') {
                    $user->dynamic_page_text = $request->dynamic_page_text;
                }
                if ($request->google_page_text != '') {
                    $user->google_page_text = $request->google_page_text;
                }

                if ($request->facebook_share != '') {
                    $user->facebook_share = $request->facebook_share;
                }
                if ($request->wp_share != '') {
                    $user->wp_share = $request->wp_share;
                }
                if ($request->private_feedback != '') {
                    $user->private_feedback = $request->private_feedback;
                }

                if (isset($request->file) && !empty($request->file)) {
                    if ($request->hasFile('file')) {
                        $file = $request->file('file');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        $user->logo = $document_link;
                    }

                }
                if (isset($request->background_image) && !empty($request->background_image)) {
                    if ($request->hasFile('background_image')) {
                        $file = $request->file('background_image');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        $user->background_image = $document_link;
                    }

                }
                if ($request->wp_key != '') {
                    $user->wp_key = $request->wp_key;
                }

                if ($request->video_access != '') {
                    $user->video_access = $request->video_access;
                    if ($request->video_access == 'YES') {
                        Integration::updateOrCreate(
                            ['user_id' => $user->id, 'type' => 'record'],
                            [
                                'button_icon' => URL::to('frontend/images/record.png'),
                                'button_name' => 'Video Testimonial',
                                'button_order' => 6,
                                'status' => 'active'
                            ]
                        );
                    } elseif ($request->video_access == 'NO') {
                        Integration::where('user_id', $user->id)->where('type', 'record')->update(['status' => 'inactive']);
                    }
                }
                
                $user->save();

                
                $notification = array(
                    'messege'=>'User Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            } else {

                $user_create_limit = Auth::user()->user_create_limit;
                if ($user_create_limit <= 0) {
                    $notification = array(
                        'messege'=>'You have no limit to create user',
                        'alert-type'=>'error'
                    );
                    return back()->with($notification);
                }

                $user = User::where('email',$request->email)->first();

                if ($user) {
                    $notification = array(
                        'messege'=>'Please enter unique email',
                        'alert-type'=>'error'
                    );
                    return back()->with($notification);
                }

                $document_link  ='';

                if (isset($request->file) && !empty($request->file)) {
                    if ($request->hasFile('file')) {
                        $file = $request->file('file');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        
                    }
                }

                $present_date = date('Y-m-d');

                $user_id_desc = User::where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
                if ($user_id_desc) {
                    $uniq_id = $user_id_desc->user_unique_id+1;
                } else {
                    $uniq_id = 1;
                }
                

                $formattedUserID = sprintf("%03d",  $uniq_id );

                $user = User::create([
                    'user_unique_id' => $formattedUserID,
                    'name' => $request->name,
                    'name_url' => $nameurl,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'type' => 'user',
                    'status' => $request->status,
                    'expiry_date' =>date('Y-m-d', strtotime($present_date.' +7 days')) ,
                    'note' => $request->note,
                    'wp_key' => $request->wp_key,
                    'template_category_id' => $request->template_category_id,
                    'video_access' => $request->video_access,
                    'front_page_text' => '',
                    'default_background' => 'Yes',
                    'facebook_share' => 'Yes',
                    'wp_share' => 'Yes',
                    'user_id' => Auth::user()->id,
                    'private_page_text' => 'Leave us a review, it will help us grow and better serve our customers like you.',
                    'dynamic_page_text' => 'Leave us a review, it will help us grow and better serve our customers like you.',
                    'google_page_text' => 'We want our customers to be 100% satisfied. Please let us know why you had a bad experience, so we can improve our service. Leave your email to be contacted.',
                    'logo' => $document_link
                ]);

                if ($user && $request->video_access == 'YES') {
                    Integration::updateOrCreate(
                        ['user_id' => $user->id, 'type' => 'record'],
                        [
                            'button_icon' => URL::to('frontend/images/record.png'),
                            'button_name' => 'Video Testimonial',
                            'button_order' => 6,
                            'status' => 'active'
                        ]
                    );
                }

                $MyForm = MyForm::create([
                    'form_name'=>'Give Us Your Feedback',
                    'desc'=>'Your opinion is very important to us. We appreciate your feedback and will use it to serve  you better and make improvements in our management.',
                    'customer_support'=>'How Was Your Experience?',
                    'rate_text'=>'Rate Our Staff Behaviour:',
                    'comments'=>'Additional Comment/Suggestion (Optional):',
                    'user_id'=>$user->id,
                ]);

                if ($MyForm) {
                    $Question = Question::create([
                        'question' => 'Where did you first hear about our Business?',
                        'user_id' => $user->id,
                        'status' => 'active'
                    ]);

                    if ($Question) {
                        $answers = ['Advertising','Recommendation'];
                        foreach ($answers as $key => $value) {
                            QuestionAnswer::create([
                                'question_id' => $Question->id,
                                'answers' => $value,
                                'user_id' => $user->id
                            ]);
                        }
                    }
    
                    
                }

                // $my_form = User::find(Auth::user()->id);
                // $my_form->user_create_limit = $my_form->user_create_limit-1;
                // $my_form->save();

                // $Wallets = new Wallets();
                // $Wallets->user_id = Auth::user()->id;
                // $Wallets->amount = 1;
                // $Wallets->note = 'You have user 1 blanced.';
                // $Wallets->credit_debit = 'debit';
                // $Wallets->amount_credit_debit = Auth::user()->name;
                // $Wallets->save();


                $notification = array(
                    'messege'=>'User inserted successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);

            }
        }
    }

    
    public function edit_sub_user($id){

        if(Auth::check()){
            $user = User::where('id',$id)->first();
            $TemplateCategory = TemplateCategory::get();
            return view('admin.user.create',compact('user','id','TemplateCategory'));
        }
    }
    
    public function profile(){

        if(Auth::check()){

            $id = Auth::user()->id;

            $user = User::where('id',$id)->first();
            
            if ($user->type == 'super_admin') {
                return view('admin.user.admin_profile',compact('user','id'));
            }
            else if ($user->type == 'admin') {
                return view('admin.user.admin_profile',compact('user','id'));
            } else {
                return view('admin.user.profile',compact('user','id'));
            }
              
        }
    }
    
    public function profile_update(Request $request){

        if(Auth::check()){
            
            // $id = Auth::user()->id;
 
            // $user = User::find($request->id);
            // $user->name = $request->name;
            // $user->email = $request->email;
            // if ($request->password != '') {
            //     $user->password = $request->password;
            // }
            // $user->phone = $request->phone;
            // $user->note = $request->note;
            // if (isset($request->file) && !empty($request->file)) {
            //     if ($request->hasFile('file')) {
            //         $file = $request->file('file');
            //         $name = time() . '.' . $file->getClientOriginalExtension();
            //         $destinationPath = public_path('upload/');
            //         $file->move($destinationPath, $name);

            //         $document_link =  URL('upload/'.$name);
            //         $user->logo = $document_link;
            //     }

            // }
            
            // $user->save();

            
            // $notification = array(
            //     'messege'=>'User Updated successfully',
            //     'alert-type'=>'success'
            // );
            // return back()->with($notification);

            $name_url = str_replace(' ', '_',$request->name_url);
            $nameurl = strtolower($name_url);
            
            if ($request->id !='') {
                

                $user = User::find($request->id);

                if ($request->password != '' && $request->old_password != '') {
                    if(!Hash::check($request->old_password, $user->password)){
                        $notification = array(
                            'messege'=>'Old Password is not matching',
                            'alert-type'=>'error'
                        );
                        return back()->with($notification);
                    }else{
                        $user->password = Hash::make($request->password);
                    }
                    
                }

                if ($request->customer_password == 'changed') {
                    if(!empty($request->password) && $request->password != null){
                        $user->password = Hash::make($request->password);
                    }
                }

                $user->name = $request->name;
                $user->name_url = $request->name_url;
                if (empty($user->google_id) && $user->user_create_type != 'google' && !empty($request->email)) {
                    $user->email = $request->email;
                }
                $user->phone = $request->phone;

                if ($request->template_category_id != '') {
                    $user->template_category_id = $request->template_category_id;
                }
                if ($request->status != '') {
                    $user->status = $request->status;
                }
                // if ($request->expiry_date != '') {
                //     $user->expiry_date = $request->expiry_date;
                // }

                if ($request->note != '') {
                    $user->note = $request->note;
                }
                if ($request->background_color != '') {
                    $user->background_color = $request->background_color;
                }
                if ($request->default_background != '') {
                    $user->default_background = $request->default_background;
                }
                if ($request->review_show_option != '') {
                    $user->review_show_option = $request->review_show_option;
                }
                if ($request->front_page_text != '') {
                    $user->front_page_text = $request->front_page_text;
                }
                if ($request->private_page_text != '') {
                    $user->private_page_text = $request->private_page_text;
                }
                if ($request->dynamic_page_text != '') {
                    $user->dynamic_page_text = $request->dynamic_page_text;
                }
                if ($request->google_page_text != '') {
                    $user->google_page_text = $request->google_page_text;
                }

                if ($request->facebook_share != '') {
                    $user->facebook_share = $request->facebook_share;
                }
                if ($request->wp_share != '') {
                    $user->wp_share = $request->wp_share;
                }
                if ($request->private_feedback != '') {
                    $user->private_feedback = $request->private_feedback;
                }

                if (isset($request->file) && !empty($request->file)) {
                    if ($request->hasFile('file')) {
                        $file = $request->file('file');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        $user->logo = $document_link;
                    }

                }
                if (isset($request->background_image) && !empty($request->background_image)) {
                    if ($request->hasFile('background_image')) {
                        $file = $request->file('background_image');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        $user->background_image = $document_link;
                    }

                }
                if ($request->wp_key != '') {
                    $user->wp_key = $request->wp_key;
                }

                if ($request->video_access != '') {
                    $user->video_access = $request->video_access;
                    if ($request->video_access == 'YES') {
                        Integration::updateOrCreate(
                            ['user_id' => $user->id, 'type' => 'record'],
                            [
                                'button_icon' => URL::to('frontend/images/record.png'),
                                'button_name' => 'Video Testimonial',
                                'button_order' => 6,
                                'status' => 'active'
                            ]
                        );
                    } elseif ($request->video_access == 'NO') {
                        Integration::where('user_id', $user->id)->where('type', 'record')->update(['status' => 'inactive']);
                    }
                }
                
                $user->save();

                
                $notification = array(
                    'messege'=>'User Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            }
        }
    }

    public function star_page_status(Request $request){
        $id = Auth::user()->id;
            // dd($request->star_page);
        $star_page = ($request->star_page == 'on')?'YES':'NO';

        $user = User::find($id);
        $user->star_page =$star_page;
        $user->save();

        
        $notification = array(
            'messege'=>'Star Page Updated successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    public function delete_sub_user($id){

        if(Auth::check()){
            
            $user = User::where('id',$id)->first();

            // if ($user->type == 'user') {
            //     $user_owner =  User::where('id',$user->user_id)->first();
            //     $user_owner_up =  User::where('id',$user->user_id)->update([
            //         'user_create_limit'=>$user_owner->user_create_limit + 1
            //     ]);
            // }

            $user = User::where('id',$id)->delete();

            $notification = array(
                'messege'=>'User Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }

    public function sub_user_add_expiry_date($id){

        if(Auth::check()){
            
            $user = User::where('id',$id)->first();

            if ($user->type == 'user') {
                // $user_owner =  User::where('id',$user->user_id)->first();
                // $user_owner_up =  User::where('id',$user->user_id)->update([
                //     'user_create_limit'=>$user_owner->user_create_limit + 1
                // ]);

                if (Auth::user()->user_create_limit < 1) {
                    $notification = array(
                        'messege'=>'You have no credit limit.',
                        'alert-type'=>'error'
                    );
                    return back()->with($notification);
                }

                $my_form = User::find(Auth::user()->id);
                $my_form->user_create_limit = $my_form->user_create_limit-1;
                $my_form->save();

                $Wallets = new Wallets();
                $Wallets->user_id = Auth::user()->id;
                $Wallets->amount = 1;
                $Wallets->note = 'You have user 1 blanced.';
                $Wallets->credit_debit = 'debit';
                $Wallets->amount_credit_debit = $user->name;
                $Wallets->save();

            }
            
            $exp_date = $user->expiry_date;
            $timestamp = strtotime($exp_date);
            // $present_date = date('Y-m-d', $timestamp);
            $present_date = date('Y-m-d');

            $user = User::where('id',$id)->update([
                'expiry_date' =>date('Y-m-d', strtotime($present_date.' +1 year')) ,
            ]);

            $notification = array(
                'messege'=>'User Activated Successfully',
                'alert-type'=>'success'
            );
            return back()->with($notification);
            
        }
    }


    protected function applyDbMailConfig()
    {
        $mail = DB::table('mail_configures')->first();
        if ($mail && !empty($mail->mail_host) && !empty($mail->mail_username)) {
            $port = (int)$mail->mail_port;
            $encryption = ($port == 465) ? 'ssl' : ($mail->mail_encryption ?: 'tls');
            $fromAddress = !empty($mail->mail_from_address) ? $mail->mail_from_address : $mail->mail_username;

            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.transport' => 'smtp',
                'mail.mailers.smtp.host' => $mail->mail_host,
                'mail.mailers.smtp.port' => $port,
                'mail.mailers.smtp.encryption' => $encryption,
                'mail.mailers.smtp.username' => $mail->mail_username,
                'mail.mailers.smtp.password' => $mail->mail_password,
                'mail.mailers.smtp.timeout' => 10,
                'mail.from.address' => $fromAddress,
                'mail.from.name' => $mail->mail_from_name ?: 'AskReview',
            ]);

            app('mail.manager')->purge('smtp');
            return true;
        }
        return false;
    }

    protected function applyEnvMailConfig()
    {
        config([
            'mail.default' => env('MAIL_MAILER', 'smtp'),
            'mail.mailers.smtp.transport' => 'smtp',
            'mail.mailers.smtp.host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'mail.mailers.smtp.port' => (int)env('MAIL_PORT', 587),
            'mail.mailers.smtp.encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'mail.mailers.smtp.username' => env('MAIL_USERNAME'),
            'mail.mailers.smtp.password' => env('MAIL_PASSWORD'),
            'mail.mailers.smtp.timeout' => 10,
            'mail.from.address' => env('MAIL_FROM_ADDRESS', 'noreply@askreview.com'),
            'mail.from.name' => env('MAIL_FROM_NAME', config('app.name', 'AskReview')),
        ]);

        app('mail.manager')->purge('smtp');
        return true;
    }

    protected function setMailConfig()
    {
        $hasEnvConfig = !empty(env('MAIL_USERNAME')) && env('MAIL_HOST') !== 'mailhog';
        $preferEnv = env('MAIL_USE_ENV', false) || $hasEnvConfig;

        if ($preferEnv) {
            $this->applyEnvMailConfig();
        } else {
            if (!$this->applyDbMailConfig()) {
                $this->applyEnvMailConfig();
            }
        }
    }

    //Admin Forgot Password
    public function forgotPassword(){
        return view('admin.forgotPassword.forgotPassword');
    }

    //admin UserId Check
    public function adminUserIdCheck(Request $request){
        $userName = $request->email;
        $admin = DB::table('users')->where('email', $request->email)->first();
        if ($admin) {
            $resetToken = Str::random(40);
            $adminMail = $admin->email;
            $phone = $admin->phone;
            $subject = 'Your AskReview Password Reset OTP';
            $otp = random_int(10000, 99999);

            DB::table('users')->where('id', $admin->id)->update([
                'otp' => $otp,
                'remember_token' => $resetToken,
                'otp_link_status' => $resetToken,
                'user_email_status' => 'urlAvailable'
            ]);

            // Send password reset email with OTP and reset link
            // Supports DB config with automatic fallback to .env (or .env preference)
            $mailSent = false;
            $hasEnvConfig = !empty(env('MAIL_USERNAME')) && env('MAIL_HOST') !== 'mailhog';
            $preferEnv = env('MAIL_USE_ENV', false) || $hasEnvConfig;

            if ($preferEnv) {
                try {
                    $this->applyEnvMailConfig();
                    $type = "ADMIN";
                    Mail::to($adminMail)->send(new adminForgotPassMail($type, $resetToken, $subject, $otp));
                    $mailSent = true;
                    \Log::info('Forgot password email sent successfully via .env config to: ' . $adminMail);
                } catch (\Throwable $e) {
                    \Log::warning('Email send via .env failed: ' . $e->getMessage() . '. Retrying via DB config...');
                }
            }

            if (!$mailSent) {
                try {
                    if ($this->applyDbMailConfig()) {
                        $type = "ADMIN";
                        Mail::to($adminMail)->send(new adminForgotPassMail($type, $resetToken, $subject, $otp));
                        $mailSent = true;
                        \Log::info('Forgot password email sent successfully via DB config to: ' . $adminMail);
                    }
                } catch (\Throwable $e) {
                    \Log::warning('Email send via DB config failed: ' . $e->getMessage() . '. Attempting fallback to .env...');
                }
            }

            if (!$mailSent && !$preferEnv) {
                try {
                    $this->applyEnvMailConfig();
                    $type = "ADMIN";
                    Mail::to($adminMail)->send(new adminForgotPassMail($type, $resetToken, $subject, $otp));
                    $mailSent = true;
                    \Log::info('Forgot password email sent successfully via .env fallback to: ' . $adminMail);
                } catch (\Throwable $e) {
                    \Log::error('All mail sending attempts (DB and .env) failed: ' . $e->getMessage());
                }
            }

            // Also trigger WhatsApp OTP if phone number is available
            if (!empty($phone)) {
                try {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://app.digitalvyapari.online/api/WhatsApp?authkey=c1NZc1R6QkNmQXp4QitDTzNQdnd6dz09&wa_number=919087868584&mobile=91'.$phone.'&template_name=verify_otp&body_1='.$otp.'&web_url_1=123456',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 5,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        CURLOPT_HTTPHEADER => array(
                            'Cookie: ci_session=7cm81ol6tgc2aei42fli0ggek8otm51n'
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                } catch (\Throwable $e) {
                    \Log::error('Forgot password WhatsApp error: ' . $e->getMessage());
                }
            }

            return redirect('confirmPasswordPage/'.$resetToken)->with('success', 'Verification OTP has been sent to your email and WhatsApp.');

        } else {
            $notification = array(
                'messege' => 'No account found with this email address.',
                'alert-type' => 'error'
            );
            return back()->with($notification)->with('error', 'No account found with this email address.');
        }
    }

    //admin Password Check
    public function confirmPasswordPage($adminKey){
        // Look up by unique token first, then fallback to user_unique_id with active status
        $admin = DB::table('users')
            ->where('remember_token', $adminKey)
            ->orWhere('otp_link_status', $adminKey)
            ->first();

        if (!$admin) {
            $admin = DB::table('users')
                ->where('user_unique_id', $adminKey)
                ->where('user_email_status', 'urlAvailable')
                ->first();

            if (!$admin) {
                $admin = DB::table('users')->where('user_unique_id', $adminKey)->first();
            }
        }

        $adminStatus = '';
        if ($admin) {
            if ($admin->user_email_status == 'urlAvailable') {
                $adminStatus = "urlAvailable";
            } else {
                $adminStatus = "urlNotAvailable";
            }
        } else {
            $adminStatus = "adminNotAvailable";
        }

        return view('admin.forgotPassword.forgotConfirmPassword', compact('adminKey', 'adminStatus'));
    }

    //admin Password Check
    public function confirmPassword(Request $request){
        $password = $request->password;
        $confirmPassword = $request->confirmPassword;
        
        $admin = User::where('remember_token', $request->adminKey)
            ->orWhere('otp_link_status', $request->adminKey)
            ->first();

        if (!$admin) {
            $admin = User::where('user_unique_id', $request->adminKey)
                ->where('user_email_status', 'urlAvailable')
                ->first();

            if (!$admin) {
                $admin = User::where('user_unique_id', $request->adminKey)->first();
            }
        }

        if (!$admin) {
            return redirect('forgotPassword')->with('error', 'Invalid or expired password reset request.');
        }

        if ($admin->otp == $request->otp) {
            if ($password == $confirmPassword) {
                DB::table('users')->where('id', $admin->id)->update([
                    'password' => Hash::make($password),
                    'user_email_status' => 'urlNotAvailable',
                    'otp' => null,
                    'remember_token' => null,
                    'otp_link_status' => null,
                ]);
                
                $credentials = [
                    'email' => $admin->email,
                    'password' => $password,
                ];

                if (Auth::attempt($credentials)) {
                    return redirect('admin/dashboard');
                }

                return redirect('login')->with('success', 'Password reset successfully! Please sign in with your new password.');
            } else {
                $notification = array(
                    'messege' => 'Passwords do not match.',
                    'alert-type' => 'error'
                );
                return back()->with($notification)->with('error', 'Passwords do not match. Please try again.');
            }
        } else {
            $notification = array(
                'messege' => 'Please enter the correct OTP code.',
                'alert-type' => 'error'
            );
            return back()->with($notification)->with('error', 'Invalid OTP code. Please check your email and enter the correct code.');
        }
    }



    //---------------------------------- Skip Ip ------------------------------------

    public function dashboard_visit($id){

        if(Auth::check()){
            
            $user = User::where('id',$id)->first();
            Auth::login($user);

            return redirect('admin/dashboard');
            
        }
    }

    public function view_qr(Request $request){

        if(Auth::check()){
            
 
            return view('admin/view_qr');
            
        }
    }

    public function print_qr_code(Request $request){

        if(Auth::check()){

            return view('admin/print_qr_code');
            
        }
    }
    public function showQRCode(Request $request){

      // Generate a simple QR code with the given data
      $qrCode = QrCode::format('png')->size(300)->generate('Your QR Code Data');

      // Return the image as a response
      return response($qrCode)->header('Content-Type', 'image/png');
  

    }

    public function generatePDF()
    {
            
        $pdf = PDF::loadView('admin.my_qr_code');
        
        return $pdf->download('MyQRCode.pdf');
    }

    //--------------------------------- Admin Section ---------------------------------------

    
    public function admin_list(Request $request){

        if(Auth::check() && Auth::user()->type == 'super_admin'){


            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(users.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(users.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['user'] = User::where('type','admin')->whereRaw($where)->get();
            // dd($user);
            return view('admin.admin_list.list',$array);
        }else{
            return redirect('/');
        }
    }

    public function admin_dashboard_visit($id){

        if(Auth::check()){
            
            $user = User::where('id',$id)->first();
            Auth::login($user);

            return redirect('admin/dashboard');
            
        }
    }

    public function expiry_admin(Request $request){

        if(Auth::check()){

            $date = date('Y-m-d');

            $array['user'] = User::where('type','admin')
            ->where('user_id',Auth::user()->id)
            ->whereDate('expiry_date','<=',$date)
            ->get();
            // dd( $array['user'] );
            return view('admin.admin_list.expiry_user_list',$array);
        }
    }

    public function add_admin_user(){

        if(Auth::check()){
            return view('admin.admin_list.create');
        }
    }

    public function downloadadminPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $user_id = $request->checkbox;
            if ($user_id != null) {
                $array['user'] = User::whereIn('id',$user_id )->get();
            $pdf = PDF::loadView('admin.admin_list.userPdf', $array);
        
            return $pdf->download('admin_list.pdf');
            } else {
                return back();
            }
                  
        }
    }

    public function admin_name_checking(Request $request){

        //dd($request->all());

        $user = User::where('name_url',$request->name)->first();
        if ($user) {
            $user_status = 'exist';
        } else {
            $user_status = 'not_exist';
        }
        return $user_status;
    }

    public function submit_admin_user(Request $request){

        if(Auth::check()){

            $name_url = str_replace(' ', '_',$request->name);
            $nameurl = strtolower($name_url);
            
            if ($request->id !='') {
                

                $user = User::find($request->id);

                if ($request->password != '' && $request->old_password != '') {
                    if(!Hash::check($request->old_password, $user->password)){
                        $notification = array(
                            'messege'=>'Old Password is not matching',
                            'alert-type'=>'error'
                        );
                        return back()->with($notification);
                    }else{
                        $user->password = Hash::make($request->password);
                    }
                    
                }

                if ($request->customer_password == 'changed') {
                    if(!empty($request->password) && $request->password != null){
                        $user->password = Hash::make($request->password);
                    }
                }

                $user->name = $request->name;
                $user->name_url = $nameurl;
                $user->email = $request->email;
                
                $user->phone = $request->phone;
                // $user->user_create_limit = $request->user_create_limit;
                if ($request->status != '') {
                    $user->status = $request->status;
                }
                if ($request->expiry_date != '') {
                    $user->expiry_date = $request->expiry_date;
                }

                if ($request->note != '') {
                    $user->note = $request->note;
                }
                if ($request->background_color != '') {
                    $user->background_color = $request->background_color;
                }
                if ($request->default_background != '') {
                    $user->default_background = $request->default_background;
                }
                if ($request->review_show_option != '') {
                    $user->review_show_option = $request->review_show_option;
                }
                if ($request->front_page_text != '') {
                    $user->front_page_text = $request->front_page_text;
                }
                if ($request->private_page_text != '') {
                    $user->private_page_text = $request->private_page_text;
                }
                if ($request->dynamic_page_text != '') {
                    $user->dynamic_page_text = $request->dynamic_page_text;
                }
                if ($request->google_page_text != '') {
                    $user->google_page_text = $request->google_page_text;
                }

                if ($request->facebook_share != '') {
                    $user->facebook_share = $request->facebook_share;
                }
                if ($request->wp_share != '') {
                    $user->wp_share = $request->wp_share;
                }
                if ($request->private_feedback != '') {
                    $user->private_feedback = $request->private_feedback;
                }
                
                if ($request->video_access != '') {
                    $user->video_access = $request->video_access;
                    if ($request->video_access == 'YES') {
                        Integration::updateOrCreate(
                            ['user_id' => $user->id, 'type' => 'record'],
                            [
                                'button_icon' => URL::to('frontend/images/record.png'),
                                'button_name' => 'Video Testimonial',
                                'button_order' => 6,
                                'status' => 'active'
                            ]
                        );
                    } elseif ($request->video_access == 'NO') {
                        Integration::where('user_id', $user->id)->where('type', 'record')->update(['status' => 'inactive']);
                    }
                }

                if (isset($request->file) && !empty($request->file)) {
                    if ($request->hasFile('file')) {
                        $file = $request->file('file');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        $user->logo = $document_link;
                    }

                }
                if (isset($request->background_image) && !empty($request->background_image)) {
                    if ($request->hasFile('background_image')) {
                        $file = $request->file('background_image');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        $user->background_image = $document_link;
                    }

                }
                if ($request->wp_key != '') {
                    $user->wp_key = $request->wp_key;
                }
                
                $user->save();

                
                $notification = array(
                    'messege'=>'Admin Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            } else {

                $user = User::where('email',$request->email)->first();

                if ($user) {
                    $notification = array(
                        'messege'=>'Please enter unique email',
                        'alert-type'=>'error'
                    );
                    return back()->with($notification);
                }

                $document_link  ='';

                if (isset($request->file) && !empty($request->file)) {
                    if ($request->hasFile('file')) {
                        $file = $request->file('file');
                        $name = time() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = public_path('upload/');
                        $file->move($destinationPath, $name);

                        $document_link =  URL('upload/'.$name);
                        
                    }
                }

                $user_id_desc = User::where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
                if ($user_id_desc) {
                    $uniq_id = $user_id_desc->user_unique_id+1;
                } else {
                    $uniq_id = 1;
                }
                

                $formattedUserID = sprintf("%03d",  $uniq_id );

                $user = User::create([
                    'user_unique_id' => $formattedUserID,
                    'name' => $request->name,
                    'name_url' => $nameurl,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'type' => 'admin',
                    'status' => $request->status,
                    'expiry_date' => $request->expiry_date,
                    'note' => $request->note,
                    //'user_create_limit' => ($request->user_create_limit)?$request->user_create_limit:1,
                    'front_page_text' => '',
                    'default_background' => 'Yes',
                    'facebook_share' => 'Yes',
                    'wp_share' => 'Yes',
                    'user_id' => Auth::user()->id,
                    'video_access' => $request->video_access,
                    'user_id' => Auth::user()->id,
                    'logo' => $document_link
                ]);

                if ($user && $request->video_access == 'YES') {
                    Integration::updateOrCreate(
                        ['user_id' => $user->id, 'type' => 'record'],
                        [
                            'button_icon' => URL::to('frontend/images/record.png'),
                            'button_name' => 'Video Testimonial',
                            'button_order' => 6,
                            'status' => 'active'
                        ]
                    );
                }

                
                $notification = array(
                    'messege'=>'Admin inserted successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);

            }
            


        }
    }

    
    public function edit_admin($id){

        if(Auth::check()){
            $user = User::where('id',$id)->first();
            return view('admin.admin_list.create',compact('user','id'));
        }
    }

    public function delete_admin($id){

        if(Auth::check()){
            $user = User::where('id',$id)->delete();
            $notification = array(
                'messege'=>'Admin deleted successfully',
                'alert-type'=>'success'
            );
            return back()->with($notification);
        }
    }

    //--------------------------------- Admin Section End ------------------------------------
}
