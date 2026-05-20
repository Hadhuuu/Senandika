<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Menampilkan Dashboard Utama Admin
    public function index()
    {
        // Proteksi ekstra: Pastikan hanya admin yang bisa masuk
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak. Anda bukan Admin.');
        }

        // Ambil semua data asesmen, gabungkan dengan tabel users
        // Urutkan dari skor CF tertinggi (DESC)
        $assessments = Assessment::with('user')
            ->orderBy('final_score', 'desc')
            ->get();

        return view('admin.dashboard', compact('assessments'));
    }

    // Mengubah status penanganan
    public function updateStatus(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'status' => 'required|in:Belum Diproses,Menunggu Jadwal,Sedang Konseling,Selesai'
        ]);

        $assessment = Assessment::findOrFail($id);
        $assessment->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status penanganan berhasil diperbarui!');
    }

    // Menampilkan detail hasil asesmen
    public function showDetail($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        // Ambil data asesmen beserta relasi detail (jawaban kuesioner) dan gejalanya
        $assessment = Assessment::with(['user', 'details.symptom'])->findOrFail($id);

        return view('admin.detail', compact('assessment'));
    }
}