@extends('layouts.dashboard.parent')

@section('header_title','Index Rooms')
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
          <h3 class="card-title">Rooms Table</h3>
          <div class="create-btn">
            <a class="btn btn-success" href="{{route('rooms.create')}}">إضافة</a>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">ID</th>
                <th>Name</th>
                <th>Room Number</th>
                <th>Description</th>
                <th>Size</th>
                <th>Status</th>
                <th>Price</th>
                <th>Settings</th>
              </tr>
            </thead>
            <tbody>
           @foreach ($rooms as $room)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$room->name}}</td>
                <td>{{$room->room_number}}</td>
                <td>{{$room->description}}</td>
                <td><span>{{$room->size}}</span></td>
                <td>{{$room->visibilty}}</td>
                <td>{{$room->price}}</td>
                <td>
                  <div class="btn-group">
                    <a  href="{{route('rooms.edit',$room->id)}}" type="button" class="btn btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                      <form action="{{route('rooms.destroy',$room->id)}}" method="POST">
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
                        <a class="dropdown-item" href="{{route('rooms.show',$room->id)}}">Details</a>
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

