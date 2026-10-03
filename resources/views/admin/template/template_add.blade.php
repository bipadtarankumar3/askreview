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
                            <h5 class="mb-0">Feedback List</h5>
                        </div>
                        <div class="col-md-2">
                            {{-- <a href="{{URL::to('admin/template/add_form_page')}}" class="btn btn-info">Add Feedback</a>
                            <a href="#" onclick="add_spinner_btn()" class="btn btn-info">Add Questions</a> --}}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4 col-lg-4"></div>
                    <div class="col-md-3 col-lg-3">
                        <form action="" class="feedback_form">
                            <input type="hidden" value="{{$form_data->id}}" name="form_id" id="form_id">
                            <div class="row text-center">
                                <div class="col-md-12">
                                    
                                    
                                    <div >
                                        <div class="row">

                                            <div class="col-md-12">
                                                <select name="editcategory_idField" id="editcategory_idField" class="form-control" onchange="update_category_id('category_id')">
                                                    <option value="">Select Category</option>
                                                    @foreach ($TemplateCategory as $item)
                                                        <option value="{{$item->id}}" @if($item->id == $form_data->category_id) selected @endif>{{$item->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                <p class="category_id_message"></p>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" onkeyup="change_template_name(this.value)" value="{{$form_data->template_name}}" name="template_name" placeholder="Add Template Name">
                                                <p class="template_message"></p>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div id="textform_nameContainer" style="dis">
                                        <h4> <span id="displayform_nameText">{{$form_data->form_name}}</span> 
                                            <i class="fa-solid fa-pen-to-square"  onclick="show_form_name_text()" ></i></h4>
                                    </div>
                                    
                                    <div id="editform_nameContainer" style=" display: none;">
                                        <div class="row">

                                            <div class="col-md-10">
                                                <input type="text" id="editform_nameField"  class="form-control" value="{{$form_data->form_name}}">
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa-solid fa-check"  onclick="update_form_name('form_name')"></i>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="textdescContainer" style="dis">
                                        <p> 
                                            <b><span id="displaydescText">{{$form_data->desc}}</span></b> 
                                            <i class="fa-solid fa-pen-to-square" onclick="show_description_text()" ></i>
                                        </p>
                                    </div>
                                    
                                    <div id="editdescContainer" style=" display: none;">
                                        <div class="row">

                                            <div class="col-md-10">
                                                <textarea name="" id="editdescField"  class="form-control">{{$form_data->desc}}</textarea>
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa-solid fa-check" onclick="update_description('desc')"></i>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
  
                            <div class="row">
                               
                                <div class="col-md-12"> 
                                    <h4>Add Feedback  <i class="fa-solid fa-plus" style="color: green" onclick="add_spinner_btn('{{$form_id}}')"></i> </h4>
                                @foreach ($Question as $key=> $item)
                                    <div class="row my-4">
                                        <div class="col-md-12">
                                        <h5>
                                            ({{$key+1}}) {{$item->question}}  
                                            <i class="fa-solid fa-pen-to-square"  onclick="edit_spinner('{{URL::to('admin/template/edit_question/'.$item->id)}}')"></i>
                                            <a href="{{URL::to('admin/template/delete_question/'.$item->id)}}" onclick="dataDelete(event)">
                                            <i class="fa-solid fa-trash" style="color: red"></i>
                                            </a>
                                        </h5>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="row">
                                            @php
                                                $answ = DB::table('question_answers')->where('question_id',$item->id)->get();
                                            @endphp
                                            @foreach ($answ as $option)
                                            <div class="col-md-6">
                                                <label>
                                                <input type="radio" name="answers[{{ $item->id }}]" value="{{ $option->id }}">
                                                {{ $option->answers }}
                                                </label>
                                            </div> 
                                            @endforeach
                                            
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                    
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div id="textcustomer_supportContainer" style="dis">
                                        <h5> <span id="displaycustomer_supportText">{{$form_data->customer_support}}</span> 
                                            <i class="fa-solid fa-pen-to-square"  onclick="show_customer_support_text()" ></i>
                                        </h5>
                                    </div>
                                    
                                    <div id="editcustomer_supportContainer" style=" display: none;">
                                        
                                        
                                        <div class="row">

                                            <div class="col-md-10">
                                                <input type="text" id="editcustomer_supportField"  class="form-control" value="{{$form_data->customer_support}}">
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa-solid fa-check" onclick="update_customer_support('customer_support')"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="star_part">
                                        <img src="{{asset('adminAssets/images/star.jpeg')}}" alt="">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div id="textrate_textContainer" style="dis">
                                        <h5> <span id="displayrate_textText">{{$form_data->rate_text}}</span>
                                            <i class="fa-solid fa-pen-to-square"  onclick="show_rate_text_text()"></i>
                                        </h5>
                                    </div>
                                    
                                    <div id="editrate_textContainer" style=" display: none;">
                                        <div class="row">

                                            <div class="col-md-10">
                                                <input type="text" id="editrate_textField"  class="form-control" value="{{$form_data->rate_text}}">
                                            </div>
                                            <div class="col-md-2">
                                                    <i class="fa-solid fa-check"  onclick="update_rate_text('rate_text')"></i>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="star_part">
                                        <img src="{{asset('adminAssets/images/star.jpeg')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row  mt-4">
                                <div class="col-md-12">
                                    <div id="textcommentsContainer" style="dis">
                                        <p> 
                                            <span id="displaycommentsText">{{$form_data->comments}}</span> 
                                            <i class="fa-solid fa-pen-to-square" onclick="show_comment_text()" ></i>
                                        </p>
                                        <div class="col-md-12">
                                            <textarea name="" class="form-control"></textarea>                                     
                                        
                                        </div>
                                    </div>
                                    
                                    <div id="editcommentsContainer" style=" display: none;">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <textarea name="" id="editcommentsField" class="form-control">{{$form_data->comments}}</textarea>                                     
                                            </div>
                                            <div class="col-md-2">
                                                <i class="fa-solid fa-check" onclick="update_comment('comments')"></i>
                                            </div>
                                           
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <a href="{{URL::to('admin/template')}}">
                                        <button class="btn btn-success" type="button">Back</button>
                                    </a>
                                    
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-5 col-lg-5"></div>
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



    function show_form_name_text() {
        $("#textform_nameContainer").hide();
        $("#editform_nameContainer").show();
    }

    function change_template_name(template_name) {
 
        var form_id = $('#form_id').val();
        $.ajax({
            type: "POST",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('admin/template/my_form_update')}}",// where you wanna post
            data: {
                'form_id':form_id,
                'template_name':template_name,
                'type':'template_name'
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $('.template_message').html('<span style="color:green;">Template Name Updated Successfully</span>');
                setTimeout(()=>{
                    $('.template_message').html('');
                },1500)
            } 
        });

    }

    function update_category_id(type) {
 
        var form_id = $('#form_id').val();
        var category_id = $('#edit'+type+'Field').val();
        $.ajax({
            type: "POST",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('admin/template/my_form_update')}}",// where you wanna post
            data: {
                'form_id':form_id,
                'category_id':category_id,
                'type':type
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $('.category_id_message').html('<span style="color:green;">Category Updated Successfully</span>');
                setTimeout(()=>{
                    $('.category_id_message').html('');
                },1500)
            } 
        });

    }

    function update_form_name(type) {
 
        var form_id = $('#form_id').val();
        var form_name = $('#edit'+type+'Field').val();
        $.ajax({
            type: "POST",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('admin/template/my_form_update')}}",// where you wanna post
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
            url: "{{URL::to('admin/template/my_form_update')}}",// where you wanna post
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
            url: "{{URL::to('admin/template/my_form_update')}}",// where you wanna post
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
            url: "{{URL::to('admin/template/my_form_update')}}",// where you wanna post
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
            url: "{{URL::to('admin/template/my_form_update')}}",// where you wanna post
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

    function add_spinner_btn(form_id) {
     
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/template/question_field_form')}}",// where you wanna post
            data: {
                'form_id':form_id
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