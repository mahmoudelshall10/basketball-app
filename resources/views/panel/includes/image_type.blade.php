 <div class="form-group">
        <label class="col-lg-2 control-label"  for="question_file">Question File  </label>
        <div class="col-lg-10">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+file" alt="" />
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                    <div>
                     <span class="btn btn-white btn-file">
                     <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select File</span>
                     <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                     <input type="file" name="question_file" class="default" value="{{old('question_file')}}" />
                     </span>
                        
                        
                    </div>
                     <div class="form-text text-muted">
                           @if ($errors->has('question_file'))
                              {{ $errors->first('question_file') }}
                          @endif
                         </div>
                </div>
        </div>
    </div>
    <div class="form-group">
          <label class="col-sm-2 control-label">Option Text</label>
          <div class="col-sm-10">
              <input type="text" class="required form-control @if ($errors->has('option_text')) is-valid @endif"  name="option_text[]" value="{{old('option_text')}}" >
              <span class="help-block">@if ($errors->has('option_text'))
                      {{ $errors->first('option_text') }}
                  @endif</span>
          </div>
      </div>
      <input type="hidden" name="option_correct[]" value="0">
