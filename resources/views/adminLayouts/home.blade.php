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

  <meta name="theme-color" content="#6777ef"/>
<link rel="apple-touch-icon" href="{{ asset('frontend/images/logo.jpg') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">

  <!-- Favicon -->

  <link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet">


  <!-- Core Css -->

  <link rel="stylesheet" href="{{asset('adminAssets/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}">

  <link rel="stylesheet" href="{{asset('adminAssets/css/style.min.css')}}" />
  
  
  {{-- <link rel="stylesheet" href="{{asset('adminAssets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('adminAssets/css/my-style.css')}}">
  <link rel="stylesheet" href="{{asset('adminAssets/css/responsive.css')}}" />
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
</style>
<style>
  .floating-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #007bff;
        color: #fff;
        padding: 10px;
        border-radius: 50%; /* Make it circular */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        text-align: center; /* Center text horizontally */
        line-height: 1; /* Center text vertically */
        width: 60px; /* Set width and height for a smaller button */
        height: 60px;
        /* display: flex;
      align-items: center;
      justify-content: center; */
    }
  .floating-button i{
        font-size: 30px;
  }

  /* Optional hover effect */
  .floating-button:hover {
      background-color: #0056b3;
  }
</style>


</head>

<body>


  <!-- Body Wrapper -->

  <div class="page-wrapper " id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <div class="">
    <!-- Sidebar Start -->

    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
          <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{URL::to('admin/dashboard')}}" class="text-nowrap logo-img">
              <img src="{{Auth::user()->logo}}" class="dark-logo" width="160" alt="" />
              {{-- <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/light-logo.svg" class="light-logo"  width="180" alt="" /> --}}
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8 text-muted"></i>
            </div>
          </div>
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
              <!-- ============================= -->
              <!-- Home -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Home</span>
              </li>
              <!-- =================== -->
              <!-- Dashboard -->
              <!-- =================== -->

              @if (Auth::user()->type  == 'super_admin')
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/dashboard')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-aperture"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/admin_list')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">Reseller</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/category')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-category-2 text-white" style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">Category</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/template')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">Template</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/wallets_list')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">Credit Manage</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/profile')}}" aria-expanded="false">
                    <span>
                       <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">Setting</span>
                  </a>
                </li>

              @elseif (Auth::user()->type  == 'admin')
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/dashboard')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-aperture"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/sub_user_list')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">User</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/my_wallets_list')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">Credit Transaction</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/service')}}" aria-expanded="false">
                    <span>
                      <i class="fa-regular fa-star"  style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">Services</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/my_user_payment_list')}}" aria-expanded="false">
                    <span>
                      <i class="fa-regular fa-star"  style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">User Payments</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/admin_service_payments_list')}}" aria-expanded="false">
                    <span>
                      <i class="fa-regular fa-star"></i>
                    </span>
                    <span class="hide-menu">Service Payments</span>
                  </a>
                </li>


                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/profile')}}" aria-expanded="false">
                    <span>
                       <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
                    </span>
                    <span class="hide-menu">Setting</span>
                  </a>
                </li>
                    
              @elseif (Auth::user()->type  == 'user')
              <li class="sidebar-item">
                <a class="sidebar-link" href="{{URL::to('admin/dashboard')}}" aria-expanded="false">
                  <span>
                    <i class="fa-solid fa-house"></i>
                  </span>
                  <span class="hide-menu">Dashboard</span>
                </a>
              </li>
              
              
              
              
              
                {{-- <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/form_field')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-caravan"></i>
                    </span>
                    <span class="hide-menu">Form Fields</span>
                  </a>
                </li> --}}
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/questions')}}" aria-expanded="false">
                    <span>
                      <i class="fa-solid fa-comment"></i>
                    </span>
                    <span class="hide-menu">Create FeedBack Form</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/list_question_answers')}}" aria-expanded="false">
                    <span>
                      <i class="fa-solid fa-rss"></i>
                    </span>
                    <span class="hide-menu">FeedBack Data</span>
                  </a>
                </li>
                {{-- <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/review_list')}}" aria-expanded="false">
                    <span>
                      <i class="ti ti-circle-dotted"></i>
                    </span>
                    <span class="hide-menu">Review List</span>
                  </a>
                </li> --}}
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/private_review_list')}}" aria-expanded="false">
                    <span>
                      <i class="fa-solid fa-address-book"></i>
                    </span>
                    <span class="hide-menu">Private Contact Data</span>
                  </a>
                </li>
                
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/social_review_list')}}" aria-expanded="false">
                    <span>
                      <i class="fa-regular fa-star"></i>
                    </span>
                    <span class="hide-menu">Reviews</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/video_testimonial')}}" aria-expanded="false">
                    <span>
                      <i class="fa-solid fa-video"></i>
                    </span>
                    <span class="hide-menu">
                      Video testimonial
                      
                    </span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/user_payments_list')}}" aria-expanded="false">
                    <span>
                      <i class="fa-solid fa-user"></i>
                    </span>
                    <span class="hide-menu">Membership</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/review_links')}}" aria-expanded="false">
                    <span>
                      <i class="fa-solid fa-link"></i>
                    </span>
                    <span class="hide-menu">Integration</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false" data-bs-toggle="collapse" data-bs-target="#analytics-submenu">
                    <span>
                      <i class="fa-solid fa-chart-pie"></i> <!-- Parent Menu Icon -->
                    </span>
                    <span class="hide-menu">Analytics</span>
                    <i class="fa-solid fa-chevron-down ms-auto"></i> <!-- Dropdown Icon -->
                  </a>
                  <ul class="collapse first-level" id="analytics-submenu">
                    <li class="sidebar-item">
                      <a class="sidebar-link" href="{{URL::to('admin/qr_analytics')}}">
                        <span>
                          <i class="fa-solid fa-qrcode"></i> <!-- QR Analytics Icon -->
                        </span>
                        <span class="hide-menu">QR Analytics</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a class="sidebar-link" href="{{URL::to('admin/links_analytics')}}">
                        <span>
                          <i class="fa-solid fa-link"></i> <!-- Links Analytics Icon -->
                        </span>
                        <span class="hide-menu">Links Analytics</span>
                      </a>
                    </li>
                  </ul>
                </li>


                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/profile')}}" aria-expanded="false">
                    <span>
                       <i class="ti ti-user-circle text-white" ></i>
                    </span>
                    <span class="hide-menu">Setting</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="#" onclick="get_support()" aria-expanded="false">
                    <span>
                       <i class="fa-solid fa-headset"></i>
                    </span>
                    <span class="hide-menu" >Need Support?</span>
                  </a>
                </li>
                
              @endif
            </ul>
            
          </nav>
          <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
            <div class="hstack gap-3">
              <div class="john-img">
                <img src="../../dist/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" alt="">
              </div>
              <div class="john-title">
                <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                <span class="fs-2 text-dark">Designer</span>
              </div>
              <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                <i class="ti ti-power fs-6"></i>
              </button>
            </div>
          </div>  
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>

    <!-- Sidebar End -->
    <!-- Main wrapper -->

    <div class="body-wrapper">

      <!-- Header Start -->

      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            
            
          </ul>
         
          <div class="d-block ">
            @if (Auth::user()->type == 'admin')
               <span style="color: red;"> User Balanced : {{Auth::user()->user_create_limit}} </span> 
            @endif

            
            
            {{-- <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg" width="180" alt="" /> --}}
          </div>
          <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
              <i class="ti ti-dots fs-7"></i>
            </span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between">
              {{-- <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                aria-controls="offcanvasWithBothOptions">
                <i class="ti ti-align-justified fs-7"></i>
              </a> --}}
              <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                
                @php
                  $noti_num = DB::table('notifications')->where('user_id',Auth::user()->id)->where('action_taken','!=','Y')->count();
                    $noti_list = DB::table('notifications')->where('user_id',Auth::user()->id)->where('action_taken','!=','Y')->get();
                @endphp

                @if (Auth::user()->type  == 'user')

                  @php
                  // Expiry date
                  $expiry_date = Auth::user()->expiry_date;;
    
                  // Convert expiry date to timestamp
                  $expiry_timestamp = strtotime($expiry_date);
    
                  // Get current timestamp
                  $current_timestamp = time();
    
                  // Calculate difference in seconds between current time and expiry time
                  $difference = $expiry_timestamp - $current_timestamp;
    
                  // Convert difference to days
                  $days_difference = floor($difference / (60 * 60 * 24));
    
    
                  // if ($difference <= 0) {
                  //     echo "Alert: Your expiry date has already passed.";
                  // } elseif ($days_difference <= 30) {
                  //     if ($days_difference == 1) {
                  //         echo "Alert: Your expiry date is approaching. You have $days_difference day left.";
                  //     } else {
                  //         echo "Alert: Your expiry date is approaching. You have $days_difference days left.";
                  //     }
                  // } else {
                  //     echo "You have more than 30 days left until expiry.";
                  // }
    
    
                @endphp
                  @if ($days_difference <= 30)
                    <li class="nav-item dropdown">
                      <a class=" btn btn-warning " title="Buy Plan" onclick="get_plans()" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="true">
                        <i class="fa-solid fa-money-check-dollar"></i> &nbsp; Buy Plan 
                      
                      </a>
                    </li>
                  @endif

                  @if (Auth::user()->seven_day_trial == 'YES' )
                  <li>
                    <li class="nav-item dropdown">
                      <a class=" btn btn-danger " title="Buy Plan" onclick="get_plans()" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="true">
                         7 Days Free Trial
                      
                      </a>
                    </li>
                  </li>
                  @endif

                  <li class="nav-item dropdown">
                    <form action="{{URL::to('admin/star_page_status')}}" method="POST">
                      @csrf
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="star_page" role="switch" id="star_page" @if(Auth::user()->star_page == 'YES')checked @endif  onchange="this.form.submit()">
                        <label class="form-check-label" for="star_page">
                          @if(Auth::user()->star_page == 'YES')
                          <i class="fa-solid fa-star" style="color: gold"></i>  On 
                          
                          @else 
                          <i class="fa-solid fa-star"></i> Off 
                          @endif
                        </label>
                      </div>
                    </form>
                    
                  </li>

                @endif

                <li class="nav-item dropdown">
                  <a class="nav-link nav-icon-hover " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="true">
                    <i class="ti ti-bell-ringing"></i>
                    @if ( $noti_num > 0 )
                        <div class="notification bg-primary rounded-circle"></div>
                    @endif
                    
                  </a>
                  <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up " aria-labelledby="drop2" data-bs-popper="static">
                    <div class="d-flex align-items-center justify-content-between py-3 px-7">
                      <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                      
                      <span class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm">{{$noti_num }} new</span>
                    </div>
                    <div class="message-body simplebar-scrollable-y" data-simplebar="init">
                      <div class="simplebar-wrapper" style="margin: 0px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                          <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                          <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                              <div class="simplebar-content" style="padding: 0px;">

                                @foreach ($noti_list as $item)
                                    <a href="{{URL::to('admin/view_noti/'.$item->id)}}" class="py-6 px-7 d-flex align-items-center dropdown-item">
                                      <span class="me-3">
                                        <img src="{{asset('adminAssets/images/profile/user-1.jpg')}}" alt="user" class="rounded-circle" width="48" height="48">
                                      </span>
                                      <div class="w-75 d-inline-block v-middle">
                                        <h6 class="mb-1 fw-semibold lh-base">{{$item->text}}</h6>
                                        {{-- <span class="fs-2 d-block text-body-secondary">Congratulate him</span> --}}
                                      </div>
                                    </a>
                                @endforeach
                                
                                
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: 360px; height: 432px;"></div>
                      </div>
                      <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                      </div>
                      <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                        <div class="simplebar-scrollbar" style="height: 300px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
                      </div>
                    </div>
                    {{-- <div class="py-6 px-7 mb-1">
                      <button class="btn btn-outline-primary w-100">See All Notifications</button>
                    </div> --}}
                  </div>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                      <div class="user-profile-img">
                        <img src="{{asset('adminAssets/images/profile/user-1.jpg')}}" class="rounded-circle" width="35" height="35"
                          alt="" />
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                    aria-labelledby="drop1">
                    <div class="profile-dropdown position-relative" data-simplebar>
                      <div class="py-3 px-7 pb-0">
                        <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                      </div>
                      <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                        <img src="{{asset('adminAssets/images/profile/user-1.jpg')}}" class="rounded-circle" width="80" height="80"
                          alt="" />
                        <div class="ms-3">
                          <h5 class="mb-1 fs-3">{{Auth::user()->name}}</h5>
                          {{-- <span class="mb-1 d-block text-dark">Designer</span> --}}
                          <p class="mb-0 d-flex text-dark align-items-center gap-2">
                            <i class="ti ti-mail fs-4"></i> {{Auth::user()->email}}
                          </p>
                        </div>
                      </div>
                      {{-- <div class="message-body">
                        <a href="{{URL::to('admin/profile')}}" class="py-8 px-7 mt-8 d-flex align-items-center">
                          <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-account.svg" alt="" width="24" height="24">
                          </span>
                          <div class="w-75 d-inline-block v-middle ps-3">
                            <h6 class="mb-1 bg-hover-primary fw-semibold"> Setting</h6>
                          </div>
                        </a>
                      </div> --}}
                      <div class="d-grid py-4 px-7 pt-8">
                        @if (Auth::user()->type  == 'user')
                          <a href="{{URL::to('admin/view_qr')}}" class="btn btn-outline-warning my-2">Download QR</a>
                          <a href="{{URL::to('u/'.Auth::user()->name_url)}}" target="_blank" class="btn btn-outline-success my-2">Visit My Site</a>
                        @elseif(Auth::user()->type  == 'admin')
                          <a href="{{URL::to('site/'.Auth::user()->name_url)}}" target="_blank" class="btn btn-outline-success my-2">Signup Link</a>
                        @endif
                        <a href="{{URL::to('logout')}}" class="btn btn-outline-primary">Log Out</a>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>

      <!-- Header End -->

        @yield('content')
      
    </div>
    </div>
  </div>


 

  <!--  Mobilenavbar -->
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar"
    aria-labelledby="offcanvasWithBothOptionsLabel">
    <nav class="sidebar-nav scroll-sidebar">
      <div class="offcanvas-header justify-content-between">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" alt="" class="img-fluid">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body profile-dropdown mobile-navbar" data-simplebar="" data-simplebar>
        <ul id="sidebarnav">
          <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
              <span>
                <i class="ti ti-apps"></i>
              </span>
              <span class="hide-menu">Apps</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level my-3">
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-chat.svg" alt="" class="img-fluid" width="24" height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Chat Application</h6>
                    <span class="fs-2 d-block fw-normal text-muted">New messages arrived</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-invoice.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Invoice App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get latest invoice</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-mobile.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Contact Application</h6>
                    <span class="fs-2 d-block fw-normal text-muted">2 Unsaved Contacts</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-message-box.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Email App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get new emails</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-cart.svg" alt="" class="img-fluid" width="24" height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">User Profile</h6>
                    <span class="fs-2 d-block fw-normal text-muted">learn more information</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-date.svg" alt="" class="img-fluid" width="24" height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Calendar App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get dates</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-lifebuoy.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Contact List Table</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Add new contact</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-dd-application.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Notes Application</h6>
                    <span class="fs-2 d-block fw-normal text-muted">To-do and Daily tasks</span>
                  </div>
                </a>
              </li>
              <ul class="px-8 mt-7 mb-4">
                <li class="sidebar-item mb-3">
                  <h5 class="fs-5 fw-semibold">Quick Links</h5>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Pricing Page</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Authentication Design</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Register Now</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">404 Error Page</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Notes App</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">User Application</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Account Settings</a>
                </li>
              </ul>
            </ul>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="app-chat.html" aria-expanded="false">
              <span>
                <i class="ti ti-message-dots"></i>
              </span>
              <span class="hide-menu">Chat</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="app-calendar.html" aria-expanded="false">
              <span>
                <i class="ti ti-calendar"></i>
              </span>
              <span class="hide-menu">Calendar</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="app-email.html" aria-expanded="false">
              <span>
                <i class="ti ti-mail"></i>
              </span>
              <span class="hide-menu">Email</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>


  <!-- Search Bar -->

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content rounded-1">
        <div class="modal-header border-bottom">
          <input type="search" class="form-control fs-3" placeholder="Search here" id="search" />
          <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
            <i class="ti ti-x fs-5 ms-3"></i>
          </span>
        </div>
        <div class="modal-body message-body" data-simplebar="">
          <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
          <ul class="list mb-0 py-2">
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Modern</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                <span class="fs-3 text-muted d-block">/apps/contacts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Posts</span>
                <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Detail</span>
                <span
                  class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Shop</span>
                <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Modern</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                <span class="fs-3 text-muted d-block">/apps/contacts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Posts</span>
                <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Detail</span>
                <span
                  class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Shop</span>
                <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

      <!-- ====================================================================
           MODERN EXPIRY ALERT MODAL
           ==================================================================== -->
      <div class="modal fade" id="expiry_alert_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="expiry_alert_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
          <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25); overflow: hidden; background: #ffffff;">
            
            @php
              $expiry_date = Auth::user()->expiry_date;
              $expiry_timestamp = strtotime($expiry_date);
              $current_timestamp = time();
              $difference = $expiry_timestamp - $current_timestamp;
              $days_difference = max(0, floor($difference / (60 * 60 * 24)));
            @endphp

            <!-- Modal Header with Close Button -->
            <div style="padding: 24px 28px 0 28px; display: flex; justify-content: flex-end;">
              <button type="button" class="btn-close" onclick="close_expiry_modal()" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.6; transition: opacity 0.2s;"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body text-center" style="padding: 0 32px 32px 32px;">
              
              <!-- Floating Icon Badge -->
              <div style="margin-bottom: 20px;">
                <div style="width: 76px; height: 76px; border-radius: 22px; background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%); border: 1.5px solid #fecdd3; display: inline-flex; align-items: center; justify-content: center; color: #e11d48; font-size: 36px; box-shadow: 0 10px 25px rgba(225, 29, 72, 0.12);">
                  @if($difference <= 0)
                    <i class="ti ti-lock-access"></i>
                  @else
                    <i class="ti ti-clock-hour-4"></i>
                  @endif
                </div>
              </div>

              <!-- Title & Days Pill -->
              @if ($difference <= 0)
                <h4 style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; color: #0f172a; font-size: 1.35rem; margin-bottom: 8px;">
                  Subscription Has Lapsed
                </h4>
                <div style="display: inline-flex; align-items: center; gap: 6px; background: #fff1f2; border: 1px solid #fecdd3; color: #e11d48; font-weight: 700; font-size: 0.82rem; padding: 4px 14px; border-radius: 9999px; margin-bottom: 14px;">
                  <i class="ti ti-alert-circle"></i> Service Paused
                </div>
                <p style="color: #64748b; font-size: 0.9rem; line-height: 1.55; margin-bottom: 22px;">
                  Your review QR stands and customer feedback collection are temporarily locked. Renew your plan today to instantly restore uninterrupted services.
                </p>
              @else
                <h4 style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; color: #0f172a; font-size: 1.35rem; margin-bottom: 8px;">
                  Subscription Expiring Soon
                </h4>
                <div style="display: inline-flex; align-items: center; gap: 6px; background: #fff1f2; border: 1px solid #fecdd3; color: #e11d48; font-weight: 700; font-size: 0.85rem; padding: 4px 16px; border-radius: 9999px; margin-bottom: 14px;">
                  <i class="ti ti-flame"></i> 
                  <span>{{ $days_difference }} Day{{ $days_difference == 1 ? '' : 's' }} Remaining</span>
                </div>
                <p style="color: #64748b; font-size: 0.9rem; line-height: 1.55; margin-bottom: 22px;">
                  Your current AskReview plan expires in <strong>{{ $days_difference }} day{{ $days_difference == 1 ? '' : 's' }}</strong>. Upgrade now to ensure seamless Google reviews & QR code scanning.
                </p>
              @endif

              <!-- Feature Highlights Box -->
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 14px 18px; margin-bottom: 24px; text-align: left;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                  <i class="ti ti-circle-check-filled" style="color: #10b981; font-size: 1.1rem; flex-shrink: 0;"></i>
                  <span style="font-size: 0.85rem; font-weight: 600; color: #334155;">Active QR Code &amp; Google Review Redirects</span>
                </div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                  <i class="ti ti-circle-check-filled" style="color: #10b981; font-size: 1.1rem; flex-shrink: 0;"></i>
                  <span style="font-size: 0.85rem; font-weight: 600; color: #334155;">Automated WhatsApp Review Collector</span>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                  <i class="ti ti-circle-check-filled" style="color: #10b981; font-size: 1.1rem; flex-shrink: 0;"></i>
                  <span style="font-size: 0.85rem; font-weight: 600; color: #334155;">Full Analytics &amp; Video Testimonials</span>
                </div>
              </div>

              <!-- CTA Buttons -->
              <div style="display: flex; flex-direction: column; gap: 10px;">
                <button 
                  onclick="get_plans()" 
                  type="button" 
                  class="btn w-100" 
                  style="background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 0.98rem; height: 48px; border-radius: 12px; border: none; box-shadow: 0 6px 18px rgba(225, 29, 72, 0.32); display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.2s ease;"
                  onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 8px 22px rgba(225, 29, 72, 0.4)';"
                  onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 6px 18px rgba(225, 29, 72, 0.32)';"
                >
                  <span>Upgrade / Renew Plan</span>
                  <i class="ti ti-arrow-right"></i>
                </button>

                <button 
                  type="button" 
                  onclick="close_expiry_modal()" 
                  class="btn w-100" 
                  style="background: transparent; color: #64748b; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 600; font-size: 0.88rem; border: none; padding: 6px;"
                  onmouseover="this.style.color='#0f172a'"
                  onmouseout="this.style.color='#64748b'"
                >
                  Remind Me Later
                </button>
              </div>

            </div>
          </div>
        </div>
      </div>
    
      <!-- ====================================================================
           MODERN EXPIRED ALERT MODAL
           ==================================================================== -->
      <div class="modal fade" id="expired_alert_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="expired_alert_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
          <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25); overflow: hidden; background: #ffffff;">
            
            <div style="padding: 24px 28px 0 28px; display: flex; justify-content: flex-end;">
              <button type="button" class="btn-close" onclick="close_expiry_modal()" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.6;"></button>
            </div>

            <div class="modal-body text-center" style="padding: 0 32px 32px 32px;">
              
              <div style="margin-bottom: 20px;">
                <div style="width: 76px; height: 76px; border-radius: 22px; background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%); border: 1.5px solid #fecdd3; display: inline-flex; align-items: center; justify-content: center; color: #e11d48; font-size: 36px; box-shadow: 0 10px 25px rgba(225, 29, 72, 0.12);">
                  <i class="ti ti-lock-access"></i>
                </div>
              </div>

              <h4 style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; color: #0f172a; font-size: 1.35rem; margin-bottom: 8px;">
                Your Subscription Has Lapsed
              </h4>
              <div style="display: inline-flex; align-items: center; gap: 6px; background: #fff1f2; border: 1px solid #fecdd3; color: #e11d48; font-weight: 700; font-size: 0.82rem; padding: 4px 14px; border-radius: 9999px; margin-bottom: 14px;">
                <i class="ti ti-alert-circle"></i> Service Paused
              </div>
              <p style="color: #64748b; font-size: 0.9rem; line-height: 1.55; margin-bottom: 24px;">
                Renew your subscription today to unlock your review QR code and continue receiving customer reviews without interruption.
              </p>

              <button 
                onclick="get_plans()" 
                type="button" 
                class="btn w-100" 
                style="background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 0.98rem; height: 48px; border-radius: 12px; border: none; box-shadow: 0 6px 18px rgba(225, 29, 72, 0.32); display: flex; align-items: center; justify-content: center; gap: 8px;"
              >
                <span>Renew Plan Now</span>
                <i class="ti ti-arrow-right"></i>
              </button>

            </div>
          </div>
        </div>
      </div>


    <div class="modal fade" id="plan_list_modal"  data-bs-backdrop="static" tabindex="-1" aria-labelledby="plan_list_modalLabel" aria-hidden="true">
      <div class="modal-dialog   modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="plan_list_modalLabel">Upgrade to ask review plan</h3>
            <button type="button" class="btn-close" onclick="close_expiry_modal()" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">

                @php
                    $Service = DB::table('services')->where('status','publish')->get();
                @endphp
                @foreach ($Service as $key=> $item)
                <div class="col-lg-6 col-md-12 col">
                  <div class="card card_box gold_box"  @if ($item->video_access ==  'Y') style="background: #c0ffc3;" @endif>
                      <div class="header_box">
                        <h2>
                          {{$item->title}}
                        </h2>
                        
                      </div>
                      <div class="card_body_box">
                        <div class="price_box">
                          <div class="price_sec">
                            <h4>₹ {{$item->price}}/Yearly</h4>
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
                              @if ($item->video_access ==  'Y')
                                <li>
                                  <span><i class="fa-solid fa-check" style="color: green"></i> <span>Video Access</span></span>
                                  
                                </li>
                              @endif
                          </ul>
                          </div>

                          <div class="mamber_btn_box">
                            <a href="{{URL::to('admin/user_service_payment_view/'.$item->id)}}">
                              <button class="btn btn-info buy_now_btn">Buy Now</button>
                            </a>
                          </div>
                      </div>
                  </div>
                </div>
                @endforeach


              </div>
          </div>
         
        </div>
      </div>
    </div>

    
<div class="modal fade bd-example-modal-lg" id="add_support_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Support</h5>
          {{-- <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close"  onclick="hide_modal()">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body support_body">
        
        </div>
    </div>
  </div>
</div>

<a href="http://m.me/147651825087840" target="_blank" class="floating-button"><i class="fa-regular fa-comment"></i> <br>Chat </a>

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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

 

<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>

  @yield('js')


  @php
      // Expiry date
      $expiry_date = Auth::user()->expiry_date;;

      // Convert expiry date to timestamp
      $expiry_timestamp = strtotime($expiry_date);

      // Get current timestamp
      $current_timestamp = time();

      // Calculate difference in seconds between current time and expiry time
      $difference = $expiry_timestamp - $current_timestamp;

      // Convert difference to days
      $days_difference = floor($difference / (60 * 60 * 24));

      // // Check if the difference is less than or equal to 30 days
      // if ($days_difference <= 30) {
      //     echo "Alert: Your expiry date is approaching. You have $days_difference days left.";
      // } else {
      //     echo "You have more than 30 days left until expiry.";
      // }

  @endphp
  
  @php
    $needsGoogleOnboarding = (Auth::user()->type == 'user' && (empty(Auth::user()->phone) || session('needs_google_onboarding')));
  @endphp
  
  @if (Auth::user()->type == 'user' && !$needsGoogleOnboarding)
    @if ($days_difference <= 30)
      <script>

        @if(!Session::get('popupShow'))
          setTimeout(function(){ $('#expiry_alert_modal').modal('show');}, 1000);
        @else
            //alert('ddd');
            $('#expiry_alert_modal').modal('hide');
        @endif

        function close_expiry_modal(){
          @php
            Session::put('popupShow','show');
          @endphp
            $('#expiry_alert_modal').modal('hide');
        }
      </script>
      @endif
    @endif
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
    
    function active_user(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute(
            'href'
            ); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Are you sure",
            text: "You want to active this user!",
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

    //
    function get_plans() {
        $('#expiry_alert_modal').modal('hide');
        $('#plan_list_modal').modal('show');
    }

    
    function get_support() {
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/service_support')}}",// where you wanna post
            data: {
                'id':''
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $('.support_body').html(data);
                $('#add_support_modal').modal("show");
            } 
        });
    }

    @if(Auth::check() && Auth::user()->type == 'user' && (empty(Auth::user()->phone) || session('needs_google_onboarding')))
    $(document).ready(function() {
        // Ensure expiry modal stays hidden while onboarding is required
        $('#expiry_alert_modal').modal('hide');
        $('#expired_alert_modal').modal('hide');

        try {
            var onboardingModalEl = document.getElementById('googleOnboardingModal');
            if (onboardingModalEl) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    var myOnboardingModal = new bootstrap.Modal(onboardingModalEl, {
                        backdrop: 'static',
                        keyboard: false
                    });
                    myOnboardingModal.show();
                } else {
                    $('#googleOnboardingModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }).modal('show');
                }
            }
        } catch(e) {
            $('#googleOnboardingModal').modal('show');
        }
    });

    function previewBusinessLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#logoPreviewImg').attr('src', e.target.result);
                $('#logoPreviewBox').show();
                $('#logoUploadPrompt').hide();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeSelectedLogo() {
        $('#businessLogoInput').val('');
        $('#logoPreviewBox').hide();
        $('#logoUploadPrompt').show();
    }
    @endif

  </script>

  @if(Auth::check() && Auth::user()->type == 'user' && (empty(Auth::user()->phone) || session('needs_google_onboarding')))
  <!-- ====================================================================
       GOOGLE LOGIN ONBOARDING POPUP MODAL
       ==================================================================== -->
  <div class="modal fade" id="googleOnboardingModal" tabindex="-1" role="dialog" aria-labelledby="googleOnboardingModalTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
      <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 40px rgba(15,23,42,0.18); overflow: hidden;">
        
        <!-- Header -->
        <div class="modal-header" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-bottom: 1px solid #e2e8f0; padding: 22px 26px 16px 26px;">
          <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #fff1f2; border: 1px solid #fecdd3; display: flex; align-items: center; justify-content: center; color: #e11d48; font-size: 22px; flex-shrink: 0;">
              <i class="ti ti-building-store"></i>
            </div>
            <div>
              <h5 class="modal-title" id="googleOnboardingModalTitle" style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 1.15rem; color: #0f172a; margin: 0;">
                Complete Business Profile
              </h5>
              <p style="font-size: 0.8rem; color: #64748b; margin: 2px 0 0 0;">Please set up your store details to activate your review QR stands.</p>
            </div>
          </div>
        </div>

        <!-- Form Body -->
        <div class="modal-body" style="padding: 24px 26px;">
          <form method="POST" action="{{ route('google.complete_onboarding') }}" enctype="multipart/form-data" id="googleOnboardingForm">
            @csrf

            <!-- 1. Business / Store Name (Mandatory) -->
            <div class="mb-3">
              <label for="onboardingBusinessName" style="font-weight: 700; font-size: 0.86rem; color: #1e293b; margin-bottom: 6px; display: block;">
                Business / Store Name <span style="color: #e11d48;">*</span>
              </label>
              <div style="position: relative; display: flex; align-items: center;">
                <span style="position: absolute; left: 14px; color: #94a3b8; font-size: 1.15rem; pointer-events: none; display: flex; align-items: center;">
                  <i class="ti ti-building-store"></i>
                </span>
                <input 
                  type="text" 
                  name="business_name" 
                  id="onboardingBusinessName" 
                  class="form-control" 
                  placeholder="e.g. Apex Dental Clinic, Royal TVS" 
                  value="{{ Auth::user()->name != 'Google User' ? Auth::user()->name : '' }}" 
                  required 
                  style="height: 48px; padding-left: 44px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.92rem; color: #0f172a;"
                  autofocus
                />
              </div>
            </div>

            <!-- 2. Email Address (Mandatory) -->
            <div class="mb-3">
              <label for="onboardingEmail" style="font-weight: 700; font-size: 0.86rem; color: #1e293b; margin-bottom: 6px; display: block;">
                Email Address <span style="color: #e11d48;">*</span>
              </label>
              <div style="position: relative; display: flex; align-items: center;">
                <span style="position: absolute; left: 14px; color: #94a3b8; font-size: 1.15rem; pointer-events: none; display: flex; align-items: center;">
                  <i class="ti ti-mail"></i>
                </span>
                <input 
                  type="email" 
                  name="email" 
                  id="onboardingEmail" 
                  class="form-control" 
                  placeholder="contact@business.com" 
                  value="{{ Auth::user()->email }}" 
                  required 
                  style="height: 48px; padding-left: 44px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.92rem; color: #0f172a;"
                />
              </div>
            </div>

            <!-- 3. WhatsApp / Contact Number (Mandatory) -->
            <div class="mb-3">
              <label for="onboardingPhone" style="font-weight: 700; font-size: 0.86rem; color: #1e293b; margin-bottom: 6px; display: block;">
                WhatsApp / Contact Number <span style="color: #e11d48;">*</span>
              </label>
              <div style="position: relative; display: flex; align-items: center;">
                <span style="position: absolute; left: 14px; color: #25d366; font-size: 1.25rem; pointer-events: none; display: flex; align-items: center;">
                  <i class="ti ti-brand-whatsapp"></i>
                </span>
                <input 
                  type="text" 
                  name="phone" 
                  id="onboardingPhone" 
                  class="form-control" 
                  placeholder="+91 98765 43210" 
                  value="{{ Auth::user()->phone }}" 
                  required 
                  style="height: 48px; padding-left: 44px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.92rem; color: #0f172a;"
                />
              </div>
            </div>

            <!-- 4. Business Logo (Optional - Logo is NOT Mandatory) -->
            <div class="mb-4">
              <label style="font-weight: 700; font-size: 0.86rem; color: #1e293b; margin-bottom: 6px; display: flex; justify-content: space-between; align-items: center;">
                <span>Business Logo</span>
                <span style="font-size: 0.75rem; font-weight: 600; color: #64748b; background: #f1f5f9; padding: 2px 8px; border-radius: 6px;">Optional</span>
              </label>

              <!-- Upload Area -->
              <div 
                style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 16px; text-align: center; background: #f8fafc; cursor: pointer; transition: all 0.2s ease; position: relative;"
                onclick="document.getElementById('businessLogoInput').click()"
              >
                <!-- Prompt State -->
                <div id="logoUploadPrompt">
                  <div style="width: 40px; height: 40px; border-radius: 50%; background: #ffffff; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; justify-content: center; color: #64748b; font-size: 1.25rem; margin-bottom: 6px;">
                    <i class="ti ti-photo-plus"></i>
                  </div>
                  <div style="font-weight: 700; font-size: 0.85rem; color: #0f172a;">Click to upload business logo</div>
                  <div style="font-size: 0.74rem; color: #94a3b8; margin-top: 2px;">PNG, JPG, WebP up to 5MB (Optional)</div>
                </div>

                <!-- Preview State -->
                <div id="logoPreviewBox" style="display: none;">
                  <img id="logoPreviewImg" src="#" alt="Logo Preview" style="max-height: 64px; max-width: 140px; object-fit: contain; border-radius: 8px; border: 1px solid #e2e8f0; padding: 4px; background: #ffffff; margin-bottom: 6px;" />
                  <div>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="event.stopPropagation(); removeSelectedLogo();" style="font-size: 0.75rem; border-radius: 6px; padding: 2px 10px;">
                      <i class="ti ti-trash"></i> Remove Logo
                    </button>
                  </div>
                </div>

                <input 
                  type="file" 
                  name="logo" 
                  id="businessLogoInput" 
                  accept="image/png, image/jpeg, image/jpg, image/webp" 
                  style="display: none;" 
                  onchange="previewBusinessLogo(this)" 
                />
              </div>
            </div>

            <!-- Submit Action -->
            <button 
              type="submit" 
              class="btn w-100" 
              style="background: #e11d48; color: #ffffff; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 0.96rem; height: 48px; border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(225, 29, 72, 0.28); transition: all 0.2s ease;"
              onmouseover="this.style.background='#be123c'"
              onmouseout="this.style.background='#e11d48'"
            >
              <span>Save &amp; Continue to Dashboard</span>
              <i class="ti ti-arrow-right ms-1"></i>
            </button>
          </form>
        </div>

      </div>
    </div>
  </div>
  @endif


</body>


<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/minisidebar/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Jul 2023 05:22:25 GMT -->
</html>