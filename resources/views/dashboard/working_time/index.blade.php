@extends('layouts.dashboard.parent')
@section('header_title','Index Working Time')
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
          <h3 class="card-title">Working Time</h3>
          <div class="create-btn">
            <a class="btn btn-success" href="{{route('working_times.create')}}">إضافة</a>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Day</th>
                <th>Status</th>
                <th>Interval Type</th>
                <th>Working From</th>
                <th>Working To</th>
                <th>Operations</th>
              </tr>
            </thead>
            <tbody>

           @foreach ($data as $workingTime)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$workingTime->day}}</td>
                <td>{{$workingTime->visibilty}}</td>
                <td>{{$workingTime->interval_type}}</td>
                <td>{{$workingTime->working_from}}</td>
                <td>{{$workingTime->working_to}}</td>
                <td>
                  <div class="btn-group">
                    <a  href="{{route('working_times.edit',$workingTime->id)}}" type="button" class="btn btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                      <form action="{{route('working_times.destroy',$workingTime->id)}}" method="POST">
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

