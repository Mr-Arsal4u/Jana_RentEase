<div class="step" id="step3">
    <h3 class="mb-3">Please Select Amenities in your property</h3>
    <div class="container">
        <div class="row g-3">
            @foreach ($amenities as $index => $amenity)
                <div class="col-md-6">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-check mt-2">

                                <input value="{{ $amenity->id }}"
                                    class=" rounded-checkbox amenity-checkbox" type="checkbox"
                                    id="amenity_{{ $amenity->id }}" name="amenity_{{ $amenity->id }}">

                                <label class="form-check-label" for="amenity_{{ $amenity->id }}">
                                    {{ $amenity->name }} ({{ $amenity->description }})
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($index % 2 != 0 && count($amenities) > 1)
                    <div class="w-100"></div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" class="btn btn-primary" id="amenities_next">Next</button>
    </div>

</div>

