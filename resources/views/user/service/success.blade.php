@extends('adminLayouts.home')
@section('content')
<style>
    .success_col {
      text-align: center;
      padding: 40px 0;
    }
      .success_col h1 {
        color: #88B04B;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
      }
      .success_col p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size:20px;
        margin: 0;
      }
    .success_col i {
      color: #9ABC66;
      font-size: 100px;
      line-height: 200px;
      margin-left:-15px;
    }
    .success_col .card {
      background: white;
      padding: 60px;
      border-radius: 4px;
      box-shadow: 0 2px 3px #C8D0D8;
      display: inline-block;
      margin: 0 auto;
    }
  </style>

<div class="container-fluid">
    <!-- basic table -->
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 success_col">      
            <div class="card">
                <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                  <i class="checkmark">✓</i>
                </div>
                  <h1>Payment Successful</h1> 
                  <h4>Payment Id : {{$payment_id}}</h4> 
                  <p>Your subscription is active for 1 year from today's date..</p>
                  @if (Auth::user()->type == 'admin')
                  <a href="{{URL::to('admin/admin_service_payments_list')}}" class="btn btn-danger">View Payment</a>
                  @else
                  <a href="{{URL::to('admin/user_payments_list')}}"  class="btn btn-danger">View Payment</a>
                  @endif
                  
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>

@endsection


@section('js')
    <script>


    </script>
@endsection