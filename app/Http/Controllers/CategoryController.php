<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\TemplateCategory as category ;
use App\Models\sub_category;
use App\Models\breakage;
use App\Models\faq;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
use Session;
use File;
use Mail;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function category()
    {
        $productcategory = category::get();
        //print_r($BlogCategory);die;
        return view('admin.category.categoryList',compact('productcategory'));
    }

    //insert
    public function addCategory(Request $request){
        
        if ($request->Status == 'Insert') {

            // $cat = category::get();
            // if (count($cat) > 0 ) {
            //     $maxValue = category::max('order_position');
            //     $position = $maxValue+1;
            // } else {
            //     $position = 1;
            // }

            $name = str_replace(' ', '_', $request->Category);
            
                $currentTimeinSeconds = time();
                $Key = substr(sha1($currentTimeinSeconds),0,13);
                $table = new category();
                $table->user_id=Auth::user()->id;
                $table->category_name=$request->Category;
                $table->status='ACTIVE';
                $getInsert = $table->save();
                if ($getInsert > 0) {
                    $notification = array(
                        'messege'=>'Category Added Successfully',
                        'alert-type'=>'success'
                    );
                    if ($request->status) {
                        return redirect('admin/addProductPage')->with($notification);
                    }
                    
                    return back()->with($notification);
                }else{
                    $notification = array(
                        'messege'=>'Data Is Not Added Successfully',
                        'alert-type'=>'error'
                    );
                    return Redirect()->back()->with($notification);
                }

        } else {

            $table=category::find($request->id);
            
            $table->category_name=$request->Category;
            $table->status='ACTIVE';
            $getInsert = $table->save();

                if ($getInsert > 0) {
                    $notification = array(
                        'messege'=>'Data Updated Successfully',
                        'alert-type'=>'success'
                    );
                    return Redirect::to('admin/category')->with($notification);
                }else{
                    $notification = array(
                        'messege'=>'Data Is Not Updated Successfully',
                        'alert-type'=>'error'
                    );
                    //return Redirect()->back()->with($notification);
                    return Redirect::to('admin/category')->with($notification);
                }


        }
    }
    //edit Data
    public function categoryEdit($id){
        
        $editData=category::find($id);
        $productcategory = category::get();
        //print_r($BlogCategory);die;
        return view('admin.category.categoryList',compact('productcategory','editData','id'));
    }
    //delete Blog Category
    public function categoryDelete($id){
        
        $deleted=category::where('id',$id)->delete();
        return Redirect::to('admin/category')->send();
    }


     //Status
     public function categoryStatus($status , $id){
         //dd($status);

        if ($status == 'active') {

            $table =  category::find($id);
           
            $table->cat_status ='INACTIVE' ;
            $result = $table->save();

            if ($result > 0) {
                $notification = array(
                    'messege'=>'Item Is Active',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            }else{
                $notification = array(
                    'messege'=>'There Have Some Error',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }

        } else {

            $table =  category::find($id);

            $table->cat_status ='ACTIVE' ;
            $result = $table->save();

            if ($result > 0) {
                $notification = array(
                    'messege'=>'Item Is Inactive',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            }else{
                $notification = array(
                    'messege'=>'There Have Some Error',
                    'alert-type'=>'worning'
                );
                return Redirect()->back()->with($notification);
            }
        }
    }

    public function updateOrder(Request $request)
    {
        $posts = category::all();

        foreach ($posts as $post) {

            foreach ($request->order as $order) {

                if ($order['id'] == $post->id) {

                    $post->update(['order_position' => $order['position']]);
                }
            }
        }

        return response(['message' => 'Update Successfully'], 200);
    }


    public function catPositionChange(Request $request){
        
        $Position=category::find($request->PositionId);
        $PositionChangeValue=$Position->cat_position;

        $table =  category::find($request->catId);
        $table->cat_position =$PositionChangeValue ;
        $result = $table->save();

        $table1 =  category::find($request->PositionId);
        $table1->cat_position =$request->catPosition;
        $result = $table1->save();

        return back();

    }

    //=============------------  Sub Category -------------==================================''''''''''''
    public function subCategory()
    {
        //$Whychooseus = Whychooseus::paginate(1);
        //print_r($Adviceandinspirations);die;
        $sub_category = DB::table('sub_categories')
        ->join('categories','categories.id','sub_categories.cat_id')
        ->select('sub_categories.id  as sub_id','sub_categories.sub_cat_name','sub_categories.status','categories.cat_name')
        ->where('sub_categories.category_type','=','CATEGORY')
        ->get();
        $category = category::where('cat_type','=','CATEGORY')->get();
        //print_r( $sub_category);die;
        return view('admin.category.subCategory',compact('category','sub_category'));
    }

    //insert
    public function addSubCategory(Request $request){
        
        if ($request->Status == 'Insert') {

                $currentTimeinSeconds = time();
                $Key = substr(sha1($currentTimeinSeconds),0,13);
                $table = new sub_category();
                $table->key=$Key;
                $table->category_type=$request->category_type;
                $table->sub_cat_name=$request->subCategory;
                $table->cat_id=$request->Category;
                $getInsert = $table->save();
                if ($getInsert > 0) {
                    $notification = array(
                        'messege'=>'Data Sub Category Successfully',
                        'alert-type'=>'success'
                    );
                    if ($request->status) {
                        return redirect('admin/addProductPage')->with($notification);
                    }
                    return back()->with($notification);
                }else{
                    $notification = array(
                        'messege'=>'Data Is Not Added Successfully',
                        'alert-type'=>'error'
                    );
                    return Redirect()->back()->with($notification);
                }

        } else {

            $table=sub_category::find($request->id);
            $table->sub_cat_name=$request->subCategory;
                $table->cat_id=$request->Category;
            $getInsert = $table->save();

                if ($getInsert > 0) {
                    $notification = array(
                        'messege'=>'Data Updated Successfully',
                        'alert-type'=>'success'
                    );
                    return Redirect::to('admin/subCategory')->with($notification);
                }else{
                    $notification = array(
                        'messege'=>'Data Is Not Updated Successfully',
                        'alert-type'=>'error'
                    );
                    //return Redirect()->back()->with($notification);
                    return Redirect::to('admin/subCategory')->with($notification);
                }


        }
    }
    //edit Data
    public function subCategoryEdit($id){
        
        $editData=sub_category::find($id);
        $category = category::where('cat_type','=','CATEGORY')->get();
        $sub_category = DB::table('sub_categories')
        ->join('categories','categories.id','sub_categories.cat_id')
        ->select('sub_categories.id  as sub_id','sub_categories.sub_cat_name','sub_categories.status','categories.cat_name')
        ->get();
        //print_r( $editData);die;
        return view('admin.category.subCategory',compact('category','sub_category','editData','id'));
    }
    //delete sub Category
    public function subCategoryDelete($id){
        
        $deleted=sub_category::where('id',$id)->delete();
        return Redirect::to('admin/subCategory')->send();
    }


     //Status
     public function subCategoryStatus($status , $id){
        
        if ($status == 'active') {

            $table =  sub_category::find($id);

            $table->status ='ACTIVE' ;
            $result = $table->save();

            if ($result > 0) {
                $notification = array(
                    'messege'=>'Item Is Active',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            }else{
                $notification = array(
                    'messege'=>'There Have Some Error',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }

        } else {

            $table =  sub_category::find($id);

            $table->status ='INACTIVE' ;
            $result = $table->save();

            if ($result > 0) {
                $notification = array(
                    'messege'=>'Item Is Inactive',
                    'alert-type'=>'success'
                );
                return back()->with($notification);
            }else{
                $notification = array(
                    'messege'=>'There Have Some Error',
                    'alert-type'=>'worning'
                );
                return Redirect()->back()->with($notification);
            }
        }
    }



     //get SubCategory
     public function getSubCategory(Request $request){
        // echo $request->categoryKey;die;

        $category_type = $request->category_type;

        $category=sub_category::where('cat_id','=',$request->Id)->where('category_type','=',$request->category_type)->get();
        foreach ($category as $key => $getSubCategory) {
            if ($key == 0) {
                echo "<option value=''>Select Sub Category</option>";
            }
                echo "<option value='".$getSubCategory->id."'>".$getSubCategory->sub_cat_name."</option>";

          }
    }

}
