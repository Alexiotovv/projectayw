<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'service_plan_id')) {
                $table->foreignId('service_plan_id')->nullable()->after('user_id')->constrained('service_plans')->nullOnDelete();
            }
            if (!Schema::hasColumn('services', 'features')) {
                $table->json('features')->nullable()->after('plan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'service_plan_id')) {
                $table->dropForeign(['service_plan_id']);
                $table->dropColumn('service_plan_id');
            }
            if (Schema::hasColumn('services', 'features')) {
                $table->dropColumn('features');
            }
        });
    }
};
