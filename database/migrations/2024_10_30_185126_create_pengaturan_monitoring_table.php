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
        Schema::create('pengaturan_monitoring', function (Blueprint $table) {
            $table->id('id_pengaturan');
            $table->foreignId('id_kandang')->constrained('kandang')->onDelete('cascade');
            $table->decimal('batas_suhu_min', 5, 2)->nullable();
            $table->decimal('batas_suhu_max', 5, 2)->nullable();
            $table->decimal('batas_kelembaban_min', 5, 2)->nullable();
            $table->decimal('batas_kelembaban_max', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_monitoring');
    }
};
