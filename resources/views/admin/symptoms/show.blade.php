@extends('layouts.main')

@section('title', 'Detail Gejala - ' . $symptom->code)

@section('content')
<div class="max-w-3xl mx-auto px-6 lg:px-8 py-10">

    <div class="mb-8">
        <a href="{{ route('admin.symptoms.index') }}" class="text-deep-teal font-bold hover:underline flex items-center gap-2 mb-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Manajemen Kuesioner
        </a>
        <h1 class="text-3xl font-extrabold text-deep-teal mb-2">Detail Gejala</h1>
        <p class="text-[#5F6F6D]">Informasi lengkap tentang gejala <span class="font-bold">{{ $symptom->code }}</span>.</p>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-[30px] shadow-xl border border-mint-soft/20 p-8">
        
        <!-- Header dengan Kode -->
        <div class="flex items-center justify-between mb-8 pb-6 border-b border-mint-soft/20">
            <div>
                <h2 class="text-2xl font-bold text-deep-teal mb-2">{{ $symptom->code }}</h2>
                <p class="text-[#5F6F6D]">Dibuat pada <strong>{{ $symptom->created_at->format('d M Y H:i') }}</strong></p>
            </div>
            <div class="bg-deep-teal/10 p-4 rounded-2xl">
                <div class="text-4xl font-extrabold text-soft-orange text-center">
                    {{ number_format($symptom->cf_pakar, 2) }}
                </div>
                <p class="text-xs font-bold text-deep-teal text-center mt-1">CF Pakar</p>
            </div>
        </div>

        <!-- Pertanyaan/Gejala -->
        <div class="mb-6">
            <p class="text-sm font-bold text-mint-soft uppercase tracking-wider mb-2">Pertanyaan/Gejala</p>
            <div class="bg-cream/30 rounded-2xl p-4 border border-mint-soft/20">
                <p class="text-base text-deep-teal leading-relaxed">{{ $symptom->question }}</p>
            </div>
        </div>

        <!-- Kategori -->
        <div class="mb-6">
            <p class="text-sm font-bold text-mint-soft uppercase tracking-wider mb-2">Kategori</p>
            <div>
                <span class="bg-soft-teal/20 text-soft-teal px-4 py-2 rounded-lg text-sm font-bold border border-soft-teal/30">
                    {{ $symptom->category }}
                </span>
            </div>
        </div>

        <!-- Certainty Factor Info -->
        <div class="mb-6">
            <p class="text-sm font-bold text-mint-soft uppercase tracking-wider mb-2">Certainty Factor (CF) Pakar</p>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-mint-soft/10 rounded-2xl p-4 border border-mint-soft/20">
                    <p class="text-xs text-mint-soft font-bold uppercase mb-1">Nilai CF</p>
                    <p class="text-2xl font-extrabold text-soft-orange">{{ number_format($symptom->cf_pakar, 2) }}</p>
                </div>
                <div class="bg-soft-teal/10 rounded-2xl p-4 border border-soft-teal/20">
                    <p class="text-xs text-soft-teal font-bold uppercase mb-1">Persentase</p>
                    <p class="text-2xl font-extrabold text-deep-teal">{{ intval($symptom->cf_pakar * 100) }}%</p>
                </div>
            </div>
            <div class="mt-4 bg-soft-orange/10 border border-soft-orange/20 rounded-2xl p-4">
                <p class="text-sm text-deep-teal">
                    <strong>📊 Interpretasi:</strong> Pakar yakin <strong>{{ intval($symptom->cf_pakar * 100) }}%</strong> 
                    bahwa gejala ini adalah indikator dari kondisi psikologis yang dievaluasi.
                </p>
            </div>
        </div>

        <!-- Usage Statistics -->
        <div class="mb-6">
            <p class="text-sm font-bold text-mint-soft uppercase tracking-wider mb-2">Statistik Penggunaan</p>
            <div class="bg-deep-teal/10 rounded-2xl p-4 border border-deep-teal/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-deep-teal font-bold uppercase mb-1">Total Asesmen Menggunakan Gejala Ini</p>
                        <p class="text-3xl font-extrabold text-deep-teal">{{ $assessmentCount }}</p>
                    </div>
                    @if($assessmentCount > 0)
                    <div class="text-right">
                        <p class="text-xs text-[#5F6F6D]">Gejala ini sudah</p>
                        <p class="text-sm font-bold text-soft-orange">SEDANG DIGUNAKAN</p>
                    </div>
                    @else
                    <div class="text-right">
                        <p class="text-xs text-[#5F6F6D]">Belum ada yang</p>
                        <p class="text-sm font-bold text-mint-soft">MENGGUNAKAN</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Timestamps -->
        <div class="grid grid-cols-2 gap-4 mb-8 p-4 bg-cream/20 rounded-2xl border border-mint-soft/20">
            <div>
                <p class="text-xs text-[#5F6F6D] font-bold uppercase mb-1">Dibuat Pada</p>
                <p class="font-semibold text-deep-teal">{{ $symptom->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-xs text-[#5F6F6D] font-bold uppercase mb-1">Terakhir Diubah</p>
                <p class="font-semibold text-deep-teal">{{ $symptom->updated_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 pt-4 border-t border-mint-soft/20">
            <a href="{{ route('admin.symptoms.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-xl transition-colors text-center">
                Kembali
            </a>
            <a href="{{ route('admin.symptoms.edit', $symptom) }}" class="flex-1 bg-deep-teal hover:bg-soft-teal text-white font-bold py-3 px-6 rounded-xl transition-colors text-center flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Gejala
            </a>
            <form action="{{ route('admin.symptoms.destroy', $symptom) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus gejala ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-soft-orange hover:bg-soft-orange/90 text-white font-bold py-3 px-6 rounded-xl transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>

    </div>

    <!-- Info Box -->
    <div class="mt-8 bg-soft-teal/10 border border-soft-teal/30 rounded-2xl p-4">
        <p class="text-sm text-deep-teal">
            <strong>💡 Catatan:</strong> Jika gejala ini sudah digunakan dalam asesmen, data historis asesmen tidak akan berubah 
            meskipun Anda mengubah CF Pakar-nya. Perubahan hanya berlaku untuk asesmen baru.
        </p>
    </div>

</div>
@endsection
