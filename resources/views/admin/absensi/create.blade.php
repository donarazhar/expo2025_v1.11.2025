@extends('admin.layouts.app')

@section('title', 'Catat Absensi')
@section('page-title', 'Catat Absensi')
@section('page-subtitle', 'Input manual absensi peserta')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('admin.absensi.index') }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar Absensi
            </a>
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
                    <h4 class="font-bold text-blue-900 mb-2">💡 Informasi</h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Halaman ini untuk input manual absensi oleh admin</li>
                        <li>• Untuk scanner QR Code, gunakan halaman: <a href="{{ route('scan.page') }}" target="_blank"
                                class="underline font-bold">Scanner Kiosk</a></li>
                        <li>• Peserta yang sudah absen hari ini tidak dapat dicatat ulang</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Manual Input Form -->
        <div class="bg-white rounded-xl shadow-md p-8" x-data="absensiForm()">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Form Input Absensi Manual</h3>

            <form action="{{ route('admin.absensi.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Mode Selector -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Metode Input:</label>
                    <div class="flex gap-4">
                        <button type="button" @click="inputMode = 'manual'; selectedPeserta = ''"
                            :class="inputMode === 'manual' ? 'bg-azhar-blue-500 text-white' :
                                'bg-white text-gray-700 border-2 border-gray-300'"
                            class="flex-1 py-3 px-4 rounded-lg font-semibold transition-all">
                            ⌨️ Input ID Manual
                        </button>
                        <button type="button"
                            @click="inputMode = 'select'; manualId = ''; pesertaFound = false; pesertaInfo = null"
                            :class="inputMode === 'select' ? 'bg-azhar-blue-500 text-white' :
                                'bg-white text-gray-700 border-2 border-gray-300'"
                            class="flex-1 py-3 px-4 rounded-lg font-semibold transition-all">
                            📋 Pilih dari Daftar
                        </button>
                    </div>
                </div>

                <!-- Input Manual Mode -->
                <div x-show="inputMode === 'manual'" x-cloak>
                    <label for="id_peserta_manual" class="block text-sm font-semibold text-gray-700 mb-2">
                        ID Peserta (4 Karakter) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" id="id_peserta_manual" x-model="manualId"
                            @input="searchPeserta($event.target.value)" maxlength="4" placeholder="Contoh: A7K2"
                            class="input-field text-2xl font-bold uppercase tracking-wider text-center {{ $errors->has('id_peserta') ? 'border-red-500' : '' }}"
                            :class="pesertaFound ? 'border-green-500 bg-green-50' : (manualId.length === 4 && !pesertaFound ?
                                'border-red-500 bg-red-50' : '')"
                            autocomplete="off">

                        <!-- Loading Indicator -->
                        <div x-show="searching" class="absolute right-4 top-1/2 transform -translate-y-1/2">
                            <svg class="animate-spin h-6 w-6 text-azhar-blue-500" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>

                        <!-- Check Icon -->
                        <div x-show="pesertaFound && !searching"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2">
                            <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>

                        <!-- Cross Icon -->
                        <div x-show="manualId.length === 4 && !pesertaFound && !searching"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2">
                            <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Peserta Info (if found) -->
                    <div x-show="pesertaFound && pesertaInfo" x-cloak
                        class="mt-4 p-4 bg-green-50 border-2 border-green-200 rounded-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <div class="flex-1">
                                <h4 class="font-bold text-green-900 text-lg mb-1" x-text="pesertaInfo.nama_lengkap"></h4>
                                <p class="text-sm text-green-800" x-text="pesertaInfo.asal_instansi"></p>
                                <p class="text-xs text-green-700 mt-1" x-text="pesertaInfo.email"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div x-show="manualId.length === 4 && !pesertaFound && !searching" x-cloak
                        class="mt-4 p-4 bg-red-50 border-2 border-red-200 rounded-lg">
                        <p class="text-red-700 font-semibold">❌ ID Peserta tidak ditemukan. Periksa kembali ID yang
                            dimasukkan.</p>
                    </div>

                    @error('id_peserta')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Select Dropdown Mode -->
                <div x-show="inputMode === 'select'" x-cloak>
                    <label for="id_peserta_select" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pilih Peserta <span class="text-red-500">*</span>
                    </label>
                    <select id="id_peserta_select" x-model="selectedPeserta"
                        class="input-field {{ $errors->has('id_peserta') ? 'border-red-500' : '' }}">
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
                    <p class="mt-1 text-xs text-gray-500">Pilih peserta yang akan dicatat absensinya</p>
                </div>

                <!-- Hidden input that will be submitted based on mode -->
                <input type="hidden" name="id_peserta" :value="inputMode === 'manual' ? manualId : selectedPeserta">

                <!-- Petugas Scanner -->
                <div>
                    <label for="petugas_scanner" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Petugas <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="petugas_scanner" name="petugas_scanner"
                        value="{{ old('petugas_scanner', Auth::guard('admin')->user()->name ?? 'Admin') }}"
                        class="input-field {{ $errors->has('petugas_scanner') ? 'border-red-500' : '' }}"
                        placeholder="Nama petugas yang mencatat..." required>
                    @error('petugas_scanner')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Waktu Scan (Optional) -->
                <div>
                    <label for="waktu_scan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Waktu Scan (Opsional)
                    </label>
                    <input type="datetime-local" id="waktu_scan" name="waktu_scan"
                        value="{{ old('waktu_scan', now()->format('Y-m-d\TH:i')) }}" class="input-field">
                    <p class="mt-1 text-xs text-gray-500">Kosongkan untuk menggunakan waktu sekarang</p>
                </div>

                <!-- Status Kehadiran -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Status Kehadiran
                    </label>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="status_kehadiran" value="1" checked
                                class="w-4 h-4 text-azhar-blue-500 border-gray-300 focus:ring-azhar-blue-500">
                            <span class="ml-2 text-sm text-gray-700 font-medium">✅ Hadir</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="status_kehadiran" value="0"
                                class="w-4 h-4 text-azhar-blue-500 border-gray-300 focus:ring-azhar-blue-500">
                            <span class="ml-2 text-sm text-gray-700 font-medium">❌ Tidak Hadir</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-4 pt-6 border-t">
                    <button type="submit" class="btn-primary flex-1"
                        :disabled="(inputMode === 'manual' && (!pesertaFound || manualId.length !== 4)) || (
                            inputMode === 'select' && !selectedPeserta)">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Absensi
                    </button>
                    <a href="{{ route('admin.absensi.index') }}"
                        class="bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-600 transition-colors text-center font-semibold">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Quick Link to Scanner -->
        <div class="bg-gradient-to-r from-azhar-blue-500 to-azhar-blue-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-lg font-bold mb-2">📱 Gunakan Scanner Kiosk</h4>
                    <p class="text-sm text-white/90">Lebih cepat dengan scan QR Code langsung dari tablet/kiosk</p>
                </div>
                <a href="{{ route('scan.page') }}" target="_blank"
                    class="bg-white text-azhar-blue-600 px-6 py-3 rounded-lg font-bold hover:bg-white/90 transition whitespace-nowrap">
                    Buka Scanner →
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function absensiForm() {
            return {
                inputMode: 'manual', // 'manual' or 'select'
                manualId: '',
                selectedPeserta: '',
                pesertaFound: false,
                pesertaInfo: null,
                searching: false,
                searchTimeout: null,

                searchPeserta(id) {
                    // Convert to uppercase
                    this.manualId = id.toUpperCase();

                    // Clear previous timeout
                    if (this.searchTimeout) {
                        clearTimeout(this.searchTimeout);
                    }

                    // Reset states
                    this.pesertaFound = false;
                    this.pesertaInfo = null;

                    // Only search if 4 characters
                    if (this.manualId.length !== 4) {
                        return;
                    }

                    // Set searching state
                    this.searching = true;

                    // Debounce search
                    this.searchTimeout = setTimeout(() => {
                        this.performSearch();
                    }, 300);
                },

                async performSearch() {
                    try {
                        const response = await fetch('{{ route('check-in.verify') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                id_peserta: this.manualId
                            })
                        });

                        const data = await response.json();
                        console.log('Search result:', data);

                        if (data.success && data.data) {
                            this.pesertaFound = true;
                            this.pesertaInfo = data.data;
                        } else {
                            this.pesertaFound = false;
                            this.pesertaInfo = null;
                        }
                    } catch (error) {
                        console.error('Search error:', error);
                        this.pesertaFound = false;
                        this.pesertaInfo = null;
                    } finally {
                        this.searching = false;
                    }
                }
            }
        }
    </script>
@endsection
