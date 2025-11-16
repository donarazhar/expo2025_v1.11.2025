<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - Al Azhar Expo 2025</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden" x-data="{
        sidebarOpen: false,
        userMenuOpen: false,
        sidebarCollapsed: false,
        contentMenuOpen: {{ request()->routeIs('admin.events.*', 'admin.eventregistrations.*', 'admin.galleries.*', 'admin.live-streams.*', 'admin.faqs.*', 'admin.feedbacks.*') ? 'true' : 'false' }},
        participantsMenuOpen: {{ request()->routeIs('admin.peserta.*', 'admin.absensi.*', 'admin.sertifikat.*') ? 'true' : 'false' }},
        lotteryMenuOpen: {{ request()->routeIs('admin.lottery.*', 'admin.prizes.*') ? 'true' : 'false' }},
        systemMenuOpen: {{ request()->routeIs('admin.activity-logs.*') ? 'true' : 'false' }}
    }">

        <!-- Sidebar Desktop -->
        <aside class="hidden lg:flex lg:flex-shrink-0 transition-all duration-300"
            :class="sidebarCollapsed ? 'lg:w-20' : 'lg:w-64'">
            <div class="flex flex-col w-full bg-[#0053C5] text-white">
                <!-- Logo -->
                <div class="flex items-center justify-between h-20 px-6 border-b border-white/10">
                    <template x-if="!sidebarCollapsed">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                                <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo"
                                    class="h-auto w-auto object-contain">
                            </div>
                            <div>
                                <h1 class="text-lg font-bold">Admin Panel</h1>
                                <p class="text-xs text-white/70">Al Azhar Expo</p>
                            </div>
                        </div>
                    </template>

                    <!-- Logo Collapsed -->
                    <template x-if="sidebarCollapsed">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mx-auto">
                            <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo"
                                class="h-auto w-auto object-contain">
                        </div>
                    </template>

                    <!-- Collapse Button Desktop -->
                    <button @click="sidebarCollapsed = !sidebarCollapsed"
                        class="text-white hover:bg-white/10 p-2 rounded-lg transition-colors"
                        x-show="!sidebarCollapsed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                        :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'"
                        :title="sidebarCollapsed ? 'Dashboard' : ''">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="font-medium" x-show="!sidebarCollapsed">Dashboard</span>
                    </a>

                    <div class="border-t border-white/10 my-4" x-show="!sidebarCollapsed"></div>

                    <!-- Menu Group: Konten & Informasi -->
                    <template x-if="!sidebarCollapsed">
                        <div>
                            <button @click="contentMenuOpen = !contentMenuOpen"
                                class="flex items-center justify-between w-full px-4 py-2 text-xs font-semibold text-white/50 uppercase tracking-wider hover:text-white/70 transition-colors">
                                <span>Konten & Informasi</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': contentMenuOpen }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </template>

                    <!-- Content Menu Items - Expanded View -->
                    <template x-if="!sidebarCollapsed">
                        <div x-show="contentMenuOpen" x-collapse>
                            <a href="{{ route('admin.events.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.events.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="font-medium">Events</span>
                            </a>

                            <a href="{{ route('admin.eventregistrations.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.eventregistrations.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                <span class="font-medium">Event Registrations</span>
                            </a>

                            <a href="{{ route('admin.galleries.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.galleries.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="font-medium">Gallery</span>
                            </a>

                            <a href="{{ route('admin.live-streams.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.live-streams.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="font-medium">Live Streaming</span>
                            </a>

                            <a href="{{ route('admin.faqs.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.faqs.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <span class="font-medium">FAQs</span>
                            </a>

                            <a href="{{ route('admin.feedbacks.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.feedbacks.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                    </path>
                                </svg>
                                <span class="font-medium">Feedbacks</span>
                            </a>
                        </div>
                    </template>

                    <!-- Content Menu Icons - Collapsed View -->
                    <template x-if="sidebarCollapsed">
                        <div class="space-y-2">
                            <a href="{{ route('admin.events.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.events.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="Events">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </a>

                            <a href="{{ route('admin.eventregistrations.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.eventregistrations.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="Event Registrations">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </a>

                            <a href="{{ route('admin.galleries.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.galleries.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="Gallery">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </a>

                            <a href="{{ route('admin.live-streams.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.live-streams.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="Live Streaming">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </a>

                            <a href="{{ route('admin.faqs.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.faqs.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="FAQs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </a>

                            <a href="{{ route('admin.feedbacks.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.feedbacks.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="Feedbacks">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </template>

                    <div class="border-t border-white/10 my-4" x-show="!sidebarCollapsed"></div>

                    <!-- Menu Group: Manajemen Peserta -->
                    <template x-if="!sidebarCollapsed">
                        <div>
                            <button @click="participantsMenuOpen = !participantsMenuOpen"
                                class="flex items-center justify-between w-full px-4 py-2 text-xs font-semibold text-white/50 uppercase tracking-wider hover:text-white/70 transition-colors">
                                <span>Manajemen Peserta</span>
                                <svg class="w-4 h-4 transition-transform"
                                    :class="{ 'rotate-180': participantsMenuOpen }" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </template>

                    <!-- Participants Menu Items - Expanded View -->
                    <template x-if="!sidebarCollapsed">
                        <div x-show="participantsMenuOpen" x-collapse>
                            <a href="{{ route('admin.peserta.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.peserta.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                <span class="font-medium">Peserta</span>
                            </a>

                            <a href="{{ route('admin.absensi.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.absensi.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                                <span class="font-medium">Absensi</span>
                            </a>

                            <a href="{{ route('admin.sertifikat.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.sertifikat.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                    </path>
                                </svg>
                                <span class="font-medium">Sertifikat</span>
                            </a>
                        </div>
                    </template>

                    <!-- Participants Menu Icons - Collapsed View -->
                    <template x-if="sidebarCollapsed">
                        <div class="space-y-2">
                            <a href="{{ route('admin.peserta.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.peserta.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="Peserta">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </a>

                            <a href="{{ route('admin.absensi.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.absensi.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="Absensi">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                            </a>

                            <a href="{{ route('admin.sertifikat.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.sertifikat.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="Sertifikat">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 33.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </template>

                    <div class="border-t border-white/10 my-4" x-show="!sidebarCollapsed"></div>

                    <!-- Menu Group: Sistem Doorprize -->
                    <template x-if="!sidebarCollapsed">
                        <div>
                            <button @click="lotteryMenuOpen = !lotteryMenuOpen"
                                class="flex items-center justify-between w-full px-4 py-2 text-xs font-semibold text-white/50 uppercase tracking-wider hover:text-white/70 transition-colors">
                                <span>Sistem Doorprize</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': lotteryMenuOpen }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </template>

                    <!-- Lottery Menu Items - Expanded View -->
                    <template x-if="!sidebarCollapsed">
                        <div x-show="lotteryMenuOpen" x-collapse>
                            <a href="{{ route('admin.lottery.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.lottery.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                                    </path>
                                </svg>
                                <span class="font-medium">Doorprize</span>
                            </a>

                            <a href="{{ route('admin.prizes.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.prizes.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <span class="font-medium">Hadiah</span>
                            </a>
                        </div>
                    </template>

                    <!-- Lottery Menu Icons - Collapsed View -->
                    <template x-if="sidebarCollapsed">
                        <div class="space-y-2">
                            <a href="{{ route('admin.lottery.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.lottery.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="Doorprize">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                                    </path>
                                </svg>
                            </a>

                            <a href="{{ route('admin.prizes.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.prizes.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="Hadiah">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </template>

                    <div class="border-t border-white/10 my-4" x-show="!sidebarCollapsed"></div>

                    <!-- Menu Group: Sistem & Utilitas -->
                    <template x-if="!sidebarCollapsed">
                        <div>
                            <button @click="systemMenuOpen = !systemMenuOpen"
                                class="flex items-center justify-between w-full px-4 py-2 text-xs font-semibold text-white/50 uppercase tracking-wider hover:text-white/70 transition-colors">
                                <span>Sistem & Utilitas</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': systemMenuOpen }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </template>

                    <!-- System Menu Items - Expanded View -->
                    <template x-if="!sidebarCollapsed">
                        <div x-show="systemMenuOpen" x-collapse>
                            <a href="{{ route('admin.activity-logs.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.activity-logs.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium">Activity Logs</span>
                            </a>

                            <a href="{{ route('home') }}" target="_blank"
                                class="flex items-center px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition-colors space-x-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                                <span class="font-medium">Lihat Website</span>
                            </a>
                        </div>
                    </template>

                    <!-- System Menu Icons - Collapsed View -->
                    <template x-if="sidebarCollapsed">
                        <div class="space-y-2">
                            <a href="{{ route('admin.activity-logs.index') }}"
                                class="flex items-center justify-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.activity-logs.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors"
                                title="Activity Logs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </a>

                            <a href="{{ route('home') }}" target="_blank"
                                class="flex items-center justify-center px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition-colors"
                                title="Lihat Website">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </template>
                </nav>

                <!-- Logout Button at Bottom -->
                <div class="p-4 border-t border-white/10">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center px-4 py-3 rounded-lg w-full text-white/70 hover:bg-red-600/20 hover:text-red-200 transition-colors"
                            :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'"
                            :title="sidebarCollapsed ? 'Logout' : ''">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span class="font-medium" x-show="!sidebarCollapsed">Logout</span>
                        </button>
                    </form>

                    <!-- Expand Button when Collapsed -->
                    <button @click="sidebarCollapsed = false" x-show="sidebarCollapsed" x-cloak
                        class="flex items-center justify-center w-full mt-2 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition-colors"
                        title="Expand Sidebar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Sidebar Mobile Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"></div>

        <!-- Sidebar Mobile -->
        <aside x-show="sidebarOpen" x-cloak x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0053C5] text-white lg:hidden flex flex-col">

            <!-- Logo -->
            <div class="flex items-center justify-between h-20 px-6 border-b border-white/10">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo"
                            class="h-auto w-auto object-contain">
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">Admin Panel</h1>
                        <p class="text-xs text-white/70">Al Azhar Expo</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="text-white hover:bg-white/10 p-2 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Navigation Mobile -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <div class="border-t border-white/10 my-4"></div>

                <!-- Menu Group: Konten & Informasi -->
                <div>
                    <button @click="contentMenuOpen = !contentMenuOpen"
                        class="flex items-center justify-between w-full px-4 py-2 text-xs font-semibold text-white/50 uppercase tracking-wider hover:text-white/70 transition-colors">
                        <span>Konten & Informasi</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': contentMenuOpen }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                </div>

                <div x-show="contentMenuOpen" x-collapse class="space-y-1">
                    <a href="{{ route('admin.events.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.events.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="font-medium">Events</span>
                    </a>

                    <a href="{{ route('admin.eventregistrations.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.eventregistrations.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                        <span class="font-medium">Event Registrations</span>
                    </a>

                    <a href="{{ route('admin.galleries.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.galleries.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="font-medium">Gallery</span>
                    </a>

                    <a href="{{ route('admin.live-streams.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.live-streams.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="font-medium">Live Streaming</span>
                    </a>

                    <a href="{{ route('admin.faqs.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.faqs.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span class="font-medium">FAQs</span>
                    </a>

                    <a href="{{ route('admin.feedbacks.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.feedbacks.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                            </path>
                        </svg>
                        <span class="font-medium">Feedbacks</span>
                    </a>
                </div>

                <div class="border-t border-white/10 my-4"></div>

                <!-- Menu Group: Manajemen Peserta -->
                <div>
                    <button @click="participantsMenuOpen = !participantsMenuOpen"
                        class="flex items-center justify-between w-full px-4 py-2 text-xs font-semibold text-white/50 uppercase tracking-wider hover:text-white/70 transition-colors">
                        <span>Manajemen Peserta</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': participantsMenuOpen }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                </div>

                <div x-show="participantsMenuOpen" x-collapse class="space-y-1">
                    <a href="{{ route('admin.peserta.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.peserta.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        <span class="font-medium">Peserta</span>
                    </a>

                    <a href="{{ route('admin.absensi.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.absensi.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                            </path>
                        </svg>
                        <span class="font-medium">Absensi</span>
                    </a>

                    <a href="{{ route('admin.sertifikat.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.sertifikat.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                            </path>
                        </svg>
                        <span class="font-medium">Sertifikat</span>
                    </a>
                </div>

                <div class="border-t border-white/10 my-4"></div>

                <!-- Menu Group: Sistem Doorprize -->
                <div>
                    <button @click="lotteryMenuOpen = !lotteryMenuOpen"
                        class="flex items-center justify-between w-full px-4 py-2 text-xs font-semibold text-white/50 uppercase tracking-wider hover:text-white/70 transition-colors">
                        <span>Sistem Doorprize</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': lotteryMenuOpen }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                </div>

                <div x-show="lotteryMenuOpen" x-collapse class="space-y-1">
                    <a href="{{ route('admin.lottery.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.lottery.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                            </path>
                        </svg>
                        <span class="font-medium">Doorprize</span>
                    </a>

                    <a href="{{ route('admin.prizes.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.prizes.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <span class="font-medium">Hadiah</span>
                    </a>
                </div>

                <div class="border-t border-white/10 my-4"></div>

                <!-- Menu Group: Sistem & Utilitas -->
                <div>
                    <button @click="systemMenuOpen = !systemMenuOpen"
                        class="flex items-center justify-between w-full px-4 py-2 text-xs font-semibold text-white/50 uppercase tracking-wider hover:text-white/70 transition-colors">
                        <span>Sistem & Utilitas</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': systemMenuOpen }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                </div>

                <div x-show="systemMenuOpen" x-collapse class="space-y-1">
                    <a href="{{ route('admin.activity-logs.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.activity-logs.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">Activity Logs</span>
                    </a>

                    <a href="{{ route('home') }}" target="_blank"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        <span class="font-medium">Lihat Website</span>
                    </a>
                </div>
            </nav>

            <!-- Logout Button Mobile -->
            <div class="p-4 border-t border-white/10">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg w-full text-white/70 hover:bg-red-600/20 hover:text-red-200 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Navbar -->
            <header class="bg-white border-b border-gray-200 h-20 flex items-center justify-between px-4 lg:px-6">

                <!-- Mobile Menu Button & Title -->
                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="lg:hidden text-gray-600 hover:text-gray-900 p-2 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <div>
                        <h2 class="text-xl lg:text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-xs lg:text-sm text-gray-600 hidden md:block">@yield('page-subtitle', 'Overview dan statistik')</p>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-2 lg:space-x-4">

                    <!-- Notifications -->
                    <button
                        class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- User Dropdown -->
                    <div class="relative" @click.away="userMenuOpen = false">
                        <button @click="userMenuOpen = !userMenuOpen"
                            class="flex items-center space-x-2 lg:space-x-3 p-2 hover:bg-gray-100 rounded-lg transition-colors">
                            <div
                                class="w-8 h-8 lg:w-10 lg:h-10 bg-[#0053C5] rounded-lg flex items-center justify-center text-white font-bold text-sm lg:text-base">
                                {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                            </div>
                            <div class="hidden lg:block text-left">
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ Auth::guard('admin')->user()->name }}</p>
                                <p class="text-xs text-gray-600">{{ ucfirst(Auth::guard('admin')->user()->role) }}</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-600 hidden lg:block transition-transform"
                                :class="{ 'rotate-180': userMenuOpen }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="userMenuOpen" x-cloak x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50">

                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ Auth::guard('admin')->user()->name }}</p>
                                <p class="text-xs text-gray-600 truncate">{{ Auth::guard('admin')->user()->email }}
                                </p>
                            </div>

                            <a href="#"
                                class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Profile</span>
                            </a>

                            <a href="#"
                                class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Settings</span>
                            </a>

                            <div class="border-t border-gray-200 my-2"></div>

                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center space-x-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full text-left transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100 p-4 lg:p-6">

                @if (session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg" x-data="{ show: true }"
                        x-show="show">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-green-800 font-medium text-sm lg:text-base">{{ session('success') }}
                                </p>
                            </div>
                            <button @click="show = false" class="text-green-500 hover:text-green-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg" x-data="{ show: true }"
                        x-show="show">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-red-800 font-medium text-sm lg:text-base">{{ session('error') }}</p>
                            </div>
                            <button @click="show = false" class="text-red-500 hover:text-red-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')
</body>

</html>
