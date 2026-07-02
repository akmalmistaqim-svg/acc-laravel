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
        Schema::create('hasil_diagnosis', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('acc_user_id')->constrained('acc_users')->onDelete('cascade');
            $table->string('nama_penyakit')->nullable();
            $table->text('analisis')->nullable();
            $table->text('saran_penanganan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_diagnosis');
    }
};
