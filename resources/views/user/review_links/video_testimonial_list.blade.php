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
                        <div class="col-md-10">
                            <h5 class="mb-0">Video List</h5>
                        </div>
                        <div class="col-md-2">
                            {{-- <a href="{{URL::to('admin/add_spinner_page')}}" class="btn btn-info">Add Spinner</a> --}}
                            {{-- <a href="#" onclick="add_spinner_btn()" class="btn btn-info">Add Review</a> --}}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
                
                <div class="row my-4">
                    <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            <h4 class="">Search</h4>
                            <form action="{{URL::to('admin/video_testimonial')}}" method="get">
                               
                                
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

                </div>

                <form action="{{URL::to('admin/downloadSpinnerPdf')}}" method="post">
                    @csrf
                        <div class="row my-3">
                            <div class="col-md-12">
                                <small> <span>Alert ! </span>

                                    Dear Client,
                                    
                                    <span style="color: red">Please Download Every Video within 30 Days,  or else it will be deleted 
                                    We are not responsible for this.</span></small>
                            </div>
                        </div>
                
                <div class="table-responsive">
                    <table id="zero_config"
                        class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <!-- start row -->
                            <tr>
                             
                                <th>Sl.</th>
                                <th>Date</th>
                                <th>Rating</th>
                                <th>Name</th>
                                <th>Video</th>
                                <th>Action</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>

                            @foreach ($video_testimonial as $key=> $item)
                                <!-- start row -->
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        @if ($item->rating != '')
                                            @for ($i = 0; $i < $item->rating; $i++)
                                                <i class="fa-solid fa-star" style="color: gold"></i>
                                            @endfor
                                        @endif
                                        
                                    </td>
                                    <td>{{$item->video_customer_name}}</td>
                                    <td>
                                        <a href="{{URL::to('admin/video_testimonial_details/'.$item->id)}}">{{$item->video}}</a>
                                    </td>
                                    
                                    <td>
                                        <a href="{{URL::to('admin/video_testimonial_delete/'.$item->id)}}" onclick="dataDelete(event)"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                   
                                </tr>
                            @endforeach

                            
                            
                        </tfoot>
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

<div class="modal fade bd-example-modal-lg" id="add_spinner_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Review Details</h5>
            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close"  onclick="hide_modal()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body spinner_body">
          
          </div>
      </div>
    </div>
  </div>

@endsection


@section('js')
    <script>

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

        $("#zero_config").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'excel'
        ]
    } );

    function add_spinner_btn() {
     
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/field_form')}}",// where you wanna post
            data: {
                'id':''
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $('.spinner_body').html(data);
                $('#add_spinner_modal').modal('show');
            } 
        });

    }

    function view_review(url) {
     
        $.ajax({
            type: "GET",
            url: url,// where you wanna post
            data: {
                'id':''
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $('.spinner_body').html(data);
                $('#add_spinner_modal').modal('show');
            } 
        });

    }

    function add_submit() {

        var spin_round = $('.value').val();
        if (spin_round == '') {
            $('.spin_round_error').html('Please Enter Spin Round Value');
            return;
        } else {
            $('.spin_round_error').html('');
        }

        var url = $('#spinner_form').attr("action");
        var form = $('#spinner_form')[0];
        // console.log(url);return;
        var formData = new FormData(form);// yourForm: form selector        
        $.ajax({
            type: "POST",
            url: url,// where you wanna post
            data: formData,
            processData: false,
            contentType: false,
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                console.log(data);
                swal({
                      title: "Success",
                      text: "Thank you for submit.",
                      type: "success",
                      confirmButtonText: "Cool"
                    });
                    
                    setTimeout(() => {
                      location.reload(true);
                    }, 1500);
            } 
        });

    }

    function hide_modal(params) {
        $('#add_spinner_modal').modal('hide');
    }

    </script>
@endsection