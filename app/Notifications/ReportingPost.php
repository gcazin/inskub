<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReportingPost extends Notification
{
    use Queueable;

    protected $reportPost;

    /**
     * Create a new notification instance.
     *
     * @param \App\ReportPost $reportPost
     */
    public function __construct(\App\ReportPost $reportPost)
    {
        $this->reportPost = $reportPost;
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
            'informant_id' => $this->reportPost->informant_id,
            'reason_id' => $this->reportPost->reason_id,
            'post_id' => $this->reportPost->post_id
        ];
    }
}