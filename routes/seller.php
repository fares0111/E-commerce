<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\Products\ProductController;

use App\Http\Controllers\Seller\Auth\RegisterSellerController;
use App\Http\Controllers\Seller\Auth\AuthenticationController;
use App\Http\Controllers\seller\ProfileController;


Route::view('seller/dashboard','sellers.dashboard')->middleware('auth:seller')->name('seller.dashboard');


Route::controller(RegisterSellerController::class)->prefix('auth/seller/')->name('auth.seller.')->group(function(){

Route::get("register",'create')->name('create');
Route::post("insert",'store')->name('insert');

Route::get('login',[AuthenticationController::class,'login'])->name('login');
Route::post('login',[AuthenticationController::class,'LoginAuthentication'])->name('login.submit');

Route::post('logout',[AuthenticationController::class,'destroy'])->name('logout');

});


Route::controller(ProfileController::class)->middleware('auth:seller')->prefix('seller/profile/')->name('seller.profile.')->group(function(){

Route::get('/','index')->name('index');



});



