<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            if (!Schema::hasColumn('payment_methods', 'bank_name')) {
                $table->string('bank_name')->nullable()->after('qr_image_path');
            }
            if (!Schema::hasColumn('payment_methods', 'bank_account_holder')) {
                $table->string('bank_account_holder')->nullable()->after('bank_name');
            }
            if (!Schema::hasColumn('payment_methods', 'bank_account_number')) {
                $table->string('bank_account_number')->nullable()->after('bank_account_holder');
            }
            if (!Schema::hasColumn('payment_methods', 'bank_account_cci')) {
                $table->string('bank_account_cci')->nullable()->after('bank_account_number');
            }
            if (!Schema::hasColumn('payment_methods', 'gateway_url')) {
                $table->string('gateway_url')->nullable()->after('bank_account_cci');
            }
        });
    }

    public function down(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $columns = [
                'bank_name',
                'bank_account_holder',
                'bank_account_number',
                'bank_account_cci',
                'gateway_url',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('payment_methods', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
