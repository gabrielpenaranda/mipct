<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RestablecerContrasenaNotification extends Notification
{
    use Queueable;

    public string $url;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $token)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->view('emails.reset-password', [
            'nombre' => $notifiable->nombre ?? '',
            'url' => $this->resetUrl($notifiable),
        ]);
    }

    /**
     * Get the password reset URL for the given notifiable.
     */
    protected function resetUrl(object $notifiable): string
    {
        $email = $notifiable->getEmailForPasswordReset();

        return config('app.frontend_url').'/auth/restablecer?token='.$this->token.'&email='.urlencode($email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
