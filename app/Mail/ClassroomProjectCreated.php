<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClassroomProjectCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Project
     */
    private Project $project;

    /**
     * @var Authenticatable
     */
    private Authenticatable $professor;

    /**
     * Create a new message instance.
     *
     * @param Project         $project
     * @param Authenticatable $professor
     */
    public function __construct(Project $project, Authenticatable $professor)
    {
        $this->project = $project;
        $this->professor = $professor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Vous avez été ajouté à la salle de classe ' . $this->project->title)
            ->markdown('mail.classroom.created', [
                'project' => $this->project,
                'professor' => $this->professor
            ]);
    }
}
