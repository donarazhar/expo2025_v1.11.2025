@extends('layouts.app')

@section('title', 'Al Azhar Expo 2025 - Daftar Sekarang')
@section('description', 'Bergabunglah dengan Al Azhar Expo 2025, event pendidikan dan inovasi terbesar tahun ini. Daftar sekarang dan dapatkan sertifikat digital!')

@section('content')

<!-- Hero Section -->
<section id="hero" class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-azhar-blue via-azhar-blue-600 to-azhar-blue-700 overflow-hidden pt-20">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="section-container relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="text-white space-y-6 animate-slide-in-left">
                <div class="inline-block">
                    <span class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold">
                        📅 4-6 Desember 2025
                    </span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                    Al Azhar Expo
                    <span class="block text-azhar-gold">2025</span>
                </h1>
                
                <p class="text-lg md:text-xl text-azhar-blue-50 leading-relaxed mb-2">
                    <strong>Al Azhar Inspirasi Bangsa</strong>
                </p>
                
                <p class="text-base md:text-lg text-azhar-blue-100 leading-relaxed">
                    Momentum kolaborasi seluruh elemen Al Azhar untuk menunjukkan karya, gagasan, dan inovasi yang menginspirasi umat, bangsa, dan negeri melalui sinergi pendidikan, dakwah, dan sosial
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="#daftar" class="bg-white text-azhar-blue px-8 py-4 rounded-azhar font-bold text-lg hover:bg-azhar-blue-50 transition-all duration-300 shadow-azhar-lg hover:shadow-2xl transform hover:-translate-y-1 text-center">
                        Daftar Sekarang
                        <svg class="inline-block ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="#tentang" class="border-2 border-white text-white px-8 py-4 rounded-azhar font-bold text-lg hover:bg-white hover:text-azhar-blue transition-all duration-300 text-center">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 pt-8">
                    <div class="text-center">
                        <div class="counter text-3xl md:text-4xl font-bold" data-target="5000">0</div>
                        <div class="text-sm text-azhar-blue-100 mt-1">Peserta</div>
                    </div>
                    <div class="text-center">
                        <div class="counter text-3xl md:text-4xl font-bold" data-target="50">0</div>
                        <div class="text-sm text-azhar-blue-100 mt-1">Pembicara</div>
                    </div>
                    <div class="text-center">
                        <div class="counter text-3xl md:text-4xl font-bold" data-target="100">0</div>
                        <div class="text-sm text-azhar-blue-100 mt-1">Booth</div>
                    </div>
                </div>
            </div>
            
            <!-- Right Content - Illustration -->
            <div class="animate-slide-in-right hidden lg:block">
                <div class="relative">
                    <div class="absolute inset-0 bg-white/10 backdrop-blur-lg rounded-3xl transform rotate-6"></div>
                    <div class="relative bg-white rounded-3xl p-8 shadow-2xl">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4 p-4 bg-azhar-blue-50 rounded-xl">
                                <div class="w-12 h-12 bg-azhar-blue rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-azhar-blue">Workshop Interaktif</h4>
                                    <p class="text-sm text-gray-600">Belajar langsung dari ahli</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4 p-4 bg-azhar-blue-50 rounded-xl">
                                <div class="w-12 h-12 bg-azhar-blue rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-azhar-blue">Networking</h4>
                                    <p class="text-sm text-gray-600">Bertemu dengan profesional</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4 p-4 bg-azhar-blue-50 rounded-xl">
                                <div class="w-12 h-12 bg-azhar-blue rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-azhar-blue">E-Sertifikat</h4>
                                    <p class="text-sm text-gray-600">Sertifikat digital gratis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#tentang" class="text-white opacity-75 hover:opacity-100 transition-opacity">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </a>
    </div>
</section>

<!-- Why Join Section -->
<section id="tentang" class="section-container bg-white reveal">
    <div class="text-center mb-16">
        <span class="text-azhar-blue font-semibold text-sm uppercase tracking-wider">Mengapa Harus Ikut?</span>
        <h2 class="section-title mt-2">
            Alasan Bergabung dengan <span class="gradient-text">Al Azhar Expo 2025</span>
        </h2>
        <p class="section-subtitle">
            Dapatkan pengalaman berharga yang akan membentuk masa depan Anda
        </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div class="card group hover:scale-105 transition-transform duration-300">
            <div class="w-16 h-16 bg-azhar-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-azhar-blue group-hover:scale-110 transition-all duration-300">
                <svg class="w-8 h-8 text-azhar-blue group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Wawasan Baru</h3>
            <p class="text-gray-600 leading-relaxed">
                Dapatkan perspektif terbaru tentang pendidikan dan teknologi dari para ahli terkemuka di bidangnya.
            </p>
        </div>
        
        <!-- Feature 2 -->
        <div class="card group hover:scale-105 transition-transform duration-300">
            <div class="w-16 h-16 bg-azhar-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-azhar-blue group-hover:scale-110 transition-all duration-300">
                <svg class="w-8 h-8 text-azhar-blue group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Networking Luas</h3>
            <p class="text-gray-600 leading-relaxed">
                Bangun koneksi profesional dengan ribuan peserta dari berbagai institusi pendidikan dan industri.
            </p>
        </div>
        
        <!-- Feature 3 -->
        <div class="card group hover:scale-105 transition-transform duration-300">
            <div class="w-16 h-16 bg-azhar-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-azhar-blue group-hover:scale-110 transition-all duration-300">
                <svg class="w-8 h-8 text-azhar-blue group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Pengalaman Praktis</h3>
            <p class="text-gray-600 leading-relaxed">
                Ikuti workshop hands-on dan demo produk terbaru yang langsung bisa Anda praktikkan.
            </p>
        </div>
        
        <!-- Feature 4 -->
        <div class="card group hover:scale-105 transition-transform duration-300">
            <div class="w-16 h-16 bg-azhar-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-azhar-blue group-hover:scale-110 transition-all duration-300">
                <svg class="w-8 h-8 text-azhar-blue group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Hadiah Menarik</h3>
            <p class="text-gray-600 leading-relaxed">
                Kesempatan memenangkan berbagai doorprize menarik dan kompetisi berhadiah jutaan rupiah.
            </p>
        </div>
        
        <!-- Feature 5 -->
        <div class="card group hover:scale-105 transition-transform duration-300">
            <div class="w-16 h-16 bg-azhar-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-azhar-blue group-hover:scale-110 transition-all duration-300">
                <svg class="w-8 h-8 text-azhar-blue group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Sertifikat Digital</h3>
            <p class="text-gray-600 leading-relaxed">
                Dapatkan e-sertifikat resmi yang dapat digunakan untuk portofolio profesional Anda.
            </p>
        </div>
        
        <!-- Feature 6 -->
        <div class="card group hover:scale-105 transition-transform duration-300">
            <div class="w-16 h-16 bg-azhar-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-azhar-blue group-hover:scale-110 transition-all duration-300">
                <svg class="w-8 h-8 text-azhar-blue group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Gratis 100%</h3>
            <p class="text-gray-600 leading-relaxed">
                Tidak ada biaya pendaftaran! Semua fasilitas dan materi dapat diakses secara gratis untuk semua peserta.
            </p>
        </div>
    </div>
</section>

<!-- Schedule & Location Section -->
<section id="jadwal" class="section-container bg-gradient-to-br from-gray-50 to-azhar-blue-50 reveal">
    <div class="text-center mb-16">
        <span class="text-azhar-blue font-semibold text-sm uppercase tracking-wider">Informasi Event</span>
        <h2 class="section-title mt-2">
            Jadwal & <span class="gradient-text">Lokasi</span>
        </h2>
        <p class="section-subtitle">
            Catat tanggal dan tempat pelaksanaan event agar tidak ketinggalan
        </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
        <!-- Schedule Card -->
        <div class="bg-white rounded-2xl shadow-azhar-lg p-8 space-y-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-azhar-blue rounded-xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Jadwal Event</h3>
                    <p class="text-gray-600">3 Hari Penuh Inspirasi</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <!-- Day 1 -->
                <div class="flex items-start space-x-4 p-4 bg-azhar-blue-50 rounded-xl">
                    <div class="flex-shrink-0 w-12 h-12 bg-azhar-blue text-white rounded-lg flex items-center justify-center font-bold">
                        15
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-900">Hari Pertama - Opening & Keynote</h4>
                        <p class="text-sm text-gray-600 mt-1">Sabtu, 15 Februari 2025</p>
                        <p class="text-sm text-gray-600">08:00 - 17:00 WIB</p>
                        <ul class="mt-2 space-y-1 text-sm text-gray-600">
                            <li>• Pembukaan & Sambutan</li>
                            <li>• Keynote Speech oleh Prof. Dr. Ahmad</li>
                            <li>• Panel Diskusi: Masa Depan Pendidikan</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Day 2 -->
                <div class="flex items-start space-x-4 p-4 bg-azhar-blue-50 rounded-xl">
                    <div class="flex-shrink-0 w-12 h-12 bg-azhar-blue text-white rounded-lg flex items-center justify-center font-bold">
                        16
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-900">Hari Kedua - Workshop & Exhibition</h4>
                        <p class="text-sm text-gray-600 mt-1">Minggu, 16 Februari 2025</p>
                        <p class="text-sm text-gray-600">08:00 - 17:00 WIB</p>
                        <ul class="mt-2 space-y-1 text-sm text-gray-600">
                            <li>• Workshop: AI dalam Pendidikan</li>
                            <li>• Pameran Produk & Inovasi</li>
                            <li>• Networking Session</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Day 3 -->
                <div class="flex items-start space-x-4 p-4 bg-azhar-blue-50 rounded-xl">
                    <div class="flex-shrink-0 w-12 h-12 bg-azhar-blue text-white rounded-lg flex items-center justify-center font-bold">
                        17
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-900">Hari Ketiga - Competition & Closing</h4>
                        <p class="text-sm text-gray-600 mt-1">Senin, 17 Februari 2025</p>
                        <p class="text-sm text-gray-600">08:00 - 16:00 WIB</p>
                        <ul class="mt-2 space-y-1 text-sm text-gray-600">
                            <li>• Kompetisi Inovasi Pendidikan</li>
                            <li>• Pengumuman Pemenang</li>
                            <li>• Penutupan & Pembagian Sertifikat</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Location Card -->
        <div class="bg-white rounded-2xl shadow-azhar-lg p-8 space-y-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-azhar-blue rounded-xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Lokasi Event</h3>
                    <p class="text-gray-600">Mudah Diakses</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="p-6 bg-azhar-blue-50 rounded-xl">
                    <h4 class="font-bold text-gray-900 mb-2">Universitas Al Azhar Indonesia</h4>
                    <p class="text-gray-600 leading-relaxed">
                        Jl. Sisingamangaraja, Kebayoran Baru<br>
                        Jakarta Selatan 12110, DKI Jakarta<br>
                        Indonesia
                    </p>
                    
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-azhar-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            (021) 7279-1315
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-2 text-azhar-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            info@alazharexpo.com
                        </div>
                    </div>
                </div>
                
                <!-- Map -->
                <div class="rounded-xl overflow-hidden shadow-lg">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.9837268324254!2d106.79714131471783!3d-6.265859295471494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1b8e1a1e1e1%3A0x1a1a1a1a1a1a1a1a!2sUniversitas%20Al%20Azhar%20Indonesia!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid" 
                        width="100%" 
                        height="250" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        class="w-full">
                    </iframe>
                </div>
                
                <!-- Transportation -->
                <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded">
                    <p class="text-sm font-semibold text-green-800 mb-1">Akses Transportasi:</p>
                    <p class="text-sm text-green-700">
                        • Stasiun MRT Haji Nawi (15 menit jalan kaki)<br>
                        • Halte TransJakarta Sisingamangaraja<br>
                        • Parkir kendaraan tersedia
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Registration Form Section -->
<section id="daftar" class="section-container bg-white reveal" x-data="registrationForm()">
    <div class="text-center mb-16">
        <span class="text-azhar-blue font-semibold text-sm uppercase tracking-wider">Pendaftaran</span>
        <h2 class="section-title mt-2">
            Daftar <span class="gradient-text">Sekarang</span>
        </h2>
        <p class="section-subtitle">
            Isi formulir di bawah ini untuk mendaftar. Proses pendaftaran hanya memakan waktu 2 menit!
        </p>
    </div>
    
    <div class="max-w-3xl mx-auto">
        <!-- Success Message -->
        <div x-show="success" 
             x-transition
             id="success-message"
             class="mb-8 p-6 bg-green-50 border-2 border-green-500 rounded-azhar">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-green-800 mb-2">Pendaftaran Berhasil! 🎉</h3>
                    <p class="text-green-700 mb-3">
                        Terima kasih telah mendaftar! ID Pendaftaran Anda adalah: <strong x-text="registrationId"></strong>
                    </p>
                    <p class="text-sm text-green-600">
                        Kami telah mengirim email konfirmasi beserta QR Code ke alamat email Anda. 
                        Silakan cek inbox atau folder spam Anda.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Registration Form -->
        <div class="bg-white rounded-2xl shadow-azhar-lg p-8 md:p-10">
            <form @submit.prevent="submitForm" class="space-y-6">
                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nama_lengkap"
                        x-model="formData.nama_lengkap"
                        :class="{ 'border-red-500': errors.nama_lengkap }"
                        class="input-field"
                        placeholder="Masukkan nama lengkap Anda"
                        required>
                    <p x-show="errors.nama_lengkap" class="mt-1 text-sm text-red-500" x-text="errors.nama_lengkap"></p>
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email"
                        x-model="formData.email"
                        :class="{ 'border-red-500': errors.email }"
                        class="input-field"
                        placeholder="nama@email.com"
                        required>
                    <p x-show="errors.email" class="mt-1 text-sm text-red-500" x-text="errors.email"></p>
                </div>
                
                <!-- Nomor HP -->
                <div>
                    <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor Handphone <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="tel" 
                        id="no_hp"
                        x-model="formData.no_hp"
                        :class="{ 'border-red-500': errors.no_hp }"
                        class="input-field"
                        placeholder="081234567890"
                        required>
                    <p x-show="errors.no_hp" class="mt-1 text-sm text-red-500" x-text="errors.no_hp"></p>
                    <p class="mt-1 text-xs text-gray-500">Format: 08xxxxxxxxxx atau +62xxxxxxxxxx</p>
                </div>
                
                <!-- Asal Instansi -->
                <div>
                    <label for="asal_instansi" class="block text-sm font-semibold text-gray-700 mb-2">
                        Asal Instansi/Sekolah/Perusahaan <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="asal_instansi"
                        x-model="formData.asal_instansi"
                        :class="{ 'border-red-500': errors.asal_instansi }"
                        class="input-field"
                        placeholder="Nama instansi/sekolah/perusahaan Anda"
                        required>
                    <p x-show="errors.asal_instansi" class="mt-1 text-sm text-red-500" x-text="errors.asal_instansi"></p>
                </div>
                
                <!-- Terms -->
                <div class="flex items-start space-x-3 p-4 bg-azhar-blue-50 rounded-lg">
                    <input 
                        type="checkbox" 
                        id="terms"
                        class="mt-1 w-4 h-4 text-azhar-blue border-gray-300 rounded focus:ring-azhar-blue"
                        required>
                    <label for="terms" class="text-sm text-gray-700">
                        Saya menyetujui <a href="#" class="text-azhar-blue font-semibold hover:underline">syarat dan ketentuan</a> 
                        serta <a href="#" class="text-azhar-blue font-semibold hover:underline">kebijakan privasi</a> Al Azhar Expo 2025
                    </label>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit"
                    :disabled="loading"
                    :class="{ 'opacity-50 cursor-not-allowed': loading }"
                    class="w-full btn-primary text-lg py-4 flex items-center justify-center space-x-2">
                    <span x-show="!loading">Daftar Sekarang</span>
                    <span x-show="loading" class="flex items-center space-x-2">
                        <span class="spinner w-5 h-5 border-2"></span>
                        <span>Memproses...</span>
                    </span>
                    <svg x-show="!loading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
                
                <p class="text-center text-sm text-gray-500">
                    Dengan mendaftar, Anda akan menerima email konfirmasi beserta QR Code untuk absensi
                </p>
            </form>
        </div>
        
        <!-- Benefits Info -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="flex items-center space-x-3 p-4 bg-azhar-blue-50 rounded-lg">
                <svg class="w-8 h-8 text-azhar-blue flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700">Proses Cepat<br>Hanya 2 Menit</span>
            </div>
            <div class="flex items-center space-x-3 p-4 bg-azhar-blue-50 rounded-lg">
                <svg class="w-8 h-8 text-azhar-blue flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700">Data Aman<br>Terenkripsi</span>
            </div>
            <div class="flex items-center space-x-3 p-4 bg-azhar-blue-50 rounded-lg">
                <svg class="w-8 h-8 text-azhar-blue flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700">Konfirmasi Email<br>Instant</span>
            </div>
        </div>
    </div>
</section>

@endsection