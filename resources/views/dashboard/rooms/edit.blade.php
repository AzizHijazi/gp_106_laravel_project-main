@extends('layouts.dashboard.parent')

@section('header_title','Edit Hub')
@section('page_title','Edit')
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
<div class="container-fluid">
  <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add Room</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('rooms.update',$rooms->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="room_number">Room Number</label>
            <input type="text" class="form-control" id="room_number" name="room_number" value="{{$rooms->room_number}}" required="">
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$rooms->name}}" required="">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" class="form-control" id="description" name="description" required>{{old($rooms->description,'description')}}</textarea>
          </div>
          <div class="form-group">
              <label for="size">Size</label>
              <input type="text" class="form-control" id="size" name="size" value="{{$rooms->size}}" required="">
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" class="form-control" id="price" name="price" value="{{$rooms->price}}" required="">
            </div>
          <div class="form-group">
            <label for="image">File input</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image"  accept="image/png, image/jpeg">
                <label class="custom-file-label" for="image">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text">Upload</span>
              </div>
            </div>
          </div>
          <label for="image">Upload Image</label>
          <div class="custom-file">
            <input type="file"  id="image" name="image" class="custom-file-input" id="customFile">
            <label class="custom-file-label" class="form-label" for="customFile">Choose file</label>
          </div>
        </div>
            @if ($rooms->image)
            <img src="{{url($rooms->image)}}" alt="Room Image" width="200px">
            @endif

          <div class="form-group">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                  <input type="checkbox" class="custom-control-input" name="status" @checked($rooms->status) id="customSwitch3">
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



