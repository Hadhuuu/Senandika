@extends('layouts.main')

@section('title', 'Kontak Darurat')

@section('content')
<div class="max-w-4xl mx-auto px-6 lg:px-8 py-10 md:py-20">
    <div class="text-center mb-16 animate-[fadeIn_0.5s_ease]">
        <div class="inline-block bg-[#F53003]/10 text-[#F53003] px-4 py-2 rounded-full font-bold text-sm mb-6 border border-[#F53003]/20">
            🚨 Bantuan Cepat 24/7
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-deep-teal mb-4">Kontak Darurat</h1>
        <p class="text-[#5F6F6D] text-lg max-w-2xl mx-auto leading-relaxed">
            Jika Anda sedang mengalami krisis, merasa sangat putus asa, atau memiliki pemikiran untuk menyakiti diri sendiri, mohon segera hubungi bantuan di bawah ini. Anda tidak sendirian.
        </p>
    </div>

    <div class="space-y-6">
        <!-- SEJIWA 119 -->
        <div class="bg-white rounded-3xl p-8 border border-[#F53003]/20 shadow-xl hover:shadow-2xl transition-shadow flex flex-col md:flex-row items-center gap-6 relative overflow-hidden group">
            <div class="absolute -left-10 -top-10 w-32 h-32 bg-[#F53003]/5 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            
            <div class="w-20 h-20 bg-[#F53003]/10 rounded-2xl flex items-center justify-center text-[#F53003] shrink-0 z-10">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <div class="flex-grow text-center md:text-left z-10">
                <h2 class="text-2xl font-bold text-deep-teal mb-2">Layanan Psikologi SEJIWA (Kemenkes RI)</h2>
                <p class="text-[#5F6F6D] mb-4">Layanan gratis dari pemerintah untuk pertolongan pertama psikologis yang beroperasi 24 jam.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                    <a href="tel:119" class="inline-flex items-center justify-center gap-2 bg-[#F53003] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#d62802] transition-colors">
                        Hubungi 119 (Ekstensi 8)
                    </a>
                </div>
            </div>
        </div>

        <!-- Konseling Kampus -->
        <div class="bg-white rounded-3xl p-8 border border-mint-soft/20 shadow-xl hover:shadow-2xl transition-shadow flex flex-col md:flex-row items-center gap-6 relative overflow-hidden group">
            <div class="absolute -left-10 -top-10 w-32 h-32 bg-mint-soft/10 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            
            <div class="w-20 h-20 bg-mint-soft/20 rounded-2xl flex items-center justify-center text-deep-teal shrink-0 z-10">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
            </div>
            <div class="flex-grow text-center md:text-left z-10">
                <h2 class="text-2xl font-bold text-deep-teal mb-2">Konseling Kampus (Pusat Layanan)</h2>
                <p class="text-[#5F6F6D] mb-4">Hubungi admin konseling kampus kami di jam kerja untuk penjadwalan atau pendampingan mendesak.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center justify-center gap-2 bg-[#25D366] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#20b958] transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.124.551 4.195 1.597 6.02L.053 24l6.096-1.597A11.973 11.973 0 0012.031 24c6.646 0 12.031-5.385 12.031-12.031C24.062 5.385 18.677 0 12.031 0zm7.156 17.156c-.307.864-1.748 1.621-2.42 1.688-.636.064-1.393.208-4.492-1.077-3.73-1.547-6.175-5.367-6.36-5.614-.186-.248-1.52-2.022-1.52-3.86 0-1.837.957-2.738 1.296-3.111.341-.371.742-.464.99-.464.248 0 .495.002.711.011.226.01.527-.087.82.617.309.743 1.05 2.565 1.144 2.75.093.185.155.401.031.649-.124.247-.186.402-.371.618-.186.216-.388.478-.557.633-.186.17-.384.357-.168.727.216.37 1.037 1.713 2.25 2.802 1.564 1.405 2.88 1.834 3.25 2.02.371.185.588.155.804-.093.216-.247.928-1.082 1.176-1.453.247-.37.495-.309.835-.185.34.124 2.165 1.02 2.536 1.206.37.185.618.278.711.433.093.154.093.896-.216 1.761z"/></svg>
                        WhatsApp Admin
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Call Center Polri -->
        <div class="bg-white rounded-3xl p-8 border border-mint-soft/20 shadow-xl hover:shadow-2xl transition-shadow flex flex-col md:flex-row items-center gap-6 relative overflow-hidden group">
            <div class="absolute -left-10 -top-10 w-32 h-32 bg-gray-100 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
            
            <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center text-deep-teal shrink-0 z-10">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div class="flex-grow text-center md:text-left z-10">
                <h2 class="text-2xl font-bold text-deep-teal mb-2">Layanan Kedaruratan Polri (110)</h2>
                <p class="text-[#5F6F6D] mb-4">Dalam kondisi gawat darurat yang mengancam nyawa, segera hubungi pusat layanan panggilan kepolisian.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                    <a href="tel:110" class="inline-flex items-center justify-center gap-2 bg-gray-800 text-white px-6 py-3 rounded-xl font-bold hover:bg-black transition-colors">
                        Hubungi 110
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
