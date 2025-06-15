<?php

use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/booking')->group(function () {
    Route::post('/send', [BookingController::class, 'sendBooking']);
    Route::get('/show', [BookingController::class, 'getBookings']);
    Route::put('/status/{id}/{status}', [BookingController::class, 'setStatus']);
});

Route::prefix('/product')->group(function () {
    Route::get('/show', [ProductController::class, 'getProducts']);
    Route::get('/show/{id}', [ProductController::class, 'getProduct']);
    Route::post('/add', [ProductController::class, 'addProduct']);
});
