@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('exam.index')}}">Exams</a></li>
                              <li class="breadcrumb-item"><a href="{{route('exam.index')}}">All Exams</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Exam</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('exam.store')}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Exam Title</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('exam_title')) is-valid @endif"  name="exam_title" value="{{old('exam_title')}}" >
                                          <span class="help-block">@if ($errors->has('exam_title'))
                                                  {{ $errors->first('exam_title') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-sm-2">Exam Slug</label>
                                      <div class="col-sm-10">
                                            <input type="text" class="required form-control @if ($errors->has('exam_slug')) is-valid @endif"  name="exam_slug" value="{{old('exam_slug')}}" >
                                           <span class="help-block">@if ($errors->has('exam_slug'))
                                                  {{ $errors->first('exam_slug') }}
                                              @endif</span>
                                      </div>
                                      
                                    </div>
                                 
                                   <div class="form-group">
                                      <label class="col-sm-2 control-label col-sm-2">Exam Description</label>
                                      <div class="col-sm-10">
                                          <textarea class="form-control ckeditor  @if ($errors->has('exam_description')) is-valid @endif" name="exam_description" rows="6">{{old('exam_description')}}</textarea>
                                           <span class="help-block">@if ($errors->has('exam_description'))
                                                  {{ $errors->first('exam_description') }}
                                              @endif</span>
                                      </div>
                                      
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Exam Time</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required number form-control @if ($errors->has('exam_time_min')) is-valid @endif"  name="exam_time_min" value="{{old('exam_time_min')}}" >
                                          <span class="help-block">@if ($errors->has('exam_time_min'))
                                                  {{ $errors->first('exam_time_min') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                      
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('exam.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
@endsection