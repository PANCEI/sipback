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
        //
         Schema::create('log_medicine_out', function (Blueprint $table) {
            $table->id();
            $table->string('kode_obat', 50);
            $table->integer('jumlah_keluar');
            $table->timestamp('tanggal_keluar');
            $table->string('keterangan')->nullable();
            $table->string('dokter_penanggung_jawab');
            $table->string('pasien_id');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('log_medicine_out');
    }
};
