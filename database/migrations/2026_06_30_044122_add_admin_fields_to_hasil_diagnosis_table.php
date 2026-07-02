<?php
// database/migrations/2026_06_30_add_admin_fields_to_hasil_diagnosis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_diagnosis', function (Blueprint $table) {
            $table->string('diagnosed_by')->nullable()->after('saran_penanganan');
            $table->timestamp('diagnosed_at')->nullable()->after('diagnosed_by');
        });
    }

    public function down(): void
    {
        Schema::table('hasil_diagnosis', function (Blueprint $table) {
            $table->dropColumn(['diagnosed_by', 'diagnosed_at']);
        });
    }
};