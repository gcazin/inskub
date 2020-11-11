<?php

namespace App\Mail;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private User $user;

    /**
     * Mot de passe
     *
     * @var string
     */
    private string $password;

    /**
     * Identifiant de la salle de classe
     *
     * @var int
     */
    private int $classroomId;

    /**
     * Create a new message instance.
     *
     * @param User                  $user
     * @param Classroom $classroom
     * @param string                $password
     */
    public function __construct(User $user, int $classroomId, string $password)
    {
        $this->user = $user;
        $this->classroomId = $classroomId;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Votre compte élève sur ' . config('app.name'))
            ->markdown('mail.student.created', [
                'classroom' => $this->classroomId,
                'email' => $this->user->email,
                'password' => $this->password,
            ]);

    }
}
