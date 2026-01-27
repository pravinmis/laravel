<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PracticeController;
use Illuminate\Support\Facades\Route;


Route::any('/register', [AuthController::class, 'register']);
 Route::any('user', [AuthController::class, 'me']);
 Route::any('/delete/{id}', [AuthController::class, 'delete']);
 Route::any('/edit/{id}', [AuthController::class, 'edit']);
 Route::any('/update/{id}', [AuthController::class, 'update']);



Route::middleware('auth:employee-api')->group(function(){
 Route::any('/profile', [AuthController::class, 'profile']);
});

Route::post('employee/register', [PracticeController::class, 'register']);

Route::any('login',    [PracticeController::class, 'login']);
 

// Protected routes
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [PracticeController::class, 'logout']);
  
    // example resource
    Route::get('orders',  [\App\Http\Controllers\PracticeController::class, 'index'])->middleware('scope:view-orders');
});
Route::any('hello',function(){
       return "hii";
});
