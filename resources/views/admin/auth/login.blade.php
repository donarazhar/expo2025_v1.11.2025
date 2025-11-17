<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - Al Azhar Expo 2025</title>
    @vite(['resources/css/app.css'])

    <style>
        /* Custom animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Gradient background animation */
        .gradient-animate {
            background: linear-gradient(-45deg, #0053C5, #003D99, #002366, #004AAF);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Glass morphism effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Floating shapes */
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 10%;
            animation: float 8s ease-in-out infinite;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            top: 60%;
            right: 15%;
            animation: float 10s ease-in-out infinite reverse;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            bottom: 10%;
            left: 20%;
            animation: float 7s ease-in-out infinite;
        }

        /* Fix for mobile scrolling */
        body {
            min-height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Ensure scrollable on mobile */
        @media (max-width: 1023px) {
            body {
                display: block;
            }

            .mobile-container {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 1rem;
            }
        }
    </style>
</head>

<body class="gradient-animate relative">

    <!-- Floating Background Shapes -->
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    <!-- Main Container -->
    <div class="mobile-container lg:min-h-screen lg:flex lg:items-center lg:justify-center lg:p-4">

        <!-- Content Wrapper -->
        <div class="w-full max-w-6xl relative z-10 animate-fade-in-up py-8 lg:py-0">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

                <!-- Left Side - Logo & Branding (Hidden on Mobile, Visible on Desktop) -->
                <div class="hidden lg:flex flex-col items-center justify-center text-center space-y-6">
                    <div
                        class="inline-flex items-center justify-center w-32 h-32 bg-white rounded-3xl shadow-2xl animate-float">
                        <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo"
                            class="h-16 w-auto object-contain">
                    </div>
                    <div>
                        <h1 class="text-5xl xl:text-6xl font-black text-white mb-4 drop-shadow-lg">Admin Panel</h1>
                        <p class="text-2xl text-white/90 font-semibold">Al Azhar Expo 2025</p>
                        <div class="mt-6 h-1 w-24 bg-white/50 rounded-full mx-auto"></div>
                    </div>
                    <p class="text-white/80 text-lg max-w-md">
                        Sistem manajemen terpadu untuk event, peserta, dan doorprize
                    </p>
                </div>

                <!-- Mobile Logo & Title (Visible on Mobile Only) -->
                <div class="lg:hidden text-center mb-6">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-2xl mb-4 animate-float">
                        <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo"
                            class="h-10 w-auto object-contain">
                    </div>
                    <h1 class="text-3xl font-black text-white mb-2 drop-shadow-lg">Admin Panel</h1>
                    <p class="text-lg text-white/90 font-medium">Al Azhar Expo 2025</p>
                </div>

                <!-- Right Side - Login Form -->
                <div class="w-full max-w-md mx-auto lg:mx-0 px-4 lg:px-0">

                    <!-- Login Card with Glass Effect -->
                    <div class="glass-effect rounded-3xl shadow-2xl p-6 sm:p-8 md:p-10">

                        <!-- Header -->
                        <div class="text-center mb-6 sm:mb-8">
                            <h2 class="text-xl sm:text-2xl md:text-3xl font-black text-gray-800 mb-2">Selamat Datang! 👋
                            </h2>
                            <p class="text-sm sm:text-base text-gray-600">Masuk ke dashboard admin</p>
                        </div>

                        <!-- Alerts -->
                        @if (session('success'))
                            <div
                                class="mb-4 sm:mb-6 bg-green-50 border-l-4 border-green-500 p-3 sm:p-4 rounded-xl shadow-sm">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 sm:w-10 sm:h-10 bg-green-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <p class="text-green-800 text-xs sm:text-sm font-semibold">{{ session('success') }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div
                                class="mb-4 sm:mb-6 bg-red-50 border-l-4 border-red-500 p-3 sm:p-4 rounded-xl shadow-sm">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 sm:w-10 sm:h-10 bg-red-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>
                                    <p class="text-red-800 text-xs sm:text-sm font-semibold">{{ session('error') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4 sm:space-y-5">
                            @csrf

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">
                                    Email Address
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="w-full pl-10 sm:pl-12 pr-4 py-3 sm:py-3.5 text-sm sm:text-base border-2 {{ $errors->has('email') ? 'border-red-500 bg-red-50' : 'border-gray-200 bg-white' }} rounded-xl focus:outline-none focus:border-azhar-blue-500 focus:ring-4 focus:ring-azhar-blue-100 transition-all font-medium"
                                        placeholder="admin@alazharexpo.com" required>
                                </div>
                                @error('email')
                                    <p class="mt-2 text-xs sm:text-sm text-red-600 flex items-center">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="password" id="password" name="password"
                                        class="w-full pl-10 sm:pl-12 pr-4 py-3 sm:py-3.5 text-sm sm:text-base border-2 {{ $errors->has('password') ? 'border-red-500 bg-red-50' : 'border-gray-200 bg-white' }} rounded-xl focus:outline-none focus:border-azhar-blue-500 focus:ring-4 focus:ring-azhar-blue-100 transition-all font-medium"
                                        placeholder="••••••••••" required>
                                </div>
                                @error('password')
                                    <p class="mt-2 text-xs sm:text-sm text-red-600 flex items-center">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" name="remember"
                                        class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-azhar-blue-500 border-gray-300 rounded focus:ring-azhar-blue-500 cursor-pointer">
                                    <span
                                        class="ml-2 text-xs sm:text-sm text-gray-700 group-hover:text-azhar-blue-500 transition-colors">Ingat
                                        saya</span>
                                </label>
                                <a href="#"
                                    class="text-xs sm:text-sm text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold hover:underline transition-all">
                                    Lupa password?
                                </a>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-azhar-blue-500 to-azhar-blue-600 text-white py-3 sm:py-4 px-4 rounded-xl font-bold text-base sm:text-lg hover:from-azhar-blue-600 hover:to-azhar-blue-700 focus:outline-none focus:ring-4 focus:ring-azhar-blue-200 transition-all duration-200 transform hover:-translate-y-1 hover:shadow-2xl flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                <span class="hidden sm:inline">Masuk ke Dashboard</span>
                                <span class="sm:hidden">Login</span>
                            </button>
                        </form>

                        <!-- Divider -->
                        <div class="mt-6 sm:mt-8 flex items-center">
                            <div class="flex-1 border-t-2 border-gray-200"></div>
                            <span class="px-3 sm:px-4 text-xs sm:text-sm text-gray-500 font-semibold">ATAU</span>
                            <div class="flex-1 border-t-2 border-gray-200"></div>
                        </div>

                        <!-- Back to Website Button -->
                        <div class="mt-4 sm:mt-6">
                            <a href="{{ route('home') }}"
                                class="w-full inline-flex items-center justify-center text-gray-700 hover:text-azhar-blue-500 py-2.5 sm:py-3 px-4 text-sm sm:text-base rounded-xl font-semibold hover:bg-gray-50 transition-all border-2 border-gray-200 hover:border-azhar-blue-500 group">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 group-hover:-translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Website
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer Info -->
            <div class="mt-6 sm:mt-8 text-center px-4">
                <p class="text-white/90 text-xs sm:text-sm font-medium drop-shadow-lg">
                    © 2025 Al Azhar Expo. All rights reserved.
                </p>
                <p class="text-white/70 text-xs mt-1 sm:mt-2">
                    Created with ❤️ by Bagian ITTD YPI Al Azhar.
                </p>
            </div>
        </div>
    </div>

</body>

</html>
