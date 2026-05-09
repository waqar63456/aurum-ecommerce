<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        try {
            // Check if user is logged in using session
            $customer = Session::get('customer');
            
            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'error' => 'Please login to make a payment'
                ], 401);
            }
            
            // Validate the request
            $request->validate([
                'amount' => 'required|numeric|min:0.5',
                'order_id' => 'required|string',
            ]);

            // Set your Stripe secret key
            Stripe::setApiKey(config('services.stripe.secret'));
            
            // Create a payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Convert to cents
                'currency' => 'usd',
                'metadata' => [
                    'user_id' => $customer->id,
                    'user_email' => $customer->email,
                    'order_id' => $request->order_id,
                ],
            ]);
            
            // Return the client secret to your Vue frontend
            return response()->json([
                'success' => true,
                'clientSecret' => $paymentIntent->client_secret,
                'paymentIntentId' => $paymentIntent->id,
            ]);
            
        } catch (\Exception $e) {
            Log::error('Payment initiation failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}