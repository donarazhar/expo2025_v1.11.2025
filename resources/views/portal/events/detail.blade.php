<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $event->judul }} - Al Azhar Expo 2025</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .gradient-text {
            background: linear-gradient(135deg, #0053C5 0%, #003D91 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center">
                        <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo" class="h-10 w-auto">
                    </div>
                    <div>
                        <h1 class="text-lg font-black">AL AZHAR EXPO</h1>
                        <p class="text-xs opacity-90">2025</p>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('portal.events') }}"
                        class="text-white font-bold border-b-2 border-white">Events</a>
                    <a href="{{ route('portal.live') }}" class="hover:text-white/80 font-semibold transition">Live</a>
                    <a href="{{ route('portal.gallery') }}"
                        class="hover:text-white/80 font-semibold transition">Gallery</a>
                    <a href="{{ route('portal.faq') }}" class="hover:text-white/80 font-semibold transition">FAQ</a>
                    <a href="{{ route('portal.feedback') }}"
                        class="hover:text-white/80 font-semibold transition">Feedback</a>
                </div>

                <a href="{{ route('home') }}"
                    class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg font-semibold transition">
                    ← Kembali
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Banner -->
    <section class="relative h-96 bg-gradient-to-br from-[#0053C5] to-[#003D91]">
        @if ($event->banner_image)
            <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->judul }}"
                class="w-full h-full object-cover opacity-30">
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center gap-3 mb-4">
                    <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-bold">
                        {{ $event->kategori }}
                    </span>
                    @if ($event->is_featured)
                        <span class="bg-yellow-500 text-white px-4 py-2 rounded-full text-sm font-bold">
                            ⭐ Featured
                        </span>
                    @endif
                    @if ($event->is_full)
                        <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-bold">
                            🔴 Penuh
                        </span>
                    @endif
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-4">{{ $event->judul }}</h1>
                <div class="flex flex-wrap gap-6 text-white/90">
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="font-semibold">{{ $event->formatted_date }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">{{ $event->formatted_time }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                        </svg>
                        <span>{{ $event->lokasi }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left Column - Event Info -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Description -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-3xl font-black text-gray-900 mb-6">Tentang Event</h2>
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($event->deskripsi)) !!}
                        </div>
                    </div>

                    <!-- Schedules -->
                    @if ($event->schedules->count() > 0)
                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <h2 class="text-3xl font-black text-gray-900 mb-6">📅 Jadwal Kegiatan</h2>
                            <div class="space-y-4">
                                @foreach ($event->schedules as $schedule)
                                    <div
                                        class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition">
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2">
                                            <h3 class="text-xl font-bold text-gray-900">{{ $schedule->judul }}</h3>
                                            <span class="text-[#0053C5] font-semibold text-sm md:text-base">
                                                {{ $schedule->waktu_mulai->format('H:i') }} -
                                                {{ $schedule->waktu_selesai ? $schedule->waktu_selesai->format('H:i') : '' }}
                                            </span>
                                        </div>
                                        @if ($schedule->pembicara)
                                            <p class="text-sm text-gray-600 mb-2">
                                                <span class="font-semibold">Pembicara:</span>
                                                {{ $schedule->pembicara }}
                                            </p>
                                        @endif
                                        @if ($schedule->deskripsi)
                                            <p class="text-gray-600">{{ $schedule->deskripsi }}</p>
                                        @endif
                                        @if ($schedule->lokasi_detail)
                                            <p class="text-sm text-gray-500 mt-2">
                                                📍 {{ $schedule->lokasi_detail }}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Feedbacks/Reviews -->
                    @if ($event->feedbacks->count() > 0)
                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-3xl font-black text-gray-900">⭐ Review & Testimoni</h2>
                                <div class="text-center">
                                    <div class="text-3xl font-black text-[#0053C5]">
                                        {{ number_format($event->average_rating, 1) }}</div>
                                    <div class="text-sm text-gray-600">dari 5.0</div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                @foreach ($event->feedbacks as $feedback)
                                    <div class="border-b border-gray-100 pb-6 last:border-0 last:pb-0">
                                        <div class="flex items-start gap-4">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br from-[#0053C5] to-[#003D91] rounded-full flex items-center justify-center text-white font-bold text-lg">
                                                {{ substr($feedback->peserta->nama_lengkap, 0, 1) }}
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-2">
                                                    <h4 class="font-bold text-gray-900">
                                                        {{ $feedback->peserta->nama_lengkap }}</h4>
                                                    <div class="flex items-center gap-1">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <svg class="w-5 h-5 {{ $i <= $feedback->rating ? 'text-yellow-500' : 'text-gray-300' }}"
                                                                fill="currentColor" viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                </path>
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <p class="text-gray-600 text-sm mb-1">
                                                    {{ $feedback->peserta->asal_instansi }}</p>
                                                <p class="text-gray-700">{{ $feedback->komentar }}</p>
                                                <p class="text-xs text-gray-400 mt-2">
                                                    {{ $feedback->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Right Column - Registration Card -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <div class="bg-white rounded-2xl shadow-xl p-8 border-2 border-[#0053C5]/20"
                            x-data="eventRegistration()">

                            <!-- Capacity Info -->
                            @if ($event->kapasitas > 0)
                                <div class="mb-6">
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600 font-semibold">Kapasitas Peserta</span>
                                        <span class="font-bold text-[#0053C5]">
                                            {{ $event->registered_count }}/{{ $event->kapasitas }}
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-[#0053C5] to-[#003D91] h-3 rounded-full transition-all"
                                            style="width: {{ min(($event->registered_count / $event->kapasitas) * 100, 100) }}%">
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">
                                        {{ $event->available_slots }} tempat tersisa
                                    </p>
                                </div>
                            @endif

                            <!-- Stats -->
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="text-center p-4 bg-gray-50 rounded-xl">
                                    <div class="text-2xl font-black text-[#0053C5]">{{ $event->registered_count }}
                                    </div>
                                    <div class="text-xs text-gray-600">Terdaftar</div>
                                </div>
                                <div class="text-center p-4 bg-gray-50 rounded-xl">
                                    <div class="text-2xl font-black text-green-600">
                                        {{ number_format($event->average_rating, 1) }}</div>
                                    <div class="text-xs text-gray-600">Rating</div>
                                </div>
                            </div>

                            <!-- Registration Status -->
                            @if ($event->is_upcoming && !$event->is_full)
                                <!-- Registration Form -->
                                <form x-on:submit.prevent="submitRegistration" class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-900 mb-2">ID Peserta *</label>
                                        <input type="text" x-model="idPeserta" maxlength="4"
                                            placeholder="Contoh: A7K2"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-[#0053C5]/20 focus:border-[#0053C5] transition font-semibold uppercase"
                                            x-bind:class="{ 'border-red-500': errorMessage, 'border-green-500': successMessage }"
                                            required>
                                        <p class="text-xs text-gray-500 mt-1">Masukkan ID peserta Anda (4 karakter)</p>
                                    </div>

                                    <!-- Error Message -->
                                    <div x-show="errorMessage" x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform scale-95"
                                        x-transition:enter-end="opacity-100 transform scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 transform scale-100"
                                        x-transition:leave-end="opacity-0 transform scale-95"
                                        class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4" x-cloak>
                                        <div class="flex items-start">
                                            <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div class="flex-1">
                                                <h3 class="text-sm font-bold text-red-800 mb-1">Pendaftaran Gagal</h3>
                                                <p class="text-sm text-red-700" x-text="errorMessage"></p>
                                            </div>
                                            <button type="button" x-on:click="errorMessage = ''"
                                                class="text-red-500 hover:text-red-700 ml-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Success Message -->
                                    <div x-show="successMessage" x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform scale-95"
                                        x-transition:enter-end="opacity-100 transform scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 transform scale-100"
                                        x-transition:leave-end="opacity-0 transform scale-95"
                                        class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4" x-cloak>
                                        <div class="flex items-start">
                                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div class="flex-1">
                                                <h3 class="text-sm font-bold text-green-800 mb-1">Pendaftaran Berhasil!
                                                    🎉</h3>
                                                <p class="text-sm text-green-700" x-text="successMessage"></p>
                                                <p class="text-xs text-green-600 mt-2">Halaman akan dimuat ulang...</p>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" x-bind:disabled="loading"
                                        class="w-full bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white px-6 py-4 rounded-xl font-bold hover:shadow-xl transition transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex items-center justify-center">
                                        <span x-show="!loading" class="flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Daftar Event Ini
                                        </span>
                                        <span x-show="loading" class="flex items-center">
                                            <svg class="animate-spin w-5 h-5 mr-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                </path>
                                            </svg>
                                            Memproses...
                                        </span>
                                    </button>
                                </form>
                                <div class="mt-6">
                                    <div class="mt-6 space-y-3">
                                        <!-- Belum Punya ID Card -->
                                        <div
                                            class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4 hover:shadow-md transition-shadow">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-blue-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-sm font-semibold text-gray-900 mb-1">Belum punya ID
                                                        Peserta?</p>
                                                    <p class="text-xs text-gray-600 mb-2">Daftar terlebih dahulu untuk
                                                        mendapatkan ID Peserta</p>
                                                    <a href="{{ route('home') }}#registrasi"
                                                        class="inline-flex items-center gap-1 text-sm font-bold text-[#0053C5] hover:text-[#003D99] transition-colors">
                                                        Daftar Sekarang
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Lupa ID Card -->
                                        <div
                                            class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl p-4 hover:shadow-md transition-shadow">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-amber-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-sm font-semibold text-gray-900 mb-1">Lupa ID
                                                        Peserta?</p>
                                                    <p class="text-xs text-gray-600 mb-2">Cari ID menggunakan email
                                                        yang terdaftar</p>
                                                    <a href="{{ route('portal.forgot-id') }}"
                                                        class="inline-flex items-center gap-1 text-sm font-bold text-[#0053C5] hover:text-[#003D99] transition-colors">
                                                        Cari ID Saya
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($event->is_full)
                                    <!-- Full Event -->
                                    <div class="bg-red-50 border-2 border-red-200 rounded-xl p-6 text-center">
                                        <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                            </path>
                                        </svg>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">Event Penuh</h3>
                                        <p class="text-gray-600 text-sm">Maaf, kapasitas event sudah terpenuhi. Lihat
                                            event
                                            lainnya!</p>
                                    </div>
                                @elseif($event->is_past)
                                    <!-- Past Event -->
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-6 text-center">
                                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">Event Sudah Lewat</h3>
                                        <p class="text-gray-600 text-sm">Event ini sudah selesai. Lihat event mendatang
                                            lainnya!</p>
                                    </div>
                            @endif

                            <!-- Share Buttons -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <p class="text-sm font-bold text-gray-900 mb-3">Bagikan Event:</p>
                                <div class="flex gap-2">
                                    <a href="https://wa.me/?text={{ urlencode($event->judul . ' - ' . route('portal.event.detail', $event->slug)) }}"
                                        target="_blank"
                                        class="flex-1 bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition text-center text-sm">
                                        WhatsApp
                                    </a>
                                    <button x-on:click="copyLink()"
                                        class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition text-sm">
                                        Copy Link
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Related Events -->
    @if ($relatedEvents->count() > 0)
        <section class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-3xl font-black text-gray-900 mb-8">Event Serupa</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($relatedEvents as $related)
                        <a href="{{ route('portal.event.detail', $related->slug) }}"
                            class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                            <div class="relative h-48 bg-gradient-to-br from-[#0053C5] to-[#003D91]">
                                @if ($related->banner_image)
                                    <img src="{{ asset('storage/' . $related->banner_image) }}"
                                        alt="{{ $related->judul }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">{{ $related->judul }}
                                </h3>
                                <p class="text-sm text-gray-600">{{ $related->formatted_date }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-[#0053C5] via-[#003D91] to-[#002D70] text-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center shadow-2xl">
                        <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo"
                            class="h-14 w-auto object-contain">
                    </div>
                    <div>
                        <h3 class="text-3xl font-black mb-1">AL AZHAR EXPO</h3>
                        <p class="text-white/80 font-semibold">2025</p>
                    </div>
                </div>
                <div class="text-center md:text-right text-sm space-y-2 px-5">
                    <div class="flex flex-col md:flex-row md:space-x-4 md:justify-end">
                        <a href="#" class="hover:underline">Syarat & Ketentuan</a>
                        <span class="hidden md:inline">|</span>
                        <a href="#" class="hover:underline">Kebijakan Privasi</a>
                    </div>
                    <p class="opacity-80">© 2025 YPI Al Azhar. All Rights Reserved.</p>
                    <p class="opacity-80">Al Azhar Expo 2025 | Menjadi sarana kolaborasi, inspirasi, dan
                        penguatan peran Al Azhar dalam mencetak generasi berakhlak mulia serta memberikan kontribusi
                        nyata bagi umat, bangsa, dan negeri.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('eventRegistration', () => ({
                idPeserta: '',
                loading: false,
                errorMessage: '',
                successMessage: '',

                async submitRegistration() {
                    // Reset messages
                    this.errorMessage = '';
                    this.successMessage = '';

                    // Validation
                    if (!this.idPeserta) {
                        this.errorMessage = 'ID Peserta wajib diisi!';
                        this.scrollToMessage();
                        return;
                    }

                    if (this.idPeserta.length !== 4) {
                        this.errorMessage = 'ID Peserta harus terdiri dari 4 karakter!';
                        this.scrollToMessage();
                        return;
                    }

                    this.loading = true;

                    try {
                        const response = await fetch(
                            '{{ route('portal.event.register', $event->id) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    id_peserta: this.idPeserta.toUpperCase()
                                })
                            });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            this.successMessage = data.message ||
                                'Anda berhasil terdaftar di event ini!';
                            this.idPeserta = '';
                            this.scrollToMessage();

                            // Reload after 3 seconds
                            setTimeout(() => {
                                window.location.reload();
                            }, 3000);
                        } else {
                            this.errorMessage = data.message ||
                                'Terjadi kesalahan saat mendaftar. Silakan coba lagi.';
                            this.scrollToMessage();
                        }
                    } catch (error) {
                        console.error('Registration error:', error);
                        this.errorMessage =
                            'Terjadi kesalahan pada server. Silakan coba lagi nanti.';
                        this.scrollToMessage();
                    } finally {
                        this.loading = false;
                    }
                },

                scrollToMessage() {
                    // Scroll to form to show message
                    this.$nextTick(() => {
                        const messageElement = this.$el.querySelector(
                            '[x-show="errorMessage"], [x-show="successMessage"]');
                        if (messageElement) {
                            messageElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                    });
                },

                copyLink() {
                    const url = window.location.href;

                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(url).then(() => {
                            // Show toast notification
                            this.showToast('Link berhasil disalin!');
                        }).catch(err => {
                            console.error('Failed to copy:', err);
                            this.fallbackCopyLink(url);
                        });
                    } else {
                        this.fallbackCopyLink(url);
                    }
                },

                fallbackCopyLink(url) {
                    const textArea = document.createElement('textarea');
                    textArea.value = url;
                    textArea.style.position = 'fixed';
                    textArea.style.left = '-999999px';
                    document.body.appendChild(textArea);
                    textArea.select();
                    try {
                        document.execCommand('copy');
                        this.showToast('Link berhasil disalin!');
                    } catch (err) {
                        console.error('Fallback copy failed:', err);
                        alert('Link: ' + url);
                    }
                    document.body.removeChild(textArea);
                },

                showToast(message) {
                    // Create toast element
                    const toast = document.createElement('div');
                    toast.className =
                        'fixed bottom-4 right-4 bg-gray-900 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-slide-up';
                    toast.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>${message}</span>
                    </div>
                `;
                    document.body.appendChild(toast);

                    // Remove after 3 seconds
                    setTimeout(() => {
                        toast.style.opacity = '0';
                        toast.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            document.body.removeChild(toast);
                        }, 300);
                    }, 3000);
                }
            }));
        });
    </script>

    <style>
        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slide-up 0.3s ease-out;
        }
    </style>

</body>

</html>
