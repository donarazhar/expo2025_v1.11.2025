<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cari ID Peserta - {{ config('app.name') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .bg-azhar-blue {
            background-color: #0053C5;
        }

        .text-azhar-blue {
            color: #0053C5;
        }

        .border-azhar-blue {
            border-color: #0053C5;
        }

        .hover\:bg-azhar-blue-dark:hover {
            background-color: #003D99;
        }

        .focus\:ring-azhar-blue:focus {
            --tw-ring-color: #0053C5;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-gray-50 min-h-screen">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full">

            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('portal.events') }}"
                    class="inline-flex items-center text-azhar-blue hover:text-blue-700 font-semibold text-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

                <!-- Header -->
                <div class="bg-azhar-blue p-8 text-white text-center">
                    <div
                        class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black mb-2">Cari ID Peserta</h2>
                    <p class="text-blue-100 text-sm">Masukkan email yang terdaftar</p>
                </div>

                <!-- Content -->
                <div class="p-8">

                    <!-- Success Alert -->
                    @if (session('success') && session('peserta'))
                        <div class="bg-green-50 border-2 border-green-200 rounded-xl p-6 mb-6" x-data="{ show: true }"
                            x-show="show" x-transition>
                            <div class="flex items-start justify-between gap-3 mb-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-green-900">ID Ditemukan!</h4>
                                        <p class="text-xs text-green-700">Simpan ID ini untuk login</p>
                                    </div>
                                </div>
                                <button @click="show = false" class="text-green-500 hover:text-green-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- ID Peserta Card -->
                            <div
                                class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border-2 border-azhar-blue mb-4">
                                <p class="text-xs text-azhar-blue font-bold mb-2 uppercase tracking-wide">ID Peserta
                                    Anda</p>
                                <div class="flex items-center justify-between gap-3 mb-4">
                                    <p class="text-4xl font-black text-azhar-blue">{{ session('peserta')->id_peserta }}
                                    </p>
                                    <button onclick="copyToClipboard('{{ session('peserta')->id_peserta }}')"
                                        class="px-4 py-2 bg-azhar-blue text-white rounded-lg hover:bg-azhar-blue-dark transition-colors text-sm font-bold flex items-center gap-2 shadow-md">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Salin
                                    </button>
                                </div>

                                <!-- Info -->
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between items-center py-2 border-t border-blue-200">
                                        <span class="text-gray-600">Nama:</span>
                                        <span
                                            class="font-bold text-gray-900">{{ session('peserta')->nama_lengkap }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-t border-blue-200">
                                        <span class="text-gray-600">Email:</span>
                                        <span class="font-bold text-gray-900">{{ session('peserta')->email }}</span>
                                    </div>
                                    @if (session('peserta')->no_hp)
                                        <div class="flex justify-between items-center py-2 border-t border-blue-200">
                                            <span class="text-gray-600">HP:</span>
                                            <span class="font-bold text-gray-900">{{ session('peserta')->no_hp }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Button -->
                            <a href="{{ route('portal.events') }}"
                                class="w-full bg-azhar-blue text-white py-3 rounded-lg hover:bg-azhar-blue-dark transition-colors font-bold text-center inline-flex items-center justify-center gap-2 shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Lihat Event
                            </a>
                        </div>
                    @endif

                    <!-- Error Alert -->
                    @if (session('error'))
                        <div class="bg-red-50 border-2 border-red-200 rounded-lg p-4 mb-6 flex items-start gap-3"
                            x-data="{ show: true }" x-show="show" x-transition>
                            <div
                                class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-red-900 text-sm">{{ session('error') }}</h4>
                            </div>
                            <button @click="show = false" class="text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('portal.forgot-id.search') }}" class="space-y-6">
                        @csrf

                        <!-- Email Input -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                        </path>
                                    </svg>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    required autocomplete="email" autofocus
                                    class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-azhar-blue focus:border-azhar-blue transition-all font-medium @error('email') border-red-500 @enderror"
                                    placeholder="nama@email.com">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-azhar-blue text-white py-3.5 rounded-lg hover:bg-azhar-blue-dark transition-all font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari ID Peserta
                        </button>
                    </form>

                    <!-- Info Box -->
                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-azhar-blue flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-xs text-gray-700">
                                <p class="font-semibold mb-1">Belum punya ID?</p>
                                <p>Daftar sebagai peserta di <a href="{{ route('home') }}#registrasi"
                                        class="text-azhar-blue font-bold hover:underline">halaman registrasi</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">
                    Butuh bantuan?
                    <a href="mailto:support@al-azhar.or.id" class="text-azhar-blue hover:underline font-semibold">
                        Hubungi kami
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Copy to clipboard function
        function copyToClipboard(text) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    showToast('✓ ID berhasil disalin!', 'success');
                });
            } else {
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = text;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                    showToast('✓ ID berhasil disalin!', 'success');
                } catch (err) {
                    console.error('Failed to copy:', err);
                    showToast('✗ Gagal menyalin ID', 'error');
                }
                textArea.remove();
            }
        }

        // Show toast notification
        function showToast(message, type = 'success') {
            const bgColor = type === 'success' ? '#0053C5' : '#EF4444';

            const toast = document.createElement('div');
            toast.className =
                'fixed bottom-4 right-4 text-white px-6 py-3 rounded-lg shadow-2xl flex items-center gap-2 z-50 animate-fade-in-up';
            toast.style.backgroundColor = bgColor;
            toast.innerHTML = `
                <span class="font-semibold">${message}</span>
            `;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'fade-out 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Add animation styles
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fade-in-up {
                from {
                    opacity: 0;
                    transform: translateY(1rem);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            @keyframes fade-out {
                from {
                    opacity: 1;
                    transform: translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateY(1rem);
                }
            }
            .animate-fade-in-up {
                animation: fade-in-up 0.3s ease-out;
            }
        `;
        document.head.appendChild(style);
    </script>

</body>

</html>
