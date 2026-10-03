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
            <div class="card-header">
                <div class="mb-2">
                    <div class="row">
                        <div class="col-md-10">
                            <h5 class="mb-0">Review Links List</h5>
                        </div>
                        <div class="col-md-2">
                            {{-- <a href="{{URL::to('admin/add_spinner_page')}}" class="btn btn-info">Add Spinner</a> --}}
                            {{-- <a href="#" onclick="add_spinner_btn()" class="btn btn-info">Add Review Links</a> --}}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
                <h4 class="text-center">Drag & Drop your favorite social media tabs to customize your feed</h4>
               <div id="integrationContainer" class="row">
                
                    @if (isset($integrationList) && count($integrationList) > 0)
                   
                        @if (isset($integrationList[0]) && $integrationList[0]->button_order != null)
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
                                <div class="col-md-3 mt-4 drag-item" id="dragbble_{{$item->id}}" data-order="{{$item->button_order}}">
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
                                                    <button class="btn btn-secondary edit" onclick="open_integration_remove_model('google')">Edit</button>
                                                @else
                                                    <button class="btn btn-secondary integrate" onclick="open_integration_model('google')">Integrate</button>
                                                @endif
                                            @elseif ($item->type == 'record')
                                                @if (isset($admin_user) && $admin_user->video_access == 'YES' && $video_access_show == true)
                                                    @if ($isConfigured)
                                                        <button class="btn btn-secondary edit" onclick="add_spinner_btn('record')">Edit</button>
                                                    @else
                                                        <button class="btn btn-secondary integrate" onclick="add_spinner_btn('record')">Integrate</button>
                                                    @endif
                                                @endif
                                            @elseif ($item->type == 'private')
                                            @else
                                                @if ($isConfigured)
                                                    <button class="btn btn-secondary edit" onclick="add_spinner_btn('{{$item->type}}')">Edit</button>
                                                @else
                                                    <button class="btn btn-secondary integrate" onclick="add_spinner_btn('{{$item->type}}')">Integrate</button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-3">
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
                                            <button class="btn btn-secondary edit"  onclick="open_integration_remove_model('google')">Edit</button>
                                        @else
                                            <button class="btn btn-secondary integrate" onclick="open_integration_model('google')">Integrate</button>
                                                                            
                                        @endif
                                        
                                    </div>
                                    
                                    
                                </div>
                            </div>
                 
                            <div class="col-md-3">
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
                                            <button class="btn btn-secondary edit"  onclick="add_spinner_btn('facebook')">Edit</button>
                                        @else
                                            <button class="btn btn-secondary integrate"  onclick="add_spinner_btn('facebook')">Integrate</button>
                                                                            
                                        @endif
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div class="col-md-3">
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
                                            <button class="btn btn-secondary edit"  onclick="add_spinner_btn('youtube')">Edit</button>
                                        @else
                                            <button class="btn btn-secondary integrate" onclick="add_spinner_btn('youtube')">Integrate</button>
                                                                            
                                        @endif
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div class="col-md-3">
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
                                            <button class="btn btn-secondary edit"  onclick="add_spinner_btn('instagram')">Edit</button>
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
                                            <button class="btn btn-secondary edit"  onclick="add_spinner_btn('whatsapp')">Edit</button>
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
                                            <button class="btn btn-secondary edit"  onclick="add_spinner_btn('record')">Edit</button>
                                        @else
                                            <button class="btn btn-secondary integrate" onclick="add_spinner_btn('record')">Integrate</button>
                                                                            
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

    <div class="modal fade bd-example-modal-lg" id="integration_remove_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content integration_remove_modal_body">
                
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
        
        $('#integration_add_modal').modal('hide');

    }

    function open_integration_model() {
        
        initAutocomplete() ;
        $('#integration_add_modal').modal('show');

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
                $('#integration_remove_modal').modal('show');
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
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{URL::to('admin/add_review_links')}}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#integration_remove_modal').modal('hide');
                swal({
                    title: "Success",
                    text: "Google status updated successfully.",
                    icon: "success",
                    button: "Cool"
                });
                setTimeout(() => {
                    location.reload(true);
                }, 1000);
            },
            error: function(err) {
                console.error(err);
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
                $('#add_spinner_modal').modal('show');
            } 
        });

    }

    function add_submit() {

        var spin_round = $('.value').val();
        if (spin_round == '') {
            $('.spin_round_error').html('Please Enter Spin Round Value');
            return;
        } else {
            $('.spin_round_error').html('');
        }

        var url = $('#spinner_form').attr("action");
        var form = $('#spinner_form')[0];
        // console.log(url);return;
        var formData = new FormData(form);// yourForm: form selector        
        $.ajax({
            type: "POST",
            url: url,// where you wanna post
            data: formData,
            processData: false,
            contentType: false,
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
        $('#add_spinner_modal').modal('hide');
    }

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


@endsection