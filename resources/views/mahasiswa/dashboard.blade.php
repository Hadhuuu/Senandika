@extends('layouts.main')

@section('title', 'Beranda Mahasiswa')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">

    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-deep-teal mb-2">Halo, {{ $user->name }}!</h1>
        <p class="text-[#5F6F6D] text-lg">Selamat datang di ruang amanmu. Bagaimana perasaanmu hari ini?</p>
    </div>

    @if(session('success'))
        <div class="bg-mint-soft/20 border border-soft-teal text-deep-teal px-6 py-4 rounded-2xl mb-8 font-semibold animate-[fadeIn_0.5s_ease]">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            <!-- Quote Card -->
            <div class="bg-gradient-to-r from-soft-teal to-deep-teal rounded-[30px] p-8 md:p-10 text-white shadow-xl relative overflow-hidden flex items-center justify-between">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-mint-soft/20 rounded-full blur-2xl"></div>
                <div class="relative z-10 w-full md:w-3/4">
                    <svg class="w-10 h-10 text-mint-soft/50 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    <div class="min-h-[80px] flex items-start">
                        <p id="dashboard-quote-text" class="text-xl md:text-2xl font-bold leading-relaxed mb-2 transition-opacity duration-300 opacity-0">"Tidak apa-apa untuk merasa lelah, beristirahatlah sebentar, lalu kita melangkah lagi."</p>
                    </div>
                    <p class="text-mint-soft text-sm font-semibold tracking-wide mb-6">— Pesan Harian Senandika</p>
                    
                    <div class="flex gap-2 items-center">
                        <button onclick="changeDashboardQuote(0)" class="dash-quote-dot w-8 h-1.5 bg-white rounded-full transition-all duration-300 focus:outline-none"></button>
                        <button onclick="changeDashboardQuote(1)" class="dash-quote-dot w-3 h-1.5 bg-white/30 hover:bg-white/50 rounded-full transition-all duration-300 focus:outline-none cursor-pointer"></button>
                        <button onclick="changeDashboardQuote(2)" class="dash-quote-dot w-3 h-1.5 bg-white/30 hover:bg-white/50 rounded-full transition-all duration-300 focus:outline-none cursor-pointer"></button>
                        <button onclick="changeDashboardQuote(3)" class="dash-quote-dot w-3 h-1.5 bg-white/30 hover:bg-white/50 rounded-full transition-all duration-300 focus:outline-none cursor-pointer"></button>
                    </div>
                </div>
            </div>

            @if(!$user->is_profile_completed)
            <div class="bg-white/60 backdrop-blur-md rounded-[30px] p-8 border border-soft-orange/30 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-soft-orange/10 rounded-bl-full -z-10"></div>
                <div class="flex items-start gap-5">
                    <div class="bg-soft-orange/20 p-4 rounded-2xl">
                        <svg class="w-8 h-8 text-soft-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-deep-teal mb-2">Langkah Pertama: Kenali Dirimu</h3>
                        <p class="text-[#5F6F6D] mb-5 text-sm md:text-base leading-relaxed">Sebelum memulai sesi berbagi cerita, kami butuh sedikit informasi demografi akademikmu. Ini akan sangat membantu Konselor dalam memberikan dukungan yang paling sesuai untuk situasi studimu.</p>
                        <a href="{{ route('onboarding.show') }}" class="inline-block bg-soft-orange text-white px-6 py-3 rounded-xl font-bold hover:bg-opacity-90 transition-all shadow-md">
                            Lengkapi Profil Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white rounded-[30px] p-8 md:p-10 shadow-2xl border border-mint-soft/20 flex flex-col md:flex-row justify-between items-center gap-8 relative overflow-hidden">
                <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-mint-soft/10 rounded-full blur-3xl"></div>
                
                <div class="z-10">
                    <span class="text-soft-teal font-bold tracking-widest text-xs uppercase mb-2 block">Asesmen CF Triage</span>
                    <h2 class="text-2xl font-extrabold text-deep-teal mb-3">Evaluasi Kesehatan Mental</h2>
                    <p class="text-[#5F6F6D] mb-3 text-sm md:text-base">Luangkan waktu 3-5 menit untuk menjawab beberapa pertanyaan tentang apa yang kamu rasakan belakangan ini. Datamu aman bersama kami.</p>
                    @if($riwayat->isNotEmpty())
                        <div class="inline-flex items-center gap-2 bg-mint-soft/10 text-soft-teal px-3 py-1.5 rounded-lg text-xs font-bold border border-mint-soft/20 mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Terakhir tes: {{ $riwayat->first()->created_at->format('d M Y • H:i') }}
                        </div>
                    @endif
                </div>
                
                <div class="w-full md:w-auto flex-shrink-0 z-10">
                    @if($user->is_profile_completed)
                        <a href="{{ route('kuesioner.consent') }}" class="block w-full text-center bg-gradient-to-r from-deep-teal to-soft-teal text-white px-8 py-4 rounded-[20px] font-bold text-lg hover:scale-105 transition-transform shadow-xl">
                            Mulai Sekarang
                        </a>
                    @else
                        <button disabled class="w-full bg-gray-200 text-gray-500 px-8 py-4 rounded-[20px] font-bold text-lg cursor-not-allowed flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Terkunci
                        </button>
                    @endif
                </div>
            </div>

            <!-- Edukasi Section -->
            <div>
                <div class="flex justify-between items-end mb-6 mt-4">
                    <h3 class="text-2xl font-extrabold text-deep-teal">Pojok Edukasi</h3>
                    <a href="{{ route('mahasiswa.edukasi') }}" class="text-soft-orange font-bold text-sm hover:underline">Lihat Semua</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Artikel 1 -->
                    <a href="{{ route('mahasiswa.edukasi.show', 1) }}" class="block bg-white rounded-[24px] p-6 border border-mint-soft/20 shadow-lg hover:shadow-xl transition-all group cursor-pointer hover:-translate-y-1">
                        <div class="h-40 bg-cream rounded-xl mb-4 overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=400" alt="Belajar" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <span class="text-xs font-bold text-soft-teal bg-mint-soft/20 px-3 py-1 rounded-full mb-3 inline-block">Tips Kuliah</span>
                        <h4 class="text-lg font-bold text-deep-teal mb-2 group-hover:text-soft-orange transition-colors">Cara Mencegah Burnout Menjelang Ujian</h4>
                        <p class="text-[#5F6F6D] text-sm line-clamp-2">Tekanan akademik kadang terasa berat. Kenali tanda-tanda burnout dan pelajari cara mengatasinya dengan langkah sederhana.</p>
                    </a>
                    
                    <!-- Artikel 2 -->
                    <a href="{{ route('mahasiswa.edukasi.show', 2) }}" class="block bg-white rounded-[24px] p-6 border border-mint-soft/20 shadow-lg hover:shadow-xl transition-all group cursor-pointer hover:-translate-y-1">
                        <div class="h-40 bg-cream rounded-xl mb-4 overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=400" alt="Meditasi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <span class="text-xs font-bold text-soft-teal bg-mint-soft/20 px-3 py-1 rounded-full mb-3 inline-block">Self-Care</span>
                        <h4 class="text-lg font-bold text-deep-teal mb-2 group-hover:text-soft-orange transition-colors">Pentingnya Mengambil Jeda 5 Menit</h4>
                        <p class="text-[#5F6F6D] text-sm line-clamp-2">Tidak perlu liburan panjang, cukup jeda 5 menit di sela aktivitasmu bisa mereset tingkat stres secara signifikan.</p>
                    </a>
                </div>
            </div>

        </div>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-[24px] shadow-lg border border-mint-soft/20">
                <h3 class="text-lg font-bold text-deep-teal mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-soft-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Riwayat Asesmen
                </h3>
                
                @if($riwayat->isEmpty())
                    <div class="text-center py-6 bg-cream/50 rounded-xl">
                        <p class="text-[#5F6F6D] text-sm">Belum ada riwayat asesmen.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($riwayat as $r)
                        <div class="p-4 bg-cream/30 border border-mint-soft/30 rounded-xl flex justify-between items-center">
                            <div>
                                <div class="text-sm font-bold text-deep-teal">{{ $r->created_at->format('d M Y • H:i') }}</div>
                                <div class="text-xs font-semibold text-soft-orange mt-1">Status: {{ $r->status }}</div>
                            </div>
                            <div class="bg-white p-2 rounded-lg shadow-sm">
                                <svg class="w-5 h-5 text-mint-soft" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <div class="bg-gradient-to-br from-soft-teal to-deep-teal p-6 rounded-[24px] shadow-lg text-white">
                <h3 class="text-lg font-bold mb-2">Butuh Bantuan Segera?</h3>
                <p class="text-sm text-mint-soft mb-4">Jangan ragu menghubungi layanan darurat jika kamu merasa tidak aman.</p>
                <div class="bg-white/10 p-3 rounded-xl backdrop-blur-sm border border-white/20 flex justify-between items-center">
                    <span class="font-semibold text-sm">Call Center</span>
                    <span class="font-bold">119 ext 8</span>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    const dashboardQuotes = [
        "\"Tidak apa-apa untuk merasa lelah, beristirahatlah sebentar, lalu kita melangkah lagi.\"",
        "\"Perasaanmu sangat valid. Jangan biarkan siapapun mengatakan sebaliknya.\"",
        "\"Kemajuan kecil tetaplah kemajuan. Hargai setiap langkah yang kamu ambil hari ini.\"",
        "\"Kamu tidak harus menghadapi semuanya sendirian. Meminta bantuan adalah tanda keberanian.\""
    ];
    
    // Pick random starting quote
    let currentDashQuote = Math.floor(Math.random() * dashboardQuotes.length);
    
    function changeDashboardQuote(index) {
        currentDashQuote = index;
        const textElement = document.getElementById('dashboard-quote-text');
        const dots = document.querySelectorAll('.dash-quote-dot');
        
        // Fade out
        textElement.style.opacity = 0;
        
        setTimeout(() => {
            // Update text
            textElement.innerText = dashboardQuotes[currentDashQuote];
            // Fade in
            textElement.style.opacity = 1;
        }, 300);
        
        // Update dots styling
        dots.forEach((dot, i) => {
            if (i === currentDashQuote) {
                dot.className = "dash-quote-dot w-8 h-1.5 bg-white rounded-full transition-all duration-300 focus:outline-none";
            } else {
                dot.className = "dash-quote-dot w-3 h-1.5 bg-white/30 hover:bg-white/50 rounded-full transition-all duration-300 focus:outline-none cursor-pointer";
            }
        });
    }

    // Initialize the first random quote when page loads
    document.addEventListener('DOMContentLoaded', () => {
        changeDashboardQuote(currentDashQuote);
    });

    // Auto rotate every 6 seconds
    setInterval(() => {
        changeDashboardQuote((currentDashQuote + 1) % dashboardQuotes.length);
    }, 6000);
</script>
@endsection