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
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('merek'); // Contoh: Toyota, Honda
            $table->string('tipe'); // Contoh: Avanza, Brio
            $table->string('nomor_polisi')->unique(); 
            $table->integer('harga_sewa_per_hari');
            $table->enum('status', ['tersedia', 'dirental', 'maintenance'])->default('tersedia');
            $table->string('foto')->nullable(); // Untuk menyimpan gambar mobil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
