@extends('layouts.dashboard.parent')

@section('header_title','Edit DeskType')
@section('page_title','Edit DeskType')
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
      <h3 class="card-title">Edit DeskType</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('desk_types.update',$edit->id)}}" method="POST">
      @method('PUT')
      @csrf
    <div class="card-body">
        <div class="form-group">
          <label for="deskType">Name</label>
          <input type="text" class="form-control" name="name" id="name" value="{{$edit->name}}" required>
        </div>
        <div class="form-group">
          <label for="deskType">Info</label>
          <input type="text" class="form-control" name="info" id="info" value="{{$edit->info}}" required>
        </div>
        <div class="form-group">
          <label for="deskType">Count</label>
          <input type="number" class="form-control" name="count" id="count" value="{{$edit->count}}" required>
        </div>
      <!-- /.card-body -->
      <div class="card">
        <button type="submit" class="btn btn-outline-success">Update Desk Type</button>
      </div>
    </form>
  </div>
  </div>
  </div>
  </div>
</div>
<hr>

@endsection