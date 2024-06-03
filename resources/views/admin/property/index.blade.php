@extends('admin.layout.app')
@section('content')
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-auto">
                <input type="date" onchange="propertyFilters()" class="form-control form-control-sm" name="from"
                    id="from_date">
            </div>
            <div class="col-auto">
                <input type="date" onchange="propertyFilters()" class="form-control form-control-sm" name="to"
                    id="to_date">
            </div>
            <div class="col-auto">
                <input type="search" name="property_name" id="property_name" oninput="propertyFilters()" class="form-control form-control-sm"
                    placeholder="Search any property" id="searchProperty">
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4>Properties</h4>
                            <a class="btn mb-1 btn-rounded btn-outline-primary" href="{{ route('properties.create') }}">Add
                                Property</a>
                        </div>
                        <div class="table-responsive">
                            <table id="properties_table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Property Name</th>
                                        <th>Description</th>
                                        <th>Location</th>
                                        <th>Price</th>
                                        <th>Property Area</th>
                                        <th>City</th>
                                        <th>Zip Code</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="properties_table_body">
                                    @forelse ($properties as $property)
                                        <tr>    
                                            <td>{{ $property->property_name }}</td>
                                            <td class="color-primary">{{ $property->description }}</td>
                                            <td>{{ $property->location }}</td>
                                            </td>
                                            <td>{{ $property->PropertyAmount->user_amount ?? '---' }},{{ $property->PropertyAmount->currency->code ?? 'none' }}
                                            </td>
                                            <td>{{ $property->area }} SQFT</td>
                                            <td>{{ $property->city }}</td>
                                            <td>{{ $property->zip_code }}</td>
                                            <td><span class="badge badge-success px-2">Active</span>
                                                {{-- <td>{{GeneralHelper::formatDate($property->created_at)}}</td> --}}
                                            {{-- <td>{{ \App\Helpers\GeneralHelper::formatDate($property->created_at) }}</td> --}}
                                            <td>{{$property->created_at->format('d F Y')}}</td>
                                            <td><span><a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="Edit"><i
                                                            class="fa fa-pencil color-muted m-r-5"></i> </a><a
                                                        href="#" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="Close"><i
                                                            class="fa fa-close color-danger"></i></a></span>
                                            </td>
                                        </tr>
                                    @empty
                                        <p >Nothing To See Here!</p>
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
