@extends('layouts.app')
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
                  <section class="card">
                    <div class="card-body">
                      <center>
                        {{-- <a href="{{route('reports.AssociationIndex')}}" class="btn btn-success">Association Report</a> --}}
                        <a href="{{route('reports.cairoAreaIndex')}}" class="btn btn-primary">Cairo Area Report</a>
                        <a href="{{route('reports.MiniBasketIndex')}}" class="btn btn-warning">Mini Basket Report</a>
                      </center>
                    </div>
                    </section>
              </div></div>
             
@endsection