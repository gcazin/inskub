<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'rating',
        'description',
        'expert_id',
        'rated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
