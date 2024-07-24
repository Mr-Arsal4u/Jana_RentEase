<div class="modal fade" id="addRoomsTypeModal" tabindex="-1" role="dialog" aria-labelledby="addRoomsTypeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addRoomsTypeForm" action="{{ route('addRoomsType') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoomsTypeModalLabel">Add Rooms Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <input type="hidden" name="property_id" value="{{ $property->id }}"> --}}
                    <div class="form-group">
                        <div class="d-flex justify-content-between mb-4">
                            <span> Total Rooms of property : <b id="property_rooms_count" > {{ $property->total_rooms ?? 'no rooms' }} </b> </span>
                            {{-- <span > Rooms left for Room Type : <b id="roomTypeCount" > {{ $leftRoomsCount  ?? '0'}}</b> </span> --}}
                        </div>
                        <label for="room_type_name">Room Type Name</label>
                        <input type="text" class="form-control" id="room_type_name" name="room_type_name" required>
                    </div>
                    {{-- <div class="form-group">
                        <label for="room_type_name">Rooms Count</label>
                        <input type="number" class="form-control" id="rooms_count" name="rooms_count" required>
                        <span id="error-message" style="display: none" class="text-danger mt-1"></span>
                    </div> --}}
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="room_type_description" name="room_type_description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // var leftRoomsCounts = json_encode($leftRoomsCount);
    
    var leftRoomsCounts = <?php echo json_encode($leftRoomsCount); ?>;
    
</script>
