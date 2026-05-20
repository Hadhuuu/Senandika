@extends('layouts.main')

@section('title', 'Detail Asesmen')

@section('content')
<div class="max-w-5xl mx-auto px-6 lg:px-8 py-10">
    
    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-soft-teal hover:text-deep-teal font-bold mb-6 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Antrean
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="space-y-6">
            <div class="bg-white p-8 rounded-[30px] shadow-xl border border-mint-soft/20 text-center">
                <div class="w-20 h-20 bg-mint-soft/20 rounded-full flex items-center justify-center mx-auto mb-4 text-deep-teal font-bold text-2xl">
                    {{ substr($assessment->user->name, 0, 1) }}
                </div>
                <h2 class="text-xl font-extrabold text-deep-teal">{{ $assessment->user->name }}</h2>
                <p class="text-sm text-[#5F6F6D] mb-6">{{ $assessment->user->nim }}</p>
                
                <div class="space-y-3 text-left">
                    <div class="flex justify-between text-sm">
                        <span class="text-[#5F6F6D]">Jurusan:</span>
                        <span class="font-bold text-deep-teal">{{ $assessment->user->course }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#5F6F6D]">Tahun:</span>
                        <span class="font-bold text-deep-teal">Ke-{{ $assessment->user->current_year }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#5F6F6D]">IPK (GPA):</span>
                        <span class="font-bold text-deep-teal">{{ $assessment->user->gpa }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#5F6F6D]">Status:</span>
                        <span class="font-bold text-deep-teal">{{ $assessment->user->marital_status }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-deep-teal p-8 rounded-[30px] shadow-xl text-white">
                <p class="text-xs font-bold tracking-widest uppercase text-mint-soft mb-2">Skor Urgensi Akhir</p>
                <h3 class="text-5xl font-black mb-4">{{ $assessment->final_score }}%</h3>
                <div class="inline-block bg-white/10 px-4 py-2 rounded-xl border border-white/20 text-sm font-semibold">
                    Dominan: {{ $assessment->dominant_category }}
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-8">
            
            <div class="bg-white rounded-[30px] shadow-xl border border-mint-soft/20 overflow-hidden">
                <div class="bg-cream/50 p-6 border-b border-mint-soft/20">
                    <h3 class="font-extrabold text-deep-teal">Analisis Gejala (Kuesioner)</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        @foreach($assessment->details as $detail)
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center font-bold {{ $detail->cf_user >= 0.8 ? 'bg-soft-orange/20 text-soft-orange' : 'bg-mint-soft/10 text-soft-teal' }}">
                                {{ $detail->cf_user * 100 }}%
                            </div>
                            <div>
                                <p class="text-deep-teal font-semibold text-[15px] leading-snug mb-1">"{{ $detail->symptom->question }}"</p>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-[#5F6F6D] bg-gray-100 px-2 py-0.5 rounded">
                                    {{ $detail->symptom->category }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-[30px] shadow-xl border border-mint-soft/20">
                <h3 class="font-extrabold text-deep-teal mb-4">Tindakan Konselor</h3>
                <form action="{{ route('admin.updateStatus', $assessment->id) }}" method="POST">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-4">
                        <select name="status" class="flex-grow bg-cream/30 border border-mint-soft/30 text-deep-teal rounded-2xl p-4 font-bold focus:ring-soft-teal">
                            <option value="Belum Diproses" {{ $assessment->status == 'Belum Diproses' ? 'selected' : '' }}>Belum Diproses</option>
                            <option value="Menunggu Jadwal" {{ $assessment->status == 'Menunggu Jadwal' ? 'selected' : '' }}>Menunggu Jadwal</option>
                            <option value="Sedang Konseling" {{ $assessment->status == 'Sedang Konseling' ? 'selected' : '' }}>Sedang Konseling</option>
                            <option value="Selesai" {{ $assessment->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <button type="submit" class="bg-soft-teal text-white px-8 py-4 rounded-2xl font-bold hover:bg-deep-teal transition-all shadow-lg">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection