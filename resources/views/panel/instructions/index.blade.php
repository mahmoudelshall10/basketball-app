@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <!--breadcrumbs start -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('instructions.index')}}">Instructions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Instruction</li>
              
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
    Instruction
      <span class="tools pull-right">
       <a class="btn btn-primary"  href="{{route('instructions.create')}}" style="margin-right:1%;color: white ">
                    <i class="fa fa-plus"></i> &nbsp;Make Instruction
                  </a>
     </span>
  </header>
  <div class="card-body">
        <div class="card-body">
            @foreach ($instructions as $instr)
                {!!$instr->instruction!!}
            @endforeach
         </div>
      </section>
  </div>
  </div>
  </section>
  </div></div>


@endsection