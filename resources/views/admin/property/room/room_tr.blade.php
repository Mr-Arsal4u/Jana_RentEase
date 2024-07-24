@if (isset($room))
    <tr >
        <td>{{ $room->room_no ?? 'N/A' }}</td>
        <td>{{ $room->room_name ?? 'N/A' }}</td>
        <td class="color-primary">{!! Str::limit($room->description ?? 'null', 40) !!}</td>
        <td>{{ $room->roomType->name ?? 'N/A' }}</td>
        <td>{{ $room->view_side ?? '---' }}</td>
        <td>{{ $room->bedrooms ?? 'N/A' }}</td>
        <td>{{ $room->bathrooms ?? 'N/A' }}</td>
        <td>{{ $room->max_persons ?? 'N/A' }}</td>
        <td>{{ $room->availablity_status ?? 'N/A' }}</td>
        <td><span class="badge badge-success px-2">{{ $room->room_status ?? 'Active' }}</span></td>
        <td>{{ $room->created_at ? $room->created_at->format('j F Y') : 'N/A' }}</td>
        <td>
            <span>
                <a href="#" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil color-muted m-r-5"></i>
                </a>
                <a href="#" data-toggle="tooltip" data-placement="top" title="Close">
                    <i class="fa fa-close color-danger"></i>
                </a>
            </span>
        </td>
    </tr>
@else
    <tr>
        <td colspan="24" class="text-center text-danger">
            <b>No Record Found</b>
        </td>
    </tr>
@endif
