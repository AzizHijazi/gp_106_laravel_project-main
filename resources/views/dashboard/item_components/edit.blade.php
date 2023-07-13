@extends('layouts.dashboard.parent')
@section('header_title','Edit Service')
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
          <h3 class="card-title">Edit Order</h3>
            </div>
        <form action="{{route('orders.update', $orders->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="form-group">
              <label for="details" class="form-label">Info:</label>
              <textarea class="form-control" id="details" name="details" rows="5" required>{{$orders->details}}</textarea>
            </div>
            <div class="form-group">
              <label for="total">Total:</label>
              <input type="text" class="form-control" id="total" name="total" value="{{$orders->total}}" required="">
            </div>
          <div class="form-group">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                  <input type="checkbox" class="custom-control-input" name="status" @checked($orders->status) id="customSwitch3">
                  <label class="custom-control-label" for="customSwitch3">Available</label>
              </div>
          </div>
                            <div class="form-group">
                            <label for="order_type" class="form-label">Custom Select</label>
                            <select class="custom-select" id="order_type" name="order_type">
                              <option value="" disabled="" selected="">Select Interval Type</option>
                              <option value="desk" {{ $orders->item_type === 'App\Models\Desk' ? 'selected' : '' }} >Desk</option>
                              <option value="room" {{ $orders->item_type === 'App\Models\Room' ? 'selected' : '' }} >Room</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="order_id" class="form-label">Custom Select</label>
                            <select class="custom-select" id="order_id" name="order_id">
                              <option value="" disabled="" selected="">Select Interval Type</option>
                              @foreach ($desks as $desk)
                              <option value="{{$desk->id}}"{{ $desk->id == $orders->item_id ? 'selected' : '' }} >{{$desk->desk_code}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="user_id" class="form-label">Custom Select</label>
                            <select class="custom-select" id="user_id" name="user_id">
                              <option value="" disabled="" selected="">Select Interval Type</option>
                              @foreach ($users as $user)
                              <option value="{{$user->id}}" {{ $user->id == $orders->user_id ? 'selected' : '' }}>{{$user->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="hub_id" class="form-label">Custom Select</label>
                            <select class="custom-select" id="hub_id" name="hub_id">
                              <option value="" disabled="" selected="">Select Interval Type</option>
                              @foreach ($hubs as $hub)
                              <option value="{{$hub->id}}" {{ $hub->id == $orders->hub_id ? 'selected' : '' }}>{{$hub->name}}</option>
                              @endforeach
                            </select>
                   </div>
                </div>
              </div>
                   
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
</div>
</div>
@endsection
