@extends('adminLayouts.home')
@section('content')

<div class="content-body">
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="la la-list-ul"></i>Create Sub Category

                              <a href="{{URL::to('admin/category')}}"><button class="btn btn-success">Go To Category</button></a>

                        </h4>
                        

                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{URL::to('admin/addSubCategory')}}" method="POST">
                                        @csrf

                                        @if (!empty($_GET['status']))
                                            <input type="hidden" name="status" id="status" value="{{$_GET['status']}}">
                                        @endif

                                        <input type="hidden" name="id" id="id" @if (!empty($id)) value="{{$id}}" @endif>
                                        <input type="hidden" name="Status" id="Status" @if (!empty($id)) value="Update" @else value="Insert" @endif>
                                        <div class="form-group">
                                          <label for="subCategory">Enter Category:</label>
                                         <select name="Category" class="form-control">
                                             <option value="">Select Category</option>
                                             @foreach ($category as $data)
                                                <option value="{{$data->id}}" @if (!empty($id)) @if ($editData->cat_id == $data->id) selected @endif  @endif>{{$data->cat_name}}</option>
                                             @endforeach

                                         </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="subCategory">Enter Category:</label>
                                          <input type="text" required title="Don`t Use White Space Only" pattern=".*\S+.*" class="form-control" placeholder="Enter Sub Category" id="subCategory" name="subCategory"  @if (!empty($id)) value="{{$editData->sub_cat_name}}" @endif>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="padding: 30px;"> 
                                <div class="table-responsive">
                                     <caption>List of Sub Category</caption><br><br>
                                        <table class="table table-striped" id="table_id">
                                           
                                            <thead>
                                              <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">Sub Category Name</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">Status</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sub_category as $key=> $productSubcat)
                                                    <tr>
                                                    <th scope="row">{{$key+1}}</th>
                                                        <td>{{$productSubcat->cat_name}}</td>
                                                        <td>{{$productSubcat->sub_cat_name}}</td>
                                                        <td class="act">
                                                            <span><a href="{{URL::to('admin/subCategoryEdit/'.$productSubcat->sub_id)}}" title="Edit"><i class="fas fa-edit"></i></a></span>
                                                            <span><a href="{{URL::to('admin/subCategoryDelete/'.$productSubcat->sub_id)}}" onclick="dataDelete(event);" title="Cancel"><i class="fas fa-trash-alt"></i></a></span>
                                                        </td>
                                                        <td class="sts">

                                                            @if ($productSubcat->status == 'INACTIVE')
                                                                <a href="{{URL::to('admin/subCategoryStatus/active/'.$productSubcat->sub_id)}}"><button type="submit" class="btn btn-sm btn-success round">Active</button></a>
                                                            @else
                                                            <a href="{{URL::to('admin/subCategoryStatus/inActive/'.$productSubcat->sub_id)}}"><button type="submit" class="btn btn-sm btn-danger round">Inactive</button></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                          </table>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection
