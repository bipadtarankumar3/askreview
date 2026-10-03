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
                            <h5 class="mb-0">Pay</h5>
                        </div>
                        <div class="col-md-2">
                            {{-- <a href="{{URL::to('admin/add_spinner_page')}}" class="btn btn-info">Add Spinner</a> --}}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
                
                <form action="{{URL::to('admin/admin_service_payment_submit')}}" method="POST" >
                    @csrf
                    @php
                        $grand_total = session()->get('admin_service');
                        // dd($store['grandTotalInput']);
                    @endphp
                    <input type="hidden" name="service_id" value="{{$service_details->id}}">
                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="{{ env('RAZORPAY_KEY') }}"
                            data-amount="{{$grand_total['grandTotalInput']*100}}"
                            data-buttontext="Confirm & Pay"
                            data-name="AskReview"
                            data-description="Rozerpay"
                            data-image="https://askreview.in/frontend/images/logo.jpg"
                            data-prefill.name="name"
                            data-prefill.email="email"
                            data-theme.color="#ff7529">
                    </script>
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
window.onload = function() {

    setTimeout(() => {
        var paymentButton = document.querySelector(".razorpay-payment-button");
        paymentButton.click();
    }, 1000);
       
};


</script>
@endsection