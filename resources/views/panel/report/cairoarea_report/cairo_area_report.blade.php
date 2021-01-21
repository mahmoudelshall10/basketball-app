@extends('layouts.app_rtl')
@section('content')
 <!-- page start-->
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
                    <a href="{{route('reports.MiniBasketIndex')}}" class="btn btn-warning">Mini Basket Report</a>
                </li>
            </ol>
        </nav>
        <!--breadcrumbs end -->
    </div>
  </div>

              <div class="row">
                <div class="col-sm-12">
                  <section class="panel">
                    <header class="panel-heading">
                      <div class="col-lg-6">

                        <select class="required form-control" name="league_id" id='league_id'>
                          <option value="" disabled="disabled" selected="">Select League</option>
                          @foreach($leagues as $league)
                          
                          <option value="{{$league->league_id}}" 
                            @if(old('league_id') == $league->league_id){{"selected"}}@endif>
                            {{$league->league_name}} - {{$league->league_start_date}} / {{$league->league_end_date}}
                          </option>
                          @endforeach
                        </select>

                      </div>
                      {{-- <hr> --}}
                      {{-- <a href="{{route('cairoAreaReportExportPdf')}}" class="btn btn-danger">Export Report PDF</a> --}}
                      {{-- <a href="{{route('cairoAreaReportExportExcel')}}" class="btn btn-info">Export Report Excel</a> --}}
                      <hr>
                      <center>اجمالي بدلات السادة الحكام الذين قاموا التحكيم مباريات منطقة القاهرة</center>
                      </header>
                      <div class="card-body">
                      <div class="adv-table">
                      @include('panel.report.cairoarea_report.cairoAreaTable')
                    </div>
                  </div>
                  </section>
                  </div>
                </div>
@endsection