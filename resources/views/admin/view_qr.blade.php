@extends('adminLayouts.home')
@section('content')

@php
    $currentStyle = $style ?? (Auth::user()->qr_style ?? 'style1');
    $url = URL::to("u/".Auth::user()->name_url);
@endphp

<div class="container-fluid py-3">
    <!-- Top Bar Controls -->
    <div class="row mb-3">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card p-3 shadow-sm border-0 rounded-3 d-flex flex-row align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ URL::to('admin/qr_analytics') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="fa fa-arrow-left me-1"></i> Back to Analytics
                    </a>
                    <span class="fw-bold text-dark fs-5 ms-2">QR Standee Preview</span>
                </div>
                
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <!-- Option Switcher Tabs -->
                    <div class="btn-group" role="group">
                        <a href="{{ URL::to('admin/view_qr?style=style1') }}" class="btn btn-sm {{ $currentStyle === 'style1' ? 'btn-primary active fw-bold' : 'btn-outline-primary' }}">
                            <i class="ti ti-qrcode me-1"></i> Option 1
                        </a>
                        @if(!empty($has_double_qr))
                            <a href="{{ URL::to('admin/view_qr?style=style2') }}" class="btn btn-sm {{ $currentStyle === 'style2' ? 'btn-primary active fw-bold' : 'btn-outline-primary' }}">
                                <i class="fa fa-crown text-warning me-1"></i> Option 2 <span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem; padding: 2px 5px;">PRO</span>
                            </a>
                        @else
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="alert('Option 2 is an exclusive Premium Plan feature. Please upgrade to unlock.')" title="Upgrade to Premium">
                                <i class="fa fa-lock text-warning me-1"></i> Option 2 (Locked)
                            </button>
                        @endif
                    </div>

                    @if((Auth::user()->qr_style ?? 'style1') !== $currentStyle)
                        <button type="button" class="btn btn-warning btn-sm fw-bold shadow-sm" onclick="activateCurrentStyle('{{ $currentStyle }}')">
                            <i class="fa fa-check me-1"></i> Make {{ $currentStyle === 'style2' ? 'Option 2' : 'Option 1' }} Active
                        </button>
                    @else
                        <span class="badge bg-success py-2 px-3 rounded-pill fw-bold">
                            <i class="fa fa-check-circle me-1"></i> {{ $currentStyle === 'style2' ? 'Option 2' : 'Option 1' }} Active
                        </span>
                    @endif

                    <a href="{{ URL::to('admin/print_qr_code?style='.$currentStyle) }}" class="btn btn-success btn-sm fw-bold px-3 shadow-sm">
                        <i class="fa-solid fa-download me-1"></i> Download PDF / Print
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Standee Display Section -->
    <div class="row">
        <div class="col-12 col-md-5 col-lg-4 mx-auto text-center">

            @if($currentStyle === 'style2')
                <!-- STYLE 2: MODERN ACRYLIC STANDEE -->
                <div class="qr_box_modern shadow-lg" id="qr_box" style="position: relative; background-color: #ffffff; border-radius: 26px; border: 2px solid #e2e8f0; overflow: hidden; color: #0f172a; text-align: center; box-shadow: 0 20px 45px rgba(0,0,0,0.12);">
                    <!-- Standee Background Image -->
                    <img src="{{ asset('frontend/images/qr_standee_bg.jpg') }}" alt="Standee Background" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; pointer-events: none;">

                    <!-- Content Layer -->
                    <div style="position: relative; z-index: 1; display: flex; flex-direction: column; min-height: 580px;">
                        <!-- Top Google Gradient Ribbon -->
                        <div style="background: linear-gradient(90deg, #4285F4 0%, #EA4335 33%, #FBBC05 66%, #34A853 100%); height: 8px;"></div>
                        
                        <!-- Header Section -->
                        <div style="padding: 22px 20px 6px 20px;">
                            <!-- 5 Stars -->
                            <div style="display: inline-flex; align-items: center; justify-content: center; gap: 5px; color: #f59e0b; font-size: 24px; margin-bottom: 4px;">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>

                            <!-- Title -->
                            <h2 style="color: #0b132b; font-weight: 900; font-size: 26px; letter-spacing: 1px; text-transform: uppercase; margin: 2px 0 0 0; line-height: 1.2;">
                                Review Us On Google
                            </h2>

                            <!-- Store Name -->
                            <div style="margin-top: 4px;">
                                <span style="color: #1a56db; font-weight: 800; font-size: 19px; letter-spacing: 0.2px;">{{ Auth::user()->name }}</span>
                            </div>

                            <!-- Subtitle -->
                            <p style="color: #475569; font-size: 13.5px; margin: 4px 0 0 0; font-weight: 600;">
                                Your 5-star review helps our business grow!
                            </p>
                        </div>

                        <!-- White Framed QR Code Card -->
                        <div style="background: #ffffff; margin: 12px 24px 14px 24px; padding: 22px 18px 16px 18px; border-radius: 26px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1.5px solid rgba(255, 255, 255, 0.9);">
                            <div class="qr_code_frame" style="position: relative; display: inline-block; line-height: 0;">
                                {!! QrCode::size(215)->errorCorrection('H')->generate($url."?from=qr") !!}
                                @if(!empty(Auth::user()->logo))
                                    <div class="qr_center_logo" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 52px; height: 52px; background: #ffffff; border-radius: 12px; padding: 4px; box-shadow: 0 4px 14px rgba(0,0,0,0.18); display: flex; align-items: center; justify-content: center; border: 2.5px solid #ffffff; overflow: hidden; z-index: 2;">
                                        <img src="{{ Auth::user()->logo }}" alt="{{ Auth::user()->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 6px;">
                                    </div>
                                @endif
                            </div>
                            <div style="display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 12px; color: #0f172a; font-weight: 700; font-size: 13.5px;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 50%; background: #eff6ff; color: #2563eb; font-size: 11px;">
                                    <i class="fa fa-camera"></i>
                                </span>
                                <span>Point camera & tap the link</span>
                            </div>
                        </div>

                        <!-- Google Review Badge -->
                        <div style="padding: 2px 20px 14px 20px;">
                            <img src="{{ asset('frontend/images/gog_rev.png') }}" alt="Google Reviews" style="height: 58px; filter: drop-shadow(0 3px 8px rgba(0,0,0,0.08));">
                        </div>

                        <!-- Footer Bar -->
                        <div style="margin-top: auto; padding: 13px 20px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(8px); border-top: 1px solid rgba(226, 232, 240, 0.85); display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center; gap: 7px; color: #1e293b; font-size: 12.5px; font-weight: 700;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 50%; background: #e0f2fe; color: #0284c7; font-size: 11px;">
                                    <i class="fa fa-wifi" style="transform: rotate(90deg);"></i>
                                </span>
                                <span>Touch-Free Review</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <span style="color: #64748b; font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Powered by</span>
                                <img src="{{ asset('frontend/images/ask.png') }}" alt="AskReview" style="height: 22px;">
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <!-- STYLE 1: CLASSIC BLUE CURVE STANDEE -->
                <div class="qr_box shadow-lg" id="qr_box" style="background-image:url('{{asset('frontend/images/qr_back.jpg')}}'); border-radius: 12px; overflow: hidden; border: 1px solid #cbd5e1;">
                    <div class="qr_text_section" style="background-color: #3074f1; border-radius: 0px 0px 100% 100%; padding: 35px 20px;">
                        <h2 style="font-weight: 800; font-size: 32px; color: white; margin-top: 10px;">Tell Us About Your Experience</h2>
                    </div>
                    <div class="qr_logo_section my-4" style="height: 160px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{Auth::user()->logo}}" alt="{{ Auth::user()->name }}" style="max-height: 100%; max-width: 80%; object-fit: contain;">
                    </div>
                    <div class="qr_section my-3">
                        {!! QrCode::size(210)->generate($url."?from=qr") !!}
                    </div>
                    <div class="qr_desc_section my-3">
                        <h2 style="font-size: 20px; font-weight: 800; color: #1e293b;">
                            Scan the QR Code to leave us a Review on
                        </h2>
                    </div>
                    <div class="qr_desc_google my-3">
                        <img src="{{asset('frontend/images/gog_rev.png')}}" alt="Google Reviews" style="height: 65px; width: auto;">
                    </div>
                    <div class="qr_desc_power_by">
                        <img src="{{asset('frontend/images/power_by.png')}}" class="power_by" alt="Powered By">
                        <img src="{{asset('frontend/images/ask.png')}}" class="logo" alt="AskReview">
                    </div>
                    <div class="yellow_box" style="height: 6px; background-color: #facc15;"></div>
                </div>
            @endif

        </div>
    </div>
</div>


@endsection

@section('js')
    <script>
        function activateCurrentStyle(style) {
            $.ajax({
                url: "{{ URL::to('admin/activate_qr_style') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    style: style
                },
                success: function(res) {
                    if (res.status === 'success') {
                        toastr.success(res.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 600);
                    }
                },
                error: function(xhr) {
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Error activating design';
                    toastr.error(msg);
                }
            });
        }

        function printDiv(tagid) {
            var hashid = "#"+ tagid;
            var tagname =  $(hashid).prop("tagName").toLowerCase() ;
            var attributes = ""; 
            var attrs = document.getElementById(tagid).attributes;
              $.each(attrs,function(i,elem){
                attributes +=  " "+  elem.name+" ='"+elem.value+"' " ;
              })
            var divToPrint= $(hashid).html() ;
            var head = "<html><head>" + $("head").html() +
        // Add a @page CSS rule for portrait mode
        "<style>@page { size: portrait; }</style>" +
        "</head>";
            var allcontent = head + "<body  onload='window.print()' >"+ "<" + tagname + attributes + ">" +  divToPrint + "</" + tagname + ">" +  "</body></html>"  ;
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write(allcontent);
            newWin.document.close();
           // setTimeout(function(){newWin.close();},10);
        }
    </script>
@endsection