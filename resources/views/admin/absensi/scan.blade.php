<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scanner Absensi - Al Azhar Expo 2025</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

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

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .manual-input {
            font-size: 28px;
            padding: 24px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 4px;
            font-weight: 900;
        }
    </style>
</head>

<body class="min-h-screen p-4" x-data="scannerApp()">

    <!-- Header -->
    <div class="max-w-4xl mx-auto mb-6">
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center shadow-xl">
                    <img src="{{ asset('assets/img/logohitam.png') }}" alt="Logo" class="h-12 w-auto">
                </div>
                <div class="text-white">
                    <h1 class="text-3xl font-black">SCANNER ABSENSI</h1>
                    <p class="text-sm opacity-90">Al Azhar Expo 2025</p>
                </div>
            </div>
            <div class="text-right text-white">
                <div class="text-5xl font-black" x-text="totalScanned"></div>
                <div class="text-sm opacity-90 font-semibold">Total Hari Ini</div>
            </div>
        </div>
    </div>

    <!-- Main Scanner Card -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl p-8 shadow-2xl">

            <!-- Mode Toggle -->
            <div class="flex gap-4 mb-8">
                <button @click="switchMode('scan')"
                    :class="mode === 'scan' ? 'bg-[#0053C5] text-white' : 'bg-gray-200 text-gray-700'"
                    class="flex-1 py-5 rounded-2xl font-bold text-xl transition-all shadow-lg">
                    📷 Scan QR Code
                </button>
                <button @click="switchMode('manual')"
                    :class="mode === 'manual' ? 'bg-[#0053C5] text-white' : 'bg-gray-200 text-gray-700'"
                    class="flex-1 py-5 rounded-2xl font-bold text-xl transition-all shadow-lg">
                    ⌨️ Input Manual
                </button>
            </div>

            <!-- Scanner Mode -->
            <div x-show="mode === 'scan'" x-cloak>
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-black text-gray-900 mb-2">Arahkan QR Code ke Kamera</h2>
                    <p class="text-gray-600 text-lg">Scanner akan otomatis membaca QR Code</p>
                </div>

                <!-- QR Reader -->
                <div id="reader" class="mb-6"></div>

                <button @click="toggleScanner"
                    :class="scanning ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600'"
                    class="w-full text-white py-5 rounded-2xl font-bold text-xl transition-all shadow-xl">
                    <span x-show="!scanning">▶️ Mulai Scanner</span>
                    <span x-show="scanning">⏸️ Pause Scanner</span>
                </button>
            </div>

            <!-- Manual Input Mode -->
            <div x-show="mode === 'manual'" x-cloak>
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-black text-gray-900 mb-2">Input ID Peserta</h2>
                    <p class="text-gray-600 text-lg">Masukkan 4 karakter ID</p>
                </div>

                <form @submit.prevent="manualCheckIn">
                    <input type="text" x-model="manualId" maxlength="4" placeholder="A7K2"
                        class="manual-input w-full border-4 border-gray-300 rounded-3xl focus:border-[#0053C5] focus:ring-8 focus:ring-[#0053C5]/20 transition-all"
                        autocomplete="off" autofocus>

                    <p x-show="errorMessage" x-text="errorMessage"
                        class="text-red-500 text-center font-bold text-lg my-6 bg-red-50 p-4 rounded-xl"></p>

                    <button type="submit" :disabled="loading || manualId.length !== 4"
                        class="w-full mt-6 bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white py-6 rounded-2xl font-bold text-2xl hover:shadow-2xl transition-all disabled:bg-gray-400 disabled:cursor-not-allowed disabled:opacity-50">
                        <span x-show="!loading">✅ Cek Absensi</span>
                        <span x-show="loading">⏳ Memproses...</span>
                    </button>
                </form>
            </div>

            <!-- Success Modal -->
            <div x-show="showSuccess" x-cloak x-transition
                class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4" @click.self="closeSuccess">
                <div class="bg-white rounded-3xl p-10 max-w-lg w-full success-animation shadow-2xl">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <h3 class="text-4xl font-black text-green-600 mb-6">ABSENSI BERHASIL! ✅</h3>

                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 mb-6 text-left">
                            <div class="mb-4">
                                <span class="text-sm text-gray-600 font-semibold">ID Peserta:</span>
                                <p class="text-2xl font-black text-[#0053C5]" x-text="successData.id_peserta"></p>
                            </div>
                            <div class="mb-4">
                                <span class="text-sm text-gray-600 font-semibold">Nama:</span>
                                <p class="text-xl font-bold text-gray-900" x-text="successData.nama"></p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-600 font-semibold">Instansi:</span>
                                <p class="text-gray-900 font-semibold" x-text="successData.instansi"></p>
                            </div>
                        </div>

                        <p class="text-3xl font-black text-gray-900 mb-8">Selamat Datang! 🎉</p>

                        <button @click="closeSuccess"
                            class="w-full bg-gradient-to-r from-[#0053C5] to-[#003D91] text-white py-5 rounded-2xl font-bold text-xl hover:shadow-2xl transition-all">
                            OK
                        </button>
                    </div>
                </div>
            </div>

            <!-- Already Checked In Modal -->
            <div x-show="showAlreadyChecked" x-cloak x-transition
                class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4"
                @click.self="closeAlreadyChecked">
                <div class="bg-white rounded-3xl p-10 max-w-lg w-full shadow-2xl">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>

                        <h3 class="text-3xl font-black text-orange-600 mb-6">SUDAH ABSEN! ⚠️</h3>

                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 mb-6 text-left">
                            <p class="text-xl font-bold text-gray-900 mb-3" x-text="successData.nama"></p>
                            <p class="text-gray-700 font-semibold">Sudah melakukan absensi hari ini</p>
                            <p class="text-sm text-gray-600 mt-2" x-text="'Waktu: ' + successData.waktu_scan"></p>
                        </div>

                        <button @click="closeAlreadyChecked"
                            class="w-full bg-orange-500 text-white py-5 rounded-2xl font-bold text-xl hover:bg-orange-600 transition-all">
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
            <p class="text-sm opacity-90">
                Halaman ini untuk petugas/kiosk absensi.
                Pengunjung silakan buka <a href="{{ route('check-in.form') }}"
                    class="font-bold underline">{{ url('/check-in') }}</a>
            </p>
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
                    console.log('Scanner App Initialized');
                    this.initScanner();
                    this.loadTodayStats();
                },

                initScanner() {
                    this.scanner = new Html5Qrcode("reader");
                    console.log('Scanner initialized');
                },

                switchMode(newMode) {
                    if (this.scanning) {
                        this.toggleScanner();
                    }
                    this.mode = newMode;
                    this.errorMessage = '';
                    this.manualId = '';
                },

                async toggleScanner() {
                    if (this.scanning) {
                        try {
                            await this.scanner.stop();
                            this.scanning = false;
                            console.log('Scanner stopped');
                        } catch (err) {
                            console.error('Stop error:', err);
                        }
                    } else {
                        try {
                            await this.scanner.start({
                                    facingMode: "environment"
                                }, {
                                    fps: 10,
                                    qrbox: {
                                        width: 300,
                                        height: 300
                                    }
                                },
                                (decodedText) => {
                                    this.onScanSuccess(decodedText);
                                },
                                (errorMessage) => {
                                    // Ignore scan errors (too noisy)
                                }
                            );
                            this.scanning = true;
                            console.log('Scanner started');
                        } catch (err) {
                            console.error("Scanner error:", err);
                            alert("Tidak dapat mengakses kamera. Pastikan izin kamera diaktifkan.");
                        }
                    }
                },

                async onScanSuccess(qrCode) {
                    console.log('QR Code scanned:', qrCode);

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
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                id_peserta: this.manualId.toUpperCase()
                            })
                        });

                        const verifyData = await verifyResponse.json();
                        console.log('Verify response:', verifyData);

                        if (verifyData.success) {
                            // Process absensi with QR token
                            this.processAbsensi(verifyData.data.qr_code_token, 'Manual Input');
                        } else {
                            this.errorMessage = verifyData.message;
                        }
                    } catch (error) {
                        console.error('Manual check-in error:', error);
                        this.errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                    } finally {
                        this.loading = false;
                    }
                },

                async processAbsensi(qrToken, source) {
                    console.log('Processing absensi:', {
                        qrToken,
                        source
                    });

                    try {
                        const response = await fetch('{{ route('scan.process') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                qr_code_token: qrToken,
                                source: source,
                                petugas: 'Kiosk Self-Service'
                            })
                        });

                        const data = await response.json();
                        console.log('Absensi response:', data);

                        if (data.success) {
                            this.successData = {
                                id_peserta: data.peserta.id_peserta,
                                nama: data.peserta.nama_lengkap,
                                instansi: data.peserta.asal_instansi
                            };
                            this.showSuccess = true;
                            this.totalScanned++;
                            this.manualId = '';

                            // Play success sound
                            this.playSuccessSound();
                        } else if (data.already_checked_in) {
                            this.successData = {
                                id_peserta: data.peserta.id_peserta,
                                nama: data.peserta.nama_lengkap,
                                instansi: data.peserta.asal_instansi,
                                waktu_scan: data.absensi?.waktu_scan || 'Tidak diketahui'
                            };
                            this.showAlreadyChecked = true;

                            // Play warning sound
                            this.playWarningSound();
                        } else {
                            this.errorMessage = data.message || 'Terjadi kesalahan';
                        }
                    } catch (error) {
                        console.error('Process absensi error:', error);
                        this.errorMessage = 'Terjadi kesalahan koneksi. Coba lagi.';
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
                        const response = await fetch('/admin/absensi/statistics?date=' + new Date().toISOString().split(
                            'T')[0]);
                        const data = await response.json();
                        this.totalScanned = data.total_hari_ini || 0;
                        console.log('Stats loaded:', this.totalScanned);
                    } catch (error) {
                        console.error('Failed to load stats:', error);
                    }
                },

                playSuccessSound() {
                    try {
                        const audioContext = new(window.AudioContext || window.webkitAudioContext)();
                        const oscillator = audioContext.createOscillator();
                        const gainNode = audioContext.createGain();

                        oscillator.connect(gainNode);
                        gainNode.connect(audioContext.destination);

                        oscillator.frequency.value = 800;
                        oscillator.type = 'sine';
                        gainNode.gain.value = 0.3;

                        oscillator.start();
                        setTimeout(() => oscillator.stop(), 100);
                    } catch (e) {
                        console.log('Sound not supported');
                    }
                },

                playWarningSound() {
                    try {
                        const audioContext = new(window.AudioContext || window.webkitAudioContext)();
                        const oscillator = audioContext.createOscillator();
                        const gainNode = audioContext.createGain();

                        oscillator.connect(gainNode);
                        gainNode.connect(audioContext.destination);

                        oscillator.frequency.value = 400;
                        oscillator.type = 'square';
                        gainNode.gain.value = 0.2;

                        oscillator.start();
                        setTimeout(() => oscillator.stop(), 150);
                    } catch (e) {
                        console.log('Sound not supported');
                    }
                }
            }
        }
    </script>
</body>

</html>
