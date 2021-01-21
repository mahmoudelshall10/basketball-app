@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('allowancesvalues.index')}}">Allowances Values</a></li>
                              <li class="breadcrumb-item"><a href="{{route('allowancesvalues.index')}}">All Allowances Values</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Allowance Value</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                      {{Session('success')}}
                    </div>
                    @endif
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('allowancesvalues.store')}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')

                                <div class="form-group">
                                    <label class="-col-sm-2 control-label">Allowance Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="required  form-control @if ($errors->has('allowance_name')) is-valid @endif" name="allowance_name" id="allowance_name">
                                    </div>
                                    <span class="help-block">
                                        @if ($errors->has('allowance_name'))
                                            {{ $errors->first('allowance_name') }}
                                        @endif
                                    </span>
                                </div>


                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Allowance Type</label>
                                      <div class="col-sm-10">
                                        <select class="required  form-control @if ($errors->has('allowance_type')) is-valid @endif" name="allowance_type" id="allowance_type" required>
                                            <option value="">Choose Allowance Type</option>
                                            <option value="association" id="association">Association</option>
                                            <option value="cairo_area" id="cairo_area">Cairo Area</option>
                                            <option value="mini_basket" id="mini_basket">Mini Basket</option>
                                        </select>
                                        <span class="help-block">
                                            @if ($errors->has('allowance_type'))
                                                {{ $errors->first('allowance_type') }}
                                            @endif
                                        </span>
                                      </div>
                                  </div>


                                  <div class="form-group" id="city_from_div">
                                      <label class="col-sm-2 control-label">From</label>  
                                      <div class="col-sm-10">
                                        <select name="city_from" id="city_from" class="required  form-control @if ($errors->has('city_from')) is-valid @endif">
                                            <option >Choose City</option>
                                            @foreach ($arrCities as $city)
                                                <option value="{{$city->city_id}}"
                                                    @if ($city->city_id)
                                                        @if (old('city_from') == $city->city_id ) {{"selected"}} @endif 
                                                    @endif 
                                                    >{{$city->city_name_en}}</option>
                                            @endforeach
                                        </select> 
                                        <span class="help-block">@if ($errors->has('city_from'))
                                            {{ $errors->first('city_from') }}
                                        @endif</span>   
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">To</label>  
                                        <div class="col-sm-10">
                                            <select class="required  form-control @if ($errors->has('city_to')) is-valid @endif" name="city_to" id="city_to" >
                                                <option>Choose City</option>
                                                
                                            </select>
                                            <span class="help-block">@if ($errors->has('city_to'))
                                                    {{ $errors->first('city_to') }}
                                                @endif</span>   
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Season Start Date</label>
                                        <div class="col-sm-10">
                                            <input type="number" min="4" name="season_start_date" class="required  form-control @if ($errors->has('season_start_date')) is-valid @endif">
                                        </div>
                                        <span class="help-block">@if ($errors->has('season_start_date'))
                                            {{ $errors->first('season_start_date') }}
                                        @endif</span>   
                                    </div>



                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">Referee Place</label>  
                                        <div class="col-sm-10">
                                            <select class="required  form-control @if ($errors->has('referee_place')) is-valid @endif" name="referee_place" >
                                                <option  selected="">Choose Referee Place</option>
                                                
                                                @foreach ($refereePlaces as $refereePlace)
                                                    <option value="{{$refereePlace->referee_place_id}}"
                                                        @if ($refereePlace->referee_place_id)
                                                         @if (old('referee_place_id') == $refereePlace->referee_place_id ) {{"selected"}} @endif 
                                                        @endif 
                                                    >{{ucfirst($refereePlace->referee_position)}}</option> 
                                                @endforeach   
                                            </select>
                                            <span class="help-block">@if ($errors->has('referee_place'))
                                                    {{ $errors->first('referee_place') }}
                                                @endif</span>   
                                        </div>
                                    </div>

                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">Referee Type </label>
                                    <div class="col-sm-10">
                                        <select class="required  form-control @if ($errors->has('referee_type')) is-valid @endif" name="referee_type" >
                                           <option  value="" disabled="disabled" selected="">Select Type</option>

                                            <option value="International" @if( old('referee_type')== "International"){{"selected"}}@endif >International</option>
                                            <option value="First Division" @if( old('referee_type')== "First Division"){{"selected"}}@endif >First Division</option>
                                            <option value="Second Division" @if( old('referee_type')== "Second Division"){{"selected"}}@endif >Second Division</option>
                                            <option value="Third Division" @if( old('referee_type')== "Third Division"){{"selected"}}@endif >Third Division</option>
                                            <option value="Mini Basket" @if( old('referee_type')== "Mini Basket"){{"selected"}}@endif >Mini Basket</option>
                                            <option value="Commessioner" @if( old('referee_type')== "Commessioner"){{"selected"}}@endif >Commessioner</option>
                                                     
                                        </select>
                                        <span class="help-block">@if ($errors->has('referee_type'))
                                                {{ $errors->first('referee_type') }}
                                            @endif</span>
                                    </div>
                                </div>


                                <div class="form-group" id="arbitration_allowance_div">
                                    <label class="col-sm-2 control-label">Refereeing Allowance</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" class="required form-control @if ($errors->has('arbitration_allowance')) is-valid @endif " name="arbitration_allowance" id="arbitration_allowance">
                                    </div>
                                    <span class="help-block">@if ($errors->has('arbitration_allowance'))
                                        {{ $errors->first('arbitration_allowance') }}
                                    @endif</span>
                                </div>

                                <div class="form-group" id="transition_allowance_div">
                                    <label class="col-sm-2 control-label">Transition Allowance</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0" class="required form-control @if ($errors->has('transition_allowance')) is-valid @endif " name="transition_allowance" id="transition_allowance">
                                    </div>
                                    <span class="help-block">@if ($errors->has('transition_allowance'))
                                        {{ $errors->first('transition_allowance') }}
                                    @endif</span>
                                </div>

                                <div class="form-group" id="subsistance_allowance_div">
                                    <label class="col-sm-2 control-label">Subsistance Allowance</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0"  class="required form-control @if ($errors->has('subsistance_allowance')) is-valid @endif " name="subsistance_allowance" id="subsistance_allowance">
                                    </div>
                                    <span class="help-block">@if ($errors->has('subsistance_allowance'))
                                        {{ $errors->first('subsistance_allowance') }}
                                    @endif</span>
                                </div>

                                <div class="form-group" id="tournament_allowance_div">
                                    <label class="col-sm-2 control-label">Tournament Allowance</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="-1"  class="required form-control @if ($errors->has('tournament_allowance')) is-valid @endif " name="tournament_allowance" id="tournament_allowance">
                                    </div>
                                    <span class="help-block">@if ($errors->has('tournament_allowance'))
                                        {{ $errors->first('tournament_allowance') }}
                                    @endif</span>
                                </div>

                                <div class="form-group" id="num_of_period_div">
                                    <label class="col-sm-2 control-label">Number Of Period</label>
                                    <div class="col-sm-10">
                                        <select class="required  form-control @if ($errors->has('num_of_periods')) is-valid @endif" name="num_of_periods" >
                                            <option  value="" disabled="disabled" selected="">Select Type</option>
 
                                             <option value="1" @if( old('num_of_periods')== "1"){{"selected"}}@endif >1</option>
                                             <option value="1.5" @if( old('num_of_periods')== "1.5"){{"selected"}}@endif >1.5</option>
                                             <option value="2" @if( old('num_of_periods')== "2"){{"selected"}}@endif >2</option>
                                             <option value="2.5" @if( old('num_of_periods')== "2.5"){{"selected"}}@endif >2.5</option>
                                             <option value="3" @if( old('num_of_periods')== "3"){{"selected"}}@endif >3</option>
                                                      
                                         </select>
                                    </div>
                                    <span class="help-block">@if ($errors->has('num_of_periods'))
                                        {{ $errors->first('num_of_periods') }}
                                    @endif</span>
                                </div>

                                <div class="form-group" id="nutrition_allowance_div">
                                    <label class="col-sm-2 control-label">Feeding Allowance</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0"  class="required form-control @if ($errors->has('nutrition_allowance')) is-valid @endif " name="nutrition_allowance" id="nutrition_allowance">
                                    </div>
                                    <span class="help-block">@if ($errors->has('nutrition_allowance'))
                                        {{ $errors->first('nutrition_allowance') }}
                                    @endif</span>
                                </div>
                                
                                <div class="form-group" id="period_value_div">
                                    <label class="col-sm-2 control-label">Period Value</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0" class="form-control @if ($errors->has('period_value')) is-valid @endif " name="period_value" id="period_value">
                                    </div>
                                    <span class="help-block">@if ($errors->has('period_value'))
                                        {{ $errors->first('period_value') }}
                                    @endif</span>
                                </div>




                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('allowancesvalues.index')}}" class="btn btn-default" type="button">Exit</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
    @push('adminjs')
    <script type="text/javascript">
    function associationType()
    {
        $('#city_from_div').show();
        $('#subsistance_allowance_div').show();
        $('#arbitration_allowance_div').show();
        $('#transition_allowance_div').show();
        $('#tournament_allowance_div').show();
        $('#period_value_div').hide();
        $('#num_of_period_div').hide();
        $('#nutrition_allowance_div').hide();
   }

   function cairoAreaType()
   {
        $('#city_from_div').hide();
        $('#journey_type_div').hide();
        $('#subsistance_allowance_div').hide();
        $('#period_value_div').hide();
        $('#num_of_period_div').hide();
        $('#tournament_allowance_div').hide();
        $('#nutrition_allowance_div').hide();
        $('#arbitration_allowance_div').show();
   }

   function miniBasketType()
   {
        $('#city_from_div').hide();
        $('#journey_type_div').hide();
        $('#subsistance_allowance_div').hide();
        $('#arbitration_allowance_div').hide();
        $('#tournament_allowance_div').hide();
        $('#nutrition_allowance_div').show();
        $('#period_value_div').show();
        $('#num_of_period_div').show();
   }
   
        $('#allowance_type').change(function () {
        var allowance_type = $(this).val();
            if (allowance_type == 'association') {
                associationType();
            }
            $('#city_from').change( () => {
                var city_from_value =  $('#city_from').val() ;
                console.log(city_from_value);
                    if (city_from_value) {

                    $.ajax({
                        type: "GET",
                        url:"{{url('getcities')}}"+"/"+ city_from_value,
                        success: function (res) 
                        {    
                            $("#city_to").empty();
                            $("#city_to").append('<option>Choose City</option>');
                            
                            /// loop javascript 
                                
                            $.each(res , function (key, value) {
                                // console.log(value);
                                $("#city_to").append('<option value="' + value.city_id + '">' + value.city_name_en + '</option>');
                            });
                        
                        }
                            });


                        } else {
                            $("#city_to").empty();
                        }
            });


            if (allowance_type == 'cairo_area') {
                cairoAreaType();
                $.ajax({
                        type: "GET",
                        url:"{{url('getcairoareas')}}",
                        success: function (res) 
                        {    
                            $("#city_to").empty();
                            $("#city_to").append('<option>Choose City</option>');
                            
                            /// loop javascript 
                                
                            $.each(res , function (key, value) {
                                // console.log(value);
                                $("#city_to").append('<option value="' + value.city_id + '">' + value.city_name_en + '</option>');
                            });
                        
                        }
                    });


            }

            if (allowance_type == 'mini_basket') {
                miniBasketType();

                $.ajax({
                        type: "GET",
                        url:"{{url('getcairoareas')}}",
                        success: function (res) 
                        {    
                            $("#city_to").empty();
                            $("#city_to").append('<option>Choose City</option>');
                            
                            /// loop javascript 
                                
                            $.each(res , function (key, value) {
                                // console.log(value);
                                $("#city_to").append('<option value="' + value.city_id + '">' + value.city_name_en + '</option>');
                            });
                        
                        }
                    });
            }
         });  
    </script>
    @endpush
@endsection