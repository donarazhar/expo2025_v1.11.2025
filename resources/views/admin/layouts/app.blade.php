<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin Dashboard') - Al Azhar Expo 2025</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100" x-data="{ sidebarOpen: false, userMenuOpen: false }">
    
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Desktop -->
        <aside class="hidden lg:flex lg:flex-shrink-0 lg:w-64">
            <div class="flex flex-col w-full bg-[#0053C5] text-white">
                <!-- Logo -->
                <div class="flex items-center h-20 px-6 border-b border-white/10">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <span class="text-[#0053C5] font-bold text-lg">AZ</span>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold">Admin Panel</h1>
                            <p class="text-xs text-white/70">Al Azhar Expo</p>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <a href="{{ route('admin.peserta.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.peserta.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="font-medium">Peserta</span>
                    </a>
                    
                    <a href="{{ route('admin.absensi.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.absensi.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <span class="font-medium">Absensi</span>
                    </a>
                    
                    <a href="{{ route('admin.sertifikat.index') }}" 
                       class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.sertifikat.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        <span class="font-medium">Sertifikat</span>
                    </a>
                    
                    <div class="border-t border-white/10 my-4"></div>
                    
                    <a href="{{ route('home') }}" 
                       target="_blank"
                       class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        <span class="font-medium">Lihat Website</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Sidebar Mobile Overlay -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false"
             style="display: none;"
             class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"></div>

        <!-- Sidebar Mobile -->
        <aside x-show="sidebarOpen" 
               style="display: none;"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0053C5] text-white lg:hidden">
            
            <!-- Logo -->
            <div class="flex items-center justify-between h-20 px-6 border-b border-white/10">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                        <span class="text-[#0053C5] font-bold text-lg">AZ</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">Admin Panel</h1>
                        <p class="text-xs text-white/70">Al Azhar Expo</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="text-white hover:bg-white/10 p-2 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Navigation -->
            <nav class="px-4 py-6 space-y-2 overflow-y-auto h-[calc(100vh-5rem)]">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.peserta.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.peserta.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span class="font-medium">Peserta</span>
                </a>
                
                <a href="{{ route('admin.absensi.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.absensi.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span class="font-medium">Absensi</span>
                </a>
                
                <a href="{{ route('admin.sertifikat.index') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.sertifikat.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    <span class="font-medium">Sertifikat</span>
                </a>
                
                <div class="border-t border-white/10 my-4"></div>
                
                <a href="{{ route('home') }}" 
                   target="_blank"
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span class="font-medium">Lihat Website</span>
                </a>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Navbar -->
            <header class="bg-white border-b border-gray-200 h-20 flex items-center justify-between px-4 lg:px-6">
                
                <!-- Mobile Menu Button & Title -->
                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-600 hover:text-gray-900 p-2 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
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
                    <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    
                    <!-- User Dropdown -->
                    <div class="relative" @click.away="userMenuOpen = false">
                        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-2 lg:space-x-3 p-2 hover:bg-gray-100 rounded-lg transition-colors">
                            <div class="w-8 h-8 lg:w-10 lg:h-10 bg-[#0053C5] rounded-lg flex items-center justify-center text-white font-bold text-sm lg:text-base">
                                {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                            </div>
                            <div class="hidden lg:block text-left">
                                <p class="text-sm font-semibold text-gray-800">{{ Auth::guard('admin')->user()->name }}</p>
                                <p class="text-xs text-gray-600">{{ ucfirst(Auth::guard('admin')->user()->role) }}</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-600 hidden lg:block transition-transform" :class="{ 'rotate-180': userMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="userMenuOpen" 
                             style="display: none;"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50">
                            
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-semibold text-gray-800">{{ Auth::guard('admin')->user()->name }}</p>
                                <p class="text-xs text-gray-600 truncate">{{ Auth::guard('admin')->user()->email }}</p>
                            </div>
                            
                            <a href="#" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Profile</span>
                            </a>
                            
                            <a href="#" class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Settings</span>
                            </a>
                            
                            <div class="border-t border-gray-200 my-2"></div>
                            
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center space-x-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full text-left transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
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
                
                @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg" x-data="{ show: true }" x-show="show">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-green-800 font-medium text-sm lg:text-base">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="text-green-500 hover:text-green-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg" x-data="{ show: true }" x-show="show">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-red-800 font-medium text-sm lg:text-base">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="text-red-500 hover:text-red-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
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