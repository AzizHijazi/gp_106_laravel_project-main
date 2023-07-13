@extends('layouts.dashboard.parent')

@section('header_title','Index Rent Services')
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
      <h3 class="card-title">Rent Services</h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Rent</th>
            <th>Item Service</th>
            <th>Settings</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $data)
          <tr>
            <td>{{$loop->index + 1}}</td>
            <td>{{$data->start_date}}</td>
            <td>{{$data->end_date}}</td>
            <td>{{$data->rent_id}}</td>
            <td>{{$data->item_service_id}}</td>
            <td>
              <div class="btn-group">
                <form action="{{route('rent_services.destroy',$data->id)}}" method="POST">
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