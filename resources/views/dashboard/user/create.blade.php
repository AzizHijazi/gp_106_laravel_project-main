@extends('layouts.dashboard.parent')


@section('header_title','Create Desk')
@section('page_title','Desks')
@section('home_page')
  {{route('home')}}
@endsection

@section('script')
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
              <h3 class="card-title">Add Desk</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('desks.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required >
                </div>
                <div class="form-group">
                  <label for="desk_code">Desk Number</label>
                  <input type="number" class="form-control" id="desk_code" name="desk_code" value="{{ old('desk_code') }}" required >
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required >
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea type="number" class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                  <!-- <label for="customFile">Custom File</label> -->
                  <label for="image">Upload Image</label>
                  <div class="custom-file">
                    <input type="file"  id="image" name="image" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" class="form-label" for="customFile">Choose file</label>
                  </div>
                </div>
                
                  <div class="form-group">
                    <label for="desk_type_id" class="form-label">Custom Select</label>
                    <select class="custom-select" id="desk_type_id" name="desk_type_id">
                      <option value="" disabled="" selected="">Select Desk Type</option>
                      @foreach ($data as $desk_type)
                      <option value="{{$desk_type->id}}">{{$desk_type->name}}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" name="status"  id="customSwitch3">
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
