@extends('admin.layouts.app')

@section('title', 'Edit Hadiah')
@section('page-title', 'Edit Hadiah')
@section('page-subtitle', 'Perbarui informasi hadiah')

@section('content')
    <div class="space-y-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('admin.prizes.index') }}"
                class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar Hadiah
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Form Edit Hadiah</h3>
                <p class="text-sm text-gray-600 mt-1">Perbarui informasi hadiah</p>
            </div>

            <form action="{{ route('admin.prizes.update', $prize) }}" method="POST" enctype="multipart/form-data"
                class="p-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">

                    <!-- Event Selection -->
                    <div>
                        <label for="event_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Event <span class="text-gray-400">(Opsional)</span>
                        </label>
                        <select name="event_id" id="event_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('event_id') border-red-500 @enderror">
                            <option value="">Pilih Event (Kosongkan jika umum)</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}"
                                    {{ old('event_id', $prize->event_id) == $event->id ? 'selected' : '' }}>
                                    {{ $event->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('event_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Hadiah -->
                    <div>
                        <label for="nama_hadiah" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Hadiah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_hadiah" id="nama_hadiah"
                            value="{{ old('nama_hadiah', $prize->nama_hadiah) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_hadiah') border-red-500 @enderror"
                            placeholder="Contoh: Smartphone Samsung Galaxy A54" required>
                        @error('nama_hadiah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi <span class="text-gray-400">(Opsional)</span>
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('deskripsi') border-red-500 @enderror"
                            placeholder="Deskripsi detail tentang hadiah...">{{ old('deskripsi', $prize->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar Upload -->
                    <div x-data="imagePreview('{{ $prize->gambar ? Storage::url($prize->gambar) : '' }}')">
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Hadiah <span class="text-gray-400">(Opsional)</span>
                        </label>
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50">
                                    <img x-show="imageUrl" :src="imageUrl" class="w-full h-full object-cover">
                                    <div x-show="!imageUrl" class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-1">
                                <input type="file" name="gambar" id="gambar" accept="image/*" @change="updatePreview"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('gambar') border-red-500 @enderror">
                                <p class="mt-2 text-xs text-gray-500">Format: JPEG, JPG, PNG, WEBP (Maks. 2MB)</p>
                                @if ($prize->gambar)
                                    <p class="mt-2 text-xs text-blue-600">Gambar saat ini akan diganti jika Anda upload
                                        gambar baru</p>
                                @endif
                                @error('gambar')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Jumlah -->
                        <div>
                            <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah Stok <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $prize->jumlah) }}"
                                min="1"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jumlah') border-red-500 @enderror"
                                required>
                            @error('jumlah')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Sisa saat ini: {{ $prize->sisa }}</p>
                        </div>

                        <!-- Urutan -->
                        <div>
                            <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                                Urutan Tampil <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $prize->urutan) }}"
                                min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('urutan') border-red-500 @enderror"
                                required>
                            @error('urutan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="kategori" id="kategori"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kategori') border-red-500 @enderror"
                                required>
                                <option value="">Pilih Kategori</option>
                                <option value="utama"
                                    {{ old('kategori', $prize->kategori) == 'utama' ? 'selected' : '' }}>
                                    Utama</option>
                                <option value="doorprize"
                                    {{ old('kategori', $prize->kategori) == 'doorprize' ? 'selected' : '' }}>Doorprize
                                </option>
                                <option value="hiburan"
                                    {{ old('kategori', $prize->kategori) == 'hiburan' ? 'selected' : '' }}>Hiburan</option>
                            </select>
                            @error('kategori')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Info Box -->
                    @if ($prize->winners()->count() > 0)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-400 mr-3 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-yellow-800">Perhatian</h4>
                                    <p class="text-sm text-yellow-700 mt-1">Hadiah ini sudah memiliki
                                        {{ $prize->winners()->count() }} pemenang. Hati-hati saat mengubah jumlah stok.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.prizes.index') }}"
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-[#0053C5] text-white rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Update Hadiah
                        </button>
                    </div>

                </div>
            </form>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        function imagePreview(existingImage = null) {
            return {
                imageUrl: existingImage,
                updatePreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.imageUrl = URL.createObjectURL(file);
                    }
                }
            }
        }
    </script>
@endpush
