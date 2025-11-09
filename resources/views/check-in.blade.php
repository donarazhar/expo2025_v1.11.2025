<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Check-in - Al Azhar Expo 2025</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #0053C5 0%, #003D91 100%);
        }
        
        .card-shadow {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        
        .input-code {
            width: 70px;
            height: 80px;
            font-size: 36px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }
        
        @@keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    
    <div class="w-full max-w-2xl" x-data="checkInApp()">
        
        <div class="text-center mb-8 fade-in">
            <div class="inline-block bg-white rounded-2xl p-4 mb-4">
                <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo" class="h-16 w-auto">
            </div>
            <h1 class="text-4xl font-black text-white mb-2">AL AZHAR EXPO 2025</h1>
            <p class="text-white/80 text-lg">Check-in Pengunjung</p>
        </div>
        
        <div class="bg-white rounded-3xl p-8 md:p-12 card-shadow">
            
            <div x-show="!verified" x-cloak class="fade-in">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Masukkan ID Peserta</h2>
                    <p class="text-gray-600">ID Anda terdiri dari 4 karakter (huruf & angka)</p>
                </div>
                
                <form @submit.prevent="verifyId" class="mb-6">
                    <div class="flex justify-center gap-3 mb-6">
                        <input type="text" 
                               x-ref="char1"
                               x-model="idChars.char1"
                               @input="handleInput($event, 'char1')"
                               @keydown.backspace="handleBackspace($event, 'char1')"
                               maxlength="1"
                               class="input-code border-4 border-gray-300 rounded-2xl focus:border-[#0053C5] focus:ring-4 focus:ring-[#0053C5]/20 transition-all"
                               autocomplete="off">
                        <input type="text" 
                               x-ref="char2"
                               x-model="idChars.char2"
                               @input="handleInput($event, 'char2')"
                               @keydown.backspace="handleBackspace($event, 'char2')"
                               maxlength="1"
                               class="input-code border-4 border-gray-300 rounded-2xl focus:border-[#0053C5] focus:ring-4 focus:ring-[#0053C5]/20 transition-all"
                               autocomplete="off">
                        <input type="text" 
                               x-ref="char3"
                               x-model="idChars.char3"
                               @input="handleInput($event, 'char3')"
                               @keydown.backspace="handleBackspace($event, 'char3')"
                               maxlength="1"
                               class="input-code border-4 border-gray-300 rounded-2xl focus:border-[#0053C5] focus:ring-4 focus:ring-[#0053C5]/20 transition-all"
                               autocomplete="off">
                        <input type="text" 
                               x-ref="char4"
                               x-model="idChars.char4"
                               @input="handleInput($event, 'char4')"
                               @keydown.backspace="handleBackspace($event, 'char4')"
                               maxlength="1"
                               class="input-code border-4 border-gray-300 rounded-2xl focus:border-[#0053C5] focus:ring-4 focus:ring-[#0053C5]/20 transition-all"
                               autocomplete="off">
                    </div>
                    
                    <p x-show="errorMessage" 
                       x-text="errorMessage" 
                       class="text-red-500 text-center font-semibold mb-4"></p>
                    
                    <button type="submit" 
                            :disabled="loading || !isIdComplete()"
                            class="w-full bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white py-5 rounded-2xl font-bold text-xl hover:shadow-2xl transition-all transform hover:scale-105 disabled:bg-gray-400 disabled:cursor-not-allowed disabled:transform-none">
                        <span x-show="!loading">Verifikasi ID →</span>
                        <span x-show="loading">Memverifikasi...</span>
                    </button>
                </form>
                
                <div class="text-center text-sm text-gray-500">
                    <p>Belum punya ID? <a href="{{ route('home') }}" class="text-[#0053C5] font-semibold hover:underline">Daftar di sini</a></p>
                </div>
            </div>
            
            <div x-show="verified" x-cloak class="text-center fade-in">
                <div class="mb-6">
                    <div class="inline-block bg-green-100 text-green-700 px-6 py-3 rounded-full mb-4">
                        <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-bold">ID Valid!</span>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2" x-text="peserta.nama_lengkap"></h3>
                    <p class="text-gray-600" x-text="peserta.asal_instansi"></p>
                    <p class="text-sm text-gray-500 mt-1">ID: <span class="font-bold" x-text="peserta.id_peserta"></span></p>
                </div>
                
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-8 mb-6">
                    <p class="text-lg font-bold text-gray-900 mb-4">Scan QR Code ini di Tablet Absensi</p>
                    <div class="inline-block bg-white p-6 rounded-2xl shadow-xl">
                        <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' + encodeURIComponent(peserta.qr_code_token)"
                             alt="QR Code"
                             width="300"
                             height="300"
                             class="rounded-lg"
                             x-show="!qrError"
                             @error="qrError = true">
                        
                        <div x-show="qrError" class="w-[300px] h-[300px] flex items-center justify-center bg-gray-100 rounded-lg">
                            <div class="text-center p-4">
                                <p class="text-sm text-gray-700 mb-2">QR Code gagal dimuat</p>
                                <p class="text-xs text-gray-500 font-mono break-all" x-text="peserta.qr_code_token"></p>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-4">QR Code valid untuk absensi</p>
                </div>
                
                <div class="bg-blue-50 rounded-2xl p-6 mb-6 text-left">
                    <h4 class="font-bold text-gray-900 mb-3 text-center">📋 Cara Absensi:</h4>
                    <ol class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start">
                            <span class="font-bold text-[#0053C5] mr-2">1.</span>
                            <span>Tunjukkan QR Code ini ke petugas atau tablet absensi</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-bold text-[#0053C5] mr-2">2.</span>
                            <span>Tunggu konfirmasi "Absensi Berhasil"</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-bold text-[#0053C5] mr-2">3.</span>
                            <span>Selamat menikmati acara! 🎉</span>
                        </li>
                    </ol>
                </div>
                
                <button @click="reset" 
                        class="text-gray-600 hover:text-gray-900 font-semibold text-sm">
                    ← Input ID Lain
                </button>
            </div>
            
        </div>
        
        <div class="text-center mt-8 text-white/80 text-sm">
            <p>© 2025 YPI Al Azhar. Al Azhar Expo 2025</p>
        </div>
        
    </div>

    <script>
        function checkInApp() {
            return {
                idChars: {
                    char1: '',
                    char2: '',
                    char3: '',
                    char4: ''
                },
                loading: false,
                verified: false,
                errorMessage: '',
                peserta: {},
                qrError: false,
                
                init() {
                    this.$nextTick(() => {
                        this.$refs.char1.focus();
                    });
                },
                
                isIdComplete() {
                    return this.idChars.char1 && this.idChars.char2 && 
                           this.idChars.char3 && this.idChars.char4;
                },
                
                getFullId() {
                    return (this.idChars.char1 + this.idChars.char2 + 
                            this.idChars.char3 + this.idChars.char4).toUpperCase();
                },
                
                handleInput(event, currentRef) {
                    const value = event.target.value.toUpperCase();
                    
                    if (!/^[A-Z0-9]$/.test(value)) {
                        event.target.value = '';
                        this.idChars[currentRef] = '';
                        return;
                    }
                    
                    this.idChars[currentRef] = value;
                    
                    const refOrder = ['char1', 'char2', 'char3', 'char4'];
                    const currentIndex = refOrder.indexOf(currentRef);
                    
                    if (currentIndex < 3 && value) {
                        const nextRef = refOrder[currentIndex + 1];
                        this.$refs[nextRef].focus();
                    }
                    
                    if (currentIndex === 3 && this.isIdComplete()) {
                        setTimeout(() => this.verifyId(), 200);
                    }
                },
                
                handleBackspace(event, currentRef) {
                    const refOrder = ['char1', 'char2', 'char3', 'char4'];
                    const currentIndex = refOrder.indexOf(currentRef);
                    
                    if (!this.idChars[currentRef] && currentIndex > 0) {
                        const prevRef = refOrder[currentIndex - 1];
                        this.$refs[prevRef].focus();
                    }
                },
                
                async verifyId() {
                    if (!this.isIdComplete()) {
                        this.errorMessage = 'Lengkapi 4 karakter ID';
                        return;
                    }
                    
                    this.loading = true;
                    this.errorMessage = '';
                    
                    try {
                        const response = await fetch('{{ route("check-in.verify") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                id_peserta: this.getFullId()
                            })
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            this.verified = true;
                            this.peserta = data.data;
                            this.qrError = false;
                            console.log('✅ ID verified, QR Code loading via API');
                        } else {
                            this.errorMessage = data.message;
                            this.shakeInputs();
                        }
                    } catch (error) {
                        console.error(error);
                        this.errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                    } finally {
                        this.loading = false;
                    }
                },
                
                shakeInputs() {
                    ['char1', 'char2', 'char3', 'char4'].forEach(ref => {
                        const el = this.$refs[ref];
                        el.classList.add('border-red-500');
                        setTimeout(() => {
                            el.classList.remove('border-red-500');
                        }, 1000);
                    });
                },
                
                reset() {
                    this.verified = false;
                    this.idChars = { char1: '', char2: '', char3: '', char4: '' };
                    this.errorMessage = '';
                    this.peserta = {};
                    this.qrError = false;
                    
                    this.$nextTick(() => {
                        this.$refs.char1.focus();
                    });
                }
            }
        }
    </script>
</body>
</html>