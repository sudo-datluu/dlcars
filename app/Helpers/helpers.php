<?php

use App\Models\Brand;
use App\Models\CarType;

function getBrands() {
    return Brand::orderBy('name', 'ASC')
        ->get();
}

function getCarType() {
    return CarType::orderBy('name', 'ASC')
        ->get();
}

?>