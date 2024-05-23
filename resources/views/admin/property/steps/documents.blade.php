<div class="step" id="step4">
    <h3 class="mb-3">Documents related to Property</h3>
    <div class="row g-3">
        <div class="col-md-12">
                <label for="imageUpload" class="form-label">Select Images</label>
                <p>Click on selected image to un-select it </p>
                <input type="file" name="images[]" class="form-control form-control-sm"
                    id="imageUpload" accept="image/*" multiple>
                <div id="imagePreview" class="mt-3"></div> 
        </div>
    </div>
    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" id="prevBtn"
            onclick="nextPrev(-1)">Previous</button>
        <button type="button" class="btn btn-primary" id="documents_next">Next</button>
    </div>
</div>

