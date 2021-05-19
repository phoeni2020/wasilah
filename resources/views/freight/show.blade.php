@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{trans('lang.cart_plural')}}<small class="ml-3 mr-3">|</small><small>{{trans('lang.cart_desc')}}</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-itema ctive"><a href="{!! url('freight/') !!}">Car</a>
          </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item">
          <a class="nav-link" href="{!! url('/car') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.cart_table')}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{!! route('carts.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.cart_create')}}</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="row">

        @if(session()->has('done'))
          <div class="alert alert-success">{{session('done')}}</div>
        @elseif(session()->has('error'))
          <div class="alert alert-danger">{{session('error')}}</div>
        @endif
          <form method="post" class="row col-12" action="{{url('/freight/order/update/'.$data[0]['id'])}}" >
            @method('PUT')
            @csrf
              @include('freight.fields_create')
            <div class="form-group col-12 text-right">
                <button type="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i>Save</button> | 
                <a href="{!! url('/freight') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.back')}}</a>
            </div>
          </form>
        <!-- Back Field -->
       
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@endsection