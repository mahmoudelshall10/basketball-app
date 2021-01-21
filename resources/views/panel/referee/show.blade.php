@extends('layouts.app')
@section('content')
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="card">
                          <div class="user-heading round">
                              <a href="#">
                                  @if($referee->referee_image === null)
                                                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                      @else
                                                          <img src="{{url($referee->referee_image)}}" alt="" />
                                                      @endif
                              </a>
                              <h1>{{$referee->referee_fullname}}</h1>
                              <p>{{"@".$referee->referee_username}}</p>
                          </div>

                         

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      
                      <section class="card">
                          
                          <div class="card-body bio-graph-info">
                              <h1>Bio Graph</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>Full Name </span>: {{$referee->referee_fullname}}</p>
                                  </div>
                                  <div class="bio-row">
                                    <p><span>Arabic FullName </span>: {{$referee->referee_fullname_ar}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Username </span>: {{$referee->referee_username}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Mobile </span>: {{$referee->referee_mobile}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Email </span>: {{$referee->referee_email}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>City </span>: {{$referee->city->city_name_en}}</p>
                                  </div>

                                  
                                  <div class="bio-row">
                                    <p><span>Governorate </span>: {{$referee->city->governorate->governorate_name_en}}</p>
                                 </div>
                                   <div class="bio-row">
                                      <p><span>Age</span>: {{$referee->referee_birthday->diffInYears()}} years old</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>National ID </span>: {{$referee->referee_nationl_identity}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>ID</span>: {{ $referee->referee_identity }}</p>
                                  </div>
                                   <div class="bio-row">
                                      <p><span>Address</span>: {{$referee->referee_address}}</p>
                                  </div>
                                   <div class="bio-row">
                                      <p><span>Card Number</span>: {{$referee->referee_card_number}}</p>
                                  </div>

                                  
                              </div>
                          </div>
                      </section>
                      {{--<section>
                          <div class="row">
                              <div class="col-lg-6">
                                  <div class="card">
                                      <div class="card-body">
                                          <div class="bio-chart">
                                              <input class="knob" data-width="100" data-height="100" data-displayPrevious=false  data-thickness=".2" value="{{round($total)}}" data-fgColor="#e06b7d" data-bgColor="#e8e8e8" data-readOnly=true >
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="red">Total Orders</h4>
                                              <p>Started From : {{ $driver->created_at->format('d M Y') }}</p>
                                              <p>Ended to : {{now()->format('d M Y')}}</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="card">
                                      <div class="card-body">
                                          <div class="bio-chart">
                                              <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="{{round($canceled)}}" data-fgColor="#4CC5CD" data-bgColor="#e8e8e8" data-readOnly=true>
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="terques">Canceled Orders </h4>
                                              <p>Started : {{ $driver->created_at->format('d M Y') }}</p>
                                              <p>Ended to : {{now()->format('d M Y')}}</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="card">
                                      <div class="card-body">
                                          <div class="bio-chart">
                                              <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="{{round($completed)}}" data-fgColor="#96be4b" data-bgColor="#e8e8e8" data-readOnly=true>
                                          </div>
                                          <div class="bio-desk">
                                              <h4 class="green">Completed Orders</h4>
                                              <p>Started From : {{ $driver->created_at->format('d M Y') }}</p>
                                              <p>Ended to : {{now()->format('d M Y')}}</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <div class="card">
                                      <div class="card-body">
                                        
                                          <div class="bio-desk">
                                              <h4 class="purple">Total Statistics</h4>
                                              <p>Total Earnings : {{$earn}}</p>
                                              <p>Rating : @if($rating !== null){{$rating}} <i class="fa fa-star"></i>@else Not Set Yet @endif</p>
                                              
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </section>--}}
                  </aside>
              </div>
@endsection