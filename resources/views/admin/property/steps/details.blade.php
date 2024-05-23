<div class="step" id="step2">
    <h3 class="mb-3">Property Details</h3>
    <div class="row g-3">
        <!-- Bedrooms -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="bedrooms">Number of Bedrooms</label>
                <input type="number" name="bedrooms" id="bedrooms" class="form-control"
                    placeholder="No of Bedrooms" required>
            </div>
        </div>
        <!-- Bathrooms -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="bathrooms">Number of Bathrooms</label>
                <input maxlength="2" max="2" type="number" name="bathrooms"
                    id="bathrooms" class="form-control" placeholder="Bathrooms" required>
            </div>
        </div>
        <!-- Description -->
        <div class="col-lg-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Tell more about your Property"
                    rows="4" required></textarea>
            </div>
        </div>
        <!-- Status -->
        {{-- <div class="col-lg-6">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div> --}}
        <!-- Maximum Persons -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="max_persons">Maximum Persons</label>
                <input type="number" name="max_persons" id="max_persons" class="form-control"
                    placeholder="Maximum Persons" required>
            </div>
        </div>
        <!-- View Side -->
        <div class="col-lg-6">
            <div class="form-group">
                <label for="view_side">View Side</label>
                <input type="text" name="view_side" id="view_side" class="form-control"
                    placeholder="View Side" required>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" id="prevBtn"
            onclick="nextPrev(-1)">Previous</button>
        <button type="button" class="btn btn-primary" id="property_details_next">Next</button>
    </div>
</div>