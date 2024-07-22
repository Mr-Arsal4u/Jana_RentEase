@extends('admin.layout.app')
@section('content')
    <div class="container">
        <div class="row justify-content-end mb-10 mt-3">
            <div class="col-auto">
                <a class="btn btn-rounded btn-outline-secondary" href="{{ url()->previous() }}">Back to Rooms</a>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-center"> --}}

        <div class="row justify-content-center">
            <div class="col col-lg-8">
                <div class="main">
                    <form action="#" class="form" id="forms" onsubmit="event.preventDefault()">
                        {{-- <input type="hidden" name="room_type_id" id="room_type_id" value="{{ $roomType->id }}"> --}}
                        <input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}">
                        <div class="progressbar">
                            <div class="progress" id="progress"></div>
                            <div class="progress-step progress-step-active" data-title="Account"></div>
                            <div class="progress-step" data-title="Social"></div>
                            <div class="progress-step" data-title="Personal"></div>
                        </div>
                        <div class="step-forms step-forms-active">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="room_no">Rooms Count</label>
                                        <input type="number" class="form-control" id="rooms_count" name="rooms_count"
                                            value="" placeholder="Rooms to be created against Room Type">
                                        <label for="text"></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="room_type">Room Type</label>
                                        <select class="form-control" id="room_type_id" name="room_type_id">
                                            @forelse($roomTypes as $roomType)
                                                <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                            @empty
                                                <option value="">Please go back and Create a room type first</option>
                                            @endforelse

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="room_name">Room Name</label>
                                        <input type="text" class="form-control" id="room_name" name="room_name"
                                            placeholder="Enter Room Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="room_status">Room Status</label>
                                        <select class="form-control" id="room_status" name="room_status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="view_side">View Side</label>
                                        <input type="text" class="form-control" id="view_side" name="view_side"
                                            placeholder="Enter View Side">
                                    </div>
                                </div>
                            </div>
                            <div class="group-inputs">
                                <label for="room_description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Room Description"></textarea>
                            </div>
                            <div class="btns-group">
                                <a href="#" class="btn btn-prev">Previous</a>
                                <a href="#" id="RoomDetails" class="btn btn-next">Next</a>
                            </div>
                        </div>
                        <div class="step-forms">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="bedrooms">Bedrooms</label>
                                        <input type="number" class="form-control" id="bedrooms" name="bedrooms"
                                            placeholder="Enter Number of Bedrooms" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="bathrooms">Bathrooms</label>
                                        <input type="number" class="form-control" id="bathrooms" name="bathrooms"
                                            placeholder="Enter Number of Bathrooms" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="room_size">Room Size SQFT</label>
                                        <input type="number" class="form-control" id="room_size" name="room_size"
                                            placeholder="Enter Room Size in square feet" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="max_persons">Max Persons</label>
                                        <input type="number" class="form-control" id="max_persons" name="max_persons"
                                            placeholder="Enter Maximum Persons" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="availablity_status">Availability Status</label>
                                        <select class="form-control" id="availablity_status" name="availablity_status">
                                            <option value="Available">Available</option>
                                            <option value="Not available">Not Available</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="btns-group">
                                <a href="#" class="btn btn-prev">Previous</a>
                                <a href="#" id="extra_room_info" class="btn btn-next">Next</a>
                            </div>
                        </div>
                        <div class="step-forms">


                            <div class="row">
                                <div class="form-group">
                                    <label>Please Select Desired Currency for Property</label>
                                    <div class="currency-options">
                                        @foreach ($currencies as $currency)
                                            <div class="form-check form-check-inline currency">
                                                <input class="form-check-input" type="radio" name="currency"
                                                    id="currency{{ $currency->id }}" value="{{ $currency->id }}" required>
                                                <label class="form-check-label"
                                                    for="currency{{ $currency->id }}">{{ $currency->code }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-12" id="feeDiv" style="display: none">
                                    <div class="form-group">
                                        <label for="room_price">Room Price Per night</label>
                                        <input type="number" oninput="loadFee()" class="form-control" id="room_price"
                                            name="room_price" placeholder="Enter Room Price" required>
                                    </div>
                                    <div id="contract-container">

                                    </div>
                                </div>
                            </div>
                            <div class="btns-group">
                                <a href="#" class="btn btn-prev">Previous</a>
                                <input type="submit" value="Submit" id="submit-form" class="btn" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
