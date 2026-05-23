<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekam Psikologis - {{ $assessment->user->name }}</title>
    <style>
        body { 
            font-family: 'Helvetica', sans-serif; 
            color: #2D3748; 
            line-height: 1.6; 
            font-size: 12px;
        }
        .header { text-align: center; margin-bottom: 25px; }
        .header h2 { margin: 0; color: #0D3B36; font-size: 20px; font-weight: 800; }
        .header p { margin: 5px 0 0 0; color: #5F6F6D; font-size: 13px; }
        .line { border-bottom: 2px solid #49715A; margin-bottom: 25px; }
        
        .section-title { 
            font-size: 13px; 
            font-weight: bold; 
            color: #0D3B36; 
            background-color: #F3F7F5; 
            padding: 6px 10px; 
            border-left: 4px solid #49715A;
            margin-top: 20px;
            margin-bottom: 12px;
        }
        
        .profile-grid { width: 100%; margin-bottom: 15px; }
        .profile-grid td { padding: 4px 0; vertical-align: top; }
        .label { color: #5F6F6D; width: 30%; }
        .value { font-weight: bold; width: 70%; color: #0D3B36; }
        
        table.table-data { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        table.table-data, .table-data th, .table-data td { 
            border: 1px solid #E2E8F0; 
        }
        .table-data th { 
            background-color: #F8FAFC; 
            padding: 10px; 
            text-align: left; 
            color: #0D3B36;
            font-weight: bold;
        }
        .table-data td { padding: 10px; vertical-align: middle; }
        
        .badge {
            background-color: #EDF2F7;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            color: #4A5568;
        }
        
        .ttd-container { 
            margin-top: 50px; 
            width: 100%;
        }
        .ttd-box { 
            float: right; 
            text-align: center; 
            width: 200px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Aplikasi Senandika</h2>
        <p>Laporan Rekam Psikologis Mahasiswa</p>
    </div>
    <div class="line"></div>

    <div class="section-title">1. Profil Akademik & Demografi</div>
    <table class="profile-grid">
        <tr>
            <td class="label">Nama Lengkap</td>
            <td class="value">: {{ $assessment->user->name }}</td>
        </tr>
        <tr>
            <td class="label">NIM</td>
            <td class="value">: {{ $assessment->user->nim }}</td>
        </tr>
        <tr>
            <td class="label">Jurusan / Program Studi</td>
            <td class="value">: {{ $assessment->user->course }}</td>
        </tr>
        <tr>
            <td class="label">Tahun Perkuliahan</td>
            <td class="value">: Ke-{{ $assessment->user->current_year }}</td>
        </tr>
        <tr>
            <td class="label">IPK Terakhir (GPA)</td>
            <td class="value">: {{ $assessment->user->gpa }}</td>
        </tr>
        <tr>
            <td class="label">Status Pernikahan</td>
            <td class="value">: {{ $assessment->user->marital_status }}</td>
        </tr>
    </table>

    <div class="section-title">2. Hasil Analisis Sistem Pakar (Certainty Factor)</div>
    <table class="profile-grid">
        <tr>
            <td class="label">Skor Urgensi Akhir</td>
            <td class="value" style="font-size: 14px; color: #DD6B20;">: {{ $assessment->final_score }}%</td>
        </tr>
        <tr>
            <td class="label">Kategori Dominan</td>
            <td class="value">: {{ $assessment->dominant_category }}</td>
        </tr>
        <tr>
            <td class="label">Status Penanganan</td>
            <td class="value">: {{ $assessment->status }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Pelaksanaan Asesmen</td>
            <td class="value">: {{ $assessment->created_at->format('d F Y (H:i)') }} WIB</td>
        </tr>
    </table>

    <div class="section-title">3. Rincian Analisis Gejala Berdasarkan Jawaban Kuesioner</div>
    <table class="table-data">
        <thead>
            <tr>
                <th style="width: 8%;">No</th>
                <th style="width: 72%;">Indikasi Gejala / Pertanyaan</th>
                <th style="width: 20%; text-align: center;">Keyakinan (CF)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assessment->details as $index => $detail)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>
                    <div style="font-weight: 600; margin-bottom: 3px;">"{{ $detail->symptom->question }}"</div>
                    <span class="badge">{{ $detail->symptom->category }}</span>
                </td>
                <td style="text-align: center; font-weight: bold; color: {{ $detail->cf_user >= 0.8 ? '#DD6B20' : '#319795' }};">
                    {{ $detail->cf_user * 100 }}%
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd-container">
        <div class="ttd-box">
            <p>Malang, {{ now()->format('d M Y') }}</p>
            <br><br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">( Tim Konselor Senandika )</p>
        </div>
    </div>

</body>
</html>