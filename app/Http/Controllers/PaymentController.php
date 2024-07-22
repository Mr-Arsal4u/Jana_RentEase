<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Booking;
use App\Models\Property;
use Stripe\Subscription;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function payment($booking_id)
    {
        // dd('here');
        // $property = Property::with('images','bookings')->find($property_id);
        $booking = Booking::with('property','user')->find($booking_id);
        // dd($property);

        return view('user.payment', compact('booking'));
        // return view('user.email.test-pay');
    }

    public function createPayment(Request $request)
    {
        // dd($request->all());
        // dd($request->amount);
        try {
            // dd($request->stripeToken);
            \Stripe\Stripe::setApiKey('sk_test_51O9f5kDqybEGHe3Sv9IImXmERokwaG2PwZsnIBYqFZUstVCvg8Ldarmu9fs9lA83a3loA7JPNsQYw4qRGCpZxzgG00YQfEkYCg');

            $charge = \Stripe\Charge::create([
                'amount' => $request->amount * 100, 
                'currency' => 'usd',
                'description' => 'Example charge',
                'source' =>  $request->stripeToken,
            ]);
            return redirect()->route('index')->with('success', 'Payment successful!');
            // return response()->json(['success' => true, 'message' => 'Payment processed successfully']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['message' => 'Failed to process payment.']);
            // return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // public function createPayment(Request $request)
    // {
    //     // dd(substr($request->valid_thru, 2, 3));
    //     $fullString = substr($request->valid_thru, 2, 3);
    //     $numericPart = str_replace("/", "", $fullString);

    //     // Validate the incoming request...
    //     $validated = $request->validate([
    //         'card_number' => 'required',
    //         'card_name' => 'required',
    //         'valid_thru' => 'required',
    //         'cvc' => 'required',
    //         // Add any additional validation rules as needed
    //     ]);

    //     // Set your secret key. Remember to switch to your live secret key in production!
    //     // See your keys here: https://dashboard.stripe.com/account/apikeys
    //     Stripe::setApiKey('sk_test_51O9f5kDqybEGHe3Sv9IImXmERokwaG2PwZsnIBYqFZUstVCvg8Ldarmu9fs9lA83a3loA7JPNsQYw4qRGCpZxzgG00YQfEkYCg');

    //     try {
    //         $paymentIntent = PaymentIntent::create([
    //             'amount' => 1099, // Amount in cents
    //             'currency' => 'usd',
    //             'payment_method_types' => ['card'],
    //             'payment_method' => $request->payment_method_id, // Replace with the test token
    //             'confirm' => true,
    //         ]);

    //         // Check if the payment succeeded
    //         if ($paymentIntent->status === 'succeeded') {
    //             // Handle successful payment here
    //             // Redirect to a success page, etc.
    //             return redirect()->route('index')->with('success', 'Payment successful!');
    //         }

    //         // Handle errors
    //         return back()->withErrors(['message' => 'Failed to process payment.']);
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         // Handle exceptions
    //         return back()->withErrors(['message' => 'An error occurred: ' . $e->getMessage()]);
    //     }

    // }
}
