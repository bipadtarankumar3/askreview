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
                            <h5 class="mb-0">Review List</h5>
                        </div>
                        <div class="col-md-2">
                            {{-- <a href="{{URL::to('admin/add_spinner_page')}}" class="btn btn-info">Add Spinner</a> --}}
                            {{-- <a href="#" onclick="add_spinner_btn()" class="btn btn-info">Add Review Links</a> --}}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
               <div class="row">

                @foreach ($SocialReview as $item)
                    
                    <div class="col-md-6">
                        <div class="review_box">
                            <div class="next_review_box">
                                <div class="review_star_box" >
                                    <div class="google_logo_box">
                                        <img alt="logo" class="jss797" src="{{asset('frontend/images/google.png')}}">
                                        <p class="MuiTypography-root MuiTypography-body1 css-zs0trh" style="padding-left: 8px; color: rgb(107, 114, 128);">Google</p>
                                    </div>
                                    <div class="MuiBox-root css-12z0wuy"></div>
                                    <div class="google_star_box" >
                                        <div class="google_next_star_box" separator="[object Object]">
                                            @php
                                                $rating = $item->rating;
                                            @endphp
                                            @for ($i = 0; $i < $rating; $i++)
                                                <div style="color: rgb(255, 184, 0); width: 15px; height: 15px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                    <path d="M11.857 1.92587C10.7901 -0.641954 7.20991 -0.641957 6.14297 1.92587L5.58369 3.27189C5.361 3.80784 4.87574 4.17228 4.3211 4.23508L2.76039 4.41179C0.12208 4.71052 -0.9307 7.99488 0.966294 9.82888L2.29142 11.11C2.68291 11.4885 2.85894 12.0499 2.75098 12.596L2.43104 14.2142C1.89984 16.901 4.795 18.9982 7.12787 17.5005L8.17453 16.8286C8.67966 16.5043 9.32034 16.5043 9.82547 16.8286L10.8721 17.5005C13.205 18.9982 16.1002 16.901 15.569 14.2142L15.249 12.596C15.1411 12.0499 15.3171 11.4885 15.7086 11.11L17.0337 9.82888C18.9307 7.99488 17.8779 4.71052 15.2396 4.41179L13.6789 4.23508C13.1243 4.17228 12.639 3.80784 12.4163 3.27189L11.857 1.92587Z" fill="#FFB800"></path>
                                                    </svg>
                                                </div>
                                                <div class="MuiBox-root css-12z0wuy"></div>
                                            @endfor
                                            
                                            
                                            
                                        </div>
                                        <div class="MuiBox-root css-12z0wuy"></div>
                                        <p class="MuiTypography-root MuiTypography-body1 css-1pu83wr" style="color: rgb(107, 114, 128);"><?php echo date('M d, Y', $item->time);?></p>
                                    </div>
                                    <div class="MuiBox-root css-12z0wuy"></div>
                                    <div class="user_location_box">
                                        <div class="user_next_location_box">
                                            <div class="jss797 MuiBox-root css-70qvj9">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0C3.56777 0 0 3.70292 0 8.23891C0 10.4908 0.878292 12.9032 2.28347 14.757C3.68543 16.6066 5.69437 18 8 18C10.3056 18 12.3146 16.6066 13.7165 14.757C15.1217 12.9032 16 10.4908 16 8.23891C16 3.70292 12.4322 0 8 0ZM5.16571 7.61538C5.16571 6.035 6.43467 4.75385 8 4.75385C9.56533 4.75385 10.8343 6.035 10.8343 7.61538C10.8343 9.19577 9.56533 10.4769 8 10.4769C6.43467 10.4769 5.16571 9.19577 5.16571 7.61538ZM8 5.86154C7.0406 5.86154 6.26286 6.64676 6.26286 7.61538C6.26286 8.58401 7.0406 9.36923 8 9.36923C8.9594 9.36923 9.73714 8.58401 9.73714 7.61538C9.73714 6.64676 8.9594 5.86154 8 5.86154Z" fill="#848484"></path>
                                                </svg>
                                            </div>
                                            <p class="MuiTypography-root MuiTypography-body1 css-zs0trh" has_text="true" style="padding-left: 8px; color: rgb(107, 114, 128);"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="review_user_part">
                                    <div class="review_next_user_part">
                                        <div class="MuiBox-root css-qswjcr">
                                            @if ($item->profile_photo_url != '')
                                                <img alt="logo" class="" src="{{$item->profile_photo_url}}">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none">
                                                    <path d="M7 0C4.56586 0 2.59259 1.95716 2.59259 4.37143C2.59259 6.7857 4.56586 8.74286 7 8.74286C9.43414 8.74286 11.4074 6.7857 11.4074 4.37143C11.4074 1.95716 9.43414 0 7 0Z" fill="black"></path>
                                                    <path d="M9.60096 10.6877C7.87789 10.4149 6.12211 10.4149 4.39904 10.6877L4.21435 10.7169C1.78647 11.1012 0 13.1783 0 15.6168C0 16.933 1.07576 18 2.40278 18H11.5972C12.9242 18 14 16.933 14 15.6168C14 13.1783 12.2135 11.1012 9.78565 10.7169L9.60096 10.6877Z" fill="black"></path>
                                                </svg> 
                                            @endif
                                            
                                            <div class="MuiBox-root css-146cg6a" style="color: rgb(46, 46, 46);">
                                                <p class="MuiTypography-root MuiTypography-body1 undefined jss806 css-zs0trh" has_text="true">{{$item->author_name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="MuiBox-root css-8dd97e"></div>
                                </div>
                                <div class="review_text_part">
                                    <div class="MuiBox-root css-4z936r">
                                        {{$item->text}}
                                    </div>
                                </div>
                                <div class="reply_box">
                                    <div class="MuiBox-root css-lrg10f">
                                        @if (isset($Integration->review_links))
                                            <a href="{{$Integration->review_links}}" target="_blank">
                                                <button class="btn btn-info"type="button">
                                                    Reply
                                                </button>
                                            </a>
                                        @endif
                                        
                                        
                                    </div>
                                    <div class="MuiBox-root css-12z0wuy"></div>
                                    <div class="MuiBox-root css-ygcxwr"></div>
                                    <div class="MuiBox-root css-12z0wuy"></div>
                                    <div class="MuiBox-root css-xt0vvu">
                                        {{-- <button class="MuiButtonBase-root MuiButton-root OutlinedButton MuiButton-contained MuiButton-containedPrimary MuiButton-sizeSmall MuiButton-containedSizeSmall MuiButton-root OutlinedButton MuiButton-contained MuiButton-containedPrimary MuiButton-sizeSmall MuiButton-containedSizeSmall css-gjzuua" tabindex="0" type="button" style="width: 100%; text-transform: none;">
                                        <div class="undefined font_600 TextNode MuiBox-root css-l8qto0" weight="6" size="15">Remove from Widgets</div>
                                        <span class="MuiTouchRipple-root css-w0pj6f"></span>
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                    
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


@endsection


@section('js')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfxfG6-lzhoNa8uOSnkXldoYG-35QbNfM&libraries=places&v=weekly" defer></script>


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


    function add_spinner_btn() {
     
        $.ajax({
            type: "GET",
            url: "{{URL::to('admin/review_links_form')}}",// where you wanna post
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
        var postData = $('#spinner_form').serializeArray();
        
        var reviewKey = $('#review_key').val();
        if (reviewKey) {
            var encodedKey = btoa(unescape(encodeURIComponent(reviewKey)));
            var found = false;
            for (var i = 0; i < postData.length; i++) {
                if (postData[i].name === 'review_key') {
                    postData[i].value = encodedKey;
                    found = true;
                    break;
                }
            }
            if (!found) {
                postData.push({ name: 'review_key', value: encodedKey });
            }
            postData.push({ name: 'is_encoded', value: '1' });
        }

        $.ajax({
            type: "POST",
            url: url,
            data: $.param(postData),
            dataType: 'json',
            headers: {
                'Accept': 'application/json, text/javascript, */*; q=0.01'
            },
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

    function hide_modal(params) {
        $('#add_spinner_modal').modal('hide');
    }

    </script>
@endsection