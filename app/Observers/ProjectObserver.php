<?php

namespace App\Observers;

use App\Models\Project;
use Carbon\Carbon;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function creating(Project $project)
    {
        $project->user_id = auth()->id() ?? $project->user_id;
        $project->deadline = Carbon::createFromFormat('d/m/Y', $project->deadline)->format('Y-m-d');
        $project->colour = $project->colour ?: '#4299e1';
        $project->type = $project->type ?: 0;
        $project->created_at = now();
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        //
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the project "restored" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
