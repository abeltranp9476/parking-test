<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $collection = 'vehicles_parking';

    protected $fillable = ['id', 'matricula', 'type', 'price_per_min', 'min_total', 'price_total', 'in_at', 'out_at'];
}
