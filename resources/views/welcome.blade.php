@extends('layouts.app')

@section('title', 'Al Azhar Expo 2025')
@section('description',
    'Sinergi Pendidikan, Dakwah, dan Sosial: Beradab dalam Kemodernan, Siap Menjawab Tantangan Masa
    Depan')

@section('content')

    <!-- Hero Section -->
    <section id="hero"
        class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0053C5] via-[#003D91] to-[#002961] overflow-hidden pt-20">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <div class="section-container relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-white space-y-6">
                    <div class="inline-block">
                        <span class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold">
                            🎓 4-6 Desember 2025
                        </span>
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                        Al Azhar Expo 2025
                    </h1>

                    <div class="text-2xl md:text-3xl font-semibold text-white">
                        Al Azhar Inspirasi Bangsa
                    </div>

                    <p class="text-xl text-white/90 leading-relaxed">
                        Sinergi Pendidikan, Dakwah, dan Sosial:<br>
                        <span class="font-semibold">Beradab dalam Kemodernan,<br>Siap Menjawab Tantangan Masa Depan</span>
                    </p>

                    <div class="flex items-center space-x-4 text-white/90">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Masjid Agung Al Azhar, Jakarta</span>
                    </div>

                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="#register"
                            class="bg-white text-[#0053C5] px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-xl">
                            Daftar Sekarang
                        </a>
                        <a href="#tentang"
                            class="bg-white/20 backdrop-blur-sm text-white px-8 py-4 rounded-lg font-semibold hover:bg-white/30 transition-all duration-300 border-2 border-white/50">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <!-- Right Content - Image Placeholder -->
                <div class="hidden lg:block">
                    <div class="relative">
                        <div
                            class="w-full h-96 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center border-4 border-white/20">
                            <svg class="w-32 h-32 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <!-- Floating Stats -->
                        <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-xl shadow-2xl">
                            <div class="text-[#0053C5] font-bold text-3xl">5,000+</div>
                            <div class="text-gray-600 text-sm">Target Peserta</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Event Info Section -->
    <section class="py-20 bg-gray-50">
        <div class="section-container">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Waktu -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all border-t-4 border-[#0053C5]">
                    <div class="w-16 h-16 bg-[#0053C5]/10 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Waktu Pelaksanaan</h3>
                    <p class="text-gray-600">Kamis - Sabtu</p>
                    <p class="text-2xl font-bold text-[#0053C5] mt-2">4-6 Desember 2025</p>
                </div>

                <!-- Tempat -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all border-t-4 border-[#0053C5]">
                    <div class="w-16 h-16 bg-[#0053C5]/10 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Lokasi Event</h3>
                    <p class="text-gray-600">Masjid Agung Al Azhar</p>
                    <p class="text-sm text-gray-500 mt-2">Aula, Kelas, dan Lapangan Hijau</p>
                </div>

                <!-- Tema -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all border-t-4 border-[#0053C5]">
                    <div class="w-16 h-16 bg-[#0053C5]/10 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tema Event</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Sinergi Pendidikan, Dakwah, dan Sosial: Beradab dalam
                        Kemodernan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Event Section -->
    <section id="tentang" class="py-20 bg-white">
        <div class="section-container">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Tentang Al Azhar Expo 2025</h2>
                <div class="w-24 h-1 bg-[#0053C5] mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Event kolaboratif yang menggabungkan pameran karya, talkshow nasional, lomba, dan kegiatan khusus untuk
                    menginspirasi bangsa
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h3 class="text-3xl font-bold text-[#0053C5] mb-6">Visi YPI Al Azhar</h3>
                    <div class="bg-[#0053C5]/5 p-8 rounded-xl border-l-4 border-[#0053C5]">
                        <p class="text-lg text-gray-700 leading-relaxed italic">
                            "Menjadi lembaga pendidikan Islam terkemuka yang menghasilkan generasi berakhlak mulia,
                            berprestasi, dan berwawasan global"
                        </p>
                    </div>
                </div>

                <div>
                    <h3 class="text-3xl font-bold text-[#0053C5] mb-6">Misi YPI Al Azhar</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div
                                class="w-8 h-8 bg-[#0053C5] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white font-bold text-sm">1</span>
                            </div>
                            <p class="ml-4 text-gray-700">Menyelenggarakan pendidikan berkualitas berbasis nilai-nilai
                                Islam</p>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="w-8 h-8 bg-[#0053C5] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white font-bold text-sm">2</span>
                            </div>
                            <p class="ml-4 text-gray-700">Mengembangkan potensi peserta didik secara holistik</p>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="w-8 h-8 bg-[#0053C5] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white font-bold text-sm">3</span>
                            </div>
                            <p class="ml-4 text-gray-700">Membangun karakter Islami yang kuat dan beradab</p>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="w-8 h-8 bg-[#0053C5] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white font-bold text-sm">4</span>
                            </div>
                            <p class="ml-4 text-gray-700">Menjalin kerjasama dengan berbagai pihak untuk kemajuan
                                pendidikan</p>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="w-8 h-8 bg-[#0053C5] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-white font-bold text-sm">5</span>
                            </div>
                            <p class="ml-4 text-gray-700">Memberikan kontribusi nyata bagi masyarakat dan bangsa</p>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Maksud dan Tujuan -->
            <div class="bg-gradient-to-br from-[#0053C5] to-[#003D91] rounded-2xl p-12 text-white">
                <h3 class="text-3xl font-bold mb-8 text-center">Maksud dan Tujuan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/20">
                        <div class="text-4xl mb-3">🤝</div>
                        <h4 class="font-bold text-lg mb-2">Silaturahmi & Kolaborasi</h4>
                        <p class="text-white/80 text-sm">Menjadi ajang silaturahmi dan kolaborasi seluruh unit Al Azhar</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/20">
                        <div class="text-4xl mb-3">🌐</div>
                        <h4 class="font-bold text-lg mb-2">Sinergi Eksternal</h4>
                        <p class="text-white/80 text-sm">Meningkatkan sinergi dengan mitra eksternal, pemerintah, dan
                            masyarakat</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/20">
                        <div class="text-4xl mb-3">🎨</div>
                        <h4 class="font-bold text-lg mb-2">Pameran Karya</h4>
                        <p class="text-white/80 text-sm">Memamerkan karya pendidikan, dakwah, dan sosial Al Azhar</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/20">
                        <div class="text-4xl mb-3">💡</div>
                        <h4 class="font-bold text-lg mb-2">Inspirasi Masyarakat</h4>
                        <p class="text-white/80 text-sm">Memberikan inspirasi melalui gagasan, inovasi, dan kreasi</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/20">
                        <div class="text-4xl mb-3">💰</div>
                        <h4 class="font-bold text-lg mb-2">Program Fundraising</h4>
                        <p class="text-white/80 text-sm">Menguatkan program fundraising untuk agenda pendidikan dan sosial
                        </p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border border-white/20">
                        <div class="text-4xl mb-3">🏆</div>
                        <h4 class="font-bold text-lg mb-2">Apresiasi & Award</h4>
                        <p class="text-white/80 text-sm">Memberikan penghargaan kepada kontributor Al Azhar</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bentuk Kegiatan Section -->
    <section id="kegiatan" class="py-20 bg-gray-50">
        <div class="section-container">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Bentuk Kegiatan</h2>
                <div class="w-24 h-1 bg-[#0053C5] mx-auto mb-6"></div>
                <p class="text-xl text-gray-600">4 kategori kegiatan utama yang akan mengisi Al Azhar Expo 2025</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Pameran dan Stand -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all group">
                    <div class="bg-[#0053C5] p-6">
                        <div class="flex items-center">
                            <div
                                class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white">Pameran & Stand</h3>
                        </div>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Karya siswa dari berbagai jenjang</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Display lembaga dan unit Al Azhar</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Bazar produk unggulan Al Azhar</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Stand mitra dan sponsor</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Talkshow Nasional -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all group">
                    <div class="bg-[#0053C5] p-6">
                        <div class="flex items-center">
                            <div
                                class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white">Talkshow Nasional</h3>
                        </div>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700"><strong>Pendidikan & Adab:</strong> Membentuk generasi
                                    berakhlak</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700"><strong>Ekonomi Keumatan & Wakaf:</strong> Pemberdayaan
                                    ekonomi</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700"><strong>Peran Masjid:</strong> Masjid sebagai pusat
                                    peradaban</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700"><strong>Digital Expo:</strong> Teknologi di era modern</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Lomba dan Festival -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all group">
                    <div class="bg-[#0053C5] p-6">
                        <div class="flex items-center">
                            <div
                                class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white">Lomba & Festival</h3>
                        </div>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Lomba Robotik & Coding</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Islamic Fashion Show</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Pentas Seni & Performance</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Rampak Gendang Tradisional</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Kegiatan Khusus -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all group">
                    <div class="bg-[#0053C5] p-6">
                        <div class="flex items-center">
                            <div
                                class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white">Kegiatan Khusus</h3>
                        </div>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Pertemuan Jamaah Haji Al Azhar 2018-2025</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Program Literasi "Al Azhar Menulis"</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Fundraising "Gelar Sorban" untuk Palestina</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-700">Penganugerahan Al Azhar Award</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tambahkan ini di <head> atau sebelum </body> -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Jadwal Section dengan Tabs -->
    <section id="jadwal" class="py-20 bg-white">
        <div class="section-container">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Jadwal Acara</h2>
                <div class="w-24 h-1 bg-[#0053C5] mx-auto mb-6"></div>
                <p class="text-xl text-gray-600">Program lengkap selama 3 hari event</p>
            </div>

            <!-- Tabs -->
            <div x-data="{ activeDay: 1 }" class="max-w-5xl mx-auto">
                <!-- Tab Headers -->
                <div class="flex flex-wrap justify-center gap-4 mb-12">
                    <template
                        x-for="(tab, index) in [
                    { id: 1, hari: 'Hari 1', tanggal: 'Kamis, 4 Desember' },
                    { id: 2, hari: 'Hari 2', tanggal: 'Jumat, 5 Desember' },
                    { id: 3, hari: 'Hari 3', tanggal: 'Sabtu, 6 Desember' }
                ]"
                        :key="index">
                        <button @click="activeDay = tab.id"
                            :class="activeDay === tab.id ?
                                'bg-[#0053C5] text-white' :
                                'bg-white text-gray-700 hover:bg-gray-50 border-2 border-gray-200'"
                            class="px-8 py-4 rounded-xl font-bold shadow-lg transition-all transform hover:scale-105">
                            <div class="text-sm opacity-75 mb-1" x-text="tab.hari"></div>
                            <div class="text-lg" x-text="tab.tanggal"></div>
                        </button>
                    </template>
                </div>

                <!-- Tab Content -->
                <div class="bg-white rounded-2xl shadow-xl p-8 border-2 border-gray-100 overflow-hidden">

                    <!-- Hari 1 -->
                    <div x-show="activeDay === 1" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 -translate-x-4" class="space-y-6">

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Opening Ceremony</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">08.00 -
                                    09.00</span>
                            </div>
                            <p class="text-gray-600">Pembukaan resmi Al Azhar Expo 2025 oleh Pimpinan YPI Al Azhar</p>
                        </div>

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Pameran & Bazar (All Day)</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">08.00 -
                                    17.00</span>
                            </div>
                            <p class="text-gray-600">Stand pameran karya, bazar produk, dan display lembaga</p>
                        </div>

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Talkshow: Pendidikan & Adab</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">10.00 -
                                    12.00</span>
                            </div>
                            <p class="text-gray-600">Diskusi tentang pentingnya pendidikan karakter di era digital</p>
                        </div>

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Islamic Fashion Show</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">14.00 -
                                    16.00</span>
                            </div>
                            <p class="text-gray-600">Peragaan busana muslim modern karya desainer dan siswa Al Azhar</p>
                        </div>
                    </div>

                    <!-- Hari 2 -->
                    <div x-show="activeDay === 2" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 -translate-x-4" class="space-y-6">

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Lomba Robotik & Coding</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">08.00 -
                                    12.00</span>
                            </div>
                            <p class="text-gray-600">Kompetisi robotik dan coding untuk siswa berbagai jenjang</p>
                        </div>

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Talkshow: Ekonomi Keumatan</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">13.00 -
                                    15.00</span>
                            </div>
                            <p class="text-gray-600">Pemberdayaan ekonomi umat melalui wakaf produktif</p>
                        </div>

                        <div class="border-l-4 border-[#0053C5] pl-6 py-6 bg-[#0053C5]/5 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3 gap-2">
                                <h4 class="text-xl font-bold text-[#0053C5] flex items-center gap-2">
                                    🌟 Talkshow Special
                                </h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">15.30 -
                                    17.30</span>
                            </div>
                            <p class="text-gray-700 font-semibold mb-2">
                                <span class="text-sm text-gray-600">Narasumber:</span><br>
                                Anies Baswedan & Ustadz Adi Hidayat
                            </p>
                            <p class="text-sm text-gray-600 mt-2 italic">
                                Tema: "Membangun Peradaban di Era Modern"
                            </p>
                        </div>

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Fundraising "Gelar Sorban" Palestina</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">19.00 -
                                    21.00</span>
                            </div>
                            <p class="text-gray-600">Acara penggalangan dana untuk saudara kita di Palestina</p>
                        </div>
                    </div>

                    <!-- Hari 3 -->
                    <div x-show="activeDay === 3" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 -translate-x-4" class="space-y-6">

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Digital Expo & Technology</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">08.00 -
                                    12.00</span>
                            </div>
                            <p class="text-gray-600">Pameran teknologi dan inovasi digital dalam pendidikan</p>
                        </div>

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Rampak Gendang</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">13.00 -
                                    14.00</span>
                            </div>
                            <p class="text-gray-600">Pertunjukan seni tradisional rampak gendang</p>
                        </div>

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Pertemuan Jamaah Haji Al Azhar</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">14.00 -
                                    16.00</span>
                            </div>
                            <p class="text-gray-600">Gathering jamaah haji Al Azhar periode 2018-2025</p>
                        </div>

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Penganugerahan Al Azhar Award</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">16.00 -
                                    17.00</span>
                            </div>
                            <p class="text-gray-600">Penghargaan kepada tokoh dan kontributor Al Azhar</p>
                        </div>

                        <div class="border-l-4 border-[#0053C5] pl-6 py-4 hover:bg-gray-50 rounded-r-lg transition-all">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 gap-2">
                                <h4 class="text-xl font-bold text-gray-800">Closing Ceremony</h4>
                                <span class="text-[#0053C5] font-semibold text-sm md:text-base whitespace-nowrap">17.00 -
                                    18.00</span>
                            </div>
                            <p class="text-gray-600">Penutupan resmi Al Azhar Expo 2025 & foto bersama</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Statistics Section -->
    <section class="py-20 bg-gradient-to-br from-[#0053C5] to-[#003D91]">
        <div class="section-container">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <div>
                    <div class="text-5xl md:text-6xl font-bold mb-2">3</div>
                    <div class="text-xl opacity-90">Hari Event</div>
                </div>
                <div>
                    <div class="text-5xl md:text-6xl font-bold mb-2">5000+</div>
                    <div class="text-xl opacity-90">Peserta</div>
                </div>
                <div>
                    <div class="text-5xl md:text-6xl font-bold mb-2">50+</div>
                    <div class="text-xl opacity-90">Stand Pameran</div>
                </div>
                <div>
                    <div class="text-5xl md:text-6xl font-bold mb-2">20+</div>
                    <div class="text-xl opacity-90">Pembicara</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Section -->
    <section id="register" class="py-20 bg-gray-50">
        <div class="section-container max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Daftar Sekarang!</h2>
                <div class="w-24 h-1 bg-[#0053C5] mx-auto mb-6"></div>
                <p class="text-xl text-gray-600">Bergabunglah dengan ribuan peserta dan dapatkan e-sertifikat digital</p>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl p-12 border-t-4 border-[#0053C5]">
                <form id="registrationForm" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">Nama Lengkap *</label>
                            <input type="text" name="nama_lengkap" required
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0053C5] focus:border-transparent"
                                placeholder="Nama lengkap Anda">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">Email *</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0053C5] focus:border-transparent"
                                placeholder="email@example.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">Nomor HP *</label>
                            <input type="tel" name="no_hp" required
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0053C5] focus:border-transparent"
                                placeholder="08xxxxxxxxxx">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">Asal Instansi *</label>
                            <input type="text" name="asal_instansi" required
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0053C5] focus:border-transparent"
                                placeholder="Nama sekolah/instansi">
                        </div>
                    </div>

                    <div class="bg-[#0053C5]/5 border-l-4 border-[#0053C5] p-4 rounded-lg">
                        <p class="text-sm text-gray-700">
                            ✅ Gratis pendaftaran<br>
                            ✅ E-sertifikat digital<br>
                            ✅ Akses ke semua kegiatan<br>
                            ✅ Doorprize menarik
                        </p>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#0053C5] text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-[#003D91] transform hover:scale-105 transition-all duration-300 shadow-xl">
                        Daftar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Contact & Location -->
    <section class="py-20 bg-white">
        <div class="section-container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Hubungi Kami</h3>
                    <div class="space-y-4">
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                            <svg class="w-6 h-6 text-[#0053C5] mr-4 mt-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <div>
                                <div class="font-semibold text-gray-800">Telepon</div>
                                <div class="text-gray-600">+62 21 7244456</div>
                            </div>
                        </div>
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                            <svg class="w-6 h-6 text-[#0053C5] mr-4 mt-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <div>
                                <div class="font-semibold text-gray-800">Email</div>
                                <div class="text-gray-600">info@alazharexpo.com</div>
                            </div>
                        </div>
                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                            <svg class="w-6 h-6 text-[#0053C5] mr-4 mt-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <div class="font-semibold text-gray-800">Alamat</div>
                                <div class="text-gray-600">Masjid Agung Al Azhar<br>Jl. Sisingamangaraja, Kebayoran
                                    Baru<br>Jakarta Selatan 12110</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Lokasi</h3>
                    <div class="bg-gray-200 h-80 rounded-xl flex items-center justify-center border-2 border-gray-300">
                        <div class="text-center text-gray-600">
                            <svg class="w-16 h-16 mx-auto mb-4 text-[#0053C5]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                </path>
                            </svg>
                            <p class="font-semibold">Peta Google Maps</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        document.getElementById('registrationForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Pendaftaran berhasil! Silakan cek email Anda untuk QR Code.');
                    this.reset();
                } else {
                    alert('Pendaftaran gagal: ' + (result.message || 'Terjadi kesalahan'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
            }
        });
    </script>
@endpush
