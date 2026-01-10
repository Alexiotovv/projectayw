<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('PEN');
            $table->enum('payment_method', ['yape', 'plin', 'card', 'transfer', 'cash']);
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->date('payment_date');
            $table->date('due_date');
            $table->string('invoice_url')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Eliminar las restricciones de clave foránea primero
            $table->dropForeign(['user_id']);
            $table->dropForeign(['service_id']);
        });
        
        Schema::dropIfExists('payments');
    }
};