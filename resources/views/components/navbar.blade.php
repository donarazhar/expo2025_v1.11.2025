<nav id="navbar" x-data="toggleMobileMenu()" class="fixed w-full z-50 transition-all duration-300 bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="#hero" class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-azhar-blue rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">AZ</span>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-xl font-bold text-azhar-blue">Al Azhar Expo</h1>
                        <p class="text-xs text-gray-600">2025</p>
                    </div>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#hero" class="text-gray-700 hover:text-azhar-blue font-medium transition-colors duration-200">
                    Beranda
                </a>
                <a href="#tentang" class="text-gray-700 hover:text-azhar-blue font-medium transition-colors duration-200">
                    Tentang
                </a>
                <a href="#jadwal" class="text-gray-700 hover:text-azhar-blue font-medium transition-colors duration-200">
                    Jadwal
                </a>
                <a href="#daftar" class="btn-primary">
                    Daftar Sekarang
                </a>
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="toggle()" type="button" class="text-gray-700 hover:text-azhar-blue focus:outline-none">
                    <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="md:hidden bg-white border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#hero" @click="close()" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-azhar-blue hover:bg-azhar-blue-50 transition-colors">
                Beranda
            </a>
            <a href="#tentang" @click="close()" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-azhar-blue hover:bg-azhar-blue-50 transition-colors">
                Tentang
            </a>
            <a href="#jadwal" @click="close()" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-azhar-blue hover:bg-azhar-blue-50 transition-colors">
                Jadwal
            </a>
            <a href="#daftar" @click="close()" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-azhar-blue hover:bg-azhar-blue-600 transition-colors text-center">
                Daftar Sekarang
            </a>
        </div>
    </div>
</nav>