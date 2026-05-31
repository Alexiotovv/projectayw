<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('contactos')) {
            return;
        }

        Schema::table('contactos', function (Blueprint $table) {
            if (! Schema::hasColumn('contactos', 'name')) {
                $table->string('name', 120)->after('id');
            }
            if (! Schema::hasColumn('contactos', 'email')) {
                $table->string('email', 190)->after('name');
            }
            if (! Schema::hasColumn('contactos', 'phone')) {
                $table->string('phone', 30)->after('email');
            }
            if (! Schema::hasColumn('contactos', 'subject')) {
                $table->string('subject', 190)->after('phone');
            }
            if (! Schema::hasColumn('contactos', 'message')) {
                $table->text('message')->after('subject');
            }
            if (! Schema::hasColumn('contactos', 'status')) {
                $table->string('status', 30)->default('pending')->after('message');
            }
            if (! Schema::hasColumn('contactos', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('status');
            }
            if (! Schema::hasColumn('contactos', 'locale')) {
                $table->string('locale', 10)->default('en')->after('admin_notes');
            }
            if (! Schema::hasColumn('contactos', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('locale');
            }
            if (! Schema::hasColumn('contactos', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('ip_address');
            }
            if (! Schema::hasColumn('contactos', 'contacted_at')) {
                $table->timestamp('contacted_at')->nullable()->after('user_agent');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('contactos')) {
            return;
        }

        Schema::table('contactos', function (Blueprint $table) {
            $columns = [
                'name',
                'email',
                'phone',
                'subject',
                'message',
                'status',
                'admin_notes',
                'locale',
                'ip_address',
                'user_agent',
                'contacted_at',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('contactos', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
