<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StripeService;

class StripeController extends Controller
{

    public function index()
    {
        return view('stripe.index');
    }

    public function payment(Request $request, StripeService $stripe)
    {
        $url = $stripe->createCheckout($request->only('title', 'price'));

        return redirect($url);
    }


    public function success(Request $request)
    {

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $response = $stripe->checkout->sessions->retrieve($request->session_id);

        return redirect()->route("profile.reservations")->with("success", "Votre réservation a bien été enregistrée.");
    }

}
