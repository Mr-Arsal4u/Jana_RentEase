@extends('admin.layout.app')
@section('content') 
    <div class="container mt-3">
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
                <input type="search" name="property_name" id="property_name" oninput="propertyFilters()"
                    class="form-control form-control-sm" placeholder="Search any property" id="searchProperty">
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
                                        <th>Property No</th>
                                        <th>Property Name</th>
                                        <th>Description</th>
                                        <th>Location</th>
                                        <th>Total Rooms (R/C)</th>
                                        <th>Property Area</th>
                                        <th>City</th>
                                        <th>Zip Code</th>
                                        <th>Application Status</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="properties_table_body">
                                    @forelse ($properties as $property)
                                      @include('admin.property.table')
                                        @include('admin.property.roomType-modal')
                                    @empty
                                    <td colspan="12" class="text-center text-danger">
                                        <b>No Record Found</b>
                                    </td>
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
