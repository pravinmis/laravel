<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PracticeController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:employee-api')->group(function(){
 Route::any('/profile', [AuthController::class, 'profile']);
});

Route::post('employee/register', [PracticeController::class, 'register']);

Route::any('login',    [PracticeController::class, 'login']);
 

// Protected routes
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [PracticeController::class, 'logout']);
   Route::get('user',    [PracticeController::class, 'me']);
    // example resource
    Route::get('orders',  [\App\Http\Controllers\PracticeController::class, 'index'])->middleware('scope:view-orders');
});
Route::any('hello',function(){
       return "hii";
});
