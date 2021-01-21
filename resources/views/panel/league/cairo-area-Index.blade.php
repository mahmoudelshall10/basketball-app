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
                              <li class="breadcrumb-item active" aria-current="page">Cairo Area Leagues</li>
                            
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
                  
                  <th>League Name</th>
                  <th>League Start Date</th>
                  <th>League End Date</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($cairoArea as $league)
              <tr>

                <td>{{$league->league_name}}</td>
                <td>{{$league->league_start_date}}</td>
                <td>{{$league->league_end_date}}</td>
              
                 <td>
                      <a class="btn btn-primary btn-xs" title="Edit" href="{{route('league.edit',$league->league_id)}}"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-outline-info btn-xs" title="Teams" href="{{route('leaguesTeams.index',$league->league_id)}}"><i class="fa fa-shield"></i></a>
                      <a class="btn btn-outline-secondary btn-xs" title="Matches" href="{{route('leaguesMatches.index',$league->league_id)}}"><i class="fa fa-flag-checkered"></i></a>
                     <a title="Delete" data-toggle="modal" href="#deModal{{$league->league_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                </td>   
                <div class="modal fade" id="deModal{{$league->league_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('league.destroy',$league->league_id)}}">
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