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
                              <li class="breadcrumb-item active" aria-current="page">{{$league->league_name}} Teams</li>
                            
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
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('leaguesTeams.create',$league->league_id)}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Assign New team
                              </a>
	             </span>
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th> Team Name</th>
                  <!-- <th> League</th> -->
                  <th>Team Logo</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($teams as $team)
              <tr>

                <td>{{$team->team->team_name}}</td>
              {{--  <td>{{$team->league->league_name}}</td> --}}

                <td>
                <a class="fancybox" href="{{asset($team->team->team_logo)}}"> <img class="thumb" src="{{asset($team->team->team_logo)}}" alt="" /></a>
                                                         
                                                      </td>
                 <td>
                     {{-- <a class="btn btn-primary btn-xs" title="Edit" href="{{route('team.edit',$team->team_id)}}"><i class="fa fa-pencil"></i></a> --}}
                     {{-- <a class="btn btn-success btn-xs" title="Show" href="{{route('team.show',$team->team_id)}}"><i class="fa fa-eye"></i></a> --}}
                      <a title="Delete" data-toggle="modal" href="#deModal{{$team->leagues_teams_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                </td>   
                <div class="modal fade" id="deModal{{$team->leagues_teams_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('leaguesTeams.destroy',['league_id'=>$league->league_id,'leagues_teams_id'=>$team->leagues_teams_id])}}">
                                @csrf
                                @method('Delete')
                                <button type="submit" class="btn btn-danger">Confirm</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>                   
              @endforeach
              </tfoot>
              </table>
              </div>
              </div>
              </section>
              </div></div>
             
@endsection