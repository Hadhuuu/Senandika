@extends('layouts.main')

@section('title', 'Tentang Kami')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-10 md:py-20">
    <div class="text-center mb-16 animate-[fadeIn_0.5s_ease]">
        <h1 class="text-4xl md:text-5xl font-extrabold text-deep-teal mb-4">Tentang Kami</h1>
        <p class="text-[#5F6F6D] text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">
            Senandika adalah platform inovatif yang dirancang sebagai ruang aman bagi mahasiswa untuk memeriksa dan mengelola kesehatan mental mereka. 
            Proyek ini dikembangkan dengan penuh dedikasi oleh tim mahasiswa yang peduli terhadap kesejahteraan psikologis di lingkungan kampus.
        </p>
    </div>

    <div class="bg-white rounded-[40px] p-8 md:p-14 shadow-2xl border border-mint-soft/20 relative overflow-hidden animate-[fadeIn_0.8s_ease]">
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-soft-orange/10 rounded-full blur-3xl z-0"></div>
        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-mint-soft/10 rounded-full blur-3xl z-0"></div>
        
        <div class="relative z-10">
            <h2 class="text-2xl font-bold text-center text-deep-teal mb-10 tracking-wide">TIM PENGEMBANG KAMI</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Hudha Aji -->
                <div class="bg-cream/40 p-8 rounded-3xl border border-mint-soft/30 hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group text-center">
                    <div class="w-32 h-32 mx-auto mb-6 rounded-full border-4 border-white shadow-xl overflow-hidden group-hover:scale-110 transition-transform duration-300 bg-cream">
                        <img src="{{ asset('images/team/hudha.jpg') }}" alt="Hudha Aji" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Hudha+Aji&background=2F5D5A&color=fff&size=256';">
                    </div>
                    <h3 class="font-bold text-deep-teal text-xl mb-1">Hudha Aji</h3>
                    <div class="w-10 h-1 bg-soft-teal mx-auto rounded-full mt-3"></div>
                </div>

                <!-- Kanaya Abdiela -->
                <div class="bg-cream/40 p-8 rounded-3xl border border-mint-soft/30 hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group text-center">
                    <div class="w-32 h-32 mx-auto mb-6 rounded-full border-4 border-white shadow-xl overflow-hidden group-hover:scale-110 transition-transform duration-300 bg-cream">
                        <img src="{{ asset('images/team/kanaya.jpg') }}" alt="Kanaya Abdiela" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Kanaya+Abdiela&background=E59A5A&color=fff&size=256';">
                    </div>
                    <h3 class="font-bold text-deep-teal text-xl mb-1">Kanaya Abdiela</h3>
                    <div class="w-10 h-1 bg-soft-orange mx-auto rounded-full mt-3"></div>
                </div>

                <!-- Maharani Wirawan -->
                <div class="bg-cream/40 p-8 rounded-3xl border border-mint-soft/30 hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group text-center">
                    <div class="w-32 h-32 mx-auto mb-6 rounded-full border-4 border-white shadow-xl overflow-hidden group-hover:scale-110 transition-transform duration-300 bg-cream">
                        <img src="{{ asset('images/team/maharani.jpg') }}" alt="Maharani Wirawan" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Maharani+Wirawan&background=7BA7A3&color=fff&size=256';">
                    </div>
                    <h3 class="font-bold text-deep-teal text-xl mb-1">Maharani Wirawan</h3>
                    <div class="w-10 h-1 bg-[#7BA7A3] mx-auto rounded-full mt-3"></div>
                </div>

                <!-- M Mahdi Arielreza -->
                <div class="bg-cream/40 p-8 rounded-3xl border border-mint-soft/30 hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group text-center">
                    <div class="w-32 h-32 mx-auto mb-6 rounded-full border-4 border-white shadow-xl overflow-hidden group-hover:scale-110 transition-transform duration-300 bg-cream">
                        <img src="{{ asset('images/team/mahdi.jpg') }}" alt="M Mahdi Arielreza" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Mahdi+Arielreza&background=1F3F3D&color=fff&size=256';">
                    </div>
                    <h3 class="font-bold text-deep-teal text-xl mb-1">M Mahdi Arielreza</h3>
                    <div class="w-10 h-1 bg-deep-teal mx-auto rounded-full mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
