@extends('adminLayouts.home')
@section('content')

<!-- Summernote Rich Text Editor CSS -->
<link rel="stylesheet" href="{{ asset('adminAssets/libs/summernote/dist/summernote-lite.min.css') }}">
<style>
/* Custom Summernote Styling to blend with modern admin UI */
.note-editor.note-frame {
  border: 1px solid #e2e8f0 !important;
  border-radius: 14px !important;
  box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04) !important;
  overflow: hidden !important;
  background: #ffffff !important;
  width: 100% !important;
}
.note-editor.note-frame .note-toolbar {
  background: #f8fafc !important;
  border-bottom: 1px solid #e2e8f0 !important;
  padding: 8px 10px !important;
  display: flex !important;
  flex-wrap: wrap !important;
  align-items: center !important;
  gap: 4px !important;
}
.note-editor.note-frame .note-btn-group {
  margin-right: 3px !important;
  margin-bottom: 3px !important;
}
.note-editor.note-frame .note-toolbar .note-btn {
  background: #ffffff !important;
  border: 1px solid #e2e8f0 !important;
  border-radius: 8px !important;
  color: #334155 !important;
  padding: 5px 9px !important;
  font-size: 13px !important;
  box-shadow: none !important;
  transition: all 0.15s ease !important;
}
.note-editor.note-frame .note-toolbar .note-btn:hover,
.note-editor.note-frame .note-toolbar .note-btn.active {
  background: #e2e8f0 !important;
  border-color: #cbd5e1 !important;
  color: #0f172a !important;
}
.note-editor.note-frame .note-editing-area .note-editable {
  padding: 22px !important;
  font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
  font-size: 14.5px !important;
  line-height: 1.75 !important;
  color: #334155 !important;
  background: #ffffff !important;
  min-height: 380px !important;
  word-break: break-word !important;
}
.note-editor.note-frame .note-editing-area .note-editable h1,
.note-editor.note-frame .note-editing-area .note-editable h2,
.note-editor.note-frame .note-editing-area .note-editable h3,
.note-editor.note-frame .note-editing-area .note-editable h4 {
  color: #0f172a !important;
  font-weight: 700 !important;
  margin-top: 18px !important;
  margin-bottom: 8px !important;
}
.note-editor.note-frame .note-editing-area .note-editable p {
  margin-bottom: 12px !important;
  color: #475569 !important;
}
.note-editor.note-frame .note-statusbar {
  background: #f8fafc !important;
  border-top: 1px solid #e2e8f0 !important;
}
.note-dropdown-menu {
  border-radius: 10px !important;
  border: 1px solid #e2e8f0 !important;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
  padding: 6px !important;
  z-index: 99999 !important;
  max-width: 90vw !important;
}

/* Responsive adjustments for phones and tablets */
@media (max-width: 767.98px) {
  .legal-page-header {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 12px !important;
  }
  .legal-header-badge {
    align-self: flex-start !important;
  }
  .legal-card-header {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 12px !important;
  }
  .legal-card-header .last-updated-box {
    text-align: left !important;
    width: 100% !important;
  }
  .legal-nav-tabs {
    flex-direction: column !important;
    width: 100% !important;
  }
  .legal-nav-tabs .nav-link {
    width: 100% !important;
    text-align: center !important;
  }
  .legal-action-bar {
    flex-direction: column !important;
    align-items: stretch !important;
    gap: 10px !important;
  }
  .legal-action-btns {
    width: 100% !important;
    display: flex !important;
    justify-content: space-between !important;
  }
  .legal-action-btns .btn {
    flex: 1 !important;
  }
  .note-editor.note-frame .note-toolbar .note-btn {
    padding: 4px 7px !important;
    font-size: 11.5px !important;
  }
  .note-editor.note-frame .note-editing-area .note-editable {
    padding: 14px !important;
    font-size: 13.5px !important;
    min-height: 280px !important;
  }
  .legal-footer-bar {
    flex-direction: column !important;
    gap: 14px !important;
    align-items: stretch !important;
    text-align: center !important;
  }
  .legal-footer-bar .btn-publish {
    width: 100% !important;
  }
}
</style>

<div class="container-fluid px-2 px-sm-3 px-md-4">
  
  <!-- Page Header -->
  <div class="card bg-light-info shadow-none position-relative overflow-hidden mb-3 mb-md-4" style="border-radius: 16px;">
    <div class="card-body px-3 px-md-4 py-3">
      <div class="d-flex legal-page-header justify-content-between align-items-center">
        <div>
          <h4 class="fw-bold mb-1 fs-5 fs-md-4" style="color: #0f172a;">Legal &amp; Policy Settings</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
              <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="{{ url('admin/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item text-muted">Platform Management</li>
              <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">Terms &amp; Privacy</li>
            </ol>
          </nav>
        </div>
        <div class="legal-header-badge">
          <span class="badge bg-light-primary text-primary px-3 py-2" style="border-radius: 9999px; font-weight: 600; font-size: 0.82rem;">
            <i class="ti ti-shield-check me-1"></i> SuperAdmin Only
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Card -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
        
        <div class="card-header bg-white border-bottom p-3 p-md-4 d-flex legal-card-header justify-content-between align-items-center">
          <div>
            <h5 class="fw-bold mb-1 fs-6 fs-md-5" style="color: #0f172a;">Manage Public Policies (Rich Text Editor)</h5>
            <p class="text-muted small mb-0">Use the rich visual text editor below to format, style, and update policies. Changes appear live on Login and Signup modals.</p>
          </div>
          <div class="last-updated-box">
            <small class="text-muted d-block" style="font-size: 0.78rem;">Last Updated:</small>
            <span class="badge bg-light-secondary text-dark fw-bold" style="font-size: 0.82rem;">{{ $lastUpdated ? date('d M Y, h:i A', strtotime($lastUpdated)) : 'Never' }}</span>
          </div>
        </div>

        <form method="POST" action="{{ route('admin.settings.legal.update') }}" id="legalSettingsForm">
          @csrf
          
          <div class="card-body p-3 p-md-4">
            
            <!-- Navigation Tabs -->
            <ul class="nav nav-pills mb-3 mb-md-4 gap-2 legal-nav-tabs" id="legalPolicyTabs" role="tablist">
              <li class="nav-item flex-fill flex-sm-grow-0" role="presentation">
                <button class="nav-link active px-3 px-sm-4 py-2 fw-bold w-100" id="terms-tab" data-bs-toggle="pill" data-bs-target="#terms-content" type="button" role="tab" aria-selected="true" style="border-radius: 10px;">
                  <i class="ti ti-file-text me-2"></i>Terms &amp; Conditions
                </button>
              </li>
              <li class="nav-item flex-fill flex-sm-grow-0" role="presentation">
                <button class="nav-link px-3 px-sm-4 py-2 fw-bold w-100" id="privacy-tab" data-bs-toggle="pill" data-bs-target="#privacy-content" type="button" role="tab" aria-selected="false" style="border-radius: 10px;">
                  <i class="ti ti-lock me-2"></i>Privacy Policy
                </button>
              </li>
            </ul>

            <div class="tab-content" id="legalPolicyTabContent">
              
              <!-- Tab 1: Terms & Conditions -->
              <div class="tab-pane fade show active" id="terms-content" role="tabpanel" aria-labelledby="terms-tab">
                <div class="d-flex legal-action-bar justify-content-between align-items-start align-items-sm-center mb-2">
                  <label for="terms_textarea" class="form-label fw-bold mb-0">
                    Terms &amp; Conditions Content <span class="text-danger">*</span>
                  </label>
                  <div class="legal-action-btns gap-2 d-flex">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="previewPolicy('Terms & Conditions', 'terms_textarea')">
                      <i class="ti ti-eye me-1"></i> Preview
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="resetTermsDefault()">
                      <i class="ti ti-refresh me-1"></i> Load Default
                    </button>
                  </div>
                </div>
                <div class="mb-3">
                  <textarea name="terms_and_conditions" id="terms_textarea" rows="16" class="form-control" required>{{ $terms }}</textarea>
                  <div class="form-text text-muted mt-2 d-flex flex-column flex-sm-row gap-2 justify-content-between align-items-start align-items-sm-center">
                    <span style="font-size: 0.82rem;"><i class="ti ti-sparkles me-1 text-primary"></i> Full formatting supported: Headings, Bold, Lists, Links, Colors, Tables, and HTML Code View.</span>
                    <span class="text-primary fw-semibold" style="cursor: pointer; font-size: 0.84rem; white-space: nowrap;" onclick="$('#terms_textarea').summernote('codeview.toggle')"><i class="ti ti-code me-1"></i>Toggle HTML View</span>
                  </div>
                </div>
              </div>

              <!-- Tab 2: Privacy Policy -->
              <div class="tab-pane fade" id="privacy-content" role="tabpanel" aria-labelledby="privacy-tab">
                <div class="d-flex legal-action-bar justify-content-between align-items-start align-items-sm-center mb-2">
                  <label for="privacy_textarea" class="form-label fw-bold mb-0">
                    Privacy Policy Content <span class="text-danger">*</span>
                  </label>
                  <div class="legal-action-btns gap-2 d-flex">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="previewPolicy('Privacy Policy', 'privacy_textarea')">
                      <i class="ti ti-eye me-1"></i> Preview
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3" onclick="resetPrivacyDefault()">
                      <i class="ti ti-refresh me-1"></i> Load Default
                    </button>
                  </div>
                </div>
                <div class="mb-3">
                  <textarea name="privacy_policy" id="privacy_textarea" rows="16" class="form-control" required>{{ $privacy }}</textarea>
                  <div class="form-text text-muted mt-2 d-flex flex-column flex-sm-row gap-2 justify-content-between align-items-start align-items-sm-center">
                    <span style="font-size: 0.82rem;"><i class="ti ti-sparkles me-1 text-primary"></i> Full formatting supported: Headings, Bold, Lists, Links, Colors, Tables, and HTML Code View.</span>
                    <span class="text-primary fw-semibold" style="cursor: pointer; font-size: 0.84rem; white-space: nowrap;" onclick="$('#privacy_textarea').summernote('codeview.toggle')"><i class="ti ti-code me-1"></i>Toggle HTML View</span>
                  </div>
                </div>
              </div>

            </div>

          </div>

          <!-- Card Footer -->
          <div class="card-footer bg-light px-3 px-md-4 py-3 border-top d-flex legal-footer-bar justify-content-between align-items-center">
            <span class="text-muted small">
              <i class="ti ti-check me-1 text-success"></i> Changes take effect immediately across all Login and Signup pages.
            </span>
            <button type="submit" class="btn btn-primary rounded-pill px-4 px-md-5 py-2 fw-bold btn-publish" style="background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%); border: none;">
              <i class="ti ti-device-floppy me-1"></i> Save &amp; Publish Policies
            </button>
          </div>

        </form>

      </div>
    </div>
  </div>

</div>

<!-- Admin Live Preview Modal -->
<div class="modal fade" id="adminPolicyPreviewModal" tabindex="-1" aria-labelledby="adminPolicyPreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 650px; margin: 12px auto;">
    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 25px 50px rgba(0,0,0,0.2); overflow: hidden;">
      
      <div class="modal-header text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%); padding: 18px 22px;">
        <div>
          <h5 class="modal-title fw-bold text-white mb-0 fs-6 fs-md-5" id="adminPolicyPreviewModalLabel">Policy Preview</h5>
          <small class="text-white-50" style="font-size: 0.78rem;">Live preview of what users will see</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-3 p-md-4" id="adminPolicyPreviewBody" style="font-size: 14px; line-height: 1.7; color: #334155; max-height: 65vh;">
        <!-- Dynamic Content -->
      </div>

      <div class="modal-footer bg-light px-3 px-md-4 py-3 border-top-0 d-flex justify-content-between">
        <span class="text-muted small" style="font-size: 0.8rem;">AskReview Policy Viewer</span>
        <button type="button" class="btn btn-secondary rounded-pill px-4 btn-sm" data-bs-dismiss="modal">Close Preview</button>
      </div>

    </div>
  </div>
</div>

@endsection

@section('js')
<!-- Summernote Rich Text Editor JS -->
<script src="{{ asset('adminAssets/libs/summernote/dist/summernote-lite.min.js') }}"></script>

<script>
$(document).ready(function() {
    // Summernote editor configuration
    var editorConfig = {
        placeholder: 'Write and format policy text here...',
        tabsize: 2,
        height: 380,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'hr']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    };

    // Initialize Summernote on both policy textareas
    if (typeof $.fn.summernote !== 'undefined') {
        $('#terms_textarea').summernote(editorConfig);
        $('#privacy_textarea').summernote(editorConfig);
    } else {
        console.error('Summernote library not available.');
    }

    // Refresh Summernote when tab is switched to avoid layout glitches in inactive tabs
    $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
        var targetId = $(e.target).attr('data-bs-target');
        if (targetId === '#privacy-content') {
            if ($('#privacy_textarea').summernote) $('#privacy_textarea').summernote('focus');
        } else if (targetId === '#terms-content') {
            if ($('#terms_textarea').summernote) $('#terms_textarea').summernote('focus');
        }
    });

    // Ensure content from Summernote is synced back to textarea before submit
    $('#legalSettingsForm').on('submit', function() {
        if ($('#terms_textarea').summernote) {
            var termsCode = $('#terms_textarea').summernote('code');
            $('#terms_textarea').val(termsCode);
        }
        if ($('#privacy_textarea').summernote) {
            var privacyCode = $('#privacy_textarea').summernote('code');
            $('#privacy_textarea').val(privacyCode);
        }
    });
});

function previewPolicy(title, textareaId) {
    var content = '';
    if ($('#' + textareaId).summernote) {
        content = $('#' + textareaId).summernote('code');
    } else {
        content = document.getElementById(textareaId).value;
    }

    document.getElementById('adminPolicyPreviewModalLabel').innerText = title;
    document.getElementById('adminPolicyPreviewBody').innerHTML = content;
    
    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
        var modalEl = document.getElementById('adminPolicyPreviewModal');
        var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        modalInstance.show();
    } else {
        $('#adminPolicyPreviewModal').modal('show');
    }
}

function resetTermsDefault() {
    if (confirm('Load standard AskReview Terms & Conditions default template? This will replace the current text in the editor.')) {
        var defaultTerms = `{!! addslashes((new \App\Http\Controllers\UserController())->getDefaultTerms()) !!}`;
        if ($('#terms_textarea').summernote) {
            $('#terms_textarea').summernote('code', defaultTerms);
        }
        $('#terms_textarea').val(defaultTerms);
    }
}

function resetPrivacyDefault() {
    if (confirm('Load standard AskReview Privacy Policy default template? This will replace the current text in the editor.')) {
        var defaultPrivacy = `{!! addslashes((new \App\Http\Controllers\UserController())->getDefaultPrivacy()) !!}`;
        if ($('#privacy_textarea').summernote) {
            $('#privacy_textarea').summernote('code', defaultPrivacy);
        }
        $('#privacy_textarea').val(defaultPrivacy);
    }
}
</script>
@endsection
