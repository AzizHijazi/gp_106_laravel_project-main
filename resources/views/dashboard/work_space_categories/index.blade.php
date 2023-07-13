@extends('layouts.dashboard.parent')

@section('header_title','Index WorkSpace Category')
@section('page_title','Index WorkSpace Category')
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
<div class="row justify-content-center px-3">
  <div class="card col-6 my-3">
    <form action="{{route('workspace.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="category_name" class="form-label">WorkSpace Category Name:</label>
        <input type="text" class="form-control" id="category_name" name="category_name" value="{{ old('category_name') }}" required>
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
        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
          <input type="checkbox" class="custom-control-input" name="status" id="customSwitch3">
          <label class="custom-control-label" for="customSwitch3">Available</label>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <button type="submit" class="btn btn-outline-success">Add Category</button>
      </div>
    </form>
  </div>
</div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 col-md-4 col-lg-12 my-2">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Workspace Category Table</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-hover text-nowrap">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th style="width: 40px">Settings</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $workspaceCategory)
                <tr>
                  <td>{{$loop->index + 1}}</td>
                  <td>{{$workspaceCategory->name}}</td>
                  <td>{{$workspaceCategory->visibility}}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{route('workspace.edit',$workspaceCategory->id)}}" type="button" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{route('workspace.destroy',$workspaceCategory->id)}}" method="POST">
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