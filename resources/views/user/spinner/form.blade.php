<form method="POST" action="{{URL::to('admin/add_spinner')}}" class="form-horizontal r-separator" id="spinner_form" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" @if (isset($Spinner)) value="{{$Spinner->id}}"  @endif>
  <div class="card-body">

    <div class="form-group row align-items-center mb-0">
      <label for="camping_id" class="col-3 text-end control-label col-form-label">Campaign</label>
      <div class="col-9 border-start pb-2 pt-2">
        <select name="camping_id" id="camping_id"  class="col-3 control-label col-form-label form-control" required>
          <option value="" >Select</option>
          @foreach ($camping as $item)
              <option value="{{$item->id}}" @if (isset($Spinner)) @if($Spinner->camping_id == $item->id) selected @endif  @endif>{{$item->title}}</option>
          @endforeach
          
        </select>
      </div>
    </div>

    <div class="form-group row align-items-center mb-0">
      <label for="anme" class="col-3 text-end control-label col-form-label"> Name</label>
      <div class="col-9 border-start pb-2 pt-2">
        <input type="text" name="name"  @if (isset($Spinner)) value="{{$Spinner->name}}"  @endif class="form-control" id="anme" placeholder="Name Here" @required(true)>
      </div>
    </div>

    <div class="form-group row align-items-center mb-0">
      <label for="inputEmail3" class="col-3 text-end control-label col-form-label">Image</label>
      <div class="col-9 border-start pb-2 pt-2">
        <input type="file" name="file"  class="form-control" id="inputEmail3" placeholder="Email Here">
      </div>
    </div>

    <div class="form-group row align-items-center mb-0">
      <label for="date" class="col-3 text-end control-label col-form-label">Color</label>
      <div class="col-9 border-start pb-2 pt-2">
        <input type="color" name="color"  @if (isset($Spinner)) value="{{$Spinner->color}}"  @endif class="form-control" id="date" placeholder="Color Here" @required(true)>
      </div>
    </div>

    <div class="form-group row align-items-center mb-0">
      <label for="date" class="col-3 text-end control-label col-form-label">Spin Round</label>
      <div class="col-9 border-start pb-2 pt-2">
        <input type="number" name="value"  @if (isset($Spinner)) value="{{$Spinner->value}}"  @endif class="form-control value" id="value" placeholder="Spin Round Here" @required(true)>
        <span class="spin_round_error" style="color: red"></span>
      </div>
    </div>
    
    <div class="form-group row align-items-center mb-0">
      <label for="note" class="col-3 text-end control-label col-form-label">Skip</label>
      <div class="col-9 border-start pb-2 pt-2">
        <select name="skip" id=""  class="col-3  control-label col-form-label form-control" required>
            <option value="No" style="background-color: green;color:white" @if (isset($Spinner)) @if($Spinner->skip =='No' ) selected @endif  @endif>No</option>
            <option value="Yes" style="background-color: red;color:white" @if (isset($Spinner)) @if($Spinner->skip =='Yes' ) selected @endif  @endif>Yes</option>
            
          </select>
      </div>
    </div>
    <div class="form-group row align-items-center mb-0">
      <label for="note" class="col-3 text-end control-label col-form-label">Status</label>
      <div class="col-9 border-start pb-2 pt-2">
        <select name="status" id=""  class="col-3 control-label col-form-label form-control" required>
          <option value="active" @if (isset($Spinner)) @if($Spinner->stauts =='active' ) selected @endif  @endif>Active</option>
          <option value="inactive" @if (isset($Spinner)) @if($Spinner->stauts =='inactive' ) selected @endif  @endif>Inactive</option>
        </select>
      </div>
    </div>
  </div>
  <div class="p-3 border-top">
    <div class="form-group mb-0 text-end">
      <button type="button" onclick="add_spinner_submit()" class="btn btn-info rounded-pill px-4 waves-effect waves-light">
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