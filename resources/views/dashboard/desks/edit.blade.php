@extends('layouts.dashboard.parent')

@section('header_title','Edit Desk')
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
        <h3 class="card-title">Edit Desk</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('desks.update',$editData->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">

          <div class="form-group">
            <label for="name">Desk Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$editData->name}}" required>
          </div>
          <div class="form-group">
            <label for="desk_code">Desk Number</label>
            <input type="number" class="form-control" id="desk_code" name="desk_code" value="{{$editData->desk_code}}" required>
          </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" class="form-control" id="price" name="price" value="{{$editData->price}}" required>
            </div>

            <div class="form-group">
              <label for="description">Description</label>
              <textarea type="number" class="form-control" id="description" name="description" required>{{$editData->description}}</textarea>
            </div>
          <div class="form-group">
            <label for="image">File input</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image"  accept="image/png, image/jpeg">
                <label class="custom-file-label" for="image">Choose file</label>

              </div>
              <div class="input-group-append">
                <span class="input-group-text">Upload</span>
              </div>
            </div>
          </div>
          @if ($editData->image)
          <img src="{{url($editData->image)}}" alt="Desk Image" width="200px">
        @endif
          <div class="form-group">
            <label for="desk_type_id" class="form-label">Custom Select</label>
            <select class="custom-select" id="desk_type_id" name="desk_type_id">
              <option value="" disabled="" selected="">Select Desk Type</option>
              @foreach ($desk_type as $desk_types)
              <option value="{{$desk_types->id}}" {{ $desk_types->id == $editData->desk_type_id ? 'selected' : '' }}>{{$desk_types->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                  <input type="checkbox" class="custom-control-input" name="status" @checked($editData->status) id="customSwitch3">
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



