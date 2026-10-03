<style>
    .modal-google-custom {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .modal-google-body::-webkit-scrollbar {
        width: 6px;
    }
    .modal-google-body::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 8px;
    }
    .modal-google-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 8px;
    }
    .modal-google-body::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    .feedback-template-item {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e2e8f0 !important;
        background: #ffffff;
    }
    .feedback-template-item:hover {
        border-color: #93c5fd !important;
        box-shadow: 0 4px 12px rgba(66, 133, 244, 0.08) !important;
        transform: translateY(-1px);
    }
    .drag-handle {
        cursor: grab;
        color: #94a3b8;
        transition: color 0.15s ease;
    }
    .drag-handle:hover {
        color: #475569;
    }
    .drag-handle:active {
        cursor: grabbing;
    }
    .sortable-ghost {
        opacity: 0.35;
        background-color: #eff6ff !important;
        border: 2px dashed #3b82f6 !important;
    }
    .sortable-chosen {
        background-color: #f8fafc !important;
        box-shadow: 0 8px 20px rgba(0,0,0,0.12) !important;
    }
    .delete-tmpl-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #94a3b8;
        background: transparent;
        border: 1px solid transparent;
        transition: all 0.15s ease;
    }
    .delete-tmpl-btn:hover {
        color: #ef4444;
        background: #fee2e2;
        border-color: #fca5a5;
    }
</style>

<div class="modal-google-custom">
    <!-- Header -->
    <div class="modal-header px-4 py-3 border-bottom d-flex align-items-center justify-content-between" style="background: #ffffff;">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center bg-white shadow-sm border rounded-circle" style="width: 42px; height: 42px; min-width: 42px;">
                <img src="{{asset('frontend/images/google.png')}}" style="width: 24px; height: 24px; object-fit: contain;" alt="Google">
            </div>
            <div>
                <h5 class="modal-title font-weight-bold mb-0 text-dark" style="font-size: 1.15rem; letter-spacing: -0.01em;">Google Reviews & Templates</h5>
                <p class="text-muted small mb-0">Configure status and pre-written customer feedback</p>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-light border-0 rounded-circle d-flex align-items-center justify-content-center p-0" 
                style="width: 34px; height: 34px; color: #64748b; background: #f1f5f9;" 
                data-bs-dismiss="modal" 
                onclick="$('#integration_remove_modal').modal('hide')">
            <i class="fa-solid fa-xmark fa-lg"></i>
        </button>
    </div>

    <!-- Modal Body -->
    <div class="modal-body modal-google-body px-4 py-3" style="max-height: 78vh; overflow-y: auto; background-color: #f8fafc;">
        @if ($type == 'google')
            <div class="edit_integration_box">

                <!-- Connection & Status Bar -->
                <div class="card border-0 shadow-sm rounded-3 mb-3 p-3 bg-white">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light rounded p-2 text-center" style="min-width: 44px;">
                                <i class="fa-solid fa-store fa-lg text-primary"></i>
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-dark mb-0">{{$Integration->name ?? 'Google Business'}}</h6>
                                <div class="text-muted small text-truncate" style="max-width: 280px;" title="{{$Integration->formatted_address ?? ''}}">
                                    {{$Integration->formatted_address ?? 'Connected to Google Reviews'}}
                                </div>
                            </div>
                        </div>

                        <!-- Status & Link Controls -->
                        <div class="d-flex align-items-center gap-2">
                            @if(isset($Integration) && !empty($Integration->review_links))
                                <a href="{{$Integration->review_links}}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3" title="Open Google Review Page">
                                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Visit
                                </a>
                            @endif

                            <form id="google_status_form" class="d-flex align-items-center gap-1 m-0">
                                @csrf
                                <input type="hidden" name="id" value="{{$Integration->id}}">
                                <input type="hidden" name="review_type" value="google">
                                <select name="status" id="google_status_select" class="form-select form-select-sm rounded-pill font-weight-bold px-3 py-1" 
                                        style="font-size: 0.85rem; width: 110px; cursor: pointer; border-color: #cbd5e1;" 
                                        onchange="save_google_status()">
                                    <option value="active" @if(isset($Integration) && ($Integration->status == 'active' || empty($Integration->status))) selected @endif>
                                        🟢 Active
                                    </option>
                                    <option value="inactive" @if(isset($Integration) && $Integration->status == 'inactive') selected @endif>
                                        🔴 Inactive
                                    </option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Feedback Templates Section -->
                <div class="card border-0 shadow-sm rounded-3 p-3 bg-white mb-3">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-comments me-1"></i> Feedback Templates
                            </span>
                            <span class="text-muted small" id="template_count_badge">
                                ({{ isset($googleFeedbackTemplates) ? count($googleFeedbackTemplates) : 0 }})
                            </span>
                        </div>
                        <span class="badge bg-light text-secondary border rounded-pill px-2 py-1 small">
                            <i class="fa-solid fa-grip-vertical text-primary me-1"></i> Drag to re-order
                        </span>
                    </div>

                    <p class="text-muted small mb-3">
                        These positive comments are shown to visitors clicking Google on your profile. Customers tap once to copy and paste directly into Google.
                    </p>

                    <!-- Add New Template Input -->
                    <div class="p-3 rounded-3 mb-3 border" style="background-color: #f8fafc;">
                        <label class="form-label small font-weight-bold text-dark mb-1">
                            <i class="fa-solid fa-plus-circle text-primary me-1"></i> Add New Pre-written Review
                        </label>
                        <div class="input-group">
                            <textarea id="new_feedback_text" class="form-control border-light-subtle rounded-3 shadow-none" rows="2" 
                                      placeholder="e.g. Excellent experience! The staff was friendly, attentive, and exceeded expectations. Highly recommend!" 
                                      style="font-size: 0.9rem; resize: none;"></textarea>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted" style="font-size: 0.78rem;">
                                <i class="fa-regular fa-lightbulb text-warning me-1"></i> Keep compliments concise and authentic.
                            </small>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm font-weight-bold" onclick="add_feedback_template()">
                                <i class="fa-solid fa-plus me-1"></i> Add Feedback
                            </button>
                        </div>
                    </div>

                    <!-- Sortable List -->
                    <div id="google_feedback_sortable_list" class="d-flex flex-column gap-2">
                        @if(isset($googleFeedbackTemplates) && count($googleFeedbackTemplates) > 0)
                            @foreach($googleFeedbackTemplates as $tmpl)
                                <div class="feedback-template-item rounded-3 p-3 d-flex align-items-center justify-content-between" data-id="{{$tmpl->id}}">
                                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                                        <div class="drag-handle px-1 py-2" title="Hold and drag to reorder">
                                            <i class="fa-solid fa-grip-vertical fa-lg"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center gap-1 mb-1">
                                                <span class="text-warning small" style="letter-spacing: 2px;">
                                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                                </span>
                                            </div>
                                            <div class="feedback-text text-dark" style="font-size: 0.92rem; line-height: 1.45; font-weight: 500;">
                                                "{{$tmpl->feedback_text}}"
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-2">
                                        <button type="button" class="delete-tmpl-btn" onclick="delete_feedback_template({{$tmpl->id}})" title="Delete template">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div id="no_feedback_alert" class="text-center py-4 text-muted border rounded-3 border-dashed bg-white">
                                <i class="fa-regular fa-comments fa-2x mb-2 text-secondary" style="opacity: 0.5;"></i>
                                <p class="mb-0 small">No pre-written feedback templates yet. Add your first compliment above!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Footer with Disconnect & Close -->
                <div class="d-flex align-items-center justify-content-between pt-2">
                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3" type="button" onclick="disconect_integration('{{$type}}')">
                        <i class="fa-solid fa-link-slash me-1"></i> Disconnect Google
                    </button>
                    <button class="btn btn-sm btn-dark rounded-pill px-4 shadow-sm" type="button" onclick="$('#integration_remove_modal').modal('hide')">
                        Done
                    </button>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    initGoogleFeedbackSortable();
                });

                function initGoogleFeedbackSortable() {
                    var el = document.getElementById('google_feedback_sortable_list');
                    if (el && typeof Sortable !== 'undefined') {
                        if (el._sortableInstance) {
                            el._sortableInstance.destroy();
                        }
                        el._sortableInstance = new Sortable(el, {
                            handle: '.drag-handle',
                            animation: 180,
                            ghostClass: 'sortable-ghost',
                            chosenClass: 'sortable-chosen',
                            onEnd: function() {
                                var order = [];
                                $('#google_feedback_sortable_list .feedback-template-item').each(function() {
                                    order.push($(this).data('id'));
                                });
                                $.ajax({
                                    type: "POST",
                                    url: "{{URL::to('admin/google_feedback_template_reorder')}}",
                                    data: {
                                        _token: '{{csrf_token()}}',
                                        order: order
                                    },
                                    success: function(res) {
                                        if (typeof toastr !== 'undefined') {
                                            toastr.success('Review order saved successfully!');
                                        }
                                    },
                                    error: function() {
                                        if (typeof toastr !== 'undefined') {
                                            toastr.error('Failed to update order');
                                        }
                                    }
                                });
                            }
                        });
                    }
                }

                function add_feedback_template() {
                    var text = $('#new_feedback_text').val().trim();
                    if (!text) {
                        alert('Please enter review feedback text.');
                        return;
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('admin/google_feedback_template_add')}}",
                        data: {
                            _token: '{{csrf_token()}}',
                            feedback_text: text
                        },
                        success: function(res) {
                            if (res.status == 1) {
                                $('#new_feedback_text').val('');
                                $('#no_feedback_alert').remove();

                                var itemHtml = `
                                    <div class="feedback-template-item rounded-3 p-3 d-flex align-items-center justify-content-between mb-2" data-id="${res.data.id}">
                                        <div class="d-flex align-items-center gap-3 flex-grow-1">
                                            <div class="drag-handle px-1 py-2" title="Hold and drag to reorder">
                                                <i class="fa-solid fa-grip-vertical fa-lg"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center gap-1 mb-1">
                                                    <span class="text-warning small" style="letter-spacing: 2px;">
                                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                                    </span>
                                                </div>
                                                <div class="feedback-text text-dark" style="font-size: 0.92rem; line-height: 1.45; font-weight: 500;">
                                                    "${res.data.feedback_text}"
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ms-2">
                                            <button type="button" class="delete-tmpl-btn" onclick="delete_feedback_template(${res.data.id})" title="Delete template">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </div>
                                `;

                                $('#google_feedback_sortable_list').append(itemHtml);
                                initGoogleFeedbackSortable();

                                var count = $('#google_feedback_sortable_list .feedback-template-item').length;
                                $('#template_count_badge').text(`(${count})`);

                                if (typeof toastr !== 'undefined') {
                                    toastr.success(res.message);
                                }
                            } else {
                                alert(res.message || 'Error adding template');
                            }
                        },
                        error: function(err) {
                            alert('Error adding template');
                        }
                    });
                }

                function delete_feedback_template(id) {
                    if (!confirm('Are you sure you want to remove this feedback template?')) {
                        return;
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('admin/google_feedback_template_delete')}}",
                        data: {
                            _token: '{{csrf_token()}}',
                            id: id
                        },
                        success: function(res) {
                            if (res.status == 1) {
                                $(`.feedback-template-item[data-id="${id}"]`).fadeOut(200, function() {
                                    $(this).remove();
                                    var count = $('#google_feedback_sortable_list .feedback-template-item').length;
                                    $('#template_count_badge').text(`(${count})`);

                                    if (count === 0) {
                                        $('#google_feedback_sortable_list').html(`
                                            <div id="no_feedback_alert" class="text-center py-4 text-muted border rounded-3 border-dashed bg-white">
                                                <i class="fa-regular fa-comments fa-2x mb-2 text-secondary" style="opacity: 0.5;"></i>
                                                <p class="mb-0 small">No pre-written feedback templates yet. Add your first compliment above!</p>
                                            </div>
                                        `);
                                    }
                                });
                                if (typeof toastr !== 'undefined') {
                                    toastr.success(res.message);
                                }
                            }
                        },
                        error: function() {
                            alert('Error deleting template');
                        }
                    });
                }
            </script>
        @else
            <div class="p-4 text-center text-muted">
                No settings available for this integration.
            </div>
        @endif
    </div>
</div>