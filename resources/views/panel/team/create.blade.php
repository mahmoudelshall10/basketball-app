@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                               <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('team.index')}}">Teams</a></li>
                              <li class="breadcrumb-item"><a href="{{route('team.index')}}">All Teams</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Teams</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('team.store')}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Team Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('team_name')) is-valid @endif"  name="team_name" value="{{old('team_name')}}" >
                                          
                                          <span class="help-block">@if ($errors->has('team_name'))
                                                  {{ $errors->first('team_name') }}
                                              @endif</span>
                                      </div>
                                  </div>
         
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">City Name</label>  
                                        <div class="col-sm-10">
                                            <select class="required  form-control @if ($errors->has('city_id')) is-valid @endif" name="city_id" id="city_id" >
                                                <option>Choose City</option>
                                                @foreach ($arrCities as $city)
                                                <option value="{{$city->city_id}}"
                                                    @if ($city->city_id)
                                                        @if (old('city_id') == $city->city_id ) {{"selected"}} @endif 
                                                    @endif 
                                                    >{{$city->city_name_en}}</option>
                                            @endforeach
                                            </select>
                                            <span class="help-block">@if ($errors->has('city_id'))
                                                    {{ $errors->first('city_id') }}
                                                @endif</span>   
                                        </div>
                                    </div>
       
                                 
                                  <div class="form-group">
                                          <label class="col-lg-2 control-label"  for="team_logo">Team Logo </label>
                                          <div class="col-lg-10">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                      </div>
                                                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                      <div>
                                                       <span class="btn btn-white btn-file">
                                                       <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                       <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                       <input type="file" name="team_logo" class="default" value="{{old('team_logo')}}" />
                                                       </span>
                                                          
                                                          
                                                      </div>
                                                       <div class="form-text text-muted">
                                                             @if ($errors->has('team_logo'))
                                                                {{ $errors->first('team_logo') }}
                                                            @endif
                                                           </div>
                                                  </div>
                                          </div>
                                      </div>

                                      
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('team.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
@endsection