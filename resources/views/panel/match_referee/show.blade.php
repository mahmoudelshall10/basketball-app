@extends('layouts.app')
@section('content')
              <div class="row">
                <aside class="profile-nav col-lg-3">
                    <section class="card">
                        <div class="user-heading round">
                            <a href="#">
                                @if($matchreferee->referee->referee_image === null)
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                @else
                                    <img src="{{url($matchreferee->referee->referee_image)}}" alt="" />
                                @endif
                            </a>
                            <h1>{{$matchreferee->referee->referee_fullname}}</h1>
                            <p>{{"@".$matchreferee->referee->referee_username}}</p>
                        </div>

                       

                    </section>
                </aside>
                  <aside class="profile-info col-lg-9">
                      
                      <section class="card">
                          
                          <div class="card-body bio-graph-info">
                              <h1>Game Details</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>Referee Name</span>: {{$matchreferee->referee->referee_fullname}}</p>
                                  </div>

                                <div class="bio-row">
                                    <p><span>Game Details</span>: <a href="{{url("league/".$matchreferee->leage_match->league->league_id."/matches")}}"> {{$matchreferee->leage_match->home->team_name}} - {{$matchreferee->leage_match->away->team_name}}</a></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Referee</span>: {{$matchreferee->referee_role->role_en}}</p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Game Accept</span>:
                                        @if ($matchreferee->match_acceptance == 'pending')
                                        Pending
                                    @endif
                    
                                    @if ($matchreferee->match_acceptance == 'decline')
                                        Decline
                                        <br>
                                        {{$matchreferee->match_decline_reason}}
                                    @endif
                    
                                    @if ($matchreferee->match_acceptance == 'accept')
                                        Accept
                                    @endif
                                    </p>
                                </div>

                                <div class="bio-row">
                                    <p><span>Game Confirm</span>:                 
                                    @if ($matchreferee->match_Confirmation)
                                        Yes
                                    @else
                                        No
                                    @endif
                                    </p>
                                </div>



                                  
                              </div>
                          </div>
                      </section>
                  </aside>
              </div>
@endsection