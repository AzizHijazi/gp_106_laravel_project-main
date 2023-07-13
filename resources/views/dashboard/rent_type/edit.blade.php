@extends('layouts.dashboard.parent')

@section('header_title','Edit Rent Type')
@section('page_title','Edit Rent Type')
@section('home_page')
  {{route('home')}}
@endsection

@section('content')
@if ($errors->any())
<div class="card-body">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
      </div>
    </div>
@endif
  <hr>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6 col-md-4 col-lg-3 my-2">
      <div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Edit Rent Type</h3>
  </div>
  <form action="{{route('rent_types.update',$edit->id)}}" method="POST">
    @method('PUT')
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{$edit->name}}" required>
      </div>
      <div class="col-md-12 mb-3">
        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
            <input type="checkbox" class="custom-control-input"  id="status" name="status" id="customSwitch3" @checked($edit->status)>
            <label class="custom-control-label" for="status" >Active</label>
        </div>
    </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-warning">Update Rent Type</button>
    </div>
  </form>
</div>
</div>
</div>
</div>
<hr>

  @endsection