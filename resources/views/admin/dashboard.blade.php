@extends('layouts.main')

@section('title', 'Dasbor Konselor')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-deep-teal mb-2">Tabel Prioritas Intervensi</h1>
            <p class="text-[#5F6F6D]">Daftar antrean mahasiswa yang diurutkan berdasarkan tingkat urgensi dari sistem pakar (CF).</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 w-full md:w-auto">
            <a href="{{ route('admin.export.excel') }}" class="bg-[#49715A] hover:bg-[#3A5A48] text-white px-5 py-3 rounded-2xl shadow-sm text-sm font-bold flex items-center justify-center gap-2 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Unduh Rekap Excel
            </a>

            <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-mint-soft/30 flex items-center gap-4">
                <div class="bg-soft-orange/20 p-2 rounded-lg text-soft-orange">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-mint-soft uppercase tracking-wider">Total Antrean</p>
                    <p class="text-xl font-extrabold text-deep-teal">{{ $assessments->where('status', '!=', 'Selesai')->count() }} Mahasiswa</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-mint-soft/20 border border-soft-teal text-deep-teal px-6 py-4 rounded-2xl mb-6 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-[30px] shadow-xl border border-mint-soft/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-cream/50 text-deep-teal text-sm font-bold border-b border-mint-soft/20">
                        <th class="py-4 px-6">Peringkat</th>
                        <th class="py-4 px-6">Mahasiswa</th>
                        <th class="py-4 px-6">Kategori Dominan</th>
                        <th class="py-4 px-6 text-center">Skor Urgensi</th>
                        <th class="py-4 px-6">Aksi & Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-mint-soft/10">
                    
                    @forelse($assessments as $index => $data)
                    <tr class="hover:bg-cream/20 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                @if($index == 0 && $data->final_score > 70)
                                    <span class="bg-soft-orange text-white w-8 h-8 flex items-center justify-center rounded-full font-bold shadow-md">1</span>
                                    <span class="relative flex h-3 w-3">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-soft-orange opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-3 w-3 bg-soft-orange"></span>
                                    </span>
                                @else
                                    <span class="bg-mint-soft/20 text-deep-teal w-8 h-8 flex items-center justify-center rounded-full font-bold">{{ $index + 1 }}</span>
                                @endif
                            </div>
                        </td>

                        <td class="py-4 px-6">
                            <a href="{{ route('admin.detail', $data->id) }}" class="font-bold text-deep-teal text-base hover:text-soft-teal hover:underline transition-all">
                                {{ $data->user->name }}
                            </a>
                            <p class="text-xs text-[#5F6F6D] font-medium">{{ $data->user->nim }} • {{ $data->user->course }}</p>
                        </td>

                        <td class="py-4 px-6">
                            <span class="bg-mint-soft/10 text-soft-teal px-3 py-1.5 rounded-lg text-xs font-bold border border-mint-soft/20">
                                {{ $data->dominant_category ?? 'Tidak Diketahui' }}
                            </span>
                        </td>

                        <td class="py-4 px-6 text-center">
                            @if($data->final_score >= 80)
                                <span class="text-soft-orange font-extrabold text-lg">{{ $data->final_score }}%</span>
                            @elseif($data->final_score >= 50)
                                <span class="text-soft-teal font-extrabold text-lg">{{ $data->final_score }}%</span>
                            @else
                                <span class="text-[#5F6F6D] font-extrabold text-lg">{{ $data->final_score }}%</span>
                            @endif
                        </td>

                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <form action="{{ route('admin.updateStatus', $data->id) }}" method="POST" class="flex items-center gap-2 flex-1">
                                    @csrf
                                    <select name="status" class="bg-white border border-mint-soft/30 text-[#5F6F6D] text-sm rounded-xl focus:ring-soft-teal focus:border-soft-teal block w-full p-2.5 font-medium">
                                        <option value="Belum Diproses" {{ $data->status == 'Belum Diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                        <option value="Menunggu Jadwal" {{ $data->status == 'Menunggu Jadwal' ? 'selected' : '' }}>Menunggu Jadwal</option>
                                        <option value="Sedang Konseling" {{ $data->status == 'Sedang Konseling' ? 'selected' : '' }}>Sedang Konseling</option>
                                        <option value="Selesai" {{ $data->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    <button type="submit" class="bg-deep-teal text-white p-2.5 rounded-xl hover:bg-soft-teal transition-colors" title="Simpan Status">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                </form>

                                <a href="{{ route('konselor.cetak.pdf', $data->id) }}" class="bg-soft-teal text-white p-2.5 rounded-xl hover:bg-deep-teal transition-colors flex items-center justify-center" title="Cetak Rekam Psikologis PDF">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center text-[#5F6F6D]">
                            Belum ada data asesmen mahasiswa bulan ini.
                        </td>
                    </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection