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
          Schema::create('master_mitra', function (Blueprint $table) {
            $table->string('kode_mitra');
            $table->string('nama_mitra');
            $table->string('alamat');
            $table->string('no_telepon');
            $table->unsignedBigInteger('flag_delete');
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
          Schema::dropIfExists('master_mitra');
    }
};
