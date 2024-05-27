<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
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