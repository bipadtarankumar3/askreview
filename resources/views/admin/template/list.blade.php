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
                            <h5 class="mb-0">Template List</h5>
                        </div>
                        <div class="col-md-2">
                            <a href="{{URL::to('admin/template_add')}}" class="btn btn-info">Add Template</a>
                            {{-- <a href="#" onclick="add_spinner_btn()" class="btn btn-info">Add Questions</a> --}}
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        
                        <form action="{{URL::to('admin/download_questions_Pdf')}}" method="post">
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
                                        <th><input name="" class="select_all" id="select_all" type="checkbox" ></th>
                                        <th>Sl.</th>
                                        <th>Category</th>
                                        <th>Template Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <!-- end row -->
                                </thead>
                                <tbody>

                                    @foreach ($Template as $key=> $item)
                                        <!-- start row -->
                                        <tr>
                                            <td><input name="checkbox[]" class="checkbox" type="checkbox"  value="{{$item->id}}"></td>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->category_name}}</td>
                                            <td>{{$item->template_name}}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        onchange="statuschange('{{ $item->id }}',this)"
                                                        {{ $item->active_status	 == 'active' ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            {{-- <td>{{$item->temp_status}}</td> --}}
                                            <td>
                                                <a href="{{URL::to('admin/template_edit/'.$item->id)}}"><i class="fas fa-edit"></i></a>
                                                <a href="{{URL::to('admin/delete_template/'.$item->id)}}" onclick="dataDelete(event)"><i class="fas fa-trash-alt"></i></a>
                                                {{-- <a href="#" onclick="dataView('{{URL::to('admin/view_question/'.$item->id)}}')"><i class="fas fa-eye"></i></a> --}}
                                            </td>
                                        </tr>
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



<div class="modal fade bd-example-modal-lg" id="add_spinner_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Questions Add/Update</h5>
            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close"  onclick="hide_modal()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body spinner_body">
          
          </div>
      </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="question_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View</h5>
            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close"  onclick="hide_question_modal()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body question_modal_body">
          
          </div>
      </div>
    </div>
</div>

@endsection


@section('js')
    <script>


function statuschange(id, getthis) {
    if ($(getthis).is(':checked')) {
        var status = "active"
    } else {
        var status = "inactive"
    }

    $.ajax({
            type: "get",
            url: "{{ URL::to('admin/template_status') }}/" + id + "/" + status,
            // where you wanna post
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                console.log(data);
                if (data.success == true) {
                    toastr.success(data.messege);
                } else {
                    toastr.error(data.message);
                }

                setTimeout(() => {
                    location.reload(true);
                }, 1000);
            }
        });

}



    function show_form_name_text() {
        $("#textform_nameContainer").hide();
        $("#editform_nameContainer").show();
    }

    function update_form_name(type) {
 
        var form_id = $('#form_id').val();
        var form_name = $('#edit'+type+'Field').val();
        $.ajax({
            type: "POST",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('admin/my_form_update')}}",// where you wanna post
            data: {
                'form_id':form_id,
                'form_name':form_name,
                'type':type
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $("#editform_nameContainer").hide();
                $("#textform_nameContainer").show();
                $("#displayform_nameText").text(form_name);
            } 
        });

    }

    function show_description_text() {
        $("#textdescContainer").hide();
        $("#editdescContainer").show();
    }

    function update_description(type) {
 
        var form_id = $('#form_id').val();
        var desc = $('#edit'+type+'Field').val();
        $.ajax({
            type: "POST",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('admin/my_form_update')}}",// where you wanna post
            data: {
                'form_id':form_id,
                'desc':desc,
                'type':type
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $("#editdescContainer").hide();
                $("#textdescContainer").show();
                $("#displaydescText").text(desc);
            } 
        });

    }
    
    function show_comment_text() {
        $("#textcommentsContainer").hide();
        $("#editcommentsContainer").show();
    }

    function update_comment(type) {

        var form_id = $('#form_id').val();
        var comments = $('#edit'+type+'Field').val();
        $.ajax({
            type: "POST",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('admin/my_form_update')}}",// where you wanna post
            data: {
                'form_id':form_id,
                'comments':comments,
                'type':type
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $("#editcommentsContainer").hide();
                $("#textcommentsContainer").show();
                $("#displaycommentsText").text(comments);
            } 
        });

    }
    
    function show_customer_support_text() {
        $("#textcustomer_supportContainer").hide();
        $("#editcustomer_supportContainer").show();
    }

    function update_customer_support(type) {

        var form_id = $('#form_id').val();
        var customer_support = $('#edit'+type+'Field').val();
        $.ajax({
            type: "POST",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('admin/my_form_update')}}",// where you wanna post
            data: {
                'form_id':form_id,
                'customer_support':customer_support,
                'type':type
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $("#editcustomer_supportContainer").hide();
                $("#textcustomer_supportContainer").show();
                $("#displaycustomer_supportText").text(customer_support);
            } 
        });

        
    }
    
    function show_rate_text_text() {
        $("#textrate_textContainer").hide();
        $("#editrate_textContainer").show();
    }

    function update_rate_text(type) {
        var form_id = $('#form_id').val();
        var rate_text = $('#edit'+type+'Field').val();
        $.ajax({
            type: "POST",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('admin/my_form_update')}}",// where you wanna post
            data: {
                'form_id':form_id,
                'rate_text':rate_text,
                'type':type
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $("#editrate_textContainer").hide();
                $("#textrate_textContainer").show();
                $("#displayrate_textText").text(rate_text);
            } 
        });

        
    }

    function add_more(){
            $('.add_more_section').append(`
              <div class="row  text-center  form-row">
                            <div class="col-md-3"> </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <div class="add_more_input_box" style="display: flex">
                                    <input type="text" class="form-control" name="answers[]" id="answers" placeholder="Enter Option">
                                
                                    <i class="fa-solid fa-minus"  style="color:red;margin-left:20px" onclick="removeField(this)"></i>
                                </div>
                                
                              </div>
                            </div>
                            
                            <div class="col-md-3"> </div>
                        </div>

            `);
        }

                
    function removeField(button) {
        $(button).closest(".form-row").remove();
    }


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
            'copy', 'excel',  'print'
        ]
    } );

    function add_spinner_btn() {
     
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/question_field_form')}}",// where you wanna post
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

    function edit_spinner(url) {
     
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

    function dataView(url) {
     
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
                $('.question_modal_body').html(data);
                $('#question_modal').modal('show');
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

    function hide_question_modal(params) {
        $('#question_modal').modal('hide');
    }

    </script>
@endsection