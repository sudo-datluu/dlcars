<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class HomeController extends Controller
{
    function home(Request $request, $brandSlug = null, $carTypeSlug = null) {
        $filePath = public_path('json/cars.json');
        
        return view('home');
    }
}
