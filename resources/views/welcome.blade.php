<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Al Azhar Expo 2025 - Al Azhar Inspirasi Bangsa</title>

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
            scroll-behavior: smooth;
        }

        /* Navbar */
        .navbar-scrolled {
            background: rgba(0, 83, 197, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 83, 197, 0.3);
        }

        /* Animations */
        @@keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @@keyframes pulse-slow {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.05);
            }
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

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }

        .float {
            animation: float 3s ease-in-out infinite;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        .delay-500 {
            animation-delay: 0.5s;
        }

        /* Card Hover */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 83, 197, 0.25);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #0053C5 0%, #003D91 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Gradient Border */
        .gradient-border {
            position: relative;
            background: white;
            border-radius: 1.5rem;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 1.5rem;
            padding: 2px;
            background: linear-gradient(135deg, #0053C5, #003D91);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }
    </style>
</head>

<body class="antialiased bg-white">

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 fade-in-up">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg">
                        <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo"
                            class="h-10 w-auto object-contain">
                    </div>
                    <div class="text-white">
                        <h1 class="text-lg font-black">AL AZHAR EXPO</h1>
                        <p class="text-xs opacity-90">2025</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section id="beranda" class="relative min-h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/img/tinyhero.png') }}" alt="Hero" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-br from-[#0053C5]/10 via-[#0053C5]/30 to-[#003D91]/25"></div>
            <div class="absolute top-20 left-10 w-72 h-72 bg-white/5 rounded-full blur-3xl pulse-slow"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white/5 rounded-full blur-3xl pulse-slow"
                style="animation-delay: 1.5s;"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-32 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="text-white space-y-8">
                    <div class="fade-in-up">
                        <div class="inline-block bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                            <span class="text-sm font-semibold">🎉 18-19 Desember 2025</span>
                        </div>
                        <h1 class="text-5xl lg:text-7xl font-black leading-tight mb-6">
                            Al Azhar<br /><span class="text-white/90">Expo 2025</span>
                        </h1>
                        <div class="h-1 w-24 bg-white rounded-full mb-6"></div>
                        <p class="text-2xl lg:text-3xl font-bold mb-4">"Al Azhar Inspirasi Bangsa"</p>
                        <p class="text-lg text-white/80 leading-relaxed max-w-xl">
                            Momentum kolaborasi seluruh elemen Al Azhar untuk menunjukkan karya, gagasan, dan inovasi
                            yang menginspirasi umat, bangsa, dan negeri melalui sinergi pendidikan, dakwah, dan sosial
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 fade-in-up delay-300">
                        <a href="#registrasi"
                            class="inline-flex items-center justify-center bg-white text-[#0053C5] px-8 py-4 rounded-full font-bold hover:bg-white/95 transition-all transform hover:scale-105 shadow-2xl group">
                            <span>Daftar Sekarang</span>
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                        <a href="{{ route('portal.events') }}"
                            class="inline-flex items-center justify-center bg-white/10 backdrop-blur-sm text-white px-8 py-4 rounded-full font-bold hover:bg-white/20 transition-all border-2 border-white/30">
                            Pelajari Selengkapnya →
                        </a>
                    </div>

                    <div class="grid grid-cols-3 gap-8 pt-8 fade-in-up delay-500">
                        <div>
                            <div class="text-4xl font-black">1K+</div>
                            <div class="text-sm text-white/70">Pengunjung</div>
                        </div>
                        <div>
                            <div class="text-4xl font-black">50+</div>
                            <div class="text-sm text-white/70">Events</div>
                        </div>
                        <div>
                            <div class="text-4xl font-black">3</div>
                            <div class="text-sm text-white/70">Hari</div>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:flex items-center justify-center fade-in-up delay-400">
                    <div class="float">
                        <img src="{{ asset('assets/img/tinyadsheros.png') }}" alt="Ads"
                            class="w-full h-auto rounded-3xl">
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 fade-in-up delay-500">
            <div class="flex flex-col items-center gap-2 cursor-pointer"
                x-on:click="document.getElementById('tentang').scrollIntoView({behavior: 'smooth'})">
                <span class="text-white text-xs font-semibold tracking-wider">SCROLL</span>
                <div class="w-6 h-10 border-2 border-white/50 rounded-full flex items-start justify-center p-2">
                    <div class="w-1.5 h-2 bg-white rounded-full animate-bounce"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="tentang" class="py-24 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 reveal">
                <div
                    class="inline-block bg-[#0053C5]/10 text-[#0053C5] px-4 py-2 rounded-full mb-4 font-semibold text-sm">
                    TENTANG EVENT</div>
                <h2 class="text-4xl lg:text-6xl font-black text-gray-900 mb-4">
                    Kenapa Harus<br /><span class="gradient-text">Al Azhar Expo?</span>
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Sinergi Pendidikan, Dakwah, dan Sosial: Beradab dalam
                    Kemodernan, Siap Menjawab Tantangan Masa Depan</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach (['tinypro1.png', 'tinypro2.png', 'tinypro3.png'] as $img)
                    <a href="{{ route('portal.events') }}" class="reveal float block group">
                        <img src="{{ asset('assets/img/' . $img) }}" alt="Event"
                            class="w-full h-auto rounded-3xl shadow-lg group-hover:scale-105 transition-transform duration-300">
                    </a>
                @endforeach
            </div>

            <div class="text-center mt-12 reveal">
                <a href="{{ route('portal.events') }}"
                    class="inline-block bg-[#0053C5] text-white px-8 py-4 rounded-full font-bold hover:bg-[#003D91] transition-all transform hover:scale-105 shadow-xl">
                    Lihat Semua Event →
                </a>
            </div>
        </div>
    </section>

    <!-- Solusi -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="reveal">
                    <img src="{{ asset('assets/img/tinysalam.png') }}" alt="Solusi" class="w-full max-w-md mx-auto">
                </div>
                <div class="reveal space-y-6 text-center lg:text-left">
                    <h3 class="text-3xl lg:text-4xl font-extrabold text-[#0053C5]">#All in One Edu-Apps
                    </h3>
                    <p class="text-gray-600 text-lg">Cara termudah untuk membantu aktivitas Al Azhar kamu. Kamu dapat
                        melakukan pembayaran, melihat jadwal, mendaftar sekolah dan masih banyak lagi!</p>
                    <a href="https://salam-alazhar.id/" target="_blank"
                        class="inline-block px-10 py-4 bg-[#0053C5] text-white font-semibold rounded-full shadow-lg hover:bg-[#0040A0] transition">
                        Kunjungi Salam Al Azhar →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bentuk Kegiatan -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 reveal">
                <h2 class="text-4xl lg:text-6xl font-black text-gray-900 mb-4">Bentuk Kegiatan</h2>
                <div class="w-24 h-1 bg-[#0053C5] mx-auto mb-6"></div>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">4 kategori kegiatan utama yang akan mengisi Al Azhar
                    Expo 2025</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @php
                    $kegiatan = [
                        [
                            'icon' =>
                                'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                            'title' => 'Pameran & Stand',
                            'items' => [
                                'Karya siswa dari berbagai jenjang',
                                'Display lembaga dan unit Al Azhar',
                                'Bazar produk unggulan Al Azhar',
                                'Stand mitra dan sponsor',
                            ],
                        ],
                        [
                            'icon' =>
                                'M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z',
                            'title' => 'Talkshow Nasional',
                            'items' => [
                                'Pendidikan & Adab: Membentuk generasi berakhlak',
                                'Ekonomi Keumatan & Wakaf: Pemberdayaan ekonomi',
                                'Peran Masjid: Masjid sebagai pusat peradaban',
                                'Digital Expo: Teknologi di era modern',
                            ],
                        ],
                        [
                            'icon' =>
                                'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
                            'title' => 'Lomba & Festival',
                            'items' => [
                                'Lomba Robotik & Coding',
                                'Islamic Fashion Show',
                                'Pentas Seni & Performance',
                                'Rampak Gendang Tradisional',
                            ],
                        ],
                        [
                            'icon' =>
                                'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
                            'title' => 'Kegiatan Khusus',
                            'items' => [
                                'Pertemuan Jamaah Haji Al Azhar 2018-2025',
                                'Program Literasi "Al Azhar Menulis"',
                                'Fundraising "Gelar Sorban" untuk Palestina',
                                'Penganugerahan Al Azhar Award',
                            ],
                        ],
                    ];
                @endphp

                @foreach ($kegiatan as $item)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all reveal">
                        <div class="bg-[#0053C5] p-6">
                            <div class="flex items-center">
                                <div
                                    class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $item['icon'] }}"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-white">{{ $item['title'] }}</h3>
                            </div>
                        </div>
                        <div class="p-8">
                            <ul class="space-y-3">
                                @foreach ($item['items'] as $point)
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-gray-700">{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12 reveal">
                <a href="{{ route('portal.events') }}"
                    class="inline-flex items-center justify-center bg-[#0053C5] text-white px-10 py-5 rounded-full font-bold hover:bg-[#003D91] transition-all transform hover:scale-105 shadow-xl text-lg">
                    Lihat Jadwal Lengkap →
                </a>
            </div>
        </div>
    </section>

    <!-- Jadwal -->
    <section id="jadwal" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 reveal">
                <h2 class="text-4xl lg:text-6xl font-black text-gray-900 mb-4">Jadwal Acara</h2>
                <div class="w-24 h-1 bg-[#0053C5] mx-auto mb-6"></div>
                <p class="text-xl text-gray-600">Program lengkap selama 3 hari event</p>
            </div>

            <div x-data="{ activeDay: 1 }" class="max-w-5xl mx-auto">
                <div class="flex flex-wrap justify-center gap-4 mb-12">
                    @foreach ([['id' => 1, 'hari' => 'Hari 1', 'tanggal' => 'Kamis, 18 Desember'], ['id' => 2, 'hari' => 'Hari 2', 'tanggal' => 'Jumat, 19 Desember'], ['id' => 3, 'hari' => 'Hari 3', 'tanggal' => 'Sabtu, 20 Desember']] as $tab)
                        <button x-on:click="activeDay = {{ $tab['id'] }}"
                            x-bind:class="activeDay === {{ $tab['id'] }} ? 'bg-[#0053C5] text-white' :
                                'bg-white text-gray-700 hover:bg-gray-50 border-2 border-gray-200'"
                            class="px-8 py-4 rounded-xl font-bold shadow-lg transition-all transform hover:scale-105">
                            <div class="text-sm opacity-75 mb-1">{{ $tab['hari'] }}</div>
                            <div class="text-lg">{{ $tab['tanggal'] }}</div>
                        </button>
                    @endforeach
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-8 border-2 border-gray-100">
                    @php
                        $jadwal = [
                            1 => [
                                [
                                    'waktu' => '08.00 - 09.00',
                                    'judul' => 'Opening Ceremony',
                                    'desc' => 'Pembukaan resmi Al Azhar Expo 2025',
                                ],
                                [
                                    'waktu' => '08.00 - 17.00',
                                    'judul' => 'Pameran & Bazar (All Day)',
                                    'desc' => 'Stand pameran karya, bazar produk',
                                ],
                                [
                                    'waktu' => '10.00 - 12.00',
                                    'judul' => 'Talkshow: Pendidikan & Adab',
                                    'desc' => 'Diskusi tentang pendidikan karakter',
                                ],
                                [
                                    'waktu' => '14.00 - 16.00',
                                    'judul' => 'Islamic Fashion Show',
                                    'desc' => 'Peragaan busana muslim modern',
                                ],
                            ],
                            2 => [
                                [
                                    'waktu' => '08.00 - 12.00',
                                    'judul' => 'Lomba Robotik & Coding',
                                    'desc' => 'Kompetisi robotik dan coding',
                                ],
                                [
                                    'waktu' => '13.00 - 15.00',
                                    'judul' => 'Talkshow: Ekonomi Keumatan',
                                    'desc' => 'Pemberdayaan ekonomi umat',
                                ],
                                [
                                    'waktu' => '15.30 - 17.30',
                                    'judul' => '🌟 Talkshow Special',
                                    'desc' => 'Anies Baswedan & Ustadz Adi Hidayat',
                                    'special' => true,
                                ],
                                [
                                    'waktu' => '19.00 - 21.00',
                                    'judul' => 'Fundraising "Gelar Sorban"',
                                    'desc' => 'Penggalangan dana untuk Palestina',
                                ],
                            ],
                            3 => [
                                [
                                    'waktu' => '08.00 - 12.00',
                                    'judul' => 'Digital Expo & Technology',
                                    'desc' => 'Pameran teknologi pendidikan',
                                ],
                                [
                                    'waktu' => '13.00 - 14.00',
                                    'judul' => 'Rampak Gendang',
                                    'desc' => 'Pertunjukan seni tradisional',
                                ],
                                [
                                    'waktu' => '14.00 - 16.00',
                                    'judul' => 'Pertemuan Jamaah Haji',
                                    'desc' => 'Gathering jamaah haji 2018-2025',
                                ],
                                [
                                    'waktu' => '16.00 - 17.00',
                                    'judul' => 'Al Azhar Award',
                                    'desc' => 'Penghargaan tokoh Al Azhar',
                                ],
                                [
                                    'waktu' => '17.00 - 18.00',
                                    'judul' => 'Closing Ceremony',
                                    'desc' => 'Penutupan resmi & foto bersama',
                                ],
                            ],
                        ];
                    @endphp

                    @foreach ($jadwal as $day => $items)
                        <div x-show="activeDay === {{ $day }}" x-transition class="space-y-6">
                            @foreach ($items as $item)
                                <div
                                    class="border-l-4 border-[#0053C5] pl-6 py-4 {{ isset($item['special']) ? 'bg-[#0053C5]/5' : 'hover:bg-gray-50' }} rounded-r-lg transition-all">
                                    <div
                                        class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                        <h4
                                            class="text-xl font-bold {{ isset($item['special']) ? 'text-[#0053C5]' : 'text-gray-800' }}">
                                            {{ $item['judul'] }}</h4>
                                        <span
                                            class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">{{ $item['waktu'] }}</span>
                                    </div>
                                    <p class="text-gray-600">{{ $item['desc'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12 reveal">
                    <a href="{{ route('portal.events') }}"
                        class="inline-flex items-center justify-center bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white px-10 py-5 rounded-full font-bold hover:shadow-2xl transition-all transform hover:scale-105 text-lg">
                        Daftar Event & Lihat Detail →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri -->
    <section id="galeri" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 reveal">
                <div
                    class="inline-block bg-[#0053C5]/10 text-[#0053C5] px-4 py-2 rounded-full mb-4 font-semibold text-sm">
                    DOKUMENTASI</div>
                <h2 class="text-4xl lg:text-6xl font-black text-gray-900 mb-4">
                    Galeri <span class="gradient-text">Al Azhar Expo</span>
                </h2>
                <p class="text-gray-600 text-lg">Cuplikan momen terbaik dari keseruan Al Azhar Expo</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @for ($i = 1; $i <= 6; $i++)
                    <a href="{{ route('portal.gallery') }}"
                        class="card-hover bg-white rounded-3xl overflow-hidden shadow-lg reveal group">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('assets/img/gal' . $i . '.jpg') }}" alt="Galeri {{ $i }}"
                                class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110 rounded-3xl">
                        </div>
                    </a>
                @endfor
            </div>

            <div class="text-center mt-12 reveal">
                <a href="{{ route('portal.gallery') }}"
                    class="inline-block bg-[#0053C5] text-white px-10 py-5 rounded-full font-bold hover:bg-[#003D91] transition-all transform hover:scale-105 shadow-xl text-lg">
                    Lihat Semua Galeri →
                </a>
            </div>
        </div>
    </section>

    <!-- Registration -->
    <section id="registrasi" class="py-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6" x-data="registrationForm()">
            <div class="text-center mb-16 reveal">
                <div
                    class="inline-block bg-[#0053C5]/10 text-[#0053C5] px-4 py-2 rounded-full mb-4 font-semibold text-sm">
                    PENDAFTARAN</div>
                <h2 class="text-4xl lg:text-6xl font-black text-gray-900 mb-4">
                    Daftar <span class="gradient-text">Sekarang</span>
                </h2>
                <p class="text-gray-600 text-lg">Isi formulir untuk mendaftar sebagai peserta Al Azhar Expo 2025</p>
            </div>

            <!-- Success Message -->
            <div x-show="success" x-cloak x-transition
                class="mb-8 bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white p-8 rounded-3xl shadow-2xl">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-4">Pendaftaran Berhasil! 🎉</h3>

                        <div class="bg-white/20 rounded-2xl p-6 mb-4">
                            <p class="text-sm font-semibold mb-2">ID PESERTA ANDA:</p>
                            <p class="text-5xl font-black tracking-wider mb-2" x-text="registrationId"></p>
                            <p class="text-sm opacity-90">⚠️ Simpan ID ini baik-baik!</p>
                        </div>

                        <div class="space-y-2 text-sm bg-white/10 rounded-xl p-4">
                            <p class="font-bold text-lg mb-2">📋 Cara Check-in di Hari H:</p>
                            <ol class="list-decimal list-inside space-y-2 ml-2">
                                <li><strong>Buka:</strong> <a href="{{ route('check-in.form') }}"
                                        class="underline hover:text-white/80">{{ url('/check-in') }}</a></li>
                                <li><strong>Masukkan</strong> ID Peserta Anda</li>
                                <li><strong>QR Code</strong> akan muncul otomatis</li>
                                <li><strong>Scan</strong> QR di tablet entrance</li>
                            </ol>
                        </div>

                        <button x-on:click="success = false; resetForm()"
                            class="mt-4 bg-white text-[#0053C5] px-6 py-2 rounded-full font-bold hover:bg-white/90 transition">
                            Daftar Lagi
                        </button>
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            <div x-show="!success" x-transition>
                <form x-on:submit.prevent="submitForm" class="gradient-border p-10 reveal">
                    <div class="space-y-6 relative z-10">
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-bold text-gray-900 mb-3">Nama Lengkap *</label>
                            <input type="text" x-model="formData.nama_lengkap"
                                class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#0053C5]/20 focus:border-[#0053C5] transition-all font-medium"
                                placeholder="Masukkan nama lengkap">
                            <p x-show="errors.nama_lengkap" x-text="errors.nama_lengkap"
                                class="text-red-500 text-sm mt-2 font-semibold"></p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-bold text-gray-900 mb-3">Email *</label>
                            <input type="email" x-model="formData.email"
                                class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#0053C5]/20 focus:border-[#0053C5] transition-all font-medium"
                                placeholder="contoh@email.com">
                            <p x-show="errors.email" x-text="errors.email"
                                class="text-red-500 text-sm mt-2 font-semibold"></p>
                        </div>

                        <!-- No HP -->
                        <div>
                            <label class="block text-sm font-bold text-gray-900 mb-3">No. HP/WhatsApp *</label>
                            <input type="tel" x-model="formData.no_hp"
                                class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#0053C5]/20 focus:border-[#0053C5] transition-all font-medium"
                                placeholder="081234567890">
                            <p x-show="errors.no_hp" x-text="errors.no_hp"
                                class="text-red-500 text-sm mt-2 font-semibold"></p>
                        </div>

                        <!-- Asal Instansi -->
                        <div>
                            <label class="block text-sm font-bold text-gray-900 mb-3">Asal Instansi/Sekolah *</label>
                            <input type="text" x-model="formData.asal_instansi"
                                class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#0053C5]/20 focus:border-[#0053C5] transition-all font-medium"
                                placeholder="Masukkan asal instansi/sekolah">
                            <p x-show="errors.asal_instansi" x-text="errors.asal_instansi"
                                class="text-red-500 text-sm mt-2 font-semibold"></p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-10 relative z-10">
                        <button type="submit" x-bind:disabled="loading"
                            class="w-full text-white px-8 py-5 rounded-2xl font-bold text-lg transition-all transform shadow-xl bg-gradient-to-r from-[#0053C5] to-[#003D91] hover:shadow-2xl hover:scale-105 disabled:bg-gray-400 disabled:cursor-not-allowed disabled:transform-none">
                            <span x-show="!loading">Daftar Sekarang →</span>
                            <span x-show="loading">Memproses...</span>
                        </button>
                    </div>
                </form>

                <!-- Help Text -->
                <div class="mt-8 text-center">
                    <p class="text-gray-600 text-sm">
                        Dengan mendaftar, Anda menyetujui <a href="#"
                            class="text-[#0053C5] hover:underline">Syarat & Ketentuan</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

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
            Alpine.data('registrationForm', () => ({
                formData: {
                    nama_lengkap: '',
                    email: '',
                    no_hp: '',
                    asal_instansi: ''
                },
                errors: {},
                loading: false,
                success: false,
                registrationId: '',

                validateForm() {
                    this.errors = {};
                    let isValid = true;

                    // Nama Lengkap
                    if (!this.formData.nama_lengkap || this.formData.nama_lengkap.trim().length < 3) {
                        this.errors.nama_lengkap = 'Nama lengkap minimal 3 karakter';
                        isValid = false;
                    }

                    // Email
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!this.formData.email || !emailRegex.test(this.formData.email)) {
                        this.errors.email = 'Format email tidak valid';
                        isValid = false;
                    }

                    // No HP
                    const phoneRegex = /^(\+62|62|0)[0-9]{9,12}$/;
                    const cleanPhone = this.formData.no_hp.replace(/[\s-]/g, '');
                    if (!cleanPhone || !phoneRegex.test(cleanPhone)) {
                        this.errors.no_hp = 'Format nomor HP tidak valid (contoh: 081234567890)';
                        isValid = false;
                    }

                    // Asal Instansi
                    if (!this.formData.asal_instansi || this.formData.asal_instansi.trim().length < 3) {
                        this.errors.asal_instansi = 'Asal instansi minimal 3 karakter';
                        isValid = false;
                    }

                    return isValid;
                },

                async submitForm() {
                    console.log('=== FORM SUBMISSION STARTED ===');

                    // Validate first
                    if (!this.validateForm()) {
                        console.error('❌ Validation failed:', this.errors);
                        return;
                    }

                    console.log('✅ Validation passed');
                    console.log('📝 Form Data:', this.formData);

                    this.loading = true;
                    this.errors = {};

                    // Check CSRF Token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfToken) {
                        console.error('❌ CSRF token not found in page');
                        alert('Error: CSRF token tidak ditemukan. Refresh halaman dan coba lagi.');
                        this.loading = false;
                        return;
                    }
                    console.log('🔑 CSRF Token:', csrfToken.content);

                    // Check Route
                    const registerUrl = '{{ route('register.store') }}';
                    console.log('🌐 Register URL:', registerUrl);

                    try {
                        console.log('📡 Sending request...');

                        const response = await fetch(registerUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken.content,
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify(this.formData)
                        });

                        console.log('📨 Response Status:', response.status);
                        console.log('📨 Response OK:', response.ok);

                        // Try to get response text first
                        const responseText = await response.text();
                        console.log('📄 Response Text:', responseText);

                        // Try to parse as JSON
                        let data;
                        try {
                            data = JSON.parse(responseText);
                            console.log('✅ Parsed JSON:', data);
                        } catch (parseError) {
                            console.error('❌ JSON Parse Error:', parseError);
                            console.error('Raw response:', responseText);
                            alert('Error: Server mengembalikan response yang tidak valid.\n\nResponse: ' +
                                responseText.substring(0, 200));
                            this.loading = false;
                            return;
                        }

                        if (response.ok && data.success) {
                            // Success
                            console.log('🎉 Registration successful!');
                            console.log('🆔 ID Peserta:', data.id_peserta);

                            this.success = true;
                            this.registrationId = data.id_peserta;
                            this.resetForm();

                            // Scroll to success message
                            setTimeout(() => {
                                document.querySelector('#registrasi').scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }, 100);
                        } else {
                            // Server validation errors
                            console.error('❌ Server Error:', data);

                            if (data.errors) {
                                console.error('Validation Errors:', data.errors);
                                this.errors = data.errors;
                            } else {
                                alert(data.message || 'Terjadi kesalahan saat pendaftaran');
                            }
                        }
                    } catch (error) {
                        console.error('❌ NETWORK ERROR:', error);
                        console.error('Error name:', error.name);
                        console.error('Error message:', error.message);
                        console.error('Error stack:', error.stack);

                        alert('Terjadi kesalahan koneksi:\n\n' +
                            'Error: ' + error.message + '\n\n' +
                            'Periksa:\n' +
                            '1. Koneksi internet Anda\n' +
                            '2. Browser console (F12) untuk detail error\n' +
                            '3. Laravel server masih running (php artisan serve)');
                    } finally {
                        this.loading = false;
                        console.log('=== FORM SUBMISSION ENDED ===');
                    }
                },

                resetForm() {
                    this.formData = {
                        nama_lengkap: '',
                        email: '',
                        no_hp: '',
                        asal_instansi: ''
                    };
                    this.errors = {};
                }
            }));
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (navbar) {
                navbar.classList.toggle('navbar-scrolled', window.scrollY > 50);
            }
        });

        // Scroll reveal animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Debug info on page load
        console.log('=== PAGE LOADED ===');
        console.log('🌐 Current URL:', window.location.href);
        console.log('🔑 CSRF Token:', document.querySelector('meta[name="csrf-token"]')?.content || 'NOT FOUND');
        console.log('📍 Register Route:', '{{ route('register.store') }}');
    </script>
</body>

</html>
