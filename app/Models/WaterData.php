<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterData extends Model
{
    use HasFactory;

    protected $fillable = [
        'water_source',
        'water_ph',
        'water_temperature',
        'turbidity',
        'ambient_temperature',
        'ambient_humidity',
        'eligibility',
        'water_status',
    ];
}
