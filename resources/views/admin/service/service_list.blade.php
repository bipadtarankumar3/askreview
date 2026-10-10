@extends('adminLayouts.home')
@section('content')


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
                        <div class="col-md-8">
                            <h5 class="mb-0">Service List </h5>
                        </div>
                        <div class="col-md-4 text-end">
                            
                            <a href="{{URL::to('admin/service')}}" class="btn btn-info"> 
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New Service
                            </a>
                                         
                         </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">

                
                {{-- <div class="row my-4">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-center">
                        <h4 class="">Search</h4>
                        <form action="{{URL::to('admin/sub_user_list')}}" method="post">
                            @csrf
                            
                            <div class="row search-box">

                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Start Date</label>
                                        <input type="date" class="form-control" required  name="start_date" value="<?php echo isset($start_date)?date('Y-m-d',strtotime($start_date)):date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">End Date</label>
                                        <input type="date" class="form-control" required name="end_date" value="<?php echo isset($end_date)?date('Y-m-d',strtotime($end_date)):date('Y-m-d'); ?>" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group" style="margin-top: 21px;"> 
                                        <button type="submit" class="btn btn-success pull-right pull-rights"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                    </div>
                                </div>

                            </div>

                            <div class="clearfix"></div>

                        </form> 
                    </div>
                    <div class="col-md-2"></div>

            </div> --}}

            <div class="row">
                <div class="col-md-5">
                    <div class="card border shadow-none" style="border-radius: 12px; background: #fafafa;">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3" style="font-weight: 700; color: #0f172a;">
                                @if(!empty($id))
                                    <i class="fas fa-edit text-primary me-2"></i> Edit Service
                                @else
                                    <i class="fas fa-plus-circle text-info me-2"></i> Add New Service
                                @endif
                            </h5>
                            <form action="{{URL::to('admin/service_update')}}" method="POST" enctype='multipart/form-data'>
                                @csrf
            
                                <input type="hidden" name="id" id="id" @if (isset($id)) value="{{$id}}" @endif>
                                <div class="form-group mb-3">
                                  <label for="title" class="form-label fw-bold">Enter Service Name:</label>
                                  <input type="text" required title="Don`t Use White Space Only" pattern=".*\S+.*" class="form-control" placeholder="e.g. Premium Plan" id="title" name="title" @if (!empty($id)) value="{{$editData->title}}" @endif>
                                </div>

                                <div class="form-group mb-3">
                                  <label for="plan_type" class="form-label fw-bold">Plan Type / Category:</label>
                                  <select name="plan_type" id="plan_type" class="form-control form-select">
                                      <option value="basic" @if(!empty($id) && ($editData->plan_type ?? 'basic') == 'basic') selected @endif>Basic Plan</option>
                                      <option value="pro" @if(!empty($id) && ($editData->plan_type ?? '') == 'pro') selected @endif>Pro Plan</option>
                                      <option value="premium" @if(!empty($id) && ($editData->plan_type ?? '') == 'premium') selected @endif>Premium Plan</option>
                                  </select>
                                  <small class="text-muted d-block mt-1">Identifies whether this plan has basic, pro, or premium privileges.</small>
                                </div>

                                <div class="form-group mb-3">
                                  <label for="subscription_date" class="form-label fw-bold">Service Validity (Years):</label>
                                  <input type="text" required title="Don`t Use White Space Only" pattern=".*\S+.*" class="form-control" placeholder="Enter Year (e.g. 1)" id="subscription_date" name="subscription_date" @if (!empty($id)) value="{{$editData->subscription_date}}" @endif>
                                </div>

                                <div class="form-group mb-3">
                                  <label for="price" class="form-label fw-bold">Enter Price (INR):</label>
                                  <input type="text" required title="Don`t Use White Space Only" pattern=".*\S+.*" class="form-control" placeholder="Enter Price" id="price" name="price" @if (!empty($id)) value="{{$editData->price}}" @endif>
                                </div>

                                <div class="form-group mb-3">
                                  <label for="double_qr_access" class="form-label fw-bold">
                                      Double QR Functionality:
                                  </label>
                                  <select name="double_qr_access" id="double_qr_access" class="form-control form-select">
                                      <option value="N" @if(!empty($id) && ($editData->double_qr_access ?? 'N') == 'N') selected @endif>No (Locked)</option>
                                      <option value="Y" @if(!empty($id) && ($editData->double_qr_access ?? 'N') == 'Y') selected @endif>Yes (Allowed for Pro & Premium)</option>
                                  </select>
                                  <small class="text-muted d-block mt-1">Grant access to double QR code standee & downloads.</small>
                                </div>

                                <div class="form-group mb-3">
                                  <label for="video_access" class="form-label fw-bold">Video Access:</label>
                                    <select name="video_access" id="video_access" class="form-control form-select">
                                        <option value="N" @if(!empty($id) && $editData->video_access == 'N') selected @endif>No</option>
                                        <option value="Y" @if(!empty($id) && $editData->video_access == 'Y') selected @endif>Yes</option>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                  <label for="status" class="form-label fw-bold">Status:</label>
                                    <select name="status" id="status" class="form-control form-select">
                                        <option value="publish" @if(!empty($id) && $editData->status == 'publish') selected @endif>Publish</option>
                                        <option value="pending" @if(!empty($id) && $editData->status == 'pending') selected @endif>Pending</option>
                                    </select>
                                </div>
                               
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-4 fw-bold">
                                        @if(!empty($id)) Update Service @else Save Service @endif
                                    </button>
                                    @if(!empty($id))
                                        <a href="{{URL::to('admin/service')}}" class="btn btn-outline-secondary">Cancel</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <form action="{{URL::to('admin/downloadUserPdf')}}" method="post">
                        @csrf
                            <div class="table-responsive">
                                <table id="zero_config"
                                    class="table border table-striped table-bordered text-nowrap align-middle">
                                    <thead class="table-light">
                                        <!-- start row -->
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Title</th>
                                            <th>Plan Type</th>
                                            <th>Service Year</th>
                                            <th>Price</th>
                                            <th>Double QR</th>
                                            <th>Video Access</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        <!-- end row -->
                                    </thead>
                                    <tbody>
        
                                        @foreach ($service_list as $key=> $item)
                                            <!-- start row -->
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td><strong>{{$item->title}}</strong></td>
                                                <td>
                                                    @if (($item->plan_type ?? 'basic') == 'premium')
                                                        <span class="badge" style="background: #7c3aed; color: #fff; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                                             <i class="fas fa-crown me-1"></i> Premium
                                                        </span>
                                                    @elseif (($item->plan_type ?? '') == 'pro')
                                                        <span class="badge" style="background: #2563eb; color: #fff; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                                             <i class="fas fa-star me-1"></i> Pro
                                                        </span>
                                                    @else
                                                        <span class="badge" style="background: #64748b; color: #fff; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                                             Basic
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{$item->subscription_date}} Year</td>
                                                <td>₹{{$item->price}}</td>
                                                <td>
                                                    @if (($item->double_qr_access ?? 'N') == 'Y')
                                                        <span class="badge" style="background: #10b981; color: #fff; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                                            <i class="fas fa-check me-1"></i> Yes
                                                        </span>
                                                    @else
                                                        <span class="badge" style="background: #f43f5e; color: #fff; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                                            <i class="fas fa-times me-1"></i> No
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->video_access == 'Y')
                                                        <span class="badge bg-success">Yes</span>
                                                    @else
                                                        <span class="badge bg-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status == 'publish')
                                                        <span class="badge bg-success">publish</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">{{$item->status}}</span>
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                    <a href="{{URL::to('admin/service?service_id='.$item->id)}}" class="btn btn-sm btn-outline-primary" title="Edit Service">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- end row --> 
                                        @endforeach
        
                                        
                                        
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                </div>
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

    // $('.checkbox').click(function() {
    //     console.log($(this).attr("data-checked"));
    //     if ($(this).attr("data-checked") == 0) {
    //         $(this).attr("data-checked", "1")
    //     } else {
    //         $(this).attr("data-checked", "0")
    //     }
    // });

    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });

    // $("#zero_config").DataTable({
    //     dom: 'Bfrtip',
    //     // buttons: [
    $("#zero_config").DataTable();

    $('#plan_type').on('change', function() {
        if ($(this).val() === 'premium' || $(this).val() === 'pro') {
            $('#double_qr_access').val('Y');
        } else {
            $('#double_qr_access').val('N');
        }
    });
    </script>
@endsection