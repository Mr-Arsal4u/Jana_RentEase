@extends('admin.layout.app')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-end">
            <div class="col-auto">
                <input type="date" onchange="roomFilters()" class="form-control form-control-sm" name="from"
                    id="from_date">
            </div>
            <div class="col-auto">
                <input type="date" onchange="roomFilters()" class="form-control form-control-sm" name="to"
                    id="to_date">
            </div>
            <div class="col-auto">
                <input type="search" name="room_name" id="room_name" oninput="roomFilters()"
                    class="form-control form-control-sm" placeholder="Search any room" id="searchroom">
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4>Rooms</h4>
                            {{-- <button id="addRoomButton" class="btn mb-1 btn-rounded btn-outline-primary"
                                >Add
                                Room</button> --}}

                                <a href="#" onclick="event.preventDefault(); document.getElementById('roomForm').submit();" class="btn mb-1 btn-rounded btn-outline-primary">Add Room</a>
                                {{-- <dd>{{$property->id}}</dd> --}}
                                <form id="roomForm" action="{{ route('room.create') }}" method="POST" style="display:none;">
                                    @csrf
                                    <input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}">
                                    {{-- <input type="hidden" name="roomId" value="{{ $room->id }}"> --}}
                                </form>
                                @include('admin.property.room.room-modal')
                        </div>
                        <div class="table-responsive">
                            @include('admin.property.room.room-table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



