<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

class CashfreeService
{
    protected Client $http;
    protected string $base;

    public function __construct()
    {
        $env = config('cashfree.env', env('CASHFREE_ENV', 'sandbox'));
        $this->base = $env === 'production' ? 'https://api.cashfree.com/pg' : 'https://sandbox.cashfree.com/pg';

        $this->http = new Client([
            'timeout'  => 15,
        ]);
    }

    protected function headers(): array
    {
        return [
            'Content-Type' => 'application/json',
            'x-client-id' => env('CASHFREE_CLIENT_ID'),
            'x-client-secret' => env('CASHFREE_CLIENT_SECRET'),
            'x-api-version' => env('CASHFREE_API_VERSION', '2025-01-01'),
            'x-request-id' => (string) Str::uuid(),
        ];
    }

    /**
     * Create order at Cashfree (returns API response array)
     * See docs: POST /pg/orders
     */
    public function createOrder(array $payload): array
    {
    // dd($this->http);
        $res = $this->http->post($this->base.'/orders', [
            'headers' => $this->headers(),
            'json' => $payload,
        ]);
          
        $body   = (string) $res->getBody(); 
        return json_decode($body, true);
    }

    /**
     * Get order status: GET /pg/orders/{order_id}
     */
    public function getOrder(string $orderId): array
    {
        $res = $this->http->get($this->base."/orders/{$orderId}", [
            'headers' => $this->headers(),
        ]);

        return json_decode((string) $res->getBody(), true);
    }
}