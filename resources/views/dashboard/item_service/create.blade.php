@extends('layouts.dashboard.parent')


@section('header_title','Create Room')
@section('page_title','Add Item Service')
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
              <h3 class="card-title">Add Item Service</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('item_services.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="info" class="form-label">Info :</label>
                  <textarea class="form-control" id="info" name="info" rows="5" required>{{ old('info') }}</textarea>
              </div>
                <div class="form-group">
                  <label for="count">Count :</label>
                  <input type="number" class="form-control" id="count" name="count" value="{{ old('count') }}" required="">
                </div>
                <div class="form-group">
                  <label for="hub_id" class="form-label">Hub ID</label>
                  <select class="custom-select" id="hub_id" name="hub_id">
                    <option value="" disabled="" selected="">Hub Select</option>
                    @foreach ($itemServiceHubCreate as $itemServiceHubCreate)
                    <option value="{{$itemServiceHubCreate->id}}">{{$itemServiceHubCreate->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="service_id" class="form-label">Service ID</label>
                  <select class="custom-select" id="service_id" name="service_id">
                    <option value="" disabled="" selected="">Service Select</option>
                    @foreach ($itemServiceCreate as $itemServiceCreate)
                    <option value="{{$itemServiceCreate->id}}">{{$itemServiceCreate->name}}</option>
                    @endforeach
                  </select>
                </div>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="item_type" class="form-label">Item Type :</label>
                        <select class="form-control" id="item_type" name="item_type" required="">
                            <option value="" disabled="" selected="">Item Type Select</option>
                            <option value="primary">Primary</option>
                            <option value="additona">Additona</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cost">Cost :</label>
                    <input type="number" class="form-control" id="cost" name="cost" value="{{ old('cost') }}" required="">
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