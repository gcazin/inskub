<?php

namespace App\Jobs;

use App\Mail\ProfessorCreated;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailProfessor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private User $user;

    /**
     * @var Authenticatable
     */
    private Authenticatable $auth;

    private string $password;

    /**
     * Traitement de l'envoie des emails lors de la création d'un professeur.
     *
     * @param User            $user
     * @param Authenticatable $auth
     * @param string          $password
     */
    public function __construct(User $user, Authenticatable $auth, string $password)
    {
        $this->user = $user;
        $this->auth = $auth;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new ProfessorCreated($this->user, $this->auth, $this->password));
    }
}
