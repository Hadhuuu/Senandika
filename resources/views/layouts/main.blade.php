<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senandika - @yield('title', 'Safe Space')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        'deep-teal': '#1F3F3D',
                        'soft-teal': '#2F5D5A',
                        'mint-soft': '#7BA7A3',
                        'warm-beige': '#EADBC8',
                        'cream': '#F6EFE6',
                        'soft-orange': '#E59A5A',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cream text-[#1C2B2A] flex flex-col min-h-screen m-0">
    @php
        $homeUrl = url('/');
        if (Auth::check()) {
            $homeUrl = Auth::user()->role === 'admin' ? route('admin.dashboard') : route('mahasiswa.dashboard');
        }
    @endphp

    <nav class="bg-white/70 backdrop-blur-lg border-b border-mint-soft/20 fixed w-full z-50 top-0 transition-all">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ $homeUrl }}" class="flex items-center gap-2">
                    <svg width="40" height="40" viewBox="0 0 100 100" fill="none">
                        <rect x="15" y="20" width="70" height="50" rx="25" fill="#1F3F3D"/>
                        <path d="M40 70 L50 85 L60 70" fill="#1F3F3D"/>
                        <path d="M50 45 C50 38, 64 38, 64 48 C64 58, 50 66, 50 66 C50 66, 36 58, 36 48 C36 38, 50 38, 50 45Z" fill="white" transform="translate(0,-6)"/>
                    </svg>
                    <span class="text-2xl font-extrabold text-deep-teal tracking-tight">senandika.</span>
                </a>

                <div class="hidden md:flex space-x-8">
                    <a href="{{ $homeUrl }}" class="text-soft-teal hover:text-deep-teal font-semibold transition-colors">Beranda</a>
                    <a href="{{ route('tentang-kami') }}" class="text-soft-teal hover:text-deep-teal font-semibold transition-colors">Tentang Kami</a>
                    <a href="{{ route('kontak-darurat') }}" class="text-soft-teal hover:text-deep-teal font-semibold transition-colors">Kontak Darurat</a>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-sm font-semibold text-deep-teal hidden md:block">Halo, {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-mint-soft/20 text-deep-teal px-5 py-2.5 rounded-xl font-bold hover:bg-mint-soft/40 transition-colors">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-deep-teal to-soft-teal text-white px-6 py-2.5 rounded-xl font-bold hover:shadow-lg hover:scale-105 transition-all">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    <footer class="bg-deep-teal text-white py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <span class="text-2xl font-extrabold tracking-tight">senandika.</span>
                <p class="text-mint-soft text-sm mt-2 font-medium">Safe Space untuk Kesehatan Mental Mahasiswa.</p>
            </div>
            <div class="text-mint-soft text-sm font-medium">
                &copy; {{ date('Y') }} Senandika. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>