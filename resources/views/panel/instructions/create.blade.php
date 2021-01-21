@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('instructions.index')}}">Instruction</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Instruction</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('instructions.store')}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')

                                 <div class="form-group">
                                     <label class="col-sm-2 control-label">Instruction</label>
                                     <div class="col-sm-10">
                                        <div class="col-sm-10">
                                            <textarea class="form-control ckeditor @if ($errors->has('instruction')) is-valid @endif" name="instruction" rows="6">{{old('instruction')}}</textarea>
                                        </div>
                                         <span class="help-block">@if ($errors->has('instruction'))
                                            {{ $errors->first('instruction') }}
                                        @endif</span>
                                     </div>
                                 </div>
         
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('instructions.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
@endsection