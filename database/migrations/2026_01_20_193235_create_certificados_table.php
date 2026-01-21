
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('nombre_curso');
            $table->date('fecha_expedicion');
            $table->string('codigo_unico')->unique();
            $table->string('url_hash')->unique();
            $table->text('habilidades')->nullable();
            $table->integer('horas_duracion')->default(6);
            $table->string('instructor')->default('Alex Vásquez');
            $table->string('modalidad')->nullable();
            $table->string('email')->nullable();
            $table->boolean('publico')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificados');
    }
};