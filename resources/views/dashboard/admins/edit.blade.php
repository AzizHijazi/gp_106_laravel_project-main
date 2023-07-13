@extends('layouts.dashboard.parent')


@section('header_title','Create Admins')
@section('page_title','Edit Admins')
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
          <h3 class="card-title">Edit Admins</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('admins.update',$admin->id)}}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="card-body">
            <div class="form-group">
                <label for="name" class="form-label">Name :</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$admin->name}}" required="">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$admin->email}}" required="">
            </div>
              <div class="form-group">
                <label for="mobile" class="form-label">Mobile:</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" value="{{$admin->mobile}}" required="">
              </div>
              <div class="form-group">
                <label for="gender" class="form-label">Gender :</label>
                <select class="form-control" id="gender" name="gender" required="">
                    <option value="" disabled="" selected="">Select Gender</option>
                    <option value="M" {{ $admin->interval_type == 'M' ? 'selected' : '' }}>Male</option>
                    <option value="F" {{ $admin->interval_type == 'F' ? 'selected' : '' }}>Female</option>
                </select>
              </div>
              <div class="col-md-12 mb-3">
                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input"  id="status" name="status" id="customSwitch3" @checked($admin->status)>
                    <label class="custom-control-label" for="status" >Active</label>
                </div>
            </div>
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


