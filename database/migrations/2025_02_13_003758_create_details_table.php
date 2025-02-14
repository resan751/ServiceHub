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
            $table->foreignId('id_service')->constrained('services', 'id_service')->onDelete('cascade');
            $table->foreignId('id_barang')->nullable()->constrained('barangs', 'id_barang')->onDelete('set null');
            $table->foreignId('id_jasa')->nullable()->constrained('jasas', 'id_jasa')->onDelete('set null');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 12, 2);
            $table->decimal('total_harga', 12, 2);
            $table->timestamps();
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
