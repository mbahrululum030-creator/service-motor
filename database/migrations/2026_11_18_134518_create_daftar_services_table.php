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
    Schema::create('daftar_services', function (Blueprint $table) {
        $table->string('id_servis', 20)->primary(); // Contoh: SRV-001
        $table->string('no_plat', 20);
        $table->string('id_pelanggan', 20);
        $table->string('nama_pelanggan', 100); // Terisi otomatis dari relasi pelanggan
        $table->text('keluhan_kendaraan');
        $table->date('tanggal_servis');
        $table->timestamps();

        $table->foreign('no_plat')->references('no_plat')->on('kendaraans')->onDelete('cascade');
        $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');
    });
}
};
