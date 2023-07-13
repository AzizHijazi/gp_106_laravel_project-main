@extends('layouts.dashboard.parent')

@section('header_title','Index Desk Types')
@section('page_title','Desk Types')
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
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card my-3">
        <div class="card-header">
          <h3 class="card-title">Add Desk Type</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('desk_types.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name:</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
              <label for="info" class="form-label">Info:</label>
              <input type="text" class="form-control" id="info" name="info" value="{{ old('info') }}" required>
            </div>
            <div class="mb-3">
              <label for="count" class="form-label">Count:</label>
              <input type="number" class="form-control" id="count" name="count" value="{{ old('count') }}" required>
            </div>
            <button type="submit" class="btn btn-success">Add Desk Type</button>
          </form>
        </div>
      </div>
</div>
</div>
</div>
   <hr>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 col-md-4 col-lg-12 my-2">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">DeskTypes Table</h3>
          </div>
  <div class="card-body">
    <table class="table table-bordered table-hover text-nowrap">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Name</th>
          <th>Info</th> 
          <th style="width: 20px">Count</th> 
          <th style="width: 20px">Settings</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($deskTypes as $deskType)
        <tr>
          <td>{{$loop->index + 1}}</td>
          <td>{{$deskType->name}}</td>
          <td>{{$deskType->info}}</td>
          <td>{{$deskType->count}}</td>
          <td>
            <div class="btn-group">
              <a href="{{route('desk_types.edit',$deskType->id)}}" type="button" class="btn btn-warning">
                <i class="fas fa-edit"></i>
              </a>
              <form action="{{route('desk_types.destroy',$deskType->id)}}" method="POST">
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
</div>
</div>
</div>
</div>
</div>
  
 @endsection