<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuesioner - Senandika</title>
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

    <div class="bg-white/60 backdrop-blur-md p-8 md:p-10 rounded-[40px] shadow-2xl border border-white/50 w-full max-w-2xl">
        
        <div class="flex justify-between items-center mb-6">
            <span class="text-mint-soft font-bold text-xs tracking-widest uppercase">Evaluasi Perasaan</span>
            <span class="bg-deep-teal text-white text-xs font-bold px-4 py-1.5 rounded-full">
                {{ $currentNumber }} / {{ $totalQuestions }}
            </span>
        </div>

        <div class="mb-10">
            <h2 class="text-2xl md:text-3xl font-extrabold text-deep-teal leading-snug">
                "{{ $currentSymptom->question }}"
            </h2>
        </div>

        <form action="{{ route('kuesioner.answer') }}" method="POST" class="flex flex-col gap-3">
            @csrf
            <input type="hidden" name="symptom_id" value="{{ $currentSymptom->id }}">

            <button type="submit" name="cf_user" value="0.0" 
                class="w-full text-left bg-white/50 border-2 border-mint-soft/30 hover:border-soft-teal hover:bg-white text-[#5F6F6D] hover:text-deep-teal font-semibold py-4 px-6 rounded-2xl transition-all cursor-pointer">
                Tidak Pernah
            </button>

            <button type="submit" name="cf_user" value="0.4" 
                class="w-full text-left bg-white/50 border-2 border-mint-soft/30 hover:border-soft-teal hover:bg-white text-[#5F6F6D] hover:text-deep-teal font-semibold py-4 px-6 rounded-2xl transition-all cursor-pointer">
                Jarang / Sedikit Yakin
            </button>

            <button type="submit" name="cf_user" value="0.8" 
                class="w-full text-left bg-white/50 border-2 border-mint-soft/30 hover:border-soft-teal hover:bg-white text-[#5F6F6D] hover:text-deep-teal font-semibold py-4 px-6 rounded-2xl transition-all cursor-pointer">
                Sering / Cukup Yakin
            </button>

            <button type="submit" name="cf_user" value="1.0" 
                class="w-full text-left bg-white/50 border-2 border-mint-soft/30 hover:border-soft-teal hover:bg-white text-[#5F6F6D] hover:text-deep-teal font-semibold py-4 px-6 rounded-2xl transition-all cursor-pointer">
                Hampir Setiap Hari / Sangat Yakin
            </button>
        </form>

    </div>

</body>
</html>