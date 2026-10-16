<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/minisidebar/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Jul 2023 05:22:23 GMT -->
<head>

  <!-- Title -->

  <title>Admin</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Required Meta Tag -->

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="handheldfriendly" content="true" />
  <meta name="MobileOptimized" content="width" />
  <meta name="description" content="Admin" />
  <meta name="author" content="" />
  <meta name="keywords" content="Admin" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />


  <!-- Favicon -->

  <link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet">


  <!-- Core Css -->

  <link rel="stylesheet" href="{{asset('adminAssets/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}">

  <link rel="stylesheet" href="{{asset('adminAssets/css/style.min.css')}}" />
  
  {{-- <link rel="stylesheet" href="{{asset('adminAssets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('adminAssets/css/my-style.css')}}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Include HTML2Canvas library -->
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <style>
    /* Your regular styles go here */

    @media print {
        body {
            -webkit-print-color-adjust: exact; /* For Webkit browsers like Chrome and Safari */
            color-adjust: exact; /* Standard property */
        }
        @page {
                size: portrait; /* or specify the desired size */
                margin: 10mm;
            }
    }

    * {
    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari 6 – 15.3, Edge */
    color-adjust: exact !important;                 /* Firefox 48 – 96 */
    print-color-adjust: exact !important;           /* Firefox 97+, Safari 15.4+ */
}
</style>
</head>

<body>@php
    $currentStyle = $style ?? (Auth::user()->qr_style ?? 'style1');
    $url = URL::to("u/".Auth::user()->name_url);
@endphp

<div class="container-fluid py-3">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center d-flex align-items-center justify-content-center gap-2 flex-wrap">
              <a href="{{URL::to('admin/view_qr?style='.$currentStyle)}}" class="btn btn-secondary my-2 float-center" style="font-size: 16px"><i class="fa-solid fa-arrow-left"></i> Back</a>
              
              <div class="btn-group my-2" role="group">
                  <a href="{{ URL::to('admin/print_qr_code?style=style1') }}" class="btn btn-sm {{ $currentStyle === 'style1' ? 'btn-primary active fw-bold' : 'btn-outline-primary' }}">
                      Option 1
                  </a>
                  @if(!empty($has_double_qr))
                      <a href="{{ URL::to('admin/print_qr_code?style=style2') }}" class="btn btn-sm {{ $currentStyle === 'style2' ? 'btn-primary active fw-bold' : 'btn-outline-primary' }}">
                          Option 2 <span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem; padding: 2px 5px;"><i class="fa fa-crown"></i> PRO</span>
                      </a>
                  @endif
              </div>

              <a href="#" onclick="printDiv('qr_box')" class="btn btn-success my-2 float-center" style="font-size: 16px"><i class="fa-solid fa-print"></i> Print Standee</a>
        </div>
        <div class="col-md-3"></div>
    </div>

    <div class="row my-4">
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4">
            @if($currentStyle === 'style2')
                <!-- STYLE 2: EXECUTIVE ACRYLIC STANDEE PRINT WITH LUXURY MESH BG & CENTER LOGO QR -->
                <div class="qr_box_modern" id="qr_box" style="position: relative; text-align: center; background-color: #ffffff !important; border-radius: 20px; border: 2px solid #cbd5e1; overflow: hidden; color: #0f172a !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important;">
                    <!-- Luxury Standee Background Image (renders in all print dialogs) -->
                    <img src="{{ asset('frontend/images/qr_standee_luxury.jpg') }}" alt="Standee Background" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; pointer-events: none; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important;">

                    <!-- Content Layer -->
                    <div style="position: relative; z-index: 1; display: flex; flex-direction: column; min-height: 600px;">
                        <!-- Top Google Accent Bar -->
                        <div style="background: linear-gradient(90deg, #4285F4 25%, #EA4335 25% 50%, #FBBC05 50% 75%, #34A853 75% 100%) !important; height: 6px; -webkit-print-color-adjust: exact !important;"></div>
                        
                        <!-- Header Section -->
                        <div style="padding: 22px 20px 6px 20px;">
                            <!-- Google Reviews Header Pill -->
                            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255, 255, 255, 0.95) !important; padding: 6px 16px; border-radius: 30px; border: 1.5px solid #e2e8f0; margin-bottom: 8px; -webkit-print-color-adjust: exact !important;">
                                <svg width="18" height="18" viewBox="0 0 24 24" style="vertical-align: middle;">
                                    <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.36 24 12 24z"/>
                                    <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.14-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.99 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                    <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.36 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                                </svg>
                                <span style="font-weight: 800; font-size: 13px; color: #1e293b !important; letter-spacing: 0.3px; -webkit-print-color-adjust: exact !important;">Google Reviews</span>
                                <div style="color: #f59e0b !important; font-size: 13px; display: inline-flex; gap: 2px; -webkit-print-color-adjust: exact !important;">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </div>
                            </div>

                            <h2 style="color: #0f172a !important; font-weight: 900; font-size: 24px; letter-spacing: 0.8px; text-transform: uppercase; margin: 4px 0 2px 0; line-height: 1.2;">
                                Review Us On Google
                            </h2>

                            <div style="margin-top: 4px; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
                                <span style="color: #1d4ed8 !important; font-weight: 800; font-size: 18px; letter-spacing: 0.2px;">{{ Auth::user()->name }}</span>
                                <span style="color: #2563eb !important; font-size: 16px;" title="Verified Business"><i class="fa-solid fa-circle-check"></i></span>
                            </div>

                            <p style="color: #64748b !important; font-size: 13px; margin: 3px 0 12px 0; font-weight: 600;">
                                Your 5-star review helps our business grow!
                            </p>
                        </div>

                        <!-- Elevated QR Code Plaque -->
                        <div style="margin: 0 auto;">
                            <div style="display: inline-block; background: #ffffff !important; padding: 15px 15px 12px 15px; border-radius: 22px; border: 2px solid #f1f5f9; text-align: center; -webkit-print-color-adjust: exact !important;">
                                <div class="qr_code_frame" style="position: relative; display: inline-block; line-height: 0;">
                                    {!! QrCode::size(210)->errorCorrection('H')->generate($url."?from=qr") !!}
                                    @if(!empty(Auth::user()->logo))
                                        <div class="qr_center_logo" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 56px; height: 56px; background: #ffffff !important; border-radius: 14px; padding: 5px; display: flex; align-items: center; justify-content: center; border: 2.5px solid #ffffff !important; overflow: hidden; z-index: 2; -webkit-print-color-adjust: exact !important;">
                                            <img src="{{ Auth::user()->logo }}" alt="{{ Auth::user()->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain; border-radius: 8px;">
                                        </div>
                                    @endif
                                </div>
                                <div style="display: flex; align-items: center; justify-content: center; gap: 6px; margin-top: 10px; color: #1e293b !important; font-weight: 700; font-size: 13px; -webkit-print-color-adjust: exact !important;">
                                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 50%; background: #eff6ff !important; color: #2563eb !important; font-size: 11px; -webkit-print-color-adjust: exact !important;">
                                        <i class="fa fa-camera"></i>
                                    </span>
                                    <span>Point camera & tap link to review</span>
                                </div>
                            </div>
                        </div>

                        <!-- NFC & Contactless Feature Pill -->
                        <div style="margin: 12px auto 6px auto; display: inline-flex; align-items: center; gap: 8px; background: rgba(255, 255, 255, 0.9) !important; padding: 5px 16px; border-radius: 30px; border: 1.5px solid #e2e8f0; -webkit-print-color-adjust: exact !important;">
                            <span style="color: #0284c7 !important; font-size: 14px;"><i class="fa fa-wifi" style="transform: rotate(90deg);"></i></span>
                            <span style="font-size: 12px; font-weight: 700; color: #334155 !important;">NFC Tap & QR Code Supported</span>
                        </div>

                        <!-- Google Review Rating Badge -->
                        <div style="margin: 4px auto 12px auto;">
                            <img src="{{ asset('frontend/images/gog_rev.png') }}" alt="Google Reviews" style="height: 50px;">
                        </div>

                        <!-- Footer Verified & Powered By -->
                        <div style="margin-top: auto; padding: 12px 20px; background: rgba(255, 255, 255, 0.9) !important; border-top: 1px solid rgba(226, 232, 240, 0.8); display: flex; align-items: center; justify-content: space-between; -webkit-print-color-adjust: exact !important;">
                            <div style="display: flex; align-items: center; gap: 6px; color: #64748b !important; font-size: 12px; font-weight: 700; -webkit-print-color-adjust: exact !important;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 22px; height: 22px; border-radius: 50%; background: #e0f2fe !important; color: #0284c7 !important; font-size: 10px; -webkit-print-color-adjust: exact !important;">
                                    <i class="fa fa-shield-halved"></i>
                                </span>
                                <span>Verified Review Standee</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <span style="color: #94a3b8 !important; font-size: 11px; text-transform: uppercase; font-weight: 600;">Powered by</span>
                                <img src="{{ asset('frontend/images/ask.png') }}" alt="AskReview" style="height: 22px;">
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <!-- STYLE 1: CLASSIC BLUE CURVE STANDEE PRINT -->
                <div style="text-align: center; border: 1px solid black;" class="qr_box" id="qr_box">
                    <div style="background-image:url('{{asset('frontend/images/qr_back.jpg')}}'); background-color: #ffffff;">
                        <div class="qr_text_section" style="height: 110px; text-align: center; align-items: center; justify-content: center; display: flex; background-color: #3074f1 !important; color: white !important; border-radius: 0px 0px 100% 100%; padding: 50px; -webkit-print-color-adjust: exact !important;">
                            <h2 style="font-weight: 800; font-size: 35px; margin-top: 10px; color: white !important;">Tell Us About Your Experience</h2>
                        </div>
                        <div class="qr_logo_section my-4" style="height: 180px;">
                            <img src="{{Auth::user()->logo}}" alt="">
                        </div>
                        <div class="qr_section">
                            {!! QrCode::size(200)->generate($url."?from=qr") !!}
                        </div>
                        <div class="qr_desc_section my-4" style="padding: 0px 50px 0px 50px;">
                            <h2>
                                <b> Scan the QR Code to leave us a Review on </b>
                            </h2>
                        </div>
                        <div class="qr_desc_google my-4" style="height: 91px;">
                            <img src="{{asset('frontend/images/gog_rev.png')}}" alt="" style="height: 80px; width: 55%;">
                        </div>
                        <div class="qr_desc_power_by" style="margin-top:0.7rem; height: 23px;">
                            <img src="{{asset('frontend/images/power_by.png')}}" style="height: 20px;" alt="">
                            <img src="{{asset('frontend/images/ask.png')}}" style="height: 29px;" alt="">
                        </div>
                        <div class="yellow_box" style="height: 5px; background-color: yellow !important; -webkit-print-color-adjust: exact !important;"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>



  <!-- Customizer -->
  <!-- Import Js Files -->
  <script src="{{asset('adminAssets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('adminAssets/libs/simplebar/dist/simplebar.min.js')}}"></script>
  <script src="{{asset('adminAssets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!-- core files -->
  <script src="{{asset('adminAssets/js/app.min.js')}}"></script>
  <script src="{{asset('adminAssets/js/app.minisidebar.init.js')}}"></script>
  <script src="{{asset('adminAssets/js/app-style-switcher.js')}}"></script>
  <script src="{{asset('adminAssets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('adminAssets/js/custom.js')}}"></script>
  <!-- current page js files -->
  <script src="{{asset('adminAssets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('adminAssets/js/dashboard4.js')}}"></script>
  {{-- <script src="{{asset('adminAssets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script> --}}

  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Toastr -->

  
  <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
 


  @yield('js')


  <script>
    @if(Session::has('messege'))
    var type = "{{Session::get('alert-type','info')}}";
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('messege')}}");
            bresk;
        case 'success':
            toastr.success("{{Session::get('messege')}}");
            bresk;
        case 'worning':
            toastr.worning("{{Session::get('messege')}}");
            bresk;
        case 'error':
            toastr.error("{{Session::get('messege')}}");
            bresk;
    }
    @endif


    
    function dataDelete(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute(
            'href'
            ); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Are you sure",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = urlToRedirect;
            } else {
                return false;
            }
        });
    }
  </script>

<script>
    function printDiv(tagid) {
        var hashid = "#"+ tagid;
        var tagname =  $(hashid).prop("tagName").toLowerCase() ;
        var attributes = ""; 
        var attrs = document.getElementById(tagid).attributes;
          $.each(attrs,function(i,elem){
            attributes +=  " "+  elem.name+" ='"+elem.value+"' " ;
          })
        var divToPrint= $(hashid).html() ;
        console.log(divToPrint);
        var head = "<html><head>" + $("head").html() +
    // Add a @page CSS rule for portrait mode
    "<style>@page { size: portrait; }</style>" +
    "</head>";
        var allcontent = head + "<body  onload='window.print()' ><div   style='width: 100%;display:flex'><div   style='width: 20%'></div><div   style='width: 60%'>"+ "<" + tagname + attributes + ">" +  divToPrint + "</" + tagname + ">" +  "</div><div   style='width: 20%'></div></div></body></html>"  ;
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write(allcontent);
        newWin.document.close();
       // setTimeout(function(){newWin.close();},10);
    }
</script>


</body>


<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/minisidebar/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Jul 2023 05:22:25 GMT -->
</html>

