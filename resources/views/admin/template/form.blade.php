<form method="POST" action="{{URL::to('admin/template/questions_form')}}" class="form-horizontal r-separator" id="spinner_form" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" @if (isset($Question)) value="{{$Question->id}}"  @endif>
  <input type="hidden" name="form_id" @if (isset($form_id)) value="{{$form_id}}"  @endif>
  <div class="card-body">

    <div class="row">
      <div class="col-md-9">
        <div class="mb-3">
          <label for="question" class="form-label">Question</label>
          <input type="text" class="form-control" name="question" id="question" placeholder="Enter Question" @if(isset($Question)) value="{{$Question->question}}" @endif>
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Status</label>
          <select name="status" id=""  class="form-control" required>
            <option value="active" @if (isset($Question)) @if($Question->stauts =='active' ) selected @endif  @endif>Active</option>
            <option value="inactive" @if (isset($Question)) @if($Question->stauts =='inactive' ) selected @endif  @endif>Inactive</option>
          </select>
        </div>
      </div>
    </div>
    


    <div class="add_more_section">

      @if (isset($Question))

        @foreach ($QuestionAnswer as $key=> $item)
          <div class="row  form-row">
            <div class="col-md-7">
              <div class="mb-3">
                <label for="answers" class="form-label">Option</label>
                <input type="text" class="form-control" name="answers[]" id="answers" value="{{$item->answers}}"  placeholder="Enter Option">
              </div>
            </div>

            <div class="col-md-2">
              @if ($key == 0)
                  <button type="button" class="btn btn-info" onclick="add_more()">Add</button>
              @else
              <button type="button" onclick="removeField(this)" class="btn btn-danger rounded-pill px-4 waves-effect waves-light">
                Delete
              </button>
              @endif
              
            </div>
          </div>
        @endforeach

      @else
        <div class="row">
          <div class="col-md-7">
            <div class="mb-3">
              <label for="answers" class="form-label">Option</label>
              <input type="text" class="form-control" name="answers[]" id="answers" placeholder="Enter Option">
            </div>
          </div>
          
          <div class="col-md-2">
            <button type="button" class="btn btn-info" style="margin-top: 27px" onclick="add_more()">Add</button>
          </div>
        </div>

      @endif

      
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

<script>
  function add_more(){
            $('.add_more_section').append(`
              <div class="row form-row">
                <div class="col-md-7">
                  <div class="mb-3">
                    <label for="answers" class="form-label">Option</label>
                    <input type="text" class="form-control" name="answers[]" id="answers" placeholder="Enter Option">
                  </div>
                </div>
                
                <div class="col-md-2">
                  <button type="button"  style="margin-top: 27px"  onclick="removeField(this)" class="btn btn-danger rounded-pill px-4 waves-effect waves-light">
                                            Delete
                                          </button>
                </div>
              </div>

            `);
        }

        
    function removeField(button) {
        $(button).closest(".form-row").remove();
    }
</script>