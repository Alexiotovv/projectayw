<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscripcionCurso extends Model
{
    protected $table = 'inscripciones_cursos';
    
    protected $fillable = [
        'dni',
        'nombres',
        'apellidos',
        'modalidad',
        'voucher_path',
        'estado'
    ];

    protected $casts = [
        'modalidad' => 'string'
    ];
}