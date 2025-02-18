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
        Schema::create('details', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_service');
            $table->unsignedBigInteger('id_barang')->nullable(); // Bisa null jika hanya jasa
            $table->unsignedBigInteger('id_jasa')->nullable(); // Bisa null jika hanya barang
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_service')->references('id_service')->on('services')->onDelete('cascade');
            $table->foreign('id_barang')->references('id_barang')->on('barangs')->onDelete('set null');
            $table->foreign('id_jasa')->references('id_jasa')->on('jasas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
