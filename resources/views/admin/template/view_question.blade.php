<form method="POST" action="{{URL::to('admin/questions_form')}}" class="form-horizontal r-separator" id="spinner_form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" @if (isset($Question)) value="{{$Question->id}}"  @endif>
    <div class="card-body">
  
      <div class="row">
        <div class="col-md-9">
          <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" class="form-control" readonly name="question" id="question" placeholder="Enter Question" @if($Question) value="{{$Question->question}}" @endif>
          </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Status</label>
            <select name="status" id="" readonly  class="form-control" required>
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
              <div class="col-md-5">
                <div class="mb-3">
                  <label for="answers" class="form-label">Answers</label>
                  <input type="text" class="form-control" name="answers[]" id="answers" value="{{$item->answers}}"  placeholder="Enter Answer">
                </div>
              </div>
              <div class="col-md-5">
                <div class="mb-3">
                  <label for="right_answer" class="form-label">Right Answer</label>
                  <select name="right_answer[]" id="right_answer"  class="form-control" required>
                    <option value="no" @if($item->right_answer =='no' ) selected @endif  >No</option>
                    <option value="yes" @if($item->right_answer =='yes' ) selected   @endif>Yes</option>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                
                
              </div>
            </div>
          @endforeach
  
        @else
          <div class="row">
            <div class="col-md-5">
              <div class="mb-3">
                <label for="answers" class="form-label">Answers</label>
                <input type="text" class="form-control" name="answers[]" id="answers" placeholder="Enter Answer">
              </div>
            </div>
            <div class="col-md-5">
              <div class="mb-3">
                <label for="right_answer" class="form-label">Right Answer</label>
                <select name="right_answer[]" id="right_answer"  class="form-control" required>
                  <option value="no" @if (isset($FormFields)) @if($FormFields->stauts =='no' ) selected @endif  @endif>No</option>
                  <option value="yes" @if (isset($FormFields)) @if($FormFields->stauts =='yes' ) selected @endif  @endif>Yes</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
            </div>
          </div>
  
        @endif
  
        
      </div>
  
    </div>

  </form>
  
 