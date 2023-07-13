@extends('layouts.dashboard.parent')

@section('header_title','Edit Working Time')
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
        <h3 class="card-title">Edit Working Time</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('working_times.update',$WorkingTimeEdit->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="day">Day</label>
            <input type="text" class="form-control" id="day" name="day" value="{{$WorkingTimeEdit->day}}" required="">
          </div>
          <div class="form-group">
            <label for="interval_type">Interval Type:</label>
            <select class="form-control" id="interval_type" name="interval_type" required>
              <option value="" disabled>Select Interval Type</option>
              <option value="daily" {{ $WorkingTimeEdit->interval_type == 'daily' ? 'selected' : '' }}>Daily</option>
              <option value="weekly" {{ $WorkingTimeEdit->interval_type == 'weekly' ? 'selected' : '' }}>Weekly</option>
              <option value="monthly" {{ $WorkingTimeEdit->interval_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
            </select>
          </div>
          <div class="form-group">
              <label for="working_from">Working From</label>
              <input type="date" class="form-control" id="working_from" name="working_from" value="{{$WorkingTimeEdit->working_from}}" required="">
            </div>
            <div class="form-group">
              <label for="working_to">Working To</label>
              <input type="date" class="form-control" id="c" name="working_to" value="{{$WorkingTimeEdit->working_to}}" required="">
            </div>
            
          <div class="form-group">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                  <input type="checkbox" class="custom-control-input" name="status" @checked($WorkingTimeEdit->status) id="customSwitch3">
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