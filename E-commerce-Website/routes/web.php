<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home-page');
});

Route::get ('/Category-list',[CategoryController::class,'CategoryList']);

Route::get ('/Product-Sliders',[ProductController::class,'ProductSliders']);
Route::get ('/Topbar-Category',[CategoryController::class,'TopbarCategory']);
Route::get ('/Product-by-Remarks/{remark}',[ProductController::class,'listProductbyRemarks']);
Route::get ('/Brand-list',[BrandController::class,'BrandList']);


Route::get ('/login',[UserController::class,'logIn']);

Route::get('/UserLogin/{UserEmail}', [UserController::class, 'UserLogin']);
Route::get('/VerifyLogin/{UserEmail}/{OTP}', [UserController::class, 'VerifyLogin']);
Route::get('/verify', [UserController::class, 'VerifyPage']);
Route::get('/auth/google/callback', [UserController::class, 'handleGoogleCallback']);
Route::get('/auth/google/redirect', [UserController::class, 'redirectToGoogle']);
