@extends('layouts.dashboard.parent')


@section('header_title','Create Meeting Room')
@section('page_title','Meeting Room')
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
            <form action="{{route('meetings.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                  <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration') }}" required="">
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