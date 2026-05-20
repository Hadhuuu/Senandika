<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Symptom;

class SymptomSeeder extends Seeder
{
    public function run(): void
    {
        $symptoms = [
            [
                'code' => 'G01',
                'question' => 'Merasa sedih, hampa, atau putus asa hampir setiap hari.',
                'cf_pakar' => 0.8,
                'category' => 'Depresi'
            ],
            [
                'code' => 'G02',
                'question' => 'Kehilangan minat pada hobi atau aktivitas yang biasanya disukai.',
                'cf_pakar' => 0.7,
                'category' => 'Depresi'
            ],
            [
                'code' => 'G03',
                'question' => 'Merasa sangat lelah atau tidak bertenaga meskipun tidak beraktivitas berat.',
                'cf_pakar' => 0.5,
                'category' => 'Depresi'
            ],
            [
                'code' => 'G04',
                'question' => 'Merasa gugup, cemas, atau gelisah secara terus-menerus.',
                'cf_pakar' => 0.8,
                'category' => 'Anxiety'
            ],
            [
                'code' => 'G05',
                'question' => 'Sulit mengendalikan rasa khawatir yang berlebihan.',
                'cf_pakar' => 0.7,
                'category' => 'Anxiety'
            ],
            [
                'code' => 'G06',
                'question' => 'Mengalami detak jantung kencang, sesak napas, atau gemetar tiba-tiba (Panic Attack).',
                'cf_pakar' => 0.9,
                'category' => 'Panic Attack'
            ],
            [
                'code' => 'G07',
                'question' => 'Penurunan performa akademik (IPK di bawah 2.5 atau merasa sulit konsentrasi belajar).',
                'cf_pakar' => 0.6,
                'category' => 'Akademik'
            ],
            [
                'code' => 'G08',
                'question' => 'Tidak memiliki akses atau belum pernah mendapatkan bantuan profesional sebelumnya.',
                'cf_pakar' => 0.5,
                'category' => 'Urgensi'
            ],
        ];

        foreach ($symptoms as $symptom) {
            Symptom::create($symptom);
        }
    }
}