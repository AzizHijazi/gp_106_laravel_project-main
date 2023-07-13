@extends('layouts.dashboard.parent')

@section('header_title','Internet Account Edit')
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
        <h3 class="card-title">Edit Hub</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('internet_accounts.update',$internetAccountEdit->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="speed">speed :</label>
            <input type="text" class="form-control" id="speed" name="speed" value="{{$internetAccountEdit->speed}}" required>
          </div>
          <div class="form-group">
            <label for="username">User Name :</label>
            <input type="text" class="form-control" id="username" name="username" value="{{$internetAccountEdit->user_name}}" required>
          </div>
          <div class="form-group">
            <label for="password">Password :</label>
            <input type="text" class="form-control" id="password" name="password" value="{{$internetAccountEdit->password}}" required>
          </div>

            <div class="form-group">
              <label>Expired :</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" id="expired" name="expired" value="{{$internetAccountEdit->expired}}"  required/>
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <label for="user_id" class="form-label">User ID</label>
              <select class="custom-select" id="user_id" name="user_id">
                <option value="" disabled="" selected="">User Id Select</option>
                @foreach ($itemUser as $itemUser)
                <option value="{{$itemUser->id}}" {{ $itemUser->id == $internetAccountEdit->user_id ? 'selected' : '' }}>{{$itemUser->name}}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="form-group">
          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
              <input type="checkbox" class="custom-control-input" name="status" id="customSwitch3">
              <label class="custom-control-label" for="customSwitch3">Active</label>
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
