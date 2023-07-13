@extends('layouts.dashboard.parent')
@section('header_title','Index Service')
@section('page_title','Index')
@section('home_page')
  {{route('home', $type)}}
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
          <h3 class="card-title">Orders Table</h3>
          <div class="card-tools d-flex justify-content-center align-items-center">
            <div class="form-inline">
              <div class="input-group input-group-sm">
                <input type="text" name="table_search" class="form-control" placeholder="Search">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="create-btn">
            <a class="btn btn-success" href="{{route('orders.create',$type)}}">إضافة</a>
          </div>
        </div>
        {{-- @if ($type == 'disk') --}}
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Details</th>
                <th>Status</th>
                <th>total</th>
                <th>type</th>
                <th>Operations</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                  <tr>
                      <td>{{$loop->index + 1}}</td>
                      <td>{{$order->item->desk_code}}</td>
                      <td>{{$order->primary_price}}</td>
                      <td><span>{{$order->price}}</span></td>
                      <td><span>{{$type}}</span></td>
                      
                      <td>
                          <div class="btn-group">
                              <a href="{{route('orders.edit',['order'=>$order->id, 'type_name'=>$type])}}" type="button" class="btn btn-warning">
                                  <i class="fas fa-edit"></i>
                              </a>
                              <form action="{{route('orders.destroy',['order'=>$order->id, 'type_name'=>$type])}}" method="POST">
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
                                      <a class="dropdown-item" href="{{route('orders.show',['order'=>$order->id, 'type_name'=>$type])}}">Details</a>
                                  </div>
                              </div>
                          </div>
                      </td>
                  </tr>
              @endforeach
            </tbody>
            </table>
        </div>
        {{-- @endif --}}
      </div>
    </div>
  </div>
@endsection

