@extends('user.layouts.master')

@section('content')
    <style>
        :root {
            --black: #525252;
            --orange: #FFB000;
            --white: #F7FBFC;
            --grey: #C2C2C2;
        }

        #page {
            width: 100%;
            height: 100vh;
            background-color: whitesmoke;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #main {
            width: 43.875rem;
            height: 20.4375rem;
            background-color: var(--black);
            font-family: 'Questrial', sans-serif;
            position: relative;
            z-index: 1;
        }

        .product-container {
            width: 21.25rem;
            height: 17.1875rem;
            background-color: black;
            position: relative;
            top: -2.7rem;
            left: -4.4rem;
            overflow: hidden;
        }

        .product-container h2 {
            color: white;
            font-size: 2.5rem;
            text-align: center;
            margin-top: .5rem;
        }

        .product-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .card {
            width: 19.5rem;
            height: 13.6rem;
            background-color: var(--white);
            border-radius: .7rem;
            padding: 1.3rem 1.6rem;
            position: absolute;
            top: -2.75rem;
            right: 4.4rem;
        }

        .card:after {
            content: '';
            display: block;
            width: 17.5rem;
            height: 11rem;
            background-color: #2A2A2A;
            border-radius: .7rem;
            position: absolute;
            top: 2.7rem;
            right: -1.5rem;
            transform: rotate(8deg);
            z-index: -1;
        }

        .chip {
            width: 3rem;
            height: 2.2rem;
            margin-bottom: .7rem;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            position: relative;
        }

        form label {
            width: 100%;
            display: flex;
            flex-direction: column;
            font-size: .55rem;
            color: #C2C2C2;
            margin-top: .35rem;
        }

        form label[for=name] {
            width: 72%;
        }

        form label[for=date] {
            width: 22%;
            margin-left: 6%;
        }

        form label[for=cvc] {
            width: 15%;
            position: absolute;
            right: 7%;
            bottom: -3.9rem;
        }

        form label[for=remember] {
            width: auto;
            height: 2.8rem;
            font-size: .7rem;
            position: absolute;
            left: -1.5rem;
            bottom: -10rem;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row-reverse;
        }

        form label[for=remember] input {
            margin-right: .5rem;
            filter: invert(100%) hue-rotate(30deg) brightness(1.7);
            color: red;
            height: 1rem;
            width: 1rem;
        }

        form input {
            border: none;
            border-bottom: 1px solid var(--grey);
            outline: none;
            background-color: transparent;
            font-size: 1.1rem;
            padding: .2rem 0;
        }

        form input#cvc {
            color: white;
        }

        form button {
            height: 2.8rem;
            width: 11.8rem;
            font-size: .8rem;
            position: absolute;
            bottom: -10rem;
            left: 10rem;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        form button .fa-angle-right {
            font-size: 2rem;
            position: absolute;
            left: 72%;
        }

        .price-container {
            position: absolute;
            bottom: .6rem;
            left: 3.4rem;
            display: inline-block;
        }

        .price-container strong {
            font-size: 2.2rem;
            color: white;
        }

        .price-container small {
            font-size: 0.6rem;
            color: var(--grey);
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe client.
        var stripe = Stripe(
            'pk_test_51O9f5kDqybEGHe3SUIRpvzdWZGYIjYDYGyLmGYXCXBnPUcmI1VtgrUA5CiyzPUIJKMWikUUAgRVQ7JFJBuma4MdT00VCLHhrRH'
            );

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style
        });

        // Add an instance of the card Element into the `card-element` div.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
    
    <div id="page">

        <div id="main">
            <div class="product-container">
                <h2>{{ $property->property_name }}<sup>x</sup></h2>
                <img src="{{ asset(str_replace('public/', 'storage/', $property->images->first()->image)) }}" alt="">
            </div>
            <div class="card">
                <div class="chip">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 230 384.4 300.4" width="38" height="70">
                        <path
                            d="M377.2 266.8c0 27.2-22.4 49.6-49.6 49.6H56.4c-27.2 0-49.6-22.4-49.6-49.6V107.6C6.8 80.4 29.2 58 56.4 58H328c27.2 0 49.6 22.4 49.6 49.6v159.2h-.4z"
                            fill="rgb(237,237,237)" />
                        <path
                            d="M327.6 51.2H56.4C25.2 51.2 0 76.8 0 107.6v158.8c0 31.2 25.2 56.8 56.4 56.8H328c31.2 0 56.4-25.2 56.4-56.4V107.6c-.4-30.8-25.6-56.4-56.8-56.4zm-104 86.8c.4 1.2.4 2 .8 2.4 0 0 0 .4.4.4.4.8.8 1.2 1.6 1.6 14 10.8 22.4 27.2 22.4 44.8s-8 34-22.4 44.8l-.4.4-1.2 1.2c0 .4-.4.4-.4.8-.4.4-.4.8-.8 1.6v74h-62.8v-73.2-.8c0-.8-.4-1.2-.4-1.6 0 0 0-.4-.4-.4-.4-.8-.8-1.2-1.6-1.6-14-10.8-22.4-27.2-22.4-44.8s8-34 22.4-44.8l1.6-1.6s0-.4.4-.4c.4-.4.4-1.2.4-1.6V64.8h62.8v72.4c-.4 0 0 .4 0 .8zm147.2 77.6H255.6c4-8.8 6-18.4 6-28.4 0-9.6-2-18.8-5.6-27.2h114.4v55.6h.4zM13.2 160H128c-3.6 8.4-5.6 17.6-5.6 27.2 0 10 2 19.6 6 28.4H13.2V160zm43.2-95.2h90.8V134c-4.4 4-8.4 8-12 12.8h-122V108c0-24 19.2-43.2 43.2-43.2zm-43.2 202v-37.6H136c3.2 4 6.8 8 10.8 11.6V310H56.4c-24-.4-43.2-19.6-43.2-43.2zm314.4 42.8h-90.8v-69.2c4-3.6 7.6-7.2 10.8-11.6h122.8v37.6c.4 24-18.8 43.2-42.8 43.2zm43.2-162.8h-122c-3.2-4.8-7.2-8.8-12-12.8V64.8h90.8c23.6 0 42.8 19.2 42.8 42.8v39.2h.4z"
                            fill="rgba(0,0,0,.4)" />
                    </svg>
                </div>
                <form action="{{ route('payment.store') }}" method="POST" id="payment-form">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <label for="number">Card Number
                        <input type="text" id="number" name="card_number" placeholder="0000 - 0000 - 0000 - 0000"
                            required>
                    </label>
                    <label for="name">Name
                        <input type="text" id="name" name="card_name" placeholder="John Doe" required>
                    </label>
                    <label for="date">Valid Thru
                        <input type="text" id="date" name="valid_thru" placeholder="00/00" required>
                    </label>
                    <label for="cvc">CVC
                        <input type="text" id="cvc" name="cvc" placeholder="000" required>
                    </label>
                    <button type="submit" id="submit-button">BUY NOW</button>
                    <label for="remember">Save my information for later
                        <input type="checkbox" id="remember" name="remember">
                    </label>
                </form>

            </div>
            <div class="price-container">
                <strong>{{ $property->PropertyAmount->total_amount }},{{ $property->PropertyAmount->currency->code }}</strong>
                <small>Inc tax</small>
            </div>
        </div>
    </div>

@endsection
