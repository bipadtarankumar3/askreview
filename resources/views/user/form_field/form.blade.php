<form method="POST" action="{{URL::to('admin/add_input_field')}}" class="form-horizontal r-separator" id="spinner_form" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" @if (isset($FormFields)) value="{{$FormFields->id}}"  @endif>
  <div class="card-body">

    <div class="form-group row align-items-center mb-0">
      <label for="type" class="col-3 text-end control-label col-form-label">Input Type</label>
      <div class="col-9 border-start pb-2 pt-2">
        <select name="type" id="type"  class="col-3 control-label col-form-label form-control" required>
          <option value="" >Select</option>
          <option value="text" @if (isset($FormFields)) @if($FormFields->type =='text' ) selected @endif  @endif>Text</option>
          <option value="number" @if (isset($FormFields)) @if($FormFields->type =='number' ) selected @endif  @endif>Number</option>
          <option value="checkbox" @if (isset($FormFields)) @if($FormFields->type =='checkbox' ) selected @endif  @endif>Checkbox</option>
          <option value="select" @if (isset($FormFields)) @if($FormFields->type =='select' ) selected @endif  @endif>Select</option>
          <option value="textarea" @if (isset($FormFields)) @if($FormFields->type =='textarea' ) selected @endif  @endif>Textarea</option>
        </select>
      </div>
    </div>

    <div class="form-group row align-items-center mb-0">
      <label for="anme" class="col-3 text-end control-label col-form-label"> Name</label>
      <div class="col-9 border-start pb-2 pt-2">
        <input type="text" name="name"  @if (isset($FormFields)) value="{{$FormFields->name}}"  @endif class="form-control" id="anme" placeholder="Name Here" @required(true)>
      </div>
    </div>

    <div class="form-group row align-items-center mb-0">
      <label for="placeholder" class="col-3 text-end control-label col-form-label">Placeholder</label>
      <div class="col-9 border-start pb-2 pt-2">
        <input type="text" name="placeholder"  @if (isset($FormFields)) value="{{$FormFields->placeholder}}"  @endif class="form-control" id="date" placeholder="Placeholder Here" @required(true)>
      </div>
    </div>
    
    <div class="form-group row align-items-center mb-0">
      <label for="required" class="col-3 text-end control-label col-form-label">Required</label>
      <div class="col-9 border-start pb-2 pt-2">
        <select name="required" id="required"  class="col-3  control-label col-form-label form-control" required>
            <option value="" style="background-color: green;color:white" @if (isset($FormFields)) @if($FormFields->required =='' ) selected @endif  @endif>No</option>
            <option value="required" style="background-color: red;color:white" @if (isset($FormFields)) @if($FormFields->required =='required' ) selected @endif  @endif>Yes</option>
            
          </select>
      </div>
    </div>
    <div class="form-group row align-items-center mb-0">
      <label for="note" class="col-3 text-end control-label col-form-label">Status</label>
      <div class="col-9 border-start pb-2 pt-2">
        <select name="status" id=""  class="col-3 control-label col-form-label form-control" required>
          <option value="active" @if (isset($FormFields)) @if($FormFields->stauts =='active' ) selected @endif  @endif>Active</option>
          <option value="inactive" @if (isset($FormFields)) @if($FormFields->stauts =='inactive' ) selected @endif  @endif>Inactive</option>
        </select>
      </div>
    </div>
  </div>
  <div class="p-3 border-top">
    <div class="form-group mb-0 text-end">
      <button type="button" onclick="add_submit()" class="btn btn-info rounded-pill px-4 waves-effect waves-light">
        Save
      </button>
      <a href="#" onclick="hide_modal()">
        <button type="button" class="btn btn-dark rounded-pill px-4 waves-effect waves-light">
          Cancel
        </button>
      </a>
      
    </div>
  </div>
</form>