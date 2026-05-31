<?php

namespace App\Mail;

use App\Models\contactos;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public contactos $contacto)
    {
    }

    public function build(): self
    {
        return $this->subject('New contact request - AYW')
            ->replyTo($this->contacto->email, $this->contacto->name)
            ->view('emails.contact_message_received');
    }
}
