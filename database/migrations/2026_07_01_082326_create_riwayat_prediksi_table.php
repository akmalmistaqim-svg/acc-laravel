<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_prediksi', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->constrained('acc_users')->onDelete('cascade');
            $table->string('kota', 100);
            $table->integer('suhu');
            $table->string('kondisi', 100)->nullable();
            $table->string('icon', 10)->nullable();
            $table->date('tanggal_prediksi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_prediksi');
    }
};