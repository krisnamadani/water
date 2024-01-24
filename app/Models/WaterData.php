<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterData extends Model
{
    use HasFactory;

    protected $fillable = [
        'water_source_id',
        'water_status_id',
        'nic_id',
    ];
}
