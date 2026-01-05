<?php


use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\SellerController;


Route::prefix('seller')->group(function(){
Route::any('/hi',function(){
   return "hi";
});


Route::any('/',[SellerController::class,'login']);

Route::any('/login',[SellerController::class,'loginstore'])->name('seller.login');


  Route::any('/dashboard',[SellerController::class,'dashboard']);


});