<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFormation extends Model
{
    protected $fillable = [
        'school', 'degree', 'study_area', 'start_date', 'finish_date', 'description', 'media', 'user_id'
    ];
}
