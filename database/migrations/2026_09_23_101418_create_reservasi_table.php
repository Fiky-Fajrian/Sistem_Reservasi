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
    Schema::create('reservasi', function (Blueprint $table) {
        $table->id();
        $table->string('nama_penyewa');
        $table->foreignId('id_kos')->constrained('kos')->onDelete('cascade');
        $table->string('nomor_kamar');
        $table->date('tanggal_mulai');
        $table->integer('durasi_bulan');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
