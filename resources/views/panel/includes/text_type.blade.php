
    <div class="form-group">
          <label class="col-sm-2 control-label">Option Text</label>
          <div class="col-sm-10">
              <input type="hidden" name="option_correct[]" value="0">
              <input type="text" class="required form-control @if ($errors->has('option_text')) is-valid @endif"  name="option_text[]" value="{{old('option_text')}}" >
              <span class="help-block">@if ($errors->has('option_text'))
                      {{ $errors->first('option_text') }}
                  @endif</span>
          </div>
      </div>
