<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscripciones_cursos', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8);
            $table->string('nombres');
            $table->string('apellidos');
            $table->enum('modalidad', ['virtual', 'presencial']);
            $table->string('voucher_path')->nullable();
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscripciones_cursos');
    }
};