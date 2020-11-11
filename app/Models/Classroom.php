<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'school_id'
    ];

    /**
     * Une classe contient plusieurs professeurs
     *
     * @return HasMany
     */
    public function professors()
    {
        return $this->hasMany(Professor::class);
    }

    /**
     * Une classe peut avoir plusieurs étudiants
     *
     * @return HasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Une classe n'est rattaché qu'a une seule école
     *
     * @return HasOne
     */
    public function school()
    {
        return $this->hasOne(User::class);
    }
}
