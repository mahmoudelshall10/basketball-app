@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('news.index')}}">News</a></li>
                              <li class="breadcrumb-item"><a href="{{route('news.index')}}">All News</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Edit News</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('news.update',$news->new_id)}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('Put')
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">News Title</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('new_title')) is-valid @endif"  name="new_title" value="{{$news->new_title}}" >
                                          <span class="help-block">@if ($errors->has('new_title'))
                                                  {{ $errors->first('new_title') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-sm-2">News Description</label>
                                      <div class="col-sm-10">
                                          <textarea class="  form-control   @if ($errors->has('new_description')) is-valid @endif" name="new_description" rows="2">{{$news->new_description}}</textarea>
                                           <span class="help-block">@if ($errors->has('new_description'))
                                                  {{ $errors->first('new_description') }}
                                              @endif</span>
                                      </div>
                                      
                                    </div>
                                 
                                  <div class="form-group">
                                          <label class="col-lg-2 control-label"  for="new_image">News Image </label>
                                          <div class="col-lg-10">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                           @if($news->new_image === null)
                                                              <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                          @else
                                                              <img src="{{asset($news->new_image)}}" alt="" />
                                                          @endif
                                                      </div>
                                                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                      <div>
                                                       <span class="btn btn-white btn-file">
                                                       <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                       <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                       <input type="file" name="new_image" class="default" value="{{old('new_image')}}" />
                                                       </span>
                                                          
                                                          
                                                      </div>
                                                       <div class="form-text text-muted">
                                                             @if ($errors->has('new_image'))
                                                                {{ $errors->first('new_image') }}
                                                            @endif
                                                           </div>
                                                  </div>
                                          </div>
                                      </div>
                                      
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('news.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
@endsection