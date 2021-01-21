@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('allowancesvalues.index')}}">Allowances Values</a></li>
                              <li class="breadcrumb-item active" aria-current="page">All Allowances Values</li>
                            
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
              <header class="card-header">
                   Allowances Values
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('allowancesvalues.create')}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Add New Allowance Value
                              </a>
               </span>
                  <a class="btn btn-default"  href="{{route('allowancesvalues.viewCopy')}}" style="margin-right:1%;color: white ">
                    <i class="fa fa-copy"></i> Copy Allowance Value
                  </a>
              </header>

              <div class="card-body">
                <center>
                    <a href="{{route('allowancesvalues.association')}}" class="btn btn-success">Association</a>
                    <a href="{{route('allowancesvalues.cairoarea')}}" class="btn btn-primary">Cairo Area</a>
                    <a href="{{route('allowancesvalues.minibasket')}}" class="btn btn-warning">Mini Basket</a>
                </center>
              </div>
              </section>
              </div></div>
             
@endsection