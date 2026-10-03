
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
                            <h5 class="mb-0">Category List</h5>
                        </div>
                        <div class="col-md-4 text-end">
                            {{-- <a href="{{URL::to('admin/add_sub_user_page')}}" class="btn btn-info"> <i class="fa fa-plus" aria-hidden="true"></i> Add Category</a> --}}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <form action="{{URL::to('admin/addCategory')}}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            @if (!empty($_GET['status']))
                                <input type="hidden" name="status" id="status" value="{{$_GET['status']}}">
                            @endif
                            <input type="hidden" name="id" id="id" @if (!empty($id)) value="{{$id}}" @endif>
                            <input type="hidden" name="cat_type" id="cat_type" value="CATEGORY">
                            <input type="hidden" name="Status" id="Status" @if (!empty($id)) value="Update" @else value="Insert" @endif>
                            <div class="form-group">
                              <label for="Category">Enter Category:</label>
                              <input type="text" required title="Don`t Use White Space Only" pattern=".*\S+.*" class="form-control" placeholder="Enter Category" id="Category" name="Category"  @if (!empty($id)) value="{{$editData->category_name}}" @endif>
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

                            <button type="submit" class="btn btn-primary my-4">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-3">
                    </div>
                    
                </div>

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
            <form action="{{URL::to('admin/downloadUserPdf')}}" method="post">
                @csrf

                    <div class="table-responsive">
                        <table id="table"
                            class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Date</th>
                                  <th scope="col">Category Name</th>
                                  <!-- <th scope="col">Desc</th>-->
                                  <!-- <th scope="col">Image</th>  -->
                                  <!-- <th scope="col">Position</th>
                                  <th scope="col">Change Position</th> -->
                                  {{-- <th scope="col">Status</th> --}}
                                  <th scope="col">Action</th>
                                  
                                </tr>
                              </thead>
                              <tbody id="tableBodyContents">
                                  @foreach ($productcategory as $key=> $Data)
                                      <tr  class="tableRow" data-id="{{ $Data->id }}">
                                      <th scope="row">{{$key+1}}</th>
                                          <td>{{$Data->created_at}}</td>
                                          <td>{{$Data->category_name}}</td>
                                          
                                          {{-- <td class="sts">

                                            @if ($Data->cat_status == 'INACTIVE')
                                            <a href="{{URL::to('admin/categoryStatus/inActive/'.$Data->id)}}"><button type="button" class="btn btn-sm btn-danger">Inactive</button></a>
                                                
                                            @else
                                            <a href="{{URL::to('admin/categoryStatus/active/'.$Data->id)}}"><button type="button" class="btn btn-sm btn-info">Active</button></a>
                                            @endif
                                        </td> --}}
                                          <td class="act">
                                              <span><a href="{{URL::to('admin/categoryEdit/'.$Data->id)}}" title="Edit"><i class="fas fa-edit"></i></a></span>
                                              <span><a href="{{URL::to('admin/categoryDelete/'.$Data->id)}}" onclick="dataDelete(event);" title="Cancel"><i class="fas fa-trash-alt"></i></a></span>
                                          </td>
                                          
                                      </tr>
                                  @endforeach

                              </tbody>
                        </table>
                    </div>
                </form>
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
    //     buttons: [
    //         'copy','excel', 'pdf', 'print'
    //     ]
    // });
    </script>


<script type="text/javascript">
    $(function () {

        // $("#table").DataTable();

        $("#tableBodyContents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {

            var order = [];
            var token = $('meta[name="csrf-token"]').attr('content');

            $('tr.tableRow').each(function(index,element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('admin/post-reorder') }}",
                    data: {
                    order: order,
                    _token: token
                },
                success: function(response) {
                    if (response.status == "success") {
                        console.log(response);
                    } else {
                        console.log(response);
                    }
                }
            });
        }
    });
</script>

@endsection


