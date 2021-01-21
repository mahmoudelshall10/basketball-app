@extends('layouts.app_rtl')
@section('content')
 <!-- page start-->
 @push('admincss')
 <style>
   /* th { white-space: nowrap; }, */
 </style>
 @endpush
 <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('reports.index')}}">Reports</a></li>
                              <li class="breadcrumb-item active" aria-current="page">All Reports</li>
                              <li>
                                <a href="{{route('reports.AssociationIndex')}}" class="btn btn-success">Association Report</a>
                                <a href="{{route('reports.cairoAreaIndex')}}" class="btn btn-primary">Cairo Area Report</a>
                              </li>
                              {{-- <li>
                                <a href="{{route('miniBasketReportExportPdf')}}" class="btn btn-danger">Export Report PDF</a>
                                <a href="{{route('miniBasketReportExportExcel')}}" class="btn btn-info">Export Report Excel</a>
                              </li> --}}
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
            <div class="row">
              <div class="col-sm-12">
                <section class="panel">
                  <header class="panel-heading">
                    <div class="col-lg-12">
                      <div class="col-lg-4">
                          <input type="number" min="2000" name="league_start_date" id="league_start_date" class="required  form-control @if ($errors->has('league_start_date')) is-valid @endif" placeholder="league Start Date...">
                          <span class="help-block">@if ($errors->has('league_start_date'))
                              {{ $errors->first('league_start_date') }}
                              @endif
                          </span> 
                      </div> 

                      <div class="col-lg-4">
                          <input type="number" min="2000" name="league_end_date" id="league_end_date" class="required  form-control @if ($errors->has('league_end_date')) is-valid @endif" placeholder="league End Date...">
                          <span class="help-block">@if ($errors->has('league_end_date'))
                              {{ $errors->first('league_end_date') }}
                              @endif
                          </span>    
                      </div>

                      <div class="col-lg-4">
                          <button class="btn btn-info" id="search" type="submit" value="Submit">Search <i class="fa fa-search"></i></button>
                      </div>
                    </div>
                    <hr>
                    <center id="center">اجمالي بدلات السادة الحكام الذين قاموا بتحكيم مباريات البراعم</center>
                  </header>
                  <div class="panel-body">
                    <div class="table-responsive">
                      @include('panel.report.minibasket_report.miniBasketTable')
                    </div>
                  </div>
                </section>
              </div>
            </div>
@endsection