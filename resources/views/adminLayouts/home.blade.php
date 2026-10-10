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

  <meta name="theme-color" content="#e11d48"/>
  <link rel="apple-touch-icon" href="{{ asset('frontend/images/logo.jpg') }}">
  <link rel="manifest" href="{{ asset('/manifest.json') }}">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/images/logo.jpg') }}" />
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet">

  <!-- Core Css -->
  <link rel="stylesheet" href="{{asset('adminAssets/libs/owl.carousel/dist/assets/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminAssets/css/style.min.css')}}" />
  <link rel="stylesheet" href="{{asset('adminAssets/css/my-style.css')}}?v={{ time() }}">
  <link rel="stylesheet" href="{{asset('adminAssets/css/responsive.css')}}" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Include HTML2Canvas library -->
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .app-header {
        width: 100% !important;
    }
    @media (min-width: 992px) {
        #main-wrapper[data-layout="vertical"][data-header-position="fixed"] .app-header,
        #main-wrapper[data-layout="vertical"][data-header-position="fixed"][data-sidebartype="mini-sidebar"] .app-header {
            width: 100% !important;
        }
    }
    /* BASE SIDEBAR LINKS & ICONS */
    .sidebar-nav ul .sidebar-item .sidebar-link {
        color: #475569 !important;
        font-size: 0.88rem !important;
        font-weight: 600 !important;
        padding: 10px 14px !important;
        border-radius: 12px !important;
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        text-decoration: none !important;
    }
    .sidebar-nav ul .sidebar-item .sidebar-link span:first-child {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 28px !important;
        height: 28px !important;
        flex-shrink: 0 !important;
    }
    .sidebar-nav ul .sidebar-item .sidebar-link i,
    .sidebar-nav ul .sidebar-item .sidebar-link .ti {
        font-size: 1.38rem !important;
        width: 28px !important;
        height: 28px !important;
        line-height: 1 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    /* ========================================================= */
    /* MINI-SIDEBAR (COLLAPSED): PERFECT CENTERING & NO ARROW    */
    /* (DESKTOP SCREENS >= 992px ONLY)                           */
    /* ========================================================= */
    @media (min-width: 992px) {
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .brand-logo,
    #main-wrapper.mini-sidebar .left-sidebar .brand-logo,
    .mini-sidebar .left-sidebar .brand-logo {
        padding: 0 !important;
        justify-content: center !important;
        align-items: center !important;
        text-align: center !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .brand-logo .logo-img,
    #main-wrapper.mini-sidebar .left-sidebar .brand-logo .logo-img,
    .mini-sidebar .left-sidebar .brand-logo .logo-img {
        margin: 0 auto !important;
        justify-content: center !important;
        display: flex !important;
        align-items: center !important;
        width: auto !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .brand-logo img,
    #main-wrapper.mini-sidebar .left-sidebar .brand-logo img,
    .mini-sidebar .left-sidebar .brand-logo img {
        margin: 0 auto !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .brand-logo #sidebarCollapse,
    #main-wrapper.mini-sidebar .left-sidebar .brand-logo #sidebarCollapse {
        display: none !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav,
    .mini-sidebar .left-sidebar .sidebar-nav {
        padding: 14px 0 30px 0 !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul#sidebarnav,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul#sidebarnav,
    .mini-sidebar .left-sidebar .sidebar-nav ul#sidebarnav {
        padding: 0 !important;
        margin: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar,
    #main-wrapper.mini-sidebar .left-sidebar,
    .mini-sidebar .left-sidebar {
        width: 87px !important;
        position: fixed !important;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 1000 !important;
        display: block !important;
        background: #ffffff !important;
        border-right: 1px solid #f1f5f9 !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .body-wrapper,
    #main-wrapper.mini-sidebar .body-wrapper,
    .mini-sidebar .body-wrapper {
        margin-left: 87px !important;
        min-height: 100vh;
        position: relative;
        z-index: 1;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item,
    .mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item {
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center !important;
        width: 100% !important;
        margin: 0 0 6px 0 !important;
        padding: 0 !important;
    }

    /* Submenu inside collapsed mini-sidebar (stack vertically within 87px) */
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .first-level,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .first-level,
    .mini-sidebar .left-sidebar .sidebar-nav .first-level {
        padding: 4px 0 0 0 !important;
        margin: 0 !important;
        border-left: none !important;
        width: 100% !important;
        display: none;
        flex-direction: column !important;
        align-items: center !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .first-level.show,
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .first-level.in,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .first-level.show,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .first-level.in,
    .mini-sidebar .left-sidebar .sidebar-nav .first-level.show,
    .mini-sidebar .left-sidebar .sidebar-nav .first-level.in {
        display: flex !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .first-level .sidebar-item,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .first-level .sidebar-item,
    .mini-sidebar .left-sidebar .sidebar-nav .first-level .sidebar-item {
        width: 100% !important;
        margin-bottom: 4px !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link,
    .mini-sidebar .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link {
        width: 42px !important;
        height: 42px !important;
        padding: 0 !important;
        margin: 0 auto !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 10px !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link i,
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link .ti,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link i,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link .ti,
    .mini-sidebar .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link i,
    .mini-sidebar .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link .ti {
        font-size: 1.35rem !important;
        width: 26px !important;
        height: 26px !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link,
    .mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link {
        width: 48px !important;
        height: 48px !important;
        padding: 0 !important;
        margin: 0 auto !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 12px !important;
        transform: none !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link span:first-child,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link span:first-child,
    .mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link span:first-child {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        height: 100% !important;
        margin: 0 auto !important;
        padding: 0 !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link i,
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link .ti,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link i,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link .ti,
    .mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link i,
    .mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link .ti {
        font-size: 1.65rem !important;
        width: 32px !important;
        height: 32px !important;
        margin: 0 auto !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item.selected > .sidebar-link,
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link.active,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item.selected > .sidebar-link,
    #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link.active,
    .mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item.selected > .sidebar-link,
    .mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link.active {
        box-shadow: none !important;
        border: 1.5px solid #fecdd3 !important;
        background: #fff1f2 !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .nav-small-cap,
    #main-wrapper.mini-sidebar .left-sidebar .nav-small-cap,
    .mini-sidebar .left-sidebar .nav-small-cap {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 12px 0 6px 0 !important;
        margin: 0 auto !important;
        text-align: center !important;
        width: 100% !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .nav-small-cap .nav-small-cap-icon,
    #main-wrapper.mini-sidebar .left-sidebar .nav-small-cap .nav-small-cap-icon,
    .mini-sidebar .left-sidebar .nav-small-cap .nav-small-cap-icon {
        display: block !important;
        margin: 0 auto !important;
        color: #cbd5e1 !important;
        text-align: center !important;
    }
    /* STRICTLY HIDE TEXT AND CHEVRON ARROW IN COLLAPSED MODE */
    #main-wrapper[data-sidebartype="mini-sidebar"] .hide-menu,
    #main-wrapper[data-sidebartype="mini-sidebar"] .ti-chevron-down,
    #main-wrapper[data-sidebartype="mini-sidebar"] [class*="ti-chevron"],
    #main-wrapper.mini-sidebar .hide-menu,
    #main-wrapper.mini-sidebar .ti-chevron-down,
    #main-wrapper.mini-sidebar [class*="ti-chevron"],
    .mini-sidebar .hide-menu,
    .mini-sidebar .ti-chevron-down,
    .mini-sidebar [class*="ti-chevron"] {
        display: none !important;
    }

    /* MINI-SIDEBAR: EXPANDED ON HOVER */
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover {
        width: 270px !important;
        box-shadow: 0 10px 40px -10px rgba(15, 23, 42, 0.15) !important;
        z-index: 1000 !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .brand-logo {
        padding: 16px 20px 14px 20px !important;
        justify-content: space-between !important;
        height: 70px !important;
        text-align: left !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .brand-logo .logo-img {
        width: auto !important;
        margin: 0 !important;
        display: flex !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .brand-logo img {
        margin: 0 !important;
        max-height: 40px !important;
        max-width: 170px !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav {
        padding: 12px 14px 30px 14px !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul#sidebarnav {
        display: block !important;
        width: 100% !important;
        padding: 0 !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item {
        display: block !important;
        width: 100% !important;
        margin-bottom: 4px !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item .sidebar-link {
        width: 100% !important;
        height: 44px !important;
        padding: 10px 14px !important;
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
        gap: 12px !important;
        border-radius: 12px !important;
        border: none !important;
        background: transparent;
        color: #475569 !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item .sidebar-link:hover {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
        transform: translateX(3px) !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item .sidebar-link span:first-child {
        width: 28px !important;
        height: 28px !important;
        flex-shrink: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item .sidebar-link i,
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item .sidebar-link .ti {
        font-size: 1.35rem !important;
        width: 28px !important;
        height: 28px !important;
        color: #64748b !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item .sidebar-link:hover i,
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item .sidebar-link:hover .ti {
        color: #e11d48 !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item .sidebar-link .hide-menu {
        display: inline !important;
        font-size: 0.88rem !important;
        font-weight: 600 !important;
        color: inherit !important;
        white-space: nowrap !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav .ti-chevron-down {
        display: inline-block !important;
        font-size: 0.85rem !important;
        margin-left: auto !important;
        width: auto !important;
        height: auto !important;
        color: #94a3b8 !important;
    }
    #analytics-submenu.collapsing,
    .sidebar-nav .first-level.collapsing {
        transition: none !important;
        -webkit-transition: none !important;
        height: auto !important;
        display: block !important;
    }
    .sidebar-nav .first-level.show,
    .sidebar-nav .first-level.in {
        display: block !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav .first-level.show,
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav .first-level.in {
        display: block !important;
    }
    .sidebar-link[aria-expanded="true"] .ti-chevron-down {
        transform: rotate(180deg) !important;
    }
    .sidebar-link[aria-expanded="false"] .ti-chevron-down {
        transform: rotate(0deg) !important;
    }
    .sidebar-link .ti-chevron-down {
        transition: transform 0.12s ease !important;
        display: inline-block !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .nav-small-cap {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
        padding: 16px 14px 6px 14px !important;
        text-align: left !important;
        width: 100% !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .nav-small-cap .nav-small-cap-icon {
        display: none !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .nav-small-cap .hide-menu {
        display: block !important;
        color: #94a3b8 !important;
        font-size: 0.68rem !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.08em !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item.selected > .sidebar-link,
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item .sidebar-link.active {
        background: #fff1f2 !important;
        color: #e11d48 !important;
        font-weight: 700 !important;
        box-shadow: inset 3px 0 0 #e11d48 !important;
        border: none !important;
    }
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item.selected > .sidebar-link i,
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item .sidebar-link.active i,
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item.selected > .sidebar-link .ti,
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar:hover .sidebar-nav ul .sidebar-item .sidebar-link.active .ti {
        color: #e11d48 !important;
    }
    } /* ================= END DESKTOP ONLY (min-width: 992px) ================= */

    /* ========================================================= */
    /* FULL MOBILE RESPONSIVE ENGINE (< 992px)                   */
    /* ========================================================= */
    @media (max-width: 991.98px) {
        html, body {
            overflow-x: hidden !important;
            max-width: 100vw !important;
            width: 100% !important;
        }

        /* 1. RESET BODY WRAPPER: Zero margin-left to prevent 87px offset */
        #main-wrapper .body-wrapper,
        #main-wrapper[data-sidebartype="mini-sidebar"] .body-wrapper,
        #main-wrapper.mini-sidebar .body-wrapper,
        .mini-sidebar .body-wrapper,
        #main-wrapper[data-sidebartype="full"] .body-wrapper {
            margin-left: 0 !important;
            width: 100% !important;
            max-width: 100vw !important;
            min-width: 0 !important;
            overflow-x: hidden !important;
            position: relative !important;
            min-height: 100vh !important;
            padding: 0 !important;
        }

        /* 2. APP HEADER: Full-width sticky header, perfectly aligned */
        #main-wrapper .app-header,
        #main-wrapper[data-sidebartype="mini-sidebar"] .app-header,
        #main-wrapper.mini-sidebar .app-header,
        #main-wrapper[data-sidebartype="full"] .app-header,
        .app-header {
            width: 100% !important;
            left: 0 !important;
            right: 0 !important;
            margin-left: 0 !important;
            position: sticky !important;
            top: 0 !important;
            z-index: 1020 !important;
        }

        /* 3. OFF-CANVAS MOBILE SIDEBAR DRAWER */
        #main-wrapper .left-sidebar,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar,
        #main-wrapper.mini-sidebar .left-sidebar,
        .mini-sidebar .left-sidebar,
        #main-wrapper[data-sidebartype="full"] .left-sidebar {
            position: fixed !important;
            top: 0 !important;
            bottom: 0 !important;
            left: -300px !important;
            width: 280px !important;
            max-width: 85vw !important;
            height: 100vh !important;
            z-index: 1055 !important;
            background: #ffffff !important;
            box-shadow: none !important;
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            display: block !important;
            overflow-y: auto !important;
            border-right: 1px solid #e2e8f0 !important;
        }

        /* Open state for off-canvas mobile drawer */
        #main-wrapper.show-sidebar .left-sidebar {
            left: 0 !important;
            box-shadow: 0 0 35px rgba(15, 23, 42, 0.25) !important;
        }

        /* 4. SIDEBAR DRAWER INTERIOR: Full readable text and close button */
        #main-wrapper .left-sidebar .brand-logo,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .brand-logo,
        #main-wrapper.mini-sidebar .left-sidebar .brand-logo,
        .mini-sidebar .left-sidebar .brand-logo {
            padding: 16px 20px !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            text-align: left !important;
            height: 70px !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }

        #main-wrapper .left-sidebar .brand-logo .logo-img,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .brand-logo .logo-img,
        #main-wrapper.mini-sidebar .left-sidebar .brand-logo .logo-img,
        .mini-sidebar .left-sidebar .brand-logo .logo-img {
            margin: 0 !important;
            width: auto !important;
            display: flex !important;
            align-items: center !important;
        }

        #main-wrapper .left-sidebar .brand-logo img,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .brand-logo img,
        #main-wrapper.mini-sidebar .left-sidebar .brand-logo img,
        .mini-sidebar .left-sidebar .brand-logo img {
            margin: 0 !important;
            max-height: 42px !important;
            max-width: 155px !important;
        }

        #main-wrapper .left-sidebar .brand-logo #sidebarCollapse,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .brand-logo #sidebarCollapse,
        #main-wrapper.mini-sidebar .left-sidebar .brand-logo #sidebarCollapse {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 36px !important;
            height: 36px !important;
            border-radius: 8px !important;
            background: #f1f5f9 !important;
            color: #475569 !important;
            cursor: pointer !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav {
            padding: 12px 14px 40px 14px !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav ul#sidebarnav,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul#sidebarnav,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul#sidebarnav {
            display: block !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav ul .sidebar-item,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item {
            display: block !important;
            width: 100% !important;
            margin-bottom: 4px !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link {
            width: 100% !important;
            height: auto !important;
            min-height: 44px !important;
            padding: 10px 14px !important;
            margin: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 12px !important;
            border-radius: 12px !important;
            border: none !important;
            color: #475569 !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link span:first-child,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link span:first-child,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link span:first-child {
            width: 28px !important;
            height: 28px !important;
            flex-shrink: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link i,
        #main-wrapper .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link .ti,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link i,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link .ti,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link i,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav ul .sidebar-item .sidebar-link .ti {
            font-size: 1.35rem !important;
            width: 28px !important;
            height: 28px !important;
            margin: 0 !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav .hide-menu,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .hide-menu,
        #main-wrapper[data-sidebartype="mini-sidebar"] .hide-menu,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .hide-menu,
        #main-wrapper.mini-sidebar .hide-menu {
            display: inline !important;
            font-size: 0.88rem !important;
            font-weight: 600 !important;
            color: inherit !important;
            white-space: nowrap !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav .ti-chevron-down,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .ti-chevron-down,
        #main-wrapper[data-sidebartype="mini-sidebar"] [class*="ti-chevron"],
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .ti-chevron-down,
        #main-wrapper.mini-sidebar [class*="ti-chevron"] {
            display: inline-block !important;
            font-size: 0.85rem !important;
            margin-left: auto !important;
            color: #94a3b8 !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav .nav-small-cap,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .nav-small-cap,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .nav-small-cap {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            padding: 16px 14px 6px 14px !important;
            text-align: left !important;
            width: 100% !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav .nav-small-cap .hide-menu,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .nav-small-cap .hide-menu,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .nav-small-cap .hide-menu {
            display: block !important;
            color: #94a3b8 !important;
            font-size: 0.68rem !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.08em !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav .nav-small-cap .nav-small-cap-icon,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .nav-small-cap .nav-small-cap-icon,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .nav-small-cap .nav-small-cap-icon {
            display: none !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav .first-level,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .first-level,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .first-level {
            padding-left: 14px !important;
            border-left: 2px solid #f1f5f9 !important;
            margin-left: 18px !important;
            width: calc(100% - 18px) !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav .first-level .sidebar-item,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .first-level .sidebar-item,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .first-level .sidebar-item {
            display: block !important;
            width: 100% !important;
        }

        #main-wrapper .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link,
        #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link,
        #main-wrapper.mini-sidebar .left-sidebar .sidebar-nav .first-level .sidebar-item .sidebar-link {
            width: 100% !important;
            height: auto !important;
            min-height: 38px !important;
            padding: 8px 12px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
        }
    }

    /* 5. BACKDROP OVERLAY FOR MOBILE SIDEBAR */
    .sidebar-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
        z-index: 1050;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.25s ease, visibility 0.25s ease;
    }
    #main-wrapper.show-sidebar .sidebar-backdrop {
        opacity: 1;
        visibility: visible;
    }

    /* 6. MOBILE REFINEMENTS (< 768px) */
    @media (max-width: 767.98px) {
        .container-fluid {
            padding-left: 14px !important;
            padding-right: 14px !important;
            padding-top: 14px !important;
        }

        .app-header .px-4 {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .card {
            margin-bottom: 14px !important;
            border-radius: 12px !important;
        }

        .card-body {
            padding: 14px !important;
        }

        .card-header {
            padding: 12px 14px !important;
        }

        /* Form elements full fluid width */
        .form-control.col-3, select.col-3, input.col-3 {
            width: 100% !important;
            flex: 1 1 auto !important;
        }

        .form-control, .form-select {
            max-width: 100% !important;
        }

        /* Breadcrumb banner cards clean stacking */
        .bg-light-info .col-3 {
            display: none !important;
        }
        .bg-light-info .col-9 {
            width: 100% !important;
        }

        /* Responsive Tables & DataTables */
        .table-responsive {
            -webkit-overflow-scrolling: touch;
            width: 100% !important;
            margin-bottom: 1rem;
        }

        div.dataTables_wrapper {
            width: 100% !important;
            overflow-x: auto !important;
        }

        div.dataTables_wrapper div.dataTables_length,
        div.dataTables_wrapper div.dataTables_filter,
        div.dataTables_wrapper div.dataTables_info,
        div.dataTables_wrapper div.dataTables_paginate {
            text-align: left !important;
            float: none !important;
            width: 100% !important;
            margin-bottom: 10px !important;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            width: 100% !important;
            margin-left: 0 !important;
            margin-top: 4px !important;
        }

        div.dataTables_wrapper div.dataTables_paginate {
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
            gap: 4px !important;
        }
    }

    /* 7. EXTRA SMALL SCREENS (< 576px) */
    @media (max-width: 575.98px) {
        #dropUserMenu {
            padding: 0 8px 0 4px !important;
        }

        #dropUserMenu .user-name-display {
            max-width: 80px !important;
            font-size: 0.78rem !important;
        }

        .dropdown-menu {
            max-width: calc(100vw - 20px) !important;
        }

        .floating-button {
            bottom: 20px !important;
            right: 16px !important;
            width: 48px !important;
            height: 48px !important;
        }

        .floating-button i {
            font-size: 16px !important;
        }

        .floating-button span {
            font-size: 9px !important;
        }
    }

    /* 8. ULTRA SMALL SCREENS (< 420px) */
    @media (max-width: 420px) {
        #dropUserMenu .user-name-display {
            display: none !important;
        }
    }
    @media print {
        body {
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
        @page {
            size: portrait;
            margin: 10mm;
        }
    }
    .floating-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
        color: #fff;
        border-radius: 50%;
        box-shadow: 0 6px 20px rgba(225, 29, 72, 0.4);
        cursor: pointer;
        text-align: center;
        text-decoration: none !important;
        width: 58px;
        height: 58px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 2px;
        z-index: 999;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .floating-button:hover {
        transform: scale(1.08);
        background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
        color: #fff;
        box-shadow: 0 8px 24px rgba(225, 29, 72, 0.5);
    }
    .floating-button i {
        font-size: 19px;
        line-height: 1;
    }
    .floating-button span {
        font-size: 11px;
        font-weight: 600;
        line-height: 1;
        letter-spacing: 0.3px;
        color: #fff;
    }
  </style>

</head>

<body>

  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <div class="">
      <!-- Sidebar Start -->
      <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
          <!-- Brand Logo Header -->
          <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{URL::to('admin/dashboard')}}" class="text-nowrap logo-img">
              <img src="{{ asset('frontend/images/logo-brand.png') }}" alt="AskReview Logo" style="height: 42px; width: auto; max-width: 155px; object-fit: contain; border-radius: 6px;" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-6 text-muted"></i>
            </div>
          </div>

          <!-- Sidebar Navigation -->
          <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">

              {{-- ========================================================= --}}
              {{-- 1. SUPER ADMIN MENU --}}
              {{-- ========================================================= --}}
              @if (Auth::user()->type == 'super_admin')
                


                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/dashboard')}}" aria-expanded="false">
                    <span><i class="ti ti-dashboard"></i></span>
                    <span class="hide-menu">Dashboard</span>
                  </a>
                </li>

                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">Platform Management</span>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/admin_list')}}" aria-expanded="false">
                    <span><i class="ti ti-users"></i></span>
                    <span class="hide-menu">Resellers</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/category')}}" aria-expanded="false">
                    <span><i class="ti ti-category-2"></i></span>
                    <span class="hide-menu">Category</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/template')}}" aria-expanded="false">
                    <span><i class="ti ti-layout-grid"></i></span>
                    <span class="hide-menu">Templates</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/wallets_list')}}" aria-expanded="false">
                    <span><i class="ti ti-wallet"></i></span>
                    <span class="hide-menu">Credit Manage</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/settings/legal')}}" aria-expanded="false">
                    <span><i class="ti ti-file-text"></i></span>
                    <span class="hide-menu">Terms &amp; Privacy</span>
                  </a>
                </li>

                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">Account</span>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/profile')}}" aria-expanded="false">
                    <span><i class="ti ti-settings"></i></span>
                    <span class="hide-menu">Settings</span>
                  </a>
                </li>

              {{-- ========================================================= --}}
              {{-- 2. ADMIN (RESELLER / DISTRIBUTOR) MENU --}}
              {{-- ========================================================= --}}
              @elseif (Auth::user()->type == 'admin')



                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/dashboard')}}" aria-expanded="false">
                    <span><i class="ti ti-dashboard"></i></span>
                    <span class="hide-menu">Dashboard</span>
                  </a>
                </li>

                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">Clients &amp; Billing</span>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/sub_user_list')}}" aria-expanded="false">
                    <span><i class="ti ti-users"></i></span>
                    <span class="hide-menu">My Users</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/my_wallets_list')}}" aria-expanded="false">
                    <span><i class="ti ti-receipt-2"></i></span>
                    <span class="hide-menu">Credit Transactions</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/service')}}" aria-expanded="false">
                    <span><i class="ti ti-packages"></i></span>
                    <span class="hide-menu">Services</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/my_user_payment_list')}}" aria-expanded="false">
                    <span><i class="ti ti-credit-card"></i></span>
                    <span class="hide-menu">User Payments</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/admin_service_payments_list')}}" aria-expanded="false">
                    <span><i class="ti ti-file-dollar"></i></span>
                    <span class="hide-menu">Service Payments</span>
                  </a>
                </li>

                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">Account</span>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/profile')}}" aria-expanded="false">
                    <span><i class="ti ti-settings"></i></span>
                    <span class="hide-menu">Settings</span>
                  </a>
                </li>

              {{-- ========================================================= --}}
              {{-- 3. USER (STORE / BUSINESS OWNER) MENU --}}
              {{-- ========================================================= --}}
              @elseif (Auth::user()->type == 'user')



                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/dashboard')}}" aria-expanded="false">
                    <span><i class="ti ti-dashboard"></i></span>
                    <span class="hide-menu">Dashboard</span>
                  </a>
                </li>

                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">Reviews &amp; Feedback</span>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/questions')}}" aria-expanded="false">
                    <span><i class="ti ti-forms"></i></span>
                    <span class="hide-menu">Manage Form</span>
                  </a>
                </li>
                
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/video_testimonial')}}" aria-expanded="false">
                    <span><i class="ti ti-video"></i></span>
                    <span class="hide-menu">Video Testimonials</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/private_review_list')}}" aria-expanded="false">
                    <span><i class="ti ti-address-book"></i></span>
                    <span class="hide-menu">Private Enquiry</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/list_question_answers')}}" aria-expanded="false">
                    <span><i class="ti ti-message-2-check"></i></span>
                    <span class="hide-menu">Feedback Data</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/social_review_list')}}" aria-expanded="false">
                    <span><i class="ti ti-star"></i></span>
                    <span class="hide-menu">Social Reviews</span>
                  </a>
                </li>
                

                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">Growth &amp; Tools</span>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/user_payments_list')}}" aria-expanded="false">
                    <span><i class="ti ti-crown"></i></span>
                    <span class="hide-menu">Subscriptions</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/review_links')}}" aria-expanded="false">
                    <span><i class="ti ti-plug"></i></span>
                    <span class="hide-menu">Integrations</span>
                  </a>
                </li>

                @php
                  $isAnalyticsActive = Request::is('admin/qr_analytics*') || Request::is('admin/links_analytics*');
                @endphp
                <li class="sidebar-item {{ $isAnalyticsActive ? 'selected' : '' }}">
                  <a class="sidebar-link {{ $isAnalyticsActive ? 'active' : '' }}" href="javascript:void(0)" aria-expanded="{{ $isAnalyticsActive ? 'true' : 'false' }}" data-bs-toggle="collapse" data-bs-target="#analytics-submenu">
                    <span><i class="ti ti-chart-pie"></i></span>
                    <span class="hide-menu">Analytics</span>
                    <span class="hide-menu ms-auto"><i class="ti ti-chevron-down" style="font-size: 0.9rem;"></i></span>
                  </a>
                  <ul class="collapse first-level {{ $isAnalyticsActive ? 'show' : '' }}" id="analytics-submenu">
                    <li class="sidebar-item">
                      <a class="sidebar-link {{ Request::is('admin/qr_analytics*') ? 'active' : '' }}" href="{{URL::to('admin/qr_analytics')}}">
                        <span><i class="ti ti-qrcode"></i></span>
                        <span class="hide-menu">QR Analytics</span>
                      </a>
                    </li>
                    <li class="sidebar-item">
                      <a class="sidebar-link {{ Request::is('admin/links_analytics*') ? 'active' : '' }}" href="{{URL::to('admin/links_analytics')}}">
                        <span><i class="ti ti-chart-arrows"></i></span>
                        <span class="hide-menu">Links Analytics</span>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">Support &amp; Account</span>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{URL::to('admin/profile')}}" aria-expanded="false">
                    <span><i class="ti ti-settings"></i></span>
                    <span class="hide-menu">Settings</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="javascript:void(0)" onclick="get_support()" aria-expanded="false">
                    <span><i class="ti ti-headset"></i></span>
                    <span class="hide-menu">Need Support?</span>
                  </a>
                </li>
                
              @endif

            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!-- Sidebar End -->

      <!-- Mobile Backdrop Overlay -->
      <div class="sidebar-backdrop d-lg-none"></div>

      <!-- Main wrapper -->
      <div class="body-wrapper d-flex flex-column min-vh-100">

        <!-- Header Start -->
        <header class="app-header" style="width: 100% !important; position: sticky; top: 0; z-index: 99; background: #ffffff; border-bottom: 1px solid #f1f5f9; box-shadow: 0 1px 4px rgba(0,0,0,0.04);">
          <div class="d-flex align-items-center justify-content-between px-3 px-md-4" style="height: 64px; gap: 8px;">

            <!-- LEFT: Hamburger + Role Indicator -->
            <div class="d-flex align-items-center gap-3 flex-shrink-0">
              <!-- Sidebar Toggle -->
              <a class="sidebartoggler d-flex align-items-center justify-content-center" id="headerCollapse" href="javascript:void(0)" style="width: 38px; height: 38px; border-radius: 10px; background: #f8fafc; border: 1px solid #e2e8f0; color: #475569; transition: all 0.2s ease; text-decoration: none;">
                <i class="ti ti-menu-2" style="font-size: 1.1rem;"></i>
              </a>

              <!-- Role Indicator Pill -->
              @if(Auth::user()->type == 'user')
                <div id="navbarLiveReviewPill" class="d-none d-xl-flex align-items-center gap-2 px-3" style="height: 36px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 9999px; font-size: 0.82rem; white-space: nowrap;">
                  <span style="width: 8px; height: 8px; border-radius: 50%; background: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,0.15); flex-shrink: 0;"></span>
                  <span class="text-muted fw-500">Live:</span>
                  <a href="{{ url('u/'.Auth::user()->name_url) }}" target="_blank" class="fw-bold text-dark text-decoration-none d-flex align-items-center gap-1">
                    <span>{{ Auth::user()->name_url }}</span>
                    <i class="ti ti-external-link" style="font-size: 0.8rem; color: #e11d48;"></i>
                  </a>
                </div>
              @elseif(Auth::user()->type == 'admin')
                <div class="d-none d-md-flex align-items-center gap-2 px-3" style="height: 36px; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 9999px; color: #e11d48; font-size: 0.82rem; font-weight: 700; white-space: nowrap;">
                  <i class="ti ti-wallet" style="font-size: 0.95rem;"></i>
                  <span>{{ Auth::user()->user_create_limit }} Credits</span>
                </div>
              @else
                <div class="d-none d-md-flex align-items-center gap-2 px-3" style="height: 36px; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 9999px; color: #475569; font-size: 0.82rem; font-weight: 700; white-space: nowrap;">
                  <i class="ti ti-shield-check" style="font-size: 0.95rem; color: #6366f1;"></i>
                  <span>Super Admin</span>
                </div>
              @endif
            </div>

            <!-- RIGHT: Actions bar -->
            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">

              @php
                $noti_num = DB::table('notifications')->where('user_id', Auth::user()->id)->where('action_taken','!=','Y')->count();
                $noti_list = DB::table('notifications')->where('user_id', Auth::user()->id)->where('action_taken','!=','Y')->get();
              @endphp

              @if(Auth::user()->type == 'user')
                @php
                  $expiry_timestamp = strtotime(Auth::user()->expiry_date);
                  $days_difference = max(0, floor(($expiry_timestamp - time()) / 86400));
                @endphp

                <!-- Trial badge -->
                @if(Auth::user()->seven_day_trial == 'YES')
                  <div class="d-none d-md-flex align-items-center gap-1 px-2" style="height: 32px; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 9999px; color: #e11d48; font-size: 0.76rem; font-weight: 700; white-space: nowrap;">
                    <span class="spinner-grow spinner-grow-sm" style="width: 5px; height: 5px; color: #e11d48; flex-shrink:0;"></span>
                    <span>{{ $days_difference }}d left</span>
                  </div>
                @endif

                <!-- Customer QR Experience Flow Mode Selector (Fully Responsive Luxury UI) -->
                <style>
                  .qr-flow-btn {
                    height: 32px !important;
                    border-radius: 9999px !important;
                    font-size: 0.76rem !important;
                    font-weight: 700 !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    gap: 6px !important;
                    padding: 0 13px !important;
                    border: 1px solid transparent !important;
                    outline: none !important;
                    text-decoration: none !important;
                    cursor: pointer !important;
                    white-space: nowrap !important;
                    flex-shrink: 0 !important;
                    transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1) !important;
                  }
                  .qr-flow-btn.mode-funnel {
                    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%) !important;
                    border-color: #fde68a !important;
                    color: #92400e !important;
                    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.16) !important;
                  }
                  .qr-flow-btn.mode-funnel:hover, .qr-flow-btn.mode-funnel:focus {
                    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
                    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.28) !important;
                    transform: translateY(-1px);
                  }
                  .qr-flow-btn.mode-direct {
                    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%) !important;
                    border-color: #bfdbfe !important;
                    color: #1e40af !important;
                    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.14) !important;
                  }
                  .qr-flow-btn.mode-direct:hover, .qr-flow-btn.mode-direct:focus {
                    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%) !important;
                    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.24) !important;
                    transform: translateY(-1px);
                  }
                  .qr-flow-dropdown {
                    min-width: 330px !important;
                    width: 375px !important;
                    max-width: calc(100vw - 20px) !important;
                    border-radius: 22px !important;
                    border: 1px solid rgba(226, 232, 240, 0.9) !important;
                    background: #ffffff !important;
                    box-shadow: 0 25px 60px -12px rgba(15, 23, 42, 0.25), 0 0 0 1px rgba(241, 245, 249, 0.9) !important;
                    padding: 0 !important;
                    overflow: hidden !important;
                    margin-top: 8px !important;
                  }
                  .qr-flow-card {
                    border-radius: 14px;
                    padding: 12px 13px;
                    transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
                    cursor: pointer;
                    position: relative;
                  }
                  .qr-flow-card.active-funnel {
                    background: linear-gradient(145deg, #fffbeb 0%, #fff7ed 100%) !important;
                    border: 2px solid #f59e0b !important;
                    box-shadow: 0 6px 20px -3px rgba(245, 158, 11, 0.22) !important;
                  }
                  .qr-flow-card.active-direct {
                    background: linear-gradient(145deg, #eff6ff 0%, #f0fdfa 100%) !important;
                    border: 2px solid #3b82f6 !important;
                    box-shadow: 0 6px 20px -3px rgba(59, 130, 246, 0.22) !important;
                  }
                  .qr-flow-card.inactive {
                    background: #f8fafc !important;
                    border: 1.5px solid #e2e8f0 !important;
                  }
                  .qr-flow-card.inactive:hover {
                    background: #ffffff !important;
                    border-color: #cbd5e1 !important;
                    transform: translateY(-2px);
                    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.06);
                  }
                  .qr-flow-card-title {
                    font-size: 0.86rem !important;
                    font-weight: 800 !important;
                    color: #0f172a !important;
                    white-space: nowrap !important;
                    line-height: 1.2 !important;
                  }
                  .qr-flow-tag-recommended {
                    background: #fef3c7 !important;
                    color: #92400e !important;
                    font-size: 0.62rem !important;
                    font-weight: 700 !important;
                    padding: 2px 7px !important;
                    border-radius: 9999px !important;
                    border: 1px solid #fde68a !important;
                    white-space: nowrap !important;
                    display: inline-block !important;
                    line-height: 1 !important;
                  }
                  .qr-flow-tag-direct {
                    background: #dbeafe !important;
                    color: #1e40af !important;
                    font-size: 0.62rem !important;
                    font-weight: 700 !important;
                    padding: 2px 7px !important;
                    border-radius: 9999px !important;
                    border: 1px solid #bfdbfe !important;
                    white-space: nowrap !important;
                    display: inline-block !important;
                    line-height: 1 !important;
                  }
                  .qr-flow-badge-active {
                    background: linear-gradient(135deg, #10b981, #059669) !important;
                    color: #ffffff !important;
                    font-size: 0.66rem !important;
                    font-weight: 800 !important;
                    border-radius: 9999px !important;
                    padding: 3px 9px !important;
                    white-space: nowrap !important;
                    box-shadow: 0 2px 6px rgba(16, 185, 129, 0.35) !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    gap: 3px !important;
                    line-height: 1.2 !important;
                  }
                  .qr-flow-badge-active-blue {
                    background: linear-gradient(135deg, #3b82f6, #1d4ed8) !important;
                    color: #ffffff !important;
                    font-size: 0.66rem !important;
                    font-weight: 800 !important;
                    border-radius: 9999px !important;
                    padding: 3px 9px !important;
                    white-space: nowrap !important;
                    box-shadow: 0 2px 6px rgba(59, 130, 246, 0.35) !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    gap: 3px !important;
                    line-height: 1.2 !important;
                  }
                  .qr-flow-badge-action {
                    background: #ffffff !important;
                    border: 1px solid #cbd5e1 !important;
                    color: #475569 !important;
                    font-size: 0.66rem !important;
                    font-weight: 700 !important;
                    border-radius: 9999px !important;
                    padding: 3px 10px !important;
                    white-space: nowrap !important;
                    display: inline-block !important;
                    line-height: 1.2 !important;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
                    transition: all 0.15s ease !important;
                  }
                  .qr-flow-card:hover .qr-flow-badge-action {
                    background: #0f172a !important;
                    color: #ffffff !important;
                    border-color: #0f172a !important;
                  }
                  .qr-flow-points {
                    display: flex !important;
                    flex-direction: column !important;
                    gap: 3px !important;
                    padding-left: 1px !important;
                  }
                  .qr-flow-point {
                    display: flex !important;
                    align-items: flex-start !important;
                    gap: 6px !important;
                    font-size: 0.72rem !important;
                    font-weight: 600 !important;
                    line-height: 1.35 !important;
                  }
                  .qr-flow-point.point-green { color: #166534 !important; }
                  .qr-flow-point.point-amber { color: #9a3412 !important; }
                  .qr-flow-point.point-blue { color: #1e40af !important; }
                  .qr-flow-point.point-indigo { color: #4338ca !important; }
                  .qr-flow-point i { margin-top: 2px !important; flex-shrink: 0 !important; }
                  .qr-flow-preview-btn {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                    width: 100%;
                    padding: 10px 16px;
                    background: linear-gradient(135deg, #2563eb, #1d4ed8);
                    color: #ffffff !important;
                    font-weight: 700;
                    font-size: 0.78rem;
                    border-radius: 12px;
                    text-decoration: none !important;
                    transition: all 0.2s ease;
                    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.28);
                  }
                  .qr-flow-preview-btn:hover {
                    transform: translateY(-1px);
                    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.38);
                    color: #ffffff !important;
                    filter: brightness(1.08);
                  }

                  /* Responsive Mobile Adjustments */
                  @media (max-width: 576px) {
                    .qr-flow-btn {
                      padding: 0 9px !important;
                      font-size: 0.72rem !important;
                    }
                    .qr-flow-dropdown {
                      width: calc(100vw - 20px) !important;
                      min-width: 0 !important;
                      max-width: 360px !important;
                      right: -6px !important;
                      border-radius: 18px !important;
                    }
                    .qr-flow-card {
                      padding: 10px 12px !important;
                    }
                    .qr-flow-card-title {
                      font-size: 0.82rem !important;
                    }
                    .qr-flow-point {
                      font-size: 0.69rem !important;
                    }
                  }
                </style>

                <div class="dropdown">
                  <button type="button" id="dropQrFlowMode" data-bs-toggle="dropdown" aria-expanded="false" 
                    class="qr-flow-btn @if(Auth::user()->star_page == 'YES') mode-funnel @else mode-direct @endif"
                    title="Click to configure QR landing page experience"
                  >
                    @if(Auth::user()->star_page == 'YES')
                      <span class="d-inline-block rounded-circle" style="width: 7px; height: 7px; background: #f59e0b; box-shadow: 0 0 8px #f59e0b;"></span>
                      <i class="fa-solid fa-star" style="font-size: 0.74rem; color: #d97706;"></i>
                      <span class="d-none d-sm-inline">5★ Funnel Mode</span>
                      <span class="d-inline d-sm-none">5★ Funnel</span>
                      <i class="ti ti-chevron-down opacity-60 ms-0.5" style="font-size: 0.72rem;"></i>
                    @else
                      <span class="d-inline-block rounded-circle" style="width: 7px; height: 7px; background: #2563eb; box-shadow: 0 0 8px #2563eb;"></span>
                      <i class="fa-solid fa-bolt" style="font-size: 0.74rem; color: #2563eb;"></i>
                      <span class="d-none d-sm-inline">Direct Links</span>
                      <span class="d-inline d-sm-none">Direct</span>
                      <i class="ti ti-chevron-down opacity-60 ms-0.5" style="font-size: 0.72rem;"></i>
                    @endif
                  </button>

                  <!-- Dropdown Menu -->
                  <div class="dropdown-menu dropdown-menu-end qr-flow-dropdown shadow-lg" aria-labelledby="dropQrFlowMode">
                    
                    <!-- Dark Executive Header -->
                    <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 15px 16px; color: #ffffff; position: relative;">
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div class="d-flex align-items-center gap-2">
                          <div style="width: 30px; height: 30px; border-radius: 9px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.15); display: flex; align-items: center; justify-content: center; color: #38bdf8; flex-shrink: 0;">
                            <i class="ti ti-qrcode" style="font-size: 1.1rem;"></i>
                          </div>
                          <span style="font-size: 0.9rem; font-weight: 800; color: #ffffff; letter-spacing: -0.01em;">Customer QR Flow</span>
                        </div>
                        <span style="background: rgba(255, 255, 255, 0.12); color: #93c5fd; font-size: 0.62rem; font-weight: 700; border-radius: 9999px; padding: 2px 8px; border: 1px solid rgba(255, 255, 255, 0.15); white-space: nowrap;">
                          LANDING MODE
                        </span>
                      </div>
                      <p class="mb-0" style="font-size: 0.72rem; color: #94a3b8; line-height: 1.35;">
                        Choose what customers see when scanning your QR code:
                      </p>
                    </div>

                    <!-- Options Body -->
                    <div class="p-2.5 p-sm-3" style="display: flex; flex-direction: column; gap: 9px; background: #ffffff;">
                      
                      <!-- Option 1: 5-Star Smart Funnel -->
                      <form action="{{ URL::to('admin/star_page_status') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <input type="hidden" name="star_page" value="YES">
                        <div onclick="this.closest('form').submit()" role="button" 
                          class="qr-flow-card @if(Auth::user()->star_page == 'YES') active-funnel @else inactive @endif text-start"
                        >
                          <div class="d-flex align-items-center justify-content-between gap-2 mb-1.5">
                            <div class="d-flex align-items-center gap-2" style="min-width: 0;">
                              <div style="width: 32px; height: 32px; border-radius: 50%; background: {{ Auth::user()->star_page == 'YES' ? '#fde68a' : '#e2e8f0' }}; color: {{ Auth::user()->star_page == 'YES' ? '#d97706' : '#64748b' }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="fa-solid fa-star" style="font-size: 0.82rem;"></i>
                              </div>
                              <div style="min-width: 0;">
                                <div class="d-flex align-items-center gap-1.5 flex-wrap">
                                  <span class="qr-flow-card-title">5★ Review Funnel</span>
                                  <span class="qr-flow-tag-recommended">Recommended</span>
                                </div>
                              </div>
                            </div>
                            
                            <div style="flex-shrink: 0;">
                              @if(Auth::user()->star_page == 'YES')
                                <span class="qr-flow-badge-active">
                                  <i class="fa-solid fa-check"></i> ACTIVE
                                </span>
                              @else
                                <span class="qr-flow-badge-action">
                                  Activate
                                </span>
                              @endif
                            </div>
                          </div>

                          <div class="qr-flow-points">
                            <div class="qr-flow-point point-green">
                              <i class="fa-solid fa-circle-check text-success"></i>
                              <span><strong>Filters bad reviews:</strong> 4–5★ go to Google Reviews</span>
                            </div>
                            <div class="qr-flow-point point-amber">
                              <i class="fa-solid fa-shield-halved text-warning"></i>
                              <span><strong>Reputation shield:</strong> 1–3★ go to private feedback</span>
                            </div>
                          </div>
                        </div>
                      </form>

                      <!-- Option 2: Direct Platform Links -->
                      <form action="{{ URL::to('admin/star_page_status') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <input type="hidden" name="star_page" value="NO">
                        <div onclick="this.closest('form').submit()" role="button" 
                          class="qr-flow-card @if(Auth::user()->star_page != 'YES') active-direct @else inactive @endif text-start"
                        >
                          <div class="d-flex align-items-center justify-content-between gap-2 mb-1.5">
                            <div class="d-flex align-items-center gap-2" style="min-width: 0;">
                              <div style="width: 32px; height: 32px; border-radius: 50%; background: {{ Auth::user()->star_page != 'YES' ? '#dbeafe' : '#e2e8f0' }}; color: {{ Auth::user()->star_page != 'YES' ? '#1d4ed8' : '#64748b' }}; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="fa-solid fa-bolt" style="font-size: 0.82rem;"></i>
                              </div>
                              <div style="min-width: 0;">
                                <div class="d-flex align-items-center gap-1.5 flex-wrap">
                                  <span class="qr-flow-card-title">Direct Platform Links</span>
                                  <span class="qr-flow-tag-direct">Direct</span>
                                </div>
                              </div>
                            </div>

                            <div style="flex-shrink: 0;">
                              @if(Auth::user()->star_page != 'YES')
                                <span class="qr-flow-badge-active-blue">
                                  <i class="fa-solid fa-check"></i> ACTIVE
                                </span>
                              @else
                                <span class="qr-flow-badge-action">
                                  Activate
                                </span>
                              @endif
                            </div>
                          </div>

                          <div class="qr-flow-points">
                            <div class="qr-flow-point point-blue">
                              <i class="fa-solid fa-bolt text-primary"></i>
                              <span><strong>Instant links:</strong> Skips star rating screen completely</span>
                            </div>
                            <div class="qr-flow-point point-indigo">
                              <i class="fa-solid fa-arrow-up-right-from-square text-indigo"></i>
                              <span>Directly shows your Google & social review links</span>
                            </div>
                          </div>
                        </div>
                      </form>

                    </div>

                    <!-- Live Preview Footer with Custom CTA Button -->
                    <div style="padding: 11px 14px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                      <a href="{{ URL::to('u/'.Auth::user()->user_name) }}" target="_blank" class="qr-flow-preview-btn">
                        <i class="ti ti-external-link" style="font-size: 0.95rem;"></i>
                        <span>Test & Preview Live QR Page</span>
                      </a>
                    </div>

                  </div>
                </div>

                <!-- Buy Plan Button -->
                @if($days_difference <= 30)
                  <button onclick="get_plans()" class="btn d-flex align-items-center gap-1" style="height: 32px; background: linear-gradient(135deg, #e11d48, #be123c); color: #fff; font-weight: 700; border-radius: 9999px; padding: 0 14px; border: none; box-shadow: 0 3px 10px rgba(225,29,72,0.25); font-size: 0.8rem; white-space: nowrap;">
                    <i class="ti ti-crown" style="font-size: 0.85rem;"></i>
                    <span>Buy Plan</span>
                  </button>
                @endif
              @endif

              <!-- Notification Bell -->
              <div class="dropdown">
                <a href="javascript:void(0)" id="dropNotification" data-bs-toggle="dropdown" aria-expanded="false" class="position-relative d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; border-radius: 50%; background: #f8fafc; border: 1px solid #e2e8f0; color: #64748b; text-decoration: none; transition: all 0.2s ease;">
                  <i class="ti ti-bell" style="font-size: 1.1rem;"></i>
                  @if($noti_num > 0)
                    <span class="position-absolute" style="top: 2px; right: 2px; width: 16px; height: 16px; border-radius: 50%; background: #e11d48; color: #fff; font-size: 0.6rem; font-weight: 700; display: flex; align-items: center; justify-content: center; border: 2px solid #fff;">{{ $noti_num }}</span>
                  @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="min-width: 290px; width: 320px; max-width: calc(100vw - 24px); border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 12px 32px rgba(0,0,0,0.1); padding: 0; overflow: hidden;">
                  <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                    <h6 class="mb-0 fw-bold" style="color: #0f172a; font-size: 0.92rem;">Notifications</h6>
                    <span class="badge rounded-pill" style="background: #fff1f2; color: #e11d48; font-weight: 700; font-size: 0.72rem;">{{ $noti_num }} new</span>
                  </div>
                  <div style="max-height: 280px; overflow-y: auto;">
                    @forelse($noti_list as $item)
                      <a href="{{ URL::to('admin/view_noti/'.$item->id) }}" class="d-flex align-items-center gap-3 px-4 py-3 border-bottom text-decoration-none" style="color: #334155; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <div style="width: 34px; height: 34px; border-radius: 50%; background: #fff1f2; display: flex; align-items: center; justify-content: center; color: #e11d48; flex-shrink: 0; font-size: 0.9rem;">
                          <i class="ti ti-bell"></i>
                        </div>
                        <span class="text-truncate fw-semibold" style="font-size: 0.84rem;">{{ $item->text }}</span>
                      </a>
                    @empty
                      <div class="py-5 text-center text-muted" style="font-size: 0.84rem;">
                        <i class="ti ti-bell-off d-block mb-2" style="font-size: 1.5rem; color: #cbd5e1;"></i>
                        No new notifications
                      </div>
                    @endforelse
                  </div>
                </div>
              </div>

              <!-- User Profile Dropdown -->
              <div class="dropdown">
                <a href="javascript:void(0)" id="dropUserMenu" data-bs-toggle="dropdown" aria-expanded="false" class="d-flex align-items-center gap-2 text-decoration-none" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 9999px; height: 36px; padding: 0 12px 0 5px; transition: all 0.2s ease;">
                  <div style="width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg, #e11d48, #be123c); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800; font-size: 0.78rem; flex-shrink: 0;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                  </div>
                  <span class="fw-bold user-name-display" style="color: #0f172a; font-size: 0.82rem; max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Auth::user()->name }}</span>
                  <i class="ti ti-chevron-down text-muted" style="font-size: 0.72rem; flex-shrink: 0;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="min-width: 260px; max-width: calc(100vw - 24px); border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 12px 32px rgba(0,0,0,0.1); padding: 0; overflow: hidden; margin-top: 8px;">
                  <!-- User Info Card -->
                  <div class="d-flex align-items-center gap-3 p-4 border-bottom" style="background: #f8fafc;">
                    <div style="width: 44px; height: 44px; border-radius: 50%; background: #e11d48; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.1rem; flex-shrink: 0;">
                      {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                      <div class="fw-bold text-truncate" style="color: #0f172a; font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                      <div class="text-truncate" style="color: #94a3b8; font-size: 0.76rem;">{{ Auth::user()->email }}</div>
                      <span class="badge mt-1" style="background: #e2e8f0; color: #475569; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em;">{{ str_replace('_', ' ', Auth::user()->type) }}</span>
                    </div>
                  </div>
                  <!-- Menu Items -->
                  <div class="p-3 d-flex flex-column gap-1">
                    @if(Auth::user()->type == 'user')
                      <a href="{{ URL::to('u/'.Auth::user()->name_url) }}" target="_blank" class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-2 fw-600" style="color: #334155; font-size: 0.85rem; font-weight: 600;">
                        <i class="ti ti-world" style="color: #10b981;"></i> View My Review Page
                      </a>
                      <a href="{{ URL::to('admin/view_qr') }}" class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-2" style="color: #334155; font-size: 0.85rem; font-weight: 600;">
                        <i class="ti ti-qrcode" style="color: #e11d48;"></i> Download QR
                      </a>
                    @elseif(Auth::user()->type == 'admin')
                      <a href="{{ URL::to('site/'.Auth::user()->name_url) }}" target="_blank" class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-2" style="color: #334155; font-size: 0.85rem; font-weight: 600;">
                        <i class="ti ti-link" style="color: #10b981;"></i> Client Signup Link
                      </a>
                    @endif
                    <a href="{{ URL::to('admin/profile') }}" class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-2" style="color: #334155; font-size: 0.85rem; font-weight: 600;">
                      <i class="ti ti-settings" style="color: #6366f1;"></i> Account Settings
                    </a>
                    <hr class="my-1" style="border-color: #f1f5f9;">
                    <a href="{{ URL::to('logout') }}" class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-2" style="color: #ef4444; font-size: 0.85rem; font-weight: 700;">
                      <i class="ti ti-logout"></i> Sign Out
                    </a>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </header>
        <!-- Header End -->

        <!-- Main Content Area -->
        <main class="flex-grow-1">
          @yield('content')
        </main>


        <!-- Modern Footer Start -->
        <footer class="app-footer text-center">
          <div class="container-fluid d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2">
            <div>
              &copy; {{ date('Y') }} <strong style="color: #0f172a;">AskReview</strong>. All rights reserved.
            </div>
            <div class="d-flex align-items-center gap-3" style="font-size: 0.8rem;">
              <a href="https://askreview.in" target="_blank">Home</a>
              <span>•</span>
              <a href="javascript:void(0)" onclick="get_support()">Support</a>
              <span>•</span>
              <a href="{{ URL::to('admin/profile') }}">Settings</a>
            </div>
          </div>
        </footer>
        <!-- Modern Footer End -->
      
      </div>
    </div>
  </div>


 

  <!--  Mobilenavbar -->
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar"
    aria-labelledby="offcanvasWithBothOptionsLabel">
    <nav class="sidebar-nav scroll-sidebar">
      <div class="offcanvas-header justify-content-between">
        <span class="fw-bold fs-5 text-primary"><i class="ti ti-brand-slack me-1"></i>AskReview</span>
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
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="ti ti-message-dots text-primary fs-6"></i>
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Chat Application</h6>
                    <span class="fs-2 d-block fw-normal text-muted">New messages arrived</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="ti ti-file-invoice text-info fs-6"></i>
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Invoice App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get latest invoice</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="ti ti-phone text-success fs-6"></i>
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Contact Application</h6>
                    <span class="fs-2 d-block fw-normal text-muted">2 Unsaved Contacts</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="ti ti-mail text-warning fs-6"></i>
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Email App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get new emails</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="ti ti-user text-danger fs-6"></i>
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">User Profile</h6>
                    <span class="fs-2 d-block fw-normal text-muted">learn more information</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="ti ti-calendar text-primary fs-6"></i>
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Calendar App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get dates</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="ti ti-lifebuoy text-secondary fs-6"></i>
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Contact List Table</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Add new contact</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="ti ti-notes text-dark fs-6"></i>
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
                  Your review QR codes and customer feedback collection are temporarily locked. Renew your plan today to instantly restore uninterrupted services.
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


    <div class="modal fade" id="plan_list_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="plan_list_modalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 1140px;">
        <div class="modal-content" style="border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 25px 60px -15px rgba(15, 23, 42, 0.25); overflow: hidden; background: #f8fafc;">
          
          <style>
            .modern-pricing-card {
              transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1) !important;
            }
            .modern-pricing-card:hover {
              transform: translateY(-8px) !important;
              box-shadow: 0 24px 48px -12px rgba(15, 23, 42, 0.16) !important;
            }
          </style>

          <!-- Modern Header -->
          <div class="modal-header border-0 pb-0" style="padding: 28px 32px 12px; background: transparent;">
            <div class="w-100 text-center position-relative">
              <div style="display: inline-flex; align-items: center; gap: 8px; background: #fff1f2; border: 1px solid #fecdd3; color: #e11d48; font-weight: 700; font-size: 0.78rem; padding: 4px 14px; border-radius: 9999px; margin-bottom: 10px;">
                <i class="ti ti-sparkles"></i>
                <span>Choose Your Growth Plan</span>
              </div>
              <h2 style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; color: #0f172a; font-size: 1.65rem; margin-bottom: 6px; letter-spacing: -0.02em;">
                Upgrade to AskReview Pro
              </h2>
              <p style="color: #64748b; font-size: 0.92rem; max-width: 580px; margin: 0 auto;">
                Get more genuine reviews, video testimonials, and higher search rankings. Select the plan that fits your business.
              </p>
              <button type="button" class="btn-close position-absolute top-0 end-0" onclick="close_expiry_modal()" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.6;"></button>
            </div>
          </div>

          <!-- Modal Body with Plans -->
          <div class="modal-body" style="padding: 24px 32px 32px;">
            @php
                $Service = DB::table('services')->where('status','publish')->orderByRaw('CAST(price AS DECIMAL(10,2)) ASC')->get();
                $count = count($Service);
                if ($count == 1) {
                    $colClass = 'col-lg-5 col-md-8 mx-auto';
                } elseif ($count == 2) {
                    $colClass = 'col-lg-6 col-md-6';
                } elseif ($count == 3) {
                    $colClass = 'col-lg-4 col-md-6';
                } else {
                    $colClass = 'col-lg-3 col-md-6';
                }
            @endphp

            <div class="row g-4 justify-content-center align-items-stretch">
              @foreach ($Service as $key => $item)
                @php
                    $isPopular = ($count >= 2 && $key == 1); // Middle card in 3-tier setup is Most Popular
                    $isBestValue = ($count >= 3 && $key == 2); // 3rd card is Best Value
                    $years = (!empty($item->subscription_date) && is_numeric($item->subscription_date)) ? (int)$item->subscription_date : 1;
                    $durationText = $years > 1 ? $years . ' Years' : '1 Year';
                @endphp
                <div class="{{ $colClass }} d-flex">
                  <div class="modern-pricing-card w-100 d-flex flex-column position-relative" 
                       style="border-radius: 22px; padding: 32px 26px; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
                              @if($isPopular)
                                background: linear-gradient(180deg, #fff5f6 0%, #ffffff 24%);
                                border: 2.5px solid #e11d48;
                                box-shadow: 0 18px 40px -10px rgba(225, 29, 72, 0.22);
                              @elseif($isBestValue)
                                background: linear-gradient(180deg, #f5f3ff 0%, #ffffff 24%);
                                border: 2px solid #a5b4fc;
                                box-shadow: 0 12px 32px -8px rgba(79, 70, 229, 0.16);
                              @else
                                background: #ffffff;
                                border: 1.5px solid #e2e8f0;
                                box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05);
                              @endif">
                    
                    @if($isPopular)
                      <div class="position-absolute" style="top: -14px; left: 50%; transform: translateX(-50%); z-index: 2;">
                        <span style="background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; font-size: 0.74rem; font-weight: 800; padding: 5px 16px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.06em; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.35); display: inline-flex; align-items: center; gap: 4px;">
                          🔥 Most Popular
                        </span>
                      </div>
                    @elseif($isBestValue)
                      <div class="position-absolute" style="top: -14px; left: 50%; transform: translateX(-50%); z-index: 2;">
                        <span style="background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); color: #ffffff; font-size: 0.74rem; font-weight: 800; padding: 5px 16px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.06em; box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35); display: inline-flex; align-items: center; gap: 4px;">
                          👑 Best Value (Save More)
                        </span>
                      </div>
                    @endif

                    <!-- Card Header -->
                    <div class="mb-3">
                      <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                          @if($key == 0)
                            <span style="width: 28px; height: 28px; border-radius: 8px; background: #f1f5f9; display: inline-flex; align-items: center; justify-content: center; color: #475569; font-size: 0.9rem;">
                              <i class="ti ti-leaf"></i>
                            </span>
                          @elseif($isPopular)
                            <span style="width: 28px; height: 28px; border-radius: 8px; background: #ffe4e6; display: inline-flex; align-items: center; justify-content: center; color: #e11d48; font-size: 0.95rem;">
                              <i class="ti ti-flame"></i>
                            </span>
                          @else
                            <span style="width: 28px; height: 28px; border-radius: 8px; background: #ede9fe; display: inline-flex; align-items: center; justify-content: center; color: #6366f1; font-size: 0.95rem;">
                              <i class="ti ti-crown"></i>
                            </span>
                          @endif
                          <h4 style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 1.28rem; color: #0f172a; margin: 0;">
                            {{ $item->title }}
                          </h4>
                        </div>
                        <span class="badge" style="
                          @if($isPopular) background: #ffe4e6; color: #be123c;
                          @elseif($isBestValue) background: #ede9fe; color: #4338ca;
                          @else background: #f1f5f9; color: #475569; @endif
                          font-weight: 700; font-size: 0.72rem; padding: 5px 10px; border-radius: 8px;">
                          {{ $durationText }}
                        </span>
                      </div>
                      
                      <!-- Price Block -->
                      <div class="d-flex align-items-baseline gap-1 my-3">
                        <span style="font-size: 1.35rem; font-weight: 700; color: #0f172a;">₹</span>
                        <span style="font-size: 2.35rem; font-weight: 800; color: #0f172a; letter-spacing: -0.02em; font-family: 'Plus Jakarta Sans', sans-serif;">
                          {{ number_format($item->price) }}
                        </span>
                        <span style="color: #64748b; font-size: 0.85rem; font-weight: 600;">/ {{ $durationText }}</span>
                      </div>
                    </div>

                    <!-- Divider -->
                    <hr style="border-color: #f1f5f9; margin: 0 0 18px 0;">

                    <!-- Feature List -->
                    <div class="flex-grow-1 mb-4">
                      <ul class="list-unstyled d-flex flex-column gap-2 mb-0" style="font-size: 0.86rem; color: #334155;">
                        <li class="d-flex align-items-start gap-2">
                          <span style="color: #10b981; font-size: 1rem; line-height: 1.2;"><i class="ti ti-circle-check-filled"></i></span>
                          <span>Link Social Platforms (Facebook, Instagram, YouTube)</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                          <span style="color: #10b981; font-size: 1rem; line-height: 1.2;"><i class="ti ti-circle-check-filled"></i></span>
                          <span>Generate Unlimited Design QR Codes</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                          <span style="color: #10b981; font-size: 1rem; line-height: 1.2;"><i class="ti ti-circle-check-filled"></i></span>
                          <span>Direct Sync with Google Business Profile</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                          <span style="color: #10b981; font-size: 1rem; line-height: 1.2;"><i class="ti ti-circle-check-filled"></i></span>
                          <span>Full <strong>{{ $durationText }}</strong> Validity</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                          <span style="color: #10b981; font-size: 1rem; line-height: 1.2;"><i class="ti ti-circle-check-filled"></i></span>
                          <span>Customizable Feedback &amp; Review Forms</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                          <span style="color: #10b981; font-size: 1rem; line-height: 1.2;"><i class="ti ti-circle-check-filled"></i></span>
                          <span>Private Negative Feedback &amp; Enquiry Filter</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                          <span style="color: #10b981; font-size: 1rem; line-height: 1.2;"><i class="ti ti-circle-check-filled"></i></span>
                          <span>Instant Email &amp; Dashboard Notifications</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                          <span style="color: #10b981; font-size: 1rem; line-height: 1.2;"><i class="ti ti-circle-check-filled"></i></span>
                          <span>Scan QR Codes Unlimited Times</span>
                        </li>

                        <!-- Double QR Access Feature -->
                        <li class="d-flex align-items-start gap-2 mt-1">
                          @if (($item->double_qr_access ?? 'N') == 'Y')
                            <div class="w-100 d-flex align-items-center justify-content-between p-2 rounded-2" style="background: #eff6ff; border: 1px solid #bfdbfe;">
                              <div class="d-flex align-items-center gap-2">
                                <span style="color: #2563eb; font-size: 1.05rem;"><i class="ti ti-qrcode"></i></span>
                                <span style="color: #1d4ed8; font-weight: 700; font-size: 0.84rem;">
                                  Double QR Code Standee Feature
                                </span>
                              </div>
                              <span class="badge" style="background: #3b82f6; color: #fff; font-size: 0.65rem; font-weight: 700; border-radius: 999px;">Included</span>
                            </div>
                          @else
                            <div class="d-flex align-items-center gap-2" style="color: #94a3b8; font-size: 0.84rem;">
                              <span style="color: #cbd5e1; font-size: 1rem;"><i class="ti ti-x"></i></span>
                              <span style="text-decoration: line-through;">Double QR Standee Access</span>
                            </div>
                          @endif
                        </li>

                        <!-- Video Access Feature -->
                        <li class="d-flex align-items-start gap-2 mt-1">
                          @if ($item->video_access == 'Y')
                            <div class="w-100 d-flex align-items-center justify-content-between p-2 rounded-2" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                              <div class="d-flex align-items-center gap-2">
                                <span style="color: #16a34a; font-size: 1.05rem;"><i class="ti ti-video"></i></span>
                                <span style="color: #15803d; font-weight: 700; font-size: 0.84rem;">
                                  Video Testimonial Collection
                                </span>
                              </div>
                              <span class="badge" style="background: #22c55e; color: #fff; font-size: 0.65rem; font-weight: 700; border-radius: 999px;">Included</span>
                            </div>
                          @else
                            <div class="d-flex align-items-center gap-2" style="color: #94a3b8; font-size: 0.84rem;">
                              <span style="color: #cbd5e1; font-size: 1rem;"><i class="ti ti-x"></i></span>
                              <span style="text-decoration: line-through;">Video Testimonial Access</span>
                            </div>
                          @endif
                        </li>
                      </ul>
                    </div>

                    <!-- CTA Button -->
                    <div class="mt-auto pt-2">
                      <a href="{{ URL::to('admin/user_service_payment_view/' . $item->id) }}" class="text-decoration-none">
                        @if($isPopular)
                          <button class="btn w-100 d-flex align-items-center justify-content-center gap-2" 
                                  style="background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; height: 50px; font-size: 0.95rem; border-radius: 14px; border: none; box-shadow: 0 6px 20px rgba(225, 29, 72, 0.4); transition: all 0.2s ease;">
                            <span>Upgrade to {{ $item->title }}</span>
                            <i class="ti ti-arrow-right"></i>
                          </button>
                        @elseif($isBestValue)
                          <button class="btn w-100 d-flex align-items-center justify-content-center gap-2" 
                                  style="background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); color: #ffffff; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; height: 50px; font-size: 0.95rem; border-radius: 14px; border: none; box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35); transition: all 0.2s ease;">
                            <span>Select {{ $item->title }}</span>
                            <i class="ti ti-arrow-right"></i>
                          </button>
                        @else
                          <button class="btn w-100 d-flex align-items-center justify-content-center gap-2" 
                                  style="background: #0f172a; color: #ffffff; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; height: 48px; border-radius: 14px; border: none; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15); transition: all 0.2s ease;">
                            <span>Select {{ $item->title }}</span>
                            <i class="ti ti-arrow-right"></i>
                          </button>
                        @endif
                      </a>
                    </div>

                  </div>
                </div>
              @endforeach
            </div>

            <!-- Trust Badge Footer -->
            <div class="mt-4 pt-3 text-center border-top" style="border-color: #e2e8f0 !important;">
              <div class="d-flex flex-wrap align-items-center justify-content-center gap-4 text-muted" style="font-size: 0.8rem;">
                <span class="d-flex align-items-center gap-1">
                  <i class="ti ti-shield-lock" style="color: #10b981; font-size: 1rem;"></i>
                  <span>100% Secure Razorpay Checkout</span>
                </span>
                <span class="d-flex align-items-center gap-1">
                  <i class="ti ti-bolt" style="color: #f59e0b; font-size: 1rem;"></i>
                  <span>Instant Account Activation</span>
                </span>
                <span class="d-flex align-items-center gap-1">
                  <i class="ti ti-headset" style="color: #2563eb; font-size: 1rem;"></i>
                  <span>Need Help? Call 90 87 86 85 84</span>
                </span>
              </div>
            </div>

          </div>
         
        </div>
      </div>
    </div>

    
<div class="modal fade" id="add_support_modal" tabindex="-1" role="dialog" aria-labelledby="supportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 520px;">
    <div class="modal-content" style="border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 18px 24px; border-bottom: 1px solid rgba(255,255,255,0.08);">
        <div class="d-flex align-items-center gap-2">
          <div style="width: 34px; height: 34px; border-radius: 10px; background: rgba(225, 29, 72, 0.15); border: 1px solid rgba(225, 29, 72, 0.3); display: flex; align-items: center; justify-content: center; color: #fb7185;">
            <i class="ti ti-headset" style="font-size: 1.15rem;"></i>
          </div>
          <div>
            <h5 class="modal-title mb-0" id="supportModalLabel" style="color: #ffffff; font-weight: 700; font-size: 1.05rem; letter-spacing: -0.01em;">Need Help? Contact Support</h5>
            <div style="color: #94a3b8; font-size: 0.78rem;">We're here to assist you anytime</div>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close" style="opacity: 0.8; font-size: 0.85rem; filter: invert(1); cursor: pointer;"></button>
      </div>
      <div class="modal-body support_body p-0">
      
      </div>
    </div>
  </div>
</div>

<a href="http://m.me/147651825087840" target="_blank" class="floating-button"><i class="fa-regular fa-comment"></i><span>Chat</span></a>

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
  <script>
    $(document).ready(function() {
      // Close mobile drawer when clicking the backdrop overlay
      $(document).on('click', '.sidebar-backdrop', function() {
        $('#main-wrapper').removeClass('show-sidebar');
      });
      // Close mobile drawer when close button inside sidebar is clicked
      $(document).on('click', '#sidebarCollapse', function() {
        $('#main-wrapper').removeClass('show-sidebar');
      });
      // Close mobile drawer when navigation links are clicked (on screens < 992px)
      $(document).on('click', '#sidebarnav a:not([data-bs-toggle="collapse"]):not(.has-arrow)', function() {
        if (window.innerWidth < 992) {
          $('#main-wrapper').removeClass('show-sidebar');
        }
      });
    });
  </script>
  <!-- current page js files -->
  @if(Request::is('admin/dashboard') || Request::is('admin'))
  <script src="{{asset('adminAssets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('adminAssets/js/dashboard4.js')}}"></script>
  @endif
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

<script>
    if ('serviceWorker' in navigator && !navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("{{ asset('sw.js') }}").then(function (reg) {
            // registered
        }).catch(function (err) {
            // Optional PWA registration
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
    $needsGoogleOnboarding = (Auth::check() && Auth::user()->type == 'user' && (empty(Auth::user()->phone) || empty(Auth::user()->onboarding_completed) || session('needs_google_onboarding') || session('first_time_login')));
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

    @if(Auth::check() && Auth::user()->type == 'user' && (empty(Auth::user()->phone) || empty(Auth::user()->onboarding_completed) || session('needs_google_onboarding') || session('first_time_login')))
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

        // --- Indian Mobile Number Validation ---
        function validateIndianMobile(phone) {
            if (!phone) return false;
            var cleaned = phone.toString().trim().replace(/[\s\-\(\)]/g, '');
            var regex = /^(?:(?:\+|0{0,2})91|0)?[6-9]\d{9}$/;
            return regex.test(cleaned);
        }

        // Live input sanitizer
        $('#onboardingPhone').on('input', function() {
            var val = $(this).val();
            var filtered = val.replace(/[^0-9+\s\-]/g, '');
            if (val !== filtered) {
                $(this).val(filtered);
                val = filtered;
            }

            var cleaned = val.replace(/[\s\-\(\)]/g, '');
            if (cleaned.length >= 10) {
                if (validateIndianMobile(val)) {
                    $(this).css({ 'border-color': '#10b981', 'box-shadow': '0 0 0 3px rgba(16, 185, 129, 0.15)' });
                    $('#phoneValidationMsg').hide();
                } else {
                    $(this).css({ 'border-color': '#e11d48', 'box-shadow': '0 0 0 3px rgba(225, 29, 72, 0.15)' });
                    $('#phoneValidationMsg').show();
                }
            } else {
                $(this).css({ 'border-color': '#cbd5e1', 'box-shadow': 'none' });
                $('#phoneValidationMsg').hide();
            }
        });

        $('#onboardingPhone').on('blur', function() {
            var val = $(this).val().trim();
            if (val.length > 0) {
                if (!validateIndianMobile(val)) {
                    $(this).css({ 'border-color': '#e11d48', 'box-shadow': '0 0 0 3px rgba(225, 29, 72, 0.15)' });
                    $('#phoneValidationMsg').slideDown(150);
                } else {
                    $(this).css({ 'border-color': '#cbd5e1', 'box-shadow': 'none' });
                    $('#phoneValidationMsg').hide();
                }
            }
        });

        // Step 1 Form AJAX Submission
        $('#googleOnboardingForm').on('submit', function(e) {
            e.preventDefault();

            var phone = $('#onboardingPhone').val().trim();
            if (!validateIndianMobile(phone)) {
                $('#onboardingPhone').css({ 'border-color': '#e11d48', 'box-shadow': '0 0 0 3px rgba(225, 29, 72, 0.25)' }).focus();
                $('#phoneValidationMsg').slideDown(150);
                return false;
            }

            var $btn = $('#onboardingStep1Btn');
            var originalBtnHtml = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving Profile...');
            $('#step1Alert').hide();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(res) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    goToOnboardingStep(2);
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html(originalBtnHtml);
                    var msg = 'An error occurred while saving your details. Please check your inputs.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        var firstKey = Object.keys(errors)[0];
                        if (firstKey && errors[firstKey][0]) {
                            msg = errors[firstKey][0];
                        }
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    $('#step1AlertText').text(msg);
                    $('#step1Alert').slideDown(200);
                }
            });
        });
    });

    // Step switching function
    function goToOnboardingStep(step) {
        if (step === 2) {
            // Update Stepper Pill 1
            $('#stepPill1').removeClass('active').addClass('completed');
            $('#stepPill1 .step-badge').html('<i class="ti ti-check" style="font-weight: 800; font-size: 13px;"></i>').css({'background': '#10b981', 'color': '#ffffff', 'border': 'none'});
            $('#stepPill1 .step-text').css('color', '#10b981');
            $('#stepLineProgress').css('background', '#10b981');

            // Update Stepper Pill 2
            $('#stepPill2').addClass('active').removeClass('completed');
            $('#stepPill2 .step-badge').css({'background': '#2563eb', 'color': '#ffffff', 'border': 'none'});
            $('#stepPill2 .step-text').css('color', '#0f172a');

            // Header info
            $('#onboardingModalTitle').text('Connect Review Integrations');
            $('#onboardingModalSubtitle').text('Integrate platforms to start gathering verified 5-star customer reviews.');
            $('#modalHeaderIcon').css({'background': 'linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%)', 'border-color': '#bfdbfe', 'color': '#2563eb'}).html('<i class="ti ti-plug-connected"></i>');

            // Transition body containers
            $('#onboardingStep1Container').hide();
            $('#onboardingStep2Container').fadeIn(250);
        } else {
            // Back to Step 1
            $('#stepPill1').addClass('active').removeClass('completed');
            $('#stepPill1 .step-badge').text('1').css({'background': '#e11d48', 'color': '#ffffff', 'border': 'none'});
            $('#stepPill1 .step-text').css('color', '#0f172a');
            $('#stepLineProgress').css('background', '#e2e8f0');

            $('#stepPill2').removeClass('active completed');
            $('#stepPill2 .step-badge').text('2').css({'background': '#f1f5f9', 'color': '#64748b', 'border': '1px solid #cbd5e1'});
            $('#stepPill2 .step-text').css('color', '#64748b');

            $('#onboardingModalTitle').text('Complete Business Profile');
            $('#onboardingModalSubtitle').text('Please set up your store details to activate your review QR codes.');
            $('#modalHeaderIcon').css({'background': 'linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%)', 'border-color': '#fecdd3', 'color': '#e11d48'}).html('<i class="ti ti-rocket"></i>');

            $('#onboardingStep2Container').hide();
            $('#onboardingStep1Container').fadeIn(250);
        }
    }

    function skipOnboardingToDashboard() {
        var $skipBtn = $('#skipOnboardingBtn');
        $skipBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status"></span> Skipping...');
        $.ajax({
            url: "{{ route('user.skip_onboarding') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            complete: function() {
                window.location.href = "{{ url('admin/dashboard') }}";
            }
        });
    }

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

  @if(Auth::check() && Auth::user()->type == 'user' && (empty(Auth::user()->phone) || empty(Auth::user()->onboarding_completed) || session('needs_google_onboarding') || session('first_time_login')))
  <!-- ====================================================================
       2-STEP ONBOARDING POPUP MODAL (DETAILS & INTEGRATIONS)
       ==================================================================== -->
  <div class="modal fade" id="googleOnboardingModal" tabindex="-1" role="dialog" aria-labelledby="onboardingModalTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 530px; margin: 1.5rem auto;">
      <div class="modal-content" style="border-radius: 22px; border: 1px solid rgba(226, 232, 240, 0.9); box-shadow: 0 25px 60px -12px rgba(15, 23, 42, 0.25); overflow: hidden; background: #ffffff;">
        
        <!-- Header with Stepper Progress -->
        <div class="modal-header d-block" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%); border-bottom: 1px solid #f1f5f9; padding: 22px 24px 16px 24px;">
          
          <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 16px;">
            <div id="modalHeaderIcon" style="width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%); border: 1px solid #fecdd3; display: flex; align-items: center; justify-content: center; color: #e11d48; font-size: 22px; flex-shrink: 0; box-shadow: 0 4px 10px rgba(225, 29, 72, 0.1);">
              <i class="ti ti-rocket"></i>
            </div>
            <div style="flex: 1;">
              <h5 class="modal-title" id="onboardingModalTitle" style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 1.15rem; color: #0f172a; margin: 0; letter-spacing: -0.01em;">
                Complete Business Profile
              </h5>
              <p id="onboardingModalSubtitle" style="font-size: 0.8rem; color: #64748b; margin: 2px 0 0 0;">
                Please set up your store details to activate your review QR codes.
              </p>
            </div>
          </div>

          <!-- 2-Step Visual Indicator -->
          <div style="display: flex; align-items: center; justify-content: space-between; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 7px 12px;">
            <!-- Step 1 Pill -->
            <div id="stepPill1" class="step-pill active" style="display: flex; align-items: center; gap: 7px; cursor: default;">
              <span class="step-badge" style="width: 22px; height: 22px; border-radius: 50%; background: #e11d48; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 0.74rem; font-weight: 800;">1</span>
              <span class="step-text" style="font-size: 0.8rem; font-weight: 700; color: #0f172a;">Store Details</span>
            </div>

            <!-- Connector Line -->
            <div style="flex: 1; height: 3px; background: #f1f5f9; margin: 0 10px; border-radius: 2px; position: relative;">
              <div id="stepLineProgress" style="height: 100%; width: 100%; background: #e2e8f0; transition: background 0.3s ease;"></div>
            </div>

            <!-- Step 2 Pill -->
            <div id="stepPill2" class="step-pill" style="display: flex; align-items: center; gap: 7px; cursor: default;">
              <span class="step-badge" style="width: 22px; height: 22px; border-radius: 50%; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 0.74rem; font-weight: 800; border: 1px solid #cbd5e1;">2</span>
              <span class="step-text" style="font-size: 0.8rem; font-weight: 600; color: #64748b;">Review Integrations</span>
            </div>
          </div>

        </div>

        <!-- ================= STEP 1: PROFILE DETAILS ================= -->
        <div id="onboardingStep1Container" class="modal-body" style="padding: 20px 24px;">
          
          <div id="step1Alert" style="display: none; background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; padding: 10px 14px; margin-bottom: 14px; color: #991b1b; font-size: 0.82rem; font-weight: 600;">
            <i class="ti ti-alert-triangle me-1"></i> <span id="step1AlertText">Please check your inputs.</span>
          </div>

          <form method="POST" action="{{ route('google.complete_onboarding') }}" enctype="multipart/form-data" id="googleOnboardingForm">
            @csrf

            <!-- 1. Business / Store Name -->
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
                  style="height: 46px; padding-left: 44px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.92rem; color: #0f172a;"
                  autofocus
                />
              </div>
            </div>

            <!-- 2. Email Address -->
            <div class="mb-3">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <label for="onboardingEmail" style="font-weight: 700; font-size: 0.86rem; color: #1e293b; margin: 0;">
                  Email Address <span style="color: #e11d48;">*</span>
                </label>
                @if(!empty(Auth::user()->google_id) || Auth::user()->user_create_type == 'google')
                <span style="font-size: 0.72rem; font-weight: 600; color: #475569; background: #f1f5f9; padding: 2px 8px; border-radius: 6px; display: inline-flex; align-items: center; gap: 4px;">
                  <i class="ti ti-lock" style="font-size: 0.8rem; color: #64748b;"></i> Google Account (Locked)
                </span>
                @endif
              </div>
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
                  @if(!empty(Auth::user()->google_id) || Auth::user()->user_create_type == 'google') readonly tabindex="-1" style="height: 46px; padding-left: 44px; padding-right: 40px; border-radius: 12px; border: 1.5px solid #e2e8f0; font-size: 0.92rem; color: #475569; background-color: #f8fafc; cursor: not-allowed;" @else style="height: 46px; padding-left: 44px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.92rem; color: #0f172a;" @endif 
                  required 
                />
                @if(!empty(Auth::user()->google_id) || Auth::user()->user_create_type == 'google')
                <span style="position: absolute; right: 14px; color: #94a3b8; font-size: 1.1rem; pointer-events: none; display: flex; align-items: center;">
                  <i class="ti ti-lock"></i>
                </span>
                @endif
              </div>
            </div>

            <!-- 3. Phone / WhatsApp Number with updated placeholder -->
            <div class="mb-3">
              <label for="onboardingPhone" style="font-weight: 700; font-size: 0.86rem; color: #1e293b; margin-bottom: 6px; display: block;">
                WhatsApp / Phone Number <span style="color: #e11d48;">*</span>
              </label>
              <div style="position: relative; display: flex; align-items: center;">
                <span style="position: absolute; left: 14px; color: #25d366; font-size: 1.25rem; pointer-events: none; display: flex; align-items: center;">
                  <i class="ti ti-brand-whatsapp"></i>
                </span>
                <input 
                  type="tel" 
                  name="phone" 
                  id="onboardingPhone" 
                  class="form-control" 
                  placeholder="Enter your phone number" 
                  value="{{ Auth::user()->phone }}" 
                  required 
                  maxlength="16"
                  inputmode="tel"
                  autocomplete="tel"
                  style="height: 46px; padding-left: 44px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 0.92rem; color: #0f172a; transition: border-color 0.2s ease, box-shadow 0.2s ease;"
                />
              </div>
              <small id="phoneValidationMsg" style="display: none; color: #e11d48; font-size: 0.76rem; font-weight: 600; margin-top: 6px;">
                <i class="ti ti-alert-circle me-1"></i>Please enter a valid 10-digit Indian mobile number.
              </small>
            </div>

            <!-- 4. Business Logo (Optional) -->
            <div class="mb-4">
              <label style="font-weight: 700; font-size: 0.86rem; color: #1e293b; margin-bottom: 6px; display: flex; justify-content: space-between; align-items: center;">
                <span>Business Logo</span>
                <span style="font-size: 0.74rem; font-weight: 600; color: #64748b; background: #f1f5f9; padding: 2px 8px; border-radius: 6px;">Optional</span>
              </label>

              <div 
                style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 12px; text-align: center; background: #f8fafc; cursor: pointer; transition: all 0.2s ease; position: relative;"
                onclick="document.getElementById('businessLogoInput').click()"
              >
                <div id="logoUploadPrompt">
                  <div style="width: 36px; height: 36px; border-radius: 50%; background: #ffffff; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; justify-content: center; color: #64748b; font-size: 1.15rem; margin-bottom: 4px;">
                    <i class="ti ti-photo-plus"></i>
                  </div>
                  <div style="font-weight: 700; font-size: 0.82rem; color: #0f172a;">Click to upload business logo</div>
                  <div style="font-size: 0.71rem; color: #94a3b8; margin-top: 1px;">PNG, JPG, WebP up to 5MB (Optional)</div>
                </div>

                <div id="logoPreviewBox" style="display: none;">
                  <img id="logoPreviewImg" src="#" alt="Logo Preview" style="max-height: 56px; max-width: 130px; object-fit: contain; border-radius: 8px; border: 1px solid #e2e8f0; padding: 4px; background: #ffffff; margin-bottom: 6px;" />
                  <div>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="event.stopPropagation(); removeSelectedLogo();" style="font-size: 0.74rem; border-radius: 6px; padding: 2px 8px;">
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

            <!-- Submit to Step 2 Button -->
            <button 
              type="submit" 
              id="onboardingStep1Btn"
              class="btn w-100" 
              style="background: #e11d48; color: #ffffff; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 0.95rem; height: 46px; border-radius: 12px; border: none; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.28); transition: all 0.2s ease;"
              onmouseover="this.style.background='#be123c'"
              onmouseout="this.style.background='#e11d48'"
            >
              <span>Continue to Integrations</span>
              <i class="ti ti-arrow-right ms-1"></i>
            </button>
          </form>
        </div>


        <!-- ================= STEP 2: INTEGRATION DETAILS & REDIRECT ================= -->
        <div id="onboardingStep2Container" class="modal-body" style="padding: 20px 24px; display: none;">
          
          <div style="text-align: center; margin-bottom: 16px;">
            <span style="display: inline-block; padding: 3px 10px; border-radius: 20px; background: #f0fdf4; border: 1px solid #bbf7d0; color: #16a34a; font-size: 0.76rem; font-weight: 700;">
              <i class="ti ti-circle-check me-1"></i> Profile Saved Successfully
            </span>
            <h6 style="font-weight: 800; font-size: 1.05rem; color: #0f172a; margin: 8px 0 3px 0;">
              Connect Your Review Platforms
            </h6>
            <p style="font-size: 0.79rem; color: #64748b; margin: 0; line-height: 1.4;">
              Link your public channels to turn happy customers into glowing Google &amp; social reviews.
            </p>
          </div>

          <!-- Integrations List Cards -->
          <div style="display: flex; flex-direction: column; gap: 9px; margin-bottom: 16px; max-height: 290px; overflow-y: auto; padding-right: 4px;">
            
            <!-- 1. Google Reviews -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
              <div style="display: flex; align-items: center; gap: 11px;">
                <div style="width: 36px; height: 36px; border-radius: 10px; background: #eff6ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                  <!-- Google G SVG -->
                  <svg width="18" height="18" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.8-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17Z"/>
                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24Z"/>
                    <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.98 0 12s.45 3.82 1.25 5.42l4.03-3.15Z"/>
                    <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98Z"/>
                  </svg>
                </div>
                <div>
                  <div style="font-weight: 700; font-size: 0.86rem; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                    Google Reviews
                    <span style="background: #dcfce7; color: #15803d; font-size: 0.66rem; font-weight: 700; padding: 1px 5px; border-radius: 4px;">Top Priority</span>
                  </div>
                  <div style="font-size: 0.72rem; color: #64748b;">Instant 5-star prefill &amp; Google Maps sync</div>
                </div>
              </div>
              <span style="font-size: 0.74rem; font-weight: 700; color: #2563eb;">Configure &rarr;</span>
            </div>

            <!-- 2. WhatsApp Direct Hub -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
              <div style="display: flex; align-items: center; gap: 11px;">
                <div style="width: 36px; height: 36px; border-radius: 10px; background: #ecfdf5; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: #10b981; flex-shrink: 0;">
                  <i class="ti ti-brand-whatsapp"></i>
                </div>
                <div>
                  <div style="font-weight: 700; font-size: 0.86rem; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                    WhatsApp Review Hub
                    <span style="background: #e0f2fe; color: #0369a1; font-size: 0.66rem; font-weight: 700; padding: 1px 5px; border-radius: 4px;">High Open Rate</span>
                  </div>
                  <div style="font-size: 0.72rem; color: #64748b;">Automated 1-click review invites for clients</div>
                </div>
              </div>
              <span style="font-size: 0.74rem; font-weight: 700; color: #2563eb;">Configure &rarr;</span>
            </div>

            <!-- 3. Facebook & Instagram -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
              <div style="display: flex; align-items: center; gap: 11px;">
                <div style="width: 36px; height: 36px; border-radius: 10px; background: #fdf2f8; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: #e11d48; flex-shrink: 0;">
                  <i class="ti ti-brand-instagram"></i>
                </div>
                <div>
                  <div style="font-weight: 700; font-size: 0.86rem; color: #0f172a;">
                    Facebook &amp; Instagram
                  </div>
                  <div style="font-size: 0.72rem; color: #64748b;">Social recommendations &amp; video testimonials</div>
                </div>
              </div>
              <span style="font-size: 0.74rem; font-weight: 700; color: #2563eb;">Configure &rarr;</span>
            </div>

            <!-- 4. Smart QR Code Standees -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
              <div style="display: flex; align-items: center; gap: 11px;">
                <div style="width: 36px; height: 36px; border-radius: 10px; background: #f5f3ff; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: #7c3aed; flex-shrink: 0;">
                  <i class="ti ti-qrcode"></i>
                </div>
                <div>
                  <div style="font-weight: 700; font-size: 0.86rem; color: #0f172a;">
                    Smart QR Codes &amp; Standees
                  </div>
                  <div style="font-size: 0.72rem; color: #64748b;">Ready-to-print dynamic table &amp; counter QR stands</div>
                </div>
              </div>
              <span style="font-size: 0.74rem; font-weight: 700; color: #2563eb;">Configure &rarr;</span>
            </div>

          </div>

          <!-- Smart Negative Shield Feature Box -->
          <div style="background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%); border: 1px solid #bbf7d0; border-radius: 12px; padding: 9px 12px; margin-bottom: 18px; display: flex; align-items: center; gap: 10px;">
            <div style="width: 28px; height: 28px; border-radius: 50%; background: #ffffff; border: 1px solid #86efac; display: flex; align-items: center; justify-content: center; color: #16a34a; font-size: 0.95rem; flex-shrink: 0;">
              <i class="ti ti-shield-check"></i>
            </div>
            <div style="font-size: 0.74rem; color: #166534; line-height: 1.35;">
              <strong>Negative Review Shield:</strong> Reviews under 4 stars route to private resolution, protecting your public Google score.
            </div>
          </div>

          <!-- Primary Integration Button -->
          <a 
            href="{{ url('admin/review_links?source=onboarding&tour=1') }}" 
            class="btn w-100 mb-2" 
            style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 0.95rem; height: 46px; border-radius: 12px; border: none; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3); display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.2s ease;"
            onmouseover="this.style.boxShadow='0 6px 18px rgba(37, 99, 235, 0.4)'"
            onmouseout="this.style.boxShadow='0 4px 14px rgba(37, 99, 235, 0.3)'"
          >
            <i class="ti ti-plug-connected me-2" style="font-size: 1.1rem;"></i>
            <span>Connect Integrations Now</span>
            <i class="ti ti-arrow-right ms-2"></i>
          </a>

          <!-- Skip & Back Navigation Links -->
          <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 6px;">
            <button 
              type="button" 
              class="btn btn-sm btn-link p-0" 
              onclick="goToOnboardingStep(1)" 
              style="font-size: 0.8rem; font-weight: 600; color: #64748b; text-decoration: none; display: flex; align-items: center; gap: 4px;"
            >
              <i class="ti ti-arrow-left"></i> Edit Details
            </button>

            <button 
              type="button" 
              id="skipOnboardingBtn"
              class="btn btn-sm btn-link p-0" 
              onclick="skipOnboardingToDashboard()" 
              style="font-size: 0.82rem; font-weight: 600; color: #64748b; text-decoration: underline; display: flex; align-items: center; gap: 4px;"
            >
              <span>Skip for Now &amp; Go to Dashboard</span>
              <i class="ti ti-chevron-right"></i>
            </button>
          </div>

        </div>

      </div>
    </div>
  </div>
  @endif


</body>


<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/minisidebar/index4.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 Jul 2023 05:22:25 GMT -->
</html>