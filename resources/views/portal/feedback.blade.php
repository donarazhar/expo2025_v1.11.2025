<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Feedback - Al Azhar Expo 2025</title>

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

        /* Star Rating */
        .star-rating {
            display: flex;
            gap: 0.5rem;
        }

        .star {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .star:hover {
            transform: scale(1.2);
        }

        .star.active {
            animation: starPop 0.3s ease;
        }

        @keyframes starPop {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }

            100% {
                transform: scale(1);
            }
        }

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
                    <a href="{{ route('portal.faq') }}" class="hover:text-white/80 font-semibold transition">FAQ</a>
                    <a href="{{ route('portal.feedback') }}"
                        class="text-white font-bold border-b-2 border-white">Feedback</a>
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
                <span class="text-sm font-semibold">💬 FEEDBACK & TESTIMONI</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-black mb-6">
                Berikan Feedback Anda
            </h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto">
                Pendapat Anda sangat berharga bagi kami untuk terus meningkatkan kualitas Al Azhar Expo
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-6">

            <!-- Success Message -->
            <div x-data="feedbackForm()" x-cloak>

                <!-- Success Alert -->
                <div x-show="success" x-transition
                    class="mb-8 bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white p-8 rounded-3xl shadow-2xl">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold mb-2">Terima Kasih! 🎉</h3>
                            <p class="text-white/90 mb-4">Feedback Anda telah berhasil dikirim dan akan segera
                                ditampilkan setelah moderasi.</p>
                            <button x-on:click="success = false; resetForm()"
                                class="bg-white text-[#0053C5] px-6 py-2 rounded-full font-bold hover:bg-white/90 transition">
                                Kirim Feedback Lagi
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Feedback Form -->
                <div x-show="!success" x-transition>
                    <form x-on:submit.prevent="submitFeedback" class="gradient-border p-10">
                        <div class="space-y-6 relative z-10">

                            <!-- ID Peserta -->
                            <div>
                                <label class="block text-sm font-bold text-gray-900 mb-3">
                                    ID Peserta *
                                    <span class="text-xs font-normal text-gray-600 ml-2">(4 karakter yang Anda terima
                                        saat registrasi)</span>
                                </label>
                                <input type="text" x-model="formData.id_peserta" maxlength="4"
                                    placeholder="Contoh: A7K2"
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#0053C5]/20 focus:border-[#0053C5] transition font-semibold uppercase"
                                    required>
                                <p x-show="errors.id_peserta" x-text="errors.id_peserta"
                                    class="text-red-500 text-sm mt-2 font-semibold"></p>
                            </div>

                            <!-- Event Selection -->
                            <div>
                                <label class="block text-sm font-bold text-gray-900 mb-3">
                                    Event (Opsional)
                                    <span class="text-xs font-normal text-gray-600 ml-2">(Pilih event yang ingin Anda
                                        review)</span>
                                </label>
                                <select x-model="formData.event_id"
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#0053C5]/20 focus:border-[#0053C5] transition font-semibold">
                                    <option value="">Feedback Umum (Tidak terkait event tertentu)</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->judul }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Rating -->
                            <div>
                                <label class="block text-sm font-bold text-gray-900 mb-3">
                                    Rating *
                                    <span class="text-xs font-normal text-gray-600 ml-2">(Berikan penilaian Anda)</span>
                                </label>
                                <div class="flex items-center gap-8">
                                    <div class="star-rating">
                                        <template x-for="star in 5" :key="star">
                                            <button type="button" x-on:click="formData.rating = star"
                                                x-on:mouseenter="hoverRating = star" x-on:mouseleave="hoverRating = 0"
                                                class="star">
                                                <svg class="w-12 h-12 transition-all"
                                                    x-bind:class="(hoverRating || formData.rating) >= star ? 'text-yellow-500' :
                                                        'text-gray-300'"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </template>
                                    </div>
                                    <div x-show="formData.rating" class="text-3xl font-black text-[#0053C5]">
                                        <span x-text="formData.rating"></span>/5
                                    </div>
                                </div>
                                <p x-show="errors.rating" x-text="errors.rating"
                                    class="text-red-500 text-sm mt-2 font-semibold"></p>
                            </div>

                            <!-- Comment -->
                            <div>
                                <label class="block text-sm font-bold text-gray-900 mb-3">
                                    Komentar/Testimoni *
                                    <span class="text-xs font-normal text-gray-600 ml-2">(Minimal 10 karakter)</span>
                                </label>
                                <textarea x-model="formData.komentar" rows="6" placeholder="Ceritakan pengalaman Anda..."
                                    class="w-full px-6 py-4 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-[#0053C5]/20 focus:border-[#0053C5] transition font-medium resize-none"
                                    required></textarea>
                                <div class="flex justify-between items-center mt-2">
                                    <p x-show="errors.komentar" x-text="errors.komentar"
                                        class="text-red-500 text-sm font-semibold"></p>
                                    <p class="text-sm text-gray-500">
                                        <span x-text="formData.komentar.length"></span> karakter
                                    </p>
                                </div>
                            </div>

                            <!-- Privacy Notice -->
                            <div class="bg-blue-50 border-2 border-[#0053C5]/20 rounded-2xl p-6">
                                <div class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-[#0053C5] flex-shrink-0 mt-1" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="text-sm text-gray-700">
                                        <p class="font-bold mb-2">📝 Catatan Penting:</p>
                                        <ul class="space-y-1 list-disc list-inside">
                                            <li>Feedback Anda akan di-moderasi terlebih dahulu sebelum dipublikasikan
                                            </li>
                                            <li>Mohon berikan komentar yang konstruktif dan sopan</li>
                                            <li>Feedback Anda akan membantu kami meningkatkan kualitas event</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div class="mt-10 relative z-10">
                            <button type="submit" x-bind:disabled="loading"
                                class="w-full text-white px-8 py-5 rounded-2xl font-bold text-lg transition-all transform shadow-xl bg-gradient-to-r from-[#0053C5] to-[#003D91] hover:shadow-2xl hover:scale-105 disabled:bg-gray-400 disabled:cursor-not-allowed disabled:transform-none">
                                <span x-show="!loading" class="flex items-center justify-center gap-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Kirim Feedback
                                </span>
                                <span x-show="loading">Mengirim...</span>
                            </button>
                        </div>
                    </form>

                    <!-- Help Text -->
                    <div class="mt-8 text-center">
                        <p class="text-gray-600 mb-4">
                            💡 <strong>Belum punya ID Peserta?</strong>
                        </p>
                        <a href="{{ route('home') }}#registrasi"
                            class="inline-block bg-[#0053C5] text-white px-8 py-3 rounded-full font-bold hover:bg-[#003D91] transition transform hover:scale-105">
                            Daftar Sebagai Peserta →
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Why Feedback Matters -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-black text-gray-900 mb-4">
                    Kenapa Feedback Anda <span class="gradient-text">Penting?</span>
                </h2>
                <p class="text-gray-600 text-lg">Kontribusi Anda membuat Al Azhar Expo semakin baik</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $benefits = [
                        [
                            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                            'title' => 'Meningkatkan Kualitas',
                            'desc' => 'Masukan Anda membantu kami mengidentifikasi area yang perlu ditingkatkan',
                            'color' => 'from-[#0053C5] to-[#003D91]',
                        ],
                        [
                            'icon' =>
                                'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                            'title' => 'Membantu Jamaah Lain',
                            'desc' => 'Testimoni Anda membantu jamaah lain dalam memilih event yang tepat',
                            'color' => 'from-[#0053C5] to-[#003D91]',
                        ],
                        [
                            'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                            'title' => 'Inovasi Berkelanjutan',
                            'desc' => 'Feedback konstruktif mendorong kami untuk terus berinovasi',
                            'color' => 'from-[#0053C5] to-[#003D91]',
                        ],
                    ];
                @endphp

                @foreach ($benefits as $benefit)
                    <div class="bg-gray-50 rounded-2xl p-8 text-center hover:shadow-xl transition">
                        <div
                            class="w-16 h-16 bg-gradient-to-br {{ $benefit['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $benefit['icon'] }}"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $benefit['title'] }}</h3>
                        <p class="text-gray-600">{{ $benefit['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black mb-4">Jelajahi Lebih Lanjut</h2>
            <p class="text-xl text-white/90 mb-8">
                Lihat event menarik lainnya dan dokumentasi Al Azhar Expo 2025
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('portal.events') }}"
                    class="inline-block bg-white text-[#0053C5] px-8 py-4 rounded-full font-bold hover:bg-white/90 transition transform hover:scale-105">
                    Lihat Event
                </a>
                <a href="{{ route('portal.gallery') }}"
                    class="inline-block bg-white/10 backdrop-blur-sm text-white px-8 py-4 rounded-full font-bold hover:bg-white/20 transition border-2 border-white/30">
                    Gallery
                </a>
            </div>
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

    <script>
        function feedbackForm() {
            return {
                formData: {
                    id_peserta: '',
                    event_id: '',
                    rating: 0,
                    komentar: ''
                },
                errors: {},
                loading: false,
                success: false,
                hoverRating: 0,

                validateForm() {
                    this.errors = {};

                    if (!this.formData.id_peserta || this.formData.id_peserta.length !== 4) {
                        this.errors.id_peserta = 'ID Peserta harus 4 karakter';
                    }

                    if (!this.formData.rating || this.formData.rating < 1 || this.formData.rating > 5) {
                        this.errors.rating = 'Pilih rating 1-5';
                    }

                    if (!this.formData.komentar || this.formData.komentar.trim().length < 10) {
                        this.errors.komentar = 'Komentar minimal 10 karakter';
                    }

                    return Object.keys(this.errors).length === 0;
                },

                async submitFeedback() {
                    if (!this.validateForm()) {
                        return;
                    }

                    this.loading = true;

                    try {
                        const response = await fetch('{{ route('portal.feedback.submit') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.formData)
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.success = true;
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                        } else {
                            this.errors = data.errors || {};
                            if (data.message) {
                                alert(data.message);
                            }
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    } finally {
                        this.loading = false;
                    }
                },

                resetForm() {
                    this.formData = {
                        id_peserta: '',
                        event_id: '',
                        rating: 0,
                        komentar: ''
                    };
                    this.errors = {};
                    this.hoverRating = 0;
                }
            }
        }
    </script>

</body>

</html>
