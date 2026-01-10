<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{

    public function index()
    {
        return view('stripe.index');
    }

    public function payment(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

        $successURL = Route('stripe.payment.success') . '?session_id={CHECKOUT_SESSION_ID}';

        $response = $stripe->checkout->sessions->create([
            'success_url' => $successURL,
            'line_items' => [
                [
                    'price_data' => [
                        "currency" => "EUR",
                        "product_data" => [
                            'name' => $request->title,
                        ],
                        "unit_amount" => $request->price * 100
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
        ]);

        return redirect($response['url']);
    }

    public function success(Request $request)
    {

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        return redirect()->route("profile.reservations")->with("success", "Votre réservation a bien été enregistrée.");
    }

}
