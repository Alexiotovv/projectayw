<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerifyPendingEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly User $user,
        private readonly string $pendingEmail
    )
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = URL::temporarySignedRoute(
            'customer.profile.email.verify',
            now()->addMinutes(60),
            [
                'id' => $this->user->getKey(),
                'hash' => sha1($this->pendingEmail),
                'email' => $this->pendingEmail,
            ]
        );

        return (new MailMessage)
            ->subject('AYW - Confirma tu nuevo correo electronico')
            ->view('emails.auth.verify_pending_email', [
                'user' => $this->user,
                'pendingEmail' => $this->pendingEmail,
                'verificationUrl' => $verificationUrl,
                'expireMinutes' => 60,
            ]);
    }
}