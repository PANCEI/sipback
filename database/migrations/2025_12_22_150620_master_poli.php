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
        Schema::create('master_poli', function (Blueprint $table) {
            $table->id();

            $table->string('kode_poli')->unique();
            $table->string('nama_poli'); // Poli Umum, Gigi, KIA, dll
            $table->text('deskripsi')->nullable();

            // Status aktif / nonaktif
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_poli');
    }
};
