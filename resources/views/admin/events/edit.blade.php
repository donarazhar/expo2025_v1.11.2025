@extends('admin.layouts.app')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')
@section('page-subtitle', 'Update informasi event')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Back Button -->
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.events.show', $event) }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Detail Event
            </a>

            <div class="flex gap-2">
                <a href="{{ route('admin.events.index') }}" class="text-gray-600 hover:text-gray-800 text-sm font-semibold">
                    Daftar Events →
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="mb-8 flex items-start justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Edit Event: {{ $event->judul }}</h3>
                    <p class="text-gray-600">Update informasi event yang sudah ada</p>
                </div>
                @if ($event->status == 'published')
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800">
                        ✓ Published
                    </span>
                @elseif($event->status == 'draft')
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gray-100 text-gray-800">
                        📝 Draft
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800">
                        ✕ Cancelled
                    </span>
                @endif
            </div>

            <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data"
                class="space-y-8" x-data="eventForm()">
                @csrf
                @method('PUT')

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
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $event->judul) }}"
                            class="input-field {{ $errors->has('judul') ? 'border-red-500' : '' }}"
                            placeholder="Contoh: Workshop AI untuk Pendidikan" required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Current slug: <span
                                class="font-mono text-azhar-blue-600">{{ $event->slug }}</span></p>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select id="kategori" name="kategori"
                            class="input-field {{ $errors->has('kategori') ? 'border-red-500' : '' }}" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="workshop"
                                {{ old('kategori', $event->kategori) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="seminar" {{ old('kategori', $event->kategori) == 'seminar' ? 'selected' : '' }}>
                                Seminar</option>
                            <option value="webinar" {{ old('kategori', $event->kategori) == 'webinar' ? 'selected' : '' }}>
                                Webinar</option>
                            <option value="talkshow"
                                {{ old('kategori', $event->kategori) == 'talkshow' ? 'selected' : '' }}>Talkshow</option>
                            <option value="kompetisi"
                                {{ old('kategori', $event->kategori) == 'kompetisi' ? 'selected' : '' }}>Kompetisi</option>
                            <option value="pameran" {{ old('kategori', $event->kategori) == 'pameran' ? 'selected' : '' }}>
                                Pameran</option>
                            <option value="lainnya" {{ old('kategori', $event->kategori) == 'lainnya' ? 'selected' : '' }}>
                                Lainnya</option>
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
                            placeholder="Jelaskan detail tentang event ini..." required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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
                                value="{{ old('tanggal_mulai', $event->tanggal_mulai->format('Y-m-d\TH:i')) }}"
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
                                value="{{ old('tanggal_selesai', $event->tanggal_selesai->format('Y-m-d\TH:i')) }}"
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
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $event->lokasi) }}"
                            class="input-field {{ $errors->has('lokasi') ? 'border-red-500' : '' }}"
                            placeholder="Contoh: Aula Utama Al Azhar, Zoom Meeting" required>
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
                            <input type="number" id="kapasitas" name="kapasitas"
                                value="{{ old('kapasitas', $event->kapasitas) }}" min="0"
                                class="input-field {{ $errors->has('kapasitas') ? 'border-red-500' : '' }}" required>
                            @error('kapasitas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">
                                Terdaftar saat ini: <span
                                    class="font-bold text-azhar-blue-600">{{ $event->registered_count }}</span> peserta
                            </p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" name="status"
                                class="input-field {{ $errors->has('status') ? 'border-red-500' : '' }}" required>
                                <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>
                                    Draft</option>
                                <option value="published"
                                    {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="cancelled"
                                    {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                                {{ old('is_featured', $event->is_featured) ? 'checked' : '' }}
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

                    <!-- Current Banner -->
                    @if ($event->banner_image)
                        <div class="mb-4">
                            <p class="text-sm font-semibold text-gray-700 mb-2">Banner Saat Ini:</p>
                            <div class="relative inline-block">
                                <img src="{{ Storage::url($event->banner_image) }}" alt="{{ $event->judul }}"
                                    class="w-full max-w-md h-48 object-cover rounded-lg border-2 border-gray-200">
                                <div
                                    class="absolute top-2 right-2 bg-white rounded-lg px-3 py-1 text-xs font-bold text-gray-700 shadow-lg">
                                    Current
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Upload gambar baru untuk mengganti banner</p>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Upload Banner Baru (Opsional)
                        </label>

                        <!-- New Image Preview -->
                        <div class="mb-4" x-show="imagePreview" x-cloak>
                            <p class="text-sm font-semibold text-green-700 mb-2">Preview Banner Baru:</p>
                            <img :src="imagePreview"
                                class="w-full max-w-md h-48 object-cover rounded-lg border-2 border-green-500">
                            <button type="button" @click="removeImage"
                                class="mt-2 text-sm text-red-600 hover:text-red-800 font-semibold">
                                ✕ Batal Upload
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
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload
                                            banner baru</span></p>
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
                        Update Event
                    </button>

                    <a href="{{ route('admin.events.show', $event) }}"
                        class="bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-600 transition-colors text-center font-semibold flex-1 md:flex-none">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Warning Card -->
        @if ($event->registrations()->count() > 0)
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-lg">
                <div class="flex items-start gap-4">
                    <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    <div>
                        <h4 class="font-bold text-yellow-900 mb-2">⚠️ Perhatian</h4>
                        <p class="text-sm text-yellow-800">
                            Event ini sudah memiliki <strong>{{ $event->registrations()->count() }} pendaftar</strong>.
                            Perubahan pada tanggal, waktu, atau lokasi dapat mempengaruhi peserta yang sudah terdaftar.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function eventForm() {
            return {
                imagePreview: null,

                previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        // Check file size (2MB)
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
