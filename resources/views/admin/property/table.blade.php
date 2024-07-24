@if (isset($property))
<tr>
    <td>{{ $property->property_no ?? 'N/A' }}</td>
    <td>{{ $property->property_name ?? 'N/A' }}</td>
    <td class="color-primary">{!! Str::limit($property->description ?? 'null', 15) !!}</td>
    <td>{{ $property->location ?? 'N/A' }}</td>
    <td>{{ $property->total_rooms ?? '---' }}
        ({{ $property->rooms->count() ?? 'N/A' }} Created)
    </td>
    <td>{{ $property->property_area ? $property->property_area . ' SQFT' : 'N/A' }}
    </td>
    <td>{{ $property->city ?? 'N/A' }}</td>
    <td>{{ $property->zip_code ?? 'N/A' }}</td>
    <td>{{ $property->application_status ?? 'N/A' }}</td>
    <td><span
            class="badge badge-success px-2">{{ $property->status ?? 'Active' }}</span>
    </td>
    <td>{{ $property->created_at ? $property->created_at->format('j F Y') : 'N/A' }}
    </td>

    <td>
        <button class="btn btn-outline-dark dropdown-toggle" type="button"
            data-toggle="dropdown" style="direction: rtl;">Actions</button>

        <div class="dropdown-menu" style="right: 100%; left: auto;">
            <a class="dropdown-item" href="#">
                <i class="fa fa-pencil color-muted m-r-5"></i> Edit
            </a>
            <a class="dropdown-item delete-property" href="#" data-id="{{ $property->id }}">
                <i class="fa fa-close color-danger m-r-5"></i> Delete
            </a> 
            <a class="dropdown-item" href="{{ route('rooms', $property->id) }}">
                <i class="fa fa-eye color-info m-r-5"></i> View Rooms
            </a>
            <a class="dropdown-item" href="{{ route('room.types', $property->id) }}">
                {{-- <i class="fa fa-eye color-info m-r-5"></i> View Room Types --}}
                <i class="fa fa-list color-info m-r-5"></i> View Room Types
            </a>
            {{-- <div role="separator" class="dropdown-divider"></div> --}}
            <a class="dropdown-item" id="add_room_type" href="#" data-toggle="modal" data-id="{{$property->id}}" data-target="#addRoomsTypeModal">
                <i class="fa fa-plus color-success m-r-5"></i> Add Rooms Type
            </a>
        </div>
    </td>
</tr>
@else
    
<tr>
    <td colspan="12" class="text-center text-danger">
        <b>No Record Found</b>
    </td>
</tr>

@endif