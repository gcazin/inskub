<?php

namespace App\Models;

use App\Http\Repository\UserRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Musonza\Chat\Traits\Messageable;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Spatie\Permission\Traits\HasRoles;

class User extends \Illuminate\Foundation\Auth\User
{
    use Notifiable, Messageable, CanFollow, CanBeFollowed, CanLike, HasApiTokens, Billable, HasRoles, HasFactory;

    protected $guarded = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'last_name', 'first_name', 'password', 'email', 'avatar', 'department_id', 'company_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Un utilisateur peut avoir plusieurs posts
     *
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class)->where('project_id', '=', null);
    }

    /**
     * Un utilisateur peut avoir plusieurs projets
     *
     * @return HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function participations()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Un utilisateur peut avoir plusieurs formations
     *
     * @return HasMany
     */
    public function formations()
    {
        return $this->hasMany(UserFormation::class);
    }

    /**
     * Un utilisateur peut avoir plusieurs compétences
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    /**
     * Un utilisateur peut avoir plusieurs notations
     *
     * @return HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'expert_id');
    }

    /**
     * Un utilisateur (en rôle school) peut avoir plusieurs professeurs
     *
     * @return HasMany
     */
    public function professors()
    {
        return $this->hasMany(Professor::class);
    }

    /**
     * Un utilisateur (en rôle school) peut avoir plusieurs salle de classes
     *
     * @return HasMany
     */
    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'school_id');
    }

    /**
     * Un utilisateur (en rôle school) peut avoir plusieurs étudiants
     *
     * @return HasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'school_id');
    }

    /**
     * @param $id
     * @return mixed|string
     */
    public static function getAvatar($id)
    {
        return (new UserRepository(new self()))->avatarPath($id);
    }
}
