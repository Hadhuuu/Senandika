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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('final_score', 5, 2)->default(0); // Hasil gabungan (persentase)
            $table->string('dominant_category')->nullable(); // Kategori paling parah
            $table->enum('status', ['Belum Diproses', 'Menunggu Jadwal', 'Sedang Konseling', 'Selesai'])->default('Belum Diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
