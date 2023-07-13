@extends('layouts.dashboard.parent')

@section('header_title','Edit Meeting Room')
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
        <h3 class="card-title">Add Meeting Room</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('meeting_rooms.update', $meetingRooms->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$meetingRooms->name}}" required>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" class="form-control" id="description" name="ndescriptioname" required>{{$meetingRooms->description}}  </textarea>
          </div>
          <div class="form-group">
            <label for="seats">Seats</label>
            <input type="text" class="form-control" id="seats" name="seats" value="{{$meetingRooms->seats}}" required>
          </div>
            <div class="form-group">
              <label for="info" class="form-label">Info:</label>
              <textarea class="form-control" id="info" name="info" rows="5" required>{{$meetingRooms->info}}</textarea>
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" class="form-control" id="price" name="price" value="{{$meetingRooms->hour_price}}" required>
            </div>
            <div class="form-group">
              <label for="duration">Duration</label>
              <input type="text" class="form-control" id="duration" name="duration" value="{{$meetingRooms->duration}}" required>
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
          @if ($meetingRooms->image)
          <img src="{{url($meetingRooms->image)}}" alt="Meeting Room Image" width="200px">
        @endif
          <div class="form-group">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                  <input type="checkbox" class="custom-control-input" name="status" @checked($meetingRooms->status) id="customSwitch3">
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



