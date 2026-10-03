@extends('adminLayouts.home')
@section('content')


<div class="container-fluid">
<!-- basic table -->
<div class="row">
    <div class="col-12">
        <!-- ---------------------
                start Zero Configuration
            ---------------- -->
        <div class="card">
            <div class="card-header">
                <div class="mb-2">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="mb-0">Service List </h5>
                        </div>
                        <div class="col-md-4 text-end">
                            
                            <a href="{{URL::to('admin/add_user_service')}}" class="btn btn-info"> 
                                <i class="fa fa-plus" aria-hidden="true"></i> Service
                            </a>
                                         
                         </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">

                
                {{-- <div class="row my-4">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-center">
                        <h4 class="">Search</h4>
                        <form action="{{URL::to('admin/sub_user_list')}}" method="post">
                            @csrf
                            
                            <div class="row search-box">

                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Start Date</label>
                                        <input type="date" class="form-control" required  name="start_date" value="<?php echo isset($start_date)?date('Y-m-d',strtotime($start_date)):date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">End Date</label>
                                        <input type="date" class="form-control" required name="end_date" value="<?php echo isset($end_date)?date('Y-m-d',strtotime($end_date)):date('Y-m-d'); ?>" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group" style="margin-top: 21px;"> 
                                        <button type="submit" class="btn btn-success pull-right pull-rights"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                    </div>
                                </div>

                            </div>

                            <div class="clearfix"></div>

                        </form> 
                    </div>
                    <div class="col-md-2"></div>

            </div> --}}

            <div class="row">
                <div class="col-md-6">
                    <form action="{{URL::to('admin/service_update')}}" method="POST" enctype='multipart/form-data'>
                        @csrf
    
                        <input type="hidden" name="id" id="id" @if (isset($id)) value="{{$id}}" @endif>
                        <div class="form-group">
                          <label for="Service">Enter Service:</label>
                          <input type="text" required title="Don`t Use White Space Only" pattern=".*\S+.*" class="form-control" placeholder="Enter service" id="title" name="title"  @if (!empty($id)) value="{{$editData->title}}" @endif>
                        </div>
                        <div class="form-group">
                          <label for="Service">Service Year:</label>
                          <input type="text" required title="Don`t Use White Space Only" pattern=".*\S+.*" class="form-control" placeholder="Enter Year" id="subscription_date" name="subscription_date"  @if (!empty($id)) value="{{$editData->subscription_date}}" @endif>
                        </div>
                        <div class="form-group">
                          <label for="Price">Enter Price:</label>
                          <input type="text" required title="Don`t Use White Space Only" pattern=".*\S+.*" class="form-control" placeholder="Enter Price" id="price" name="price"  @if (!empty($id)) value="{{$editData->price}}" @endif>
                        </div>
                        <div class="form-group">
                          <label for="Price">Video Access:</label>
                            <select name="video_access" id="video_access"  class="form-control" >
                                <option value="N" @if(!empty($id) && $editData->video_access == 'N') selected @endif>No</option>
                                <option value="Y" @if(!empty($id) && $editData->video_access == 'Y') selected @endif>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="status">Status:</label>
                            <select name="status" id="status"  class="form-control" >
                                <option value="pending" @if(!empty($id) && $editData->status == 'pending') selected @endif>Pending</option>
                                <option value="publish" @if(!empty($id) && $editData->status == 'publish') selected @endif>Publish</option>
                            </select>
                        </div>
                       
                        <button type="submit" class="btn btn-primary my-4">Submit</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="{{URL::to('admin/downloadUserPdf')}}" method="post">
                        @csrf
                            {{-- <div class="row my-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-info">Download Pdf</button>
                                </div>
                            </div> --}}
                            <div class="table-responsive">
                                <table id="zero_config"
                                    class="table border table-striped table-bordered text-nowrap">
                                    <thead>
                                        <!-- start row -->
                                        <tr>
                                            {{-- <th><input name="" class="select_all" id="select_all" type="checkbox" ></th> --}}
                                            <th>Sl.</th>
                                            <th>Title</th>
                                            <th>Service Year</th>
                                            <th>Price</th>
                                            <th>Video Access</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
        
                                        @foreach ($service_list as $key=> $item)
                                            <!-- start row -->
                                            <tr>
                                                {{-- <td><input name="checkbox[]" class="checkbox" type="checkbox"  value="{{$item->id}}"></td> --}}
                                                <td>{{$key+1}}</td>
                                                <td>{{$item->title}}</td>
                                                <td>{{$item->subscription_date}}</td>
                                                
                                                <td>{{$item->price}}</td>
                                                <td>
                                                    @if ($item->video_access == 'Y')
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                                <td>{{$item->status}}</td>
                                                
                                                <td>
                                                    <a href="{{URL::to('admin/service?service_id='.$item->id)}}"><i class="fas fa-edit"></i></a>
                                                    
                                                    {{-- <a href="{{URL::to('admin/delete_user_service/'.$item->id)}}" onclick="dataDelete(event)"><i class="fas fa-trash-alt"></i></a> --}}
                                                    
                                                </td>
                                            </tr>
                                            <!-- end row --> 
                                        @endforeach
        
                                        
                                        
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                </div>
            </div>

            
            </div>
        </div>
        <!-- ---------------------
                end Zero Configuration
            ---------------- -->
    </div>
</div>
</div>

@endsection


@section('js')
    <script>

    // $('.checkbox').click(function() {
    //     console.log($(this).attr("data-checked"));
    //     if ($(this).attr("data-checked") == 0) {
    //         $(this).attr("data-checked", "1")
    //     } else {
    //         $(this).attr("data-checked", "0")
    //     }
    // });

    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });

    // $("#zero_config").DataTable({
    //     dom: 'Bfrtip',
    //     // buttons: [
    //     //     'copy','excel', 'pdf', 'print'
    //     // ]
    // });
    $("#zero_config").DataTable();
    </script>
@endsection