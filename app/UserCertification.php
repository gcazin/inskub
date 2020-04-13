<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCertification extends Model
{
    protected $fillable = [
        'name', 'institution', 'start_date', 'finish_date', 'description', 'media',
    ];
}
