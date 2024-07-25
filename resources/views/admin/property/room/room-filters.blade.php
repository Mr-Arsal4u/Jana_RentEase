<div class="container mt-5">
    <div class="row justify-content-end">
        <div class="col-auto">
            <select onchange="roomFilters()" class="form-control" name="room_type" id="room_type">
                <option value="">Select Room Type</option>
                @forelse($property->roomTypes as $roomType)
                    <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                @empty
                    <option value="">No room types available</option>
                @endforelse
            </select>
        </div>
        <div class="col-auto">
            <input type="date" onchange="roomFilters()" class="form-control form-control-sm" name="from"
                id="from_date">
        </div>
        <div class="col-auto">
            <input type="date" onchange="roomFilters()" class="form-control form-control-sm" name="to"
                id="to_date">
        </div>
        <div class="col-auto">
            <input type="search" name="room_no" id="room_no" oninput="roomFilters()"
                class="form-control form-control-sm" placeholder="Search By Room no" >
        </div>
    </div>
</div>