<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['email', 'hosting', 'domain', 'saas']);
            $table->string('domain')->nullable();
            $table->string('plan');
            $table->integer('email_accounts')->default(0);
            $table->integer('storage_gb')->default(0);
            $table->enum('status', ['active', 'suspended', 'cancelled', 'pending'])->default('pending');
            $table->date('start_date');
            $table->date('expiry_date');
            $table->boolean('auto_renew')->default(true);
            $table->string('plesk_subscription_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            // Eliminar la restricción de clave foránea primero
            $table->dropForeign(['user_id']);
        });
        
        Schema::dropIfExists('services');
    }
};