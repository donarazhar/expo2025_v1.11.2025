<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gallery - Al Azhar Expo 2025</title>

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

        .gallery-item {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* Lightbox */
        .lightbox-overlay {
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
        }

        /* Video Container */
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }

        .video-container iframe,
        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Masonry Grid Effect */
        .masonry-grid {
            column-count: 1;
            column-gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .masonry-grid {
                column-count: 2;
            }
        }

        @media (min-width: 1024px) {
            .masonry-grid {
                column-count: 3;
            }
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 1.5rem;
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

<body class="bg-gray-50" x-data="galleryViewer()">

    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white shadow-lg sticky top-0 z-40">
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
                    <a href="{{ route('portal.live') }}" class="hover:text-white/80 font-semibold transition">Live</a>
                    <a href="{{ route('portal.gallery') }}"
                        class="text-white font-bold border-b-2 border-white">Gallery</a>
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
    <section class="bg-gradient-to-br from-[#0053C5] via-[#003D91] to-[#002D70] text-white py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="inline-block bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                <span class="text-sm font-semibold">📸 DOKUMENTASI</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-black mb-6">
                Gallery Al Azhar Expo
            </h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto">
                Jelajahi momen-momen berharga dan dokumentasi kegiatan Al Azhar Expo 2025
            </p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-8 bg-white border-b border-gray-200 sticky top-[72px] z-30">
        <div class="max-w-7xl mx-auto px-6">
            <form method="GET" action="{{ route('portal.gallery') }}"
                class="flex flex-col md:flex-row gap-4 items-center">
                <!-- Category Filter -->
                <div class="flex-1 w-full">
                    <select name="kategori" onchange="this.form.submit()"
                        class="w-full px-6 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-[#0053C5]/20 focus:border-[#0053C5] transition font-semibold">
                        <option value="">🎨 Semua Kategori</option>
                        @foreach ($kategoris as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Reset Button -->
                @if (request('kategori'))
                    <a href="{{ route('portal.gallery') }}"
                        class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold hover:bg-gray-300 transition whitespace-nowrap">
                        Reset Filter
                    </a>
                @endif
            </form>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-6">

            @if ($galleries->count() > 0)
                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                    <div class="bg-white rounded-2xl p-6 shadow-lg text-center border-2 border-[#0053C5]/10">
                        <div class="text-3xl font-black text-[#0053C5] mb-2">{{ $galleries->total() }}</div>
                        <div class="text-sm text-gray-600 font-semibold">Total Media</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg text-center border-2 border-[#003D91]/10">
                        <div class="text-3xl font-black text-[#003D91] mb-2">
                            {{ $galleries->whereNotNull('file_path')->count() }}</div>
                        <div class="text-sm text-gray-600 font-semibold">Foto</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg text-center border-2 border-[#0053C5]/10">
                        <div class="text-3xl font-black text-[#0053C5] mb-2">
                            {{ $galleries->whereNotNull('video_url')->count() }}</div>
                        <div class="text-sm text-gray-600 font-semibold">Video</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg text-center border-2 border-[#003D91]/10">
                        <div class="text-3xl font-black text-[#003D91] mb-2">{{ $kategoris->count() }}</div>
                        <div class="text-sm text-gray-600 font-semibold">Kategori</div>
                    </div>
                </div>

                <!-- Masonry Grid -->
                <div class="masonry-grid">
                    @foreach ($galleries as $gallery)
                        <div class="masonry-item">
                            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover gallery-item"
                                x-on:click="openLightbox(
                                    {{ $gallery->id }}, 
                                    '{{ $gallery->video_url ? 'video' : 'image' }}', 
                                    '{{ $gallery->video_url ? $gallery->video_url : asset('storage/' . $gallery->file_path) }}', 
                                    '{{ $gallery->judul }}', 
                                    '{{ $gallery->deskripsi ?? '' }}'
                                )">

                                <!-- Image/Video Thumbnail -->
                                <div class="relative overflow-hidden">
                                    @if ($gallery->file_path)
                                        <img src="{{ asset('storage/' . $gallery->file_path) }}"
                                            alt="{{ $gallery->judul }}" class="w-full h-auto object-cover">
                                    @else
                                        <div
                                            class="aspect-video bg-gradient-to-br from-[#0053C5] to-[#003D91] flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Video Badge -->
                                    @if ($gallery->video_url)
                                        <div class="absolute top-4 left-4">
                                            <span
                                                class="bg-[#0053C5] text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                                                </svg>
                                                Video
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Category Badge -->
                                    @if ($gallery->kategori)
                                        <div class="absolute top-4 right-4">
                                            <span
                                                class="bg-white/90 backdrop-blur-sm text-[#0053C5] px-3 py-1 rounded-full text-xs font-bold">
                                                {{ $gallery->kategori }}
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Hover Overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end">
                                        <div class="p-6 w-full">
                                            <h3 class="text-white font-bold text-lg mb-1">{{ $gallery->judul }}</h3>
                                            @if ($gallery->deskripsi)
                                                <p class="text-white/80 text-sm line-clamp-2">
                                                    {{ $gallery->deskripsi }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Info -->
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-900 line-clamp-2 mb-1">
                                        {{ $gallery->judul }}
                                    </h3>
                                    @if ($gallery->event)
                                        <p class="text-sm text-gray-600">
                                            <span class="font-semibold">Event:</span> {{ $gallery->event->judul }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $galleries->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="w-32 h-32 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak Ada Media Ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba ubah filter atau kembali ke halaman utama</p>
                    <a href="{{ route('portal.gallery') }}"
                        class="inline-block bg-[#0053C5] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#003D91] transition">
                        Reset Filter
                    </a>
                </div>
            @endif

        </div>
    </section>

    <!-- Lightbox Modal -->
    <div x-show="lightboxOpen" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 lightbox-overlay flex items-center justify-center p-4"
        x-on:click.self="closeLightbox()">

        <div class="relative max-w-6xl w-full">
            <!-- Close Button -->
            <button x-on:click="closeLightbox()"
                class="absolute -top-12 right-0 text-white hover:text-gray-300 transition">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <!-- Content -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-2xl">
                <!-- Image -->
                <div x-show="currentMediaType === 'image'" class="relative">
                    <img x-bind:src="currentMediaUrl" x-bind:alt="currentTitle"
                        class="w-full h-auto max-h-[70vh] object-contain bg-black">
                </div>

                <!-- Video -->
                <div x-show="currentMediaType === 'video'" class="bg-black">
                    <div class="video-container">
                        <iframe x-bind:src="getVideoEmbedUrl()" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <!-- Info -->
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2" x-text="currentTitle"></h3>
                    <p class="text-gray-600" x-text="currentDescription" x-show="currentDescription"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black mb-4">Ikut Berpartisipasi!</h2>
            <p class="text-xl text-white/90 mb-8">
                Daftar sekarang dan jadilah bagian dari dokumentasi Al Azhar Expo 2025
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}#registrasi"
                    class="inline-block bg-white text-[#0053C5] px-8 py-4 rounded-full font-bold hover:bg-white/90 transition transform hover:scale-105">
                    Daftar Sekarang
                </a>
                <a href="{{ route('portal.events') }}"
                    class="inline-block bg-white/10 backdrop-blur-sm text-white px-8 py-4 rounded-full font-bold hover:bg-white/20 transition border-2 border-white/30">
                    Lihat Event Lainnya
                </a>
            </div>
        </div>
    </section>

    <script>
        function galleryViewer() {
            return {
                lightboxOpen: false,
                currentId: null,
                currentMediaType: '',
                currentMediaUrl: '',
                currentTitle: '',
                currentDescription: '',

                openLightbox(id, type, url, title, description) {
                    this.currentId = id;
                    this.currentMediaType = type;
                    this.currentMediaUrl = url;
                    this.currentTitle = title;
                    this.currentDescription = description;
                    this.lightboxOpen = true;
                    document.body.style.overflow = 'hidden';
                },

                closeLightbox() {
                    this.lightboxOpen = false;
                    document.body.style.overflow = 'auto';
                },

                getVideoEmbedUrl() {
                    if (this.currentMediaType !== 'video') return '';

                    // YouTube
                    if (this.currentMediaUrl.includes('youtube.com') || this.currentMediaUrl.includes('youtu.be')) {
                        let videoId = '';
                        if (this.currentMediaUrl.includes('youtu.be/')) {
                            videoId = this.currentMediaUrl.split('youtu.be/')[1].split('?')[0];
                        } else {
                            videoId = this.currentMediaUrl.split('v=')[1]?.split('&')[0] || '';
                        }
                        return `https://www.youtube.com/embed/${videoId}?autoplay=1`;
                    }

                    return this.currentMediaUrl;
                }
            }
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const galleryApp = document.querySelector('[x-data]').__x.$data;
                if (galleryApp.lightboxOpen) {
                    galleryApp.closeLightbox();
                }
            }
        });
    </script>

</body>

</html>
