<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="referrer" content="never">
    <meta name="referrer" content="no-referrer">
    <meta property="og:type" content="website">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#4f46e5"/>
    <link rel="apple-touch-icon" href="{{ asset('frontend/images/logo.jpg') }}">
    <link rel="manifest" href="{{ url('/manifest/' . $user_name . '.json') }}">
    <link rel="icon" type="image/png" sizes="200x200" href="{{$user->logo}}">
    <title>{{$user->name}} - Review Us</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet">

    <style>
        :root {
            --app-font: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: #eef2ff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --card-bg: #ffffff;
            --star-gold: #f59e0b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: var(--app-font);
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
        }

        /* Full Screen Split Layout */
        .feedback-wrapper {
            height: 100vh;
            min-height: 100vh;
            display: flex;
            width: 100%;
            overflow: hidden;
        }

        .left-content-col {
            flex: 1;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            padding: 4.5rem 2rem 2rem 2rem;
            position: relative;
            background-color: #f8fafc;
            scrollbar-width: thin;
            scrollbar-color: rgba(203, 213, 225, 0.6) transparent;
        }

        .left-content-col::-webkit-scrollbar {
            width: 6px;
        }
        .left-content-col::-webkit-scrollbar-track {
            background: transparent;
        }
        .left-content-col::-webkit-scrollbar-thumb {
            background: rgba(203, 213, 225, 0.6);
            border-radius: 9999px;
        }
        .left-content-col::-webkit-scrollbar-thumb:hover {
            background: rgba(148, 163, 184, 0.8);
        }

        /* Atmospheric Faded Background Image & Ambient Mesh */
        .left-bg-faded-image {
            position: absolute;
            inset: -20px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.12;
            filter: blur(10px) contrast(1.1);
            pointer-events: none;
            z-index: 1;
        }

        .left-bg-overlay {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 15% 15%, rgba(99, 102, 241, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 85% 85%, rgba(244, 63, 94, 0.06) 0%, transparent 50%),
                radial-gradient(ellipse 90% 70% at 50% 50%, rgba(255, 255, 255, 0.82) 0%, rgba(248, 250, 252, 0.94) 100%);
            pointer-events: none;
            z-index: 2;
        }

        .right-hero-col {
            flex: 1;
            min-height: 100vh;
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 3rem;
            overflow: hidden;
        }

        .right-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.75) 100%);
        }

        .hero-floating-card {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 20px;
            padding: 1.5rem 2rem;
            color: #ffffff;
            max-width: 440px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        /* Top Header Utilities */
        .top-nav-bar {
            position: absolute;
            top: 1.5rem;
            left: 1.75rem;
            right: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 20;
        }

        .top-brand-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.45rem 1rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.85);
            border-radius: 9999px;
            font-size: 0.82rem;
            font-weight: 600;
            color: #1e293b;
            box-shadow: 0 4px 14px -2px rgba(15, 23, 42, 0.04);
            letter-spacing: -0.01em;
        }

        .top-brand-pill i {
            color: #10b981;
            filter: drop-shadow(0 1px 3px rgba(16, 185, 129, 0.3));
        }

        .share-dropdown-wrapper {
            position: relative;
        }

        .share-btn-trigger {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.85);
            padding: 0.45rem 1.05rem;
            border-radius: 9999px;
            color: #1e293b;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 14px -2px rgba(15, 23, 42, 0.04);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .share-btn-trigger:hover {
            border-color: #cbd5e1;
            background: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -2px rgba(15, 23, 42, 0.08);
        }

        .share-menu-card {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 16px;
            padding: 0.5rem;
            min-width: 175px;
            box-shadow: 0 16px 36px -6px rgba(15, 23, 42, 0.14);
            z-index: 100;
            display: none;
            animation: shareMenuPop 0.18s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes shareMenuPop {
            from { opacity: 0; transform: translateY(-6px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .share-menu-card a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.55rem 0.85rem;
            border-radius: 10px;
            color: var(--text-dark);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: background 0.15s ease;
        }

        .share-menu-card a:hover {
            background: #f1f5f9;
        }

        .share-menu-card a.fb-link i { color: #1877f2; }
        .share-menu-card a.wp-link i { color: #25d366; }

        /* Main Card Container (Enlarged & Responsive) */
        .portal-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 32px;
            padding: 2.5rem 2.5rem;
            width: 100%;
            max-width: 560px;
            margin: auto;
            box-shadow: 
                0 30px 80px -15px rgba(15, 23, 42, 0.12),
                0 6px 20px -2px rgba(15, 23, 42, 0.04),
                0 0 0 1px rgba(226, 232, 240, 0.75);
            position: relative;
            z-index: 10;
            text-align: center;
            transition: all 0.3s ease;
        }

        /* Brand Logo Avatar (Default / Initial State) */
        .brand-avatar-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border: 1px solid #f1f5f9;
            box-shadow: 
                0 14px 35px -6px rgba(15, 23, 42, 0.09),
                0 0 0 1px rgba(226, 232, 240, 0.8);
            border-radius: 26px;
            padding: 14px 24px;
            margin-bottom: 1.5rem;
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s ease;
        }

        .brand-avatar-box:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 18px 40px -6px rgba(15, 23, 42, 0.14),
                0 0 0 1px rgba(203, 213, 225, 0.9);
        }

        .brand-avatar-img {
            max-height: 90px;
            max-width: 190px;
            object-fit: contain;
            border-radius: 12px;
        }

        /* Luminous Golden Stars */
        .rating-stars-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #f59e0b;
            font-size: 1.6rem;
            filter: drop-shadow(0 4px 12px rgba(245, 158, 11, 0.45));
            margin-bottom: 0.85rem;
        }

        /* Typography (Prominent & Eye-catching) */
        .portal-title {
            font-size: 2.1rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.25;
            margin-bottom: 0.75rem;
            letter-spacing: -0.03em;
        }

        .portal-subtitle {
            font-size: 1.02rem;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 2rem;
            line-height: 1.55;
        }

        /* Dynamic Star Rating Component (Bigger Interactive Stars) */
        .stars-rating-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 1.5rem 0 0.5rem 0;
        }

        .rating-interactive-stars {
            display: inline-flex;
            flex-direction: row-reverse;
            justify-content: center;
            gap: 14px;
            margin-bottom: 1.25rem;
        }

        .rating-interactive-stars input[type="radio"] {
            display: none;
        }

        .rating-interactive-stars label {
            cursor: pointer;
            width: 62px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #e2e8f0;
            transition: all 0.22s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .rating-interactive-stars label::before {
            content: "\f005";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
        }

        .rating-interactive-stars label:hover,
        .rating-interactive-stars label:hover ~ label,
        .rating-interactive-stars input[type="radio"]:checked ~ label {
            color: var(--star-gold);
            transform: scale(1.22);
            filter: drop-shadow(0 6px 18px rgba(245, 158, 11, 0.5));
        }

        .rating-interactive-stars label:active {
            transform: scale(0.95);
        }

        .rating-prompt-badge {
            font-size: 0.92rem;
            font-weight: 600;
            color: #475569;
            background: #f1f5f9;
            padding: 0.5rem 1.35rem;
            border-radius: 9999px;
            transition: all 0.2s ease;
        }

        /* State 2: Positive Feedback Platforms View (Fits Gracefully Without Window Scroll) */
        .more_three_star .brand-avatar-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border: 1px solid #f1f5f9;
            box-shadow: 0 8px 20px -3px rgba(15, 23, 42, 0.06);
            border-radius: 18px;
            padding: 8px 18px;
            margin-bottom: 0.65rem;
        }

        .more_three_star .brand-avatar-img {
            max-height: 52px;
            max-width: 135px;
            object-fit: contain;
        }

        .more_three_star .rating-stars-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #f59e0b;
            font-size: 1.35rem;
            filter: drop-shadow(0 3px 8px rgba(245, 158, 11, 0.45));
            margin-bottom: 0.35rem;
        }

        .more_three_star .portal-title {
            font-size: 1.7rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
            margin-bottom: 0.3rem;
            letter-spacing: -0.025em;
        }

        .more_three_star .portal-subtitle {
            font-size: 0.88rem;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 1.15rem;
            line-height: 1.45;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Platform Links List Container */
        .platform-links-list {
            max-height: calc(100vh - 350px);
            overflow-y: auto;
            padding: 2px 4px 2px 2px;
            margin-right: -4px;
            scrollbar-width: thin;
            scrollbar-color: rgba(203, 213, 225, 0.7) transparent;
        }

        .platform-links-list::-webkit-scrollbar {
            width: 5px;
        }
        .platform-links-list::-webkit-scrollbar-track {
            background: transparent;
        }
        .platform-links-list::-webkit-scrollbar-thumb {
            background: rgba(203, 213, 225, 0.7);
            border-radius: 9999px;
        }
        .platform-links-list::-webkit-scrollbar-thumb:hover {
            background: rgba(148, 163, 184, 0.9);
        }

        /* Review Platform Links List (>= 4 Stars) */
        .platform-btn-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background: #ffffff;
            border: 1.5px solid #edf2f7;
            border-radius: 16px;
            padding: 0.72rem 1.15rem;
            margin-bottom: 0.6rem;
            text-decoration: none;
            color: #0f172a;
            transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .platform-btn-link:last-child {
            margin-bottom: 0;
        }

        .platform-btn-link:hover {
            transform: translateY(-2px);
            color: #0f172a;
            border-color: #cbd5e1;
            box-shadow: 0 8px 20px -3px rgba(15, 23, 42, 0.08);
        }

        .platform-btn-link:active {
            transform: translateY(0) scale(0.99);
        }

        .platform-icon-wrap {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
            transition: transform 0.22s ease;
        }

        .platform-btn-link:hover .platform-icon-wrap {
            transform: scale(1.06);
        }

        .platform-icon-wrap img {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }

        .platform-info-text {
            flex-grow: 1;
            text-align: left;
            margin-left: 0.95rem;
        }

        .platform-info-text .platform-name {
            font-weight: 700;
            font-size: 0.96rem;
            color: #0f172a;
            margin-bottom: 0.1rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .platform-info-text .platform-hint {
            font-size: 0.78rem;
            color: #64748b;
            margin: 0;
            font-weight: 500;
        }

        .platform-chevron-wrap {
            width: 32px;
            height: 32px;
            min-width: 32px;
            border-radius: 50%;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 0.75rem;
            transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .platform-btn-link:hover .platform-chevron-wrap {
            background: #0f172a;
            border-color: #0f172a;
            color: #ffffff;
            transform: translateX(3px);
        }

        /* Platform-Specific Themes on Hover */
        .platform-btn-link.platform-google:hover {
            border-color: #93c5fd;
            background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);
            box-shadow: 0 10px 24px -4px rgba(66, 133, 244, 0.16);
        }
        .platform-btn-link.platform-google:hover .platform-chevron-wrap {
            background: #4285f4;
            border-color: #4285f4;
            color: #ffffff;
        }

        .platform-btn-link.platform-facebook:hover {
            border-color: #bfdbfe;
            background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);
            box-shadow: 0 10px 24px -4px rgba(24, 119, 242, 0.16);
        }
        .platform-btn-link.platform-facebook:hover .platform-chevron-wrap {
            background: #1877f2;
            border-color: #1877f2;
            color: #ffffff;
        }

        .platform-btn-link.platform-instagram:hover {
            border-color: #fbcfe8;
            background: linear-gradient(135deg, #ffffff 0%, #fff1f2 100%);
            box-shadow: 0 10px 24px -4px rgba(225, 48, 108, 0.16);
        }
        .platform-btn-link.platform-instagram:hover .platform-chevron-wrap {
            background: linear-gradient(135deg, #f58529, #dd2a7b, #8134af);
            border-color: transparent;
            color: #ffffff;
        }

        .platform-btn-link.platform-youtube:hover {
            border-color: #fecaca;
            background: linear-gradient(135deg, #ffffff 0%, #fef2f2 100%);
            box-shadow: 0 10px 24px -4px rgba(239, 68, 68, 0.16);
        }
        .platform-btn-link.platform-youtube:hover .platform-chevron-wrap {
            background: #ff0000;
            border-color: #ff0000;
            color: #ffffff;
        }

        .platform-btn-link.platform-whatsapp:hover {
            border-color: #bbf7d0;
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
            box-shadow: 0 10px 24px -4px rgba(34, 197, 94, 0.16);
        }
        .platform-btn-link.platform-whatsapp:hover .platform-chevron-wrap {
            background: #25d366;
            border-color: #25d366;
            color: #ffffff;
        }

        /* Special Video & Private Buttons */
        .video-record-btn {
            background: linear-gradient(135deg, #fff1f2 0%, #fdf2f8 50%, #ffffff 100%);
            border: 1.5px solid #fecdd3;
        }
        .video-record-btn .platform-icon-wrap {
            background: linear-gradient(135deg, #ffe4e6 0%, #fce7f3 100%);
            border-color: #fbcfe8;
            color: #e11d48;
        }
        .video-record-btn:hover {
            border-color: #f43f5e;
            box-shadow: 0 12px 28px -4px rgba(244, 63, 94, 0.22);
            transform: translateY(-2px);
        }
        .video-record-btn:hover .platform-chevron-wrap {
            background: #e11d48;
            border-color: #e11d48;
            color: #ffffff;
        }

        .private-enquiry-btn {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 45%, #ffffff 100%);
            border: 1.5px solid #fde68a;
        }
        .private-enquiry-btn .platform-icon-wrap {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-color: #fcd34d;
            color: #d97706;
        }
        .private-enquiry-btn:hover {
            border-color: #f59e0b;
            box-shadow: 0 12px 28px -4px rgba(245, 158, 11, 0.2);
            transform: translateY(-2px);
        }
        .private-enquiry-btn:hover .platform-chevron-wrap {
            background: #d97706;
            border-color: #d97706;
            color: #ffffff;
        }

        .pulsing-rec-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ef4444;
            display: inline-block;
            box-shadow: 0 0 0 rgba(239, 68, 68, 0.7);
            animation: pulse-dot 1.5s infinite;
        }

        @keyframes pulse-dot {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { box-shadow: 0 0 0 7px rgba(239, 68, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        /* Back / Close button */
        .nav-back-btn {
            position: absolute;
            top: 1.25rem;
            left: 1.25rem;
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #f1f5f9;
            color: var(--text-muted);
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .nav-back-btn:hover {
            background: #e2e8f0;
            color: var(--text-dark);
            transform: scale(1.05);
        }

        /* Form Controls Styling (< 4 Stars Form) */
        .feedback-form-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.35rem;
        }

        .feedback-form-desc {
            font-size: 0.86rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .form-question-card {
            background: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.15rem;
            margin-bottom: 1.15rem;
            text-align: left;
        }

        .form-question-title {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .answers-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }

        .ans-pill-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 0.55rem 0.85rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.15s ease;
            margin: 0;
            user-select: none;
        }

        .ans-pill-label:hover {
            border-color: var(--primary-color);
            background: #f8faff;
        }

        .ans-pill-label input[type="radio"]:checked + span {
            color: var(--primary-color);
            font-weight: 700;
        }

        /* Rating Stars inside Form */
        .rate {
            display: inline-flex;
            flex-direction: row-reverse;
            gap: 6px;
        }

        .rate input {
            display: none;
        }

        .rate label {
            cursor: pointer;
            font-size: 1.5rem;
            color: #cbd5e1;
            transition: color 0.15s ease, transform 0.15s ease;
        }

        .rate label::before {
            content: "\f005";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
        }

        .rate label:hover,
        .rate label:hover ~ label,
        .rate input:checked ~ label {
            color: var(--star-gold);
            transform: scale(1.1);
        }

        /* Form Inputs */
        .modern-input {
            width: 100%;
            background: #ffffff;
            border: 1.5px solid var(--border-color);
            border-radius: 14px;
            padding: 0.75rem 1rem;
            font-size: 0.92rem;
            font-family: inherit;
            color: var(--text-dark);
            transition: all 0.2s ease;
        }

        .modern-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3.5px rgba(79, 70, 229, 0.15);
        }

        .primary-submit-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            color: #ffffff;
            border: none;
            border-radius: 14px;
            padding: 0.85rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 8px 20px -4px rgba(79, 70, 229, 0.4);
            transition: all 0.2s ease;
            width: 100%;
        }

        .primary-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px -4px rgba(79, 70, 229, 0.5);
            color: #ffffff;
        }

        .secondary-btn {
            background: #f1f5f9;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 0.85rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .secondary-btn:hover {
            background: #e2e8f0;
        }

        /* Video Recording UI */
        #videoContainer {
            width: 100%;
        }

        .video_box {
            position: relative;
            background: #0b0f19;
            border: 2px solid #1e293b;
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 4 / 3;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 35px rgba(0,0,0,0.25);
            margin-bottom: 1.25rem;
        }

        #videoElement, #previewVideo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 18px;
            position: absolute;
            inset: 0;
            z-index: 2;
        }

        .record_start_button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 90%;
            text-align: center;
        }

        .record_start_button #startButton {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            color: #ffffff;
            border: none;
            border-radius: 9999px;
            padding: 0.85rem 1.75rem;
            font-size: 0.95rem;
            font-weight: 700;
            white-space: nowrap;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.5);
            transition: all 0.2s ease;
            width: auto;
        }

        .record_start_button #startButton:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(79, 70, 229, 0.7);
            color: #ffffff;
        }

        .video_record_time_box {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(8px);
            color: #ffffff;
            padding: 0.4rem 0.9rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            z-index: 20;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        #video_prepration_time_box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 5rem;
            font-weight: 800;
            color: #ffffff;
            text-shadow: 0 4px 25px rgba(0,0,0,0.8);
            z-index: 25;
        }

        /* Loader */
        #loader {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(6px);
            z-index: 99999;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #ffffff;
        }

        .overlay {
            display: none;
        }

        /* PWA Install Button */
        .install-pwa-banner {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 9999px;
            padding: 0.55rem 1.35rem;
            font-size: 0.84rem;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
            margin-top: 1.25rem;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .install-pwa-banner:hover {
            border-color: #6366f1;
            color: #4f46e5;
            background: #f8faff;
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.12);
            transform: translateY(-2px);
        }

        /* Mobile Adjustments */
        @media (max-width: 991px) {
            .right-hero-col {
                display: none !important;
            }
            .left-content-col {
                padding: 4rem 1.25rem 2rem 1.25rem;
            }
            .portal-card {
                padding: 2.25rem 1.5rem;
                border-radius: 24px;
            }
        }
    </style>
</head>
<body>

    <!-- Loading Screen -->
    <div id="loader">
        <i class="fas fa-circle-notch fa-spin fa-3x text-primary mb-3"></i>
        <h5 class="font-weight-bold text-white mb-1">Submitting your feedback...</h5>
        <small class="text-white-50">Please do not refresh the page.</small>
    </div>

    <!-- Overlay -->
    <div class="overlay"></div>

    <div class="feedback-wrapper">
        <!-- Left Interactive Column -->
        <div class="left-content-col" @if($user->default_background == 'No') style="background-color: {{$user->background_color}};" @endif>
            
            <!-- Atmospheric Faded Background Image & Ambient Light Mesh -->
            <div class="left-bg-faded-image" @if ($user->background_image != '') style="background-image: url('{{$user->background_image}}');" @else style="background-image: url('{{asset('frontend/images/background.jpg')}}');" @endif></div>
            <div class="left-bg-overlay"></div>

            <!-- Top Navigation Bar -->
            <div class="top-nav-bar">
                <div class="top-brand-pill">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Verified Review</span>
                </div>

                <!-- Share Button -->
                <div class="share-dropdown-wrapper">
                    <button type="button" class="share-btn-trigger" onclick="show_share_option()" aria-label="Share">
                        <i class="fa-solid fa-share-nodes"></i>
                        <span>Share</span>
                    </button>
                    <div class="share-menu-card" id="share_anchor">
                        @if ($user->facebook_share == 'Yes')
                            <a href="http://www.facebook.com/share.php?u={{url()->current()}}" target="_blank" class="fb-link">
                                <i class="fab fa-facebook-f fa-fw"></i> Facebook
                            </a>
                        @endif
                        @if ($user->wp_share == 'Yes')
                            <a href="https://wa.me/?text={{url()->current()}}" target="_blank" class="wp-link">
                                <i class="fab fa-whatsapp fa-fw"></i> WhatsApp
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Card Container -->
            <div class="portal-card">

                <!-- 1. INITIAL STATE: Rating Selection -->
                <div class="logo_part">
                    <div class="brand-avatar-box">
                        <img src="{{$user->logo}}" alt="{{$user->name}}" class="brand-avatar-img">
                    </div>

                    <h1 class="portal-title">
                        @if ($user->front_page_text != '')
                            {{$user->front_page_text}}
                        @else
                            How was your experience with {{$user->name}}?
                        @endif
                    </h1>
                    <p class="portal-subtitle">We value your opinion. Tap a star below to rate us:</p>

                    <div class="stars-rating-container">
                        <div class="rating-interactive-stars">
                            <input type="radio" onchange="get_review_value(this.value)" name="rating" id="r1" value="5">
                            <label for="r1" title="5 Stars - Outstanding!"></label>

                            <input type="radio" onchange="get_review_value(this.value)" name="rating" id="r2" value="4">
                            <label for="r2" title="4 Stars - Very Good"></label>

                            <input type="radio" onchange="get_review_value(this.value)" name="rating" id="r3" value="3">
                            <label for="r3" title="3 Stars - Good"></label>

                            <input type="radio" onchange="get_review_value(this.value)" name="rating" id="r4" value="2">
                            <label for="r4" title="2 Stars - Could be better"></label>

                            <input type="radio" onchange="get_review_value(this.value)" name="rating" id="r5" value="1">
                            <label for="r5" title="1 Star - Poor"></label>
                        </div>
                        <span class="rating-prompt-badge" id="rating_hint_text">
                            <i class="fa-regular fa-hand-pointer me-1"></i> Tap to rate
                        </span>
                    </div>
                </div>

                <!-- 2. POSITIVE RATING STATE (>= 4 Stars) -->
                <div class="more_three_star" style="display: none;">
                    <button type="button" class="nav-back-btn" onclick="close_social_links()" title="Change Rating">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>

                    <div class="brand-avatar-box">
                        <img src="{{$user->logo}}" alt="{{$user->name}}" class="brand-avatar-img">
                    </div>

                    <div class="d-block text-center">
                        <div class="rating-stars-badge">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>

                    <h2 class="portal-title">Thank You!</h2>
                    <p class="portal-subtitle">
                        {{$user->google_page_text ?: 'Please take a moment to share your review on your preferred platform below:'}}
                    </p>

                    <div class="platform-links-list w-100">
                        @if (isset($integrationList) && count($integrationList) > 0)
                            @if (isset($integrationList[0]) && $integrationList[0]->button_order != '')
                                @foreach ($integrationList as $item)
                                    @php
                                        $platformSlug = strtolower(trim($item->button_name ?? $item->type ?? ''));
                                        $platformClass = '';
                                        if (str_contains($platformSlug, 'google')) $platformClass = 'platform-google';
                                        elseif (str_contains($platformSlug, 'facebook')) $platformClass = 'platform-facebook';
                                        elseif (str_contains($platformSlug, 'instagram')) $platformClass = 'platform-instagram';
                                        elseif (str_contains($platformSlug, 'youtube')) $platformClass = 'platform-youtube';
                                        elseif (str_contains($platformSlug, 'whatsapp')) $platformClass = 'platform-whatsapp';
                                    @endphp
                                    @if ($item->type == 'record' && ($item->status == 'active' || empty($item->status)))
                                        @if ($video_access_show == true)
                                            <div class="platform-btn-link video-record-btn" onclick="record_video()">
                                                <div class="platform-icon-wrap">
                                                    <i class="fa-solid fa-video text-danger fa-lg"></i>
                                                </div>
                                                <div class="platform-info-text">
                                                    <div class="platform-name">
                                                        <span>{{$item->button_name}}</span>
                                                        <span class="pulsing-rec-dot"></span>
                                                    </div>
                                                    <p class="platform-hint">Record a 60-sec video shoutout</p>
                                                </div>
                                                <div class="platform-chevron-wrap">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </div>
                                            </div>
                                        @endif
                                    @elseif($item->type == 'private')
                                        @if ($user->private_feedback == 'yes')
                                            <div class="platform-btn-link private-enquiry-btn" onclick="open_private_feedback()">
                                                <div class="platform-icon-wrap">
                                                    <i class="fa-regular fa-message fa-lg"></i>
                                                </div>
                                                <div class="platform-info-text">
                                                    <div class="platform-name">Private Enquiry</div>
                                                    <p class="platform-hint">Send a direct private message to us</p>
                                                </div>
                                                <div class="platform-chevron-wrap">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </div>
                                            </div>
                                        @endif
                                    @elseif ($item->type == 'google')
                                        @if ($item->status == 'active')
                                            @if (isset($googleFeedbackTemplates) && count($googleFeedbackTemplates) > 0)
                                                <div class="platform-btn-link platform-google" onclick="open_google_reviews_popup('{{$item->review_links}}')">
                                                    <div class="platform-icon-wrap">
                                                        <img src="{{$item->button_icon}}" alt="Google">
                                                    </div>
                                                    <div class="platform-info-text">
                                                        <div class="platform-name">{{$item->button_name}}</div>
                                                        <p class="platform-hint">Pick pre-written review & paste</p>
                                                    </div>
                                                    <div class="platform-chevron-wrap">
                                                        <i class="fa-solid fa-chevron-right"></i>
                                                    </div>
                                                </div>
                                            @else
                                                <a href="{{$item->review_links}}" onclick="review_links_analytics('{{$item->type}}')" target="_blank" class="platform-btn-link platform-google">
                                                    <div class="platform-icon-wrap">
                                                        <img src="{{$item->button_icon}}" alt="Google">
                                                    </div>
                                                    <div class="platform-info-text">
                                                        <div class="platform-name">{{$item->button_name}}</div>
                                                        <p class="platform-hint">Review directly on Google</p>
                                                    </div>
                                                    <div class="platform-chevron-wrap">
                                                        <i class="fa-solid fa-chevron-right"></i>
                                                    </div>
                                                </a>
                                            @endif
                                        @endif
                                    @else
                                        @if ($item->status == 'active')
                                            <a href="{{$item->review_links}}" onclick="review_links_analytics('{{$item->type}}')" target="_blank" class="platform-btn-link {{ $platformClass }}">
                                                <div class="platform-icon-wrap">
                                                    <img src="{{$item->button_icon}}" alt="{{$item->button_name}}">
                                                </div>
                                                <div class="platform-info-text">
                                                    <div class="platform-name">{{$item->button_name}}</div>
                                                    <p class="platform-hint">Review us on {{$item->button_name}}</p>
                                                </div>
                                                <div class="platform-chevron-wrap">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </div>
                                            </a>
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                <!-- Fallback Loop -->
                                @if (isset($IntegrationRecord) && ($IntegrationRecord->status == 'active' || empty($IntegrationRecord->status)) && $video_access_show == true)
                                    <div class="platform-btn-link video-record-btn" onclick="record_video()">
                                        <div class="platform-icon-wrap">
                                            <i class="fa-solid fa-video text-danger fa-lg"></i>
                                        </div>
                                        <div class="platform-info-text">
                                            <div class="platform-name">
                                                <span>Video Testimonial</span>
                                                <span class="pulsing-rec-dot"></span>
                                            </div>
                                            <p class="platform-hint">Record a 60-sec video shoutout</p>
                                        </div>
                                        <div class="platform-chevron-wrap">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </div>
                                    </div>
                                @endif
                                @if (isset($IntegrationGoogle) && $IntegrationGoogle->status == 'active')
                                    @if (isset($googleFeedbackTemplates) && count($googleFeedbackTemplates) > 0)
                                        <div class="platform-btn-link platform-google" onclick="open_google_reviews_popup('{{$IntegrationGoogle->review_links}}')">
                                            <div class="platform-icon-wrap">
                                                <img src="{{asset('frontend/images/google.png')}}" alt="Google">
                                            </div>
                                            <div class="platform-info-text">
                                                <div class="platform-name">Google</div>
                                                <p class="platform-hint">Pick pre-written review & paste</p>
                                            </div>
                                            <div class="platform-chevron-wrap">
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{$IntegrationGoogle->review_links}}" onclick="review_links_analytics('google')" target="_blank" class="platform-btn-link platform-google">
                                            <div class="platform-icon-wrap">
                                                <img src="{{asset('frontend/images/google.png')}}" alt="Google">
                                            </div>
                                            <div class="platform-info-text">
                                                <div class="platform-name">Google</div>
                                                <p class="platform-hint">Review directly on Google</p>
                                            </div>
                                            <div class="platform-chevron-wrap">
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </div>
                                        </a>
                                    @endif
                                @endif
                                @if (isset($IntegrationFacebook) && $IntegrationFacebook->status == 'active')
                                    <a href="{{$IntegrationFacebook->review_links}}" onclick="review_links_analytics('facebook')" target="_blank" class="platform-btn-link platform-facebook">
                                        <div class="platform-icon-wrap">
                                            <img src="{{asset('frontend/images/facebook.png')}}" alt="Facebook">
                                        </div>
                                        <div class="platform-info-text">
                                            <div class="platform-name">Facebook</div>
                                            <p class="platform-hint">Recommend us on Facebook</p>
                                        </div>
                                        <div class="platform-chevron-wrap">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </div>
                                    </a>
                                @endif
                                @if (isset($IntegrationYoutube) && $IntegrationYoutube->status == 'active')
                                    <a href="{{$IntegrationYoutube->review_links}}" onclick="review_links_analytics('youtube')" target="_blank" class="platform-btn-link platform-youtube">
                                        <div class="platform-icon-wrap">
                                            <img src="{{asset('frontend/images/youtube.png')}}" alt="Youtube">
                                        </div>
                                        <div class="platform-info-text">
                                            <div class="platform-name">Youtube</div>
                                            <p class="platform-hint">Subscribe & support us</p>
                                        </div>
                                        <div class="platform-chevron-wrap">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </div>
                                    </a>
                                @endif
                                @if (isset($IntegrationInstagram) && $IntegrationInstagram->status == 'active')
                                    <a href="{{$IntegrationInstagram->review_links}}" onclick="review_links_analytics('instagram')" target="_blank" class="platform-btn-link platform-instagram">
                                        <div class="platform-icon-wrap">
                                            <img src="{{asset('frontend/images/instagram.png')}}" alt="Instagram">
                                        </div>
                                        <div class="platform-info-text">
                                            <div class="platform-name">Instagram</div>
                                            <p class="platform-hint">Follow us on Instagram</p>
                                        </div>
                                        <div class="platform-chevron-wrap">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </div>
                                    </a>
                                @endif
                                @if (isset($IntegrationWhatsapp) && $IntegrationWhatsapp->status == 'active')
                                    <a href="{{$IntegrationWhatsapp->review_links}}" onclick="review_links_analytics('whatsapp')" target="_blank" class="platform-btn-link platform-whatsapp">
                                        <div class="platform-icon-wrap">
                                            <img src="{{asset('frontend/images/whatsapp.png')}}" alt="WhatsApp">
                                        </div>
                                        <div class="platform-info-text">
                                            <div class="platform-name">WhatsApp</div>
                                            <p class="platform-hint">Chat directly with our team</p>
                                        </div>
                                        <div class="platform-chevron-wrap">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </div>
                                    </a>
                                @endif
                                @if ($user->private_feedback == 'yes')
                                    <div class="platform-btn-link private-enquiry-btn" onclick="open_private_feedback()">
                                        <div class="platform-icon-wrap">
                                            <i class="fa-regular fa-message fa-lg"></i>
                                        </div>
                                        <div class="platform-info-text">
                                            <div class="platform-name">Private Enquiry</div>
                                            <p class="platform-hint">Send a direct private message to us</p>
                                        </div>
                                        <div class="platform-chevron-wrap">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif

                        <!-- PWA Install Button -->
                        <div id="install_button" class="text-center">
                            <button type="button" id="installButton" class="install-pwa-banner" style="display: none;">
                                <i class="fa-solid fa-mobile-screen-button text-primary"></i>
                                <span>Install App on Home Screen</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 3. DETAILED FEEDBACK FORM (< 4 Stars) -->
                <form method="post" action="{{URL::to('/u/review_form_submit')}}" class="lessthen_three_feedback" style="display: none;">
                    @csrf
                    <input type="hidden" name="user_id" value="{{encrypt($user->id)}}">
                    <input type="hidden" name="form_id" @if (isset($form_data) && $form_data->form_name) value="{{$form_data->id}}" @endif>
                    <input type="hidden" name="rating_number" id="rating_number">

                    <button type="button" class="nav-back-btn" onclick="close_form()" title="Back">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>

                    <div class="brand-avatar-box" style="margin-top: 0.5rem; margin-bottom: 0.75rem;">
                        <img src="{{$user->logo}}" alt="{{$user->name}}" class="brand-avatar-img">
                    </div>

                    <h2 class="feedback-form-title">
                        {{ (isset($form_data) && !empty($form_data->form_name)) ? $form_data->form_name : 'Help Us Improve' }}
                    </h2>
                    <p class="feedback-form-desc">
                        @if (isset($form_data) && !empty($form_data->desc) && $form_data->desc != ' ')
                            {{$form_data->desc}}
                        @else
                            Your feedback is very important to us. Tell us what we can do better:
                        @endif
                    </p>

                    <!-- Step 1: Questions & Comments -->
                    <div class="form_field_section">
                        @foreach ($Question as $key => $item)
                            <div class="form-question-card">
                                <div class="form-question-title">
                                    <i class="fa-solid fa-circle-question text-primary"></i>
                                    <span>{{$item->question}}</span>
                                </div>
                                <div class="answers-grid">
                                    @php
                                        $answ = DB::table('question_answers')->where('question_id', $item->id)->orderBy('id', 'asc')->get();
                                    @endphp
                                    @foreach ($answ as $option)
                                        <label class="ans-pill-label">
                                            <input type="radio" name="answers[{{ $item->id }}]" value="{{ $option->id }}" class="form-check-input mt-0">
                                            <span>{{ $option->answers }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        @if (isset($form_data) && !empty($form_data->customer_support))
                            <div class="form-question-card text-center">
                                <input type="hidden" name="customer_support" id="customer_support" value="{{$form_data->customer_support}}">
                                <div class="form-question-title justify-content-center">
                                    <span>{{$form_data->customer_support}}</span>
                                </div>
                                <p class="customer_support_error text-danger small mb-1"></p>
                                <div class="rate my-1">
                                    <input type="radio" id="f_customer_support_star5" name="f_customer_support" value="5" />
                                    <label for="f_customer_support_star5" title="5 stars"></label>
                                    <input type="radio" id="f_customer_support_star4" name="f_customer_support" value="4" />
                                    <label for="f_customer_support_star4" title="4 stars"></label>
                                    <input type="radio" id="f_customer_support_star3" name="f_customer_support" value="3" />
                                    <label for="f_customer_support_star3" title="3 stars"></label>
                                    <input type="radio" id="f_customer_support_star2" name="f_customer_support" value="2" />
                                    <label for="f_customer_support_star2" title="2 stars"></label>
                                    <input type="radio" id="f_customer_support_star1" name="f_customer_support" value="1" />
                                    <label for="f_customer_support_star1" title="1 star"></label>
                                </div>
                            </div>
                        @endif

                        @if (isset($form_data) && !empty($form_data->rate_text))
                            <div class="form-question-card text-center">
                                <input type="hidden" name="rate_text" id="rate_text" value="{{$form_data->rate_text}}">
                                <div class="form-question-title justify-content-center">
                                    <span>{{$form_data->rate_text}}</span>
                                </div>
                                <p class="rate_text_error text-danger small mb-1"></p>
                                <div class="rate my-1">
                                    <input type="radio" id="star5" name="f_rate_text" value="5" />
                                    <label for="star5" title="5 stars"></label>
                                    <input type="radio" id="star4" name="f_rate_text" value="4" />
                                    <label for="star4" title="4 stars"></label>
                                    <input type="radio" id="star3" name="f_rate_text" value="3" />
                                    <label for="star3" title="3 stars"></label>
                                    <input type="radio" id="star2" name="f_rate_text" value="2" />
                                    <label for="star2" title="2 stars"></label>
                                    <input type="radio" id="star1" name="f_rate_text" value="1" />
                                    <label for="star1" title="1 star"></label>
                                </div>
                            </div>
                        @endif

                        @if (isset($form_data) && !empty($form_data->comments))
                            <div class="form-question-card">
                                <div class="form-question-title">
                                    <i class="fa-regular fa-comment-dots text-primary"></i>
                                    <span>{{$form_data->comments}}</span>
                                </div>
                                <textarea name="f_comments" id="f_comments" class="modern-input" rows="3" placeholder="Tell us more about what happened..."></textarea>
                            </div>
                        @endif

                        <button type="button" class="primary-submit-btn mt-2" onclick="customer_field_section_show()">
                            <span>Continue</span>
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                    </div>

                    <!-- Step 2: Contact Details -->
                    <div class="customer_field_section text-start" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label small font-weight-bold text-dark mb-1">Your Name</label>
                            <input type="text" name="f_customer_name" required id="f_customer_name" placeholder="e.g. John Doe" class="modern-input">
                        </div>

                        <div class="mb-4">
                            <label class="form-label small font-weight-bold text-dark mb-1">Mobile Number</label>
                            <input type="text" pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$" title="Enter valid mobile number" name="f_phone_number" required id="f_phone_number" placeholder="e.g. 9811111111" class="modern-input">
                            <small class="text-muted" style="font-size: 0.75rem;">We may contact you to resolve your experience.</small>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="secondary-btn flex-grow-1" onclick="customer_field_section_hide()">
                                <i class="fa-solid fa-arrow-left me-1"></i> Back
                            </button>
                            <button type="submit" class="primary-submit-btn flex-grow-1">
                                Submit Feedback
                            </button>
                        </div>
                    </div>
                </form>

                <!-- 4. PRIVATE ENQUIRY FORM -->
                <form method="post" action="{{URL::to('/u/private_feedback')}}" class="private_feedback text-start" style="display: none;">
                    @csrf
                    <input type="hidden" name="user_id" value="{{encrypt($user->id)}}">
                    <input type="hidden" name="rating_number" id="rating_number">

                    <button type="button" class="nav-back-btn" onclick="close_form()" title="Back">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>

                    <div class="text-center mb-3">
                        <div class="brand-avatar-box" style="margin-top: 0.5rem; margin-bottom: 0.75rem;">
                            <img src="{{$user->logo}}" alt="{{$user->name}}" class="brand-avatar-img">
                        </div>
                        <h2 class="portal-title mb-1">Private Message</h2>
                        <p class="portal-subtitle mb-3">{{$user->private_page_text ?: 'Send a message directly to management.'}}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small font-weight-bold mb-1">Your Name</label>
                        <input type="text" name="customer_name" required id="customer_name" class="modern-input" placeholder="Enter your full name">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small font-weight-bold mb-1">Phone</label>
                            <input type="text" pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$" title="Enter valid mobile number" required name="customer_number" id="customer_number" maxlength="10" class="modern-input" placeholder="Mobile no">
                        </div>
                        <div class="col-6">
                            <label class="form-label small font-weight-bold mb-1">Email</label>
                            <input type="email" name="customer_email" id="customer_email" class="modern-input" placeholder="Email address">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small font-weight-bold mb-1">Your Message</label>
                        <textarea name="customer_message" id="customer_message" class="modern-input" rows="3" placeholder="How can we assist you?"></textarea>
                    </div>

                    <button type="submit" class="primary-submit-btn">
                        <i class="fa-regular fa-paper-plane me-2"></i> Send Private Message
                    </button>
                </form>

                <!-- 5. VIDEO TESTIMONIAL FORM -->
                <form method="post" action="{{URL::to('/u/video_testimonial')}}" id="video_testimonial_form" class="video_testimonial text-start" style="display: none;">
                    @csrf
                    <input type="hidden" name="testi_user_id" id="testi_user_id" value="{{encrypt($user->id)}}">
                    <input type="hidden" name="testi_rating_number" id="rating_number">

                    <button type="button" class="nav-back-btn" onclick="close_form()" title="Back">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>

                    <div class="text-center mb-3">
                        <h2 class="portal-title mb-1" style="font-size: 1.3rem;">Video Testimonial</h2>
                        <p class="portal-subtitle mb-2">Record a quick 60-second video sharing your story</p>
                        <small class="web_cam_error text-danger font-weight-bold"></small>
                    </div>

                    <div id="videoContainer">
                        <div class="video_box" id="video_box">
                            <video id="videoElement" autoplay muted playsinline style="display: none;"></video>
                            <video id="previewVideo" controls playsinline style="display: none;"></video>

                            <div class="video_record_time_box" id="video_record_time_box" style="display: none;">
                                <span class="pulsing-rec-dot"></span>
                                <span id="recordingTime">00:60</span>
                            </div>

                            <div id="video_prepration_time_box" style="display: none;">
                                <span id="preprationTime">5</span>
                            </div>

                            <div class="record_start_button">
                                <div class="mb-3 text-center">
                                    <i class="fa-solid fa-camera fa-2x text-white-50 mb-1 d-block"></i>
                                    <span class="text-white-50 small font-weight-bold">Ready to Record</span>
                                </div>
                                <button type="button" id="startButton">
                                    <i class="fa-solid fa-video me-2"></i> Start Recording
                                </button>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                            <button type="button" id="stopButton" class="btn btn-danger rounded-pill px-4" style="display: none;">
                                <i class="fa-solid fa-stop me-1"></i> Stop Recording
                            </button>
                            <button type="button" id="previewButton" class="btn btn-warning rounded-pill px-3" style="display: none;">
                                <i class="fa-solid fa-play me-1"></i> Preview
                            </button>
                            <button type="button" id="restartButton" class="btn btn-secondary rounded-pill px-3" style="display: none;">
                                <i class="fa-solid fa-rotate-left me-1"></i> Retake
                            </button>
                        </div>

                        <div class="name_phone_no_box" id="name_phone_no_box" style="display: none;">
                            <div class="form-check mb-3">
                                <input type="checkbox" checked disabled class="form-check-input" id="video_customer_aggree">
                                <label class="form-check-label small text-muted" for="video_customer_aggree">
                                    I agree that my video review may be used for marketing purposes.
                                </label>
                                <small class="text-danger video_customer_aggree_error d-block"></small>
                            </div>

                            <div class="mb-3">
                                <input type="text" required name="video_customer_name" id="video_customer_name" class="modern-input" placeholder="Enter your full name">
                            </div>

                            <button type="button" id="uploadButton" class="primary-submit-btn" style="display: none;">
                                <i class="fa-solid fa-cloud-arrow-up me-2"></i> Submit Video Review
                            </button>
                            <div class="submit_button_alert text-center mt-2" style="display: none;">
                                <small class="text-danger font-weight-bold">Almost done! Please click 'Submit Video Review' to finish.</small>
                            </div>
                        </div>

                        <audio id="audioPlayer" style="display: none;">
                            <source src="{{URL::to('mp3/video_start.mp3')}}" type="audio/mpeg">
                        </audio>
                    </div>
                </form>

            </div>
        </div>

        <!-- Right Side Hero Image Column -->
        <div class="right-hero-col img_sec" @if ($user->background_image != '') style="background-image: url('{{$user->background_image}}');" @else style="background-image: url('{{asset('frontend/images/background.jpg')}}');" @endif>
            <div class="right-hero-overlay"></div>
            
            <div class="hero-floating-card">
                <div class="d-flex align-items-center gap-1 text-warning mb-2" style="font-size: 1.1rem;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <h4 class="font-weight-bold mb-1" style="font-size: 1.35rem; letter-spacing: -0.01em;">Your Trust is Our Passion</h4>
                <p class="mb-0 text-white-50 small">Every review empowers us to deliver an even better experience. Thank you for being a valued part of our journey.</p>
            </div>
        </div>
    </div>

    <!-- Google Reviews Selection Modal -->
    <div class="modal fade" id="googleReviewsPopupModal" tabindex="-1" aria-labelledby="googleReviewsPopupModalLabel" aria-hidden="true" style="z-index: 1055;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 520px;">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden; background: #ffffff;">
                <div class="modal-header border-0 pb-0" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding: 1.5rem 1.5rem 0.75rem 1.5rem;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center bg-white shadow-sm border rounded-circle" style="width: 44px; height: 44px;">
                            <img src="{{URL::to('frontend/images/google.png')}}" width="26px" height="26px" alt="Google">
                        </div>
                        <div>
                            <h5 class="modal-title font-weight-bold mb-0 text-dark" id="googleReviewsPopupModalLabel" style="font-size: 1.15rem; font-weight: 700;">Google Review Options</h5>
                            <small class="text-muted" style="font-size: 0.82rem;">Select a pre-written compliment or write your own</small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-light border-0 rounded-circle d-flex align-items-center justify-content-center p-0" 
                            style="width: 32px; height: 32px; color: #64748b;" 
                            data-bs-dismiss="modal" 
                            onclick="closeGoogleReviewsPopup()">
                        <i class="fa-solid fa-xmark fa-lg"></i>
                    </button>
                </div>

                <div class="modal-body p-4 pt-2" style="background-color: #fafbfc;">
                    <!-- Notification Banner when copied -->
                    <div id="copy_feedback_toast" class="alert alert-success d-none py-2 px-3 mb-3 rounded-3 shadow-sm align-items-center gap-2 border-0" style="background-color: #e6f4ea; color: #137333;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-circle-check fa-lg text-success"></i>
                            <div class="small">
                                <strong>Comment copied!</strong> Opening Google Reviews... Just paste (Ctrl+V / Tap & Hold) in Google's review box!
                            </div>
                        </div>
                    </div>

                    <p class="text-secondary small mb-3">
                        Click any compliment below to copy it automatically and proceed to Google Reviews, or write your own review:
                    </p>

                    <div class="d-flex flex-column gap-2 mb-3" id="google_templates_popup_list">
                        @if(isset($googleFeedbackTemplates) && count($googleFeedbackTemplates) > 0)
                            @foreach($googleFeedbackTemplates as $tmpl)
                                <div class="google-comment-card p-3 rounded-3 border bg-white shadow-sm position-relative mb-2" 
                                     onclick="selectAndCopyReview({{ json_encode($tmpl->feedback_text) }})"
                                     style="cursor: pointer; transition: all 0.2s ease-in-out; border-color: #e5e7eb !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div class="text-warning" style="letter-spacing: 2px; font-size: 0.85rem;">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="badge bg-light text-primary border rounded-pill px-2 py-1" style="font-size: 0.72rem; font-weight: 600;">
                                            <i class="fa-regular fa-copy me-1"></i> Tap to Copy & Review
                                        </span>
                                    </div>
                                    <div class="comment-text text-dark" style="font-size: 0.92rem; line-height: 1.45; font-weight: 500;">
                                        "{{$tmpl->feedback_text}}"
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- Option to write custom review directly -->
                    <div class="text-center pt-3 border-top">
                        <p class="small text-muted mb-2">Want to write your own personalized review?</p>
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-pill px-4 py-2 font-weight-bold" onclick="openDirectGoogleReview()">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Write My Own Review on Google
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Star Prompt Dynamics -->
    <script>
        const ratingLabels = {
            '5': '🤩 5 Stars - Outstanding!',
            '4': '😊 4 Stars - Very Good!',
            '3': '🙂 3 Stars - Good',
            '2': '😐 2 Stars - Could be better',
            '1': '😞 1 Star - Poor'
        };

        $('.rating-interactive-stars label').on('mouseenter', function() {
            var forId = $(this).attr('for');
            var val = $('#' + forId).val();
            if (val && ratingLabels[val]) {
                $('#rating_hint_text').text(ratingLabels[val]);
            }
        });

        $('.rating-interactive-stars').on('mouseleave', function() {
            var checkedVal = $('input[name="rating"]:checked').val();
            if (checkedVal && ratingLabels[checkedVal]) {
                $('#rating_hint_text').text(ratingLabels[checkedVal]);
            } else {
                $('#rating_hint_text').html('<i class="fa-regular fa-hand-pointer me-1"></i> Tap to rate');
            }
        });
    </script>

    <!-- Video Testimonial Recording Script -->
    <script>
        var loader = document.getElementById('loader');
        var overlay = document.querySelector('.overlay');

        const video_box = document.getElementById('video_box');
        const videoElement = document.getElementById('videoElement');
        const previewVideo = document.getElementById('previewVideo');
        const startButton = document.getElementById('startButton');
        const stopButton = document.getElementById('stopButton');
        const uploadButton = document.getElementById('uploadButton');
        const previewButton = document.getElementById('previewButton');
        const restartButton = document.getElementById('restartButton');
        const recordingTimeDisplay = document.getElementById('recordingTime');
        const recordingTimeBoxDisplay = document.getElementById('video_record_time_box');
        const preprationTimeDisplay = document.getElementById('preprationTime');
        const preprationTimeBoxDisplay = document.getElementById('video_prepration_time_box');
        const name_phone_no_box = document.getElementById('name_phone_no_box');

        let mediaRecorder;
        let recordedChunks = [];
        let startTime;
        let timerInterval;
        let remainingTime = 60;
        let videoStream;

        if (startButton) {
            startButton.addEventListener('click', () => {
                startButton.disabled = true;
                video_box.style.background = 'black';
                $('.record_start_button').hide();
                preprationTimeBoxDisplay.style.display = 'inline';

                countdown(5, () => {
                    startButton.disabled = false;
                    startRecording();
                    videoElement.style.display = 'block';
                    preprationTimeBoxDisplay.style.display = 'none';
                    recordingTimeDisplay.style.display = 'inline';
                    recordingTimeBoxDisplay.style.display = 'flex';
                });
            });
        }

        function startRecording() {
            startButton.style.display = 'none';
            stopButton.style.display = 'inline-block';

            var audio = document.getElementById("audioPlayer");
            if (audio) {
                audio.play().catch(e => console.log('Audio autoplay prevented'));
            }

            try {
                if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                    const constraints = { 
                        video: { facingMode: 'user' },
                        audio: true 
                    };
                    navigator.mediaDevices.getUserMedia(constraints)
                        .then(stream => {
                            videoStream = stream;
                            videoElement.srcObject = videoStream;
                            mediaRecorder = new MediaRecorder(videoStream);

                            mediaRecorder.ondataavailable = event => {
                                if (event.data.size > 0) {
                                    recordedChunks.push(event.data);
                                }
                            };

                            mediaRecorder.start();
                            startTime = Date.now();
                            timerInterval = setInterval(updateRecordingTime, 1000);
                        })
                        .catch(error => {
                            let errorMsg;
                            switch(error.name) {
                                case 'NotFoundError':
                                    errorMsg = 'No camera or microphone found.';
                                    break;
                                case 'NotAllowedError':
                                    errorMsg = 'Camera/mic permission denied. Please allow camera access in browser.';
                                    break;
                                case 'NotReadableError':
                                    errorMsg = 'Camera is already in use by another app.';
                                    break;
                                default:
                                    errorMsg = 'Error accessing webcam. Please try again.';
                            }
                            $('.web_cam_error').html(errorMsg);
                            console.error('Error accessing webcam and microphone:', error);
                        });
                } else {
                    $('.web_cam_error').html('Your browser does not support webcam recording.');
                }
            } catch (error) {
                $('.web_cam_error').html('Error accessing webcam, please try again.');
                console.error(error);
            }
        }

        if (stopButton) {
            stopButton.addEventListener('click', () => {
                if (mediaRecorder && mediaRecorder.state === 'recording') {
                    mediaRecorder.stop();
                }
                clearInterval(timerInterval);
                uploadButton.style.display = 'inline-block';
                previewButton.style.display = 'inline-block';
                restartButton.style.display = 'inline-block';
                stopButton.style.display = 'none';
                name_phone_no_box.style.display = 'block';
                $('.submit_button_alert').show();

                if (videoStream) {
                    videoStream.getTracks().forEach(track => track.stop());
                }
            });
        }

        if (uploadButton) {
            uploadButton.addEventListener('click', () => {
                if (recordedChunks.length > 0) {
                    uploadButton.style.display = 'none';
                    if ($('#video_customer_aggree').is(':checked')) {
                        $('.video_customer_aggree_error').html('');
                    } else {
                        $('.video_customer_aggree_error').html('Please agree to terms to submit.');
                        uploadButton.style.display = 'inline-block';
                        return;
                    }

                    var rating_number = $('#rating_number').val();
                    var video_customer_name = $('#video_customer_name').val();
                    if (!video_customer_name) {
                        alert('Please enter your name.');
                        uploadButton.style.display = 'inline-block';
                        return;
                    }
                    var video_customer_phone = $('#video_customer_phone').val() || '';

                    const blob = new Blob(recordedChunks, { type: 'video/mp4' });
                    const formData = new FormData();
                    formData.append('video', blob, 'video.mp4');
                    const testi_user_id = $('#testi_user_id').val();
                    formData.append('testi_user_id', testi_user_id);
                    formData.append('rating_number', rating_number);
                    formData.append('video_customer_name', video_customer_name);
                    formData.append('video_customer_phone', video_customer_phone);

                    loader.style.display = 'flex';
                    overlay.style.display = 'block';

                    $.ajax({
                        url: '{{ URL::to("u/video_testimonial_form_submit") }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            toastr.success('Video testimonial uploaded successfully!');
                            loader.style.display = 'none';
                            overlay.style.display = 'none';
                            $('.more_three_star').show();
                            $('#video_testimonial_form').hide();
                        },
                        error: function(xhr, status, error) {
                            toastr.error('Error uploading video. Please try again.');
                            loader.style.display = 'none';
                            overlay.style.display = 'none';
                            $('.more_three_star').show();
                            $('#video_testimonial_form').hide();
                        }
                    });
                }
            });
        }

        if (previewButton) {
            previewButton.addEventListener('click', () => {
                previewVideo.style.display = 'block';
                videoElement.style.display = 'none';
                const blob = new Blob(recordedChunks, { type: 'video/webm' });
                const url = URL.createObjectURL(blob);
                previewVideo.src = url;
                previewVideo.play();
            });
        }

        if (restartButton) {
            restartButton.addEventListener('click', () => {
                previewVideo.pause();
                previewVideo.style.display = 'none';
                videoElement.style.display = 'none';
                $('.record_start_button').show();
                startButton.disabled = false;
                startButton.style.display = 'inline-flex';
                stopButton.style.display = 'none';
                uploadButton.style.display = 'none';
                previewButton.style.display = 'none';
                restartButton.style.display = 'none';
                $('.submit_button_alert').hide();
                recordedChunks = [];
                remainingTime = 60;
                recordingTimeDisplay.textContent = '00:60';
            });
        }

        function updateRecordingTime() {
            remainingTime--;
            const minutes = Math.floor(remainingTime / 60);
            const seconds = remainingTime % 60;
            const formattedTime = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            recordingTimeDisplay.textContent = formattedTime;
            if (remainingTime <= 0) {
                stopButton.click();
            }
        }

        function countdown(seconds, callback) {
            let counter = seconds;
            const countdownInterval = setInterval(() => {
                counter--;
                if (counter < 0) {
                    clearInterval(countdownInterval);
                    if (callback) {
                        callback();
                    }
                } else {
                    preprationTimeDisplay.textContent = `${counter}`;
                }
            }, 1000);
        }
    </script>

    <!-- PWA Service Worker -->
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        function saveCurrentUrl() {
            localStorage.setItem('lastVisitedUrl', window.location.href);
        }

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').catch(error => {
                    console.log('Service Worker registration skipped:', error);
                });
            });
        }

        window.addEventListener('beforeunload', saveCurrentUrl);

        let deferredPrompt;
        const installButton = document.getElementById('installButton');

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            if (installButton) {
                installButton.style.display = 'inline-flex';
                installButton.addEventListener('click', () => {
                    installButton.style.display = 'none';
                    deferredPrompt.prompt();
                    deferredPrompt.userChoice.then(() => {
                        deferredPrompt = null;
                    });
                });
            }
        });
    </script>

    <!-- Flow Navigation & Form Handling -->
    <script>
        function get_review_value(review) {
            var review_option = <?php echo $user->review_show_option ?? 3; ?>;
            if (review > review_option) {
                $('.more_three_star').fadeIn(250);
                $('.private_feedback').hide();
                $('.lessthen_three_feedback').hide();
            } else {
                $('.more_three_star').hide();
                $('.lessthen_three_feedback').fadeIn(250);
            }
            $('.logo_part').hide();
            $('#rating_number').val(review);
        }

        function open_private_feedback() {
            $('.private_feedback').fadeIn(250);
            $('.more_three_star').hide();
            review_links_analytics('private');
        }

        function close_form() {
            $('.private_feedback').hide();
            $('.lessthen_three_feedback').hide();
            $('#video_testimonial_form').hide();
            $('.logo_part').fadeIn(200);
        }

        function customer_field_section_show() {
            var customer_support = $('#customer_support').val();
            if (customer_support !== undefined && customer_support !== '') {
                var checkedValue = $('input[name="f_customer_support"]:checked').val();
                if (checkedValue !== undefined) {
                    $('.customer_support_error').html('');
                } else {
                    $('.customer_support_error').html('Please rate ' + customer_support);
                    return false;
                }
            }

            var rate_text = $('#rate_text').val();
            if (rate_text !== undefined && rate_text !== '') {
                var checkedValue = $('input[name="f_rate_text"]:checked').val();
                if (checkedValue !== undefined) {
                    $('.rate_text_error').html('');
                } else {
                    $('.rate_text_error').html('Please rate ' + rate_text);
                    return false;
                }
            }

            $('.form_field_section').hide();
            $('.customer_field_section').fadeIn(200);
        }

        function customer_field_section_hide() {
            $('.form_field_section').fadeIn(200);
            $('.customer_field_section').hide();
        }

        function close_social_links() {
            $('.logo_part').fadeIn(200);
            $('.more_three_star').hide();
        }

        function show_share_option() {
            var div = document.getElementById("share_anchor");
            if (div) {
                div.style.display = (div.style.display === "block") ? "none" : "block";
            }
        }

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.share-dropdown-wrapper').length) {
                $('#share_anchor').hide();
            }
        });

        function record_video() {
            $('.video_testimonial').fadeIn(250);
            $('.more_three_star').hide();
            review_links_analytics('record');
        }

        function review_links_analytics(type) {
            var user_id = "{{$user->id}}";
            $.ajax({
                url: '{{ URL::to("/review_links_analytics") }}',
                type: 'POST',
                data: {
                    type: type,
                    _token: '{{ csrf_token() }}',
                    user_id: user_id
                },
                success: function(response) {},
                error: function(xhr, status, error) {}
            });
        }
    </script>

    <!-- Google Reviews Templates Popup Handling -->
    <script>
        var currentGoogleReviewUrl = '';

        function open_google_reviews_popup(reviewUrl) {
            currentGoogleReviewUrl = reviewUrl || '{{ $IntegrationGoogle->review_links ?? "" }}';
            review_links_analytics('google');
            
            $('#copy_feedback_toast').addClass('d-none');
            
            var modalEl = document.getElementById('googleReviewsPopupModal');
            if (modalEl) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    var myModal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    myModal.show();
                } else {
                    $(modalEl).modal('show');
                }
            }
        }

        function closeGoogleReviewsPopup() {
            var modalEl = document.getElementById('googleReviewsPopupModal');
            if (modalEl) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    var myModal = bootstrap.Modal.getInstance(modalEl);
                    if (myModal) myModal.hide();
                } else {
                    $(modalEl).modal('hide');
                }
            }
        }

        function selectAndCopyReview(text) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(function() {
                    finishCopyAction();
                }).catch(function() {
                    fallbackCopyText(text);
                });
            } else {
                fallbackCopyText(text);
            }
        }

        function fallbackCopyText(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed";
            textArea.style.left = "-999999px";
            textArea.style.top = "-999999px";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
            } catch (err) {
                console.error('Fallback copy error', err);
            }
            document.body.removeChild(textArea);
            finishCopyAction();
        }

        function finishCopyAction() {
            $('#copy_feedback_toast').removeClass('d-none');
            
            if (typeof toastr !== 'undefined') {
                toastr.success('Review copied! Opening Google Reviews...', 'Copied to Clipboard');
            }
            
            setTimeout(function() {
                if (currentGoogleReviewUrl) {
                    window.open(currentGoogleReviewUrl, '_blank');
                }
            }, 700);
        }

        function openDirectGoogleReview() {
            if (currentGoogleReviewUrl) {
                window.open(currentGoogleReviewUrl, '_blank');
            }
            closeGoogleReviewsPopup();
        }
    </script>

    <!-- Session Notifications -->
    <script>
        @if(Session::has('messege'))
            var type = "{{Session::get('alert-type','info')}}";
            switch (type) {
                case 'info':
                    toastr.info("{{Session::get('messege')}}");
                    break;
                case 'success':
                    toastr.success("{{Session::get('messege')}}");
                    break;
                case 'warning':
                case 'worning':
                    toastr.warning("{{Session::get('messege')}}");
                    break;
                case 'error':
                    toastr.error("{{Session::get('messege')}}");
                    break;
            }
        @endif
    </script>

</body>
</html>