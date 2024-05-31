<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

class Car
{
    public $filePath;

    public function __construct()
    {
        $this->filePath = public_path('json/cars.json');
    }

    public function getAllCars()
    {
        $cars = File::get($this->filePath);
        return json_decode($cars, true);
    }

    public function get($id)
    {
        $cars = $this->getAllCars();
        return $cars[$id] ?? null;
    }

    public function save(array $carData)
    {
        $cars = $this->getAllCars();
        $cars[] = $carData;
        File::put($this->filePath, json_encode($cars, JSON_PRETTY_PRINT));
    }

    public function update($id, array $carData)
    {
        $cars = $this->getAllCars();
        if (isset($cars[$id])) {
            $cars[$id] = $carData;
            File::put($this->filePath, json_encode($cars, JSON_PRETTY_PRINT));
        }
    }
}
