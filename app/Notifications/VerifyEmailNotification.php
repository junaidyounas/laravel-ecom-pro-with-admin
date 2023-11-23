<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function toMail($notifiable)
    {
        $url = url("/verify/{$this->token}");

        return (new MailMessage)
            ->line('Click the button below to verify your email address.')
            ->action('Verify Email', url($url))
            ->line('If you did not create an account, no further action is required.');
    }

    // Add the 'via' method to specify notification channels
    public function via($notifiable)
    {
        return ['mail'];
    }
}
