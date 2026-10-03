<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Sign Up | AskReview - Google Review &amp; QR Code Management Platform</title>
  <meta name="description" content="Start your 7-day free trial on AskReview. Collect more 5-star Google reviews with smart QR standees and review automation." />
  
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
         LEFT PANEL: 5-Slide QR Hardware & Software Showcase (Big Images)
         ==================================================================== -->
    <div class="auth-hero-panel">
      
      <!-- Top Brand Header (Pill Badge Only) -->
      <div class="hero-header">
        <div class="hero-badge-pill">
          <span class="pulse-dot"></span>
          <span>7-Day Free Trial Available</span>
        </div>
      </div>

      <!-- Centered 5-Slide QR Carousel (Big Images) -->
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
                  <!-- Phone Mockup with the actual AskReview Buttons: Google, Facebook, Instagram, YouTube, Video Testimonial, Private Enquiry -->
                  <svg class="slide-graphic-svg" viewBox="0 0 460 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Desk Shadow & Phone Device Base -->
                    <ellipse cx="230" cy="225" rx="170" ry="12" fill="rgba(15,23,42,0.06)"/>
                    
                    <!-- Phone Frame (Centered) -->
                    <rect x="120" y="10" width="220" height="216" rx="20" fill="#ffffff" stroke="#cbd5e1" stroke-width="2.5"/>
                    <rect x="185" y="14" width="90" height="5" rx="2.5" fill="#e2e8f0"/>
                    
                    <!-- Mini Agency Logo Header inside phone -->
                    <circle cx="230" cy="34" r="12" fill="#eff6ff" stroke="#bfdbfe"/>
                    <text x="230" y="38" font-family="'Plus Jakarta Sans', sans-serif" font-size="10" font-weight="800" fill="#2563eb" text-anchor="middle">R</text>
                    <text x="230" y="52" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#0f172a" text-anchor="middle">YOUR BUSINESS HUB</text>
                    
                    <!-- 1. GOOGLE BUTTON -->
                    <g transform="translate(136, 58)">
                      <rect x="0" y="0" width="188" height="22" rx="11" fill="#ffffff" stroke="#0f172a" stroke-width="1.2"/>
                      <circle cx="16" cy="11" r="6" fill="#ffffff"/>
                      <text x="16" y="14.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="8" font-weight="800" fill="#4285f4" text-anchor="middle">G</text>
                      <text x="100" y="14.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="8" font-weight="800" fill="#0f172a" text-anchor="middle">GOOGLE</text>
                    </g>
                    
                    <!-- 2. FACEBOOK BUTTON -->
                    <g transform="translate(136, 84)">
                      <rect x="0" y="0" width="188" height="22" rx="11" fill="#ffffff" stroke="#0f172a" stroke-width="1.2"/>
                      <circle cx="16" cy="11" r="6" fill="#1877f2"/>
                      <text x="16" y="14.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="8" font-weight="800" fill="#ffffff" text-anchor="middle">f</text>
                      <text x="100" y="14.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="8" font-weight="800" fill="#0f172a" text-anchor="middle">FACEBOOK</text>
                    </g>
                    
                    <!-- 3. INSTAGRAM BUTTON -->
                    <g transform="translate(136, 110)">
                      <rect x="0" y="0" width="188" height="22" rx="11" fill="#ffffff" stroke="#0f172a" stroke-width="1.2"/>
                      <circle cx="16" cy="11" r="6" fill="#e1306c"/>
                      <text x="16" y="14.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="7" font-weight="800" fill="#ffffff" text-anchor="middle">📷</text>
                      <text x="100" y="14.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="8" font-weight="800" fill="#0f172a" text-anchor="middle">INSTAGRAM</text>
                    </g>
                    
                    <!-- 4. YOUTUBE BUTTON -->
                    <g transform="translate(136, 136)">
                      <rect x="0" y="0" width="188" height="22" rx="11" fill="#ffffff" stroke="#0f172a" stroke-width="1.2"/>
                      <circle cx="16" cy="11" r="6" fill="#ff0000"/>
                      <text x="16" y="14" font-family="'Plus Jakarta Sans', sans-serif" font-size="7" font-weight="800" fill="#ffffff" text-anchor="middle">▶</text>
                      <text x="100" y="14.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="8" font-weight="800" fill="#0f172a" text-anchor="middle">YOUTUBE</text>
                    </g>
                    
                    <!-- 5. VIDEO TESTIMONIAL BUTTON (WITH NEW! BADGE) -->
                    <g transform="translate(136, 162)">
                      <rect x="0" y="0" width="188" height="22" rx="11" fill="#ffffff" stroke="#0f172a" stroke-width="1.4"/>
                      <text x="16" y="15" font-family="'Plus Jakarta Sans', sans-serif" font-size="9" fill="#0f172a" text-anchor="middle">📹</text>
                      <text x="96" y="14.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="8" font-weight="800" fill="#0f172a" text-anchor="middle">VIDEO TESTIMONIAL</text>
                      <!-- NEW! Starburst Badge -->
                      <polygon points="172,6 175,10 179,10 176,13 177,17 173,15 169,17 170,13 167,10 171,10" fill="#facc15"/>
                      <text x="173" y="14" font-family="'Plus Jakarta Sans', sans-serif" font-size="5.5" font-weight="800" fill="#0f172a" text-anchor="middle">NEW!</text>
                    </g>
                    
                    <!-- 6. PRIVATE ENQUIRY BUTTON (GOLD BORDER) -->
                    <g transform="translate(136, 188)">
                      <rect x="0" y="0" width="188" height="22" rx="11" fill="#ffffff" stroke="#f59e0b" stroke-width="1.4"/>
                      <text x="16" y="15" font-family="'Plus Jakarta Sans', sans-serif" font-size="9" fill="#f59e0b" text-anchor="middle">💬</text>
                      <text x="100" y="14.5" font-family="'Plus Jakarta Sans', sans-serif" font-size="8" font-weight="800" fill="#0f172a" text-anchor="middle">PRIVATE ENQUIRY</text>
                    </g>
                    
                    <!-- Left Floating Feature Pill -->
                    <g transform="translate(10, 80)">
                      <rect x="0" y="0" width="96" height="46" rx="10" fill="#ffffff" stroke="#e2e8f0" stroke-width="1.5"/>
                      <text x="48" y="18" font-family="'Plus Jakarta Sans', sans-serif" font-size="9.5" font-weight="800" fill="#e11d48" text-anchor="middle">1 QR Code</text>
                      <text x="48" y="32" font-family="'Inter', sans-serif" font-size="7.5" font-weight="600" fill="#64748b" text-anchor="middle">All Review Links</text>
                    </g>
                    
                    <!-- Right Floating Feature Pill -->
                    <g transform="translate(354, 110)">
                      <rect x="0" y="0" width="96" height="46" rx="10" fill="#ffffff" stroke="#cbd5e1" stroke-width="1.5"/>
                      <text x="48" y="18" font-family="'Plus Jakarta Sans', sans-serif" font-size="9.5" font-weight="800" fill="#16a34a" text-anchor="middle">⚡ Instant Tap</text>
                      <text x="48" y="32" font-family="'Inter', sans-serif" font-size="7.5" font-weight="600" fill="#64748b" text-anchor="middle">Google &amp; Socials</text>
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

            <!-- SLIDE 2: Video Testimonials (Direct Smartphone Selfie Reviews) -->
            <div class="carousel-slide" data-index="1">
              <div class="slide-visual-card">
                <div class="slide-badge-top">
                  <i class="bi bi-camera-video-fill"></i> Video Testimonials
                </div>
                
                <div class="slide-graphic-container">
                  <svg class="slide-graphic-svg" viewBox="0 0 460 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="230" cy="225" rx="170" ry="12" fill="rgba(15,23,42,0.06)"/>
                    
                    <!-- Recording Phone Frame -->
                    <rect x="135" y="12" width="190" height="212" rx="18" fill="#0f172a" stroke="#334155" stroke-width="2.5"/>
                    <rect x="190" y="16" width="80" height="5" rx="2.5" fill="#475569"/>
                    
                    <!-- Live Camera Feed Preview -->
                    <rect x="143" y="28" width="174" height="152" rx="8" fill="#1e293b"/>
                    
                    <!-- Customer Silhouette / Avatar in Camera -->
                    <circle cx="230" cy="82" r="26" fill="#3b82f6"/>
                    <path d="M200 135 C200 110, 260 110, 260 135 Z" fill="#3b82f6"/>
                    
                    <!-- Recording Indicator Top Right -->
                    <rect x="152" y="38" width="56" height="16" rx="8" fill="rgba(0,0,0,0.6)"/>
                    <circle cx="160" cy="46" r="4" fill="#ef4444"/>
                    <text x="180" y="49" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="800" fill="#ffffff">REC 0:18</text>
                    
                    <!-- 5-Star Overlay Badge inside Video -->
                    <g transform="translate(170, 115)">
                      <rect x="0" y="0" width="120" height="26" rx="6" fill="rgba(0,0,0,0.75)" stroke="rgba(255,255,255,0.2)"/>
                      <text x="60" y="17" font-family="'Plus Jakarta Sans', sans-serif" font-size="10.5" font-weight="800" fill="#f59e0b" text-anchor="middle">★★★★★</text>
                    </g>
                    
                    <!-- Record / Stop Button -->
                    <circle cx="230" cy="198" r="11" fill="#ffffff"/>
                    <circle cx="230" cy="198" r="8" fill="#ef4444"/>
                    
                    <!-- Left Pill -->
                    <g transform="translate(20, 90)">
                      <rect x="0" y="0" width="100" height="50" rx="10" fill="#ffffff" stroke="#e2e8f0" stroke-width="1.5"/>
                      <text x="50" y="20" font-family="'Plus Jakarta Sans', sans-serif" font-size="10" font-weight="800" fill="#e11d48" text-anchor="middle">📹 Selfie Video</text>
                      <text x="50" y="36" font-family="'Inter', sans-serif" font-size="8" font-weight="600" fill="#64748b" text-anchor="middle">100% Authentic</text>
                    </g>
                    
                    <!-- Right Pill -->
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
                    <!-- Dashboard Base Container -->
                    <rect x="25" y="14" width="410" height="212" rx="14" fill="#ffffff" stroke="#e2e8f0" stroke-width="2"/>
                    <rect x="25" y="14" width="410" height="38" rx="14" fill="#f8fafc" stroke="#e2e8f0" stroke-width="1"/>
                    
                    <!-- Dashboard Header Bar -->
                    <circle cx="45" cy="33" r="5" fill="#ef4444"/>
                    <circle cx="60" cy="33" r="5" fill="#f59e0b"/>
                    <circle cx="75" cy="33" r="5" fill="#10b981"/>
                    <text x="100" y="37" font-family="'Plus Jakarta Sans', sans-serif" font-size="11" font-weight="700" fill="#0f172a">AskReview Analytics Dashboard</text>
                    <text x="390" y="37" font-family="'Inter', sans-serif" font-size="9.5" font-weight="600" fill="#16a34a">● Live Tracking</text>
                    
                    <!-- 3 Summary Metric Cards -->
                    <!-- Metric 1: Total Scans -->
                    <rect x="42" y="60" width="114" height="52" rx="8" fill="#f8fafc" stroke="#e2e8f0"/>
                    <text x="54" y="76" font-family="'Inter', sans-serif" font-size="8.5" font-weight="600" fill="#64748b">TOTAL SCANS</text>
                    <text x="54" y="98" font-family="'Plus Jakarta Sans', sans-serif" font-size="16" font-weight="800" fill="#0f172a">18,450</text>
                    <text x="120" y="98" font-family="'Inter', sans-serif" font-size="9.5" font-weight="700" fill="#16a34a">+24% ↑</text>
                    
                    <!-- Metric 2: Google Reviews -->
                    <rect x="172" y="60" width="114" height="52" rx="8" fill="#eff6ff" stroke="#bfdbfe"/>
                    <text x="184" y="76" font-family="'Inter', sans-serif" font-size="8.5" font-weight="600" fill="#1e40af">5★ REVIEWS</text>
                    <text x="184" y="98" font-family="'Plus Jakarta Sans', sans-serif" font-size="16" font-weight="800" fill="#2563eb">4,920</text>
                    <text x="245" y="98" font-family="'Inter', sans-serif" font-size="9.5" font-weight="700" fill="#2563eb">98.2%</text>
                    
                    <!-- Metric 3: Video Reviews -->
                    <rect x="302" y="60" width="114" height="52" rx="8" fill="#fdf2f8" stroke="#fbcfe8"/>
                    <text x="314" y="76" font-family="'Inter', sans-serif" font-size="8.5" font-weight="600" fill="#9d174d">VIDEOS COLLECTED</text>
                    <text x="314" y="98" font-family="'Plus Jakarta Sans', sans-serif" font-size="16" font-weight="800" fill="#e11d48">156 📹</text>
                    
                    <!-- Performance Trend Chart -->
                    <line x1="42" y1="195" x2="416" y2="195" stroke="#e2e8f0" stroke-width="1.5"/>
                    <text x="42" y="132" font-family="'Inter', sans-serif" font-size="9" font-weight="700" fill="#475569">Channel Distribution</text>
                    
                    <!-- Bar 1: Google -->
                    <rect x="65" y="138" width="28" height="57" rx="4" fill="#4285f4"/>
                    <text x="79" y="208" font-family="'Inter', sans-serif" font-size="8" font-weight="700" fill="#4285f4" text-anchor="middle">Google</text>
                    
                    <!-- Bar 2: Facebook -->
                    <rect x="135" y="150" width="28" height="45" rx="4" fill="#1877f2"/>
                    <text x="149" y="208" font-family="'Inter', sans-serif" font-size="8" font-weight="700" fill="#1877f2" text-anchor="middle">FB</text>
                    
                    <!-- Bar 3: Instagram -->
                    <rect x="205" y="156" width="28" height="39" rx="4" fill="#e1306c"/>
                    <text x="219" y="208" font-family="'Inter', sans-serif" font-size="8" font-weight="700" fill="#e1306c" text-anchor="middle">Insta</text>
                    
                    <!-- Bar 4: YouTube -->
                    <rect x="275" y="162" width="28" height="33" rx="4" fill="#ff0000"/>
                    <text x="289" y="208" font-family="'Inter', sans-serif" font-size="8" font-weight="700" fill="#ff0000" text-anchor="middle">YouTube</text>
                    
                    <!-- Bar 5: Video Reviews -->
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
            <div class="trust-avatar" style="background:#e11d48;">AR</div>
            <div class="trust-avatar" style="background:#2563eb;">BK</div>
            <div class="trust-avatar" style="background:#16a34a;">RD</div>
            <div class="trust-avatar" style="background:#f59e0b;">+5k</div>
          </div>
          <div class="trust-text">
            <span>Trusted by <strong>5,000+ businesses</strong></span>
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
         RIGHT PANEL: Compact Corporate Sign-Up Form (No Scrollbar)
         ==================================================================== -->
    <div class="auth-form-panel">
      <div class="auth-form-container">
        
        <!-- Right Panel Brand Logo Header -->
        <div class="auth-brand-top">
          <a href="{{ url('/') }}" class="auth-brand-link">
            <img src="{{ asset('frontend/images/logo.jpg') }}" alt="AskReview Logo" class="auth-brand-logo-img">
          </a>
        </div>

        <!-- Form Heading Block -->
        <div class="auth-header-block">
          <span class="auth-welcome-badge">
            <i class="bi bi-rocket-takeoff-fill"></i> 7-Day Free Trial
          </span>
          <h1 class="auth-title">Create Account</h1>
          <p class="auth-subtitle">Set up your business profile to start collecting 5-star Google reviews today.</p>
        </div>

        <!-- Google One-Click Registration Button -->
        <a href="{{ route('auth.google') }}" class="btn-google-auth" id="googleSignupBtn">
          <svg class="google-icon-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
          </svg>
          <span>Sign Up with Google</span>
        </a>

        <!-- Divider -->
        <div class="auth-divider">
          <span>Or register with email</span>
        </div>

        <!-- Standard Signup Form -->
        <form method="POST" action="{{ URL::to('singup_post') }}" id="signupForm" onsubmit="return validateSignupForm();" autocomplete="on">
          @csrf
          <input type="hidden" name="user_id" value="{{ isset($user) ? $user->id : 1 }}">
          
          <!-- Business Name Input -->
          <div class="auth-form-group">
            <label for="businessName" class="auth-label">
              <span>Business / Store Name</span>
            </label>
            <div class="input-with-icon-wrapper">
              <span class="input-icon-prefix">
                <i class="bi bi-shop"></i>
              </span>
              <input 
                type="text" 
                name="name" 
                id="businessName" 
                class="auth-input-control" 
                placeholder="e.g. Apex Dental Clinic, Royal TVS" 
                required 
                value="{{ old('name') }}"
                autocomplete="organization"
              />
            </div>
          </div>

          <!-- Email Input -->
          <div class="auth-form-group">
            <label for="signupEmail" class="auth-label">
              <span>Email Address</span>
            </label>
            <div class="input-with-icon-wrapper">
              <span class="input-icon-prefix">
                <i class="bi bi-envelope"></i>
              </span>
              <input 
                type="email" 
                name="email" 
                id="signupEmail" 
                class="auth-input-control" 
                placeholder="contact@business.com" 
                required 
                value="{{ old('email') }}"
                autocomplete="email"
              />
            </div>
          </div>

          <!-- WhatsApp Number Input -->
          <div class="auth-form-group">
            <label for="signupPhone" class="auth-label">
              <span>WhatsApp / Contact Number</span>
            </label>
            <div class="input-with-icon-wrapper">
              <span class="input-icon-prefix">
                <i class="bi bi-whatsapp"></i>
              </span>
              <input 
                type="tel" 
                name="phone" 
                id="signupPhone" 
                class="auth-input-control" 
                placeholder="+91 98765 43210" 
                required 
                value="{{ old('phone') }}"
                autocomplete="tel"
              />
            </div>
          </div>

          <!-- Password Input -->
          <div class="auth-form-group">
            <label for="signupPassword" class="auth-label">
              <span>Password</span>
            </label>
            <div class="input-with-icon-wrapper">
              <span class="input-icon-prefix">
                <i class="bi bi-lock"></i>
              </span>
              <input 
                type="password" 
                name="password" 
                id="signupPassword" 
                class="auth-input-control has-suffix" 
                placeholder="Minimum 6 characters" 
                required 
                minlength="6"
                autocomplete="new-password"
              />
              <button type="button" class="btn-password-toggle" id="toggleSignupPasswordBtn" aria-label="Toggle password visibility">
                <i class="bi bi-eye" id="toggleSignupPasswordIcon"></i>
              </button>
            </div>
          </div>

          <!-- Confirm Password Input -->
          <div class="auth-form-group">
            <label for="confirmPassword" class="auth-label">
              <span>Confirm Password</span>
            </label>
            <div class="input-with-icon-wrapper">
              <span class="input-icon-prefix">
                <i class="bi bi-shield-lock"></i>
              </span>
              <input 
                type="password" 
                name="confirm_password" 
                id="confirmPassword" 
                class="auth-input-control has-suffix" 
                placeholder="Re-enter password" 
                required 
                minlength="6"
                autocomplete="new-password"
              />
              <button type="button" class="btn-password-toggle" id="toggleConfirmPasswordBtn" aria-label="Toggle password visibility">
                <i class="bi bi-eye" id="toggleConfirmPasswordIcon"></i>
              </button>
            </div>
            <div id="passwordMismatchNotice" class="text-danger mt-1" style="display:none; font-size: 0.8rem; font-weight: 600;">
              <i class="bi bi-exclamation-circle"></i> Passwords do not match!
            </div>
          </div>

          <!-- Interactive Captcha Box -->
          <div class="captcha-container-card">
            <div class="captcha-header">
              <span class="captcha-title">
                <i class="bi bi-shield-check"></i> Human Verification
              </span>
              <span style="font-size: 0.75rem; color: #64748b;">Enter code</span>
            </div>
            
            <div class="captcha-interactive-box">
              <div class="captcha-display-badge" id="captchaBadge" title="Security verification code">
                <span class="captcha-text-code" id="captchaText">{{ $captcha_code ?? 'AR9X2' }}</span>
              </div>
              
              <button type="button" class="btn-captcha-refresh" id="refreshCaptchaBtn" title="Get a new security code">
                <i class="bi bi-arrow-clockwise"></i>
              </button>
              
              <div class="captcha-input-box">
                <input 
                  type="text" 
                  name="captcha" 
                  id="captchaInput" 
                  class="auth-input-control" 
                  placeholder="CODE" 
                  maxlength="6" 
                  required 
                  autocomplete="off"
                />
              </div>
            </div>
          </div>

          <!-- Terms Checkbox -->
          <div class="auth-form-group mb-3">
            <label class="custom-checkbox-wrapper" for="acceptTermsCheckbox">
              <input type="checkbox" name="accept" id="acceptTermsCheckbox" class="custom-checkbox-input" required checked />
              <span class="custom-checkbox-label">
                I agree to the <a href="javascript:void(0)" class="auth-link">Terms of Service</a> &amp; <a href="javascript:void(0)" class="auth-link">Privacy Policy</a>
              </span>
            </label>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn-primary-auth" id="submitSignupBtn">
            <span id="signupBtnText">Create Account &amp; Start Trial</span>
            <i class="bi bi-arrow-right" id="signupBtnIcon"></i>
          </button>
        </form>

        <!-- Switch to Login -->
        <div class="auth-switch-prompt">
          Already have an account? 
          <a href="{{ url('login') }}">Sign In</a>
        </div>

        <!-- Security & Trust Footer -->
        <div class="auth-security-badge">
          <i class="bi bi-shield-fill-check"></i>
          <span>256-Bit SSL Encrypted • No Credit Card Required for Trial</span>
        </div>

      </div>
    </div>

  </div>

  <!-- jQuery & Toastr Scripts -->
  <script src="{{ asset('adminAssets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script>
    toastr.options = {
      "closeButton": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "timeOut": "4500",
      "extendedTimeOut": "1500"
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

    function setupPasswordToggle(toggleBtnId, inputId, iconId) {
      const toggleBtn = document.getElementById(toggleBtnId);
      const inputEl = document.getElementById(inputId);
      const iconEl = document.getElementById(iconId);

      if (toggleBtn && inputEl && iconEl) {
        toggleBtn.addEventListener('click', () => {
          const isPassword = inputEl.type === 'password';
          inputEl.type = isPassword ? 'text' : 'password';
          iconEl.className = isPassword ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
      }
    }

    setupPasswordToggle('toggleSignupPasswordBtn', 'signupPassword', 'toggleSignupPasswordIcon');
    setupPasswordToggle('toggleConfirmPasswordBtn', 'confirmPassword', 'toggleConfirmPasswordIcon');

    // Dynamic Captcha Refresh
    const refreshCaptchaBtn = document.getElementById('refreshCaptchaBtn');
    const captchaText = document.getElementById('captchaText');
    const captchaInput = document.getElementById('captchaInput');

    if (refreshCaptchaBtn && captchaText) {
      refreshCaptchaBtn.addEventListener('click', function() {
        refreshCaptchaBtn.classList.add('spinning');
        fetch("{{ url('refresh-captcha') }}")
          .then(res => res.json())
          .then(data => {
            if (data && data.code) {
              captchaText.innerText = data.code;
              if (captchaInput) captchaInput.value = '';
            }
          })
          .catch(err => {
            console.error('Failed to refresh captcha:', err);
          })
          .finally(() => {
            setTimeout(() => {
              refreshCaptchaBtn.classList.remove('spinning');
            }, 600);
          });
      });
    }

    // Form Validation Function
    function validateSignupForm() {
      const password = document.getElementById("signupPassword").value;
      const confirmPassword = document.getElementById("confirmPassword").value;
      const mismatchNotice = document.getElementById("passwordMismatchNotice");
      const submitBtn = document.getElementById('submitSignupBtn');
      const btnText = document.getElementById('signupBtnText');
      const btnIcon = document.getElementById('signupBtnIcon');
      const captchaInp = document.getElementById('captchaInput').value.trim();

      if (password !== confirmPassword) {
        mismatchNotice.style.display = "block";
        toastr.error("Passwords do not match!");
        return false;
      }
      mismatchNotice.style.display = "none";

      if (!captchaInp) {
        toastr.warning("Please enter the security verification code.");
        document.getElementById('captchaInput').focus();
        return false;
      }

      if (submitBtn) {
        submitBtn.disabled = true;
        btnText.innerText = 'Creating Account...';
        btnIcon.className = 'spinner-border spinner-border-sm';
      }

      return true;
    }

    const signupPass = document.getElementById('signupPassword');
    const confirmPass = document.getElementById('confirmPassword');
    const mismatchNotice = document.getElementById('passwordMismatchNotice');

    function checkPassMatch() {
      if (confirmPass.value.length > 0) {
        if (signupPass.value !== confirmPass.value) {
          mismatchNotice.style.display = "block";
        } else {
          mismatchNotice.style.display = "none";
        }
      } else {
        mismatchNotice.style.display = "none";
      }
    }

    if (signupPass && confirmPass) {
      signupPass.addEventListener('input', checkPassMatch);
      confirmPass.addEventListener('input', checkPassMatch);
    }

    // 5-Slide QR Code Carousel
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
        slidesContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
        
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

      startAutoPlay();
    })();
  </script>

</body>
</html>