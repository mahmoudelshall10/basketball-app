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
                              <li class="breadcrumb-item"><a href="{{route('exam.index')}}">All Exams</a></li>
                              <li class="breadcrumb-item active" aria-current="page" style="text-transform: capitalize;">{{$exam->exam_title}} Referees</li>
                              
                            
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
                  
                  @if ($errors->has('referee_id'))
                   <div class="alert alert-danger" role="alert">
                    {{ $errors->first('referee_id') }}
                  </div>
                                                  
                  @endif
              <section class="card">
              <header class="card-header" style="text-transform: capitalize;">
                  {{$exam->exam_title}} Referees
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  data-toggle="modal" href="#exam_{{$exam->exam_id}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Assign New Referee
                              </a>
	             </span>
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Referee Name</th>
                  <th>Exam</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($referees as $referee)
              <tr>

                <td>{{$referee->referee->referee_fullname}}</td>
               
                <td>{{$referee->exam->exam_title}}</td>
                
                 <td>
                    
                      <a title="Delete" data-toggle="modal" href="#deModal{{$referee->exam_referee_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                </td>   
                <div class="modal fade" id="deModal{{$referee->exam_referee_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('examReferee.destroy',['exam_id'=>$exam->exam_id,'exam_referee_id'=>$referee->exam_referee_id])}}">
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
               <div class="modal fade" id="exam_{{$exam->exam_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Assign New Referee</h4>
                          </div>
                          <div class="modal-body">
                              <form method="POST"  action="{{route('examReferee.store',$exam->exam_id)}}" id="{{$exam->exam_id}}_question_form">
                                @csrf
                                @method('POST')
                                <!--  <select class="required  form-control @if ($errors->has('referee_id')) is-valid @endif" name="referee_id" >
                                             <option  value="" disabled="disabled" selected="">Select Referee</option>
                                              @foreach($all as $referee)
                                              <option value="{{$referee->referee_id}}" @if( old('referee_id')=== $referee->referee_id){{"selected"}}@endif >{{$referee->referee_fullname}}</option>
                                              @endforeach
                                          </select> -->
                                  <div class="form-group">
                                      <label class="col-sm-12 control-label">Select Referees </label>
                                      <div class="col-sm-12">
                                      <select class="required js-example-basic-multiple  @if ($errors->has('referee_id')) is-valid @endif" multiple="multiple" name="referee_id[]" >
                                          @foreach($all as $referee)
                                              <option value="{{$referee->referee_id}}"
                                              @if(old('referee_id') == $referee->referee_id)
                                                 {{"selected"}}
                                              @endif >{{$referee->referee_fullname}}</option>
                                          @endforeach
                                      </select>
                                      <span class="help-block">@if ($errors->has('referee_id'))
                                              {{ $errors->first('referee_id') }}
                                          @endif</span>
                                      </div>
                                  </div>
                              </form>
                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                                <button type="submit" class="btn btn-default" onclick="document.getElementById('{{$exam->exam_id}}_question_form').submit();">Confirm</button>
                          </div>
                      </div>
                  </div>
              </div>  
              </div>
              </div>
              </section>
              </div></div>
             
@endsection