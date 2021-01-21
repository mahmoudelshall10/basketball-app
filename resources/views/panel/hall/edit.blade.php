@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('hall.index')}}">Halls</a></li>
                              <li class="breadcrumb-item"><a href="{{route('hall.index')}}">All Halls</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Edit Hall</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('hall.update',$hall->hall_id)}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('PUT')

                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">Hall Place</label>
                                    <div class="col-sm-10">
                                        <select class="required form-control @if ($errors->has('hall_place')) is-valid @endif"  name="hall_place">
                                           <option value="">Choose City</option>
                                           @foreach ($cities as $city)
                                               <option value="{{$city->city_id}}"
                                                        {{$city->city_id == $hall->hall_place ? 'selected':''}}
                                                   >{{$city->city_name_en}}</option>
                                           @endforeach
                                        </select>
                                        <span class="help-block">@if ($errors->has('hall_place'))
                                           {{ $errors->first('hall_place') }}
                                       @endif</span>
                                    </div>
                                </div>

                                   <div class="form-group">
                                      <label class="col-sm-2 control-label">Hall Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('hall_name')) is-valid @endif"  name="hall_name" value="{{$hall->hall_name}}" >
                                          <span class="help-block">@if ($errors->has('hall_name'))
                                                  {{ $errors->first('hall_name') }}
                                              @endif</span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('hall.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                            
                         </div>
                      </section>
                </div>
              </div>
@endsection