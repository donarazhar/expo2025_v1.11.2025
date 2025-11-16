@extends('admin.layouts.app')

@section('title', 'Tambah Registrasi Event')
@section('page-title', 'Tambah Registrasi Event')
@section('page-subtitle', 'Daftarkan peserta ke event')

@section('content')
    <div class="max-w-4xl mx-auto">

        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('admin.eventregistrations.index') }}"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">
                                Registrasi Event
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tambah</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">

            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">Form Registrasi Event Baru</h3>
                <p class="text-sm text-blue-100 mt-1">Lengkapi form di bawah untuk mendaftarkan peserta ke event</p>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.eventregistrations.store') }}" method="POST" class="p-6">
                @csrf

                <div class="space-y-6">

                    <!-- Peserta Selection -->
                    <div>
                        <label for="id_peserta" class="block text-sm font-medium text-gray-700 mb-2">
                            Peserta <span class="text-red-500">*</span>
                        </label>
                        <select name="id_peserta" id="id_peserta"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('id_peserta') border-red-500 @enderror"
                            required>
                            <option value="">-- Pilih Peserta --</option>
                            @foreach ($pesertas as $peserta)
                                <option value="{{ $peserta->id_peserta }}"
                                    {{ old('id_peserta') == $peserta->id_peserta ? 'selected' : '' }}
                                    data-email="{{ $peserta->email }}" data-instansi="{{ $peserta->asal_instansi }}">
                                    {{ $peserta->nama_lengkap }} - {{ $peserta->email }} ({{ $peserta->id_peserta }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_peserta')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Pilih peserta yang akan didaftarkan ke event
                        </p>
                    </div>

                    <!-- Event Selection -->
                    <div>
                        <label for="event_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Event <span class="text-red-500">*</span>
                        </label>
                        <select name="event_id" id="event_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('event_id') border-red-500 @enderror"
                            required>
                            <option value="">-- Pilih Event --</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}
                                    data-kapasitas="{{ $event->kapasitas }}"
                                    data-registered="{{ $event->registered_count }}"
                                    data-available="{{ $event->available_slots }}"
                                    data-tanggal="{{ $event->formatted_date }}">
                                    {{ $event->judul }} - {{ $event->formatted_date }}
                                    @if ($event->kapasitas > 0)
                                        ({{ $event->registered_count }}/{{ $event->kapasitas }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('event_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Event Info Display -->
                        <div id="event-info" class="mt-3 hidden">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="text-sm text-blue-800">
                                        <p class="font-semibold">Informasi Event:</p>
                                        <p class="mt-1">Tanggal: <span id="event-tanggal" class="font-medium"></span></p>
                                        <p class="mt-1" id="kapasitas-info"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror"
                            required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status', 'confirmed') == 'confirmed' ? 'selected' : '' }}>
                                Confirmed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            Status registrasi peserta untuk event ini
                        </p>
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                            Keterangan (Opsional)
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('keterangan') border-red-500 @enderror"
                            placeholder="Tambahkan catatan atau keterangan tambahan...">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Maksimal 500 karakter</p>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 9.586 8.707 7.293z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.eventregistrations.index') }}"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Registrasi
                    </button>
                </div>

            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex">
                <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm text-blue-800">
                    <p class="font-semibold mb-2">Petunjuk:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Pastikan peserta belum terdaftar di event yang sama</li>
                        <li>Perhatikan kapasitas event sebelum melakukan registrasi</li>
                        <li>Status "Confirmed" akan mengurangi slot tersedia event</li>
                        <li>Status "Pending" masih dapat diubah menjadi "Confirmed" atau "Cancelled"</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            // Event Selection Info Display
            document.getElementById('event_id').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const eventInfo = document.getElementById('event-info');

                if (this.value) {
                    const kapasitas = selectedOption.dataset.kapasitas;
                    const registered = selectedOption.dataset.registered;
                    const available = selectedOption.dataset.available;
                    const tanggal = selectedOption.dataset.tanggal;

                    document.getElementById('event-tanggal').textContent = tanggal;

                    const kapasitasInfo = document.getElementById('kapasitas-info');
                    if (kapasitas > 0) {
                        kapasitasInfo.innerHTML =
                            `Kapasitas: <span class="font-medium">${registered}/${kapasitas}</span> terdaftar, <span class="font-medium ${available > 0 ? 'text-green-600' : 'text-red-600'}">${available} slot tersedia</span>`;

                        // Peringatan jika penuh
                        if (available <= 0) {
                            kapasitasInfo.innerHTML +=
                                '<br><span class="text-red-600 font-semibold">⚠️ Event sudah penuh!</span>';
                        } else if (available <= 5) {
                            kapasitasInfo.innerHTML +=
                                '<br><span class="text-orange-600 font-semibold">⚠️ Slot hampir penuh!</span>';
                        }
                    } else {
                        kapasitasInfo.innerHTML =
                        'Kapasitas: <span class="font-medium text-green-600">Unlimited</span>';
                    }

                    eventInfo.classList.remove('hidden');
                } else {
                    eventInfo.classList.add('hidden');
                }
            });

            // Trigger change event if there's old value
            @if (old('event_id'))
                document.getElementById('event_id').dispatchEvent(new Event('change'));
            @endif

            // Select2 Enhancement (Optional - if you have Select2)
            if (typeof $ !== 'undefined' && $.fn.select2) {
                $('#id_peserta').select2({
                    placeholder: '-- Pilih Peserta --',
                    allowClear: true,
                    width: '100%'
                });

                $('#event_id').select2({
                    placeholder: '-- Pilih Event --',
                    allowClear: true,
                    width: '100%'
                });
            }
        </script>
    @endpush

@endsection
