<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kabar_sekitar', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->constrained('acc_users')->onDelete('cascade');
            $table->string('kota', 100);
            $table->tinyInteger('rating')->comment('1-5 bintang');
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kabar_sekitar');
    }
};