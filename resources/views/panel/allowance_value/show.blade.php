@extends('layouts.app')
@section('content')
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="card">

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      
                      <section class="card">
                          
                          <div class="card-body bio-graph-info">
                              <h1>Allowance Value</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>Allow. Name </span>: {{$allowance_value->allowance_name}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Allowance Type </span>:
                                      @if ($allowance_value->allowance_type == 'association')
                                          Association
                                      @elseif($allowance_value->allowance_type == 'cairo_area')
                                          Cairo Area
                                      @elseif($allowance_value->allowance_type == 'mini_basket')
                                            Mini-Basket
                                      @endif
                                      </p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>From </span>: {{$allowance_value->From->city_name_en}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>To </span>: {{$allowance_value->To->city_name_en}}</p>
                                  </div>

                                  <div class="bio-row">
                                    <p><span>Referee Place </span>: {{$allowance_value->refereeplace->referee_position == 'playground'? 'Playground':'Table'}}</p>
                                 </div>
                                   <div class="bio-row">
                                      <p><span>Referee Type</span>: {{$allowance_value->referee_type}}</p>
                                  </div>
                                  @if ($allowance_value->subsistance_allowance)
                                    <div class="bio-row">
                                        <p><span>Subsistance Allowance </span>: {{$allowance_value->subsistance_allowance}}</p>
                                    </div>
                                  @endif
                                  @if ($allowance_value->arbitration_allowance)   
                                    <div class="bio-row">
                                        <p><span>Refereeing Allowance</span>: {{ $allowance_value->arbitration_allowance }}</p>
                                    </div>
                                  @endif
                                  @if ($allowance_value->transition_allowance)
                                   <div class="bio-row">
                                      <p><span>Transition Allowance</span>: {{$allowance_value->transition_allowance}}</p>
                                  </div>                                      
                                  @endif
                                  @if ($allowance_value->tournament_allowance)
                                   <div class="bio-row">
                                      <p><span>Tournament Allowance</span>: {{$allowance_value->tournament_allowance}}</p>
                                  </div>                                      
                                  @endif
                                  @if ($allowance_value->nutrition_allowance)
                                  <div class="bio-row">
                                     <p><span>Feeding Allowance</span>: {{$allowance_value->nutrition_allowance}}</p>
                                 </div>                                      
                                 @endif
                                @if ($allowance_value->period_value)
                                   <div class="bio-row">
                                      <p><span>Period Value</span>: {{$allowance_value->period_value}}</p>
                                  </div>
                                @endif

                                  
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