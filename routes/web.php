<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\ReportController;


// Halaman Landing Page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->name('tentang-kami');

Route::get('/kontak-darurat', function () {
    return view('kontak-darurat');
})->name('kontak-darurat');

// Rute untuk menampilkan halaman Alur Pelayanan publik
Route::view('/alur-pelayanan', 'alur_pelayanan')->name('alur-pelayanan');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

// Rute Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Sementara (Placeholder) untuk ngetes berhasil login atau tidak
Route::middleware('auth')->group(function () {
    // --- RUTE ADMIN / KONSELOR ---
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/assessment/save-all-status', [App\Http\Controllers\AdminController::class, 'saveAllStatus'])->name('admin.saveAllStatus');
    Route::post('/admin/assessment/{id}/status', [App\Http\Controllers\AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::get('/admin/assessment/{id}', [App\Http\Controllers\AdminController::class, 'showDetail'])->name('admin.detail');
    
    // --- RUTE MASTER DATA MANAGEMENT (SYMPTOMS) ---
    Route::resource('admin/symptoms', App\Http\Controllers\SymptomController::class, [
        'names' => [
            'index' => 'admin.symptoms.index',
            'create' => 'admin.symptoms.create',
            'store' => 'admin.symptoms.store',
            'show' => 'admin.symptoms.show',
            'edit' => 'admin.symptoms.edit',
            'update' => 'admin.symptoms.update',
            'destroy' => 'admin.symptoms.destroy',
        ]
    ]);

    // --- RUTE ANALYTICS API (untuk Dashboard Grafik) ---
    Route::prefix('api/analytics')->name('api.analytics.')->group(function () {
        Route::get('monthly-urgency', [App\Http\Controllers\AnalyticsController::class, 'monthlyUrgency'])->name('monthly_urgency');
        Route::get('category-distribution', [App\Http\Controllers\AnalyticsController::class, 'categoryDistribution'])->name('category_distribution');
        Route::get('status-summary', [App\Http\Controllers\AnalyticsController::class, 'statusSummary'])->name('status_summary');
        Route::get('dashboard-stats', [App\Http\Controllers\AnalyticsController::class, 'dashboardStats'])->name('dashboard_stats');
        Route::get('dominant-category', [App\Http\Controllers\AnalyticsController::class, 'dominantCategoryAnalysis'])->name('dominant_category');
    });
    // Rute Mahasiswa Kuesioner
    Route::get('/mahasiswa/consent', [KuesionerController::class, 'showConsent'])->name('kuesioner.consent');
    Route::post('/mahasiswa/consent', [KuesionerController::class, 'acceptConsent'])->name('kuesioner.accept');
    
    Route::get('/mahasiswa/kuesioner', [KuesionerController::class, 'showQuestion'])->name('kuesioner.show');
    Route::post('/mahasiswa/kuesioner', [KuesionerController::class, 'answerQuestion'])->name('kuesioner.answer');
    Route::post('/mahasiswa/kuesioner/previous', [KuesionerController::class, 'previousQuestion'])->name('kuesioner.previous');

    
    Route::get('/mahasiswa/calculate', [KuesionerController::class, 'calculateResult'])->name('kuesioner.calculate');
    Route::get('/mahasiswa/resolusi', [KuesionerController::class, 'showResolution'])->name('kuesioner.resolusi');

    // Rute Edukasi Mahasiswa
    Route::get('/mahasiswa/edukasi', [App\Http\Controllers\EdukasiController::class, 'index'])->name('mahasiswa.edukasi');
    Route::get('/mahasiswa/edukasi/{id}', [App\Http\Controllers\EdukasiController::class, 'show'])->name('mahasiswa.edukasi.show');

    // Rute Onboarding (Profil)
    Route::get('/mahasiswa/onboarding', [App\Http\Controllers\ProfileController::class, 'showOnboarding'])->name('onboarding.show');
    Route::post('/mahasiswa/onboarding', [App\Http\Controllers\ProfileController::class, 'saveOnboarding'])->name('onboarding.save');

    // Dashboard Mahasiswa
    Route::get('/mahasiswa/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('mahasiswa.dashboard');

    // Route untuk Admin mengunduh rekapitulasi Excel
    Route::get('/admin/ekspor-excel', [ReportController::class, 'eksporExcelAdmin'])->name('admin.export.excel');

    // Import Mahasiswa
    Route::post('/admin/import-mahasiswa', [App\Http\Controllers\AdminController::class, 'importMahasiswa'])->name('admin.importMahasiswa');

    // Route untuk Konselor mencetak berkas PDF sebelum konseling
    Route::get('/konselor/cetak-pdf/{id}', [ReportController::class, 'cetakRekamPsikologisPDF'])->name('konselor.cetak.pdf');

});