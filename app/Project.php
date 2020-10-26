<?php

namespace App;

use App\Observers\ProjectObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $dispatchesEvents = [
        'saved' => ProjectObserver::class
    ];

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'finish',
        'colour',
        'private',
        'type',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
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

        return null;
    }

    /**
     * Permet d'ajouter un utilisateur à un projet
     *
     * @param int $id
     */
    public function addParticipant(int $id): void
    {
        $this->participants()->create([
            'user_id' => $id,
            'project_id' => $this->id,
            'created_at' => now(),
        ]);
    }

    /**
     * Vérifie que l'utilisateur connecté est bien un participant du projet
     */
    public function selfParticipant()
    {
        return $this->participants()->get()->contains('user_id', '=', auth()->id());
    }
}
