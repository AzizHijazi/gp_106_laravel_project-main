@extends('layouts.dashboard.parent')

@section('header_title','Index Faq')
@section('page_title','Index')
@section('home_page')
{{route('home')}}
@endsection
@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="card-title">Faq Table</h3>
      <div class="create-btn">
        <a class="btn btn-success" href="{{route('faq.create')}}">إضافة</a>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Settings</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $data)
          <tr>
            <td>{{$loop->index + 1}}</td>
            <td>{{$data->question}}</td>
            <td>{{$data->answer}}</td>
            <td>
              <div class="btn-group">
                <a href="{{route('faq.edit',$data->id)}}" type="button" class="btn btn-warning">
                  <i class="fas fa-edit"></i>
                </a>
                <form action="{{route('faq.destroy',$data->id)}}" method="POST">
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