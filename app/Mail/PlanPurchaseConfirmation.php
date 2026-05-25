<?php

namespace App\Mail;

use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Service;
use App\Models\ServicePlan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanPurchaseConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public ServicePlan $servicePlan,
        public Service $service,
        public Payment $payment,
        public PaymentMethod $paymentMethod
    ) {
    }

    public function build(): self
    {
        return $this->subject('Confirmación de solicitud de servicio - AYW')
            ->view('emails.plan_purchase_confirmation');
    }
}
