<?php

namespace App\Services;

use App\Contracts\PaymentGatewayContract;
use Razorpay\Api\Api;

class RazorpayService implements PaymentGatewayContract
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(
            config('razorpay.key'),
            config('razorpay.secret')
        );
    }

    public function createOrder(array $data)
    {
        return $this->api->order->create([
            'receipt' => uniqid(),
            'amount' => $data['amount'] * 100,
            'currency' => 'INR',
        ]);
    }

    public function verifyPayment(array $data)
    {
        // Razorpay signature verify logic
        return true;
    }
}
