<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Forgot Password | AskReview - Google Review &amp; Multi-Channel Feedback Platform</title>
  <meta name="description" content="Reset your AskReview account password. Enter your registered email to receive a verification OTP." />
  
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
      
      <!-- Top Brand Header (Pill Badge Only) -->
      <div class="hero-header">
        <div class="hero-badge-pill">
          <span class="pulse-dot"></span>
          <span>Account Security &amp; Recovery</span>
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
                  <!-- High-Fidelity Review Hub Showcase Matching Actual Client Screen -->
                  <svg class="slide-graphic-svg" viewBox="0 0 460 276" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                      <linearGradient id="instaGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#833ab4"/>
                        <stop offset="50%" stop-color="#fd1d1d"/>
                        <stop offset="100%" stop-color="#fcb045"/>
                      </linearGradient>
                      <filter id="floatShadow" x="-10%" y="-10%" width="125%" height="125%">
                        <feDropShadow dx="0" dy="4" stdDeviation="5" flood-color="rgba(15,23,42,0.06)"/>
                      </filter>
                      <filter id="cardShadow" x="-10%" y="-10%" width="125%" height="125%">
                        <feDropShadow dx="0" dy="6" stdDeviation="8" flood-color="rgba(15,23,42,0.08)"/>
                      </filter>
                    </defs>

                    <!-- Desk Base Shadow -->
                    <ellipse cx="230" cy="270" rx="175" ry="6" fill="rgba(15,23,42,0.05)"/>
                    
                    <!-- Main Smartphone Review Hub Card (Centered) -->
                    <rect x="114" y="6" width="232" height="264" rx="20" fill="#ffffff" stroke="#e2e8f0" stroke-width="1.5" filter="url(#cardShadow)"/>
                    
                    <!-- Top Navigation: Back Button & Agency Header -->
                    <g transform="translate(122, 12)">
                      <circle cx="9" cy="9" r="8" fill="#f8fafc" stroke="#e2e8f0" stroke-width="0.8"/>
                      <path d="M10.5 6.5 L7.5 9 L10.5 11.5" stroke="#475569" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    
                    <!-- Business Logo Header Card (Center Top) -->
                    <g transform="translate(204, 10)">
                      <rect x="0" y="0" width="52" height="23" rx="6" fill="#ffffff" stroke="#e2e8f0" stroke-width="0.8"/>
                      <circle cx="11" cy="11.5" r="6" fill="#eff6ff"/>
                      <text x="11" y="14" font-family="'Plus Jakarta Sans', sans-serif" font-size="7" font-weight="900" fill="#2563eb" text-anchor="middle">R</text>
                      <text x="31" y="10" font-family="'Plus Jakarta Sans', sans-serif" font-size="4.8" font-weight="800" fill="#0f172a" text-anchor="middle">AGENCY</text>
                      <text x="31" y="15.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="3.2" font-weight="600" fill="#2563eb" text-anchor="middle">TRUE VALUE</text>
                    </g>

                    <!-- 5 Glowing Rating Stars -->
                    <g transform="translate(187, 38)">
                      <polygon points="4.5,0 5.8,3 9,3.5 6.7,5.6 7.3,8.7 4.5,7.2 1.7,8.7 2.3,5.6 0,3.5 3.2,3" fill="#f59e0b"/>
                      <polygon points="4.5,0 5.8,3 9,3.5 6.7,5.6 7.3,8.7 4.5,7.2 1.7,8.7 2.3,5.6 0,3.5 3.2,3" fill="#f59e0b" transform="translate(18, 0)"/>
                      <polygon points="4.5,0 5.8,3 9,3.5 6.7,5.6 7.3,8.7 4.5,7.2 1.7,8.7 2.3,5.6 0,3.5 3.2,3" fill="#f59e0b" transform="translate(36, 0)"/>
                      <polygon points="4.5,0 5.8,3 9,3.5 6.7,5.6 7.3,8.7 4.5,7.2 1.7,8.7 2.3,5.6 0,3.5 3.2,3" fill="#f59e0b" transform="translate(54, 0)"/>
                      <polygon points="4.5,0 5.8,3 9,3.5 6.7,5.6 7.3,8.7 4.5,7.2 1.7,8.7 2.3,5.6 0,3.5 3.2,3" fill="#f59e0b" transform="translate(72, 0)"/>
                    </g>

                    <!-- Friendly Header -->
                    <text x="230" y="56" font-family="'Plus Jakarta Sans', sans-serif" font-size="10.5" font-weight="800" fill="#0f172a" text-anchor="middle">Thank You!</text>
                    <text x="230" y="65" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#64748b" text-anchor="middle">Select your preferred platform below to leave us a quick review.</text>

                    <!-- 1. GOOGLE REVIEW CARD -->
                    <g transform="translate(122, 72)">
                      <rect x="0" y="0" width="216" height="23" rx="7" fill="#ffffff" stroke="#e2e8f0" stroke-width="1"/>
                      <circle cx="12" cy="11.5" r="7.5" fill="#f8fafc" stroke="#f1f5f9"/>
                      <path d="M14.5 11.5 H12 V13 H13.6 C13.3 13.8 12.6 14.3 11.7 14.3 C10.4 14.3 9.4 13.2 9.4 11.8 C9.4 10.5 10.4 9.4 11.7 9.4 C12.3 9.4 12.9 9.6 13.3 10 L14.4 8.9 C13.7 8.2 12.7 7.8 11.7 7.8 C9.5 7.8 7.7 9.6 7.7 11.8 C7.7 14 9.5 15.8 11.7 15.8 C14 15.8 15.5 14.2 15.5 11.9 C15.5 11.6 15.4 11.3 15.4 11.1 L14.5 11.5 Z" fill="#4285F4"/>
                      <text x="26" y="9.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Google</text>
                      <text x="26" y="16.5" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#64748b">Pick pre-written review &amp; paste</text>
                      <circle cx="204" cy="11.5" r="5" fill="#f8fafc"/>
                      <path d="M203 9.5 L205.5 11.5 L203 13.5" stroke="#94a3b8" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 2. FACEBOOK REVIEW CARD -->
                    <g transform="translate(122, 98)">
                      <rect x="0" y="0" width="216" height="23" rx="7" fill="#ffffff" stroke="#e2e8f0" stroke-width="1"/>
                      <circle cx="12" cy="11.5" r="7.5" fill="#1877f2"/>
                      <text x="12" y="14.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="9" font-weight="800" fill="#ffffff" text-anchor="middle">f</text>
                      <text x="26" y="9.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Facebook</text>
                      <text x="26" y="16.5" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#64748b">Review us on Facebook</text>
                      <circle cx="204" cy="11.5" r="5" fill="#f8fafc"/>
                      <path d="M203 9.5 L205.5 11.5 L203 13.5" stroke="#94a3b8" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 3. INSTAGRAM REVIEW CARD -->
                    <g transform="translate(122, 124)">
                      <rect x="0" y="0" width="216" height="23" rx="7" fill="#ffffff" stroke="#e2e8f0" stroke-width="1"/>
                      <circle cx="12" cy="11.5" r="7.5" fill="url(#instaGradient)"/>
                      <rect x="7.5" y="7.5" width="9" height="8" rx="2.2" fill="none" stroke="#ffffff" stroke-width="0.9"/>
                      <circle cx="12" cy="11.5" r="2.2" fill="none" stroke="#ffffff" stroke-width="0.8"/>
                      <circle cx="14.5" cy="9.2" r="0.5" fill="#ffffff"/>
                      <text x="26" y="9.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Instagram</text>
                      <text x="26" y="16.5" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#64748b">Review us on Instagram</text>
                      <circle cx="204" cy="11.5" r="5" fill="#f8fafc"/>
                      <path d="M203 9.5 L205.5 11.5 L203 13.5" stroke="#94a3b8" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 4. YOUTUBE REVIEW CARD -->
                    <g transform="translate(122, 150)">
                      <rect x="0" y="0" width="216" height="23" rx="7" fill="#ffffff" stroke="#e2e8f0" stroke-width="1"/>
                      <circle cx="12" cy="11.5" r="7.5" fill="#ff0000"/>
                      <polygon points="10.5,8.5 15,11.5 10.5,14.5" fill="#ffffff"/>
                      <text x="26" y="9.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Youtube</text>
                      <text x="26" y="16.5" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#64748b">Review us on Youtube</text>
                      <circle cx="204" cy="11.5" r="5" fill="#f8fafc"/>
                      <path d="M203 9.5 L205.5 11.5 L203 13.5" stroke="#94a3b8" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 5. VIDEO TESTIMONIAL CARD (HIGHLIGHTED IN SOFT PINK/ROSE) -->
                    <g transform="translate(122, 176)">
                      <rect x="0" y="0" width="216" height="23" rx="7" fill="#fff1f2" stroke="#fecdd3" stroke-width="1.2"/>
                      <circle cx="12" cy="11.5" r="7.5" fill="#ffe4e6"/>
                      <rect x="8.5" y="8" width="5.5" height="7" rx="1.2" fill="#e11d48"/>
                      <polygon points="14,10 17,8.5 17,14.5 14,13" fill="#e11d48"/>
                      <text x="26" y="9.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Video Testimonial</text>
                      <circle cx="95" cy="7" r="2.2" fill="#e11d48"/>
                      <text x="26" y="16.5" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#e11d48">Record a 60–sec video shoutout</text>
                      <circle cx="204" cy="11.5" r="5" fill="#fff1f2"/>
                      <path d="M203 9.5 L205.5 11.5 L203 13.5" stroke="#e11d48" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 6. PRIVATE ENQUIRY CARD (HIGHLIGHTED IN SOFT AMBER) -->
                    <g transform="translate(122, 202)">
                      <rect x="0" y="0" width="216" height="23" rx="7" fill="#fffdf0" stroke="#fde68a" stroke-width="1.2"/>
                      <circle cx="12" cy="11.5" r="7.5" fill="#fef3c7"/>
                      <rect x="8.5" y="8" width="7" height="5.5" rx="1.5" fill="#d97706"/>
                      <polygon points="10,13.5 12,13.5 9,15.5" fill="#d97706"/>
                      <text x="26" y="9.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a">Private Enquiry</text>
                      <text x="26" y="16.5" font-family="'Inter', sans-serif" font-size="5" font-weight="500" fill="#b45309">Send a direct private message to us</text>
                      <circle cx="204" cy="11.5" r="5" fill="#fffdf0"/>
                      <path d="M203 9.5 L205.5 11.5 L203 13.5" stroke="#d97706" stroke-width="1.2" stroke-linecap="round"/>
                    </g>

                    <!-- 7. INSTALL APP PILL BUTTON -->
                    <g transform="translate(166, 230)">
                      <rect x="0" y="0" width="128" height="15" rx="7.5" fill="#ffffff" stroke="#bfdbfe" stroke-width="0.9"/>
                      <path d="M8 4 H10.5 C10.8 4 11 4.2 11 4.5 V10.5 C11 10.8 10.8 11 10.5 11 H8 C7.7 11 7.5 10.8 7.5 10.5 V4.5 C7.5 4.2 7.7 4 8 4 Z" fill="none" stroke="#2563eb" stroke-width="0.8"/>
                      <circle cx="9.25" cy="9.8" r="0.4" fill="#2563eb"/>
                      <text x="68" y="10" font-family="'Plus Jakarta Sans', sans-serif" font-size="5.5" font-weight="700" fill="#2563eb" text-anchor="middle">Install App on Home Screen</text>
                    </g>

                    <!-- Left Floating Feature Pill -->
                    <g transform="translate(6, 100)" filter="url(#floatShadow)">
                      <rect x="0" y="0" width="98" height="46" rx="10" fill="#ffffff" stroke="#e2e8f0" stroke-width="1.2"/>
                      <circle cx="18" cy="23" r="8" fill="#fff1f2"/>
                      <text x="18" y="26" font-family="'Plus Jakarta Sans', sans-serif" font-size="8.5" font-weight="800" fill="#e11d48" text-anchor="middle">QR</text>
                      <text x="32" y="18" font-family="'Plus Jakarta Sans', sans-serif" font-size="8.5" font-weight="800" fill="#e11d48">1 QR Stand</text>
                      <text x="32" y="30" font-family="'Inter', sans-serif" font-size="7" font-weight="600" fill="#64748b">All Review Links</text>
                    </g>
                    
                    <!-- Right Floating Feature Pill -->
                    <g transform="translate(356, 114)" filter="url(#floatShadow)">
                      <rect x="0" y="0" width="98" height="46" rx="10" fill="#ffffff" stroke="#cbd5e1" stroke-width="1.2"/>
                      <circle cx="18" cy="23" r="8" fill="#f0fdf4"/>
                      <text x="18" y="26.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="10" fill="#16a34a" text-anchor="middle">⚡</text>
                      <text x="32" y="18" font-family="'Plus Jakarta Sans', sans-serif" font-size="8.5" font-weight="800" fill="#16a34a">Instant Tap</text>
                      <text x="32" y="30" font-family="'Inter', sans-serif" font-size="7" font-weight="600" fill="#64748b">Google &amp; Socials</text>
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

            <!-- SLIDE 2: Video Testimonials -->
            <div class="carousel-slide" data-index="1">
              <div class="slide-visual-card">
                <div class="slide-badge-top">
                  <i class="bi bi-camera-video-fill"></i> Video Testimonials
                </div>
                
                <div class="slide-graphic-container">
                  <svg class="slide-graphic-svg" viewBox="0 0 460 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="230" cy="225" rx="170" ry="12" fill="rgba(15,23,42,0.06)"/>
                    <rect x="135" y="12" width="190" height="212" rx="18" fill="#0f172a" stroke="#334155" stroke-width="2.5"/>
                    <rect x="190" y="16" width="80" height="5" rx="2.5" fill="#475569"/>
                    <rect x="143" y="28" width="174" height="152" rx="8" fill="#1e293b"/>
                    
                    <circle cx="230" cy="82" r="26" fill="#3b82f6"/>
                    <path d="M200 135 C200 110, 260 110, 260 135 Z" fill="#3b82f6"/>
                    
                    <rect x="152" y="38" width="56" height="16" rx="8" fill="rgba(0,0,0,0.6)"/>
                    <circle cx="160" cy="46" r="4" fill="#ef4444"/>
                    <text x="180" y="49" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="800" fill="#ffffff">REC 0:18</text>
                    
                    <g transform="translate(170, 115)">
                      <rect x="0" y="0" width="120" height="26" rx="6" fill="rgba(0,0,0,0.75)" stroke="rgba(255,255,255,0.2)"/>
                      <text x="60" y="17" font-family="'Plus Jakarta Sans', sans-serif" font-size="10.5" font-weight="800" fill="#f59e0b" text-anchor="middle">★★★★★</text>
                    </g>
                    
                    <circle cx="230" cy="198" r="11" fill="#ffffff"/>
                    <circle cx="230" cy="198" r="8" fill="#ef4444"/>
                    
                    <g transform="translate(20, 90)">
                      <rect x="0" y="0" width="100" height="50" rx="10" fill="#ffffff" stroke="#e2e8f0" stroke-width="1.5"/>
                      <text x="50" y="20" font-family="'Plus Jakarta Sans', sans-serif" font-size="10" font-weight="800" fill="#e11d48" text-anchor="middle">📹 Selfie Video</text>
                      <text x="50" y="36" font-family="'Inter', sans-serif" font-size="8" font-weight="600" fill="#64748b" text-anchor="middle">100% Authentic</text>
                    </g>
                    
                    <g transform="translate(340, 105)">
                      <rect x="0" y="0" width="100" height="50" rx="10" fill="#ffffff" stroke="#cbd5e1" stroke-width="1.5"/>
                      <text x="50" y="20" font-family="'Plus Jakarta Sans', sans-serif" font-size="10" font-weight="800" fill="#16a34a" text-anchor="middle">⚡ Zero App</text>
                      <text x="50" y="36" font-family="'Inter', sans-serif" font-size="8" font-weight="600" fill="#64748b" text-anchor="middle">Direct Upload</text>
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
      <div class="hero-footer-trust">
        <div class="trust-badge-item">
          <i class="bi bi-shield-check text-success"></i>
          <span>Secure OTP Verification</span>
        </div>
        <div class="trust-badge-item">
          <i class="bi bi-stars text-primary"></i>
          <span>50,000+ Reviews Generated</span>
        </div>
        <div class="trust-badge-item">
          <i class="bi bi-award-fill text-danger"></i>
          <span>Instant Password Recovery</span>
        </div>
      </div>

    </div>

    <!-- ====================================================================
         RIGHT PANEL: Forgot Password Form Card
         ==================================================================== -->
    <div class="auth-form-panel">
      <div class="auth-form-container">
        
        <!-- Right Panel Brand Logo Header -->
        <div class="auth-brand-top">
          <a href="{{ url('/') }}" class="auth-brand-link">
            <img src="{{ asset('frontend/images/logo.jpg') }}" alt="AskReview Logo" class="auth-brand-logo-img" />
          </a>
        </div>

        <!-- Form Header -->
        <div class="auth-header-block">
          <div class="auth-welcome-badge">
            <i class="bi bi-shield-lock-fill"></i>
            <span>Password Recovery</span>
          </div>
          <h1 class="auth-title">Forgot Password?</h1>
          <p class="auth-subtitle">Enter your registered email address and we'll send a 5-digit verification OTP to reset your password.</p>
        </div>

        <!-- Alert messages if any -->
        @if (session('error'))
          <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 10px 14px; border-radius: 10px; font-size: 0.85rem; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
          </div>
        @endif

        @if (session('success'))
          <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; padding: 10px 14px; border-radius: 10px; font-size: 0.85rem; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        <!-- Forgot Password Form -->
        <form method="POST" action="{{ URL::to('adminUserIdCheck') }}" id="forgotPasswordForm">
          @csrf
          
          <!-- Email Input Group -->
          <div class="auth-form-group">
            <label for="emailInput" class="auth-label">
              <span>Registered Email Address</span>
            </label>
            <div class="input-with-icon-wrapper">
              <span class="input-icon-prefix">
                <i class="bi bi-envelope"></i>
              </span>
              <input 
                type="email" 
                id="emailInput" 
                name="email" 
                class="auth-input-control" 
                placeholder="name@business.com" 
                value="{{ old('email') }}"
                required 
                autocomplete="email" 
                autofocus
              />
            </div>
            <span style="font-size: 0.74rem; color: #64748b; margin-top: 5px; display: block;">
              <i class="bi bi-info-circle"></i> OTP will be sent to your registered WhatsApp / Phone.
            </span>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn-primary-auth" id="submitBtn" style="margin-top: 14px;">
            <span>Send Verification OTP</span>
            <i class="bi bi-arrow-right"></i>
          </button>
        </form>

        <!-- Back to Login Navigation -->
        <div class="auth-switch-prompt" style="margin-top: 22px;">
          Remembered your password? 
          <a href="{{ URL::to('login') }}" style="font-weight: 700; color: var(--brand-red);">
            Sign In
          </a>
        </div>

        <!-- Security & Trust Footer -->
        <div class="auth-security-badge" style="margin-top: 18px;">
          <i class="bi bi-shield-fill-check"></i>
          <span>256-Bit SSL Encrypted • Instant Recovery</span>
        </div>

      </div>
    </div>

  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script>
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

    // Carousel Controller (5 Slides)
    (function initCarousel() {
      const slides = document.querySelectorAll('.carousel-slide');
      const indicators = document.querySelectorAll('.carousel-indicator-btn');
      const prevBtn = document.getElementById('prevSlideBtn');
      const nextBtn = document.getElementById('nextSlideBtn');
      let currentIdx = 0;
      let autoPlayTimer = null;
      const totalSlides = slides.length;

      function goToSlide(idx) {
        if (idx < 0) idx = totalSlides - 1;
        if (idx >= totalSlides) idx = 0;
        
        slides.forEach(s => s.classList.remove('active'));
        indicators.forEach(ind => ind.classList.remove('active'));

        slides[idx].classList.add('active');
        if (indicators[idx]) {
          indicators[idx].classList.add('active');
        }
        currentIdx = idx;
      }

      function startAutoPlay() {
        stopAutoPlay();
        autoPlayTimer = setInterval(() => {
          goToSlide(currentIdx + 1);
        }, 5000);
      }

      function stopAutoPlay() {
        if (autoPlayTimer) clearInterval(autoPlayTimer);
      }

      if (prevBtn) {
        prevBtn.addEventListener('click', () => {
          goToSlide(currentIdx - 1);
          startAutoPlay();
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', () => {
          goToSlide(currentIdx + 1);
          startAutoPlay();
        });
      }

      indicators.forEach((ind, i) => {
        ind.addEventListener('click', () => {
          goToSlide(i);
          startAutoPlay();
        });
      });

      const carouselEl = document.getElementById('authQrCarousel');
      if (carouselEl) {
        carouselEl.addEventListener('mouseenter', stopAutoPlay);
        carouselEl.addEventListener('mouseleave', startAutoPlay);
      }

      startAutoPlay();
    })();
  </script>
</body>
</html>