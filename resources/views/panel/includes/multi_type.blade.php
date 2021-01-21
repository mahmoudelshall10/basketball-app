@for($i=0;$i < 3;$i++)

 <div class="form-group">
    <label class="col-sm-2 control-label">Option Text</label>
    <div class="col-sm-10">
        <input type="text" class="required form-control @if ($errors->has('option_text')) is-valid @endif"  name="option_text[]" value="{{old('option_text')}}" >
        <span class="help-block">@if ($errors->has('option_text'))
                {{ $errors->first('option_text') }}
            @endif</span>
    </div>
</div>
  <div class="form-group">
   
           <div class="custom-control form-check">
              
                <label class="form-check-label" for="checkbox-{{$i}}">
                  <input name="option_correct[]" id="checkbox-{{$i}}" class="form-check-input"  value="{{$i}}" type="checkbox" /> Correct. 
                </label>

                
           
    </div> 
    </div>

    @endfor