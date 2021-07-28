@extends('layouts.app_rtl')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
            <div class="form-row">
                <div class="col-lg-3">
                    <select class="required form-control" name="referee_id" id='referee_id'>
                    <option value="" disabled="disabled" selected="">Select Referee</option>
                    @foreach($referees as $referee)

                                    <option value="{{$referee->referee_id}}" 
                                        @if(old('referee_id') == $referee->referee_id){{"selected"}}@endif>
                                    {{$referee->referee_fullname}} - Type: {{$referee->referee_type}} - From: {{$referee->city->city_name_en}}
                                    </option>
                                    @endforeach
                        </select>
            
                    <span class="help-block">@if ($errors->has('referee_id'))
                            {{ $errors->first('referee_id') }}
                        @endif</span>
                </div>
                
                <div class="col-lg-3">
                    <input type="number" min="2000" name="season_start_date" id="season_start_date"class="required  form-control @if ($errors->has('season_start_date')) is-valid @endif" placeholder="Season Start Date...">
                    <span class="help-block">@if ($errors->has('season_start_date'))
                        {{ $errors->first('season_start_date') }}
                        @endif
                    </span>    
                </div>

                <div class="col-lg-3">
                    <input type="number" min="2000" name="season_end_date" id="season_end_date" class="required  form-control @if ($errors->has('season_end_date')) is-valid @endif" placeholder="Season End Date...">
                    <span class="help-block">@if ($errors->has('season_end_date'))
                        {{ $errors->first('season_end_date') }}
                        @endif
                    </span>    
                </div>

                <div class="col-lg-3">
                    <button class="btn btn-info" id="search" type="submit">Search <i class="fa fa-search"></i></button>
                </div>
            </div>
            <hr>
                      <div class="adv-table">
                        <table class="display table table-bordered table-striped" id="dynamic-table" style="direction: rtl;width:100%">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>اسم الدوري</th>
                                    <th>الفريق أ</th>
                                    <th>الفريق ب</th>
                                    <th>توقيت المباراة</th>
                                    <th>اسم الصالة</th>
                                    <th>صافي المستحق</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th id="total">المجموع : </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
    </div>
</div>
@push('adminjs')

<script type="text/javascript">
    $(document).ready(function () {
        var table = $("#dynamic-table tbody");
        $('#search').on('click',function() {
            var referee_id     = $('#referee_id').val(); 
            var season_start_date      = $('#season_start_date').val(); 
            var season_end_date     = $('#season_end_date').val(); 
            $.ajax({
               
                url:"{{ route('Search') }}",
          
                type:"GET",
               
                data:{
                    'referee_id':referee_id,
                    'season_start_date':season_start_date,
                    'season_end_date':season_end_date,
                    },
               
                success:function (data) {
                    table.empty();
                    table.append(data[0]);
                    $('#total').html(' المجموع : ' + data[1]);
                    $('#dynamic-table').DataTable({
                            dom: 'lBfrtip',
                            bRetrieve:true,
                            buttons: [
                                { extend: 'print', footer: true},
                                { extend: 'excel', footer: true},
                            ],
                        });
                        $('.dt-buttons').css({"left": "5px", "top": "14px"});
                }
            })
            // end of ajax call
        });

    });
</script>
@endpush

@endsection