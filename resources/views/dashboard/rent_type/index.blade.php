@extends('layouts.dashboard.parent')

@section('header_title','Index Rent Type')
@section('page_title','Index Rent Type')
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
    <h3 class="card-title">Add Rent Type</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form action="{{route('rent_types.store')}}" method="POST">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
      </div>
      <div class="form-group">
        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
            <input type="checkbox" class="custom-control-input" name="status" id="customSwitch3">
            <label class="custom-control-label" for="customSwitch3">Active</label>
        </div>
    </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-success">Add Rent Type</button>
    </div>
  </form> 
</div>
</div>
</div>
<hr>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6 col-md-4 col-lg-12 my-2">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Rent Type Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Active</th>
                <th style="width: 40px">Settings</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $data)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->visibilty}}</td>
                <td>
                  <div class="btn-group">
                    <a href="{{route('rent_types.edit',$data->id)}}" type="button" class="btn btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{route('rent_types.destroy',$data->id)}}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
</div>
</div>



@endsection