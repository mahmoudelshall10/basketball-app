<div class="modal fade" id="Modal{{$team->leage_matches_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Number Of Periods</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST"  action="{{route('storePeriods',$team->leage_matches_id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-10">
                            <select class="required  form-control @if ($errors->has('num_of_periods')) is-valid @endif" name="num_of_periods">
                                <option value="" disabled="disabled" selected="">Select Type</option>

                                 <option value="1" @if( old('num_of_periods')  == "1"){{"selected"}}@endif >1</option>
                                 <option value="1.5" @if( old('num_of_periods')== "1.5"){{"selected"}}@endif >1.5</option>
                                 <option value="2" @if( old('num_of_periods')  == "2"){{"selected"}}@endif >2</option>
                                 <option value="2.5" @if( old('num_of_periods')== "2.5"){{"selected"}}@endif >2.5</option>
                                 <option value="3" @if( old('num_of_periods')  == "3"){{"selected"}}@endif >3</option>
                                          
                             </select>
                        </div>
                        <span class="help-block">@if ($errors->has('num_of_periods'))
                            {{ $errors->first('num_of_periods') }}
                        @endif</span>
                    </div>
                    <button type="submit" class="btn btn-danger">Save</button>
                </form>
                </div>
        </div>
    </div>
  </div> 