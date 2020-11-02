<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkillPivot extends Model
{
    protected $table = "user_skills_pivot";

    public function skills()
    {
        return $this->hasMany(UserSkill::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
