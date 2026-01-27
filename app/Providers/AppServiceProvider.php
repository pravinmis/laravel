<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
  //   User::observe(UserObserver::class);


    // For resources/
    View::addLocation(resource_path());

    // For resources/custom/
    View::addLocation(resource_path('custom'));
}
}
