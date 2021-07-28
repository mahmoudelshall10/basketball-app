@extends('layouts.app')
@section('content')

@push('admincss')
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/bootstrap-datepicker/css/datepicker.css" />
@endpush


<div class="row">
    <div class="col-lg-12">
        <!--breadcrumbs start -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                {{-- <form class="form-horizontal tasi-form" action="{{route('Search')}}" enctype="multipart/form-data" method="GET"> --}}
                    <center>
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
                                <input type="text" min="2000" name="season_start_date" id="season_start_date" class="required default-date-picker form-control  @if ($errors->has('season_start_date')) is-valid @endif" placeholder="Season Start Date...">
                                <span class="help-block">@if ($errors->has('season_start_date'))
                                    {{ $errors->first('season_start_date') }}
                                    @endif
                                </span>    
                            </div>

                            <div class="col-lg-3">
                                <input type="text" min="2000" name="season_end_date" id="season_end_date" class="required default-date-picker form-control default-date-picker @if ($errors->has('season_end_date')) is-valid @endif" placeholder="Season End Date...">
                                <span class="help-block">@if ($errors->has('season_end_date'))
                                    {{ $errors->first('season_end_date') }}
                                    @endif
                                </span>    
                            </div>


                            <div class="col-lg-3">
                                <button class="btn btn-info" id="search" type="submit">Search <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </center>
                {{-- </form> --}}
            </ol>
        </nav>
        <!--breadcrumbs end -->
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
          <section class="card">
                <div class="card-body">
                    <div class="adv-table">
                        <table class="display table table-bordered table-striped" id="dynamic-table" style="direction: rtl;width:100%">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>الفريق أ</th>
                                    <th>الفريق ب</th>
                                    <th>اسم الدوري</th>
                                    <th>توقيت المباراة</th>
                                    <th>اسم الصالة</th>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="{{url('assets')}}/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script>
        $( function() {
            $( "#season_start_date" ).datepicker();
            $( "#season_end_date" ).datepicker();
        } );
    </script>

<script type="text/javascript">
    $(document).ready(function () {
     
        $('#search').on('click',function() {
            var referee_id     = $('#referee_id').val(); 
            var season_start_date      = $('#season_start_date').val(); 
            var season_end_date      = $('#season_end_date').val(); 
            $.ajax({
               
                url:"{{ route('Decline') }}",
          
                type:"GET",
               
                data:{
                    'referee_id':referee_id,
                    'season_start_date':season_start_date,
                    'season_end_date':season_end_date,
                    },
               
                success:function (data) {
                    $('tbody').html(data[0]);
                    $('#total').html(data[1]);
                }
            })
            // end of ajax call
        });

    });
</script>
@endpush

@endsection