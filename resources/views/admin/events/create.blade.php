@extends('admin.layouts.app')

@section('title', 'Tambah Event Baru')
@section('page-title', 'Tambah Event')
@section('page-subtitle', 'Buat event baru untuk Al Azhar Expo 2025')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('admin.events.index') }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar Events
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Informasi Event</h3>
                <p class="text-gray-600">Lengkapi form di bawah untuk membuat event baru</p>
            </div>

            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8"
                x-data="eventForm()">
                @csrf

                <!-- Basic Information Section -->
                <div class="space-y-6">
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-bold text-gray-800">📋 Informasi Dasar</h4>
                    </div>

                    <!-- Judul Event -->
                    <div>
                        <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Event <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                            class="input-field {{ $errors->has('judul') ? 'border-red-500' : '' }}"
                            placeholder="Contoh: Workshop AI untuk Pendidikan" required autofocus>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select id="kategori" name="kategori"
                            class="input-field {{ $errors->has('kategori') ? 'border-red-500' : '' }}" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="workshop" {{ old('kategori') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="seminar" {{ old('kategori') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                            <option value="webinar" {{ old('kategori') == 'webinar' ? 'selected' : '' }}>Webinar</option>
                            <option value="talkshow" {{ old('kategori') == 'talkshow' ? 'selected' : '' }}>Talkshow</option>
                            <option value="kompetisi" {{ old('kategori') == 'kompetisi' ? 'selected' : '' }}>Kompetisi
                            </option>
                            <option value="pameran" {{ old('kategori') == 'pameran' ? 'selected' : '' }}>Pameran</option>
                            <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi Event <span class="text-red-500">*</span>
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="6"
                            class="input-field {{ $errors->has('deskripsi') ? 'border-red-500' : '' }}"
                            placeholder="Jelaskan detail tentang event ini..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Minimal 50 karakter, maksimal 1000 karakter</p>
                    </div>
                </div>

                <!-- Date & Location Section -->
                <div class="space-y-6">
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-bold text-gray-800">📅 Waktu & Lokasi</h4>
                    </div>

                    <!-- Tanggal & Waktu -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tanggal_mulai" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal & Waktu Mulai <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" id="tanggal_mulai" name="tanggal_mulai"
                                value="{{ old('tanggal_mulai') }}"
                                class="input-field {{ $errors->has('tanggal_mulai') ? 'border-red-500' : '' }}" required>
                            @error('tanggal_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_selesai" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal & Waktu Selesai <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" id="tanggal_selesai" name="tanggal_selesai"
                                value="{{ old('tanggal_selesai') }}"
                                class="input-field {{ $errors->has('tanggal_selesai') ? 'border-red-500' : '' }}" required>
                            @error('tanggal_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Lokasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                            class="input-field {{ $errors->has('lokasi') ? 'border-red-500' : '' }}"
                            placeholder="Contoh: Aula Utama Al Azhar, Zoom Meeting, Lapangan Sekolah" required>
                        @error('lokasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Capacity & Status Section -->
                <div class="space-y-6">
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-bold text-gray-800">⚙️ Pengaturan Event</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kapasitas -->
                        <div>
                            <label for="kapasitas" class="block text-sm font-semibold text-gray-700 mb-2">
                                Kapasitas Peserta <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', 0) }}"
                                min="0"
                                class="input-field {{ $errors->has('kapasitas') ? 'border-red-500' : '' }}"
                                placeholder="0 untuk unlimited" required>
                            @error('kapasitas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Masukkan 0 untuk kapasitas unlimited</p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" name="status"
                                class="input-field {{ $errors->has('status') ? 'border-red-500' : '' }}" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Belum
                                    Dipublikasikan)</option>
                                <option value="published"
                                    {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Published (Aktif)
                                </option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                    (Dibatalkan)</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Featured Event -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1"
                                {{ old('is_featured') ? 'checked' : '' }}
                                class="w-5 h-5 text-azhar-blue-500 border-gray-300 rounded focus:ring-azhar-blue-500">
                        </div>
                        <div class="ml-3">
                            <label for="is_featured" class="font-semibold text-gray-700 cursor-pointer">
                                ⭐ Jadikan Featured Event
                            </label>
                            <p class="text-sm text-gray-500">Event ini akan ditampilkan di halaman utama</p>
                        </div>
                    </div>
                </div>

                <!-- Banner Image Section -->
                <div class="space-y-6">
                    <div class="border-b pb-4">
                        <h4 class="text-lg font-bold text-gray-800">🖼️ Banner Event</h4>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Upload Banner (Opsional)
                        </label>

                        <!-- Image Preview -->
                        <div class="mb-4" x-show="imagePreview" x-cloak>
                            <img :src="imagePreview"
                                class="w-full max-w-md h-48 object-cover rounded-lg border-2 border-gray-200">
                            <button type="button" @click="removeImage"
                                class="mt-2 text-sm text-red-600 hover:text-red-800 font-semibold">
                                ✕ Hapus Gambar
                            </button>
                        </div>

                        <!-- Upload Area -->
                        <div class="flex items-center justify-center w-full">
                            <label for="banner_image"
                                class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk
                                            upload</span> atau drag & drop</p>
                                    <p class="text-xs text-gray-500">PNG, JPG atau JPEG (MAX. 2MB)</p>
                                </div>
                                <input id="banner_image" name="banner_image" type="file" class="hidden"
                                    accept="image/png,image/jpeg,image/jpg" @change="previewImage($event)">
                            </label>
                        </div>
                        @error('banner_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-4 pt-6 border-t">
                    <button type="submit" class="btn-primary flex-1 md:flex-none md:px-8">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Event
                    </button>

                    <a href="{{ route('admin.events.index') }}"
                        class="bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-600 transition-colors text-center font-semibold flex-1 md:flex-none">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="font-bold text-blue-900 mb-2">💡 Tips Membuat Event</h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Gunakan judul yang menarik dan deskriptif</li>
                        <li>• Pastikan tanggal dan waktu sudah benar</li>
                        <li>• Upload banner dengan resolusi minimal 1200x600px untuk hasil terbaik</li>
                        <li>• Set status "Draft" jika event belum siap dipublikasikan</li>
                        <li>• Kapasitas 0 = unlimited peserta</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function eventForm() {
            return {
                imagePreview: null,

                previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        // Check file size (2MB = 2097152 bytes)
                        if (file.size > 2097152) {
                            alert('Ukuran file terlalu besar! Maksimal 2MB');
                            event.target.value = '';
                            return;
                        }

                        // Check file type
                        if (!['image/jpeg', 'image/jpg', 'image/png'].includes(file.type)) {
                            alert('Format file tidak didukung! Gunakan JPG, JPEG, atau PNG');
                            event.target.value = '';
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imagePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                removeImage() {
                    this.imagePreview = null;
                    document.getElementById('banner_image').value = '';
                }
            }
        }
    </script>
@endsection

