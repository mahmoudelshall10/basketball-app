@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="#">Exams</a></li>
                              <li class="breadcrumb-item"><a href="#">All Referees</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Assign To Referee</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('question.store')}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Referee  </label>
                                      <div class="col-sm-10">
                                          <select class="required  form-control @if ($errors->has('referee_id')) is-valid @endif" name="referee_id" >
                                             <option  value="" disabled="disabled" selected="">Select Referee</option>
                                                        @foreach($all as $referee)

                                                        <option value="{{$referee->referee_id}}" @if( old('referee_id')== $referee->referee_id){{"selected"}}@endif >{{$referee->referee_fullname}}</option>
                                                        @endforeach
                                                       
                                          </select>
                                          <span class="help-block">@if ($errors->has('referee_id'))
                                                  {{ $errors->first('referee_id') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Question Score</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required number form-control @if ($errors->has('question_score')) is-valid @endif"  name="question_score" value="{{old('question_score')}}" >
                                          <span class="help-block">@if ($errors->has('question_score'))
                                                  {{ $errors->first('question_score') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                 
                                  
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label"  for="question_file">Question File  </label>
                                          <div class="col-lg-10">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+file" alt="" />
                                                      </div>
                                                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                      <div>
                                                       <span class="btn btn-white btn-file">
                                                       <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select File</span>
                                                       <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                       <input type="file" name="question_file" class="default" value="{{old('question_file')}}" />
                                                       </span>
                                                          
                                                          
                                                      </div>
                                                       <div class="form-text text-muted">
                                                             @if ($errors->has('question_file'))
                                                                {{ $errors->first('question_file') }}
                                                            @endif
                                                           </div>
                                                  </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                      <label class="col-sm-2 control-label">Question Type </label>
                                      <div class="col-sm-10">
                                          <select class="required  form-control @if ($errors->has('question_type')) is-valid @endif" name="question_type" >
                                             <option  value="" disabled="disabled" selected="">Select Type</option>
                                                        

                                                        <option value="0" @if( old('question_type')=== 0){{"selected"}}@endif >Single Choice Questions</option>
                                                        <option value="1" @if( old('question_type')=== 1){{"selected"}}@endif >Multiple Choice Questions</option>
                                                        <option value="2" @if( old('question_type')=== 2){{"selected"}}@endif >Text Question</option>
                                                       
                                          </select>
                                          <span class="help-block">@if ($errors->has('question_type'))
                                                  {{ $errors->first('question_type') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('question.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
@endsection