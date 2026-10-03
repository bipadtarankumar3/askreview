@extends('adminLayouts.home')
@section('content')

<div class="container-fluid">

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Add Wallets</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="index.html">Wallets</a></li>
                  <li class="breadcrumb-item" aria-current="page">Add Wallets</li>
                </ol>
              </nav>
            </div>
            <div class="col-3">
              <div class="text-center mb-n5">  
                <img src="{{asset('adminAssets/images/breadcrumb/ChatBc.png')}}" alt="" class="img-fluid mb-n4">
              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- basic table -->
    <div class="row">
        <div class="col-md-12">
          
          <div class="card w-100">
            <div class="card-header">
              <div class="mb-2">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="mb-0">Create Wallets</h5>
                    </div>
                    <div class="col-md-4 text-end">
                        
                        <a href="{{URL::to('admin/wallets_list')}}" class="btn btn-success">Back</a>
                                  
                        
                    </div>
                </div>
                
                
            </div>
            
            </div>
            <form method="POST" action="{{URL::to('admin/submit_wallets')}}"  enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" @if (isset($wallets)) value="{{$wallets->id}}"  @endif>
              

              <div class="card-body border-top">
                <h5>Info</h5>
                <div class="row">
                  <div class="col-sm-12 col-md-3">
                    <div class="mb-3">
                      <label for="inputcontact" class="control-label col-form-label">Reseller</label>
                      <select name="user_id" id="" class="form-control">
                        <option value="">Select Reseller</option>
                        @foreach ($user as $item)
                            <option value="{{$item->id}}" @if(isset($wallets) && $wallets->user_id ==$item->id) @endif>{{$item->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                      <label for="amount" class="control-label col-form-label">Amount  <span style="color: red;">*</span></label>
                      <input type="number" name="amount"  @if (isset($wallets)) value="{{$wallets->name}}"  @endif class="form-control" id="amount" placeholder="Add Amount" required>
                    </div>
                  </div>
                  
                  
                  <div class="col-sm-12 col-md-3">
                    <div class="mb-3">
                      <label for="credit_debit" class="control-label col-form-label">Credit/Debit</label>
                      <select name="credit_debit" id="credit_debit" class="form-control">
                        <option value="credit" @if(isset($wallets) && $wallets->credit_debit =='credit') @endif>Credit</option>
                        <option value="debit" @if(isset($wallets) && $wallets->credit_debit =='debit') @endif>Debit</option>
                        
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                      <label for="note" class="control-label col-form-label">Note  <span style="color: red;">*</span></label>
                      <input type="text" name="note"  @if (isset($wallets)) value="{{$wallets->note}}"  @endif class="form-control" id="note" placeholder="Add note" required>
                    </div>
                  </div>
                </div>
               

                <div class="action-form">
                  <div class="mb-3 mb-0 text-start">
                    <button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light submit_button">
                      Save
                    </button>
                    <a href="{{URL::to('admin/wallets_list')}}">
                      <button type="button" class="btn btn-dark rounded-pill px-4 waves-effect waves-light">
                        Cancel
                      </button>
                    </a>
                  </div>
                </div>

              </div>
              
            </form>
          </div>

        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
      $('#name_url').keyup(function() {
        this.value = this.value.replace(/\s/g,'');
      });

      function check_username(name) {
          $.ajax({
              type: "GET",
              url: "{{URL::to('admin/user_name_checking')}}",// where you wanna post
              data: {
                  'name':name
              },
              error: function(jqXHR, textStatus, errorMessage) {
                  console.log(errorMessage); // Optional
              },
              success: function(data) {

                if (data == 'exist') {
                  $('.submit_button').attr('disabled','disabled');
                  $('.user_name_url').html('<p style="color:red">Already Exist</p>');
                } else {
                  $('.user_name_url').html('');
                  $('.submit_button').removeAttr('disabled');
                }

              } 
          });
      }
    </script>
@endsection