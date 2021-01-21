@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('referee.index')}}">Referees</a></li>
                              <li class="breadcrumb-item active" aria-current="page">All Referees</li>
                            
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
                  Referees
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('referee.create')}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Add New referee
                              </a>
	             </span>
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Full Name</th>
                  <th>Arabic Full Name</th>
                  <th> Username</th>
                  <th>Mobile</th>
                  <th>Type</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($referees as $referee)
              <tr>

                <td>{{$referee->referee_fullname}}</td>
                <td>{{$referee->referee_fullname_ar}}</td>
                <td>{{$referee->referee_username}}</td>
                <td>{{$referee->referee_mobile}}</td>
                <td>{{$referee->referee_type}}</td>
                 <td>
                      <a class="btn btn-primary btn-xs" title="Edit" href="{{route('referee.edit',$referee->referee_id)}}"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-success btn-xs" title="Show" href="{{route('referee.show',$referee->referee_id)}}"><i class="fa fa-eye"></i></a>
                     <a title="Delete" data-toggle="modal" href="#deModal{{$referee->referee_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                </td>   
                <div class="modal fade" id="deModal{{$referee->referee_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <form method="POST"  action="{{route('referee.destroy',$referee->referee_id)}}">
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