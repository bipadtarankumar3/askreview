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
                            <h5 class="mb-0">Subscription List</h5>
                        </div>
                        <div class="col-md-2">
                            <a href="{{URL::to('admin/admin_blanced_list')}}" class="btn btn-info">Add Blanced</a>
                            {{-- <a href="#" onclick="add_spinner_btn()" class="btn btn-info">Add Review</a> --}}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">
                

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
                                <th>User</th>
                                <th>Transaction Id</th>
                                <th>Amount</th>
                                <th>VAT/GST/Sales Tax 18%</th>
                                <th>Grand Amount</th>
                                <th>Payment Type</th>
                                <th>Credit</th>
                                <th>Prevoius Credit</th>
                                <th>Extend Credit</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>

                            @foreach ($Payments as $key=> $item)
                                <!-- start row -->
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->transction_id}}</td>
                                    <td>₹ {{$item->price}}</td>
                                    <td>₹ {{$item->gst_amount}}</td>
                                    <td>₹ {{$item->grand_total}}</td>
                                    <td>{{$item->payment_type}}</td>
                                    <td>{{$item->credit_limit}}</td>
                                    <td>{{$item->previous_credit}}</td>
                                    <td>
                                        <span style="color: green">{{$item->extend_credit}}</span>
                                        
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