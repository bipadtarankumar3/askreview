<!-- Modal: Change Expiry Date -->
<div class="modal fade" id="modalChangeExpiry" tabindex="-1" aria-labelledby="modalChangeExpiryLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
    <div class="modal-content" style="border-radius: 18px; border: none; box-shadow: 0 20px 45px rgba(0,0,0,0.18); overflow: hidden;">
      
      <!-- Modal Header -->
      <div class="modal-header text-white" style="background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%); padding: 18px 24px;">
        <div>
          <h5 class="modal-title fw-bold text-white mb-0" id="modalChangeExpiryLabel">
            <i class="fas fa-calendar-alt me-2"></i>Change Expiry Date
          </h5>
          <small class="text-white-50" id="modal_user_display_name">User: Business Name</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Form -->
      <form id="formChangeExpiry" action="{{ URL::to('admin/update_user_expiry_date') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" id="modal_expiry_user_id" value="">

        <div class="modal-body p-4">
          <!-- Current Expiry Info Card -->
          <div class="d-flex align-items-center justify-content-between p-3 mb-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
            <div>
              <span class="text-muted d-block small" style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Current Expiry Date</span>
              <span class="fw-bold text-dark fs-6" id="modal_current_expiry_display">-</span>
            </div>
            <span class="badge" id="modal_expiry_status_badge" style="font-size: 12px; padding: 6px 12px;">Active</span>
          </div>

          <!-- Quick Presets -->
          <label class="form-label fw-bold text-secondary small text-uppercase mb-2" style="letter-spacing: 0.5px;">
            Quick Presets (Click to Auto-Calculate)
          </label>
          <div class="d-flex flex-wrap gap-2 mb-3">
            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 btn-quick-preset" data-days="7" data-trial="YES">
              <i class="fas fa-bolt me-1 text-warning"></i> +7 Days (Trial)
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 btn-quick-preset" data-days="15" data-trial="NO">
              +15 Days
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 btn-quick-preset" data-months="1" data-trial="NO">
              +1 Month
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 btn-quick-preset" data-months="3" data-trial="NO">
              +3 Months
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 btn-quick-preset" data-months="6" data-trial="NO">
              +6 Months
            </button>
            <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1 btn-quick-preset" data-years="1" data-trial="NO">
              <i class="fas fa-check-circle me-1"></i> +1 Year
            </button>
          </div>

          <!-- Custom Expiry Date Input -->
          <div class="mb-3">
            <label for="modal_new_expiry_date" class="form-label fw-bold">New Expiry Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control form-control-lg" id="modal_new_expiry_date" name="expiry_date" required style="border-radius: 12px; font-weight: 600;">
            <div class="form-text text-muted">Admin can select any custom date anytime.</div>
          </div>

          <!-- Trial Status Option -->
          <div class="mb-1">
            <label class="form-label fw-semibold text-secondary small">Trial Status Badge</label>
            <select name="seven_day_trial" id="modal_seven_day_trial" class="form-select" style="border-radius: 10px;">
              <option value="NO">Regular / Active Subscription</option>
              <option value="YES">7-Day Trial Badge (Shows countdown badge to user)</option>
            </select>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer bg-light px-4 py-3 border-top-0 d-flex justify-content-between">
          <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary rounded-pill px-4" id="btnSubmitExpiry" style="background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%); border: none;">
            <span class="btn-text"><i class="fas fa-save me-1"></i> Save Changes</span>
            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Open modal on click (using delegated event so DataTables pagination doesn't break it)
    $(document).on('click', '.btn-edit-expiry', function(e) {
        e.preventDefault();
        var userId = $(this).data('id');
        var userName = $(this).data('name');
        var expiryDate = $(this).data('expiry');
        var trialStatus = $(this).data('trial') || 'NO';

        $('#modal_expiry_user_id').val(userId);
        $('#modal_user_display_name').text('User: ' + userName);
        $('#modal_current_expiry_display').text(expiryDate || 'Not Set');
        $('#modal_new_expiry_date').val(expiryDate || '');
        $('#modal_seven_day_trial').val(trialStatus === 'YES' ? 'YES' : 'NO');

        // Status calculation for badge
        var now = new Date();
        now.setHours(0,0,0,0);
        var exp = new Date(expiryDate);
        if (expiryDate && exp >= now) {
            $('#modal_expiry_status_badge').removeClass('bg-danger').addClass('bg-success').text('Active');
        } else {
            $('#modal_expiry_status_badge').removeClass('bg-success').addClass('bg-danger').text('Expired');
        }

        // Show modal (supporting both Bootstrap 5 and jQuery)
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            var modalEl = document.getElementById('modalChangeExpiry');
            var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modalInstance.show();
        } else {
            $('#modalChangeExpiry').modal('show');
        }
    });

    // Quick preset buttons calculation
    $(document).on('click', '.btn-quick-preset', function(e) {
        e.preventDefault();
        var days = $(this).data('days');
        var months = $(this).data('months');
        var years = $(this).data('years');
        var trial = $(this).data('trial');

        var baseDate = new Date(); // Start relative to current date
        if (days) {
            baseDate.setDate(baseDate.getDate() + parseInt(days));
        }
        if (months) {
            baseDate.setMonth(baseDate.getMonth() + parseInt(months));
        }
        if (years) {
            baseDate.setFullYear(baseDate.getFullYear() + parseInt(years));
        }

        var yyyy = baseDate.getFullYear();
        var mm = String(baseDate.getMonth() + 1).padStart(2, '0');
        var dd = String(baseDate.getDate()).padStart(2, '0');
        var formattedDate = yyyy + '-' + mm + '-' + dd;

        $('#modal_new_expiry_date').val(formattedDate);
        if (trial) {
            $('#modal_seven_day_trial').val(trial);
        }
    });

    // Form submission via AJAX
    $('#formChangeExpiry').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btnSubmitExpiry');
        var $btnText = $btn.find('.btn-text');
        var $spinner = $btn.find('.spinner-border');

        $btn.prop('disabled', true);
        $btnText.addClass('d-none');
        $spinner.removeClass('d-none');

        var formAction = $(this).attr('action');
        var formData = $(this).serialize();
        var userId = $('#modal_expiry_user_id').val();
        var newDate = $('#modal_new_expiry_date').val();

        $.ajax({
            url: formAction,
            type: 'POST',
            data: formData,
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                $btn.prop('disabled', false);
                $btnText.removeClass('d-none');
                $spinner.addClass('d-none');

                if (response.status) {
                    // Hide modal
                    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                        var modalEl = document.getElementById('modalChangeExpiry');
                        var modalInstance = bootstrap.Modal.getInstance(modalEl);
                        if (modalInstance) {
                            modalInstance.hide();
                        } else {
                            $('#modalChangeExpiry').modal('hide');
                        }
                    } else {
                        $('#modalChangeExpiry').modal('hide');
                    }

                    // Update UI text in the table
                    $('.user-expiry-text-' + userId).text(response.raw_date);
                    // Update button data attributes
                    var $editBtn = $('button[data-id="' + userId + '"].btn-edit-expiry');
                    $editBtn.data('expiry', response.raw_date);
                    $editBtn.attr('data-expiry', response.raw_date);
                    $editBtn.data('trial', $('#modal_seven_day_trial').val());
                    $editBtn.attr('data-trial', $('#modal_seven_day_trial').val());

                    if (typeof toastr !== 'undefined') {
                        toastr.success(response.message || 'Expiry date updated successfully!');
                    } else {
                        alert(response.message || 'Expiry date updated successfully!');
                    }
                } else {
                    if (typeof toastr !== 'undefined') {
                        toastr.error(response.message || 'Failed to update expiry date.');
                    } else {
                        alert(response.message || 'Failed to update expiry date.');
                    }
                }
            },
            error: function(xhr) {
                $btn.prop('disabled', false);
                $btnText.removeClass('d-none');
                $spinner.addClass('d-none');

                var errorMsg = 'An error occurred while updating expiry date.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                if (typeof toastr !== 'undefined') {
                    toastr.error(errorMsg);
                } else {
                    alert(errorMsg);
                }
            }
        });
    });
});
</script>
