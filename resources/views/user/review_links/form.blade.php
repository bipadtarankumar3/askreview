<form method="POST" action="{{URL::to('admin/add_review_links')}}" class="form-horizontal r-separator" id="spinner_form" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" @if (isset($Integration)) value="{{$Integration->id}}"  @endif>
  <input type="hidden" name="review_type" @if (isset($review_type)) value="{{$review_type}}"  @endif>
  <div class="card-body">


    @if ($review_type != 'record')
    <div class="form-group row align-items-center mb-0">
      <label for="anme" class="col-3 text-end control-label col-form-label"> Key</label>
      <div class="col-9 border-start pb-2 pt-2">
        <input type="text" name="review_key"  @if (isset($Integration)) value="{{$Integration->review_links}}"  @endif class="form-control" id="review_key" placeholder="URL" @required(true)>
      </div>
    </div>
    @endif
      


    {{-- <div class="form-group row align-items-center mb-0">
      <label for="inputEmail3" class="col-3 text-end control-label col-form-label">Icon (PNG)</label>
      <div class="col-9 border-start pb-2 pt-2">
        <input type="file" name="file"  class="form-control" id="inputEmail3" placeholder="Email Here">
      </div>
    </div> 
    <div class="form-group row align-items-center mb-0">
      <label for="inputEmail3" class="col-3 text-end control-label col-form-label">Button Color</label>
      <div class="col-9 border-start pb-2 pt-2">
        <input type="color" name="color"  class="form-control" id="inputEmail3" @if (isset($ReviewLinks)) value="{{$ReviewLinks->color}}"  @endif>
      </div>
    </div>--}}

    
    <div class="form-group row align-items-center mb-0">
      <label for="note" class="col-3 text-end control-label col-form-label">Status</label>
      <div class="col-9 border-start pb-2 pt-2">
        <select name="status" id=""  class="col-3 control-label col-form-label form-control" required>
          <option value="active" @if (isset($Integration)) @if($Integration->status =='active' ) selected @endif  @endif>Active</option>
          <option value="inactive" @if (isset($Integration)) @if($Integration->status =='inactive' ) selected @endif  @endif>Inactive</option>
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