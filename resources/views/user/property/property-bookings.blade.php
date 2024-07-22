@extends('user.layouts.master')
@section('content')
    <style>
        .amenities-list {
            list-style-type: none;
            /* Remove default list styling */
            padding: 0;
            /* Remove default padding */
            margin: 0;
            /* Remove default margin */
        }

        .amenities-list li {
            margin-bottom: 10px;
            /* Add space between items */
        }

        .amenity-name {
            font-weight: bold;
            /* Make the name bold */
            display: inline-block;
            /* Aligns the name inline */
            margin-right: 5px;
            /* Add space between name and description */
        }

        .amenity-description {
            font-style: italic;
            /* Italicize the description */
            color: #555;
            /* Optional: Change color of the description */
        }
    </style>
    <style>
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control.glow {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .form-control.glow:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -5px;
            margin-left: -5px;
        }

        .form-row>.col-md-6 {
            padding-right: 5px;
            padding-left: 5px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h4>{{ $property->property_name }} </h4>
                <br>
                <h6>{{ $property->location }} <a href="https://maps.google.com">See on Google maps</a> </h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <img class="img main-image" id="mainImage"
                    src="{{ asset(str_replace('public/', 'storage/', $property->images->first()->image)) }}"
                    alt="Main Property Image" class="img-fluid">
            </div>
            <div class="col-md-6 thumbnail-container">
                <div class="row">
                    @if ($property->images->count() > 1)
                        @foreach ($property->images->slice(1) as $image)
                            <div class="col-6">
                                <img class="img thumbnail"
                                    src="{{ asset(str_replace('public/', 'storage/', $image->image)) }}" alt="Thumbnail"
                                    class="img-fluid">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <!-- Property Details Section -->
                <div class="col-md-6 mt-2">
                    <h2>Property Details</h2>
                    <p>{{ $property->description ?? 'Description not available' }}</p>
                    <p>Price P/N 1 Room:<strong>{{ $property->PropertyAmount->total_amount ?? 'Price not available' }}
                            {{ optional($property->PropertyAmount->currency)->code ?? 'Currency not available' }}</strong>
                    </p>
                    <p>City: <strong>{{ $property->city ?? 'City not available' }}</strong></p>
                    <p>Country: <strong>{{ $property->country ?? 'Country not available' }}</strong></p>
                    <p>View Side: <strong>{{ $property->view_side ?? 'View side not available' }}</strong></p>
                    <p>Zip Code: <strong>{{ $property->zip_code ?? 'Zip code not available' }}</strong></p>
                    <p>Bedrooms: <strong>{{ $property->bedrooms ?? 'Bedrooms not available' }}</strong></p>
                    <p>Bathrooms: <strong>{{ $property->bathrooms ?? 'Bathrooms not available' }}</strong></p>
                    <p>Total Rooms: <strong>{{ $property->total_rooms ?? 'Total rooms not available' }}</strong></p>
                    <p>Property Area:
                        <strong>{{ $property->area ? $property->area . ' SQFT' : 'Property area not available' }}</strong>
                    </p>
                    <p>Max guests in one room: <strong>{{ $property->max_persons ?? 'Max guests not available' }}</strong>
                    </p>
                </div>


                <!-- Form Section -->
                <div class="col-md-6 mt-2">
                    <h2>Booking Form</h2>
                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}" id="property_id">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control glow" id="name" name="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control glow" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="checkin">Check-in Date</label>
                                <input type="date" class="form-control glow" id="checkin" name="check_in" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="checkout">Check-out Date</label>
                                <input type="date" class="form-control glow" id="checkout" name="check_out" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="adults">Number of Adults</label>
                                <input type="number" class="form-control glow" id="adults" name="adults" max="0"
                                    required>
                                <div id="guests-error" style="color: red; display: none;"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="children">Number of Children</label>
                                <input type="number" class="form-control glow" id="children" max="0"
                                    name="children">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="arrival_time">Arrival Time</label>
                                <input type="time" class="form-control glow" id="arrival_time" name="arrival_time">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="rooms">Rooms</label>
                                <input type="number" class="form-control glow" id="rooms" name="rooms_booked">
                                <div id="rooms-error" style="color: red; display: none;"></div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                          
                            </div> --}}

                        <button type="submit" class="btn btn-primary">Book Now</button>
                    </form>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <h2>Facilities</h2>
            <div id="amenities" class="amenities">
                <ul class="amenities-list">
                    @forelse ($property->amenities as $amenity)
                        <li>
                            <span class="amenity-name">{{ $amenity->name }}</span>
                            <span class="amenity-description">({{ $amenity->description }})</span>
                        </li>
                    @empty

                        <p>
                            No amenities found.
                        </p>
                    @endforelse


                </ul>

            </div>
        </div>
    </div>
@endsection


<style>
    .img {
        border: 2px solid transparent;
        border-radius: 10px;
        /* Rounded corners */
        transition: border-color 0.3s, transform 0.3s;
        /* Smooth transitions */
    }

    .img:hover {
        border-color: orange;
        transform: scale(1.05);
        /* Slight zoom effect */
    }

    .main-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
        /* Apply the same rounding to the main image */
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        var today = new Date().toISOString().split('T')[0];
        $('#checkin').attr('min', today);

        $('#checkin').on('change', function() {
            var checkInDate = $(this).val();
            $('#checkout').attr('min', checkInDate);
        });

        if ($('#checkin').val()) {
            $('#checkout').attr('min', $('#checkin').val());
        }


        $('#rooms').on('change', function() {
            var selectedRooms = parseInt($(this).val());
            var totalRooms = parseInt('{{ $property->total_rooms }}');
            $('#adults').attr('max', selectedRooms);
            $('#children').attr('max', selectedRooms);

            if (selectedRooms > totalRooms) {
                $('#rooms-error').text('Selected rooms cannot exceed total rooms available').show();
            } else {
                $('#rooms-error').hide();
            }
        });

        $('#adults, #children').on('input', function() {
            var adults = parseInt($('#adults').val());
            var children = parseInt($('#children').val());
            var maxPersons = parseInt('{{ $property->max_persons }}');

            if (adults + children > maxPersons) {
                $('#guests-error').text(
                        'Total number of guests (adults + children) cannot exceed maximum allowed')
                    .show();
            } else {
                $('#guests-error').hide();
            }
        });
    });
</script>
