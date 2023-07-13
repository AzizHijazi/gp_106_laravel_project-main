@extends('layouts.dashboard.parent')

@section('header_title','Edit Faq')
@section('page_title','Edit')
@section('home_page')
  {{route('home')}}
@endsection 
@section('content')
@if ($errors->any())
<div class="card-body">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
      </div>
    </div>
@endif
<div class="container-fluid">
  <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Faq</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('faq.update',$editData->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">

          <div class="form-group">
            <label for="question">Question :</label>
            <input type="text" class="form-control" id="question" name="question" value="{{$editData->question}}" required>
          </div>
          <div class="form-group">
            <label for="answer">Answer :</label>
            <input type="text" class="form-control" id="answer" name="answer" value="{{$editData->answer}}" required>
          </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
</div>
@endsection



