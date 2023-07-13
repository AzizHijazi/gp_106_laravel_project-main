@extends('layouts.dashboard.parent')
@section('header_title','Edit Component')
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
                    <h3 class="card-title">Edit Component</h3>
                </div><!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('components.update',$components->id)}}" method="POST"
                    enctype="multipart/form-data">
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
                            <label for="code" class="form-label">Code:</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{$components->code}}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="notes" class="form-label">Notes:</label>
                            <textarea class="form-control" id="notes" name="notes" rows="5"
                                required>{{$components->notes}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="component_type_id" class="form-label">Custom Select</label>
                            <select class="custom-select" id="component_type_id" name="component_type_id">
                                <option value="" disabled="" selected="">Select Interval Type</option>
                                @foreach ($component_types as $component_type)
                                <option value="{{$component_type->id}}" {{ $component_type->id ==
                                    $components->component_types_id ? 'selected' : '' }}>{{$component_type->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" name="condition"
                                    @checked($components->condition) id="customSwitch3">
                                <label class="custom-control-label" for="customSwitch3">Condition</label>
                            </div>
                        </div>
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