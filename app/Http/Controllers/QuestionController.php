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
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionResult;
use App\Models\MyForm;

use App\Models\feedback_form_submit;
use Illuminate\Support\Facades\Auth;
use Response;
use PDF;

class QuestionController extends Controller
{
    public function questions(Request $request){

        if(Auth::check()){

            $where = '1=1';

            $array['templates'] = MyForm::where('category_id',Auth::user()->template_category_id)->where('active_status','active')->where('type','template')->get();
            $array['form_data'] = MyForm::where('user_id',Auth::user()->id)->where('active_status','active')->first();
            // dd($array['form_data']);
            if ($array['form_data']) {
                $Question = Question::where('questions.p_form_id',$array['form_data']->id)
                ->whereRaw($where)
                ->orderBy('id','asc')
                ->get();

                if(count($Question) > 0 ){
                    $array['Question'] = $Question;
                }else{
                    $array['Question'] = Question::where('questions.p_form_id',$array['form_data']->form_id)
                    ->whereRaw($where)
                    ->orderBy('id','asc')
                    ->get();
                }

            }
            
            //dd($Spinner);
            return view('user.question.list',$array);
        }
    }

    public function active_form($form_id){


        $MyForm = MyForm::whereNull('type')->where('user_id',Auth::user()->id)->where('form_id',$form_id)->first();
        if ($MyForm) {
            $MyFormAdd = MyForm::where('user_id',Auth::user()->id)->update([
                'active_status'=>'inactive'
            ]);
            $MyFormAddUpdate = MyForm::where('form_id',$form_id)->where('user_id',Auth::user()->id)->update([
                'active_status'=>'active'
            ]);
        }else{
            $MyForm = MyForm::where('id',$form_id)->first();
            $MyFormAdd = MyForm::create([
                'template_name'=>$MyForm->template_name,
                'form_name'=>$MyForm->form_name,
                'desc'=>$MyForm->desc,
                'customer_support'=>$MyForm->customer_support,
                'rate_text'=>$MyForm->rate_text,
                'comments'=>$MyForm->comments,
                'form_id'=>$form_id,
                'active_status'=>'active',
                'user_id'=>Auth::user()->id,
            ]);

            $QuestionList = Question::where('questions.p_form_id',$form_id)
                ->orderBy('id','asc')
                ->get();

            foreach ($QuestionList as $key => $value) {
                $Question = Question::create([
                    'question' => $value->question,
                    'p_form_id' => $MyFormAdd->id,
                    'user_id' => Auth::user()->id,
                    'status' => $value->status
                ]);
    
                $answers = QuestionAnswer::where('question_id',$value->id)->get();
                foreach ($answers as $key => $ans) {
                    QuestionAnswer::create([
                        'question_id' => $Question->id,
                        'answers' => $ans->answers,
                        'user_id' => Auth::user()->id
                    ]);
                }
            }

            



        }
        $notification = array(
            'messege'=>'Template Activated Successfully.',
            'alert-type'=>'success'
        );
        return back()->with($notification);
        
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

    public function question_field_form(Request $request){

        if(Auth::check()){
            //$camping = Camping::where('created_by',Auth::user()->id)->where('status','active')->get();
            $form_id =  $request->form_id;
            return view('user.question.form',compact('form_id'));
        }
    }

    

    public function my_form_update(Request $request){

        ///dd($request->all());

        if(Auth::check()){
            
            if ($request->form_id !='') {

                if ($request->type == 'form_name') {
                    if ($request->form_name !='') {
                        $update = ['form_name'=>$request->form_name];
                    }else{
                        $update = ['form_name'=>''];
                    }
                }
                if ($request->type == 'desc') {
                    if ($request->desc !='') {
                        $update = ['desc'=>$request->desc];
                    }else{
                        $update = ['desc'=>''];
                    }
                }
                if ($request->type == 'customer_support') {
                    if ($request->customer_support !='') {
                        $update = ['customer_support'=>$request->customer_support];
                    }else{
                        $update = ['customer_support'=>''];
                    }
                }
                if ($request->type == 'rate_text') {
                    if ($request->rate_text !='') {
                        $update = ['rate_text'=>$request->rate_text];
                    }else{
                        $update = ['rate_text'=>''];
                    }
                }
                if ($request->type == 'comments') {
                    if ($request->comments !='') {
                        $update = ['comments'=>$request->comments];
                    }else{
                        $update = ['comments'=>''];
                    }
                }

                $MyForm = MyForm::where('id',$request->form_id)->update($update);

                $notification = array(
                    'messege'=>'Question Updated successfully',
                    'alert-type'=>'success'
                );
                // return back()->with($notification);
                return Response::json($notification);

            }
            
        }
    }

    public function questions_form(Request $request){

        ///dd($request->all());

        if(Auth::check()){
            
            if ($request->id !='') {

                $Question = Question::where('id',$request->id)->update([
                    'question' => $request->question,
                    'status' => $request->status
                ]);

                $answers = $request->answers;
                $right_answer = $request->right_answer;
                $QuestionAnswer = QuestionAnswer::where('question_id',$request->id)->delete();
                //dd( $answers );
                foreach ($answers as $key => $value) {
                    // dd($value);
                    // if ($key == 0) {
                        QuestionAnswer::create([
                            'question_id' => $request->id,
                            'answers' => $value,
                            'user_id' => Auth::user()->id
                        ]);
                    // }
                    
                }

                $notification = array(
                    'messege'=>'Question Updated successfully',
                    'alert-type'=>'success'
                );
                // return back()->with($notification);
                return Response::json($notification);

            } else {


                $Question = Question::create([
                    'question' => $request->question,
                    'p_form_id' => $request->form_id,
                    'user_id' => Auth::user()->id,
                    'status' => $request->status
                ]);

                $answers = $request->answers;
                $right_answer = $request->right_answer;

                // dd( $right_answer );
                foreach ($answers as $key => $value) {
                    QuestionAnswer::create([
                        'question_id' => $Question->id,
                        'answers' => $value,
                        'user_id' => Auth::user()->id
                    ]);
                }

                $notification = array(
                    'messege'=>'Data inserted successfully',
                    'alert-type'=>'success'
                );
                return Response::json($notification);

            }
            
        }
    }

    public function edit_question($id){

        if(Auth::check()){
            $Question = Question::where('id',$id)->first();
            $QuestionAnswer = QuestionAnswer::where('question_id',$id)->get();
            return view('user.question.form',compact('Question','QuestionAnswer','id'));
        }
    }

    public function view_question($id){

        if(Auth::check()){
            $Question = Question::where('id',$id)->first();
            $QuestionAnswer = QuestionAnswer::where('question_id',$id)->get();
            return view('user.question.view_question',compact('Question','QuestionAnswer','id'));
        }
    }

    public function delete_question($id){

        if(Auth::check()){
            
            $Question = Question::where('id',$id)->delete();
            $QuestionAnswer = QuestionAnswer::where('question_id',$id)->delete();

            $notification = array(
                'messege'=>'Feedback Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }

    public function list_question_answers(Request $request){

        if(Auth::check()){

            $where = '1=1';

            if(isset($request))
            {
                
                if($request->start_date!='')
                {
                    $where .= " and  date(feedback_form_submits.created_at) >=  '$request->start_date'" ;
                    $array['start_date'] = $request->start_date;
                }
                if($request->end_date!='')
                {

                    $where .= " and  date(feedback_form_submits.created_at) <=  '$request->end_date'" ;
                    $array['end_date'] = $request->end_date ;
                }

            }
            
            $feedback_form_submit = feedback_form_submit::where('user_id',Auth::user()->id)
            ->whereRaw($where)
            ->orderBy('id','desc')
            ->get();

            $QuestionResult = QuestionResult::join('questions','questions.id','question_results.r_question_id')
            ->join('question_answers','question_answers.id','question_results.result_id')
            ->where('question_results.user_id',Auth::user()->id)
            ->get();

            // dd( $QuestionResult );

            return view('user.question.list_question_answers',compact('QuestionResult','feedback_form_submit'));
            
        }
    }

    public function view_question_answers($id){

        if(Auth::check()){

            
            $feedback_form_submit = feedback_form_submit::
                select(
                    'feedback_form_submits.*',
                    'my_forms.form_name',
                    'my_forms.desc',
                    'my_forms.customer_support',
                    'my_forms.rate_text',
                    'my_forms.comments'
                    )
            ->leftJoin('my_forms','my_forms.id','feedback_form_submits.form_id')
            ->where('feedback_form_submits.user_id',Auth::user()->id)
            ->where('feedback_form_submits.id',$id)
            ->first();

            //dd($feedback_form_submit );

            $QuestionResult = QuestionResult::join('questions','questions.id','question_results.r_question_id')
            ->join('question_answers','question_answers.id','question_results.result_id')
            ->where('question_results.feedback_id',$id)
            ->get();

            //dd( $QuestionResult );

            return view('user.question.view_question_answers',compact('QuestionResult','feedback_form_submit'));
            
        }
    }

    public function delete_question_answers($id){

        if(Auth::check()){
            
            $feedback_form_submit = feedback_form_submit::where('id',$id)->delete();
            $QuestionResult = QuestionResult::where('feedback_id',$id)->delete();

            $notification = array(
                'messege'=>'Feedback Deleted Successfully',
                'alert-type'=>'error'
            );
            return back()->with($notification);
            
        }
    }

}
