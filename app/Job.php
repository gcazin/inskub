<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function types()
    {
        return $this->hasOne(Job_type::class);
    }

}
