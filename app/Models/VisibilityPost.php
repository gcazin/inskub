<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisibilityPost extends Model
{
    protected $table = 'visibility_posts';

    protected $fillable = [
        'type', 'description',
    ];
}
