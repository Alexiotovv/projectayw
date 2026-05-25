<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE service_plans MODIFY COLUMN type VARCHAR(100) NOT NULL");
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement("UPDATE service_plans SET type = 'email' WHERE type NOT IN ('vps','email')");
            DB::statement("ALTER TABLE service_plans MODIFY COLUMN type ENUM('vps','email') NOT NULL");
        }
    }
};
