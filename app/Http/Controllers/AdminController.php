<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;

class AdminController extends Controller
{
    // Menampilkan Dashboard Utama Admin
    public function index(Request $request)
    {
        // Proteksi ekstra: Pastikan hanya admin yang bisa masuk
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak. Anda bukan Admin.');
        }

        $query = Assessment::with('user');

        // Filter Pencarian (Nama / NIM)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan Kategori
        if ($request->filled('category')) {
            $query->where('dominant_category', $request->category);
        }

        // Ambil data, urutkan dari skor CF tertinggi (DESC), dan beri paginasi
        $perPage = $request->input('per_page', 10);
        $assessments = $query->orderBy('final_score', 'desc')->paginate($perPage)->appends($request->query());

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

    // Mengubah status penanganan secara massal (sekaligus dengan status berbeda-beda)
    public function saveAllStatus(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'statuses' => 'required|array',
            'statuses.*' => 'in:Belum Diproses,Menunggu Jadwal,Sedang Konseling,Selesai'
        ]);

        foreach ($request->statuses as $id => $status) {
            Assessment::where('id', $id)->update(['status' => $status]);
        }

        return back()->with('success', 'Semua perubahan status berhasil disimpan!');
    }

    // Menampilkan detail hasil asesmen
    public function showDetail($id)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        // Ambil data asesmen beserta relasi detail (jawaban kuesioner) dan gejalanya
        $assessment = Assessment::with(['user', 'details.symptom'])->findOrFail($id);

        return view('admin.detail', compact('assessment'));
    }

    public function importMahasiswa(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            // Proses import
            Excel::import(new MahasiswaImport, $request->file('file_excel'));
            
            return back()->with('success', 'Data mahasiswa berhasil diimport! Password default mereka adalah: senandika123');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Terjadi kesalahan saat import: ' . $e->getMessage()]);
        }
    }
}