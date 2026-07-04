<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificadoEnviadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $certificado,
        public $enlace
    ) {
    }

    public function build(): self
    {
        return $this->subject('Tu certificado está listo - AYW')
            ->view('emails.certificado_enviado')
            ->with([
                'certificado' => $this->certificado,
                'enlace' => $this->enlace,
            ]);
    }
}
