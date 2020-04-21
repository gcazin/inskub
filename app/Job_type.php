<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_type extends Model
{
    protected $table = 'jobs_type';

    public function jobs()
    {
        return $this->belongsTo(Job::class);
    }
}
