@extends('admin.layouts.app')

@section('title', 'Tambah Feedback Baru')
@section('page-title', 'Tambah Feedback')
@section('page-subtitle', 'Buat feedback/testimoni baru')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('admin.feedbacks.index') }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar Feedbacks
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Form Feedback Baru</h3>
                <p class="text-gray-600">Tambahkan feedback/testimoni dari peserta</p>
            </div>

            <form action="{{ route('admin.feedbacks.store') }}" method="POST" class="space-y-6" x-data="feedbackForm()">
                @csrf

                <!-- Event -->
                <div>
                    <label for="event_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Event <span class="text-red-500">*</span>
                    </label>
                    <select id="event_id" name="event_id"
                        class="input-field {{ $errors->has('event_id') ? 'border-red-500' : '' }}" required>
                        <option value="">-- Pilih Event --</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->judul }} ({{ $event->formatted_date }})
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Peserta -->
                <div>
                    <label for="id_peserta" class="block text-sm font-semibold text-gray-700 mb-2">
                        Peserta <span class="text-red-500">*</span>
                    </label>
                    <select id="id_peserta" name="id_peserta"
                        class="input-field {{ $errors->has('id_peserta') ? 'border-red-500' : '' }}" required>
                        <option value="">-- Pilih Peserta --</option>
                        @foreach ($pesertas as $peserta)
                            <option value="{{ $peserta->id_peserta }}"
                                {{ old('id_peserta') == $peserta->id_peserta ? 'selected' : '' }}>
                                {{ $peserta->id_peserta }} - {{ $peserta->nama_lengkap }} ({{ $peserta->asal_instansi }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_peserta')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Peserta yang memberikan feedback</p>
                </div>

                <!-- Rating -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Rating <span class="text-red-500">*</span>
                    </label>

                    <div class="flex items-center gap-2">
                        <div class="flex gap-1" x-data="{ hoverRating: 0 }">
                            <template x-for="star in 5" :key="star">
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" :value="star" x-model="rating"
                                        class="hidden" required>
                                    <svg class="w-10 h-10 transition-colors"
                                        :class="star <= (hoverRating || rating) ? 'text-yellow-400' : 'text-gray-300'"
                                        @mouseenter="hoverRating = star" @mouseleave="hoverRating = 0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                </label>
                            </template>
                        </div>
                        <span class="text-2xl font-bold text-gray-900"
                            x-text="rating ? rating + ' bintang' : 'Pilih rating'"></span>
                    </div>

                    @error('rating')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Komentar -->
                <div>
                    <label for="komentar" class="block text-sm font-semibold text-gray-700 mb-2">
                        Komentar/Testimoni <span class="text-red-500">*</span>
                    </label>
                    <textarea id="komentar" name="komentar" rows="6"
                        class="input-field {{ $errors->has('komentar') ? 'border-red-500' : '' }}"
                        placeholder="Tulis komentar atau testimoni peserta..." required x-model="komentar" @input="updateCharCount">{{ old('komentar') }}</textarea>
                    @error('komentar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">
                        <span x-text="komentar.length"></span> karakter (minimal 10 karakter)
                    </p>
                </div>

                <!-- Checkboxes -->
                <div class="space-y-4 border-t pt-6">
                    <!-- Published -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" id="is_published" name="is_published" value="1"
                                {{ old('is_published', true) ? 'checked' : '' }}
                                class="w-5 h-5 text-azhar-blue-500 border-gray-300 rounded focus:ring-azhar-blue-500">
                        </div>
                        <div class="ml-3">
                            <label for="is_published" class="font-semibold text-gray-700 cursor-pointer">
                                ✓ Publikasikan Feedback
                            </label>
                            <p class="text-sm text-gray-500">Feedback akan ditampilkan di website</p>
                        </div>
                    </div>

                    <!-- Featured -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1"
                                {{ old('is_featured') ? 'checked' : '' }}
                                class="w-5 h-5 text-yellow-500 border-gray-300 rounded focus:ring-yellow-500">
                        </div>
                        <div class="ml-3">
                            <label for="is_featured" class="font-semibold text-gray-700 cursor-pointer">
                                ⭐ Jadikan Featured
                            </label>
                            <p class="text-sm text-gray-500">Feedback akan ditampilkan di bagian highlight</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-4 pt-6 border-t">
                    <button type="submit" class="btn-primary flex-1 md:flex-none md:px-8">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Feedback
                    </button>

                    <a href="{{ route('admin.feedbacks.index') }}"
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
                    <h4 class="font-bold text-blue-900 mb-2">💡 Tips Mengelola Feedback</h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Pastikan feedback relevan dengan event yang dipilih</li>
                        <li>• Rating dan komentar harus mencerminkan pengalaman peserta</li>
                        <li>• Gunakan featured untuk highlight testimoni terbaik</li>
                        <li>• Moderasi feedback sebelum dipublikasikan</li>
                        <li>• Feedback positif dapat digunakan untuk promosi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function feedbackForm() {
            return {
                rating: {{ old('rating', 0) }},
                komentar: `{{ old('komentar', '') }}`,

                updateCharCount() {
                    // Character count handled by x-text
                }
            }
        }
    </script>
@endsection
