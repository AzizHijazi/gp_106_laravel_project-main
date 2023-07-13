@extends('layouts.dashboard.parent')
@section('header_title', 'Edit Order Item')
@section('page_title', 'Edit')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Order Item Edit</h3>
                </div><!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('rent.update', ['id' => $item->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="order_type" class="form-label">Select Desk|Room Type|MeetingRoom</label>
                                <select class="custom-select" id="order_type" name="item_type">
                                    <option value="" disabled>Select Desk|Room</option>
                                    <option value="desk" {{ old('item_type', $item->item_type === 'App\Models\Desk' ? 'selected' : '') }}>Desk</option>
                                    <option value="room" {{ old('item_type', $item->item_type === 'App\Models\Room' ? 'selected' : '') }}>Room</option>
                                    <option value="meeting_rooms" {{ old('item_type', $item->item_type === 'App\Models\MeetingRoom' ? 'selected' : '') }}>Meeting Room</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price" class="form-label">Price:</label>
                                <input class="form-control" id="price" name="price"  required value="{{old('price',$item->price)}}">
                            </div>
                            <div class="form-group">
                                <label for="order_id" class="form-label">Select Desk|Room|MeetingRoom</label>
                                <select class="custom-select" id="order_id" name="item_id">
                                    <option value="" disabled selected></option>
                                    @if ($item->item_type === 'App\Models\Desk')
                                        @foreach ($desks as $desk)
                                            <option value="{{ $desk->id }}" {{ old('item_id', $item->item_id) == $desk->id ? 'selected' : '' }}>{{ $desk->desk_code }}</option>
                                        @endforeach
                                    @elseif ($item->item_type === 'App\Models\Room')
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}" {{ old('item_id', $item->item_id) == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                                        @endforeach 
                                    @elseif ($item->item_type === 'App\Models\MeetingRoom')
                                        @foreach ($meetingRooms as $meetingRoom)
                                            <option value="{{ $meetingRoom->id }}" {{ old('item_id', $item->item_id) == $meetingRoom->id ? 'selected' : '' }}>{{ $meetingRoom->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="user_id" class="form-label">Select User</label>
                                <select class="custom-select" id="user_id" name="user_id">
                                    <option value="" disabled>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id', $item->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_date" class="form-label">Start Date:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $item->start_date) }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="form-label">End Date:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $item->end_date) }}">
                            </div>
                            <div class="form-group">
                                <label for="order_id" class="form-label">User Order:</label>
                                <select class="custom-select" id="order_id" name="order_id">
                                    <option value="" disabled>Select User Order</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->id }}" {{ old('order_id', $item->order_id) == $order->id ? 'selected' : '' }}>{{ $order->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rent_type_id" class="form-label">Rent Type:</label>
                                <select class="custom-select" id="rent_type_id" name="rent_type_id">
                                    <option value="" disabled>Select Rent Type</option>
                                    @foreach ($rentTypes as $rentType)
                                        <option value="{{ $rentType->id }}" {{ old('rent_type_id', $item->rent_type_id) == $rentType->id ? 'selected' : '' }}>{{ $rentType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="pending" name="status" class="custom-control-input" value="pending" {{ old('status', $item->status) == 'pending' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pending">Pending</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="confirmed" name="status" class="custom-control-input" value="confirmed" {{ old('status', $item->status) == 'confirmed' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="confirmed">Confirmed</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="canceled" name="status" class="custom-control-input" value="canceled" {{ old('status', $item->status) == 'canceled' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="canceled">Canceled</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
var orderTypeSelect = document.getElementById('order_type');
var orderIdSelect = document.getElementById('order_id');
var desks = {!! json_encode($desks) !!};
var rooms = {!! json_encode($rooms) !!};
var meetingRooms = {!! json_encode($meetingRooms) !!};

orderTypeSelect.addEventListener('change', function() {
    var selectedOption = orderTypeSelect.options[orderTypeSelect.selectedIndex].value;
    orderIdSelect.innerHTML = ""; // Clear previous options

    if (selectedOption === 'desk') {
        desks.forEach(function(desk) {
            var option = document.createElement('option');
            option.value = desk.id;
            option.textContent = desk.desk_code;
            orderIdSelect.appendChild(option);
        });
    } else if (selectedOption === 'room') {
        rooms.forEach(function(room) {
            var option = document.createElement('option');
            option.value = room.id;
            option.textContent = room.name;
            orderIdSelect.appendChild(option);
        });
    } else if (selectedOption === 'meeting_rooms'){
        meetingRooms.forEach(function(meetingRoom) {
            var option = document.createElement('option');
            option.value = meetingRoom.id;
            option.textContent = meetingRoom.name;
            orderIdSelect.appendChild(option);
        });
    }
});
</script>
@endsection
