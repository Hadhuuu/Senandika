<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senandika - Calm Therapy</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
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
            background: linear-gradient(120deg, var(--cream) 0%, var(--warm-beige) 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark);
        }
        .login-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(14px);
            box-shadow: 0 25px 50px rgba(31, 63, 61, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.5);
            animation: fadeIn 1s ease;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        .text-gradient {
            background: linear-gradient(to right, var(--deep-teal), var(--soft-teal));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-gradient {
            background: linear-gradient(135deg, var(--deep-teal) 0%, var(--soft-teal) 100%);
            box-shadow: 0 10px 25px rgba(31, 63, 61, 0.3);
        }
        .btn-gradient:hover {
            transform: scale(1.04);
            box-shadow: 0 15px 35px rgba(31, 63, 61, 0.4);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center m-0">

    <div class="login-card w-[90%] max-w-[400px] p-10 rounded-[40px] text-center">
        <div class="flex justify-center mb-5 drop-shadow-[0_10px_20px_rgba(31,63,61,0.2)]">
            <svg width="110" height="110" viewBox="0 0 100 100" fill="none">
                <rect x="15" y="20" width="70" height="50" rx="25" fill="url(#grad1)"/>
                <path d="M40 70 L50 85 L60 70" fill="url(#grad1)"/>
                <g transform="translate(0,-6)">
                    <path d="M50 45 C50 38, 64 38, 64 48 C64 58, 50 66, 50 66 C50 66, 36 58, 36 48 C36 38, 50 38, 50 45Z" fill="white"/>
                </g>
                <defs>
                    <linearGradient id="grad1">
                        <stop stop-color="#1F3F3D"/>
                        <stop offset="1" stop-color="#7BA7A3"/>
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <h1 class="text-[34px] font-extrabold m-0 text-gradient tracking-tight">senandika</h1>
        <div class="text-[12px] font-bold text-[#7BA7A3] uppercase tracking-[2px] mb-8 mt-1">Safe Space</div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-xl mb-4 text-sm text-left">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}" class="flex flex-col gap-4 text-left">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-[#5F6F6D] mb-1 ml-2">NIM / NIP</label>
                <input type="text" name="nim" required value="{{ old('nim') }}"
                       class="w-full px-5 py-3 rounded-2xl bg-white/50 border border-[#7BA7A3]/30 focus:outline-none focus:border-[#2F5D5A] focus:ring-1 focus:ring-[#2F5D5A] transition-all">
            </div>

            <div class="mb-2">
                <label class="block text-sm font-semibold text-[#5F6F6D] mb-1 ml-2">Password</label>
                <input type="password" name="password" required 
                       class="w-full px-5 py-3 rounded-2xl bg-white/50 border border-[#7BA7A3]/30 focus:outline-none focus:border-[#2F5D5A] focus:ring-1 focus:ring-[#2F5D5A] transition-all">
            </div>

            <button type="submit" class="btn-gradient text-white border-none py-4 rounded-[20px] text-base font-bold cursor-pointer w-full transition-all duration-300 mt-2">
                Masuk
            </button>
        </form>

    </div>

</body>
</html>