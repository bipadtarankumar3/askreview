@extends('adminLayouts.home')
@section('content')

<style>
/* Modern Support Center Styling */
.support-hero-card {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
    border-radius: 20px;
    padding: 32px 36px;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    margin-bottom: 28px;
    box-shadow: 0 15px 35px -10px rgba(15, 23, 42, 0.45);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.support-hero-card::before {
    content: '';
    position: absolute;
    top: -40%;
    right: -8%;
    width: 420px;
    height: 420px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(225, 29, 72, 0.22) 0%, rgba(249, 115, 22, 0.12) 40%, transparent 70%);
    pointer-events: none;
}

.support-hero-card::after {
    content: '';
    position: absolute;
    bottom: -50%;
    left: 20%;
    width: 320px;
    height: 320px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 65%);
    pointer-events: none;
}

.pulse-indicator {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #10b981;
    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    animation: pulse-green 1.8s infinite;
}

@keyframes pulse-green {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}

/* Channel Cards */
.channel-box {
    background: #ffffff;
    border-radius: 20px;
    padding: 28px 24px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
}

.channel-box:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 36px -8px rgba(15, 23, 42, 0.12);
}

.channel-icon-wrap {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.6rem;
    margin-bottom: 20px;
}

/* Channel Color Themes */
.channel-whatsapp {
    border-top: 4px solid #22c55e;
}
.channel-whatsapp .channel-icon-wrap {
    background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
    color: #15803d;
    box-shadow: 0 8px 18px rgba(34, 197, 94, 0.2);
}

.channel-phone {
    border-top: 4px solid #2563eb;
}
.channel-phone .channel-icon-wrap {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    color: #1d4ed8;
    box-shadow: 0 8px 18px rgba(37, 99, 235, 0.2);
}

.channel-email {
    border-top: 4px solid #ea580c;
}
.channel-email .channel-icon-wrap {
    background: linear-gradient(135deg, #ffedd5 0%, #fed7aa 100%);
    color: #c2410c;
    box-shadow: 0 8px 18px rgba(234, 88, 12, 0.2);
}

.copy-pill-btn {
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    color: #475569;
    border-radius: 8px;
    padding: 3px 8px;
    font-size: 0.72rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s ease;
}
.copy-pill-btn:hover {
    background: #e2e8f0;
    color: #1e293b;
}

/* Content cards */
.content-box-card {
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
    padding: 28px;
    height: 100%;
}

/* Accordion Custom Styling */
.accordion-custom .accordion-item {
    border: 1px solid #e2e8f0;
    border-radius: 12px !important;
    margin-bottom: 12px;
    overflow: hidden;
    background: #ffffff;
}
.accordion-custom .accordion-button {
    font-weight: 700;
    font-size: 0.92rem;
    color: #1e293b;
    padding: 16px 20px;
    background: #ffffff;
    box-shadow: none !important;
}
.accordion-custom .accordion-button:not(.collapsed) {
    background: #f8fafc;
    color: #2563eb;
    border-bottom: 1px solid #e2e8f0;
}
.accordion-custom .accordion-body {
    padding: 18px 20px;
    font-size: 0.88rem;
    color: #475569;
    line-height: 1.6;
    background: #ffffff;
}
</style>

<div class="container-fluid px-4 py-3">

    <!-- ── HERO BANNER ── -->
    <div class="support-hero-card">
        <div class="row align-items-center">
            <div class="col-lg-8 col-12">
                <span class="badge mb-2 px-3 py-1.5 text-uppercase fw-bold" style="background: rgba(225, 29, 72, 0.2); color: #fecdd3; border: 1px solid rgba(225, 29, 72, 0.35); font-size: 0.72rem; letter-spacing: 0.06em;">
                    <i class="ti ti-headset me-1"></i> Dedicated Customer Support &amp; Success
                </span>
                <h2 class="fw-bold mb-2 text-white" style="letter-spacing: -0.02em;">How Can We Help You Today?</h2>
                <p class="text-white-50 mb-3" style="font-size: 0.95rem; max-width: 650px;">
                    Have questions about your Google Review link setup, subscription plans, custom domain white-labeling, or gamified scratch cards? Our dedicated customer team is ready to assist you.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-dark bg-opacity-50 text-white border border-secondary px-3 py-2 fw-normal" style="border-radius: 8px;">
                        <span class="pulse-indicator me-1.5"></span> Live Support: <strong>Mon – Sat (10 AM – 7 PM IST)</strong>
                    </span>
                    <span class="badge bg-dark bg-opacity-50 text-white border border-secondary px-3 py-2 fw-normal" style="border-radius: 8px;">
                        <i class="ti ti-bolt text-warning me-1"></i> WhatsApp Reply: <strong>~5 Minutes</strong>
                    </span>
                    <span class="badge bg-dark bg-opacity-50 text-white border border-secondary px-3 py-2 fw-normal" style="border-radius: 8px;">
                        <i class="ti ti-shield-check text-info me-1"></i> 100% Free Technical Assistance
                    </span>
                </div>
            </div>
            <div class="col-lg-4 col-12 text-lg-end mt-4 mt-lg-0">
                <a href="https://wa.me/919087868584?text=Hi%20AskReview%20Support%2C%20I%20need%20help%20with%20my%20account." target="_blank" 
                   class="btn btn-success fw-bold px-4 py-2.5 me-2" style="border-radius: 12px; background: #22c55e; border-color: #22c55e; box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);">
                    <i class="fa-brands fa-whatsapp me-1.5 fs-5 align-middle"></i> Start WhatsApp Chat
                </a>
                <a href="{{ url('admin/dashboard') }}" class="btn btn-outline-light px-3 py-2.5" style="border-radius: 12px;" title="Back to Dashboard">
                    <i class="ti ti-arrow-left"></i> Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- ── 3 CHANNELS GRID ── -->
    <div class="row g-4 mb-4">
        
        <!-- WhatsApp Priority Channel -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="channel-box channel-whatsapp">
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="channel-icon-wrap">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <span class="badge" style="background: #dcfce7; color: #15803d; font-size: 0.72rem; font-weight: 700; border-radius: 999px; padding: 4px 10px;">
                            <span class="pulse-indicator me-1"></span> Fastest Response
                        </span>
                    </div>

                    <h4 class="fw-bold text-slate-900 mb-1" style="font-size: 1.18rem;">WhatsApp Chat Support</h4>
                    <p class="text-muted mb-3" style="font-size: 0.86rem; line-height: 1.5;">
                        Connect directly with our support specialists for real-time onboarding help, troubleshooting, and link audits.
                    </p>

                    <div class="p-3 mb-3 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-brands fa-whatsapp text-success fs-5"></i>
                                <span class="fw-bold text-dark font-monospace" style="font-size: 0.95rem;">+91 90878 68584</span>
                            </div>
                            <button type="button" class="copy-pill-btn" onclick="copyToClipboard('+919087868584', this)">
                                <i class="ti ti-copy me-1"></i>Copy
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <a href="https://wa.me/919087868584?text=Hi%20AskReview%20Support%2C%20I%20need%20assistance%20with%20my%20account." target="_blank" 
                       class="btn btn-success w-100 fw-bold py-2.5" style="border-radius: 12px; background: #22c55e; border: none; box-shadow: 0 4px 14px rgba(34, 197, 94, 0.3);">
                        <i class="fa-brands fa-whatsapp me-1.5"></i> Open WhatsApp Chat
                    </a>
                    <small class="text-muted d-block text-center mt-2" style="font-size: 0.75rem;">
                        <i class="ti ti-clock me-1"></i> Typically replies in under 5 minutes
                    </small>
                </div>
            </div>
        </div>

        <!-- Direct Phone Helpline -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="channel-box channel-phone">
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="channel-icon-wrap">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <span class="badge" style="background: #dbeafe; color: #1d4ed8; font-size: 0.72rem; font-weight: 700; border-radius: 999px; padding: 4px 10px;">
                            <i class="ti ti-phone-call me-1"></i> Direct Line
                        </span>
                    </div>

                    <h4 class="fw-bold text-slate-900 mb-1" style="font-size: 1.18rem;">Direct Voice Helpline</h4>
                    <p class="text-muted mb-3" style="font-size: 0.86rem; line-height: 1.5;">
                        Prefer speaking to an expert? Call our dedicated business support line for urgent assistance and questions.
                    </p>

                    <div class="p-3 mb-3 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-phone text-primary fs-5"></i>
                                <span class="fw-bold text-dark font-monospace" style="font-size: 0.95rem;">90 8786 8584</span>
                            </div>
                            <button type="button" class="copy-pill-btn" onclick="copyToClipboard('9087868584', this)">
                                <i class="ti ti-copy me-1"></i>Copy
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <a href="tel:+919087868584" class="btn btn-primary w-100 fw-bold py-2.5" style="border-radius: 12px; background: #2563eb; border: none; box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);">
                        <i class="fa-solid fa-phone me-1.5"></i> Call +91 90878 68584
                    </a>
                    <small class="text-muted d-block text-center mt-2" style="font-size: 0.75rem;">
                        <i class="ti ti-calendar-time me-1"></i> Available Mon – Sat: 10:00 AM – 7:00 PM IST
                    </small>
                </div>
            </div>
        </div>

        <!-- Email Helpdesk & Billing -->
        <div class="col-lg-4 col-md-12 col-12">
            <div class="channel-box channel-email">
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="channel-icon-wrap">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <span class="badge" style="background: #ffedd5; color: #c2410c; font-size: 0.72rem; font-weight: 700; border-radius: 999px; padding: 4px 10px;">
                            <i class="ti ti-mail me-1"></i> Official Helpdesk
                        </span>
                    </div>

                    <h4 class="fw-bold text-slate-900 mb-1" style="font-size: 1.18rem;">Email &amp; Billing Desk</h4>
                    <p class="text-muted mb-3" style="font-size: 0.86rem; line-height: 1.5;">
                        For detailed requests, GST invoicing, custom domain requests, or formal inquiries, write to our desk.
                    </p>

                    <div class="p-3 mb-3 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2 text-truncate me-2">
                                <i class="fa-solid fa-envelope text-warning fs-5"></i>
                                <span class="fw-bold text-dark font-monospace text-truncate" style="font-size: 0.85rem;">info@digitalvyapari.online</span>
                            </div>
                            <button type="button" class="copy-pill-btn flex-shrink-0" onclick="copyToClipboard('info@digitalvyapari.online', this)">
                                <i class="ti ti-copy me-1"></i>Copy
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <a href="mailto:info@digitalvyapari.online?subject=AskReview%20Support%20Request%20-%20{{ urlencode(Auth::user()->name ?? 'User') }}" 
                       class="btn btn-warning w-100 fw-bold py-2.5 text-white" style="border-radius: 12px; background: #ea580c; border: none; box-shadow: 0 4px 14px rgba(234, 88, 12, 0.3);">
                        <i class="fa-solid fa-paper-plane me-1.5"></i> Send Support Email
                    </a>
                    <small class="text-muted d-block text-center mt-2" style="font-size: 0.75rem;">
                        <i class="ti ti-check me-1"></i> Guaranteed response within 2-4 business hours
                    </small>
                </div>
            </div>
        </div>

    </div>

    <!-- ── FREQUENTLY ASKED QUESTIONS ── -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="content-box-card">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div style="width: 46px; height: 46px; border-radius: 14px; background: #fdf2f8; color: #db2777; display: flex; align-items: center; justify-content: center; font-size: 1.35rem;">
                        <i class="ti ti-help"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-slate-800 mb-0" style="font-size: 1.18rem;">Frequently Asked Questions</h4>
                        <small class="text-muted">Instant answers to common account, feature, and integration questions.</small>
                    </div>
                </div>

                <div class="accordion accordion-custom" id="faqAccordion">
                    
                    <!-- Item 1: Scratch Card locked -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="ti ti-gift text-warning me-2"></i> Why is the Scratch Card or Video Testimonial feature locked?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Interactive Scratch &amp; Win cards and Video Testimonials are premium gamification tools included in <strong>Pro and Premium subscription plans</strong>. To unlock them for your account, visit <a href="{{ url('admin/user_payments_list') }}" class="fw-bold text-primary">Subscriptions &amp; Plans</a> or reach out to our WhatsApp support to activate access.
                            </div>
                        </div>
                    </div>

                    <!-- Item 2: Google Review Link -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="ti ti-brand-google text-danger me-2"></i> How do I link my Google Business Profile?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Head over to <a href="{{ url('admin/review_links') }}" class="fw-bold text-primary">Manage Form &gt; Review Links</a>, search for your business name or Google Map location, and select your Place ID. Positive reviewers (4 &amp; 5 stars) will automatically be directed straight to your Google Review submission box!
                            </div>
                        </div>
                    </div>

                    <!-- Item 3: Custom Domains -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="ti ti-world text-info me-2"></i> Can I use my own custom domain for my reviews?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes! You can point a custom subdomain (e.g. <code>reviews.yourbrand.com</code>) to your AskReview profile via a CNAME record. Our team will provision an SSL certificate and configure the routing for your brand. Message our support team to get your custom domain activated.
                            </div>
                        </div>
                    </div>

                    <!-- Item 4: QR Codes -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <i class="ti ti-qrcode text-success me-2"></i> How can I print my QR code standee or table cards?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                In your <a href="{{ url('admin/dashboard') }}" class="fw-bold text-primary">Dashboard</a>, you can download your custom QR code in high-resolution PNG or SVG format, ready to print for cashier counters, table tents, and customer billing desks.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Copy Notification Toast Script -->
<script>
function copyToClipboard(text, btnElement) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(showCopied);
    } else {
        // Fallback
        var textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            showCopied();
        } catch (err) {
            console.error('Copy fallback failed', err);
        }
        document.body.removeChild(textArea);
    }

    function showCopied() {
        var originalHtml = btnElement.innerHTML;
        btnElement.innerHTML = '<i class="ti ti-check text-success me-1"></i>Copied!';
        btnElement.style.background = '#dcfce7';
        btnElement.style.color = '#15803d';
        btnElement.style.borderColor = '#86efac';
        setTimeout(function() {
            btnElement.innerHTML = originalHtml;
            btnElement.style.background = '';
            btnElement.style.color = '';
            btnElement.style.borderColor = '';
        }, 2000);
    }
}
</script>

@endsection