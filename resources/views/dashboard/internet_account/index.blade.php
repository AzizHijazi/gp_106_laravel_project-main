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
            <a class="btn btn-success" href="{{route('internet_accounts.create')}}">إضافة</a>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">ID</th>
                <th>Speed</th>
                <th>User Name</th>
                <th>Password</th>
                <th>Expired</th>
                <th>Active</th>
                <th>Username</th>
              </tr>
            </thead>
            <tbody>

           @foreach ($data as $data)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$data->speed}}</td>
                <td>{{$data->username}}</td>
                <td>{{$data->password}}</td>
                <td>{{$data->expired}}</td>
                <td>{{$data->visibilty}}</td>
                <td>{{$data->user->name}}</td>
                <td>
                  <div class="btn-group">
                    <a  href="{{route('internet_accounts.edit',$data->id)}}" type="button" class="btn btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                      <form action="{{route('internet_accounts.destroy',$data->id)}}" method="POST">
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

@endsection

