@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="#"></a></li>
                              <li class="breadcrumb-item"><a href="#">All Options</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Single Choice Option</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('question_option.store')}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')
                                 <div class="form-group">
                                      <label class="col-sm-2 control-label">Question Type </label>
                                      <div class="col-sm-10">
                                          <select class="required  form-control @if ($errors->has('question_id')) is-valid @endif" name="question_id" >
                                             <option  value="" disabled="disabled" selected="">Select Type</option>
                                                        @foreach($questions as $question)

                                                        <option value="{{$question->question_id}}" @if( old('question_id')=== $question->question_id){{"selected"}}@endif >{{$question->question_content}}</option>
                                                        @endforeach
                                                       
                                          </select>
                                          <span class="help-block">@if ($errors->has('question_id'))
                                                  {{ $errors->first('question_id') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  @for($i = 0 ; $i<3 ; $i++)
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Option Text</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('option_text')) is-valid @endif"  name="option_text[{{$i}}]" value="{{old('option_text_'.$i)}}" >
                                          <span class="help-block">@if ($errors->has('option_text'))
                                                  {{ $errors->first('option_text') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                     <div class="col-lg-12">
                                          
                                          <div class="custom-control custom-radio mb-3">
                                              <input type="radio" id="customRadio{{$i}}" name="option_correct[]" class="custom-control-input required" value="1">
                                              <label class="custom-control-label" for="customRadio{{$i}}">Correct</label>
                                          </div>
                                         

                                      </div>
                                  </div>
                                  @endfor
          <!--                        <div class="form-group">
                                      <label class="col-sm-2 control-label">Option Text</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('option_text')) is-valid @endif"  name="option_text[]" value="{{old('option_text')}}" >
                                          <span class="help-block">@if ($errors->has('option_text'))
                                                  {{ $errors->first('option_text') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                     <div class="col-lg-12">
                                          
                                          <div class="custom-control custom-radio mb-3">
                                              <input type="radio" id="customRadio2" name="option_correct" class="custom-control-input required">
                                              <label class="custom-control-label" for="customRadio2">Correct</label>
                                          </div>
                                         

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Option Text</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('option_text')) is-valid @endif"  name="option_text[]" value="{{old('option_text')}}" >
                                          <span class="help-block">@if ($errors->has('option_text'))
                                                  {{ $errors->first('option_text') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                     <div class="col-lg-12">
                                          
                                          <div class="custom-control custom-radio mb-3">
                                              <input type="radio" id="customRadio3" name="option_correct" class="custom-control-input required">
                                              <label class="custom-control-label" for="customRadio3">Correct</label>
                                          </div>
                                         

                                      </div>
                                  </div> -->
                                  
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