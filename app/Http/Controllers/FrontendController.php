<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\FormFields;
use App\Models\ReviewForm;
use App\Models\privateReview;
use App\Models\ReviewFormField;
use App\Models\notification;
use DB;
use Config;
use Mail;
use App\Mail\SpinnerFormMail;
use App\Models\ip_skip;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionResult;
use App\Models\MyForm;
use App\Models\feedback_form_submit;
use App\Models\Integration;
use App\Models\SocialReview;
use App\Models\TemplateCategory;
use App\Models\video_testimonial;
use App\Models\QrTrack;
use App\Models\ReviewLinksAnalytics;
use App\Models\Payment;
use App\Models\GoogleFeedbackTemplate;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Hash;


use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use App\Services\TranscoderService;

class FrontendController extends Controller
{

    protected $transcoder;
    protected $s3;

    public function __construct(TranscoderService $transcoder)
    {
        $this->transcoder = $transcoder;
        // S3Client is lazy-initialized via getS3() to avoid crashing
        // all frontend routes when AWS credentials are missing/empty.
    }

    protected function getS3()
    {
        if (!$this->s3) {
            try {
                $this->s3 = new S3Client([
                    'version'     => 'latest',
                    'region'      => env('AWS_DEFAULT_REGION', 'us-east-1'),
                    'credentials' => [
                        'key'    => env('AWS_ACCESS_KEY_ID'),
                        'secret' => env('AWS_SECRET_ACCESS_KEY'),
                    ],
                ]);
            } catch (\Exception $e) {
                \Log::warning('S3Client init failed: ' . $e->getMessage());
                return null;
            }
        }
        return $this->s3;
    }

    protected function setMailConfig()
    {
        $hasEnvConfig = !empty(env('MAIL_USERNAME')) && env('MAIL_HOST') !== 'mailhog';
        $preferEnv = env('MAIL_USE_ENV', false) || $hasEnvConfig;

        if ($preferEnv) {
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
            return;
        }

        $mail = DB::table('mail_configures')->first();
        if ($mail && !empty($mail->mail_host) && !empty($mail->mail_username)) {
            $port = (int)$mail->mail_port;
            $encryption = $mail->mail_encryption ?: ($port == 465 ? 'ssl' : 'tls');
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
        } else {
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
        }
    }

    public function index($user_name){

        $date = date('Y-m-d');
        $user = User::where('name_url',$user_name)->first();
        // $computerId = $_SERVER['HTTP_USER_AGENT'].$_SERVER['LOCAL_ADDR'].$_SERVER['LOCAL_PORT'].$_SERVER['REMOTE_ADDR'];
        // echo $computerId;die;

        if ($user) {

            $userDate = User::whereDate('expiry_date','>=',$date)->where('id',$user->id)->where('status','active')->first();
            if ($userDate) {

                $today = date('Y-m-d');
                
                //$FormFields = FormFields::where('user_id',$userDate->id)->orderBy('id','asc')->get();
                
                $array['review_links'] = DB::table('review_links')->where('user_id',$userDate->id)->orderBy('id','asc')->get();
                $array['form_data'] = MyForm::where('user_id',$userDate->id)->where('active_status','active')->first();
                //dd($array['form_data']);
                if ($array['form_data']) {
                    $Question = Question::where('user_id',$userDate->id)
                    ->where('p_form_id',$array['form_data']->id)
                    ->orderBy('id','asc')
                    ->get();

                    if(count($Question) > 0 ){
                        $array['Question'] = $Question;
                    }else{
                        
                        $array['Question'] = Question::
                        where('p_form_id',$array['form_data']->form_id)
                        ->orderBy('id','asc')
                        ->get();

                    }

                } else {
                    $array['Question'] = [];
                }
                

                $array['IntegrationGoogle'] = Integration::where('user_id',$userDate->id)
                ->where('type','google')
                ->first();
                $array['IntegrationFacebook'] = Integration::where('user_id',$userDate->id)
                ->where('type','facebook')
                ->first();
                $array['IntegrationYoutube'] = Integration::where('user_id',$userDate->id)
                ->where('type','youtube')
                ->first();
                $array['IntegrationInstagram'] = Integration::where('user_id',$userDate->id)
                ->where('type','instagram')
                ->first();
                $array['IntegrationRecord'] = Integration::where('user_id',$userDate->id)
                ->where('type','record')
                ->first();
                $array['IntegrationWhatsapp'] = Integration::where('user_id',$userDate->id)
                ->where('type','whatsapp')
                ->first();

                
                $array['integrationList'] = Integration::where('user_id',$user->id)->orderBy('button_order','asc')->get();

                $array['googleFeedbackTemplates'] = GoogleFeedbackTemplate::where('user_id', $userDate->id)
                    ->where('status', 'active')
                    ->orderBy('sort_order', 'asc')
                    ->get();

                $array['video_access_show'] = false;
                if ($userDate->user_create_type == 'sign_up') {
                    $service = Payment::select('payments.*','services.title','services.subscription_date','services.video_access')
                    ->join('services','services.id','payments.service_id')
                    ->where('payments.user_id',$userDate->id)
                    ->orderBy('payments.id','desc')
                    ->first();

                    if ($service && $service->video_access	== 'YES') {
                        $array['video_access_show'] = true;
                    }else{

                        if ($userDate->video_access == 'YES') {
                            $array['video_access_show'] = true;
                        }else{
                            $array['video_access_show'] = false;
                        } 
                        
                    }
                    
                }else{
                    if ($userDate->video_access == 'YES') {
                        $array['video_access_show'] = true;
                    }else{
                        $array['video_access_show'] = false;
                    } 
                    
                }


                if (isset($_GET['from']) && $_GET['from'] == 'qr') {
                    $qr = QrTrack::where('ip_address', request()->ip())
                        ->where('user_id', $user->id)
                        ->whereDate('created_at', date('Y-m-d'))
                        ->first();
                    if (empty($qr)) {
                        QrTrack::create([
                            'user_id' => $user->id,
                            'ip_address' => request()->ip(),
                            'qr_count' => 1
                        ]);
                    } else {
                        $qr->increment('qr_count');
                    }
                }
                

                $array['user'] = $user;

                $array['user_name'] = $user_name;

                if ($userDate->star_page == 'YES') {
                    return view('frontend.index', $array);
                } else {
                    return view('frontend.plan_page', $array);
                }
                

                

            } else {
                $status= 'user_date_expired';
                return view('frontend.404',compact('status'));
            }
            
        } else {
            $status= 'no_user_available';
            return view('frontend.404',compact('status'));
        }
         
    }


    // Captcha generator helper
    public function generateCaptcha()
    {
        $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < 5; $i++) {
            $code .= $chars[rand(0, strlen($chars) - 1)];
        }
        session(['signup_captcha' => $code]);
        return $code;
    }

    public function refresh_captcha()
    {
        $code = $this->generateCaptcha();
        return response()->json(['status' => true, 'code' => $code]);
    }

    // Direct Sign up
    public function site_signup_direct()
    {
        $user = User::where('type', 'super_admin')->first() ?? User::first();
        if (!$user) {
            $user = new User();
            $user->id = 1;
            $user->name = 'AskReview';
        }
        $captcha_code = $this->generateCaptcha();
        return view('frontend.signup', [
            'user' => $user,
            'captcha_code' => $captcha_code
        ]);
    }

    // User referral / affiliate Sign up
    public function site_singup($user_name)
    {
        $user = User::where('name_url', $user_name)->first();
        if (!$user) {
            $user = User::where('type', 'super_admin')->first() ?? User::first();
            if (!$user) {
                $user = new User();
                $user->id = 1;
                $user->name = 'AskReview';
            }
        }
        $captcha_code = $this->generateCaptcha();
        return view('frontend.signup', [
            'user' => $user,
            'captcha_code' => $captcha_code
        ]);
    }

    public function singup_post(Request $request)
    {
        // 1. Validate Captcha
        $captcha = strtoupper(trim($request->input('captcha', '')));
        $sessionCaptcha = strtoupper(trim(session('signup_captcha', '')));

        if (empty($captcha) || empty($sessionCaptcha) || $captcha !== $sessionCaptcha) {
            $this->generateCaptcha();
            $notification = array(
                'messege' => 'Invalid Security Captcha code. Please try again.',
                'alert-type' => 'error'
            );
            return back()->withInput()->with($notification);
        }

        // 2. Validate Password match
        if ($request->password !== $request->confirm_password) {
            $notification = array(
                'messege' => 'Passwords do not match.',
                'alert-type' => 'error'
            );
            return back()->withInput()->with($notification);
        }

        // 3. Unique email check
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $notification = array(
                'messege' => 'Email address is already registered. Please login or use another email.',
                'alert-type' => 'error'
            );
            return back()->withInput()->with($notification);
        }

        $name_url = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '_', trim($request->name)));
        if (empty($name_url)) {
            $name_url = 'user_' . rand(1000, 9999);
        }
        $count = User::where('name_url', $name_url)->count();
        if ($count > 0) {
            $name_url = $name_url . '_' . rand(100, 999);
        }

        $TemplateCategory = TemplateCategory::orderBy('id', 'desc')->first();
        $present_data = date('Y-m-d');
        $future_date = date('Y-m-d', strtotime($present_data . ' + 7 days'));
        
        $superAdmin = User::where('type', 'super_admin')->first() ?? User::first();
        $user_id = $request->user_id ?: ($superAdmin ? $superAdmin->id : 1);

        $last_user = User::where('user_id', $user_id)->orderBy('id', 'desc')->first();
        $formatted_number = '001';
        if ($last_user && is_numeric($last_user->user_unique_id)) {
            $formatted_number = sprintf('%03d', (int)$last_user->user_unique_id + 1);
        }

        $user_create = User::create([
            'user_unique_id' => $formatted_number,
            'name' => $request->name,
            'name_url' => $name_url,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'type' => 'user',
            'status' => 'active',
            'expiry_date' => $future_date,
            'seven_day_trial' => 'YES',
            'user_create_limit' => 10,
            'front_page_text' => '',
            'default_background' => 'Yes',
            'facebook_share' => 'Yes',
            'wp_share' => 'Yes',
            'template_category_id' => isset($TemplateCategory) ? $TemplateCategory->id : '',
            'user_create_type' => 'sign_up',
            'private_page_text' => 'Leave us a review, it will help us grow and better serve our customers like you.',
            'dynamic_page_text' => 'Leave us a review, it will help us grow and better serve our customers like you.',
            'google_page_text' => 'We want our customers to be 100% satisfied. Please let us know why you had a bad experience, so we can improve our service. Leave your email to be contacted.',
            'user_id' => $user_id 
        ]);

        try {
            MyForm::create([
                'form_name' => 'Give Us Your Feedback',
                'desc' => 'Your opinion is very important to us. We appreciate your feedback and will use it to serve you better and make improvements in our management.',
                'customer_support' => 'How Was Your Experience?',
                'rate_text' => 'Rate Our Staff Behaviour:',
                'feedback_text' => 'Your Feedback',
                'active_status' => 'active',
                'user_id' => $user_create->id
            ]);
        } catch (\Exception $e) {
        }

        session()->forget('signup_captcha');

        $notification = array(
            'messege' => 'Registration successful! Please login with your credentials.',
            'alert-type' => 'success'
        );
        return redirect('/login')->with($notification);
    }


    public function review_form_submit(Request $request){

        // try {
            $user_id =decrypt($request->user_id); 
            $User = User::where('id',$user_id)->first();
            $data = $request->all();
            //  dd($data );
            if ($User) {

                // $url='';
                //     if($request->hasFile('screenshot')) {
                //         $screenshot=$request->file('screenshot');
                //         $milisecond=round(microtime(true)*1000);
                //         $name=$screenshot->getClientOriginalName();
                //         $actual_name=str_replace(" ","_",$name);
                //         $uploadName=$milisecond."_".$actual_name;
                //         $screenshot->move(public_path().'/upload/',$uploadName);
                //         $url = asset('upload/'.$uploadName);
                // }
                // date_default_timezone_set("Asia/Calcutta"); 
                // $arr = array(
                //     'rating'=>$request->rating_number,
                //     'customer_name'=>$request->customer_name,
                //     'user_id'=>$user_id,
                // );
                // $ReviewForm = ReviewForm::create($arr);

                // foreach ($data as $key => $value) {
                //     if ($key != '_token' &&  $key != 'user_id' && $key != 'rating1' && $key != 'customer_name') {
                //         $arra = array(
                //             'review_form_id'=>$ReviewForm->id,
                //             'key'=>$key ,
                //             'value'=>$value
                //         );
                //         ReviewFormField::create($arra);
                //     }
                // }


                $arr = array(
                    'user_id'=>$user_id,
                    'form_id'=>($request->form_id)?$request->form_id:'',
                    'rating_number'=>($request->rating_number)?$request->rating_number:'',
                    'f_customer_support'=>($request->f_customer_support)?$request->f_customer_support:'',
                    'f_rate_text'=>($request->f_rate_text)?$request->f_rate_text:'',
                    'f_comments'=>($request->f_comments)?$request->f_comments:'',
                    'f_customer_name'=>($request->f_customer_name)?$request->f_customer_name:'',
                    'f_phone_number'=>($request->f_phone_number)?$request->f_phone_number:''
                    
                );
                $feedback_form_submit = feedback_form_submit::create($arr);

                if ($feedback_form_submit) {
                    $answers = $request->answers;
                    if (isset($answers)) {
                        $uniqueId = $feedback_form_submit->id;
                        foreach ($answers as $key => $value) {
                            $arr = array(
                                'feedback_id'=>$uniqueId,
                                'r_question_id'=>$key,
                                'result_id'=>$value,
                                'user_id'=>$user_id,
                            );
                            $QuestionResult = QuestionResult::create($arr);
                        }
                    }
                    
                }

                $notification_arr = array(
                    'type'=>'dynamic',
                    'item_id'=>$feedback_form_submit->id,
                    'url'=>'admin/list_question_answers',
                    'text'=>'Feedback Result: '.$request->f_customer_name,
                    'user_id'=>$user_id,
                );
                $notification = notification::create($notification_arr);

                $this->setMailConfig();
                $subject = "New Feedback from " . ($request->f_customer_name ?: 'Customer');
                
                $userDate = User::where('id',$user_id)->first();
                if ($userDate) {
                    
                    $mail_arr = array(
                        'title' => 'New Customer Feedback Received',
                        'name' => $request->f_customer_name,
                        'phone' => $request->f_phone_number,
                        'rating' => $request->rating_number,
                        'message' => $request->f_comments,
                        'admin_url' => url('admin/list_question_answers')
                    );

                    if (!empty($userDate->email)) {
                        try {
                            Mail::to($userDate->email)->send(new SpinnerFormMail('ADMIN', $mail_arr, $subject));
                        } catch (\Throwable $e) {
                            \Log::error('Review form admin email error: ' . $e->getMessage());
                        }
                    }

                    if (!empty($request->email)) {
                        try {
                            Mail::to($request->email)->send(new SpinnerFormMail('CUSTOMER', $mail_arr, 'Thank you for your feedback'));
                        } catch (\Throwable $e) {
                            \Log::error('Review form customer email error: ' . $e->getMessage());
                        }
                    }

                    if(!empty($request->f_phone_number) && !empty($userDate->wp_key)){
                        try {
                            $curl = curl_init();
                            $string = 'Thank you for submit the form.';
                            $message = urlencode($string);
                        
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => 'http://api.vyyapar.com/wapp/api/send?apikey='.$userDate->wp_key.'&mobile='.$request->f_phone_number.'&msg='.$message,
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => '',
                              CURLOPT_MAXREDIRS => 5,
                              CURLOPT_TIMEOUT => 5,
                              CURLOPT_CONNECTTIMEOUT => 5,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => 'GET',
                            ));
                            
                            $response = curl_exec($curl);
                            curl_close($curl);

                            $count = empty($userDate->wp_count) ? 1 : ($userDate->wp_count + 1);
                            User::where('id', $userDate->id)->update(['wp_count' => $count]);
                        } catch (\Throwable $e) {
                            \Log::error('Review form whatsapp error: ' . $e->getMessage());
                        }
                    }

                    
                }
                

                $notification = array(
                    'messege'=>'Your Feedback Is Submitted Successfully.',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
    
    
            } else {
                $notification = array(
                    'messege'=>'Not Valid User Id',
                    'alert-type'=>'error'
                );
                return back()->with($notification);
            }
        // } catch (\Throwable $th) {
        //     $data = array(
        //         'message'=>'Code Error',
        //         'status'=>0,
        //         'data'=>'',
        //     );
        //     return response()->json($data);
        // } 
    }



    public function private_feedback(Request $request){

        // dd($request->all());

        try {
            $user_id = decrypt($request->user_id);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Invalid request.'], 400);
        }

        $User = User::where('id',$user_id)->first();
            $data = $request->all();
            //dd($data );
            if ($User) {

                date_default_timezone_set("Asia/Calcutta"); 
                $arr = array(
                    'name'=>$request->customer_name,
                    'email'=>$request->customer_email,
                    'number'=>$request->customer_number,
                    'message'=>$request->customer_message,
                    'user_id'=>$user_id,
                );
                $privateReview = privateReview::create($arr);


                $notification_arr = array(
                    'type'=>'private',
                    'item_id'=>$privateReview->id,
                    'url'=>'admin/private_review_list',
                    'text'=>'Private Contact: '.$request->customer_name,
                    'user_id'=>$user_id,
                );
                $notification = notification::create($notification_arr);

                // $SpinnerUpdate = Spinner::where('id',decrypt($request->spinner_id))->update(['value'=>$Spinner->value-1]);
     
                $this->setMailConfig();
                $subject = "New Private Enquiry from " . ($request->customer_name ?: 'Customer');
                
                $userDate = User::where('id',$user_id)->first();
                if ($userDate) {
                    
                    $mail_arr = array(
                        'title' => 'New Private Enquiry Received',
                        'name' => $request->customer_name,
                        'email' => $request->customer_email,
                        'phone' => $request->customer_number,
                        'message' => $request->customer_message,
                        'admin_url' => url('admin/private_review_list')
                    );

                    if (!empty($userDate->email)) {
                        try {
                            Mail::to($userDate->email)->send(new SpinnerFormMail('ADMIN', $mail_arr, $subject));
                        } catch (\Throwable $e) {
                            \Log::error('Private feedback admin email error: ' . $e->getMessage());
                        }
                    }

                    if (!empty($request->customer_email)) {
                        try {
                            Mail::to($request->customer_email)->send(new SpinnerFormMail('CUSTOMER', $mail_arr, 'Thank you for your enquiry'));
                        } catch (\Throwable $e) {
                            \Log::error('Private feedback customer email error: ' . $e->getMessage());
                        }
                    }

                    if(!empty($request->customer_number) && !empty($userDate->wp_key)){
                        try {
                            $curl = curl_init();
                            $string = "प्रिय ग्राहक, धन्यवाद 🙏 हम अपने ग्राहकों से फीडबैक सुनना पसंद करते हैं। आपका फीडबैक हमे प्राप्त हो गया है, ये फीडबैक ही हमे बेहतर को और बेहतर करने के लिए प्रेरित करता है। आपकी संतुष्टि ही हमारा लक्ष्य है जल्द ही हमारी टीम आपसे संपर्क करेगी |";
                            $message = urlencode($string);
                        
                            curl_setopt_array($curl, array(
                              CURLOPT_URL => 'http://api.vyyapar.com/wapp/api/send?apikey='.$userDate->wp_key.'&mobile='.$request->customer_number.'&msg='.$message,
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => '',
                              CURLOPT_MAXREDIRS => 5,
                              CURLOPT_TIMEOUT => 5,
                              CURLOPT_CONNECTTIMEOUT => 5,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => 'GET',
                            ));
                            
                            $response = curl_exec($curl);
                            curl_close($curl);

                            $count = empty($userDate->wp_count) ? 1 : ($userDate->wp_count + 1);
                            User::where('id', $userDate->id)->update(['wp_count' => $count]);
                        } catch (\Throwable $e) {
                            \Log::error('Private feedback whatsapp error: ' . $e->getMessage());
                        }
                    }

                    
                }
                

                $notification = array(
                    'messege'=>'Review Added Successfully',
                    'alert-type'=>'success'
                );
                return redirect('/u/success_submit/'.$User->name_url.'')->with($notification);
    
    
            } else {
                $notification = array(
                    'messege'=>'Not Valid User Id',
                    'alert-type'=>'error'
                );
                return back()->with($notification);
            }
        // } catch (\Throwable $th) {
        //     $data = array(
        //         'message'=>'Code Error',
        //         'status'=>0,
        //         'data'=>'',
        //     );
        //     return response()->json($data);
        // } 
    }

    public function success_submit($user_name){
        
        $data['user_name'] = $user_name;
        $user = User::where('name_url',$user_name)->first();
        $data['user'] = $user;
        // dd($data);
        return view('frontend.success',$data);
    }
        
    public function video_testimonial_form_submit(Request $request){

        // try {
            $rating_number = $request->rating_number; 
            $user_id =decrypt($request->testi_user_id); 
            $User = User::where('id',$user_id)->first();
            $data = $request->all();
            // dd($data );
            if ($User) {

                date_default_timezone_set("Asia/Calcutta"); 
                $url='';
                /*************document upload **********/
                if($request->hasFile('video')) {

                    $file = $request->file('video');
                    // Generate a unique filename with milliseconds
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Upload the video to S3
                    $result = $this->s3->putObject([
                        'Bucket' => env('AWS_BUCKET'),
                        'Key' => 'uploads/' . $fileName,
                        'SourceFile' => $file->getPathname()
                    ]);

                    $inputKey = 'uploads/' . $fileName;
                    $outputKey = 'transcoded/' . pathinfo($fileName, PATHINFO_FILENAME) . '_transcoded.mp4';
                    $presetId = '1351620000001-000020'; // Example preset ID for Generic 1080p
        
                    $transcodeResult = $this->transcoder->createJob($inputKey, $outputKey, $presetId);
                    
                    $outPutFile = pathinfo($fileName, PATHINFO_FILENAME) . '_transcoded.mp4';

                    // $video=$request->file('video');
                    // $milisecond=round(microtime(true)*1000);
                    // $name=$video->getClientOriginalName();
                    // $actual_name=str_replace(" ","_",$name);
                    // $uploadName=$milisecond."_".$actual_name;
                    // $video->move(public_path().'/upload/',$uploadName);
                    // $url = asset('upload/'.$uploadName);
                }
                /***********document upload ************/

                $arr = array(
                    'rating'=>$rating_number,
                    'video'=>isset($outPutFile)?$outPutFile:'',
                    'video_url'=>isset($result['ObjectURL'])?$result['ObjectURL']:'',
                    'video_customer_name'=>$request->video_customer_name,
                    'video_customer_phone'=>$request->video_customer_phone,
                    'user_id'=>$user_id,
                );
                $video_testimonial = video_testimonial::create($arr);


                $download_url = '';
                if (!empty($video_testimonial->video)) {
                    try {
                        $cmd = $this->s3->getCommand('GetObject', [
                            'Bucket' => env('AWS_BUCKET'),
                            'Key' => 'transcoded/' . $video_testimonial->video
                        ]);
                        $s3Req = $this->s3->createPresignedRequest($cmd, '+7 days');
                        $download_url = (string)$s3Req->getUri();
                    } catch (\Exception $e) {
                        $download_url = !empty($video_testimonial->video_url) ? $video_testimonial->video_url : url('admin/video_testimonial_details/' . $video_testimonial->id);
                    }
                } else {
                    $download_url = !empty($video_testimonial->video_url) ? $video_testimonial->video_url : url('admin/video_testimonial_details/' . $video_testimonial->id);
                }

                $notification_arr = array(
                    'type'=>'video',
                    'item_id'=>$video_testimonial->id,
                    'url'=>'admin/video_testimonial_details/'.$video_testimonial->id,
                    'text'=>'Video Testimonial: '.($request->video_customer_name ?: 'New Customer'),
                    'user_id'=>$user_id,
                );
                notification::create($notification_arr);

                $this->setMailConfig();
                $subject = "New Video Testimonial from " . ($request->video_customer_name ?: 'Customer');
                $mail_arr = array(
                    'title' => 'New Video Testimonial Received',
                    'name' => $request->video_customer_name,
                    'phone' => $request->video_customer_phone,
                    'rating' => $rating_number,
                    'video_url' => $download_url,
                    'admin_url' => url('admin/video_testimonial_details/' . $video_testimonial->id)
                );
                
                $userDate = User::where('id',$user_id)->first();
                if ($userDate && !empty($userDate->email)) {
                    try {
                        Mail::to($userDate->email)->send(new SpinnerFormMail('ADMIN', $mail_arr, $subject));
                    } catch (\Throwable $e) {
                        \Log::error('Video testimonial mail error: ' . $e->getMessage());
                    }
                }
                
                $data = array(
                    'message'=>'Video Submitted Successfully',
                    'status'=>1,
                    'data'=>'',
                );
                return response()->json($data);
    
    
            } else {
                $data = array(
                        'message'=>'Not Valid User Id',
                        'status'=>0,
                        'data'=>'',
                    );
                    return response()->json($data);

            }
        // } catch (\Throwable $th) {
        //     $data = array(
        //         'message'=>'Code Error',
        //         'status'=>0,
        //         'data'=>'',
        //     );
        //     return response()->json($data);
        // } 
    }
    
    public function dummy(){

        return view('frontend.dummy');
        
    }
    
    public function review_links_analytics(Request $request){

        $ip_address = request()->ip();

        $review_track = ReviewLinksAnalytics::where('ip_address',request()->ip())
        ->where('type',$request->type)
        ->where('user_id',$request->user_id)
        ->first();
        if (empty($review_track)) {
            ReviewLinksAnalytics::create([
                'user_id'=>$request->user_id,
                'ip_address'=>request()->ip(),
                'type'=>$request->type,
                'count'=>1
            ]);
        }
        
        return response()->json(['status'=>true]);
        
    }




















    public function spinner_form_check(Request $request){

        $ip_address = request()->ip();

        $SpinnerMacAddr = SpinnerForm::where('mac_address',$ip_address)->first();
        if ($SpinnerMacAddr) {
            $data = array(
                'message'=>'AlreadyInserted',
                'status'=>1,
                'data'=>'',
            );
            return response()->json($data);
        }
        
    }
    
    public function spinner_round_check(Request $request){

        $ip_address = request()->ip();
        $campaign_id = $request->campaign_id;
        $user_id = $request->user_id;

        $user = User::where('id',$user_id)->first();

        
        $ip_skip = ip_skip::where('ip',$ip_address)->where('user_id',$user->id)->first();

        if ($ip_skip) {
            $data = array(
                'message'=>'NotInserted',
                'status'=>true,
                'data'=>'',
                'total_count'=>'No Limit'
            );
            return response()->json($data);
        } else {

            

            $SpinnerFormAccess = SpinnerFormAccess::where('ip_address',$ip_address)->where('campaign_id',$campaign_id)->count();
            $total_count =  $user->spin_whell_round -$SpinnerFormAccess ;

            $SpinnerMacAddr = SpinnerForm::where('mac_address',$ip_address)->where('camping_id',$campaign_id)->first();
            if ($SpinnerMacAddr) {
                $data = array(
                    'message'=>'You have already submitted details',
                    'status'=>false,
                    'data'=>'',
                    'total_count'=>$total_count
                );
                return response()->json($data);
            }

            if ($SpinnerFormAccess >= $user->spin_whell_round) {
                $data = array(
                    'message'=>'You have no limit for spin',
                    'status'=>false,
                    'data'=>'',
                    'total_count'=>$total_count
                );
                return response()->json($data);
            }else{

                $SpinnerFormAccess = SpinnerFormAccess::insert(['ip_address'=>$ip_address,'campaign_id'=>$campaign_id]);

                $SpinnerFormAccessCount = SpinnerFormAccess::where('ip_address',$ip_address)->where('campaign_id',$campaign_id)->count();
                $total_count =  $user->spin_whell_round -$SpinnerFormAccessCount ;
                $data = array(
                    'message'=>'NotInserted',
                    'status'=>true,
                    'data'=>'',
                    'total_count'=>$total_count
                );
                return response()->json($data);
            }
        }
        


        
        
    }
}
