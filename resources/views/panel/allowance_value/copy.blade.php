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
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('allowancesvalues.copy')}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')

                                 <div class="form-group">
                                    <label class="col-sm-2 control-label">From Start Date</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="4" name="from_season" class="required  form-control @if ($errors->has('from_season')) is-valid @endif">
                                    </div>
                                    <span class="help-block">@if ($errors->has('from_season'))
                                        {{ $errors->first('from_season') }}
                                        @endif
                                    </span>   
                                </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">To Start Season</label>  
                                        <div class="col-sm-10">
                                            <input type="number" min="4" name="to_season" class="required form-control @if ($errors->has('to_season')) is-valid @endif">
                                        </div>
                                        <span class="help-block">@if ($errors->has('to_season'))
                                            {{ $errors->first('to_season') }}
                                            @endif
                                        </span>  
                                        </div>

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Copy</button>
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
        $('#from_league').change(function () {
       var from_league = $(this).val();
      if (from_league) {
       $.ajax({
        type: "GET",
        url: "{{url('getleague')}}"+"/"+from_league,
        success: function (res) {
            
            $("#to_league").empty();
            $("#to_league").append('<option>Choose League</option>');
            
            /// loop javascript 
             
            $.each(res , function (key, value) {
                // console.log(value);
                $("#to_league").append('<option value="' + value.league_id + '">' + value.league_name + '</option>');
            });
        }
            });
           } else {
            $("#to_league").empty();
           }
         });  
 </script>
    @endpush
@endsection