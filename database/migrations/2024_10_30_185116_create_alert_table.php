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
        Schema::create('alert', function (Blueprint $table) {
            $table->id('id_alert');
            $table->foreignId('id_kandang')->constrained('kandang')->onDelete('cascade');
            $table->enum('jenis_alert', ['suhu', 'kelembaban']);
            $table->decimal('nilai', 5, 2);
            $table->timestamp('waktu_alert')->useCurrent();
            $table->enum('status', ['pending', 'resolved'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert');
    }
};
