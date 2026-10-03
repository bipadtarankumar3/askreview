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
                            <h5 class="mb-0">Wallets List</h5>
                        </div>
                        <div class="col-md-4 text-end">
                            
                         
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="card-body">

                 

                <div class="row my-4">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-center">
                        <h4 class="">Search</h4>
                        <form action="{{URL::to('admin/my_wallets_list')}}" method="post">
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

            </div>
            
                    
                    <div class="table-responsive">
                        <table id="zero_config"
                            class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>Sl.</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Note</th>
                                    <th>Credit/Debit</th>
                                    <th>Amount Credit/Debit By</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>

                                @foreach ($list as $key=> $item)
                                    <!-- start row -->
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{number_format($item->amount, 2)}}</td>
                                        <td>{{$item->note}}</td>
                                        <td>
                                            
                                            @if($item->credit_debit == 'credit')
                                                <p style="color:green;">Credit</p>
                                            @else 
                                                <p style="color:red;">Debit</p>
                                                
                                            @endif
                                        </td>
                                        <td>
                                            {{$item->amount_credit_debit}}
                                        </td>
                                        
                                    </tr>
                                    <!-- end row --> 
                                @endforeach

                                
                                
                            </tfoot>
                        </table>
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

    $("#zero_config").DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy','excel', 'pdf', 'print'
        ]
    });
    </script>
@endsection