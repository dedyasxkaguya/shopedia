<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// Route::get('/users', [Controller::class,'index']);
Route::get('/users', [UserController::class,'index']);
Route::get('/user/{id}', [UserController::class,'show']);

Route::get('/products', [ProductController::class,'index']);
Route::get('/product/{id}', [ProductController::class,'show']);

Route::get('/carts', [CartController::class,'index']);
Route::get('/cart/{id}', [CartController::class,'show']);
Route::get('/cart/user/{id}', [CartController::class,'userCart']);

Route::post('/user/register', [UserController::class,'register']);
Route::post('/user/login', [UserController::class,'login']);
Route::post('/user/edit/{id}', [UserController::class,'updateProfile']);

Route::post('/product/add', [ProductController::class,'storeData']);

Route::post('/cart/add', [CartController::class,'storeData']);