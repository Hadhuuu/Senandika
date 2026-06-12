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
                    <p class="text-xl font-extrabold text-deep-teal">{{ $assessments->total() }} Mahasiswa</p>                
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-mint-soft/20 border border-soft-teal text-deep-teal px-6 py-4 rounded-2xl mb-6 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-2xl mb-6">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="bg-gradient-to-r from-deep-teal to-soft-teal rounded-[30px] shadow-xl p-8 mb-10 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="text-white">
            <h3 class="text-xl font-extrabold mb-2">Import Data Mahasiswa Baru</h3>
            <p class="text-mint-soft text-sm font-medium">Unggah data mahasiswa sekaligus menggunakan template Excel (.xlsx). Akun akan dibuat otomatis tanpa merusak data yang sudah ada.</p>
        </div>
        
        <form action="{{ route('admin.importMahasiswa') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-3 w-full md:w-auto">
            @csrf
            <label class="bg-white/10 hover:bg-white/20 border border-white/30 text-white cursor-pointer px-5 py-3 rounded-xl transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                <span class="text-sm font-bold">Pilih File Excel</span>
                <input type="file" name="file_excel" accept=".xlsx, .xls, .csv" class="hidden" required id="file-upload">
            </label>
            
            <button type="submit" class="bg-soft-orange hover:bg-opacity-90 text-white px-6 py-3 rounded-xl font-bold shadow-md transition-all text-sm">
                Unggah & Proses
            </button>
        </form>
    </div>

    <!-- Statistics Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8" id="statsContainer">
        <div class="bg-white rounded-2xl shadow-md border border-mint-soft/20 p-6">
            <p class="text-xs font-bold text-mint-soft uppercase tracking-wider mb-2">Total Asesmen</p>
            <p class="text-3xl font-extrabold text-deep-teal" id="totalAssessments">-</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md border border-mint-soft/20 p-6">
            <p class="text-xs font-bold text-mint-soft uppercase tracking-wider mb-2">Mahasiswa Aktif</p>
            <p class="text-3xl font-extrabold text-deep-teal" id="totalStudents">-</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md border border-mint-soft/20 p-6">
            <p class="text-xs font-bold text-mint-soft uppercase tracking-wider mb-2">Rata-rata Urgensi</p>
            <p class="text-3xl font-extrabold text-soft-orange" id="avgUrgency">-</p>
            <p class="text-xs text-[#5F6F6D] mt-1" id="highUrgencyPercentage">-</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md border border-mint-soft/20 p-6">
            <p class="text-xs font-bold text-mint-soft uppercase tracking-wider mb-2">Tingkat Penyelesaian</p>
            <p class="text-3xl font-extrabold text-soft-teal" id="completionRate">-</p>
            <p class="text-xs text-[#5F6F6D] mt-1" id="completedCount">-</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Line Chart: Tren Urgensi per Bulan -->
        <div class="bg-white rounded-[30px] shadow-xl border border-mint-soft/20 p-6">
            <h3 class="text-lg font-bold text-deep-teal mb-4">📈 Tren Urgensi per Bulan</h3>
            <div id="monthlyUrgencyChart" class="w-full h-80"></div>
        </div>

        <!-- Pie Chart: Distribusi Kasus per Kategori -->
        <div class="bg-white rounded-[30px] shadow-xl border border-mint-soft/20 p-6">
            <h3 class="text-lg font-bold text-deep-teal mb-4">🎯 Distribusi Kasus per Kategori</h3>
            <div id="categoryDistributionChart" class="w-full h-80"></div>
        </div>
    </div>

    <!-- Secondary Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Bar Chart: Status Penanganan -->
        <div class="bg-white rounded-[30px] shadow-xl border border-mint-soft/20 p-6">
            <h3 class="text-lg font-bold text-deep-teal mb-4">📊 Status Penanganan</h3>
            <div id="statusSummaryChart" class="w-full h-80"></div>
        </div>

        <!-- Bar Chart: Kategori Dominan -->
        <div class="bg-white rounded-[30px] shadow-xl border border-mint-soft/20 p-6">
            <h3 class="text-lg font-bold text-deep-teal mb-4">🏆 Top Kategori Dominan</h3>
            <div id="dominantCategoryChart" class="w-full h-80"></div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h2 class="text-2xl font-extrabold text-deep-teal">📋 Tabel Prioritas Intervensi</h2>
        
        <!-- Filter & Search Form -->
        <form action="{{ route('admin.dashboard') }}" method="GET" id="filterSearchForm" class="flex flex-col lg:flex-row items-stretch lg:items-center gap-2 w-full lg:w-auto">
            <div class="relative flex-1 lg:w-48">
                <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Cari Nama / NIM..." class="bg-white border border-mint-soft/30 text-[#5F6F6D] text-sm rounded-xl focus:ring-soft-teal focus:border-soft-teal block w-full pl-10 p-2.5 shadow-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-mint-soft" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>
            
            <select name="status" onchange="this.form.submit()" class="bg-white border border-mint-soft/30 text-[#5F6F6D] text-sm rounded-xl focus:ring-soft-teal focus:border-soft-teal block p-2.5 shadow-sm w-full lg:w-auto cursor-pointer">
                <option value="">Semua Status</option>
                <option value="Belum Diproses" {{ request('status') == 'Belum Diproses' ? 'selected' : '' }}>Belum Diproses</option>
                <option value="Menunggu Jadwal" {{ request('status') == 'Menunggu Jadwal' ? 'selected' : '' }}>Menunggu Jadwal</option>
                <option value="Sedang Konseling" {{ request('status') == 'Sedang Konseling' ? 'selected' : '' }}>Sedang Konseling</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>

            <select name="category" onchange="this.form.submit()" class="bg-white border border-mint-soft/30 text-[#5F6F6D] text-sm rounded-xl focus:ring-soft-teal focus:border-soft-teal block p-2.5 shadow-sm w-full lg:w-auto cursor-pointer">
                <option value="">Semua Kategori</option>
                <option value="Depresi" {{ request('category') == 'Depresi' ? 'selected' : '' }}>Depresi</option>
                <option value="Kecemasan" {{ request('category') == 'Kecemasan' ? 'selected' : '' }}>Kecemasan</option>
                <option value="Stres" {{ request('category') == 'Stres' ? 'selected' : '' }}>Stres</option>
            </select>
            
            <select name="per_page" onchange="this.form.submit()" class="bg-white border border-mint-soft/30 text-[#5F6F6D] text-sm rounded-xl focus:ring-soft-teal focus:border-soft-teal block p-2.5 shadow-sm w-full lg:w-auto cursor-pointer">
                <option value="10" {{ request('per_page', 10) == '10' ? 'selected' : '' }}>10 Baris</option>
                <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25 Baris</option>
                <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50 Baris</option>
            </select>
            
            @if(request()->hasAny(['search', 'status', 'category', 'per_page']) && (request('search') || request('status') || request('category') || request('per_page') != 10))
            <a href="{{ route('admin.dashboard') }}" class="bg-soft-orange text-white p-2.5 rounded-xl hover:bg-red-500 transition-colors shadow-sm flex items-center justify-center" title="Reset Filter">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </a>
            @endif
        </form>
    </div>

    <form action="{{ route('admin.saveAllStatus') }}" method="POST" id="statusForm">
        @csrf
        <div class="mb-4 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div></div> <!-- Spacer -->
            
            <!-- Save Changes / Discard Buttons -->
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" id="btnDiscard" class="hidden bg-gray-200 text-[#5F6F6D] px-5 py-2.5 rounded-xl hover:bg-gray-300 transition-colors text-sm font-bold shadow-sm">
                    Batal
                </a>
                <button type="submit" id="btnSaveAll" class="hidden bg-deep-teal text-white px-5 py-2.5 rounded-xl hover:bg-soft-teal transition-colors text-sm font-bold shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </div>

        <div class="bg-white rounded-[30px] shadow-xl border border-mint-soft/20 overflow-hidden mb-8">
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
                                <div class="flex items-center gap-2 flex-1">
                                    <select name="statuses[{{ $data->id }}]" data-id="{{ $data->id }}" data-original="{{ $data->status }}" onchange="checkChanges()" class="status-select bg-white border border-mint-soft/30 text-[#5F6F6D] text-sm rounded-xl focus:ring-soft-teal focus:border-soft-teal block w-full p-2.5 font-medium cursor-pointer transition-all">
                                        <option value="Belum Diproses" {{ $data->status == 'Belum Diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                        <option value="Menunggu Jadwal" {{ $data->status == 'Menunggu Jadwal' ? 'selected' : '' }}>Menunggu Jadwal</option>
                                        <option value="Sedang Konseling" {{ $data->status == 'Sedang Konseling' ? 'selected' : '' }}>Sedang Konseling</option>
                                        <option value="Selesai" {{ $data->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>

                                <a href="{{ route('konselor.cetak.pdf', $data->id) }}" id="print-btn-{{ $data->id }}" class="bg-soft-teal text-white p-2.5 rounded-xl hover:bg-deep-teal transition-all flex items-center justify-center print-btn" title="Cetak Rekam Psikologis PDF" onclick="if(this.classList.contains('cursor-not-allowed')) return false;">
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
    
    <!-- Paginasi -->
    <div class="mt-6 mb-8">
        {{ $assessments->links() }}
    </div>

    </form>
</div>

<!-- ApexCharts Scripts -->
<script>
    // Menyimpan posisi scroll dan mengembalikan setelah halaman dimuat ulang
    window.addEventListener('beforeunload', function() {
        sessionStorage.setItem('scrollPosition', window.scrollY);
    });

    window.addEventListener('load', function() {
        if (sessionStorage.getItem('scrollPosition') !== null) {
            window.scrollTo(0, sessionStorage.getItem('scrollPosition'));
            sessionStorage.removeItem('scrollPosition');
        }
        
        // Pindahkan fokus kembali ke kotak pencarian jika pengguna sedang mencari
        const searchInput = document.getElementById('searchInput');
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('search') && searchInput) {
            searchInput.focus();
            // Pindahkan kursor ke akhir teks
            const val = searchInput.value;
            searchInput.value = '';
            searchInput.value = val;
        }
    });

    // Auto Submit Search Input dengan Debounce
    let searchTimeout = null;
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                document.getElementById('filterSearchForm').submit();
            }, 800); // Tunggu 800ms setelah user berhenti mengetik
        });
    }

    function checkChanges() {
        let hasChanges = false;
        document.querySelectorAll('.status-select').forEach(select => {
            const id = select.getAttribute('data-id');
            const printBtn = document.getElementById('print-btn-' + id);

            if (select.value !== select.getAttribute('data-original')) {
                hasChanges = true;
                select.classList.add('border-soft-orange', 'ring-1', 'ring-soft-orange', 'bg-orange-50');
                
                // Kunci (Lock) tombol print
                if (printBtn) {
                    printBtn.classList.add('opacity-50', 'cursor-not-allowed', 'bg-gray-400');
                    printBtn.classList.remove('bg-soft-teal', 'hover:bg-deep-teal');
                    printBtn.setAttribute('title', 'Simpan perubahan status terlebih dahulu untuk mencetak!');
                }
            } else {
                select.classList.remove('border-soft-orange', 'ring-1', 'ring-soft-orange', 'bg-orange-50');
                
                // Buka kunci (Unlock) tombol print
                if (printBtn) {
                    printBtn.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-gray-400');
                    printBtn.classList.add('bg-soft-teal', 'hover:bg-deep-teal');
                    printBtn.setAttribute('title', 'Cetak Rekam Psikologis PDF');
                }
            }
        });

        const btnSaveAll = document.getElementById('btnSaveAll');
        const btnDiscard = document.getElementById('btnDiscard');
        
        if (hasChanges) {
            btnSaveAll.classList.remove('hidden');
            btnDiscard.classList.remove('hidden');
        } else {
            btnSaveAll.classList.add('hidden');
            btnDiscard.classList.add('hidden');
        }
    }

    const colors = {
        primary: '#1F3F3D',
        secondary: '#2F5D5A', 
        accent: '#E59A5A',
        mint: '#7BA7A3',
        teal: '#14B8A6'
    };

    // Load Dashboard Statistics
    fetch('/api/analytics/dashboard-stats')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('totalAssessments').textContent = data.total_assessments;
                document.getElementById('totalStudents').textContent = data.total_students;
                document.getElementById('avgUrgency').textContent = data.avg_urgency + '%';
                document.getElementById('highUrgencyPercentage').textContent = data.high_urgency_percentage + '% urgensi tinggi';
                document.getElementById('completionRate').textContent = data.completion_rate + '%';
                document.getElementById('completedCount').textContent = data.completed_count + ' kasus selesai';
            }
        })
        .catch(err => console.error('Error loading dashboard stats:', err));

    // Monthly Urgency Line Chart
    fetch('/api/analytics/monthly-urgency')
        .then(res => res.json())
        .then(data => {
            if (data.success && data.months.length > 0) {
                const options = {
                    series: data.series,
                    chart: {
                        type: 'line',
                        height: 320,
                        toolbar: { show: true },
                        zoom: { enabled: true }
                    },
                    colors: [colors.accent, colors.teal],
                    stroke: { curve: 'smooth', width: 3 },
                    xaxis: { categories: data.months },
                    yaxis: [
                        {
                            title: { text: 'Skor Urgensi (%)' },
                            min: 0,
                            max: 100
                        },
                        {
                            opposite: true,
                            title: { text: 'Total Asesmen' }
                        }
                    ],
                    tooltip: { shared: true, intersect: false },
                    legend: { position: 'top' },
                    grid: { strokeDashArray: 4 }
                };
                new ApexCharts(document.getElementById('monthlyUrgencyChart'), options).render();
            } else {
                document.getElementById('monthlyUrgencyChart').innerHTML = '<p class="text-center text-gray-500 py-8">Belum ada data urgensi per bulan</p>';
            }
        })
        .catch(err => console.error('Error loading monthly urgency:', err));

    // Category Distribution Pie Chart
    fetch('/api/analytics/category-distribution')
        .then(res => res.json())
        .then(data => {
            if (data.success && data.labels.length > 0) {
                const options = {
                    series: data.series,
                    chart: { type: 'donut', height: 320 },
                    labels: data.labels,
                    colors: ['#1F3F3D', '#2F5D5A', '#0D9488', '#14B8A6', '#2DD4BF', '#99F6E4'],
                    plotOptions: {
                        pie: { donut: { size: '65%' } }
                    },
                    legend: { position: 'bottom' },
                    tooltip: { y: { formatter: val => val + ' kasus' } }
                };
                new ApexCharts(document.getElementById('categoryDistributionChart'), options).render();
            } else {
                document.getElementById('categoryDistributionChart').innerHTML = '<p class="text-center text-gray-500 py-8">Belum ada data kategori</p>';
            }
        })
        .catch(err => console.error('Error loading category distribution:', err));

    // Status Summary Bar Chart
    fetch('/api/analytics/status-summary')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const options = {
                    series: [
                        { name: 'Jumlah Kasus', data: data.totals },
                        { name: 'Rata-rata Skor (%)', data: data.avgScores }
                    ],
                    chart: { 
                        type: 'bar', 
                        height: 320, 
                        toolbar: { show: true },
                        stacked: false
                    },
                    colors: [colors.mint, colors.accent],
                    xaxis: { categories: data.statuses },
                    yaxis: [
                        { 
                            title: { text: 'Jumlah Kasus' },
                            min: 0
                        },
                        { 
                            opposite: true, 
                            title: { text: 'Rata-rata Skor (%)' },
                            min: 0,
                            max: 100
                        }
                    ],
                    plotOptions: { 
                        bar: { 
                            horizontal: false, 
                            columnWidth: '60%',
                            dataLabels: { position: 'top' }
                        } 
                    },
                    legend: { position: 'top' },
                    tooltip: { shared: true, intersect: false }
                };
                new ApexCharts(document.getElementById('statusSummaryChart'), options).render();
            }
        })
        .catch(err => console.error('Error loading status summary:', err));

    // Dominant Category Bar Chart
    fetch('/api/analytics/dominant-category')
        .then(res => res.json())
        .then(data => {
            if (data.success && data.categories.length > 0) {
                const options = {
                    series: [
                        { name: 'Total Asesmen', data: data.totals },
                        { name: 'Selesai', data: data.completed }
                    ],
                    chart: { 
                        type: 'bar', 
                        height: 320, 
                        toolbar: { show: true }, 
                        stacked: false 
                    },
                    colors: [colors.secondary, colors.teal],
                    xaxis: { categories: data.categories },
                    plotOptions: { bar: { columnWidth: '60%' } },
                    legend: { position: 'top' },
                    tooltip: { y: { formatter: val => val + ' kasus' } }
                };
                new ApexCharts(document.getElementById('dominantCategoryChart'), options).render();
            } else {
                document.getElementById('dominantCategoryChart').innerHTML = '<p class="text-center text-gray-500 py-8">Belum ada data kategori dominan</p>';
            }
        })
        .catch(err => console.error('Error loading dominant category:', err));
</script>
@endsection