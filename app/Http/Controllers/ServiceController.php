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
use App\Models\Service;
use App\Models\Payment;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Hash;

use Razorpay\Api\Api;
use Session;
use Exception;


class ServiceController extends Controller
{

    public function service_list(Request $request){

        if(Auth::check()){

            $admin_id = Auth::user()->id;

            $array['service_list'] = Service::where('user_id',$admin_id)
            ->where('service_type','user')
            ->orderBy('id','desc')
            ->get();

            if (isset($_GET['service_id'])) {
                $array['id'] = $_GET['service_id'];
                $array['editData'] = Service::where('id',$_GET['service_id'])
                ->first();
            }

            //dd($Spinner);
            return view('admin.service.service_list',$array);
        }
    }


    public function service_update(Request $request){

        if(Auth::check()){


            Service::where('id',$request->id)->update([
                'title'=>$request->title,
                'subscription_date'=>$request->subscription_date,
                'video_access'=>$request->video_access,
                'status'=>$request->status,
                'price'=>$request->price
            ]);
            $notification = array(
                'messege'=>'Service updated Successfull',
                'alert-type'=>'success'
            );
            return redirect('admin/service')->with($notification);
        }
    }

    public function user_service(Request $request){

        if(Auth::check()){

            $admin_id = Auth::user()->user_id;

            $array['Service'] = Service::where('user_id',$admin_id)
            ->where('service_type','user')
            ->orderBy('id','desc')
            ->get();
            //dd($Spinner);
            return view('user.service.user_service_list',$array);
        }
    }

    public function user_service_payment_view($id){

        if(Auth::check()){

            $admin_id = Auth::user()->user_id;
            $array['Service'] = Service::where('id',$id)
            ->orderBy('id','desc')
            ->first();
            return view('user.service.user_service_payment_view',$array);
        }
    }


    public function user_service_payment_submit(Request $request)
    {
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                // dd($response);
                $Service = Service::where('id',$request->service_id)
                ->orderBy('id','desc')
                ->first();

                if ($Service) {
                    $exp_date = Auth::user()->expiry_date;
                    $timestamp = strtotime($exp_date);
                    $present_date = date('Y-m-d', $timestamp);

                    Payment::create([
                        'user_id'=>Auth::user()->id,
                        'service_id'=>$request->service_id,
                        'transction_id'=>$input['razorpay_payment_id'],
                        'price'=>$Service->price,
                        'gst_amount'=>$request->gst_amount,
                        'grand_total'=>$request->grand_total,
                        'status'=>'pending',
                        'state' =>$request->state,
                        'country' =>$request->country,
                        'address' =>$request->address,
                        'payment_type' =>$response->method,
                        'gst_number' =>$request->gst_number,
                        'payment_type' =>$response->method,
                        'form_date' =>$present_date,
                        'to_date' =>date('Y-m-d', strtotime($present_date.' +1 year')),
                    ]);

                    $user = User::where('id',Auth::user()->id)->update([
                        'expiry_date' =>date('Y-m-d', strtotime($present_date.' +1 year')),
                        'seven_day_trial' =>null
                        
                    ]);

                    $my_form = User::find(Auth::user()->user_id);
                    $my_form->user_create_limit = $my_form->user_create_limit-1;
                    $my_form->save();

                    $notification = array(
                        'messege'=>'Payment Successfull',
                        'alert-type'=>'success'
                    );
                    return redirect('admin/service_payment_success/'.$input['razorpay_payment_id'])->with($notification);

                } else {
                    $notification = array(
                        'messege'=>'Service Not Getting',
                        'alert-type'=>'error'
                    );
                    return back()->with($notification);
                }
                
            } catch (Exception $e) {
                $notification = array(
                    'messege'=>$e->getMessage(),
                    'alert-type'=>'error'
                );
                return back()->with($notification);
            }
        }

        
    }

    
    public function user_payments_list(Request $request){

        if(Auth::check()){

            $id = Auth::user()->id;
            $array['Payments'] = Payment::select('payments.*','services.title','services.subscription_date','services.video_access','countries.name as country_name','states.name as state_name')
            ->join('services','services.id','payments.service_id')
            
            ->leftJoin('countries','countries.id','payments.country')
            ->leftJoin('states','states.id','payments.state')
            ->where('payments.user_id',$id)
            ->orderBy('payments.id','desc')
            ->get();
            return view('user.service.user_payment_list',$array);
        }
    }
    public function get_state(Request $request){

        if(Auth::check()){

            $cun_id = $request->country_id;
            $states = DB::table('states')->where('country_id',$cun_id)->get();

            $option = "<option value=''>Select State</option>";
            foreach ($states as $key => $value) {
                $option.="<option value='".$value->id."'>".$value->name."</option>";
            }

            echo $option;

        }
    }

    public function service_support(Request $request){

        if(Auth::check()){

            $array['title'] = "Support";
            return view('user.support',$array);

        }
    }

    public function service_payment_success($payment_id){

        if(Auth::check()){

            $array['title'] = "Success";
            $array['payment_id'] = $payment_id;
            return view('user.service.success',$array);

        }
    }

    // ------------------------------------ Admin Payment Section --------------------------------------------
    public function admin_service_payments_list(Request $request){

        if(Auth::check()){

            $id = Auth::user()->id;
            $array['Payments'] = Payment::select('payments.*','services.title','services.subscription_date','services.credit_limit')
            ->join('services','services.id','payments.service_id')
            ->where('payments.user_id',$id)
            ->orderBy('payments.id','desc')
            ->get();

            //dd($Spinner);
            return view('admin.payments.admin_service_payments_list',$array);
        }
    }
    public function admin_blanced_list(Request $request){

        if(Auth::check()){

            $admin_id = Auth::user()->id;
            
            $array['service_list'] = Service::where('user_id',$admin_id)
            ->where('service_type','admin')
            ->orderBy('id','desc')
            ->get();


            //dd($Spinner);
            return view('admin.payments.admin_service_payment',$array);
        }
    }
    public function admin_service_payment_store(Request $request){

        if(Auth::check()){

            $admin_id = Auth::user()->id;
            session()->put('admin_service',$request->all());
            return redirect('admin/admin_service_payment_store_view/'.$request->service_id);
        }
    }

    public function admin_service_payment_store_view($service_id){

        if(Auth::check()){

            $array['service_details'] = Service::where('id',$service_id)
            ->orderBy('id','desc')
            ->first();

            return view('admin.payments.admin_service_payment_page',$array);
        }
    }


    
    public function admin_service_payment_submit(Request $request)
    {
        $session_data = session()->get('admin_service');
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                // dd($response);
                $Service = Service::where('id',$session_data['service_id'])
                ->orderBy('id','desc')
                ->first();

                if ($Service) {
                    $user_create_limit = Auth::user()->user_create_limit;

                    Payment::create([
                        'user_id'=>Auth::user()->id,
                        'service_id'=>$session_data['service_id'],
                        'transction_id'=>$input['razorpay_payment_id'],
                        'price'=>$Service->price,
                        'gst_amount'=>$session_data['gstAmountInput'],
                        'grand_total'=>$session_data['grandTotalInput'],
                        'status'=>'pending',
                        'state' =>$session_data['state'],
                        'country' =>$session_data['country'],
                        'address' =>$session_data['address'],
                        'payment_type' =>$response->method,
                        'previous_credit' =>$user_create_limit,
                        'extend_credit' =>$user_create_limit +$Service->credit_limit,
                    ]);

                    $user = User::where('id',Auth::user()->id)->update([
                        'user_create_limit' => $user_create_limit +$Service->credit_limit
                        
                    ]);

                    $notification = array(
                        'messege'=>'Payment Successfull',
                        'alert-type'=>'success'
                    );
                    return redirect('admin/service_payment_success/'.$input['razorpay_payment_id'])->with($notification);

                } else {
                    $notification = array(
                        'messege'=>'Service Not Getting',
                        'alert-type'=>'error'
                    );
                    return back()->with($notification);
                }
                
            } catch (Exception $e) {
                $notification = array(
                    'messege'=>$e->getMessage(),
                    'alert-type'=>'error'
                );
                return back()->with($notification);
            }
        }

        
    }

    // ------------------------------------ End Admin Payment Section -----------------------------------------


}
