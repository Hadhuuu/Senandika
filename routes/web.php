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
    Route::post('/admin/assessment/{id}/status', [App\Http\Controllers\AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::get('/admin/assessment/{id}', [App\Http\Controllers\AdminController::class, 'showDetail'])->name('admin.detail');
    // Rute Mahasiswa Kuesioner
    Route::get('/mahasiswa/consent', [KuesionerController::class, 'showConsent'])->name('kuesioner.consent');
    Route::post('/mahasiswa/consent', [KuesionerController::class, 'acceptConsent'])->name('kuesioner.accept');
    
    Route::get('/mahasiswa/kuesioner', [KuesionerController::class, 'showQuestion'])->name('kuesioner.show');
    Route::post('/mahasiswa/kuesioner', [KuesionerController::class, 'answerQuestion'])->name('kuesioner.answer');
    
    Route::get('/mahasiswa/calculate', [KuesionerController::class, 'calculateResult'])->name('kuesioner.calculate');
    Route::get('/mahasiswa/resolusi', [KuesionerController::class, 'showResolution'])->name('kuesioner.resolusi');

    // Rute Onboarding (Profil)
    Route::get('/mahasiswa/onboarding', [App\Http\Controllers\ProfileController::class, 'showOnboarding'])->name('onboarding.show');
    Route::post('/mahasiswa/onboarding', [App\Http\Controllers\ProfileController::class, 'saveOnboarding'])->name('onboarding.save');

    // Dashboard Mahasiswa
    Route::get('/mahasiswa/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('mahasiswa.dashboard');

    // Route untuk Admin mengunduh rekapitulasi Excel
    Route::get('/admin/ekspor-excel', [ReportController::class, 'eksporExcelAdmin'])->name('admin.export.excel');

    // Route untuk Konselor mencetak berkas PDF sebelum konseling
    Route::get('/konselor/cetak-pdf/{id}', [ReportController::class, 'cetakRekamPsikologisPDF'])->name('konselor.cetak.pdf');
});