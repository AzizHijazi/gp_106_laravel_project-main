@extends('layouts.dashboard.parent')

@section('header_title','Index Admins')
@section('page_title','Index admin')
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
          <h3 class="card-title">Admins Table</h3>
          <div class="create-btn">
            <a class="btn btn-success" href="{{route('admins.create')}}">إضافة</a>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Operations</th>
              </tr>
            </thead>
            <tbody>
           @foreach ($admins as $admins)
              <tr>
                <td>{{$admins->index + 1}}</td>
                <td>{{$admins->name}}</td>
                <td><span>{{$admins->email}}</span></td>
                <td>{{$admins->mobile}}</td>
                <td>{{$admins->gender}}</td>
                <td>{{$admins->visibilty}}</td>
                <td>
                  <div class="btn-group">
                    <a  href="{{route('admins.edit',$admins->id)}}" type="button" class="btn btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                      <form action="{{route('admins.destroy',$admins->id)}}" method="POST">
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


