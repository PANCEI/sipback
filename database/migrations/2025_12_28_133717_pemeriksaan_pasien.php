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
          Schema::create('pemeriksaan_pasien', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pasien');
            $table->integer('sistolik');
            $table->integer('diastolik');
            $table->text('keluhan');
            $table->text('diagnosa');
            $table->date('tanggal_pemeriksaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('pemeriksaan_pasien');
    }
};
