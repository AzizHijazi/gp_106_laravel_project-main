@extends('layouts.dashboard.parent')
@section('header_title','Internet Account')
@section('page_title','Create')
@section('home_page')
{{route('home')}}
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Internet Account</h3>
                </div><!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                <form action="{{ route('internet_accounts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group">
                            <label for="speed" class="form-label">speed :</label>
                            <input type="text" class="form-control" id="speed" name="speed" value="{{ old('speed') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-label">User Name:</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password :</label>
                            <input class="form-control" type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label>Expired :</label>
                              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                  <input type="date"  class="form-control datetimepicker-input" data-target="#reservationdate" id="expired" name="expired" value="{{ old('expired') }}" required/>
                                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                          </div>
                        <div class="form-group">
                            <label for="user_id" class="form-label">User ID</label>
                            <select class="custom-select" id="user_id" name="user_id">
                              <option value="" disabled="" selected="">User Select</option>
                              @foreach ($users as $user)
                              <option value="{{$user->id}}">{{$user->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" value="{{ old('status') }}" class="custom-control-input" name="status" id="customSwitch3">
                                <label class="custom-control-label" for="customSwitch3">Active</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div><!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
</div>
@endsection