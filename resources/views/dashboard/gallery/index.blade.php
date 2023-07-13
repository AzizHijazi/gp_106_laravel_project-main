@extends('layouts.dashboard.parent')

@section('header_title','Index Gallery')
@section('page_title','Index Gallery')
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
    <form action="{{route('gallery.store')}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="name" class="form-label">Gallery Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('gallery') }}" required>
      </div>

      
      <div class="col-md-6 mb-3">
        <button type="submit" class="btn btn-outline-success">Add Gallery</button>
      </div>
    </form>
  </div>
</div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 col-md-4 col-lg-12 my-2">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Gallery Table</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-hover text-nowrap">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Hub</th>
                  <th style="width: 40px">Settings</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $data)
                <tr>
                  <td>{{$loop->index + 1}}</td>
                  <td>{{$data->name}}</td>
                  <td>{{$data->hub_id}}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{route('gallery.edit',$data->id)}}" type="button" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{route('gallery.destroy',$data->id)}}" method="POST">
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