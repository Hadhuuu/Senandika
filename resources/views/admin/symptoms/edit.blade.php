@extends('layouts.main')

@section('title', 'Edit Gejala - ' . $symptom->code)

@section('content')
<div class="max-w-3xl mx-auto px-6 lg:px-8 py-10">

    <div class="mb-8">
        <a href="{{ route('admin.symptoms.index') }}" class="text-deep-teal font-bold hover:underline flex items-center gap-2 mb-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Master Gejala
        </a>
        <h1 class="text-3xl font-extrabold text-deep-teal mb-2">Edit Gejala</h1>
        <p class="text-[#5F6F6D]">Ubah pertanyaan, kategori, atau Certainty Factor (CF) Pakar gejala <span class="font-bold">{{ $symptom->code }}</span>.</p>
    </div>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="bg-soft-orange/20 border border-soft-orange text-soft-orange px-6 py-4 rounded-2xl mb-6">
            <p class="font-bold mb-2">Terdapat kesalahan dalam form:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-[30px] shadow-xl border border-mint-soft/20 p-8">
        <form action="{{ route('admin.symptoms.update', $symptom) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Kode Gejala -->
            <div>
                <label for="code" class="block text-sm font-bold text-deep-teal mb-2">
                    Kode Gejala <span class="text-soft-orange">*</span>
                </label>
                <input 
                    type="text" 
                    name="code" 
                    id="code"
                    placeholder="Contoh: G01, G02"
                    class="w-full px-4 py-3 border border-mint-soft/30 rounded-xl focus:ring-2 focus:ring-soft-teal focus:border-transparent @error('code') border-soft-orange @enderror"
                    value="{{ old('code', $symptom->code) }}"
                    maxlength="10"
                    required
                >
                @error('code')
                    <p class="text-soft-orange text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-[#5F6F6D] mt-2">Kode harus unik dan maksimal 10 karakter</p>
            </div>

            <!-- Pertanyaan/Gejala -->
            <div>
                <label for="question" class="block text-sm font-bold text-deep-teal mb-2">
                    Pertanyaan/Gejala <span class="text-soft-orange">*</span>
                </label>
                <textarea 
                    name="question" 
                    id="question"
                    rows="4"
                    placeholder="Masukkan pertanyaan/gejala"
                    class="w-full px-4 py-3 border border-mint-soft/30 rounded-xl focus:ring-2 focus:ring-soft-teal focus:border-transparent @error('question') border-soft-orange @enderror"
                    maxlength="500"
                    required
                >{{ old('question', $symptom->question) }}</textarea>
                @error('question')
                    <p class="text-soft-orange text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-[#5F6F6D] mt-2">Maksimal 500 karakter</p>
            </div>

            <!-- Kategori & CF Pakar -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="category" class="block text-sm font-bold text-deep-teal mb-2">
                        Kategori <span class="text-soft-orange">*</span>
                    </label>
                    <div class="flex gap-2">
                        <select 
                            name="category" 
                            id="category"
                            class="flex-1 px-4 py-3 border border-mint-soft/30 rounded-xl focus:ring-2 focus:ring-soft-teal focus:border-transparent @error('category') border-soft-orange @enderror"
                            required
                        >
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category', $symptom->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        <input 
                            type="text" 
                            id="newCategory"
                            placeholder="Atau kategori baru"
                            class="flex-1 px-4 py-3 border border-mint-soft/30 rounded-xl focus:ring-2 focus:ring-soft-teal focus:border-transparent"
                        >
                    </div>
                    @error('category')
                        <p class="text-soft-orange text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cf_pakar" class="block text-sm font-bold text-deep-teal mb-2">
                        Certainty Factor (CF) Pakar <span class="text-soft-orange">*</span>
                    </label>
                    <div class="flex items-center gap-4">
                        <input 
                            type="number" 
                            name="cf_pakar" 
                            id="cf_pakar"
                            placeholder="0.00 - 1.00"
                            class="flex-1 px-4 py-3 border border-mint-soft/30 rounded-xl focus:ring-2 focus:ring-soft-teal focus:border-transparent @error('cf_pakar') border-soft-orange @enderror"
                            value="{{ old('cf_pakar', $symptom->cf_pakar) }}"
                            min="0"
                            max="1"
                            step="0.01"
                            required
                        >
                        <div class="text-3xl font-bold text-soft-orange" id="cfDisplay">{{ number_format($symptom->cf_pakar, 2) }}</div>
                    </div>
                    @error('cf_pakar')
                        <p class="text-soft-orange text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-[#5F6F6D] mt-2">Range: 0.00 hingga 1.00</p>
                </div>
            </div>

            <!-- Info Box -->
            <div class="bg-mint-soft/10 border border-mint-soft/30 rounded-2xl p-4">
                <p class="text-sm text-deep-teal">
                    <strong>📝 Info Edit:</strong> Perubahan CF Pakar akan mempengaruhi kalkulasi asesmen mendatang, 
                    tetapi tidak mengubah hasil asesmen yang sudah dilakukan.
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4 border-t border-mint-soft/20">
                <a href="{{ route('admin.symptoms.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-xl transition-colors text-center">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-deep-teal hover:bg-soft-teal text-white font-bold py-3 px-6 rounded-xl transition-colors">
                    Perbarui Gejala
                </button>
            </div>
        </form>
    </div>

</div>

<script>
// Update CF display value
document.getElementById('cf_pakar').addEventListener('input', function() {
    document.getElementById('cfDisplay').textContent = parseFloat(this.value).toFixed(2);
});

// Handle category input
document.getElementById('newCategory').addEventListener('blur', function() {
    if (this.value) {
        document.getElementById('category').value = this.value;
    }
});
</script>
@endsection
