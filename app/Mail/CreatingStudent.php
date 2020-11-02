<?php

namespace App\Mail;

use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreatingStudent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\User
     */
    private User $user;
    private string $password;
    private string $project;

    /**
     * Create a new message instance.
     *
     * @param \App\User $user
     * @param string    $password
     * @param string    $project
     */
    public function __construct(User $user, string $password, string $project)
    {
        $this->user = $user;
        $this->password = $password;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('noreply@inskub.fr')
            ->subject('Vous avez été ajouté à la salle de classe ' . Project::find($this->project)->title)
            ->markdown('mail.student.creating', [
                'email' => $this->user->email,
                'password' => $this->password,
                'project' => $this->project
            ]);

    }
}
