@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('matchesreferees.index')}}">Game</a></li>
                              <li class="breadcrumb-item active" aria-current="page">All Games</li>
                            
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

              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Referees Name</th>
                  <th>Game</th>
                  <th>Referee</th>
                  <th>Game Acceptance</th>
                  <th>Game Confirmation</th>
                  <th>Score Sheet</th>
                  <th>Game Verfication</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($matchreferees as $matches)
              <tr>

                <td>{{$matches->referee->referee_fullname}}</td>
                <td>
                <a href="{{url("league/".$matches->leage_match->league->league_id."/matches/".$matches->leage_matches_id)}}">
                    {{$matches->leage_match->home->team_name}} - {{$matches->leage_match->away->team_name}}</td>
                </a>
                <td>{{$matches->referee_role->role_en}}</td>
                
                @if ($matches->match_acceptance == 'pending')
                    <td>Pending</td>
                @endif

                @if ($matches->match_acceptance == 'decline')
                    <td>Decline</td>
                @endif

                @if ($matches->match_acceptance == 'accept')
                    <td>Accept</td>
                @endif

                @if ($matches->match_confirmation)
                    @if ($matches->match_acceptance == 'accept')
                        <td>Yes</td>
                    @endif
                @else
                    <td>No</td>
                @endif

                @if ($matches->leage_match->score_sheet_image)
                <td>
                    <a class="fancybox"  href="{{url($matches->leage_match->score_sheet_image)}}"> <img class="thumb" src="{{url($matches->leage_match->score_sheet_image)}}" alt="" /></a>
                </td>
                @else
                <td>
                    <a class="fancybox"  href="https://via.placeholder.com/50"> <img class="thumb" src="https://via.placeholder.com/50" alt="" /></a>
                </td>
                @endif

                @if ($matches->match_verification)
                <td>Verfied</td>
                @else
                <td>
                    <a class="btn btn-success" href="{{route('verifyMatch',$matches->matches_referee_id)}}">Verify</a>
                </td>
                @endif

            
                 <td>
                      <a class="btn btn-primary btn-xs" title="Edit" href="{{route('matchesreferees.edit',$matches->matches_referee_id)}}"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-outline-info btn-xs" title="Matches" href="{{route('matchesreferees.show',$matches->matches_referee_id)}}"><i class="fa fa-flag-checkered"></i></a>
                 </td>                    
              @endforeach
              </tfoot>
              </table>
              </div>
              </div>
              </section>
              </div></div>
             
@endsection