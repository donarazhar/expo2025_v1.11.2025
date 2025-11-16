@extends('admin.layouts.app')

@section('title', 'Tambah Foto Gallery')
@section('page-title', 'Tambah Foto Gallery')
@section('page-subtitle', 'Upload foto baru ke gallery')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('admin.galleries.index') }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Gallery
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Upload Foto Gallery</h3>
                <p class="text-gray-600">Tambahkan foto ke gallery event</p>
            </div>

            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6" id="gallery-form">
                @csrf

                <!-- Image Upload -->
                <div x-data="imageUploader()">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Upload Gambar <span class="text-red-500">*</span>
                    </label>

                    <div class="mt-2">
                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-azhar-blue-500 transition-colors cursor-pointer"
                            @click="$refs.fileInput.click()" @dragover.prevent="dragOver = true"
                            @dragleave.prevent="dragOver = false" @drop.prevent="handleDrop($event)"
                            :class="dragOver ? 'border-azhar-blue-500 bg-azhar-blue-50' : ''">

                            <input type="file" name="image" x-ref="fileInput" @change="previewImage($event)"
                                accept="image/jpeg,image/jpg,image/png,image/webp" class="hidden" required>

                            <div x-show="!imagePreview">
                                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p class="mt-4 text-sm text-gray-600">
                                    <span class="font-semibold text-azhar-blue-500">Click to upload</span> atau drag & drop
                                </p>
                                <p class="text-xs text-gray-500 mt-2">PNG, JPG, WEBP (Max 5MB)</p>
                            </div>

                            <div x-show="imagePreview" class="relative" x-cloak>
                                <img :src="imagePreview" class="max-h-64 mx-auto rounded-lg shadow-lg">
                                <button type="button" @click.stop="removeImage()"
                                    class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                                <p class="text-sm text-gray-600 mt-3" x-text="imageName"></p>
                                <p class="text-xs text-gray-500" x-text="imageSize"></p>
                            </div>
                        </div>
                    </div>

                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Judul -->
                <div>
                    <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Foto <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                        class="input-field {{ $errors->has('judul') ? 'border-red-500' : '' }}"
                        placeholder="Contoh: Opening Ceremony Expo 2025" required>
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Event -->
                <div>
                    <label for="event_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Event (Opsional)
                    </label>
                    <select id="event_id" name="event_id"
                        class="input-field {{ $errors->has('event_id') ? 'border-red-500' : '' }}">
                        <option value="">-- Pilih Event (Opsional) --</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->judul }} ({{ $event->formatted_date }})
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Hubungkan foto dengan event tertentu</p>
                </div>

                <!-- Kategori -->
                <div x-data="{ mode: 'select' }">
                    <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>

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
                        <select name="kategori" id="kategori-select"
                            class="input-field {{ $errors->has('kategori') ? 'border-red-500' : '' }}">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}" {{ old('kategori') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Input New -->
                    <div x-show="mode === 'new'" x-cloak>
                        <input type="text" name="kategori_new" id="kategori-new" value="{{ old('kategori') }}"
                            class="input-field {{ $errors->has('kategori') ? 'border-red-500' : '' }}"
                            placeholder="Contoh: Opening Ceremony, Workshop, Exhibition">
                    </div>

                    @error('kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi (Opsional)
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                        class="input-field {{ $errors->has('deskripsi') ? 'border-red-500' : '' }}"
                        placeholder="Deskripsi singkat tentang foto...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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

                <!-- Submit Buttons -->
                <div class="flex gap-4 pt-6 border-t">
                    <button type="submit" class="btn-primary flex-1 md:flex-none md:px-8">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Upload Foto
                    </button>

                    <a href="{{ route('admin.galleries.index') }}"
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
                    <h4 class="font-bold text-blue-900 mb-2">💡 Tips Upload Foto</h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Gunakan foto dengan resolusi tinggi untuk hasil terbaik</li>
                        <li>• Format yang didukung: JPEG, JPG, PNG, WebP</li>
                        <li>• Ukuran maksimal file: 5MB</li>
                        <li>• Berikan judul yang deskriptif untuk memudahkan pencarian</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Image Uploader Component
        function imageUploader() {
            return {
                imagePreview: null,
                imageName: '',
                imageSize: '',
                dragOver: false,

                previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.processFile(file);
                    }
                },

                handleDrop(event) {
                    this.dragOver = false;
                    const file = event.dataTransfer.files[0];
                    if (file && file.type.startsWith('image/')) {
                        this.$refs.fileInput.files = event.dataTransfer.files;
                        this.processFile(file);
                    }
                },

                processFile(file) {
                    // Validate file size (5MB = 5 * 1024 * 1024 bytes)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar! Maksimal 5MB.');
                        this.$refs.fileInput.value = '';
                        return;
                    }

                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        alert('Format file tidak didukung! Gunakan JPEG, JPG, PNG, atau WebP.');
                        this.$refs.fileInput.value = '';
                        return;
                    }

                    this.imageName = file.name;
                    this.imageSize = this.formatFileSize(file.size);

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },

                removeImage() {
                    this.imagePreview = null;
                    this.imageName = '';
                    this.imageSize = '';
                    this.$refs.fileInput.value = '';
                },

                formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
                }
            }
        }

        // Form Submit Handler - Handle kategori field properly
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('gallery-form');

            if (form) {
                form.addEventListener('submit', function(e) {
                    // Get kategori value from active mode
                    const kategoriSelect = document.getElementById('kategori-select');
                    const kategoriNew = document.getElementById('kategori-new');

                    // Create or update hidden kategori field
                    let kategoriField = document.querySelector('input[name="kategori"][type="hidden"]');
                    if (!kategoriField) {
                        kategoriField = document.createElement('input');
                        kategoriField.type = 'hidden';
                        kategoriField.name = 'kategori';
                        form.appendChild(kategoriField);
                    }

                    // Set value based on active mode
                    if (kategoriNew.value.trim()) {
                        kategoriField.value = kategoriNew.value.trim();
                        kategoriSelect.removeAttribute('required');
                    } else {
                        kategoriField.value = kategoriSelect.value;
                    }

                    // Validate kategori is not empty
                    if (!kategoriField.value) {
                        e.preventDefault();
                        alert('Kategori wajib diisi!');
                        return false;
                    }
                });
            }
        });
    </script>
@endsection
