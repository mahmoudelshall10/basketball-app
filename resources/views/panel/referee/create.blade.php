@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('referee.index')}}">Referees</a></li>
                              <li class="breadcrumb-item"><a href="{{route('referee.index')}}">All Referees</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Referee</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('referee.store')}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Full Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('referee_fullname')) is-valid @endif"  name="referee_fullname" value="{{old('referee_fullname')}}" >
                                          <span class="help-block">@if ($errors->has('referee_fullname'))
                                                  {{ $errors->first('referee_fullname') }}
                                              @endif</span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Arabic Full Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('referee_fullname_ar')) is-valid @endif"  name="referee_fullname_ar" value="{{old('referee_fullname_ar')}}" >
                                          <span class="help-block">@if ($errors->has('referee_fullname_ar'))
                                                  {{ $errors->first('referee_fullname_ar') }}
                                              @endif</span>
                                      </div>
                                  </div>
         
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Username</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('referee_username')) is-valid @endif"  name="referee_username" value="{{old('referee_username')}}">
                                          <span class="help-block">@if ($errors->has('referee_username'))
                                                  {{ $errors->first('referee_username') }}
                                              @endif</span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">E-mail</label>
                                      <div class="col-sm-10">
                                          <input type="email" class="required form-control @if ($errors->has('referee_email')) is-valid @endif"  name="referee_email" value="{{old('referee_email')}}">
                                          <span class="help-block">@if ($errors->has('referee_email'))
                                                  {{ $errors->first('referee_email') }}
                                              @endif</span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Password </label>
                                      <div class="col-sm-10">
                                          <input type="password" class="required form-control @if ($errors->has('refree_password')) is-valid @endif"  name="refree_password" >
                                          <span class="help-block">@if ($errors->has('refree_password'))
                                                  {{ $errors->first('refree_password') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Confirm Password </label>
                                      <div class="col-sm-10">
                                          <input type="password" class="required form-control @if ($errors->has('refree_password')) is-valid @endif"  name="refree_password_confirmation" > 
                                      </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="col-sm-2 control-label">Governorate</label>
                                    <div class="col-sm-10">
                                      <select name="gov_id" class="required form-control  @if ($errors->has('gov_id')) is-valid @endif" id="gov_id" >
                                          <option value="">Choose Your Governorate</option>
                                          @foreach ($governorates as $governorate)
                                              <option value="{{$governorate->gov_id}}" @if (old('gov_id') == $governorate->gov_id ) selected="selected" @endif>
                                                {{$governorate->governorate_name_en}}
                                              </option>
                                          @endforeach
                                          <span class="help-block">
                                              @if ($errors->has('gov_id'))
                                                  {{ $errors->first('gov_id') }}
                                              @endif
                                          </span>
                                      </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                  <label for="col-sm-2 control-label">City</label>
                                  <div class="col-sm-10">
                                    <select name="city_id" class="required form-control  @if ($errors->has('city_id')) is-valid @endif" id="city_id">

                                        <span class="help-block">
                                          @if ($errors->has('city_id'))
                                              {{ $errors->first('city_id') }}
                                          @endif
                                      </span>
                                    </select>
                                  </div>
                                </div>

                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Phone Number</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('referee_mobile')) is-valid @endif"  name="referee_mobile" value="{{old('referee_mobile')}}">
                                          <span class="help-block">@if ($errors->has('referee_mobile'))
                                                  {{ $errors->first('referee_mobile') }}
                                              @endif</span>
                                      </div>
                                  </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"  for="referee_image">Presonal Picture </label>
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
                                                     <input type="file" name="referee_image" class="default" value="{{old('referee_image')}}" />
                                                     </span>
                                                        
                                                        
                                                    </div>
                                                     <div class="form-text text-muted">
                                                           @if ($errors->has('referee_image'))
                                                              {{ $errors->first('referee_image') }}
                                                          @endif
                                                         </div>
                                                </div>
                                        </div>
                                    </div>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-sm-2">Address Description</label>
                                      <div class="col-sm-10">
                                          <textarea class="  form-control   @if ($errors->has('referee_address')) is-valid @endif" name="referee_address" rows="2">{{old('referee_address')}}</textarea>
                                           <span class="help-block">@if ($errors->has('referee_address'))
                                                  {{ $errors->first('referee_address') }}
                                              @endif</span>
                                      </div>
                                      
                                    </div>
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label col-sm-2">Birthday Date</label>
                                        <div class="col-sm-10">
                                            <div class="input-group date dpYears" data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="1-1-1970">
                                                <input type="text" class="form-control @if ($errors->has('referee_birthday')) is-valid @endif" placeholder="dd-mm-yyyy" aria-label="Right Icon" aria-describedby="dp-ig" name="referee_birthday" value="{{old('referee_birthday')}}">
                                                <div class="input-group-append">
                                                    <button id="dp-ig" class="btn btn-outline-secondary" type="button"><i class="fa fa-calendar f14"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('referee_birthday'))
                                                  {{ $errors->first('referee_birthday') }}
                                              @endif</span>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">National ID </label>
                                      <div class="col-sm-10">
                                          <input type="text" class=" form-control @if ($errors->has('referee_nationl_identity')) is-valid @endif" id="namear" name="referee_nationl_identity" value="{{old('referee_nationl_identity')}}">
                                          <span class="help-block">@if ($errors->has('referee_nationl_identity'))
                                                  {{ $errors->first('referee_nationl_identity') }}
                                              @endif</span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label"> ID  </label>
                                      <div class="col-sm-10">
                                          <input type="text" class=" form-control @if ($errors->has('referee_identity')) is-valid @endif" id="namear" name="referee_identity" value="{{old('referee_identity')}}">
                                          <span class="help-block">@if ($errors->has('referee_identity'))
                                                  {{ $errors->first('referee_identity') }}
                                              @endif</span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">Card Number</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0"  class=" form-control @if ($errors->has('referee_card_number')) is-valid @endif" id="namear" name="referee_card_number" value="{{old('referee_card_number')}}">
                                        <span class="help-block">@if ($errors->has('referee_card_number'))
                                                {{ $errors->first('referee_card_number') }}
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

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('referee.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
    @push('adminjs')
    <script type="text/javascript">
        $('#gov_id').change(function () {
       var gov_id = $(this).val();
      if (gov_id) {
       $.ajax({
        type: "GET",
        url: "{{url('getcitybygov')}}"+"/"+gov_id,
        success: function (res) {
            
            $("#city_id").empty();
            $("#city_id").append('<option>Choose Your City</option>');
            
            /// loop javascript 
             
            $.each(res , function (key, value) {
                // console.log(value);
                $("#city_id").append('<option value="' + value.city_id + '">' + value.city_name_en + '</option>');
            });
        }
            });
           } else {
            $("#city_id").empty();
           }
         });  
 </script>
    @endpush
@endsection