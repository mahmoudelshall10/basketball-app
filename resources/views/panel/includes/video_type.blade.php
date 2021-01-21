 <div class="form-group">
          <label class="col-sm-2 control-label">Video Link</label>
          <div class="col-sm-10">
              <input type="text" class="required url form-control @if ($errors->has('option_text')) is-valid @endif"  name="option_url" value="{{old('option_url')}}" >
              <span class="help-block">@if ($errors->has('option_url'))
                      {{ $errors->first('option_url') }}
                  @endif</span>
          </div>
      </div>
    <div class="form-group">
          <label class="col-sm-2 control-label">Option Text</label>
          <div class="col-sm-10">
              <input type="text" class="required form-control @if ($errors->has('option_text')) is-valid @endif"  name="option_text[]" value="{{old('option_text')}}" >
              <input type="hidden" name="option_correct[]" value="0">
              <span class="help-block">@if ($errors->has('option_text'))
                      {{ $errors->first('option_text') }}
                  @endif</span>
          </div>
      </div>
