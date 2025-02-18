<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('id_service');
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade'); // Fix FK ke users.id_user
            $table->dateTime('tanggal');
            $table->text('keluhan')->nullable();
            $table->decimal('total_harga', 10, 2)->default(0);
            $table->decimal('dibayar', 10, 2);
            $table->decimal('kembalian', 10, 2);
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
