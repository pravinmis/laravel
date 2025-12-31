<?php


use Illuminate\Support\Facades\Route;


Route::prefix('seller')->group(function(){
Route::any('/hi',function(){
   return "hi";
});
});