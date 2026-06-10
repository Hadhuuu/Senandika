<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Pengecekan agar baris kosong diabaikan
        if (!isset($row['nim'])) {
            return null;
        }

        // Cek apakah NIM sudah ada (menghindari duplikasi)
        $existingUser = User::where('nim', $row['nim'])->first();
        if ($existingUser) {
            return null;
        }

        // Buat instance user baru
        $user = new User();
        
        // Isi data secara spesifik (bypass mass assignment restriction)
        $user->nim = $row['nim'];
        $user->name = $row['nama_lengkap'];
        $user->password = Hash::make('senandika123');
        $user->role = 'mahasiswa';
        $user->is_profile_completed = false;

        return $user;
    }
}