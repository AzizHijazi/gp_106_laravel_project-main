@extends('layouts.dashboard.parent')
@section('header_title','Index meetings room orders')
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
          <h3 class="card-title">Meeting Room Orders</h3>
          <div class="create-btn">
            <a class="btn btn-success" href="{{route('meeting_room_orders.create')}}">إضافة</a>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Start Date</th>
                <th>End Data</th>
                <th>Category</th>
                <th>Guest </th>
                <th>Total </th>
                <th>Duration</th>
                <th>Meeting Room Name</th>
                <th>UserName</th>
                <th>Status</th> 
                <th>Operations</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
           @foreach ($meetingRoomOrders as $meetings_room_orders)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$meetings_room_orders->start_date->diffForHumans()}}</td>
                <td>{{$meetings_room_orders->end_date->diffForHumans()}}</td>
                <td>{{$meetings_room_orders->category}}</td>
                <td>{{$meetings_room_orders->guest_count}}</td>
                <td>{{$meetings_room_orders->total}}</td>
                <td>{{$meetings_room_orders->duration}}</td>
                <td>{{$meetings_room_orders->meeting_room->name}}</td>
                <td>{{$meetings_room_orders->user->name}}</td>
              <td><span>{{$meetings_room_orders->status}}</span></td>
                <td>
                  <div class="btn-group">
                    <a  href="{{route('meeting_room_orders.edit',$meetings_room_orders->id)}}" type="button" class="btn btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                      <form action="{{route('meeting_room_orders.destroy',$meetings_room_orders->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> 
                      </button>   
                    </form>
                </div>
                </td>
                <td>
                  <div class="btn-group">
                      <form action="{{ route('rent.storeConfirm', ['type_name' => 'meeting_rooms', 'id' => $meetings_room_orders->id]) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-success">
                              <i class="fas fa-check"></i>
                          </button>
                      </form>
                      
                      <form action="{{ route('rent.storeCanceled', ['type_name' => 'meeting_rooms', 'id' => $meetings_room_orders->id]) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-danger">
                              <i class="fas fa-times"></i>
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

