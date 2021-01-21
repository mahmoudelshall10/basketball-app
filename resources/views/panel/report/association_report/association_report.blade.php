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
              
            </ol>
        </nav>
        <!--breadcrumbs end -->
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-12">
      @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
        {{Session('success')}}
      </div>
      @endif
    <section class="panel">
    <header class="panel-heading">
    <center>
      <a href="{{route('reports.CairoAreaReport')}}" class="btn btn-primary">Cairo Area Report</a>
      <a href="{{route('reports.MiniBasketReport')}}" class="btn btn-warning">Mini Basket Report</a>
    </center>
    <hr>
    <a href="{{route('associationReportExportPdf')}}" class="btn btn-danger">Export Report PDF</a>
    <a href="{{route('associationReportExportExcel')}}" class="btn btn-info">Export Report Excel</a>
    <hr>
    <center>اجمالي بدلات السادة الحكام الذين قاموا التحكيم مباريات الدوري العام</center>
    </header>
    <div class="card-body">
    <div class="adv-table">
    @include('panel.report.association_report.associationTable')
    </div>
    </div>
    </section>
    </div>
  </div>

@endsection