<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informed Consent - Senandika</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'deep-teal': '#1F3F3D',
                        'soft-teal': '#2F5D5A',
                        'mint-soft': '#7BA7A3',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background: linear-gradient(120deg, #F6EFE6 0%, #EADBC8 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1C2B2A;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-5 m-0">

    <div class="bg-white/60 backdrop-blur-md p-8 md:p-10 rounded-[40px] shadow-2xl border border-white/50 w-full max-w-2xl transition-all">
        
        <h2 class="text-3xl font-extrabold text-deep-teal mb-1">Sebelum kita mulai...</h2>
        <p class="text-mint-soft font-bold text-sm tracking-[2px] uppercase mb-8">Informed Consent</p>

        <div class="space-y-4 text-[#5F6F6D] text-[15px] leading-relaxed bg-white/50 p-6 rounded-2xl border border-mint-soft/30 mb-8">
            <p>Halo, <strong class="text-deep-teal">{{ Auth::user()->name }}</strong>. Ruang ini adalah tempat yang aman untukmu.</p>
            <p>Dengan menekan tombol setuju di bawah, kamu memahami bahwa:</p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Sistem ini <strong class="text-deep-teal">bukanlah pengganti diagnosis medis</strong> atau psikologis profesional.</li>
                <li>Data yang kamu isikan akan dijaga kerahasiaannya dan hanya dapat diakses oleh Psikolog/Konselor Kampus untuk tujuan penanganan lanjutan.</li>
                <li>Jawablah sesuai dengan apa yang paling kamu rasakan dalam <strong class="text-deep-teal">2 minggu terakhir</strong>. Tidak ada jawaban yang salah.</li>
            </ul>
        </div>

        <form action="{{ route('kuesioner.accept') }}" method="POST">
            @csrf
            <div class="flex items-start gap-3 mb-8 bg-white/40 p-4 rounded-xl border border-white/50">
                <input type="checkbox" id="agree" required class="mt-1 w-5 h-5 accent-soft-teal cursor-pointer">
                <label for="agree" class="text-sm font-semibold text-[#1C2B2A] cursor-pointer">
                    Saya mengerti dan setuju untuk membagikan perasaan saya kepada Konselor Kampus demi kebaikan saya.
                </label>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-deep-teal to-soft-teal text-white py-4 rounded-[20px] text-lg font-bold hover:scale-[1.02] hover:shadow-xl transition-all duration-300 cursor-pointer">
                Ya, Saya Setuju & Mulai
            </button>
        </form>
    </div>

</body>
</html>