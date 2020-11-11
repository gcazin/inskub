<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'location', 'entry_price'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
