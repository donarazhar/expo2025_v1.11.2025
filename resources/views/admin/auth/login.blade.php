<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - Al Azhar Expo 2025</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-br from-azhar-blue via-azhar-blue-600 to-azhar-blue-700 min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-xl mb-4">
                <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo" class="h-10 w-auto object-contain">
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Admin Panel</h1>
            <p class="text-azhar-blue-100">Al Azhar Expo 2025</p>
        </div>
        
        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang!</h2>
            <p class="text-gray-600 mb-6">Silakan login untuk melanjutkan</p>
            
            <!-- Alerts -->
            @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-green-800 text-sm">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-red-800 text-sm">{{ session('error') }}</p>
                </div>
            </div>
            @endif
            
            <!-- Login Form -->
            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="w-full pl-10 pr-4 py-3 border-2 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors"
                            placeholder="admin@alazharexpo.com"
                            required>
                    </div>
                    @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full pl-10 pr-4 py-3 border-2 {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors"
                            placeholder="••••••••"
                            required>
                    </div>
                    @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            class="w-4 h-4 text-azhar-blue-500 border-gray-300 rounded focus:ring-azhar-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Ingat saya</span>
                    </label>
                    <a href="#" class="text-sm text-azhar-blue-500 hover:text-azhar-blue-600 font-medium">
                        Lupa password?
                    </a>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-azhar-blue-500 text-white py-3 px-4 rounded-lg font-semibold hover:bg-azhar-blue-600 focus:outline-none focus:ring-4 focus:ring-azhar-blue-200 transition-all duration-200 transform hover:-translate-y-0.5">
                    Login
                </button>
            </form>
            
            <!-- Divider -->
            <div class="mt-6 flex items-center">
                <div class="flex-1 border-t border-gray-300"></div>
                <span class="px-4 text-sm text-gray-500">atau</span>
                <div class="flex-1 border-t border-gray-300"></div>
            </div>
            
            <!-- Back to Website -->
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-azhar-blue-500 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Website
                </a>
            </div>
        </div>
        
        <!-- Footer Info -->
        <div class="mt-6 text-center text-azhar-blue-100 text-sm">
            <p>© 2025 Al Azhar Expo. All rights reserved.</p>
            <p class="mt-2">Default credentials: admin@alazharexpo.com / password</p>
        </div>
    </div>
    
</body>
</html>