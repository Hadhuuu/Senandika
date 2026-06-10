<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Memanggil seeder gejala
        $this->call(SymptomSeeder::class);

        // Akun Admin / Konselor
        User::create([
            'nim' => 'admin01',
            'name' => 'Psikolog Kampus',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_profile_completed' => true, // Admin tidak perlu isi onboarding
        ]);

        // Akun Mahasiswa
        User::create([
            'nim' => '1238',
            'name' => 'Guest',
            'password' => Hash::make('123'),
            'role' => 'mahasiswa',
            // Kita set false agar saat login, dia dipaksa masuk ke halaman Onboarding dulu
            'is_profile_completed' => false, 
        ]);
    }
}