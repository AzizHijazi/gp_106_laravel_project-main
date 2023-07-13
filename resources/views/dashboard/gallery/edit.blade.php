@extends('layouts.dashboard.parent')

@section('header_title','Edit Gallery')
@section('page_title','Edit Gallery')
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
    <h3 class="card-title">Edit Gallery</h3>
  </div>
  <form action="{{route('gallery.update',$editData->id)}}" method="POST">
    @method('PUT')
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="name">City Name</label>
        <input type="text" class="form-control" name="name" id="city" value="{{$editData->name}}" required>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-warning">Update Gallery</button>
    </div>
  </form>
</div>
</div>
</div>
</div>
<hr>
@endsection