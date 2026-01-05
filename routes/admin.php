<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\AdminController;
Use App\Http\Controllers\TestController;


Route::prefix('admin')->group(function () {

Route::any('/',[AdminController::class,'login']);
Route::any('/login',[AdminController::class,'loginstore'])->name('admin.login');
Route::any('/create',[AdminController::class,'create'])->name('create');
Route::any('/store',[AdminController::class,'store'])->name('admin.store');
Route::any('/dashboard',[AdminController::class,'dashboard']);









// Route::any('test',[TestController::class, 'test']);
// Route::any('login',[TestController::class, 'login']);
// Route::any('role',[TestController::class, 'role']);
// Route::any('counts',[TestController::class, 'count_test']);
// Route::any('create',[TestController::class, 'create']);
// Route::any('store',[TestController::class, 'store'])->name('store');
// Route::any('index_1',[TestController::class, 'index_1']);
// Route::any('edit/{id}',[TestController::class, 'edit'])->name('edit');
// Route::any('updates/{id}',[TestController::class, 'update'])->name('updates');

Route::any('order',[TestController::class, 'order']);
Route::post('/notification/read/{id}', function ($id) {
    $notification = auth()->user()
        ->notifications()
        ->where('id', $id)
        ->first();

    if ($notification) {
        $notification->markAsRead();
    }

    return response()->json(['success' => true]);
})->middleware('auth');


// Route::any('/s',function(){
// return "hello";
// });






// Route::any('index',function(){
//     return view('admin.index');
// })->middleware(['auth:employee','role:employee']);

});
