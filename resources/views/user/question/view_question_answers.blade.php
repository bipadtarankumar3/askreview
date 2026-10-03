@extends('adminLayouts.home')
@section('content')
<style>
    
.rate {
  float: left;
  height: 46px;
  /* padding: 0 10px; */
}
.rate:not(:checked) > input {
  position:absolute;
  top:-9999px;
}
.rate:not(:checked) > label {
  float:right;
  width:1em;
  overflow:hidden;
  white-space:nowrap;
  cursor:pointer;
  font-size:45px;
  color:#ccc;
}
.rate:not(:checked) > label:before {
  content: '★ ';
}
.rate > input:checked ~ label {
  color: #ffda26;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
  color: #ffda26;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
  color: #ffda26;
}

</style>

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
                            <h5 class="mb-0">Feedback Result</h5>
                        </div>
                        <div class="col-md-2">
                            
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-4 col-lg-4"></div>
                    <div class="col-md-3 col-lg-3">
                        <form action="" class="feedback_form">
                         
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <div id="textform_nameContainer" style="dis">
                                        <h4> <span id="displayform_nameText">{{(isset($feedback_form_submit->form_name))?$feedback_form_submit->form_name:''}}</span> 
                                         </h4>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div id="textdescContainer" style="dis">
                                        <p> 
                                            <b><span id="displaydescText">{{(isset($feedback_form_submit->desc))?$feedback_form_submit->desc:''}}</span></b> 
                                           
                                        </p>
                                    </div>
                                 
                                </div>
                            </div>
  
                            <div class="row">
                               
                                <div class="col-md-12"> 
                                 @foreach ($QuestionResult as $key=> $item)
                                    <div class="row my-4">
                                        <div class="col-md-12">
                                        <h5>
                                            ({{$key+1}}) {{$item->question}}  
                                            
                                        </h5>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="row">
                                            <label for="">{{ $item->answers }}</label>
                                            
                                            
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                    
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div id="textcustomer_supportContainer" style="dis">
                                        <h5> <span id="displaycustomer_supportText">{{(isset($feedback_form_submit->customer_support))?$feedback_form_submit->customer_support:''}}</span> 
                                            
                                        </h5>
                                    </div>
                                    
                                    <div class="star_part">
                                        <div class="rate">
                                            @if (isset($feedback_form_submit->f_customer_support))
                                                @for ($i = 0; $i < $feedback_form_submit->f_customer_support	; $i++)
                                                    <input type="radio" id="f_customer_support_star5" name="f_customer_support" value="5">
                                                    <label for="f_customer_support_star5" title="text" style="color: gold;">5 stars</label>
                                                @endfor
                                            @endif
                                        
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div id="textrate_textContainer" style="dis">
                                        <h5> <span id="displayrate_textText">{{isset($feedback_form_submit->rate_text)?$feedback_form_submit->rate_text:''}}</span>
                                           
                                        </h5>
                                    </div>
                                    
                                    <div class="star_part">
                                        <div class="rate">
                                            @if (isset($feedback_form_submit->f_rate_text))
                                               @for ($i = 0; $i < $feedback_form_submit->f_rate_text	; $i++)
                                                    <input type="radio" id="f_customer_support_star5" name="f_customer_support" value="5">
                                                    <label for="f_customer_support_star5"  style="color: gold;" title="text">5 stars</label>
                                                @endfor 
                                            @endif
                                            
                                            
                                          </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row  mt-4">
                                <div class="col-md-12">
                                    <div id="textcommentsContainer" style="dis">
                                        <p> 
                                            <span id="displaycommentsText">{{isset($feedback_form_submit->comments)?$feedback_form_submit->comments:''}}</span> 
                                          
                                        </p>
                                        <div class="col-md-12">
                                            <textarea name="" class="form-control">{{isset($feedback_form_submit->f_comments)?$feedback_form_submit->f_comments:''}}</textarea>                                     
                                        
                                        </div>
                                    </div>
                                    
                                    
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