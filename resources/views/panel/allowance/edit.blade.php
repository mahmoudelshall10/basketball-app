@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('allowances.index')}}">Allowances </a></li>
                              <li class="breadcrumb-item"><a href="{{route('allowances.index')}}">All Allowances </a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Allowance</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('allowances.update',$allowance->allowance_id)}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 {{ method_field('PUT') }}
 
                                 <div class="form-group">
                                    <label class="-col-sm-2 control-label">Match</label>
                                    <div class="col-sm-10">

                                        <input class="form-control" disabled 
                                        value="{{$allowance->leageMatch->home->team_name}} - {{$allowance->leageMatch->away->team_name}} - in {{$allowance->leageMatch->hall->HallPlace->city_name_en}} - at {{$allowance->leageMatch->match_date}}"
                                        >
                                    </div>
                                    <span class="help-block">
                                        @if ($errors->has('leage_matches_id'))
                                            {{ $errors->first('leage_matches_id') }}
                                        @endif
                                    </span>
                                 </div>
                                
                                 <div class="form-group">
                                    <label class="-col-sm-2 control-label">Referee Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" disabled value="{{$allowance->referee->referee_fullname}} - {{$role}} - {{$allowance->referee->referee_type}} - From {{$allowance->referee->city->city_name_en}}">
                                    </div>
                                    <span class="help-block">
                                        @if ($errors->has('referee_id'))
                                            {{ $errors->first('referee_id') }}
                                        @endif
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label class="-col-sm-2 control-label">Allowance Name</label>
                                    <div class="col-sm-10">
                                       
                                        <select class="required  form-control @if ($errors->has('allowances_values_id')) is-valid @endif" name="allowances_values_id" id="allowances_values_id">
                                            <option>Select Allowance</option>
                                            @foreach ($allowancesvalues as $allowancevalue)
                                                <option {{$allowancevalue->allowances_values_id == $allowance->allowances_values_id ? 'selected':''}}
                                                    value="{{$allowancevalue->allowances_values_id}}">
                                                    {{$allowancevalue->allowance_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="help-block">
                                        @if ($errors->has('allowances_values_id'))
                                            {{ $errors->first('allowances_values_id') }}
                                        @endif
                                    </span>
                                </div>



                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('allowances.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
    @push('adminjs')
    <script type="text/javascript">
        $('#leage_matches_id').change(function () {
       var leage_matches_id = $(this).val();
    //    console.log(leage_matches_id);
      if (leage_matches_id) {
       $.ajax({
        type: "GET",
        url: "{{url('getmatchreferees')}}"+"/"+leage_matches_id,
        success: function (res) {
            
            $("#referee_id").empty();
            $("#referee_id").append('<option>Select Referee</option>');
            
            /// loop javascript 
             var role ='';
            $.each(res , function (key, value) {
                // console.log(value.referee_role);
                if (value.referee_role == 'playground_referee') {
                    role = 'Playground Referee';
                }
                if(value.referee_role == 'table_referee') {
                    role = 'Table Referee';
                }
                if(value.referee_role == 'observer_referee'){
                    role = 'Observer Referee';
                }
                $("#referee_id").append('<option value="' + value.referee_id + '">' + value.referee.referee_fullname +' - '+ role +' - ' + value.referee.referee_type + '</option>');
            });
        }
            });
           } else {
            $("#referee_id").empty();
           }
         });  
 </script>
    @endpush
@endsection