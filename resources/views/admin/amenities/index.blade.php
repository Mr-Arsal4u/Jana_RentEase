@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4>Amenities</h4>
                            <button class="btn mb-1 btn-rounded btn-outline-primary" data-toggle="modal"
                                data-target="#exampleModal" data-whatever="@mdo">Create</button>
                        </div>
                        @include('admin.amenities.modal')
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($amenities as $amenity)
                                        <tr>
                                            <td>{{ $amenity->name }}</td>
                                            <td class="color-primary">{{ $amenity->description }}</td>
                                            <td><span class="badge badge-primary px-2">Sale</span>
                                            </td>
                                            {{-- <td>{{GeneralHelper::formatDate($amenity->created_at)}}</td> --}}
                                            <td>{{ \App\Helpers\GeneralHelper::formatDate($amenity->created_at) }}</td>
                                            <td><span><a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="Edit"><i
                                                            class="fa fa-pencil color-muted m-r-5"></i> </a><a
                                                        href="{{route('amenities.delete',$amenity->id)}}" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="Close"><i
                                                            class="fa fa-close color-danger"></i></a></span>
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Nothing To See Here!</p>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
