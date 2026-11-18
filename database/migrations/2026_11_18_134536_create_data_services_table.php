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
    Schema::create('data_services', function (Blueprint $table) {
        $table->id();
        $table->string('id_servis', 20);
        $table->text('keluhan_kendaraan'); // Muncul otomatis setelah id_servis dipilih
        $table->string('estimasi_service', 100);
        $table->string('nama_mekanik', 100);
        $table->text('sparepart_pengganti');
        $table->timestamps();

        $table->foreign('id_servis')->references('id_servis')->on('daftar_services')->onDelete('cascade');
    });
}
};
