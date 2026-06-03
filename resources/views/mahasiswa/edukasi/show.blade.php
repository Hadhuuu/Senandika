@extends('layouts.main')

@section('title', $article['title'] . ' - Pojok Edukasi')

@section('content')
<div class="max-w-4xl mx-auto px-6 lg:px-8 py-10">
    <!-- Breadcrumb & Back Button -->
    <div class="mb-8">
        <a href="{{ route('mahasiswa.edukasi') }}" class="text-[#5F6F6D] hover:text-deep-teal transition-colors font-semibold flex items-center gap-2 text-sm mb-4 inline-flex">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Pojok Edukasi
        </a>
    </div>

    <!-- Article Content -->
    <div class="bg-white rounded-[30px] shadow-xl border border-mint-soft/20 overflow-hidden">
        <!-- Hero Image -->
        <div class="h-64 sm:h-80 md:h-96 w-full relative">
            <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-deep-teal/80 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-8 w-full">
                <span class="text-xs font-bold text-deep-teal bg-mint-soft px-3 py-1 rounded-full mb-3 inline-block shadow-sm">
                    {{ $article['category'] }}
                </span>
                <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2 leading-tight">
                    {{ $article['title'] }}
                </h1>
            </div>
        </div>
        
        <!-- Body -->
        <div class="p-8 md:p-12 text-[#1F3F3D] text-lg leading-relaxed bg-cream/30">
            {!! $article['content'] !!}
        </div>
        
        <!-- Footer -->
        <div class="bg-mint-soft/10 p-8 border-t border-mint-soft/20 text-center">
            <p class="text-[#5F6F6D] text-sm mb-4">Bagikan artikel ini kepada teman yang mungkin membutuhkan:</p>
            <div class="flex justify-center gap-4">
                <button onclick="navigator.clipboard.writeText(window.location.href).then(() => alert('Tautan berhasil disalin!'))" class="bg-white hover:bg-gray-50 text-[#1F3F3D] p-3 rounded-full shadow-sm border border-mint-soft/30 transition-colors" title="Salin Tautan">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
