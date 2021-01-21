@for($i=0;$i < 3 ;$i++)
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
                                     <div class="col-lg-12">
                                          
                                         
                                            <div class="custom-control custom-radio mb-3">
                                              <input type="radio" id="customRadio{{$i}}" name="option_correct[]" class="custom-control-input required @if ($errors->has('option_correct')) is-valid @endif" value="{{$i}}" @if(old('option_correct') === 1) {{"checked"}} @endif >
                                              
                                              <label class="custom-control-label" for="customRadio{{$i}}">Correct</label>
                                          </div>
                                         
                                        

                                      </div>
                                      <span class="help-block">@if ($errors->has('option_correct'))
                                                  {{ $errors->first('option_correct') }}
                                              @endif</span>
                                  </div>

                                  @endfor