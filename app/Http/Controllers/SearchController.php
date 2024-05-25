<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class SearchController extends Controller
{
    protected $recentSearches = [];

    public function cars(Request $request) {
        $query = $request->input('query');
        $cars = json_decode(File::get(public_path('json/cars.json')), true);
        $results = $cars;

        if (!$query) {
            $results = array_filter($cars, function ($car) use ($query) {
                return stripos($car['search_index'], $query) !== false;
            });
            $results = array_values($results);
        }


        return response()->json($results);
    }

    public function recent()
    {
        return response()->json(session('recentSearches', []));
    }

    public function saveSearch(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        // Save search term to session
        $recentSearches = session('recentSearches', []);
        array_unshift($recentSearches, $searchTerm);
        session(['recentSearches' => array_unique($recentSearches)]);

        return response()->json(['status' => 'success']);
    }
}
