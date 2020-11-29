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

    /**
     * Permet de déterminer si l'intermédiaire a déjà noter l'expert ou non
     *
     * @param int $expertId
     *
     * @return bool
     */
    public static function isRated(int $expertId): bool
    {
        return self::where('expert_id', '=', $expertId)->where('rated_by', '=', auth()->id())->get()->isNotEmpty();
    }
}
