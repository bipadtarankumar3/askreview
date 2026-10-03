@extends('adminLayouts.home')
@section('content')

<style>
    .razorpay-payment-button {
        width: 100%;
        padding: 13px 24px;
        border-radius: 12px;
        border: none;
        background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
        color: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        box-shadow: 0 4px 14px rgba(225, 29, 72, 0.35);
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .razorpay-payment-button:hover {
        background: linear-gradient(135deg, #be123c 0%, #9f1239 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(225, 29, 72, 0.4);
    }
</style>

<div class="container-fluid py-3">
    <!-- Breadcrumb / Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-800 mb-1" style="color: #0f172a; font-family: 'Plus Jakarta Sans', sans-serif;">Complete Your Subscription</h4>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">Review your selected plan and finalize your secure payment.</p>
        </div>
        <div>
            <a href="{{ URL::to('admin/user_payments_list') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2" style="border-radius: 10px; font-size: 0.85rem; font-weight: 600;">
                <i class="ti ti-receipt"></i>
                <span>Payment History</span>
            </a>
        </div>
    </div>

    @php
        $years = (!empty($Service->subscription_date) && is_numeric($Service->subscription_date)) ? (int)$Service->subscription_date : 1;
        $durationText = $years > 1 ? $years . ' Years' : '1 Year';
        $gstPercentage = 18;
        $gstAmount = round(($Service->price * $gstPercentage) / 100, 2);
        $grandTotal = $Service->price + $gstAmount;
    @endphp

    <div class="row g-4">
        <!-- Left: Selected Plan Overview -->
        <div class="col-lg-6">
            <div class="card border-0 h-100" style="border-radius: 20px; border: 1.5px solid #e2e8f0; box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.08); background: #ffffff;">
                <div class="card-body p-4 p-md-5 d-flex flex-column">
                    
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span style="background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3; font-weight: 800; font-size: 0.74rem; padding: 4px 12px; border-radius: 9999px; text-transform: uppercase;">
                            Selected Plan
                        </span>
                        <span class="badge" style="background: #f1f5f9; color: #475569; font-weight: 700; font-size: 0.78rem; padding: 6px 12px; border-radius: 8px;">
                            {{ $durationText }} Validity
                        </span>
                    </div>

                    <h2 style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; color: #0f172a; font-size: 1.75rem; margin-bottom: 8px;">
                        {{ $Service->title }}
                    </h2>

                    <!-- Price Block -->
                    <div class="d-flex align-items-baseline gap-1 my-3 p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                        <span style="font-size: 1.4rem; font-weight: 700; color: #0f172a;">₹</span>
                        <span style="font-size: 2.5rem; font-weight: 800; color: #0f172a; font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.02em;">
                            {{ number_format($Service->price) }}
                        </span>
                        <span style="color: #64748b; font-size: 0.9rem; font-weight: 600;">/ {{ $durationText }} (+18% GST)</span>
                    </div>

                    <!-- Included Features -->
                    <div class="my-3 flex-grow-1">
                        <div class="text-uppercase fw-700 mb-3" style="font-size: 0.75rem; letter-spacing: 0.05em; color: #64748b;">What's Included:</div>
                        <ul class="list-unstyled d-flex flex-column gap-2 mb-0" style="font-size: 0.9rem; color: #334155;">
                            <li class="d-flex align-items-start gap-2">
                                <span style="color: #10b981; font-size: 1.1rem; line-height: 1;"><i class="ti ti-circle-check-filled"></i></span>
                                <span>Link social media platforms (Facebook, Instagram, YouTube)</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span style="color: #10b981; font-size: 1.1rem; line-height: 1;"><i class="ti ti-circle-check-filled"></i></span>
                                <span>Generate unlimited custom-branded QR codes</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span style="color: #10b981; font-size: 1.1rem; line-height: 1;"><i class="ti ti-circle-check-filled"></i></span>
                                <span>Direct Google Business Profile integration</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span style="color: #10b981; font-size: 1.1rem; line-height: 1;"><i class="ti ti-circle-check-filled"></i></span>
                                <span>Full <strong>{{ $durationText }}</strong> access starting from purchase date</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span style="color: #10b981; font-size: 1.1rem; line-height: 1;"><i class="ti ti-circle-check-filled"></i></span>
                                <span>Customizable review questions &amp; survey forms</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span style="color: #10b981; font-size: 1.1rem; line-height: 1;"><i class="ti ti-circle-check-filled"></i></span>
                                <span>Private negative review protection filter</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span style="color: #10b981; font-size: 1.1rem; line-height: 1;"><i class="ti ti-circle-check-filled"></i></span>
                                <span>Real-time email and dashboard alerts</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span style="color: #10b981; font-size: 1.1rem; line-height: 1;"><i class="ti ti-circle-check-filled"></i></span>
                                <span>Unlimited QR scans with zero traffic limits</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                @if ($Service->video_access == 'Y')
                                    <span style="color: #16a34a; font-size: 1.1rem; line-height: 1;"><i class="ti ti-video"></i></span>
                                    <span style="color: #15803d; font-weight: 700;">Customer Video Testimonial Collection &amp; Download</span>
                                @else
                                    <span style="color: #94a3b8; font-size: 1.1rem; line-height: 1;"><i class="ti ti-x"></i></span>
                                    <span style="color: #94a3b8; text-decoration: line-through;">Video Testimonials Access</span>
                                @endif
                            </li>
                        </ul>
                    </div>

                    <!-- Change plan button -->
                    <div class="pt-3 border-top mt-auto" style="border-color: #f1f5f9 !important;">
                        <a href="javascript:void(0)" onclick="get_plans()" class="d-inline-flex align-items-center gap-1 text-decoration-none" style="color: #e11d48; font-weight: 700; font-size: 0.85rem;">
                            <i class="ti ti-switch-horizontal"></i>
                            <span>Switch to another plan</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Right: Checkout Details & Razorpay -->
        <div class="col-lg-6">
            <div class="card border-0 h-100" style="border-radius: 20px; border: 1.5px solid #e2e8f0; box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.08); background: #ffffff;">
                <div class="card-body p-4 p-md-5">
                    
                    <h3 style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; color: #0f172a; font-size: 1.4rem; margin-bottom: 20px;">
                        Billing &amp; Payment
                    </h3>

                    <form action="{{ URL::to('admin/user_service_payment_submit') }}" method="POST" id="checkoutForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="business_name" class="form-label fw-600" style="font-size: 0.85rem; color: #334155;">Business / Account Name</label>
                            <input type="text" name="business_name" class="form-control" id="business_name" value="{{ Auth::user()->name }}" required style="border-radius: 10px; height: 44px;">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-600" style="font-size: 0.85rem; color: #334155;">Billing Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ Auth::user()->email }}" required style="border-radius: 10px; height: 44px;">
                        </div>

                        <div class="mb-3">
                            <label for="gst_number" class="form-label fw-600" style="font-size: 0.85rem; color: #334155;">
                                GST Number <span class="text-muted fw-400">(Optional for tax invoice)</span>
                            </label>
                            <input type="text" name="gst_number" class="form-control" id="gst_number" placeholder="e.g. 22AAAAA0000A1Z5" style="border-radius: 10px; height: 44px;">
                        </div>

                        <!-- Address Toggle -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="add_address" onchange="toggleBillAddress()" style="cursor: pointer;">
                            <label class="form-check-label fw-600" for="add_address" style="cursor: pointer; font-size: 0.85rem; color: #475569;">
                                Add detailed billing address
                            </label>
                        </div>

                        <div class="bill_address p-3 mb-3 rounded-3" style="display: none; background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="mb-3">
                                <label for="country" class="form-label fw-600" style="font-size: 0.82rem;">Country</label>
                                <select name="country" id="country" class="form-select" onchange="get_state(this.value)" style="border-radius: 8px;">
                                    <option value="">Select Country</option>
                                    @php
                                        $countries = DB::table('countries')->get();
                                    @endphp
                                    @foreach ($countries as $cn)
                                        <option value="{{ $cn->id }}">{{ $cn->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label fw-600" style="font-size: 0.82rem;">State</label>
                                <select name="state" id="state" class="form-select" style="border-radius: 8px;">
                                    <option value="">Select State</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="addressInput" class="form-label fw-600" style="font-size: 0.82rem;">Street Address</label>
                                <textarea name="address" class="form-control" id="addressInput" rows="2" placeholder="Building, Street, Landmark" style="border-radius: 8px; font-size: 0.85rem;"></textarea>
                            </div>
                        </div>

                        <!-- Price Breakdown Card -->
                        <div class="p-3 rounded-3 mb-4" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="d-flex justify-content-between py-1" style="font-size: 0.88rem; color: #475569;">
                                <span>Plan Amount</span>
                                <span class="fw-600" style="color: #0f172a;">₹ {{ number_format($Service->price, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between py-1" style="font-size: 0.88rem; color: #475569;">
                                <span>GST (18%)</span>
                                <span class="fw-600" style="color: #0f172a;">₹ {{ number_format($gstAmount, 2) }}</span>
                            </div>
                            <hr class="my-2" style="border-color: #e2e8f0;">
                            <div class="d-flex justify-content-between py-1" style="font-size: 1.05rem; font-weight: 800; color: #0f172a;">
                                <span>Total Payable</span>
                                <span style="color: #e11d48; font-family: 'Plus Jakarta Sans', sans-serif;">₹ {{ number_format($grandTotal, 2) }}</span>
                            </div>
                        </div>

                        <input type="hidden" name="gst_amount" value="{{ $gstAmount }}">
                        <input type="hidden" name="grand_total" value="{{ $grandTotal }}">
                        <input type="hidden" name="service_id" value="{{ $Service->id }}">

                        <!-- Razorpay Script Button -->
                        <div class="mb-3">
                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ env('RAZORPAY_KEY') }}"
                                data-amount="{{ $grandTotal * 100 }}"
                                data-buttontext="Pay ₹{{ number_format($grandTotal, 2) }} Securely"
                                data-name="AskReview"
                                data-description="{{ $Service->title }} Subscription"
                                data-image="https://askreview.in/frontend/images/logo.jpg"
                                data-prefill.name="{{ Auth::user()->name }}"
                                data-prefill.email="{{ Auth::user()->email }}"
                                data-theme.color="#e11d48">
                            </script>
                        </div>

                        <!-- Trust Footnote -->
                        <div class="text-center text-muted mt-3" style="font-size: 0.78rem;">
                            <i class="ti ti-shield-check" style="color: #10b981;"></i>
                            <span>Secure 256-Bit SSL Encrypted Checkout via Razorpay</span>
                            <div class="mt-1">
                                Need help? <a href="javascript:void(0)" onclick="get_support()" style="color: #2563eb; font-weight: 600; text-decoration: none;">Contact Support</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
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
        if (!country_id) return;
        $.ajax({
            type: "GET",
            url: "{{ URL::to('admin/get_state') }}?country_id=" + country_id,
            success: function(data) {
                $('#state').html(data);
            } 
        });
    }
</script>
@endsection