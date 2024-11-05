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
        Schema::create('log_monitoring', function (Blueprint $table) {
            $table->id('id_log');
            $table->foreignId('id_kandang')->constrained('kandang')->onDelete('cascade');
            $table->string('tindakan', 100);
            $table->text('keterangan')->nullable();
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_monitoring');
    }
};
