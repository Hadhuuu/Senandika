@extends('layouts.main')

@section('title', 'Lengkapi Profil')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center p-6 bg-gradient-to-br from-cream to-warm-beige">
    <div class="bg-white/60 backdrop-blur-md p-8 md:p-10 rounded-[40px] shadow-xl border border-white/50 w-full max-w-2xl animate-[fadeIn_0.5s_ease]">
        
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-deep-teal mb-2">Ceritakan Sedikit Tentangmu</h2>
            <p class="text-[#5F6F6D]">Agar kami bisa memberikan dukungan yang tepat sasaran, lengkapi data akademikmu di bawah ini.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                Terdapat kesalahan pada isianmu. Pastikan semua terisi dengan benar.
            </div>
        @endif

        <form action="{{ route('onboarding.save') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-deep-teal mb-2 ml-1">Usia</label>
                    <input type="number" name="age" required min="16" max="40" value="{{ old('age') }}" placeholder="Contoh: 20"
                           class="w-full px-5 py-3 rounded-2xl bg-white/50 border border-mint-soft/30 focus:outline-none focus:border-soft-teal focus:ring-1 focus:ring-soft-teal transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-deep-teal mb-2 ml-1">Jenis Kelamin</label>
                    <select name="gender" required class="w-full px-5 py-3 rounded-2xl bg-white/50 border border-mint-soft/30 focus:outline-none focus:border-soft-teal focus:ring-1 focus:ring-soft-teal transition-all text-[#5F6F6D]">
                        <option value="" disabled selected>Pilih...</option>
                        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-deep-teal mb-2 ml-1">Jurusan / Program Studi</label>
                    <input type="text" name="course" required value="{{ old('course') }}" placeholder="Contoh: Teknik Informatika"
                           class="w-full px-5 py-3 rounded-2xl bg-white/50 border border-mint-soft/30 focus:outline-none focus:border-soft-teal focus:ring-1 focus:ring-soft-teal transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-deep-teal mb-2 ml-1">Tahun Kuliah (Ke-)</label>
                    <select name="current_year" required class="w-full px-5 py-3 rounded-2xl bg-white/50 border border-mint-soft/30 focus:outline-none focus:border-soft-teal focus:ring-1 focus:ring-soft-teal transition-all text-[#5F6F6D]">
                        <option value="" disabled selected>Pilih Tahun...</option>
                        <option value="1" {{ old('current_year') == '1' ? 'selected' : '' }}>Tahun ke-1 (Maba)</option>
                        <option value="2" {{ old('current_year') == '2' ? 'selected' : '' }}>Tahun ke-2</option>
                        <option value="3" {{ old('current_year') == '3' ? 'selected' : '' }}>Tahun ke-3</option>
                        <option value="4" {{ old('current_year') == '4' ? 'selected' : '' }}>Tahun ke-4 (Tingkat Akhir)</option>
                        <option value="5" {{ old('current_year') == '5' ? 'selected' : '' }}>Tahun ke-5+</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-deep-teal mb-2 ml-1">Kisaran IPK (GPA)</label>
                    <input type="number" name="gpa" required step="0.01" min="0" max="4" value="{{ old('gpa') }}" placeholder="Contoh: 3.50"
                           class="w-full px-5 py-3 rounded-2xl bg-white/50 border border-mint-soft/30 focus:outline-none focus:border-soft-teal focus:ring-1 focus:ring-soft-teal transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-deep-teal mb-2 ml-1">Status Pernikahan</label>
                    <select name="marital_status" required class="w-full px-5 py-3 rounded-2xl bg-white/50 border border-mint-soft/30 focus:outline-none focus:border-soft-teal focus:ring-1 focus:ring-soft-teal transition-all text-[#5F6F6D]">
                        <option value="" disabled selected>Pilih...</option>
                        <option value="Belum Menikah" {{ old('marital_status') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                        <option value="Menikah" {{ old('marital_status') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                    </select>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-gradient-to-r from-deep-teal to-soft-teal text-white py-4 rounded-[20px] text-lg font-bold hover:shadow-xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                    Simpan & Lanjutkan
                </button>
            </div>
        </form>

    </div>
</div>
@endsection