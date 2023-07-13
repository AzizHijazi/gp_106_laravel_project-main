@extends('layouts.dashboard.parent')
@section('header_title','Create Order')
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
                    <h3 class="card-title">Create Service</h3>
                </div><!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('orders.store') }}" method="POST">
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
                            <label for="total" class="form-label">Total:</label>
                            <input type="number" class="form-control" id="total" name="total" required value="{{ old('total') }}">
                        </div>
                        <div class="form-group">
                            <label for="user_id" class="form-label">Select User Name</label>
                            <select class="custom-select" id="user_id" name="user_id">
                                <option value="" disabled="" selected="">Select User Name</option>
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div><!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
</div>

<script>
    document.getElementById('order_type').addEventListener('change', function() {
        var orderType = this.value;
        var deskOptions = document.getElementsByClassName('desk-option');
        var roomOptions = document.getElementsByClassName('room-option');

        if (orderType === 'desk') {
            for (var i = 0; i < deskOptions.length; i++) {
                deskOptions[i].style.display = 'block';
            }
            for (var j = 0; j < roomOptions.length; j++) {
                roomOptions[j].style.display = 'none';
            }
        } else if (orderType === 'room') {
            for (var k = 0; k < deskOptions.length; k++) {
                deskOptions[k].style.display = 'none';
            }
            for (var l = 0; l < roomOptions.length; l++) {
                roomOptions[l].style.display = 'block';
            }
        }
    });
</script>
@endsection
