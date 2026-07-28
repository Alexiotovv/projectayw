<?php

namespace App\Models;

use App\Models\Payment;
use App\Models\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'service_plan_id',
        'name',
        'type',
        'domain',
        'plan',
        'features',
        'email_accounts',
        'storage_gb',
        'status',
        'start_date',
        'expiry_date',
        'auto_renew',
        'plesk_subscription_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'expiry_date' => 'date',
        'features' => 'array',
        'auto_renew' => 'boolean',
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con pagos
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function servicePlan()
    {
        return $this->belongsTo(ServicePlan::class);
    }

    public function nextBillingDate(): ?Carbon
    {
        if (!$this->expiry_date || !$this->servicePlan) {
            return null;
        }

        return $this->expiry_date->copy();
    }

    public function generateNextRecurringPayment(PaymentMethod $paymentMethod = null): ?Payment
    {
        if (!$this->auto_renew || !$this->servicePlan) {
            return null;
        }

        $nextPaymentDate = $this->nextBillingDate();
        if (!$nextPaymentDate) {
            return null;
        }

        if ($nextPaymentDate->isPast()) {
            $nextPaymentDate = Carbon::now();
        }

        $existingPending = $this->payments()
            ->where('status', Payment::STATUS_PENDING)
            ->whereDate('payment_date', $nextPaymentDate)
            ->exists();

        if ($existingPending) {
            return null;
        }

        $paymentMethod = $paymentMethod
            ?? PaymentMethod::where('is_active', true)->orderBy('name')->first();

        if (!$paymentMethod) {
            return null;
        }

        $dueDate = $nextPaymentDate->copy()->subDays(3);
        if ($dueDate->lt(Carbon::now())) {
            $dueDate = Carbon::now()->copy()->addDays(3);
        }

        return $this->payments()->create([
            'user_id' => $this->user_id,
            'amount' => $this->servicePlan->price,
            'currency' => 'PEN',
            'payment_method' => $paymentMethod->code,
            'status' => Payment::STATUS_PENDING,
            'payment_date' => $nextPaymentDate,
            'due_date' => $dueDate,
            'notes' => 'Pago recurrente generado automáticamente para el ciclo ' . ($this->servicePlan->billing_cycle === 'yearly' ? 'anual' : 'mensual') . ' de ' . $this->servicePlan->name,
        ]);
    }

    // Scope para servicios activos
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope para servicios de correo
    public function scopeEmail($query)
    {
        return $query->where('type', 'email');
    }
}