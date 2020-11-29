<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisibilityPost extends Model
{
    protected $fillable = [
        'type', 'description',
    ];
}
