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
    Schema::create('pelanggans', function (Blueprint $table) {
        $table->string('id_pelanggan', 20)->primary(); // Contoh: PLG-001
        $table->string('nama_lengkap', 100);
        $table->string('no_hp', 20);
        $table->text('alamat_pelanggan');
        $table->string('pekerjaan', 100);
        $table->timestamps();
    });
}
};
