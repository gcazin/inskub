<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $table = 'project_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
