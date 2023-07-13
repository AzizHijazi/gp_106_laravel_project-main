@extends('layouts.dashboard.parent')
@section('header_title','Index Service')
@section('page_title','Index')
@section('home_page')
{{route('home')}}
@endsection
@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title">Orders Table</h3>
      <div class="create-btn">
        <a class="btn btn-success" href="{{route('orders.create')}}">إضافة</a>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-bordered table-hover text-nowrap">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Status</th>
            <th>total</th>
            <th>Operations</th>
          </tr>
        </thead>
        <tbody>
          {{--Desk--}}
          {{--Start If--}}
          @foreach ($orders as $order)
          <tr>
            <td>{{$loop->index + 1}}</td>
            <td>{{$order->user->name}}</td>
            <td>{{$order->total}}</td>
            <td>
              <div class="btn-group">
                <a href="{{ route('orders.edit',$order->id)}}" type="button" class="btn btn-warning">
                  <i class="fas fa-edit"></i>
              </a>
                <form action="{{route('orders.destroy',$order->id)}}" method="POST">
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
          {{--END foreach--}}
        </tbody>
      </table>
    </div>
    {{-- @endif --}}
  </div>
</div>
</div>

@endsection