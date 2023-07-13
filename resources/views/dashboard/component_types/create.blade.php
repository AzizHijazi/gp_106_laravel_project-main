@extends('layouts.dashboard.parent')
@section('header_title','Create Component Type')
@section('page_title','Create')
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
                    <h3 class="card-title">Create Component Type</h3>
                </div><!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('component_types.store')}}" method="POST" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="count" class="form-label">Count:</label>
                            <input type="number" class="form-control" id="count" name="count" value="{{ old('count') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Price:</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
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
                          <div class="form-group">
                            <label for="hub_id" class="form-label">Custom Select</label>
                            <select class="custom-select" id="hub_id" name="hub_id">
                              <option value="" disabled="" selected="">Select Hub</option>
                              @foreach ($hubs as $hub)
                              <option value="{{$hub->id}}">{{$hub->name}}</option>
                              @endforeach
                            </select>
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