<!DOCTYPE html>
<html lang="en">
<head>
  <title>Double QR Standee Print - AskReview</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
  <link rel="stylesheet" href="{{asset('adminAssets/css/style.min.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <style>
    body {
        background-color: #f8fafc;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    @media print {
        body {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            background: #ffffff !important;
            margin: 0;
            padding: 0;
        }
        .no-print {
            display: none !important;
        }
        @page {
            size: portrait;
            margin: 8mm;
        }
    }

    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .standee-container {
        max-width: 680px;
        margin: 20px auto;
        background: #ffffff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        border: 2px solid #e2e8f0;
        position: relative;
    }

    .standee-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: #ffffff;
        padding: 32px 24px 28px 24px;
        text-align: center;
        position: relative;
    }

    .standee-header::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #e11d48, #3b82f6, #10b981);
    }

    .standee-logo-box {
        width: 84px;
        height: 84px;
        margin: 0 auto 14px auto;
        border-radius: 20px;
        background: #ffffff;
        padding: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .standee-logo-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .standee-title {
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 4px;
        letter-spacing: -0.02em;
    }

    .standee-subtitle {
        font-size: 14px;
        color: #94a3b8;
        font-weight: 600;
        margin: 0;
    }

    .standee-body {
        padding: 32px 24px;
        background: #ffffff;
    }

    .qr-dual-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .qr-card-standee {
        border-radius: 18px;
        padding: 22px 16px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        position: relative;
    }

    .qr-card-review {
        background: #fff1f2;
        border: 2px solid #fecdd3;
    }

    .qr-card-custom {
        background: #eff6ff;
        border: 2px solid #bfdbfe;
    }

    .qr-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 9999px;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 14px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .pill-review {
        background: #e11d48;
        color: #ffffff;
    }

    .pill-custom {
        background: #2563eb;
        color: #ffffff;
    }

    .qr-matrix-box {
        background: #ffffff;
        border-radius: 14px;
        padding: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qr-matrix-box svg, .qr-matrix-box img {
        max-width: 100%;
        height: auto;
    }

    .qr-callout-text {
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 4px;
        color: #0f172a;
    }

    .qr-sub-text {
        font-size: 11.5px;
        color: #64748b;
        font-weight: 600;
        margin: 0;
    }

    .standee-footer {
        padding: 16px 24px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .footer-left {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 700;
        color: #475569;
    }

    .footer-right img {
        height: 22px;
        object-fit: contain;
    }
  </style>
</head>
<body>

<div class="container py-4">
    <!-- Action Bar (Not Printed) -->
    <div class="text-center mb-3 no-print">
        <button type="button" onclick="window.print()" class="btn btn-success px-4 py-2 fw-bold shadow-sm rounded-pill me-2">
            <i class="fa fa-print me-1"></i> Print Double Standee
        </button>
        <a href="{{ URL::to('admin/qr_analytics') }}" class="btn btn-secondary px-4 py-2 fw-bold rounded-pill">
            <i class="fa fa-arrow-left me-1"></i> Back to Analytics
        </a>
    </div>

    @php
        $user = Auth::user();
        $qr1Url = URL::to("u/".$user->name_url)."?from=qr";
        
        $qr2Url = !empty($doubleQrSettings->url) ? $doubleQrSettings->url : $qr1Url;
        $qr2Name = !empty($doubleQrSettings->name) ? $doubleQrSettings->name : 'Connect / Pay';
        $qr2Type = !empty($doubleQrSettings->review_links) ? $doubleQrSettings->review_links : 'upi';

        $qr2Subtitle = "Scan to take quick action";
        if ($qr2Type == 'upi') $qr2Subtitle = "GPay / PhonePe / Paytm / Any UPI";
        elseif ($qr2Type == 'instagram') $qr2Subtitle = "Follow our updates on Instagram";
        elseif ($qr2Type == 'whatsapp') $qr2Subtitle = "Message directly on WhatsApp";
        elseif ($qr2Type == 'menu') $qr2Subtitle = "View digital menu & offers";
        elseif ($qr2Type == 'google') $qr2Subtitle = "Direct 5-Star Rating on Google";
    @endphp

    <!-- Standee Printable Card -->
    <div class="standee-container" id="standeePrintArea">
        <!-- Standee Header -->
        <div class="standee-header">
            <div class="standee-logo-box">
                @if (!empty($user->logo))
                    <img src="{{ $user->logo }}" alt="{{ $user->name }}">
                @else
                    <i class="ti ti-building-store fs-1 text-primary"></i>
                @endif
            </div>
            <h2 class="standee-title">{{ $user->name ?? 'Welcome to Our Store' }}</h2>
            <p class="standee-subtitle">We appreciate your support &amp; love hearing from you!</p>
        </div>

        <!-- Standee Dual QRs Body -->
        <div class="standee-body">
            <div class="qr-dual-grid">
                <!-- QR 1: Google Reviews -->
                <div class="qr-card-standee qr-card-review">
                    <span class="qr-badge-pill pill-review">
                        <i class="fa fa-star"></i> Review Us
                    </span>
                    <div class="qr-matrix-box">
                        {!! QrCode::size(175)->generate($qr1Url) !!}
                    </div>
                    <div>
                        <div class="qr-callout-text">Rate Us on Google</div>
                        <p class="qr-sub-text">Share your quick 5-star experience</p>
                    </div>
                </div>

                <!-- QR 2: Custom Secondary Action -->
                <div class="qr-card-standee qr-card-custom">
                    <span class="qr-badge-pill pill-custom">
                        @if($qr2Type == 'upi')
                            <i class="fa fa-wallet"></i> Pay via UPI
                        @elseif($qr2Type == 'instagram')
                            <i class="fab fa-instagram"></i> Instagram
                        @elseif($qr2Type == 'whatsapp')
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        @elseif($qr2Type == 'menu')
                            <i class="fa fa-utensils"></i> Menu / Site
                        @else
                            <i class="fa fa-link"></i> Direct Connect
                        @endif
                    </span>
                    <div class="qr-matrix-box">
                        {!! QrCode::size(175)->generate($qr2Url) !!}
                    </div>
                    <div>
                        <div class="qr-callout-text">{{ $qr2Name }}</div>
                        <p class="qr-sub-text">{{ $qr2Subtitle }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Standee Footer -->
        <div class="standee-footer">
            <div class="footer-left">
                <i class="ti ti-qrcode text-danger fs-5"></i>
                <span>Instant Tap &amp; Scan Enabled</span>
            </div>
            <div class="footer-right">
                <span class="small text-muted me-1 fw-bold">Powered by</span>
                <strong style="color: #e11d48; font-weight: 800; font-size: 15px;">AskReview</strong>
            </div>
        </div>
    </div>
</div>

</body>
</html>
