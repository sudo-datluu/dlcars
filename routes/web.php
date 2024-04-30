<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Redirect::route('home');
});

Route::get('/home/{carBrandSlug?}/{carTypeSlug?}', [HomeController::class, 'home']) -> name('home');
