<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="referrer" content="never">
    <meta name="referrer" content="no-referrer">
    <meta property="og:type" content="website">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">


  
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('frontend/images/logo.jpg') }}">
    <!--<link rel="manifest" href="{{ asset('/manifest.json') }}">-->
       <link rel="manifest" href="{{ url('/manifest/' . $user_name . '.json') }}">
   
    

    <link rel="icon" type="image/png" sizes="200x200" href="{{$user->logo}}">
    <title>{{$user->name}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('frontend/css/my-style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    
</head>
<body>
   <!-- Loader -->
   <div class="text-center mb-3" id="loader">
    <i class="fas fa-spinner fa-spin fa-3x"  style="color:#f52e2e;"></i>
    <h3 style="color: white">Please wait we are uploading the file...</h3>
</div>
 
  <div class="container-fluid feedback">

    <div class="row">
      <div class="col-sm-12 col-md-6 text-center left_box" @if($user->default_background == 'No') style="background-color: {{$user->background_color}};" @endif >
        <div class="row">

          <div class="col-md-2"></div>
          <div class="col-md-8 col-12">
          <div class="logo_part" style="display: none">


          <div class="logo_img_box">
              <img src="{{$user->logo}}" alt="" srcset="" height="170px">
          </div>

            @if ($user->front_page_text != '')
                <h3>{{$user->front_page_text}}</h3>
            @else
              <h2>How was your experience with {{$user->name}} ?</h2>
            @endif

            <div class="rating">

              <input type="radio"  onchange="get_review_value(this.value)"  name="rating" id="r1" value="5">
              <label for="r1"></label>
            
              <input type="radio"  onchange="get_review_value(this.value)"  name="rating" id="r2" value="4">
              <label for="r2"></label>
            
              <input type="radio"  onchange="get_review_value(this.value)"  name="rating" id="r3" value="3">
              <label for="r3"></label>
            
              <input type="radio"  onchange="get_review_value(this.value)"  name="rating" id="r4" value="2">
              <label for="r4"></label>
            
              <input type="radio"  onchange="get_review_value(this.value)"  name="rating" id="r5" value="1">
              <label for="r5"></label>
            
            </div>
            
          </div>

          <div class="more_three_star" >

            <div class="container">

              <div class="share_option">
                <h5 style="display: flex;justify-content: end;">
                  <i class="fa-solid fa-share-nodes" onclick="show_share_option()"></i>
                  <div class="share_anchor" id="share_anchor" style="display: none">
                    @if ($user->facebook_share == 'Yes')
                        <a class="fb" href="http://www.facebook.com/share.php?u={{url()->current()}}" target="_blank">
                        <i class="fab fa-facebook"></i>
                      </a>
                    @endif
                    @if ($user->wp_share == 'Yes')
                    <a class="wp" href="https://wa.me/?text={{url()->current()}}" target="_blank">
                      <i class="fab fa-whatsapp"></i>
                    </a>
                    @endif
                  </div>
                  
                </h5>
                
            </div>

              <div class="form_logo_part">
                {{-- <div class="close_form">
                  <span onclick="close_social_links()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                  </span>
                </div> --}}
                <img src="{{$user->logo}}" alt="" srcset="" height="170px">

                <p>Share your experience with us. We value your feedback and strive to provide the best service possible. Thank you !</p>
                
    
                <div class="row">
                  <div class="col-md-12 mt-4">

                    @if (isset($IntegrationRecord) && $IntegrationRecord->status == 'active')
                        
                          <button type="button" onclick="record_video()" class="btn btn-secondary google_btn" style="text-align: left;
                            border-radius: 20px;">
                            <span>
                              <i class="fa-solid fa-video"  style="font-size: 20px"></i>
                            </span> 
                            <div class="btn_text">Video Testimonial</div>
                            <img src="{{URL::to('frontend/images/new-blinking-gif.gif')}}" width="28px" alt="" srcset="">
                          </button>
                        <br><br>
                    @endif

                    @if (isset($IntegrationGoogle) && $IntegrationGoogle->status == 'active')
                        
                        <a href="{{$IntegrationGoogle->review_links}}" target="_blank" class="mt-4">
                          <button type="button" class="btn btn-secondary google_btn" style="text-align: left;
                            border-radius: 20px;">
                            <span><img src="{{asset('frontend/images/google.png')}}" alt="" width="25px"></span> <div class="btn_text">Google</div>
                            
                          </button>
                        </a><br><br>
                    @endif
                    @if (isset($IntegrationFacebook)  && $IntegrationFacebook->status == 'active')
                        
                        <a href="{{$IntegrationFacebook->review_links}}" target="_blank" class="mt-4">
                          <button type="button" class="btn btn-secondary google_btn" style="text-align: left;
                            border-radius: 20px;">
                            <span><img src="{{asset('frontend/images/fb.png')}}" alt="" width="25px"></span> <div class="btn_text">Facebook</div>
                            
                          </button>
                        </a><br><br>
                    @endif
                    @if (isset($IntegrationYoutube)  && $IntegrationYoutube->status == 'active')
                        
                        <a href="{{$IntegrationYoutube->review_links}}" target="_blank" class="mt-4">
                          <button type="button" class="btn btn-secondary google_btn" style="text-align: left;
                            border-radius: 20px;">
                            <span><img src="{{asset('frontend/images/youtube.png')}}" alt="" width="25px"></span> <div class="btn_text">Youtube</div>
                            
                          </button>
                        </a><br><br>
                    @endif
                    @if (isset($IntegrationInstagram)  && $IntegrationInstagram->status == 'active')
                        
                        <a href="{{$IntegrationInstagram->review_links}}" target="_blank" class="mt-4">
                          <button type="button" class="btn btn-secondary google_btn" style="text-align: left;
                            border-radius: 20px;">
                            <span><img src="{{asset('frontend/images/instagram-.png')}}" alt="" width="25px"></span> <div class="btn_text">Instagram</div>
                            
                          </button>
                        </a><br><br>
                    @endif
                    
                     @if (isset($IntegrationWhatsapp)  && $IntegrationWhatsapp->status == 'active')
                        
                      <a href="{{$IntegrationWhatsapp->review_links}}" target="_blank" class="mt-4">
                        <button type="button" class="btn btn-secondary google_btn" style="text-align: left;
                          border-radius: 20px;">
                          <span><img src="{{asset('frontend/images/whatsapp.png')}}" alt="" width="25px"></span> <div class="btn_text">Whatsapp</div>
                          
                        </button>
                      </a><br><br>
                  @endif
                    

                  </div>
                  @if ($user->private_feedback == 'yes')
                      <div class="col-md-12 ">
                    
                      <button type="button" onclick="open_private_feedback()"  style="text-align: left;
                        border-radius: 20px;" class="btn btn-warning google_btn">
                        <span><i class="fa-regular fa-message"></i></span> <div class="btn_text">Private Enquiry</div>
                      </button>
                    </div>
                  @endif
                  
                  <div class="col-md-12 mt-4 " id="install_button" style="display:ruby;">
                    <button type="button" id="installButton" class="btn btn-sm btn-warning" style="text-align: left;
                        border-radius: 2px;display: none;">
                        <span><i class="fa-solid fa-download"></i> &nbsp; </span> <div class="btn_text"> Install</div>
                    </button>
                    {{-- <button type="button" class="btn btn-outline-info">Video Testimonial</button> --}}
                  </div>
                </div>
              </div>
            </div>

            
          </div>


          <div class="container">

            <form method="post" action="{{URL::to('/u/review_form_submit')}}" class="lessthen_three_feedback"  style="display: none">
              @csrf
              <input type="hidden" name="user_id" value="{{encrypt($user->id)}}">
              <input type="hidden" name="form_id" @if (isset($form_data) && $form_data->form_name) value="{{$form_data->id}}" @endif>
              <input type="hidden" name="rating_number" id="rating_number">
              <div class="close_form">
                <span onclick="close_form()">
                  <i class="fa fa-times" aria-hidden="true"></i>
                </span>
              </div>
              <div class="form_logo_part">
                <img src="{{$user->logo}}" alt="" srcset="" height="150px">
                @if (isset($form_data) && $form_data->form_name)
                  <h3>
                    {{$form_data->form_name}}
                  </h3>
                @endif
                @if (isset($form_data) && $form_data->desc)
                  @if ($form_data->desc ==' ')
                      <p>
                        Your opinion is very important to us. We appreciate your feedback and will use it to serve  you better and make improvements in our management.
                      </p>
                  @else
                      <p>
                      {{$form_data->desc}}
                    </p>
                  @endif
                  
                @endif
                
      
              </div>
              
            
              <div class="form_field_section"  @if($user->default_background == 'No') style="background-color: {{$user->background_color}};"  style="text-align: justify;" @else @endif >
              
                  
                  @foreach ($Question as $key=> $item)
                    <div class="row my-4" style="text-align: left">
                      <div class="col-md-12">
                        <h6>
                          <i class="fa-solid fa-bullseye"></i> {{$item->question}}
                        </h6>
                      </div>
                      <div class="col-md-12">
                        <div class="row">
                          @php
                              $answ = DB::table('question_answers')->where('question_id',$item->id)->orderBy('id','asc')->get();
                          @endphp
                          @foreach ($answ as $option)
                            <div class="col-md-6  col-sm-6 col-6">
                              <label class="ans_label">
                                <input type="radio" name="answers[{{ $item->id }}]" value="{{ $option->id }}">
                                {{ $option->answers }}
                              </label>
                            </div> 
                          @endforeach
                          
                        </div>
                      </div>
                    </div>
                  @endforeach
                  @if (isset($form_data) && !empty($form_data->customer_support))
                  <div class="row  mt-4">
        
                    <div class="col-md-12 ">
                        <input type="hidden" name="customer_support" id="customer_support" value="{{$form_data->customer_support}}">
                        <h6>
                          {{$form_data->customer_support}}
                        </h6>
                        <p class="customer_support_error" style="color: red;    text-align: -webkit-left;"></p>
                        <div class="rate">
                          <input type="radio" id="f_customer_support_star5" name="f_customer_support" value="5" />
                          <label for="f_customer_support_star5" title="text">5 stars</label>
                          <input type="radio" id="f_customer_support_star4" name="f_customer_support" value="4" />
                          <label for="f_customer_support_star4" title="text">4 stars</label>
                          <input type="radio" id="f_customer_support_star3" name="f_customer_support" value="3" />
                          <label for="f_customer_support_star3" title="text">3 stars</label>
                          <input type="radio" id="f_customer_support_star2" name="f_customer_support" value="2" />
                          <label for="f_customer_support_star2" title="text">2 stars</label>
                          <input type="radio" id="f_customer_support_star1" name="f_customer_support" value="1" />
                          <label for="f_customer_support_star1" title="text">1 star</label>
                        </div>
                        
                    </div>

                  </div>
                  @endif
                  @if (isset($form_data) && !empty($form_data->rate_text))
                    <div class="row  mt-4">
          
                      <div class="col-md-12 ">
                        <input type="hidden" name="rate_text" id="rate_text" value="{{$form_data->rate_text}}">
                          <h6>
                            {{$form_data->rate_text}}
                          </h6>
                          <p class="rate_text_error" style="color: red;    text-align: -webkit-left;"></p>
                          <div class="rate">
                            <input type="radio" id="star5" name="f_rate_text" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="f_rate_text" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="f_rate_text" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="f_rate_text" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="f_rate_text" value="1" />
                            <label for="star1" title="text">1 star</label>
                          </div>
                         
                          
                      </div>

                    </div>
                  @endif
                  @if (isset($form_data) && !empty($form_data->comments) )
                    <div class="row mt-4">
          
                      <div class="col-md-12 ">
                        
                          <h6>
                            {{$form_data->comments}}
                          </h6>
                          <textarea name="f_comments" id="f_comments" class="form-control"  placeholder="{{$form_data->comments}}"></textarea>
                      
                      </div>

                    </div>
                  @endif

                <div class="row text-right mt-4">
                  <div class="col-md-2">
                    
                  </div>
                  <div class="col-md-8 text-center">
                    <button type="button" class="btn btn-success form-control next_btn mb-4" onclick="customer_field_section_show()">Submit Your Feedback</button>
                  </div>
                  <div class="col-md-2">
                  </div>
                </div>
              </div>

              <div class="customer_field_section text-left" style="display: none">

                  <div class="row">
        
                    <div class="col-md-12" style="text-align: justify;">
                      
                        <h6>
                          Name
                        </h6>
                        <input type="text" name="f_customer_name" required id="f_customer_name" placeholder="Enter Your Name" class="form-control">
                      
                    </div>
                    <div class="col-md-12 my-4 "  style="text-align: justify;">
                      
                      <h6>
                        Phone Number
                      </h6>
                      <input type="text"   pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$" title="Enter Valid mobile number ex.9811111111" name="f_phone_number" required id="f_phone_number" placeholder="Enter Your Phone Number" class="form-control">
  
                  </div>

                  </div>
              
                

                <div class="row text-right mt-4">
                  <div class="col-md-2">
                    
                  </div>
                  <div class="col-md-8 text-center">
                    <button type="button" class="btn btn-warning"  onclick="customer_field_section_hide()">Back</button>
                    <button type="submit" class="btn btn-info">Submit</button>
                  </div>
                  <div class="col-md-2">
                  </div>
                </div>
              </div>
              
            </form>

            {{-- <form method="post" action="{{URL::to('/u/review_form_submit')}}" class="lessthen_three_feedback"  style="display: none">
              @csrf
              <input type="hidden" name="user_id" value="{{encrypt($user->id)}}">
              <input type="hidden" name="rating_number" id="rating_number">
              <div class="close_form">
                <span onclick="close_form()">
                  <i class="fa fa-times" aria-hidden="true"></i>
                </span>
              </div>
              <div class="form_logo_part">
                <img src="{{$user->logo}}" alt="" srcset="" height="150px">
                <p>{{$user->dynamic_page_text}}</p>
      
              </div>
              
            
              <div class="form_field_section">
                <div class="row ">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <input type="text" name="customer_name" required id="customer_name" class="form-control" placeholder="Enter your name">
                    </div>
                  </div>
                  @foreach ($FormFields as $key=> $item)
                    @if ($item->type == 'select')
                    <div class="col-md-6">
                      <div class="mb-3">
                        <select name="{{$item->name}}" id="{{$item->input_id}}" {{$item->required}} >
                          <option value="">Select</option>
                        </select>
                      </div>
                    </div>
                    @elseif ($item->type == 'textarea')
                    <div class="col-md-6">
                      <div class="mb-3">
                        <textarea name="{{$item->name}}" id="{{$item->input_id}}" class="form-control" placeholder="{{$item->placeholder}}" {{$item->required}} ></textarea>
                      </div>
                    </div>
                    @else
                    <div class="col-md-6">
                      <div class="mb-3">
                        <input type="{{$item->type}}" name="{{$item->name}}" {{$item->required}} id="{{$item->input_id}}" class="form-control" placeholder="{{$item->placeholder}}">
                      </div>
                    </div>
                    @endif
                    
                  @endforeach
                  
                </div>
                <div class="row text-right">
                  <div class="col-md-2">
                    
                  </div>
                  <div class="col-md-8">
                    <button type="submit" class="btn btn-info">Submit</button>
                  </div>
                  <div class="col-md-2">
                  </div>
                </div>
              </div>
              
            </form> --}}

            <form method="post" action="{{URL::to('/u/private_feedback')}}" class="private_feedback"  style="display: none">
              @csrf
              <input type="hidden" name="user_id" value="{{encrypt($user->id)}}">
              <input type="hidden" name="rating_number" id="rating_number">
              <div class="close_form">
                <span  onclick="close_form()">
                  <i class="fa fa-times" aria-hidden="true"></i>
                </span>
              </div>
              
              <div class="form_logo_part">
                <img src="{{$user->logo}}" alt="" srcset="" height="150px">
                {{-- <p>{{$user->private_page_text}}</p>/ --}}
                <p>Have Questions? Reach Out for More Details and Assistance</p>
      
              </div>
              
            
              <div class="form_field_section">
                <div class="row ">
                  <div class="col-md-12">
                    <div class="mb-3">
                      <input type="text" name="customer_name" required id="customer_name" class="form-control" placeholder="Enter your name">
                    </div>
                  </div>
                  
                </div>
                
                <div class="row ">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <input type="text"  pattern="^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$" title="Enter Valid mobile number ex.9811111111" required name="customer_number" id="customer_number" maxlength="10" class="form-control" placeholder="Enter your number">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <input type="email" name="customer_email" id="customer_email" class="form-control" placeholder="Enter your email">
                    </div>
                  </div>
                </div>
                <div class="row ">
                  <div class="col-md-12">
                    <div class="mb-3">
                      <textarea name="customer_message" id="customer_message" class="form-control" placeholder="Enter your message"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row text-right">
                  <div class="col-md-2">
                    
                  </div>
                  <div class="col-md-8">
                    <button type="submit" class="btn btn-success form-control send_btn">Send</button>
                  </div>
                  <div class="col-md-2">
                  </div>
                </div>
              </div>
              
            </form>

            <form method="post" action="{{URL::to('/u/video_testimonial')}}" id="video_testimonial_form" class="video_testimonial"  style="display: none">
              @csrf
              <input type="hidden" name="testi_user_id" id="testi_user_id" value="{{encrypt($user->id)}}">
              <input type="hidden" name="testi_rating_number" id="rating_number">
              <div class="close_form">
                <span onclick="close_form()">
                  <i class="fa fa-times" aria-hidden="true"></i>
                </span>
              </div>
              <div class="" id="videoContainer">
                <small class="web_cam_error" style="color: red"></small>
                <div class="video_box" id="video_box">
                  <video id="videoElement" autoplay muted></video>
                  <video id="previewVideo" controls style="display: none;"></video>

                  <div class="video_record_time_box" id="video_record_time_box" style="display: none">
                    <span  class="blink">Rec <div class="red_mark" ></div></span>&nbsp;
                    <span id="recordingTime" style="font-size: 20px;display:none;">00:60</span>
                  </div>
                  <div id="video_prepration_time_box"  style="display:none;">
                      <span id="preprationTime">0</span>
                  </div>
                  <br>
                  <div class="record_start_button">
                    <button type="button" id="startButton" class="btn btn-info btn-sm btn-record me-3"><i class="fa-solid fa-video"></i> Record Now</button>
                  </div>
                </div>

                
                <div  class="video_button_box">
                   
                    {{-- <button type="button" id="cancelButton" class="btn btn-danger btn-sm btn-cancel me-3" style="display: none;">Cancel</button> --}}
                    <button type="button" id="stopButton" class="btn btn-danger btn-sm btn-stop me-3" style="display: none;">Stop</button>
                    
                    <button type="button" id="previewButton" class="btn btn-warning btn-sm btn-preview" style="display: none;">Preview</button>
                    <button type="button" id="restartButton" class="btn btn-secondary btn-sm btn-restart" style="display: none;">Restart</button>
                </div>

                <div class="name_phone_no_box" id="name_phone_no_box" style="display: none">
                  <div class="row ">
                  
                    <div class="col-md-12">
                      <div class="mb-3 form-check">
                        <input type="checkbox" disabled checked class="form-check-input" id="video_customer_aggree">
                        <label class="form-check-label" for="video_customer_aggree">I agree that my video could be used for marketing purposes.</label>
                        
                      </div>
                      <div>
                        <small style="color: red" class="video_customer_aggree_error"></small>
                      </div>
                    </div>
                  </div>
                    <div class="row mt-2">
                      <div class="col-md-12">
                        <div class="mb-3">
                          <input type="text" required name="video_customer_name" id="video_customer_name" class="form-control" placeholder="Enter your name">
                        </div>
                      </div>
                      {{-- <div class="col-md-6">
                        <div class="mb-3">
                          <input type="text" name="video_customer_phone" id="video_customer_phone" class="form-control" placeholder="Enter your mobile no">
                        </div>
                      </div> --}}
                    </div>
                </div>
                
                <div class="row mt-2">
                  
                  <div class="col-md-12">
                    <button type="button" id="uploadButton"  class="btn btn-success btn-upload me-3 video_send_btn" style="display: none;">
                      Submit
                    </button>
                    <div class="submit_button_alert mt-2" style="display: none"><small style="color: red">(After Record, Please Click on Submit Button👆)</small></div>
                    
                    <audio id="audioPlayer"  style="display: none;">
                      <source src="{{URL::to('mp3/video_start.mp3')}}" type="audio/mpeg">
                      Your browser does not support the audio element.
                    </audio>
                  </div>
                </div>
                
            </div>
            </form>

          </div>
          <!--<p class="mt-4">Powered by askreview</p>-->
        </div>
      </div>
      <div class="col-md-2"></div>
        
      </div>
      <div class="col-sm-12 col-md-6 img_sec" style="">
        <div class="backgroung_img" @if ($user->background_image != '') style="background-image:url({{$user->background_image}})" @else style="background-image:url({{asset('frontend/images/background.jpg')}})"> @endif

        </div>
      </div>
    </div>

    
  </div>
<!-- Overlay -->
<div class="overlay"></div>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  

  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- Toastr -->


  <script>
        var loader = document.getElementById('loader');

// Overlay Element
var overlay = document.querySelector('.overlay');

    const video_box = document.getElementById('video_box');
    const videoElement = document.getElementById('videoElement');
    const previewVideo = document.getElementById('previewVideo');
    const startButton = document.getElementById('startButton');
    // const cancelButton = document.getElementById('cancelButton');
    const stopButton = document.getElementById('stopButton');
    const uploadButton = document.getElementById('uploadButton');
    const previewButton = document.getElementById('previewButton');
    const restartButton = document.getElementById('restartButton');
    const recordingTimeDisplay = document.getElementById('recordingTime');
    const recordingTimeBoxDisplay = document.getElementById('video_record_time_box');
    const preprationTimeDisplay = document.getElementById('preprationTime');
    const preprationTimeBoxDisplay = document.getElementById('video_prepration_time_box');
    const name_phone_no_box = document.getElementById('name_phone_no_box');


    let mediaRecorder;
    let recordedChunks = [];
    let startTime;
    let timerInterval;
    let remainingTime = 60;
    let videoStream;

    startButton.addEventListener('click', () => {
        // Disable start button during preparation
        startButton.disabled = true;
        video_box.style.background = 'black';
        preprationTimeBoxDisplay.style.display = 'inline';
        startButton.style.display = 'none';
        

        // Start preparation countdown
        countdown(5, () => {
            startButton.disabled = false; // Re-enable start button
            startRecording();
            videoElement.style.display = 'block';
            preprationTimeBoxDisplay.style.display = 'none';
            recordingTimeDisplay.style.display = 'inline';
            recordingTimeBoxDisplay.style.display = 'flex';
            
        });
    });

    
    function startRecording() {
        startButton.style.display = 'none';
        stopButton.style.display = 'inline';

        var audio = document.getElementById("audioPlayer");
        audio.play();

        // cancelButton.style.display = 'inline';
        try {

          if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {

            const constraints = { 
                  video: { facingMode: 'user' }, // 'user' for front camera, 'environment' for rear camera
                  audio: true 
              };
            navigator.mediaDevices.getUserMedia(constraints) // Request video and audio streams
                .then(stream => {
                    videoStream = stream;
                    videoElement.srcObject = videoStream;
                    mediaRecorder = new MediaRecorder(videoStream);

                    mediaRecorder.ondataavailable = event => {
                        if (event.data.size > 0) {
                            recordedChunks.push(event.data);
                        }
                    };

                    mediaRecorder.start();
                    startTime = Date.now();
                    timerInterval = setInterval(updateRecordingTime, 1000);
                })
                .catch(error => {
                  let errorMsg;
                  switch(error.name) {
                      case 'NotFoundError':
                          errorMsg = 'No media devices found.';
                          break;
                      case 'NotAllowedError':
                          errorMsg = 'Permission denied. Please allow access to the camera and microphone.';
                          break;
                      case 'NotReadableError':
                          errorMsg = 'Media device is already in use.';
                          break;
                      case 'OverconstrainedError':
                          errorMsg = 'Constraints cannot be satisfied by available devices.';
                          break;
                      default:
                          errorMsg = 'Error accessing webcam. If possible, please try again.';
                  }
                  $('.web_cam_error').html(errorMsg);
                  console.error('Error accessing webcam and microphone:', error);
                });
        
          } else {
                $('.web_cam_error').html('Your browser does not support accessing the webcam and microphone.');
          }
        } catch (error) {
          $('.web_cam_error').html('Error accessing webcam, If possible please try again');
            console.error('Error accessing webcam and microphone:', error);
        }
    }

    // cancelButton.addEventListener('click', () => {
    //     clearInterval(timerInterval); // Clear timer
    //     videoElement.style.display = 'none'; // Hide video element
    //     cancelButton.style.display = 'none'; // Hide cancel button
    //     startButton.style.display = 'inline'; // Show start button
    //     remainingTime = 60; // Reset remaining time
    //     recordingTimeDisplay.textContent = '00:60'; // Reset display
    //     if (mediaRecorder && mediaRecorder.state === 'recording') {
    //         mediaRecorder.stop(); // Stop media recorder if it's recording
    //     }
    //     if (videoStream) {
    //         videoStream.getTracks().forEach(track => track.stop()); // Stop video stream if it exists
    //     }
    //     recordedChunks = []; // Clear recorded chunks
    // });

    stopButton.addEventListener('click', () => {
        mediaRecorder.stop();
        clearInterval(timerInterval);
        uploadButton.style.display = 'inline'; // Show the upload button after recording stops
        previewButton.style.display = 'inline'; // Show the preview button after recording stops
        restartButton.style.display = 'inline'; // Show the restart button after recording stops
        stopButton.style.display = 'none'; // Show the restart button after recording stops
        // cancelButton.style.display = 'none'; // Show the restart button after recording stops
        name_phone_no_box.style.display = 'inline';

        $('.submit_button_alert').show();

        // Stop the webcam stream
        videoStream.getTracks().forEach(track => track.stop());
    });

    uploadButton.addEventListener('click', () => {
    if (recordedChunks.length > 0) {

      uploadButton.style.display = 'none';
      if ($('#video_customer_aggree').is(':checked')) {
        $('.video_customer_aggree_error').html('');
      }else{
        $('.video_customer_aggree_error').html('Please checked in checkbox');
        return;
      }

      var rating_number = $('#rating_number').val();
      var video_customer_name = $('#video_customer_name').val();
      var video_customer_phone = $('#video_customer_phone').val();
        // Convert recorded chunks to a single Blob
        const blob = new Blob(recordedChunks, { type: 'video/mp4' });

        // Create a FormData object
        const formData = new FormData();
        formData.append('video', blob, 'video.mp4');
        const testi_user_id = $('#testi_user_id').val();
        formData.append('testi_user_id', testi_user_id);
        formData.append('rating_number', rating_number);
        formData.append('video_customer_name', video_customer_name);
        formData.append('video_customer_phone', video_customer_phone);

        // Show loader and overlay
        loader.style.display = 'block';
        overlay.style.display = 'block';

        // Send the MP4 Blob to the server
        $.ajax({
            url: '{{ URL::to("u/video_testimonial_form_submit") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                console.log('Video uploaded successfully');

                toastr.success('Video uploaded successfully');
                loader.style.display = 'none';
                overlay.style.display = 'none';
                $('.more_three_star').show();
                $('#video_testimonial_form').hide();

              },
              error: function(xhr, status, error) {
                  console.error('Error uploading video:', error);
                  
                  // Display an error toast
                  toastr.error('Error uploading video: ' + error);
                  loader.style.display = 'none';
                overlay.style.display = 'none';
              }
        });
    } else {
        console.error('No video recorded');
    }
});

    previewButton.addEventListener('click', () => {
        // Show the preview video element
        previewVideo.style.display = 'block';
        // Hide the original video element
        videoElement.style.display = 'none';

        const blob = new Blob(recordedChunks, { type: 'video/webm' });
        const url = URL.createObjectURL(blob);
        previewVideo.src = url;
        previewVideo.play();
    });

    restartButton.addEventListener('click', () => {
        // Stop preview video playback
        previewVideo.pause();
        // Hide the preview video element
        previewVideo.style.display = 'none';
        // Show the original video element
        videoElement.style.display = 'none';
        // Hide other buttons
        startButton.style.display = 'inline';
        stopButton.style.display = 'none';
        uploadButton.style.display = 'none';
        previewButton.style.display = 'none';
        restartButton.style.display = 'none';
        name_phone_no_box.style.display = 'none';
        $('.submit_button_alert').hide();

        // Clear recorded chunks
        recordedChunks = [];
        remainingTime = 60;
        recordingTimeDisplay.textContent = '00:60';
    });

    function updateRecordingTime() {
        remainingTime--;
        const minutes = Math.floor(remainingTime / 60);
        const seconds = remainingTime % 60;
        const formattedTime = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        recordingTimeDisplay.textContent = formattedTime;
        if (remainingTime <= 0) {
            stopButton.click(); // Auto-stop recording when time is up
        }
    }


    function countdown(seconds, callback) {
        let counter = seconds;
        const countdownInterval = setInterval(() => {
            counter--;
            if (counter < 0) {
                clearInterval(countdownInterval);
                if (callback) {
                    callback();
                }
            } else {
              preprationTimeDisplay.textContent = `${counter}`;
            }
        }, 1000);
    }

</script>


<script src="{{ asset('/sw.js') }}"></script>
<script>
  // Function to save the current URL
  function saveCurrentUrl() {
      localStorage.setItem('lastVisitedUrl', window.location.href);
      console.log('Current URL saved:', window.location.href);
  }
  

  
  // Register service worker
  if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
          navigator.serviceWorker.register('/sw.js').then(registration => {
              console.log('Service Worker registered with scope:', registration.scope);
          }).catch(error => {
              console.log('Service Worker registration failed:', error);
          });
  
      });
  }
  
  // Listen to page changes and save the current URL
  window.addEventListener('beforeunload', saveCurrentUrl);
  
  // Handling the install prompt
  let deferredPrompt;
  const installButton = document.getElementById('installButton');
  
  window.addEventListener('beforeinstallprompt', (e) => {
      e.preventDefault();
      deferredPrompt = e;
      installButton.style.display = 'flex';
  
      installButton.addEventListener('click', () => {
          installButton.style.display = 'none';
          deferredPrompt.prompt();
          deferredPrompt.userChoice.then((choiceResult) => {
              if (choiceResult.outcome === 'accepted') {
                  console.log('User accepted the install prompt');
              } else {
                  console.log('User dismissed the install prompt');
              }
              deferredPrompt = null;
          });
      });
  });
  </script>
  

    <script>
      function get_review_value(review) {

        var review_option = <?php echo $user->review_show_option?>;
        // setTimeout(() => {
          if (review > review_option) {
            $('.more_three_star').show();
            $('.private_feedback').hide();
            $('.lessthen_three_feedback').hide();
          } else {
            $('.more_three_star').hide();
            $('.lessthen_three_feedback').show();
            
          }
          $('.logo_part').hide();
          $('#rating_number').val(review);
        // }, 500);

        
      }

      function open_private_feedback(){
        $('.private_feedback').show();
        $('.more_three_star').hide();
      }

      function close_form(){
        $('.private_feedback').hide();
        $('.lessthen_three_feedback').hide();
        $('#video_testimonial_form').hide();
        $('.more_three_star').show();

      }
      function customer_field_section_show(){

        var customer_support = $('#customer_support').val();
        console.log(customer_support);
        if (customer_support != undefined) {
            var checkedValue = $('input[name="f_customer_support"]:checked').val();

            if (checkedValue !== undefined) {
                $('.customer_support_error').html('');
            } else {
              $('.customer_support_error').html('Please click the '+customer_support);
              return false;
            }
        }

        var rate_text = $('#rate_text').val();
        if (rate_text != undefined) {
            var checkedValue = $('input[name="f_rate_text"]:checked').val();

            if (checkedValue !== undefined) {
                $('.rate_text_error').html('');
            } else {
              $('.rate_text_error').html('Please click the '+rate_text);
              return false;
            }
        }

        $('.form_field_section').hide();
        $('.customer_field_section').show();

      }
      function customer_field_section_hide(){
        $('.form_field_section').show();
        $('.customer_field_section').hide();

      }

      function close_social_links(){
        $('.logo_part').show();
        $('.more_three_star').hide();

      }

      function show_share_option() {
        
        var div = document.getElementById("share_anchor");
          if (div.style.display === "none") {
            div.style.display = "block";
          } else {
            div.style.display = "none";
          }
      }


      //video record section
      function record_video() {
        $('.video_testimonial').show();
        $('.more_three_star').hide();
      }

    </script>

    
  @yield('js')


  <script>
    @if(Session::has('messege'))
    var type = "{{Session::get('alert-type','info')}}";
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('messege')}}");
            bresk;
        case 'success':
            toastr.success("{{Session::get('messege')}}");
            bresk;
        case 'worning':
            toastr.worning("{{Session::get('messege')}}");
            bresk;
        case 'error':
            toastr.error("{{Session::get('messege')}}");
            bresk;
    }
    @endif


    
    function dataDelete(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute(
            'href'
            ); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Are you sure",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = urlToRedirect;
            } else {
                return false;
            }
        });
    }

  
    
  </script>

</body>
</html>