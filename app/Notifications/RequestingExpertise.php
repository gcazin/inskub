<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RequestingExpertise extends Notification
{
    use Queueable;

    protected $expertise;

    /**
     * Create a new notification instance.
     *
     * @param $expertise
     */
    public function __construct($expertise)
    {
        $this->expertise = $expertise;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'message' => 'Demande d\'expertise envoyé par ' . User::find($this->expertise->sender_id)->first_name . ' ' . User::find($this->expertise->sender_id)->last_name,
            'sender_id' => $this->expertise->sender_id
        ];
    }
}
