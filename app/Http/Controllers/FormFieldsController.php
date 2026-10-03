<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Validator;

use Hash;
use Session;
use App\Models\User;
use App\Models\FormFields;
use App\Models\ReviewForm;
use App\Models\ReviewFormField;
use Illuminate\Support\Facades\Auth;


use Response;
use PDF;

class FormFieldsController extends Controller
{
    public function form_field(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(form_fields.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(form_fields.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['Spinner'] = FormFields::where('form_fields.user_id',Auth::user()->id)
            ->whereRaw($where)
            ->orderBy('id','desc')
            ->get();
            //dd($Spinner);
            return view('user.form_field.list',$array);
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

    public function field_form(){

        if(Auth::check()){
            //$camping = Camping::where('created_by',Auth::user()->id)->where('status','active')->get();
            return view('user.form_field.form');
        }
    }

    public function add_form_page(){

        if(Auth::check()){
            //$camping = Camping::where('created_by',Auth::user()->id)->where('status','active')->get();
            return view('user.form_field.add_form_page');
        }
    }

    public function add_input_field(Request $request){

        ///dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {

                FormFields::where('id',$request->id)->update([
                    'type' => $request->type,
                    'name' => $request->name,
                    'input_id' => $request->input_id,
                    'placeholder' => $request->placeholder,
                    'required' => $request->required,
                    'user_id' => Auth::user()->id,
                    'status' => $request->status
                ]);

                $notification = array(
                    'messege'=>'Form Fields Updated successfully',
                    'alert-type'=>'success'
                );
                // return back()->with($notification);
                return Response::json($notification);

            } else {

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

                FormFields::create([
                    'type' => $request->type,
                    'name' => $request->name,
                    'input_id' => $request->input_id,
                    'placeholder' => $request->placeholder,
                    'required' => $request->required,
                    'user_id' => Auth::user()->id,
                    'status' => $request->status
                ]);

                $notification = array(
                    'messege'=>'Form Fields inserted successfully',
                    'alert-type'=>'success'
                );
                return Response::json($notification);

            }
            
        }
    }

    public function add_input_field_data(Request $request){

        //dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {

                FormFields::where('id',$request->id)->update([
                    'type' => $request->type,
                    'name' => $request->name,
                    'input_id' => $request->input_id,
                    'placeholder' => $request->placeholder,
                    'required' => $request->required,
                    'user_id' => Auth::user()->id
                ]);

                $notification = array(
                    'messege'=>'Form Fields Updated successfully',
                    'alert-type'=>'success'
                );
                // return back()->with($notification);
                return Response::json($notification);

            } else {


                $name = $request->name;
                $required = $request->required;
                $type = $request->type;

                foreach ($name as $key => $value) {

                    $small_name = strtolower($name[$key]);
                    $newString = str_replace(' ', '_', $small_name);

                    FormFields::create([
                        'type' => $type[$key],
                        'name' => $newString,
                        'input_id' => $newString,
                        'placeholder' => $name[$key],
                        'required' => $required[$key],
                        'user_id' => Auth::user()->id,
                        'status' => $request->status
                    ]);

                }

                $notification = array(
                    'messege'=>'Form Fields inserted successfully',
                    'alert-type'=>'success'
                );
                return back()->with($notification);

            }
            
        }
    }

    
    public function edit_form_field($id){

        if(Auth::check()){
            $FormFields = FormFields::where('id',$id)->first();
            return view('user.form_field.form',compact('FormFields','id'));
        }
    }

    public function delete_form_field($id){

        if(Auth::check()){
            
            $FormFields = FormFields::where('id',$id)->delete();

            $notification = array(
                'messege'=>'Form Fields Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }

    public function review_list(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(review_forms.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(review_forms.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }

            $array['ReviewForm'] = ReviewForm::where('user_id',Auth::user()->id)
            ->whereRaw($where)
            ->orderBy('id','desc')
            ->get();
            //dd($Spinner);
            return view('user.review_list.list',$array);
        }
    }
    public function view_review($id){

        if(Auth::check()){
            $array['ReviewForm'] = ReviewForm::where('id',$id)
            ->orderBy('id','desc')
            ->first();
            $array['ReviewFormField'] = ReviewFormField::where('review_form_id',$id)
            ->orderBy('id','desc')
            ->get();
            //dd($Spinner);
            return view('user.review_list.view',$array);
        }
    }



}
