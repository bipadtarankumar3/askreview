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
                            <h5 class="mb-0">Add Credit</h5>
                        </div>
                        <div class="col-md-2">
                            {{-- <a href="{{URL::to('admin/add_spinner_page')}}" class="btn btn-info">Add Spinner</a> --}}
                            <a href="{{URL::to('admin/admin_service_payments_list')}}" class="btn btn-info">Admin Payment List</a>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
                
                {{-- <form action="{{URL::to('admin/user_service_payment_submit')}}" method="POST" >
                    @csrf --}}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="image_box">
                                    <img src="{{URL::to('adminAssets/images/service.jpg')}}" width="100%" height="100%" alt="">
                                </div>
                            </div>
                            <div class="col-md-7">
                                
                                    <h3>Order Details</h3>

                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            
                                           
                                            
                                          
                                            <form action="{{URL::to('admin/admin_service_payment_store')}}" method="POST" >
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="business_name" class="form-label">Business Name</label>
                                                            <input type="text" name="business_name" class="form-control" id="business_name" value="{{Auth::user()->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" name="email" class="form-control" id="email" value="{{Auth::user()->email}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
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
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="gst_number" class="form-label">GST Number</label>
                                                            <input type="text" name="gst_number" class="form-control" id="gst_number" aria-describedby="emailHelp">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="business_name" class="form-label">Service</label>
                                                            <select name="service_id" id="service_id" onchange="handleServiceChange()" class="form-control">
                                                                <option value="">Select Service</option>
                                                                @foreach ($service_list as $service)
                                                                    <option value="{{$service->id}}" data-credit="{{$service->credit_limit}}" data-price="{{$service->price}}">{{$service->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label for="credit" class="form-label">Number Of Credit</label>
                                                            <input type="number" name="credit" class="form-control" id="credit" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label for="price" class="form-label">Price</label>
                                                            <input type="number" name="price" class="form-control" id="price" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-md-6">

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-6"></div>
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                <h3>Payment Details</h3>
                                                <table class="table">
                                                    <tr>
                                                        
                                                        <td>Amount</td>
                                                        <td>₹ <span class="amount"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>VAT/GST/Sales Tax 18%</td>
                
                                                        <td>
                                                            
                                                            ₹ <span class="gst"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Amount</td>
                                                        <td>₹ <span class="total_amount"></span>
                                                        </td>
                                                    </tr>
                                                    
                                                </table>
                                                <input type="hidden" name="amountInput" id="amountInput" value="">
                                                <input type="hidden" name="gstAmountInput" id="gstAmountInput" value="">
                                                <input type="hidden" name="grandTotalInput" id="grandTotalInput" value="">
                                                <div class="mb-3 form-check">
                                                    <a href="javascript::void()" onclick="get_support()">Need Support?</a>
                                                </div>
                                                <button class="btn btn-sm btn-success"> Pay</button>
                                            </form>
                                        </div>
                                    </div>

                                    
                            </div>
                            
                            
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

function handleServiceChange() {
        var serviceSelect = document.getElementById("service_id");
        var creditInput = document.getElementById("credit");
        var priceInput = document.getElementById("price");
        var amountSpan = document.querySelector(".amount");
        var gstSpan = document.querySelector(".gst");
        var totalAmountSpan = document.querySelector(".total_amount");


        // var amountInput = document.getElementById("amountInput");
        // var gstAmountInput = document.getElementById("gstAmountInput");
        // var grandTotalInput = document.getElementById("grandTotalInput");

        // Get the selected option
        var selectedOption = serviceSelect.options[serviceSelect.selectedIndex];

        // Get the price and credit limit from the selected option
        var price = parseFloat(selectedOption.getAttribute("data-price"));
        var credit = parseFloat(selectedOption.getAttribute("data-credit"));

        // Set the values of credit and price input fields
        creditInput.value = credit;
        priceInput.value = price;

        // Calculate the amount without GST
        var amount = price.toFixed(2);
        amountSpan.textContent = amount;
        // amountInput.value = amount.toFixed(2);

        // Calculate GST (18% of the amount)
        var gst = amount * 0.18;
        gstSpan.textContent = gst.toFixed(2);
        // gstAmountInput.value = gst.toFixed(2);

        // Calculate the total amount including GST
        var totalAmount = parseFloat(amount) + parseFloat(gst);
        totalAmountSpan.textContent = totalAmount.toFixed(2);
        // grandTotalInput.value = totalAmount.toFixed(2);
        $('#amountInput').val(amount);
        $('#gstAmountInput').val(gst.toFixed(2));
        $('#grandTotalInput').val( totalAmount.toFixed(2));

    }



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