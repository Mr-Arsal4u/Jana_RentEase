<div class="step active" id="step1">
    <h3 class="mb-3">Property Info</h3>
    <div class="row g-3">
        <!-- Property Number -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="property_no">Property Number</label>
                <div class="input-group">
                    <input name="property_no" id="property_no" value="{{ $property_no }}"
                        class="form-control" disabled required>
                    <span class="input-group-text">Your Property No</span>
                </div>
            </div>
        </div>

        <!-- Property Name -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="property_name">Property Name</label>
                <input type="text" name="property_name" id="property_name" class="form-control"
                    placeholder="Property name" required>
            </div>
        </div>

        <!-- Property Location -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="location">Property Location</label>
                <input type="text" name="location" id="location" class="form-control"
                    placeholder="Property Location" required>
            </div>
        </div>

        <!-- Zip Code -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="zip_code">Zip Code</label>
                <input type="number" name="zip_code" id="zip_code" class="form-control"
                    placeholder="Zip code" required>
            </div>
        </div>

        <!-- Property Area -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="area">Property Area</label>
                <div class="input-group">
                    <input type="number" name="property_area" id="property_area" class="form-control"
                        placeholder="Property area in Square feet" required>
                    <span class="input-group-text">sqft</span>
                </div>
            </div>
        </div>

        <!-- Property City -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="city">Property City</label>
                <input type="text" name="city" id="city" class="form-control"
                    placeholder="Property City" required>
            </div>
        </div>

        <!-- Country -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" class="form-control"
                    placeholder="Country" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="rooms">Total Number of Rooms</label>
                <input type="number" name="rooms" id="rooms" class="form-control" placeholder="Enter total rooms" required>
                <div id="error-message" style="color: red; display: none;">The total count of all room types must exactly match the total number of rooms.</div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" id="prevBtn"
            onclick="nextPrev(-1)">Previous</button>
        <button type="button" class="btn btn-primary" id="property_info_next">Next</button>
    </div>
</div>