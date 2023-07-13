@extends('layouts.dashboard.parent')
@section('header_title','Edit Order')
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
            <form action="{{ route('orders.update', $orders->id) }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
        @csrf
        <div class="card-body">
            <div class="form-group">
              <label for="total">Total:</label>
              <input type="number" class="form-control" id="total" name="total" value="{{$orders->total}}" required>
            </div>
              <div class="form-group">
                            <label for="user_id" class="form-label">Select User Name</label>
                            <select class="custom-select" id="user_id" name="user_id">
                              <option value="" disabled="" selected="">Select User Name</option>
                              @foreach ($users as $user)
                              <option value="{{$user->id}}" {{ $user->id == $orders->user_id ? 'selected' : '' }}>{{$user->name}}</option>
                              @endforeach
                            </select>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
      </form>
</div>
</div>
@endsection
