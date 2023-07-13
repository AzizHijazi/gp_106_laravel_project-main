@extends('layouts.dashboard.parent')
@section('header_title','Index Item Component')
@section('page_title','Index')
@section('home_page')
  {{route('home',$type)}}
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
         </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>component_id</th>
                <th>item_type</th>
                <th>Operations</th>
              </tr>
            </thead>
            <tbody>
            {{--Start foreach--}}
              @foreach ($itemComponents as $itemComponent)
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td><span>{{$itemComponent->component_id}}</span></td>
                <td>{{$itemComponent->item_type}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('item_components.edit',$itemComponent->id)}}" type="button" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{route('item_components.destroy',$itemComponent->id)}}" method="POST">
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
      </div>
    </div>
  </div>
  
@endsection

