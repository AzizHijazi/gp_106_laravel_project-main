@extends('layouts.dashboard.parent')

@section('header_title','Index Hub')
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
          <h3 class="card-title">Hubs Table</h3>
          <div class="create-btn">
            <a class="btn btn-success" href="{{route('hubs.create')}}">إضافة</a>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Mobile</th>
                <th>Interval type</th>
                <th>Operations</th>
              </tr>
            </thead>
            <tbody>
           @foreach ($hubs as $hub)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$hub->name}}</td>
                <td><span>{{$hub->description}}</span></td>
                <td>{{$hub->mobile}}</td>
                <td>{{$hub->interval_type}}</td>
                <td>
                  <div class="btn-group">
                    <a  href="{{route('hubs.edit',$hub->id)}}" type="button" class="btn btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                      <form action="{{route('hubs.destroy',$hub->id)}}" method="POST">
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
                        <a class="dropdown-item" href="{{route('hubs.show',$hub->id)}}">Details</a>
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

