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
            $table->string('telp');
            $table->timestamp('tgl_masuk', $precision = 0);
            $table->string('gambar');
            $table->string('nama_pemilik');
            $table->enum('status', ['0', '1'])->default('0');
            $table->timestamps();

            $table->foreign('idkategori')->references('idkategori')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
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
