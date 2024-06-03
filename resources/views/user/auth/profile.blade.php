@extends('user.layouts.master')

@section('content')
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <h5>{{ __('User Information') }}</h5>
                        <p><strong>{{ __('Name') }}:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>{{ __('Email') }}:</strong> {{ Auth::user()->email }}</p>

                        <h5 class="mt-4">{{ __('Bookings') }}</h5>
                        @if (Auth::user()->bookings ->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Booking ID') }}</th>
                                        <th>{{ __('Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Auth::user()->bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->id }}</td>
                                            <td>{{ $booking->date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>{{ __('No bookings yet.') }}</p>
                        @endif

                        <div class="mt-4">
                            <h5>{{ __('Update Profile') }}</h5>
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
