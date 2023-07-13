@extends('layouts.dashboard.parent')
@section('header_title', 'Index Rent Items')
@section('page_title', 'Index')
@section('home_page')
    {{ route('home', $type) }}
@endsection
@section('style')
<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-tools {
        display: flex;
        align-items: center;
    }

    .create-btn {
        margin-left: auto;
    }
</style>
@endsection
@section('content')
    <div class="col-12">
        <ul class="nav nav-tabs" id="orderTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="confirmed-tab" data-toggle="tab" href="#confirmed" role="tab" aria-controls="confirmed" aria-selected="true">Confirmed Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="canceled-tab" data-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">Canceled Orders</a>
            </li>
        </ul>
        <div class="tab-content" id="orderTabsContent">
            <div class="tab-pane fade show active" id="confirmed" role="tabpanel" aria-labelledby="confirmed-tab">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Confirmed Orders</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rents as $rent)
                                    @if ($rent->status === 'confirmed')
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rent->details }}</td>
                                            <td>{{ $rent->status }}</td>
                                            <td>{{ $rent->price }}</td>
                                            <td>
                                                @if ($type === 'meeting_rooms')
                                                <span>{{ $rent->start_date->format('Y-m-d H:i:s') }}</span>
                                            @else
                                                <span>{{ $rent->start_date->format('Y-m-d') }}</span>
                                            @endif
                                            </td>
                                            <td>
                                                @if ($type === 'meeting_rooms')
                                                <span>{{ $rent->end_date->format('Y-m-d H:i:s') }}</span>
                                            @else
                                                <span>{{ $rent->end_date->format('Y-m-d') }}</span>
                                            @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('rent.edit', ['type_name' => $type, 'id' => $rent->id]) }}" type="button" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('rent.destroy', $rent->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Canceled Orders</h3>
                        <div class="card-tools">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="table_search" class="form-control" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rents as $rent)
                                    @if ($rent->status === 'canceled')
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rent->details }}</td>
                                            <td>{{ $rent->status }}</td>
                                            <td>{{ $rent->price }}</td>
                                            <td>
                                                @if ($type === 'meeting_rooms')
                                                <span>{{ $rent->start_date->format('Y-m-d H:i:s') }}</span>
                                            @else
                                                <span>{{ $rent->start_date->format('Y-m-d') }}</span>
                                            @endif
                                            </td>
                                            <td>
                                                @if ($type === 'meeting_rooms')
                                                <span>{{ $rent->end_date->format('Y-m-d H:i:s') }}</span>
                                            @else
                                                <span>{{ $rent->end_date->format('Y-m-d') }}</span>
                                            @endif
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('rent.edit', ['type_name' => $type, 'id' => $rent->id]) }}" type="button" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('rent.destroy', $rent->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('rent.show', ['type_name' => $type, 'id' => $rent->id]) }}">Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
