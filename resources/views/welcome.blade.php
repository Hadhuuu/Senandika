@extends('layouts.main')

@section('title', 'Beranda - Safe Space')

@section('content')
<!-- Hero Section -->
<section class="relative bg-cream overflow-hidden">
    <!-- Dekorasi Latar Belakang -->
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-mint-soft/20 rounded-full blur-3xl"></div>
    <div class="absolute top-40 -right-20 w-80 h-80 bg-soft-orange/20 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 md:py-28 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Teks Hero -->
            <div class="animate-[fadeIn_0.8s_ease]">
                <div class="inline-block bg-mint-soft/20 text-soft-teal px-4 py-2 rounded-full font-bold text-sm mb-6 border border-mint-soft/30">
                    #1 Platform Kesehatan Mental Mahasiswa
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-deep-teal leading-tight mb-6">
                    Ruang Aman untuk <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-soft-teal to-soft-orange">Kesehatan Mentalmu.</span>
                </h1>
                <p class="text-lg text-[#5F6F6D] mb-8 leading-relaxed max-w-lg">
                    Senandika hadir mendampingi mahasiswa mengenali kondisi psikologis, mengukur tingkat stres, dan menemukan solusi yang tepat bersama konselor profesional.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-deep-teal to-soft-teal text-white text-center px-8 py-4 rounded-2xl font-bold text-lg hover:shadow-lg hover:-translate-y-1 transition-all">
                        Mulai Asesmen Sekarang
                    </a>
                    <a href="#fitur" class="bg-white text-deep-teal border border-mint-soft/30 text-center px-8 py-4 rounded-2xl font-bold text-lg hover:bg-cream/50 hover:-translate-y-1 transition-all">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            <!-- Gambar Hero -->
            <div class="relative animate-[fadeIn_1s_ease]">
                <!-- Gambar Utama -->
                <div class="rounded-[40px] overflow-hidden shadow-2xl border-8 border-white relative z-10 transform hover:scale-[1.02] transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Mahasiswa bermeditasi" class="w-full h-[400px] lg:h-[500px] object-cover">
                    <!-- Overlay Gradasi -->
                    <div class="absolute inset-0 bg-gradient-to-t from-deep-teal/60 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8 text-white">
                        <p class="font-bold text-xl">"Kesehatan mentalmu sama pentingnya dengan nilai akademikmu."</p>
                    </div>
                </div>
                
                <!-- Floating Card -->
                <div class="absolute -top-6 -right-6 md:-right-10 bg-white p-5 rounded-2xl shadow-xl border border-mint-soft/20 z-20 animate-bounce" style="animation-duration: 3s;">
                    <div class="flex items-center gap-4">
                        <div class="bg-soft-orange/20 p-3 rounded-full text-soft-orange">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-[#5F6F6D] uppercase">Privasi</p>
                            <p class="text-sm font-extrabold text-deep-teal">100% Terjamin</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Fitur Section -->
<section id="fitur" class="bg-white py-20 border-t border-mint-soft/20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-deep-teal mb-4">Mengapa Memilih Senandika?</h2>
            <p class="text-[#5F6F6D] max-w-2xl mx-auto">Kami merancang platform ini khusus untuk kebutuhan psikologis mahasiswa, dengan pendekatan yang ramah dan ilmiah.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Fitur 1 -->
            <div class="bg-cream/50 p-8 rounded-[30px] border border-mint-soft/20 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-14 h-14 bg-soft-teal rounded-2xl flex items-center justify-center text-white mb-6 shadow-md">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <h3 class="text-xl font-bold text-deep-teal mb-3">Asesmen Cepat (Triage)</h3>
                <p class="text-[#5F6F6D] leading-relaxed">Sistem pakar kami akan mengevaluasi tingkat urgensi kondisi Anda dengan metode Certainty Factor yang akurat.</p>
            </div>

            <!-- Fitur 2 -->
            <div class="bg-cream/50 p-8 rounded-[30px] border border-mint-soft/20 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-14 h-14 bg-soft-orange rounded-2xl flex items-center justify-center text-white mb-6 shadow-md">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-deep-teal mb-3">Konseling Profesional</h3>
                <p class="text-[#5F6F6D] leading-relaxed">Terhubung langsung dengan konselor kampus yang berpengalaman untuk mendapatkan pendampingan lebih lanjut.</p>
            </div>

            <!-- Fitur 3 -->
            <div class="bg-cream/50 p-8 rounded-[30px] border border-mint-soft/20 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="w-14 h-14 bg-mint-soft rounded-2xl flex items-center justify-center text-white mb-6 shadow-md">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-deep-teal mb-3">Privasi Terjamin</h3>
                <p class="text-[#5F6F6D] leading-relaxed">Semua data dan cerita yang Anda bagikan dijaga kerahasiaannya dengan standar keamanan privasi yang tinggi.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-br from-deep-teal to-soft-teal py-20 relative overflow-hidden">
    <!-- Ornamen -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-20 -mt-20"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full -ml-20 -mb-20"></div>

    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6">Jangan Tunda Bahagiamu.<br>Mari Mulai Hari Ini.</h2>
        <p class="text-mint-soft text-lg mb-10 max-w-2xl mx-auto">Satu langkah kecil untuk bercerita bisa membawa perubahan besar pada kesejahteraan mentalmu. Kamu tidak sendirian.</p>
        <a href="{{ route('login') }}" class="inline-block bg-white text-deep-teal px-10 py-4 rounded-2xl font-bold text-lg hover:bg-cream hover:scale-105 transition-all shadow-xl">
            Masuk / Daftar Sekarang
        </a>
    </div>
</section>
@endsection
