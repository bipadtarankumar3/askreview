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
                
                {{-- <form action="{{URL::to('admin/user_service_payment_submit')}}" method="POST" >
                    @csrf --}}
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card card_box gold_box">
                                <div class="header_box">
                                    <h2>
                                    {{$Service->title}}
                                    </h2>
                                    
                                </div>
                                <div class="card_body_box">
                                    <div class="price_box">
                                    <div class="price_sec">
                                        <h4>₹ {{$Service->price}}/Yearly</h4>
                                    </div>
                                    </div>
                                    
                                    <div class="card_list_sec">
                                        <ul>
                                        <li>
                                            <span><i class="fa-solid fa-check" style="color: green"></i> <span>Link social media platform (facebook + instagram + youtube)</span></span>
                                            
                                        </li>
                                        <li>
                                            <span><i class="fa-solid fa-check" style="color: green"></i> <span>Generate unlimited design qr code</span></span>
                                            
                                        </li>
                                        <li>
                                            <span><i class="fa-solid fa-check" style="color: green"></i> <span> Automatic link qr code with google my business access</span></span>
                                            
                                        </li>
                                        <li>
                                            <span><i class="fa-solid fa-check" style="color: green"></i> <span>1 year validity</span></span>
                                            
                                        </li>
                                        <li>
                                            <span><i class="fa-solid fa-check" style="color: green"></i> <span>Customize feedback form</span></span>
                                            
                                        </li>
                                        <li>
                                            <span><i class="fa-solid fa-check" style="color: green"></i> <span>Private  enquiry option</span></span>
                                            
                                        </li>
                                        <li>
                                            <span><i class="fa-solid fa-check" style="color: green"></i> <span>Dashboard  notifications</span></span>
                                            
                                        </li>
                                        <li>
                                            <span><i class="fa-solid fa-check" style="color: green"></i> <span>Scan qr code unlimited times</span></span>
                                            
                                        </li>
                                        
                                    </ul>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <form action="{{URL::to('admin/user_service_payment_submit')}}" method="POST" >
                                @csrf
                                <h3>Order Details</h3>
                                <div class="mb-3">
                                    <label for="business_name" class="form-label">Business Name</label>
                                    <input type="text" name="business_name" class="form-control" id="business_name" value="{{Auth::user()->name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{Auth::user()->email}}">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="add_address"  onchange="toggleBillAddress()">
                                    <label class="form-check-label" for="add_address">Add Address</label>
                                </div>

                                <div class="bill_address" style="display: none">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <select name="country" id="country" class="form-control" onchange="get_state(this.value)">
                                            <option value="">Select Country</option>
                                            @php
                                                $country = DB::table('countries')->get();
                                            @endphp
                                            @foreach ($country as $cn)
                                                <option value="{{$cn->id}}">{{$cn->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <select name="state" id="state" class="form-control">
                                            <option value="">Select State</option>
                                            
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                        <textarea name="address" class="form-control" id="exampleFormControlTextarea1" placeholder="Address"></textarea>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="gst_number" class="form-label">GST Number</label>
                                    <input type="text" name="gst_number" class="form-control" id="gst_number" aria-describedby="emailHelp">
                                </div>
                                <h3>Payment Details</h3>
                                <table class="table">
                                    <tr>
                                        
                                        <td>Amount</td>
                                        <td>₹ {{$Service->price}}</td>
                                    </tr>
                                    <tr>
                                        <td>VAT/GST/Sales Tax 18%</td>

                                        <td>
                                            @php

                                                $gstPercentage = 18; // GST percentage
                                                $gstAmount = ( $Service->price * $gstPercentage) / 100; // Calculating GST amount
                                            
                                            @endphp
                                            ₹ {{$gstAmount}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td>₹ 
                                            @php
                                                $price = $Service->price + $gstAmount;
                                                echo $price;
                                            @endphp
                                        </td>
                                    </tr>
                                    
                                </table>
                                <input type="hidden" name="gst_amount" value="{{$gstAmount}}">
                                <input type="hidden" name="grand_total" value="{{$price}}">
                                <input type="hidden" name="service_id" value="{{$Service->id}}">
                                <div class="mb-3 form-check">
                                    <a href="javascript::void()" onclick="get_support()">Need Support?</a>
                                </div>
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="{{ env('RAZORPAY_KEY') }}"
                                    data-amount="{{$price*100}}"
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
                                
                {{-- </form> --}}
                
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
    function toggleBillAddress() {
        var checkbox = document.getElementById("add_address");
        var billAddress = document.querySelector(".bill_address");

        if (checkbox.checked) {
            billAddress.style.display = "block";
        } else {
            billAddress.style.display = "none";
        }
    }

    function get_state(country_id) {
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/get_state')}}?country_id="+country_id,// where you wanna post
            data: {
                'id':''
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $('#state').html(data);
            } 
        });
    }


</script>
@endsection