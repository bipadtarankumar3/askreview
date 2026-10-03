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
                                <h5 class="mb-0">Payment Details</h5>
                            </div>
                            <div class="col-md-2">
                                {{-- <a href="{{URL::to('admin/add_spinner_page')}}" class="btn btn-info">Add Spinner</a> --}}
                                <a href="{{URL::to('admin/user_service')}}" class="btn btn-info">Service List</a>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="card-body">
                    @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Error!</strong> {{ $message }}
                        </div>
                    @endif

                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Success!</strong> {{ $message }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <form action="{{URL::to('admin/user_service_payment_submit')}}" method="POST" >
                                @csrf
                                <input type="hidden" name="service_id" value="{{$Service->id}}">
                                <div class="card">
                                    <div class="card-header" style="background: white;color:white;">
                                        <h3>{{$Service->title}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <ul>
                                            <li>1 Year Extend Expiry Date</li>
                                            <li>Video Access : 
                                                @if ($Service->video_access == 'Y')
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </li>
                                            <li>Price : {{$Service->price}}</li>
                                        </ul>
                                    </div>
                                    <div class="text-center mb-4">
                                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                            data-key="{{ env('RAZORPAY_KEY') }}"
                                            data-amount="{{$Service->price*100}}"
                                            data-buttontext="Pay {{$Service->price}} INR"
                                            data-name="AskReview"
                                            data-description="Rozerpay"
                                            data-image="https://askreview.in/frontend/images/logo.jpg"
                                            data-prefill.name="name"
                                            data-prefill.email="email"
                                            data-theme.color="#ff7529">
                                        </script>
                                    </div>
                                </div>

                                
                            </form>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

