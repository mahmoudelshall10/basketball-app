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
                              <li class="breadcrumb-item"><a href="{{route('leaguesTeams.index',$league->league_id)}}">{{$league->league_name}} Teams</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Teams</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('leaguesTeams.store',$league->league_id)}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Team </label>
                                      <div class="col-sm-10">
                                          <select class="required number form-control @if ($errors->has('team_id')) is-valid @endif" name="team_id" >
                                             <option  value="" disabled="disabled" selected="">Select Team</option>
                                                        @foreach($teams as $team)

                                                        <option value="{{$team->team_id}}" 
                                                        
                                                        @if(old('team_id') == $team->team_id)

                                                           {{"selected"}}
                                                        @endif >{{$team->team_name}}</option>
                                                       @endforeach
                                          </select>
                                          <span class="help-block">@if ($errors->has('team_id'))
                                                  {{ $errors->first('team_id') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="f
         
                              
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('leaguesTeams.index',$league->league_id)}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
@endsection