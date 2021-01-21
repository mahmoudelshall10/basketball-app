@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                               <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('question.index')}}">Questions Bank</a></li>
                              <li class="breadcrumb-item"><a href="{{route('question_option.index')}}">Question Options</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Question Option</li>
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
                                      <label class="col-sm-2 control-label">Question  </label>
                                      <div class="col-sm-10">
                                          <select class="required  form-control @if ($errors->has('question_id')) is-valid @endif" name="question_id" >
                                             <option  value="" disabled="disabled" selected="">Select Question</option>
                                                        @foreach($questions as $question)

                                                        <option value="{{$question->question_id}}" @if( old('question_id')== $question->question_id){{"selected"}}@endif >{{$question->question_content}}</option>
                                                        @endforeach
                                                       
                                          </select>
                                          <span class="help-block">@if ($errors->has('question_id'))
                                                  {{ $errors->first('question_id') }}
                                              @endif</span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Option Text</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('option_text')) is-valid @endif"  name="option_text" value="{{old('option_text')}}" >
                                          <span class="help-block">@if ($errors->has('option_text'))
                                                  {{ $errors->first('option_text') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                    <div class="form-group">
                                     <div class="col-lg-12">
                                          
                                              <!-- <input type="radio" id="customRadio" name="option_correct" class="custom-control-input required" value="1"> -->
                                          <!--  <div class="custom-control custom-checkbox mb-3">
                                              <input type="checkbox" class="custom-control-input" name="option_correct" id="customCheck1" value="1" @if(old('option_correct') === 1) {{"Checked"}} @endif>
                                              <label class="custom-control-label" for="customCheck1">Correct</label>
                                          </div> -->
                                            <div class="custom-control custom-radio mb-3">
                                              <input type="radio" id="customRadio" name="option_correct" class="custom-control-input required @if ($errors->has('option_correct')) is-valid @endif" value="1" @if(old('option_correct') === 1) {{"checked"}} @endif>
                                              <label class="custom-control-label" for="customRadio">Correct</label>
                                          </div>
                                          <div class="custom-control custom-radio mb-3">
                                             <input type="radio" id="customRadio1" name="option_correct" class="custom-control-input required @if ($errors->has('option_correct')) is-valid @endif" value="0">
                                               <label class="custom-control-label" for="customRadio1" @if(old('option_correct') === 0) {{"checked"}} @endif>Incorrect</label>
                                          </div>
                                        

                                      </div>
                                      <span class="help-block">@if ($errors->has('option_correct'))
                                                  {{ $errors->first('option_correct') }}
                                              @endif</span>
                                  </div>
                                  
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('question_option.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
@endsection