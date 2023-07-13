@extends('layouts.dashboard.parent')

@section('header_title','Edit A Meeting')
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
        <h3 class="card-title">Update a Meeting</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('meetings.update', $meetings->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="duration">Duration</label>
            <input type="text" class="form-control" id="duration" name="duration" value="{{$meetings->duration}}" required="">
          </div>

          <div class="form-group">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                  <input type="checkbox" class="custom-control-input" name="status" @checked($meetings->status) id="customSwitch3">
                  <label class="custom-control-label" for="customSwitch3">Running</label>
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



