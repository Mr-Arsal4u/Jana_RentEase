@extends('admin.layout.app')
@section('content')
    <div class="container p-4 rounded container-custom">
        <h2 class="text-center mb-4">Property listing Form</h2>
        <div class="mb-4">
            <div class="d-flex justify-content-between">
                <div class="step-header" id="headerStep1">Property Info</div>
                {{-- <div class="step-header" id="headerStep2">Room Types</div> --}}
                <div class="step-header" id="headerStep2">Amenities</div>
                <div class="step-header" id="headerStep3">Documents</div>
                {{-- <div class="step-header" id="headerStep4">Finishing Up</div> --}}
            </div>
        </div>
        <form id="multiStepForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="property_no" id="property_no" value="{{ $property_no }}">
            <input type="hidden" name="owner_id" id="owner_id" value="{{ auth()->user()->id ?? '1' }}">
            @include('admin.property.steps.info')
            {{-- @include('admin.property.steps.details') --}}
            @include('admin.property.steps.amenities')
            @include('admin.property.steps.documents')
            {{-- @include('admin.property.steps.fee') --}}
        </form>
    </div>
@endsection
