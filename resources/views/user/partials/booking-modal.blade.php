<style>
    .form-btn {
        position: relative;
        /* display: inline-block; Ensures the button and spinner stay on the same line */
    }

    #loading-spinner {
        position: absolute;
        top: 10px;
        bottom: 50px;
        right: 15px;
        /* Adjust this value to move the spinner horizontally */
        transform: translateY(-50%);
        /* Vertically center the spinner */
        width: 30px;
        height: 30px;
        border: 2px solid rgba(0, 0, 0, 0.2);
        border-top-color: #f39c12;
        /* Color of the rotating part */
        border-radius: 50%;
        animation: spin 1s linear infinite;
        display: none;
        /* Initially hidden */
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
                    <div style="display: block" class="details-bg">
                        <div class="form-header">
                            <h2>Make your reservation</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate laboriosam numquam at
                            </p>
                        </div>
                    </div>
                    <div style="display: none" class="gallery-bg">
                        <div class="form-header">
                            <h2>Make your reservation</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate laboriosam numquam at
                            </p>
                        </div>
                    </div>
                    <form class="" id="bookingForm">
                        @csrf
                        <input type="hidden" name="property_id" id="property_id">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Name</span>
                                    <input class="form-control" id="name" name="renter_name" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Email</span>
                                    <input class="form-control" id="email" name="renter_email" type="email" required>
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
                                <input type="number" class="form-control" id="arrival_time" name="arrival_time" maxlength="2"
                                    oninput="validateTime(this)">
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


 
