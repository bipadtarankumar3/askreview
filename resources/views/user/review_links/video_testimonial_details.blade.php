@extends('adminLayouts.home')
@section('content')

<style>
    .responsive-iframe {
    width: 100%;
    height: 500px;
    display: block;
    max-width: 100%; /* Set maximum width */
}
</style>
<style>
  .video-container {
    width: 100%;
    /* Additional styles for the container, if needed */
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
                            <h5 class="mb-0">Video Details</h5>
                        </div>
                        <div class="col-md-2">
                            {{-- <a href="{{URL::to('admin/add_spinner_page')}}" class="btn btn-info">Add Spinner</a> --}}
                            {{-- <a href="#" onclick="add_spinner_btn()" class="btn btn-info">Add Review</a> --}}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-center">
                         <small class="mb-2">
                            <a href="{{$url}}" class="btn btn-sm btn-success" download="{{$video_testimonial->video}}">Download <i class="fa-solid fa-download"></i></a>
                            (If video is not shown, Please click on Download Button)
                         
                        </small>
                        <!--<iframe src="{{URL::to('upload/'.$url)}}" class="responsive-iframe" frameborder="0" allowfullscreen></iframe>-->

                        <div class="video-container">
                          <video width="100%" height="auto" controls class="mt-4">
                            <source src="{{ $url }}" type="video/mp4">
                            Your browser does not support the video tag.
                          </video>
                        </div>

                    </div>
                    <div class="col-md-2"></div>
                </div>
                

            </div>
        </div>
        <!-- ---------------------
                end Zero Configuration
            ---------------- -->
    </div>
</div>
</div>


@endsection


@section('js')
    <script>

    </script>
@endsection