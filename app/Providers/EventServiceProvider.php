<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
   //rotected $shouldDiscoverEvents = true;

    public function register(): void
    {
        // agr koi event fire hota hia to yha bhi hm code kr skte ha event ka 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
