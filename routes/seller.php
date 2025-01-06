<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\Products\ProductController;

use App\Http\Controllers\Seller\Auth\RegisterSellerController;
use App\Http\Controllers\Seller\Auth\AuthenticationController;

use App\Http\Controllers\Seller\SellerController;

Route::controller(RegisterSellerController::class)->prefix('auth/seller/')->name('auth.seller.')->group(function(){

Route::get("register",'create')->name('create');
Route::post("insert",'store')->name('insert');

Route::get('login',[AuthenticationController::class,'login'])->name('login');
Route::post('login',[AuthenticationController::class,'LoginAuthentication'])->name('login.submit');

Route::post('logout',[AuthenticationController::class,'destroy'])->name('logout');

});


Route::controller(SellerController::class)->middleware('auth:seller')->prefix('seller/')->name('seller.')->group(function(){



Route::view('dashboard','sellers.dashboard')->name('dashboard');

});



