@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('question.index')}}">Questions Bank</a></li>
                              <li class="breadcrumb-item"><a href="{{route('question.index')}}">All Questions</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Question</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('question.store')}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')
                                   <div class="form-group">
                                      <label class="col-sm-2 control-label">Question Type </label>
                                      <div class="col-sm-10">
                                          <select class="required  form-control @if ($errors->has('question_type')) is-valid @endif" name="question_type" id="question_type" >
                                             <option  value="" disabled="disabled" selected="">Select Type</option>
                                                        

                                                        <option value="0" {{--@if( old('question_type')=== 0){{"selected"}}@endif --}}>Single Choice Questions</option>
                                                        <option value="1" {{--@if( old('question_type')=== 1){{"selected"}}@endif --}}>Multiple Choice Questions</option>
                                                        <option value="2" {{--@if( old('question_type')=== 2){{"selected"}}@endif --}}>Text Question</option>
                                                        <option value="3" {{--@if( old('question_type')=== 3){{"selected"}}@endif --}}>Video Question</option>
                                                        <option value="4" {{--@if( old('question_type')=== 4){{"selected"}}@endif --}}>Image Question</option>
                                                       
                                          </select>
                                          <span class="help-block">@if ($errors->has('question_type'))
                                                  {{ $errors->first('question_type') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Question Content</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('question_content')) is-valid @endif"  name="question_content" value="{{old('question_content')}}" >
                                          <span class="help-block">@if ($errors->has('question_content'))
                                                  {{ $errors->first('question_content') }}
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
                                  <div class="form-group" id="1" >
                                   
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
              <script type="text/javascript">
@if( isset($html) )
 $("#1").append({{$html}})
@endif
</script>
@endsection