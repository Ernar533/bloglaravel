<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendVerifyWithQueueNotfication extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Подтверждение электронной почты')
            ->line('Нажмите на кнопку ниже для подтверждения вашего адреса электронной почты.')
            ->action('Подтвердить', $this->verificationUrl($notifiable))
            ->line('Спасибо за регистрацию!');
    }
}
