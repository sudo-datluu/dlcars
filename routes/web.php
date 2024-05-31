<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Redirect::route('home');
});

Route::get('/home/{carBrandSlug?}/{carTypeSlug?}', [CarController::class, 'home']) -> name('home');
Route::get('car/{carId}', [CarController::class, 'carDetails']) -> name('car');

Route::group(['prefix' => 'search'], function() {
    Route::get('/cars', [SearchController::class, 'cars']);
    Route::get('/history', [SearchController::class, 'history']);
    Route::post('/save', [SearchController::class, 'saveSearch']);
});

Route::group(['prefix' => 'reservation'], function() {
    Route::get('/', [ReservationController::class, 'index']) -> name('reservation');
    Route::post('/save', [ReservationController::class, 'save']);
    Route::post('/clear', [ReservationController::class, 'clear']);
    Route::post('/store', [ReservationController::class, 'store']);
});

Route::group(['prefix' => 'orders'], function() {
    Route::get('/{orderID}', [OrderController::class, 'order']) -> name('order');
    Route::post('/{orderID}/confirm', [OrderController::class, 'confirm']);
});