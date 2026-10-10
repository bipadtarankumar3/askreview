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
                <!-- STYLE 2: MODERN DARK ACRYLIC STANDEE PRINT -->
                <div class="qr_box_modern" id="qr_box" style="text-align: center; background: #090d16 !important; border-radius: 20px; border: 2px solid #334155; overflow: hidden; color: #ffffff !important; position: relative; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important;">
                    <!-- Top Gradient Accent -->
                    <div style="background: linear-gradient(90deg, #e11d48 0%, #7c3aed 50%, #2563eb 100%) !important; height: 8px; -webkit-print-color-adjust: exact !important;"></div>
                    
                    <!-- Header -->
                    <div style="padding: 24px 20px 14px 20px;">
                        <div style="display: inline-flex; align-items: center; gap: 4px; color: #fbbf24 !important; font-size: 22px; margin-bottom: 6px; -webkit-print-color-adjust: exact !important;">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                        </div>
                        <h2 style="color: #ffffff !important; font-weight: 900; font-size: 26px; letter-spacing: 1.5px; text-transform: uppercase; margin: 0; line-height: 1.2;">
                            Review Us On Google
                        </h2>
                        <p style="color: #94a3b8 !important; font-size: 13px; margin: 5px 0 0 0; font-weight: 500;">
                            Your 5-star review helps our business grow!
                        </p>
                    </div>

                    <!-- Business Logo -->
                    <div style="margin: 6px auto; width: 130px; height: 130px; border-radius: 20px; background: #ffffff !important; padding: 10px; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255,255,255,0.2); -webkit-print-color-adjust: exact !important;">
                        <img src="{{ Auth::user()->logo }}" alt="{{ Auth::user()->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                    
                    <div style="margin-top: 8px; margin-bottom: 10px;">
                        <span style="color: #f8fafc !important; font-weight: 700; font-size: 16px;">{{ Auth::user()->name }}</span>
                    </div>

                    <!-- Framed QR Code -->
                    <div style="background: #ffffff !important; margin: 10px 30px 15px 30px; padding: 18px; border-radius: 20px; text-align: center; -webkit-print-color-adjust: exact !important;">
                        {!! QrCode::size(210)->generate($url."?from=qr") !!}
                        <div style="display: flex; align-items: center; justify-content: center; gap: 6px; margin-top: 10px; color: #0f172a !important; font-weight: 700; font-size: 13px;">
                            <i class="fa fa-camera text-primary"></i>
                            <span>Point camera & tap the link</span>
                        </div>
                    </div>

                    <!-- Google Review Badge -->
                    <div style="padding: 6px 20px 14px 20px;">
                        <img src="{{ asset('frontend/images/gog_rev.png') }}" alt="Google Reviews" style="height: 60px;">
                    </div>

                    <!-- Footer NFC & Powered By -->
                    <div style="padding: 14px 20px; background: #0f172a !important; border-top: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: space-between; -webkit-print-color-adjust: exact !important;">
                        <div style="display: flex; align-items: center; gap: 6px; color: #94a3b8 !important; font-size: 12px; font-weight: 600;">
                            <i class="fa fa-wifi" style="transform: rotate(90deg); color: #38bdf8 !important;"></i>
                            <span>Touch-Free Review</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 4px;">
                            <span style="color: #64748b !important; font-size: 11px; text-transform: uppercase;">Powered by</span>
                            <img src="{{ asset('frontend/images/ask.png') }}" alt="AskReview" style="height: 22px;">
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

