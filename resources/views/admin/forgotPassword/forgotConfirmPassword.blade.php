<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Reset Password | AskReview - Google Review &amp; Multi-Channel Feedback Platform</title>
  <meta name="description" content="Set a new secure password for your AskReview dashboard." />
  
  <meta name="theme-color" content="#e11d48" />
  <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/images/logo.jpg') }}" />
  <link rel="apple-touch-icon" href="{{ asset('frontend/images/logo.jpg') }}" />
  <link rel="manifest" href="{{ asset('/manifest.json') }}" />

  <!-- Modern Google Fonts & Bootstrap Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <!-- Toastr Notification CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
  
  <!-- Clean Corporate Light Stylesheet -->
  <link rel="stylesheet" href="{{ asset('frontend/css/modern-auth.css') }}?v={{ time() }}" />
</head>
<body class="auth-body">

  <div class="auth-wrapper">
    
    <!-- ====================================================================
         LEFT PANEL: 5-Slide Multi-Channel Review Hub Carousel (Light Theme)
         ==================================================================== -->
    <div class="auth-hero-panel">
      <!-- Top Brand Header -->
      <div class="hero-header">
        <a href="{{ url('/') }}" class="hero-brand">
          <div style="display:flex;align-items:center;gap:10px;">
            <div style="width:32px;height:32px;background:var(--brand-red);border-radius:8px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(225,29,72,0.3);">
              <span style="font-family:'Plus Jakarta Sans',sans-serif;font-size:14px;font-weight:900;color:#fff;">A</span>
            </div>
            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-size:1.05rem;font-weight:800;color:#0f172a;letter-spacing:-0.01em;">AskReview<span style="color:var(--brand-red);">.</span></span>
          </div>
        </a>
        <div class="hero-badge-pill">
          <span class="pulse-dot"></span>
          <span>Account Security</span>
        </div>
      </div>

      <!-- Centered 5-Slide Multi-Review Carousel -->
      <div class="hero-carousel-wrapper">
        <div class="qr-carousel" id="authQrCarousel">
          <div class="carousel-slides" id="carouselSlides">
            
            <!-- SLIDE 1: Multi-Platform Review Hub (Matching /u/rajuranjanagency) -->
            <div class="carousel-slide active" data-index="0">
              <div class="slide-visual-card">
                <div class="slide-badge-top">
                  <i class="bi bi-grid-fill"></i> Multi-Platform Review Hub
                </div>
                
                <div class="slide-graphic-container">
                  <!-- High-Fidelity Realistic Smartphone Review Hub Showcase -->
                  <svg class="slide-graphic-svg" viewBox="0 0 460 415" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                      <linearGradient id="instaGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#833ab4"/>
                        <stop offset="50%" stop-color="#fd1d1d"/>
                        <stop offset="100%" stop-color="#fcb045"/>
                      </linearGradient>
                      <filter id="floatShadow" x="-10%" y="-10%" width="125%" height="125%">
                        <feDropShadow dx="0" dy="4" stdDeviation="5" flood-color="rgba(15,23,42,0.08)"/>
                      </filter>
                      <filter id="phoneShadow" x="-15%" y="-10%" width="130%" height="125%">
                        <feDropShadow dx="0" dy="12" stdDeviation="16" flood-color="rgba(15,23,42,0.16)"/>
                      </filter>
                    </defs>

                    <!-- Desk Base Shadow -->
                    <ellipse cx="230" cy="408" rx="130" ry="6" fill="rgba(15,23,42,0.08)"/>
                    
                    <!-- Side Physical Buttons -->
                    <!-- Volume Up -->
                    <rect x="128" y="80" width="3" height="22" rx="1.5" fill="#475569"/>
                    <!-- Volume Down -->
                    <rect x="128" y="110" width="3" height="22" rx="1.5" fill="#475569"/>
                    <!-- Power Button -->
                    <rect x="329" y="90" width="3" height="30" rx="1.5" fill="#475569"/>

                    <!-- Main Smartphone Outer Frame (Chassis / Bezel) -->
                    <rect x="131" y="6" width="198" height="396" rx="38" fill="#0f172a" stroke="#334155" stroke-width="2" filter="url(#phoneShadow)"/>
                    
                    <!-- Smartphone Inner Screen Display -->
                    <rect x="135" y="10" width="190" height="388" rx="34" fill="#ffffff"/>

                    <!-- Top Dynamic Island Pill -->
                    <rect x="195" y="15" width="70" height="13" rx="6.5" fill="#000000"/>
                    <circle cx="248" cy="21.5" r="2.8" fill="#1e293b"/>
                    <circle cx="248.5" cy="21" r="1" fill="#2563eb" opacity="0.6"/>

                    <!-- Status Bar: Time & Connectivity Icons -->
                    <text x="152" y="25" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.2" font-weight="700" fill="#0f172a">9:41</text>
                    <g transform="translate(288, 18)">
                      <!-- Signal Bars -->
                      <rect x="0" y="5" width="1.8" height="3" rx="0.5" fill="#0f172a"/>
                      <rect x="2.8" y="3.5" width="1.8" height="4.5" rx="0.5" fill="#0f172a"/>
                      <rect x="5.6" y="2" width="1.8" height="6" rx="0.5" fill="#0f172a"/>
                      <rect x="8.4" y="0.5" width="1.8" height="7.5" rx="0.5" fill="#0f172a"/>
                      <!-- Battery -->
                      <rect x="14" y="1" width="15" height="7" rx="2" fill="none" stroke="#0f172a" stroke-width="0.8"/>
                      <rect x="15.5" y="2.5" width="9.5" height="4" rx="1" fill="#16a34a"/>
                      <path d="M29.5 3 V5.5" stroke="#0f172a" stroke-width="0.8" stroke-linecap="round"/>
                    </g>
                    
                    <!-- Screen Content -->
                    <!-- Top Navigation: Back Button & Agency Header -->
                    <g transform="translate(143, 36)">
                      <circle cx="7" cy="8" r="7" fill="#f8fafc" stroke="#e2e8f0" stroke-width="0.8"/>
                      <path d="M8.5 6 L6 8 L8.5 10" stroke="#475569" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    
                    <!-- Business Logo Header Card (Center Top) -->
                    <g transform="translate(202, 32)">
                      <rect x="0" y="0" width="56" height="23" rx="6" fill="#ffffff" stroke="#e2e8f0" stroke-width="0.8"/>
                      <circle cx="12" cy="11.5" r="6" fill="#eff6ff"/>
                      <text x="12" y="14" font-family="'Plus Jakarta Sans', sans-serif" font-size="7" font-weight="900" fill="#2563eb" text-anchor="middle">R</text>
                      <text x="34" y="10" font-family="'Plus Jakarta Sans', sans-serif" font-size="4.8" font-weight="800" fill="#0f172a" text-anchor="middle">AGENCY</text>
                      <text x="34" y="15.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="3.2" font-weight="600" fill="#2563eb" text-anchor="middle">TRUE VALUE</text>
                    </g>

                    <!-- 5 Glowing Rating Stars -->
                    <g transform="translate(193, 62)">
                      <polygon points="4.5,0 5.8,3 9,3.5 6.7,5.6 7.3,8.7 4.5,7.2 1.7,8.7 2.3,5.6 0,3.5 3.2,3" fill="#f59e0b"/>
                      <polygon points="4.5,0 5.8,3 9,3.5 6.7,5.6 7.3,8.7 4.5,7.2 1.7,8.7 2.3,5.6 0,3.5 3.2,3" fill="#f59e0b" transform="translate(16, 0)"/>
                      <polygon points="4.5,0 5.8,3 9,3.5 6.7,5.6 7.3,8.7 4.5,7.2 1.7,8.7 2.3,5.6 0,3.5 3.2,3" fill="#f59e0b" transform="translate(32, 0)"/>
                      <polygon points="4.5,0 5.8,3 9,3.5 6.7,5.6 7.3,8.7 4.5,7.2 1.7,8.7 2.3,5.6 0,3.5 3.2,3" fill="#f59e0b" transform="translate(48, 0)"/>
                      <polygon points="4.5,0 5.8,3 9,3.5 6.7,5.6 7.3,8.7 4.5,7.2 1.7,8.7 2.3,5.6 0,3.5 3.2,3" fill="#f59e0b" transform="translate(64, 0)"/>
                    </g>

                    <!-- Friendly Header -->
                    <text x="230" y="80" font-family="'Plus Jakarta Sans', sans-serif" font-size="10.5" font-weight="800" fill="#0f172a" text-anchor="middle">Thank You!</text>
                    <text x="230" y="89" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#64748b" text-anchor="middle">Select your preferred platform below to leave us a quick review.</text>

                    <!-- 1. GOOGLE REVIEW CARD -->
                    <g class="hub-review-row" data-platform="Google" transform="translate(144, 98)">
                      <rect class="hub-card-bg" x="0" y="0" width="172" height="26" rx="7" fill="#ffffff" stroke="#e2e8f0" stroke-width="1"/>
                      <circle cx="13" cy="13" r="8" fill="#f8fafc" stroke="#f1f5f9"/>
                      <path d="M15.5 13 H13 V14.5 H14.6 C14.3 15.3 13.6 15.8 12.7 15.8 C11.4 15.8 10.4 14.7 10.4 13.3 C10.4 12 11.4 10.9 12.7 10.9 C13.3 10.9 13.9 11.1 14.3 11.5 L15.4 10.4 C14.7 9.7 13.7 9.3 12.7 9.3 C10.5 9.3 8.7 11.1 8.7 13.3 C8.7 15.5 10.5 17.3 12.7 17.3 C15 17.3 16.5 15.7 16.5 13.4 C16.5 13.1 16.4 12.8 16.4 12.6 L15.5 13 Z" fill="#4285F4"/>
                      <text x="27" y="11" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Google</text>
                      <text x="27" y="19" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#64748b">Pick pre-written review &amp; paste</text>
                      <circle cx="160" cy="13" r="5" fill="#f8fafc"/>
                      <path class="row-arrow" d="M159 11 L161.5 13 L159 15" stroke="#94a3b8" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 2. FACEBOOK REVIEW CARD -->
                    <g class="hub-review-row" data-platform="Facebook" transform="translate(144, 130)">
                      <rect class="hub-card-bg" x="0" y="0" width="172" height="26" rx="7" fill="#ffffff" stroke="#e2e8f0" stroke-width="1"/>
                      <circle cx="13" cy="13" r="8" fill="#1877f2"/>
                      <text x="13" y="16.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="9.5" font-weight="800" fill="#ffffff" text-anchor="middle">f</text>
                      <text x="27" y="11" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Facebook</text>
                      <text x="27" y="19" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#64748b">Review us on Facebook</text>
                      <circle cx="160" cy="13" r="5" fill="#f8fafc"/>
                      <path class="row-arrow" d="M159 11 L161.5 13 L159 15" stroke="#94a3b8" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 3. INSTAGRAM REVIEW CARD -->
                    <g class="hub-review-row" data-platform="Instagram" transform="translate(144, 162)">
                      <rect class="hub-card-bg" x="0" y="0" width="172" height="26" rx="7" fill="#ffffff" stroke="#e2e8f0" stroke-width="1"/>
                      <circle cx="13" cy="13" r="8" fill="url(#instaGradient)"/>
                      <rect x="8.5" y="9" width="9" height="8" rx="2.2" fill="none" stroke="#ffffff" stroke-width="0.9"/>
                      <circle cx="13" cy="13" r="2.2" fill="none" stroke="#ffffff" stroke-width="0.8"/>
                      <circle cx="15.5" cy="10.7" r="0.5" fill="#ffffff"/>
                      <text x="27" y="11" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Instagram</text>
                      <text x="27" y="19" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#64748b">Review us on Instagram</text>
                      <circle cx="160" cy="13" r="5" fill="#f8fafc"/>
                      <path class="row-arrow" d="M159 11 L161.5 13 L159 15" stroke="#94a3b8" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 4. YOUTUBE REVIEW CARD -->
                    <g class="hub-review-row" data-platform="YouTube" transform="translate(144, 194)">
                      <rect class="hub-card-bg" x="0" y="0" width="172" height="26" rx="7" fill="#ffffff" stroke="#e2e8f0" stroke-width="1"/>
                      <circle cx="13" cy="13" r="8" fill="#ff0000"/>
                      <polygon points="11.5,10 16,13 11.5,16" fill="#ffffff"/>
                      <text x="27" y="11" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Youtube</text>
                      <text x="27" y="19" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#64748b">Review us on Youtube</text>
                      <circle cx="160" cy="13" r="5" fill="#f8fafc"/>
                      <path class="row-arrow" d="M159 11 L161.5 13 L159 15" stroke="#94a3b8" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 5. VIDEO TESTIMONIAL CARD (HIGHLIGHTED IN SOFT PINK/ROSE) -->
                    <g class="hub-review-row" data-platform="Video Testimonial" transform="translate(144, 226)">
                      <rect class="hub-card-bg" x="0" y="0" width="172" height="26" rx="7" fill="#fff1f2" stroke="#fecdd3" stroke-width="1.2"/>
                      <circle cx="13" cy="13" r="8" fill="#ffe4e6"/>
                      <rect x="9.5" y="9.5" width="5.5" height="7" rx="1.2" fill="#e11d48"/>
                      <polygon points="15,11.5 18,10 18,16 15,14.5" fill="#e11d48"/>
                      <text x="27" y="11" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Video Testimonial</text>
                      <circle cx="97" cy="8.5" r="2.2" fill="#e11d48" class="rec-dot-animated"/>
                      <text x="27" y="19" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#e11d48">Record a 60–sec video shoutout</text>
                      <circle cx="160" cy="13" r="5" fill="#fff1f2"/>
                      <path class="row-arrow" d="M159 11 L161.5 13 L159 15" stroke="#e11d48" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 6. PRIVATE ENQUIRY CARD (HIGHLIGHTED IN SOFT AMBER) -->
                    <g class="hub-review-row" data-platform="Private Enquiry" transform="translate(144, 258)">
                      <rect class="hub-card-bg" x="0" y="0" width="172" height="26" rx="7" fill="#fffdf0" stroke="#fde68a" stroke-width="1.2"/>
                      <circle cx="13" cy="13" r="8" fill="#fef3c7"/>
                      <rect x="9.5" y="9.5" width="7" height="5.5" rx="1.5" fill="#d97706"/>
                      <polygon points="11,15 13,15 10,17" fill="#d97706"/>
                      <text x="27" y="11" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Private Enquiry</text>
                      <text x="27" y="19" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#b45309">Send a direct private message to us</text>
                      <circle cx="160" cy="13" r="5" fill="#fffdf0"/>
                      <path class="row-arrow" d="M159 11 L161.5 13 L159 15" stroke="#d97706" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 7. INSTALL APP PILL BUTTON -->
                    <g class="hub-review-row" data-platform="App Install" transform="translate(164, 290)">
                      <rect class="hub-card-bg" x="0" y="0" width="132" height="17" rx="8.5" fill="#ffffff" stroke="#bfdbfe" stroke-width="0.9"/>
                      <path d="M8 4.5 H10.5 C10.8 4.5 11 4.7 11 5 V11 C11 11.3 10.8 11.5 10.5 11.5 H8 C7.7 11.5 7.5 11.3 7.5 11 V5 C7.5 4.7 7.7 4.5 8 4.5 Z" fill="none" stroke="#2563eb" stroke-width="0.8"/>
                      <circle cx="9.25" cy="10.3" r="0.4" fill="#2563eb"/>
                      <text x="70" y="11" font-family="'Plus Jakarta Sans', sans-serif" font-size="5.5" font-weight="700" fill="#2563eb" text-anchor="middle">Install App on Home Screen</text>
                    </g>

                    <!-- Interactive Notification Toast Inside Smartphone Screen -->
                    <g id="hubToastMessage" opacity="0" transform="translate(148, 335)" style="transition: all 0.3s cubic-bezier(0.34, 1.4, 0.64, 1); pointer-events: none;">
                      <rect width="164" height="26" rx="13" fill="#0f172a" filter="url(#floatShadow)"/>
                      <circle cx="15" cy="13" r="6" fill="#16a34a"/>
                      <path d="M12.5 13 L14.5 15 L17.5 11" stroke="#ffffff" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                      <text id="hubToastText" x="27" y="16" font-family="'Plus Jakarta Sans', sans-serif" font-size="6.8" font-weight="700" fill="#ffffff">Google Reviews Selected</text>
                    </g>

                    <!-- Bottom iOS Home Indicator -->
                    <rect x="195" y="386" width="70" height="3.5" rx="1.75" fill="#0f172a"/>

                    <!-- Left Floating Feature Pill -->
                    <g transform="translate(6, 170)" filter="url(#floatShadow)">
                      <rect x="0" y="0" width="102" height="48" rx="10" fill="#ffffff" stroke="#e2e8f0" stroke-width="1.2"/>
                      <circle cx="18" cy="24" r="8.5" fill="#fff1f2"/>
                      <text x="18" y="27.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="8.5" font-weight="800" fill="#e11d48" text-anchor="middle">QR</text>
                      <text x="33" y="19" font-family="'Plus Jakarta Sans', sans-serif" font-size="8.5" font-weight="800" fill="#e11d48">1 QR Stand</text>
                      <text x="33" y="32" font-family="'Inter', sans-serif" font-size="7" font-weight="600" fill="#64748b">All Review Links</text>
                    </g>
                    
                    <!-- Right Floating Feature Pill -->
                    <g transform="translate(352, 195)" filter="url(#floatShadow)">
                      <rect x="0" y="0" width="102" height="48" rx="10" fill="#ffffff" stroke="#cbd5e1" stroke-width="1.2"/>
                      <circle cx="18" cy="24" r="8.5" fill="#f0fdf4"/>
                      <text x="18" y="27.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="10" fill="#16a34a" text-anchor="middle">⚡</text>
                      <text x="33" y="19" font-family="'Plus Jakarta Sans', sans-serif" font-size="8.5" font-weight="800" fill="#16a34a">Instant Tap</text>
                      <text x="33" y="32" font-family="'Inter', sans-serif" font-size="7" font-weight="600" fill="#64748b">Google &amp; Socials</text>
                    </g>
                  </svg>
                </div>
                
                <h3 class="slide-title">Multi-Platform Review Hub</h3>
                <p class="slide-desc">Give customers complete freedom: Google, Facebook, Instagram, YouTube, Video Testimonials, or Private Enquiry in one single tap.</p>
                
                <div class="slide-features-row">
                  <span class="slide-pill"><i class="bi bi-google"></i> Google</span>
                  <span class="slide-pill"><i class="bi bi-facebook"></i> Facebook</span>
                  <span class="slide-pill"><i class="bi bi-instagram"></i> Instagram</span>
                  <span class="slide-pill"><i class="bi bi-youtube"></i> YouTube</span>
                  <span class="slide-pill"><i class="bi bi-camera-video"></i> Video Reviews</span>
                </div>
              </div>
            </div>

            <!-- SLIDE 2: Video Testimonials (Realistic Smartphone Live Recording Showcase) -->
            <div class="carousel-slide" data-index="1">
              <div class="slide-visual-card">
                <div class="slide-badge-top">
                  <i class="bi bi-camera-video-fill"></i> Live Video Testimonials
                </div>
                
                <div class="slide-graphic-container">
                  <!-- Tall Realistic Smartphone With Live Recording Activity -->
                  <svg class="slide-graphic-svg" viewBox="0 0 460 415" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                      <linearGradient id="camBgGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" stop-color="#1e293b"/>
                        <stop offset="50%" stop-color="#0f172a"/>
                        <stop offset="100%" stop-color="#090d16"/>
                      </linearGradient>
                      <linearGradient id="userFaceGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#fed7aa"/>
                        <stop offset="100%" stop-color="#fba86b"/>
                      </linearGradient>
                      <linearGradient id="userShirtGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#2563eb"/>
                        <stop offset="100%" stop-color="#1d4ed8"/>
                      </linearGradient>
                      <linearGradient id="recAuraGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#ef4444" stop-opacity="0.8"/>
                        <stop offset="100%" stop-color="#dc2626" stop-opacity="0.2"/>
                      </linearGradient>
                      <filter id="phoneShadow2" x="-15%" y="-10%" width="130%" height="125%">
                        <feDropShadow dx="0" dy="12" stdDeviation="16" flood-color="rgba(15,23,42,0.22)"/>
                      </filter>
                      <filter id="floatShadow2" x="-10%" y="-10%" width="125%" height="125%">
                        <feDropShadow dx="0" dy="4" stdDeviation="6" flood-color="rgba(15,23,42,0.08)"/>
                      </filter>
                      <filter id="glowRed" x="-20%" y="-20%" width="140%" height="140%">
                        <feDropShadow dx="0" dy="0" stdDeviation="6" flood-color="rgba(239,68,68,0.7)"/>
                      </filter>
                    </defs>

                    <!-- Desk Base Shadow -->
                    <ellipse cx="230" cy="408" rx="130" ry="6" fill="rgba(15,23,42,0.08)"/>
                    
                    <!-- Side Buttons -->
                    <rect x="128" y="80" width="3" height="22" rx="1.5" fill="#475569"/>
                    <rect x="128" y="110" width="3" height="22" rx="1.5" fill="#475569"/>
                    <rect x="329" y="90" width="3" height="30" rx="1.5" fill="#475569"/>

                    <!-- Main Smartphone Outer Chassis (Midnight Titanium) -->
                    <rect x="131" y="6" width="198" height="396" rx="38" fill="#0f172a" stroke="#334155" stroke-width="2" filter="url(#phoneShadow2)"/>
                    
                    <!-- Full-Screen Camera Viewfinder Screen -->
                    <rect x="135" y="10" width="190" height="388" rx="34" fill="url(#camBgGrad)"/>

                    <!-- Camera Viewfinder Grid (Subtle Rule of Thirds) -->
                    <line x1="198" y1="10" x2="198" y2="398" stroke="rgba(255,255,255,0.06)" stroke-width="0.8" stroke-dasharray="3 3"/>
                    <line x1="262" y1="10" x2="262" y2="398" stroke="rgba(255,255,255,0.06)" stroke-width="0.8" stroke-dasharray="3 3"/>
                    <line x1="135" y1="140" x2="325" y2="140" stroke="rgba(255,255,255,0.06)" stroke-width="0.8" stroke-dasharray="3 3"/>
                    <line x1="135" y1="265" x2="325" y2="265" stroke="rgba(255,255,255,0.06)" stroke-width="0.8" stroke-dasharray="3 3"/>

                    <!-- Realistic Customer Portrait (Selfie Camera Feed) -->
                    <g id="cameraUserFeed" transform="translate(160, 92)" style="transition: transform 0.4s ease; transform-origin: 70px 85px;">
                      <!-- Ambient Glow Behind User -->
                      <circle cx="70" cy="65" r="58" fill="#3b82f6" opacity="0.12"/>
                      
                      <!-- Shoulders & Torso -->
                      <path d="M12 155 C15 110, 40 100, 70 100 C100 100, 125 110, 128 155 Z" fill="url(#userShirtGrad)"/>
                      <!-- Shirt Collar V -->
                      <polygon points="70,118 60,100 80,100" fill="#ffffff" opacity="0.9"/>
                      
                      <!-- Neck -->
                      <rect x="61" y="78" width="18" height="24" rx="4" fill="#fba86b"/>
                      
                      <!-- Head / Face -->
                      <ellipse cx="70" cy="58" rx="27" ry="32" fill="url(#userFaceGrad)"/>
                      
                      <!-- Stylish Modern Haircut -->
                      <path d="M40 50 C40 26, 56 18, 70 18 C84 18, 100 26, 100 50 C95 44, 88 40, 70 40 C52 40, 45 44, 40 50 Z" fill="#1e293b"/>
                      
                      <!-- Friendly Facial Features: Eyes & Smile -->
                      <!-- Left Eye -->
                      <ellipse cx="60" cy="54" rx="3.5" ry="2.5" fill="#1e293b"/>
                      <circle cx="61" cy="53" r="1" fill="#ffffff"/>
                      <!-- Right Eye -->
                      <ellipse cx="80" cy="54" rx="3.5" ry="2.5" fill="#1e293b"/>
                      <circle cx="81" cy="53" r="1" fill="#ffffff"/>
                      <!-- Smile -->
                      <path d="M59 68 Q70 79 81 68" stroke="#7c2d12" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                      <path d="M62 69 Q70 77 78 69" fill="#ffffff"/>
                      <!-- Cheerful Cheeks -->
                      <circle cx="53" cy="64" r="5" fill="#f43f5e" opacity="0.25"/>
                      <circle cx="87" cy="64" r="5" fill="#f43f5e" opacity="0.25"/>
                    </g>

                    <!-- Camera Autofocus Face Reticle Brackets (Pulsing) -->
                    <g class="camera-focus-reticle" transform="translate(230, 150)">
                      <!-- Top-Left Corner -->
                      <path d="M-36 -30 H-44 V-22" stroke="#38bdf8" stroke-width="1.8" stroke-linecap="round"/>
                      <!-- Top-Right Corner -->
                      <path d="M36 -30 H44 V-22" stroke="#38bdf8" stroke-width="1.8" stroke-linecap="round"/>
                      <!-- Bottom-Left Corner -->
                      <path d="M-36 30 H-44 V22" stroke="#38bdf8" stroke-width="1.8" stroke-linecap="round"/>
                      <!-- Bottom-Right Corner -->
                      <path d="M36 30 H44 V22" stroke="#38bdf8" stroke-width="1.8" stroke-linecap="round"/>
                      <!-- Small Center Crosshair -->
                      <path d="M-3 0 H3 M0 -3 V3" stroke="#38bdf8" stroke-width="1.2"/>
                      <!-- Face Detection Label -->
                      <rect x="-24" y="-38" width="48" height="11" rx="4" fill="rgba(14,165,233,0.85)"/>
                      <text x="0" y="-30" font-family="'Plus Jakarta Sans', sans-serif" font-size="5.8" font-weight="700" fill="#ffffff" text-anchor="middle">FACE 4K</text>
                    </g>

                    <!-- Top Dynamic Island Pill -->
                    <rect x="195" y="15" width="70" height="13" rx="6.5" fill="#000000"/>
                    <circle cx="248" cy="21.5" r="2.8" fill="#1e293b"/>
                    <circle cx="248.5" cy="21" r="1" fill="#2563eb" opacity="0.6"/>

                    <!-- iOS Status Bar (White on Dark Camera) -->
                    <text x="152" y="25" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.2" font-weight="700" fill="#ffffff">9:41</text>
                    <g transform="translate(288, 18)">
                      <!-- Signal Bars -->
                      <rect x="0" y="5" width="1.8" height="3" rx="0.5" fill="#ffffff"/>
                      <rect x="2.8" y="3.5" width="1.8" height="4.5" rx="0.5" fill="#ffffff"/>
                      <rect x="5.6" y="2" width="1.8" height="6" rx="0.5" fill="#ffffff"/>
                      <rect x="8.4" y="0.5" width="1.8" height="7.5" rx="0.5" fill="#ffffff"/>
                      <!-- Battery -->
                      <rect x="14" y="1" width="15" height="7" rx="2" fill="none" stroke="#ffffff" stroke-width="0.8"/>
                      <rect x="15.5" y="2.5" width="9.5" height="4" rx="1" fill="#16a34a"/>
                      <path d="M29.5 3 V5.5" stroke="#ffffff" stroke-width="0.8" stroke-linecap="round"/>
                    </g>

                    <!-- Top Recording Control Bar -->
                    <!-- Live Pulsating Red REC Pill -->
                    <g transform="translate(144, 34)">
                      <rect x="0" y="0" width="76" height="20" rx="10" fill="rgba(15,23,42,0.8)" stroke="rgba(239,68,68,0.4)" stroke-width="1"/>
                      <circle id="recIndicatorDot" cx="11" cy="10" r="4.5" fill="#ef4444" class="rec-dot-animated" filter="url(#glowRed)"/>
                      <text id="liveRecLabel" x="22" y="13.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="6.8" font-weight="800" fill="#ef4444">REC</text>
                      <text id="liveTimerText" x="43" y="13.5" font-family="'JetBrains Mono', monospace, sans-serif" font-size="7.5" font-weight="800" fill="#ffffff">00:18</text>
                    </g>
                    <!-- Quality Badge Right -->
                    <g transform="translate(254, 34)">
                      <rect x="0" y="0" width="62" height="20" rx="10" fill="rgba(15,23,42,0.8)" stroke="rgba(255,255,255,0.15)" stroke-width="0.8"/>
                      <circle cx="10" cy="10" r="3" fill="#22c55e"/>
                      <text x="36" y="13.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="6.5" font-weight="700" fill="#f8fafc" text-anchor="middle">4K • 60fps</text>
                    </g>

                    <!-- Live Audio Soundwave Visualizer Bars Above Controls -->
                    <g id="soundwaveContainer" transform="translate(195, 275)">
                      <rect class="wave-bar-1" x="0" y="304" width="3.5" height="6" rx="1.5" fill="#38bdf8"/>
                      <rect class="wave-bar-2" x="8" y="304" width="3.5" height="12" rx="1.5" fill="#38bdf8"/>
                      <rect class="wave-bar-3" x="16" y="304" width="3.5" height="16" rx="1.5" fill="#22c55e"/>
                      <rect class="wave-bar-4" x="24" y="304" width="3.5" height="9" rx="1.5" fill="#22c55e"/>
                      <rect class="wave-bar-5" x="32" y="304" width="3.5" height="18" rx="1.5" fill="#ef4444"/>
                      <rect class="wave-bar-6" x="40" y="304" width="3.5" height="11" rx="1.5" fill="#22c55e"/>
                      <rect class="wave-bar-7" x="48" y="304" width="3.5" height="15" rx="1.5" fill="#22c55e"/>
                      <rect class="wave-bar-8" x="56" y="304" width="3.5" height="8" rx="1.5" fill="#38bdf8"/>
                      <rect class="wave-bar-9" x="64" y="304" width="3.5" height="14" rx="1.5" fill="#38bdf8"/>
                    </g>

                    <!-- Frosted Glass Customer Testimonial Overlay Card Inside Video -->
                    <g transform="translate(144, 252)">
                      <rect width="172" height="34" rx="8" fill="rgba(15,23,42,0.82)" stroke="rgba(255,255,255,0.18)" stroke-width="0.8"/>
                      <text x="10" y="14" fill="#f59e0b" font-family="'Plus Jakarta Sans', sans-serif" font-size="8.5" font-weight="800">★★★★★</text>
                      <text x="62" y="13.5" fill="#ffffff" font-family="'Plus Jakarta Sans', sans-serif" font-size="6.8" font-weight="700">"Super easy video review!"</text>
                      <text x="10" y="26" fill="#94a3b8" font-family="'Inter', sans-serif" font-size="5.8" font-weight="500">Sarah Jenkins • Verified Client</text>
                      <circle cx="158" cy="17" r="4" fill="#16a34a"/>
                      <path d="M156 17 L157.5 18.5 L160 15.5" stroke="#ffffff" stroke-width="0.9" stroke-linecap="round"/>
                    </g>

                    <!-- Camera Shutter Flash Overlay -->
                    <rect id="cameraFlashOverlay" x="135" y="10" width="190" height="388" rx="34" fill="#ffffff" opacity="0" pointer-events="none"/>

                    <!-- Camera Control Bottom Deck -->
                    <!-- Flip Camera Button (Clickable Activity) -->
                    <g id="flipCameraBtn" class="camera-tool-btn" transform="translate(160, 336)">
                      <circle cx="12" cy="12" r="14" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.25)" stroke-width="0.8"/>
                      <path d="M8 12 A5 5 0 0 1 16 8 L17 6.5 M16 12 A5 5 0 0 1 8 16 L7 17.5" stroke="#ffffff" stroke-width="1.3" stroke-linecap="round"/>
                      <polygon points="17,8 14,8 17,5" fill="#ffffff"/>
                      <polygon points="7,16 10,16 7,19" fill="#ffffff"/>
                    </g>

                    <!-- Big Interactive Red Record Button (Clickable Activity) -->
                    <g id="cameraRecordBtn" class="camera-record-btn" transform="translate(230, 348)">
                      <!-- Pulsing Outer Aura Ring -->
                      <circle id="recAuraCircle" cx="0" cy="0" r="18" fill="url(#recAuraGrad)" class="record-aura-ring"/>
                      <!-- Outer White Camera Ring -->
                      <circle cx="0" cy="0" r="16" fill="none" stroke="#ffffff" stroke-width="2.5"/>
                      <!-- Inner Red Recording Core -->
                      <rect id="recCenterShape" x="-9" y="-9" width="18" height="18" rx="9" fill="#ef4444" style="transition: all 0.25s ease;"/>
                    </g>

                    <!-- Mic Status Button (Clickable Activity) -->
                    <g id="micToggleBtn" class="camera-tool-btn" transform="translate(276, 336)">
                      <circle cx="12" cy="12" r="14" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.25)" stroke-width="0.8"/>
                      <rect id="micIconBody" x="10" y="6.5" width="4" height="8" rx="2" fill="#22c55e" style="transition: fill 0.2s ease;"/>
                      <path id="micIconArc" d="M7.5 11 A4.5 4.5 0 0 0 16.5 11" stroke="#22c55e" stroke-width="1.2" fill="none" style="transition: stroke 0.2s ease;"/>
                      <line id="micIconStem" x1="12" y1="15.5" x2="12" y2="18" stroke="#22c55e" stroke-width="1.2" style="transition: stroke 0.2s ease;"/>
                    </g>

                    <!-- Bottom iOS Home Indicator (White on Camera Feed) -->
                    <rect x="195" y="386" width="70" height="3.5" rx="1.75" fill="#ffffff"/>

                    <!-- Left Floating Feature Pill -->
                    <g transform="translate(6, 170)" filter="url(#floatShadow2)">
                      <rect x="0" y="0" width="102" height="48" rx="10" fill="#ffffff" stroke="#e2e8f0" stroke-width="1.2"/>
                      <circle cx="18" cy="24" r="8.5" fill="#fff1f2"/>
                      <text x="18" y="27.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="8.5" font-weight="800" fill="#e11d48" text-anchor="middle">📹</text>
                      <text x="33" y="19" font-family="'Plus Jakarta Sans', sans-serif" font-size="8.5" font-weight="800" fill="#e11d48">Selfie Video</text>
                      <text x="33" y="32" font-family="'Inter', sans-serif" font-size="7" font-weight="600" fill="#64748b">100% Authentic</text>
                    </g>
                    
                    <!-- Right Floating Feature Pill -->
                    <g transform="translate(352, 195)" filter="url(#floatShadow2)">
                      <rect x="0" y="0" width="102" height="48" rx="10" fill="#ffffff" stroke="#cbd5e1" stroke-width="1.2"/>
                      <circle cx="18" cy="24" r="8.5" fill="#f0fdf4"/>
                      <text x="18" y="27.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="10" fill="#16a34a" text-anchor="middle">⚡</text>
                      <text x="33" y="19" font-family="'Plus Jakarta Sans', sans-serif" font-size="8.5" font-weight="800" fill="#16a34a">Zero App</text>
                      <text x="33" y="32" font-family="'Inter', sans-serif" font-size="7" font-weight="600" fill="#64748b">Direct Upload</text>
                    </g>
                  </svg>
                </div>
                
                <h3 class="slide-title">Instant Video Testimonials</h3>
                <p class="slide-desc">Customers can record and submit authentic selfie video reviews directly from their smartphone camera without installing any apps.</p>
                
                <div class="slide-features-row">
                  <span class="slide-pill"><i class="bi bi-camera-video"></i> Direct Camera Feed</span>
                  <span class="slide-pill"><i class="bi bi-cloud-arrow-up-fill"></i> Instant Cloud Save</span>
                  <span class="slide-pill"><i class="bi bi-patch-check-fill"></i> Verified Proof</span>
                </div>
              </div>
            </div>

            <!-- SLIDE 3: 1-Tap Google & Smart Acrylic Standees -->
            <div class="carousel-slide" data-index="2">
              <div class="slide-visual-card">
                <div class="slide-badge-top">
                  <i class="bi bi-qr-code-scan"></i> Smart QR Standees &amp; NFC
                </div>
                
                <div class="slide-graphic-container">
                  <svg class="slide-graphic-svg" viewBox="0 0 460 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="230" cy="220" rx="190" ry="14" fill="rgba(15,23,42,0.06)"/>
                    <rect x="90" y="210" width="280" height="16" rx="8" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1.5"/>
                    <rect x="120" y="202" width="220" height="10" rx="5" fill="#f1f5f9"/>
                    
                    <rect x="150" y="16" width="160" height="190" rx="14" fill="#ffffff" stroke="#cbd5e1" stroke-width="2"/>
                    <rect x="162" y="26" width="136" height="32" rx="8" fill="#e11d48"/>
                    <text x="230" y="46" font-family="'Plus Jakarta Sans', sans-serif" font-size="10.5" font-weight="800" fill="#ffffff" text-anchor="middle">★ REVIEW US ON GOOGLE</text>
                    
                    <rect x="175" y="68" width="110" height="110" rx="10" fill="#f8fafc" stroke="#e2e8f0" stroke-width="1.5"/>
                    <rect x="183" y="76" width="28" height="28" rx="4" fill="#0f172a"/>
                    <rect x="188" y="81" width="18" height="18" rx="2" fill="#ffffff"/>
                    <rect x="192" y="85" width="10" height="10" rx="1" fill="#e11d48"/>
                    
                    <rect x="249" y="76" width="28" height="28" rx="4" fill="#0f172a"/>
                    <rect x="254" y="81" width="18" height="18" rx="2" fill="#ffffff"/>
                    <rect x="258" y="85" width="10" height="10" rx="1" fill="#e11d48"/>
                    
                    <rect x="183" y="142" width="28" height="28" rx="4" fill="#0f172a"/>
                    <rect x="188" y="147" width="18" height="18" rx="2" fill="#ffffff"/>
                    <rect x="192" y="151" width="10" height="10" rx="1" fill="#e11d48"/>
                    
                    <circle cx="230" cy="88" r="4" fill="#0f172a"/>
                    <circle cx="230" cy="104" r="4.5" fill="#e11d48"/>
                    <circle cx="230" cy="122" r="4" fill="#0f172a"/>
                    <circle cx="230" cy="140" r="4" fill="#0f172a"/>
                    <rect x="220" y="152" width="8" height="8" rx="2" fill="#0f172a"/>
                    <rect x="248" y="116" width="10" height="10" rx="2" fill="#0f172a"/>
                    <rect x="262" y="132" width="10" height="10" rx="2" fill="#e11d48"/>
                    
                    <circle cx="230" cy="192" r="9" fill="#2563eb"/>
                    <path d="M225 190 C228 187, 232 187, 235 190" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                    
                    <g transform="translate(18, 70)">
                      <rect x="0" y="0" width="120" height="52" rx="12" fill="#ffffff" stroke="#e2e8f0" stroke-width="2"/>
                      <text x="60" y="22" font-family="'Plus Jakarta Sans', sans-serif" font-size="12" font-weight="800" fill="#e11d48" text-anchor="middle">5.0 ★★★★★</text>
                      <text x="60" y="38" font-family="'Inter', sans-serif" font-size="9" font-weight="600" fill="#64748b" text-anchor="middle">Google Verified</text>
                    </g>
                    
                    <g transform="translate(322, 95)">
                      <rect x="0" y="0" width="120" height="52" rx="12" fill="#ffffff" stroke="#cbd5e1" stroke-width="2"/>
                      <text x="60" y="22" font-family="'Plus Jakarta Sans', sans-serif" font-size="12" font-weight="800" fill="#16a34a" text-anchor="middle">⚡ 1-Tap Tap</text>
                      <text x="60" y="38" font-family="'Inter', sans-serif" font-size="9" font-weight="600" fill="#64748b" text-anchor="middle">NFC &amp; QR Stand</text>
                    </g>
                  </svg>
                </div>
                
                <h3 class="slide-title">1-Tap Google Reviews &amp; QR Stands</h3>
                <p class="slide-desc">Place custom-branded acrylic stands at billing counters. Customers tap with NFC or scan to post 5-star Google reviews in seconds.</p>
                
                <div class="slide-features-row">
                  <span class="slide-pill"><i class="bi bi-phone"></i> NFC 1-Tap</span>
                  <span class="slide-pill"><i class="bi bi-qr-code"></i> Standee QR Matrix</span>
                  <span class="slide-pill"><i class="bi bi-check-circle-fill"></i> Boost SEO</span>
                </div>
              </div>
            </div>

            <!-- SLIDE 4: Private Enquiry & Reputation Protection -->
            <div class="carousel-slide" data-index="3">
              <div class="slide-visual-card">
                <div class="slide-badge-top">
                  <i class="bi bi-shield-check"></i> Private Enquiry &amp; Protection
                </div>
                
                <div class="slide-graphic-container">
                  <svg class="slide-graphic-svg" viewBox="0 0 460 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="230" cy="46" r="32" fill="#ffffff" stroke="#e11d48" stroke-width="3"/>
                    <text x="230" y="54" font-family="'Plus Jakarta Sans', sans-serif" font-size="20" fill="#e11d48" text-anchor="middle">⭐</text>
                    
                    <path d="M200 62 C150 95, 110 120, 110 145" stroke="#16a34a" stroke-width="3" stroke-dasharray="5 5" fill="none"/>
                    <path d="M260 62 C310 95, 350 120, 350 145" stroke="#f59e0b" stroke-width="3" stroke-dasharray="5 5" fill="none"/>
                    
                    <g transform="translate(30, 145)">
                      <rect x="0" y="0" width="160" height="78" rx="12" fill="#f0fdf4" stroke="#86efac" stroke-width="2"/>
                      <rect x="12" y="10" width="26" height="26" rx="6" fill="#16a34a"/>
                      <text x="25" y="28" font-family="'Plus Jakarta Sans', sans-serif" font-size="13" font-weight="800" fill="#ffffff" text-anchor="middle">G</text>
                      <text x="46" y="27" font-family="'Plus Jakarta Sans', sans-serif" font-size="12" font-weight="800" fill="#15803d">4 - 5 Stars</text>
                      <text x="12" y="52" font-family="'Inter', sans-serif" font-size="10" font-weight="600" fill="#166534">→ Google Maps Public</text>
                      <text x="12" y="66" font-family="'Inter', sans-serif" font-size="9.5" fill="#15803d">Boost SEO &amp; Rankings</text>
                    </g>
                    
                    <g transform="translate(270, 145)">
                      <rect x="0" y="0" width="160" height="78" rx="12" fill="#fffbeb" stroke="#fde68a" stroke-width="2"/>
                      <rect x="12" y="10" width="26" height="26" rx="6" fill="#f59e0b"/>
                      <text x="25" y="28" font-family="'Plus Jakarta Sans', sans-serif" font-size="13" font-weight="800" fill="#ffffff" text-anchor="middle">💬</text>
                      <text x="46" y="27" font-family="'Plus Jakarta Sans', sans-serif" font-size="12" font-weight="800" fill="#b45309">Private Enquiry</text>
                      <text x="12" y="52" font-family="'Inter', sans-serif" font-size="10" font-weight="600" fill="#92400e">→ Internal Resolution</text>
                      <text x="12" y="66" font-family="'Inter', sans-serif" font-size="9.5" fill="#b45309">Protects Public Rating</text>
                    </g>
                  </svg>
                </div>
                
                <h3 class="slide-title">Private Feedback &amp; Enquiry Shield</h3>
                <p class="slide-desc">Unhappy customers submit private feedback straight to management, protecting your public ratings while resolving complaints immediately.</p>
                
                <div class="slide-features-row">
                  <span class="slide-pill"><i class="bi bi-chat-left-dots-fill"></i> Private Form</span>
                  <span class="slide-pill"><i class="bi bi-shield-lock-fill"></i> Zero Negative Impact</span>
                  <span class="slide-pill"><i class="bi bi-bell-fill"></i> Instant Owner Alert</span>
                </div>
              </div>
            </div>

            <!-- SLIDE 5: Real-Time Review & Scan Analytics -->
            <div class="carousel-slide" data-index="4">
              <div class="slide-visual-card">
                <div class="slide-badge-top">
                  <i class="bi bi-graph-up-arrow"></i> Real-Time Review Analytics
                </div>
                
                <div class="slide-graphic-container">
                  <svg class="slide-graphic-svg" viewBox="0 0 460 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="25" y="14" width="410" height="212" rx="14" fill="#ffffff" stroke="#e2e8f0" stroke-width="2"/>
                    <rect x="25" y="14" width="410" height="38" rx="14" fill="#f8fafc" stroke="#e2e8f0" stroke-width="1"/>
                    
                    <circle cx="45" cy="33" r="5" fill="#ef4444"/>
                    <circle cx="60" cy="33" r="5" fill="#f59e0b"/>
                    <circle cx="75" cy="33" r="5" fill="#10b981"/>
                    <text x="100" y="37" font-family="'Plus Jakarta Sans', sans-serif" font-size="11" font-weight="700" fill="#0f172a">AskReview Analytics Dashboard</text>
                    <text x="390" y="37" font-family="'Inter', sans-serif" font-size="9.5" font-weight="600" fill="#16a34a">● Live Tracking</text>
                    
                    <rect x="42" y="60" width="114" height="52" rx="8" fill="#f8fafc" stroke="#e2e8f0"/>
                    <text x="54" y="76" font-family="'Inter', sans-serif" font-size="8.5" font-weight="600" fill="#64748b">TOTAL SCANS</text>
                    <text x="54" y="98" font-family="'Plus Jakarta Sans', sans-serif" font-size="16" font-weight="800" fill="#0f172a">18,450</text>
                    <text x="120" y="98" font-family="'Inter', sans-serif" font-size="9.5" font-weight="700" fill="#16a34a">+24% ↑</text>
                    
                    <rect x="172" y="60" width="114" height="52" rx="8" fill="#eff6ff" stroke="#bfdbfe"/>
                    <text x="184" y="76" font-family="'Inter', sans-serif" font-size="8.5" font-weight="600" fill="#1e40af">5★ REVIEWS</text>
                    <text x="184" y="98" font-family="'Plus Jakarta Sans', sans-serif" font-size="16" font-weight="800" fill="#2563eb">4,920</text>
                    <text x="245" y="98" font-family="'Inter', sans-serif" font-size="9.5" font-weight="700" fill="#2563eb">98.2%</text>
                    
                    <rect x="302" y="60" width="114" height="52" rx="8" fill="#fdf2f8" stroke="#fbcfe8"/>
                    <text x="314" y="76" font-family="'Inter', sans-serif" font-size="8.5" font-weight="600" fill="#9d174d">VIDEOS COLLECTED</text>
                    <text x="314" y="98" font-family="'Plus Jakarta Sans', sans-serif" font-size="16" font-weight="800" fill="#e11d48">156 📹</text>
                    
                    <line x1="42" y1="195" x2="416" y2="195" stroke="#e2e8f0" stroke-width="1.5"/>
                    <text x="42" y="132" font-family="'Inter', sans-serif" font-size="9" font-weight="700" fill="#475569">Channel Distribution</text>
                    
                    <rect x="65" y="138" width="28" height="57" rx="4" fill="#4285f4"/>
                    <text x="79" y="208" font-family="'Inter', sans-serif" font-size="8" font-weight="700" fill="#4285f4" text-anchor="middle">Google</text>
                    
                    <rect x="135" y="150" width="28" height="45" rx="4" fill="#1877f2"/>
                    <text x="149" y="208" font-family="'Inter', sans-serif" font-size="8" font-weight="700" fill="#1877f2" text-anchor="middle">FB</text>
                    
                    <rect x="205" y="156" width="28" height="39" rx="4" fill="#e1306c"/>
                    <text x="219" y="208" font-family="'Inter', sans-serif" font-size="8" font-weight="700" fill="#e1306c" text-anchor="middle">Insta</text>
                    
                    <rect x="275" y="162" width="28" height="33" rx="4" fill="#ff0000"/>
                    <text x="289" y="208" font-family="'Inter', sans-serif" font-size="8" font-weight="700" fill="#ff0000" text-anchor="middle">YouTube</text>
                    
                    <rect x="345" y="142" width="28" height="53" rx="4" fill="#10b981"/>
                    <text x="359" y="208" font-family="'Inter', sans-serif" font-size="8" font-weight="700" fill="#10b981" text-anchor="middle">Videos</text>
                  </svg>
                </div>
                
                <h3 class="slide-title">Multi-Channel Performance Analytics</h3>
                <p class="slide-desc">Track QR scans, review conversions, customer feedback trends, and video testimonials in real-time from an intuitive business dashboard.</p>
                
                <div class="slide-features-row">
                  <span class="slide-pill"><i class="bi bi-speedometer2"></i> Live Tracking</span>
                  <span class="slide-pill"><i class="bi bi-bar-chart-line-fill"></i> Channel Breakdown</span>
                  <span class="slide-pill"><i class="bi bi-check2-circle"></i> 100% Transparent</span>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Carousel Navigation Controls -->
        <div class="carousel-nav-container">
          <div class="carousel-indicators-list" id="carouselIndicators">
            <button type="button" class="carousel-indicator-btn active" data-slide="0" aria-label="Slide 1"></button>
            <button type="button" class="carousel-indicator-btn" data-slide="1" aria-label="Slide 2"></button>
            <button type="button" class="carousel-indicator-btn" data-slide="2" aria-label="Slide 3"></button>
            <button type="button" class="carousel-indicator-btn" data-slide="3" aria-label="Slide 4"></button>
            <button type="button" class="carousel-indicator-btn" data-slide="4" aria-label="Slide 5"></button>
          </div>
          
          <div style="display: flex; gap: 8px;">
            <button type="button" class="carousel-arrow-btn" id="prevSlideBtn" aria-label="Previous Slide">
              <i class="bi bi-chevron-left"></i>
            </button>
            <button type="button" class="carousel-arrow-btn" id="nextSlideBtn" aria-label="Next Slide">
              <i class="bi bi-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Hero Footer Trust Badges -->
      <div class="hero-footer">
        <div class="hero-trust-item">
          <div class="trust-avatar-stack">
            <div class="trust-avatar" style="background:linear-gradient(135deg,#e11d48,#be123c);">AR</div>
            <div class="trust-avatar" style="background:linear-gradient(135deg,#2563eb,#1d4ed8);">BK</div>
            <div class="trust-avatar" style="background:linear-gradient(135deg,#16a34a,#15803d);">RD</div>
            <div class="trust-avatar" style="background:linear-gradient(135deg,#7c3aed,#6d28d9);">+k</div>
          </div>
          <div class="trust-text">
            Trusted by <strong>5,000+ businesses</strong>
          </div>
        </div>
        <div class="hero-trust-item">
          <div class="trust-rating-stars">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
          <span class="trust-text"><strong>4.9 / 5.0</strong> rating</span>
        </div>
      </div>

    </div>

    <!-- ====================================================================
         RIGHT PANEL: Confirm Password Form Card
         ==================================================================== -->
    <div class="auth-form-panel">
      <!-- Ambient Background Watermark Icons -->
      <div class="auth-bg-watermark wm-google"><i class="bi bi-google"></i></div>
      <div class="auth-bg-watermark wm-star"><i class="bi bi-star-fill"></i></div>
      <div class="auth-bg-watermark wm-heart"><i class="bi bi-chat-heart-fill"></i></div>
      <div class="auth-bg-watermark wm-shield"><i class="bi bi-shield-check"></i></div>
      <div class="auth-bg-watermark wm-camera"><i class="bi bi-camera-video-fill"></i></div>

      <!-- Floating Decorative Review Badges -->
      <div class="auth-floating-badge badge-top-right">
        <div class="badge-icon-box" style="background:#fffbeb;color:#f59e0b;">
          <i class="bi bi-star-fill"></i>
        </div>
        <div>
          <div class="badge-label">5.0 ★★★★★</div>
          <div class="badge-sub">Google Verified</div>
        </div>
      </div>

      <div class="auth-floating-badge badge-bottom-right">
        <div class="badge-icon-box" style="background:#eff6ff;color:#2563eb;">
          <i class="bi bi-lightning-charge-fill"></i>
        </div>
        <div>
          <div class="badge-label">Smart NFC &amp; QR</div>
          <div class="badge-sub">Instant Feedback</div>
        </div>
      </div>

      <div class="auth-form-container">
        
        <!-- Right Panel Brand Logo Header -->
        <div class="auth-brand-top">
          <a href="{{ url('/') }}" class="auth-brand-link">
            <img src="{{ asset('frontend/images/logo-brand.png') }}" alt="AskReview Logo" class="auth-brand-logo-img" />
          </a>
        </div>

        <!-- Form Header -->
        <div class="auth-header-block">
          <div class="auth-welcome-badge">
            <i class="bi bi-key-fill"></i>
            <span>Set New Password</span>
          </div>
          <h1 class="auth-title">Reset Password</h1>
          <p class="auth-subtitle">Enter the verification OTP sent to your registered number and create your new secure password.</p>
        </div>

        @if ($adminStatus == 'urlAvailable')
          <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 10px 14px; border-radius: 10px; font-size: 0.85rem; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="bi bi-whatsapp text-success" style="font-size: 1.1rem;"></i>
            <span>OTP has been sent to your registered WhatsApp / phone.</span>
          </div>

          <!-- Reset Password Form -->
          <form method="POST" action="{{ URL::to('confirmPassword') }}" id="confirmPasswordForm">
            @csrf
            <input type="hidden" name="adminKey" value="{{ $adminKey }}">

            <!-- OTP Input -->
            <div class="auth-form-group">
              <label for="otpInput" class="auth-label">
                <span>Verification OTP</span>
              </label>
              <div class="input-with-icon-wrapper">
                <span class="input-icon-prefix">
                  <i class="bi bi-shield-lock"></i>
                </span>
                <input 
                  type="number" 
                  id="otpInput" 
                  name="otp" 
                  class="auth-input-control" 
                  placeholder="5-digit code (e.g. 54321)" 
                  required 
                  autofocus
                />
              </div>
            </div>

            <!-- New Password Input -->
            <div class="auth-form-group">
              <label for="newPassword" class="auth-label">
                <span>New Password</span>
              </label>
              <div class="input-with-icon-wrapper">
                <span class="input-icon-prefix">
                  <i class="bi bi-lock"></i>
                </span>
                <input 
                  type="password" 
                  id="newPassword" 
                  name="password" 
                  class="auth-input-control has-suffix" 
                  placeholder="••••••••••••" 
                  required 
                />
                <button type="button" class="btn-password-toggle" onclick="togglePassVisibility('newPassword', 'eyeIcon1')" aria-label="Toggle password visibility">
                  <i class="bi bi-eye" id="eyeIcon1"></i>
                </button>
              </div>
            </div>

            <!-- Confirm Password Input -->
            <div class="auth-form-group">
              <label for="confirmPasswordInput" class="auth-label">
                <span>Confirm New Password</span>
              </label>
              <div class="input-with-icon-wrapper">
                <span class="input-icon-prefix">
                  <i class="bi bi-lock-fill"></i>
                </span>
                <input 
                  type="password" 
                  id="confirmPasswordInput" 
                  name="confirmPassword" 
                  class="auth-input-control has-suffix" 
                  placeholder="••••••••••••" 
                  required 
                />
                <button type="button" class="btn-password-toggle" onclick="togglePassVisibility('confirmPasswordInput', 'eyeIcon2')" aria-label="Toggle password visibility">
                  <i class="bi bi-eye" id="eyeIcon2"></i>
                </button>
              </div>
              <div id="passMatchMsg" style="font-size: 0.75rem; margin-top: 4px; display: none;"></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary-auth" id="submitPassBtn" style="margin-top: 10px;">
              <span>Update Password &amp; Login</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </form>

        @else
          <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 14px 16px; border-radius: 10px; font-size: 0.875rem; margin-bottom: 20px;">
            <div style="font-weight: 700; margin-bottom: 4px;"><i class="bi bi-exclamation-triangle-fill"></i> Reset Link Expired or Invalid</div>
            <span>This password reset link is invalid or has already been used. Please request a new OTP.</span>
          </div>

          <a href="{{ URL::to('forgotPassword') }}" class="btn-primary-auth" style="text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
            <span>Request New OTP</span>
            <i class="bi bi-arrow-clockwise"></i>
          </a>
        @endif

        <!-- Back to Login Navigation -->
        <div class="auth-switch-prompt" style="margin-top: 22px;">
          <a href="{{ URL::to('forgotPassword') }}" style="font-weight: 600; color: #64748b; margin-right: 8px;">
            <i class="bi bi-arrow-left"></i> Resend OTP
          </a>
          •
          <a href="{{ URL::to('login') }}" style="font-weight: 700; color: var(--brand-red); margin-left: 8px;">
            Back to Login
          </a>
        </div>

        <!-- Security & Trust Footer -->
        <div class="auth-security-badge" style="margin-top: 18px;">
          <i class="bi bi-shield-fill-check"></i>
          <span>256-Bit SSL Encrypted • ISO 27001 Certified</span>
        </div>

      </div>
    </div>

      </div>
    </div>

  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script>
    function togglePassVisibility(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      }
    }

    // Password matcher check
    const p1 = document.getElementById('newPassword');
    const p2 = document.getElementById('confirmPasswordInput');
    const msg = document.getElementById('passMatchMsg');

    if (p1 && p2 && msg) {
      function checkMatch() {
        if (p2.value.length === 0) {
          msg.style.display = 'none';
          return;
        }
        msg.style.display = 'block';
        if (p1.value === p2.value) {
          msg.style.color = '#16a34a';
          msg.innerHTML = '<i class="bi bi-check-circle-fill"></i> Passwords match';
        } else {
          msg.style.color = '#dc2626';
          msg.innerHTML = '<i class="bi bi-x-circle-fill"></i> Passwords do not match';
        }
      }
      p1.addEventListener('input', checkMatch);
      p2.addEventListener('input', checkMatch);
    }

    // Toastr Notification configuration
    toastr.options = {
      closeButton: true,
      progressBar: true,
      positionClass: "toast-top-right",
      timeOut: 4500
    };

    @if(Session::has('messege'))
      var type = "{{ Session::get('alert-type', 'info') }}";
      switch(type) {
        case 'info':
          toastr.info("{{ Session::get('messege') }}");
          break;
        case 'success':
          toastr.success("{{ Session::get('messege') }}");
          break;
        case 'warning':
        case 'worning':
          toastr.warning("{{ Session::get('messege') }}");
          break;
        case 'error':
          toastr.error("{{ Session::get('messege') }}");
          break;
      }
    @endif

    // 5-Slide QR Code Carousel Functionality
    (function initQrCarousel() {
      const slides = document.querySelectorAll('.carousel-slide');
      const indicators = document.querySelectorAll('.carousel-indicator-btn');
      const slidesContainer = document.getElementById('carouselSlides');
      const prevBtn = document.getElementById('prevSlideBtn');
      const nextBtn = document.getElementById('nextSlideBtn');
      
      if (!slides.length) return;
      
      let currentIndex = 0;
      let autoPlayTimer = null;
      const totalSlides = slides.length;
      const intervalDuration = 4800;

      function goToSlide(index) {
        if (index < 0) index = totalSlides - 1;
        if (index >= totalSlides) index = 0;
        
        currentIndex = index;
        if (slidesContainer) {
          slidesContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
        }
        
        slides.forEach((slide, i) => {
          slide.classList.toggle('active', i === currentIndex);
        });
        
        indicators.forEach((btn, i) => {
          btn.classList.toggle('active', i === currentIndex);
        });
      }

      function nextSlide() {
        goToSlide(currentIndex + 1);
      }

      function prevSlide() {
        goToSlide(currentIndex - 1);
      }

      function startAutoPlay() {
        stopAutoPlay();
        autoPlayTimer = setInterval(nextSlide, intervalDuration);
      }

      function stopAutoPlay() {
        if (autoPlayTimer) {
          clearInterval(autoPlayTimer);
          autoPlayTimer = null;
        }
      }

      indicators.forEach((indicator) => {
        indicator.addEventListener('click', () => {
          const slideIdx = parseInt(indicator.getAttribute('data-slide'), 10);
          goToSlide(slideIdx);
          startAutoPlay();
        });
      });

      if (prevBtn) {
        prevBtn.addEventListener('click', () => {
          prevSlide();
          startAutoPlay();
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', () => {
          nextSlide();
          startAutoPlay();
        });
      }

      const carouselEl = document.getElementById('authQrCarousel');
      if (carouselEl) {
        carouselEl.addEventListener('mouseenter', stopAutoPlay);
        carouselEl.addEventListener('mouseleave', startAutoPlay);
      }

      // Slide 1: Review Hub Row Click & Hover Interactions
      const hubRows = document.querySelectorAll('.hub-review-row');
      const hubToast = document.getElementById('hubToastMessage');
      const hubToastText = document.getElementById('hubToastText');
      let toastHideTimeout = null;

      hubRows.forEach((row) => {
        row.addEventListener('click', (e) => {
          e.stopPropagation();
          const platform = row.getAttribute('data-platform') || 'Platform';
          
          // Toggle active styling
          hubRows.forEach(r => r.classList.remove('active'));
          row.classList.add('active');

          // Trigger toast message inside phone
          if (hubToast && hubToastText) {
            clearTimeout(toastHideTimeout);
            if (platform === 'Video Testimonial') {
              hubToastText.textContent = 'Opening Video Studio...';
            } else if (platform === 'App Install') {
              hubToastText.textContent = 'PWA Saved to Home Screen!';
            } else {
              hubToastText.textContent = `✓ ${platform} Form Selected`;
            }
            hubToast.classList.add('hub-toast-show');
            
            toastHideTimeout = setTimeout(() => {
              hubToast.classList.remove('hub-toast-show');
            }, 2400);
          }

          // If clicking Video Testimonial, seamlessly transition to Slide 2!
          if (platform === 'Video Testimonial') {
            setTimeout(() => {
              goToSlide(1);
            }, 550);
          }
        });
      });

      // Slide 2: Mobile Live Video Recording Interactions
      let isRecording = true;
      let recordSeconds = 18;
      let recordInterval = null;
      let isFlipped = false;
      let isMicMuted = false;

      const liveTimerText = document.getElementById('liveTimerText');
      const liveRecLabel = document.getElementById('liveRecLabel');
      const recIndicatorDot = document.getElementById('recIndicatorDot');
      const recAuraCircle = document.getElementById('recAuraCircle');
      const recCenterShape = document.getElementById('recCenterShape');
      const soundwaveContainer = document.getElementById('soundwaveContainer');
      const cameraRecordBtn = document.getElementById('cameraRecordBtn');
      const flipCameraBtn = document.getElementById('flipCameraBtn');
      const cameraUserFeed = document.getElementById('cameraUserFeed');
      const cameraFlashOverlay = document.getElementById('cameraFlashOverlay');
      const micToggleBtn = document.getElementById('micToggleBtn');
      const micIconBody = document.getElementById('micIconBody');
      const micIconArc = document.getElementById('micIconArc');
      const micIconStem = document.getElementById('micIconStem');

      function formatTime(totalSec) {
        const m = Math.floor(totalSec / 60).toString().padStart(2, '0');
        const s = (totalSec % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
      }

      function startRecordingTimer() {
        if (recordInterval) clearInterval(recordInterval);
        recordInterval = setInterval(() => {
          if (isRecording) {
            recordSeconds++;
            if (liveTimerText) liveTimerText.textContent = formatTime(recordSeconds);
          }
        }, 1000);
      }

      startRecordingTimer();

      // Record / Pause Toggle Button
      if (cameraRecordBtn) {
        cameraRecordBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          isRecording = !isRecording;

          if (isRecording) {
            // Resumed
            if (liveRecLabel) {
              liveRecLabel.textContent = 'REC';
              liveRecLabel.setAttribute('fill', '#ef4444');
            }
            if (recIndicatorDot) {
              recIndicatorDot.setAttribute('fill', '#ef4444');
              recIndicatorDot.classList.add('rec-dot-animated');
            }
            if (recAuraCircle) recAuraCircle.style.display = 'block';
            if (recCenterShape) {
              recCenterShape.setAttribute('rx', '9');
              recCenterShape.setAttribute('width', '18');
              recCenterShape.setAttribute('height', '18');
              recCenterShape.setAttribute('x', '-9');
              recCenterShape.setAttribute('y', '-9');
            }
            if (!isMicMuted && soundwaveContainer) {
              soundwaveContainer.classList.remove('soundwaves-paused');
            }
          } else {
            // Paused
            if (liveRecLabel) {
              liveRecLabel.textContent = 'PAUSED';
              liveRecLabel.setAttribute('fill', '#f59e0b');
            }
            if (recIndicatorDot) {
              recIndicatorDot.setAttribute('fill', '#f59e0b');
              recIndicatorDot.classList.remove('rec-dot-animated');
            }
            if (recAuraCircle) recAuraCircle.style.display = 'none';
            if (recCenterShape) {
              recCenterShape.setAttribute('rx', '2.5');
              recCenterShape.setAttribute('width', '14');
              recCenterShape.setAttribute('height', '14');
              recCenterShape.setAttribute('x', '-7');
              recCenterShape.setAttribute('y', '-7');
            }
            if (soundwaveContainer) {
              soundwaveContainer.classList.add('soundwaves-paused');
            }
          }
        });
      }

      // Flip Camera Button
      if (flipCameraBtn && cameraUserFeed) {
        flipCameraBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          isFlipped = !isFlipped;
          
          // Flash effect
          if (cameraFlashOverlay) {
            cameraFlashOverlay.classList.remove('camera-flash-active');
            void cameraFlashOverlay.offsetWidth;
            cameraFlashOverlay.classList.add('camera-flash-active');
          }

          if (isFlipped) {
            cameraUserFeed.style.transform = 'translate(160px, 92px) scaleX(-1)';
          } else {
            cameraUserFeed.style.transform = 'translate(160px, 92px) scaleX(1)';
          }
        });
      }

      // Mic Toggle Button
      if (micToggleBtn) {
        micToggleBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          isMicMuted = !isMicMuted;
          const color = isMicMuted ? '#ef4444' : '#22c55e';
          if (micIconBody) micIconBody.setAttribute('fill', color);
          if (micIconArc) micIconArc.setAttribute('stroke', color);
          if (micIconStem) micIconStem.setAttribute('stroke', color);
          
          if (soundwaveContainer) {
            if (isMicMuted || !isRecording) {
              soundwaveContainer.classList.add('soundwaves-paused');
            } else {
              soundwaveContainer.classList.remove('soundwaves-paused');
            }
          }
        });
      }

      startAutoPlay();
    })();
  </script>
</body>
</html>