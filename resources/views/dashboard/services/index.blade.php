@extends('layouts.dashboard.parent')
@section('header_title','Index Service')
@section('page_title','Index')
@section('home_page')
  {{route('home')}}
@endsection
@section('style')
<style>
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .card-tools {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .create-btn {
    margin-left: auto;
  }
  </style>
@endsection
@section('content')
  <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">Services Table</h3>
          <div class="create-btn">
            <a class="btn btn-success" href="{{route('services.create')}}">إضافة</a>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">ID</th>
                <th>Name</th>
                <th>Info</th>
                <th>Status</th>
                <th>Operations</th>
              </tr>
            </thead>
            <tbody>

           @foreach ($data as $service)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$service->name}}</td>
                <td>{{$service->info}}</td>
                <td><span>{{$service->visibilty}}</span></td>
                <td>
                  <div class="btn-group">
                    <a  href="{{route('services.edit',$service->id)}}" type="button" class="btn btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                      <form action="{{route('services.destroy',$service->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> 
                      </button>   
                    </form>
                  <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{route('services.show',$service->id)}}">Details</a>
                    </div>
                  </div>
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

@endsection

