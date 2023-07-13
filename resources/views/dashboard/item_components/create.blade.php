@extends('layouts.dashboard.parent')
@section('header_title','Create Order')
@section('page_title','Create')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Service</h3>
                </div><!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('orders.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                        <div class="form-group">
                            <label for="details" class="form-label">Details:</label>
                            <textarea class="form-control" id="details" name="details" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                          <div class="form-group">
                            <label for="total" class="form-label">Total:</label>
                            <input type="text" class="form-control" id="total" name="total" value="{{ old('total') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="order_type" class="form-label">Custom Select</label>
                            <select class="custom-select" id="order_type" name="order_type">
                              <option value="" disabled="" selected="">Select Item Component</option>
                              <option value="desk">Desk</option>
                              <option value="room">Room</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="order_id" class="form-label">Custom Select</label>
                            <select class="custom-select" id="order_id" name="order_id">
                              <option value="" disabled="" selected="">Select Desk</option>
                              @foreach ($desks as $desk)
                              <option value="{{$desk->id}}">{{$desk->desk_code}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                            <label for="user_id" class="form-label">Custom Select</label>
                            <select class="custom-select" id="user_id" name="user_id">
                              <option value="" disabled="" selected="">Select The User</option>
                              @foreach ($users as $user)
                              <option value="{{$user->id}}">{{$user->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="hub_id" class="form-label">Custom Select</label>
                            <select class="custom-select" id="hub_id" name="hub_id">
                              <option value="" disabled="" selected="">Select The Hub</option>
                              @foreach ($hubs as $hub)
                              <option value="{{$hub->id}}">{{$hub->name}}</option>
                              @endforeach
                            </select>
                          </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" name="status" id="customSwitch3">
                                <label class="custom-control-label" for="customSwitch3">Active</label>
                            </div>
                        </div>
                    </div>
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