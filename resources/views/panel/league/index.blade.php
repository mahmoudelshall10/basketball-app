@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('league.index')}}">Leagues</a></li>
                              <li class="breadcrumb-item active" aria-current="page">All Leagues</li>
                            
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
                  Leagues
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('league.create')}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Add New Leagues
                              </a>
	             </span>
              </header>
              <div class="card-body">
            <center>
                <a href="{{route('associationIndex')}}" class="btn btn-primary">Association Leagues</a>
                <a href="{{route('cairoAreaIndex')}}" class="btn btn-success">Cairo Area Leagues</a>
                <a href="{{route('miniBasketIndex')}}" class="btn btn-default">Mini Basket Leagues</a>
            </center>  
                </div>
              </div>
              </section>
              </div></div>
             
@endsection