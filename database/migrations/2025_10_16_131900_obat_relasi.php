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
        Schema::create('obat_kategori_relasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_obat', 50);
            $table->unsignedBigInteger('kategori_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
         Schema::dropIfExists('obat_kategori_relasi');
    }
};
