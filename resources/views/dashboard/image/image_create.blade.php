@extends('layouts.dashboard.parent')


@section('header_title','Create Image')
@section('page_title','Image')
@section('home_page')
  {{route('home')}}
@endsection

@section('script')
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
              <h3 class="card-title">Add Image</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('image.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                
                  <div class="form-group">
                    <label for="gallery_id" class="form-label">Custom Select</label>
                    <select class="custom-select" id="gallery_id" name="gallery_id">
                      <option value="" disabled="" selected="">Select Gallery</option>
                      @foreach ($create as $create)
                      <option value="{{$create->id}}">{{$create->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <!-- <label for="customFile">Custom File</label> -->
                    <label for="image">Upload Image</label>
                    <div class="custom-file">
                      <input type="file"  id="image" name="image" class="custom-file-input" id="customFile">
                      <label class="custom-file-label" class="form-label" for="customFile">Choose file</label>
                    </div>
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
