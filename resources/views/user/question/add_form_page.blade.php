@extends('adminLayouts.home')
@section('content')


<div class="container-fluid">
    <!-- basic table -->

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        <form action="{{URL::to('admin/add_input_field_data')}}" method="POST">
                            @csrf
                            <div class="mb-2 add_more_box">
                                <div class="row ">
                                    <div class="col-md-10 ">
    
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="name[]"  @if (isset($FormFields)) value="{{$FormFields->name}}"  @endif class="form-control" id="anme" placeholder="Name Here" @required(true)>
                                            </div>
                                            <div class="col-md-2">
                                                <select name="required[]" id="" class="form-control">
                                                    <option value="">Select Required</option>
                                                    <option value="no">No</option>
                                                    <option value="yes">Yes</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="type[]" id="" class="form-control">
                                                    <option value="">Select type</option>
                                                    <option value="text">Paragraph</option>
                                                    <option value="textarea">Notes</option>
                                                    <option value="number">Number</option>
                                                    <option value="email">Email</option>
                                                </select>
                                            </div>
                                        </div>
    
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group mb-0">
                                            <button type="button" onclick="add_more()" class="btn btn-info rounded-pill px-4 waves-effect waves-light">
                                                Add More
                                              </button>
                                            
                                          </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </div>
                        </form>

                        

                        

                    </div>
                </div>

                
            </div>
           
        </div>
    
</div>

@endsection


@section('js')

    <script>

        function add_more(){
            $('.add_more_box').append(`
                <div class="row  form-row mt-4">
                                <div class="col-md-10 ">

                                    <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="name[]"  @if (isset($FormFields)) value="{{$FormFields->name}}"  @endif class="form-control" id="anme" placeholder="Name Here" @required(true)>
                                            </div>
                                            <div class="col-md-2">
                                                <select name="required[]" id="" class="form-control">
                                                    <option value="">Select Required</option>
                                                    <option value="no">No</option>
                                                    <option value="yes">Yes</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="type[]" id="" class="form-control">
                                                    <option value="">Select type</option>
                                                    <option value="text">Paragraph</option>
                                                    <option value="textarea">Notes</option>
                                                    <option value="number">Number</option>
                                                    <option value="email">Email</option>
                                                </select>
                                            </div>
                                        </div>

                                </div>
                                <div class="col-2">
                                    <div class="form-group mb-0">
                                        <button type="button" onclick="removeField(this)" class="btn btn-danger rounded-pill px-4 waves-effect waves-light">
                                            Delete
                                          </button>
                                        
                                      </div>
                                </div>
                            </div>

            `);
        }

        
    function removeField(button) {
        $(button).closest(".form-row").remove();
    }
    
    </script>

@endsection