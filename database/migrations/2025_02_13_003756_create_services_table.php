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
        Schema::create('services', function (Blueprint $table) {
            $table->id('id_servilce');
            $table->date('tangga');
            $table->string('plat');
            $table->string('keluhan');
            $table->integer('id_barang');
            $table->integer('id_jasa');
            $table->integer('biaya_barang');
            $table->integer('biaya_jasa');
            $table->integer('total_harga');
            $table->integer('dibayar');
            $table->integer('kembali');
            $table->integer('id_user');
            $table->string('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
