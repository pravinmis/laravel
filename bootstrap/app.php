<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;



require_once __DIR__ . '/../app/Helpers/helpers.php';
require_once __DIR__ . '/../app/Helpers/fun.php';

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    //  ->withRouting(
    //     then: function(){
    //         Route::middleware('api')
    //              ->group(base_path('routes/employee/employee.php'));
    //     }
    // )
      
   
    ->withMiddleware(function (Middleware $middleware): void {

  
        // middleware alias ko yahan register karo:
       $middleware->alias([
    'admin'               => \App\Http\Middleware\CheckAdmin::class,
    'seller'              => \App\Http\Middleware\CheckedSeller::class,
    // NOTE: use singular "Middleware" namespace (as files show)
    'role'                => \Spatie\Permission\Middleware\RoleMiddleware::class,
    'permission'          => \Spatie\Permission\Middleware\PermissionMiddleware::class,
    'role_or_permission'  => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
    'auth.employee-api' => \Laravel\Passport\Http\Middleware\CheckClientCredentials::class,
]);
          $middleware->append(\App\Http\Middleware\CorsMiddleware::class);
          
    })->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

