<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portal Jamaah - Al Azhar Expo 2025</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            scroll-behavior: smooth;
        }

        .gradient-text {
            background: linear-gradient(135deg, #0053C5 0%, #003D91 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 83, 197, 0.2);
        }

        @@keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .float {
            animation: float 3s ease-in-out infinite;
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
                    <a href="{{ route('portal.index') }}" class="text-white font-bold border-b-2 border-white">Home</a>
                    <a href="{{ route('portal.events') }}"
                        class="hover:text-white/80 font-semibold transition">Events</a>
                    <a href="{{ route('portal.live') }}" class="hover:text-white/80 font-semibold transition">Live</a>
                    <a href="{{ route('portal.gallery') }}"
                        class="hover:text-white/80 font-semibold transition">Gallery</a>
                    <a href="{{ route('portal.faq') }}" class="hover:text-white/80 font-semibold transition">FAQ</a>
                </div>

                <a href="{{ route('home') }}"
                    class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg font-semibold transition">
                    Kembali ke Home
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section
        class="relative bg-gradient-to-br from-[#0053C5] via-[#003D91] to-[#002D70] text-white py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-block bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                        <span class="text-sm font-semibold">🎉 4-6 Desember 2025</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-black mb-6">
                        Selamat Datang di<br />
                        <span class="text-white/90">Portal Jamaah</span>
                    </h1>
                    <p class="text-xl text-white/90 mb-8 leading-relaxed">
                        Akses informasi lengkap seputar Al Azhar Expo 2025. Daftar event, saksikan live streaming, dan
                        jelajahi berbagai konten menarik lainnya!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('portal.events') }}"
                            class="inline-flex items-center justify-center bg-white text-[#0053C5] px-8 py-4 rounded-full font-bold hover:bg-white/90 transition transform hover:scale-105 shadow-xl">
                            Lihat Semua Event →
                        </a>
                        <a href="{{ route('portal.live') }}"
                            class="inline-flex items-center justify-center bg-white/10 backdrop-blur-sm text-white px-8 py-4 rounded-full font-bold hover:bg-white/20 transition border-2 border-white/30">
                            🔴 Live Streaming
                        </a>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="float">
                        <img src="{{ asset('assets/img/ads2.png') }}" alt="Hero"
                            class="w-full h-auto rounded-3xl shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="text-center p-8 bg-gradient-to-br from-[#0053C5] to-[#003D91] rounded-2xl shadow-xl text-white card-hover">
                    <div class="text-5xl font-black mb-2">{{ $stats['total_peserta'] }}+</div>
                    <div class="text-lg opacity-90">Total Jamaah Terdaftar</div>
                </div>
                <div
                    class="text-center p-8 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl text-white card-hover">
                    <div class="text-5xl font-black mb-2">{{ $stats['total_events'] }}+</div>
                    <div class="text-lg opacity-90">Event & Kegiatan</div>
                </div>
                <div
                    class="text-center p-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-xl text-white card-hover">
                    <div class="text-5xl font-black mb-2">{{ $stats['total_feedback'] }}+</div>
                    <div class="text-lg opacity-90">Testimoni & Review</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Stream Alert -->
    @if ($liveStream)
        <section class="py-8 bg-red-500">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6 text-white">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div class="w-4 h-4 bg-white rounded-full animate-pulse"></div>
                            <div class="absolute inset-0 w-4 h-4 bg-white rounded-full animate-ping"></div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black">🔴 LIVE SEKARANG!</h3>
                            <p class="text-white/90">{{ $liveStream->judul }}</p>
                        </div>
                    </div>
                    <a href="{{ route('portal.live') }}"
                        class="bg-white text-red-500 px-8 py-4 rounded-full font-bold hover:bg-white/90 transition whitespace-nowrap">
                        Tonton Sekarang →
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Featured Events -->
    @if ($featuredEvents->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                        ⭐ Event <span class="gradient-text">Unggulan</span>
                    </h2>
                    <p class="text-gray-600 text-lg">Event pilihan yang wajib Anda ikuti!</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($featuredEvents as $event)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                            <div class="relative h-48 bg-gradient-to-br from-[#0053C5] to-[#003D91]">
                                @if ($event->banner_image)
                                    <img src="{{ asset('storage/' . $event->banner_image) }}"
                                        alt="{{ $event->judul }}" class="w-full h-full object-cover">
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-bold">⭐
                                        Featured</span>
                                </div>
                            </div>

                            <div class="p-6">
                                <span
                                    class="inline-block bg-[#0053C5]/10 text-[#0053C5] px-3 py-1 rounded-full text-xs font-bold mb-3">
                                    {{ $event->kategori }}
                                </span>
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $event->judul }}</h3>

                                <div class="space-y-2 mb-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-[#0053C5]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span class="font-semibold">{{ $event->formatted_date }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-[#0053C5]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                        </svg>
                                        <span class="line-clamp-1">{{ $event->lokasi }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('portal.event.detail', $event->slug) }}"
                                    class="block w-full text-center bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white px-6 py-3 rounded-xl font-bold hover:shadow-xl transition">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('portal.events') }}"
                        class="inline-block bg-[#0053C5] text-white px-8 py-4 rounded-full font-bold hover:bg-[#003D91] transition transform hover:scale-105 shadow-xl">
                        Lihat Semua Event →
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Upcoming Events -->
    @if ($upcomingEvents->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-2">
                            📅 Event <span class="gradient-text">Mendatang</span>
                        </h2>
                        <p class="text-gray-600">Jangan sampai ketinggalan!</p>
                    </div>
                    <a href="{{ route('portal.events') }}"
                        class="hidden md:inline-block text-[#0053C5] font-bold hover:underline">
                        Lihat Semua →
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($upcomingEvents as $event)
                        <div
                            class="bg-white border-2 border-gray-100 rounded-2xl p-6 hover:border-[#0053C5] hover:shadow-lg transition">
                            <div class="flex items-start gap-4">
                                <div
                                    class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-[#0053C5] to-[#003D91] rounded-xl flex flex-col items-center justify-center text-white">
                                    <div class="text-xs font-semibold">{{ $event->tanggal_mulai->format('M') }}</div>
                                    <div class="text-2xl font-black">{{ $event->tanggal_mulai->format('d') }}</div>
                                </div>

                                <div class="flex-1">
                                    <span
                                        class="inline-block bg-[#0053C5]/10 text-[#0053C5] px-2 py-1 rounded text-xs font-bold mb-2">
                                        {{ $event->kategori }}
                                    </span>
                                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">{{ $event->judul }}</h3>
                                    <p class="text-sm text-gray-600 mb-3">{{ $event->formatted_time }}</p>
                                    <a href="{{ route('portal.event.detail', $event->slug) }}"
                                        class="text-[#0053C5] font-bold text-sm hover:underline">
                                        Lihat Detail →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-8 md:hidden">
                    <a href="{{ route('portal.events') }}"
                        class="inline-block text-[#0053C5] font-bold hover:underline">
                        Lihat Semua Event →
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Features -->
    <section class="py-16 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                    Fitur <span class="gradient-text">Portal Jamaah</span>
                </h2>
                <p class="text-gray-600 text-lg">Semua yang Anda butuhkan dalam satu tempat</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $features = [
                        [
                            'icon' =>
                                'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                            'title' => 'Events',
                            'desc' => 'Lihat dan daftar event',
                            'link' => 'portal.events',
                            'color' => 'from-blue-500 to-blue-600',
                        ],
                        [
                            'icon' =>
                                'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z',
                            'title' => 'Live Streaming',
                            'desc' => 'Saksikan acara live',
                            'link' => 'portal.live',
                            'color' => 'from-red-500 to-red-600',
                        ],
                        [
                            'icon' =>
                                'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                            'title' => 'Gallery',
                            'desc' => 'Dokumentasi kegiatan',
                            'link' => 'portal.gallery',
                            'color' => 'from-purple-500 to-purple-600',
                        ],
                        [
                            'icon' =>
                                'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                            'title' => 'FAQ',
                            'desc' => 'Pertanyaan umum',
                            'link' => 'portal.faq',
                            'color' => 'from-green-500 to-green-600',
                        ],
                    ];
                @endphp

                @foreach ($features as $feature)
                    <a href="{{ route($feature['link']) }}"
                        class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition card-hover group">
                        <div
                            class="w-16 h-16 bg-gradient-to-br {{ $feature['color'] }} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $feature['icon'] }}"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-gray-600">{{ $feature['desc'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    @if ($featuredTestimonials->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                        💬 Testimoni <span class="gradient-text">Jamaah</span>
                    </h2>
                    <p class="text-gray-600 text-lg">Apa kata mereka tentang Al Azhar Expo</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($featuredTestimonials as $feedback)
                        <div class="bg-white rounded-2xl p-8 shadow-lg card-hover">
                            <div class="flex items-center gap-1 mb-4">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= $feedback->rating ? 'text-yellow-500' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endfor
                            </div>

                            <p class="text-gray-700 mb-6 italic">"{{ $feedback->komentar }}"</p>

                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-[#0053C5] to-[#003D91] rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    {{ substr($feedback->peserta->nama_lengkap, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $feedback->peserta->nama_lengkap }}</h4>
                                    <p class="text-sm text-gray-600">{{ $feedback->peserta->asal_instansi }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('portal.feedback') }}"
                        class="inline-block bg-[#0053C5] text-white px-8 py-4 rounded-full font-bold hover:bg-[#003D91] transition transform hover:scale-105 shadow-xl">
                        Berikan Testimoni Anda →
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-black mb-6">Siap Bergabung?</h2>
            <p class="text-xl text-white/90 mb-8">
                Daftar sekarang dan jadi bagian dari Al Azhar Expo 2025!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}#registrasi"
                    class="inline-block bg-white text-[#0053C5] px-10 py-4 rounded-full font-bold text-lg hover:bg-white/90 transition transform hover:scale-105">
                    Daftar Sebagai Peserta
                </a>
                <a href="{{ route('portal.events') }}"
                    class="inline-block bg-white/10 backdrop-blur-sm text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-white/20 transition border-2 border-white/30">
                    Lihat Semua Event
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center">
                            <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo" class="h-12 w-auto">
                        </div>
                        <div>
                            <h3 class="text-2xl font-black">AL AZHAR EXPO</h3>
                            <p class="text-gray-400 text-sm">2025</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">Al Azhar Inspirasi Bangsa</p>
                    <p class="text-gray-400 text-sm">Portal informasi terpadu untuk jamaah Al Azhar Expo 2025</p>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('portal.index') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('portal.events') }}" class="hover:text-white transition">Events</a>
                        </li>
                        <li><a href="{{ route('portal.live') }}" class="hover:text-white transition">Live
                                Streaming</a></li>
                        <li><a href="{{ route('portal.gallery') }}" class="hover:text-white transition">Gallery</a>
                        </li>
                        <li><a href="{{ route('portal.faq') }}" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📍 Masjid Agung Al Azhar Jakarta</li>
                        <li>📧 info@alazharexpo.com</li>
                        <li>📱 +62 821 xxxx xxxx</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>© 2025 YPI Al Azhar. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

</body>

</html>
