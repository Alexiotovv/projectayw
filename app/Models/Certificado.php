<?php

namespace App\Models;

use App\Models\CertificadoHabilidad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Certificado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_completo',
        'nombre_curso',
        'fecha_expedicion',
        'codigo_unico',
        'url_hash',
        'habilidades',
        'horas_duracion',
        'instructor',
        'modalidad',
        'email',
        'publico'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificado) {
            if (empty($certificado->codigo_unico)) {
                $certificado->codigo_unico = Str::upper(Str::random(12));
            }
            if (empty($certificado->url_hash)) {
                $certificado->url_hash = Str::uuid()->toString();
            }
        });
    }

    public function habilidades()
    {
        return $this->hasMany(CertificadoHabilidad::class)->orderBy('orden')->orderBy('id');
    }

    public function getHabilidadesArrayAttribute()
    {
        try {
            if (Schema::hasTable('certificado_habilidades')) {
                $habilidades = $this->habilidades()->pluck('nombre')->filter()->values()->toArray();

                if (!empty($habilidades)) {
                    return $habilidades;
                }
            }
        } catch (\Throwable $e) {
            // Fallback al formato anterior si la tabla no está disponible.
        }

        $valor = $this->attributes['habilidades'] ?? $this->getAttribute('habilidades');

        if (empty($valor)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\n|,/', $valor) ?: [])));
    }

    public function getUrlCertificadoAttribute()
    {
        return route('certificado.ver', $this->url_hash);
    }
}