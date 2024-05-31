<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'carID',
        'qty',
        'name',
        'license',
        'email',
        'phone',
        'startDate',
        'endDate'
    ];

    protected $dates = [
        'startDate',
        'endDate'
    ];
}
