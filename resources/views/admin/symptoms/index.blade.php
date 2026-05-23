@extends('layouts.main')

@section('title', 'Master Data Gejala (Symptoms)')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-deep-teal mb-2">Master Data Gejala</h1>
            <p class="text-[#5F6F6D]">Kelola daftar gejala, pertanyaan, kategori, dan Certainty Factor (CF) Pakar untuk sistem asesmen.</p>
        </div>
        
        <a href="{{ route('admin.symptoms.create') }}" class="bg-deep-teal hover:bg-soft-teal text-white font-bold py-3 px-6 rounded-2xl transition-colors flex items-center gap-2 whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Gejala Baru
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-mint-soft/20 border border-soft-teal text-deep-teal px-6 py-4 rounded-2xl mb-6 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="bg-soft-orange/20 border border-soft-orange text-soft-orange px-6 py-4 rounded-2xl mb-6 font-semibold">
            {{ session('error') }}
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-2xl shadow-md border border-mint-soft/20 p-6">
            <p class="text-xs font-bold text-mint-soft uppercase tracking-wider mb-2">Total Gejala</p>
            <p class="text-3xl font-extrabold text-deep-teal">{{ $symptoms->total() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md border border-mint-soft/20 p-6">
            <p class="text-xs font-bold text-mint-soft uppercase tracking-wider mb-2">Kategori Unik</p>
            <p class="text-3xl font-extrabold text-deep-teal">
                @php
                    $uniqueCategories = $symptoms->pluck('category')->unique()->count();
                @endphp
                {{ $uniqueCategories }}
            </p>
        </div>
        <div class="bg-white rounded-2xl shadow-md border border-mint-soft/20 p-6">
            <p class="text-xs font-bold text-mint-soft uppercase tracking-wider mb-2">Avg CF Pakar</p>
            <p class="text-3xl font-extrabold text-deep-teal">
                @php
                    $avgCF = $symptoms->avg('cf_pakar');
                @endphp
                {{ number_format($avgCF, 2) }}
            </p>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="bg-white rounded-2xl shadow-md border border-mint-soft/20 p-6 mb-6">
        <form method="GET" class="flex flex-col md:flex-row gap-4">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari berdasarkan kode, pertanyaan, atau kategori..." 
                class="flex-1 px-4 py-2 border border-mint-soft/30 rounded-xl focus:ring-soft-teal focus:border-soft-teal"
            >
            <button type="submit" class="bg-deep-teal hover:bg-soft-teal text-white font-bold py-2 px-6 rounded-xl transition-colors">
                Cari
            </button>
        </form>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-[30px] shadow-xl border border-mint-soft/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-cream/50 text-deep-teal text-sm font-bold border-b border-mint-soft/20">
                        <th class="py-4 px-6">Kode</th>
                        <th class="py-4 px-6">Pertanyaan</th>
                        <th class="py-4 px-6">Kategori</th>
                        <th class="py-4 px-6 text-center">CF Pakar</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-mint-soft/10">
                    
                    @forelse($symptoms as $symptom)
                    <tr class="hover:bg-cream/20 transition-colors">
                        <td class="py-4 px-6">
                            <span class="bg-deep-teal/10 text-deep-teal px-3 py-1 rounded-lg font-bold text-sm">
                                {{ $symptom->code }}
                            </span>
                        </td>

                        <td class="py-4 px-6">
                            <p class="font-semibold text-deep-teal text-sm max-w-xs line-clamp-2">
                                {{ $symptom->question }}
                            </p>
                        </td>

                        <td class="py-4 px-6">
                            <span class="bg-soft-teal/20 text-soft-teal px-3 py-1 rounded-lg text-xs font-bold border border-soft-teal/30">
                                {{ $symptom->category }}
                            </span>
                        </td>

                        <td class="py-4 px-6 text-center">
                            <span class="text-lg font-extrabold text-soft-orange">
                                {{ number_format($symptom->cf_pakar, 2) }}
                            </span>
                        </td>

                        <td class="py-4 px-6 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.symptoms.edit', $symptom) }}" 
                                   class="bg-deep-teal/10 hover:bg-deep-teal/20 text-deep-teal p-2 rounded-lg transition-colors"
                                   title="Edit Gejala">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>

                                <form action="{{ route('admin.symptoms.destroy', $symptom) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus gejala ini? Pastikan tidak digunakan dalam asesmen.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-soft-orange/10 hover:bg-soft-orange/20 text-soft-orange p-2 rounded-lg transition-colors"
                                            title="Hapus Gejala">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center text-[#5F6F6D]">
                            Belum ada data gejala. <a href="{{ route('admin.symptoms.create') }}" class="text-deep-teal font-bold hover:underline">Tambah gejala baru sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($symptoms->hasPages())
        <div class="bg-cream/20 px-6 py-4">
            {{ $symptoms->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
