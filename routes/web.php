<?php

require  __DIR__.'/../routes/admin.php';
require  __DIR__.'/../routes/seller.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PracticeController;
Use App\Http\Controllers\RazorpayController;
Use App\Http\Controllers\AdminController;
Use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('home');
});
Route::get('home', function (){
    return view('home');
});

Route::any('/creat',[HomeController::class,'create']);
Route::any('/homes',[HomeController::class,'home'])->name('homes');
Route::any('count',[HomeController::class,'counts']);
Route::any('store',[HomeController::class,'store']);




Route::any('index',function (){
    return view('index');
});

Route::any('store',[PracticeController::class,'store'])->name('store');
Route::any('ship',[PracticeController::class,'ship']);
 Route::any('/pay',function(){
   return view('pay');
});
Route::any('/sms/fast2sms', [HomeController::class, 'sendFast2Sms']);
Route::middleware('auth')->group(function (){
      
});
 Route::any('/login', [HomeController::class, 'login'])->name('login');

// Route::middleware(['admin'])->group(function(){
//     Route::get('homes',[HomeController::class,'home']);
// });



Route::post('/checkout/create-order', [\App\Http\Controllers\CashfreeController::class, 'createOrder'])->name('checkout.create');
Route::get('/checkout/return', [\App\Http\Controllers\CashfreeController::class, 'return'])->name('checkout.return'); // return_url





Route::get('/admin', function () {
  
   return view('admin.index');
})->middleware(['auth:seller','role:seller']);


Route::get('/admins', function () {
   return view('admin.index');
})->middleware(['auth:seller','permission:create sellers']);


Route::any('/role',[HomeController::class,'role']);

Route::any('/counter',function(){
    return view('counter_page');
});
     



Route::any('/payment', [RazorpayController::class, 'payment'])->name('payment');
Route::post('/pay', [RazorpayController::class, 'createOrder'])->name('pay');
Route::post('/payment-success', [RazorpayController::class, 'paymentSuccess'])->name('payment.success');

Route::any('/employee',[PracticeController::class,'employee'])->name('employee');
Route::middleware('auth:employee')->group(function(){
Route::any('/profile',[PracticeController::class,'profile'])->name('profile');
});


// Route::get('/notify', [NotificationController::class, 'send']);


Route::any('/welcomes',function(){
  return view('welcomes');
});




// Route::middleware('auth')->group(function () {
//     Route::any('/chat/send', [NotificationController::class, 'send']);
// });

// Route::any('/chat',function(){
//   return view('chat');
// });
// routes/web.php
Route::get('/chat/{user}', [NotificationController::class, 'chat']);
Route::post('/chat/send', [NotificationController::class,'send']);
Route::any('/chat/delivered/{id}', [NotificationController::class,'delivered']);
Route::any('/chat/seen/{user}', [NotificationController::class,'seen']);
Route::post('/chat/typing', [NotificationController::class,'typing']);

