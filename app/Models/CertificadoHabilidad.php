<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificadoHabilidad extends Model
{
    use HasFactory;

    protected $table = 'certificado_habilidades';

    protected $fillable = [
        'certificado_id',
        'nombre',
        'orden',
    ];

    public function certificado()
    {
        return $this->belongsTo(Certificado::class);
    }
}
