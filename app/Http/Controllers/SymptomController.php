<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SymptomController extends Controller
{
    // Proteksi: Hanya admin yang bisa akses
    private function checkAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak. Hanya Admin yang dapat mengelola Master Gejala.');
        }
    }

    // Menampilkan daftar semua gejala dengan search/filter
    public function index(Request $request)
    {
        $this->checkAdmin();
        
        $query = Symptom::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('code', 'like', "%$search%")
                  ->orWhere('question', 'like', "%$search%")
                  ->orWhere('category', 'like', "%$search%");
        }

        // Filter by category if provided
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        $symptoms = $query->orderBy('category')
            ->orderBy('code')
            ->paginate(20);

        // Get unique categories for filter dropdown
        $categories = Symptom::pluck('category')->unique()->values();

        return view('admin.symptoms.index', compact('symptoms', 'categories'));
    }

    // Menampilkan form tambah gejala
    public function create()
    {
        $this->checkAdmin();
        
        $categories = Symptom::pluck('category')->unique()->values();
        return view('admin.symptoms.create', compact('categories'));
    }

    // Menyimpan gejala baru ke database
    public function store(Request $request)
    {
        $this->checkAdmin();
        
        $validated = $request->validate([
            'code' => 'required|string|unique:symptoms,code|max:10',
            'question' => 'required|string|max:500',
            'category' => 'required|string|max:50',
            // Numeric between 0 and 1, allow up to 2 decimal places
            'cf_pakar' => ['required','numeric','between:0,1','regex:/^\d+(\.\d{1,2})?$/'],
        ], [
            'code.unique' => 'Kode gejala sudah terdaftar. Gunakan kode yang berbeda.',
            'cf_pakar.between' => 'CF Pakar harus berada di antara 0.00 sampai 1.00.',
            'cf_pakar.regex' => 'CF Pakar harus memiliki maksimal 2 angka desimal (misal: 0.80, 0.95).',
        ]);

        Symptom::create($validated);

        return redirect()->route('admin.symptoms.index')
            ->with('success', 'Gejala baru berhasil ditambahkan!');
    }

    // Menampilkan form edit gejala
    public function edit(Symptom $symptom)
    {
        $this->checkAdmin();
        
        $categories = Symptom::pluck('category')->unique()->values();
        return view('admin.symptoms.edit', compact('symptom', 'categories'));
    }

    // Menyimpan perubahan gejala
    public function update(Request $request, Symptom $symptom)
    {
        $this->checkAdmin();
        
        $validated = $request->validate([
            'code' => 'required|string|unique:symptoms,code,' . $symptom->id . '|max:10',
            'question' => 'required|string|max:500',
            'category' => 'required|string|max:50',
            // Numeric between 0 and 1, allow up to 2 decimal places
            'cf_pakar' => ['required','numeric','between:0,1','regex:/^\d+(\.\d{1,2})?$/'],
        ], [
            'code.unique' => 'Kode gejala sudah terdaftar. Gunakan kode yang berbeda.',
            'cf_pakar.between' => 'CF Pakar harus berada di antara 0.00 sampai 1.00.',
            'cf_pakar.regex' => 'CF Pakar harus memiliki maksimal 2 angka desimal (misal: 0.80, 0.95).',
        ]);

        $symptom->update($validated);

        return redirect()->route('admin.symptoms.index')
            ->with('success', 'Gejala berhasil diperbarui!');
    }

    // Menghapus gejala
    public function destroy(Symptom $symptom)
    {
        $this->checkAdmin();
        
        // Cek apakah gejala sudah digunakan dalam assessment
        $usedInAssessment = $symptom->assessmentDetails()->count();

        if ($usedInAssessment > 0) {
            return back()->with('error', 'Tidak dapat menghapus gejala yang sudah digunakan dalam asesmen. ('.$usedInAssessment.' asesmen)');
        }

        $symptom->delete();
        return redirect()->route('admin.symptoms.index')
            ->with('success', 'Gejala berhasil dihapus!');
    }

    // Menampilkan detail gejala (optional, bisa untuk quick view)
    public function show(Symptom $symptom)
    {
        $this->checkAdmin();
        
        $assessmentCount = $symptom->assessmentDetails()->count();
        return view('admin.symptoms.show', compact('symptom', 'assessmentCount'));
    }
}
