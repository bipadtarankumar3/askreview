<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\privateReview;
use App\Models\ReviewForm;
use App\Models\ReviewFormField;
use DB;
use Config;
use Mail;
use App\Mail\SpinnerFormMail;
use App\Models\ip_skip;

use Response;
use PDF;

use Illuminate\Support\Facades\Auth;

class PrivateReviewController extends Controller
{
    public function private_review_list(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(private_reviews.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(private_reviews.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['list'] = privateReview::where('user_id',Auth::user()->id)
            ->whereRaw($where)
            ->orderBy('id','desc')
            ->get();
            //dd($Spinner);
            return view('user.private_review.private_review',$array);
        }
    }

    
    
    public function download_private_review_Pdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $id = $request->checkbox;
            if ($id != null) {

                $array['list'] = privateReview::whereIn('private_reviews.id',$id )
                    ->where('private_reviews.created_by',Auth::user()->id)
                    ->get();
                $pdf = PDF::loadView('user.pdf.privateReview', $array);
        
            return $pdf->download('spinner.pdf');
            } else {
                return back();
            }
                  
        }
    }

    
    public function delete_private_review($id){

        if(Auth::check()){
            
            $privateReview = privateReview::where('id',$id)->delete();

            $notification = array(
                'messege'=>'Review Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }

}
