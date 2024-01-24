<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nic extends Model
{
    use HasFactory;

    protected $fillable = [
        'delay_time',
        'water_source_id',
    ];
}
