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
                        <div class="col-md-10">
                            <h5 class="mb-0">Subscription List (Expiry Date: {{Auth::user()->expiry_date}})</h5>
                        </div>
                        <div class="col-md-2">
                            {{-- <a href="{{URL::to('admin/add_spinner_page')}}" class="btn btn-info">Add Spinner</a> --}}
                            {{-- <a href="#" onclick="add_spinner_btn()" class="btn btn-info">Add Review</a> --}}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
                
                {{-- <div class="row my-4">
                    <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            <h4 class="">Search</h4>
                            <form action="{{URL::to('admin/spinner_list')}}" method="post">
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
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Membership Details</th>
                                    <th>Form Date</th>
                                    <th>To date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Payments as $key=> $item)
                                    @if ($key == 0 )
                                        <tr>
                                            <td> <button class="btn btn-info">{{$item->subscription_date}} Year ({{$item->title}})</button> </td>
                                            <td>{{$item->form_date}}</td>
                                            <td>{{$item->to_date}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <form action="{{URL::to('admin/downloadSpinnerPdf')}}" method="post" class="mt-4">
                    @csrf
                       
                <div class="table-responsive">
                    <table id="zero_config"
                        class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th>Sl.</th>
                                <th>Date</th>
                                <th>Transaction Id</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>Address</th>
                                <th>GST Number</th>
                                <th>Amount</th>
                                <th>VAT/GST/Sales Tax 18%</th>
                                <th>Grand Amount</th>
                                <th>Payment For</th>
                                <th>Payment Type</th>
                                <th>Form Date</th>
                                <th>To date</th>
                                
                                
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>

                            @foreach ($Payments as $key=> $item)
                                <!-- start row -->
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->transction_id}}</td>
                                    <td>{{$item->country_name}}</td>
                                    <td>{{$item->state_name}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{$item->gst_number}}</td>
                                    <td>₹ {{$item->price}}</td>
                                    <td>₹ {{$item->gst_amount}}</td>
                                    <td>₹ {{$item->grand_total}}</td>
                                    <td>{{$item->subscription_date}} Year ({{$item->title}})</td>
                                    <td>{{$item->payment_type}}</td>
                                    <td>
                                        
                                        @php
                                            $new_date = date('Y-m-d', strtotime($item->form_date));
                                        @endphp
                                        {{$new_date}}
                                    </td>
                                    <td>
                                        @php
                                            $to_date = date('Y-m-d', strtotime($item->to_date));
                                        @endphp
                                        {{$to_date}}
                                    </td>
                                </tr>
                            @endforeach

                            
                            
                        </tfoot>
                    </table>
                </div>
            </form>
            </div>
        </div>
        <!-- ---------------------
                end Zero Configuration
            ---------------- -->
    </div>
</div>
</div>

<div class="modal fade bd-example-modal-lg" id="add_spinner_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Review Details</h5>
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
    <script>


    </script>
@endsection