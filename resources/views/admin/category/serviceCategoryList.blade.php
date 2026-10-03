@extends('adminLayouts.home')
@section('content')

<div class="content-body">
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="la la-list-ul"></i>Create Menu
                        

                        </h4>
                        
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{URL::to('admin/addServiceCategory')}}" method="POST" enctype='multipart/form-data'>
                                        @csrf
                                        @if (!empty($_GET['status']))
                                            <input type="hidden" name="status" id="status" value="{{$_GET['status']}}">
                                        @endif
                                        <input type="hidden" name="id" id="id" @if (!empty($id)) value="{{$id}}" @endif>
                                        <input type="hidden" name="cat_type" id="cat_type" value="CATEGORY">
                                        <input type="hidden" name="Status" id="Status" @if (!empty($id)) value="Update" @else value="Insert" @endif>
                                        <div class="form-group">
                                          <label for="Category">Enter Category:</label>
                                          <input type="text" required title="Don`t Use White Space Only" pattern=".*\S+.*" class="form-control" placeholder="Enter Category" id="Category" name="Category"  @if (!empty($id)) value="{{$editData->cat_name}}" @endif>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="desc">Enter Desc:</label>
                                            <textarea class="form-control" required placeholder="Enter Desc" id="desc" name="desc" >@if(!empty($id)){{$editData->cat_desc}}@endif</textarea>
                                          </div> -->

                                          <!-- <div class="form-group">
                                            <label for="desc">Enter Image:</label>
                                            <input type="file" @if (empty($id))  @endif  class="form-control"  id="file" name="file"  >
                                          </div>
                                          <div class="form-group">
                                            @if (!empty($id))
                                                <img src="{{$editData->cat_image}}" width="90px">
                                            @endif
                                          </div> -->

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                </div>
                                
                            </div>

                             <div class="row mt-4">
                                <div class="col-md-12">
                                    <div>
                                        <caption>List of Menu</caption><br><br>
                                        <table class="table table-striped" id="table_id">
                                            
                                            <thead>
                                              <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Menu Name</th>
                                                <!-- <th scope="col">Desc</th>-->
                                                <!-- <th scope="col">Image</th>  -->
                                                <!-- <th scope="col">Position</th>
                                                <th scope="col">Change Position</th> -->
                                                <th scope="col">Action</th>
                                                <th scope="col">Status</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Category as $key=> $Data)
                                                    <tr>
                                                    <th scope="row">{{$key+1}}</th>
                                                        <td>{{$Data->cat_name}}</td>
                                                        <!-- <td>{{$Data->cat_desc}}</td> -->
                                                        <!-- <td><img src="{{$Data->cat_image}}" width="90px"></td> -->
                                                        <!-- <td>{{$Data->cat_position}}</td>
                                                        <td>
                                                            <form action="{{URL::to('admin/catPositionChange')}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="catId" value="{{$Data->id}}">
                                                                <input type="hidden" name="catPosition" value="{{$Data->cat_position}}">
                                                                <select name="PositionId" onchange="this.form.submit()">
                                                                    <option value="">Select Position</option>
                                                                    @foreach ($Category as $key=> $productcategories)
                                                                        <option value="{{$productcategories->id}}">{{$productcategories->cat_name}} ({{$productcategories->cat_position}})</option>
                                                                    @endforeach
                                                                </select>
                                                            </form>
                                                        </td> -->
                                                        <td class="act">
                                                            <span><a href="{{URL::to('admin/serviceCategoryEdit/'.$Data->id)}}" title="Edit"><i class="fas fa-edit"></i></a></span>
                                                            <span><a href="{{URL::to('admin/serviceCategoryDelete/'.$Data->id)}}" onclick="dataDelete(event);" title="Cancel"><i class="fas fa-trash-alt"></i></a></span>
                                                        </td>
                                                        <td class="sts">

                                                            @if ($Data->cat_status == 'INACTIVE')
                                                            <a href="{{URL::to('admin/serviceCategoryStatus/inActive/'.$Data->id)}}"><button type="submit" class="btn btn-sm btn-danger round">Inactive</button></a>
                                                                
                                                            @else
                                                            <a href="{{URL::to('admin/serviceCategoryStatus/active/'.$Data->id)}}"><button type="submit" class="btn btn-sm btn-info round">Active</button></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                          </table>
                                          {{-- {{$productcategory->links()}} --}}
                                    </div>
                                </div>
                             </div>
                        </div>

                    </div>
                </div>
            </div>
    </section>
</div>
@endsection
