@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('league.index')}}">Leagues</a></li>
                              <li class="breadcrumb-item"><a href="{{route('league.index')}}">All Leagues</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Edit League</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                      @foreach (Session('error') as $error)
                        <li>{{$error}}</li>
                      @endforeach
                    </div>
                    @endif
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('league.update',$league->league_id)}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('PUT')
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">League Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('league_name')) is-valid @endif"  name="league_name" value="{{$league->league_name}}" >
                                          <span class="help-block">@if ($errors->has('league_name'))
                                                  {{ $errors->first('league_name') }}
                                              @endif</span>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">League Type</label>
                                        <div class="col-sm-10">
                                          <select class="required  form-control @if ($errors->has('league_type')) is-valid @endif" name="league_type" id="league_type" required>
                                              <option value="">Choose Allowance Type</option>
                                              <option {{$league->league_type == 'association'? 'selected':'' }} value="association">Association</option>
                                              <option {{$league->league_type == 'cairo_area'? 'selected':''  }} value="cairo_area"> Cairo Area</option>
                                              <option {{$league->league_type == 'mini_basket'? 'selected':'' }} value="mini_basket">Mini Basket</option>
                                          </select>
                                          <span class="help-block">
                                              @if ($errors->has('league_type'))
                                                  {{ $errors->first('league_type') }}
                                              @endif
                                          </span>
                                        </div>
                                    </div>

                                  <div class="form-group ">
                                    <label class="control-label col-sm-2 ">Start Date </label>
                                    <div class="col-lg-10">
                                        <div class="input-group date form_datetime-component">
                                            <input type="text" class="form-control date-set" aria-label="Right Icon" name="league_start_date" aria-describedby="basic-addon12">
                                            <div class="input-group-append">
                                                <button id="basic-addon12" class="btn btn-outline-secondary" type="button">{{$league->league_start_date}}<i class="fa fa-calendar f14"></i></button>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('league_start_date'))
                                                {{ $errors->first('league_start_date') }}
                                            @endif</span>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label col-sm-2 ">End Date </label>
                                    <div class="col-lg-10">
                                        <div class="input-group date form_datetime-component">
                                            <input type="text" class="form-control date-set" aria-label="Right Icon" name="league_end_date" aria-describedby="basic-addon12">
                                            <div class="input-group-append">
                                                <button id="basic-addon12" class="btn btn-outline-secondary" type="button">{{$league->league_end_date}}<i class="fa fa-calendar f14"></i></button>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('league_end_date'))
                                                {{ $errors->first('league_end_date') }}
                                            @endif</span>
                                    </div>
                                </div>



                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('league.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                            
                         </div>
                      </section>
                </div>
              </div>
@endsection