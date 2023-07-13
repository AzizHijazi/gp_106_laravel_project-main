@extends('layouts.dashboard.parent')
@section('header_title', 'Index Order Items')
@section('page_title', 'Index')
@section('home_page')
    {{ route('home', $type) }}
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
                <h3 class="card-title">Order Item Table</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Operations</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        {{-- Start foreach --}}

                        @foreach ($orderItems as $order)
                        @if ($order->status !== 'confirmed' && $order->status !== 'canceled')
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$order->details}}</td>
                            <td>{{$order->status}}</td>
                            <td><span>{{$order->price}}</span></td>
                            <td><span>{{$order->start_date}}</span></td>
                            <td><span>{{$order->end_date}}</span></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('order_items.edit', ['type_name' => $type, 'id' => $order->id]) }}" type="button"
                                        class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('order_items.destroy', $order->id) }}" method="POST">
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
                                    <form action="{{ route('rent.storeConfirm', ['type_name' => $type, 'id' => $order->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('rent.storeCanceled', ['type_name' => $type, 'id' => $order->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                        {{-- END foreach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
