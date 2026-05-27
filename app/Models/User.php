<?php

namespace App\Models;

use App\Notifications\AywResetPasswordNotification;
use App\Notifications\VerifyPendingEmailNotification;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, MustVerifyEmail, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'pending_email',
        'password',
        'phone',
        'company',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relación con servicios
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    // Relación con pagos
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Verificar si es cliente
    public function isCustomer()
    {
        return $this->hasRole('customer');
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new AywResetPasswordNotification($token));
    }

    public function sendPendingEmailVerificationNotification(string $pendingEmail): void
    {
        Notification::route('mail', $pendingEmail)
            ->notify(new VerifyPendingEmailNotification($this, $pendingEmail));
    }
}