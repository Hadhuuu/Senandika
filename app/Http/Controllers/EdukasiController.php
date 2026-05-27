<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EdukasiController extends Controller
{
    // Data statis untuk artikel edukasi
    private $articles = [
        [
            'id' => 1,
            'title' => 'Cara Mencegah Burnout Menjelang Ujian',
            'category' => 'Tips Kuliah',
            'image' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=600',
            'summary' => 'Tekanan akademik kadang terasa berat. Kenali tanda-tanda burnout dan pelajari cara mengatasinya dengan langkah sederhana.',
            'content' => '<p class="mb-4">Burnout adalah kondisi kelelahan emosional, fisik, dan mental yang disebabkan oleh stres yang berlebihan dan berkepanjangan. Hal ini terjadi ketika Anda merasa kewalahan, kehabisan tenaga emosional, dan tidak mampu memenuhi tuntutan yang terus-menerus.</p>
            <h3 class="text-xl font-bold text-deep-teal mb-3 mt-6">Tanda-tanda Burnout:</h3>
            <ul class="list-disc pl-5 mb-4 text-[#5F6F6D] space-y-2">
                <li>Merasa lelah sepanjang waktu</li>
                <li>Sering merasa pusing atau sakit perut</li>
                <li>Perubahan nafsu makan dan pola tidur</li>
                <li>Menarik diri dari tanggung jawab</li>
                <li>Menunda-nunda tugas yang membutuhkan banyak waktu</li>
            </ul>
            <h3 class="text-xl font-bold text-deep-teal mb-3 mt-6">Cara Mengatasinya:</h3>
            <ol class="list-decimal pl-5 mb-4 text-[#5F6F6D] space-y-2">
                <li><strong>Istirahat yang cukup:</strong> Jangan begadang setiap hari. Pastikan Anda tidur 7-8 jam per hari.</li>
                <li><strong>Makan makanan bergizi:</strong> Nutrisi yang baik membantu fungsi otak dan tubuh secara keseluruhan.</li>
                <li><strong>Lakukan aktivitas fisik:</strong> Olahraga ringan minimal 30 menit sehari dapat meredakan stres.</li>
                <li><strong>Kelola waktu:</strong> Buat jadwal belajar yang realistis dan jangan lupa selipkan waktu istirahat (teknik Pomodoro).</li>
            </ol>'
        ],
        [
            'id' => 2,
            'title' => 'Pentingnya Mengambil Jeda 5 Menit',
            'category' => 'Self-Care',
            'image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=600',
            'summary' => 'Tidak perlu liburan panjang, cukup jeda 5 menit di sela aktivitasmu bisa mereset tingkat stres secara signifikan.',
            'content' => '<p class="mb-4">Terlalu lama menatap layar laptop atau mengerjakan tugas tanpa henti dapat meningkatkan tingkat stres dan menurunkan konsentrasi. Jeda singkat selama 5 menit adalah bentuk <em>self-care</em> yang paling sederhana namun sering diremehkan.</p>
            <p class="mb-4">Memberikan waktu bagi otak untuk beristirahat dapat membantu mereset fokus, memperbaiki <em>mood</em>, dan mencegah kelelahan mental berkepanjangan.</p>
            <h3 class="text-xl font-bold text-deep-teal mb-3 mt-6">Apa yang Bisa Dilakukan dalam 5 Menit?</h3>
            <ul class="list-disc pl-5 mb-4 text-[#5F6F6D] space-y-2">
                <li><strong>Peregangan Ringan:</strong> Berdiri dan regangkan tubuh, terutama bahu, leher, dan punggung bagian bawah.</li>
                <li><strong>Aturan 20-20-20:</strong> Setiap 20 menit, tatap objek berjarak 20 kaki (sekitar 6 meter) selama 20 detik untuk mengistirahatkan mata.</li>
                <li><strong>Minum Air Putih:</strong> Dehidrasi ringan bisa menyebabkan sakit kepala dan kelelahan. Ambil jeda untuk minum segelas air.</li>
                <li><strong>Latihan Pernapasan:</strong> Tarik napas dalam-dalam melalui hidung selama 4 detik, lalu embuskan perlahan melalui mulut. Ulangi 3-5 kali.</li>
                <li><strong>Menjauh dari Layar:</strong> Pejamkan mata atau nikmati pemandangan di luar jendela tanpa memegang ponsel.</li>
            </ul>
            <p class="mt-6 text-[#5F6F6D]">Ingat, kamu bukan robot. Produktivitas yang baik berawal dari tubuh dan pikiran yang sehat!</p>'
        ],
        [
            'id' => 3,
            'title' => 'Pentingnya Circle Pertemanan Positif',
            'category' => 'Sosial',
            'image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=600',
            'summary' => 'Lingkungan sangat mempengaruhi performa dan kesehatan mental Anda. Temukan teman yang mendukung perkembangan Anda.',
            'content' => '<p class="mb-4">Masa kuliah adalah masa di mana Anda mulai membangun jaringan dan mencari jati diri. Teman yang Anda pilih akan sangat mempengaruhi cara Anda berpikir, bertindak, dan memandang dunia.</p>
            <h3 class="text-xl font-bold text-deep-teal mb-3 mt-6">Ciri Circle Pertemanan yang Sehat:</h3>
            <ul class="list-disc pl-5 mb-4 text-[#5F6F6D] space-y-2">
                <li><strong>Saling Mendukung:</strong> Mereka merayakan kesuksesan Anda dan memberikan dukungan saat Anda gagal.</li>
                <li><strong>Komunikasi Terbuka:</strong> Anda bisa membicarakan apa saja tanpa takut dihakimi.</li>
                <li><strong>Menghargai Batasan:</strong> Mereka mengerti kapan Anda butuh waktu sendiri atau sedang sibuk.</li>
                <li><strong>Memotivasi untuk Maju:</strong> Berada di dekat mereka membuat Anda ingin menjadi versi terbaik dari diri sendiri.</li>
            </ul>
            <p class="mt-6 text-[#5F6F6D]">Jangan ragu untuk menjauh dari lingkungan yang toksik. Kesehatan mental dan kedamaian pikiran Anda jauh lebih penting.</p>'
        ]
    ];

    public function index()
    {
        if (Auth::user()->role !== 'mahasiswa') abort(403);
        $articles = collect($this->articles);
        return view('mahasiswa.edukasi.index', compact('articles'));
    }

    public function show($id)
    {
        if (Auth::user()->role !== 'mahasiswa') abort(403);
        $article = collect($this->articles)->firstWhere('id', (int)$id);
        
        if (!$article) abort(404);

        return view('mahasiswa.edukasi.show', compact('article'));
    }
}
