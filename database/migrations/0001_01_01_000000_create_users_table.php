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
    // 1. Tabel Users (Yang sudah kita modifikasi)
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('nim')->unique();
        $table->string('name');
        $table->string('password');
        $table->enum('role', ['mahasiswa', 'admin'])->default('mahasiswa');
        
        // --- DATA PROFILING (KAGGLE DATASET) ---
        $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
        $table->integer('age')->nullable();
        $table->string('course')->nullable(); // Jurusan
        $table->integer('current_year')->nullable(); // Tahun ke-berapa
        $table->decimal('gpa', 3, 2)->nullable(); // IPK (Contoh: 3.50)
        $table->enum('marital_status', ['Belum Menikah', 'Menikah'])->nullable();
        
        // Penanda apakah profil sudah lengkap
        $table->boolean('is_profile_completed')->default(false); 

        $table->rememberToken();
        $table->timestamps();
    });

    // 2. Tabel Password Reset (Bawaan Laravel)
    Schema::create('password_reset_tokens', function (Blueprint $table) {
        $table->string('email')->primary();
        $table->string('token');
        $table->timestamp('created_at')->nullable();
    });

    // 3. Tabel Sessions (Ini yang tadi hilang dan bikin error)
    Schema::create('sessions', function (Blueprint $table) {
        $table->string('id')->primary();
        $table->foreignId('user_id')->nullable()->index();
        $table->string('ip_address', 45)->nullable();
        $table->text('user_agent')->nullable();
        $table->longText('payload');
        $table->integer('last_activity')->index();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
