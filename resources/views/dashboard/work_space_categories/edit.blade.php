@extends('layouts.dashboard.parent')
@section('header_title','Edit WorkSpace Category')
@section('page_title','Edit WorkSpace Category')
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
  <hr>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6 col-md-4 col-lg-3 my-2">
      <div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Edit WorkSpace Category</h3>
  </div>
  <form action="{{route('workspace.update',$editData->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="category_name" class="form-label">WorkSpace Category Name:</label>
        <input type="text" class="form-control" name="category_name" id="category_name" value="{{$editData->name}}" required>
      </div>

      <div class="form-group">
        <!-- <label for="customFile">Custom File</label> -->
        <label for="image">Upload Image</label>
        <div class="custom-file">
          <input type="file"  id="image" name="image" class="custom-file-input" id="customFile">
          <label class="custom-file-label" class="form-label" for="customFile">Choose file</label>
        </div>
      </div>

      @if ($editData->image)
      <img src="{{url($editData->image)}}" alt="WorkSpace Category Image" width="200px">
     @endif

      <div class="form-group">
        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
          <input type="checkbox" class="custom-control-input"  name="status" id="customSwitch3" {{$editData->status ? 'checked' : ''}}>
          <label class="custom-control-label" for="customSwitch3">Available</label>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-warning">Update City</button>
    </div>
  </form>
</div>
</div>
</div>
</div>
<hr>
@endsection