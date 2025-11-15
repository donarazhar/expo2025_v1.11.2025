<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Events - Al Azhar Expo 2025</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
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

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#0053C5] via-[#003D91] to-[#002D70] text-white py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-6xl font-black mb-6">
                Event & Kegiatan
            </h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto mb-8">
                Temukan berbagai event menarik di Al Azhar Expo 2025. Daftar sekarang untuk mengikuti kegiatan pilihan
                Anda!
            </p>

            <!-- Search & Filter -->
            <div class="max-w-4xl mx-auto">
                <form method="GET" action="{{ route('portal.events') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari event..."
                            class="w-full px-6 py-4 rounded-xl text-gray-900 font-semibold focus:ring-4 focus:ring-white/30 outline-none">
                    </div>

                    <select name="kategori"
                        class="px-6 py-4 rounded-xl text-gray-900 font-semibold focus:ring-4 focus:ring-white/30 outline-none">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="bg-white text-[#0053C5] px-8 py-4 rounded-xl font-bold hover:bg-white/90 transition whitespace-nowrap">
                        🔍 Cari Event
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Events Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">

            @if ($events->count() > 0)

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-[#0053C5]/10">
                        <div class="text-4xl font-black text-[#0053C5] mb-2">{{ $events->total() }}</div>
                        <div class="text-gray-600 font-semibold">Total Events</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-green-500/10">
                        <div class="text-4xl font-black text-green-600 mb-2">
                            {{ $events->where('is_upcoming', true)->count() }}</div>
                        <div class="text-gray-600 font-semibold">Upcoming</div>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-orange-500/10">
                        <div class="text-4xl font-black text-orange-600 mb-2">{{ $kategoris->count() }}</div>
                        <div class="text-gray-600 font-semibold">Kategori</div>
                    </div>
                </div>

                <!-- Events Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($events as $event)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                            <!-- Image -->
                            <div class="relative h-48 bg-gradient-to-br from-[#0053C5] to-[#003D91]">
                                @if ($event->banner_image)
                                    <img src="{{ asset('storage/' . $event->banner_image) }}"
                                        alt="{{ $event->judul }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <svg class="w-20 h-20 text-white/30" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Badge -->
                                @if ($event->is_featured)
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-bold">⭐
                                            Featured</span>
                                    </div>
                                @endif

                                <div class="absolute top-4 right-4">
                                    <span
                                        class="bg-white/90 backdrop-blur-sm text-[#0053C5] px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $event->kategori }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                    {{ $event->judul }}
                                </h3>

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
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $event->formatted_time }}</span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-[#0053C5]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="line-clamp-1">{{ $event->lokasi }}</span>
                                    </div>
                                </div>

                                <!-- Capacity -->
                                @if ($event->kapasitas > 0)
                                    <div class="mb-4">
                                        <div class="flex justify-between text-sm mb-2">
                                            <span class="text-gray-600">Kapasitas</span>
                                            <span class="font-bold text-[#0053C5]">
                                                {{ $event->registered_count }}/{{ $event->kapasitas }}
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-[#0053C5] h-2 rounded-full"
                                                style="width: {{ min(($event->registered_count / $event->kapasitas) * 100, 100) }}%">
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Button -->
                                <a href="{{ route('portal.event.detail', $event->slug) }}"
                                    class="block w-full text-center bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white px-6 py-3 rounded-xl font-bold hover:shadow-xl transition">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $events->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="w-32 h-32 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak Ada Event Ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba ubah filter pencarian Anda atau kembali ke halaman utama</p>
                    <a href="{{ route('portal.events') }}"
                        class="inline-block bg-[#0053C5] text-white px-8 py-3 rounded-xl font-bold hover:bg-[#003D91] transition">
                        Reset Filter
                    </a>
                </div>

            @endif

        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white py-16">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black mb-4">Belum Daftar?</h2>
            <p class="text-xl text-white/90 mb-8">
                Daftar sekarang sebagai peserta Al Azhar Expo 2025 untuk mengikuti semua event menarik!
            </p>
            <a href="{{ route('home') }}#registrasi"
                class="inline-block bg-white text-[#0053C5] px-10 py-4 rounded-full font-bold text-lg hover:bg-white/90 transition transform hover:scale-105">
                Daftar Sebagai Peserta →
            </a>
        </div>
    </section>

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
                        <li><a href="{{ route('portal.events') }}" class="hover:text-white transition">Events</a>
                        </li>
                        <li><a href="{{ route('portal.live') }}" class="hover:text-white transition">Live
                                Streaming</a></li>
                        <li><a href="{{ route('portal.gallery') }}" class="hover:text-white transition">Gallery</a>
                        </li>
                        <li><a href="{{ route('portal.faq') }}" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="{{ route('portal.feedback') }}" class="hover:text-white transition">Feedback</a>
                        </li>
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
```

---

## ✅ **Perubahan yang Dilakukan:**

### **1. Navbar**
- ❌ Removed: "Portal Jamaah" subtitle
- ✅ Changed: Logo sekarang link ke home
- ✅ Updated: Menu navigation
- Events (active)
- Live
- Gallery
- FAQ
- **Feedback** (new)
- ✅ Button: "← Kembali" (lebih simple)

### **2. Footer**
- ❌ Removed: "Portal Home" link
- ✅ Updated: Quick Links sekarang:
- Events
- Live Streaming
- Gallery
- FAQ
- **Feedback** (new)

---

## 🎯 **New Navigation Structure:**
```
Events → Live → Gallery → FAQ → Feedback
