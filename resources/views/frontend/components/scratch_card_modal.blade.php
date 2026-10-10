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
            <div class="scratch-modal-header d-flex align-items-center justify-content-between p-3 pb-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="scratch-header-badge">
                        <i class="fa-solid fa-sparkles"></i> EXCLUSIVE REWARD
                    </span>
                </div>
                <button type="button" class="btn-close-scratch" data-bs-dismiss="modal" aria-label="Close" onclick="close_scratch_card_modal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4 pt-1">
                <div class="text-center mb-3">
                    <h4 class="fw-bold mb-1 scratch-title-heading" style="color: #0f172a; font-size: 1.35rem;">
                        {{ $activeScratchCard->title ?: 'Scratch & Win Special Offer!' }}
                    </h4>
                    <p class="text-muted mb-0" style="font-size: 0.85rem;" id="scratchInstructionsText">
                        Rub the card below with your finger or cursor to uncover your mystery reward!
                    </p>
                </div>

                <!-- ── The Scratch Card Interactive Canvas Box ── -->
                <div class="scratch-card-box-wrapper mb-3" id="scratchCardBoxWrapper">
                    <!-- Underneath Revealed Layer -->
                    <div class="scratch-revealed-layer" id="scratchRevealedLayer" style="background: {{ $activeTheme['gradient'] }};">
                        <div class="scratch-confetti-bg"></div>
                        <div class="scratch-revealed-inner text-center">
                            @if(!empty($activeScratchCard->image))
                                <div class="revealed-reward-img-box mb-1.5">
                                    <img src="{{ asset($activeScratchCard->image) }}" alt="{{ $activeScratchCard->title }}" class="revealed-reward-img">
                                </div>
                            @endif
                            <span class="revealed-tag"><i class="fa-solid fa-gift"></i> YOU WON!</span>
                            <h3 class="revealed-offer-text">{{ $activeScratchCard->offer_text }}</h3>
                            @if(!empty($activeScratchCard->coupon_code))
                                <div class="revealed-coupon-badge" id="revealedCouponBadge">
                                    <span class="coupon-label">CODE:</span>
                                    <span class="coupon-code-val">{{ $activeScratchCard->coupon_code }}</span>
                                    <button type="button" class="btn-copy-coupon-mini" onclick="copyScratchCoupon('{{ $activeScratchCard->coupon_code }}')" title="Copy Code">
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
                    <canvas id="scratchCanvas" class="scratch-canvas-overlay" width="380" height="230"></canvas>

                    <!-- Hint / Hand swipe animation over canvas (hidden after first scratch) -->
                    <div class="scratch-hand-hint" id="scratchHandHint">
                        <i class="fa-solid fa-hand-pointer hand-icon"></i>
                        <span>Scratch with finger or cursor</span>
                    </div>

                    <!-- Scratch Progress Indicator -->
                    <div class="scratch-percent-indicator" id="scratchPercentIndicator">
                        <span id="scratchPercentText">0% Scratched</span>
                    </div>
                </div>

                <!-- ── Unlocked Success Notification ── -->
                <div class="scratch-revealed-alert alert d-none mb-3" id="scratchRevealedAlert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-check text-success fa-lg"></i>
                        <div>
                            <strong style="color: #065f46; font-size: 0.88rem;">Offer Unlocked!</strong>
                            <div style="color: #047857; font-size: 0.78rem;">Submit your details below to activate and redeem this reward.</div>
                        </div>
                    </div>
                </div>

                <!-- ── Lead Capture Form (Shows once scratched or automatically opens below) ── -->
                <div class="scratch-lead-form-wrap" id="scratchLeadFormWrap" style="display: none;">
                    <form id="scratchLeadClaimForm" onsubmit="submitScratchLead(event)">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="user_name" value="{{ $user->name_url ?? ($user_name ?? '') }}">
                        <input type="hidden" name="scratch_card_id" value="{{ $activeScratchCard->id }}">
                        <input type="hidden" name="offer_won" value="{{ $activeScratchCard->offer_text }}">
                        <input type="hidden" name="coupon_code" value="{{ $activeScratchCard->coupon_code ?? '' }}">

                        <div class="form-group mb-2.5">
                            <label class="form-label scratch-form-label">
                                <i class="fa-regular fa-user me-1 text-muted"></i> Your Full Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="customer_name" class="form-control scratch-input" placeholder="e.g. Rahul Sharma" required>
                        </div>

                        <div class="form-group mb-2.5">
                            <label class="form-label scratch-form-label">
                                <i class="fa-brands fa-whatsapp me-1 text-success"></i> WhatsApp / Mobile Number <span class="text-danger">*</span>
                            </label>
                            <input type="tel" name="customer_phone" class="form-control scratch-input" placeholder="e.g. 9876543210" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label scratch-form-label">
                                <i class="fa-regular fa-envelope me-1 text-muted"></i> Email Address <span class="text-muted" style="font-size: 0.72rem;">(Optional)</span>
                            </label>
                            <input type="email" name="customer_email" class="form-control scratch-input" placeholder="e.g. rahul@example.com">
                        </div>

                        <button type="submit" class="btn btn-claim-scratch-reward w-100" id="btnSubmitScratchLead">
                            <span class="btn-text">
                                <i class="fa-solid fa-gift me-1"></i> Claim My {{ $activeScratchCard->offer_text }}
                            </span>
                            <span class="btn-spinner d-none">
                                <span class="spinner-border spinner-border-sm me-1" role="status"></span> Saving...
                            </span>
                        </button>
                    </form>
                </div>

                <!-- ── Success State after Lead Submitted ── -->
                <div class="scratch-success-state text-center py-3 d-none" id="scratchSuccessState">
                    <div class="scratch-success-icon-wrap mb-2">
                        <i class="fa-solid fa-circle-check text-success" style="font-size: 46px;"></i>
                    </div>
                    <h5 class="fw-bold mb-1" style="color: #0f172a;">Reward Claimed Successfully!</h5>
                    <p class="text-muted mb-3" style="font-size: 0.82rem;">
                        Your offer has been registered with <strong>{{ $user->name }}</strong>. Present this coupon on your next visit.
                    </p>

                    @if(!empty($activeScratchCard->coupon_code))
                        <div class="coupon-share-box p-3 mb-3" style="background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 14px;">
                            <div class="text-muted small mb-1" style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em;">Your Secret Coupon Code</div>
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <span class="fw-bold fs-4" style="color: #4f46e5; letter-spacing: 0.08em;" id="finalCouponCodeDisplay">{{ $activeScratchCard->coupon_code }}</span>
                                <button type="button" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;" onclick="copyScratchCoupon('{{ $activeScratchCard->coupon_code }}')">
                                    <i class="fa-regular fa-copy me-1"></i> Copy
                                </button>
                            </div>
                        </div>
                    @endif

                    @php
                        $userPhone = preg_replace('/[^0-9]/', '', $user->mobile ?? $user->phone ?? '');
                    @endphp
                    @if(!empty($userPhone))
                        <a href="https://wa.me/{{ $userPhone }}?text={{ urlencode('Hello ' . $user->name . ', I just scratched and won ' . $activeScratchCard->offer_text . ' (Coupon: ' . ($activeScratchCard->coupon_code ?? 'CLAIMED') . ') on your review page!') }}" target="_blank" class="btn btn-success w-100 mb-2" style="border-radius: 12px; font-weight: 700; padding: 11px;">
                            <i class="fa-brands fa-whatsapp fa-lg me-1"></i> Send Voucher via WhatsApp
                        </a>
                    @endif

                    <button type="button" class="btn btn-light w-100 text-muted" style="border-radius: 12px; font-weight: 600; font-size: 0.85rem;" onclick="close_scratch_card_modal()">
                        Done &amp; Continue Review
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
        height: 220px;
        border-radius: 20px;
        overflow: hidden;
        user-select: none;
        box-shadow: 0 12px 30px -8px rgba(15, 23, 42, 0.22);
        border: 2px solid {{ $activeTheme['border'] }};
    }
    .scratch-revealed-layer {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        color: #ffffff;
        z-index: 1;
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
    }
    .revealed-reward-img-box {
        display: inline-block;
        position: relative;
    }
    .revealed-reward-img {
        width: 54px;
        height: 54px;
        object-fit: cover;
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
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 2px 10px;
        border-radius: 9999px;
        margin-bottom: 6px;
    }
    .revealed-offer-text {
        font-size: 1.55rem;
        font-weight: 800;
        letter-spacing: -0.01em;
        line-height: 1.2;
        margin-bottom: 8px;
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

    var scratchCardInstance = {
        canvas: null,
        ctx: null,
        isDrawing: false,
        scratchedPercent: 0,
        isCompleted: false,
        theme: "{{ $theme }}",
        primaryColor: "{{ $activeTheme['canvas_color'] }}",
        hasStarted: false,
        hasTracked: false
    };

    function trackScratchEvent() {
        if (scratchCardInstance.hasTracked) return;
        scratchCardInstance.hasTracked = true;
        fetch("{{ url('/u/scratch_card/track_scratch') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ scratch_card_id: {{ $activeScratchCard->id }} })
        }).catch(e => console.log('Track scratch err', e));
    }

    function open_scratch_card_modal() {
        scratchAudio.init();
        var modalEl = document.getElementById('scratchCardModal');
        if (!modalEl) return;

        if (!modalEl._hasScratchAudioListener) {
            modalEl.addEventListener('hidden.bs.modal', function() {
                scratchAudio.stop();
            });
            modalEl._hasScratchAudioListener = true;
        }

        var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();

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

        // Reset state if already completed and reopened
        if (scratchCardInstance.isCompleted) {
            return;
        }

        var rect = wrapper.getBoundingClientRect();
        var width = rect.width || 380;
        var height = rect.height || 220;

        canvas.width = width;
        canvas.height = height;

        var ctx = canvas.getContext('2d');
        scratchCardInstance.canvas = canvas;
        scratchCardInstance.ctx = ctx;

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

        // Draw Center Golden Emblem
        ctx.textAlign = 'center';
        ctx.fillStyle = '#ffffff';
        ctx.font = 'bold 15px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
        ctx.shadowColor = 'rgba(0,0,0,0.4)';
        ctx.shadowBlur = 6;
        ctx.fillText('🎁 SCRATCH HERE', width / 2, height / 2 - 8);

        ctx.font = '12px -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
        ctx.fillStyle = 'rgba(255, 255, 255, 0.88)';
        ctx.shadowBlur = 4;
        ctx.fillText('Rub with finger or mouse to win', width / 2, height / 2 + 14);

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
        scratchAt(coords.x, coords.y);
    }

    function handleScratchMove(e) {
        if (!scratchCardInstance.isDrawing || scratchCardInstance.isCompleted) return;
        if (e.cancelable) e.preventDefault();

        scratchAudio.start();

        var coords = getCanvasCoords(e, scratchCardInstance.canvas);
        scratchAt(coords.x, coords.y);
    }

    function handleScratchEnd(e) {
        if (!scratchCardInstance.isDrawing) return;
        scratchCardInstance.isDrawing = false;
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

        var canvas = scratchCardInstance.canvas;
        if (canvas) {
            canvas.classList.add('cleared');
        }

        var percentWrap = document.getElementById('scratchPercentIndicator');
        if (percentWrap) percentWrap.style.display = 'none';

        var instructions = document.getElementById('scratchInstructionsText');
        if (instructions) {
            instructions.innerHTML = '<strong class="text-success"><i class="fa-solid fa-gift"></i> Congratulations! Fill the form below to claim your reward!</strong>';
        }

        var alertBox = document.getElementById('scratchRevealedAlert');
        if (alertBox) alertBox.classList.remove('d-none');

        var formWrap = document.getElementById('scratchLeadFormWrap');
        if (formWrap) {
            formWrap.style.display = 'block';
            formWrap.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
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

    function copyScratchCoupon(code) {
        if (!code) return;
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(code).then(function() {
                if (typeof toastr !== 'undefined') toastr.success('Coupon code copied: ' + code);
                else alert('Coupon code copied: ' + code);
            });
        } else {
            var input = document.createElement('input');
            input.value = code;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            if (typeof toastr !== 'undefined') toastr.success('Coupon code copied: ' + code);
            else alert('Coupon code copied: ' + code);
        }
    }

    function submitScratchLead(e) {
        e.preventDefault();
        var form = document.getElementById('scratchLeadClaimForm');
        var btn = document.getElementById('btnSubmitScratchLead');
        var btnText = btn.querySelector('.btn-text');
        var btnSpinner = btn.querySelector('.btn-spinner');

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
                // Hide form, show final success
                document.getElementById('scratchLeadFormWrap').style.display = 'none';
                document.getElementById('scratchRevealedAlert').classList.add('d-none');
                document.getElementById('scratchSuccessState').classList.remove('d-none');
                if (data.coupon_code) {
                    var finalDisplay = document.getElementById('finalCouponCodeDisplay');
                    if (finalDisplay) finalDisplay.innerText = data.coupon_code;
                }
                fireScratchConfetti();
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
</script>
@endif
