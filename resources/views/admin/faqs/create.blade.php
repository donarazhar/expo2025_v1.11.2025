@extends('admin.layouts.app')

@section('title', 'Tambah FAQ Baru')
@section('page-title', 'Tambah FAQ')
@section('page-subtitle', 'Buat pertanyaan dan jawaban baru')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('admin.faqs.index') }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar FAQs
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Form FAQ Baru</h3>
                <p class="text-gray-600">Lengkapi form di bawah untuk menambahkan FAQ baru</p>
            </div>

            <form action="{{ route('admin.faqs.store') }}" method="POST" class="space-y-6" x-data="faqForm()">
                @csrf

                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>

                    <div x-data="{ mode: 'select' }">
                        <!-- Mode Toggle -->
                        <div class="flex gap-2 mb-3">
                            <button type="button" @click="mode = 'select'"
                                :class="mode === 'select' ? 'bg-azhar-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                                class="px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                                Pilih dari Daftar
                            </button>
                            <button type="button" @click="mode = 'new'"
                                :class="mode === 'new' ? 'bg-azhar-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                                class="px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                                Kategori Baru
                            </button>
                        </div>

                        <!-- Select Existing -->
                        <div x-show="mode === 'select'" x-cloak>
                            <select name="kategori"
                                class="input-field {{ $errors->has('kategori') ? 'border-red-500' : '' }}"
                                x-model="selectedKategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}"
                                        {{ old('kategori') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input New -->
                        <div x-show="mode === 'new'" x-cloak>
                            <input type="text" name="kategori" value="{{ old('kategori') }}"
                                class="input-field {{ $errors->has('kategori') ? 'border-red-500' : '' }}"
                                placeholder="Contoh: Umum, Pendaftaran, Teknis" x-model="newKategori">
                        </div>
                    </div>

                    @error('kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Pilih kategori yang sudah ada atau buat kategori baru</p>
                </div>

                <!-- Pertanyaan -->
                <div>
                    <label for="pertanyaan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pertanyaan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="pertanyaan" name="pertanyaan" rows="3" maxlength="500"
                        class="input-field {{ $errors->has('pertanyaan') ? 'border-red-500' : '' }}"
                        placeholder="Tulis pertanyaan yang sering ditanyakan..." required x-model="pertanyaan" @input="updateCharCount">{{ old('pertanyaan') }}</textarea>
                    @error('pertanyaan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">
                        <span x-text="pertanyaan.length"></span>/500 karakter
                    </p>
                </div>

                <!-- Jawaban -->
                <div>
                    <label for="jawaban" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jawaban <span class="text-red-500">*</span>
                    </label>
                    <textarea id="jawaban" name="jawaban" rows="8"
                        class="input-field {{ $errors->has('jawaban') ? 'border-red-500' : '' }}"
                        placeholder="Tulis jawaban lengkap dan jelas..." required>{{ old('jawaban') }}</textarea>
                    @error('jawaban')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Gunakan bahasa yang mudah dipahami</p>
                </div>

                <!-- Urutan -->
                <div>
                    <label for="urutan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Urutan Tampilan <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $nextUrutan) }}"
                        min="0" class="input-field {{ $errors->has('urutan') ? 'border-red-500' : '' }}" required>
                    @error('urutan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Angka lebih kecil akan ditampilkan lebih dahulu (default:
                        {{ $nextUrutan }})</p>
                </div>

                <!-- Published Status -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                            {{ old('is_published', true) ? 'checked' : '' }}
                            class="w-5 h-5 text-azhar-blue-500 border-gray-300 rounded focus:ring-azhar-blue-500">
                    </div>
                    <div class="ml-3">
                        <label for="is_published" class="font-semibold text-gray-700 cursor-pointer">
                            ✓ Publikasikan FAQ
                        </label>
                        <p class="text-sm text-gray-500">FAQ akan langsung ditampilkan di website</p>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-4 pt-6 border-t">
                    <button type="submit" class="btn-primary flex-1 md:flex-none md:px-8">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan FAQ
                    </button>

                    <a href="{{ route('admin.faqs.index') }}"
                        class="bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-600 transition-colors text-center font-semibold flex-1 md:flex-none">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Tips Card -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="font-bold text-blue-900 mb-2">💡 Tips Membuat FAQ</h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Gunakan pertanyaan yang spesifik dan mudah dipahami</li>
                        <li>• Jawaban harus lengkap, jelas, dan to the point</li>
                        <li>• Kelompokkan FAQ berdasarkan kategori yang relevan</li>
                        <li>• Urutkan FAQ dari yang paling sering ditanyakan</li>
                        <li>• Review dan update FAQ secara berkala</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function faqForm() {
            return {
                selectedKategori: '',
                newKategori: '',
                pertanyaan: '{{ old('pertanyaan', '') }}',

                updateCharCount() {
                    // Character count is handled by x-text in template
                }
            }
        }
    </script>
@endsection
