<?php

namespace App\Jobs;

use App\Mail\ClassroomProjectCreated;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailStudentClassroom implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Student
     */
    private Student $student;

    /**
     * @var Project
     */
    private Project $project;
    /**
     * @var Authenticatable
     */
    private Authenticatable $auth;

    /**
     * Traitement de l'envoie des emails lors de l'ajout d'un étudiant à une salle de classe dans l'espace projet.
     *
     * @param Student         $student
     * @param Project         $project
     * @param Authenticatable $auth
     */
    public function __construct(Student $student, Project $project, Authenticatable $auth)
    {
        $this->student = $student;
        $this->project = $project;
        $this->auth = $auth;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Mail::to($this->student->user->email)->send(new ClassroomProjectCreated($this->project, $this->auth));
    }
}
