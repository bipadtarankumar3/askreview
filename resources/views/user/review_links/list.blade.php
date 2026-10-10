@extends('adminLayouts.home')
@section('content')

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<style>
    /* Google Autocomplete input */
    .controls {
        background-color: #fff;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        box-sizing: border-box;
        font-family: inherit;
        font-size: 14px;
        height: 38px;
        outline: none;
        padding: 0 14px;
        text-overflow: ellipsis;
        width: 100%;
        max-width: 420px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .controls:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    /* ── Integrations Hub Design System ── */
    :root {
        --int-primary: #2563eb;
        --int-primary-hover: #1d4ed8;
        --int-surface: #ffffff;
        --int-border: rgba(226, 232, 240, 0.85);
        --int-text-main: #0f172a;
        --int-text-muted: #64748b;
    }

    /* Hero Header Card */
    .integration-hero-card {
        border-radius: 20px;
        background: linear-gradient(135deg, #0b1329 0%, #172554 48%, #0f172a 100%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 12px 36px -8px rgba(15, 23, 42, 0.35);
        border: 1px solid rgba(255, 255, 255, 0.08);
        margin-bottom: 24px;
        padding: 28px 30px;
    }
    .integration-hero-card::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 420px;
        height: 420px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, rgba(99, 102, 241, 0.1) 40%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }
    .integration-hero-card::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: 20%;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 60%);
        pointer-events: none;
        z-index: 0;
    }
    .integration-hero-content {
        position: relative;
        z-index: 1;
    }
    .integration-tag-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.16);
        color: #93c5fd;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 9999px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 12px;
    }
    .hero-stat-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(15, 23, 42, 0.55);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        padding: 8px 16px;
        border-radius: 9999px;
        font-size: 0.82rem;
        color: #e2e8f0;
        font-weight: 600;
    }
    .pulse-dot-green {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
        animation: pulseGreen 2s infinite;
        display: inline-block;
    }
    @keyframes pulseGreen {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    /* Search & Filter Toolbar */
    .filter-search-toolbar {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 12px 18px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .filter-pill-nav {
        display: flex;
        align-items: center;
        gap: 6px;
        overflow-x: auto;
        padding-bottom: 2px;
        -webkit-overflow-scrolling: touch;
    }
    .filter-pill-nav::-webkit-scrollbar {
        height: 0px;
    }
    .filter-pill-btn {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 9999px;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .filter-pill-btn:hover {
        background: #f1f5f9;
        color: #0f172a;
        border-color: #cbd5e1;
    }
    .filter-pill-btn.active {
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 3px 10px rgba(37, 99, 235, 0.25);
    }
    .filter-pill-btn .pill-counter {
        background: rgba(0, 0, 0, 0.08);
        padding: 1px 7px;
        border-radius: 9999px;
        font-size: 0.72rem;
    }
    .filter-pill-btn.active .pill-counter {
        background: rgba(255, 255, 255, 0.25);
        color: #ffffff;
    }

    .search-input-wrapper {
        position: relative;
        min-width: 240px;
        flex: 1;
        max-width: 320px;
    }
    .search-input-wrapper i.search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.95rem;
    }
    .search-input-wrapper input {
        width: 100%;
        padding: 7px 12px 7px 34px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        font-size: 0.82rem;
        color: #0f172a;
        outline: none;
        transition: all 0.2s ease;
    }
    .search-input-wrapper input:focus {
        background: #ffffff;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
    }

    /* Drag Hint Banner */
    .drag-hint-strip {
        background: #eff6ff;
        border: 1px dashed #bfdbfe;
        border-radius: 12px;
        padding: 10px 16px;
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #1e40af;
        font-size: 0.83rem;
        font-weight: 500;
    }
    .drag-hint-strip i {
        font-size: 1.15rem;
        color: #2563eb;
        flex-shrink: 0;
    }

    /* ── Modern Integration Card ── */
    .modern-integration-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid rgba(226, 232, 240, 0.9);
        box-shadow: 0 4px 18px -2px rgba(15, 23, 42, 0.05);
        transition: transform 0.24s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.24s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.24s;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        padding: 20px 20px 18px;
        overflow: hidden;
    }
    .modern-integration-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.12);
        border-color: #cbd5e1;
    }
    .modern-integration-card.card-connected {
        border-top: 3px solid #10b981;
    }
    .modern-integration-card.card-shield {
        border-top: 3px solid #8b5cf6;
    }
    .modern-integration-card.card-pro-feature,
    .modern-integration-card.card-pro-private {
        background: linear-gradient(180deg, #ffffff 0%, #faf5ff 100%);
        border: 1.5px solid #d8b4fe;
        border-top: 3.5px solid #8b5cf6;
        box-shadow: 0 6px 20px -3px rgba(139, 92, 246, 0.12);
        position: relative;
    }
    .modern-integration-card.card-pro-feature:hover,
    .modern-integration-card.card-pro-private:hover {
        border-color: #a855f7;
        box-shadow: 0 16px 36px -6px rgba(139, 92, 246, 0.22);
    }
    .pro-crown-badge {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #ffffff;
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        padding: 3px 8px;
        border-radius: 9999px;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        box-shadow: 0 2px 6px rgba(245, 158, 11, 0.25);
    }

    /* Drag handle badge */
    .drag-handle-badge {
        cursor: grab;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.7rem;
        font-weight: 700;
        color: #94a3b8;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 3px 8px;
        user-select: none;
        transition: all 0.2s ease;
    }
    .drag-handle-badge:hover {
        background: #f1f5f9;
        color: #475569;
        border-color: #cbd5e1;
    }
    .drag-handle-badge:active {
        cursor: grabbing;
    }

    /* Status Badges */
    .status-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 9999px;
        line-height: 1.2;
    }
    .status-badge-pill.status-connected {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }
    .status-badge-pill.status-inactive {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    .status-badge-pill.status-unconnected {
        background: #f8fafc;
        color: #94a3b8;
        border: 1px solid #e2e8f0;
    }
    .status-badge-pill.status-shield {
        background: #f5f3ff;
        color: #7c3aed;
        border: 1px solid #ddd6fe;
    }

    /* Brand Logo Squircle */
    .brand-logo-squircle {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 6px auto 14px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.04);
        position: relative;
        transition: transform 0.2s ease;
    }
    .modern-integration-card:hover .brand-logo-squircle {
        transform: scale(1.05);
    }
    .brand-logo-squircle img {
        width: 44px;
        height: 44px;
        object-fit: contain;
    }
    .brand-logo-squircle i {
        font-size: 38px;
    }

    /* Card Details */
    .card-title-platform {
        font-size: 1.05rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
        text-align: center;
    }
    .card-desc-platform {
        font-size: 0.78rem;
        color: #64748b;
        line-height: 1.45;
        text-align: center;
        margin-bottom: 16px;
        min-height: 36px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Action Buttons */
    .card-action-bar {
        border-top: 1px solid #f1f5f9;
        padding-top: 14px;
        margin-top: auto;
    }
    .btn-connect-action {
        width: 100%;
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        color: #1e293b;
        font-weight: 700;
        font-size: 0.82rem;
        border-radius: 10px;
        padding: 8px 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.2s ease;
    }
    .btn-connect-action:hover {
        background: #2563eb;
        border-color: #2563eb;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }

    .btn-configure-action {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.82rem;
        border-radius: 10px;
        padding: 8px 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2);
        transition: all 0.2s ease;
        flex: 1;
    }
    .btn-configure-action:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
    }

    .btn-test-link {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .btn-test-link:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        color: #2563eb;
    }

    .shield-badge-box {
        background: #f5f3ff;
        border: 1px solid #ddd6fe;
        color: #6d28d9;
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 0.78rem;
        font-weight: 600;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    /* Sortable drag state */
    .sortable-ghost-card {
        opacity: 0.45;
        border: 2px dashed #3b82f6 !important;
        background: #eff6ff !important;
    }
    .sortable-chosen-card {
        cursor: grabbing;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .integration-hero-card {
            padding: 20px 18px;
        }
        .filter-search-toolbar {
            flex-direction: column;
            align-items: stretch;
        }
        .search-input-wrapper {
            max-width: 100%;
        }
    }
</style>

<div class="container-fluid py-2">

    <!-- ── 1. HERO HEADER COMMAND CENTER ── -->
    <div class="integration-hero-card" id="integrationsHeroCard">
        <div class="integration-hero-content">
            <div class="row align-items-center g-3">
                <div class="col-lg-8 col-12">
                    <span class="integration-tag-badge">
                        <i class="ti ti-sparkles"></i> Review Command Center
                    </span>
                    <h2 class="fw-bold mb-2 text-white" style="font-size: 1.75rem; letter-spacing: -0.02em;">
                        Review Integrations &amp; Channels
                    </h2>
                    <p class="mb-3 text-slate-300" style="color: #cbd5e1; font-size: 0.92rem; line-height: 1.5; max-width: 680px;">
                        Connect your review platforms to turn happy customers into verified 5-star Google &amp; social reviews. Every channel activated here updates automatically across your smart QR standees and landing page.
                    </p>

                    <!-- Real-time Stats Strip -->
                    @php
                        $totalChannels = isset($integrationList) ? count($integrationList) : 8;
                        $connectedCount = 0;
                        if (isset($integrationList)) {
                            foreach ($integrationList as $itemCheck) {
                                if ($itemCheck->type == 'google' && (!empty($itemCheck->review_links) || !empty($itemCheck->place_id) || !empty($itemCheck->status))) $connectedCount++;
                                elseif ($itemCheck->type == 'record' && (($video_access_show == true || (Auth::check() && Auth::user()->video_access == 'YES')) && $itemCheck->status != 'inactive')) $connectedCount++;
                                elseif ($itemCheck->type != 'private' && (!empty($itemCheck->review_links) || !empty($itemCheck->status))) $connectedCount++;
                            }
                        }
                    @endphp
                    <div class="d-flex flex-wrap align-items-center gap-2 mt-2">
                        <div class="hero-stat-pill">
                            <span class="pulse-dot-green"></span>
                            <span><strong id="statConnectedCount">{{ $connectedCount }}</strong> / <span id="statTotalCount">{{ $totalChannels }}</span> Active Channels</span>
                        </div>
                        <div class="hero-stat-pill">
                            <i class="ti ti-shield-check" style="color: #a78bfa; font-size: 1rem;"></i>
                            <span>1–3★ Review Shield: <strong style="color: #a78bfa;">Active</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Right Action Buttons -->
                <div class="col-lg-4 col-12 text-lg-end">
                    <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                        <button type="button" class="btn btn-sm" id="btnRestartTour" onclick="startIntegrationsTour(true)" style="background: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.25); color: #ffffff; font-weight: 700; border-radius: 12px; padding: 9px 18px; font-size: 0.85rem; backdrop-filter: blur(8px); display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;">
                            <i class="ti ti-compass" style="font-size: 1.1rem; color: #93c5fd;"></i>
                            <span>Interactive Tour</span>
                        </button>
                        
                        @php
                            $publicFunnelUrl = (Auth::check() && !empty(Auth::user()->name_url)) ? url('u/'.Auth::user()->name_url) : '#';
                        @endphp
                        <a href="{{ $publicFunnelUrl }}" target="_blank" id="heroLiveReviewBtn" class="btn btn-sm" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; color: #ffffff; font-weight: 700; border-radius: 12px; padding: 9px 18px; font-size: 0.85rem; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35); display: inline-flex; align-items: center; gap: 6px; text-decoration: none; transition: all 0.2s;">
                            <span>Preview Funnel</span>
                            <i class="ti ti-external-link" style="font-size: 0.95rem;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── 2. SEARCH & FILTER TOOLBAR ── -->
    <div class="filter-search-toolbar">
        <!-- Filter Tabs -->
        <div class="filter-pill-nav" id="integrationFilterGroup">
            <button type="button" class="filter-pill-btn active" data-filter="all">
                <span>All Channels</span>
                <span class="pill-counter" id="pillCountAll">{{ $totalChannels }}</span>
            </button>
            <button type="button" class="filter-pill-btn" data-filter="connected">
                <i class="ti ti-circle-check" style="font-size: 0.85rem;"></i>
                <span>Connected</span>
                <span class="pill-counter" id="pillCountConnected">{{ $connectedCount }}</span>
            </button>
            <button type="button" class="filter-pill-btn" data-filter="review">
                <i class="ti ti-star" style="font-size: 0.85rem;"></i>
                <span>Direct Reviews</span>
            </button>
            <button type="button" class="filter-pill-btn" data-filter="social">
                <i class="ti ti-message-circle" style="font-size: 0.85rem;"></i>
                <span>Social &amp; Chat</span>
            </button>
            <button type="button" class="filter-pill-btn" data-filter="shield">
                <i class="ti ti-shield" style="font-size: 0.85rem;"></i>
                <span>Testimonial &amp; Shield</span>
            </button>
        </div>

        <!-- Live Search -->
        <div class="search-input-wrapper">
            <i class="ti ti-search search-icon"></i>
            <input type="text" id="searchIntegrations" placeholder="Search platforms (Google, WhatsApp...)" autocomplete="off">
        </div>
    </div>

    <!-- ── 3. REORDER PRO-TIP STRIP ── -->
    <div class="drag-hint-strip" id="dragReorderHint">
        <i class="ti ti-arrows-sort"></i>
        <div>
            <strong>Reorder Channels:</strong> Grab any card by the <span style="background: #ffffff; border: 1px solid #bfdbfe; border-radius: 4px; padding: 1px 6px; font-weight: 700; font-size: 0.75rem;">Drag</span> handle to change button priority. The channels you place first will receive the highest visibility and clicks on your public review page.
        </div>
    </div>

    <!-- ── 4. INTEGRATION CARDS CONTAINER ── -->
    <div id="integrationContainer" class="row">
        @php
            $typeMeta = [
                'google' => [
                    'title' => 'Google Reviews',
                    'desc' => 'Boost Google Maps ranking & search visibility with authentic 5-star customer ratings.',
                    'category' => 'review',
                    'tint' => '#ffffff',
                    'border' => '#e2e8f0',
                    'icon_class' => 'ti ti-brand-google',
                    'default_icon' => asset('frontend/images/google.png'),
                ],
                'facebook' => [
                    'title' => 'Facebook Recommendations',
                    'desc' => 'Drive social proof and word-of-mouth recommendations on Facebook.',
                    'category' => 'social',
                    'tint' => '#eff6ff',
                    'border' => '#dbeafe',
                    'icon_class' => 'ti ti-brand-facebook',
                    'default_icon' => asset('frontend/images/facebook.png'),
                ],
                'youtube' => [
                    'title' => 'YouTube Channel',
                    'desc' => 'Showcase video reviews, feature demos, and build your subscriber audience.',
                    'category' => 'social',
                    'tint' => '#fef2f2',
                    'border' => '#fee2e2',
                    'icon_class' => 'ti ti-brand-youtube',
                    'default_icon' => asset('frontend/images/youtube.png'),
                ],
                'instagram' => [
                    'title' => 'Instagram Profile',
                    'desc' => 'Direct happy customers to follow, tag your handle, and share stories.',
                    'category' => 'social',
                    'tint' => '#fdf2f8',
                    'border' => '#fce7f3',
                    'icon_class' => 'ti ti-brand-instagram',
                    'default_icon' => asset('frontend/images/instagram.png'),
                ],
                'whatsapp' => [
                    'title' => 'WhatsApp Chat',
                    'desc' => 'One-click instant messaging for personal customer support and inquiries.',
                    'category' => 'social',
                    'tint' => '#f0fdf4',
                    'border' => '#dcfce7',
                    'icon_class' => 'ti ti-brand-whatsapp',
                    'default_icon' => asset('frontend/images/whatsapp.png'),
                ],
                'record' => [
                    'title' => 'Video Testimonial',
                    'desc' => 'Collect authentic recorded video feedback directly from clients via smartphone.',
                    'category' => 'shield',
                    'tint' => '#f5f3ff',
                    'border' => '#ede9fe',
                    'icon_class' => 'ti ti-video',
                    'default_icon' => '',
                ],
                'private' => [
                    'title' => 'Private Feedback Shield',
                    'desc' => 'Intercepts 1-3 star reviews privately so you can resolve customer issues in secret.',
                    'category' => 'shield',
                    'tint' => '#faf5ff',
                    'border' => '#f3e8ff',
                    'icon_class' => 'ti ti-shield-check',
                    'default_icon' => '',
                ],
                'website' => [
                    'title' => 'Company Website',
                    'desc' => 'Direct high-intent customer traffic to your official landing page or store.',
                    'category' => 'review',
                    'tint' => '#f0f9ff',
                    'border' => '#e0f2fe',
                    'icon_class' => 'ti ti-world',
                    'default_icon' => asset('frontend/images/website.png'),
                ],
            ];
        @endphp

        @if (isset($integrationList) && count($integrationList) > 0)
            @if (isset($integrationList[0]))
                @foreach ($integrationList as $item)
                    @php
                        $hasVideoAccess = ($video_access_show == true || (Auth::check() && Auth::user()->video_access == 'YES'));
                        $hasPrivateAccess = ($has_private_access ?? false);
                        $isPrivateActive = ($hasPrivateAccess && (Auth::user()->private_feedback ?? 'yes') == 'yes' && $item->status != 'inactive');
                        $isConfigured = false;
                        if ($item->type == 'google') {
                            $isConfigured = (!empty($item->review_links) || !empty($item->place_id) || !empty($item->status));
                        } elseif ($item->type == 'record') {
                            $isConfigured = $hasVideoAccess && ($item->status != 'inactive');
                        } elseif ($item->type == 'private') {
                            $isConfigured = $isPrivateActive;
                        } else {
                            $isConfigured = (!empty($item->review_links) || !empty($item->status));
                        }

                        $meta = $typeMeta[$item->type] ?? [
                            'title' => $item->button_name,
                            'desc' => 'Collect customer feedback and reviews through ' . $item->button_name . '.',
                            'category' => 'social',
                            'tint' => '#f8fafc',
                            'border' => '#e2e8f0',
                            'icon_class' => 'ti ti-external-link',
                            'default_icon' => $item->button_icon,
                        ];
                        $cardCategory = $meta['category'];
                        $isInactive = ($item->status == 'inactive');
                    @endphp

                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4 drag-item integration-item-card"
                         id="dragbble_{{$item->id}}"
                         data-order="{{$item->button_order}}"
                         data-type="{{$item->type}}"
                         data-category="{{$cardCategory}}"
                         data-name="{{ strtolower($meta['title']) }}"
                         data-status="{{ ($item->type == 'private') ? ($isPrivateActive ? 'connected' : 'inactive') : ($isConfigured ? 'connected' : 'unconnected') }}">

                        @php
                            $isProCard = ($item->type == 'record' || $item->type == 'private');
                        @endphp
                        <div class="modern-integration-card {{ $isProCard ? 'card-pro-feature' : ($isConfigured ? 'card-connected' : '') }}">
                            <!-- Top Bar: Drag Handle + Status Badge -->
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="drag-handle-badge" title="Click and drag to reorder">
                                    <i class="ti ti-grip-vertical"></i> Drag
                                </span>

                                @if ($item->type == 'private')
                                    @if ($hasPrivateAccess)
                                        @if ($isPrivateActive)
                                            <span class="status-badge-pill status-connected" style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;" title="Shield is active on customer review page">
                                                <span class="pulse-dot-green"></span> Pro Shield
                                            </span>
                                        @else
                                            <span class="status-badge-pill status-inactive" title="Shield is currently disabled">
                                                <i class="ti ti-circle-x"></i> Inactive
                                            </span>
                                        @endif
                                    @else
                                        <span class="status-badge-pill status-unconnected" style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a;" title="Exclusive to Pro & Premium plans">
                                            <i class="fa fa-crown text-warning"></i> Pro / Premium
                                        </span>
                                    @endif
                                @elseif ($item->type == 'record')
                                    @if ($hasVideoAccess && !$isInactive)
                                        <span class="status-badge-pill status-connected" style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;" title="Video access enabled and live">
                                            <span class="pulse-dot-green"></span> Pro Active
                                        </span>
                                    @elseif ($isInactive)
                                        <span class="status-badge-pill status-inactive" title="Channel is disabled">
                                            <i class="ti ti-circle-x"></i> Inactive
                                        </span>
                                    @else
                                        <span class="status-badge-pill status-unconnected" style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a;" title="Exclusive to Pro & Premium plans">
                                            <i class="fa fa-crown text-warning"></i> Pro / Premium
                                        </span>
                                    @endif
                                @elseif ($isConfigured)
                                    @if ($isInactive)
                                        <span class="status-badge-pill status-inactive" title="Channel is disabled">
                                            <i class="ti ti-circle-x"></i> Inactive
                                        </span>
                                    @else
                                        <span class="status-badge-pill status-connected" title="Channel is live and configured">
                                            <span class="pulse-dot-green"></span> Connected
                                        </span>
                                    @endif
                                @else
                                    <span class="status-badge-pill status-unconnected">
                                        Not Connected
                                    </span>
                                @endif
                            </div>

                            <!-- Squircle Logo Badge -->
                            <div class="brand-logo-squircle" style="background: {{ $meta['tint'] }}; border: 1.5px solid {{ $meta['border'] }};">
                                @if ($item->type == 'record')
                                    <div style="position: relative; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-video" style="color: #7c3aed; font-size: 30px;"></i>
                                        <span style="position: absolute; top: -7px; right: -8px; font-size: 13px; color: #f59e0b;" title="Pro Feature"><i class="fa fa-crown"></i></span>
                                    </div>
                                @elseif ($item->type == 'private')
                                    <div style="position: relative; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-shield-halved" style="color: #7c3aed; font-size: 30px;"></i>
                                        <span style="position: absolute; top: -7px; right: -8px; font-size: 13px; color: #f59e0b;" title="Pro Feature"><i class="fa fa-crown"></i></span>
                                    </div>
                                @elseif (!empty($item->button_icon))
                                    <img src="{{ $item->button_icon }}" alt="{{ $meta['title'] }}" loading="lazy">
                                @elseif (!empty($meta['default_icon']))
                                    <img src="{{ $meta['default_icon'] }}" alt="{{ $meta['title'] }}" loading="lazy">
                                @else
                                    <i class="{{ $meta['icon_class'] }}" style="font-size: 32px; color: #3b82f6;"></i>
                                @endif
                            </div>

                            <!-- Platform Details -->
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <h5 class="card-title-platform mb-0">{{ $meta['title'] }}</h5>
                                @if($isProCard)
                                    <span class="pro-crown-badge"><i class="fa fa-crown"></i> PRO</span>
                                @endif
                            </div>
                            <p class="card-desc-platform">{{ $meta['desc'] }}</p>

                            <!-- Bottom Action Row -->
                            <div class="card-action-bar">
                                @if ($item->type == 'google')
                                    @if ($isConfigured)
                                        <div class="d-flex align-items-center gap-2">
                                            @if (!empty($item->review_links))
                                                <a href="{{ $item->review_links }}" target="_blank" class="btn-test-link" title="Test destination review link">
                                                    <i class="ti ti-external-link"></i>
                                                </a>
                                            @endif
                                            <button type="button" class="btn-configure-action" onclick="open_integration_remove_model('google')">
                                                <i class="ti ti-settings"></i> Configure
                                            </button>
                                        </div>
                                    @else
                                        <button type="button" class="btn-connect-action" onclick="open_integration_model('google')">
                                            <i class="ti ti-plus"></i> Connect Google
                                        </button>
                                    @endif

                                @elseif ($item->type == 'record')
                                    @if ($hasVideoAccess)
                                        <div class="d-flex align-items-center gap-2 w-100">
                                            <div class="btn btn-sm flex-fill fw-bold py-1.5 d-flex align-items-center justify-content-center gap-1.5" style="border-radius: 8px; font-size: 0.78rem; background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                                <i class="ti ti-circle-check"></i> Pro Active
                                            </div>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="add_spinner_btn('record')" title="Video Testimonial Settings" style="border-radius: 8px; width: 36px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="ti ti-settings fs-5"></i>
                                            </button>
                                        </div>
                                    @else
                                        <div class="shield-badge-box w-100" style="background: #f8fafc; border: 1px solid #e2e8f0; color: #94a3b8;">
                                            <i class="ti ti-lock"></i> Video Access Disabled by Admin
                                        </div>
                                    @endif

                                @elseif ($item->type == 'private')
                                    @if ($hasPrivateAccess)
                                        <div class="d-flex align-items-center gap-2 w-100">
                                            @if ($isPrivateActive)
                                                <button type="button" class="btn btn-outline-danger btn-sm flex-fill fw-bold py-1.5" style="border-radius: 8px; font-size: 0.78rem;" onclick="quickTogglePrivateFeedback('no')" title="Deactivate Private Feedback">
                                                    <i class="fa fa-power-off me-1"></i> Deactivate
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-success btn-sm flex-fill fw-bold py-1.5" style="border-radius: 8px; font-size: 0.78rem;" onclick="quickTogglePrivateFeedback('yes')" title="Activate Private Feedback">
                                                    <i class="fa fa-check me-1"></i> Activate
                                                </button>
                                            @endif
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="open_private_feedback_modal()" title="Customize Message & Settings" style="border-radius: 8px; width: 36px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="ti ti-settings fs-5"></i>
                                            </button>
                                        </div>
                                    @else
                                        <button type="button" class="btn btn-sm w-100 fw-bold d-flex align-items-center justify-content-center gap-1.5 shadow-sm py-2" style="background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%); color: #ffffff; border: none; border-radius: 8px; font-size: 0.78rem;" onclick="promptPrivateUpgrade()">
                                            <i class="fa fa-crown text-warning"></i>
                                            <span>Upgrade to Unlock Shield</span>
                                        </button>
                                    @endif

                                @else
                                    @if ($isConfigured)
                                        <div class="d-flex align-items-center gap-2">
                                            @if (!empty($item->review_links))
                                                <a href="{{ $item->review_links }}" target="_blank" class="btn-test-link" title="Test destination review link">
                                                    <i class="ti ti-external-link"></i>
                                                </a>
                                            @endif
                                            <button type="button" class="btn-configure-action" onclick="add_spinner_btn('{{$item->type}}')">
                                                <i class="ti ti-settings"></i> Configure
                                            </button>
                                        </div>
                                    @else
                                        <button type="button" class="btn-connect-action" onclick="add_spinner_btn('{{$item->type}}')">
                                            <i class="ti ti-plus"></i> Connect {{ $item->button_name }}
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        @else
            <!-- Fallback empty state -->
            <div class="col-12 py-5 text-center">
                <div style="width: 80px; height: 80px; border-radius: 20px; background: #eff6ff; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <i class="ti ti-plug-connected" style="font-size: 38px; color: #2563eb;"></i>
                </div>
                <h4 class="fw-bold mb-2">No Review Integrations Found</h4>
                <p class="text-muted mb-4" style="max-width: 450px; margin: 0 auto;">Initialize your standard review platforms with one click to start collecting customer ratings.</p>
                <button class="btn btn-primary px-4 py-2" style="border-radius: 12px; font-weight: 700;" onclick="integration_start()">
                    <i class="ti ti-rocket me-1"></i> Initialize Review Channels
                </button>
            </div>
        @endif
    </div>

    <!-- Empty Search State (hidden by default) -->
    <div id="noIntegrationsFoundState" class="col-12 py-5 text-center" style="display: none;">
        <div style="width: 72px; height: 72px; border-radius: 18px; background: #f8fafc; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 14px;">
            <i class="ti ti-search" style="font-size: 32px; color: #94a3b8;"></i>
        </div>
        <h5 class="fw-bold mb-1" style="color: #0f172a;">No Matching Platforms Found</h5>
        <p class="text-muted mb-3" style="font-size: 0.85rem;">Try adjusting your search keyword or clearing the category filter.</p>
        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="resetIntegrationFilters()" style="border-radius: 8px; font-weight: 600;">
            Clear Search &amp; Filters
        </button>
    </div>

</div>

<!-- ── MODALS (Google Connect, Remove, Spinner) ── -->
<div class="modal fade bd-example-modal-lg" id="integration_add_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 25px 60px rgba(15,23,42,0.2); overflow: hidden;">
            <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
                <div class="d-flex align-items-center gap-2">
                    <img src="{{asset('frontend/images/google.png')}}" width="28px" alt="Google">
                    <h5 class="modal-title fw-bold mb-0" style="color: #0f172a; font-size: 1.15rem;">Connect Google Business Profile</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="hide_modal()"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div style="max-width: 540px; margin: 0 auto;">
                    <div style="width: 80px; height: 80px; border-radius: 20px; background: #ffffff; border: 1.5px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(66, 133, 244, 0.18); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                        <img src="{{asset('frontend/images/google.png')}}" width="48px" alt="Google">
                    </div>
                    <h4 class="fw-bold mb-2" style="color: #0f172a;">Search &amp; Link Your Google Place</h4>
                    <p class="text-muted mb-4" style="font-size: 0.88rem; line-height: 1.5;">Type your business or store name below as it appears on Google Maps. Once selected, your customer review funnel will direct users straight to your official 5-star Google review box!</p>

                    <div class="mb-3">
                        <input id="pac-input" class="controls" type="text" placeholder="Search your business name on Google Maps..." style="max-width: 100%; border-radius: 12px; height: 46px; font-size: 0.92rem; padding: 0 16px;">
                    </div>

                    <button class="btn btn-success integrate_button py-2 px-4 mt-2" style="display: none; border-radius: 12px; font-weight: 700; font-size: 0.95rem; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);" onclick="sendResult('google')">
                        <i class="ti ti-check me-1"></i> Connect Selected Business
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="integration_remove_modal" tabindex="-1" role="dialog" aria-labelledby="integrationRemoveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 720px;">
        <div class="modal-content integration_remove_modal_body" style="border-radius: 20px; border: none; box-shadow: 0 25px 60px rgba(15,23,42,0.2); overflow: hidden;">
            <!-- Rendered dynamically via AJAX -->
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="add_spinner_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 25px 60px rgba(15,23,42,0.2); overflow: hidden;">
            <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
                <h5 class="modal-title fw-bold" id="exampleModalLabel" style="font-size: 1.15rem; color: #0f172a;">Platform Channel Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="hide_modal()"></button>
            </div>
            <div class="modal-body spinner_body p-4">
                <!-- Rendered dynamically via AJAX -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="private_feedback_modal" tabindex="-1" role="dialog" aria-labelledby="privateFeedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 780px;">
        <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 25px 60px rgba(15,23,42,0.25); overflow: hidden; background: #ffffff;">
            <div class="modal-header d-flex align-items-center justify-content-between" style="border-bottom: 1px solid #f1f5f9; padding: 22px 28px; background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #7c3aed, #9333ea); display: flex; align-items: center; justify-content: center; color: #fff; box-shadow: 0 6px 16px rgba(124,58,237,0.3);">
                        <i class="ti ti-shield-lock" style="font-size: 24px;"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="modal-title fw-bold mb-0" id="privateFeedbackModalLabel" style="font-size: 1.15rem; color: #0f172a;">Private Feedback Shield Settings</h5>
                            <span class="badge" style="background: linear-gradient(135deg, #7c3aed, #6d28d9); color: #fff; font-size: 0.7rem; font-weight: 700; padding: 4px 8px; border-radius: 20px;"><i class="fa fa-crown text-warning me-1"></i> PRO</span>
                        </div>
                        <small class="text-muted" style="font-size: 0.8rem;">Intercept low customer reviews and capture private feedback</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="hide_modal()"></button>
            </div>
            <div class="modal-body p-4" style="background: #ffffff;">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark mb-2" style="font-size: 0.88rem;">Shield Status</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="w-100 p-3 rounded-3 border position-relative cursor-pointer" style="cursor: pointer; transition: all 0.2s;" id="label_shield_active">
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="radio" name="modal_private_feedback_status" id="shield_status_yes" value="yes" {{ (Auth::user()->private_feedback ?? 'yes') == 'yes' ? 'checked' : '' }} onchange="updateShieldPreviewState()">
                                            <label class="form-check-label fw-bold ms-1" for="shield_status_yes" style="cursor: pointer; color: #059669;">
                                                <i class="fa fa-check-circle me-1"></i> Active
                                            </label>
                                        </div>
                                        <small class="text-muted d-block mt-1 ps-4" style="font-size: 0.74rem; line-height: 1.3;">Enable shield for low ratings</small>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label class="w-100 p-3 rounded-3 border position-relative cursor-pointer" style="cursor: pointer; transition: all 0.2s;" id="label_shield_inactive">
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="radio" name="modal_private_feedback_status" id="shield_status_no" value="no" {{ (Auth::user()->private_feedback ?? 'yes') != 'yes' ? 'checked' : '' }} onchange="updateShieldPreviewState()">
                                            <label class="form-check-label fw-bold ms-1" for="shield_status_no" style="cursor: pointer; color: #64748b;">
                                                <i class="fa fa-times-circle me-1"></i> Inactive
                                            </label>
                                        </div>
                                        <small class="text-muted d-block mt-1 ps-4" style="font-size: 0.74rem; line-height: 1.3;">Disable private funnel</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark mb-1" style="font-size: 0.88rem;" for="modal_private_page_text">Customer Subtitle / Message</label>
                            <textarea class="form-control" id="modal_private_page_text" rows="3" style="border-radius: 12px; font-size: 0.88rem; padding: 12px; line-height: 1.5;" placeholder="Leave us a review, it will help us grow and better serve our customers like you." oninput="updateShieldPreviewText()">{{ Auth::user()->private_page_text ?? 'Leave us a review, it will help us grow and better serve our customers like you.' }}</textarea>
                            <small class="text-muted" style="font-size: 0.75rem;">Shown under "Private Message" on the customer form.</small>
                        </div>

                        <div class="p-3 rounded-3" style="background: #faf5ff; border: 1px dashed #c084fc;">
                            <div class="d-flex align-items-start gap-2">
                                <i class="fa fa-lightbulb text-warning mt-1" style="font-size: 1rem;"></i>
                                <div style="font-size: 0.78rem; color: #581c87; line-height: 1.45;">
                                    <strong>How Shield Works:</strong> Unhappy ratings are caught privately before reaching public review sites like Google or Facebook.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="text-muted fw-bold mb-2 text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.05em;">Live Form Preview</div>
                        <div class="p-3 rounded-4 shadow-sm" style="background: #ffffff; border: 1px solid #e2e8f0; max-width: 280px; margin: 0 auto; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                            <div class="text-center mb-3">
                                @if (!empty(Auth::user()->logo))
                                    <img src="{{ Auth::user()->logo }}" style="width: 50px; height: 50px; border-radius: 12px; object-fit: contain; box-shadow: 0 2px 8px rgba(0,0,0,0.06); margin-bottom: 8px;">
                                @else
                                    <div style="width: 44px; height: 44px; border-radius: 10px; background: #6366f1; color: #fff; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 8px;">
                                        {{ substr(Auth::user()->name ?? 'B', 0, 1) }}
                                    </div>
                                @endif
                                <h6 class="fw-bold mb-1" style="font-size: 0.95rem; color: #1e1b4b;">Private Message</h6>
                                <p id="preview_private_text" class="text-muted mb-0" style="font-size: 0.68rem; line-height: 1.35;">{{ Auth::user()->private_page_text ?? 'Leave us a review, it will help us grow and better serve our customers like you.' }}</p>
                            </div>
                            <div class="mb-2">
                                <div class="p-1 px-2 rounded-2 border bg-light text-muted" style="font-size: 0.68rem;">Your Name</div>
                            </div>
                            <div class="row g-1 mb-2">
                                <div class="col-6"><div class="p-1 px-2 rounded-2 border bg-light text-muted" style="font-size: 0.65rem;">Mobile no</div></div>
                                <div class="col-6"><div class="p-1 px-2 rounded-2 border bg-light text-muted" style="font-size: 0.65rem;">Email address</div></div>
                            </div>
                            <div class="mb-2">
                                <div class="p-1 px-2 rounded-2 border bg-light text-muted" style="font-size: 0.68rem; height: 38px;">How can we assist you?</div>
                            </div>
                            <div class="p-1.5 rounded-3 text-center fw-bold text-white shadow-sm" style="font-size: 0.7rem; background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                                <i class="fa fa-paper-plane me-1"></i> Send Private Message
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between" style="border-top: 1px solid #f1f5f9; padding: 16px 28px; background: #fafafa;">
                <button type="button" class="btn btn-light fw-bold px-4 py-2" data-bs-dismiss="modal" onclick="hide_modal()" style="border-radius: 10px; font-size: 0.85rem;">Cancel</button>
                <button type="button" id="btn_save_private_feedback" class="btn btn-primary fw-bold px-4 py-2" onclick="savePrivateFeedbackSettings()" style="border-radius: 10px; font-size: 0.85rem; background: linear-gradient(135deg, #7c3aed, #6d28d9); border: none;">
                    <i class="ti ti-check me-1"></i> Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL_Gc4eXdsopPpkv_EkMFyo-uoU8mWp5U&libraries=places&v=weekly" defer></script>

<script>
    function hide_modal() {
        var privEl = document.getElementById('private_feedback_modal');
        var privM = privEl ? bootstrap.Modal.getInstance(privEl) : null;
        if (privM) privM.hide();

        var spinEl = document.getElementById('add_spinner_modal');
        var spinM = spinEl ? bootstrap.Modal.getInstance(spinEl) : null;
        if (spinM) spinM.hide();

        var addEl = document.getElementById('integration_add_modal');
        var addM = addEl ? bootstrap.Modal.getInstance(addEl) : null;
        if (addM) addM.hide();

        var rmEl = document.getElementById('integration_remove_modal');
        var rmM = rmEl ? bootstrap.Modal.getInstance(rmEl) : null;
        if (rmM) rmM.hide();
    }

    function open_private_feedback_modal() {
        var el = document.getElementById('private_feedback_modal');
        if (!el) return;
        var m = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
        m.show();
    }

    function updateShieldPreviewText() {
        var text = $('#modal_private_page_text').val();
        if (!text || text.trim() === '') {
            text = 'Leave us a review, it will help us grow and better serve our customers like you.';
        }
        $('#preview_private_text').text(text);
    }

    function updateShieldPreviewState() {
        var isYes = $('#shield_status_yes').is(':checked');
        if (isYes) {
            $('#label_shield_active').css({'border-color': '#059669', 'background': '#ecfdf5'});
            $('#label_shield_inactive').css({'border-color': '#e2e8f0', 'background': '#ffffff'});
        } else {
            $('#label_shield_active').css({'border-color': '#e2e8f0', 'background': '#ffffff'});
            $('#label_shield_inactive').css({'border-color': '#94a3b8', 'background': '#f8fafc'});
        }
    }

    function quickTogglePrivateFeedback(status) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{URL::to('admin/update_private_feedback_status')}}",
            data: { 
                status: status,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                if (typeof toastr !== 'undefined') {
                    toastr.success(res.message || "Private feedback updated.");
                } else if (typeof swal !== 'undefined') {
                    swal("Success", res.message || "Updated successfully", "success");
                }
                setTimeout(function() {
                    location.reload(true);
                }, 600);
            },
            error: function(xhr) {
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : "Failed to update.";
                if (typeof toastr !== 'undefined') {
                    toastr.error(msg);
                } else if (typeof swal !== 'undefined') {
                    swal("Access Denied", msg, "warning");
                } else {
                    alert(msg);
                }
            }
        });
    }

    function savePrivateFeedbackSettings() {
        var status = $('input[name="modal_private_feedback_status"]:checked').val() || 'yes';
        var pageText = $('#modal_private_page_text').val();
        var btn = $('#btn_save_private_feedback');
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Saving...');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{URL::to('admin/update_private_feedback_status')}}",
            data: {
                status: status,
                private_page_text: pageText,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                btn.prop('disabled', false).html('<i class="ti ti-check me-1"></i> Save Changes');
                hide_modal();
                if (typeof toastr !== 'undefined') {
                    toastr.success(res.message || "Private feedback saved.");
                } else if (typeof swal !== 'undefined') {
                    swal("Success", res.message || "Saved successfully", "success");
                }
                setTimeout(function() {
                    location.reload(true);
                }, 600);
            },
            error: function(xhr) {
                btn.prop('disabled', false).html('<i class="ti ti-check me-1"></i> Save Changes');
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : "Failed to update.";
                if (typeof toastr !== 'undefined') {
                    toastr.error(msg);
                } else if (typeof swal !== 'undefined') {
                    swal("Access Denied", msg, "warning");
                } else {
                    alert(msg);
                }
            }
        });
    }

    function promptPrivateUpgrade() {
        if (typeof get_plans === 'function') {
            get_plans();
        } else {
            window.location.href = "{{ URL::to('admin/membership_plans') }}";
        }
    }

    var _autocompleteInitialized = false;
    function open_integration_model() {
        var el = document.getElementById('integration_add_modal');
        if (!el) { console.error('integration_add_modal element not found'); return; }
        var m = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
        m.show();
        try {
            if (!_autocompleteInitialized && typeof google !== 'undefined' && google.maps) {
                initAutocomplete();
                _autocompleteInitialized = true;
            }
        } catch(e) {
            console.warn('Autocomplete init failed:', e);
        }
    }

    function open_integration_remove_model(type) {
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/open_integration_remove_modal')}}",
            data: { 'type': type },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage);
            },
            success: function(data) {
                $('.integration_remove_modal_body').html(data);
                var el = document.getElementById('integration_remove_modal');
                var m = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
                m.show();
            } 
        });
    }

    function disconect_integration(type) {
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/integration_remove')}}",
            data: { 'type': type },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage);
            },
            success: function(data) {
                location.reload(true);
            } 
        });
    }

    function save_google_status() {
        var form = $('#google_status_form')[0];
        if (!form) return;
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{URL::to('admin/add_review_links')}}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (typeof toastr !== 'undefined') {
                    toastr.success("Google status updated successfully.");
                } else if (typeof swal !== 'undefined') {
                    swal("Success", "Google status updated.", "success");
                }
            },
            error: function(err) {
                console.error(err);
                if (typeof toastr !== 'undefined') {
                    toastr.error("Failed to update status.");
                }
            }
        });
    }

    let selectedPlace;
    function initAutocomplete() {
        const input = document.getElementById("pac-input");
        if (!input) return;
        const autocomplete = new google.maps.places.Autocomplete(input, {
            fields: ["place_id", "geometry", "formatted_address", "name"],
        });

        const placesService = new google.maps.places.PlacesService(document.createElement('div'));

        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            if (place.place_id) {
                placesService.getDetails({ placeId: place.place_id }, (result, status) => {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        selectedPlace = result;
                        $(".integrate_button").show();
                    } else {
                        console.error('Place details request failed. Status:', status);
                    }
                });
            } else {
                console.error('Place object does not have a valid place_id.');
            }
        });
    }

    function sendResult(type) {
        if (selectedPlace) {
            selectedPlace.type = type;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{URL::to('admin/integration_form')}}",
                type: "POST",
                contentType: "application/json;charset=UTF-8",
                data: JSON.stringify(selectedPlace),
                success: function (data) {
                    location.reload(true);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.statusText);
                }
            });
        }
    }

    function add_spinner_btn(review_type) {
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/review_links_form')}}",
            data: { 'review_type': review_type },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage);
            },
            success: function(data) {
                $('.spinner_body').html(data);
                var el = document.getElementById('add_spinner_modal');
                var m = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
                m.show();
            } 
        });
    }

    function edit_spinner(url) {
        $.ajax({
            type: "GET",
            url: url,
            data: { 'id': '' },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage);
            },
            success: function(data) {
                $('.spinner_body').html(data);
                var el = document.getElementById('add_spinner_modal');
                var m = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
                m.show();
            } 
        });
    }

    function add_submit() {
        var id = $('#spinner_form input[name="id"]').val();
        var review_type = $('#spinner_form input[name="review_type"]').val();
        var review_key = $('#spinner_form input[name="review_key"]').val();
        var status = $('#spinner_form select[name="status"]').val();
        var _token = $('#spinner_form input[name="_token"]').val();

        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/add_review_links')}}",
            data: {
                id: id,
                review_type: review_type,
                review_key: review_key,
                status: status,
                _token: _token
            },
            dataType: 'json',
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage);
            },
            success: function(data) {
                swal({
                    title: "Success",
                    text: "Configuration saved successfully.",
                    icon: "success",
                    button: "Done"
                });
                setTimeout(() => {
                    location.reload(true);
                }, 1200);
            } 
        });
    }

    function integration_start() {
        if (confirm("Initialize standard review platforms?")) {
            $.ajax({
                type: "POST",
                url: "{{ URL::to('admin/integration_start') }}",
                data: {
                    '_token': "{{ csrf_token() }}"
                },
                error: function(jqXHR, textStatus, errorMessage) {
                    console.error("Error:", errorMessage);
                },
                success: function(data) {
                    swal({
                        title: "Success",
                        text: "Integrations initialized.",
                        icon: "success",
                        button: "Awesome"
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1200);
                }
            });
        }
    }

    // Modal escape fix
    document.addEventListener('DOMContentLoaded', function () {
        ['integration_add_modal', 'integration_remove_modal', 'add_spinner_modal'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el && el.parentElement !== document.body) {
                document.body.appendChild(el);
            }
        });
    });

    // Initialize Sortable.js
    document.addEventListener("DOMContentLoaded", function () {
        var container = document.getElementById('integrationContainer');
        if (container && typeof Sortable !== 'undefined') {
            Sortable.create(container, {
                animation: 200,
                handle: '.drag-item',
                filter: 'button, a, input, .btn',
                preventOnFilter: false,
                ghostClass: 'sortable-ghost-card',
                chosenClass: 'sortable-chosen-card',
                onEnd: function (evt) {
                    var order = [];
                    document.querySelectorAll('#integrationContainer .drag-item').forEach(function (item, idx) {
                        order.push({
                            id: item.id.replace('dragbble_', ''),
                            order: (idx + 1)
                        });
                    });

                    fetch("{{ URL::to('admin/update-integration-order') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order: order })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Order updated:', data.message);
                    })
                    .catch(error => console.error('Error updating order:', error));
                }
            });
        }
    });

    // ── SEARCH & FILTER CONTROLS ──
    var activeFilter = 'all';
    var searchQuery = '';

    function filterIntegrationCards() {
        var cards = document.querySelectorAll('.integration-item-card');
        var visibleCount = 0;

        cards.forEach(function(card) {
            var category = card.getAttribute('data-category') || '';
            var name = card.getAttribute('data-name') || '';
            var status = card.getAttribute('data-status') || '';

            var matchesFilter = false;
            if (activeFilter === 'all') {
                matchesFilter = true;
            } else if (activeFilter === 'connected') {
                matchesFilter = (status === 'connected' || status === 'shield');
            } else if (activeFilter === 'review') {
                matchesFilter = (category === 'review');
            } else if (activeFilter === 'social') {
                matchesFilter = (category === 'social');
            } else if (activeFilter === 'shield') {
                matchesFilter = (category === 'shield');
            }

            var matchesSearch = true;
            if (searchQuery.trim() !== '') {
                matchesSearch = name.indexOf(searchQuery.toLowerCase()) !== -1;
            }

            if (matchesFilter && matchesSearch) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        var noState = document.getElementById('noIntegrationsFoundState');
        if (noState) {
            noState.style.display = (visibleCount === 0) ? 'block' : 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Filter pills click
        var pillGroup = document.getElementById('integrationFilterGroup');
        if (pillGroup) {
            pillGroup.addEventListener('click', function(e) {
                var btn = e.target.closest('.filter-pill-btn');
                if (!btn) return;
                pillGroup.querySelectorAll('.filter-pill-btn').forEach(function(b) { b.classList.remove('active'); });
                btn.classList.add('active');
                activeFilter = btn.getAttribute('data-filter') || 'all';
                filterIntegrationCards();
            });
        }

        // Search input
        var searchInput = document.getElementById('searchIntegrations');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                searchQuery = e.target.value;
                filterIntegrationCards();
            });
        }
    });

    function resetIntegrationFilters() {
        activeFilter = 'all';
        searchQuery = '';
        var searchInput = document.getElementById('searchIntegrations');
        if (searchInput) searchInput.value = '';
        var pillGroup = document.getElementById('integrationFilterGroup');
        if (pillGroup) {
            pillGroup.querySelectorAll('.filter-pill-btn').forEach(function(b) { b.classList.remove('active'); });
            var first = pillGroup.querySelector('.filter-pill-btn[data-filter="all"]');
            if (first) first.classList.add('active');
        }
        filterIntegrationCards();
    }
</script>

<!-- ====================================================================
     INTERACTIVE ONBOARDING TOUR FOR INTEGRATIONS HUB
     ==================================================================== -->
<div id="integrationsTourOverlay" style="display: none; position: fixed; inset: 0; z-index: 99998; pointer-events: auto;">
    <div id="tourBackdropClickCatcher" onclick="closeIntegrationsTour()" style="position: absolute; inset: 0; background: rgba(15, 23, 42, 0.68); backdrop-filter: blur(3px); cursor: pointer;" title="Click anywhere to exit tour"></div>
    
    <!-- Dynamic Spotlight Cutout -->
    <div id="tourSpotlightBox" style="position: absolute; pointer-events: none; border-radius: 18px; border: 3px solid #3b82f6; box-shadow: 0 0 0 9999px rgba(15, 23, 42, 0.68), 0 0 35px rgba(59, 130, 246, 0.6); transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1); z-index: 99999; display: none;"></div>

    <!-- Floating Tour Tooltip Card -->
    <div id="tourTooltipCard" style="position: absolute; width: 380px; max-width: calc(100vw - 32px); background: #ffffff; border-radius: 20px; border: 1px solid rgba(226, 232, 240, 0.95); box-shadow: 0 25px 60px -12px rgba(15, 23, 42, 0.45); padding: 22px; z-index: 100000; font-family: 'Plus Jakarta Sans', sans-serif; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); pointer-events: auto;">
        
        <!-- Header: Badge & Close -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span id="tourStepBadge" style="display: inline-flex; align-items: center; gap: 4px; background: #eff6ff; border: 1px solid #bfdbfe; color: #1d4ed8; font-size: 0.72rem; font-weight: 800; padding: 3px 10px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.04em;">
                Step 1 of 5
            </span>
            <button type="button" onclick="closeIntegrationsTour()" style="background: none; border: none; color: #94a3b8; font-size: 1.35rem; line-height: 1; cursor: pointer; padding: 2px 6px; border-radius: 6px; transition: all 0.2s;" onmouseover="this.style.color='#0f172a'; this.style.background='#f1f5f9';" onmouseout="this.style.color='#94a3b8'; this.style.background='none';" title="Exit Tour (Esc)">
                &times;
            </button>
        </div>

        <!-- Title -->
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
            <div id="tourStepIcon" style="width: 38px; height: 38px; border-radius: 12px; background: #eff6ff; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: #2563eb; flex-shrink: 0;">
                <i class="ti ti-rocket"></i>
            </div>
            <h6 id="tourStepTitle" style="font-weight: 800; font-size: 1.08rem; color: #0f172a; margin: 0; line-height: 1.3;">
                Welcome to Integrations Hub!
            </h6>
        </div>

        <!-- Content -->
        <p id="tourStepContent" style="font-size: 0.85rem; color: #475569; line-height: 1.55; margin: 0 0 18px 0;">
            This is where you activate the review channels for your business.
        </p>

        <!-- Footer -->
        <div style="display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #f1f5f9; padding-top: 14px;">
            <div id="tourProgressDots" style="display: flex; gap: 6px; align-items: center;"></div>

            <div style="display: flex; align-items: center; gap: 8px;">
                <button type="button" id="tourPrevBtn" onclick="prevTourStep()" class="btn btn-sm" style="display: none; background: #f8fafc; border: 1px solid #e2e8f0; color: #475569; font-weight: 700; font-size: 0.8rem; border-radius: 10px; padding: 6px 14px; transition: all 0.2s;">
                    &larr; Back
                </button>
                <button type="button" id="tourNextBtn" onclick="nextTourStep()" class="btn btn-sm" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); border: none; color: #ffffff; font-weight: 700; font-size: 0.82rem; border-radius: 10px; padding: 7px 18px; box-shadow: 0 3px 10px rgba(37,99,235,0.25); display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;">
                    <span>Next</span> &rarr;
                </button>
            </div>
        </div>

    </div>
</div>

<script>
(function() {
    var tourCurrentStep = 0;
    var currentTargetEl = null;
    var tourSteps = [
        {
            target: '#integrationsHeroCard',
            fallbackTarget: '.container-fluid',
            badge: 'Step 1 of 5 • Welcome',
            icon: '<i class="ti ti-rocket"></i>',
            title: 'Welcome to Integrations Hub! 🚀',
            content: 'This is your central command center for reviews. Every platform you configure here appears instantly on your public customer funnel, smart QR standees, and review cards!',
            placement: 'bottom'
        },
        {
            target: '[data-type="google"] .modern-integration-card',
            fallbackTarget: '[data-type="google"]',
            badge: 'Step 2 of 5 • Highest SEO Impact',
            icon: '<i class="ti ti-brand-google"></i>',
            title: 'Connect Google Reviews ⭐',
            content: 'Google Reviews have the greatest impact on your store ranking and local map pack. Click <strong>"Connect Google"</strong> to link your business profile so satisfied customers are routed straight to your 5-star Google review box.',
            placement: 'right'
        },
        {
            target: '[data-type="whatsapp"] .modern-integration-card',
            fallbackTarget: '[data-type="facebook"] .modern-integration-card',
            badge: 'Step 3 of 5 • Multi-Channel',
            icon: '<i class="ti ti-brand-whatsapp"></i>',
            title: 'WhatsApp & Social Channels 💬',
            content: 'Enable WhatsApp, Facebook, or Instagram so shoppers who prefer quick chat or don\'t use Google can still leave recommendations, contact your team, or follow your brand.',
            placement: 'right'
        },
        {
            target: '#dragReorderHint',
            fallbackTarget: '#integrationContainer',
            badge: 'Step 4 of 5 • Custom Ordering',
            icon: '<i class="ti ti-arrows-sort"></i>',
            title: 'Drag & Drop Reordering 🔄',
            content: 'You have full control over card layout! Grab any card by its <strong>"Drag"</strong> handle to reorder buttons. Channels placed at the top receive up to <strong>70% more clicks</strong>.',
            placement: 'bottom'
        },
        {
            target: '#heroLiveReviewBtn',
            fallbackTarget: '#navbarLiveReviewPill',
            badge: 'Step 5 of 5 • Live Preview',
            icon: '<i class="ti ti-external-link"></i>',
            title: 'Test Your Live Funnel 🌐',
            content: 'Click <strong>"Preview Funnel"</strong> anytime to experience exactly what your customers see when they scan your NFC/QR standees or click your review link. You\'re all set to grow!',
            placement: 'bottom'
        }
    ];

    window.startIntegrationsTour = function(forceRestart) {
        tourCurrentStep = 0;
        var overlay = document.getElementById('integrationsTourOverlay');
        if (!overlay) return;
        overlay.style.display = 'block';
        showTourStep(tourCurrentStep);
    };

    window.closeIntegrationsTour = function() {
        var overlay = document.getElementById('integrationsTourOverlay');
        if (overlay) overlay.style.display = 'none';
        var spotlight = document.getElementById('tourSpotlightBox');
        if (spotlight) spotlight.style.display = 'none';
        currentTargetEl = null;
        
        try {
            localStorage.setItem('askreview_integrations_tour_seen', 'true');
        } catch(e) {}

        try {
            var url = new URL(window.location.href);
            if (url.searchParams.has('tour') || url.searchParams.has('source')) {
                url.searchParams.delete('tour');
                url.searchParams.delete('source');
                window.history.replaceState({}, document.title, url.toString());
            }
        } catch(e) {}
    };

    window.nextTourStep = function() {
        if (tourCurrentStep < tourSteps.length - 1) {
            tourCurrentStep++;
            showTourStep(tourCurrentStep);
        } else {
            closeIntegrationsTour();
        }
    };

    window.prevTourStep = function() {
        if (tourCurrentStep > 0) {
            tourCurrentStep--;
            showTourStep(tourCurrentStep);
        }
    };

    function showTourStep(index) {
        var step = tourSteps[index];
        if (!step) return;

        var targetEl = document.querySelector(step.target);
        if (!targetEl || targetEl.offsetParent === null) {
            if (step.fallbackTarget) {
                targetEl = document.querySelector(step.fallbackTarget);
            }
        }
        if (!targetEl || targetEl.offsetParent === null) {
            targetEl = document.getElementById('integrationsHeroCard') || document.body;
        }
        currentTargetEl = targetEl;

        var badge = document.getElementById('tourStepBadge');
        if (badge) badge.innerText = step.badge;

        var icon = document.getElementById('tourStepIcon');
        if (icon) icon.innerHTML = step.icon;

        var title = document.getElementById('tourStepTitle');
        if (title) title.innerText = step.title;

        var content = document.getElementById('tourStepContent');
        if (content) content.innerHTML = step.content;

        var prevBtn = document.getElementById('tourPrevBtn');
        if (prevBtn) {
            prevBtn.style.display = (index > 0) ? 'inline-block' : 'none';
        }

        var nextBtn = document.getElementById('tourNextBtn');
        if (nextBtn) {
            if (index === tourSteps.length - 1) {
                nextBtn.innerHTML = '<span>Finish Tour</span> <i class="ti ti-check ms-1"></i>';
                nextBtn.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
            } else {
                nextBtn.innerHTML = '<span>Next</span> &rarr;';
                nextBtn.style.background = 'linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%)';
            }
        }

        var dotsBox = document.getElementById('tourProgressDots');
        if (dotsBox) {
            var dotsHtml = '';
            for (var i = 0; i < tourSteps.length; i++) {
                if (i === index) {
                    dotsHtml += '<span style="width: 18px; height: 6px; border-radius: 9999px; background: #2563eb; transition: all 0.2s ease;"></span>';
                } else if (i < index) {
                    dotsHtml += '<span style="width: 6px; height: 6px; border-radius: 50%; background: #10b981; transition: all 0.2s ease;"></span>';
                } else {
                    dotsHtml += '<span style="width: 6px; height: 6px; border-radius: 50%; background: #cbd5e1; transition: all 0.2s ease;"></span>';
                }
            }
            dotsBox.innerHTML = dotsHtml;
        }

        // Smoothly bring target into view
        try {
            targetEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } catch(e) {}

        // Multi-frame positioning update to track smooth scroll cleanly
        positionTourElements(targetEl, step.placement);
        setTimeout(function() { positionTourElements(targetEl, step.placement); }, 80);
        setTimeout(function() { positionTourElements(targetEl, step.placement); }, 200);
        setTimeout(function() { positionTourElements(targetEl, step.placement); }, 380);
    }

    function positionTourElements(targetEl, preferredPlacement) {
        var spotlight = document.getElementById('tourSpotlightBox');
        var card = document.getElementById('tourTooltipCard');
        if (!spotlight || !card || !targetEl) return;

        var rect = targetEl.getBoundingClientRect();
        var pad = 6;

        // Viewport-relative coordinates (overlay is position: fixed)
        var spotTop = rect.top - pad;
        var spotLeft = rect.left - pad;
        var spotWidth = rect.width + (pad * 2);
        var spotHeight = rect.height + (pad * 2);

        spotlight.style.display = 'block';
        spotlight.style.top = Math.round(spotTop) + 'px';
        spotlight.style.left = Math.round(spotLeft) + 'px';
        spotlight.style.width = Math.round(spotWidth) + 'px';
        spotlight.style.height = Math.round(spotHeight) + 'px';

        var cardWidth = card.offsetWidth || 380;
        var cardHeight = card.offsetHeight || 220;
        var vw = window.innerWidth;
        var vh = window.innerHeight;

        var spaceBelow = vh - (rect.bottom + pad);
        var spaceAbove = rect.top - pad;
        var spaceRight = vw - (rect.right + pad);
        var spaceLeft = rect.left - pad;

        // Decide optimal placement
        var placement = preferredPlacement || 'bottom';

        // Auto-adapt if chosen side is too cramped
        if (placement === 'bottom') {
            if (spaceBelow < cardHeight + 16 && spaceAbove > cardHeight + 16) {
                placement = 'top';
            } else if (spaceBelow < cardHeight + 16 && spaceRight > cardWidth + 24) {
                placement = 'right';
            }
        } else if (placement === 'top') {
            if (spaceAbove < cardHeight + 16 && spaceBelow > cardHeight + 16) {
                placement = 'bottom';
            } else if (spaceAbove < cardHeight + 16 && spaceRight > cardWidth + 24) {
                placement = 'right';
            }
        } else if (placement === 'right') {
            if (spaceRight < cardWidth + 16) {
                if (spaceBelow >= cardHeight + 16) {
                    placement = 'bottom';
                } else if (spaceAbove >= cardHeight + 16) {
                    placement = 'top';
                } else if (spaceLeft >= cardWidth + 16) {
                    placement = 'left';
                }
            }
        }

        var cardTop = 0;
        var cardLeft = 0;

        if (placement === 'right') {
            cardLeft = rect.right + pad + 14;
            cardTop = rect.top + (rect.height / 2) - (cardHeight / 2);
        } else if (placement === 'left') {
            cardLeft = rect.left - pad - cardWidth - 14;
            cardTop = rect.top + (rect.height / 2) - (cardHeight / 2);
        } else if (placement === 'top') {
            cardTop = rect.top - pad - cardHeight - 14;
            cardLeft = rect.left + (rect.width / 2) - (cardWidth / 2);
        } else { // bottom
            cardTop = rect.bottom + pad + 14;
            cardLeft = rect.left + (rect.width / 2) - (cardWidth / 2);
        }

        // CRITICAL: NEVER allow card to be clipped off-screen
        cardLeft = Math.max(16, Math.min(vw - cardWidth - 16, cardLeft));
        cardTop = Math.max(16, Math.min(vh - cardHeight - 16, cardTop));

        card.style.top = Math.round(cardTop) + 'px';
        card.style.left = Math.round(cardLeft) + 'px';
    }

    // Keep spotlight and tooltip perfectly synced during user scroll or window resize
    window.addEventListener('scroll', function() {
        var overlay = document.getElementById('integrationsTourOverlay');
        if (overlay && overlay.style.display !== 'none' && currentTargetEl) {
            var step = tourSteps[tourCurrentStep];
            positionTourElements(currentTargetEl, step ? step.placement : 'bottom');
        }
    }, { passive: true });

    window.addEventListener('resize', function() {
        var overlay = document.getElementById('integrationsTourOverlay');
        if (overlay && overlay.style.display !== 'none' && currentTargetEl) {
            var step = tourSteps[tourCurrentStep];
            positionTourElements(currentTargetEl, step ? step.placement : 'bottom');
        }
    }, { passive: true });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        var overlay = document.getElementById('integrationsTourOverlay');
        if (!overlay || overlay.style.display === 'none') return;

        if (e.key === 'Escape') {
            closeIntegrationsTour();
        } else if (e.key === 'ArrowRight' || e.key === 'Enter') {
            nextTourStep();
        } else if (e.key === 'ArrowLeft') {
            prevTourStep();
        }
    });

    // Auto-launch on first visit or query params
    document.addEventListener('DOMContentLoaded', function() {
        var urlParams = new URLSearchParams(window.location.search);
        var hasTourParam = urlParams.get('tour') === '1' || urlParams.get('source') === 'onboarding';
        var tourSeen = false;
        try {
            tourSeen = localStorage.getItem('askreview_integrations_tour_seen') === 'true';
        } catch(e) {}

        if (hasTourParam || !tourSeen) {
            setTimeout(function() {
                startIntegrationsTour(false);
            }, 600);
        }
    });
})();
</script>

@endsection