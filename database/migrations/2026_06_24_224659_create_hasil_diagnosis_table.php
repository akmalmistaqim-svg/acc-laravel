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
            $table->id();
            $table->foreignId('acc_user_id')->constrained('acc_users')->onDelete('cascade');
            $table->string('nama_penyakit');
            $table->text('analisis');
            $table->text('saran_penanganan');
            $table->string('foto');
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
