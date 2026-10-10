@extends('adminLayouts.home')
@section('content')

<style>
    /* Modern Dashboard Styling */
    .qr-analytics-wrapper {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    .kpi-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        background: #ffffff;
        overflow: hidden;
        position: relative;
    }
    .kpi-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }
    .kpi-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .bg-soft-primary { background-color: rgba(99, 102, 241, 0.12); color: #4f46e5; }
    .bg-soft-success { background-color: rgba(16, 185, 129, 0.12); color: #059669; }
    .bg-soft-warning { background-color: rgba(245, 158, 11, 0.12); color: #d97706; }
    .bg-soft-info    { background-color: rgba(14, 165, 233, 0.12); color: #0284c7; }
    .bg-soft-danger  { background-color: rgba(236, 72, 153, 0.12); color: #db2777; }

    .chart-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        background: #ffffff;
        transition: box-shadow 0.2s ease;
        margin-bottom: 24px;
    }
    .chart-card:hover {
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.07);
    }
    .chart-card .card-header {
        background: transparent;
        border-bottom: 1px solid #f1f5f9;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .chart-card .card-body {
        padding: 22px;
    }

    /* QR Code Display Card */
    .qr-showcase-box {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
    }
    .qr-showcase-box svg, .qr-showcase-box img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        background: #ffffff;
        padding: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    .qr-showcase-box-dark {
        background: linear-gradient(135deg, #090d16 0%, #1e293b 100%);
        border: 2px solid #334155;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.18);
    }
    .qr-showcase-box-dark svg, .qr-showcase-box-dark img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        background: #ffffff;
        padding: 10px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.25);
    }

    .link-copy-container {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 8px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
    }
    .link-copy-input {
        background: transparent;
        border: none;
        outline: none;
        font-size: 11px;
        color: #475569;
        width: 100%;
        font-family: monospace;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .progress-habit {
        height: 6px;
        border-radius: 4px;
        background-color: #f1f5f9;
        margin-top: 6px;
    }
    .progress-habit .progress-bar {
        border-radius: 4px;
    }

    .custom-toast {
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: #0f172a;
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        z-index: 99999;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        opacity: 0;
        transform: translateY(15px);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        pointer-events: none;
    }
    .custom-toast.show {
        opacity: 1;
        transform: translateY(0);
    }

    .table-modern th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-top: none;
        border-bottom: 1px solid #e2e8f0;
        padding: 12px 16px;
    }
    .table-modern td {
        padding: 14px 16px;
        font-size: 13px;
        color: #334155;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }
    .badge-soft {
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 11px;
    }
</style>

<div class="container-fluid qr-analytics-wrapper py-3">

    <!-- Header & Action Row -->
    <div class="d-flex flex-column flex-xl-row align-items-start align-items-xl-center justify-content-between gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge" style="background: #eef2ff; color: #4f46e5; font-weight: 700; font-size: 0.72rem; padding: 4px 10px; border-radius: 9999px;">
                    <i class="ti ti-qrcode me-1"></i> QR Performance
                </span>
                <span class="text-muted small fw-medium">| Live Business Analytics</span>
            </div>
            <h3 class="fw-bold text-dark mb-1" style="font-size: 1.55rem; letter-spacing: -0.02em;">My QR Analytics & Insights</h3>
            <p class="text-muted small mb-0">Showing scans and customer visit trends recorded exclusively for your QR code.</p>
        </div>
        @php
            $qrUrl = URL::to("u/".Auth::user()->name_url)."?from=qr";
        @endphp
        @php
            $activeStyle = $active_style ?? (Auth::user()->qr_style ?? 'style1');
        @endphp
        <div class="d-flex align-items-center flex-wrap gap-2 flex-shrink-0">
            @if (!empty($has_double_qr))
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fw-semibold rounded-pill d-inline-flex align-items-center gap-1.5">
                    <i class="fa fa-crown text-warning"></i> 2 QR Options Unlocked
                </span>
            @else
                <button type="button" class="btn btn-sm d-inline-flex align-items-center gap-2" style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a; border-radius: 10px; font-weight: 700; padding: 8px 14px;" onclick="promptDoubleQrUpgrade()">
                    <i class="fa fa-crown text-warning fs-5"></i>
                    <span>Unlock Option 2 <span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem;">PRO</span></span>
                </button>
            @endif
            <a href="{{ URL::to('admin/view_qr?style='.$activeStyle) }}" class="btn btn-sm d-inline-flex align-items-center gap-2" style="background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; border-radius: 10px; font-weight: 700; padding: 8px 16px; border: none; box-shadow: 0 4px 12px rgba(225, 29, 72, 0.25); text-decoration: none;">
                <i class="ti ti-qrcode fs-5"></i>
                <span>View Standee</span>
            </a>
            <a href="{{ URL::to('admin/print_qr_code?style='.$activeStyle) }}" class="btn btn-sm btn-outline-dark d-inline-flex align-items-center gap-2" style="border-radius: 10px; font-weight: 600; padding: 8px 14px; text-decoration: none;">
                <i class="ti ti-printer fs-5"></i>
                <span>Print Standee</span>
            </a>
            <button type="button" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-2" style="border-radius: 10px; font-weight: 600; padding: 8px 14px;" onclick="copyQrLink('{{ $qrUrl }}')">
                <i class="ti ti-copy fs-5"></i>
                <span>Copy Link</span>
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-2" style="border-radius: 10px; font-weight: 600; padding: 8px 14px;" onclick="downloadQrPng()">
                <i class="ti ti-download fs-5"></i>
                <span>PNG</span>
            </button>
            <a href="{{ $qrUrl }}" target="_blank" class="btn btn-sm btn-outline-dark d-inline-flex align-items-center gap-2" style="border-radius: 10px; font-weight: 600; padding: 8px 14px; text-decoration: none;">
                <i class="ti ti-external-link fs-5"></i>
                <span>Test Scan</span>
            </a>
        </div>
    </div>

    <!-- KPI Metric Cards (User Scoped) -->
    <div class="row g-3 mb-4">
        <!-- Total Scans -->
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="kpi-card card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Total Scans</span>
                        <h2 class="fw-bold text-dark mt-1 mb-0">{{ number_format($total_scan) }}</h2>
                        <span class="text-muted small">All-time scans for your QR</span>
                    </div>
                    <div class="kpi-icon-box bg-soft-primary">
                        <i class="fa fa-qrcode"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today Scans -->
        <div class="col-xl-2 col-sm-6 col-12">
            <div class="kpi-card card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Today's Scans</span>
                        <h2 class="fw-bold {{ $today_scan > 0 ? 'text-success' : 'text-dark' }} mt-1 mb-0">{{ number_format($today_scan) }}</h2>
                        <span class="text-muted small">{{ date('d M Y') }}</span>
                    </div>
                    <div class="kpi-icon-box bg-soft-success">
                        <i class="fa fa-calendar-day"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Week -->
        <div class="col-xl-2 col-sm-6 col-12">
            <div class="kpi-card card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">This Week</span>
                        <h2 class="fw-bold text-dark mt-1 mb-0">{{ number_format($this_week_scan) }}</h2>
                        <span class="text-muted small">Current week total</span>
                    </div>
                    <div class="kpi-icon-box bg-soft-warning">
                        <i class="fa fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Month -->
        <div class="col-xl-2 col-sm-6 col-12">
            <div class="kpi-card card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">This Month</span>
                        <h2 class="fw-bold text-dark mt-1 mb-0">{{ number_format($this_month_scan) }}</h2>
                        <span class="text-muted small">{{ date('F Y') }}</span>
                    </div>
                    <div class="kpi-icon-box bg-soft-info">
                        <i class="fa fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unique Visitors / Devices -->
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="kpi-card card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold text-uppercase">Unique Scanners</span>
                        <h2 class="fw-bold text-dark mt-1 mb-0">{{ number_format($unique_scans) }}</h2>
                        <span class="text-muted small">Distinct devices/visitors</span>
                    </div>
                    <div class="kpi-icon-box bg-soft-danger">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="row">
        <!-- Left Column: QR Code Showcase & Analyzed Quick Metrics -->
        <div class="col-lg-4 col-xl-3">
            @php
                $qr2Url = !empty($doubleQrSettings->url) ? $doubleQrSettings->url : $qrUrl;
                $qr2Name = !empty($doubleQrSettings->name) ? $doubleQrSettings->name : 'Pay via UPI';
                $qr2Type = !empty($doubleQrSettings->review_links) ? $doubleQrSettings->review_links : 'upi';
            @endphp

            <!-- QR Showcase Card with Option 1 & Option 2 (Single QR Per Option) -->
            <div class="chart-card card mb-4">
                <div class="card-header pb-2 pt-3">
                    <ul class="nav nav-pills w-100 gap-1" id="qrOptionTabs" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link {{ $activeStyle !== 'style2' ? 'active' : '' }} w-100 py-2 px-2 fw-bold text-center rounded-2 position-relative" id="option1-tab" data-bs-toggle="pill" data-bs-target="#option1Pane" type="button" role="tab" style="font-size: 0.85rem;">
                                <i class="ti ti-qrcode me-1"></i> Option 1
                                @if($activeStyle !== 'style2')
                                    <span class="badge bg-success ms-1" style="font-size: 0.65rem; padding: 2px 6px;">Active</span>
                                @endif
                            </button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link {{ $activeStyle === 'style2' ? 'active' : '' }} w-100 py-2 px-2 fw-bold text-center rounded-2 position-relative" id="option2-tab" data-bs-toggle="pill" data-bs-target="#option2Pane" type="button" role="tab" style="font-size: 0.85rem;">
                                <i class="fa fa-crown text-warning me-1"></i> Option 2
                                @if($activeStyle === 'style2')
                                    <span class="badge bg-success ms-1" style="font-size: 0.65rem; padding: 2px 6px;">Active</span>
                                @elseif(!empty($has_double_qr))
                                    <span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem; padding: 2px 6px;">PRO</span>
                                @else
                                    <i class="fa fa-lock ms-1 text-muted" style="font-size: 0.72rem;"></i>
                                @endif
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="qrOptionTabContent">
                        <!-- PANE 1: OPTION 1 QR -->
                        <div class="tab-pane fade {{ $activeStyle !== 'style2' ? 'show active' : '' }}" id="option1Pane" role="tabpanel">
                            <div class="qr-showcase-box" id="qrCodeContainerOption1">
                                {!! QrCode::size(210)->generate($qrUrl) !!}
                            </div>

                            @if($activeStyle !== 'style2')
                                <div class="p-2 rounded-2 bg-success-subtle text-success text-center fw-bold small mb-3 border border-success-subtle d-flex align-items-center justify-content-center gap-1.5">
                                    <i class="fa fa-check-circle"></i> Option 1 is Currently Active
                                </div>
                            @else
                                <button type="button" class="btn btn-outline-primary btn-sm w-100 fw-bold mb-3 d-flex align-items-center justify-content-center gap-1.5" onclick="activateQrOption('style1')">
                                    <i class="fa fa-toggle-on"></i> Make Option 1 Active
                                </button>
                            @endif

                            <label class="small text-muted fw-semibold mb-1">Target Review URL:</label>
                            <div class="link-copy-container mb-3">
                                <input type="text" readonly id="qrLinkText" value="{{ $qrUrl }}" class="link-copy-input">
                                <button type="button" class="btn btn-sm btn-link p-0 text-primary text-decoration-none" onclick="copyQrLink('{{ $qrUrl }}')" title="Copy to clipboard">
                                    <i class="fa fa-copy"></i>
                                </button>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ URL::to('admin/view_qr?style=style1') }}" class="btn btn-sm py-2 fw-bold text-white shadow-sm d-flex align-items-center justify-content-center gap-2" style="background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); border-radius: 10px; border: none; box-shadow: 0 4px 12px rgba(225, 29, 72, 0.22); text-decoration: none;">
                                    <i class="ti ti-qrcode fs-5"></i>
                                    <span>Download Standee (Option 1)</span>
                                </a>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-primary btn-sm w-100 fw-semibold d-flex align-items-center justify-content-center gap-1.5" style="border-radius: 8px; padding: 7px 10px;" onclick="downloadQrPng()">
                                            <i class="ti ti-download"></i>
                                            <span>PNG Image</span>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 fw-semibold d-flex align-items-center justify-content-center gap-1.5" style="border-radius: 8px; padding: 7px 10px;" onclick="downloadQrSvg()">
                                            <i class="ti ti-file-code"></i>
                                            <span>Vector (SVG)</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PANE 2: OPTION 2 QR (PREMIUM) -->
                        <div class="tab-pane fade {{ $activeStyle === 'style2' ? 'show active' : '' }}" id="option2Pane" role="tabpanel">
                            @if (empty($has_double_qr))
                                <!-- Locked State for Basic / Non-Premium Users -->
                                <div class="text-center p-3 rounded-3" style="background: linear-gradient(180deg, #faf5ff 0%, #f3e8ff 100%); border: 2px dashed #c084fc;">
                                    <div class="mb-2" style="width: 52px; height: 52px; margin: 0 auto; border-radius: 16px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); display: flex; align-items: center; justify-content: center; color: #b45309; font-size: 24px; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);">
                                        <i class="fa fa-crown"></i>
                                    </div>
                                    <div class="badge bg-warning text-dark fw-bold mb-2 px-2.5 py-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                        ⭐ PREMIUM EXCLUSIVE
                                    </div>
                                    <h6 class="fw-bold mb-1" style="color: #4c1d95; font-size: 1rem;">Option 2: Modern Luxury Standee</h6>
                                    <p class="text-muted small mb-3" style="font-size: 0.78rem;">
                                        Unlock our executive dark acrylic QR standee template and seamlessly switch between multiple QR options anytime.
                                    </p>
                                    <div class="text-start mb-3 p-3 rounded-3" style="background: #ffffff; border: 1px solid #e9d5ff; font-size: 0.76rem; color: #4b5563;">
                                        <div class="d-flex align-items-center gap-2 mb-2 text-dark fw-bold">
                                            <i class="fa fa-check-circle text-success"></i> Modern Dark Acrylic Standee Template
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-2 text-dark fw-bold">
                                            <i class="fa fa-check-circle text-success"></i> 2 QR Options Generated for Your Brand
                                        </div>
                                        <div class="d-flex align-items-center gap-2 text-dark fw-bold">
                                            <i class="fa fa-check-circle text-success"></i> Instant 1-Click QR Design Switching
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm w-100 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 py-2.5" style="background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%); color: #ffffff; border-radius: 10px; border: none;" onclick="promptDoubleQrUpgrade()">
                                        <i class="fa fa-crown text-warning"></i>
                                        <span>Upgrade to Premium Plan</span>
                                    </button>
                                </div>
                            @else
                                <!-- Active Option 2 for Premium Users -->
                                <div class="qr-showcase-box-dark" id="qrCodeContainerOption2">
                                    {!! QrCode::size(210)->generate($qrUrl) !!}
                                </div>

                                @if($activeStyle === 'style2')
                                    <div class="p-2 rounded-2 bg-success-subtle text-success text-center fw-bold small mb-3 border border-success-subtle d-flex align-items-center justify-content-center gap-1.5">
                                        <i class="fa fa-check-circle"></i> Option 2 is Currently Active
                                    </div>
                                @else
                                    <button type="button" class="btn btn-outline-primary btn-sm w-100 fw-bold mb-3 d-flex align-items-center justify-content-center gap-1.5" onclick="activateQrOption('style2')">
                                        <i class="fa fa-toggle-on"></i> Make Option 2 Active
                                    </button>
                                @endif

                                <label class="small text-muted fw-semibold mb-1">Target Review URL:</label>
                                <div class="link-copy-container mb-3">
                                    <input type="text" readonly value="{{ $qrUrl }}" class="link-copy-input">
                                    <button type="button" class="btn btn-sm btn-link p-0 text-primary text-decoration-none" onclick="copyQrLink('{{ $qrUrl }}')" title="Copy to clipboard">
                                        <i class="fa fa-copy"></i>
                                    </button>
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="{{ URL::to('admin/view_qr?style=style2') }}" class="btn btn-sm py-2 fw-bold text-white shadow-sm d-flex align-items-center justify-content-center gap-2" style="background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%); border-radius: 10px; border: none; box-shadow: 0 4px 12px rgba(124, 58, 237, 0.25); text-decoration: none;">
                                        <i class="ti ti-qrcode fs-5"></i>
                                        <span>Download Standee (Option 2)</span>
                                    </a>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-outline-primary btn-sm w-100 fw-semibold d-flex align-items-center justify-content-center gap-1.5" style="border-radius: 8px; padding: 7px 10px;" onclick="downloadQrPng()">
                                                <i class="ti ti-download"></i>
                                                <span>PNG Image</span>
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-outline-secondary btn-sm w-100 fw-semibold d-flex align-items-center justify-content-center gap-1.5" style="border-radius: 8px; padding: 7px 10px;" onclick="downloadQrSvg()">
                                                <i class="ti ti-file-code"></i>
                                                <span>Vector (SVG)</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analyzed Insights & Visiting Habits -->
            <div class="chart-card card mb-4">
                <div class="card-header">
                    <h6 class="fw-bold text-dark mb-0"><i class="fa fa-lightbulb text-warning me-2"></i>Scan Highlights</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small text-muted"><i class="fa fa-star text-warning me-1"></i> Busiest Day:</span>
                            <span class="badge bg-primary-subtle text-primary fw-semibold">{{ $peakDow }}</span>
                        </div>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small text-muted"><i class="fa fa-fire text-danger me-1"></i> Peak Record Date:</span>
                            <span class="fw-semibold text-dark small">{{ $peakDate }}</span>
                        </div>
                    </div>

                    <!-- Time of Day Distribution -->
                    <div>
                        <h6 class="small fw-bold text-dark mb-2">Time of Day Distribution</h6>
                        @php
                            $totalHourlyScans = array_sum($timeOfDayBuckets);
                            $morningPct = $totalHourlyScans > 0 ? round(($timeOfDayBuckets['Morning'] / $totalHourlyScans) * 100) : 0;
                            $afternoonPct = $totalHourlyScans > 0 ? round(($timeOfDayBuckets['Afternoon'] / $totalHourlyScans) * 100) : 0;
                            $eveningPct = $totalHourlyScans > 0 ? round(($timeOfDayBuckets['Evening'] / $totalHourlyScans) * 100) : 0;
                            $nightPct = $totalHourlyScans > 0 ? round(($timeOfDayBuckets['Night'] / $totalHourlyScans) * 100) : 0;
                        @endphp

                        <div class="mb-2">
                            <div class="d-flex justify-content-between small">
                                <span><i class="fa fa-sun text-warning me-1"></i> Morning (6AM - 12PM)</span>
                                <span class="fw-semibold">{{ $timeOfDayBuckets['Morning'] }} ({{ $morningPct }}%)</span>
                            </div>
                            <div class="progress progress-habit">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $morningPct }}%"></div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="d-flex justify-content-between small">
                                <span><i class="fa fa-cloud-sun text-info me-1"></i> Afternoon (12PM - 5PM)</span>
                                <span class="fw-semibold">{{ $timeOfDayBuckets['Afternoon'] }} ({{ $afternoonPct }}%)</span>
                            </div>
                            <div class="progress progress-habit">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $afternoonPct }}%"></div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="d-flex justify-content-between small">
                                <span><i class="fa fa-coffee text-primary me-1"></i> Evening (5PM - 9PM)</span>
                                <span class="fw-semibold">{{ $timeOfDayBuckets['Evening'] }} ({{ $eveningPct }}%)</span>
                            </div>
                            <div class="progress progress-habit">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $eveningPct }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between small">
                                <span><i class="fa fa-moon text-secondary me-1"></i> Night (9PM - 6AM)</span>
                                <span class="fw-semibold">{{ $timeOfDayBuckets['Night'] }} ({{ $nightPct }}%)</span>
                            </div>
                            <div class="progress progress-habit">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $nightPct }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Charts Suite & Detailed Logs -->
        <div class="col-lg-8 col-xl-9">
            <!-- Row 1: Monthly Trend & Share Charts -->
            <div class="row">
                <!-- Monthly Trend Curve -->
                <div class="col-lg-7 col-12">
                    <div class="chart-card card">
                        <div class="card-header">
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Monthly Scan Trend ({{ date('Y') }})</h6>
                                <span class="text-muted small">Month-by-month trajectory for your QR code</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="monthlyTrendChart" style="width: 100%; height: 320px;"></div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Distribution Donut -->
                <div class="col-lg-5 col-12">
                    <div class="chart-card card">
                        <div class="card-header">
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Monthly Share</h6>
                                <span class="text-muted small">Scans breakdown by month</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="monthWisePieChart" style="width: 100%; height: 320px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Customer Habit Charts (Day of Week & Peak Hours) -->
            <div class="row">
                <!-- Day of Week Distribution -->
                <div class="col-lg-6 col-12">
                    <div class="chart-card card">
                        <div class="card-header">
                            <div>
                                <h6 class="fw-bold text-dark mb-0"><i class="fa fa-calendar-week text-primary me-2"></i>Day of Week Scan Activity</h6>
                                <span class="text-muted small">Identify which days of the week get the most scans</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="dowChart" style="width: 100%; height: 290px;"></div>
                        </div>
                    </div>
                </div>

                <!-- Peak Hours 24H Activity -->
                <div class="col-lg-6 col-12">
                    <div class="chart-card card">
                        <div class="card-header">
                            <div>
                                <h6 class="fw-bold text-dark mb-0"><i class="fa fa-clock text-info me-2"></i>Peak Scanning Hours (24h)</h6>
                                <span class="text-muted small">Customer visit hours when scans occur</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="hourlyChart" style="width: 100%; height: 290px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 3: Date-Wise Custom Range Analytics -->
            <div class="chart-card card">
                <div class="card-header">
                    <div>
                        <h6 class="fw-bold text-dark mb-0"><i class="fa fa-filter text-secondary me-2"></i>Date-Wise QR Scans Explorer</h6>
                        <span class="text-muted small">Detailed daily scan volume with custom date filtering</span>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Date Filter Form -->
                    <form action="{{ url('admin/qr_analytics') }}" method="GET" class="mb-4">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-3 col-sm-6 col-12">
                                <label for="from_date" class="form-label small fw-semibold text-muted">From Date:</label>
                                <input type="date" name="from_date" id="from_date" class="form-control form-control-sm rounded-3" value="{{ request('from_date') }}">
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <label for="to_date" class="form-label small fw-semibold text-muted">To Date:</label>
                                <input type="date" name="to_date" id="to_date" class="form-control form-control-sm rounded-3" value="{{ request('to_date') }}">
                            </div>
                            <div class="col-md-4 col-sm-8 col-12">
                                <button type="submit" class="btn btn-primary btn-sm rounded-3 px-3 me-2">
                                    <i class="fa fa-search me-1"></i> Filter Scans
                                </button>
                                @if(request('from_date') || request('to_date'))
                                    <a href="{{ url('admin/qr_analytics') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                                        <i class="fa fa-undo me-1"></i> Reset
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-2 col-sm-4 col-12 text-md-end">
                                <span class="badge bg-light text-dark border small py-2 px-3">
                                    {{ count($dateWiseData) }} days with scans
                                </span>
                            </div>
                        </div>
                    </form>

                    <div id="dateWiseChart" style="width:100%; height:320px;"></div>
                </div>
            </div>

            <!-- Row 4: Analyzed Section: Recent QR Activity Stream Table -->
            <div class="chart-card card">
                <div class="card-header">
                    <div>
                        <h6 class="fw-bold text-dark mb-0"><i class="fa fa-history text-primary me-2"></i>Recent QR Scans Activity Log</h6>
                        <span class="text-muted small">Real-time log of the latest scans recorded for your business</span>
                    </div>
                    <span class="badge bg-primary-subtle text-primary">Showing latest {{ count($recentScans) }} scans</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th>Scan Date & Time</th>
                                    <th>Time Elapsed</th>
                                    <th>Visitor Device IP</th>
                                    <th>Source</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentScans as $idx => $scan)
                                    @php
                                        // Mask IP for privacy (e.g. 223.228.***.***)
                                        $ipParts = explode('.', $scan->ip_address ?? '');
                                        if (count($ipParts) === 4) {
                                            $maskedIp = $ipParts[0] . '.' . $ipParts[1] . '.***.***';
                                        } else {
                                            $maskedIp = 'Visitor Device';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-muted fw-bold">{{ $idx + 1 }}</td>
                                        <td>
                                            <div class="fw-semibold text-dark">
                                                {{ \Carbon\Carbon::parse($scan->created_at)->format('d M Y, h:i A') }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-muted fw-normal">
                                                {{ \Carbon\Carbon::parse($scan->created_at)->diffForHumans() }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="font-monospace small bg-light px-2 py-1 rounded text-secondary border">
                                                <i class="fa fa-shield-alt text-success me-1"></i> {{ $maskedIp }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info-subtle text-info">
                                                <i class="fa fa-qrcode me-1"></i> Direct QR Scan
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success-subtle text-success">
                                                <i class="fa fa-check-circle me-1"></i> Verified
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="py-4">
                                                <i class="fa fa-qrcode fa-3x text-muted mb-3 opacity-50"></i>
                                                <h6 class="fw-bold text-dark">No Scans Recorded Yet</h6>
                                                <p class="text-muted small mb-3">Download and print your QR code to place it on counters, bills, and reception desks.</p>
                                                <button type="button" class="btn btn-primary btn-sm rounded-pill px-4" onclick="downloadQrPng()">
                                                    <i class="fa fa-download me-1"></i> Download My QR
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Custom Toast Notification -->
<div id="analyticsToast" class="custom-toast">
    <i class="fa fa-check-circle text-success fs-5"></i>
    <span id="analyticsToastMsg">Link copied to clipboard!</span>
</div>


@endsection

@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    // Copy link helper
    function copyQrLink(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(function () {
                showToast('QR Code Review Link copied to clipboard!');
            }).catch(function() {
                fallbackCopy(text);
            });
        } else {
            fallbackCopy(text);
        }
    }

    function fallbackCopy(text) {
        var dummy = document.createElement("input");
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
        showToast('QR Code Review Link copied to clipboard!');
    }

    function showToast(msg) {
        var toast = document.getElementById('analyticsToast');
        var toastMsg = document.getElementById('analyticsToastMsg');
        if (toast && toastMsg) {
            toastMsg.innerText = msg;
            toast.classList.add('show');
            setTimeout(function () {
                toast.classList.remove('show');
            }, 3000);
        }
    }

    // Download QR Code as PNG
    function downloadQrPng() {
        var svgEl = document.querySelector('.tab-pane.active svg') || 
                    document.querySelector('#qrCodeContainerOption1 svg') || 
                    document.querySelector('#qrCodeContainerOption2 svg') || 
                    document.querySelector('#qrCodeContainer svg');
        if (!svgEl) {
            alert('QR Code element not found.');
            return;
        }

        var svgData = new XMLSerializer().serializeToString(svgEl);
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        var img = new Image();

        var svgBlob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
        var url = URL.createObjectURL(svgBlob);

        img.onload = function () {
            canvas.width = 600;
            canvas.height = 600;

            // Fill white background
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // Draw image with padding
            ctx.drawImage(img, 40, 40, 520, 520);
            URL.revokeObjectURL(url);

            var pngUrl = canvas.toDataURL('image/png');
            var a = document.createElement('a');
            a.download = 'askreview-qr-code.png';
            a.href = pngUrl;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            showToast('QR Code PNG downloaded!');
        };
        img.src = url;
    }

    // Download QR Code as SVG
    function downloadQrSvg() {
        var svgEl = document.querySelector('.tab-pane.active svg') || 
                    document.querySelector('#qrCodeContainerOption1 svg') || 
                    document.querySelector('#qrCodeContainerOption2 svg') || 
                    document.querySelector('#qrCodeContainer svg');
        if (!svgEl) return;
        var svgData = new XMLSerializer().serializeToString(svgEl);
        var svgBlob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
        var url = URL.createObjectURL(svgBlob);
        var a = document.createElement('a');
        a.download = 'askreview-qr-code.svg';
        a.href = url;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        showToast('QR Code SVG downloaded!');
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Highcharts global options
        Highcharts.setOptions({
            chart: {
                style: {
                    fontFamily: "'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif"
                }
            },
            colors: ['#4f46e5', '#0ea5e9', '#10b981', '#f59e0b', '#ec4899', '#8b5cf6', '#14b8a6', '#64748b']
        });

        // 1. Monthly Scan Trend (Current Year) - Smooth Spline / Area
        var monthlyTrendCategories = {!! json_encode($monthNames) !!};
        var monthlyTrendData = {!! json_encode($monthlyTrendSeries) !!};

        Highcharts.chart('monthlyTrendChart', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: monthlyTrendCategories,
                crosshair: true,
                lineColor: '#e2e8f0'
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Scans'
                },
                gridLineColor: '#f1f5f9'
            },
            tooltip: {
                shared: true,
                valueSuffix: ' scans'
            },
            plotOptions: {
                areaspline: {
                    fillColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, 'rgba(79, 70, 229, 0.25)'],
                            [1, 'rgba(79, 70, 229, 0.01)']
                        ]
                    },
                    lineColor: '#4f46e5',
                    lineWidth: 3,
                    marker: {
                        radius: 4,
                        fillColor: '#ffffff',
                        lineWidth: 2,
                        lineColor: '#4f46e5'
                    }
                }
            },
            series: [{
                name: 'QR Scans',
                data: monthlyTrendData
            }],
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            }
        });

        // 2. Month-Wise Pie / Donut Chart (Current Year Share)
        var pieData = {!! json_encode($pieChart) !!};

        Highcharts.chart('monthWisePieChart', {
            chart: {
                type: 'pie'
            },
            title: {
                text: null
            },
            tooltip: {
                pointFormat: '<b>{point.y} scans</b> ({point.percentage:.1f}%)'
            },
            plotOptions: {
                pie: {
                    innerSize: '55%',
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y}',
                        style: {
                            fontSize: '11px',
                            fontWeight: '500'
                        }
                    }
                }
            },
            series: [{
                name: 'Scans',
                colorByPoint: true,
                data: pieData.length > 0 ? pieData : [{ name: 'No Scans Yet', y: 1, color: '#e2e8f0' }]
            }],
            credits: {
                enabled: false
            }
        });

        // 3. Day of Week Activity Chart
        var dowCategories = {!! json_encode($dowDays) !!};
        var dowData = {!! json_encode($dowSeries) !!};

        Highcharts.chart('dowChart', {
            chart: {
                type: 'column'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: dowCategories,
                crosshair: true,
                lineColor: '#e2e8f0'
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Scans'
                },
                gridLineColor: '#f1f5f9'
            },
            tooltip: {
                valueSuffix: ' scans'
            },
            plotOptions: {
                column: {
                    borderRadius: 6,
                    colorByPoint: true
                }
            },
            series: [{
                name: 'Scans',
                data: dowData
            }],
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            }
        });

        // 4. Hourly / Peak Times 24h Activity Chart
        var hourlyCategories = {!! json_encode($hourlyCategories) !!};
        var hourlyData = {!! json_encode($hourlySeries) !!};

        Highcharts.chart('hourlyChart', {
            chart: {
                type: 'spline'
            },
            title: {
                text: null
            },
            xAxis: {
                categories: hourlyCategories,
                tickInterval: 3,
                crosshair: true,
                lineColor: '#e2e8f0'
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Scans'
                },
                gridLineColor: '#f1f5f9'
            },
            tooltip: {
                valueSuffix: ' scans'
            },
            plotOptions: {
                spline: {
                    lineColor: '#0ea5e9',
                    lineWidth: 3,
                    marker: {
                        radius: 3,
                        fillColor: '#0ea5e9'
                    }
                }
            },
            series: [{
                name: 'Hourly Scans',
                data: hourlyData
            }],
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            }
        });

        // 5. Date-Wise Filtered Chart
        var dateWiseData = {!! json_encode($dateWiseData) !!};

        Highcharts.chart('dateWiseChart', {
            chart: {
                type: 'column'
            },
            title: {
                text: null
            },
            xAxis: {
                type: 'category',
                title: {
                    text: 'Date'
                },
                lineColor: '#e2e8f0'
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Scans Recorded'
                },
                gridLineColor: '#f1f5f9'
            },
            tooltip: {
                pointFormat: '<b>{point.y} scans</b> recorded on {point.name}'
            },
            plotOptions: {
                column: {
                    borderRadius: 6,
                    color: '#6366f1'
                }
            },
            series: [{
                name: 'Daily Scans',
                data: dateWiseData
            }],
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            }
        });
    });

    // Option QR Helpers & Switcher
    function promptDoubleQrUpgrade() {
        if (typeof get_plans === "function") {
            get_plans();
        } else {
            window.location.href = "{{ URL::to('admin/user_service') }}";
        }
    }

    function activateQrOption(style) {
        $.ajax({
            url: "{{ URL::to('admin/activate_qr_style') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                style: style
            },
            success: function(res) {
                if (res.status === "success") {
                    showToast(res.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 600);
                }
            },
            error: function(xhr) {
                if (xhr.status === 403 && xhr.responseJSON && xhr.responseJSON.premium_required) {
                    promptDoubleQrUpgrade();
                } else {
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Error activating QR option";
                    alert(msg);
                }
            }
        });
    }
</script>
@endsection
