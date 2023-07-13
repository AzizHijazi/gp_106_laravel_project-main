@extends('layouts.dashboard.parent')

@section('header_title','Create Room')
@section('page_title','Rooms')
@section('home_page')
{{route('home')}}
@endsection

@section('style')
{{-- CUSTOM CSS FILES IMPORT --}}
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
<div class="container-fluid">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add Room</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('rooms.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="room_number">Room Number</label>
          <input type="text" class="form-control" id="room_number" name="room_number" value="{{ old('room_number') }}" required="">
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required="">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea type="text" class="form-control" id="description" name="description"  required>{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
          <label for="size">Size</label>
          <input type="number" class="form-control" id="size" name="size" value="{{ old('size') }}" required="">
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" required="">
        </div>
        <div class="form-group">
          <label for="image">File input</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="image" name="image">
              <label class="custom-file-label" for="image">Choose file</label>
            </div>
            <div class="input-group-append">
              <span class="input-group-text">Upload</span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
            <input type="checkbox" class="custom-control-input" name="status" id="customSwitch3">
            <label class="custom-control-label" for="customSwitch3">Available</label>
          </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>
@endsection

