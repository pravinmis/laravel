<?php

namespace App\Contracts;

interface PaymentGatewayContract
{
    public function createOrder(array $data);
    public function verifyPayment(array $data);
}
