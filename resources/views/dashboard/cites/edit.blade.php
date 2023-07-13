@extends('layouts.dashboard.parent')

@section('header_title','Edit City')
@section('page_title','Edit City')
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
    <h3 class="card-title">Edit City</h3>
  </div>
  <form action="{{route('cities.update',$editData->id)}}" method="POST">
    @method('PUT')
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="city">City Name</label>
        <input type="text" class="form-control" name="city" id="city" value="{{$editData->name}}" required>
      </div>
      <div class="form-group">
        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
          <input type="checkbox" class="custom-control-input"  name="status" id="customSwitch3" {{$editData->status ? 'checked' : ''}}>
          <label class="custom-control-label" for="customSwitch3">Available</label>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-warning">Update City</button>
    </div>
  </form>
</div>
</div>
</div>
</div>
<hr>
@endsection