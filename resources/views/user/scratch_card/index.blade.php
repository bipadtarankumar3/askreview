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
</style>

<div class="container-fluid px-4 py-3">

    <!-- ── HERO BANNER ── -->
    <div class="scratch-hero-card">
        <div class="row align-items-center">
            <div class="col-lg-8 col-12">
                <span class="badge mb-2 px-3 py-1.5 text-uppercase fw-bold" style="background: rgba(245, 158, 11, 0.2); color: #fef08a; border: 1px solid rgba(245, 158, 11, 0.35); font-size: 0.72rem; letter-spacing: 0.06em;">
                    <i class="ti ti-gift me-1"></i> Interactive Gamified Lead Magnet
                </span>
                <h2 class="fw-bold mb-2 text-white" style="letter-spacing: -0.02em;">Scratch &amp; Win Reward Cards</h2>
                <p class="text-white-50 mb-3" style="font-size: 0.95rem; max-width: 650px;">
                    Boost customer engagement and collect high-intent leads on your public review page. Customers scratch an authentic foil card with sound effects, reveal your reward image &amp; coupon, and claim it with their contact details.
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
                <button type="button" class="btn btn-warning fw-bold px-4 py-2.5 me-2" data-bs-toggle="modal" data-bs-target="#createScratchModal" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);">
                    <i class="ti ti-plus me-1"></i> Create Scratch Card
                </button>
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

        <!-- ── NAVIGATION TABS (CARDS vs LEADS) ── -->
        <ul class="nav nav-pills mb-4 gap-2" id="scratchTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold px-4 py-2" id="cards-tab" data-bs-toggle="pill" data-bs-target="#cards-content" type="button" role="tab" style="border-radius: 12px;">
                    <i class="ti ti-cards me-1.5"></i> My Scratch Cards ({{ $cards->count() }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-4 py-2" id="leads-tab" data-bs-toggle="pill" data-bs-target="#leads-content" type="button" role="tab" style="border-radius: 12px;">
                    <i class="ti ti-users me-1.5"></i> Customer Submissions &amp; Leads ({{ $leads->total() }})
                </button>
            </li>
        </ul>

        <div class="tab-content" id="scratchTabsContent">
            
            <!-- ── TAB 1: SCRATCH CARDS MANAGEMENT ── -->
            <div class="tab-pane fade show active" id="cards-content" role="tabpanel">
                <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                    <div>
                        <h4 class="fw-bold text-slate-800 mb-0">Configured Scratch Cards</h4>
                        <small class="text-muted">You can create multiple scratch cards with custom images and offers, but only <strong>1 card can be active</strong> at a time.</small>
                    </div>
                    <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#createScratchModal" style="border-radius: 10px;">
                        <i class="ti ti-plus me-1"></i> Add Scratch Card
                    </button>
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
                                                <i class="ti ti-sparkles me-1"></i> {{ $c->title }}
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
                                            <div style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.85;">Secret Reward:</div>
                                            <h4 class="fw-bold mb-1 mt-0.5 text-white" style="letter-spacing: -0.01em;">{{ $c->offer_text }}</h4>
                                            @if($c->coupon_code)
                                                <span class="badge bg-white text-dark fw-bold px-2.5 py-0.5 font-monospace" style="font-size: 0.78rem;">
                                                    CODE: {{ $c->coupon_code }}
                                                </span>
                                            @endif
                                        </div>

                                        <div style="font-size: 0.72rem; opacity: 0.85; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                            {{ $c->description ?: 'Show this coupon code at counter to redeem.' }}
                                        </div>
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

                                            <a href="{{ route('scratch_cards.delete', $c->id) }}" onclick="return confirm('Are you sure you want to delete this scratch card?')" class="btn btn-outline-danger btn-sm px-2.5 py-1.5" style="border-radius: 8px;" title="Delete Card">
                                                <i class="ti ti-trash fs-5"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- ── TAB 2: CUSTOMER LEADS SUBMISSIONS TABLE ── -->
            <div class="tab-pane fade" id="leads-content" role="tabpanel">
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
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleLeadStatus({{ $lead->id }}, '{{ $lead->status === 'redeemed' ? 'claimed' : 'redeemed' }}')" id="leadBtn{{ $lead->id }}">
                                                @if($lead->status === 'redeemed')
                                                    <i class="ti ti-arrow-back-up me-1"></i> Mark Claimed
                                                @else
                                                    <i class="ti ti-check me-1"></i> Mark Redeemed
                                                @endif
                                            </button>
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
                        <label class="form-label fw-bold small text-muted">Offer Title / Campaign Name <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="cardTitle" class="form-control" placeholder="e.g. Weekend Surprise Treat" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Prize / Reward Won Text <span class="text-danger">*</span></label>
                        <input type="text" name="offer_text" id="cardOfferText" class="form-control" placeholder="e.g. Flat 20% OFF or Free Coffee" required>
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

<!-- ── CARD-WISE DEEP ANALYTICS & LEADS MODAL ── -->
<div class="modal fade" id="cardAnalyticsModal" tabindex="-1" aria-labelledby="cardAnalyticsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header border-0 pb-0" style="background: #f8fafc; padding: 20px 24px;">
                <div>
                    <span class="badge bg-primary px-2.5 py-1 text-uppercase" id="modalCardThemeBadge" style="font-size: 0.68rem;">Theme</span>
                    <h4 class="fw-bold text-dark mt-1 mb-0" id="modalCardTitle">Scratch Card Details</h4>
                    <small class="text-muted" id="modalCardCreated">Created on ...</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Card Metrics Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-3">
                        <div class="p-3 text-center rounded border" style="background: #fffbeb;">
                            <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Scratches</div>
                            <h3 class="fw-bold mb-0 text-warning" id="modalStatScratches">0</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="p-3 text-center rounded border" style="background: #eff6ff;">
                            <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Total Leads</div>
                            <h3 class="fw-bold mb-0 text-primary" id="modalStatLeads">0</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="p-3 text-center rounded border" style="background: #ecfdf5;">
                            <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Claimed</div>
                            <h3 class="fw-bold mb-0 text-success" id="modalStatClaimed">0</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="p-3 text-center rounded border" style="background: #faf5ff;">
                            <div class="text-muted small fw-bold text-uppercase" style="font-size: 0.7rem;">Redeemed</div>
                            <h3 class="fw-bold mb-0 text-purple" style="color: #9333ea;" id="modalStatRedeemed">0</h3>
                        </div>
                    </div>
                </div>

                <!-- Card Details Snippet -->
                <div class="p-3 rounded border mb-4 d-flex align-items-center justify-content-between" style="background: #f8fafc;">
                    <div class="d-flex align-items-center gap-3">
                        <div id="modalCardImageWrap"></div>
                        <div>
                            <div class="fw-bold fs-5 text-dark" id="modalCardOfferText">...</div>
                            <div class="text-muted small" id="modalCardCouponWrap"></div>
                        </div>
                    </div>
                    <div id="modalCardStatusWrap"></div>
                </div>

                <!-- Customer Submissions Table with exact Date & Time -->
                <h5 class="fw-bold text-dark mb-2">Customers Who Scratched This Card</h5>
                <div class="table-responsive" style="max-height: 280px; overflow-y: auto;">
                    <table class="table table-sm table-modern align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Phone &amp; WhatsApp</th>
                                <th>Coupon</th>
                                <th>Date &amp; Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="modalCardLeadsTbody">
                            <!-- Populated via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 bg-light">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Close</button>
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
    document.getElementById('cardTitle').value = card.title;
    document.getElementById('cardOfferText').value = card.offer_text;
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

// Open Card Analytics & Leads Breakdown Modal
function openCardAnalyticsModal(cardId) {
    fetch('{{ url("admin/scratch_cards/analytics") }}/' + cardId)
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                var card = res.card;
                var leads = res.leads;

                document.getElementById('modalCardThemeBadge').innerText = card.card_theme + ' Theme';
                document.getElementById('modalCardTitle').innerText = card.title;
                document.getElementById('modalCardCreated').innerText = 'Created on ' + card.created_at;
                document.getElementById('modalStatScratches').innerText = card.scratch_count;
                document.getElementById('modalStatLeads').innerText = card.leads_count;
                document.getElementById('modalStatClaimed').innerText = card.claimed_count;
                document.getElementById('modalStatRedeemed').innerText = card.redeemed_count;

                document.getElementById('modalCardOfferText').innerText = card.offer_text;
                document.getElementById('modalCardCouponWrap').innerHTML = card.coupon_code 
                    ? '<span class="badge bg-primary font-monospace">CODE: ' + card.coupon_code + '</span>' 
                    : '<span class="text-muted">No coupon code</span>';

                var imgWrap = document.getElementById('modalCardImageWrap');
                if (card.image) {
                    imgWrap.innerHTML = '<img src="' + card.image + '" style="width: 52px; height: 52px; object-fit: cover; border-radius: 10px; border: 1.5px solid #cbd5e1;">';
                } else {
                    imgWrap.innerHTML = '<div style="width: 52px; height: 52px; border-radius: 10px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;"><i class="ti ti-gift"></i></div>';
                }

                document.getElementById('modalCardStatusWrap').innerHTML = (card.status === 'active')
                    ? '<span class="badge bg-success px-3 py-1.5"><span class="pulse-active-dot me-1"></span> LIVE ON PAGE</span>'
                    : '<span class="badge bg-secondary px-3 py-1.5">Inactive</span>';

                // Leads list table
                var tbody = document.getElementById('modalCardLeadsTbody');
                if (leads.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">No customers have scratched this card yet.</td></tr>';
                } else {
                    var html = '';
                    leads.forEach(function(l) {
                        var phoneNum = l.customer_phone ? l.customer_phone.replace(/[^0-9]/g, '') : '';
                        html += '<tr>' +
                            '<td><strong>' + l.customer_name + '</strong>' + (l.customer_email ? '<div class="small text-muted">' + l.customer_email + '</div>' : '') + '</td>' +
                            '<td>' +
                                '<div class="small text-dark">' + l.customer_phone + '</div>' +
                                (phoneNum ? '<a href="https://wa.me/' + phoneNum + '" target="_blank" class="badge bg-success text-white text-decoration-none mt-0.5"><i class="ti ti-brand-whatsapp"></i> WhatsApp</a>' : '') +
                            '</td>' +
                            '<td><span class="font-monospace fw-bold text-primary">' + (l.coupon_code || '-') + '</span></td>' +
                            '<td><div class="fw-bold small">' + l.date_time + '</div><div class="text-muted" style="font-size: 0.72rem;">' + l.date_relative + '</div></td>' +
                            '<td><span class="badge ' + (l.status === 'redeemed' ? 'bg-success' : 'bg-warning text-dark') + ' text-capitalize">' + l.status + '</span></td>' +
                        '</tr>';
                    });
                    tbody.innerHTML = html;
                }

                var modal = new bootstrap.Modal(document.getElementById('cardAnalyticsModal'));
                modal.show();
            } else {
                alert('Failed to load card details.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error loading card analytics.');
        });
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
