<?php
// database/migrations/2026_07_01_000000_add_is_active_to_acc_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('acc_users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('acc_users', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};