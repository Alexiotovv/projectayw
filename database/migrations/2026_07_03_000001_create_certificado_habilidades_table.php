<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificado_habilidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('certificado_id')->constrained('certificados')->cascadeOnDelete();
            $table->string('nombre');
            $table->unsignedInteger('orden')->default(0);
            $table->timestamps();

            $table->unique(['certificado_id', 'nombre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificado_habilidades');
    }
};
