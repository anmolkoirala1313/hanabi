<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewServiceNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($service,$quote_id,$name)
    {
        $this->service  = $service;
        $this->quote_id = $quote_id;
        $this->name     = $name;
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
            'id'=>$this->service->id,
            'title'=>$this->service->title,
            'slug'=>$this->service->slug,
            'quote_id'=> $this->quote_id,
            'name'=> $this->name,
            'image'=>  $this->service->banner_image,

        ];
    }
}
