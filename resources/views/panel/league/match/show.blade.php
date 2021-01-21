@extends('layouts.app')
@section('content')
              <div class="row">

                  <aside class="profile-info">
                      
                      <section class="card">
                          
                          <div class="card-body bio-graph-info">
                              <h1>Match Details</h1>
                              <div class="row">

                                  <div class="bio-row">
                                      <p><span>League Name</span>: {{$leage_match->league->league_name}}</p>
                                  </div>

                                  <div class="bio-row">
                                      <p><span>Team Home</span>: {{$leage_match->home->team_name}}</p>
                                  </div>

                                  <div class="bio-row">
                                      <p><span>Team Away</span>: {{$leage_match->away->team_name}}</p>
                                  </div>

                                <div class="bio-row">
                                    <p><span>Match Date</span>: {{$leage_match->match_date}}</p>
                                </div>

                                <div class="bio-row">
                                    <p><span>Match Referees</span>: 
                                        @foreach ($leage_match->referee as $referee)
                                            @foreach ($MatchesReferees as $matchreferee)
                                                @if ($matchreferee->referee_id == $referee->referee->referee_id)
                                                <hr>
                                                    {{ucwords($referee->referee->referee_fullname)}} - Type :{{$referee->referee->referee_type}} - Role :{{$matchreferee->referee_role->role_en}} 
                                                <br>
                                            @endif
                                            @endforeach
                                        @endforeach
                                    </p>
                                </div>

                                <div class="bio-row">
                                    <p><span>Match Score Sheet</span>: 
                                        <div class="user-heading round">
                                            <a href="#">
                                                @if($leage_match->score_sheet_image == null)
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                @else
                                                    <img src="{{url($leage_match->score_sheet_image)}}" alt="" />
                                                @endif
                                            </a>
                                        </div>
                                    </p>
                                </div>




                                  
                              </div>
                          </div>
                      </section>
                  </aside>
              </div>
@endsection