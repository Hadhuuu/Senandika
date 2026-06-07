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
            // KATEGORI DEPRESI (Adaptasi PHQ-9)
            [
                'code' => 'G01',
                'question' => 'Kurang berminat atau bergairah dalam melakukan hal-hal yang biasanya disukai.',
                'cf_pakar' => 0.8,
                'category' => 'Depresi'
            ],
            [
                'code' => 'G02',
                'question' => 'Merasa murung, sedih, atau putus asa.',
                'cf_pakar' => 0.9,
                'category' => 'Depresi'
            ],
            [
                'code' => 'G03',
                'question' => 'Sulit tidur, mudah terbangun, atau justru terlalu banyak tidur.',
                'cf_pakar' => 0.6,
                'category' => 'Depresi'
            ],
            [
                'code' => 'G04',
                'question' => 'Merasa lelah atau kurang bertenaga hampir setiap saat.',
                'cf_pakar' => 0.5,
                'category' => 'Depresi'
            ],

            // KATEGORI ANXIETY (Adaptasi GAD-7)
            [
                'code' => 'G05',
                'question' => 'Merasa gugup, cemas, atau sangat tegang.',
                'cf_pakar' => 0.8,
                'category' => 'Anxiety'
            ],
            [
                'code' => 'G06',
                'question' => 'Tidak mampu menghentikan atau mengendalikan rasa khawatir.',
                'cf_pakar' => 0.9,
                'category' => 'Anxiety'
            ],
            [
                'code' => 'G07',
                'question' => 'Menjadi mudah marah, jengkel, atau tersinggung.',
                'cf_pakar' => 0.6,
                'category' => 'Anxiety'
            ],

            // KATEGORI PANIC ATTACK
            [
                'code' => 'G08',
                'question' => 'Mengalami serangan panik mendadak (jantung berdebar keras, sesak napas, gemetar) tanpa alasan jelas.',
                'cf_pakar' => 0.9,
                'category' => 'Panic Attack'
            ],
        ];
        
        foreach ($symptoms as $symptom) {
            Symptom::create($symptom);
        }
    }
}