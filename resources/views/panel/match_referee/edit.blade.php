@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('matchesreferees.index')}}">Leagues</a></li>
                              <li class="breadcrumb-item"><a href="{{route('matchesreferees.index')}}">All Leagues</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Edit League</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('matchesreferees.update',$matchesreferees->matches_referee_id)}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('PUT')
                                     <div class="form-group">
                                      <label class="col-sm-2 control-label">League Name</label>
                                      <div class="col-sm-10">
                                        {{ucwords($matchesreferees->referee->referee_fullname) }} 
                                        <br>
                                        <br>
                                          <select class="required form-control" name="referee_id">
                                              <option value="">Select Referee</option>
                                            @foreach($referees as $referee)
                                            <option value="{{$referee->referee_id}}"              
                                                @if(old('referee_id') == $referee->referee_id)

                                                    {{"selected"}}
                                                @endif >{{$referee->referee_fullname}} - Type: {{$referee->referee_type}} - From: {{$referee->city_name_en}}
                                            </option>
                                            @endforeach
                                        </select>


                                          <span class="help-block">@if ($errors->has('referee_id'))
                                                  {{ $errors->first('referee_id') }}
                                              @endif</span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('matchesreferees.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                            
                         </div>
                      </section>
                </div>
              </div>
@endsection