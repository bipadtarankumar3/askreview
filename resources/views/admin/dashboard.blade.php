@extends('adminLayouts.home')
@section('content')

<div class="container-fluid">

    @if (Auth::user()->type  == 'super_admin')
    <div class="row">
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-primary shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-primary d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Total Reseller </h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$resallers}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-success shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-success d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Active Reseller </h6>
              <div class="ms-auto text-success d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-success fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$active_resallers}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-danger shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-danger d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Inactive Reseller </h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$inactive_resallers}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-danger shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-danger d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Expired Reseller </h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$expired_resallers}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      
    </div>
    @elseif (Auth::user()->type  == 'admin')
    <div class="row">
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-primary shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-primary d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Total User</h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$Users}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-success shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-success d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Active User</h6>
              <div class="ms-auto text-success d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-success fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$ActiveUsers}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-danger shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-danger d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Inactive User</h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$InactiveUsers}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-danger shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-danger d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Expired Users</h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$expiredUsers}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      
    </div>
    @else
    <div class="row">
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-primary shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-primary d-flex align-items-center justify-content-center">
                {{-- <i class="ti ti-user-circle text-white"></i> --}}
                <i class="fa-solid fa-comment" style="font-size: 30px;color:white;"></i>
              </div>
              <h6 class="mb-0 ms-3">Feedback Questions </h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$Question}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-primary shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-primary d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-rss" style="font-size: 30px;color:white;"></i>
              </div>
              <h6 class="mb-0 ms-3">Feedback Data </h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$feedback_form_submit}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-primary shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-primary d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Private Contact </h6>
              <div class="ms-auto text-primary d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">{{$privateReview}}</h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-success shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-success d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Total Wp Used</h6>
              <div class="ms-auto text-success d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-success fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">
                
                @if (Auth::user()->wp_count)
                  {{Auth::user()->wp_count}}  
                  @else
                  0
                @endif
              </h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-xl-3">
        <div class="card bg-light-success shadow-none">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">
              <div class="round rounded bg-success d-flex align-items-center justify-content-center">
                <i class="ti ti-user-circle text-white" style="font-size: 30px;"></i>
              </div>
              <h6 class="mb-0 ms-3">Total Video</h6>
              <div class="ms-auto text-success d-flex align-items-center">
                {{-- <i class="ti ti-trending-up text-success fs-6 me-1"></i>
                <span class="fs-2 fw-bold">sas</span> --}}
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4">
              <h3 class="mb-0 fw-semibold fs-7">
                {{$video_testimonial}}
              </h3>
              {{-- <span class="fw-bold">$1,015.00</span> --}}
            </div>
          </div>
        </div>
      </div>

      
    </div>
    @endif

  {{-- {!! QrCode::size(300)->generate("qrcode_generator_test123") !!} --}}
    

  </div>

@endsection