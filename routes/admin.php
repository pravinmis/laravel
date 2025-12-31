<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\AdminController;
Use App\Http\Controllers\TestController;


Route::prefix('admin')->group(function () {

Route::any('test',[TestController::class, 'test']);
Route::any('login',[TestController::class, 'login']);
Route::any('role',[TestController::class, 'role']);
Route::any('counts',[TestController::class, 'count_test']);
Route::any('create',[TestController::class, 'create']);
Route::any('store',[TestController::class, 'store'])->name('store');
Route::any('index_1',[TestController::class, 'index_1']);
Route::any('edit/{id}',[TestController::class, 'edit'])->name('edit');
Route::any('updates/{id}',[TestController::class, 'update'])->name('updates');

Route::any('order',[TestController::class, 'order']);

Route::any('/s',function(){
return "hello";
});






Route::any('index',function(){
    return view('admin.index');
})->middleware(['auth:employee','role:employee']);

});
