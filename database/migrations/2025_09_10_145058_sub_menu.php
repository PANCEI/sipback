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
        Schema::create('submenu', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sub_menu');
            $table->string('url')->nullable();
            $table->string('path')->nullable();
            $table->unsignedBigInteger('id_menu');
            $table->string('icon')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //  
         Schema::dropIfExists('submenu');
    }
};
