    @extends('layouts.dashboard.parent')
    @section('header_title', 'Create Order Item')
    @section('page_title', 'Create')
    @section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Order Item Create</h3>
                    </div><!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('order_items.store')}}" method="POST">
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
                                    <label for="order_type" class="form-label">Select Desk|Room Type</label>
                                    <select class="custom-select" id="order_type" name="order_item_type">
                                        <option value="" disabled>Select Desk|Room</option>
                                        <option value="desk" {{ old('order_item_type') === 'desk' ? 'selected' : '' }}>Desk</option>
                                        <option value="room" {{ old('order_item_type') === 'room' ? 'selected' : '' }}>Room</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="order_id" class="form-label">Select Desk|Room</label>
                                    <select class="custom-select" id="order_id" name="order_item_id">
                                        <option value="" disabled selected></option>
                                        <!-- Add the options dynamically based on the selected order_item_type if available -->
                                        @if (old('order_item_type') === 'desk')
                                            @foreach ($desks as $desk)
                                                <option value="{{ $desk->id }}" {{ old('order_item_id') == $desk->id ? 'selected' : '' }}>{{ $desk->desk_code }}</option>
                                            @endforeach
                                        @elseif (old('order_item_type') === 'room')
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}" {{ old('order_item_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
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
                                            <option value="{{ $order->id }}" {{ old('order_id') == $order->id ? 'selected' : '' }}>{{ $order->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="rent_type_id" class="form-label">Rent Type:</label>
                                    <select class="custom-select" id="rent_type_id" name="rent_type_id">
                                        <option value="" disabled>Select Rent Type</option>
                                        @foreach ($rentTypes as $rentType)
                                            <option value="{{ $rentType->id }}" {{ old('rent_type_id') == $rentType->id ? 'selected' : '' }}>{{ $rentType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" name="status" id="customSwitch3" {{ old('status') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch3">Active</label>
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
    var desks = {!! json_encode($desks) !!};
    var rooms = {!! json_encode($rooms) !!};
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
        }
    });
</script>
@endsection
