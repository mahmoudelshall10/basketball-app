@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('league.index')}}">Leagues</a></li>
                              <li class="breadcrumb-item"><a href="{{route('league.index')}}">All Leagues</a></li>
                              <li class="breadcrumb-item"><a href="{{route('leaguesMatches.index',$league->league_id)}}">{{$league->league_name}} Matches</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Match</li>
                              <li class="breadcrumb-item">From : {{$league->league_start_date}}</li>
                              <li class="breadcrumb-item">To : {{$league->league_end_date}}</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                      {{Session('success')}}
                    </div>
                    @endif
                    
                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session('error')}}
                    </div>
                    @endif

                      <section class="card">
                         <div class="card-body">
                  
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('leaguesMatches.store',$league->league_id)}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Team A <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                          <select class="required number form-control @if ($errors->has('home_team')) is-valid @endif" name="home_team" >
                                             <option  value="" disabled="disabled" selected="">Team A</option>

                                                        @foreach($teams as $team)

                                                        <option value="{{$team->team_id}}" 
                                                        
                                                        @if(old('home_team') == $team->team_id)

                                                           {{"selected"}}
                                                        @endif >{{$team->team->team_name}}</option>
                                                       @endforeach
                                          </select>
                                          <span class="help-block">@if ($errors->has('home_team'))
                                                  {{ $errors->first('home_team') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Team B<span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                          <select class="required number form-control @if ($errors->has('away_team')) is-valid @endif" name="away_team" >
                                             <option  value="" disabled="disabled" selected="">Team B</option>
                                                        @foreach($teams as $team)

                                                        <option value="{{$team->team_id}}" 
                                                        
                                                        @if(old('away_team') == $team->team_id)

                                                           {{"selected"}}
                                                        @endif >{{$team->team->team_name}}</option>
                                                       @endforeach
                                          </select>
                                          <span class="help-block">@if ($errors->has('away_team'))
                                                  {{ $errors->first('away_team') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Place <span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                          <select class="required number form-control @if ($errors->has('match_hall')) is-valid @endif" name="match_hall" >
                                             <option  value="" disabled="disabled" selected="">Select Place</option>
                                                        @foreach($halls as $hall)

                                                        <option value="{{$hall->hall_id}}" 
                                                        
                                                        @if(old('match_hall') == $hall->hall_id)

                                                           {{"selected"}}
                                                        @endif >{{$hall->hall_name}}</option>
                                                       @endforeach
                                          </select>
                                          <span class="help-block">@if ($errors->has('match_hall'))
                                                  {{ $errors->first('match_hall') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  
                                <div class="form-group ">
                                    <label class="control-label col-sm-2 ">Date<span style="color: red">*</span></label>
                                    <div class="col-lg-10">
                                        <div class="input-group date form_datetime-component">
                                            <input type="text" class="form-control date-set" aria-label="Right Icon" name="match_date" aria-describedby="basic-addon12">
                                            <div class="input-group-append">
                                                <button id="basic-addon12" class="btn btn-outline-secondary" type="button"><i class="fa fa-calendar f14"></i></button>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('match_date'))
                                                {{ $errors->first('match_date') }}
                                            @endif</span>
                                    </div>
                                </div>

                                  {{-- first referee --}}
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Select Crow Chief Referee<span style="color: red">*</span></label>
                                      <div class="col-sm-10">
                                      <select class="required form-control"  name="first_referee" id="first_referee">
                                          <option value="">Select Crow Chief Referee</option>
                                          @foreach($referees as $referee)
                                                    <option value="{{$referee->referee_id}}"
                                                    @if(old('first_referee') == $referee->referee_id)
                                                        {{"selected"}}
                                                    @endif >{{$referee->referee_fullname}} - Type: {{$referee->referee_type}} - From: {{$referee->city->city_name_en}}
                                                    </option>
                                            @endforeach
                                      </select>
                                 
                                          <span class="help-block">@if ($errors->has('first_referee'))
                                                  {{ $errors->first('first_referee') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                    {{-- first referee --}}
                                    
                                    {{-- second referee --}}
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Select Umpire 1 Referee<span style="color: red">*</span></label>
                                        <div class="col-sm-10">
                                        <select class="required form-control"  name="second_referee" id="second_referee">
                                            <option value="">Select Umpire 1 Referee</option>
                                            @foreach($referees as $referee)
    
                                                            <option value="{{$referee->referee_id}}" 
                                                                @if(old('referee_id') == $referee->referee_id){{"selected"}}@endif>
                                                            {{$referee->referee_fullname}} - Type: {{$referee->referee_type}} - From: {{$referee->city->city_name_en}}
                                                            </option>
                                            @endforeach
                                        </select>
                                   
                                            <span class="help-block">@if ($errors->has('second_referee'))
                                                    {{ $errors->first('second_referee') }}
                                                @endif</span>
                                        </div>
                                      </div>
                                    {{-- second referee --}}

                                    {{-- third referee --}}
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Select Umpire 2 Referee</label>
                                        <div class="col-sm-10">
                                        <select class="form-control" name="third_referee" id='third_referee'>
                                            <option value="">Select Umpire 2 Referee</option>
                                            @foreach($referees as $referee)
    
                                                            <option value="{{$referee->referee_id}}" 
                                                                @if(old('referee_id') == $referee->referee_id){{"selected"}}@endif>
                                                            {{$referee->referee_fullname}} - Type: {{$referee->referee_type}} - From: {{$referee->city->city_name_en}}
                                                            </option>
                                                            @endforeach
                                        </select>
                                   
                                            <span class="help-block">@if ($errors->has('third_referee'))
                                                    {{ $errors->first('third_referee') }}
                                                @endif</span>
                                        </div>
                                      </div>
                                    {{-- third referee --}}

                                    {{-- Scorer Referee --}}
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Select Scorer Referee<span style="color: red">*</span></label>
                                        <div class="col-sm-10">
                                        <select class="required form-control" name="scorer_referee" id='scorer_referee'>
                                            <option value="">Select Scorer Referee</option>
                                            @foreach($referees as $referee)
    
                                                            <option value="{{$referee->referee_id}}" 
                                                                @if(old('referee_id') == $referee->referee_id){{"selected"}}@endif>
                                                            {{$referee->referee_fullname}} - Type: {{$referee->referee_type}} - From: {{$referee->city->city_name_en}}
                                                            </option>
                                                            @endforeach
                                        </select>
                                    
                                            <span class="help-block">@if ($errors->has('scorer_referee'))
                                                    {{ $errors->first('scorer_referee') }}
                                                @endif</span>
                                        </div>
                                        </div>
                                    {{-- Scorer Referee --}}

                                    {{-- Assistant Scorer Referee --}}
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Select Assistant Scorer Referee</label>
                                        <div class="col-sm-10">
                                        <select class="form-control" name="assistant_scorer_referee" id='assistant_scorer_referee'>
                                            <option value="">Select Assistant Scorer Referee</option>
                                            @foreach($referees as $referee)
    
                                                            <option value="{{$referee->referee_id}}" 
                                                                @if(old('referee_id') == $referee->referee_id){{"selected"}}@endif>
                                                            {{$referee->referee_fullname}} - Type: {{$referee->referee_type}} - From: {{$referee->city->city_name_en}}
                                                            </option>
                                                            @endforeach
                                        </select>
                                    
                                            <span class="help-block">@if ($errors->has('assistant_scorer_referee'))
                                                    {{ $errors->first('assistant_scorer_referee') }}
                                                @endif</span>
                                        </div>
                                        </div>
                                    {{-- Assistant Scorer Referee --}}

                                    {{-- Time keeper Referee --}}
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Select Time keeper Referee <span style="color: red">*</span></label>
                                        <div class="col-sm-10">
                                        <select class="required form-control" name="time_keeper_referee" id='time_keeper_referee'>
                                            <option value="">Select Time keeper Referee</option>
                                            @foreach($referees as $referee)
    
                                                            <option value="{{$referee->referee_id}}" 
                                                                @if(old('referee_id') == $referee->referee_id){{"selected"}}@endif>
                                                            {{$referee->referee_fullname}} - Type: {{$referee->referee_type}} - From: {{$referee->city->city_name_en}}
                                                            </option>
                                                            @endforeach
                                        </select>
                                    
                                            <span class="help-block">@if ($errors->has('time_keeper_referee'))
                                                    {{ $errors->first('time_keeper_referee') }}
                                                @endif</span>
                                        </div>
                                        </div>
                                    {{-- Time keeper Referee --}}

                                           {{-- Shoot Clock keeper Referee --}}
                                           <div class="form-group">
                                            <label class="col-sm-2 control-label">Select Shoot Clock keeper Referee</label>
                                            <div class="col-sm-10">
                                            <select class="form-control" name="shoot_clock_keeper_referee" id='shoot_clock_keeper_referee'>
                                                <option value="">Select Shoot Clock keeper Referee</option>
                                                @foreach($referees as $referee)
        
                                                                <option value="{{$referee->referee_id}}" 
                                                                    @if(old('referee_id') == $referee->referee_id){{"selected"}}@endif>
                                                                {{$referee->referee_fullname}} - Type: {{$referee->referee_type}} - From: {{$referee->city->city_name_en}}
                                                                </option>
                                                                @endforeach
                                            </select>
                                        
                                                <span class="help-block">@if ($errors->has('shoot_clock_keeper_referee'))
                                                        {{ $errors->first('shoot_clock_keeper_referee') }}
                                                    @endif</span>
                                            </div>
                                            </div>
                                        {{-- Shoot clock keeper Referee --}}

                                    {{-- Commessioner referee --}}
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Select Commessioner Referee</label>
                                        <div class="col-sm-10">
                                        <select class="form-control" name="commessioner_referee" id='commessioner_referee'>
                                            <option value="">Select Commessioner Referee</option>
                                            @foreach($referees as $referee)
  
                                                          <option value="{{$referee->referee_id}}" 
                                                              @if(old('referee_id') == $referee->referee_id){{"selected"}}@endif>
                                                          {{$referee->referee_fullname}} - Type: {{$referee->referee_type}} - From: {{$referee->city->city_name_en}}
                                                          </option>
                                                         @endforeach
                                        </select>
                                   
                                            <span class="help-block">@if ($errors->has('commessioner_referee'))
                                                    {{ $errors->first('commessioner_referee') }}
                                                @endif</span>
                                        </div>
                                      </div>
                                    {{-- Commessioner referee --}}


                            
                              
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('leaguesMatches.index',$league->league_id)}}" class="btn btn-default" type="button">Exit</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
              @push('adminjs')
                {{-- <script>
                // (()=>{
                $('#first_referee').change(function () {
                    var first_referee = $(this).val();
                    console.log(first_referee);
                    
                    if (first_referee) {
                    $.ajax({
                        type: "GET",
                        url: "{{url('getrefereesmatch')}}"+"/"+first_referee,
                        success: function (res) { 
                            $("#second_referee").empty();
                            $("#second_referee").append('<option>Select Second Referee</option>');
                            
                            /// loop javascript 
                            
                            $.each(res , function (key, value) {
                                // console.log(value);
                                $("#second_referee").append('<option value="' + value.referee_id + '">' + value.referee_fullname +' - Type: '+value.referee_type +' - From: ' +value.city.city_name_en+ '</option>');
                            });
                        }
                            });
                        } else {
                            $("#second_referee").empty();
                        }
                        });     
                </script>

                <script>
                    $('#second_referee').change(function () {
                    var second_referee = $(this).val();

                    if (second_referee) {
                    $.ajax({
                        type: "GET",
                        url: "{{url('getrefereesmatch')}}"+"/"+second_referee,
                        success: function (res) {
                            
                            $("#third_referee").empty();
                            $("#third_referee").append('<option>Select Third Referee</option>');
                            
                            /// loop javascript 
                            
                            $.each(res , function (key, value) {
                                // console.log(value);
                                $("#third_referee").append('<option value="' + value.referee_id + '">' + value.referee_fullname +' - Type: '+value.referee_type +' - From: ' +value.city.city_name_en+ '</option>');
                            });
                        }
                            });
                        } else {
                            $("#third_referee").empty();
                        }
                        });
                </script> --}}

              @endpush

@endsection