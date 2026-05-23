<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment; 
use App\Exports\AntreanExport;
// Panggil langsung namespace utamanya di sini tanpa lewat alias
use Barryvdh\DomPDF\PDF as DomPdfInstance;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function eksporExcelAdmin()
    {
        return Excel::download(new AntreanExport, 'Laporan_Bulanan_Senandika.xlsx');
    }
    /**
     * Cetak Rekam Psikologis PDF A4 untuk Konselor (Laravel 11 Version)
     */
    public function cetakRekamPsikologisPDF($id)
    {
        ini_set('memory_limit', '256M');

        // 1. Ambil data dari database beserta relasi user dan gejala kuesionernya
        $assessment = Assessment::with(['user', 'details.symptom'])->findOrFail($id);

        // 2. Buat objek DomPDF langsung menggunakan container bawaan aplikasi
        $pdf = app('dompdf.wrapper');
        
        // 3. Load view HTML dan atur ukuran kertas
        $pdf->loadView('admin.cetak_pdf', compact('assessment'))
            ->setPaper('a4', 'portrait');

        // 4. Unduh file PDF otomatis
        return $pdf->download('Rekam_Psikologis_' . $assessment->user->nim . '.pdf');
    }
}