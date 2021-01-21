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
                              <li class="breadcrumb-item" aria-current="page">All Allowances Values</li>
                              <li class="breadcrumb-item active" aria-current="page">All Cairo Area Allowances </li>
                            
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
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Allowance Name</th>
                  <th>City From</th>
                  <th>City To</th>
                  <th>Season</th>
                  <th>Referee Place</th>
                  <th>Referee Type</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($cairoAreaAllowancesValues as $allowanceValue)
              <tr>


                <td>{{$allowanceValue->allowance_name}}</td>
                <td>{{$allowanceValue->From->city_name_en}}</td>
                <td>{{$allowanceValue->To->city_name_en}}</td>
                <td>{{$allowanceValue->season_start_date}} / {{$allowanceValue->season_end_date}}</td>
                <td>
                    @if ($allowanceValue->refereeplace->referee_position == 'playground')
                     Playground
                    @endif
                    @if ($allowanceValue->refereeplace->referee_position == 'table')
                         Table                   
                    @endif
                </td>
                <td>{{$allowanceValue->referee_type}}</td>
                <td>
                      <a class="btn btn-primary btn-xs" title="Edit" href="{{route('allowancesvalues.edit',$allowanceValue->allowances_values_id)}}"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-success btn-xs" title="Show" href="{{route('allowancesvalues.show',$allowanceValue->allowances_values_id)}}"><i class="fa fa-eye"></i></a>
                     <a title="Delete" data-toggle="modal" href="#deModal{{$allowanceValue->allowances_values_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                </td>   
                <div class="modal fade" id="deModal{{$allowanceValue->allowances_values_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Confirmation</h4>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete this record.
                             <!-- <input type="hidden" id="catidh" value=""/>-->
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                <form method="POST"  action="{{route('allowancesvalues.destroy',$allowanceValue->allowances_values_id)}}">
                                  @csrf
                                  @method('Delete')
                                  <button type="submit" class="btn btn-danger">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>                   
              @endforeach
              </tfoot>
              </table>
              </div>
              </div>
              </section>
              </div></div>
             
@endsection