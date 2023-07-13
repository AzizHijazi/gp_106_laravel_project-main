@extends('layouts.dashboard.parent')


@section('header_title','Create Room')
@section('page_title','working Time')
@section('home_page')
  {{route('home')}}
@endsection


@section('content')

<div class="container-fluid">
  
        <div class="card card-primary">
            <div class="card-header">
              
              <h3 class="card-title">Add Working Time</h3>
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
            <form action="{{route('working_times.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="day">Day</label>
                  <input type="text" class="form-control" id="day" name="day" required="">
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="interval_type" class="form-label">Interval Type:</label>
                      <select class="form-control" id="interval_type" name="interval_type" required="">
                          <option value="" disabled="" selected="">Select Interval Type</option>
                          <option value="daily">Daily</option>
                          <option value="weekly">Weekly</option>
                          <option value="monthly">Monthly</option>
                      </select>
                  </div>
              </div>
                <div class="form-group">
                    <label for="size">Size</label>
                    <input type="number" class="form-control" id="size" name="size" required="">
                  </div>
                  <div class="form-group">
                    <label for="working-from">Working From:</label>
                    <div class="input-group date" id="working-from" data-target-input="nearest">
                      <input type="date" name="working_from" id="working-from-input" class="form-control date" data-target="#working-from" />
                      <div class="input-group-append" data-target="#working-from" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="working-to">Working To:</label>
                    <div class="input-group date" id="working-to" data-target-input="nearest">
                      <input type="date" name="working_to" id="working-to-input" class="form-control date" data-target="#working-to" />
                      <div class="input-group-append" data-target="#working-to" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
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
