<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'project_id',
        'user_id',
        'assigned_to'
    ];

    public function assigned()
    {
        return $this->belongsTo(User::class);
    }
}
