<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="referrer" content="never">
    <meta name="referrer" content="no-referrer">
    <meta property="og:type" content="website">
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="theme-color" content="#6777ef"/>
<link rel="apple-touch-icon" href="{{ asset('frontend/images/logo.jpg') }}">
<!--<link rel="manifest" href="{{ asset('/manifest.json') }}">-->
  <link rel="manifest" href="{{ url('/manifest/' . $user_name . '.json') }}">


    <link rel="icon" type="image/png" sizes="200x200" href="{{$user->logo}}">
    <title>{{$user->name}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('frontend/css/my-style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    
</head>
<body>
   <!-- Loader -->
   <div class="text-center mb-3" id="loader">
    <i class="fas fa-spinner fa-spin fa-3x"  style="color:#f52e2e;"></i>
    <h3 style="color: white">Please wait we are uploading the file...</h3>
</div>
 
  <div class="container-fluid feedback">
    <div class="row">

      <div class="col-sm-12 col-md-6 text-center left_box" @if($user->default_background == 'No') style="background-color: {{$user->background_color}};display: flex
;
    justify-content: center;
    align-items: center;" @else style="display: flex
;
    justify-content: center;
    align-items: center;" @endif >
        <div class="card shadow-lg text-center p-4">
            <div class="card-body">
                <div class="mb-3">
                    <i class="fa fa-check-circle text-success" style="font-size: 3rem;"></i>
                </div>
                <h5 class="card-title fw-bold">Review submitted successfully.</h5>
                <p class="card-text text-muted">Sorry for all kinds of inconvenience caused.</p>
                <a href="{{url('/u/'.$user_name.'')}}"><button class="btn btn-sm btn-primary">Back to Home</button></a>
            </div>
        </div>
        </div>
      
    <div class="col-sm-12 col-md-6 img_sec" style="">
      <div class="backgroung_img" @if ($user->background_image != '') style="background-image:url({{$user->background_image}})" @else style="background-image:url({{asset('frontend/images/background.jpg')}})"> @endif

      </div>
    </div>
  </div>

  
</div>


<!-- Overlay -->
<div class="overlay"></div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>



<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Toastr -->
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

</body>
</html>