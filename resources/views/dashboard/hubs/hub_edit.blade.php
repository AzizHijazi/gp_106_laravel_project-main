@extends('layouts.dashboard.parent')

@section('header_title','Hub Edit')
@section('page_title','Edit')
@section('home_page')
  {{route('home')}}
@endsection 
@section('content')
<div class="container-fluid">
  <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Hub</h3>
      </div>
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
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('hubs.update',$hubs->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$hubs->name}}" required>
          </div>
          <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" id="location" name="location" value="{{$hubs->location}}" required>
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter description" required>{{$hubs->description}}</textarea>
            </div>
            <div class="form-group">
              <label for="mobile">Mobile:</label>
              <input type="tel" class="form-control" id="mobile" name="mobile" value="{{$hubs->mobile}}" required>
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
          @if ($hubs->image)
              <img src="{{url($hubs->image)}}" alt="{{$hubs->name}}" width="200px">
          @endif

          <div class="form-group">
              <label for="image">File input</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="cover_image">
                  <label class="custom-file-label" for="image">Choose Cover Image</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text">Upload</span>
                </div>
              </div>
            </div>
            @if ($hubs->cover_image)
            <img src="{{url($hubs->cover_image)}}" alt="{{$hubs->name}}" width="200px">
        @endif
            <div class="form-group">
              <label for="interval_type" class="form-label">Interval Type:</label>
              <select class="form-control" id="interval_type" name="interval_type" required>
                <option value="" disabled>Select Interval Type</option>
                <option value="daily" {{ $hubs->interval_type == 'daily' ? 'selected' : '' }}>Daily</option>
                <option value="weekly" {{ $hubs->interval_type == 'weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="monthly" {{ $hubs->interval_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
              </select>
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
