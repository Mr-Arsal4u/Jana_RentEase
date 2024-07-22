<style>
    .currency-options {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .currency-options label {
        margin-right: 10px;
    }

    .success-container {
        text-align: center;
        padding: 20px;
    }

    .success-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 5px solid green;
        display: inline-block;
        margin-bottom: 10px;
    }

    .tick-icon {
        font-size: 28px;
        line-height: 40px;
        vertical-align: middle;
    }
</style>
<div class="step" id="step4">
    <h3 class="mb-3">Documents related to Property</h3>
    <div class="row g-3">
        <div class="col-md-12">
            <label for="imageUpload" class="form-label">Select Images</label>
            <p>Click on selected image to un-select it </p>
            <input type="file" name="images[]" class="form-control form-control-sm" id="imageUpload" accept="image/*"
                multiple required>
            <div id="imagePreview" class="mt-3"></div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Tell more about your Property"
                    rows="4" required></textarea>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        {{-- <button type="button" class="btn btn-primary" id="documents_next">Next</button> --}}
        <button type="button" class="btn btn-primary" id="documents_next">Save </button>
    </div>
</div>

<div style="display: none" id="success-container" class="success-container">
    <img src="https://static.vecteezy.com/system/resources/previews/009/663/249/original/tick-icon-transparent-free-png.png"
        alt="Tick" class="success-image">
    <p>Application saved successfully!</p>
</div>
