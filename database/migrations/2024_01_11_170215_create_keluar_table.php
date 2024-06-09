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
        Schema::create('keluar', function (Blueprint $table) {
            $table->bigIncrements('idkeluar');
            $table->unsignedBigInteger('idparkir');
            $table->unsignedBigInteger('iduser');
            $table->timestamp('tgl_masuk')->nullable();
            $table->timestamp('tgl_keluar')->nullable();
            $table->string('total');
            $table->timestamps();

            $table->foreign('idparkir')->references('idparkir')->on('parkir')->onUpdate('cascade')->onDelete('restrict');
            //$table->foreign('idkategori')->references('idkategori')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluar');
    }
};
