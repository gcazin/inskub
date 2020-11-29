<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_code',
        'insee_code',
        'zip_code',
        'name',
        'slug',
        'gps_lat',
        'gps_lng'
    ];

    public $timestamps = false;

    protected $table = 'cities';
}
