<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Live Streaming - Al Azhar Expo 2025</title>

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

        @keyframes pulse-live {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .pulse-live {
            animation: pulse-live 2s ease-in-out infinite;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            background: #000;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 83, 197, 0.2);
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
                        class="hover:text-white/80 font-semibold transition">Events</a>
                    <a href="{{ route('portal.live') }}" class="text-white font-bold border-b-2 border-white">Live</a>
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

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#0053C5] via-[#003D91] to-[#002D70] text-white py-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-sm px-6 py-3 rounded-full mb-6">
                <div class="relative">
                    <div class="w-3 h-3 bg-white rounded-full pulse-live"></div>
                </div>
                <span class="font-bold">LIVE STREAMING</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-black mb-6">
                🔴 Saksikan Langsung
            </h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto">
                Ikuti setiap momen berharga Al Azhar Expo 2025 secara langsung dari mana saja!
            </p>
        </div>
    </section>

    @if ($liveStreams->where('status', 'live')->count() > 0)
        <!-- Live Now Section -->
        <section class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                @foreach ($liveStreams->where('status', 'live') as $stream)
                    <div class="mb-12 last:mb-0">
                        <!-- Live Badge -->
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <span
                                        class="bg-[#0053C5] text-white px-4 py-2 rounded-full text-sm font-bold flex items-center gap-2">
                                        <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                                        LIVE SEKARANG
                                    </span>
                                    <span
                                        class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        👁️ {{ rand(150, 500) }} viewers
                                    </span>
                                </div>
                                <h2 class="text-3xl md:text-4xl font-black text-gray-900">{{ $stream->judul }}</h2>
                                @if ($stream->event)
                                    <p class="text-gray-600 mt-2">
                                        <span class="font-semibold">Event:</span> {{ $stream->event->judul }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Video Player -->
                        <div class="bg-black rounded-2xl overflow-hidden shadow-2xl mb-6">
                            @if ($stream->platform === 'youtube')
                                <div class="video-container">
                                    <iframe
                                        src="https://www.youtube.com/embed/{{ $stream->stream_url }}?autoplay=1&rel=0"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            @elseif($stream->platform === 'other')
                                <div
                                    class="aspect-video bg-gradient-to-br from-[#0053C5] via-[#003D91] to-[#002D70] flex items-center justify-center">
                                    <div class="text-center text-white p-8">
                                        <svg class="w-20 h-20 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                        <h3 class="text-2xl font-bold mb-2">Social Media Live</h3>
                                        <p class="mb-4">Tonton di platform social media kami</p>
                                        <a href="{{ $stream->stream_url }}" target="_blank"
                                            class="inline-block bg-white text-[#0053C5] px-6 py-3 rounded-full font-bold hover:bg-white/90 transition">
                                            Buka Platform →
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div
                                    class="aspect-video bg-gradient-to-br from-[#0053C5] to-[#003D91] flex items-center justify-center">
                                    <div class="text-center text-white p-8">
                                        <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <h3 class="text-2xl font-bold mb-2">Streaming Aktif</h3>
                                        <a href="{{ $stream->stream_url }}" target="_blank"
                                            class="inline-block bg-white text-[#0053C5] px-6 py-3 rounded-full font-bold hover:bg-white/90 transition mt-4">
                                            Tonton Sekarang →
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Stream Info -->
                        @if ($stream->deskripsi)
                            <div class="bg-gray-50 rounded-2xl p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Tentang Live Streaming Ini</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $stream->deskripsi }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if ($liveStreams->where('status', 'scheduled')->count() > 0)
        <!-- Scheduled Streams -->
        <section class="py-12 {{ $liveStreams->where('status', 'live')->count() > 0 ? 'bg-gray-50' : 'bg-white' }}">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">
                        📅 Jadwal <span class="gradient-text">Live Streaming</span>
                    </h2>
                    <p class="text-gray-600 text-lg">Live streaming yang akan datang</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($liveStreams->where('status', 'scheduled') as $stream)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                            <!-- Thumbnail -->
                            <div class="relative h-48 bg-gradient-to-br from-[#0053C5] to-[#003D91]">
                                @if ($stream->thumbnail)
                                    <img src="{{ asset('storage/' . $stream->thumbnail) }}" alt="{{ $stream->judul }}"
                                        class="w-full h-full object-cover opacity-80">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <svg class="w-20 h-20 text-white/30" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Status Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="bg-[#0053C5] text-white px-3 py-1 rounded-full text-xs font-bold">
                                        🕐 Terjadwal
                                    </span>
                                </div>

                                <!-- Platform Badge -->
                                <div class="absolute top-4 right-4">
                                    @if ($stream->platform === 'youtube')
                                        <span class="bg-[#003D91] text-white px-3 py-1 rounded-full text-xs font-bold">
                                            YouTube
                                        </span>
                                    @else
                                        <span class="bg-[#003D91] text-white px-3 py-1 rounded-full text-xs font-bold">
                                            Live
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                    {{ $stream->judul }}
                                </h3>

                                @if ($stream->event)
                                    <p class="text-sm text-gray-600 mb-3">
                                        <span class="font-semibold">Event:</span> {{ $stream->event->judul }}
                                    </p>
                                @endif

                                <!-- Date & Time -->
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <svg class="w-5 h-5 text-[#0053C5]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span
                                            class="font-semibold">{{ $stream->jadwal_tayang->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <svg class="w-5 h-5 text-[#0053C5]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $stream->jadwal_tayang->format('H:i') }} WIB</span>
                                    </div>
                                </div>

                                <!-- Countdown -->
                                <div class="bg-blue-50 border-2 border-[#0053C5]/20 rounded-xl p-4 text-center">
                                    <p class="text-sm text-gray-700 font-semibold">
                                        ⏰ Mulai dalam {{ $stream->jadwal_tayang->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($liveStreams->count() === 0)
        <!-- Empty State -->
        <section class="py-20 bg-white">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <div class="w-32 h-32 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-gray-900 mb-4">Belum Ada Live Streaming</h3>
                <p class="text-gray-600 text-lg mb-8">
                    Saat ini belum ada live streaming yang aktif atau terjadwal. Pantau terus untuk update terbaru!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('portal.events') }}"
                        class="inline-block bg-[#0053C5] text-white px-8 py-4 rounded-full font-bold hover:bg-[#003D91] transition transform hover:scale-105 shadow-xl">
                        Lihat Event Lainnya
                    </a>
                    <a href="{{ route('home') }}"
                        class="inline-block bg-gray-200 text-gray-700 px-8 py-4 rounded-full font-bold hover:bg-gray-300 transition">
                        Kembali ke Home
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Info Section -->
    <section class="py-16 bg-gradient-to-br from-[#0053C5] to-[#003D91] text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Live Setiap Hari</h3>
                    <p class="text-white/80">Saksikan berbagai acara menarik setiap hari selama Al Azhar Expo 2025</p>
                </div>

                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Multi Platform</h3>
                    <p class="text-white/80">Tersedia di YouTube dan platform streaming lainnya</p>
                </div>

                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">HD Quality</h3>
                    <p class="text-white/80">Streaming berkualitas tinggi untuk pengalaman menonton terbaik</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black text-gray-900 mb-4">
                Jangan Lewatkan <span class="gradient-text">Momen Berharga</span>
            </h2>
            <p class="text-gray-600 text-lg mb-8">
                Ikuti terus live streaming kami dan jadilah bagian dari setiap momen Al Azhar Expo 2025!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('portal.events') }}"
                    class="inline-block bg-[#0053C5] text-white px-8 py-4 rounded-full font-bold hover:bg-[#003D91] transition transform hover:scale-105 shadow-xl">
                    Lihat Jadwal Event
                </a>
                <a href="{{ route('portal.gallery') }}"
                    class="inline-block bg-gray-200 text-gray-700 px-8 py-4 rounded-full font-bold hover:bg-gray-300 transition">
                    Lihat Gallery
                </a>
            </div>
        </div>
    </section>

</body>

</html>
