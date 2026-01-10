<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudCorreo extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_correo';
    
    protected $fillable = [
        'plan',
        'nombre_completo',
        'empresa',
        'email',
        'telefono',
        'tipo_dominio',
        'dominio',
        'dominio_seleccionado',
        'servicio_actual',
        'mensaje',
        'tipo_solicitud',
        'estado',
        'precio_dominio_eur',
        'precio_dominio_soles'
    ];

    protected $casts = [
        'precio_dominio_eur' => 'decimal:2',
        'precio_dominio_soles' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Scopes para filtros comunes
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }
    
    public function scopePorPlan($query, $plan)
    {
        return $query->where('plan', $plan);
    }
    
    public function scopeDelDia($query)
    {
        return $query->whereDate('created_at', today());
    }

    // Accessor para dominio final
    public function getDominioFinalAttribute()
    {
        return $this->tipo_dominio === 'nuevo' 
            ? $this->dominio_seleccionado 
            : $this->dominio;
    }

    // Accessor para nombre del plan
    public function getNombrePlanAttribute()
    {
        $planes = [
            'personal' => 'Plan Personal',
            'premium' => 'Plan Premium',
            'avanzado' => 'Plan Avanzado'
        ];
        
        return $planes[$this->plan] ?? $this->plan;
    }

    // Accessor para precio del plan
    public function getPrecioPlanAttribute()
    {
        $precios = [
            'personal' => 9.90,
            'premium' => 14.90,
            'avanzado' => 24.90
        ];
        
        return $precios[$this->plan] ?? 0;
    }
}