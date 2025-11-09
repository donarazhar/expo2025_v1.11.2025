<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scanner Absensi - Al Azhar Expo 2025</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- html5-qrcode Scanner -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #0053C5 0%, #003D91 100%);
        }
        
        #reader {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }
        
        .success-animation {
            animation: successPulse 0.6s ease-in-out;
        }
        
        @keyframes successPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .manual-input {
            font-size: 24px;
            padding: 20px;
            text-align: center;
            text-transform: uppercase;
        }
    </style>
</head>

<body class="min-h-screen p-4" x-data="scannerApp()">
    
    <!-- Header -->
    <div class="max-w-4xl mx-auto mb-6">
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center">
                    <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo" class="h-8 w-auto">
                </div>
                <div class="text-white">
                    <h1 class="text-2xl font-black">SCANNER ABSENSI</h1>
                    <p class="text-sm opacity-80">Al Azhar Expo 2025</p>
                </div>
            </div>
            <div class="text-right text-white">
                <div class="text-3xl font-black" x-text="totalScanned"></div>
                <div class="text-xs opacity-80">Total Hari Ini</div>
            </div>
        </div>
    </div>
    
    <!-- Main Scanner Card -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl p-8 shadow-2xl">
            
            <!-- Mode Toggle -->
            <div class="flex gap-4 mb-6">
                <button @click="mode = 'scan'"
                        :class="mode === 'scan' ? 'bg-[#0053C5] text-white' : 'bg-gray-200 text-gray-700'"
                        class="flex-1 py-4 rounded-xl font-bold text-lg transition-all">
                    📷 Scan QR Code
                </button>
                <button @click="mode = 'manual'"
                        :class="mode === 'manual' ? 'bg-[#0053C5] text-white' : 'bg-gray-200 text-gray-700'"
                        class="flex-1 py-4 rounded-xl font-bold text-lg transition-all">
                    ⌨️ Input Manual
                </button>
            </div>
            
            <!-- Scanner Mode -->
            <div x-show="mode === 'scan'" x-cloak>
                <div class="text-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">Arahkan QR Code ke Kamera</h2>
                    <p class="text-gray-600">Scanner akan otomatis membaca QR Code</p>
                </div>
                
                <!-- QR Reader -->
                <div id="reader" class="mb-4"></div>
                
                <button @click="toggleScanner"
                        :class="scanning ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600'"
                        class="w-full text-white py-4 rounded-xl font-bold text-lg transition-all">
                    <span x-show="!scanning">▶️ Mulai Scanner</span>
                    <span x-show="scanning">⏸️ Pause Scanner</span>
                </button>
            </div>
            
            <!-- Manual Input Mode -->
            <div x-show="mode === 'manual'" x-cloak>
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Input ID Peserta</h2>
                    <p class="text-gray-600">Masukkan 4 karakter ID</p>
                </div>
                
                <form @submit.prevent="manualCheckIn">
                    <input type="text" 
                           x-model="manualId"
                           maxlength="4"
                           placeholder="A7K2"
                           class="manual-input w-full border-4 border-gray-300 rounded-2xl focus:border-[#0053C5] focus:ring-4 focus:ring-[#0053C5]/20 transition-all font-black"
                           autocomplete="off">
                    
                    <p x-show="errorMessage" 
                       x-text="errorMessage" 
                       class="text-red-500 text-center font-semibold my-4"></p>
                    
                    <button type="submit" 
                            :disabled="loading || manualId.length !== 4"
                            class="w-full mt-4 bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white py-5 rounded-2xl font-bold text-xl hover:shadow-2xl transition-all disabled:bg-gray-400 disabled:cursor-not-allowed">
                        <span x-show="!loading">Cek Absensi →</span>
                        <span x-show="loading">Memproses...</span>
                    </button>
                </form>
            </div>
            
            <!-- Success Modal -->
            <div x-show="showSuccess" 
                 x-cloak
                 class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4"
                 @click.self="closeSuccess">
                <div class="bg-white rounded-3xl p-8 max-w-md w-full success-animation">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        
                        <h3 class="text-3xl font-black text-green-600 mb-4">ABSENSI BERHASIL! ✅</h3>
                        
                        <div class="bg-gray-50 rounded-2xl p-6 mb-4 text-left">
                            <div class="mb-2">
                                <span class="text-sm text-gray-600">ID Peserta:</span>
                                <p class="text-xl font-bold text-gray-900" x-text="successData.id_peserta"></p>
                            </div>
                            <div class="mb-2">
                                <span class="text-sm text-gray-600">Nama:</span>
                                <p class="text-lg font-bold text-gray-900" x-text="successData.nama"></p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-600">Instansi:</span>
                                <p class="text-gray-900 font-semibold" x-text="successData.instansi"></p>
                            </div>
                        </div>
                        
                        <p class="text-2xl font-bold text-gray-900 mb-6">Selamat Datang! 🎉</p>
                        
                        <button @click="closeSuccess" 
                                class="w-full bg-[#0053C5] text-white py-4 rounded-xl font-bold text-lg hover:bg-[#003D91] transition-all">
                            OK
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Already Checked In Modal -->
            <div x-show="showAlreadyChecked" 
                 x-cloak
                 class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4"
                 @click.self="closeAlreadyChecked">
                <div class="bg-white rounded-3xl p-8 max-w-md w-full">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        
                        <h3 class="text-2xl font-black text-orange-600 mb-4">SUDAH ABSEN</h3>
                        
                        <div class="bg-gray-50 rounded-2xl p-6 mb-4 text-left">
                            <p class="text-lg font-bold text-gray-900 mb-2" x-text="successData.nama"></p>
                            <p class="text-sm text-gray-600">Sudah melakukan absensi hari ini</p>
                        </div>
                        
                        <button @click="closeAlreadyChecked" 
                                class="w-full bg-orange-500 text-white py-4 rounded-xl font-bold text-lg hover:bg-orange-600 transition-all">
                            OK
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <!-- Stats Footer -->
    <div class="max-w-4xl mx-auto mt-6">
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 text-white text-center">
            <p class="text-sm opacity-80">Halaman ini untuk petugas/kiosk absensi. Pengunjung silakan buka <strong class="font-bold">alazharexpo.com/check-in</strong></p>
        </div>
    </div>

    <script>
        function scannerApp() {
            return {
                mode: 'scan',
                scanning: false,
                loading: false,
                scanner: null,
                manualId: '',
                errorMessage: '',
                showSuccess: false,
                showAlreadyChecked: false,
                successData: {},
                totalScanned: 0,
                
                init() {
                    this.initScanner();
                    this.loadTodayStats();
                },
                
                initScanner() {
                    this.scanner = new Html5Qrcode("reader");
                },
                
                async toggleScanner() {
                    if (this.scanning) {
                        await this.scanner.stop();
                        this.scanning = false;
                    } else {
                        try {
                            await this.scanner.start(
                                { facingMode: "environment" },
                                {
                                    fps: 10,
                                    qrbox: { width: 300, height: 300 }
                                },
                                (decodedText) => {
                                    this.onScanSuccess(decodedText);
                                }
                            );
                            this.scanning = true;
                        } catch (err) {
                            console.error("Scanner error:", err);
                            alert("Tidak dapat mengakses kamera. Pastikan izin kamera diaktifkan.");
                        }
                    }
                },
                
                async onScanSuccess(qrCode) {
                    // Stop scanner sementara
                    if (this.scanning) {
                        await this.scanner.stop();
                        this.scanning = false;
                    }
                    
                    // Process absensi
                    this.processAbsensi(qrCode, 'QR Scanner');
                },
                
                async manualCheckIn() {
                    if (this.manualId.length !== 4) {
                        this.errorMessage = 'ID harus 4 karakter';
                        return;
                    }
                    
                    this.loading = true;
                    this.errorMessage = '';
                    
                    try {
                        // First, verify ID to get QR token
                        const verifyResponse = await fetch('{{ route('check-in.verify') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                id_peserta: this.manualId.toUpperCase()
                            })
                        });
                        
                        const verifyData = await verifyResponse.json();
                        
                        if (verifyData.success) {
                            // Process absensi with QR token
                            this.processAbsensi(verifyData.data.qr_code_token, 'Manual Input');
                        } else {
                            this.errorMessage = verifyData.message;
                        }
                    } catch (error) {
                        console.error(error);
                        this.errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                    } finally {
                        this.loading = false;
                    }
                },
                
                async processAbsensi(qrToken, source) {
                    try {
                        const response = await fetch('{{ route('scan.process') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                qr_code_token: qrToken,
                                source: source,
                                petugas: 'Kiosk Self-Service'
                            })
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            this.successData = {
                                id_peserta: data.peserta.id_peserta,
                                nama: data.peserta.nama_lengkap,
                                instansi: data.peserta.asal_instansi
                            };
                            this.showSuccess = true;
                            this.totalScanned++;
                            this.manualId = '';
                            
                            // Play success sound (optional)
                            this.playSuccessSound();
                        } else if (data.already_checked_in) {
                            this.successData = {
                                id_peserta: data.peserta.id_peserta,
                                nama: data.peserta.nama_lengkap,
                                instansi: data.peserta.asal_instansi
                            };
                            this.showAlreadyChecked = true;
                        } else {
                            this.errorMessage = data.message;
                        }
                    } catch (error) {
                        console.error(error);
                        this.errorMessage = 'Terjadi kesalahan koneksi.';
                    }
                },
                
                closeSuccess() {
                    this.showSuccess = false;
                    this.successData = {};
                    this.errorMessage = '';
                    
                    // Resume scanner if in scan mode
                    if (this.mode === 'scan' && !this.scanning) {
                        setTimeout(() => this.toggleScanner(), 500);
                    }
                },
                
                closeAlreadyChecked() {
                    this.showAlreadyChecked = false;
                    this.successData = {};
                    this.errorMessage = '';
                    
                    // Resume scanner if in scan mode
                    if (this.mode === 'scan' && !this.scanning) {
                        setTimeout(() => this.toggleScanner(), 500);
                    }
                },
                
                async loadTodayStats() {
                    try {
                        const response = await fetch('/admin/absensi/statistics?date=' + new Date().toISOString().split('T')[0]);
                        const data = await response.json();
                        this.totalScanned = data.total_hari_ini || 0;
                    } catch (error) {
                        console.error('Failed to load stats:', error);
                    }
                },
                
                playSuccessSound() {
                    // Optional: Add beep sound
                    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                    const oscillator = audioContext.createOscillator();
                    const gainNode = audioContext.createGain();
                    
                    oscillator.connect(gainNode);
                    gainNode.connect(audioContext.destination);
                    
                    oscillator.frequency.value = 800;
                    oscillator.type = 'sine';
                    gainNode.gain.value = 0.3;
                    
                    oscillator.start();
                    setTimeout(() => oscillator.stop(), 100);
                }
            }
        }
    </script>
</body>
</html>