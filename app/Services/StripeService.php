<?php

namespace App\Services;

class StripeService
{
    public function createCheckout(array $data): string
    {
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

        $response = $stripe->checkout->sessions->create([
            'success_url' => route('stripe.payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [
                            'name' => $data['title'],
                        ],
                        'unit_amount' => $data['price'] * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
        ]);

        return $response['url'];
    }
}
