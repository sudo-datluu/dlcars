<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CarController extends Controller
{
    protected $carModel;

    public function __construct(Car $car)
    {
        $this->carModel = $car;
    }

    function home(Request $request, $brandSlug = null, $carTypeSlug = null) {
        $cars = $this->carModel->getAllCars();

        // Filter by brand if carBrandSlug is provided
        if ($brandSlug) {
            $cars = array_filter($cars, function ($car) use ($brandSlug) {
                return strtolower(str_replace(' ', '-', $car['brand'])) === $brandSlug;
            });
        }

        // Filter by type if carTypeSlug is provided
        if ($carTypeSlug) {
            $cars = array_filter($cars, function ($car) use ($carTypeSlug) {
                return strtolower(str_replace(' ', '-', $car['type'])) === $carTypeSlug;
            });
        }

        $query = $request->get('query');
        if (!empty($query)) {
            $cars = array_filter($cars, function ($car) use ($query) {
                return stripos($car['search_index'], $query) !== false;
            });
            $cars = array_values($cars);
        }

        return view('home', ['cars' => $cars]);
    }

    function carDetails($carId) {
        $car = $this->carModel->get($carId);
        return view('car', ['car' => $car]);
    }
}
