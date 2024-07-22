@extends('admin.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-end">
            <div class="col-auto">
                <input type="date" onchange="propertyFilters()" class="form-control form-control-sm" name="from"
                    id="from_date">
            </div>
            <div class="col-auto">
                <input type="date" onchange="propertyFilters()" class="form-control form-control-sm" name="to"
                    id="to_date">
            </div>
            <div class="col-auto">
                <input type="search" name="property_name" id="property_name" oninput="propertyFilters()"
                    class="form-control form-control-sm" placeholder="Search any property" id="searchProperty">
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4>Room Types</h4>
                            <a class="btn mb-1 btn-rounded btn-outline-primary" href="#" data-toggle="modal"
                                data-target="#addRoomsTypeModal">Add
                                Room type</a>
                        </div>
                        {{-- <dd>{{ $leftRoomsCount }}</dd> --}}
                        {{-- @dd($leftRoomsCount) --}}
                        <div class="table-responsive">
                            <table id="properties_table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Room Type Name</th>
                                        <th>Description</th>
                                        <th>Property Name</th>
                                        <th>Total Rooms </th>
                                        <th>Rooms Created</th>
                                        <th>Amount</th>

                                        {{-- <th>Status</th> --}}
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="properties_table_body">
                                    @forelse ($roomTypes as $roomType)
                                        <tr>
                                            <td>{{ $roomType->name ?? 'N/A' }}</td>
                                            <td class="color-primary">{!! Str::limit($roomType->description ?? 'null', 15) !!}</td>
                                            <td>{{ $roomType->property->property_name ?? 'N/A' }}</td>
                                            <td>{{ $roomType->room_count ?? '---' }}
                                            </td>
                                            <td>
                                                {{ $roomType->hasRooms() ? 'Yes' : 'No' }}

                                            </td>
                                            {{-- <td><span class="badge badge-success px-2">{{ $roomType->status ?? 'Active' }}</span></td> --}}
                                            <td>{{ $roomType->propertyAmounts->total_amount ?? 'Not set yet' }}</td>
                                            <td>{{ $property->created_at ? $property->created_at->format('j F Y') : 'N/A' }}
                                            </td>

                                            <td>
                                                <button class="btn btn-outline-dark dropdown-toggle" type="button"
                                                    data-toggle="dropdown" style="direction: rtl;">Actions</button>

                                                <div class="dropdown-menu" style="right: 100%; left: auto;">
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fa fa-close color-danger m-r-5"></i> Delete
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('rooms', $property->id) }}">
                                                        <i class="fa fa-eye color-info m-r-5"></i> View Rooms
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('admin.property.roomType-modal')
                                    @empty
                                        <tr>
                                            <td colspan="20">Nothing To See Here!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
