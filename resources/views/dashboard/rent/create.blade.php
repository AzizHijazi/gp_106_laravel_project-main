@extends('layouts.dashboard.parent')
@section('header_title', 'Create Rent')
@section('page_title', 'Create')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Rent Create</h3>
                </div><!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('rent.store')}}" method="POST">
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
                            <!-- Remaining code omitted for brevity -->
                            <div class="form-group">
                                <label for="details" class="form-label">Details:</label>
                                <textarea class="form-control" id="details" name="details" rows="5" required>{{ old('details') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="price" class="form-label">Price:</label>
                                <input class="form-control" id="price" name="price"  required value="{{old('price') }}">
                            </div>
              
                            <div class="form-group">
                                <label for="order_type" class="form-label">Select Desk|Room Type|MeetingRoom</label>
                                <select class="custom-select" id="order_type" name="item_type">
                                    <option value="" disabled>Select Desk|Room|MeetingRoom</option>
                                    <option value="desk" {{ old('item_type') === 'desk' ? 'selected' : '' }}>Desk</option>
                                    <option value="room" {{ old('item_type') === 'room' ? 'selected' : '' }}>Room</option>
                                    <option value="meeting_rooms" {{ old('item_type') === 'meeting_room' ? 'selected' : '' }}>Meeting Room</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order_id" class="form-label">Select Desk|Room|MeetingRoom</label>
                                <select class="custom-select" id="order_id" name="item_id">
                                    <option value="" disabled selected></option>
                                    <!-- Add the options dynamically based on the selected order_item_type if available -->
                                    @if (old('item_type') === 'desk')
                                        @foreach ($desks as $desk)
                                            <option value="{{ $desk->id }}" {{ old('item_id') == $desk->id ? 'selected' : '' }}>{{ $desk->desk_code }}</option>
                                        @endforeach
                                    @elseif (old('item_type') === 'room')
                                        @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}" {{ old('item_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                                        @endforeach
                                    @elseif (old('item_type') === 'meeting_rooms')   
                                        @foreach ($meeting_rooms as $meeting_room)
                                        <option value="{{ $meeting_room->id }}" {{ old('item_id') == $meeting_room->id ? 'selected' : '' }}>{{ $meeting_room->name }}</option>
                                        @endforeach 
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_id" class="form-label">Select User</label>
                                <select class="custom-select" id="user_id" name="user_id">
                                    <option value="" disabled>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="start_date" class="form-label">Start Date:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="form-label">End Date:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="order_id" class="form-label">User Order:</label>
                                <select class="custom-select" id="order_id" name="order_id">
                                    <option value="" disabled>Select User Order</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->id }}" {{ old('order_id') == $order->id ? 'selected' : '' }}>{{ $order->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rent_types_id" class="form-label">Rent Type:</label>
                                <select class="custom-select" id="rent_types_id" name="rent_types_id">
                                    <option value="" disabled>Select Rent Type</option>
                                    @foreach ($rentTypes as $rentType)
                                        <option value="{{ $rentType->id }}" {{ old('rent_type_id') == $rentType->id ? 'selected' : '' }}>{{ $rentType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="pending" name="status" class="custom-control-input" value="pending" {{ old('status') == 'pending' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="pending">Pending</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="confirmed" name="status" class="custom-control-input" value="confirmed" {{ old('status') == 'confirmed' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="confirmed">Confirmed</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="canceled" name="status" class="custom-control-input" value="canceled" {{ old('status') == 'canceled' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="canceled">Canceled</label>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                    </div>
            </div><!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
</div>
<script>
    var orderTypeSelect = document.getElementById('order_type');
    var orderIdSelect = document.getElementById('order_id');

    // Assuming $desks, $rooms, and $meeting_rooms are defined and accessible in the current scope
    var desks = {!! json_encode($desks) !!};
    var rooms = {!! json_encode($rooms) !!};
    var meetingRooms = {!! json_encode($meeting_rooms) !!};

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
            option.textContent = room.name; // Modify the property name to match your actual data property
            orderIdSelect.appendChild(option);
        });
    } else if (selectedOption === 'meeting_rooms') {
        meetingRooms.forEach(function(meetingRoom) {
            var option = document.createElement('option');
            option.value = meetingRoom.id;
            option.textContent = meetingRoom.name; // Modify the property name to match your actual data property
            orderIdSelect.appendChild(option);
        });
    }
});
</script>

@endsection
