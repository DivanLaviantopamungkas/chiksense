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
        Schema::create('sensor', function (Blueprint $table) {
            $table->bigIncrements('id_sensor');
            $table->unsignedBigInteger('id_kandang'); // Pastikan tipe data cocok dengan bigIncrements
            $table->decimal('suhu', 5, 2);
            $table->decimal('kelembaban', 5, 2)->nullable();
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();

            $table->foreign('id_kandang')->references('id')->on('kandang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor');
    }
};
