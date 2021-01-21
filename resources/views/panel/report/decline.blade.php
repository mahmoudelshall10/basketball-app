@extends('layouts.app')
@section('content')

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
                                <select class="required  form-control @if ($errors->has('league_id')) is-valid @endif" name="league_id" id="league_id" >
                                    <option disabled="disabled" selected="" value="">Select League</option>
                                    @foreach ($leagues as $league)
                                    <option value="{{$league->league_id}}"
                                        @if ($league->league_id)
                                            @if (old('league_id') == $league->league_id ) {{"selected"}} @endif 
                                        @endif 
                                        >{{$league->league_name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">@if ($errors->has('league_id'))
                                        {{ $errors->first('league_id') }}
                                    @endif</span>   
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
                        <table class="display table table-bordered table-striped" id="search-table" style="direction: rtl;width:100%">
                            <thead>
                                <tr>
                                    <th>اسم الصالة</th>
                                    <th>معاد المباراة</th>
                                    <th>الفريق ب</th>
                                    <th>الفريق أ</th>
                                    <th>اسم الدوري</th>
                                    <th>الاسم</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
    </div>
</div>
@push('adminjs')

<script type="text/javascript">
$(document).ready(function () {
    $('#search-table').DataTable({
            dom: 'lBfrtip',
            bRetrieve:true,
            buttons: [
                { extend: 'excel', footer: true},
                { extend: 'print', footer: true},
            ]
    });
    $('.dt-buttons').css({"left": "5px", "top": "14px"});
});
</script>  

<script type="text/javascript">
    $(document).ready(function () {
     
        $('#search').on('click',function() {
            var referee_id     = $('#referee_id').val(); 
            var league_id      = $('#league_id').val(); 
            $.ajax({
               
                url:"{{ route('Search') }}",
          
                type:"GET",
               
                data:{
                    'referee_id':referee_id,
                    'league_id':league_id,
                    },
               
                success:function (data) {
                    $('tbody').html(data);
                    // console.log(data);
                }
            })
            // end of ajax call
        });

    });
</script>
@endpush

@endsection