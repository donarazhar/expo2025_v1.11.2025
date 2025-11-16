@extends('admin.layouts.app')

@section('title', 'Edit Registrasi Event')
@section('page-title', 'Edit Registrasi Event')
@section('page-subtitle', 'Ubah data registrasi peserta event')

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
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('admin.eventregistrations.show', $registration) }}"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">
                                Detail
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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Current Registration Info -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-blue-800">Registrasi Saat Ini:</p>
                    <p class="text-sm text-blue-700 mt-1">
                        <span class="font-medium">{{ $registration->peserta->nama_lengkap ?? 'N/A' }}</span>
                        terdaftar di event
                        <span class="font-medium">{{ $registration->event->judul ?? 'N/A' }}</span>
                    </p>
                    <p class="text-xs text-blue-600 mt-1">
                        Status: <span class="font-semibold">{{ ucfirst($registration->status) }}</span> |
                        ID Registrasi: #{{ $registration->id }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">

            <!-- Card Header -->
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-4">
                <h3 class="text-lg font-semibold text-white">Form Edit Registrasi Event</h3>
                <p class="text-sm text-yellow-100 mt-1">Ubah status atau keterangan registrasi peserta</p>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.eventregistrations.update', $registration) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">

                    <!-- Peserta Info (Read Only) -->
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Informasi Peserta
                        </label>
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 font-bold text-lg mr-4">
                                {{ substr($registration->peserta->nama_lengkap ?? 'N', 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <p class="text-base font-semibold text-gray-900">
                                    {{ $registration->peserta->nama_lengkap ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600">{{ $registration->peserta->email ?? '-' }}</p>
                                <p class="text-xs text-gray-500">ID: {{ $registration->id_peserta }}</p>
                            </div>
                            <a href="{{ route('admin.peserta.show', $registration->peserta->id_peserta) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium" target="_blank">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>

                    <!-- Event Info (Read Only) -->
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Informasi Event
                        </label>
                        <div class="space-y-2">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="text-base font-semibold text-gray-900">
                                        {{ $registration->event->judul ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600">{{ optional($registration->event)->formatted_date }}
                                    </p>
                                </div>
                            </div>
                            @if ($registration->event)
                                <div class="flex items-center text-sm text-gray-600 mt-2">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                    </svg>
                                    {{ $registration->event->lokasi ?? '-' }}
                                </div>
                                <div class="flex items-center text-sm">
                                    <span class="text-gray-600 mr-2">Kapasitas:</span>
                                    @if ($registration->event->kapasitas > 0)
                                        <span
                                            class="font-medium text-gray-900">{{ $registration->event->registered_count }}/{{ $registration->event->kapasitas }}</span>
                                        <span
                                            class="ml-2 text-xs {{ $registration->event->available_slots > 0 ? 'text-green-600' : 'text-red-600' }}">
                                            ({{ $registration->event->available_slots }} slot tersedia)
                                        </span>
                                    @else
                                        <span class="text-green-600 font-medium">Unlimited</span>
                                    @endif
                                </div>
                            @endif
                            <a href="{{ route('admin.events.show', $registration->event_id) }}"
                                class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium mt-2"
                                target="_blank">
                                Lihat Detail Event
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="text-base font-semibold text-gray-900 mb-4">Edit Registrasi</h4>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('status') border-red-500 @enderror"
                            required>
                            <option value="pending"
                                {{ old('status', $registration->status) == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="confirmed"
                                {{ old('status', $registration->status) == 'confirmed' ? 'selected' : '' }}>
                                Confirmed
                            </option>
                            <option value="cancelled"
                                {{ old('status', $registration->status) == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Status Change Warning -->
                        <div id="status-warning" class="mt-3 hidden">
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-500 mr-2 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="text-sm text-yellow-800">
                                        <p class="font-semibold">Perhatian:</p>
                                        <p id="status-warning-text" class="mt-1"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                            Keterangan (Opsional)
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="5"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('keterangan') border-red-500 @enderror"
                            placeholder="Tambahkan catatan atau keterangan tambahan...">{{ old('keterangan', $registration->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            <span id="char-count">{{ strlen(old('keterangan', $registration->keterangan)) }}</span>/500
                            karakter
                        </p>
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

                    <!-- Registration History -->
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <h5 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Riwayat
                        </h5>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm">
                            <div>
                                <p class="text-xs text-gray-500">Dibuat</p>
                                <p class="font-medium text-gray-900">{{ $registration->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Terakhir Diupdate</p>
                                <p class="font-medium text-gray-900">{{ $registration->updated_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status Saat Ini</p>
                                <p
                                    class="font-medium {{ $registration->status == 'confirmed' ? 'text-green-600' : ($registration->status == 'cancelled' ? 'text-red-600' : 'text-yellow-600') }}">
                                    {{ ucfirst($registration->status) }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.eventregistrations.show', $registration) }}"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Batal
                        </a>
                        <a href="{{ route('admin.eventregistrations.index') }}"
                            class="px-6 py-2 text-gray-600 hover:text-gray-800 transition-colors inline-flex items-center">
                            Kembali ke List
                        </a>
                    </div>
                    <button type="submit"
                        class="px-6 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Update Registrasi
                    </button>
                </div>

            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex">
                <svg class="w-5 h-5 text-yellow-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm text-yellow-800">
                    <p class="font-semibold mb-2">Catatan Penting:</p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Perubahan status dari "Pending" ke "Confirmed" akan mengurangi slot tersedia event</li>
                        <li>Status "Cancelled" tidak akan menambah atau mengurangi kapasitas event</li>
                        <li>Pastikan untuk mengecek kapasitas event sebelum mengubah status</li>
                        <li>Data peserta dan event tidak dapat diubah, hanya status dan keterangan</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            // Character counter for keterangan
            const keteranganInput = document.getElementById('keterangan');
            const charCount = document.getElementById('char-count');

            keteranganInput.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = length;

                if (length > 500) {
                    charCount.classList.add('text-red-600', 'font-bold');
                } else {
                    charCount.classList.remove('text-red-600', 'font-bold');
                }
            });

            // Status change warning
            const statusSelect = document.getElementById('status');
            const statusWarning = document.getElementById('status-warning');
            const statusWarningText = document.getElementById('status-warning-text');
            const originalStatus = '{{ $registration->status }}';
            const eventCapacity = {{ $registration->event->kapasitas ?? 0 }};
            const availableSlots = {{ $registration->event->available_slots ?? 999 }};

            statusSelect.addEventListener('change', function() {
                const newStatus = this.value;

                if (newStatus !== originalStatus) {
                    statusWarning.classList.remove('hidden');

                    let warningMessage = '';

                    if (originalStatus === 'pending' && newStatus === 'confirmed') {
                        if (eventCapacity > 0 && availableSlots <= 0) {
                            warningMessage = 'Event sudah penuh! Tidak dapat mengubah status ke Confirmed.';
                            statusWarningText.parentElement.parentElement.classList.remove('bg-yellow-50',
                                'border-yellow-200');
                            statusWarningText.parentElement.parentElement.classList.add('bg-red-50', 'border-red-200');
                            statusWarningText.parentElement.querySelector('svg').classList.remove('text-yellow-500');
                            statusWarningText.parentElement.querySelector('svg').classList.add('text-red-500');
                            statusWarningText.parentElement.querySelector('p').classList.remove('text-yellow-800');
                            statusWarningText.parentElement.querySelector('p').classList.add('text-red-800');
                        } else {
                            warningMessage =
                                'Status akan diubah ke Confirmed. Ini akan mengurangi 1 slot tersedia event.';
                        }
                    } else if (originalStatus === 'confirmed' && newStatus === 'pending') {
                        warningMessage = 'Status akan diubah ke Pending. Ini akan menambah 1 slot tersedia event.';
                    } else if (originalStatus === 'confirmed' && newStatus === 'cancelled') {
                        warningMessage = 'Status akan diubah ke Cancelled. Ini akan menambah 1 slot tersedia event.';
                    } else if (newStatus === 'cancelled') {
                        warningMessage = 'Registrasi akan dibatalkan. Pastikan ini sudah benar.';
                    } else {
                        warningMessage = 'Status registrasi akan diubah dari ' + originalStatus.toUpperCase() + ' ke ' +
                            newStatus.toUpperCase();
                    }

                    statusWarningText.textContent = warningMessage;
                } else {
                    statusWarning.classList.add('hidden');
                }
            });

            // Trigger change event if there's old value different from original
            @if (old('status') && old('status') != $registration->status)
                statusSelect.dispatchEvent(new Event('change'));
            @endif
        </script>
    @endpush

@endsection
