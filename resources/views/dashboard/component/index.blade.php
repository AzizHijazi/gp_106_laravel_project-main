@extends('layouts.dashboard.parent')
@section('header_title','Index Component Type')
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
          <h3 class="card-title">Components Table</h3>
          <div class="create-btn">
            <a class="btn btn-success" href="{{route('components.create')}}">إضافة</a>
          </div>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Code</th>
                <th>Notes</th>
                <th>Condition</th>
                <th>Component Type</th>
                <th>Settings</th>
              </tr>
            </thead>
            <tbody>
           @foreach ($components as $component)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$component->code}}</td>
                <td>
                  <ul>
                      @foreach (explode("\n", $component->notes) as $note)
                          <li>{{$note}}</li>
                      @endforeach
                  </ul>
              </td>
              <td><span>{{$component->status}}</span></td>
              <td><span>{{$component->componentType->name}}</span></td>
                <td>
                  <div class="btn-group">
                    <a  href="{{route('components.edit',$component->id)}}" type="button" class="btn btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                      <form action="{{route('components.destroy',$component->id)}}" method="POST">
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

