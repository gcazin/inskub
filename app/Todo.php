<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    public function assigned()
    {
        return $this->belongsTo(User::class);
    }
}
