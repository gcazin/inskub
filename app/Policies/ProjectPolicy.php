<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the project.
     *
     * @param  User  $user
     * @param  Project  $project
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
        return $project->checkParticipant($user->id) || $project->user->id === auth()->id();
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param User    $user
     * @param Project $project
     *
     * @return mixed
     */
    public function update(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param User    $user
     * @param Project $project
     *
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }
}
