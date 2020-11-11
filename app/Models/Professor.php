<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = [
        'professor_id',
        'school_id'
    ];

    /**
     * Un professeur n'est rattaché qu'a un seul utilisateur
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    /**
     * Un professeur n'est rattaché qu'a une seule école
     *
     * @return BelongsTo
     */
    public function school()
    {
        return $this->belongsTo(User::class, 'school_id');
    }

    /**
     * Un professeur peut-être rattaché à plusieurs classes
     *
     * @return BelongsToMany
     */
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }
}
