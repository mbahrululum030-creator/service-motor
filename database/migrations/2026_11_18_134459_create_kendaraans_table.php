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
    Schema::create('kendaraans', function (Blueprint $table) {
        $table->string('no_plat', 20)->primary(); // Contoh: BL 1234 AB
        $table->enum('jenis_kendaraan', ['Matic', 'Manual Transmisi']);
        $table->string('no_stnk', 50);
        $table->year('tahun_pembuatan');
        $table->string('nama_pemilik', 100);
        $table->string('warna_kendaraan', 50);
        $table->timestamps();
    });
}
};
