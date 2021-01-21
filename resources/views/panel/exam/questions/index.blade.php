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
                              <li class="breadcrumb-item active" aria-current="page" style="text-transform: capitalize;">{{$exam->exam_title}} Questions</li>
                            
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
                  
                  @if ($errors->has('single_choice'))
                   <div class="alert alert-danger" role="alert">
                    {{ $errors->first('single_choice') }}
                  </div>
                   @elseif($errors->has('multiple_choice'))
                       <div class="alert alert-danger" role="alert">
                        {{ $errors->first('multiple_choice') }}
                      </div>                         
                   @elseif($errors->has('text_question')) 
                     <div class="alert alert-danger" role="alert">
                      {{ $errors->first('text_question') }}
                    </div>                            
                  @endif
              <section class="card">
              <header class="card-header" style="text-transform: capitalize;">
                 {{$exam->exam_title}} Questions
	              <span class="tools pull-right">
	               <a class="btn btn-primary"   data-toggle="modal" href="#exam_{{$exam->exam_id}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-repeat"></i> &nbsp;Generate Exam's Questions
                              </a>
	             </span>
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Question Content</th>
                  <th>Question Score</th>
                  <th>Question Type</th>
                  <th>Exam</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($questions as $question)
              <tr>

                <td>{{$question->question->question_content}}</td>
                <td>{{$question->question->question_score}}</td>
                <td>
                  @if($question->question->question_type === 0)
                    Single Choice Questions
                  @elseif($question->question->question_type === 1)
                    Multiple Choice Questions
                  @elseif($question->question->question_type === 2)
                    Text Question
                   @elseif($question->question->question_type === 3)
                    Video Question
                  @elseif($question->question->question_type == 4)
                    Image Question
                  @endif
                 
                </td>
                <td>{{$question->exam->exam_title}}</td>
                
                 <td>
                    
                      <a title="Delete" data-toggle="modal" href="#deModal{{$question->exam_question_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                </td>   
                <div class="modal fade" id="deModal{{$question->exam_question_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('examQuestion.destroy',['exam_id'=>$exam->exam_id,'exam_question_id'=>$question->exam_question_id])}}">
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
                              <h4 class="modal-title">Generate Exam's Questions</h4>
                          </div>
                          <div class="modal-body">
                              <form method="POST"  action="{{route('examQuestion.store',$exam->exam_id)}}" id="commentForm">
                                @csrf
                                @method('POST')
                                 <!-- <select class="required  form-control @if ($errors->has('question_id')) is-valid @endif" name="question_id" >
                                             <option  value="" disabled="disabled" selected="">Select Question</option>
                                                        @foreach($all as $question)

                                                        <option value="{{$question->question_id}}" @if( old('question_id')== $question->question_id){{"selected"}}@endif >{{$question->question_content}}</option>
                                                        @endforeach
                                                       
                                          </select> -->
                                           <div class="form-group">
                                              <label class="col-sm-12 control-label">Number Of Single Choice Questions<br> <small>Notice : Count Of Single Choice Questions In Question Bank is <b>{{$singleChoiceCount}}</b> Questions</small></label>
                                              <div class="col-sm-12">
                                                  <input type="text" class="required number form-control @if ($errors->has('single_choice')) is-valid @endif"  name="single_choice" value="{{old('single_choice')}}" >
                                                  <span class="help-block">@if ($errors->has('single_choice'))
                                                          {{ $errors->first('single_choice') }}
                                                      @endif</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-12 control-label">Number Of Multiple Choice Questions<br> <small>Notice : Count Of Multiple Choice Questions In Question Bank is <b>{{$multipleChoiceCount}}</b> Questions</small></label>
                                              <div class="col-sm-12">
                                                  <input type="text" class="required number form-control @if ($errors->has('multiple_choice')) is-valid @endif"  name="multiple_choice" value="{{old('multiple_choice')}}" >
                                                  <span class="help-block">@if ($errors->has('multiple_choice'))
                                                          {{ $errors->first('multiple_choice') }}
                                                      @endif</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-12 control-label">Number Of Text Questions<br> <small>Notice : Count Of Text Questions In Question Bank is <b>{{$textCount}}</b> Questions</small></label>
                                              <div class="col-sm-12">
                                                  <input type="text" class="required number form-control @if ($errors->has('text_question')) is-valid @endif"  name="text_question" value="{{old('text_question')}}" >
                                                  <span class="help-block">@if ($errors->has('text_question'))
                                                          {{ $errors->first('text_question') }}
                                                      @endif</span>
                                              </div>
                                          </div>
                                           <div class="form-group">
                                              <label class="col-sm-12 control-label">Number Of Image Questions<br> <small>Notice : Count Of Image Questions In Question Bank is <b>{{$imageCount}}</b> Questions</small></label>
                                              <div class="col-sm-12">
                                                  <input type="text" class="required number form-control @if ($errors->has('image_question')) is-valid @endif"  name="image_question" value="{{old('image_question')}}" >
                                                  <span class="help-block">@if ($errors->has('image_question'))
                                                          {{ $errors->first('image_question') }}
                                                      @endif</span>
                                              </div>
                                          </div>
                                           <div class="form-group">
                                              <label class="col-sm-12 control-label">Number Of Video Questions<br> <small>Notice : Count Of Video Questions In Question Bank is <b>{{$videoCount}}</b> Questions</small></label>
                                              <div class="col-sm-12">
                                                  <input type="text" class="required number form-control @if ($errors->has('video_question')) is-valid @endif"  name="video_question" value="{{old('video_question')}}" >
                                                  <span class="help-block">@if ($errors->has('video_question'))
                                                          {{ $errors->first('video_question') }}
                                                      @endif</span>
                                              </div>
                                          </div>
                              </form>
                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                                <button type="submit" class="btn btn-default" onclick="document.getElementById('commentForm').submit();">Confirm</button>
                          </div>
                      </div>
                  </div>
              </div>  
              </div>
              </div>
              </section>
              </div></div>
             
@endsection