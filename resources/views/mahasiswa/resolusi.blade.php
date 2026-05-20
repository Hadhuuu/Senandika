<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - Senandika</title>
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
<body class="min-h-screen flex items-center justify-center p-5 m-0 text-center">

    <div class="bg-white/60 backdrop-blur-md p-8 md:p-12 rounded-[40px] shadow-2xl border border-white/50 w-full max-w-xl">
        
        <div class="flex justify-center mb-6">
            <div class="w-20 h-20 bg-gradient-to-tr from-[#E8AFA3] to-[#E59A5A] rounded-full flex items-center justify-center shadow-lg">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="white">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
        </div>

        <h2 class="text-3xl font-extrabold text-deep-teal mb-4">Terima kasih sudah berbagi.</h2>
        
        <p class="text-[#5F6F6D] text-[15px] leading-relaxed mb-8">
            Perasaanmu sangat valid. Datamu sudah kami amankan dan akan di-review oleh Konselor Kampus untuk mencarikan dukungan terbaik bagimu. <br><br>
            Jika kamu butuh teman bicara atau bantuan mendesak saat ini juga, jangan ragu untuk menghubungi:
        </p>

        <div class="bg-white/50 p-5 rounded-2xl border border-mint-soft/30 mb-8 flex flex-col gap-3">
            <div class="flex items-center justify-between">
                <span class="font-bold text-sm text-soft-teal">Hotline SEJIWA (Kemkes)</span>
                <span class="font-bold text-deep-teal">119 (Ext. 8)</span>
            </div>
            <div class="h-px w-full bg-mint-soft/20"></div>
            <div class="flex items-center justify-between">
                <span class="font-bold text-sm text-soft-teal">Konseling Kampus</span>
                <span class="font-bold text-deep-teal">0812-3456-7890</span>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-deep-teal text-white py-4 rounded-[20px] text-lg font-bold hover:bg-soft-teal transition-all shadow-md cursor-pointer">
                Selesai & Keluar
            </button>
        </form>

    </div>

</body>
</html>