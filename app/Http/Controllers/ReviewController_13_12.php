<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ReviewLinks;
use App\Models\ReviewForm;
use App\Models\ReviewFormField;
use DB;
use Config;
use Mail;
use App\Mail\SpinnerFormMail;
use App\Models\ip_skip;
use App\Models\Integration;
use App\Models\SocialReview;
use App\Models\video_testimonial;
use App\Models\Service;
use App\Models\Payment;

use Response;
use PDF;

use Illuminate\Support\Facades\Auth;


use Aws\S3\S3Client;
use Aws\Exception\AwsException;


class ReviewController extends Controller
{

    
    protected $s3;

    public function __construct()
    {
        $this->s3 = new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
    }


    public function review_links(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(review_links.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(review_links.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['ReviewLinks'] = ReviewLinks::where('review_links.user_id',Auth::user()->id)
            ->whereRaw($where)
            ->orderBy('id','desc')
            ->get();
            //dd($Spinner);



            $array['IntegrationGoogle'] = Integration::where('user_id',Auth::user()->id)
            ->where('type','google')
            ->first();
            $array['IntegrationFacebook'] = Integration::where('user_id',Auth::user()->id)
            ->where('type','facebook')
            ->first();
            $array['IntegrationYoutube'] = Integration::where('user_id',Auth::user()->id)
            ->where('type','youtube')
            ->first();
            $array['IntegrationInstagram'] = Integration::where('user_id',Auth::user()->id)
            ->where('type','instagram')
            ->first();
            $array['IntegrationWhatsApp'] = Integration::where('user_id',Auth::user()->id)
            ->where('type','whatsapp')
            ->first();

            $array['IntegrationRecord'] = Integration::where('user_id',Auth::user()->id)
            ->where('type','record')
            ->first();

            $array['admin_user'] = User::where('id',Auth::user()->user_id)->orderBy('id','desc')->first();

            $array['video_access_show'] = false;
            if (Auth::user()->user_create_type == 'sign_up') {
                $service = Payment::select('payments.*','services.title','services.subscription_date','services.video_access')
                ->join('services','services.id','payments.service_id')
                ->where('payments.user_id',Auth::user()->id)
                ->orderBy('payments.id','desc')
                ->first();

                if ($service && $service->video_access	== 'YES') {
                    $array['video_access_show'] = true;
                }else{
                    $array['video_access_show'] = false;
                }
                

            }else{
                if (Auth::user()->video_access == 'YES') {
                    $array['video_access_show'] = true;
                } 
                
            }


            

            //dd($Spinner);
            return view('user.review_links.list',$array);
        }
    }

    
    
    public function downloadSpinnerPdf(Request $request){

        if(Auth::check()){
                //dd($request->all());
                $id = $request->checkbox;
            if ($id != null) {

                $array['Spinner'] = Spinner::select('spinners.*','campings.campaign_name as c_name','campings.title as c_title')
                    ->leftJoin('campings','campings.id','spinners.camping_id')
                    ->whereIn('spinners.id',$id )
                    ->where('spinners.created_by',Auth::user()->id)
                    ->get();
                $pdf = PDF::loadView('user.spinner.spinnerPdf', $array);
        
            return $pdf->download('spinner.pdf');
            } else {
                return back();
            }
                  
        }
    }

    public function review_links_form(Request $request){

        if(Auth::check()){
            //$camping = Camping::where('created_by',Auth::user()->id)->where('status','active')->get();
            $data['review_type'] = $request->review_type;
            $data['Integration'] = Integration::where('user_id',Auth::user()->id)->where('type',$request->review_type)->first();
            return view('user.review_links.form',$data);
        }
    }

    public function open_integration_remove_modal(Request $request){

        if(Auth::check()){
            $data['type'] = $request->type;
            $data['Integration'] = Integration::where('user_id',Auth::user()->id)
            ->where('type',$request->type)
            ->first();
            return view('user.review_links.integration_remove_modal',$data);
        }
    }

    public function integration_remove(Request $request){

        if(Auth::check()){
            $data['type'] = $request->type;
            $data['Integration'] = Integration::where('user_id',Auth::user()->id)
            ->where('type',$request->type)
            ->delete();
            $data['SocialReview'] = SocialReview::where('user_id',Auth::user()->id)
            ->delete();
            $notification = array(
                'messege'=>'Key Updated successfully',
                'alert-type'=>'success'
            );
            // return back()->with($notification);
            return Response::json($notification);
        }
    }

    public function add_review_links(Request $request){

        ///dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {

                Integration::where('id',$request->id)->update([
                    'type' => $request->review_type,
                    'review_links' => $request->review_key,
                    'user_id' => Auth::user()->id,
                    'status' => $request->status
                ]);

                
                $notification = array(
                    'messege'=>'Key Updated successfully',
                    'alert-type'=>'success'
                );
                // return back()->with($notification);
                return Response::json($notification);

            } else {
                Integration::create([
                    'type' => $request->review_type,
                    'review_links' => $request->review_key,
                    'user_id' => Auth::user()->id,
                    'status' => $request->status
                ]);

                $notification = array(
                    'messege'=>'Key inserted successfully',
                    'alert-type'=>'success'
                );
                return Response::json($notification);

            }
            
        }
    }

    public function integration_form(Request $request){

        // dd($request->all());
        if ($request->type == 'google') {
            $review_links = "https://search.google.com/local/writereview?placeid=".$request->place_id;
        }else{
            $review_links = "https://search.google.com/local/writereview?placeid=";
        }
        
        Integration::create([
            'user_id' => Auth::user()->id,
            'type' => $request->type,
            'name' => isset($request->name)?$request->name:'',
            'place_id' => isset($request->place_id)?$request->place_id:'',
            'review_links' => $review_links,
            'url' => isset($request->url)?$request->url:'',
            'formatted_address' => isset($request->formatted_address)?$request->formatted_address:'',
            'formatted_phone_number' => isset($request->formatted_phone_number)?$request->formatted_phone_number:'',
            'profile_photo_url' => isset($request->profile_photo_url)?$request->profile_photo_url:'',
            'rating' => isset($request->rating)?$request->rating:'',
            'reference' => isset($request->reference)?$request->reference:'',
            'user_ratings_total' => isset($request->user_ratings_total)?$request->user_ratings_total:'',
            'website' => isset($request->website)?$request->website:'',
            'status' => 'active'
        ]);

        $reviews = $request->reviews;
        if (isset($reviews)) {
            foreach ($reviews as $key => $value) {
                // dd($value['author_name']);
                SocialReview::create([
                    'user_id' => Auth::user()->id,
                    'type' => $request->type,
                    'author_name' => isset($value['author_name'])?$value['author_name']:'',
                    'author_url' => isset($value['author_url'])?$value['author_url']:'',
                    'language' => isset($value['language'])?$value['language']:'',
                    'profile_photo_url' => isset($value['profile_photo_url'])?$value['profile_photo_url']:'',
                    'rating' => isset($value['rating'])?$value['rating']:'',
                    'relative_time_description' => isset($value['relative_time_description'])?$value['relative_time_description']:'',
                    'text' => isset($value['text'])?$value['text']:'',
                    'time' => isset($value['time'])?$value['time']:''
                ]);
            }
        }

        $notification = array(
            'messege'=>'Key inserted successfully',
            'alert-type'=>'success'
        );
        return Response::json($notification);
    }

    
    public function edit_review_links($id){

        if(Auth::check()){
            $ReviewLinks = ReviewLinks::where('id',$id)->first();
            return view('user.review_links.form',compact('ReviewLinks','id'));
        }
    }

    public function delete_review_links($id){

        if(Auth::check()){
            
            $ReviewLinks = ReviewLinks::where('id',$id)->delete();

            $notification = array(
                'messege'=>'Key Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }

    public function social_review_list(Request $request){

        if(Auth::check()){
            $data['Integration'] = Integration::where('user_id',Auth::user()->id)
            ->where('type','google')
            ->first();
            $data['SocialReview'] = SocialReview::where('user_id',Auth::user()->id)->get();
            return view('user.review_links.social_review_list',$data);
        }
    }

    public function video_testimonial(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(video_testimonials.created_at) >=  '$request->start_date'" ;
                    $data['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(video_testimonials.created_at) <=  '$request->end_date'" ;
                    $data['end_date'] = $request->end_date ;
                }

            }

            $data['video_testimonial'] = video_testimonial::where('user_id',Auth::user()->id)
            ->whereRaw($where)
            ->orderBy('id','desc')
            ->get();
            return view('user.review_links.video_testimonial_list',$data);
        }
    }

    public function video_testimonial_details($id){

        if(Auth::check()){
            $data['video_testimonial'] = video_testimonial::where('id',$id)
            ->first();

            //$data['url'] = $this->s3->getObjectUrl(env('AWS_BUCKET'), 'uploads/' . $data['video_testimonial']->video);

            $cmd = $this->s3->getCommand('GetObject', [
                'Bucket' => env('AWS_BUCKET'),
                'Key' => 'transcoded/' . $data['video_testimonial']->video
            ]);
    
            $request = $this->s3->createPresignedRequest($cmd, '+20 minutes');
    
            $data['url'] = (string)$request->getUri();

            // dd($result);

            return view('user.review_links.video_testimonial_details',$data);
        }
    }

    public function video_testimonial_delete($id){

        if(Auth::check()){
            $data['video_testimonial'] = video_testimonial::where('id',$id)
            ->delete();

            
            $notification = array(
                'messege'=>'Video Review Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
           
        }
    }
}
