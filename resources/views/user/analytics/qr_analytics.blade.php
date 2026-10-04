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
    <div class="row align-items-center mb-4">
        <div class="col-md-7 col-12">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary-subtle text-primary fw-semibold px-2 py-1 rounded-pill">
                    <i class="fa fa-qrcode me-1"></i> QR Performance
                </span>
                <span class="text-muted small">| Live Business Analytics</span>
            </div>
            <h3 class="fw-bold text-dark mt-1 mb-0">My QR Analytics & Insights</h3>
            <p class="text-muted small mb-0">Showing scans and customer visit trends recorded exclusively for your QR code stand.</p>
        </div>
        <div class="col-md-5 col-12 text-md-end mt-3 mt-md-0">
            @php
                $qrUrl = URL::to("u/".Auth::user()->name_url)."?from=qr";
            @endphp
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="copyQrLink('{{ $qrUrl }}')">
                    <i class="fa fa-copy me-1"></i> Copy Link
                </button>
                <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 ms-2" onclick="downloadQrPng()">
                    <i class="fa fa-download me-1"></i> Download PNG
                </button>
                <a href="{{ $qrUrl }}" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill px-3 ms-2">
                    <i class="fa fa-external-link-alt me-1"></i> Test Scan
                </a>
            </div>
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
        <!-- Left Column: QR Stand Showcase & Analyzed Quick Metrics -->
        <div class="col-lg-4 col-xl-3">
            <!-- QR Card -->
            <div class="chart-card card mb-4">
                <div class="card-header">
                    <h6 class="fw-bold text-dark mb-0"><i class="fa fa-qrcode text-primary me-2"></i>My QR Stand</h6>
                    <span class="badge bg-success-subtle text-success small">Active</span>
                </div>
                <div class="card-body">
                    <div class="qr-showcase-box" id="qrCodeContainer">
                        {!! QrCode::size(210)->generate($qrUrl) !!}
                    </div>

                    <label class="small text-muted fw-semibold mb-1">Target Review URL:</label>
                    <div class="link-copy-container">
                        <input type="text" readonly id="qrLinkText" value="{{ $qrUrl }}" class="link-copy-input">
                        <button type="button" class="btn btn-sm btn-link p-0 text-primary text-decoration-none" onclick="copyQrLink('{{ $qrUrl }}')" title="Copy to clipboard">
                            <i class="fa fa-copy"></i>
                        </button>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-sm rounded-3 py-2 fw-semibold" onclick="downloadQrPng()">
                            <i class="fa fa-download me-1"></i> Download QR Image (PNG)
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-3 py-2" onclick="downloadQrSvg()">
                            <i class="fa fa-file-code me-1"></i> Download Vector (SVG)
                        </button>
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
        var svgEl = document.querySelector('#qrCodeContainer svg');
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
        var svgEl = document.querySelector('#qrCodeContainer svg');
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
</script>
@endsection
