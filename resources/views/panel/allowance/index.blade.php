@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('allowances.index')}}">Allowances </a></li>
                              <li class="breadcrumb-item active" aria-current="page">All Allowances </li>
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
                   Allowances 
              </header>
              <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dynamic-table">
                <thead>
                    <tr>
                        <th>Referee Name</th>
                        <th>Referee Type</th>
                        <th>Referee From</th>
                        <th>Match Place</th>
                        <th>Match Date</th>
                        <th>Match Hall</th>
                        <th>Referee Place</th>
                        <th>Allowance Name</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($allowances as $allowance)
                    <tr>
                      <td>{{$allowance->referee->referee_fullname}}</td>
                      <td>{{$allowance->referee->referee_type}}</td>
                      <td>{{$allowance->referee['city']['city_name_en']}}</td>
                      <td>{{$allowance->leageMatch->hall->HallPlace->city_name_en}}</td>
                      <td>{{$allowance->leageMatch->match_date}}</td>
                      <td>{{$allowance->leageMatch->hall->hall_name}}</td>
                      <td>
                          @if ($allowance->AllownanceValue->refereeplace->referee_position == 'playground') Playground @endif       
                          @if ($allowance->AllownanceValue->refereeplace->referee_position == 'table') Table @endif 
                      </td> 
                    <td>{{$allowance->AllownanceValue->allowance_name}}</td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
              </div>
              </div>
              </section>
              </div>
            </div>
             
@endsection