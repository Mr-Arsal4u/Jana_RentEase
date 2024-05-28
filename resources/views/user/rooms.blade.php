@extends('user.layouts.master')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_2.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ route('index') }}">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Rooms <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Apartment Room</h1>
                </div>
            </div>
        </div>
    </section>



    <section class="ftco-section bg-light ftco-no-pt ftco-no-pb">
        <div class="container-fluid px-md-0">
            <div class="row no-gutters">
                @foreach ($properties as $property)
                    <div class="col-lg-6 mb-4 mt-4">
                        <div class="room-wrap d-md-flex">
                            <a href="#" class="img"
                                style="background-image: url('{{ asset('images/room-1.jpg') }}');"></a>
                            <div class="half left-arrow d-flex align-items-center">
                                <div class="text p-4 p-xl-5 text-center">
                                    <p class="star mb-0"><span class="fa fa-star"></span><span
                                            class="fa fa-star"></span><span class="fa fa-star"></span><span
                                            class="fa fa-star"></span><span class="fa fa-star"></span></p>

                                    <p class="mb-0"><span class="price mr-1">
                                            ${{ $property->amount->amount }}
                                        </span> <span class="per">
                                            @if ($property->amount->per_night === 1)
                                                Per Night
                                            @else
                                                Per Month
                                            @endif
                                        </span>
                                    </p>

                                    <h3 class="mb-3"><a href="rooms.html">{{ $property->property_name }}</a></h3>
                                    <ul class="list-accomodation">
                                        <li><span>Max:</span> {{ $property->max_persons }} Persons</li>
                                        <li><span>Size:</span> {{ $property->area }} m2</li>
                                        <li><span>View:</span> {{ $property->view_side }} View</li>
                                        <li><span>Bed:</span> {{ $property->bed }}</li>
                                    </ul>
                                    <p class="pt-1">
                                        <a href="#" id="propertySelect" onclick="bookingDates({{ $property->id }})" data-property-id="{{ $property->id }}"
                                            class="btn-custom px-3 py-2 view-room-details">
                                            View Room Details <span class="icon-long-arrow-right"></span>
                                        </a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    {{-- <img src="" alt=""> --}}
    {{-- <img src="{{asset('modal/img/details.svg')}}" alt="no img"> --}}
    {{-- <div id="bookingModal" style="display: none" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form">
                        <div class="form-img">
                            <img class="detailsImg" src="{{ asset('modal/img/details.svg') }}" alt="">
                            <img class="galleryImg" src="{{ asset('modal/img/img.svg') }}" alt="">
                        </div>
                        <div style="display: block" class="details-bg">
                            <div class="form-header">
                                <h2>Make your reservation</h2>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate laboriosam numquam at
                                </p>
                            </div>
                        </div>
                        <div style="display: none" class="gallery-bg">
                            <div class="form-header">
                                <h2>Make your reservation</h2>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate laboriosam numquam at
                                </p>
                            </div>
                        </div>
                        <form class="" id="" method="POST" action="{{ route('booking.store') }}">
                            @csrf
                            <input type="hidden" name="property_id" id="property_id">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Name</span>
                                        <input class="form-control" name="renter_name" type="text" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Email</span>
                                        <input class="form-control" name="renter_email" type="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Check In</span>
                                        <input class="form-control" name="check_in" placeholder="Select Check In date" type="text" id="check_in_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Check Out</span>
                                        <input class="form-control" name="check_out"  id="check_out_date" type="text" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Adults</span>
                                        <input type="number" name="adults" class="form-control" id="">
                                        <span class="select-arrow"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Children</span>
                                        <input type="number" name="children" class="form-control" id="">
                                        <span class="select-arrow"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="form-label">Arrival Time</span>
                                <div class="input-with-dropdown">
                                    <input type="number" class="form-control" name="arrival_time" maxlength="2"
                                        oninput="validateTime(this)">
                                    <div class="dropdowns">
                                        <select name="period" class="time-select">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-btn">
                                <button type="submit" class="submit-btn">Check availability</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection


