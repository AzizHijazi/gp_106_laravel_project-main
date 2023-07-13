@extends('layouts.dashboard.parent')

@section('header_title','Create Meeting Room Order')
@section('page_title','Meeting Room Order')
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
              <h3 class="card-title">Add Meeting Room Order</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('meeting_room_orders.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="check_in_date">Check-in Date</label>
                  <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>
              </div>
              
              <div class="form-group">
                  <label for="check_in_time">Check-in Time</label>
                  <input type="time" class="form-control" id="check_in_time" name="check_in_time" required>
              </div>
              <div class="form-group">
                  <label for="check_out_time">Check-out Time</label>
                  <input type="time" class="form-control" id="check_out_time" name="check_out_time" required>
              </div>
            <div class="form-group">
              <label for="category">category</label>
              <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required>
            </div>
                <div class="form-group">
                  <label for="seats">Seats</label>
                  <input type="number" class="form-control" id="seats" name="seats" value="{{ old('seats') }}" required>
                </div>
                <div class="form-group">
                  <label for="guest_count">Guest Count</label>
                  <input type="number" class="form-control" id="guest_count" name="guest_count" value="{{ old('guest_count') }}" required>
                </div>
                <div class="form-group">
                  <label for="duration">Duration</label>
                  <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration') }}" required>
                </div>            
                <div class="form-group">
                  <label for="total">Total</label>
                  <input type="number" class="form-control" id="total" name="total" value="{{ old('total') }}" required>
                </div>

                <div class="form-group">
                  <label for="meeting_room_id" class="form-label">Select Meeting Room</label>
                  <select class="custom-select" id="meeting_room_id" name="meeting_room_id">
                      <option value="" disabled>Select User</option>
                      @foreach ($meeting_rooms as $meeting_room)
                          <option value="{{ $meeting_room->id }}" {{ old('meeting_room') == $meeting_room->id ? 'selected' : '' }}>{{ $meeting_room->name }}</option>
                      @endforeach
                  </select>
              </div>

                <div class="form-group">
                  <label for="user_id" class="form-label">Select User</label>
                  <select class="custom-select" id="user_id" name="user_id">
                      <option value="" disabled>Select User</option>
                      @foreach ($users as $user)
                          <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                      @endforeach
                  </select>
              </div>

                  <div class="form-group">
                    <label for="status">Status:</label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="pending" name="status" class="custom-control-input" value="pending" >
                        <label class="custom-control-label" for="pending">Pending</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="confirmed" name="status" class="custom-control-input" value="confirmed" >
                        <label class="custom-control-label" for="confirmed">Confirmed</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="canceled" name="status" class="custom-control-input" value="canceled" >
                        <label class="custom-control-label" for="canceled">Canceled</label>
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