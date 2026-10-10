@extends('adminLayouts.home')
@section('content')

<style>
    .razorpay-payment-button{
        padding: 7px;
        border-radius: 5px;
        border: 0px solid black;
        background: #539bff;
        color: white;
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
                            <h5 class="mb-0">Buy Plan</h5>
                        </div>
                        <div class="col-md-2">
                            {{-- <a href="{{URL::to('admin/add_spinner_page')}}" class="btn btn-info">Add Spinner</a> --}}
                            <a href="{{URL::to('admin/user_payments_list')}}" class="btn btn-info">Payment List</a>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">

                <div class="row">

                    @foreach ($Service as $item)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header" style="background: white;color:white;">
                                    <h3>{{$item->title}}</h3>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li><strong>Validity:</strong> {{$item->subscription_date ?? 1}} Year Extend Expiry Date</li>
                                        <li><strong>Plan Tier:</strong> {{ ucfirst($item->plan_type ?? 'basic') }}</li>
                                        <li><strong>Double QR Access:</strong> 
                                            @if (($item->double_qr_access ?? 'N') == 'Y')
                                                <span class="text-success fw-bold">Yes</span>
                                            @else
                                                <span class="text-muted">No</span>
                                            @endif
                                        </li>
                                        <li><strong>Video Access:</strong> 
                                            @if ($item->video_access == 'Y')
                                                <span class="text-success fw-bold">Yes</span>
                                            @else
                                                <span class="text-muted">No</span>
                                            @endif
                                        </li>
                                        <li><strong>Price:</strong> ₹{{$item->price}}</li>
                                    </ul>
                                </div>
                                <div class="text-center mb-4">
                                    <a href="{{URL::to('admin/user_service_payment_view/'.$item->id)}}">
                                        <button class="btn btn-info">View</button>
                                    </a>

                                    {{-- <form action="{{URL::to('admin/user_service_payment_submit')}}" method="POST" >
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{$item->id}}">
                                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                data-key="{{ env('RAZORPAY_KEY') }}"
                                                data-amount="{{$item->price*100}}"
                                                data-buttontext="Pay {{$item->price}} INR"
                                                data-name="AskReview"
                                                data-description="Rozerpay"
                                                data-image="https://askreview.in/frontend/images/logo.jpg"
                                                data-prefill.name="name"
                                                data-prefill.email="email"
                                                data-theme.color="#ff7529">
                                        </script>
                                    </form> --}}
                                    
                                   

                                </div>
                            </div>
                        </div>
                    @endforeach

                    
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
            <h5 class="modal-title" id="exampleModalLabel">Spinner</h5>
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
            'copy', 'excel',  'print'
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