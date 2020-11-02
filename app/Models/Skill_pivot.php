<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill_pivot extends Model
{
    protected $table = "skills_pivot";

    protected $fillable = [
        'user_id', 'skill_id'
    ];
}
