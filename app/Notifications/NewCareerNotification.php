<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCareerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($career,$response_id,$name)
    {
        $this->career      =  $career;
        $this->response_id = $response_id;
        $this->name        = $name;
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
            'id'           => $this->career->id,
            'career_name'  => $this->career->name,
            'slug'         => $this->career->slug,
            'response_id'  => $this->response_id,
            'name'         => $this->name,
            'image'        => $this->career->feature_image,

        ];
    }
}
