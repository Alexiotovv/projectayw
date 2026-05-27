<?php

namespace App\Models;

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