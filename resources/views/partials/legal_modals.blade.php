@php
    $defaultTerms = (new \App\Http\Controllers\UserController())->getDefaultTerms();
    $defaultPrivacy = (new \App\Http\Controllers\UserController())->getDefaultPrivacy();
    $termsContent = \App\Models\Setting::get('terms_and_conditions', $defaultTerms);
    $privacyContent = \App\Models\Setting::get('privacy_policy', $defaultPrivacy);
@endphp

<!-- =========================================================================
     Standalone Universal Legal Modals (Terms & Privacy)
     Guaranteed zero dependency conflict on Login, Signup, or Admin pages
     ========================================================================= -->

<!-- Terms & Conditions Modal -->
<div class="legal-custom-modal" id="modalTermsConditions" role="dialog" aria-modal="true" aria-labelledby="termsModalTitle">
  <div class="legal-modal-backdrop-layer" onclick="closeAllLegalModals(event)"></div>
  <div class="legal-modal-dialog-box">
    
    <!-- Modal Header -->
    <div class="legal-modal-header-bar">
      <div>
        <span class="legal-modal-badge legal-badge-blue">AskReview Legal</span>
        <h3 class="legal-modal-title" id="termsModalTitle">Terms &amp; Conditions</h3>
      </div>
      <button type="button" class="legal-modal-close-btn" onclick="closeAllLegalModals(event)" aria-label="Close modal">&times;</button>
    </div>

    <!-- Modal Body -->
    <div class="legal-modal-scroll-body">
      <div class="legal-policy-rendered-content">
        {!! $termsContent !!}
      </div>
    </div>

    <!-- Modal Footer -->
    <div class="legal-modal-footer-bar">
      <span class="legal-modal-footer-note">
        <i class="bi bi-shield-check"></i> Verified Platform Policy
      </span>
      <button type="button" class="legal-modal-action-btn" onclick="closeAllLegalModals(event)">
        I Understand &amp; Close
      </button>
    </div>

  </div>
</div>

<!-- Privacy Policy Modal -->
<div class="legal-custom-modal" id="modalPrivacyPolicy" role="dialog" aria-modal="true" aria-labelledby="privacyModalTitle">
  <div class="legal-modal-backdrop-layer" onclick="closeAllLegalModals(event)"></div>
  <div class="legal-modal-dialog-box">
    
    <!-- Modal Header -->
    <div class="legal-modal-header-bar">
      <div>
        <span class="legal-modal-badge legal-badge-green">Data Protection &amp; Privacy</span>
        <h3 class="legal-modal-title" id="privacyModalTitle">Privacy Policy</h3>
      </div>
      <button type="button" class="legal-modal-close-btn" onclick="closeAllLegalModals(event)" aria-label="Close modal">&times;</button>
    </div>

    <!-- Modal Body -->
    <div class="legal-modal-scroll-body">
      <div class="legal-policy-rendered-content">
        {!! $privacyContent !!}
      </div>
    </div>

    <!-- Modal Footer -->
    <div class="legal-modal-footer-bar">
      <span class="legal-modal-footer-note">
        <i class="bi bi-lock-fill"></i> 256-Bit SSL Encrypted
      </span>
      <button type="button" class="legal-modal-action-btn" onclick="closeAllLegalModals(event)">
        I Understand &amp; Close
      </button>
    </div>

  </div>
</div>

<style>
/* Reset & Base Modal Overlay - Hidden by default */
.legal-custom-modal {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  width: 100vw !important;
  height: 100vh !important;
  z-index: 99999999 !important;
  display: none !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 16px !important;
  box-sizing: border-box !important;
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
}

/* Shown state */
.legal-custom-modal.is-open {
  display: flex !important;
}

/* Glassmorphism Backdrop */
.legal-modal-backdrop-layer {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  background-color: rgba(15, 23, 42, 0.65) !important;
  backdrop-filter: blur(8px) !important;
  -webkit-backdrop-filter: blur(8px) !important;
  animation: legalFadeIn 0.2s ease-out forwards !important;
  cursor: pointer !important;
}

/* Dialog Container Box */
.legal-modal-dialog-box {
  position: relative !important;
  z-index: 10 !important;
  width: 100% !important;
  max-width: 680px !important;
  max-height: 85vh !important;
  background: #ffffff !important;
  border-radius: 22px !important;
  box-shadow: 0 25px 65px -10px rgba(15, 23, 42, 0.4), 0 10px 25px -5px rgba(15, 23, 42, 0.15) !important;
  display: flex !important;
  flex-direction: column !important;
  overflow: hidden !important;
  animation: legalScaleUp 0.25s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
  border: 1px solid rgba(255, 255, 255, 0.2) !important;
}

/* Header */
.legal-modal-header-bar {
  padding: 22px 28px !important;
  background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 60%, #312e81 100%) !important;
  color: #ffffff !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
  flex-shrink: 0 !important;
}

.legal-modal-badge {
  display: inline-block !important;
  font-size: 11px !important;
  font-weight: 700 !important;
  text-transform: uppercase !important;
  letter-spacing: 0.06em !important;
  padding: 3px 10px !important;
  border-radius: 9999px !important;
  margin-bottom: 6px !important;
}

.legal-badge-blue {
  background: rgba(56, 189, 248, 0.18) !important;
  color: #38bdf8 !important;
  border: 1px solid rgba(56, 189, 248, 0.4) !important;
}

.legal-badge-green {
  background: rgba(52, 211, 153, 0.18) !important;
  color: #34d399 !important;
  border: 1px solid rgba(52, 211, 153, 0.4) !important;
}

.legal-modal-title {
  color: #ffffff !important;
  font-size: 20px !important;
  font-weight: 800 !important;
  margin: 0 !important;
  letter-spacing: -0.01em !important;
}

/* Close Button */
.legal-modal-close-btn {
  background: rgba(255, 255, 255, 0.1) !important;
  border: 1px solid rgba(255, 255, 255, 0.15) !important;
  color: #ffffff !important;
  font-size: 26px !important;
  line-height: 1 !important;
  width: 36px !important;
  height: 36px !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  cursor: pointer !important;
  transition: all 0.2s ease !important;
  padding: 0 0 2px 0 !important;
}

.legal-modal-close-btn:hover {
  background: rgba(255, 255, 255, 0.22) !important;
  transform: rotate(90deg) !important;
}

/* Scrollable Body */
.legal-modal-scroll-body {
  padding: 28px !important;
  overflow-y: auto !important;
  flex: 1 1 auto !important;
  font-size: 14.5px !important;
  line-height: 1.75 !important;
  color: #334155 !important;
  background: #ffffff !important;
}

/* Custom Scrollbar */
.legal-modal-scroll-body::-webkit-scrollbar {
  width: 6px !important;
}
.legal-modal-scroll-body::-webkit-scrollbar-track {
  background: #f1f5f9 !important;
}
.legal-modal-scroll-body::-webkit-scrollbar-thumb {
  background: #cbd5e1 !important;
  border-radius: 9999px !important;
}

/* Content Formatting */
.legal-policy-rendered-content h4 {
  color: #0f172a !important;
  font-size: 15.5px !important;
  font-weight: 700 !important;
  margin-top: 22px !important;
  margin-bottom: 8px !important;
  letter-spacing: -0.01em !important;
}

.legal-policy-rendered-content h4:first-child {
  margin-top: 0 !important;
}

.legal-policy-rendered-content p {
  color: #475569 !important;
  margin: 0 0 14px 0 !important;
  font-size: 14px !important;
  line-height: 1.7 !important;
}

.legal-policy-rendered-content ul {
  padding-left: 20px !important;
  margin: 0 0 16px 0 !important;
  color: #475569 !important;
}

.legal-policy-rendered-content li {
  margin-bottom: 6px !important;
  font-size: 14px !important;
  line-height: 1.6 !important;
}

/* Footer */
.legal-modal-footer-bar {
  padding: 16px 28px !important;
  background: #f8fafc !important;
  border-top: 1px solid #e2e8f0 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  flex-shrink: 0 !important;
}

.legal-modal-footer-note {
  font-size: 12.5px !important;
  color: #64748b !important;
  font-weight: 600 !important;
  display: flex !important;
  align-items: center !important;
  gap: 6px !important;
}

.legal-modal-footer-note i {
  color: #10b981 !important;
  font-size: 14px !important;
}

.legal-modal-action-btn {
  background: #0f172a !important;
  color: #ffffff !important;
  border: none !important;
  font-size: 13.5px !important;
  font-weight: 700 !important;
  padding: 10px 24px !important;
  border-radius: 9999px !important;
  cursor: pointer !important;
  transition: all 0.2s ease !important;
}

.legal-modal-action-btn:hover {
  background: #1e293b !important;
  box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2) !important;
}

/* Keyframes */
@keyframes legalFadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes legalScaleUp {
  from {
    opacity: 0;
    transform: scale(0.92) translateY(12px);
  }
  to {
    opacity: 1;
    transform: scale(1) translateY(0);
  }
}
</style>

<script>
// Standalone modal functions exposed to global window
window.showTermsModal = function(e) {
    if (e) {
        if (typeof e.preventDefault === 'function') e.preventDefault();
        if (typeof e.stopPropagation === 'function') e.stopPropagation();
    }
    window.closeAllLegalModals();
    var modal = document.getElementById('modalTermsConditions');
    if (modal) {
        modal.classList.add('is-open');
        modal.style.setProperty('display', 'flex', 'important');
        document.body.style.overflow = 'hidden';
    }
    return false;
};

window.showPrivacyModal = function(e) {
    if (e) {
        if (typeof e.preventDefault === 'function') e.preventDefault();
        if (typeof e.stopPropagation === 'function') e.stopPropagation();
    }
    window.closeAllLegalModals();
    var modal = document.getElementById('modalPrivacyPolicy');
    if (modal) {
        modal.classList.add('is-open');
        modal.style.setProperty('display', 'flex', 'important');
        document.body.style.overflow = 'hidden';
    }
    return false;
};

window.closeAllLegalModals = function(e) {
    if (e) {
        if (typeof e.preventDefault === 'function') e.preventDefault();
        if (typeof e.stopPropagation === 'function') e.stopPropagation();
    }
    var terms = document.getElementById('modalTermsConditions');
    var privacy = document.getElementById('modalPrivacyPolicy');
    if (terms) {
        terms.classList.remove('is-open');
        terms.style.setProperty('display', 'none', 'important');
    }
    if (privacy) {
        privacy.classList.remove('is-open');
        privacy.style.setProperty('display', 'none', 'important');
    }
    document.body.style.overflow = '';
    return false;
};

// Handle ESC key press to close modal
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' || event.keyCode === 27) {
        window.closeAllLegalModals();
    }
});

// Auto-bind click handlers for convenience
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-legal-modal="terms"], .open-terms-modal').forEach(function(el) {
        el.addEventListener('click', function(e) {
            window.showTermsModal(e);
        });
    });
    document.querySelectorAll('[data-legal-modal="privacy"], .open-privacy-modal').forEach(function(el) {
        el.addEventListener('click', function(e) {
            window.showPrivacyModal(e);
        });
    });
});
</script>
