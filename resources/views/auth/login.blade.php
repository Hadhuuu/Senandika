<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senandika - Masuk</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')

    <style>
        :root {
            --deep-teal: #1F3F3D;
            --soft-teal: #2F5D5A;
            --mint-soft: #7BA7A3;
            --warm-beige: #EADBC8;
            --cream: #F6EFE6;
            --text-dark: #1C2B2A;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
            background-color: var(--cream);
        }
        .text-gradient {
            background: linear-gradient(to right, var(--deep-teal), var(--soft-teal));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-gradient {
            background: linear-gradient(135deg, var(--deep-teal) 0%, var(--soft-teal) 100%);
            box-shadow: 0 10px 25px rgba(31, 63, 61, 0.2);
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(31, 63, 61, 0.3);
        }
        .glass-input {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="min-h-screen flex m-0 relative">

    <!-- Tombol Kembali (Absolute for all screens) -->
    <a href="{{ url('/') }}" class="absolute top-6 left-6 md:top-10 md:left-10 flex items-center gap-2 text-white opacity-70 hover:opacity-100 font-bold transition-all group z-50">
        <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span class="hidden md:inline">Kembali ke Beranda</span>
    </a>

    <!-- Bagian Kiri: Gambar Edukatif/Branding (Hidden on mobile) -->
    <div class="hidden lg:flex w-1/2 relative bg-deep-teal items-center justify-center p-16 overflow-hidden">
        <div class="absolute inset-0 z-0 bg-deep-teal">
            <img src="https://images.unsplash.com/photo-1518241353330-0f7941c2d1b8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="" class="w-full h-full object-cover opacity-60 mix-blend-luminosity" onerror="this.style.display='none'">
            <div class="absolute inset-0 bg-gradient-to-br from-deep-teal/90 to-soft-teal/80"></div>
        </div>
        
        <!-- Ornamen Dekoratif -->
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-mint-soft/30 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-10 right-10 w-64 h-64 bg-[#E59A5A]/20 rounded-full blur-3xl z-0"></div>

        <!-- Teks -->
        <div class="relative z-10 text-white max-w-lg mt-10">
            <div class="mb-8">
                <svg width="80" height="80" viewBox="0 0 100 100" fill="none">
                    <rect x="15" y="20" width="70" height="50" rx="25" fill="white"/>
                    <path d="M40 70 L50 85 L60 70" fill="white"/>
                    <g transform="translate(0,-6)">
                        <path d="M50 45 C50 38, 64 38, 64 48 C64 58, 50 66, 50 66 C50 66, 36 58, 36 48 C36 38, 50 38, 50 45Z" fill="#1F3F3D"/>
                    </g>
                </svg>
            </div>
            <h1 class="text-5xl font-extrabold mb-6 leading-tight">Senandika.</h1>
            
            <div class="h-24 flex items-start">
                <p id="quote-text" class="text-xl text-mint-soft leading-relaxed transition-opacity duration-300">
                    "Bercerita adalah langkah pertama menuju pemulihan. Ruang aman Anda menanti di dalam."
                </p>
            </div>
            
            <div class="flex gap-3 items-center mt-4">
                <button onclick="changeQuote(0)" class="quote-dot w-16 h-1.5 bg-[#E59A5A] rounded-full transition-all duration-300 focus:outline-none"></button>
                <button onclick="changeQuote(1)" class="quote-dot w-3 h-1.5 bg-mint-soft/50 hover:bg-mint-soft rounded-full transition-all duration-300 focus:outline-none cursor-pointer"></button>
                <button onclick="changeQuote(2)" class="quote-dot w-3 h-1.5 bg-mint-soft/50 hover:bg-mint-soft rounded-full transition-all duration-300 focus:outline-none cursor-pointer"></button>
            </div>
        </div>
    </div>

    <!-- Bagian Kanan: Form Login -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-20 relative bg-cream">
        <!-- Dekorasi Background Kanan -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-mint-soft/20 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-[#E59A5A]/10 rounded-full blur-3xl -z-10"></div>

        <div class="w-full max-w-[420px] z-10 animate-[fadeIn_0.8s_ease]">
            <!-- Header Form -->
            <div class="mb-10 text-center lg:text-left">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-deep-teal mb-3 tracking-tight">Selamat Datang!</h2>
                <p class="text-[#5F6F6D] text-lg">Silakan masuk menggunakan NIM atau NIP Anda untuk melanjutkan.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 text-sm flex gap-3 shadow-sm">
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}" class="flex flex-col gap-6">
                @csrf
                
                <!-- Input NIM/NIP -->
                <div>
                    <label class="block text-sm font-bold text-deep-teal mb-2 ml-1">NIM / NIP</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#7BA7A3]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <input type="text" name="nim" required value="{{ old('nim') }}" placeholder="Masukkan NIM / NIP"
                               class="w-full pl-11 pr-5 py-3.5 rounded-2xl glass-input border-2 border-mint-soft/30 focus:outline-none focus:border-soft-teal focus:ring-4 focus:ring-soft-teal/10 transition-all font-medium text-deep-teal placeholder:text-mint-soft/70">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <label class="block text-sm font-bold text-deep-teal mb-2 ml-1">Kata Sandi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#7BA7A3]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" name="password" required placeholder="Masukkan Kata Sandi"
                               class="w-full pl-11 pr-5 py-3.5 rounded-2xl glass-input border-2 border-mint-soft/30 focus:outline-none focus:border-soft-teal focus:ring-4 focus:ring-soft-teal/10 transition-all font-medium text-deep-teal placeholder:text-mint-soft/70">
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn-gradient text-white border-none py-4 rounded-2xl text-lg font-bold cursor-pointer w-full transition-all duration-300 mt-4 flex justify-center items-center gap-2 group">
                    <span>Masuk ke Akun</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-[#5F6F6D]">Belum punya akun? <a href="https://wa.me/6281234567890" target="_blank" class="font-bold text-[#E59A5A] hover:text-[#c47f45] transition-colors">Hubungi Admin Kampus</a></p>
            </div>
        </div>
    </div>

    <script>
        const quotes = [
            "\"Bercerita adalah langkah pertama menuju pemulihan. Ruang aman Anda menanti di dalam.\"",
            "\"Kesehatan mentalmu sama pentingnya dengan nilai akademikmu. Jangan ragu untuk meminta bantuan.\"",
            "\"Tidak apa-apa untuk merasa tidak baik-baik saja. Kami di sini untuk mendengarkan tanpa menghakimi.\""
        ];
        
        let currentQuote = 0;
        
        function changeQuote(index) {
            currentQuote = index;
            const textElement = document.getElementById('quote-text');
            const dots = document.querySelectorAll('.quote-dot');
            
            // Fade out
            textElement.style.opacity = 0;
            
            setTimeout(() => {
                // Update text
                textElement.innerText = quotes[currentQuote];
                // Fade in
                textElement.style.opacity = 1;
            }, 300);
            
            // Update dots styling
            dots.forEach((dot, i) => {
                if (i === currentQuote) {
                    dot.className = "quote-dot w-16 h-1.5 bg-[#E59A5A] rounded-full transition-all duration-300 focus:outline-none";
                } else {
                    dot.className = "quote-dot w-3 h-1.5 bg-mint-soft/50 hover:bg-mint-soft rounded-full transition-all duration-300 focus:outline-none cursor-pointer";
                }
            });
        }

        // Auto rotate quotes every 5 seconds
        setInterval(() => {
            changeQuote((currentQuote + 1) % quotes.length);
        }, 5000);
    </script>
</body>
</html>