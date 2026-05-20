<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Menampilkan form lengkapi profil
    public function showOnboarding()
    {
        $user = Auth::user();
        
        // Jika sudah lengkap, langsung lempar ke halaman kuesioner/consent
        if ($user->is_profile_completed) {
            return redirect()->route('kuesioner.consent');
        }

        return view('mahasiswa.onboarding');
    }

    // Menyimpan data profil
    public function saveOnboarding(Request $request)
    {
        // 1. Cek apakah data masuk ke sini (Hapus baris ini jika sudah fix)
        // dd($request->all()); 

        $request->validate([
            'gender' => 'required|in:Laki-laki,Perempuan',
            'age' => 'required|numeric|min:16|max:40',
            'course' => 'required|string|max:100',
            'current_year' => 'required|numeric|min:1|max:7',
            'gpa' => 'required|numeric|min:0|max:4',
            'marital_status' => 'required|in:Belum Menikah,Menikah',
        ]);

        $user = User::find(Auth::id());
        
        // 2. Isi data satu per satu untuk memastikan masuk ke objek
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->course = $request->course;
        $user->current_year = $request->current_year;
        $user->gpa = $request->gpa;
        $user->marital_status = $request->marital_status;
        $user->is_profile_completed = true;

        // 3. Simpan dan cek apakah berhasil
        if($user->save()){
            return redirect()->route('mahasiswa.dashboard')->with('success', 'Profil berhasil diperbarui!');
        } else {
            return back()->withErrors(['msg' => 'Gagal menyimpan data ke database.']);
        }
    }
}