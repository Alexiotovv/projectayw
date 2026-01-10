<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('solicitudes_correo', function (Blueprint $table) {
            $table->id();
            $table->string('plan'); // personal, premium, avanzado
            $table->string('nombre_completo');
            $table->string('empresa');
            $table->string('email');
            $table->string('telefono');
            $table->enum('tipo_dominio', ['nuevo', 'existente'])->default('nuevo');
            $table->string('dominio')->nullable(); // Para dominios existentes
            $table->string('dominio_seleccionado')->nullable(); // Para dominios nuevos seleccionados
            $table->string('servicio_actual')->nullable();
            $table->text('mensaje')->nullable();
            $table->enum('tipo_solicitud', ['contratacion', 'prueba_gratuita'])->default('contratacion');
            $table->enum('estado', ['pendiente', 'contactado', 'procesando', 'activado', 'rechazado'])->default('pendiente');
            $table->decimal('precio_dominio_eur', 8, 2)->nullable();
            $table->decimal('precio_dominio_soles', 8, 2)->nullable();
            $table->timestamps();
            
            // Índices para búsquedas frecuentes
            $table->index('email');
            $table->index('estado');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes_correo');
    }
};