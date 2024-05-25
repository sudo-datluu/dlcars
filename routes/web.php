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

Route::group(['prefix' => 'search'], function() {
    Route::get('/cars', [SearchController::class, 'cars']);
    Route::get('/recent', [SearchController::class, 'recent']);
    Route::post('/save', [SearchController::class, 'saveSearch']);
});