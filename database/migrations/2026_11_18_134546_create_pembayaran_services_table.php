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
    Schema::create('pembayaran_services', function (Blueprint $table) {
        $table->id();
        $table->string('id_servis', 20);
        $table->decimal('jumlah_biaya', 12, 2);
        $table->enum('jenis_pembayaran', ['Cash / Tunai', 'Non Tunai']);
        $table->text('keterangan')->nullable();
        $table->timestamps();

        $table->foreign('id_servis')->references('id_servis')->on('daftar_services')->onDelete('cascade');
    });
}
};
