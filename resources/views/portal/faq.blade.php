<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FAQ - Al Azhar Expo 2025</title>

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

        .faq-item {
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 83, 197, 0.15);
        }

        /* Accordion Animation */
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .accordion-content.open {
            max-height: 500px;
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
                    <a href="{{ route('portal.live') }}" class="hover:text-white/80 font-semibold transition">Live</a>
                    <a href="{{ route('portal.gallery') }}"
                        class="hover:text-white/80 font-semibold transition">Gallery</a>
                    <a href="{{ route('portal.faq') }}" class="text-white font-bold border-b-2 border-white">FAQ</a>
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
                <span class="text-sm font-semibold">❓ PERTANYAAN UMUM</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-black mb-6">
                Frequently Asked Questions
            </h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto">
                Temukan jawaban untuk pertanyaan yang sering diajukan seputar Al Azhar Expo 2025
            </p>
        </div>
    </section>

    <!-- Search & Filter Section -->
    <section class="py-8 bg-white border-b border-gray-200 sticky top-[72px] z-40">
        <div class="max-w-7xl mx-auto px-6">
            <form method="GET" action="{{ route('portal.faq') }}" class="flex flex-col md:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari pertanyaan..."
                            class="w-full px-6 py-4 pl-14 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-[#0053C5]/20 focus:border-[#0053C5] transition font-semibold">
                        <svg class="w-6 h-6 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Category Filter -->
                <select name="kategori"
                    class="px-6 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-[#0053C5]/20 focus:border-[#0053C5] transition font-semibold">
                    <option value="">📂 Semua Kategori</option>
                    @foreach ($kategoris as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                            {{ $kat }}
                        </option>
                    @endforeach
                </select>

                <!-- Submit Button -->
                <button type="submit"
                    class="bg-[#0053C5] text-white px-8 py-4 rounded-xl font-bold hover:bg-[#003D91] transition whitespace-nowrap">
                    🔍 Cari
                </button>

                <!-- Reset Button -->
                @if (request('search') || request('kategori'))
                    <a href="{{ route('portal.faq') }}"
                        class="bg-gray-200 text-gray-700 px-8 py-4 rounded-xl font-bold hover:bg-gray-300 transition whitespace-nowrap text-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </section>

    <!-- FAQ Content -->
    <section class="py-12">
        <div class="max-w-5xl mx-auto px-6">

            @if ($faqs->count() > 0)

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white rounded-2xl p-6 shadow-lg text-center border-2 border-[#0053C5]/10">
                        <div class="text-3xl font-black text-[#0053C5] mb-2">
                            {{ $faqs->sum(fn($group) => $group->count()) }}</div>
                        <div class="text-sm text-gray-600 font-semibold">Total FAQ</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg text-center border-2 border-[#003D91]/10">
                        <div class="text-3xl font-black text-[#003D91] mb-2">{{ $faqs->count() }}</div>
                        <div class="text-sm text-gray-600 font-semibold">Kategori</div>
                    </div>
                    <div
                        class="bg-white rounded-2xl p-6 shadow-lg text-center col-span-2 md:col-span-1 border-2 border-[#0053C5]/10">
                        <div class="text-3xl font-black text-[#0053C5] mb-2">24/7</div>
                        <div class="text-sm text-gray-600 font-semibold">Tersedia</div>
                    </div>
                </div>

                <!-- FAQ Accordion by Category -->
                @foreach ($faqs as $kategori => $questions)
                    <div class="mb-12">
                        <!-- Category Header -->
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-[#0053C5] to-[#003D91] rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-3xl font-black text-gray-900">{{ $kategori }}</h2>
                                <p class="text-sm text-gray-600">{{ $questions->count() }} pertanyaan</p>
                            </div>
                        </div>

                        <!-- FAQ Items -->
                        <div class="space-y-4" x-data="{ openId: null }">
                            @foreach ($questions as $faq)
                                <div
                                    class="bg-white rounded-2xl shadow-lg overflow-hidden faq-item border-2 border-transparent hover:border-[#0053C5]/20">
                                    <!-- Question -->
                                    <button
                                        x-on:click="openId = openId === {{ $faq->id }} ? null : {{ $faq->id }}"
                                        class="w-full text-left p-6 flex items-start justify-between gap-4 group">
                                        <div class="flex-1">
                                            <h3
                                                class="text-lg font-bold text-gray-900 group-hover:text-[#0053C5] transition">
                                                {{ $faq->pertanyaan }}
                                            </h3>
                                        </div>
                                        <div
                                            class="flex-shrink-0 w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center group-hover:bg-[#0053C5] transition">
                                            <svg class="w-5 h-5 text-[#0053C5] group-hover:text-white transition transform"
                                                x-bind:class="openId === {{ $faq->id }} ? 'rotate-180' : ''"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </button>

                                    <!-- Answer -->
                                    <div x-show="openId === {{ $faq->id }}"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                                        x-transition:enter-end="opacity-100 transform translate-y-0" x-cloak
                                        class="px-6 pb-6">
                                        <div class="pl-4 border-l-4 border-[#0053C5]">
                                            <div class="prose prose-lg max-w-none text-gray-700">
                                                {!! nl2br(e($faq->jawaban)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="w-32 h-32 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak Ada FAQ Ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba ubah kata kunci pencarian atau filter kategori Anda</p>
                    <a href="{{ route('portal.faq') }}"
                        class="inline-block bg-[#0053C5] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#003D91] transition">
                        Reset Pencarian
                    </a>
                </div>

            @endif

        </div>
    </section>

    <!-- Still Have Questions -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="bg-gradient-to-br from-blue-50 to-[#0053C5]/5 rounded-3xl p-12 border-2 border-[#0053C5]/20">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-[#0053C5] to-[#003D91] rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-4">
                    Masih Ada Pertanyaan?
                </h2>
                <p class="text-gray-600 text-lg mb-8">
                    Kami siap membantu Anda! Hubungi tim kami atau berikan feedback Anda
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('portal.feedback') }}"
                        class="inline-block bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white px-8 py-4 rounded-full font-bold hover:shadow-xl transition transform hover:scale-105">
                        💬 Kirim Pesan
                    </a>
                    <a href="https://wa.me/628xxxxxxxx" target="_blank"
                        class="inline-block bg-[#25D366] text-white px-8 py-4 rounded-full font-bold hover:bg-[#20BA5A] transition transform hover:scale-105">
                        📱 WhatsApp Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Topics -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-black text-gray-900 mb-4">
                    🔥 Topik <span class="gradient-text">Populer</span>
                </h2>
                <p class="text-gray-600 text-lg">Pertanyaan yang sering dicari jamaah</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $popularTopics = [
                        [
                            'title' => 'Cara Pendaftaran',
                            'icon' =>
                                'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                            'link' => '?search=pendaftaran',
                        ],
                        [
                            'title' => 'Jadwal Acara',
                            'icon' =>
                                'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                            'link' => '?search=jadwal',
                        ],
                        [
                            'title' => 'Lokasi & Akses',
                            'icon' =>
                                'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z',
                            'link' => '?search=lokasi',
                        ],
                        [
                            'title' => 'Biaya & Gratis',
                            'icon' =>
                                'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1',
                            'link' => '?search=biaya',
                        ],
                        [
                            'title' => 'Fasilitas',
                            'icon' =>
                                'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                            'link' => '?search=fasilitas',
                        ],
                        [
                            'title' => 'Kontak & Info',
                            'icon' =>
                                'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                            'link' => '?search=kontak',
                        ],
                    ];
                @endphp

                @foreach ($popularTopics as $topic)
                    <a href="{{ route('portal.faq') }}{{ $topic['link'] }}"
                        class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition transform hover:scale-105 group">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-[#0053C5] to-[#003D91] rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $topic['icon'] }}"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#0053C5] transition">
                            {{ $topic['title'] }}</h3>
                        <p class="text-sm text-gray-600">Klik untuk melihat FAQ terkait</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black mb-4">Siap Bergabung?</h2>
            <p class="text-xl text-white/90 mb-8">
                Daftar sekarang dan jadilah bagian dari Al Azhar Expo 2025!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}#registrasi"
                    class="inline-block bg-white text-[#0053C5] px-8 py-4 rounded-full font-bold hover:bg-white/90 transition transform hover:scale-105">
                    Daftar Sebagai Peserta
                </a>
                <a href="{{ route('portal.events') }}"
                    class="inline-block bg-white/10 backdrop-blur-sm text-white px-8 py-4 rounded-full font-bold hover:bg-white/20 transition border-2 border-white/30">
                    Lihat Semua Event
                </a>
            </div>
        </div>
    </section>


</body>

</html>
