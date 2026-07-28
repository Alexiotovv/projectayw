<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Payment $payment)
    {
    }

    public function build(): self
    {
        return $this->subject('Pago confirmado - ' . $this->getInvoiceNumber())
            ->view('emails.payment_approved');
    }

    private function getInvoiceNumber(): string
    {
        return 'FAC-' . str_pad($this->payment->id, 6, '0', STR_PAD_LEFT);
    }
}
