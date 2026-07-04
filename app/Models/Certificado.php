<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Models\CertificadoHabilidad;

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
        return $this->habilidades()->pluck('nombre')->toArray();
    }

    public function getUrlCertificadoAttribute()
    {
        return route('certificado.ver', $this->url_hash);
    }
}