@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('exam.index')}}">Exams</a></li>
                             <li class="breadcrumb-item active" aria-current="page">All Exams</li>
                            
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
                  Exams
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('exam.create')}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Add New Exam
                              </a>
	             </span>
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th> Exam Title</th>
                  <th> Exam Slug</th>
                  <th> Exam Time</th>
                  <th> Exam Description</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($exams as $exam)
              <tr>

                <td>{{$exam->exam_title}}</td>
                <td>{{$exam->exam_slug}}</td>
                <td>{{$exam->exam_time_min}}</td>
                <td>{!! Str::limit($exam->exam_description,100) !!}</td>
                 <td>
                      <a class="btn btn-primary btn-xs" title="Edit" href="{{route('exam.edit',$exam->exam_id)}}"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-outline-primary btn-xs" title="Question" href="{{route('examQuestion.index',$exam->exam_id)}}"><i class="fa fa-question"></i></a>
                      <a class="btn btn-outline-secondary btn-xs" title="Referee" href="{{route('examReferee.index',$exam->exam_id)}}"><i class="fa fa-bullhorn"></i></a>
                      <a title="Delete" data-toggle="modal" href="#deModal{{$exam->exam_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                </td>   
                <div class="modal fade" id="deModal{{$exam->exam_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('news.destroy',$exam->exam_id)}}">
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