@extends('layouts.main')

@section('title', 'Alur Pelayanan')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
    
    <!-- 1. HEADER TITLE -->
    <div class="text-center mb-20">
        <h1 class="text-4xl md:text-5xl font-extrabold text-deep-teal mb-4 tracking-tight">Alur Pelayanan</h1>
        <p class="text-soft-teal max-w-2xl mx-auto text-base md:text-lg font-medium">
            Proses skrining dan pendampingan kesehatan mental yang mudah, aman, dan terstruktur.
        </p>
    </div>

    <!-- 2. TIMELINE VERTIKAL ZIG-ZAG -->
    <div class="relative wrap overflow-hidden p-4 h-full mb-24">
        <div class="absolute border border-mint-soft/30 h-full left-1/2 transform -translate-x-1/2 hidden md:block"></div>

        <!-- LANGKAH 1 -->
        <div class="mb-12 flex justify-between flex-row-reverse md:flex-row items-center w-full">
            <div class="w-full md:w-5/12 bg-white rounded-[24px] shadow-xl shadow-deep-teal/5 p-8 border border-mint-soft/10">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-extrabold text-deep-teal text-xl">1. Skrining Awal</h3>
                    <div class="p-3 bg-mint-soft/10 rounded-xl text-deep-teal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-[#5F6F6D] leading-relaxed font-medium">
                    Isi kuesioner skrining dengan indikasi gejala yang Anda rasakan. Proses hanya memakan waktu 3-5 menit dan data privasi Anda sepenuhnya dijamin aman.
                </p>
            </div>
            <div class="z-20 flex items-center bg-deep-teal shadow-lg w-10 h-10 rounded-full md:mx-auto border-4 border-cream">
                <h1 class="mx-auto font-extrabold text-sm text-white">1</h1>
            </div>
            <div class="w-5/12 hidden md:block"></div>
        </div>

        <!-- LANGKAH 2 -->
        <div class="mb-12 flex justify-between items-center w-full">
            <div class="w-5/12 hidden md:block"></div>
            <div class="z-20 flex items-center bg-mint-soft shadow-lg w-10 h-10 rounded-full md:mx-auto border-4 border-cream">
                <h1 class="mx-auto font-extrabold text-sm text-white">2</h1>
            </div>
            <div class="w-full md:w-5/12 bg-white rounded-[24px] shadow-xl shadow-deep-teal/5 p-8 border border-mint-soft/10">
                <div class="flex justify-between items-start mb-4 md:flex-row-reverse">
                    <h3 class="font-extrabold text-deep-teal text-xl md:text-right w-full">2. Analisis Hasil</h3>
                    <div class="p-3 bg-mint-soft/10 rounded-xl text-soft-teal md:mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-[#5F6F6D] leading-relaxed font-medium md:text-right">
                    Sistem mengukur jawaban Anda menggunakan mesin inferensi Certainty Factor (CF) untuk memberikan hasil tingkat urgensi kondisi kesehatan mental Anda secara akurat.
                </p>
            </div>
        </div>

        <!-- LANGKAH 3 -->
        <div class="mb-12 flex justify-between flex-row-reverse md:flex-row items-center w-full">
            <div class="w-full md:w-5/12 bg-white rounded-[24px] shadow-xl shadow-deep-teal/5 p-8 border border-mint-soft/10">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="font-extrabold text-deep-teal text-xl">3. Rekomendasi Personal</h3>
                    <div class="p-3 bg-mint-soft/10 rounded-xl text-soft-orange">
                        <svg xmlns="http://www.w3.org/2000/xl" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-[#5F6F6D] leading-relaxed font-medium">
                    Berdasarkan skor kepastian sistem, Anda mendapatkan rekomendasi penanganan awal yang disesuaikan khusus untuk meredakan kecemasan atau tingkat stres Anda.
                </p>
            </div>
            <div class="z-20 flex items-center bg-soft-orange shadow-lg w-10 h-10 rounded-full md:mx-auto border-4 border-cream">
                <h1 class="mx-auto font-extrabold text-sm text-white">3</h1>
            </div>
            <div class="w-5/12 hidden md:block"></div>
        </div>

        <!-- LANGKAH 4 -->
        <div class="mb-12 flex justify-between items-center w-full">
            <div class="w-5/12 hidden md:block"></div>
            <div class="z-20 flex items-center bg-soft-teal shadow-lg w-10 h-10 rounded-full md:mx-auto border-4 border-cream">
                <h1 class="mx-auto font-extrabold text-sm text-white">4</h1>
            </div>
            <div class="w-full md:w-5/12 bg-white rounded-[24px] shadow-xl shadow-deep-teal/5 p-8 border border-mint-soft/10">
                <div class="flex justify-between items-start mb-4 md:flex-row-reverse">
                    <h3 class="font-extrabold text-deep-teal text-xl md:text-right w-full">4. Konseling (Opsional)</h3>
                    <div class="p-3 bg-mint-soft/10 rounded-xl text-soft-teal md:mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm text-[#5F6F6D] leading-relaxed font-medium md:text-right">
                    Jika tingkat urgensi bernilai tinggi, data antrean Anda akan masuk ke Konselor Kampus untuk penjadwalan sesi konseling tatap muka atau daring lebih lanjut.
                </p>
            </div>
        </div>
    </div>

    <!-- 3. KOTAK EDUKASI -->
    <div class="bg-white rounded-[32px] p-8 md:p-12 shadow-xl shadow-deep-teal/5 border border-mint-soft/20">
        <div class="text-center mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-soft-orange bg-soft-orange/10 px-4 py-1.5 rounded-full">Metode Sistem Pakar</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-deep-teal mt-4 mb-4">Mengenal Certainty Factor (CF)</h2>
            <p class="text-[#5F6F6D] text-sm md:text-base leading-relaxed max-w-4xl mx-auto font-medium">
                Certainty Factor adalah metode yang digunakan oleh sistem pakar Senandika untuk menghitung tingkat keyakinan atau kepastian pakar terhadap suatu kondisi emosional berdasarkan akumulasi gejala yang Anda konfirmasi saat kuesioner.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-cream/40 rounded-2xl p-6 border border-mint-soft/10">
                <h4 class="font-extrabold text-deep-teal text-base mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-soft-orange"></span> Keunggulan Analisis CF
                </h4>
                <ul class="space-y-3 text-sm text-[#5F6F6D] font-medium">
                    <li class="flex items-start gap-2"><span class="text-soft-orange font-bold">•</span> Mengakomodasi ketidakpastian perasaan manusia secara matematis.</li>
                    <li class="flex items-start gap-2"><span class="text-soft-orange font-bold">•</span> Hasil akhir diagnosis jauh lebih presisi dibandingkan kuesioner biasa.</li>
                    <li class="flex items-start gap-2"><span class="text-soft-orange font-bold">•</span> Membantu psikolog kampus memprioritaskan mahasiswa yang kritis.</li>
                </ul>
            </div>

            <div class="bg-cream/40 rounded-2xl p-6 border border-mint-soft/10">
                <h4 class="font-extrabold text-deep-teal text-base mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-deep-teal"></span> Tingkat Variabel Keyakinan
                </h4>
                <div class="grid grid-cols-2 gap-2 text-xs text-[#5F6F6D] font-bold">
                    <div class="bg-white p-3 rounded-xl border border-mint-soft/10">Pasti Tidak (-1.0)</div>
                    <div class="bg-white p-3 rounded-xl border border-mint-soft/10">Mungkin Tidak (-0.6)</div>
                    <div class="bg-white p-3 rounded-xl border border-mint-soft/10">Ragu-ragu (0.0)</div>
                    <div class="bg-white p-3 rounded-xl border border-mint-soft/10">Mungkin (0.6)</div>
                    <div class="bg-gradient-to-r from-deep-teal to-soft-teal text-white p-3 rounded-xl col-span-2 text-center shadow-md">Sangat Yakin (1.0)</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
