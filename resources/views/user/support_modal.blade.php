<div class="p-4" style="background: #ffffff;">
    <div class="text-center mb-4">
        <div style="width: 54px; height: 54px; border-radius: 16px; background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%); border: 1px solid #fecdd3; display: inline-flex; align-items: center; justify-content: center; color: #e11d48; font-size: 1.5rem; margin-bottom: 12px; box-shadow: 0 6px 16px rgba(225, 29, 72, 0.15);">
            <i class="ti ti-headset"></i>
        </div>
        <h4 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin-bottom: 4px; letter-spacing: -0.01em;">How can we help you today?</h4>
        <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 0;">Connect with our support team directly through any of our channels below.</p>
    </div>

    <div class="d-flex flex-column gap-3 mb-4">
        <!-- WhatsApp Support Card -->
        <a href="https://wa.me/919087868584?text=Hi%2C%20I%20need%20support%20regarding%20my%20AskReview%20account." target="_blank" 
           class="support-channel-card d-flex align-items-center justify-content-between p-3" 
           style="text-decoration: none; border-radius: 14px; border: 1px solid #bbf7d0; background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); transition: all 0.2s ease;">
            <div class="d-flex align-items-center gap-3">
                <div style="width: 46px; height: 46px; border-radius: 12px; background: #22c55e; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <span style="font-weight: 700; font-size: 0.95rem; color: #14532d;">WhatsApp Chat</span>
                        <span class="badge" style="background: #dcfce7; color: #15803d; font-size: 0.68rem; font-weight: 700; border-radius: 999px; padding: 2px 8px;">Fastest ~5m</span>
                    </div>
                    <div style="font-size: 0.82rem; color: #166534; font-weight: 500;">+91 90878 68584</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1" style="color: #16a34a; font-weight: 700; font-size: 0.84rem;">
                <span>Chat</span>
                <i class="ti ti-chevron-right" style="font-size: 1rem;"></i>
            </div>
        </a>

        <!-- Phone Call Support Card -->
        <a href="tel:+919087868584" 
           class="support-channel-card d-flex align-items-center justify-content-between p-3" 
           style="text-decoration: none; border-radius: 14px; border: 1px solid #bfdbfe; background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%); transition: all 0.2s ease;">
            <div class="d-flex align-items-center gap-3">
                <div style="width: 46px; height: 46px; border-radius: 12px; background: #2563eb; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <span style="font-weight: 700; font-size: 0.95rem; color: #1e3a8a;">Direct Phone</span>
                        <span class="badge" style="background: #dbeafe; color: #1d4ed8; font-size: 0.68rem; font-weight: 700; border-radius: 999px; padding: 2px 8px;">Direct Line</span>
                    </div>
                    <div style="font-size: 0.82rem; color: #1d4ed8; font-weight: 500;">+91 90 8786 8584</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1" style="color: #2563eb; font-weight: 700; font-size: 0.84rem;">
                <span>Call</span>
                <i class="ti ti-chevron-right" style="font-size: 1rem;"></i>
            </div>
        </a>

        <!-- Email Support Card -->
        <a href="mailto:info@digitalvyapari.online?subject=AskReview%20Support%20Request%20-%20{{ urlencode(Auth::user()->name ?? 'User') }}" 
           class="support-channel-card d-flex align-items-center justify-content-between p-3" 
           style="text-decoration: none; border-radius: 14px; border: 1px solid #fed7aa; background: linear-gradient(135deg, #fff7ed 0%, #ffffff 100%); transition: all 0.2s ease;">
            <div class="d-flex align-items-center gap-3">
                <div style="width: 46px; height: 46px; border-radius: 12px; background: #ea580c; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; box-shadow: 0 4px 12px rgba(234, 88, 12, 0.3);">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div style="max-width: 250px; overflow: hidden;">
                    <div style="font-weight: 700; font-size: 0.95rem; color: #7c2d12;">Email Helpdesk</div>
                    <div style="font-size: 0.82rem; color: #c2410c; font-weight: 500; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">info@digitalvyapari.online</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1" style="color: #ea580c; font-weight: 700; font-size: 0.84rem;">
                <span>Email</span>
                <i class="ti ti-chevron-right" style="font-size: 1rem;"></i>
            </div>
        </a>
    </div>

    <!-- Operating Hours Banner -->
    <div class="p-3" style="background: #f8fafc; border-radius: 14px; border: 1px solid #e2e8f0;">
        <div class="d-flex align-items-center justify-content-between mb-1">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-regular fa-clock" style="color: #64748b; font-size: 0.9rem;"></i>
                <span style="font-size: 0.8rem; font-weight: 700; color: #334155;">Support Hours</span>
            </div>
            <span class="badge" style="background: #dcfce7; color: #15803d; font-size: 0.7rem; font-weight: 700; border-radius: 999px; padding: 3px 8px;">
                <span class="pulse-active-dot me-1" style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#22c55e;"></span> Online
            </span>
        </div>
        <div style="font-size: 0.8rem; color: #64748b; line-height: 1.4;">
            Monday – Saturday: <strong>10:00 AM – 7:00 PM IST</strong><br>
            <span style="color: #059669; font-weight: 600;">Active Support Response</span>
        </div>
    </div>
</div>

<style>
.support-channel-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}
</style>
