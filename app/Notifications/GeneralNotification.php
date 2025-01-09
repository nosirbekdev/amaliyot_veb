<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GeneralNotification extends Notification
{
    use Queueable;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // ma'lumotlar bazasi va email orqali yuborish
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->data['message'],
            'url' => $this->data['url'], // xabarga yo'naltirish havolasi
        ];
    }
}
