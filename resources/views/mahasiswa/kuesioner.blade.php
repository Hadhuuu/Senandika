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
                        'warm-beige': '#EADBC8',
                        'cream': '#F6EFE6',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #F6EFE6 0%, #e8d9c4 50%, #dceae9 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1C2B2A;
            min-height: 100vh;
        }

        /* Animated background blobs */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.25;
            animation: blobFloat 8s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }
        .blob-1 { width: 400px; height: 400px; background: #7BA7A3; top: -100px; left: -100px; animation-delay: 0s; }
        .blob-2 { width: 350px; height: 350px; background: #EADBC8; bottom: -80px; right: -80px; animation-delay: -3s; }
        .blob-3 { width: 250px; height: 250px; background: #2F5D5A; top: 40%; left: 60%; animation-delay: -5s; }

        @keyframes blobFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(20px, -20px) scale(1.05); }
            66%       { transform: translate(-15px, 15px) scale(0.95); }
        }

        /* Card slide-in animation */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(32px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card-enter { animation: slideUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) both; }

        /* Question slide-in */
        @keyframes questionSlide {
            from { opacity: 0; transform: translateX(24px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        .question-enter { animation: questionSlide 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0.15s both; }

        /* Options stagger-in */
        @keyframes optionFadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .option-1 { animation: optionFadeIn 0.4s ease 0.25s both; }
        .option-2 { animation: optionFadeIn 0.4s ease 0.35s both; }
        .option-3 { animation: optionFadeIn 0.4s ease 0.45s both; }
        .option-4 { animation: optionFadeIn 0.4s ease 0.55s both; }

        /* Option selected state */
        .option-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .option-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, #1F3F3D, #2F5D5A);
            opacity: 0;
            transition: opacity 0.25s ease;
            border-radius: inherit;
        }
        .option-btn:hover {
            transform: translateX(6px);
            border-color: #7BA7A3 !important;
            box-shadow: 0 4px 20px rgba(31,63,61,0.12);
        }
        .option-btn.selected {
            border-color: #1F3F3D !important;
            transform: translateX(6px);
            box-shadow: 0 6px 24px rgba(31,63,61,0.22);
        }
        .option-btn.selected::before { opacity: 1; }
        .option-btn.selected .option-text { color: white !important; }
        .option-btn.selected .option-icon { opacity: 1; transform: scale(1) rotate(0deg); }
        .option-btn.not-selected { opacity: 0.5; }

        /* Checkmark icon */
        .option-icon {
            opacity: 0;
            transform: scale(0.3) rotate(-90deg);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            flex-shrink: 0;
        }

        /* Ripple effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: scale(0);
            animation: rippleAnim 0.5s linear;
            pointer-events: none;
        }
        @keyframes rippleAnim {
            to { transform: scale(4); opacity: 0; }
        }

        /* Next button slide-up */
        @keyframes nextSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .next-btn-appear { animation: nextSlideUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) both; }

        /* Progress bar fill */
        .progress-fill {
            transition: width 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        }

        /* Pulse on progress number */
        @keyframes countPulse {
            0%   { transform: scale(1); }
            50%  { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        .count-pulse { animation: countPulse 0.4s ease; }
    </style>
</head>
<body class="flex items-center justify-center p-5 m-0">

    <!-- Background blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="relative z-10 w-full max-w-2xl">

        <!-- Card -->
        <div class="card-enter bg-white/70 backdrop-blur-xl p-8 md:p-10 rounded-[40px] shadow-2xl border border-white/60">

            <!-- Header: Label + Counter -->
            <div class="flex justify-between items-center mb-5">
                <span class="text-mint-soft font-bold text-xs tracking-widest uppercase flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Evaluasi Perasaan
                </span>
                <span class="bg-deep-teal text-white text-xs font-bold px-4 py-1.5 rounded-full count-pulse" id="counter">
                    {{ $currentNumber }} / {{ $totalQuestions }}
                </span>
            </div>

            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="w-full bg-mint-soft/20 rounded-full h-2 overflow-hidden">
                    <div class="progress-fill h-2 rounded-full bg-gradient-to-r from-soft-teal to-mint-soft"
                         style="width: {{ round(($currentNumber - 1) / $totalQuestions * 100) }}%">
                    </div>
                </div>
                <p class="text-right text-xs text-mint-soft font-semibold mt-1">
                    {{ round(($currentNumber - 1) / $totalQuestions * 100) }}% selesai
                </p>
            </div>

            <!-- Question -->
            <div class="question-enter mb-8">
                <p class="text-xs font-bold text-mint-soft uppercase tracking-widest mb-3">Pertanyaan {{ $currentNumber }}</p>
                <p class="text-sm text-[#7BA7A3] font-semibold mb-2">Dalam 2 minggu terakhir, seberapa sering kamu merasa...</p>
                <h2 class="text-xl md:text-2xl font-extrabold text-deep-teal leading-snug">
                    {{ $currentSymptom->question }}
                </h2>
            </div>

            <!-- Answer Form -->
            <form action="{{ route('kuesioner.answer') }}" method="POST" id="answerForm">
                @csrf
                <input type="hidden" name="symptom_id" value="{{ $currentSymptom->id }}">
                <input type="hidden" name="cf_user" id="selectedValue" value="">

                <div class="flex flex-col gap-3" id="optionsList">

                    <!-- Option 1 -->
                    <button type="button"
                        onclick="selectOption(this, '0.0')"
                        class="option-btn option-1 w-full text-left bg-white/50 border-2 border-mint-soft/25 py-4 px-6 rounded-2xl cursor-pointer flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                                <span class="option-text font-semibold text-[#5F6F6D] relative z-10">Tidak Pernah</span>
                        </div>
                        <svg class="option-icon w-6 h-6 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </button>

                    <!-- Option 2 -->
                    <button type="button"
                        onclick="selectOption(this, '0.4')"
                        class="option-btn option-2 w-full text-left bg-white/50 border-2 border-mint-soft/25 py-4 px-6 rounded-2xl cursor-pointer flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                                <span class="option-text font-semibold text-[#5F6F6D] relative z-10">Beberapa Hari</span>
                        </div>
                        <svg class="option-icon w-6 h-6 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </button>

                    <!-- Option 3 -->
                    <button type="button"
                        onclick="selectOption(this, '0.8')"
                        class="option-btn option-3 w-full text-left bg-white/50 border-2 border-mint-soft/25 py-4 px-6 rounded-2xl cursor-pointer flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                                <span class="option-text font-semibold text-[#5F6F6D] relative z-10">Lebih Dari Separuh Waktu</span>
                        </div>
                        <svg class="option-icon w-6 h-6 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </button>

                    <!-- Option 4 -->
                    <button type="button"
                        onclick="selectOption(this, '1.0')"
                        class="option-btn option-4 w-full text-left bg-white/50 border-2 border-mint-soft/25 py-4 px-6 rounded-2xl cursor-pointer flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                                <span class="option-text font-semibold text-[#5F6F6D] relative z-10">Hampir Setiap Hari</span>
                        </div>
                        <svg class="option-icon w-6 h-6 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </button>

                </div>

                <!-- Next Button (hidden until selection) -->
                <div id="nextBtnWrapper" class="hidden mt-5">
                    <button type="submit" id="nextBtn"
                        class="next-btn-appear w-full bg-gradient-to-r from-deep-teal to-soft-teal hover:from-soft-teal hover:to-deep-teal text-white font-bold py-4 px-8 rounded-2xl transition-all shadow-lg hover:shadow-xl hover:scale-[1.02] flex items-center justify-center gap-3">
                        <span>Lanjut</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>

            </form>

            <!-- Previous Button -->
            @if($currentNumber > 1)
            <form action="{{ route('kuesioner.previous') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 text-mint-soft hover:text-deep-teal font-semibold py-3 px-6 rounded-2xl border-2 border-mint-soft/25 hover:border-deep-teal/30 bg-transparent hover:bg-white/40 transition-all text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Pertanyaan Sebelumnya
                </button>
            </form>
            @endif

        </div>

    </div>

    <script>
        function selectOption(btn, value) {
            // Ripple effect
            const ripple = document.createElement('span');
            ripple.className = 'ripple';
            const rect = btn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (event.clientX - rect.left - size / 2) + 'px';
            ripple.style.top  = (event.clientY - rect.top  - size / 2) + 'px';
            btn.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);

            // Update hidden input
            document.getElementById('selectedValue').value = value;

            // Update button states
            const allBtns = document.querySelectorAll('.option-btn');
            allBtns.forEach(b => {
                b.classList.remove('selected', 'not-selected');
                if (b !== btn) {
                    b.classList.add('not-selected');
                }
            });
            btn.classList.add('selected');

            // Show Next button
            const wrapper = document.getElementById('nextBtnWrapper');
            wrapper.classList.remove('hidden');
            // Re-trigger animation
            const nextBtn = document.getElementById('nextBtn');
            nextBtn.style.animation = 'none';
            nextBtn.offsetHeight; // reflow
            nextBtn.style.animation = '';
        }
    </script>

</body>
</html>