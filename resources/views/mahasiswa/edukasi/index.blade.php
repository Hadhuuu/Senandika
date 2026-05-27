@extends('layouts.main')

@section('title', 'Pojok Edukasi')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-deep-teal mb-2">Pojok Edukasi</h1>
            <p class="text-[#5F6F6D]">Temukan artikel, tips, dan wawasan seputar kesehatan mental dan kehidupan kampus.</p>
        </div>
        <a href="{{ route('mahasiswa.dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl transition-colors font-semibold flex items-center gap-2 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Dasbor
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($articles as $article)
        <a href="{{ route('mahasiswa.edukasi.show', $article['id']) }}" class="bg-white rounded-[24px] p-6 border border-mint-soft/20 shadow-lg hover:shadow-xl transition-all group block transform hover:-translate-y-1">
            <div class="h-48 bg-cream rounded-xl mb-4 overflow-hidden relative">
                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <span class="text-xs font-bold text-soft-teal bg-mint-soft/20 px-3 py-1 rounded-full mb-3 inline-block">
                {{ $article['category'] }}
            </span>
            <h3 class="text-xl font-bold text-deep-teal mb-2 group-hover:text-soft-orange transition-colors">{{ $article['title'] }}</h3>
            <p class="text-[#5F6F6D] text-sm line-clamp-3 leading-relaxed">
                {{ $article['summary'] }}
            </p>
            <div class="mt-4 flex items-center text-soft-teal font-semibold text-sm group-hover:text-deep-teal transition-colors">
                Baca selengkapnya 
                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
