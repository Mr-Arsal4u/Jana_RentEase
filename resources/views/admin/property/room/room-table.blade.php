<table id="rooms_table" class="table table-striped">
    <thead>
        <tr>
            <th>Room No</th>
            <th>Room Name</th>
            <th>Description</th>
            <th>Room Type</th>
            <th>View Side</th>
            <th>Bedrooms</th>
            <th>Bathrooms</th>
            <th>Max Persons</th>
            <th>Availability Status</th>
            <th>Room Status</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="rooms_table_body">
        @forelse ($rooms as $room)
          @include('admin.property.room.room_tr')
        @empty
        <td colspan="12" class="text-center text-danger">
            <b>No Record Found</b>
        </td>
        @endforelse
    </tbody>
                       
</table>