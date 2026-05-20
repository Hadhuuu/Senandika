<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Symptom;
use App\Models\Assessment;
use App\Models\AssessmentDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // Gunakan Faker dengan format Indonesia
        $faker = Faker::create('id_ID');
        
        // Ambil semua gejala yang ada di database
        $symptoms = Symptom::all();
        
        // Data referensi untuk diacak
        $courses = ['Teknik Informatika', 'Sistem Informasi', 'Psikologi', 'Ilmu Komunikasi', 'Manajemen', 'Akuntansi', 'Teknik Sipil', 'Desain Komunikasi Visual'];
        $categories = ['Depresi', 'Anxiety', 'Panic Attack'];
        $statuses = ['Belum Diproses', 'Menunggu Jadwal', 'Sedang Konseling', 'Selesai'];

        // Kita buat 25 data mahasiswa fiktif
        for ($i = 0; $i < 25; $i++) {
            
            // 1. Buat User Mahasiswa
            $user = User::create([
                'nim' => $faker->unique()->numerify('##########'), // 10 digit angka acak
                'name' => $faker->name(),
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa',
                'gender' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'age' => $faker->numberBetween(18, 24),
                'course' => $faker->randomElement($courses),
                'current_year' => $faker->numberBetween(1, 5),
                'gpa' => $faker->randomFloat(2, 1.5, 4.0), // IPK antara 1.50 - 4.00
                'marital_status' => $faker->randomElement(['Belum Menikah', 'Belum Menikah', 'Belum Menikah', 'Menikah']), // Dibuat lebih sering belum menikah
                'is_profile_completed' => true,
            ]);

            // 2. Buat Hasil Asesmen
            $assessment = Assessment::create([
                'user_id' => $user->id,
                'final_score' => $faker->randomFloat(2, 15, 95), // Skor CF acak 15% - 95%
                'dominant_category' => $faker->randomElement($categories),
                'status' => $faker->randomElement($statuses),
                'created_at' => $faker->dateTimeBetween('-2 months', 'now') // Acak tanggal tes dalam 2 bulan terakhir
            ]);

            // 3. Buat Detail Jawaban Kuesioner
            foreach ($symptoms as $symptom) {
                AssessmentDetail::create([
                    'assessment_id' => $assessment->id,
                    'symptom_id' => $symptom->id,
                    'cf_user' => $faker->randomElement([0.0, 0.4, 0.8, 1.0]), // Acak jawaban
                ]);
            }
        }
    }
}