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
        Schema::create('parkir', function (Blueprint $table) {
            $table->bigIncrements('idparkir');
            $table->unsignedBigInteger('idkategori');
            $table->string('merk');
            $table->string('nama_mobil');
            $table->string('warna');
            $table->string('plat');
            $table->string('total', 15)->nullable();;
            $table->enum('status', ['cekin', 'cekout'])->default('cekin');
            $table->timestamps();


            $table->foreign('idkategori')->references('idkategori')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkir');
    }
};