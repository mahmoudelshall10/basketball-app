@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('question.index')}}">Questions Bank</a></li>
                              <li class="breadcrumb-item"><a href="{{route('question_option.index')}}">Question Options</a></li>
                              <li class="breadcrumb-item active" aria-current="page">All Options</li>
                            
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
                  Options
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('question_option.create')}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Add New Option
                              </a>
	             </span>
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Option Text</th>
                  <th>Correct</th>
                  <th>Question </th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($options as $option)
              <tr>

                <td>{{$option->option_text}}</td>
                <td>@if($option->option_correct === 0)
                    Incorrect
                  @elseif($option->option_correct === 1)
                    Correct
                  @endif</td>
                <td>{{$option->question->question_content}}</td>
                <td>
                  @if($option->option_type === 0)
                    Single Choice Option
                  @elseif($option->option_type === 1)
                    Multiple Choice Option
                  @elseif($option->option_type === 2)
                    Text Option
                  @endif
                </td>
                
                 <td>
                      <a class="btn btn-primary btn-xs" title="Edit" href="{{route('question_option.edit',$option->option_id)}}"><i class="fa fa-pencil"></i></a>
                     {{-- <a class="btn btn-success btn-xs" title="Show" href="{{route('question_option.show',$option->option_id)}}"><i class="fa fa-eye"></i></a> --}}
                      <a title="Delete" data-toggle="modal" href="#deModal{{$option->option_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                </td>   
                <div class="modal fade" id="deModal{{$option->option_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('question_option.destroy',$option->option_id)}}">
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