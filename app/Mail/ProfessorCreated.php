<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProfessorCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private User $professor;

    /**
     * @var Authenticatable
     */
    private Authenticatable $school;

    /**
     * @var string
     */
    private string $password;

    /**
     * Create a new message instance.
     *
     * @param User            $professor
     * @param Authenticatable $school
     * @param string          $password
     */
    public function __construct(User $professor, Authenticatable $school, string $password)
    {
        $this->professor = $professor;
        $this->school = $school;
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
            ->subject('Votre compte de professeur sur ' . config('app.name'))
            ->markdown('mail.professor.created', [
            'professor' => $this->professor,
            'school' => $this->school,
            'password' => $this->password
        ]);
    }
}
