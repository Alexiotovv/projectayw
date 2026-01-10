<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Agregar los nuevos campos
            $table->string('company')->nullable()->after('email');
            $table->string('phone')->nullable()->after('company');
            $table->boolean('is_customer')->default(false)->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar los campos en caso de rollback
            $table->dropColumn(['company', 'phone', 'is_customer']);
        });
    }
};