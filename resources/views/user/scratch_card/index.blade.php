@extends('adminLayouts.home')
@section('content')

<style>
/* Modern Scratch Card Management Styles */
.scratch-hero-card {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
    border-radius: 18px;
    padding: 24px 28px;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    margin-bottom: 24px;
    box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.scratch-hero-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 380px;
    height: 380px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(234, 179, 8, 0.22) 0%, rgba(249, 115, 22, 0.12) 40%, transparent 70%);
    pointer-events: none;
}

.scratch-stat-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 20px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.scratch-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
}

.scratch-preview-chassis {
    border-radius: 16px;
    padding: 20px;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    min-height: 220px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25);
    transition: all 0.25s ease;
}

/* Card Themes */
.theme-gold {
    background: linear-gradient(135deg, #b45309 0%, #f59e0b 50%, #d97706 100%);
    border: 1.5px solid rgba(254, 240, 138, 0.5);
}
.theme-emerald {
    background: linear-gradient(135deg, #047857 0%, #10b981 50%, #059669 100%);
    border: 1.5px solid rgba(167, 243, 208, 0.5);
}
.theme-sapphire {
    background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 50%, #2563eb 100%);
    border: 1.5px solid rgba(191, 219, 254, 0.5);
}
.theme-crimson {
    background: linear-gradient(135deg, #be123c 0%, #f43f5e 50%, #e11d48 100%);
    border: 1.5px solid rgba(254, 205, 211, 0.5);
}
.theme-violet {
    background: linear-gradient(135deg, #6d28d9 0%, #8b5cf6 50%, #7c3aed 100%);
    border: 1.5px solid rgba(221, 214, 254, 0.5);
}

.scratch-shimmer-foil {
    background: repeating-linear-gradient(45deg, rgba(255,255,255,0.12), rgba(255,255,255,0.12) 10px, rgba(255,255,255,0.2) 10px, rgba(255,255,255,0.2) 20px);
    border-radius: 12px;
    padding: 12px 14px;
    border: 1px dashed rgba(255, 255, 255, 0.4);
    margin: 10px 0;
    text-align: center;
}

.card-thumb-badge {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid rgba(255, 255, 255, 0.8);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
}

.pulse-active-dot {
    width: 9px;
    height: 9px;
    background: #10b981;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    animation: activeDotPulse 1.8s infinite;
}

@keyframes activeDotPulse {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
    70% { transform: scale(1.15); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}

.card-metrics-pill-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f8fafc;
    border-radius: 10px;
    padding: 8px 12px;
    margin-bottom: 12px;
    font-size: 0.76rem;
    border: 1px solid #f1f5f9;
}

.table-modern thead th {
    background: #f8fafc;
    color: #475569;
    font-size: 0.78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    border-bottom: 2px solid #e2e8f0;
    padding: 12px 16px;
}

.table-modern tbody td {
    padding: 14px 16px;
    vertical-align: middle;
    font-size: 0.86rem;
    border-bottom: 1px solid #f1f5f9;
}

.locked-card-overlay {
    background: #ffffff;
    border: 2px dashed #fca5a5;
    border-radius: 20px;
    padding: 48px 24px;
    text-align: center;
    box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.08);
}

/* Card Analytics Modal & Selection Toolbar Button Hover Fixes */
.btn-export-excel {
    background-color: #ffffff !important;
    color: #107c41 !important;
    border: 1.5px solid #107c41 !important;
    transition: all 0.2s ease !important;
}
.btn-export-excel:hover,
.btn-export-excel:focus,
.btn-export-excel:active {
    background-color: #107c41 !important;
    color: #ffffff !important;
    border-color: #107c41 !important;
    box-shadow: 0 4px 10px rgba(16, 124, 65, 0.25) !important;
}
.btn-export-excel:hover i,
.btn-export-excel:hover span {
    color: #ffffff !important;
}

.btn-export-pdf {
    background-color: #ffffff !important;
    color: #dc2626 !important;
    border: 1.5px solid #dc2626 !important;
    transition: all 0.2s ease !important;
}
.btn-export-pdf:hover,
.btn-export-pdf:focus,
.btn-export-pdf:active {
    background-color: #dc2626 !important;
    color: #ffffff !important;
    border-color: #dc2626 !important;
    box-shadow: 0 4px 10px rgba(220, 38, 38, 0.25) !important;
}
.btn-export-pdf:hover i,
.btn-export-pdf:hover span {
    color: #ffffff !important;
}

.btn-print-report {
    background-color: #ffffff !important;
    color: #475569 !important;
    border: 1.5px solid #cbd5e1 !important;
    transition: all 0.2s ease !important;
}
.btn-print-report:hover,
.btn-print-report:focus,
.btn-print-report:active {
    background-color: #475569 !important;
    color: #ffffff !important;
    border-color: #475569 !important;
    box-shadow: 0 4px 10px rgba(71, 85, 105, 0.25) !important;
}
.btn-print-report:hover i,
.btn-print-report:hover span {
    color: #ffffff !important;
}

/* Ensure all outline buttons in modal have crisp visible text on hover */
#cardAnalyticsModal .btn-outline-success:hover,
#cardAnalyticsModal .btn-outline-success:focus,
#modalSelectionToolbar .btn-outline-success:hover,
#modalSelectionToolbar .btn-outline-success:focus {
    background-color: #107c41 !important;
    color: #ffffff !important;
    border-color: #107c41 !important;
}

#cardAnalyticsModal .btn-outline-danger:hover,
#cardAnalyticsModal .btn-outline-danger:focus,
#modalSelectionToolbar .btn-outline-danger:hover,
#modalSelectionToolbar .btn-outline-danger:focus {
    background-color: #dc2626 !important;
    color: #ffffff !important;
    border-color: #dc2626 !important;
}

#cardAnalyticsModal .btn-outline-secondary:hover,
#cardAnalyticsModal .btn-outline-secondary:focus {
    background-color: #64748b !important;
    color: #ffffff !important;
    border-color: #64748b !important;
}
</style>

<div class="container-fluid px-4 py-3">

    <!-- ── HERO BANNER ── -->
    <div class="scratch-hero-card">
        <div class="row align-items-center">
            <div class="col-lg-8 col-12">
                <span class="badge mb-2 px-2.5 py-1 text-uppercase fw-bold" style="background: rgba(245, 158, 11, 0.2); color: #fef08a; border: 1px solid rgba(245, 158, 11, 0.35); font-size: 0.68rem; letter-spacing: 0.05em;">
                    <i class="ti ti-gift me-1"></i> Lead Magnet
                </span>
                <h2 class="fw-bold mb-1.5 text-white" style="letter-spacing: -0.02em;">Scratch &amp; Win Reward Cards</h2>
                <p class="text-white-50 mb-3" style="font-size: 0.85rem; max-width: 580px;">
                    Engage customers and collect leads with interactive scratch reward cards.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-dark bg-opacity-50 text-white border border-secondary px-3 py-2 fw-normal" style="border-radius: 8px;">
                        <span class="pulse-active-dot me-1.5"></span> Active Live Card: <strong>{{ $stats['active_card'] }}</strong>
                    </span>
                    <span class="badge bg-dark bg-opacity-50 text-white border border-secondary px-3 py-2 fw-normal" style="border-radius: 8px;">
                        <i class="ti ti-users me-1 text-warning"></i> Total Claimed Leads: <strong>{{ $stats['total_leads'] }}</strong>
                    </span>
                    <span class="badge bg-dark bg-opacity-50 text-white border border-secondary px-3 py-2 fw-normal" style="border-radius: 8px;">
                        <i class="ti ti-sparkles me-1 text-info"></i> Total Scratches: <strong>{{ $stats['total_scratches'] }}</strong>
                    </span>
                </div>
            </div>
            <div class="col-lg-4 col-12 text-lg-end mt-3 mt-lg-0">
                @if($hasAccess)
                    <button type="button" class="btn btn-warning fw-bold px-4 py-2.5 me-2" data-bs-toggle="modal" data-bs-target="#createScratchModal" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);">
                        <i class="ti ti-plus me-1"></i> Create Scratch Card
                    </button>
                @else
                    <a href="{{ url('admin/user_payments_list') }}" class="btn btn-warning fw-bold px-4 py-2.5 me-2" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);">
                        <i class="ti ti-lock me-1"></i> Upgrade to Unlock
                    </a>
                @endif
                <a href="{{ url('u/' . ($user->name_url ?? '')) }}" target="_blank" class="btn btn-outline-light px-3 py-2.5" style="border-radius: 12px;" title="View Live Landing Page">
                    <i class="ti ti-external-link"></i> View Live Page
                </a>
            </div>
        </div>
    </div>

    <!-- ── STAT CARDS ── -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="scratch-stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold" style="font-size: 0.78rem; text-transform: uppercase;">Total Cards</span>
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center;">
                        <i class="ti ti-cards fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-slate-800">{{ $stats['total_cards'] }}</h3>
                <small class="text-muted">Cards configured</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="scratch-stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold" style="font-size: 0.78rem; text-transform: uppercase;">Times Scratched</span>
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center;">
                        <i class="ti ti-sparkles fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-slate-800">{{ $stats['total_scratches'] }}</h3>
                <small class="text-muted">Customer scratch interactions</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="scratch-stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold" style="font-size: 0.78rem; text-transform: uppercase;">Customer Leads</span>
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: #fff7ed; color: #ea580c; display: flex; align-items: center; justify-content: center;">
                        <i class="ti ti-user-check fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-slate-800">{{ $stats['total_leads'] }}</h3>
                <small class="text-muted">Claimed contact submissions</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="scratch-stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted fw-bold" style="font-size: 0.78rem; text-transform: uppercase;">Redeemed Offers</span>
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: #fdf2f8; color: #db2777; display: flex; align-items: center; justify-content: center;">
                        <i class="ti ti-discount-check fs-5"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0 text-slate-800">{{ $stats['redeemed_leads'] }}</h3>
                <small class="text-muted">Verified at store/counter</small>
            </div>
        </div>
    </div>

    @if(!$hasAccess)
        <!-- ── LOCKED STATE (WHEN ADMIN HAS NOT GIVEN ACCESS) ── -->
        <div class="locked-card-overlay my-4">
            <div style="width: 72px; height: 72px; border-radius: 50%; background: #fee2e2; color: #e11d48; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center;">
                <i class="ti ti-lock" style="font-size: 2.2rem;"></i>
            </div>
            <h3 class="fw-bold text-slate-900 mb-2">Scratch Card Feature is Locked</h3>
            <p class="text-muted mx-auto mb-4" style="max-width: 540px; font-size: 0.95rem;">
                This feature requires permission from administrator or an active Pro/Premium subscription. Contact support or upgrade your subscription to unlock interactive Scratch &amp; Win cards.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ url('admin/user_payments_list') }}" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 12px;">
                    <i class="ti ti-crown me-1"></i> Upgrade Subscription Plan
                </a>
                <a href="{{ url('admin/service_support') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 12px;">
                    Contact Administrator
                </a>
            </div>
        </div>
    @else

        @php
            $isLeadsTab = request('tab') === 'leads' || request('card_id') || request('search');
        @endphp
        <!-- ── NAVIGATION TABS (CARDS vs LEADS) ── -->
        <ul class="nav nav-pills mb-4 gap-2" id="scratchTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ !$isLeadsTab ? 'active' : '' }} fw-bold px-4 py-2" id="cards-tab" data-bs-toggle="pill" data-bs-target="#cards-content" type="button" role="tab" style="border-radius: 12px;">
                    <i class="ti ti-cards me-1.5"></i> My Scratch Cards ({{ $cards->count() }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $isLeadsTab ? 'active' : '' }} fw-bold px-4 py-2" id="leads-tab" data-bs-toggle="pill" data-bs-target="#leads-content" type="button" role="tab" style="border-radius: 12px;">
                    <i class="ti ti-users me-1.5"></i> Customer Submissions &amp; Leads ({{ $leads->total() }})
                </button>
            </li>
        </ul>

        <div class="tab-content" id="scratchTabsContent">
            
            <!-- ── TAB 1: SCRATCH CARDS MANAGEMENT ── -->
            <div class="tab-pane fade {{ !$isLeadsTab ? 'show active' : '' }}" id="cards-content" role="tabpanel">
                <div class="mb-3">
                    <h4 class="fw-bold text-slate-800 mb-0">Configured Scratch Cards</h4>
                    <small class="text-muted">You can create multiple scratch cards with custom images and offers, but only <strong>1 card can be active</strong> at a time.</small>
                </div>

                @if($cards->isEmpty())
                    <div class="card border text-center py-5 px-3" style="border-radius: 16px; background: #f8fafc;">
                        <div style="width: 64px; height: 64px; border-radius: 50%; background: #fef3c7; color: #d97706; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center;">
                            <i class="ti ti-gift" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="fw-bold text-slate-800 mb-1">No Scratch Cards Created Yet</h5>
                        <p class="text-muted mx-auto mb-3" style="max-width: 440px;">
                            Create your first scratch card with a tempting discount, reward image, or voucher code to start attracting leads today!
                        </p>
                        <div>
                            <button type="button" class="btn btn-warning fw-bold px-4 py-2" data-bs-toggle="modal" data-bs-target="#createScratchModal" style="border-radius: 10px;">
                                <i class="ti ti-plus me-1"></i> Create First Scratch Card
                            </button>
                        </div>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($cards as $c)
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card h-100 border-0 shadow-sm" style="border-radius: 18px; overflow: hidden; background: #ffffff;">
                                    
                                    <!-- Visual Card Preview -->
                                    <div class="scratch-preview-chassis theme-{{ $c->card_theme ?? 'gold' }}">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.06em; font-weight: 800; opacity: 0.9;">
                                                <i class="ti ti-sparkles me-1"></i> {{ $c->title ?: 'Scratch Card Offer' }}
                                            </span>
                                            @if($c->status === 'active')
                                                <span class="badge bg-white text-success fw-bold px-2.5 py-1" style="border-radius: 20px; font-size: 0.72rem;">
                                                    <span class="pulse-active-dot me-1"></span> LIVE ON PAGE
                                                </span>
                                            @else
                                                <span class="badge bg-black bg-opacity-25 text-white px-2 py-1" style="border-radius: 20px; font-size: 0.72rem;">
                                                    Inactive
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Shimmer Foil Section with Optional Image -->
                                        <div class="scratch-shimmer-foil">
                                            @if(!empty($c->image))
                                                <div class="text-center mb-1.5">
                                                    <img src="{{ asset($c->image) }}" alt="Reward" class="card-thumb-badge">
                                                </div>
                                            @endif
                                            @if(!empty($c->offer_text))
                                                <div style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.85;">Secret Reward:</div>
                                                <h4 class="fw-bold mb-1 mt-0.5 text-white" style="letter-spacing: -0.01em;">{{ $c->offer_text }}</h4>
                                            @endif
                                            @if(!empty($c->coupon_code))
                                                <span class="badge bg-white text-dark fw-bold px-2.5 py-0.5 font-monospace" style="font-size: 0.78rem;">
                                                    CODE: {{ $c->coupon_code }}
                                                </span>
                                            @endif
                                        </div>

                                        @if(!empty($c->description))
                                            <div style="font-size: 0.72rem; opacity: 0.85; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                                {{ $c->description }}
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Card Actions & Deep Details Deck -->
                                    <div class="p-3 bg-white border-top">
                                        <!-- Card-Wise Metrics Strip -->
                                        <div class="card-metrics-pill-bar">
                                            <span title="Total times customer scratched this card">
                                                <i class="ti ti-sparkles text-warning me-1"></i> <strong>{{ max($c->scratch_count, $c->leads_count) }}</strong> Scratched
                                            </span>
                                            <span title="Total leads captured from this card">
                                                <i class="ti ti-users text-primary me-1"></i> <strong>{{ $c->leads_count }}</strong> Leads
                                            </span>
                                            <span title="Total claimed / redeemed">
                                                <i class="ti ti-check text-success me-1"></i> <strong>{{ $c->redeemed_count ?? 0 }}</strong> Redeemed
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <small class="text-muted" title="{{ $c->created_at->format('d M Y, h:i A') }}">
                                                <i class="ti ti-calendar me-1"></i>{{ $c->created_at->format('M d, Y') }}
                                            </small>
                                            <button type="button" class="btn btn-sm btn-link text-decoration-none p-0 fw-bold text-primary" onclick="openCardAnalyticsModal({{ $c->id }})">
                                                <i class="ti ti-chart-bar me-1"></i> View Details &amp; Leads
                                            </button>
                                        </div>

                                        <div class="d-flex align-items-center gap-2 mt-2">
                                            @if($c->status === 'active')
                                                <form action="{{ route('scratch_cards.deactivate', $c->id) }}" method="POST" class="flex-fill">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-secondary w-100 btn-sm fw-bold py-1.5" style="border-radius: 8px;">
                                                        <i class="ti ti-power me-1"></i> Deactivate
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('scratch_cards.activate', $c->id) }}" method="POST" class="flex-fill">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success w-100 btn-sm fw-bold py-1.5" style="border-radius: 8px;" title="Sets this card as the 1 active card on public page">
                                                        <i class="ti ti-circle-check me-1"></i> Set As Active
                                                    </button>
                                                </form>
                                            @endif

                                            <button type="button" class="btn btn-outline-primary btn-sm px-2.5 py-1.5" style="border-radius: 8px;" onclick="editScratchCard({{ json_encode($c) }})" title="Edit Details">
                                                <i class="ti ti-edit fs-5"></i>
                                            </button>

                                            @if($c->leads_count > 0)
                                                <button type="button" class="btn btn-outline-danger btn-sm px-2.5 py-1.5" style="border-radius: 8px;" onclick="cannotDeleteCardWithLeads({{ $c->id }}, '{{ addslashes($c->title) }}', {{ $c->leads_count }})" title="Cannot delete: has {{ $c->leads_count }} leads. Delete leads first.">
                                                    <i class="ti ti-trash fs-5"></i>
                                                </button>
                                            @else
                                                <a href="{{ route('scratch_cards.delete', $c->id) }}" onclick="return confirm('Are you sure you want to delete this scratch card?')" class="btn btn-outline-danger btn-sm px-2.5 py-1.5" style="border-radius: 8px;" title="Delete Card">
                                                    <i class="ti ti-trash fs-5"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- ── TAB 2: CUSTOMER LEADS SUBMISSIONS TABLE ── -->
            <div class="tab-pane fade {{ $isLeadsTab ? 'show active' : '' }}" id="leads-content" role="tabpanel">
                <div class="card border-0 shadow-sm" style="border-radius: 18px; overflow: hidden; background: #ffffff;">
                    <div class="p-4 border-bottom bg-white">
                        <div class="row align-items-center g-3">
                            <div class="col-md-6 col-12">
                                <h4 class="fw-bold text-slate-800 mb-1">Customer Scratch Submissions</h4>
                                <p class="text-muted mb-0 small">Real customers who scratched your card and submitted contact details with exact date &amp; time.</p>
                            </div>
                            <div class="col-md-6 col-12 text-md-end">
                                <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                                    <a href="{{ route('scratch_cards.export_leads') }}" class="btn btn-outline-success fw-bold btn-sm py-2 px-3" style="border-radius: 10px;">
                                        <i class="ti ti-download me-1"></i> Export to CSV
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Form with Card Selector -->
                        <form action="{{ route('scratch_cards.index') }}" method="GET" class="row g-2 mt-2 align-items-center">
                            <div class="col-md-4 col-12">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white"><i class="ti ti-search"></i></span>
                                    <input type="text" name="search" class="form-control" placeholder="Search name, phone, coupon..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <select name="card_id" class="form-select form-select-sm">
                                    <option value="">All Scratch Cards</option>
                                    @foreach($cards as $c)
                                        <option value="{{ $c->id }}" @if(request('card_id') == $c->id) selected @endif>
                                            {{ $c->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-6">
                                <select name="status" class="form-select form-select-sm">
                                    <option value="">All Statuses</option>
                                    <option value="claimed" @if(request('status') === 'claimed') selected @endif>Claimed</option>
                                    <option value="redeemed" @if(request('status') === 'redeemed') selected @endif>Redeemed</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-6">
                                <button type="submit" class="btn btn-primary btn-sm w-100 fw-bold">Filter</button>
                            </div>
                            @if(request('search') || request('status') || request('card_id'))
                                <div class="col-md-1 col-6">
                                    <a href="{{ route('scratch_cards.index') }}" class="btn btn-outline-secondary btn-sm w-100">Clear</a>
                                </div>
                            @endif
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-modern mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Details</th>
                                    <th>Scratch Card &amp; Prize</th>
                                    <th>Coupon Code</th>
                                    <th>Scratched Date &amp; Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($leads as $lead)
                                    <tr>
                                        <td><span class="text-muted fw-bold">#{{ $lead->id }}</span></td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $lead->customer_name }}</div>
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <a href="tel:{{ $lead->customer_phone }}" class="text-decoration-none text-muted small">
                                                    <i class="ti ti-phone me-1"></i>{{ $lead->customer_phone }}
                                                </a>
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->customer_phone) }}" target="_blank" class="badge bg-success text-white text-decoration-none" style="font-size: 0.68rem;" title="Chat on WhatsApp">
                                                    <i class="ti ti-brand-whatsapp"></i> WhatsApp
                                                </a>
                                            </div>
                                            @if($lead->customer_email)
                                                <div class="small text-muted mt-0.5"><i class="ti ti-mail me-1"></i>{{ $lead->customer_email }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($lead->scratchCard)
                                                <div class="badge bg-light text-muted border mb-1" style="font-size: 0.7rem;">
                                                    <i class="ti ti-ticket me-1"></i>{{ $lead->scratchCard->title }}
                                                </div>
                                            @endif
                                            <div>
                                                <span class="badge bg-warning bg-opacity-10 text-dark border border-warning px-2 py-1 fw-bold" style="font-size: 0.8rem;">
                                                    🎁 {{ $lead->offer_won ?: 'Special Reward' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($lead->coupon_code)
                                                <span class="font-monospace fw-bold text-primary bg-primary bg-opacity-10 px-2 py-1 rounded">
                                                    {{ $lead->coupon_code }}
                                                </span>
                                            @else
                                                <span class="text-muted small">No code</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark" style="font-size: 0.84rem;">
                                                <i class="ti ti-calendar me-1 text-muted"></i>{{ $lead->created_at->format('d M, Y') }}
                                            </div>
                                            <div class="small text-muted" style="font-size: 0.78rem;">
                                                <i class="ti ti-clock me-1 text-primary"></i>{{ $lead->created_at->format('h:i A') }}
                                                <span class="text-muted ms-1">({{ $lead->created_at->diffForHumans() }})</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge @if($lead->status === 'redeemed') bg-success @else bg-warning text-dark @endif text-capitalize px-2.5 py-1 rounded-pill" id="leadStatusBadge{{ $lead->id }}">
                                                {{ $lead->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1.5">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleLeadStatus({{ $lead->id }}, '{{ $lead->status === 'redeemed' ? 'claimed' : 'redeemed' }}')" id="leadBtn{{ $lead->id }}">
                                                    @if($lead->status === 'redeemed')
                                                        <i class="ti ti-arrow-back-up me-1"></i> Claimed
                                                    @else
                                                        <i class="ti ti-check me-1"></i> Redeemed
                                                    @endif
                                                </button>
                                                <a href="{{ route('scratch_cards.leads.delete', $lead->id) }}" onclick="return confirm('Are you sure you want to delete lead for {{ addslashes($lead->customer_name) }}?')" class="btn btn-sm btn-outline-danger px-2" title="Delete Customer Lead">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-muted">
                                            <i class="ti ti-inbox fs-2 text-slate-300 d-block mb-2"></i>
                                            No customer scratch submissions found yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($leads->hasPages())
                        <div class="p-3 border-top d-flex justify-content-end bg-white">
                            {{ $leads->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>

    @endif

</div>

<!-- ── CREATE / EDIT SCRATCH CARD MODAL (WITH IMAGE UPLOAD) ── -->
<div class="modal fade" id="createScratchModal" tabindex="-1" aria-labelledby="createScratchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="modalHeading">
                    <i class="ti ti-ticket text-warning me-1.5"></i> Create Scratch Card Offer
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('scratch_cards.store') }}" method="POST" id="scratchCardForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="cardId">
                <div class="modal-body pt-3">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Offer Title / Campaign Name (Optional)</label>
                        <input type="text" name="title" id="cardTitle" class="form-control" placeholder="e.g. Weekend Surprise Treat">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Prize / Reward Won Text (Optional)</label>
                        <input type="text" name="offer_text" id="cardOfferText" class="form-control" placeholder="e.g. Flat 20% OFF or Free Coffee">
                        <small class="text-muted">This text is hidden under the scratch foil and revealed when scratched!</small>
                    </div>

                    <!-- Scratch Card Reward Image Upload -->
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Reward / Gift Image (Optional)</label>
                        <input type="file" name="image" id="cardImageInput" class="form-control" accept="image/*" onchange="previewCardImage(event)">
                        <small class="text-muted d-block">Upload photo of product, gift box, or voucher (PNG, JPG, WebP).</small>
                        <div id="cardImagePreviewContainer" class="mt-2 d-none">
                            <div class="d-flex align-items-center gap-2 p-2 border rounded" style="background: #f8fafc;">
                                <img src="" id="cardImagePreviewImg" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                <div class="small text-muted" id="cardImagePreviewText">Image attached</div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6 col-12">
                            <label class="form-label fw-bold small text-muted">Coupon Code (Optional)</label>
                            <input type="text" name="coupon_code" id="cardCouponCode" class="form-control font-monospace text-uppercase" placeholder="e.g. FLAT20">
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label fw-bold small text-muted">Card Theme Color</label>
                            <select name="card_theme" id="cardTheme" class="form-select">
                                <option value="gold">Gold Luxury</option>
                                <option value="emerald">Emerald Green</option>
                                <option value="sapphire">Electric Sapphire</option>
                                <option value="crimson">Ruby Crimson</option>
                                <option value="violet">Royal Violet</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Terms &amp; Instructions (Optional)</label>
                        <textarea name="description" id="cardDesc" rows="2" class="form-control" placeholder="e.g. Valid on minimum bill of ₹500. Show this code to cashier before bill generation."></textarea>
                    </div>

                    <div class="mb-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="status" value="active" id="cardStatusCheck" checked>
                            <label class="form-check-label fw-bold small" for="cardStatusCheck">Set as Active Live Card</label>
                        </div>
                        <small class="text-muted d-block ps-4">Setting this card to Active will automatically deactivate any previously active card.</small>
                    </div>

                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 10px;">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4" id="btnSaveCard" style="border-radius: 10px;">Save Scratch Card</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ── CARD-WISE DEEP ANALYTICS & LEADS MODAL (EXPANDED MODAL-XL) ── -->
<div class="modal fade" id="cardAnalyticsModal" tabindex="-1" aria-labelledby="cardAnalyticsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" style="max-width: 95vw; width: 1320px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <!-- Modal Header -->
            <div class="modal-header border-0 pb-3" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 20px 28px; border-bottom: 1px solid #e2e8f0 !important;">
                <div class="d-flex align-items-center gap-3">
                    <div id="modalCardHeaderIcon" style="width: 48px; height: 48px; border-radius: 12px; background: #e0e7ff; color: #4338ca; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class="ti ti-ticket"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary px-2.5 py-1 text-uppercase fw-bold" id="modalCardThemeBadge" style="font-size: 0.68rem; letter-spacing: 0.5px;">Theme</span>
                            <span id="modalCardStatusWrap"></span>
                        </div>
                        <h4 class="fw-bold text-dark mt-1 mb-0" id="modalCardTitle" style="font-size: 1.35rem;">Scratch Card Details</h4>
                        <small class="text-muted" id="modalCardCreated">Created on ...</small>
                    </div>
                </div>

                <!-- Export & Print Actions -->
                <div class="d-flex align-items-center gap-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-export-excel fw-bold d-flex align-items-center gap-1.5 shadow-sm" onclick="exportCardLeadsExcel()" title="Export Filtered or Selected Leads to Excel / CSV">
                            <i class="ti ti-file-spreadsheet fs-5"></i> <span>Export Excel</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-export-pdf fw-bold d-flex align-items-center gap-1.5 shadow-sm" onclick="exportCardLeadsPdf()" title="Export Leads to PDF Document">
                            <i class="ti ti-file-text fs-5"></i> <span>Export PDF</span>
                        </button>
                        <!-- <button type="button" class="btn btn-sm btn-print-report d-flex align-items-center gap-1.5 shadow-sm" onclick="printModalLeads()" title="Print Leads Report">
                            <i class="ti ti-printer fs-5"></i> <span>Print</span>
                        </button> -->
                    </div>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4" style="background: #ffffff;">
                <!-- Card Metrics Row -->
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="p-3 text-center rounded-3 border shadow-sm" style="background: #fffbeb; border-color: #fef3c7 !important;">
                            <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Total Scratches</div>
                            <h3 class="fw-bold mb-0 text-warning" id="modalStatScratches">0</h3>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 text-center rounded-3 border shadow-sm" style="background: #eff6ff; border-color: #dbeafe !important;">
                            <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Total Leads</div>
                            <h3 class="fw-bold mb-0 text-primary" id="modalStatLeads">0</h3>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 text-center rounded-3 border shadow-sm" style="background: #ecfdf5; border-color: #d1fae5 !important;">
                            <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Claimed Leads</div>
                            <h3 class="fw-bold mb-0 text-success" id="modalStatClaimed">0</h3>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 text-center rounded-3 border shadow-sm" style="background: #faf5ff; border-color: #f3e8ff !important;">
                            <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Redeemed Leads</div>
                            <h3 class="fw-bold mb-0" style="color: #9333ea;" id="modalStatRedeemed">0</h3>
                        </div>
                    </div>
                </div>

                <!-- Card Details Snippet -->
                <div class="p-3 rounded-3 border mb-4 d-flex align-items-center justify-content-between" style="background: #f8fafc; border-color: #e2e8f0 !important;">
                    <div class="d-flex align-items-center gap-3">
                        <div id="modalCardImageWrap"></div>
                        <div>
                            <div class="fw-bold fs-5 text-dark" id="modalCardOfferText">...</div>
                            <div class="text-muted small" id="modalCardCouponWrap"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <form id="modalPurgeLeadsForm" action="" method="POST" onsubmit="return confirm('Are you sure you want to delete ALL customer leads for this scratch card? This cannot be undone!')" class="d-inline-block">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger" id="btnModalPurgeLeads">
                                <i class="ti ti-trash me-1"></i> Delete All Leads for Card
                            </button>
                        </form>
                    </div>
                </div>

                <!-- ── FILTER & SEARCH TOOLBAR (Date-wise, Status, Keyword) ── -->
                <div class="card border mb-3 shadow-none" style="background: #f8fafc; border-radius: 14px; border-color: #e2e8f0 !important;">
                    <div class="card-body p-3">
                        <div class="row g-2 align-items-end">
                            <!-- From Date -->
                            <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                <label class="form-label text-muted small fw-bold mb-1" style="font-size: 0.75rem;">
                                    <i class="ti ti-calendar me-1"></i>From Date
                                </label>
                                <input type="date" id="modalFilterFromDate" class="form-control form-control-sm" onchange="onModalFilterChanged()">
                            </div>
                            <!-- To Date -->
                            <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                <label class="form-label text-muted small fw-bold mb-1" style="font-size: 0.75rem;">
                                    <i class="ti ti-calendar me-1"></i>To Date
                                </label>
                                <input type="date" id="modalFilterToDate" class="form-control form-control-sm" onchange="onModalFilterChanged()">
                            </div>
                            <!-- Status Filter -->
                            <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                                <label class="form-label text-muted small fw-bold mb-1" style="font-size: 0.75rem;">
                                    <i class="ti ti-adjustments-horizontal me-1"></i>Status
                                </label>
                                <select id="modalFilterStatus" class="form-select form-select-sm" onchange="onModalFilterChanged()">
                                    <option value="">All Statuses</option>
                                    <option value="claimed">Claimed</option>
                                    <option value="redeemed">Redeemed</option>
                                </select>
                            </div>
                            <!-- Keyword Search -->
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                                <label class="form-label text-muted small fw-bold mb-1" style="font-size: 0.75rem;">
                                    <i class="ti ti-search me-1"></i>Search Leads
                                </label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white border-end-0"><i class="ti ti-search text-muted"></i></span>
                                    <input type="text" id="modalFilterSearch" class="form-control border-start-0" placeholder="Name, phone, code..." onkeyup="onModalFilterChanged()">
                                </div>
                            </div>
                            <!-- Filter Buttons & Reset -->
                            <div class="col-12 col-lg-3 d-flex gap-2 justify-content-lg-end">
                                <button type="button" class="btn btn-sm btn-primary px-3 fw-bold flex-grow-1 flex-lg-grow-0" onclick="applyModalServerFilter()">
                                    <i class="ti ti-filter me-1"></i> Filter
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary px-2.5" onclick="resetModalFilters()" title="Reset all filters">
                                    <i class="ti ti-refresh me-1"></i> Reset
                                </button>
                            </div>
                        </div>

                        <!-- Quick Date Presets -->
                        <div class="d-flex align-items-center flex-wrap gap-1.5 mt-2.5 pt-2 border-top" style="border-color: #e2e8f0 !important;">
                            <span class="text-muted small fw-bold me-1" style="font-size: 0.72rem;">Quick Range:</span>
                            <button type="button" class="btn btn-xs btn-outline-secondary py-0.5 px-2 rounded-pill" onclick="setModalDateRange('all')">All Time</button>
                            <button type="button" class="btn btn-xs btn-outline-secondary py-0.5 px-2 rounded-pill" onclick="setModalDateRange('today')">Today</button>
                            <button type="button" class="btn btn-xs btn-outline-secondary py-0.5 px-2 rounded-pill" onclick="setModalDateRange('yesterday')">Yesterday</button>
                            <button type="button" class="btn btn-xs btn-outline-secondary py-0.5 px-2 rounded-pill" onclick="setModalDateRange('7days')">Last 7 Days</button>
                            <button type="button" class="btn btn-xs btn-outline-secondary py-0.5 px-2 rounded-pill" onclick="setModalDateRange('30days')">Last 30 Days</button>
                            <button type="button" class="btn btn-xs btn-outline-secondary py-0.5 px-2 rounded-pill" onclick="setModalDateRange('this_month')">This Month</button>
                        </div>
                    </div>
                </div>

                <!-- ── BATCH / BULK SELECTION ACTION TOOLBAR ── -->
                <div id="modalSelectionToolbar" class="alert alert-primary py-2.5 px-3.5 d-flex align-items-center justify-content-between mb-3 shadow-sm" style="display: none !important; border-radius: 12px; border-left: 4px solid #2563eb;">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary rounded-pill px-2.5 py-1" id="modalSelectedCountBadge">0 Selected</span>
                        <span class="small text-dark fw-bold" id="modalSelectedCountText">Select actions for checked customer leads</span>
                    </div>
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <button type="button" class="btn btn-xs btn-success fw-bold px-2.5 py-1" onclick="bulkUpdateSelectedStatus('redeemed')">
                            <i class="ti ti-check me-1"></i> Mark Redeemed
                        </button>
                        <button type="button" class="btn btn-xs btn-warning text-dark fw-bold px-2.5 py-1" onclick="bulkUpdateSelectedStatus('claimed')">
                            <i class="ti ti-clock me-1"></i> Mark Claimed
                        </button>
                        <button type="button" class="btn btn-xs btn-export-excel fw-bold px-2.5 py-1" onclick="exportSelectedOnlyExcel()">
                            <i class="ti ti-file-spreadsheet me-1"></i> Excel Selected
                        </button>
                        <button type="button" class="btn btn-xs btn-export-pdf fw-bold px-2.5 py-1" onclick="exportSelectedOnlyPdf()">
                            <i class="ti ti-file-text me-1"></i> PDF Selected
                        </button>
                        <button type="button" class="btn btn-xs btn-danger fw-bold px-2.5 py-1" onclick="bulkDeleteSelectedLeads()">
                            <i class="ti ti-trash me-1"></i> Delete Selected
                        </button>
                        <button type="button" class="btn btn-xs btn-link text-muted p-0 text-decoration-none ms-1" onclick="clearModalSelection()">
                            Clear
                        </button>
                    </div>
                </div>

                <!-- ── LEADS TABLE HEADER BAR ── -->
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <h5 class="fw-bold text-dark mb-0">Customers Who Scratched This Card</h5>
                        <span class="badge bg-secondary rounded-pill" id="modalLeadsCounterBadge">0</span>
                    </div>
                    <div class="small text-muted" id="modalFilterSummaryText">
                        Showing all leads
                    </div>
                </div>

                <!-- ── TABLE WITH CHECKBOXES ── -->
                <div class="table-responsive border rounded-3" style="max-height: 480px; min-height: 220px; overflow-y: auto;">
                    <table class="table table-hover table-sm table-modern align-middle mb-0" id="modalLeadsTable">
                        <thead class="table-light sticky-top" style="z-index: 2;">
                            <tr>
                                <th style="width: 44px; text-align: center;">
                                    <input type="checkbox" id="modalSelectAllLeads" onchange="toggleSelectAllModalLeads(this)" class="form-check-input" title="Select / Deselect All Visible" style="cursor: pointer; width: 17px; height: 17px;">
                                </th>
                                <th style="min-width: 170px;">Customer Name</th>
                                <th style="min-width: 190px;">Phone &amp; WhatsApp</th>
                                <th style="min-width: 110px;">Coupon Code</th>
                                <th style="min-width: 170px;">Scratched Date &amp; Time (IST)</th>
                                <th style="min-width: 110px;">Status</th>
                                <th style="width: 70px; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="modalCardLeadsTbody">
                            <!-- Populated via AJAX -->
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer Info -->
                <div class="d-flex align-items-center justify-content-between mt-2 px-1">
                    <small class="text-muted" id="modalFooterShowingCount">Loading leads...</small>
                    <small class="text-muted"><i class="ti ti-info-circle me-1"></i>Click the status badge to toggle between Claimed and Redeemed</small>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-0 pt-0 bg-light px-4 py-3 d-flex justify-content-between">
                <div class="small text-muted">
                    <i class="ti ti-clock me-1"></i>All timestamps displayed in <strong>Indian Standard Time (IST)</strong>
                </div>
                <button type="button" class="btn btn-secondary btn-sm px-4 fw-bold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Cannot Delete Scratch Card with Leads -->
<div class="modal fade" id="cannotDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-body p-4 text-center">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 1.8rem;">
                    <i class="ti ti-alert-triangle"></i>
                </div>
                <h5 class="fw-bold text-slate-800 mb-2">Cannot Delete Scratch Card</h5>
                <p class="text-muted mb-3" id="cannotDeleteDesc" style="font-size: 0.92rem; line-height: 1.45;">
                    This scratch card has customer leads. You must first delete all associated customer leads before you can delete this card.
                </p>
                <div class="alert alert-warning py-2.5 px-3 small text-start d-flex align-items-center gap-2 mb-3.5" style="border-radius: 12px;">
                    <i class="ti ti-info-circle text-warning fs-4 flex-shrink-0"></i>
                    <div style="font-size: 0.82rem;"><strong>First delete the leads</strong> from this card, then delete the scratch card.</div>
                </div>

                <div class="d-flex flex-column gap-2 mt-2">
                    <button type="button" class="btn btn-primary fw-bold py-2.5" onclick="viewCardLeadsFromCannotDelete()" style="border-radius: 12px;">
                        <i class="ti ti-users me-1"></i> View &amp; Delete Leads for this Card
                    </button>

                    <form id="cannotDeletePurgeForm" action="" method="POST" onsubmit="return confirm('Are you sure you want to delete ALL customer leads for this scratch card? This cannot be undone!')">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100 fw-bold py-2.5" style="border-radius: 12px;">
                            <i class="ti ti-trash me-1"></i> Purge All Leads &amp; Unlock Deletion
                        </button>
                    </form>

                    <button type="button" class="btn btn-light text-muted py-2" data-bs-dismiss="modal" style="border-radius: 12px;">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewCardImage(event) {
    var input = event.target;
    var container = document.getElementById('cardImagePreviewContainer');
    var img = document.getElementById('cardImagePreviewImg');
    var text = document.getElementById('cardImagePreviewText');

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            text.innerText = input.files[0].name;
            container.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function editScratchCard(card) {
    document.getElementById('modalHeading').innerHTML = '<i class="ti ti-edit text-primary me-1.5"></i> Edit Scratch Card';
    document.getElementById('btnSaveCard').innerText = 'Update Scratch Card';
    document.getElementById('cardId').value = card.id;
    document.getElementById('cardTitle').value = card.title || '';
    document.getElementById('cardOfferText').value = card.offer_text || '';
    document.getElementById('cardCouponCode').value = card.coupon_code || '';
    document.getElementById('cardTheme').value = card.card_theme || 'gold';
    document.getElementById('cardDesc').value = card.description || '';
    document.getElementById('cardStatusCheck').checked = (card.status === 'active');
    
    // Existing image preview
    var container = document.getElementById('cardImagePreviewContainer');
    var img = document.getElementById('cardImagePreviewImg');
    var text = document.getElementById('cardImagePreviewText');
    if (card.image) {
        img.src = "{{ url('/') }}/" + card.image;
        text.innerText = 'Current uploaded image';
        container.classList.remove('d-none');
    } else {
        container.classList.add('d-none');
    }

    var modal = new bootstrap.Modal(document.getElementById('createScratchModal'));
    modal.show();
}

// Reset modal on close
document.getElementById('createScratchModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('scratchCardForm').reset();
    document.getElementById('cardId').value = '';
    document.getElementById('modalHeading').innerHTML = '<i class="ti ti-ticket text-warning me-1.5"></i> Create Scratch Card Offer';
    document.getElementById('btnSaveCard').innerText = 'Save Scratch Card';
    document.getElementById('cardStatusCheck').checked = true;
    document.getElementById('cardImagePreviewContainer').classList.add('d-none');
});

// ─────────────────────────────────────────────────────────────
// CARD ANALYTICS & LEADS MANAGEMENT (EXPANDED MODAL)
// ─────────────────────────────────────────────────────────────
var currentModalCardId = null;
var currentModalCard = null;
var modalAllLeads = [];
var modalFilteredLeads = [];
var selectedModalLeadIds = new Set();

// Open Card Analytics & Leads Breakdown Modal
function openCardAnalyticsModal(cardId) {
    currentModalCardId = cardId;
    selectedModalLeadIds.clear();
    updateModalSelectionUI();

    // Reset filter inputs on fresh modal open
    var fromInput = document.getElementById('modalFilterFromDate');
    var toInput = document.getElementById('modalFilterToDate');
    var statusInput = document.getElementById('modalFilterStatus');
    var searchInput = document.getElementById('modalFilterSearch');
    if (fromInput) fromInput.value = '';
    if (toInput) toInput.value = '';
    if (statusInput) statusInput.value = '';
    if (searchInput) searchInput.value = '';

    fetchCardAnalyticsData(cardId, {});
}

// Fetch analytics and leads from backend
function fetchCardAnalyticsData(cardId, params, keepModalOpen) {
    var url = new URL('{{ url("admin/scratch_cards/analytics") }}/' + cardId, window.location.origin);
    if (params) {
        Object.keys(params).forEach(function(k) {
            if (params[k]) url.searchParams.append(k, params[k]);
        });
    }

    fetch(url.toString())
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                currentModalCard = res.card;
                modalAllLeads = res.leads || [];
                modalFilteredLeads = [...modalAllLeads];

                // Header details
                document.getElementById('modalCardThemeBadge').innerText = (res.card.card_theme || 'gold') + ' Theme';
                document.getElementById('modalCardTitle').innerText = res.card.title || 'Untitled Card';
                document.getElementById('modalCardCreated').innerText = 'Created on ' + (res.card.created_at || 'N/A');

                // Metric boxes (unfiltered overall totals)
                document.getElementById('modalStatScratches').innerText = res.card.scratch_count || 0;
                document.getElementById('modalStatLeads').innerText = res.card.leads_count || 0;
                document.getElementById('modalStatClaimed').innerText = res.card.claimed_count || 0;
                document.getElementById('modalStatRedeemed').innerText = res.card.redeemed_count || 0;

                // Card details snippet
                document.getElementById('modalCardOfferText').innerText = res.card.offer_text || 'No offer text';
                document.getElementById('modalCardCouponWrap').innerHTML = res.card.coupon_code 
                    ? '<span class="badge bg-primary font-monospace" style="cursor: pointer;" onclick="copyModalCoupon(\'' + res.card.coupon_code + '\', this)" title="Click to copy coupon code">CODE: ' + res.card.coupon_code + ' <i class="ti ti-copy ms-1"></i></span>' 
                    : '<span class="text-muted">No coupon code</span>';

                var imgWrap = document.getElementById('modalCardImageWrap');
                if (res.card.image) {
                    var imgUrl = (res.card.image.indexOf('http') === 0 || res.card.image.indexOf('/') === 0) ? res.card.image : ('{{ url('/') }}/' + res.card.image);
                    imgWrap.innerHTML = '<img src="' + imgUrl + '" style="width: 52px; height: 52px; object-fit: cover; border-radius: 10px; border: 1.5px solid #cbd5e1;">';
                } else {
                    imgWrap.innerHTML = '<div style="width: 52px; height: 52px; border-radius: 10px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;"><i class="ti ti-gift"></i></div>';
                }

                document.getElementById('modalCardStatusWrap').innerHTML = (res.card.status === 'active')
                    ? '<span class="badge bg-success px-2.5 py-1 text-uppercase fw-bold"><span class="pulse-active-dot me-1"></span> Live</span>'
                    : '<span class="badge bg-secondary px-2.5 py-1 text-uppercase fw-bold">Inactive</span>';

                // Configure Purge Leads form
                var purgeForm = document.getElementById('modalPurgeLeadsForm');
                var purgeBtn = document.getElementById('btnModalPurgeLeads');
                if (purgeForm) {
                    purgeForm.action = '{{ url("admin/scratch_cards/leads/delete_all_for_card") }}/' + res.card.id;
                }
                if (purgeBtn) {
                    purgeBtn.style.display = (res.card.leads_count > 0) ? 'inline-block' : 'none';
                }

                // Render Table
                renderModalLeadsTable(modalFilteredLeads);

                if (!keepModalOpen) {
                    var modalEl = document.getElementById('cardAnalyticsModal');
                    var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modal.show();
                }
            } else {
                alert(res.message || 'Failed to load card details.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error loading card analytics.');
        });
}

// Render leads table inside modal
function renderModalLeadsTable(leads) {
    var tbody = document.getElementById('modalCardLeadsTbody');
    var counterBadge = document.getElementById('modalLeadsCounterBadge');
    var footerCount = document.getElementById('modalFooterShowingCount');
    var summaryText = document.getElementById('modalFilterSummaryText');
    var selectAllChk = document.getElementById('modalSelectAllLeads');

    if (counterBadge) counterBadge.innerText = leads.length;
    if (footerCount) footerCount.innerText = 'Showing ' + leads.length + ' of ' + modalAllLeads.length + ' customer leads';

    if (modalAllLeads.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center py-5 text-muted"><i class="ti ti-inbox fs-1 text-slate-300 d-block mb-2"></i><strong>No customer leads found for this scratch card yet.</strong><div class="small mt-1">When customers scratch this card on your profile page, their leads will show up here.</div></td></tr>';
        if (selectAllChk) { selectAllChk.checked = false; selectAllChk.disabled = true; }
        if (summaryText) summaryText.innerText = 'No leads recorded';
        return;
    }

    if (leads.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center py-5 text-muted"><i class="ti ti-filter-off fs-1 text-slate-300 d-block mb-2"></i><strong>No leads match your filter criteria.</strong><div class="mt-2"><button type="button" class="btn btn-sm btn-outline-primary" onclick="resetModalFilters()"><i class="ti ti-refresh me-1"></i>Reset Filters</button></div></td></tr>';
        if (selectAllChk) { selectAllChk.checked = false; selectAllChk.disabled = true; }
        if (summaryText) summaryText.innerText = '0 matching leads';
        return;
    }

    if (selectAllChk) selectAllChk.disabled = false;

    // Check if all visible leads are currently selected
    var allVisibleSelected = leads.length > 0 && leads.every(function(l) { return selectedModalLeadIds.has(l.id); });
    if (selectAllChk) selectAllChk.checked = allVisibleSelected;

    var html = '';
    leads.forEach(function(l) {
        var isChecked = selectedModalLeadIds.has(l.id);
        var cleanPhone = l.customer_phone ? l.customer_phone.replace(/[^0-9]/g, '') : '';
        // If 10 digits, add country code 91 for Indian WhatsApp
        var waPhone = cleanPhone;
        if (waPhone.length === 10) waPhone = '91' + waPhone;

        var waMessage = encodeURIComponent('Hi ' + l.customer_name + '! Thank you for scratching our card at ' + (currentModalCard ? currentModalCard.title : '') + '. Your coupon code is: ' + (l.coupon_code || '-') + '.');

        var isRedeemed = (l.status === 'redeemed');
        var nextStatus = isRedeemed ? 'claimed' : 'redeemed';
        var statusBadgeClass = isRedeemed ? 'bg-success' : 'bg-warning text-dark';
        var statusBadgeIcon = isRedeemed ? 'ti-circle-check' : 'ti-clock';

        html += '<tr id="modalLeadRow_' + l.id + '" class="' + (isChecked ? 'table-primary bg-opacity-25' : '') + '">' +
            // Checkbox
            '<td class="text-center">' +
                '<input type="checkbox" class="form-check-input modal-lead-chk" value="' + l.id + '" onchange="toggleSelectLeadRow(' + l.id + ', this.checked)" ' + (isChecked ? 'checked' : '') + ' style="cursor: pointer; width: 17px; height: 17px;">' +
            '</td>' +
            // Customer Name & Email
            '<td>' +
                '<div class="fw-bold text-dark">' + l.customer_name + '</div>' +
                (l.customer_email ? '<div class="small text-muted"><i class="ti ti-mail me-1" style="font-size: 0.8rem;"></i>' + l.customer_email + '</div>' : '') +
            '</td>' +
            // Phone & WhatsApp with 1-click Copy
            '<td>' +
                '<div class="d-flex align-items-center gap-1.5">' +
                    '<span class="fw-bold text-dark font-monospace small">' + l.customer_phone + '</span>' +
                    '<button type="button" class="btn btn-xs btn-light border py-0 px-1 text-muted" onclick="copyModalPhone(\'' + l.customer_phone + '\', this)" title="Copy Phone Number" style="border-radius: 6px;">' +
                        '<i class="ti ti-copy"></i>' +
                    '</button>' +
                '</div>' +
                (cleanPhone ? '<a href="https://wa.me/' + waPhone + '?text=' + waMessage + '" target="_blank" class="badge bg-success text-white text-decoration-none mt-1 d-inline-flex align-items-center gap-1 py-1 px-2" style="font-size: 0.72rem; border-radius: 6px;"><i class="ti ti-brand-whatsapp"></i> Chat WhatsApp</a>' : '') +
            '</td>' +
            // Coupon Code
            '<td>' +
                (l.coupon_code 
                    ? '<span class="badge bg-light text-primary border font-monospace fw-bold px-2 py-1" style="cursor: pointer;" onclick="copyModalCoupon(\'' + l.coupon_code + '\', this)" title="Click to copy coupon">' + l.coupon_code + ' <i class="ti ti-copy ms-0.5"></i></span>'
                    : '<span class="text-muted small">-</span>') +
            '</td>' +
            // Date & Time (IST)
            '<td>' +
                '<div class="fw-bold small text-dark"><i class="ti ti-calendar-time me-1 text-muted"></i>' + l.date_time + '</div>' +
                (l.date_relative ? '<div class="text-muted" style="font-size: 0.72rem;">' + l.date_relative + '</div>' : '') +
            '</td>' +
            // Interactive Status Badge (1-click Toggle)
            '<td>' +
                '<button type="button" class="badge ' + statusBadgeClass + ' text-capitalize border-0 py-1.5 px-2.5 rounded-pill d-inline-flex align-items-center gap-1 shadow-sm" onclick="toggleModalLeadStatus(' + l.id + ', \'' + nextStatus + '\')" title="Click to switch to ' + nextStatus.toUpperCase() + '" style="cursor: pointer; transition: transform 0.15s ease;">' +
                    '<i class="ti ' + statusBadgeIcon + '"></i> ' + l.status +
                '</button>' +
            '</td>' +
            // Action (Delete Lead)
            '<td class="text-center">' +
                '<button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="deleteModalLeadAjax(' + l.id + ', ' + currentModalCardId + ')" title="Delete Lead" style="border-radius: 8px;">' +
                    '<i class="ti ti-trash"></i>' +
                '</button>' +
            '</td>' +
        '</tr>';
    });

    tbody.innerHTML = html;

    if (summaryText) {
        var claimedCount = leads.filter(l => l.status === 'claimed').length;
        var redeemedCount = leads.filter(l => l.status === 'redeemed').length;
        summaryText.innerHTML = 'Showing <strong>' + leads.length + '</strong> leads (<span class="text-success fw-bold">' + claimedCount + ' Claimed</span>, <span class="text-purple fw-bold" style="color: #9333ea;">' + redeemedCount + ' Redeemed</span>)';
    }
}

// Master Select / Deselect All visible leads
function toggleSelectAllModalLeads(masterChk) {
    var isChecked = masterChk.checked;
    modalFilteredLeads.forEach(function(l) {
        if (isChecked) {
            selectedModalLeadIds.add(l.id);
        } else {
            selectedModalLeadIds.delete(l.id);
        }
    });
    updateModalSelectionUI();
    renderModalLeadsTable(modalFilteredLeads);
}

// Toggle individual lead row checkbox
function toggleSelectLeadRow(leadId, isChecked) {
    if (isChecked) {
        selectedModalLeadIds.add(leadId);
    } else {
        selectedModalLeadIds.delete(leadId);
    }
    updateModalSelectionUI();
    // Highlight row
    var row = document.getElementById('modalLeadRow_' + leadId);
    if (row) {
        if (isChecked) {
            row.classList.add('table-primary', 'bg-opacity-25');
        } else {
            row.classList.remove('table-primary', 'bg-opacity-25');
        }
    }
    // Update master checkbox
    var selectAllChk = document.getElementById('modalSelectAllLeads');
    if (selectAllChk && modalFilteredLeads.length > 0) {
        selectAllChk.checked = modalFilteredLeads.every(function(l) { return selectedModalLeadIds.has(l.id); });
    }
}

// Update Selection Toolbar UI
function updateModalSelectionUI() {
    var toolbar = document.getElementById('modalSelectionToolbar');
    var countBadge = document.getElementById('modalSelectedCountBadge');
    var countText = document.getElementById('modalSelectedCountText');
    var size = selectedModalLeadIds.size;

    if (!toolbar) return;

    if (size > 0) {
        toolbar.style.setProperty('display', 'flex', 'important');
        if (countBadge) countBadge.innerText = size + ' Selected';
        if (countText) countText.innerText = size + ' lead' + (size > 1 ? 's' : '') + ' selected. Apply batch actions below:';
    } else {
        toolbar.style.setProperty('display', 'none', 'important');
    }
}

// Clear all lead selections
function clearModalSelection() {
    selectedModalLeadIds.clear();
    updateModalSelectionUI();
    var selectAllChk = document.getElementById('modalSelectAllLeads');
    if (selectAllChk) selectAllChk.checked = false;
    document.querySelectorAll('.modal-lead-chk').forEach(function(chk) {
        chk.checked = false;
    });
    document.querySelectorAll('#modalCardLeadsTbody tr').forEach(function(tr) {
        tr.classList.remove('table-primary', 'bg-opacity-25');
    });
}

// Live client-side instant filter on typing / date change
function onModalFilterChanged() {
    var fromDate = document.getElementById('modalFilterFromDate').value;
    var toDate = document.getElementById('modalFilterToDate').value;
    var status = document.getElementById('modalFilterStatus').value;
    var search = (document.getElementById('modalFilterSearch').value || '').trim().toLowerCase();

    modalFilteredLeads = modalAllLeads.filter(function(l) {
        // Date filter (l.date_iso is in YYYY-MM-DD format)
        if (fromDate && l.date_iso && l.date_iso < fromDate) return false;
        if (toDate && l.date_iso && l.date_iso > toDate) return false;

        // Status filter
        if (status && l.status !== status) return false;

        // Search text filter
        if (search) {
            var name = (l.customer_name || '').toLowerCase();
            var phone = (l.customer_phone || '').toLowerCase();
            var email = (l.customer_email || '').toLowerCase();
            var coupon = (l.coupon_code || '').toLowerCase();
            var offer = (l.offer_won || '').toLowerCase();
            if (!name.includes(search) && !phone.includes(search) && !email.includes(search) && !coupon.includes(search) && !offer.includes(search)) {
                return false;
            }
        }

        return true;
    });

    renderModalLeadsTable(modalFilteredLeads);
}

// Apply Server-side filtering
function applyModalServerFilter() {
    var fromDate = document.getElementById('modalFilterFromDate').value;
    var toDate = document.getElementById('modalFilterToDate').value;
    var status = document.getElementById('modalFilterStatus').value;
    var search = (document.getElementById('modalFilterSearch').value || '').trim();

    fetchCardAnalyticsData(currentModalCardId, {
        from_date: fromDate,
        to_date: toDate,
        status: status,
        search: search
    }, true);
}

// Reset all filters in modal
function resetModalFilters() {
    document.getElementById('modalFilterFromDate').value = '';
    document.getElementById('modalFilterToDate').value = '';
    document.getElementById('modalFilterStatus').value = '';
    document.getElementById('modalFilterSearch').value = '';
    applyModalServerFilter();
}

// Quick Date Range Presets
function setModalDateRange(rangeType) {
    var today = new Date();
    var formatDate = function(d) {
        var month = '' + (d.getMonth() + 1);
        var day = '' + d.getDate();
        var year = d.getFullYear();
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        return [year, month, day].join('-');
    };

    var fromStr = '';
    var toStr = formatDate(today);

    if (rangeType === 'today') {
        fromStr = formatDate(today);
    } else if (rangeType === 'yesterday') {
        var yest = new Date();
        yest.setDate(yest.getDate() - 1);
        fromStr = formatDate(yest);
        toStr = formatDate(yest);
    } else if (rangeType === '7days') {
        var d7 = new Date();
        d7.setDate(d7.getDate() - 7);
        fromStr = formatDate(d7);
    } else if (rangeType === '30days') {
        var d30 = new Date();
        d30.setDate(d30.getDate() - 30);
        fromStr = formatDate(d30);
    } else if (rangeType === 'this_month') {
        var firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
        fromStr = formatDate(firstDay);
    } else if (rangeType === 'all') {
        fromStr = '';
        toStr = '';
    }

    document.getElementById('modalFilterFromDate').value = fromStr;
    document.getElementById('modalFilterToDate').value = toStr;
    onModalFilterChanged();
}

// Single-click status toggle inside modal
function toggleModalLeadStatus(leadId, newStatus) {
    fetch('{{ route("scratch_cards.update_lead_status") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ lead_id: leadId, status: newStatus })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            // Update in local arrays
            modalAllLeads.forEach(function(l) {
                if (l.id === leadId) l.status = data.status;
            });
            modalFilteredLeads.forEach(function(l) {
                if (l.id === leadId) l.status = data.status;
            });

            // Update stats
            var claimed = modalAllLeads.filter(l => l.status === 'claimed').length;
            var redeemed = modalAllLeads.filter(l => l.status === 'redeemed').length;
            document.getElementById('modalStatClaimed').innerText = claimed;
            document.getElementById('modalStatRedeemed').innerText = redeemed;

            renderModalLeadsTable(modalFilteredLeads);
        } else {
            alert(data.message || 'Failed to update status.');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Error updating status.');
    });
}

// Bulk update status for selected leads
function bulkUpdateSelectedStatus(newStatus) {
    var ids = Array.from(selectedModalLeadIds);
    if (ids.length === 0) {
        alert('Please select at least one lead first.');
        return;
    }

    fetch('{{ route("scratch_cards.leads.bulk_update_status") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ lead_ids: ids, status: newStatus })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            modalAllLeads.forEach(function(l) {
                if (selectedModalLeadIds.has(l.id)) l.status = data.status;
            });
            modalFilteredLeads.forEach(function(l) {
                if (selectedModalLeadIds.has(l.id)) l.status = data.status;
            });

            var claimed = modalAllLeads.filter(l => l.status === 'claimed').length;
            var redeemed = modalAllLeads.filter(l => l.status === 'redeemed').length;
            document.getElementById('modalStatClaimed').innerText = claimed;
            document.getElementById('modalStatRedeemed').innerText = redeemed;

            renderModalLeadsTable(modalFilteredLeads);
            alert(data.message || 'Status updated successfully.');
        } else {
            alert(data.message || 'Failed to update status.');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Error in bulk status update.');
    });
}

// Bulk delete selected leads
function bulkDeleteSelectedLeads() {
    var ids = Array.from(selectedModalLeadIds);
    if (ids.length === 0) {
        alert('Please select at least one lead first.');
        return;
    }

    if (!confirm('Are you sure you want to delete ' + ids.length + ' selected lead(s)? This cannot be undone!')) {
        return;
    }

    fetch('{{ route("scratch_cards.leads.bulk_delete") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ lead_ids: ids, card_id: currentModalCardId })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            // Remove from local arrays
            modalAllLeads = modalAllLeads.filter(l => !selectedModalLeadIds.has(l.id));
            modalFilteredLeads = modalFilteredLeads.filter(l => !selectedModalLeadIds.has(l.id));
            selectedModalLeadIds.clear();
            updateModalSelectionUI();

            // Update stats
            document.getElementById('modalStatLeads').innerText = modalAllLeads.length;
            document.getElementById('modalStatClaimed').innerText = modalAllLeads.filter(l => l.status === 'claimed').length;
            document.getElementById('modalStatRedeemed').innerText = modalAllLeads.filter(l => l.status === 'redeemed').length;

            renderModalLeadsTable(modalFilteredLeads);

            if (data.remaining_leads === 0) {
                window.location.reload();
            } else {
                alert(data.message || 'Leads deleted successfully.');
            }
        } else {
            alert(data.message || 'Failed to delete leads.');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Error in bulk delete.');
    });
}

// Delete single lead
function deleteModalLeadAjax(leadId, cardId) {
    if (!confirm('Are you sure you want to delete this customer lead?')) {
        return;
    }
    fetch('{{ route("scratch_cards.leads.delete_ajax") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ lead_id: leadId })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            selectedModalLeadIds.delete(leadId);
            updateModalSelectionUI();

            modalAllLeads = modalAllLeads.filter(l => l.id !== leadId);
            modalFilteredLeads = modalFilteredLeads.filter(l => l.id !== leadId);

            document.getElementById('modalStatLeads').innerText = modalAllLeads.length;
            document.getElementById('modalStatClaimed').innerText = modalAllLeads.filter(l => l.status === 'claimed').length;
            document.getElementById('modalStatRedeemed').innerText = modalAllLeads.filter(l => l.status === 'redeemed').length;

            renderModalLeadsTable(modalFilteredLeads);

            if (data.remaining_leads === 0) {
                window.location.reload();
            }
        } else {
            alert(data.message || 'Failed to delete lead.');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Error deleting lead.');
    });
}

// ─────────────────────────────────────────────────────────────
// EXPORT FUNCTIONS (EXCEL / CSV, PDF, PRINT)
// ─────────────────────────────────────────────────────────────

// Export Excel / CSV (Filtered or Selected)
function exportCardLeadsExcel() {
    var leadsToExport = (selectedModalLeadIds.size > 0)
        ? modalAllLeads.filter(l => selectedModalLeadIds.has(l.id))
        : modalFilteredLeads;

    if (leadsToExport.length === 0) {
        alert('No leads available to export.');
        return;
    }

    var cardTitle = currentModalCard ? (currentModalCard.title || 'scratch_card') : 'scratch_card';
    var cleanSlug = cardTitle.toLowerCase().replace(/[^a-z0-9]+/g, '_');
    var filename = 'leads_' + cleanSlug + '_' + (new Date().toISOString().slice(0, 10)) + '.csv';

    // Build CSV with UTF-8 BOM
    var csvContent = '\uFEFF';
    csvContent += 'Sl No,Customer Name,Phone Number,Email,Offer Won,Coupon Code,Status,Scratched Date & Time (IST)\r\n';

    leadsToExport.forEach(function(l, idx) {
        var escapeCsv = function(val) {
            if (val === null || val === undefined) return '""';
            var s = String(val).replace(/"/g, '""');
            return '"' + s + '"';
        };

        var row = [
            idx + 1,
            escapeCsv(l.customer_name),
            '="' + (l.customer_phone || '') + '"', // Forces Excel to format phone as plain text string
            escapeCsv(l.customer_email || 'N/A'),
            escapeCsv(l.offer_won || (currentModalCard ? currentModalCard.offer_text : 'N/A')),
            escapeCsv(l.coupon_code || 'N/A'),
            escapeCsv(l.status),
            escapeCsv(l.date_time)
        ];
        csvContent += row.join(',') + '\r\n';
    });

    var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    var link = document.createElement('a');
    var url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function exportSelectedOnlyExcel() {
    exportCardLeadsExcel();
}

// Export PDF (Filtered or Selected via Backend DomPDF)
function exportCardLeadsPdf() {
    if (!currentModalCardId) return;

    var url = new URL('{{ url("admin/scratch_cards/leads/export_card_pdf") }}/' + currentModalCardId, window.location.origin);

    if (selectedModalLeadIds.size > 0) {
        url.searchParams.append('ids', Array.from(selectedModalLeadIds).join(','));
    } else {
        var fromDate = document.getElementById('modalFilterFromDate').value;
        var toDate = document.getElementById('modalFilterToDate').value;
        var status = document.getElementById('modalFilterStatus').value;
        var search = (document.getElementById('modalFilterSearch').value || '').trim();

        if (fromDate) url.searchParams.append('from_date', fromDate);
        if (toDate) url.searchParams.append('to_date', toDate);
        if (status) url.searchParams.append('status', status);
        if (search) url.searchParams.append('search', search);
    }

    window.open(url.toString(), '_blank');
}

function exportSelectedOnlyPdf() {
    exportCardLeadsPdf();
}

// Print Leads Report
function printModalLeads() {
    var leadsToPrint = (selectedModalLeadIds.size > 0)
        ? modalAllLeads.filter(l => selectedModalLeadIds.has(l.id))
        : modalFilteredLeads;

    var cardTitle = currentModalCard ? (currentModalCard.title || 'Scratch Card') : 'Scratch Card';
    var offerText = currentModalCard ? (currentModalCard.offer_text || '') : '';
    var couponCode = currentModalCard ? (currentModalCard.coupon_code || '') : '';

    var printWin = window.open('', '_blank', 'width=1000,height=750');
    var html = '<!DOCTYPE html><html><head><title>Leads Report - ' + cardTitle + '</title>' +
        '<style>' +
            'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; color: #1e293b; padding: 24px; font-size: 12px; }' +
            'h2 { margin: 0 0 4px 0; color: #1e40af; }' +
            '.meta { color: #64748b; font-size: 11px; margin-bottom: 16px; border-bottom: 1px solid #cbd5e1; padding-bottom: 10px; }' +
            '.card-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px; margin-bottom: 16px; }' +
            'table { width: 100%; border-collapse: collapse; margin-top: 10px; }' +
            'th { background: #1e293b; color: white; text-align: left; padding: 7px 8px; font-size: 10px; text-transform: uppercase; }' +
            'td { padding: 7px 8px; border-bottom: 1px solid #e2e8f0; font-size: 11px; }' +
            'tr:nth-child(even) { background: #f8fafc; }' +
            '.badge { display: inline-block; padding: 2px 7px; border-radius: 4px; font-size: 9px; font-weight: bold; text-transform: uppercase; }' +
            '.badge-claimed { background: #fef3c7; color: #b45309; }' +
            '.badge-redeemed { background: #d1fae5; color: #065f46; }' +
        '</style>' +
    '</head><body>' +
        '<h2>AskReview &mdash; Scratch Card Customer Leads</h2>' +
        '<div class="meta">Generated: ' + (new Date().toLocaleString('en-IN', { timeZone: 'Asia/Kolkata' })) + ' (IST) &bull; Total Records: ' + leadsToPrint.length + '</div>' +
        '<div class="card-box">' +
            '<strong>Card:</strong> ' + cardTitle + ' | <strong>Offer:</strong> ' + (offerText || 'N/A') + ' | <strong>Default Code:</strong> ' + (couponCode || 'N/A') +
        '</div>' +
        '<table><thead><tr>' +
            '<th style="width: 35px;">#</th><th>Customer Name</th><th>Phone Number</th><th>Email</th><th>Coupon Code</th><th>Date & Time (IST)</th><th>Status</th>' +
        '</tr></thead><tbody>';

    leadsToPrint.forEach(function(l, i) {
        html += '<tr>' +
            '<td>' + (i + 1) + '</td>' +
            '<td><strong>' + l.customer_name + '</strong></td>' +
            '<td>' + l.customer_phone + '</td>' +
            '<td>' + (l.customer_email || '-') + '</td>' +
            '<td><span style="font-family: monospace; font-weight: bold;">' + (l.coupon_code || '-') + '</span></td>' +
            '<td>' + l.date_time + '</td>' +
            '<td><span class="badge badge-' + l.status + '">' + l.status + '</span></td>' +
        '</tr>';
    });

    html += '</tbody></table>' +
        '<div style="margin-top: 24px; font-size: 10px; color: #94a3b8; text-align: center;">AskReview &bull; Scratch Card Leads Report</div>' +
    '</body></html>';

    printWin.document.write(html);
    printWin.document.close();
    printWin.focus();
    setTimeout(function() {
        printWin.print();
        printWin.close();
    }, 500);
}

// 1-Click Copy Phone Number
function copyModalPhone(phone, btn) {
    if (!phone) return;
    navigator.clipboard.writeText(phone).then(function() {
        var old = btn.innerHTML;
        btn.innerHTML = '<i class="ti ti-check text-success"></i>';
        setTimeout(function() { btn.innerHTML = old; }, 1800);
    }).catch(function() {
        var el = document.createElement('input');
        el.value = phone;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        var old = btn.innerHTML;
        btn.innerHTML = '<i class="ti ti-check text-success"></i>';
        setTimeout(function() { btn.innerHTML = old; }, 1800);
    });
}

// 1-Click Copy Coupon Code
function copyModalCoupon(code, btn) {
    if (!code) return;
    navigator.clipboard.writeText(code).then(function() {
        var old = btn.innerHTML;
        btn.innerHTML = '<i class="ti ti-check text-success me-1"></i> Copied!';
        setTimeout(function() { btn.innerHTML = old; }, 1800);
    }).catch(function() {
        var el = document.createElement('input');
        el.value = code;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        var old = btn.innerHTML;
        btn.innerHTML = '<i class="ti ti-check text-success me-1"></i> Copied!';
        setTimeout(function() { btn.innerHTML = old; }, 1800);
    });
}

// Cannot delete scratch card popup logic
var currentCannotDeleteCardId = null;

function cannotDeleteCardWithLeads(cardId, cardTitle, leadsCount) {
    currentCannotDeleteCardId = cardId;
    var descEl = document.getElementById('cannotDeleteDesc');
    if (descEl) {
        descEl.innerHTML = 'Scratch card <strong>"' + cardTitle + '"</strong> currently has <strong>' + leadsCount + ' customer lead(s)</strong>.<br>Cards with active leads cannot be deleted. First delete the leads, then you can delete the scratch card.';
    }
    var purgeForm = document.getElementById('cannotDeletePurgeForm');
    if (purgeForm) {
        purgeForm.action = '{{ url("admin/scratch_cards/leads/delete_all_for_card") }}/' + cardId;
    }

    var modal = new bootstrap.Modal(document.getElementById('cannotDeleteModal'));
    modal.show();
}

function viewCardLeadsFromCannotDelete() {
    var cannotModalEl = document.getElementById('cannotDeleteModal');
    var cannotModal = bootstrap.Modal.getInstance(cannotModalEl);
    if (cannotModal) {
        cannotModal.hide();
    }
    if (currentCannotDeleteCardId) {
        openCardAnalyticsModal(currentCannotDeleteCardId);
    }
}

// Toggle lead status via AJAX
function toggleLeadStatus(leadId, newStatus) {
    fetch('{{ route("scratch_cards.update_lead_status") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ lead_id: leadId, status: newStatus })
    })
    .then(r => r.json())
    .then(data => {
        if(data.success) {
            const badge = document.getElementById('leadStatusBadge' + leadId);
            const btn = document.getElementById('leadBtn' + leadId);
            
            if(data.status === 'redeemed') {
                badge.className = 'badge bg-success text-capitalize px-2.5 py-1 rounded-pill';
                badge.innerText = 'Redeemed';
                btn.innerHTML = '<i class="ti ti-arrow-back-up me-1"></i> Mark Claimed';
                btn.setAttribute('onclick', `toggleLeadStatus(${leadId}, 'claimed')`);
            } else {
                badge.className = 'badge bg-warning text-dark text-capitalize px-2.5 py-1 rounded-pill';
                badge.innerText = 'Claimed';
                btn.innerHTML = '<i class="ti ti-check me-1"></i> Mark Redeemed';
                btn.setAttribute('onclick', `toggleLeadStatus(${leadId}, 'redeemed')`);
            }
        }
    })
    .catch(e => console.error(e));
}
</script>

@endsection
