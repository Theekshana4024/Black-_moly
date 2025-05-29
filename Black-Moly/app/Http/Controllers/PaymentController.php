<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function checkout(Request $request, $vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);

        return view('customer.pages.checkout', compact('vehicle'));
    }

    public function processPayment(Request $request, $vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => $vehicle->price * 100, // price in cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for vehicle: ' . $vehicle->title,
            ]);

            // Store transaction
            Transaction::create([
                'buyer_id' => Auth::id(),
                'vehicle_id' => $vehicle->id,
                'payment_status' => 'paid',
                'payment_method' => 'stripe',
            ]);

            // Update vehicle status
            $vehicle->status = 'sold';
            $vehicle->save();

            $vehicle = Vehicle::findOrFail($vehicleId);
            $payment = Transaction::where('vehicle_id', $vehicleId)->latest()->first();

            return view('customer.pages.thank-you', compact('vehicle', 'payment'));

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Payment failed: ' . $e->getMessage()]);
        }
    }
}
