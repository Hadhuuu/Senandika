@extends('layouts.main')

@section('title', 'Beranda Mahasiswa')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">

    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-deep-teal mb-2">Halo, {{ $user->name }} 👋</h1>
        <p class="text-[#5F6F6D] text-lg">Selamat datang di ruang amanmu. Bagaimana perasaanmu hari ini?</p>
    </div>

    @if(session('success'))
        <div class="bg-mint-soft/20 border border-soft-teal text-deep-teal px-6 py-4 rounded-2xl mb-8 font-semibold animate-[fadeIn_0.5s_ease]">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            
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
                    <p class="text-[#5F6F6D] mb-0 text-sm md:text-base">Luangkan waktu 3-5 menit untuk menjawab beberapa pertanyaan tentang apa yang kamu rasakan belakangan ini. Datamu aman bersama kami.</p>
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
                                <div class="text-sm font-bold text-deep-teal">{{ $r->created_at->format('d M Y') }}</div>
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
@endsection