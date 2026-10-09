@extends('adminLayouts.home')
@section('content')

<style>
/* ==========================================================================
   MODERN FINTECH WALLET DASHBOARD STYLES
   ========================================================================== */
:root {
    --wallet-primary: #4f46e5;
    --wallet-primary-soft: #eef2ff;
    --wallet-danger: #e11d48;
    --wallet-danger-soft: #fff1f2;
    --wallet-success: #059669;
    --wallet-success-soft: #ecfdf5;
    --wallet-card-bg: #ffffff;
    --wallet-border: #e2e8f0;
}

.wallet-page-header {
    background: #ffffff;
    border: 1px solid var(--wallet-border);
    border-radius: 18px;
    padding: 20px 24px;
    box-shadow: 0 2px 12px rgba(15, 23, 42, 0.03);
    margin-bottom: 24px;
}

/* Stat Cards */
.modern-stat-card {
    background: #ffffff;
    border: 1px solid var(--wallet-border);
    border-radius: 18px;
    padding: 22px 24px;
    position: relative;
    overflow: hidden;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
}
.modern-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px -4px rgba(15, 23, 42, 0.08);
    border-color: #cbd5e1;
}
.stat-card-accent-bar {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
}
.accent-primary { background: linear-gradient(90deg, #4f46e5, #818cf8); }
.accent-danger  { background: linear-gradient(90deg, #e11d48, #fb7185); }
.accent-success { background: linear-gradient(90deg, #059669, #34d399); }
.accent-info    { background: linear-gradient(90deg, #0284c7, #38bdf8); }
.accent-purple  { background: linear-gradient(90deg, #7c3aed, #a78bfa); }

.stat-icon-wrapper {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}
.stat-icon-primary {
    background: #eef2ff;
    color: #4f46e5;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
}
.stat-icon-danger {
    background: #fff1f2;
    color: #e11d48;
    box-shadow: 0 4px 12px rgba(225, 29, 72, 0.15);
}
.stat-icon-success {
    background: #ecfdf5;
    color: #059669;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.15);
}
.stat-icon-info {
    background: #f0f9ff;
    color: #0284c7;
    box-shadow: 0 4px 12px rgba(2, 132, 199, 0.15);
}
.stat-icon-purple {
    background: #f5f3ff;
    color: #7c3aed;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.15);
}

.stat-number {
    font-size: 2.1rem;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: #0f172a;
    line-height: 1.1;
    margin-top: 6px;
    margin-bottom: 4px;
}
.stat-label {
    font-size: 0.78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #64748b;
}
.stat-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}

/* Filter Card */
.modern-filter-card {
    background: #ffffff;
    border: 1px solid var(--wallet-border);
    border-radius: 18px;
    padding: 18px 24px;
    box-shadow: 0 2px 12px rgba(15, 23, 42, 0.03);
    margin-bottom: 24px;
}
.input-with-icon {
    position: relative;
}
.input-with-icon .input-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 15px;
    pointer-events: none;
}
.input-with-icon input {
    padding-left: 36px !important;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    font-size: 13px;
    height: 40px;
    transition: all 0.2s;
}
.input-with-icon input:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
}
.preset-chip {
    padding: 5px 12px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    color: #475569;
    cursor: pointer;
    transition: all 0.2s;
    user-select: none;
}
.preset-chip:hover, .preset-chip.active {
    background: #4f46e5;
    color: #ffffff;
    border-color: #4f46e5;
}

/* Transactions Table Card */
.modern-table-card {
    background: #ffffff;
    border: 1px solid var(--wallet-border);
    border-radius: 18px;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
    overflow: hidden;
}
.modern-table-toolbar {
    padding: 18px 24px;
    border-bottom: 1px solid var(--wallet-border);
    background: #ffffff;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
}
.search-wrapper {
    position: relative;
    min-width: 280px;
    max-width: 380px;
    flex-grow: 1;
}
.search-wrapper .search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 15px;
}
.search-wrapper input {
    padding-left: 40px;
    padding-right: 14px;
    height: 40px;
    border-radius: 20px;
    border: 1px solid #cbd5e1;
    font-size: 13px;
    width: 100%;
    transition: all 0.2s;
    background: #f8fafc;
}
.search-wrapper input:focus {
    background: #ffffff;
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
    outline: none;
}
.export-btn {
    height: 38px;
    padding: 0 14px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    color: #334155;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
    cursor: pointer;
}
.export-btn:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #0f172a;
    transform: translateY(-1px);
}

/* Table Design */
.table-modern {
    margin-bottom: 0 !important;
}
.table-modern thead th {
    background-color: #f8fafc;
    color: #64748b;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    font-weight: 700;
    border-bottom: 1px solid var(--wallet-border);
    padding: 14px 18px;
    white-space: nowrap;
}
.table-modern tbody td {
    padding: 16px 18px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    background: #ffffff;
    transition: background 0.15s;
}
.table-modern tbody tr:hover td {
    background-color: #f8fafc;
}
.table-modern tbody tr:last-child td {
    border-bottom: none;
}

/* User Card inside row */
.user-cell-card {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    min-width: 290px;
}
.user-avatar-initials {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
    flex-shrink: 0;
    color: #ffffff;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1);
}
.user-avatar-img {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    object-fit: cover;
    border: 1px solid #e2e8f0;
    flex-shrink: 0;
}
.user-details-body {
    flex-grow: 1;
}
.user-name-title {
    font-weight: 700;
    color: #0f172a;
    font-size: 13.5px;
    line-height: 1.3;
}
.uid-pill {
    background: #f1f5f9;
    color: #475569;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 6px;
    font-family: monospace;
    border: 1px solid #e2e8f0;
}
.contact-item {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #475569;
    text-decoration: none;
    transition: color 0.15s;
}
.contact-item:hover {
    color: #4f46e5;
    text-decoration: underline;
}
.wa-link {
    color: #16a34a !important;
}
.wa-link:hover {
    color: #15803d !important;
}
.funnel-link-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #eef2ff;
    color: #4f46e5;
    border: 1px solid #c7d2fe;
    padding: 3px 9px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}
.funnel-link-pill:hover {
    background: #4f46e5;
    color: #ffffff;
    border-color: #4f46e5;
}

/* Token Badges */
.token-badge-debit {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #fff1f2;
    color: #e11d48;
    border: 1px solid #fecdd3;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 13px;
    white-space: nowrap;
}
.token-badge-credit {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #ecfdf5;
    color: #059669;
    border: 1px solid #a7f3d0;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 13px;
    white-space: nowrap;
}

/* Channel / Source Pills */
.source-pill-website {
    background: #f0fdf4;
    color: #166534;
    border: 1px solid #bbf7d0;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 11.5px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.source-pill-google {
    background: #f8fafc;
    color: #1e293b;
    border: 1px solid #e2e8f0;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 11.5px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.source-pill-admin {
    background: #f5f3ff;
    color: #6b21a8;
    border: 1px solid #ddd6fe;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 11.5px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* Status Dot */
.status-pill-active {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 600;
    color: #16a34a;
}
.status-pulse-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
}

/* Action Icon Buttons */
.action-btn-group {
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.action-btn {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    color: #475569;
    font-size: 14px;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
}
.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}
.action-btn-edit:hover {
    background: #4f46e5;
    color: #ffffff;
    border-color: #4f46e5;
}
.action-btn-dash:hover {
    background: #0284c7;
    color: #ffffff;
    border-color: #0284c7;
}
.action-btn-visit:hover {
    background: #059669;
    color: #ffffff;
    border-color: #059669;
}

/* Hide default DataTables ugly elements */
div.dataTables_wrapper div.dataTables_filter,
div.dataTables_wrapper div.dataTables_length,
div.dataTables_wrapper div.dt-buttons {
    display: none !important;
}
.dataTables_info {
    padding: 18px 24px !important;
    font-size: 12px !important;
    color: #64748b !important;
}
.dataTables_paginate {
    padding: 14px 24px !important;
}
.paginate_button {
    border-radius: 8px !important;
    font-size: 12px !important;
    margin: 0 2px !important;
    border: 1px solid #e2e8f0 !important;
    background: #ffffff !important;
    color: #475569 !important;
}
.paginate_button.current {
    background: #4f46e5 !important;
    color: #ffffff !important;
    border-color: #4f46e5 !important;
}
</style>

<div class="container-fluid py-2">

    <!-- Header Section -->
    <div class="wallet-page-header">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper stat-icon-primary">
                        <i class="ti ti-wallet"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h4 class="mb-0 fw-bolder text-dark" style="letter-spacing: -0.02em;">Wallet & Token History</h4>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 font-monospace" style="font-size: 11px;">
                                -1 Token / Signup
                            </span>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 13px;">
                            Detailed live audit trail of all token deductions for user creations and recharges.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                <div class="d-inline-flex align-items-center gap-2 bg-light border px-3 py-2 rounded-pill">
                    <i class="ti ti-shield-check text-success fs-5"></i>
                    <span class="text-muted small">Admin:</span>
                    <strong class="text-dark small">{{ Auth::user()->name }}</strong>
                    <span class="badge bg-success-subtle text-success rounded-pill ms-1 px-2 py-0.5" style="font-size: 10px;">
                        Active
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- 5 Tab Stat Cards -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3 mb-4">
        <!-- 1. How much Pending -->
        <div class="col">
            <div class="modern-stat-card h-100" onclick="filterByTab('all')" style="cursor: pointer;" title="Click to view all transactions">
                <div class="stat-card-accent-bar accent-primary"></div>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Pending Tokens</div>
                        <div class="stat-number text-primary">
                            {{ number_format($pending_tokens ?? Auth::user()->user_create_limit) }}
                        </div>
                        <div class="stat-badge bg-primary-subtle text-primary mt-1">
                            <i class="ti ti-coins" style="font-size: 12px;"></i>
                            <span>Available balance</span>
                        </div>
                    </div>
                    <div class="stat-icon-wrapper stat-icon-primary">
                        <i class="ti ti-wallet"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. How much Used -->
        <div class="col">
            <div class="modern-stat-card h-100" onclick="filterByTab('used')" style="cursor: pointer;" title="Click to filter by used/debited tokens">
                <div class="stat-card-accent-bar accent-danger"></div>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Tokens Used</div>
                        <div class="stat-number text-danger">
                            {{ number_format($total_used ?? 0) }}
                        </div>
                        <div class="stat-badge bg-danger-subtle text-danger mt-1">
                            <i class="ti ti-arrow-down-right" style="font-size: 12px;"></i>
                            <span>Total debited</span>
                        </div>
                    </div>
                    <div class="stat-icon-wrapper stat-icon-danger">
                        <i class="ti ti-arrow-down-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. How much Gets -->
        <div class="col">
            <div class="modern-stat-card h-100" onclick="filterByTab('gets')" style="cursor: pointer;" title="Click to filter by credited tokens">
                <div class="stat-card-accent-bar accent-success"></div>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Tokens Gets</div>
                        <div class="stat-number text-success">
                            {{ number_format($total_gets ?? 0) }}
                        </div>
                        <div class="stat-badge bg-success-subtle text-success mt-1">
                            <i class="ti ti-arrow-up-right" style="font-size: 12px;"></i>
                            <span>Total recharged</span>
                        </div>
                    </div>
                    <div class="stat-icon-wrapper stat-icon-success">
                        <i class="ti ti-receipt-tax"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. How much Signup -->
        <div class="col">
            <div class="modern-stat-card h-100" onclick="filterByTab('signup')" style="cursor: pointer;" title="Click to filter by self-signups">
                <div class="stat-card-accent-bar accent-info"></div>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">User Signups</div>
                        <div class="stat-number text-info">
                            {{ number_format($total_signup ?? 0) }}
                        </div>
                        <div class="stat-badge bg-info-subtle text-info mt-1">
                            <i class="ti ti-world" style="font-size: 12px;"></i>
                            <span>Website & Google</span>
                        </div>
                    </div>
                    <div class="stat-icon-wrapper stat-icon-info">
                        <i class="ti ti-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. How much Create -->
        <div class="col">
            <div class="modern-stat-card h-100" onclick="filterByTab('create')" style="cursor: pointer;" title="Click to filter by admin-created users">
                <div class="stat-card-accent-bar accent-purple"></div>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Admin Created</div>
                        <div class="stat-number" style="color: #7c3aed;">
                            {{ number_format($total_create ?? 0) }}
                        </div>
                        <div class="stat-badge mt-1" style="background-color: #f5f3ff; color: #7c3aed;">
                            <i class="ti ti-user-check" style="font-size: 12px;"></i>
                            <span>Manual creation</span>
                        </div>
                    </div>
                    <div class="stat-icon-wrapper stat-icon-purple">
                        <i class="ti ti-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Filter Toolbar with Quick Presets -->
    <div class="modern-filter-card">
        <form action="{{ url('admin/my_wallets_list') }}" method="post" id="walletFilterForm">
            @csrf
            <div class="row g-3 align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="d-flex align-items-center gap-2">
                        <span class="small fw-bold text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.05em;">Date Range:</span>
                        <div class="input-with-icon flex-grow-1">
                            <i class="ti ti-calendar input-icon"></i>
                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                   value="{{ isset($start_date) ? date('Y-m-d', strtotime($start_date)) : '' }}" 
                                   placeholder="Start Date">
                        </div>
                        <span class="text-muted small">to</span>
                        <div class="input-with-icon flex-grow-1">
                            <i class="ti ti-calendar input-icon"></i>
                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                   value="{{ isset($end_date) ? date('Y-m-d', strtotime($end_date)) : '' }}" 
                                   placeholder="End Date">
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6">
                    <div class="d-flex align-items-center gap-1 flex-wrap">
                        <span class="preset-chip" onclick="setDatePreset('all')">All Time</span>
                        <span class="preset-chip" onclick="setDatePreset('today')">Today</span>
                        <span class="preset-chip" onclick="setDatePreset('7days')">Last 7 Days</span>
                        <span class="preset-chip" onclick="setDatePreset('this_month')">This Month</span>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-12 text-xl-end">
                    <div class="d-flex align-items-center justify-content-xl-end gap-2">
                        <button type="submit" class="btn btn-primary btn-sm px-3 rounded-pill d-inline-flex align-items-center gap-1.5 shadow-sm">
                            <i class="ti ti-filter"></i>
                            <span>Filter Results</span>
                        </button>
                        @if(isset($start_date) || isset($end_date))
                            <a href="{{ url('admin/my_wallets_list') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill d-inline-flex align-items-center gap-1" title="Reset filter">
                                <i class="ti ti-rotate-clockwise"></i>
                                <span>Reset</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Main Transactions Card -->
    <div class="modern-table-card">
        <!-- Custom Toolbar: Search & Modern Export Buttons -->
        <div class="modern-table-toolbar">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="fw-bold text-dark fs-4">Transactions Log</span>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1">
                    {{ count($list) }} Records
                </span>
            </div>

            <div class="d-flex align-items-center gap-2 flex-grow-1 justify-content-md-end flex-wrap">
                <!-- Search input connected to DataTables -->
                <div class="search-wrapper">
                    <i class="ti ti-search search-icon"></i>
                    <input type="text" id="customSearchInput" placeholder="Search user, UID, phone, email, date...">
                </div>

                <!-- Modern Excel Export Button Only -->
                <div>
                    <button type="button" class="export-btn shadow-sm" id="btnExportExcel" title="Export Transactions to Excel">
                        <i class="fa-solid fa-file-excel text-success fs-5"></i>
                        <span class="fw-bold">Export Excel</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Table View -->
        <div class="table-responsive">
            <table id="zero_config" class="table table-modern align-middle w-100">
                <thead>
                    <tr>
                        <th style="width: 45px;">#</th>
                        <th style="min-width: 140px;">Date & Time</th>
                        <th style="min-width: 120px;">Token Impact</th>
                        <th style="min-width: 320px;">User Full Details</th>
                        <th style="min-width: 140px;">Channel / Source</th>
                        <th style="min-width: 170px;">Transaction Note</th>
                        <th style="width: 100px;" class="text-center">Quick Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Harmonious avatar gradient palettes
                        $gradients = [
                            'linear-gradient(135deg, #6366f1, #4f46e5)',
                            'linear-gradient(135deg, #06b6d4, #0891b2)',
                            'linear-gradient(135deg, #ec4899, #db2777)',
                            'linear-gradient(135deg, #8b5cf6, #7c3aed)',
                            'linear-gradient(135deg, #10b981, #059669)',
                            'linear-gradient(135deg, #f59e0b, #d97706)'
                        ];
                    @endphp

                    @foreach ($list as $key => $item)
                        @php
                            $grad = $gradients[$key % count($gradients)];
                            $initials = 'US';
                            if (!empty($item->sub_user_name)) {
                                $words = preg_split('/\s+/', trim($item->sub_user_name));
                                if (count($words) >= 2) {
                                    $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                                } else {
                                    $initials = strtoupper(substr($words[0], 0, 2));
                                }
                            }
                        @endphp
                        <tr>
                            <!-- Sl. -->
                            <td>
                                <span class="text-muted fw-bold font-monospace" style="font-size: 12px;">
                                    {{ sprintf('%02d', $key + 1) }}
                                </span>
                            </td>

                            <!-- Date & Time -->
                            <td>
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: 13px;">
                                        <i class="ti ti-calendar me-1 text-muted"></i>{{ date('d M Y', strtotime($item->created_at)) }}
                                    </div>
                                    <div class="text-muted small mt-0.5">
                                        <i class="ti ti-clock me-1 text-muted"></i>{{ date('h:i:s A', strtotime($item->created_at)) }}
                                    </div>
                                    <div class="text-muted" style="font-size: 10.5px; margin-top: 2px;">
                                        <i class="ti ti-history me-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    </div>
                                </div>
                            </td>

                            <!-- Token Change -->
                            <td>
                                @if($item->credit_debit == 'debit')
                                    <span class="token-badge-debit">
                                        <i class="ti ti-arrow-down-right fs-4"></i>
                                        <span>-{{ (int)$item->amount == $item->amount ? (int)$item->amount : $item->amount }} Token</span>
                                    </span>
                                @else
                                    <span class="token-badge-credit">
                                        <i class="ti ti-arrow-up-right fs-4"></i>
                                        <span>+{{ (int)$item->amount == $item->amount ? (int)$item->amount : $item->amount }} Tokens</span>
                                    </span>
                                @endif
                            </td>

                            <!-- User Full Details -->
                            <td>
                                @if($item->credit_debit == 'debit')
                                    @if(!empty($item->sub_user_name))
                                        <div class="user-cell-card">
                                            <!-- Avatar or Initials -->
                                            @if(!empty($item->sub_user_avatar))
                                                <img src="{{ asset($item->sub_user_avatar) }}" class="user-avatar-img" alt="avatar">
                                            @elseif(!empty($item->sub_user_logo))
                                                <img src="{{ asset($item->sub_user_logo) }}" class="user-avatar-img" alt="logo">
                                            @else
                                                <div class="user-avatar-initials" style="background: {{ $grad }};">
                                                    {{ $initials }}
                                                </div>
                                            @endif

                                            <div class="user-details-body">
                                                <!-- Business / Name & UID -->
                                                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                                    <span class="user-name-title">{{ $item->sub_user_name }}</span>
                                                    @if(!empty($item->sub_user_unique_id))
                                                        <span class="uid-pill" title="Unique User ID">#{{ $item->sub_user_unique_id }}</span>
                                                    @elseif(!empty($item->sub_user_real_id))
                                                        <span class="uid-pill" title="Database ID">#ID: {{ $item->sub_user_real_id }}</span>
                                                    @endif
                                                </div>

                                                <!-- Email -->
                                                @if(!empty($item->sub_user_email))
                                                    <div>
                                                        <a href="mailto:{{ $item->sub_user_email }}" class="contact-item" title="Click to email">
                                                            <i class="ti ti-mail text-muted"></i>
                                                            <span>{{ $item->sub_user_email }}</span>
                                                        </a>
                                                    </div>
                                                @endif

                                                <!-- Phone & WhatsApp -->
                                                @if(!empty($item->sub_user_phone))
                                                    <div class="mt-0.5 d-flex align-items-center gap-2">
                                                        <a href="tel:{{ $item->sub_user_phone }}" class="contact-item" title="Click to call">
                                                            <i class="ti ti-phone text-muted"></i>
                                                            <span>{{ $item->sub_user_phone }}</span>
                                                        </a>
                                                        @php
                                                            $cleanPhone = preg_replace('/[^0-9]/', '', $item->sub_user_phone);
                                                            if (strlen($cleanPhone) == 10) {
                                                                $cleanPhone = '91' . $cleanPhone;
                                                            }
                                                        @endphp
                                                        <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="contact-item wa-link" title="Chat on WhatsApp">
                                                            <i class="fab fa-whatsapp"></i>
                                                        </a>
                                                    </div>
                                                @endif

                                                <!-- Live Review Funnel Link -->
                                                @if(!empty($item->sub_user_name_url))
                                                    <div class="mt-1.5">
                                                        <a href="{{ url('u/'.$item->sub_user_name_url) }}" target="_blank" class="funnel-link-pill" title="View live review funnel">
                                                            <i class="ti ti-external-link"></i>
                                                            <span>/u/{{ $item->sub_user_name_url }}</span>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <!-- Fallback for older transactions -->
                                        <div class="d-flex align-items-center gap-2.5">
                                            <div class="user-avatar-initials" style="background: linear-gradient(135deg, #64748b, #475569);">
                                                <i class="ti ti-user"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $item->amount_credit_debit ?? 'User Created' }}</div>
                                                <span class="text-muted small">Sub-user record</span>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <!-- Credit Entry -->
                                    <div class="d-flex align-items-center gap-2.5">
                                        <div class="user-avatar-initials" style="background: linear-gradient(135deg, #10b981, #059669);">
                                            <i class="ti ti-wallet"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-success">Super Admin Token Credit</div>
                                            <div class="text-muted small">Credited by: <strong>{{ $item->amount_credit_debit ?? 'Super Admin' }}</strong></div>
                                        </div>
                                    </div>
                                @endif
                            </td>

                            <!-- Channel / Source -->
                            <td>
                                @if($item->credit_debit == 'debit')
                                    @if(($item->sub_user_create_type ?? '') == 'sign_up')
                                        <div class="source-pill-website">
                                            <i class="ti ti-world"></i>
                                            <span>Direct Signup</span>
                                        </div>
                                    @elseif(($item->sub_user_create_type ?? '') == 'google')
                                        <div class="source-pill-google">
                                            <i class="fab fa-google text-danger"></i>
                                            <span>Google OAuth</span>
                                        </div>
                                    @elseif(($item->sub_user_create_type ?? '') == 'admin' || ($item->sub_user_create_type ?? '') == 'register')
                                        <div class="source-pill-admin">
                                            <i class="ti ti-user-plus"></i>
                                            <span>Admin Created</span>
                                        </div>
                                    @elseif(!empty($item->sub_user_create_type))
                                        <span class="badge bg-light text-dark border">
                                            {{ ucfirst($item->sub_user_create_type) }}
                                        </span>
                                    @else
                                        <span class="badge bg-light text-muted border">User Debit</span>
                                    @endif

                                    @if(!empty($item->sub_user_status))
                                        <div class="mt-1">
                                            @if($item->sub_user_status == 'active')
                                                <span class="status-pill-active">
                                                    <span class="status-pulse-dot"></span>
                                                    <span>Active</span>
                                                </span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger" style="font-size: 10px;">
                                                    Inactive
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                        <i class="ti ti-shield-check me-1"></i>Wallet Topup
                                    </span>
                                @endif
                            </td>

                            <!-- Transaction Note -->
                            <td>
                                <div class="text-dark small" style="line-height: 1.4;">
                                    @if(str_contains(strtolower($item->note ?? ''), 'blanced'))
                                        <span>New user registration (-1 token deducted)</span>
                                    @else
                                        {{ $item->note ?? '-' }}
                                    @endif
                                </div>
                                @if($item->credit_debit == 'debit' && !empty($item->sub_user_created_at))
                                    <div class="text-muted mt-1" style="font-size: 11px;">
                                        <i class="ti ti-calendar-event me-1"></i>Reg: {{ date('d M Y, h:i A', strtotime($item->sub_user_created_at)) }}
                                    </div>
                                @endif
                            </td>

                            <!-- Action -->
                            <td class="text-center">
                                @if($item->credit_debit == 'debit' && !empty($item->sub_user_real_id))
                                    <div class="action-btn-group">
                                        <!-- Edit Sub User -->
                                        <a href="{{ url('admin/edit_sub_user/'.$item->sub_user_real_id) }}" 
                                           class="action-btn action-btn-edit" 
                                           data-bs-toggle="tooltip" 
                                           title="Edit User Profile & Settings">
                                            <i class="ti ti-edit"></i>
                                        </a>

                                        <!-- Login to Dashboard -->
                                        <a href="{{ url('admin/dashboard_visit/'.$item->sub_user_real_id) }}" 
                                           class="action-btn action-btn-dash" 
                                           data-bs-toggle="tooltip" 
                                           title="Login to User Dashboard">
                                            <i class="ti ti-device-desktop"></i>
                                        </a>

                                        <!-- Public Funnel -->
                                        @if(!empty($item->sub_user_name_url))
                                            <a href="{{ url('u/'.$item->sub_user_name_url) }}" target="_blank" 
                                               class="action-btn action-btn-visit" 
                                               data-bs-toggle="tooltip" 
                                               title="Open Public Funnel Link">
                                                <i class="ti ti-external-link"></i>
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

@section('js')
<script>
$(document).ready(function() {
    // Initialize tooltips if Bootstrap 5 bundle is present
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Destroy existing table instance if any
    if ($.fn.DataTable.isDataTable('#zero_config')) {
        $('#zero_config').DataTable().destroy();
    }
    
    // Initialize modern DataTable with full export capabilities
    dataTable = $('#zero_config').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                className: 'buttons-excel',
                title: 'Token_Transactions_History',
                exportOptions: { 
                    columns: [0, 1, 2, 3, 4, 5],
                    format: {
                        body: function (data, row, column, node) {
                            return $(node).text().trim().replace(/\s+/g, ' ');
                        }
                    }
                }
            }
        ],
        order: [], // Preserve server-side descending order
        pageLength: 25,
        language: {
            info: "Showing _START_ to _END_ of _TOTAL_ transactions",
            infoEmpty: "Showing 0 to 0 of 0 transactions",
            paginate: {
                previous: '<i class="ti ti-chevron-left"></i>',
                next: '<i class="ti ti-chevron-right"></i>'
            }
        }
    });

    // Custom Live Search box integration
    $('#customSearchInput').on('keyup', function() {
        dataTable.search(this.value).draw();
    });

    // Hook up custom modern Excel export button to DataTables internal trigger
    $('#btnExportExcel').on('click', function() {
        dataTable.button('.buttons-excel').trigger();
    });
});

// Interactive tab click filter
function filterByTab(tab) {
    if (!dataTable) return;
    if (tab === 'all') {
        $('#customSearchInput').val('');
        dataTable.search('').draw();
    } else if (tab === 'used') {
        $('#customSearchInput').val('Token');
        dataTable.search('Token').draw();
    } else if (tab === 'gets') {
        $('#customSearchInput').val('Credit');
        dataTable.search('Credit').draw();
    } else if (tab === 'signup') {
        $('#customSearchInput').val('Signup');
        dataTable.search('Signup').draw();
    } else if (tab === 'create') {
        $('#customSearchInput').val('Admin Created');
        dataTable.search('Admin Created').draw();
    }
}

// Quick Date Presets Helper
function setDatePreset(type) {
    var now = new Date();
    var formatDate = function(d) {
        var month = '' + (d.getMonth() + 1);
        var day = '' + d.getDate();
        var year = d.getFullYear();
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        return [year, month, day].join('-');
    };

    if (type === 'today') {
        var todayStr = formatDate(now);
        $('#start_date').val(todayStr);
        $('#end_date').val(todayStr);
    } else if (type === '7days') {
        var start = new Date();
        start.setDate(now.getDate() - 7);
        $('#start_date').val(formatDate(start));
        $('#end_date').val(formatDate(now));
    } else if (type === 'this_month') {
        var firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
        $('#start_date').val(formatDate(firstDay));
        $('#end_date').val(formatDate(now));
    } else if (type === 'all') {
        $('#start_date').val('');
        $('#end_date').val('');
    }

    // Submit form automatically on chip click
    $('#walletFilterForm').submit();
}
</script>
@endsection