<div class="step" id="step2">
    <h3 class="mb-3">Room Type Details</h3>
   
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="rooms">Total Number of Rooms</label>
                <input type="number" name="rooms" id="rooms" class="form-control" placeholder="Enter total rooms" required>
                <div id="error-message" style="color: red; display: none;">The total count of all room types must exactly match the total number of rooms.</div>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <h5>Select Room Types and Enter Their Counts</h5>
        </div>
        {{-- @foreach ($roomTypes as $roomType)
            <div class="col-md-6">
                <div class="form-group">
                    <label for="roomType{{ $roomType->id }}" class="form-label">{{ $roomType->name }}</label>
                    <input type="number" class="form-control" id="roomType{{ $roomType->id }}" 
                           name="roomCounts[{{ $roomType->id }}]" placeholder="Enter count for {{ $roomType->name }}" 
                           value="0" min="0">
                </div>
            </div>
        @endforeach --}}
    </div>
    

    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" class="btn btn-primary" id="property_details_next">Next</button>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function validateTotalRooms() {
            let totalRooms = parseInt($('#rooms').val()) || 0;
            let totalSelectedRooms = 0;

            $('input[name^="roomCounts"]').each(function() {
                totalSelectedRooms += parseInt($(this).val()) || 0;
            });

            if (totalSelectedRooms !== totalRooms) {
                $('#error-message').show();
                return false;
            } else {
                $('#error-message').hide();
            }
            return true;
        }

        // Trigger validation only when changing room type counts
        $('input[name^="roomCounts"]').on('input', function() {
            validateTotalRooms();
        });

        // Trigger validation when navigating to the next step
        $('#property_details_next').on('click', function() {
            if (validateTotalRooms()) {
                nextPrev(1);
            }
        });
    });
</script>
