<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan ini ditambahkan!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Cari user secara eksplisit berdasarkan ID agar editor tidak rewel
        $user = User::find(Auth::id());

        // Nanti untuk admin kita pisahkan
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard'); 
        }

        // Ambil riwayat tes mahasiswa ini (diurutkan dari yang terbaru)
        $riwayat = $user->assessments()->orderBy('created_at', 'desc')->get();

        return view('mahasiswa.dashboard', compact('user', 'riwayat'));
    }
}