<style>
    .form-btn {
        position: relative;
    }

    #loading-spinner {
        position: absolute;
        top: 10px;
        bottom: 50px;
        right: 15px;
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
        border: 2px solid rgba(0, 0, 0, 0.2);
        border-top-color: #f39c12;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        display: none;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>


<div id="bookingModal" style="display: none" class="section">
    <div class="section-center">
        <div class="container">
            <div class="row">
                <div class="booking-form">
                    <div class="form-img">
                        <img class="detailsImg" src="{{ asset('modal/img/details.svg') }}" alt="">
                        <img class="galleryImg" src="{{ asset('modal/img/img.svg') }}" alt="">
                    </div>
                    <div id="details-bg" style="display: block; overflow-y: auto;" class="details-bg">
                        <div id="form-header" class="form-header">
                            <h2 id="property-name">Property Name</h2>
                            <h5 id="property-price">Price P/N:</h5>
                            <p id="property-description">Description:</p>
                            <div id="property-details" class="property-details">
                                <p id="property-location">Location: N/A, Bedrooms: N/A</p>
                                <p id="property-bathroom-area">Bathrooms: N/A, Area: N/A sq ft</p>
                                <p id="property-max-view">Max Persons: N/A, View Side: N/A</p>
                                <p id="property-location-details">City: N/A, Zip Code: N/A, Country: N/A</p>
                            </div>
                            <div id="facilities">
                                <h2>Facilities</h2>
                                <div id="amenities" class="amenities"></div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" class="gallery-bg">
                        <div class="form-header">
                            <img class=""
                                src="{{ asset(str_replace('public/', 'storage/', $property->images->first()->image)) }}"
                                alt="Property Image">
                        </div>
                    </div>

                    <div class="imageGallery" style="display: none" id="imgGallery">
                        @if ($property->images->count() > 1)
                            @foreach ($property->images->slice(1) as $image)
                                <div class="additional-image">
                                    <img src="{{ asset(str_replace('public/', 'storage/', $image->image)) }}"
                                        alt="Property Image">
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <form class="bookingForm" id="bookingForm">
                        @csrf
                        <input type="hidden" name="property_id" id="property_id">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Name</span>
                                    <input class="form-control" id="name" name="renter_name" type="text"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Email</span>
                                    <input class="form-control" id="email" name="renter_email" type="email"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Check In</span>
                                    <input class="form-control" name="check-in" type="date" id="check_in" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Check Out</span>
                                    <input class="form-control" name="check-out" id="check_out" type="date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Adults</span>
                                    <input type="number" name="adults" class="form-control" id="adults">
                                    <span class="select-arrow"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Children</span>
                                    <input type="number" name="children" class="form-control" id="children">
                                    <span class="select-arrow"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="form-label">Arrival Time</span>
                            <div class="input-with-dropdown">
                                <input type="number" class="form-control" id="arrival_time" name="arrival_time"
                                    maxlength="2" oninput="validateTime(this)">
                                <div class="dropdowns">
                                    <select id="period" name="period" class="time-select">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-btn">
                            <button type="submit" id="check-btn" class="submit-btn">Check availability</button>
                            <div id="loading-spinner"></div> <!-- Spinner element -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
