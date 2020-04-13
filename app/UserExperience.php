<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    protected $fillable = [
        'title', 'enterprise', 'location', 'start_date', 'finish_date', 'sector', 'description', 'media',
    ];
}
