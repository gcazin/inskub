<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatingStudent extends Notification
{
    use Queueable;

    protected User $user;

    protected $plain_password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, string $plain_password)
    {
        $this->user = $user;
        $this->plain_password = $plain_password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->cc(env('MAIL_USERNAME'))
            ->subject('Vous avez été ajouté à une classe sur ' . config('app.name'))
            ->markdown('mail.student.creating', [
                'email' => $this->user->email,
                'password' => $this->plain_password
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
