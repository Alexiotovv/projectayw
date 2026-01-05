<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inscripciones_cursos', function (Blueprint $table) {
            $table->dropColumn('dni');
        });
    }

    public function down(): void
    {
        Schema::table('inscripciones_cursos', function (Blueprint $table) {
            $table->string('dni', 8)->nullable();
        });
    }
};