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
        <h3 class="card-title">Edit Item Service</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('item_services.update',$itemServiceEdit->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
          <div class="col-md-12 mb-3">
            <label for="info" class="form-label">Info:</label>
            <textarea class="form-control" id="info" name="info" rows="5" required>{{$itemServiceEdit->info}}</textarea>
        </div>
          <div class="form-group">
            <label for="count">Count :</label>
            <input type="number" class="form-control" id="count" name="count" value="{{$itemServiceEdit->count}}" required="">
          </div>
          <div class="form-group">
            <label for="hub_id" class="form-label">Hub ID</label>
            <select class="custom-select" id="hub_id" name="hub_id">
              <option value="" disabled="" selected="">Hub Select</option>
              @foreach ($itemServiceHub as $itemServiceHub)
              <option value="{{$itemServiceHub->id}}" {{ $itemServiceHub->id == $itemServiceEdit->hub_id ? 'selected' : '' }}>{{$itemServiceHub->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="service_id" class="form-label">Service ID</label>
            <select class="custom-select" id="service_id" name="service_id">
              <option value="" disabled="" selected="">Service Select</option>
              @foreach ($itemService as $itemService)
              <option value="{{$itemService->id}}" {{ $itemService->id == $itemServiceEdit->service_id ? 'selected' : '' }}>{{$itemService->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="item_type">Item Type :</label>
            <select class="form-control" id="item_type" name="item_type" required>
              <option value="" disabled>Select Item Type</option>
              <option value="primary" {{ $itemServiceEdit->item_type == 'primary' ? 'selected' : '' }}>Primary</option>
              <option value="additona" {{ $itemServiceEdit->item_type == 'additona' ? 'selected' : '' }}>Additona</option>
            </select>
          </div>
          <div class="form-group">
              <label for="cost">Cost :</label>
              <input type="text" class="form-control" id="cost" name="cost" value="{{$itemServiceEdit->cost}}" required="">
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