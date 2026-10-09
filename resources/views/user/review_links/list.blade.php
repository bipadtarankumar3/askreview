@extends('adminLayouts.home')
@section('content')

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style>
        .controls {
            background-color: #fff;
            border-radius: 2px;
            border: 1px solid transparent;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            box-sizing: border-box;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            height: 29px;
            margin-left: 17px;
            margin-top: 10px;
            outline: none;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        .controls:focus {
            border-color: #4d90fe;
        }
    </style>

<div class="container-fluid">
<!-- basic table -->
<div class="row">
    <div class="col-12">
        <!-- ---------------------
                start Zero Configuration
            ---------------- -->
        <div class="card">
            <div class="card-header" id="reviewLinksCardHeader">
                <div class="mb-2">
                    <div class="row align-items-center">
                        <div class="col-md-9 col-7">
                            <h5 class="mb-0 fw-bold" style="color: #0f172a;">Review Links List</h5>
                        </div>
                        <div class="col-md-3 col-5 text-end">
                            <button type="button" class="btn btn-sm" id="btnRestartTour" onclick="startIntegrationsTour(true)" style="background: #eff6ff; border: 1.5px solid #bfdbfe; color: #1d4ed8; font-weight: 700; border-radius: 10px; padding: 6px 14px; font-size: 0.82rem; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(37,99,235,0.08);">
                                <i class="ti ti-compass" style="font-size: 1.05rem;"></i>
                                <span>Page Tour</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4 class="text-center" id="reviewLinksIntroTitle" style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; color: #1e293b; margin-bottom: 24px;">Drag &amp; Drop your favorite social media tabs to customize your feed</h4>
               <div id="integrationContainer" class="row">
                 
                    @if (isset($integrationList) && count($integrationList) > 0)
                        @if (isset($integrationList[0]))
                            @foreach ($integrationList as $item)
                                @php
                                    $isConfigured = false;
                                    if ($item->type == 'google') {
                                        $isConfigured = (!empty($item->review_links) || !empty($item->place_id) || !empty($item->status));
                                    } elseif ($item->type == 'record') {
                                        $isConfigured = (!empty($item->status));
                                    } elseif ($item->type == 'private') {
                                        $isConfigured = false;
                                    } else {
                                        $isConfigured = (!empty($item->review_links) || !empty($item->status));
                                    }
                                @endphp
                                <div class="col-md-3 mt-4 drag-item" id="dragbble_{{$item->id}}" data-order="{{$item->button_order}}" data-type="{{$item->type}}">
                                    <div class="links_box">
                                        <br>
                                        @if ($isConfigured)
                                            <div class="redirect_box">
                                                @if (!empty($item->review_links))
                                                    <a href="{{$item->review_links}}" target="_blank" class="redirect_anchor" title="Visit Link">
                                                        <i class="fa-solid fa-diamond-turn-right"></i>
                                                    </a>
                                                @else
                                                    <span class="redirect_anchor" style="visibility: hidden;">
                                                        <i class="fa-solid fa-diamond-turn-right"></i>
                                                    </span>
                                                @endif

                                                @if ($item->type == 'record')
                                                    @if (isset($admin_user) && $admin_user->video_access == 'YES' && $video_access_show == true)
                                                        <span class="success_right" title="{{ $item->status == 'inactive' ? 'Inactive' : 'Active' }}">
                                                            @if ($item->status == 'inactive')
                                                                <i class="fa-solid fa-square-xmark" style="color: #ef4444;"></i>
                                                            @else
                                                                <i class="fa-solid fa-square-check"></i>
                                                            @endif
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="success_right" title="{{ $item->status == 'inactive' ? 'Inactive' : 'Active' }}">
                                                        @if ($item->status == 'inactive')
                                                            <i class="fa-solid fa-square-xmark" style="color: #ef4444;"></i>
                                                        @else
                                                            <i class="fa-solid fa-square-check"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="img_box">
                                            <img src="{{$item->button_icon}}" class="link_image" alt="">
                                            <p>{{$item->button_name}}</p>
                                        </div>
                                        <div class="button_box">
                                            @if ($item->type == 'google')
                                                @if ($isConfigured)
                                                    <button class="btn btn-secondary edit" onclick="open_integration_remove_model('google')">Customize</button>
                                                @else
                                                    <button class="btn btn-secondary integrate" onclick="open_integration_model('google')">Integrate</button>
                                                @endif
                                            @elseif ($item->type == 'record')
                                                @if (isset($admin_user) && $admin_user->video_access == 'YES' && $video_access_show == true)
                                                    @if ($isConfigured)
                                                        <button class="btn btn-secondary edit" onclick="add_spinner_btn('record')">Customize</button>
                                                    @else
                                                        <button class="btn btn-secondary integrate" onclick="add_spinner_btn('record')">Integrate</button>
                                                    @endif
                                                @endif
                                            @elseif ($item->type == 'private')
                                            @else
                                                @if ($isConfigured)
                                                    <button class="btn btn-secondary edit" onclick="add_spinner_btn('{{$item->type}}')">Customize</button>
                                                @else
                                                    <button class="btn btn-secondary integrate" onclick="add_spinner_btn('{{$item->type}}')">Integrate</button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-3" data-type="google">
                                <div class="links_box">
                                    <br>
                                    @if (isset($IntegrationGoogle))
                                        <div class="redirect_box">
                                            <a href="{{$IntegrationGoogle->review_links}}" target="_blank" class="redirect_anchor">
                                                <i class="fa-solid fa-diamond-turn-right"></i>
                                            </a>
                                            <span class="success_right">
                                                <i class="fa-solid fa-square-check"></i>
                                            </span>
                                        </div>
                                    @endif
                                    
                                    <div class="img_box">
                                    <img src="{{asset('frontend/images/google.png')}}" class="link_image" alt=""> 
                                    <p>Google</p>
                                    </div>

                                    <div class="button_box">

                                        @if (isset($IntegrationGoogle))
                                            <button class="btn btn-secondary edit"  onclick="open_integration_remove_model('google')">Customize</button>
                                        @else
                                            <button class="btn btn-secondary integrate" onclick="open_integration_model('google')">Integrate</button>
                                                                            
                                        @endif
                                        
                                    </div>
                                    
                                    
                                </div>
                            </div>
                 
                            <div class="col-md-3" data-type="facebook">
                                <div class="links_box">
                                    
                                    <br>
                                    @if (isset($IntegrationFacebook))
                                    <div class="redirect_box">
                                        <a  href="{{$IntegrationFacebook->review_links}}" target="_blank"  class="redirect_anchor">
                                            <i class="fa-solid fa-diamond-turn-right"></i>
                                        </a>
                                        <span class="success_right">
                                            @if ($IntegrationFacebook->status == 'active')
                                            <i class="fa-solid fa-square-check"></i> 
                                            @else
                                            <i class="fa-solid fa-xmark" style="color: red"></i> 
                                            @endif
                                            

                                            
                                        </span>
                                    </div>
                                    @endif
                                    <div class="img_box">
                                    <img src="{{asset('frontend/images/facebook.png')}}" class="link_image" alt=""> 
                                    <p>Facebook</p>
                                    </div>

                                    <div class="button_box">
                                        @if (isset($IntegrationFacebook))
                                            <button class="btn btn-secondary edit"  onclick="add_spinner_btn('facebook')">Customize</button>
                                        @else
                                            <button class="btn btn-secondary integrate"  onclick="add_spinner_btn('facebook')">Integrate</button>
                                                                            
                                        @endif
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div class="col-md-3" data-type="youtube">
                                <div class="links_box">
                                    
                                    <br>
                                    @if (isset($IntegrationYoutube))
                                    <div class="redirect_box">
                                        <a  href="{{$IntegrationYoutube->review_links}}" target="_blank" class="redirect_anchor">
                                            <i class="fa-solid fa-diamond-turn-right"></i>
                                        </a>
                                        <span class="success_right">
                                            @if ($IntegrationYoutube->status == 'active')
                                            <i class="fa-solid fa-square-check"></i> 
                                            @else
                                            <i class="fa-solid fa-xmark" style="color: red"></i> 
                                            @endif
                                        </span>
                                    </div>
                                    @endif
                                    <div class="img_box">
                                    <img src="{{asset('frontend/images/youtube.png')}}" class="link_image" alt=""> 
                                    <p>Youtube</p>
                                    </div>

                                    <div class="button_box">
                                        @if (isset($IntegrationYoutube))
                                            <button class="btn btn-secondary edit"  onclick="add_spinner_btn('youtube')">Customize</button>
                                        @else
                                            <button class="btn btn-secondary integrate" onclick="add_spinner_btn('youtube')">Integrate</button>
                                                                            
                                        @endif
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div class="col-md-3" data-type="instagram">
                                <div class="links_box">
                                    
                                    <br>
                                    @if (isset($IntegrationInstagram))
                                    <div class="redirect_box">
                                        <a  href="{{$IntegrationInstagram->review_links}}" target="_blank" class="redirect_anchor">
                                            <i class="fa-solid fa-diamond-turn-right"></i>
                                        </a>
                                        <span class="success_right">
                                            @if ($IntegrationInstagram->status == 'active')
                                            <i class="fa-solid fa-square-check"></i> 
                                            @else
                                            <i class="fa-solid fa-xmark" style="color: red"></i> 
                                            @endif
                                        </span>
                                    </div>
                                    @endif
                                    <div class="img_box">
                                    <img src="{{asset('frontend/images/instagram.png')}}" class="link_image" alt=""> 
                                    <p>Instagram</p>
                                    </div>

                                    <div class="button_box">
                                        @if (isset($IntegrationInstagram))
                                            <button class="btn btn-secondary edit"  onclick="add_spinner_btn('instagram')">Customize</button>
                                        @else
                                            <button class="btn btn-secondary integrate" onclick="add_spinner_btn('instagram')">Integrate</button>
                                                                            
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-3 mt-2">
                                <div class="links_box">
                                    
                                    <br>
                                    @if (isset($IntegrationWhatsApp))
                                    <div class="redirect_box">
                                        <a  href="{{$IntegrationWhatsApp->review_links}}" target="_blank" class="redirect_anchor">
                                            <i class="fa-solid fa-diamond-turn-right"></i>
                                        </a>
                                        <span class="success_right">
                                            @if ($IntegrationWhatsApp->status == 'active')
                                            <i class="fa-solid fa-square-check"></i> 
                                            @else
                                            <i class="fa-solid fa-xmark" style="color: red"></i> 
                                            @endif
                                        </span>
                                    </div>
                                    @endif
                                    <div class="img_box">
                                    <img src="{{asset('frontend/images/whatsapp.png')}}" class="link_image" alt=""> 
                                    <p>Whats App</p>
                                    </div>

                                    <div class="button_box">
                                        @if (isset($IntegrationWhatsApp))
                                            <button class="btn btn-secondary edit"  onclick="add_spinner_btn('whatsapp')">Customize</button>
                                        @else
                                            <button class="btn btn-secondary integrate" onclick="add_spinner_btn('whatsapp')">Integrate</button>
                                                                            
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>

                            @if (isset($admin_user) && $admin_user->video_access == 'YES' && $video_access_show == true)
                                
                            
                            <div class="col-md-3 mt-2">
                                <div class="links_box">
                                    
                                    <br>
                                    @if (isset($IntegrationRecord))
                                    <div class="redirect_box">
                                        <a  href="{{$IntegrationRecord->review_links}}" target="_blank" class="redirect_anchor">
                                            <i class="fa-solid fa-diamond-turn-right"></i>
                                        </a>
                                        <span class="success_right">
                                            @if ($IntegrationRecord->status == 'active')
                                            <i class="fa-solid fa-square-check"></i> 
                                            @else
                                            <i class="fa-solid fa-xmark" style="color: red"></i> 
                                            @endif
                                        </span>
                                    </div>
                                    @endif
                                    <div class="img_box text-center">
                                        <i class="fa-solid fa-video" style="font-size: 70px"></i>
                                    <p>Record Video</p>
                                    </div>

                                    <div class="button_box">
                                        @if (isset($IntegrationRecord))
                                            <button class="btn btn-secondary edit"  onclick="add_spinner_btn('record')">Customize</button>
                                        @else
                                            <button class="btn btn-secondary integrate" onclick="add_spinner_btn('record')">Integrate</button>
                                                                            
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-3 mt-2">
                                <div class="links_box">
                                    <br>
                                    @if (isset($IntegrationWebsite))
                                    <div class="redirect_box">
                                        @if (!empty($IntegrationWebsite->review_links))
                                            <a href="{{$IntegrationWebsite->review_links}}" target="_blank" class="redirect_anchor">
                                                <i class="fa-solid fa-diamond-turn-right"></i>
                                            </a>
                                        @endif
                                        <span class="success_right">
                                            @if ($IntegrationWebsite->status == 'active')
                                                <i class="fa-solid fa-square-check"></i>
                                            @else
                                                <i class="fa-solid fa-xmark" style="color: red"></i>
                                            @endif
                                        </span>
                                    </div>
                                    @endif
                                    <div class="img_box">
                                        <img src="{{asset('frontend/images/website.png')}}" class="link_image" alt="">
                                        <p>Website</p>
                                    </div>
                                    <div class="button_box">
                                        @if (isset($IntegrationWebsite) && (!empty($IntegrationWebsite->review_links) || !empty($IntegrationWebsite->status)))
                                            <button class="btn btn-secondary edit" onclick="add_spinner_btn('website')">Customize</button>
                                        @else
                                            <button class="btn btn-secondary integrate" onclick="add_spinner_btn('website')">Integrate</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif
                                
                    @else
                        <div class="col-md-4 mt-4"></div>
                        <div class="col-md-4 text-center my-4">
                            <p>No Integration Found</p>
                            <div class="button_box">
                                <button class="btn btn-secondary integrate" onclick="integration_start()">Integration Start</button>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4"></div>
                    @endif

               </div>
            </div>
        </div>
        <!-- ---------------------
                end Zero Configuration
            ---------------- -->
    </div>
</div>
</div>

    <div class="modal fade bd-example-modal-lg" id="integration_add_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close btn btn-danger"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"  onclick="hide_modal()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="social_search_box">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="{{asset('frontend/images/google.png')}}" width="100px" alt="">
                                <h3 class="mt-4">Link your Account</h3>
                                <p class="p-4">Search your Google My Business in the search box. Public access integration will not allow you to reply to reviews from the platform and import more than 10 reviews per day.</p>
                            </div>
                        </div>
                        
                        <div class="row text-center">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <input
                                    id="pac-input"
                                    class="form-control"
                                    type="text"
                                    placeholder="Enter a location"
                                />
                                
                                <button class="btn btn-success my-4 integrate_button" style="display: none" onclick="sendResult('google')">Integrate</button>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="integration_remove_modal" tabindex="-1" role="dialog" aria-labelledby="integrationRemoveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 720px;">
            <div class="modal-content integration_remove_modal_body" style="border-radius: 18px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.18); overflow: hidden;">
                
            </div>
        </div>
    </div>

<div class="modal fade bd-example-modal-lg" id="add_spinner_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Integration</h5>
            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close"  onclick="hide_modal()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body spinner_body">
          
          </div>
      </div>
    </div>
  </div>

@endsection


@section('js')

{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfxfG6-lzhoNa8uOSnkXldoYG-35QbNfM&libraries=places&v=weekly" defer></script> --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL_Gc4eXdsopPpkv_EkMFyo-uoU8mWp5U&libraries=places&v=weekly" defer></script>

    <script>



    function hide_modal() {
        var el = document.getElementById('integration_add_modal');
        var m = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
        m.hide();
    }

    var _autocompleteInitialized = false;
    function open_integration_model() {
        // Show modal FIRST so a Maps API error doesn't block the modal
        var el = document.getElementById('integration_add_modal');
        if (!el) { console.error('integration_add_modal element not found'); return; }
        var m = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
        m.show();
        // Init autocomplete safely after modal is visible
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
            url: "{{URL::to('admin/open_integration_remove_modal')}}",// where you wanna post
            data: {
                'type':type
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional

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
            url: "{{URL::to('admin/integration_remove')}}",// where you wanna post
            data: {
                'type':type
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional

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
            const autocomplete = new google.maps.places.Autocomplete(input, {
                fields: ["place_id", "geometry", "formatted_address", "name"],
            });

            const placesService = new google.maps.places.PlacesService(document.createElement('div'));

            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();

                // Check if the place has a valid place_id
                if (place.place_id) {
                    // Use the getDetails method to fetch all details for the place
                    placesService.getDetails({ placeId: place.place_id }, (result, status) => {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            // 'result' contains all the details for the place
                            console.log(result);
                            console.log(result.reviews);
                            selectedPlace = result;
                            $(".integrate_button").show();
                            // Handle the full place details as needed
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
                // Perform AJAX request with the selected place details
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
                        // Handle successful response
                        console.log(data);
                        location.reload(true);

                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error(xhr.statusText);
                    }
                });
            }
        }


    function add_spinner_btn(review_type) {
     
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/review_links_form')}}",// where you wanna post
            data: {
                'review_type':review_type
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                $('.spinner_body').html(data);
                $('#add_spinner_modal').modal('show');
            } 
        });

    }

    function edit_spinner(url) {
     
        $.ajax({
            type: "GET",
            url: url,// where you wanna post
            data: {
                'id':''
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.log(errorMessage); // Optional
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
                console.log(errorMessage); // Optional
            },
            success: function(data) {
                console.log(data);
                swal({
                      title: "Success",
                      text: "Thank you for submit.",
                      type: "success",
                      confirmButtonText: "Cool"
                    });
                    
                    setTimeout(() => {
                      location.reload(true);
                    }, 1500);
            } 
        });

    }

    function integration_start() {
    if (confirm("Are you sure?")) {
        $.ajax({
            type: "POST",
            url: "{{ URL::to('admin/integration_start') }}", // where you want to post
            data: {
                '_token': "{{ csrf_token() }}"
            },
            error: function(jqXHR, textStatus, errorMessage) {
                console.error("Error:", errorMessage); // Improved error logging
            },
            success: function(data) {
                console.log("Response:", data);
                swal({
                    title: "Success",
                    text: "Thank you for submitting.",
                    icon: "success", // Updated for newer SweetAlert2 usage
                    button: "Cool"
                });

                setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        });
    }
}


    function hide_modal(params) {
        var spinEl = document.getElementById('add_spinner_modal');
        var spinM = bootstrap.Modal.getInstance(spinEl);
        if (spinM) spinM.hide();
        var addEl = document.getElementById('integration_add_modal');
        var addM = bootstrap.Modal.getInstance(addEl);
        if (addM) addM.hide();
        var rmEl = document.getElementById('integration_remove_modal');
        var rmM = bootstrap.Modal.getInstance(rmEl);
        if (rmM) rmM.hide();
    }

    // ── Modal stacking-context escape fix ──────────────────────────────────
    // Bootstrap 5 modals need to live directly under <body> to avoid being
    // trapped by any ancestor with a z-index / transform stacking context.
    document.addEventListener('DOMContentLoaded', function () {
        ['integration_add_modal', 'integration_remove_modal', 'add_spinner_modal'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el && el.parentElement !== document.body) {
                document.body.appendChild(el);
            }
        });

        if (typeof bootstrap === 'undefined') {
            console.error('Bootstrap JS not loaded — modals will not work!');
        } else {
            console.log('Bootstrap', typeof bootstrap.Modal, '— modals ready.');
        }
    });
    </script>


<script>
    // Initialize Sortable.js on the container
    document.addEventListener("DOMContentLoaded", function () {
        var container = document.getElementById('integrationContainer');
        Sortable.create(container, {
            animation: 150, // Smooth animation
            handle: '.drag-item', // Drag handle
            onEnd: function (evt) {
                // Get the updated order
                var order = [];
                document.querySelectorAll('#integrationContainer .drag-item').forEach(function (item) {
                    order.push({
                        id: item.id.replace('dragbble_', ''),
                        order: item.dataset.order
                    });
                });

                // Send the updated order to the server using an AJAX call
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
                    console.log(data.message); // Log success message
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
</script>

<!-- ====================================================================
     INTERACTIVE ONBOARDING TOUR FOR REVIEW LINKS (FIRST-TIME VISITORS)
     ==================================================================== -->
<div id="integrationsTourOverlay" style="display: none; position: fixed; inset: 0; z-index: 99998; pointer-events: auto;">
    <!-- Clickable backdrop to close or advance -->
    <div id="tourBackdropClickCatcher" onclick="closeIntegrationsTour()" style="position: absolute; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(2px); cursor: pointer;" title="Click anywhere to exit tour"></div>
    
    <!-- Dynamic Spotlight cutout box with pulsing illumination -->
    <div id="tourSpotlightBox" style="position: absolute; pointer-events: none; border-radius: 16px; border: 3px solid #2563eb; box-shadow: 0 0 0 9999px rgba(15, 23, 42, 0.65), 0 0 30px rgba(37, 99, 235, 0.55); transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1); z-index: 99999; display: none;"></div>

    <!-- Floating Tour Tooltip Card -->
    <div id="tourTooltipCard" style="position: absolute; width: 360px; max-width: calc(100vw - 32px); background: #ffffff; border-radius: 20px; border: 1px solid rgba(226, 232, 240, 0.95); box-shadow: 0 25px 60px -15px rgba(15, 23, 42, 0.38); padding: 22px; z-index: 100000; font-family: 'Plus Jakarta Sans', sans-serif; transition: all 0.32s cubic-bezier(0.16, 1, 0.3, 1); pointer-events: auto;">
        
        <!-- Top row: Badge, Steps counter, Close -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span id="tourStepBadge" style="display: inline-flex; align-items: center; gap: 4px; background: #eff6ff; border: 1px solid #bfdbfe; color: #1d4ed8; font-size: 0.72rem; font-weight: 800; padding: 3px 10px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.04em;">
                Step 1 of 5
            </span>
            <button type="button" onclick="closeIntegrationsTour()" style="background: none; border: none; color: #94a3b8; font-size: 1.35rem; line-height: 1; cursor: pointer; padding: 2px 6px; border-radius: 6px; transition: all 0.2s;" onmouseover="this.style.color='#0f172a'; this.style.background='#f1f5f9';" onmouseout="this.style.color='#94a3b8'; this.style.background='none';" title="Exit Tour (Esc)">
                &times;
            </button>
        </div>

        <!-- Step Title -->
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
            <div id="tourStepIcon" style="width: 36px; height: 36px; border-radius: 10px; background: #eff6ff; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: #2563eb; flex-shrink: 0;">
                <i class="ti ti-rocket"></i>
            </div>
            <h6 id="tourStepTitle" style="font-weight: 800; font-size: 1.06rem; color: #0f172a; margin: 0; line-height: 1.3;">
                Welcome to Review Links!
            </h6>
        </div>

        <!-- Step Description -->
        <p id="tourStepContent" style="font-size: 0.85rem; color: #475569; line-height: 1.55; margin: 0 0 18px 0;">
            This is where you configure which review channels appear on your public review page.
        </p>

        <!-- Footer -->
        <div style="display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #f1f5f9; padding-top: 14px;">
            <!-- Progress dots -->
            <div id="tourProgressDots" style="display: flex; gap: 6px; align-items: center;"></div>

            <!-- Nav Buttons -->
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
    var tourSteps = [
        {
            target: '#reviewLinksIntroTitle',
            fallbackTarget: '#reviewLinksCardHeader',
            badge: 'Step 1 of 5 • Welcome',
            icon: '<i class="ti ti-rocket"></i>',
            title: 'Welcome to Integrations Hub! 🚀',
            content: 'This is where you activate the review channels for your business. Every platform you configure here appears instantly on your public review page and smart QR standees!',
            placement: 'bottom'
        },
        {
            target: '[data-type="google"]',
            fallbackTarget: '.drag-item:first-child',
            badge: 'Step 2 of 5 • Top Priority',
            icon: '<i class="ti ti-brand-google"></i>',
            title: 'Connect Google Reviews ⭐',
            content: 'Google Reviews have the highest impact on your store ranking. Click <strong>"Integrate"</strong> to link your Google Business profile so happy customers are directed straight to leave a 5-star review on Google Maps.',
            placement: 'bottom'
        },
        {
            target: '[data-type="whatsapp"]',
            fallbackTarget: '[data-type="facebook"]',
            badge: 'Step 3 of 5 • Multi-Channel',
            icon: '<i class="ti ti-brand-whatsapp"></i>',
            title: 'WhatsApp & Social Channels 💬',
            content: 'Enable WhatsApp, Facebook, or Instagram so customers who don\'t have a Google account can still recommend your store, leave feedback, or chat with you directly.',
            placement: 'bottom'
        },
        {
            target: '#integrationContainer',
            fallbackTarget: '.card-body',
            badge: 'Step 4 of 5 • Custom Order',
            icon: '<i class="ti ti-arrows-sort"></i>',
            title: 'Drag & Drop Ordering 🔄',
            content: 'You can freely reorder your buttons! Simply click and drag any card to customize their layout. Platforms placed at the top will be shown first to your customers.',
            placement: 'top'
        },
        {
            target: '#navbarLiveReviewPill',
            fallbackTarget: '#btnRestartTour',
            badge: 'Step 5 of 5 • Live Preview',
            icon: '<i class="ti ti-external-link"></i>',
            title: 'Test Your Live Review Page 🌐',
            content: 'Click your <strong>Live Link</strong> in the header anytime to see exactly what your customers experience when they scan your QR code standees or click your link. You\'re all set!',
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
        
        // Mark tour as seen in localStorage
        try {
            localStorage.setItem('askreview_integrations_tour_seen', 'true');
        } catch(e) {}

        // Remove tour / source params from URL without refreshing
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

        // Find target element
        var targetEl = document.querySelector(step.target);
        if (!targetEl || targetEl.offsetParent === null) {
            if (step.fallbackTarget) {
                targetEl = document.querySelector(step.fallbackTarget);
            }
        }
        if (!targetEl || targetEl.offsetParent === null) {
            targetEl = document.getElementById('reviewLinksCardHeader') || document.body;
        }

        // Update Text & UI
        var badge = document.getElementById('tourStepBadge');
        if (badge) badge.innerText = step.badge;

        var icon = document.getElementById('tourStepIcon');
        if (icon) icon.innerHTML = step.icon;

        var title = document.getElementById('tourStepTitle');
        if (title) title.innerText = step.title;

        var content = document.getElementById('tourStepContent');
        if (content) content.innerHTML = step.content;

        // Prev & Next Buttons
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

        // Render progress dots
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

        // Scroll and position
        targetEl.scrollIntoView({ behavior: 'smooth', block: 'center' });

        setTimeout(function() {
            positionTourElements(targetEl, step.placement);
        }, 120);
    }

    function positionTourElements(targetEl, preferredPlacement) {
        var spotlight = document.getElementById('tourSpotlightBox');
        var card = document.getElementById('tourTooltipCard');
        if (!spotlight || !card) return;

        var rect = targetEl.getBoundingClientRect();
        var scrollY = window.pageYOffset || document.documentElement.scrollTop;
        var scrollX = window.pageXOffset || document.documentElement.scrollLeft;

        var pad = 8;
        var spotTop = rect.top + scrollY - pad;
        var spotLeft = rect.left + scrollX - pad;
        var spotWidth = rect.width + (pad * 2);
        var spotHeight = rect.height + (pad * 2);

        spotlight.style.display = 'block';
        spotlight.style.top = spotTop + 'px';
        spotlight.style.left = spotLeft + 'px';
        spotlight.style.width = spotWidth + 'px';
        spotlight.style.height = spotHeight + 'px';

        // Calculate card position
        var cardWidth = card.offsetWidth || 360;
        var cardHeight = card.offsetHeight || 220;

        var cardTop = 0;
        var cardLeft = (rect.left + scrollX) + (rect.width / 2) - (cardWidth / 2);

        if (preferredPlacement === 'top') {
            cardTop = (rect.top + scrollY) - cardHeight - 16;
            if (cardTop < scrollY + 10) {
                cardTop = (rect.bottom + scrollY) + 16;
            }
        } else {
            cardTop = (rect.bottom + scrollY) + 16;
            if (cardTop + cardHeight > document.documentElement.scrollHeight - 10) {
                cardTop = (rect.top + scrollY) - cardHeight - 16;
            }
        }

        // Clamp horizontally
        if (cardLeft < 16) cardLeft = 16;
        if (cardLeft + cardWidth > window.innerWidth - 16) {
            cardLeft = window.innerWidth - cardWidth - 16;
        }

        card.style.top = cardTop + 'px';
        card.style.left = cardLeft + 'px';
    }

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

    // Auto-launch for first-time visitors or if URL has tour=1 / source=onboarding
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