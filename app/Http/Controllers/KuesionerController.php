<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Symptom;
use App\Models\Assessment;
use App\Models\AssessmentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuesionerController extends Controller
{
    // 1. Tampilkan Halaman Consent
    public function showConsent()
    {
        return view('mahasiswa.consent');
    }

    // 2. Setuju Consent -> Mulai Kuesioner
    public function acceptConsent(Request $request)
    {
        $request->session()->forget('answers');
        return redirect()->route('kuesioner.show');
    }

    // 3. Tampilkan Pertanyaan (Satu per Satu)
    public function showQuestion(Request $request)
    {
        $symptoms = Symptom::orderBy('id', 'asc')->get();
        $answers = $request->session()->get('answers', []);

        $currentSymptom = $symptoms->first(function ($symptom) use ($answers) {
            return !array_key_exists($symptom->id, $answers);
        });

        if (!$currentSymptom) {
            return redirect()->route('kuesioner.calculate');
        }

        $totalQuestions = $symptoms->count();
        $currentNumber = count($answers) + 1;

        return view('mahasiswa.kuesioner', compact('currentSymptom', 'totalQuestions', 'currentNumber'));
    }

    // 4. Simpan Jawaban Sementara ke Session
    public function answerQuestion(Request $request)
    {
        $request->validate([
            'symptom_id' => 'required|exists:symptoms,id',
            'cf_user' => 'required|numeric'
        ]);

        $answers = $request->session()->get('answers', []);
        $answers[$request->symptom_id] = $request->cf_user;
        $request->session()->put('answers', $answers);

        return redirect()->route('kuesioner.show');
    }

    // --- FUNGSI HELPER UNTUK RUMUS CF COMBINE ---
    private function combineCF($cf_old, $cf_new)
    {
        if ($cf_old == 0) return $cf_new;
        return $cf_old + $cf_new * (1 - $cf_old);
    }

    // 5. Rumus Mesin CF (Gejala + Demografi) & Simpan ke Database
    public function calculateResult(Request $request)
    {
        $answers = $request->session()->get('answers', []);
        
        if (empty($answers)) {
            return redirect()->route('kuesioner.consent');
        }

        // Ambil data user beserta demografinya
        $user = User::find(Auth::id());
        $symptoms = Symptom::whereIn('id', array_keys($answers))->get();
        
        $cf_gejala_total = 0;
        $category_scores = [];

        // Buat Header Assessment
        $assessment = Assessment::create([
            'user_id' => $user->id,
            'status' => 'Belum Diproses'
        ]);

        // FASE 1: KALKULASI CF DARI GEJALA (JAWABAN KUESIONER)
        foreach ($symptoms as $symptom) {
            $cf_user = $answers[$symptom->id];
            $cf_pakar = $symptom->cf_pakar;

            // Hitung bobot per gejala (E * P)
            $cf_gejala = $cf_user * $cf_pakar;

            // Simpan rincian jawaban ke tabel detail
            AssessmentDetail::create([
                'assessment_id' => $assessment->id,
                'symptom_id' => $symptom->id,
                'cf_user' => $cf_user,
            ]);

            // Kombinasikan nilai CF Gejala
            $cf_gejala_total = $this->combineCF($cf_gejala_total, $cf_gejala);

            // Klasifikasi dominan
            if (!isset($category_scores[$symptom->category])) {
                $category_scores[$symptom->category] = 0;
            }
            $category_scores[$symptom->category] += $cf_gejala;
        }

        // Cari kategori penyakit yang paling dominan
        $dominant_category = array_keys($category_scores, max($category_scores))[0];

        // FASE 2: KALKULASI CF DARI FAKTOR RISIKO DEMOGRAFI (DATA KAGGLE)
        $cf_risiko_total = 0;

        // Rule A: Stress Akademik Berat (Tingkat Akhir & IPK Rendah)
        if ($user->current_year >= 4 && $user->gpa < 2.5) {
            $cf_risiko_total = $this->combineCF($cf_risiko_total, 0.20);
        }

        // Rule B: Culture Shock Akademik (Mahasiswa Baru)
        if ($user->current_year == 1) {
            $cf_risiko_total = $this->combineCF($cf_risiko_total, 0.10);
        }

        // Rule C: Beban Ganda (Sudah Menikah sambil Kuliah)
        if ($user->marital_status === 'Menikah') {
            $cf_risiko_total = $this->combineCF($cf_risiko_total, 0.15);
        }

        // FASE 3: GABUNGKAN CF GEJALA & CF RISIKO DEMOGRAFI
        $cf_akhir = $this->combineCF($cf_gejala_total, $cf_risiko_total);
        
        // Ubah jadi persentase
        $final_score_percentage = round($cf_akhir * 100, 2);

        // Update hasil akhir ke database
        $assessment->update([
            'final_score' => $final_score_percentage,
            'dominant_category' => $dominant_category
        ]);

        // Bersihkan session
        $request->session()->forget('answers');

        return redirect()->route('kuesioner.resolusi');
    }

    // 6. Halaman Resolusi (Penutup)
    public function showResolution()
    {
        return view('mahasiswa.resolusi');
    }
}