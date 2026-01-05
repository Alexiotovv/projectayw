<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscripcionCurso extends Model
{
    protected $table = 'inscripciones_cursos';
    
    protected $fillable = [
        'nombres',
        'apellidos',
        'modalidad',
        'voucher_path',
        'estado',
        'email'
    ];

    protected $casts = [
        'modalidad' => 'string'
    ];
}