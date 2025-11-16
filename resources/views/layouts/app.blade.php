<!DOCTYPE html>
<html lang="id" class="smooth-scroll">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Al Azhar Expo 2025 - Event Registration')</title>
    <meta name="description" content="@yield('description', 'Daftar sekarang untuk mengikuti Al Azhar Expo 2025. Event terbesar untuk pendidikan dan inovasi.')">
    <meta name="keywords" content="Al Azhar, Expo 2025, Event, Registration, Pendidikan, Inovasi">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Al Azhar Expo 2025')">
    <meta property="og:description" content="@yield('description', 'Daftar sekarang untuk mengikuti Al Azhar Expo 2025')">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Al Azhar Expo 2025')">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Styles -->
   <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    
    @stack('styles')
</head>
<body class="antialiased">
    
    <!-- Navigation -->
    @include('components.navbar')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    @stack('scripts')
</body>
</html>