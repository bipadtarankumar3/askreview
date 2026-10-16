@if (!empty($activeScratchCard))
@php
    $theme = $activeScratchCard->card_theme ?? 'gold';
    $themeStyles = [
        'gold' => [
            'gradient' => 'linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%)',
            'foil' => 'linear-gradient(135deg, #d97706 0%, #fef3c7 25%, #f59e0b 50%, #fef3c7 75%, #b45309 100%)',
            'border' => '#fcd34d',
            'accent' => '#f59e0b',
            'badge' => '#92400e',
            'canvas_color' => '#d97706'
        ],
        'purple' => [
            'gradient' => 'linear-gradient(135deg, #8b5cf6 0%, #6d28d9 50%, #4c1d95 100%)',
            'foil' => 'linear-gradient(135deg, #7c3aed 0%, #ede9fe 25%, #a855f7 50%, #f3e8ff 75%, #581c87 100%)',
            'border' => '#c4b5fd',
            'accent' => '#8b5cf6',
            'badge' => '#4c1d95',
            'canvas_color' => '#7c3aed'
        ],
        'emerald' => [
            'gradient' => 'linear-gradient(135deg, #10b981 0%, #059669 50%, #064e3b 100%)',
            'foil' => 'linear-gradient(135deg, #059669 0%, #d1fae5 25%, #10b981 50%, #ecfdf5 75%, #065f46 100%)',
            'border' => '#6ee7b7',
            'accent' => '#10b981',
            'badge' => '#064e3b',
            'canvas_color' => '#059669'
        ],
        'blue' => [
            'gradient' => 'linear-gradient(135deg, #3b82f6 0%, #1d4ed8 50%, #1e3a8a 100%)',
            'foil' => 'linear-gradient(135deg, #2563eb 0%, #dbeafe 25%, #3b82f6 50%, #eff6ff 75%, #1e40af 100%)',
            'border' => '#93c5fd',
            'accent' => '#3b82f6',
            'badge' => '#1e3a8a',
            'canvas_color' => '#2563eb'
        ],
    ];
    $activeTheme = $themeStyles[$theme] ?? $themeStyles['gold'];
    $couponCode = !empty($scratchCardExistingLead->coupon_code) ? $scratchCardExistingLead->coupon_code : ($activeScratchCard->coupon_code ?? '');
    $rewardName = !empty($activeScratchCard->offer_text) ? $activeScratchCard->offer_text : (!empty($activeScratchCard->title) ? $activeScratchCard->title : 'Exclusive Reward');
    $waShareText = "Hello " . $user->name . ",\n\nI just unlocked my reward on your review page!\n\n🎁 Offer: " . $rewardName . ($couponCode ? ("\n🎟️ Code: " . $couponCode) : "") . "\n\nPlease find my voucher details for redemption at your store.";
@endphp

<!-- ═══════════════════════════════════════════════════════════════ -->
<!-- FLOATING SCRATCH & WIN BADGE TRIGGER -->
<!-- ═══════════════════════════════════════════════════════════════ -->
<button type="button" id="floatingScratchBadge" onclick="open_scratch_card_modal()" class="floating-scratch-pill" aria-label="Scratch & Win">
    <span class="floating-gift-icon">🎁</span>
    <span class="floating-scratch-text">
        <span class="pill-title">Scratch &amp; Win</span>
        <span class="pill-subtitle">Surprise Gift Inside</span>
    </span>
    <span class="floating-sparkle-dot"></span>
</button>

<!-- ═══════════════════════════════════════════════════════════════ -->
<!-- SCRATCH CARD INTERACTIVE MODAL -->
<!-- ═══════════════════════════════════════════════════════════════ -->
<div class="modal fade" id="scratchCardModal" tabindex="-1" aria-labelledby="scratchCardModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content scratch-modal-content border-0">
            <!-- Modal Header -->
            <div class="scratch-modal-header d-flex align-items-center justify-content-between p-3 pb-2 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <span class="scratch-header-badge">
                        <i class="fa-solid fa-sparkles"></i> EXCLUSIVE REWARD
                    </span>
                    <span class="scratch-scratched-pill {{ !empty($scratchCardAlreadyScratched) ? '' : 'd-none' }}" id="headerScratchedBadge">
                        <i class="fa-solid fa-circle-check text-success"></i> ALREADY SCRATCHED
                    </span>
                </div>
                <button type="button" class="btn-close-scratch" data-bs-dismiss="modal" aria-label="Close" onclick="close_scratch_card_modal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-3 p-sm-4 pt-3">
                <!-- ── The Scratch Card Interactive Canvas Box ── -->
                <div class="scratch-card-box-wrapper mb-3" id="scratchCardBoxWrapper">
                    <!-- Underneath Revealed Layer -->
                    <div class="scratch-revealed-layer" id="scratchRevealedLayer" style="background: {{ $activeTheme['gradient'] }};">
                        <div class="scratch-confetti-bg"></div>
                        <div class="scratch-revealed-inner text-center">
                            @if(!empty($activeScratchCard->image))
                                <div class="revealed-reward-img-box mb-1.5">
                                    <img src="{{ asset($activeScratchCard->image) }}" alt="{{ $activeScratchCard->title ?? 'Reward' }}" class="revealed-reward-img">
                                </div>
                            @endif
                            <span class="revealed-tag"><i class="fa-solid fa-gift"></i> YOU WON!</span>
                            @if(!empty($activeScratchCard->offer_text))
                                <h3 class="revealed-offer-text">{{ $activeScratchCard->offer_text }}</h3>
                            @endif
                            @if(!empty($couponCode))
                                <div class="revealed-coupon-badge" id="revealedCouponBadge">
                                    <span class="coupon-label">CODE:</span>
                                    <span class="coupon-code-val">{{ $couponCode }}</span>
                                    <button type="button" class="btn-copy-coupon-mini" onclick="copyScratchCoupon('{{ $couponCode }}', this)" title="Copy Code">
                                        <i class="fa-regular fa-copy"></i>
                                    </button>
                                </div>
                            @endif
                            @if(!empty($activeScratchCard->description))
                                <p class="revealed-desc-text">{{ $activeScratchCard->description }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Top Scratchable Canvas Layer -->
                    <canvas id="scratchCanvas" class="scratch-canvas-overlay {{ !empty($scratchCardAlreadyScratched) ? 'cleared' : '' }}" width="380" height="230" style="{{ !empty($scratchCardAlreadyScratched) ? 'display:none;' : '' }}"></canvas>

                    <!-- Hint / Hand swipe animation over canvas (hidden after first scratch) -->
                    <div class="scratch-hand-hint {{ !empty($scratchCardAlreadyScratched) ? 'd-none' : '' }}" id="scratchHandHint" style="{{ !empty($scratchCardAlreadyScratched) ? 'display:none;' : '' }}">
                        <i class="fa-solid fa-hand-pointer hand-icon"></i>
                        <span>Rub with finger or cursor</span>
                    </div>

                    <!-- Scratch Progress Indicator -->
                    <div class="scratch-percent-indicator {{ !empty($scratchCardAlreadyScratched) ? 'd-none' : '' }}" id="scratchPercentIndicator" style="{{ !empty($scratchCardAlreadyScratched) ? 'display:none;' : '' }}">
                        <span id="scratchPercentText">0% Scratched</span>
                    </div>
                </div>

                <!-- ═══════════════════════════════════════════════════════════════ -->
                <!-- REVEALED VOUCHER DETAILS & ACTIONS (Shown when Scratched) -->
                <!-- ═══════════════════════════════════════════════════════════════ -->
                <div class="scratch-revealed-details-wrap {{ !empty($scratchCardAlreadyScratched) ? '' : 'd-none' }}" id="scratchRevealedDetailsWrap" style="{{ !empty($scratchCardAlreadyScratched) ? 'display: block;' : 'display: none;' }}">

                    <!-- 1. Status & Guarantee Strip -->
                    <div class="scratch-status-strip d-flex align-items-center justify-content-between p-2.5 px-3 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="status-pulse-dot"></span>
                            <span class="fw-bold status-title">Voucher Unlocked &amp; Active</span>
                        </div>
                        <span class="badge status-verified-badge">
                            <i class="fa-solid fa-shield-halved me-1"></i> 1 Scratch Limit
                        </span>
                    </div>

                    <!-- 2. Detailed Voucher Summary Card -->
                    <div class="voucher-info-card p-3 mb-3">
                        <div class="d-flex align-items-center justify-content-between pb-2 mb-2 border-bottom">
                            <div class="d-flex align-items-center gap-1.5 text-uppercase fw-bold" style="font-size: 0.76rem; letter-spacing: 0.05em; color: #475569;">
                                <i class="fa-solid fa-receipt text-primary"></i> Voucher Details &amp; Summary
                            </div>
                            <span class="badge bg-success-subtle text-success fw-bold" style="font-size: 0.72rem; border-radius: 6px;">
                                <i class="fa-solid fa-check me-1"></i> Active
                            </span>
                        </div>

                        <!-- Rows of details -->
                        <div class="voucher-detail-row">
                            <span class="detail-label"><i class="fa-solid fa-store text-warning me-1"></i> Store</span>
                            <span class="detail-value fw-bold text-dark">{{ $user->name }}</span>
                        </div>

                        @if(!empty($activeScratchCard->offer_text))
                        <div class="voucher-detail-row">
                            <span class="detail-label"><i class="fa-solid fa-gift text-primary me-1"></i> Reward Won</span>
                            <span class="detail-value fw-bold text-success">{{ $activeScratchCard->offer_text }}</span>
                        </div>
                        @elseif(!empty($activeScratchCard->title))
                        <div class="voucher-detail-row">
                            <span class="detail-label"><i class="fa-solid fa-gift text-primary me-1"></i> Offer</span>
                            <span class="detail-value fw-bold text-success">{{ $activeScratchCard->title }}</span>
                        </div>
                        @endif

                        @if(!empty($couponCode))
                        <div class="voucher-detail-row">
                            <span class="detail-label"><i class="fa-solid fa-ticket text-danger me-1"></i> Coupon Code</span>
                            <div class="d-flex align-items-center gap-1.5">
                                <span class="voucher-code-pill" id="detailCouponCodeDisplay">{{ $couponCode }}</span>
                                <button type="button" class="btn btn-sm btn-light border py-1 px-2 text-dark btn-copy-mini" onclick="copyScratchCoupon('{{ $couponCode }}', this)" title="Copy Code">
                                    <i class="fa-regular fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        @endif

                        <div class="voucher-detail-row">
                            <span class="detail-label"><i class="fa-solid fa-location-dot text-danger me-1"></i> Location</span>
                            <span class="detail-value text-muted">In-Store at {{ $user->name }}</span>
                        </div>

                        @if(!empty($activeScratchCard->description))
                        <div class="voucher-detail-terms mt-2 pt-2 border-top">
                            <div class="detail-label small mb-1 text-muted" style="font-size: 0.74rem;">
                                <i class="fa-solid fa-circle-info text-info me-1"></i> Terms &amp; Instructions:
                            </div>
                            <div class="terms-callout-box">
                                {{ $activeScratchCard->description }}
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- 3. Customer Lead / Claim Registration Box -->
                    <!-- Case A: Already Claimed / Lead Exists -->
                    <div class="customer-verified-card p-3 mb-3 {{ !empty($scratchCardExistingLead) ? '' : 'd-none' }}" id="customerVerifiedCard" style="{{ !empty($scratchCardExistingLead) ? 'display: block;' : 'display: none;' }}">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2.5">
                                <div class="verified-avatar">
                                    <i class="fa-solid fa-user-check"></i>
                                </div>
                                <div>
                                    <div class="fw-bold verified-name">Registered To: <span id="leadNameDisplay">{{ $scratchCardExistingLead->customer_name ?? '' }}</span></div>
                                    <div class="verified-phone">
                                        <i class="fa-brands fa-whatsapp text-success me-1"></i><span id="leadPhoneDisplay">{{ $scratchCardExistingLead->customer_phone ?? '' }}</span>
                                        @if(!empty($scratchCardExistingLead->created_at))
                                            • <span>{{ $scratchCardExistingLead->created_at->format('d M, Y') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <span class="badge bg-success" style="font-size: 0.7rem; border-radius: 6px;">CLAIMED</span>
                        </div>
                    </div>

                    <!-- Case B: Not Yet Registered -> Quick Lead Capture Form -->
                    <div class="scratch-lead-form-wrap mb-3 {{ !empty($scratchCardExistingLead) ? 'd-none' : '' }}" id="scratchLeadFormWrap" style="{{ empty($scratchCardExistingLead) ? 'display: block;' : 'display: none;' }}">
                        <div class="lead-form-card p-3 p-sm-3.5">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="lead-header-icon-box">
                                    <i class="fa-solid fa-gift"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1 text-slate-800" style="font-size: 0.94rem; letter-spacing: -0.01em; line-height: 1.3;">Lock In &amp; Register Your Reward</h6>
                                    <div class="text-muted" style="font-size: 0.76rem; line-height: 1.35;">Enter your contact details to save &amp; redeem this offer</div>
                                </div>
                            </div>

                            <form id="scratchLeadClaimForm" onsubmit="submitScratchLead(event)">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="user_name" value="{{ $user->name_url ?? ($user_name ?? '') }}">
                                <input type="hidden" name="scratch_card_id" value="{{ $activeScratchCard->id }}">
                                <input type="hidden" name="offer_won" value="{{ $activeScratchCard->offer_text ?: ($activeScratchCard->title ?: 'Exclusive Reward') }}">
                                <input type="hidden" name="coupon_code" value="{{ $couponCode }}">

                                <!-- Name Input Group -->
                                <div class="mb-2.5">
                                    <label class="form-label lead-input-label mb-1">Full Name <span class="text-danger">*</span></label>
                                    <div class="lead-input-group">
                                        <span class="lead-input-addon"><i class="fa-regular fa-user"></i></span>
                                        <input type="text" name="customer_name" id="scratchCustomerName" class="form-control lead-input-field" placeholder="Enter your full name" required autocomplete="name">
                                    </div>
                                </div>

                                <!-- Phone Input Group with +91 & WhatsApp Icon -->
                                <div class="mb-3">
                                    <label class="form-label lead-input-label mb-1">WhatsApp / Mobile Number <span class="text-danger">*</span></label>
                                    <div class="lead-input-group" id="phoneInputGroup">
                                        <span class="lead-input-addon country-prefix">
                                            <span style="font-size: 1rem;">🇮🇳</span> <span class="fw-bold text-dark ms-1">+91</span>
                                        </span>
                                        <input type="tel" name="customer_phone" id="scratchCustomerPhone" class="form-control lead-input-field" placeholder="10-digit mobile number" maxlength="10" inputmode="numeric" required oninput="validateLivePhone(this)" autocomplete="tel">
                                        <span class="lead-input-addon wa-addon" title="Verified via WhatsApp">
                                            <i class="fa-brands fa-whatsapp text-success" style="font-size: 1.15rem;"></i>
                                        </span>
                                    </div>
                                    <div class="phone-validation-feedback d-none" id="phoneValidationErr">
                                        <i class="fa-solid fa-circle-exclamation me-1"></i><span id="phoneValidationErrMsg">Please enter a valid 10-digit mobile number.</span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-claim-scratch-reward w-100" id="btnSubmitScratchLead">
                                    <span class="btn-text">
                                        <i class="fa-solid fa-bolt me-1.5"></i> Claim &amp; Lock Reward
                                    </span>
                                    <span class="btn-spinner d-none">
                                        <span class="spinner-border spinner-border-sm me-1.5" role="status"></span> Saving Your Reward...
                                    </span>
                                </button>

                                <div class="lead-security-badge text-center mt-2.5">
                                    <i class="fa-solid fa-shield-halved text-success me-1"></i> 100% Secure • Used only for in-store voucher verification
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Actions after claimed or when already claimed -->
                    @php
                        $userPhone = preg_replace('/[^0-9]/', '', $user->mobile ?? $user->phone ?? '');
                        $couponText = !empty($couponCode) ? ' (Code: ' . $couponCode . ')' : '';
                        $rewardName = $activeScratchCard->offer_text ?: ($activeScratchCard->title ?: 'Exclusive Reward');
                        $waMsg = 'Hello ' . $user->name . ', I just scratched and won ' . $rewardName . $couponText . ' on your review page!';
                    @endphp

                    <div class="voucher-actions-wrap pt-1 pb-1 {{ !empty($scratchCardExistingLead) ? '' : 'd-none' }}" id="scratchClaimedActionsWrap" style="{{ !empty($scratchCardExistingLead) ? 'display: block;' : 'display: none;' }}">
                        @if(!empty($userPhone))
                            <a href="https://wa.me/{{ $userPhone }}?text={{ urlencode($waMsg) }}" target="_blank" class="btn btn-whatsapp-voucher w-100 d-flex align-items-center justify-content-center gap-2 mb-3">
                                <i class="fa-brands fa-whatsapp fs-5"></i>
                                <span>Send Voucher via WhatsApp</span>
                            </a>
                        @endif

                        <button type="button" class="btn btn-light w-100 btn-done-close text-muted py-2.5" onclick="close_scratch_card_modal()">
                            Done &amp; Return to Review
                        </button>
                    </div>
            </div>
        </div>
    </div>
</div>

<!-- Scratch & Win Audio Elements -->
<audio id="scratchSoundAudio" preload="auto">
    <source src="{{ asset('mp3/scratch.mp3') }}" type="audio/mpeg">
</audio>
<audio id="scratchWinSoundAudio" preload="auto">
    <source src="{{ asset('mp3/won.mp3') }}" type="audio/mpeg">
</audio>

<!-- Canvas Confetti Library for Modern Win Effect -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<style>
    /* ── Floating Scratch Pill ── */
    .floating-scratch-pill {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 1040;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px 10px 14px;
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
        border: 1.5px solid rgba(245, 158, 11, 0.4);
        border-radius: 9999px;
        box-shadow: 0 10px 30px -5px rgba(67, 56, 202, 0.5), 0 0 20px rgba(245, 158, 11, 0.35);
        color: #ffffff;
        cursor: pointer;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none;
        animation: floatPillGlow 3s infinite ease-in-out;
    }
    .floating-scratch-pill:hover {
        transform: translateY(-4px) scale(1.04);
        box-shadow: 0 16px 36px -4px rgba(67, 56, 202, 0.65), 0 0 28px rgba(245, 158, 11, 0.6);
        border-color: #f59e0b;
    }
    .floating-scratch-pill:active {
        transform: translateY(-1px) scale(0.98);
    }
    .floating-gift-icon {
        font-size: 1.4rem;
        display: inline-block;
        animation: giftShake 2.5s infinite ease-in-out;
    }
    .floating-scratch-text {
        display: flex;
        flex-direction: column;
        text-align: left;
        line-height: 1.15;
    }
    .floating-scratch-text .pill-title {
        font-size: 0.82rem;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: 0.02em;
    }
    .floating-scratch-text .pill-subtitle {
        font-size: 0.68rem;
        color: #fcd34d;
        font-weight: 600;
    }
    .floating-sparkle-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #f59e0b;
        box-shadow: 0 0 8px #f59e0b;
        display: inline-block;
        animation: pulseSparkle 1.8s infinite;
    }

    @keyframes floatPillGlow {
        0%, 100% { box-shadow: 0 10px 30px -5px rgba(67, 56, 202, 0.5), 0 0 18px rgba(245, 158, 11, 0.35); }
        50% { box-shadow: 0 14px 34px -5px rgba(67, 56, 202, 0.6), 0 0 26px rgba(245, 158, 11, 0.55); }
    }
    @keyframes giftShake {
        0%, 100% { transform: rotate(0deg); }
        15% { transform: rotate(-14deg) scale(1.1); }
        30% { transform: rotate(14deg) scale(1.1); }
        45% { transform: rotate(-8deg); }
        60% { transform: rotate(8deg); }
        75% { transform: rotate(0deg); }
    }
    @keyframes pulseSparkle {
        0%, 100% { transform: scale(0.9); opacity: 0.7; }
        50% { transform: scale(1.3); opacity: 1; }
    }

    @media (max-width: 768px) {
        .floating-scratch-pill {
            bottom: 16px;
            right: 16px;
            padding: 8px 14px 8px 12px;
        }
        .floating-scratch-text .pill-title {
            font-size: 0.78rem;
        }
        .floating-scratch-text .pill-subtitle {
            font-size: 0.64rem;
        }
    }

    /* ── Scratch Modal Design ── */
    .scratch-modal-content {
        border-radius: 24px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 25px 60px -15px rgba(15, 23, 42, 0.35);
        max-height: 90vh;
        display: flex;
        flex-direction: column;
    }
    #scratchCardModal .modal-body {
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        max-height: calc(90vh - 65px);
    }
    #scratchCardModal .modal-body::-webkit-scrollbar {
        width: 5px;
    }
    #scratchCardModal .modal-body::-webkit-scrollbar-track {
        background: #f8fafc;
    }
    #scratchCardModal .modal-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .scratch-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
        font-size: 0.72rem;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 9999px;
        letter-spacing: 0.04em;
    }
    .scratch-scratched-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
        font-size: 0.7rem;
        font-weight: 800;
        padding: 3px 9px;
        border-radius: 9999px;
        letter-spacing: 0.03em;
    }
    .btn-close-scratch {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #f1f5f9;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-close-scratch:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* ── The Scratch Box ── */
    .scratch-card-box-wrapper {
        position: relative;
        width: 100%;
        height: 205px;
        border-radius: 20px;
        overflow: hidden;
        user-select: none;
        box-shadow: 0 10px 25px -6px rgba(15, 23, 42, 0.2);
        border: 2px solid {{ $activeTheme['border'] }};
    }
    .scratch-revealed-layer {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 14px 12px;
        color: #ffffff;
        z-index: 1;
        text-align: center;
    }
    .scratch-confetti-bg {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.2) 2px, transparent 2px);
        background-size: 16px 16px;
        opacity: 0.6;
        pointer-events: none;
    }
    .scratch-revealed-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .revealed-reward-img-box {
        display: inline-block;
        position: relative;
        margin-bottom: 4px;
    }
    .revealed-reward-img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        background: #ffffff;
        padding: 4px;
        border-radius: 12px;
        border: 2px solid rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.35);
        display: inline-block;
        animation: prizeImgFloat 2.5s infinite ease-in-out;
    }
    @keyframes prizeImgFloat {
        0%, 100% { transform: translateY(0px) scale(1); }
        50% { transform: translateY(-3px) scale(1.05); }
    }
    .revealed-tag {
        display: inline-block;
        background: rgba(255, 255, 255, 0.22);
        backdrop-filter: blur(6px);
        font-size: 0.68rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 2px 9px;
        border-radius: 9999px;
        margin-bottom: 4px;
    }
    .revealed-offer-text {
        font-size: 1.45rem;
        font-weight: 800;
        letter-spacing: -0.01em;
        line-height: 1.15;
        margin-bottom: 5px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
    }
    .revealed-coupon-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ffffff;
        color: #0f172a;
        padding: 5px 12px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        font-size: 0.85rem;
        margin-bottom: 6px;
    }
    .revealed-coupon-badge .coupon-label {
        font-weight: 700;
        font-size: 0.7rem;
        color: #64748b;
        letter-spacing: 0.05em;
    }
    .revealed-coupon-badge .coupon-code-val {
        font-weight: 800;
        letter-spacing: 0.06em;
        color: {{ $activeTheme['badge'] }};
    }
    .btn-copy-coupon-mini {
        background: transparent;
        border: none;
        color: #64748b;
        padding: 0 2px;
        cursor: pointer;
        transition: color 0.15s;
    }
    .btn-copy-coupon-mini:hover {
        color: #0f172a;
    }
    .revealed-desc-text {
        font-size: 0.78rem;
        opacity: 0.92;
        margin-bottom: 0;
        max-width: 320px;
        margin: 0 auto;
    }

    /* ── Canvas Overlay ── */
    .scratch-canvas-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 5;
        cursor: crosshair;
        touch-action: none;
        transition: opacity 0.5s ease-out;
    }
    .scratch-canvas-overlay.cleared {
        opacity: 0;
        pointer-events: none;
    }

    /* Hand pointer hint */
    .scratch-hand-hint {
        position: absolute;
        bottom: 14px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 6;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(8px);
        color: #ffffff;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 9999px;
        pointer-events: none;
        transition: opacity 0.3s;
    }
    .scratch-hand-hint .hand-icon {
        animation: handSwipe 1.8s infinite ease-in-out;
    }
    @keyframes handSwipe {
        0%, 100% { transform: translateX(-8px); }
        50% { transform: translateX(8px); }
    }

    .scratch-percent-indicator {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 6;
        background: rgba(0, 0, 0, 0.45);
        backdrop-filter: blur(6px);
        color: #ffffff;
        font-size: 0.68rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 9999px;
        pointer-events: none;
    }

    /* ── Form Styles ── */
    .scratch-form-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 4px;
    }
    .scratch-input {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        padding: 9px 14px;
        font-size: 0.88rem;
        transition: all 0.2s;
    }
    .scratch-input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
    }
    .btn-claim-scratch-reward {
        background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
        color: #ffffff;
        font-weight: 700;
        font-size: 0.92rem;
        padding: 12px;
        border-radius: 14px;
        border: none;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
        transition: all 0.2s;
    }
    .btn-claim-scratch-reward:hover {
        background: linear-gradient(135deg, #4338ca 0%, #3730a3 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(79, 70, 229, 0.45);
        color: #ffffff;
    }

    /* ── Voucher Status Strip ── */
    .scratch-status-strip {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 14px;
    }
    .status-pulse-dot {
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulseGreenDot 1.8s infinite;
        flex-shrink: 0;
    }
    @keyframes pulseGreenDot {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1.1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
    .status-title {
        color: #065f46;
        font-size: 0.82rem;
    }
    .status-verified-badge {
        background: rgba(16, 185, 129, 0.15);
        color: #047857;
        font-size: 0.7rem;
        font-weight: 700;
        border-radius: 6px;
        padding: 4px 8px;
    }

    /* ── Voucher Details Card ── */
    .voucher-info-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
    }
    .voucher-detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 7px 0;
        font-size: 0.82rem;
        border-bottom: 1px dashed #f1f5f9;
    }
    .voucher-detail-row:last-child {
        border-bottom: none;
    }
    .detail-label {
        color: #64748b;
        font-size: 0.8rem;
    }
    .detail-value {
        font-size: 0.82rem;
    }
    .voucher-code-pill {
        background: #f8fafc;
        color: #4338ca;
        border: 1.5px dashed #cbd5e1;
        padding: 3px 8px;
        border-radius: 8px;
        font-family: monospace;
        font-weight: 800;
        font-size: 0.88rem;
        letter-spacing: 0.06em;
    }
    .btn-copy-mini {
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-copy-mini:hover {
        background: #e2e8f0;
    }
    .terms-callout-box {
        background: #f8fafc;
        border-radius: 8px;
        padding: 8px 10px;
        font-size: 0.78rem;
        color: #475569;
        line-height: 1.4;
    }

    /* ── Verified Customer Card ── */
    .customer-verified-card {
        background: #f0fdf4;
        border: 1.5px solid #86efac;
        border-radius: 14px;
    }
    .verified-avatar {
        width: 34px;
        height: 34px;
        background: #22c55e;
        color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }
    .verified-name {
        color: #14532d;
        font-size: 0.82rem;
    }
    .verified-phone {
        color: #166534;
        font-size: 0.75rem;
    }

    /* ── Lead Form Card ── */
    .lead-form-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 18px;
        box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06);
    }
    .lead-header-icon-box {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
        color: #4f46e5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
        border: 1px solid rgba(99, 102, 241, 0.15);
    }
    .lead-input-label {
        font-size: 0.74rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .lead-input-group {
        display: flex;
        align-items: center;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        background: #f8fafc;
        transition: all 0.2s ease;
    }
    .lead-input-group:focus-within {
        border-color: #6366f1;
        background: #ffffff;
        box-shadow: 0 0 0 3.5px rgba(99, 102, 241, 0.12);
    }
    .lead-input-group.is-invalid-group {
        border-color: #ef4444 !important;
        background: #fff5f5 !important;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15) !important;
    }
    .lead-input-group.is-valid-group {
        border-color: #10b981 !important;
        background: #f0fdf4 !important;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12) !important;
    }
    .lead-input-addon {
        display: inline-flex;
        align-items: center;
        padding: 10px 12px;
        color: #64748b;
        background: transparent;
        font-size: 0.88rem;
    }
    .lead-input-addon.country-prefix {
        background: #f1f5f9;
        border-right: 1.5px solid #e2e8f0;
        padding: 9px 11px;
        font-size: 0.85rem;
    }
    .lead-input-addon.wa-addon {
        padding: 9px 12px;
    }
    .lead-input-field {
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
        padding: 10px 12px;
        font-size: 0.88rem;
        font-weight: 500;
        color: #0f172a;
        width: 100%;
    }
    .lead-input-field::placeholder {
        color: #94a3b8;
        font-size: 0.84rem;
        font-weight: 400;
    }
    .phone-validation-feedback {
        color: #dc2626;
        font-size: 0.74rem;
        font-weight: 600;
        margin-top: 5px;
        padding-left: 2px;
        display: flex;
        align-items: center;
    }
    .lead-security-badge {
        color: #64748b;
        font-size: 0.72rem;
        font-weight: 500;
    }

    /* ── Action Buttons ── */
    .btn-whatsapp-voucher {
        background: #25d366;
        color: #ffffff;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        padding: 13px 18px;
        font-size: 0.92rem;
        box-shadow: 0 4px 14px rgba(37, 211, 102, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        text-decoration: none;
        margin-top: 6px;
        margin-bottom: 14px;
    }
    .btn-whatsapp-voucher:hover {
        background: #1eb956;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(37, 211, 102, 0.45);
    }
    
    /* Hide floating badge when modal is active */
    body.modal-open #floatingScratchBadge {
        opacity: 0 !important;
        pointer-events: none !important;
        visibility: hidden !important;
        transform: scale(0.8) translateY(20px) !important;
        transition: opacity 0.2s, transform 0.2s !important;
    }

    /* ═══════════════════════════════════════════════════════ */
    /* ── COMPREHENSIVE MOBILE RESPONSIVE OPTIMIZATIONS ── */
    /* ═══════════════════════════════════════════════════════ */
    @media (max-width: 576px) {
        #scratchCardModal .modal-dialog {
            margin: 8px auto !important;
            max-width: calc(100% - 16px) !important;
            width: calc(100% - 16px) !important;
            min-height: calc(100% - 16px) !important;
            display: flex !important;
            align-items: center !important;
        }
        .scratch-modal-content {
            border-radius: 20px !important;
            max-height: calc(100dvh - 20px) !important;
            width: 100% !important;
        }
        .scratch-modal-header {
            padding: 10px 14px !important;
        }
        .scratch-header-badge {
            font-size: 0.68rem !important;
            padding: 2.5px 8px !important;
        }
        .scratch-scratched-pill {
            font-size: 0.66rem !important;
            padding: 2.5px 7px !important;
        }
        #scratchCardModal .modal-body {
            padding: 12px 14px 16px !important;
            max-height: calc(100dvh - 74px) !important;
            overscroll-behavior: contain;
        }
        .scratch-card-box-wrapper {
            height: 185px !important;
            border-radius: 16px !important;
            margin-bottom: 10px !important;
        }
        .scratch-revealed-layer {
            padding: 10px 12px !important;
        }
        .revealed-reward-img {
            width: 44px !important;
            height: 44px !important;
            border-radius: 10px !important;
        }
        .revealed-tag {
            font-size: 0.64rem !important;
            padding: 2px 8px !important;
            margin-bottom: 3px !important;
        }
        .revealed-offer-text {
            font-size: 1.3rem !important;
            margin-bottom: 4px !important;
        }
        .revealed-coupon-badge {
            padding: 3px 9px !important;
            font-size: 0.78rem !important;
            margin-bottom: 3px !important;
        }
        .revealed-desc-text {
            font-size: 0.72rem !important;
            max-width: 270px !important;
            line-height: 1.25 !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }
        .scratch-status-strip {
            padding: 7px 12px !important;
            margin-bottom: 10px !important;
            border-radius: 11px !important;
            font-size: 0.76rem !important;
        }
        .voucher-info-card {
            padding: 10px 14px !important;
            margin-bottom: 10px !important;
            border-radius: 14px !important;
        }
        .voucher-detail-row {
            padding: 5px 0 !important;
            font-size: 0.78rem !important;
        }
        .detail-label {
            font-size: 0.76rem !important;
        }
        .detail-value {
            font-size: 0.78rem !important;
        }
        .customer-verified-card {
            padding: 10px 14px !important;
            margin-bottom: 10px !important;
            border-radius: 14px !important;
        }
        .lead-form-card {
            padding: 15px 14px 16px !important;
            border-radius: 16px !important;
            margin-bottom: 10px !important;
        }
        .lead-header-icon-box {
            width: 36px !important;
            height: 36px !important;
            font-size: 0.95rem !important;
            border-radius: 9px !important;
        }
        .lead-input-label {
            font-size: 0.72rem !important;
            margin-bottom: 4px !important;
        }
        .lead-input-group {
            border-radius: 11px !important;
        }
        .lead-input-addon {
            padding: 9px 11px !important;
            font-size: 0.84rem !important;
        }
        .lead-input-addon.country-prefix {
            padding: 8px 10px !important;
            font-size: 0.82rem !important;
        }
        .lead-input-addon.wa-addon {
            padding: 8px 11px !important;
        }
        .lead-input-field {
            padding: 8px 11px !important;
            font-size: 16px !important;
        }
        .lead-input-field::placeholder {
            font-size: 0.84rem !important;
        }
        .phone-validation-feedback {
            font-size: 0.72rem !important;
            margin-top: 4px !important;
        }
        .btn-claim-scratch-reward {
            padding: 11px 14px !important;
            font-size: 0.9rem !important;
            border-radius: 11px !important;
            min-height: 44px !important;
        }
        .lead-security-badge {
            font-size: 0.68rem !important;
            margin-top: 7px !important;
        }
        .btn-whatsapp-voucher {
            padding: 11px 14px !important;
            font-size: 0.9rem !important;
            border-radius: 12px !important;
            margin-top: 5px !important;
            margin-bottom: 10px !important;
            min-height: 44px !important;
        }
        .btn-done-close {
            padding: 9px 12px !important;
            font-size: 0.84rem !important;
            border-radius: 12px !important;
        }
    }
</style>

<script>
    var scratchAudio = {
        audio: null,
        winAudio: null,
        isPlaying: false,
        stopTimer: null,
        init: function() {
            if (!this.audio) {
                this.audio = document.getElementById('scratchSoundAudio');
                if (!this.audio) {
                    this.audio = new Audio("{{ asset('mp3/scratch.mp3') }}");
                }
                if (this.audio) {
                    this.audio.loop = true;
                    this.audio.volume = 0.85;
                }
            }
            if (!this.winAudio) {
                this.winAudio = document.getElementById('scratchWinSoundAudio');
                if (!this.winAudio) {
                    this.winAudio = new Audio("{{ asset('mp3/won.mp3') }}");
                }
                if (this.winAudio) {
                    this.winAudio.volume = 0.95;
                }
            }
        },
        start: function() {
            this.init();
            if (!this.audio) return;

            if (this.audio.paused) {
                var promise = this.audio.play();
                if (promise !== undefined) {
                    promise.catch(function(e) {});
                }
            }
            this.isPlaying = true;

            // Automatically pause sound if user pauses scratching movement
            clearTimeout(this.stopTimer);
            var self = this;
            this.stopTimer = setTimeout(function() {
                self.stop();
            }, 180);
        },
        stop: function() {
            clearTimeout(this.stopTimer);
            if (this.audio && !this.audio.paused) {
                try {
                    this.audio.pause();
                } catch(e) {}
            }
            this.isPlaying = false;
        },
        playWinMusic: function() {
            this.stop();
            this.init();
            if (this.winAudio) {
                try {
                    this.winAudio.currentTime = 0;
                    var promise = this.winAudio.play();
                    if (promise !== undefined) {
                        promise.catch(function(e) {});
                    }
                } catch(e) {}
            }
        }
    };

    var isIpAlreadyScratched = @json(!empty($scratchCardAlreadyScratched));
    var localKey = 'askreview_scratched_' + {{ $activeScratchCard->id }};
    var isLocalAlreadyScratched = (localStorage.getItem(localKey) === 'true');

    var scratchCardInstance = {
        canvas: null,
        ctx: null,
        dpr: 1,
        isDrawing: false,
        scratchedPercent: 0,
        isCompleted: isIpAlreadyScratched || isLocalAlreadyScratched,
        theme: "{{ $theme }}",
        primaryColor: "{{ $activeTheme['canvas_color'] }}",
        hasStarted: false,
        hasTracked: false
    };

    // Immediate sync if already scratched
    if (scratchCardInstance.isCompleted) {
        var cv = document.getElementById('scratchCanvas');
        if (cv) cv.style.display = 'none';
        var hnt = document.getElementById('scratchHandHint');
        if (hnt) hnt.style.display = 'none';
        var pw = document.getElementById('scratchPercentIndicator');
        if (pw) pw.style.display = 'none';
        var dw = document.getElementById('scratchRevealedDetailsWrap');
        if (dw) {
            dw.classList.remove('d-none');
            dw.style.display = 'block';
        }
        var hb = document.getElementById('headerScratchedBadge');
        if (hb) hb.classList.remove('d-none');
    }

    function trackScratchEvent() {
        if (scratchCardInstance.hasTracked) return;
        scratchCardInstance.hasTracked = true;
        try {
            localStorage.setItem(localKey, 'true');
        } catch(e) {}

        fetch("{{ url('/u/scratch_card/track_scratch') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ scratch_card_id: {{ $activeScratchCard->id }} })
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data && data.already_scratched) {
                // If 1 IP already scratched, stop further scratching and reveal details
                scratchCardInstance.isCompleted = true;
                completeScratchReveal();
            }
        })
        .catch(function(e) { console.log('Track scratch err', e); });
    }

    function open_scratch_card_modal() {
        scratchAudio.init();
        var modalEl = document.getElementById('scratchCardModal');
        if (!modalEl) return;

        if (!modalEl._hasScratchModalListeners) {
            modalEl.addEventListener('show.bs.modal', function() {
                var floatingBtn = document.getElementById('floatingScratchBadge');
                if (floatingBtn) floatingBtn.style.setProperty('display', 'none', 'important');
            });
            modalEl.addEventListener('shown.bs.modal', function() {
                var modalBody = modalEl.querySelector('.modal-body');
                if (modalBody) {
                    modalBody.scrollTop = 0;
                }
                if (!scratchCardInstance.isCompleted) {
                    initScratchCanvas();
                }
            });
            modalEl.addEventListener('hidden.bs.modal', function() {
                scratchAudio.stop();
                var floatingBtn = document.getElementById('floatingScratchBadge');
                if (floatingBtn) floatingBtn.style.removeProperty('display');
            });
            modalEl._hasScratchModalListeners = true;
        }

        var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();

        var modalBody = modalEl.querySelector('.modal-body');
        if (modalBody) {
            modalBody.scrollTop = 0;
        }

        // If already completed or IP already scratched, reveal directly with full details
        if (scratchCardInstance.isCompleted) {
            var canvas = document.getElementById('scratchCanvas');
            if (canvas) canvas.style.display = 'none';
            var hint = document.getElementById('scratchHandHint');
            if (hint) hint.style.display = 'none';
            var percentWrap = document.getElementById('scratchPercentIndicator');
            if (percentWrap) percentWrap.style.display = 'none';
            var detailsWrap = document.getElementById('scratchRevealedDetailsWrap');
            if (detailsWrap) {
                detailsWrap.classList.remove('d-none');
                detailsWrap.style.display = 'block';
            }
            var headerBadge = document.getElementById('headerScratchedBadge');
            if (headerBadge) headerBadge.classList.remove('d-none');
            return;
        }

        // Delay init canvas until modal is completely visible
        setTimeout(function() {
            initScratchCanvas();
        }, 250);
    }

    function close_scratch_card_modal() {
        scratchAudio.stop();
        var modalEl = document.getElementById('scratchCardModal');
        if (modalEl) {
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        }
    }

    function initScratchCanvas() {
        var canvas = document.getElementById('scratchCanvas');
        if (!canvas) return;
        var wrapper = document.getElementById('scratchCardBoxWrapper');
        if (!wrapper) return;

        // Reset state if already completed
        if (scratchCardInstance.isCompleted) {
            canvas.style.display = 'none';
            var hint = document.getElementById('scratchHandHint');
            if (hint) hint.style.display = 'none';
            var percentWrap = document.getElementById('scratchPercentIndicator');
            if (percentWrap) percentWrap.style.display = 'none';
            return;
        }

        var rect = wrapper.getBoundingClientRect();
        var width = rect.width || 380;
        var height = rect.height || 220;

        // HIGH-DPI Retina Device Scaling (eliminates blurry text on mobile)
        var dpr = window.devicePixelRatio || 1;
        canvas.width = Math.round(width * dpr);
        canvas.height = Math.round(height * dpr);
        canvas.style.width = width + 'px';
        canvas.style.height = height + 'px';

        var ctx = canvas.getContext('2d');
        ctx.scale(dpr, dpr);
        scratchCardInstance.canvas = canvas;
        scratchCardInstance.ctx = ctx;
        scratchCardInstance.dpr = dpr;

        // Draw scratch cover pattern
        drawScratchFoilCover(ctx, width, height);

        // Bind events
        canvas.removeEventListener('mousedown', handleScratchStart);
        canvas.removeEventListener('mousemove', handleScratchMove);
        window.removeEventListener('mouseup', handleScratchEnd);
        canvas.removeEventListener('touchstart', handleScratchStart);
        canvas.removeEventListener('touchmove', handleScratchMove);
        window.removeEventListener('touchend', handleScratchEnd);

        canvas.addEventListener('mousedown', handleScratchStart, false);
        canvas.addEventListener('mousemove', handleScratchMove, false);
        window.addEventListener('mouseup', handleScratchEnd, false);

        canvas.addEventListener('touchstart', handleScratchStart, { passive: false });
        canvas.addEventListener('touchmove', handleScratchMove, { passive: false });
        window.addEventListener('touchend', handleScratchEnd, { passive: false });
    }

    function drawScratchFoilCover(ctx, width, height) {
        ctx.save();
        ctx.globalCompositeOperation = 'source-over';

        // Rich metallic gradient cover
        var grad = ctx.createLinearGradient(0, 0, width, height);
        if (scratchCardInstance.theme === 'purple') {
            grad.addColorStop(0, '#7c3aed');
            grad.addColorStop(0.3, '#c084fc');
            grad.addColorStop(0.5, '#9333ea');
            grad.addColorStop(0.7, '#e879f9');
            grad.addColorStop(1, '#6b21a8');
        } else if (scratchCardInstance.theme === 'emerald') {
            grad.addColorStop(0, '#059669');
            grad.addColorStop(0.3, '#6ee7b7');
            grad.addColorStop(0.5, '#10b981');
            grad.addColorStop(0.7, '#a7f3d0');
            grad.addColorStop(1, '#064e3b');
        } else if (scratchCardInstance.theme === 'blue') {
            grad.addColorStop(0, '#2563eb');
            grad.addColorStop(0.3, '#93c5fd');
            grad.addColorStop(0.5, '#3b82f6');
            grad.addColorStop(0.7, '#bfdbfe');
            grad.addColorStop(1, '#1e40af');
        } else {
            // Gold foil default
            grad.addColorStop(0, '#b45309');
            grad.addColorStop(0.2, '#fde68a');
            grad.addColorStop(0.4, '#d97706');
            grad.addColorStop(0.6, '#fef3c7');
            grad.addColorStop(0.8, '#f59e0b');
            grad.addColorStop(1, '#78350f');
        }

        ctx.fillStyle = grad;
        ctx.fillRect(0, 0, width, height);

        // Add subtle geometric scratch pattern dots
        ctx.fillStyle = 'rgba(255, 255, 255, 0.12)';
        for (var x = 8; x < width; x += 16) {
            for (var y = 8; y < height; y += 16) {
                ctx.beginPath();
                ctx.arc(x, y, 1.5, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        // Draw Center Emblem Capsule Badge - High Contrast, Razor Sharp
        var badgeW = Math.min(240, width - 40);
        var badgeH = 56;
        var badgeX = (width - badgeW) / 2;
        var badgeY = (height - badgeH) / 2 - 10;
        var radius = 16;

        ctx.save();
        ctx.beginPath();
        if (typeof ctx.roundRect === 'function') {
            ctx.roundRect(badgeX, badgeY, badgeW, badgeH, radius);
        } else {
            ctx.rect(badgeX, badgeY, badgeW, badgeH);
        }
        ctx.fillStyle = 'rgba(15, 23, 42, 0.78)';
        ctx.fill();
        ctx.lineWidth = 1.5;
        ctx.strokeStyle = 'rgba(255, 255, 255, 0.35)';
        ctx.stroke();

        // Crisp typography with zero shadow blur
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillStyle = '#ffffff';
        ctx.font = 'bold 15px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
        ctx.fillText('✨ SCRATCH TO REVEAL', width / 2, badgeY + 19);

        ctx.font = '600 11.5px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
        ctx.fillStyle = '#fde047';
        ctx.fillText('Secret Prize Inside', width / 2, badgeY + 38);

        ctx.restore();
        ctx.restore();
    }

    function getCanvasCoords(e, canvas) {
        var rect = canvas.getBoundingClientRect();
        var clientX = e.clientX;
        var clientY = e.clientY;

        if (e.targetTouches && e.targetTouches.length > 0) {
            clientX = e.targetTouches[0].clientX;
            clientY = e.targetTouches[0].clientY;
        } else if (e.changedTouches && e.changedTouches.length > 0) {
            clientX = e.changedTouches[0].clientX;
            clientY = e.changedTouches[0].clientY;
        }

        return {
            x: clientX - rect.left,
            y: clientY - rect.top
        };
    }

    function handleScratchStart(e) {
        if (scratchCardInstance.isCompleted) return;
        if (e.cancelable) e.preventDefault();

        scratchCardInstance.isDrawing = true;
        scratchCardInstance.hasStarted = true;

        scratchAudio.start();
        trackScratchEvent();

        var hint = document.getElementById('scratchHandHint');
        if (hint) hint.style.opacity = '0';

        var coords = getCanvasCoords(e, scratchCardInstance.canvas);
        scratchCardInstance.lastX = coords.x;
        scratchCardInstance.lastY = coords.y;
        scratchAt(coords.x, coords.y);
    }

    function handleScratchMove(e) {
        if (!scratchCardInstance.isDrawing || scratchCardInstance.isCompleted) return;
        if (e.cancelable) e.preventDefault();

        scratchAudio.start();

        var coords = getCanvasCoords(e, scratchCardInstance.canvas);
        if (scratchCardInstance.lastX !== undefined && scratchCardInstance.lastY !== undefined) {
            scratchLine(scratchCardInstance.lastX, scratchCardInstance.lastY, coords.x, coords.y);
        } else {
            scratchAt(coords.x, coords.y);
        }
        scratchCardInstance.lastX = coords.x;
        scratchCardInstance.lastY = coords.y;
    }

    function handleScratchEnd(e) {
        if (!scratchCardInstance.isDrawing) return;
        scratchCardInstance.isDrawing = false;
        scratchCardInstance.lastX = undefined;
        scratchCardInstance.lastY = undefined;
        scratchAudio.stop();
        checkScratchPercentage();
    }

    function scratchAt(x, y) {
        var ctx = scratchCardInstance.ctx;
        if (!ctx) return;

        ctx.save();
        ctx.globalCompositeOperation = 'destination-out';
        ctx.beginPath();
        // Scratch radius
        ctx.arc(x, y, 22, 0, Math.PI * 2, false);
        ctx.fill();
        ctx.restore();

        // Throttle check percentage every 15 strokes
        if (Math.random() < 0.25) {
            checkScratchPercentage();
        }
    }

    function scratchLine(x1, y1, x2, y2) {
        var ctx = scratchCardInstance.ctx;
        if (!ctx) return;

        ctx.save();
        ctx.globalCompositeOperation = 'destination-out';
        ctx.lineWidth = 44;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.beginPath();
        ctx.moveTo(x1, y1);
        ctx.lineTo(x2, y2);
        ctx.stroke();
        ctx.restore();

        if (Math.random() < 0.25) {
            checkScratchPercentage();
        }
    }

    function checkScratchPercentage() {
        if (scratchCardInstance.isCompleted) return;
        var canvas = scratchCardInstance.canvas;
        var ctx = scratchCardInstance.ctx;
        if (!canvas || !ctx) return;

        try {
            var width = canvas.width;
            var height = canvas.height;
            // Sample grid for speed instead of every pixel
            var imgData = ctx.getImageData(0, 0, width, height);
            var pixels = imgData.data;
            var totalCount = 0;
            var transparentCount = 0;
            var step = 16; // Sample every 16th pixel for silky fast performance

            for (var i = 0; i < pixels.length; i += step * 4) {
                totalCount++;
                if (pixels[i + 3] < 128) {
                    transparentCount++;
                }
            }

            var percent = Math.round((transparentCount / totalCount) * 100);
            scratchCardInstance.scratchedPercent = percent;

            var percentIndicator = document.getElementById('scratchPercentText');
            if (percentIndicator) {
                percentIndicator.innerText = percent + '% Scratched';
            }

            // Threshold: If user scratched 40% or more, automatically reveal everything!
            if (percent >= 40) {
                completeScratchReveal();
            }
        } catch (err) {
            console.error('Scratch calculation error:', err);
        }
    }

    function completeScratchReveal() {
        if (scratchCardInstance.isCompleted) return;
        scratchCardInstance.isCompleted = true;

        try {
            localStorage.setItem(localKey, 'true');
        } catch(e) {}

        var canvas = scratchCardInstance.canvas;
        if (canvas) {
            canvas.classList.add('cleared');
            setTimeout(function() {
                canvas.style.display = 'none';
            }, 350);
        }

        var hint = document.getElementById('scratchHandHint');
        if (hint) hint.style.display = 'none';

        var percentWrap = document.getElementById('scratchPercentIndicator');
        if (percentWrap) percentWrap.style.display = 'none';

        var headerBadge = document.getElementById('headerScratchedBadge');
        if (headerBadge) headerBadge.classList.remove('d-none');

        var detailsWrap = document.getElementById('scratchRevealedDetailsWrap');
        if (detailsWrap) {
            detailsWrap.classList.remove('d-none');
            detailsWrap.style.display = 'block';
        }

        // Play celebratory win fanfare music!
        scratchAudio.playWinMusic();

        // Fire festive Confetti explosion
        fireScratchConfetti();

        // Optional haptic vibration
        if (window.navigator && window.navigator.vibrate) {
            window.navigator.vibrate([100, 50, 150]);
        }
    }

    function fireScratchConfetti() {
        if (typeof confetti === 'function') {
            confetti({
                particleCount: 80,
                spread: 70,
                origin: { y: 0.6 }
            });
            setTimeout(function() {
                confetti({
                    particleCount: 50,
                    angle: 60,
                    spread: 55,
                    origin: { x: 0 }
                });
                confetti({
                    particleCount: 50,
                    angle: 120,
                    spread: 55,
                    origin: { x: 1 }
                });
            }, 250);
        }
    }

    function copyScratchCoupon(code, btnEl) {
        if (!code) return;
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(code).then(function() {
                showCopyFeedback(btnEl, code);
            });
        } else {
            var input = document.createElement('input');
            input.value = code;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            showCopyFeedback(btnEl, code);
        }
    }

    function showCopyFeedback(btnEl, code) {
        if (btnEl) {
            var origHtml = btnEl.innerHTML;
            btnEl.innerHTML = '<i class="fa-solid fa-check text-success"></i> Copied!';
            setTimeout(function() { btnEl.innerHTML = origHtml; }, 2000);
        }
        if (typeof toastr !== 'undefined') toastr.success('Coupon code copied: ' + code);
    }

    function shareScratchVoucher(offer, code, store) {
        var shareText = '🎉 I won ' + offer + (code ? ' (Code: ' + code + ')' : '') + ' at ' + store + '! Check it out here: ' + window.location.href;
        if (navigator.share) {
            navigator.share({
                title: store + ' Reward Voucher',
                text: shareText,
                url: window.location.href
            }).catch(function() {});
        } else {
            copyScratchCoupon(code || shareText);
            if (typeof toastr !== 'undefined') toastr.info('Voucher details copied! Share with your friends.');
            else alert('Voucher details copied to clipboard!');
        }
    }

    function validateLivePhone(input) {
        var val = input.value.replace(/[^0-9]/g, '');
        if (val.length > 10) val = val.substring(0, 10);
        input.value = val;

        var group = document.getElementById('phoneInputGroup');
        var errEl = document.getElementById('phoneValidationErr');
        var errMsg = document.getElementById('phoneValidationErrMsg');

        if (val.length === 0) {
            if (errEl) errEl.classList.add('d-none');
            if (group) {
                group.classList.remove('is-invalid-group');
                group.classList.remove('is-valid-group');
            }
            return;
        }

        if (!/^[6-9]/.test(val)) {
            if (errMsg) errMsg.innerText = 'Mobile number must start with 6, 7, 8, or 9.';
            if (errEl) errEl.classList.remove('d-none');
            if (group) {
                group.classList.add('is-invalid-group');
                group.classList.remove('is-valid-group');
            }
            return;
        }

        if (val.length === 10) {
            if (errEl) errEl.classList.add('d-none');
            if (group) {
                group.classList.remove('is-invalid-group');
                group.classList.add('is-valid-group');
            }
        } else {
            if (errMsg) errMsg.innerText = 'Please enter 10 digits (' + val.length + '/10).';
            if (errEl) errEl.classList.remove('d-none');
            if (group) {
                group.classList.add('is-invalid-group');
                group.classList.remove('is-valid-group');
            }
        }
    }

    function submitScratchLead(e) {
        e.preventDefault();
        var form = document.getElementById('scratchLeadClaimForm');
        var btn = document.getElementById('btnSubmitScratchLead');
        var btnText = btn.querySelector('.btn-text');
        var btnSpinner = btn.querySelector('.btn-spinner');

        var phoneInput = document.getElementById('scratchCustomerPhone');
        var group = document.getElementById('phoneInputGroup');
        var errEl = document.getElementById('phoneValidationErr');
        var errMsg = document.getElementById('phoneValidationErrMsg');

        var phoneVal = phoneInput ? phoneInput.value.replace(/[^0-9]/g, '') : '';
        if (phoneVal.length !== 10 || !/^[6-9]\d{9}$/.test(phoneVal)) {
            if (errMsg) errMsg.innerText = 'Please enter a valid 10-digit mobile number.';
            if (errEl) errEl.classList.remove('d-none');
            if (group) {
                group.classList.add('is-invalid-group');
                group.classList.remove('is-valid-group');
            }
            if (phoneInput) phoneInput.focus();
            return;
        }

        btnText.classList.add('d-none');
        btnSpinner.classList.remove('d-none');
        btn.disabled = true;

        var formData = new FormData(form);

        fetch("{{ url('/u/scratch_card/submit') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(function(res) {
            return res.json().then(function(data) {
                return { ok: res.ok, status: res.status, data: data };
            });
        })
        .then(function(result) {
            btnText.classList.remove('d-none');
            btnSpinner.classList.add('d-none');
            btn.disabled = false;

            var data = result.data;
            if (result.ok && (data.status || data.success)) {
                // Hide lead capture form
                var formWrap = document.getElementById('scratchLeadFormWrap');
                if (formWrap) {
                    formWrap.classList.add('d-none');
                    formWrap.style.display = 'none';
                }

                // Show verified customer card with saved details
                var verifiedCard = document.getElementById('customerVerifiedCard');
                if (verifiedCard) {
                    verifiedCard.classList.remove('d-none');
                    verifiedCard.style.display = 'block';
                }

                var nameDisp = document.getElementById('leadNameDisplay');
                if (nameDisp) nameDisp.innerText = formData.get('customer_name') || '';

                var phoneDisp = document.getElementById('leadPhoneDisplay');
                if (phoneDisp) phoneDisp.innerText = formData.get('customer_phone') || '';

                if (data.coupon_code) {
                    var detailCoupon = document.getElementById('detailCouponCodeDisplay');
                    if (detailCoupon) detailCoupon.innerText = data.coupon_code;
                    var cardCoupon = document.querySelector('.revealed-coupon-badge .coupon-code-val');
                    if (cardCoupon) cardCoupon.innerText = data.coupon_code;
                }

                // Show action buttons below claimed card
                var actionsWrap = document.getElementById('scratchClaimedActionsWrap');
                if (actionsWrap) {
                    actionsWrap.classList.remove('d-none');
                    actionsWrap.style.display = 'block';
                }

                fireScratchConfetti();
                if (typeof toastr !== 'undefined') toastr.success('Reward registered successfully!');
            } else {
                var errMsg = data.message || 'Something went wrong. Please check your details and try again.';
                if (data.errors) {
                    var errorList = [];
                    for (var key in data.errors) {
                        if (data.errors.hasOwnProperty(key)) {
                            errorList.push(data.errors[key].join(', '));
                        }
                    }
                    if (errorList.length > 0) errMsg = errorList.join('\n');
                }
                alert(errMsg);
            }
        })
        .catch(function(err) {
            btnText.classList.remove('d-none');
            btnSpinner.classList.add('d-none');
            btn.disabled = false;
            console.error('Submit lead error:', err);
            alert('Failed to submit. Please check your internet connection.');
        });
    }

    window.addEventListener('resize', function() {
        if (!scratchCardInstance.isCompleted) {
            var modalEl = document.getElementById('scratchCardModal');
            if (modalEl && modalEl.classList.contains('show')) {
                initScratchCanvas();
            }
        }
    });
</script>
@endif
