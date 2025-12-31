<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\PaymentGatewayContract;
use App\Services\RazorpayService;
use App\Services\CashfreeService;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
     //only for cashfree

//  public function register()
//     {
//         // Contract ko directly Cashfree se bind kar diya
//         $this->app->bind(
//             PaymentGatewayContract::class,
//             CashfreeService::class
//         );
//     }

    public function register()
    {
        $this->app->bind(PaymentGatewayContract::class, function () {

            $gateway = config('payment.gateway'); // razorpay / cashfree

            return match ($gateway) {
                'cashfree' => new CashfreeService(),
                default => new RazorpayService(),
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
