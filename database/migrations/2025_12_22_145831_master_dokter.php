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
        Schema::create('master_dokter', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dokter')->unique();
            $table->string('nama_dokter');
            $table->integer('id_poli');
            $table->string('spesialis')->nullable();
            $table->string('no_sip')->nullable();
            $table->string('no_telp')->nullable();
             $table->enum('status_dokter', ['PNS', 'Non PNS', 'Kontrak'])->default('PNS');
             $table->unsignedBigInteger('flag_delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_dokter');
    }
};
