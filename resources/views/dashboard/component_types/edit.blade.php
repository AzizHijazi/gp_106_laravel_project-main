@extends('layouts.dashboard.parent')
@section('header_title','Edit Component Type')
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
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Component Type</h3>
                </div><!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('component_types.update',$componentTypes->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
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
                            <input type="text" class="form-control" id="name" name="name" value="{{$componentTypes->name}}" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="5"  required>{{$componentTypes->description}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="count" class="form-label">Count:</label>
                            <input type="number" class="form-control" id="count" name="count"  value="{{$componentTypes->count}}" required>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Price:</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{$componentTypes->price}}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">File input</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/png, image/jpeg">
                                <label class="custom-file-label" for="image">Choose Service Image</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                              </div>
                            </div>
                          </div>
                          @if ($componentTypes->image)
                          <img src="{{$componentTypes->image}}" alt="{{$componentTypes->name}}" width="200px">
                          @endif
                          <div class="form-group">
                            <label for="hub_id" class="form-label">Custom Select</label>
                            <select class="custom-select" id="hub_id" name="hub_id">
                              <option value="" disabled="" selected="">Select Interval Type</option>
                              @foreach ($hubs as $hub)
                              <option value="{{$hub->id}}" {{ $hub->id == $componentTypes->hub_id ? 'selected' : '' }}>{{$hub->name}}</option>
                              @endforeach
                            </select>
                          </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

