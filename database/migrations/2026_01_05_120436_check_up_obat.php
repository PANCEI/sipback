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
           Schema::create('checkup_obat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pemeriksaan');
            $table->integer('id_obat');
            $table->string('dokter');
            $table->string('dosis');
            $table->integer('jumlah');
            $table->date('tanggal_pemeriksaan_dokter');
            $table->date('tanggal_penyerahan_obat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('checkup_obat');
    }
};
