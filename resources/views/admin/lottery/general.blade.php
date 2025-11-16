@extends('admin.layouts.app')

@section('title', 'Doorprize Umum')
@section('page-title', 'Doorprize Umum')
@section('page-subtitle', 'Doorprize untuk semua peserta yang hadir')

@section('content')
    <div class="space-y-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('admin.lottery.index') }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

        <!-- Header Info -->
        <div class="bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl shadow-lg p-8 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black mb-2">🎁 Doorprize Umum</h2>
                        <p class="text-purple-100 text-lg">Untuk semua peserta yang sudah check-in</p>
                    </div>
                </div>
                <div class="text-right bg-white/10 backdrop-blur-sm rounded-lg p-4">
                    <p class="text-purple-200 text-sm mb-1">Total Peserta Eligible</p>
                    <p class="text-5xl font-black">{{ $stats['total_participants'] }}</p>
                    <p class="text-purple-100 text-sm mt-1">Semua yang hadir</p>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="text-sm text-blue-800">
                    <p class="font-semibold mb-1">Tentang Doorprize Umum:</p>
                    <ul class="space-y-1">
                        <li>• <strong>Semua peserta</strong> yang sudah melakukan check-in (absensi) bisa mengikuti doorprize
                            ini</li>
                        <li>• Tidak perlu terdaftar di event tertentu</li>
                        <li>• Hadiah bersifat umum (tidak terikat event spesifik)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Total Hadiah</p>
                        <p class="text-3xl font-black text-purple-600 mt-1">{{ $stats['total_prizes'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Sisa Hadiah</p>
                        <p class="text-3xl font-black text-orange-600 mt-1">{{ $stats['remaining_prizes'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Total Pemenang</p>
                        <p class="text-3xl font-black text-green-600 mt-1">{{ $stats['total_winners'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Sudah Diambil</p>
                        <p class="text-3xl font-black text-blue-600 mt-1">{{ $stats['claimed_winners'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Belum Diambil</p>
                        <p class="text-3xl font-black text-yellow-600 mt-1">{{ $stats['unclaimed_winners'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Column - Prize Selection & Lottery Machine -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Prize Selection -->
                <div class="bg-white rounded-xl shadow-md p-6" x-data="generalLotteryMachine()">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Pilih Hadiah untuk Diundi</h3>

                    @if (count($generalPrizes) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($generalPrizes as $prize)
                                <div @click="selectPrize({{ json_encode($prize) }})"
                                    :class="selectedPrizeId === {{ $prize['id'] }} ? 'border-purple-500 bg-purple-50' :
                                        'border-gray-200'"
                                    class="border-2 rounded-lg p-4 cursor-pointer hover:border-purple-400 transition-all group">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-bold text-gray-900 mb-1 line-clamp-1">
                                                {{ $prize['nama_hadiah'] }}</h4>
                                            <div class="flex flex-wrap items-center gap-2 text-xs mb-2">
                                                <span
                                                    class="px-2 py-1 rounded-full bg-purple-100 text-purple-800 font-semibold">
                                                    Sisa: {{ $prize['sisa'] }}/{{ $prize['jumlah'] }}
                                                </span>
                                                @if ($prize['kategori'] == 'utama')
                                                    <span
                                                        class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 font-semibold">⭐
                                                        Utama</span>
                                                @elseif($prize['kategori'] == 'doorprize')
                                                    <span
                                                        class="px-2 py-1 rounded-full bg-blue-100 text-blue-800 font-semibold">🎁
                                                        Doorprize</span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 rounded-full bg-green-100 text-green-800 font-semibold">🎉
                                                        Hiburan</span>
                                                @endif
                                            </div>
                                            <p class="text-xs text-gray-500">🌟 Hadiah Umum</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            <p class="text-gray-600 font-semibold">Semua hadiah umum sudah habis</p>
                            <a href="{{ route('admin.prizes.index') }}"
                                class="text-azhar-blue-500 hover:text-azhar-blue-600 text-sm mt-2 inline-block">
                                Tambah hadiah baru
                            </a>
                        </div>
                    @endif

                    <!-- Lottery Machine -->
                    <div class="mt-6 bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl shadow-2xl p-8">
                        <div class="text-center">
                            <h3 class="text-2xl font-black text-white mb-2">🎰 Mesin Doorprize Umum</h3>
                            <p class="text-purple-200 mb-6" x-text="selectedPrizeName || 'Pilih hadiah terlebih dahulu'">
                            </p>

                            <!-- Lottery Display -->
                            <div
                                class="bg-white/10 backdrop-blur-sm rounded-xl p-8 mb-6 min-h-[300px] flex items-center justify-center">

                                <!-- Before Draw -->
                                <div x-show="!isDrawing && !winner" class="text-center">
                                    <svg class="w-32 h-32 text-white/50 mx-auto mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                                        </path>
                                    </svg>
                                    <p class="text-white/70 text-lg">Siap untuk mengundi?</p>
                                </div>

                                <!-- During Draw - Rolling Names -->
                                <div x-show="isDrawing" x-cloak class="text-center w-full">
                                    <div class="relative overflow-hidden h-48 mb-4">
                                        <div class="absolute inset-0 flex flex-col items-center justify-center space-y-2"
                                            style="animation: scroll 0.1s linear infinite;">
                                            <template x-for="i in 20" :key="i">
                                                <div class="text-3xl font-black text-white/70" x-text="rollingName"></div>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center gap-2">
                                        <div class="w-3 h-3 bg-white rounded-full animate-bounce"
                                            style="animation-delay: 0s;"></div>
                                        <div class="w-3 h-3 bg-white rounded-full animate-bounce"
                                            style="animation-delay: 0.1s;"></div>
                                        <div class="w-3 h-3 bg-white rounded-full animate-bounce"
                                            style="animation-delay: 0.2s;"></div>
                                    </div>
                                </div>

                                <!-- Winner Display -->
                                <div x-show="winner" x-cloak class="text-center animate-fadeIn">
                                    <div class="mb-6">
                                        <div class="text-6xl mb-4">🎉</div>
                                        <h4 class="text-4xl font-black text-white mb-2" x-text="winner?.nama"></h4>
                                        <p class="text-purple-200 text-lg mb-2" x-text="winner?.email"></p>
                                        <p class="text-purple-200 text-sm mb-4" x-text="winner?.instansi"></p>
                                        <div
                                            class="inline-block bg-yellow-400 text-yellow-900 px-6 py-3 rounded-full font-black text-xl mb-3">
                                            🏆 <span x-text="selectedPrizeName"></span>
                                        </div>
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full font-bold">
                                                🌟 Doorprize Umum
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4 justify-center">
                                <button @click="startDraw()"
                                    :disabled="!selectedPrizeId || isDrawing || totalParticipants === 0"
                                    :class="(!selectedPrizeId || isDrawing || totalParticipants === 0) ?
                                    'opacity-50 cursor-not-allowed' : 'hover:scale-105'"
                                    class="bg-white text-purple-600 px-8 py-4 rounded-xl font-black text-lg shadow-lg transition-transform flex items-center gap-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span x-text="isDrawing ? 'Mengundi...' : 'MULAI UNDI!'"></span>
                                </button>

                                <button @click="resetDraw()" x-show="winner"
                                    class="bg-purple-500 text-white px-6 py-4 rounded-xl font-bold text-lg hover:bg-purple-400 transition-colors">
                                    Undi Lagi
                                </button>
                            </div>

                            <!-- Info Messages -->
                            <div class="mt-4">
                                <p class="text-white/60 text-sm" x-show="!selectedPrizeId">
                                    ⬆️ Pilih hadiah di atas untuk memulai
                                </p>
                                <p class="text-white/60 text-sm" x-show="selectedPrizeId && totalParticipants === 0">
                                    ❌ Tidak ada peserta yang memenuhi syarat
                                </p>
                                <div x-show="selectedPrizeId && totalParticipants > 0"
                                    class="text-white text-sm space-y-1">
                                    <p>
                                        <span class="font-bold" x-text="totalParticipants"></span> peserta yang memenuhi
                                        syarat
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Recent Winners -->
            <div class="space-y-6">

                <!-- Recent Winners -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Pemenang Terbaru</h3>
                        <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                            {{ $recentWinners->total() }} pemenang
                        </span>
                    </div>

                    @if ($recentWinners->count() > 0)
                        <div class="space-y-3 max-h-[600px] overflow-y-auto">
                            @foreach ($recentWinners as $winner)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start justify-between gap-2 mb-2">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-bold text-gray-900 text-sm truncate">
                                                {{ $winner->nama_pemenang }}</h4>
                                            <p class="text-xs text-gray-500 truncate">{{ $winner->email_pemenang }}</p>
                                            @if ($winner->peserta)
                                                <p class="text-xs text-gray-500 truncate">
                                                    {{ $winner->peserta->asal_instansi ?? '-' }}</p>
                                            @endif
                                        </div>
                                        <div class="flex flex-col gap-1 items-end flex-shrink-0">
                                            @if ($winner->sudah_diambil)
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 whitespace-nowrap">✓
                                                    Diambil</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 whitespace-nowrap">⏳
                                                    Pending</span>
                                            @endif
                                            <span
                                                class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800 font-semibold">
                                                🌟 Umum
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-4 h-4 text-purple-600 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $winner->nama_hadiah }}
                                        </p>
                                    </div>
                                    <p class="text-xs text-gray-500">{{ $winner->waktu_undi->format('d M Y, H:i') }} WIB
                                    </p>

                                    @if (!$winner->sudah_diambil)
                                        <button onclick="claimPrizeGlobal({{ $winner->id }})"
                                            class="mt-3 w-full bg-green-500 text-white text-xs py-2 rounded-lg hover:bg-green-600 transition-colors font-semibold">
                                            Tandai Sudah Diambil
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if ($recentWinners->hasPages())
                            <div class="mt-4 border-t pt-4">
                                {{ $recentWinners->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">Belum ada pemenang</p>
                        </div>
                    @endif
                </div>

                <!-- Quick Stats -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-200">
                    <h4 class="text-sm font-bold text-gray-900 mb-4">📊 Statistik Cepat</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Total Peserta Hadir</span>
                            <span class="text-lg font-black text-purple-600">{{ $stats['total_participants'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Hadiah Tersisa</span>
                            <span class="text-lg font-black text-orange-600">{{ $stats['remaining_prizes'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Belum Diambil</span>
                            <span class="text-lg font-black text-yellow-600">{{ $stats['unclaimed_winners'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Claim Prize Modal -->
    <div x-data x-show="$store.claimModal.showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black opacity-50" @click="$store.claimModal.closeModal()"></div>

            <div class="relative bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Konfirmasi Pengambilan Hadiah</h3>

                <form @submit.prevent="$store.claimModal.submitClaim()">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Diserahkan Oleh <span class="text-red-500">*</span>
                            </label>
                            <input type="text" x-model="$store.claimModal.form.diambil_oleh" required
                                class="input-field" placeholder="Nama petugas">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Catatan (Opsional)
                            </label>
                            <textarea x-model="$store.claimModal.form.catatan" rows="3" class="input-field"
                                placeholder="Catatan tambahan..."></textarea>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="submit" :disabled="$store.claimModal.submitting"
                            class="flex-1 bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 transition-colors font-semibold disabled:opacity-50">
                            <span x-text="$store.claimModal.submitting ? 'Menyimpan...' : 'Konfirmasi'"></span>
                        </button>
                        <button type="button" @click="$store.claimModal.closeModal()"
                            class="flex-1 bg-gray-500 text-white py-3 rounded-lg hover:bg-gray-600 transition-colors font-semibold">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        @keyframes scroll {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-50%);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }
    </style>

    <script>
        // Initialize Alpine Store for Claim Modal
        document.addEventListener('alpine:init', () => {
            Alpine.store('claimModal', {
                showModal: false,
                winnerId: null,
                submitting: false,
                form: {
                    diambil_oleh: '',
                    catatan: ''
                },

                openModal(id) {
                    this.winnerId = id;
                    this.showModal = true;
                    this.form = {
                        diambil_oleh: '',
                        catatan: ''
                    };
                },

                closeModal() {
                    this.showModal = false;
                    this.winnerId = null;
                },

                async submitClaim() {
                    if (this.submitting) return;

                    this.submitting = true;

                    try {
                        const response = await fetch(
                            `{{ url('admin/lottery/winner') }}/${this.winnerId}/claim`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify(this.form)
                            });

                        const data = await response.json();

                        if (data.success) {
                            this.closeModal();
                            window.location.reload();
                        } else {
                            alert(data.message || 'Gagal menyimpan data');
                        }
                    } catch (error) {
                        console.error('Error claiming prize:', error);
                        alert('Terjadi kesalahan');
                    } finally {
                        this.submitting = false;
                    }
                }
            });
        });

        // General Lottery Machine Component
        function generalLotteryMachine() {
            return {
                selectedPrizeId: null,
                selectedPrizeName: null,
                selectedPrizeStock: 0,
                isDrawing: false,
                winner: null,
                participants: [],
                totalParticipants: 0,
                rollingName: '',
                rollingInterval: null,

                selectPrize(prize) {
                    this.selectedPrizeId = prize.id;
                    this.selectedPrizeName = prize.nama_hadiah;
                    this.selectedPrizeStock = prize.sisa;
                    this.winner = null;

                    this.loadParticipants();
                },

                async loadParticipants() {
                    try {
                        const response = await fetch(
                            `{{ route('admin.lottery.general') }}/prize/${this.selectedPrizeId}/participants`);
                        const data = await response.json();

                        if (data.success) {
                            this.participants = data.participants;
                            this.totalParticipants = data.total;

                            console.log('Loaded participants:', {
                                total: this.totalParticipants,
                                prize: data.prize
                            });
                        }
                    } catch (error) {
                        console.error('Error loading participants:', error);
                        alert('Gagal memuat data peserta');
                    }
                },

                async startDraw() {
                    if (!this.selectedPrizeId || this.participants.length === 0) return;

                    this.isDrawing = true;
                    this.winner = null;

                    this.rollingInterval = setInterval(() => {
                        const randomParticipant = this.participants[Math.floor(Math.random() * this.participants
                            .length)];
                        this.rollingName = randomParticipant.nama;
                    }, 50);

                    setTimeout(() => {
                        this.performDraw();
                    }, 3000);
                },

                async performDraw() {
                    const randomParticipant = this.participants[Math.floor(Math.random() * this.participants.length)];

                    try {
                        const response = await fetch(
                            `{{ route('admin.lottery.general') }}/prize/${this.selectedPrizeId}/draw`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    qr_code_token: randomParticipant.qr_code_token
                                })
                            });

                        const data = await response.json();

                        clearInterval(this.rollingInterval);
                        this.isDrawing = false;

                        if (data.success) {
                            this.winner = data.winner;

                            confetti({
                                particleCount: 200,
                                spread: 70,
                                origin: {
                                    y: 0.6
                                }
                            });

                            setTimeout(() => {
                                window.location.reload();
                            }, 5000);
                        } else {
                            alert(data.message || 'Gagal melakukan doorprize');
                        }
                    } catch (error) {
                        clearInterval(this.rollingInterval);
                        this.isDrawing = false;
                        console.error('Error drawing:', error);
                        alert('Terjadi kesalahan saat mengundi');
                    }
                },

                resetDraw() {
                    this.winner = null;
                    this.loadParticipants();
                }
            }
        }

        // Global function for claim button
        function claimPrizeGlobal(winnerId) {
            Alpine.store('claimModal').openModal(winnerId);
        }
    </script>
@endsection
