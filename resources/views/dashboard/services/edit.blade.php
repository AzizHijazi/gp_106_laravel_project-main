@extends('layouts.dashboard.parent')
@section('header_title','Edit Service')
@section('page_title','Edit')
@section('home_page')
{{route('home')}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Service</h3>
                </div><!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('services.update',$editData->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value=" {{$editData->name}}" required>
                        </div>
                        <div class="form-group">
                            <label for="info" class="form-label">Info:</label>
                            <textarea class="form-control" id="info" name="info" rows="5"  required>{{$editData->info}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">File input</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose Service Image</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                              </div>
                            </div>
                          </div>
                          @if ($editData->image)
                          <img src="{{asset('storage/uploads/images/' . $editData->image)}}" alt="{{$editData->name}}" width="200px">
                      @endif
                        <div class="form-group">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" name="status" id="customSwitch3">
                                <label class="custom-control-label" for="customSwitch3">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div><!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
</div>  
@endsection


