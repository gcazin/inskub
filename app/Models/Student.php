<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'classroom_id',
        'school_id'
    ];

    /**
     * Un étudiant n'est rattaché qu'a un seul utilisateur
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Un étudiant n'est rattaché qu'a une seule école
     *
     * @return BelongsTo
     */
    public function school()
    {
        return $this->belongsTo(User::class, 'school_id');
    }

    /**
     * Un étudiant n'est rattaché qu'a une seule classe
     *
     * @return BelongsTo
     */
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
