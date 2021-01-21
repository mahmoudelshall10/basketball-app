@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('news.index')}}">News</a></li>
                              <li class="breadcrumb-item active" aria-current="page">All News</li>
                            
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
                  News
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('news.create')}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Add New News
                              </a>
	             </span>
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th> News Title</th>
                  <th> News Description</th>
                  <!-- <th> League</th> -->
                  <th>News Image</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($news as $report)
              <tr>

                <td>{{$report->new_title}}</td>
                <td>{{$report->new_description}}</td>
                <td>
                <a class="fancybox"  href="{{asset($report->new_image)}}"> <img class="thumb" src="{{asset($report->new_image)}}" alt="" /></a>
                                                         
                                                      </td>
                 <td>
                      <a class="btn btn-primary btn-xs" title="Edit" href="{{route('news.edit',$report->new_id)}}"><i class="fa fa-pencil"></i></a>
                     <a title="Delete" data-toggle="modal" href="#deModal{{$report->new_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                </td>   
                <div class="modal fade" id="deModal{{$report->new_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('news.destroy',$report->new_id)}}">
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