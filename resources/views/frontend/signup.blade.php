<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/minisidebar/authentication-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Jul 2023 05:23:45 GMT -->
<head>
    <!-- Title -->
    <title>{{$user->name}} | Google review management in Delhi, Kolkata, Bangalore India</title>
    <!-- Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Login" />
    <meta name="author" content="" />
    <meta name="keywords" content="Login" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('frontend/images/logo.jpg')}}" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('adminAssets/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}">
    <!-- Core Css -->
    <link rel="stylesheet" href="{{asset('adminAssets/css/style.min.css')}}" />
    <link rel="stylesheet" href="{{asset('adminAssets/css/my-style.css')}}" />
      
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet">

  </head>
  <body>

    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <div class="position-relative overflow-hidden radial-gradient min-vh-100">
        <div class="position-relative z-index-5">
          <div class="row">
            <div class="col-xl-7 col-xxl-8">
              <a href="index.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                {{-- <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg" width="180" alt=""> --}}
              </a>
              <div class="d-none d-xl-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
                <img src="{{asset('frontend/images/user_feedback.jpg')}}" alt="" class="img-fluid" width="500">
              </div>
            </div>
            <div class="col-xl-5 col-xxl-4">
              <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                <div class="col-sm-8 col-md-6 col-xl-9">
                  <h2 class="mb-3 fs-7 fw-bolder">Welcome </h2>
                  <p class=" mb-9">Login To Access Your Dashboard</p>
                  
                  <form method="POST" action="{{URL::to('singup_post')}}"  onsubmit="return validatePassword();">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="mb-3">
                      <label for="Name" class="form-label">Business Name</label>
                      <input type="text" name="name" class="form-control" id="Name" aria-describedby="emailHelp" required>
                    </div>
                    {{-- <div class="mb-3">
                      <label for="name_url" class="form-label">Username</label>
                      <input type="text" name="name_url" class="form-control" id="name_url" aria-describedby="emailHelp" required>
                    </div> --}}
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                      <label for="phone" class="form-label">Whatsapp Number</label>
                      <input type="number" name="phone" class="form-control" id="phone" aria-describedby="phoneHelp" required>
                    </div>
                    <div class="mb-4">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" pattern="\d{6,}"
                      title="Please enter at least 8 digits" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-4">
                      <label for="confirm_password" class="form-label">Confirm Password</label>
                      <input type="password" name="confirm_password" class="form-control" pattern="\d{6,}"
                      title="Please enter at least 8 digits" id="confirm_password" required>
                      <small id="password_error" class="text-danger" style="display:none;">Passwords do not match!</small>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between mb-4">
                      <div class="form-check">
                        <input class="form-check-input primary" name="accept" type="checkbox" value="" id="flexCheckChecked" required>
                        <label class="form-check-label text-dark" for="flexCheckChecked">
                            Accept Terms & Condition.
                        </label>
                      </div>
                      <a class="text-primary fw-medium" href="{{URL::to('/')}}">Already User?</a>
                    </div> 
                    <button type="submit" id="signupButton"  class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign Up</button>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    
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
    <script src="{{asset('adminAssets/libs/owl.carousel/dist/owl.carousel.min.js')}}"></script>
    

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

  </script>

<script>
  // Function to validate password and confirm password fields
  function validatePassword() {
    var password = document.getElementById("exampleInputPassword1").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    var passwordError = document.getElementById("password_error");
    const signupButton = document.getElementById('signupButton');

    // Check if the passwords match
    if (password != confirmPassword) {
      passwordError.style.display = "block";
      return false;
    }
    passwordError.style.display = "none";



    // Disable the submit button
    signupButton.disabled = true;
    signupButton.innerText = 'Processing...';

    return true;
  }
</script>



  </body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/minisidebar/authentication-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Jul 2023 05:23:45 GMT -->
</html>