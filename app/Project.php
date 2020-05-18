<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        ''
    ];

    public function users()
    {
        return $this->hasMany(ProjectUser::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static function daysLeft(Project $project, ?bool $color = false)
    {
        $carbon = new Carbon();
        $diff = $carbon::parse(now())->diffInDays($project->deadline, false);

        if ($project->finish === 0 && $color === false) {
            if ($diff === 0) {
                return "Dernier jour";
            }
            if ($diff < 0) {
                return "Retard de ".abs($diff)." jours";
            } else {
                return "$diff jours restant";
            }
        }

        if ($color !== false) {
            if ($diff === 0) {
                return "warning";
            }
            if ($diff < 0) {
                return "danger";
            } else {
                return "primary";
            }
        }
    }
}
