<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function home(Request $request, $brandSlug = null, $carTypeSlug = null) {
        return view('home');
    }
}
