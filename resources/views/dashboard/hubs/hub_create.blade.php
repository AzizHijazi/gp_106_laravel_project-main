@extends('layouts.dashboard.parent')


@section('header_title','Create Hub')
@section('page_title','Create')
@section('home_page')
  {{route('home')}}
@endsection

@section('content')

<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add Hub</h3>
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
        <form action="{{ route('hubs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="card-body">
            <div class="form-group">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required="">
            </div>
            <div class="form-group">
              <label for="email" class="form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required="">
          </div>
          <div class="form-group">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required="">
        </div>
            <div class="form-group">
                <label for="location" class="form-label">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required="">
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="5" required="">{{ old('description') }}</textarea>
              </div>
              <div class="form-group">
                <label for="mobile" class="form-label">Mobile:</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" required="">
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
              <div class="form-group">
                <label for="interval_type" class="form-label">Interval Type:</label>
                <select class="form-control" id="interval_type" name="interval_type" required="">
                    <option value="" disabled="" selected="">Select Interval Type</option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
              </div>
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


