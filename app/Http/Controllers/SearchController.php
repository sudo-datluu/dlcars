<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class SearchController extends Controller
{
    protected $recentSearches = [];

    public function cars(Request $request, $cars = null) {
        $query = urldecode($request->get('query'));
        
        if (!$cars) {
            $cars = json_decode(File::get(public_path('json/cars.json')), true);
        }
        $results = $cars;

        if (!empty($query)) {
            $results = array_filter($cars, function ($car) use ($query) {
                return stripos($car['search_index'], $query) !== false;
            });
            $results = array_values($results);
        }


        return response()->json($results);
    }

    public function history(Request $request)
    {
        // $request->session()->forget('recentSearches');
        return response()->json(session('recentSearches', []));
    }

    public function saveSearch(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        if (!$searchTerm) {
            return response()->json(['status' => 'error', 'message' => 'Search term is required']);
        }
        // Save search term to session
        $recentSearches = session('recentSearches', []);
        if (!in_array($searchTerm, $recentSearches)) {
            $recentSearches[] = $searchTerm;
        }
        $recentSearches = array_slice($recentSearches, -5);
        session(['recentSearches' => array_unique($recentSearches)]);

        return response()->json(['status' => 'success']);
    }
}
