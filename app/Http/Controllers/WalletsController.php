<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

    
use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\Wallets;
use App\Models\Service;
use App\Models\Payment;

use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Str;

use Config;
use Mail;
use App\Mail\adminForgotPassMail;
use App\Mail\OtpVerifyMail;

use Illuminate\Support\Facades\Response;



class WalletsController extends Controller
{
    
    
    public function wallets_list(Request $request){

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

            $array['list'] = Wallets::select('wallets.*','users.name')->leftJoin('users','users.id','wallets.user_id')->whereRaw($where)->get();
            // dd($user);
            return view('admin.wallets.list',$array);
        }else{
            return redirect('/');
        }
    }


    public function add_wallets(){

        if(Auth::check()){
            $array['user'] = User::where('type','admin')->get();
            return view('admin.wallets.create',$array);
        }
    }

    public function downloadadminPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $user_id = $request->checkbox;
            if ($user_id != null) {
                $array['user'] = User::whereIn('id',$user_id )->get();
            $pdf = PDF::loadView('admin.wallets.userPdf', $array);
        
            return $pdf->download('wallets.pdf');
            } else {
                return back();
            }
                  
        }
    }

    public function submit_wallets(Request $request){

        if(Auth::check()){

            if ($request->id !='') {
                

                $Wallets = Wallets::find($request->id);
                $Wallets->user_id = $request->user_id;
                $Wallets->amount = $request->amount;
                $Wallets->note = $request->note;
                $Wallets->credit_debit = $request->credit_debit;
                $Wallets->amount_credit_debit = Auth::user()->name;
                $Wallets->created_by = Auth::user()->id;
                $Wallets->save();

                $user = User::where('id',$request->user_id)->first();
                if ($request->credit_debit == 'credit') {
                    if ($user) {
                        $u_up = User::where('id',$request->user_id)->update([
                            'user_create_limit'=>$user->user_create_limit+$request->amount
                        ]);
                    }
                } else {
                    if ($user) {
                        $u_up = User::where('id',$request->user_id)->update([
                            'user_create_limit'=>$user->user_create_limit-$request->amount
                        ]);
                    }
                }

                
                $notification = array(
                    'messege'=>'Amount Updated successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            } else {

                

                $Wallets = new Wallets();
                $Wallets->user_id = $request->user_id;
                $Wallets->amount = $request->amount;
                $Wallets->note = $request->note;
                $Wallets->credit_debit = $request->credit_debit;
                $Wallets->amount_credit_debit = Auth::user()->name;
                $Wallets->created_by = Auth::user()->id;
                $Wallets->save();


                $user = User::where('id',$request->user_id)->first();
                if ($request->credit_debit == 'credit') {
                    if ($user) {
                        $u_up = User::where('id',$request->user_id)->update([
                            'user_create_limit'=>$user->user_create_limit+$request->amount
                        ]);
                    }
                } else {
                    if ($user) {
                        $u_up = User::where('id',$request->user_id)->update([
                            'user_create_limit'=>$user->user_create_limit-$request->amount
                        ]);
                    }
                }
                
                $notification = array(
                    'messege'=>'Amount inserted successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);

            }
            


        }
    }

    
    public function edit_wallets($id){

        if(Auth::check()){
            $wallets = Wallets::where('id',$id)->first();
            $user = User::where('type','admin')->get();
            return view('admin.wallets.create',compact('wallets','id','user'));
        }
    }
    
    

    public function my_wallets_list(Request $request){

        if(Auth::check() && Auth::user()->type == 'admin'){

            $query = Wallets::select(
                'wallets.*',
                'sub_users.name as sub_user_name',
                'sub_users.email as sub_user_email',
                'sub_users.phone as sub_user_phone',
                'sub_users.name_url as sub_user_name_url',
                'sub_users.user_unique_id as sub_user_unique_id',
                'sub_users.user_create_type as sub_user_create_type',
                'sub_users.status as sub_user_status',
                'sub_users.id as sub_user_real_id',
                'sub_users.created_at as sub_user_created_at',
                'sub_users.avatar as sub_user_avatar',
                'sub_users.logo as sub_user_logo'
            )
            ->leftJoin('users as sub_users', function($join) {
                $join->on('sub_users.id', '=', 'wallets.sub_user_id')
                     ->orWhere(function($q) {
                         $q->whereNull('wallets.sub_user_id')
                           ->where('wallets.credit_debit', '=', 'debit')
                           ->whereColumn('sub_users.id', '=', 'wallets.created_by');
                     });
            })
            ->where('wallets.user_id', Auth::user()->id);

            if ($request->filled('start_date')) {
                $query->whereDate('wallets.created_at', '>=', $request->start_date);
                $array['start_date'] = $request->start_date;
            }
            if ($request->filled('end_date')) {
                $query->whereDate('wallets.created_at', '<=', $request->end_date);
                $array['end_date'] = $request->end_date;
            }

            $array['list'] = $query->orderBy('wallets.id', 'desc')->get();

            // 5 Tab Stats for admin
            $adminId = Auth::user()->id;
            $array['pending_tokens'] = (int) Auth::user()->user_create_limit;
            $array['total_used'] = (int) Wallets::where('user_id', $adminId)->where('credit_debit', 'debit')->sum('amount');
            $array['total_gets'] = (int) Wallets::where('user_id', $adminId)->where('credit_debit', 'credit')->sum('amount');
            $array['total_signup'] = (int) User::where('user_id', $adminId)->whereIn('user_create_type', ['sign_up', 'google'])->count();
            $array['total_create'] = (int) User::where('user_id', $adminId)->where(function($q) {
                $q->whereNotIn('user_create_type', ['sign_up', 'google'])->orWhereNull('user_create_type');
            })->count();

            // Backward compatibility aliases
            $array['current_balance'] = $array['pending_tokens'];
            $array['total_debited'] = $array['total_used'];
            $array['total_credited'] = $array['total_gets'];

            return view('admin.wallets.my_list', $array);
        }else{
            return redirect('/');
        }
    }

    public function my_user_payment_list(Request $request){

        if(Auth::check()){
            
            $user = User::where('user_id',Auth::user()->id)->get();
            $user_id = [];
            foreach ($user as $key => $value) {
                $user_id[] = $value->id;
            }

            $array['Payments'] = Payment::select('payments.*','services.title','services.subscription_date','services.video_access','users.name','countries.name as country_name','states.name as state_name')
            ->join('services','services.id','payments.service_id')
            ->leftJoin('users','users.id','payments.user_id')
            ->leftJoin('countries','countries.id','payments.country')
            ->leftJoin('states','states.id','payments.state')
            ->whereIn('payments.user_id',$user_id)
            ->orderBy('payments.id','desc')
            ->get();

            return view('admin.payments.my_user_payment_list',$array);
        }
    }

}
