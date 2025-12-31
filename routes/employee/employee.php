<?php

use Illuminate\Support\Facades\Route;


Route::prefix('employee/employee')->group(function(){
Route::any('/',function(){
   return "hello";
});
});