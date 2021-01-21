@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                               <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('league.index')}}">Leagues</a></li>
                              @if ($league->league_type == 'mini_basket')
                                <li class="breadcrumb-item"><a href="{{route('miniBasketIndex')}}">All Mini Basket Leagues</a></li>  
                              @elseif($league->league_type == 'association')
                                <li class="breadcrumb-item"><a href="{{route('associationIndex')}}">All Association Leagues</a></li>       
                              @elseif($league->league_type == 'cairo_area')
                                <li class="breadcrumb-item"><a href="{{route('miniBasketIndex')}}">All Cairo Area Leagues</a></li>       
                              @endif
                              
                              <li class="breadcrumb-item active" aria-current="page">{{$league->league_name}} Matches</li>
                            
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                 @if(Session::has('success'))
                  <div class="alert alert-success" role="alert">
                    {{Session('success')}}
                  </div>
                  @endif
              <section class="card">
              <header class="card-header">
                  Teams
                  <a class="btn btn-warning" href="{{route('sendNotificationsForAll')}}" style="margin-right:1%;color: white "><i class="fa fa-check">Send All</i></a>
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('leaguesMatches.create',$league->league_id)}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Create New Match
                              </a>
	             </span>
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Team A</th>
                  <th>Team B</th>
                  <th>Place</th>
                  <th>Referees</th>
                  <th>Date</th>
                  @if($league->league_type == 'mini_basket')
                    <th>Number Of Periods</th>
                  @endif
                  <th>Send Match</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($matches as $team)
              <tr>

                <td>{{$team->home->team_name}}</td>
                <td>{{$team->away->team_name}}</td>
                <td>{{$team->hall->hall_name}}</td>
                <td style="text-transform: capitalize;">
                    @foreach($team->referee as $referee)
                        {{$referee->referee->referee_fullname}}
                    <br>
                    @endforeach</td>
                <td>{{$team->match_date}}</td>
                @if($league->league_type == 'mini_basket')
                    @if ($team->is_sent == 0)
                    <td>
                        <a title="periods" data-toggle="modal" href="#Modal{{$team->leage_matches_id}}" class="btn btn-info btn-xs" ><i class="fa fa-magnet"></i>
                            {{$team->num_of_periods}}
                        </a>
                    </td>
                    @else
                    <td>
                        {{$team->num_of_periods}}
                    </td>
                    @endif
                @endif

                @if ($team->is_sent == 0)
                <td>
                    <a class="btn btn-outline-warning btn-xs" title="Send Notification" href="{{route('sendNotification',$team->leage_matches_id)}}"><i class="fa fa-check"></i></a>
                </td>
                @else
                <td>
                    Sent
                </td>
                @endif

                 <td>
                      <a title="Delete" data-toggle="modal" href="#deModal{{$team->leage_matches_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                </td>   
                <div class="modal fade" id="deModal{{$team->leage_matches_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Delete Confirmation</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this record.
                           <!-- <input type="hidden" id="catidh" value=""/>-->
                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                              <form method="POST"  action="{{route('leaguesMatches.destroy',['league_id'=>$league->league_id,'leage_matches_id'=>$team->leage_matches_id])}}">
                                @csrf
                                @method('Delete')
                                <button type="submit" class="btn btn-danger">Confirm</button>
                              </form>
                          </div>
                      </div>
                  </div>
                </div>  
                @include('panel.league.match.num_of_periods')                 
              @endforeach
              </tfoot>
              </table>
              </div>
              </div>
              </section>
              </div></div>
             
@endsection