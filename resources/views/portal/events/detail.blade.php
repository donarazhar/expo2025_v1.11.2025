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
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center">
                        <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo" class="h-10 w-auto">
                    </div>
                    <div>
                        <h1 class="text-lg font-black">AL AZHAR EXPO</h1>
                        <p class="text-xs opacity-90">Portal Jamaah</p>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('portal.index') }}" class="hover:text-white/80 font-semibold transition">Home</a>
                    <a href="{{ route('portal.events') }}" class="text-white font-bold">Events</a>
                    <a href="{{ route('portal.live') }}" class="hover:text-white/80 font-semibold transition">Live</a>
                    <a href="{{ route('portal.gallery') }}"
                        class="hover:text-white/80 font-semibold transition">Gallery</a>
                    <a href="{{ route('portal.faq') }}" class="hover:text-white/80 font-semibold transition">FAQ</a>
                </div>

                <a href="{{ route('portal.events') }}"
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
                                            required>
                                        <p class="text-xs text-gray-500 mt-1">Masukkan ID peserta Anda (4 karakter)</p>
                                    </div>

                                    <p x-show="errorMessage" x-text="errorMessage"
                                        class="text-red-500 text-sm font-semibold bg-red-50 p-3 rounded-lg" x-cloak>
                                    </p>

                                    <p x-show="successMessage" x-text="successMessage"
                                        class="text-green-600 text-sm font-semibold bg-green-50 p-3 rounded-lg"
                                        x-cloak></p>

                                    <button type="submit" x-bind:disabled="loading"
                                        class="w-full bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white px-6 py-4 rounded-xl font-bold hover:shadow-xl transition transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                        <span x-show="!loading">✨ Daftar Event Ini</span>
                                        <span x-show="loading">Memproses...</span>
                                    </button>
                                </form>

                                <div class="mt-4 p-4 bg-blue-50 rounded-xl">
                                    <p class="text-xs text-gray-600">
                                        💡 <strong>Belum punya ID?</strong> <a href="{{ route('home') }}#registrasi"
                                            class="text-[#0053C5] font-bold hover:underline">Daftar dulu</a> sebagai
                                        peserta
                                    </p>
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
                                    <p class="text-gray-600 text-sm">Maaf, kapasitas event sudah terpenuhi. Lihat event
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
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-2xl font-black mb-4">AL AZHAR EXPO 2025</h3>
                    <p class="text-gray-400">Al Azhar Inspirasi Bangsa</p>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('portal.index') }}" class="hover:text-white transition">Portal Home</a>
                        </li>
                        <li><a href="{{ route('portal.events') }}" class="hover:text-white transition">Events</a>
                        </li>
                        <li><a href="{{ route('portal.feedback') }}" class="hover:text-white transition">Feedback</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📍 Masjid Agung Al Azhar Jakarta</li>
                        <li>📧 info@alazharexpo.com</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>© 2025 YPI Al Azhar. All Rights Reserved.</p>
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
                    if (!this.idPeserta || this.idPeserta.length !== 4) {
                        this.errorMessage = 'ID Peserta harus 4 karakter!';
                        return;
                    }

                    this.loading = true;
                    this.errorMessage = '';
                    this.successMessage = '';

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

                        if (data.success) {
                            this.successMessage = data.message;
                            this.idPeserta = '';
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        } else {
                            this.errorMessage = data.message;
                        }
                    } catch (error) {
                        console.error(error);
                        this.errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                    } finally {
                        this.loading = false;
                    }
                },

                copyLink() {
                    const url = window.location.href;
                    navigator.clipboard.writeText(url).then(() => {
                        alert('Link berhasil disalin!');
                    });
                }
            }));
        });
    </script>

</body>

</html>
