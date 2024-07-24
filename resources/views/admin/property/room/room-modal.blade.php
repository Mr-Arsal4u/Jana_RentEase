<div class="room-container" id="roomContainer">
    <b class="text-center">Please Select a Room Type first</b>
    @forelse ($roomTypes as $room)
        {{-- <div class="room-box mt-2">
            <a href="#"
                onclick="redirectToRoomCreate('{{ route('room.create') }}', {{ $property->id }}, {{ $room->id }});">
                {{ $room->name }}
            </a>
        </div> --}}

        {{-- <script>
            function redirectToRoomCreate(route, propertyId, roomId) {
                // Construct the URL with parameters
                let url = route + '?property_id=' + propertyId + '&roomId=' + roomId;

                // Redirect to the constructed URL
                window.location.href = url;
            }
        </script> --}}

        {{-- <div class="room-box mt-2">
            <a href="#" onclick="event.preventDefault(); document.getElementById('roomForm').submit();">
                {{ $room->name }}
            </a>
        </div> --}}

        <form id="roomForm" action="{{ route('room.create') }}" method="POST" style="display:none;">
            @csrf
            {{-- <input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}">
             --}}
             <input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}">

            </form>

    @empty
        <p>No Room Types exist !</p>
    @endforelse

</div>
