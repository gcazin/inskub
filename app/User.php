<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Musonza\Chat\Traits\Messageable;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static find($id)
 */
class User extends \Illuminate\Foundation\Auth\User
{
    use Notifiable, Messageable, CanFollow, CanBeFollowed, CanLike, HasApiTokens, Billable, HasRoles;

    protected $guarded = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'last_name', 'first_name', 'email', 'password', 'avatar', 'department', 'company', 'tel', 'adresse'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $guard_name = 'api';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return bool
     */
    public static function isAdmin(): bool
    {
        return Auth::check() && (int) Auth::user()->role_id === 1;
    }

    /**
     * @param $id
     * @return mixed|string
     */
    public static function getAvatar($id)
    {
        $user = self::find($id);
        if ($user->avatar === "user.jpg" || $user->avatar === null) {
            return 'https://avatars.dicebear.com/v2/initials/' . strtolower(trim(substr($user->first_name, 0, 1))) . ''.strtolower(trim(substr($user->last_name, 0, 1))).'.svg?options[fontSize]=40';
        }
        return self::find($id)->avatar;
    }

    /**
     * @param $id Identifiant de l'utilisateur
     *
     * @return int
     */
    public static function getNumberFollowers($id): int
    {
        $user = self::find($id);
        return count($user->followers()->get());
    }

    /**
     * @param $id Identifiant de l'utilisateur
     *
     * @return int
     */
    public static function getNumberFollowings($id): int
    {
        $user = self::find($id);
        return count($user->followings()->get());
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->where('project_id', '=', null);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function formations()
    {
        return $this->hasMany(UserFormation::class);
    }

    public function skills()
    {
        return $this->hasMany(UserSkillPivot::class, 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'expert_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
