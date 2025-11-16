@extends('admin.layouts.app')

@section('title', 'Sistem Doorprize')
@section('page-title', 'Sistem Doorprize')
@section('page-subtitle', 'Kelola doorprize hadiah untuk peserta event')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Sistem Doorprize</h3>
                    <p class="text-sm text-gray-600">Undi hadiah untuk peserta event</p>
                </div>
            </div>

            <a href="{{ route('admin.prizes.index') }}" class="btn-primary inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                Kelola Hadiah
            </a>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Total Event</p>
                        <p class="text-3xl font-black text-gray-900 mt-1">{{ $stats['total_events'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Total Hadiah</p>
                        <p class="text-3xl font-black text-purple-600 mt-1">{{ $stats['total_prizes'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">Sisa: {{ $stats['remaining_prizes'] }}</p>
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
                        <p class="text-sm text-gray-600 font-semibold">Total Pemenang</p>
                        <p class="text-3xl font-black text-green-600 mt-1">{{ $stats['total_winners'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">Rate: {{ $stats['claim_rate'] }}%</p>
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
                        <p class="text-sm text-gray-600 font-semibold">Belum Diambil</p>
                        <p class="text-3xl font-black text-orange-600 mt-1">{{ $stats['unclaimed_prizes'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">Sudah: {{ $stats['claimed_prizes'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Peserta Hadir</p>
                        <p class="text-3xl font-black text-indigo-600 mt-1">{{ $stats['total_attended_participants'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">Terdaftar: {{ $stats['total_registered_participants'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- General Lottery Section (Doorprize Umum) -->
        @if ($generalPrizes->count() > 0 && $allAttendedParticipants->count() > 0)
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold">🎁 Doorprize Umum</h3>
                                <p class="text-purple-100 text-sm">Untuk semua peserta yang hadir</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <p class="text-purple-100 text-sm">Hadiah Tersedia</p>
                                <p class="text-2xl font-black">{{ $stats['general_prizes'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-purple-100 text-sm">Stok Hadiah</p>
                                <p class="text-2xl font-black">{{ $stats['general_prizes_stock'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-purple-100 text-sm">Peserta Eligible</p>
                                <p class="text-2xl font-black">{{ $allAttendedParticipants->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach ($generalPrizes->take(3) as $prize)
                            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                                <div class="flex items-center justify-between mb-2">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-white">
                                        {{ $prize->kategori }}
                                    </span>
                                    <span class="text-white font-bold">
                                        Sisa: {{ $prize->sisa }}/{{ $prize->jumlah }}
                                    </span>
                                </div>
                                <h4 class="font-bold text-white text-lg">{{ $prize->nama_hadiah }}</h4>
                            </div>
                        @endforeach

                        @if ($generalPrizes->count() > 3)
                            <div
                                class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20 flex items-center justify-center">
                                <div class="text-center">
                                    <p class="text-3xl font-black text-white">+{{ $generalPrizes->count() - 3 }}</p>
                                    <p class="text-white/80 text-sm">Hadiah lainnya</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-purple-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm">Doorprize umum dapat diikuti oleh semua peserta yang sudah check-in</span>
                        </div>

                        <a href="{{ route('admin.lottery.general') }}"
                            class="bg-white text-purple-600 px-6 py-3 rounded-lg hover:bg-purple-50 transition-all font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5">
                                </path>
                            </svg>
                            Mulai Doorprize Umum
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Events List -->
        @if ($events->count() > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">📅 Doorprize Per Event</h3>
                            <p class="text-sm text-gray-600 mt-1">Pilih event untuk mengundi peserta yang terdaftar</p>
                        </div>

                        <!-- Filter/Search (Optional) -->
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <input type="text" id="searchEvent" placeholder="Cari event..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-sm">
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="divide-y divide-gray-200" id="eventsList">
                    @foreach ($events as $event)
                        <div class="p-6 hover:bg-gray-50 transition-colors event-item"
                            data-event-name="{{ strtolower($event->judul) }}">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-start gap-4">
                                        @if ($event->banner_image)
                                            <img src="{{ Storage::url($event->banner_image) }}"
                                                alt="{{ $event->judul }}"
                                                class="w-20 h-20 rounded-lg object-cover shadow-md">
                                        @else
                                            <div
                                                class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center shadow-md">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif

                                        <div class="flex-1">
                                            <h4 class="font-bold text-gray-900 text-lg mb-1">{{ $event->judul }}</h4>
                                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span>{{ $event->formatted_date }}</span>

                                                @if ($event->lokasi)
                                                    <span class="text-gray-400">•</span>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    <span>{{ $event->lokasi }}</span>
                                                @endif
                                            </div>

                                            <div class="flex flex-wrap gap-4 text-sm">
                                                <div class="flex items-center gap-2 bg-purple-50 px-3 py-1.5 rounded-lg">
                                                    <svg class="w-4 h-4 text-purple-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                    <span class="text-gray-700">
                                                        <span
                                                            class="font-bold text-purple-600">{{ $event->prizes->sum('sisa') }}</span>
                                                        /{{ $event->prizes->sum('jumlah') }} Hadiah
                                                    </span>
                                                </div>

                                                <div class="flex items-center gap-2 bg-green-50 px-3 py-1.5 rounded-lg">
                                                    <svg class="w-4 h-4 text-green-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="text-gray-700">
                                                        <span
                                                            class="font-bold text-green-600">{{ $event->lotteryWinners->count() }}</span>
                                                        Pemenang
                                                    </span>
                                                </div>

                                                <div class="flex items-center gap-2 bg-blue-50 px-3 py-1.5 rounded-lg">
                                                    <svg class="w-4 h-4 text-blue-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                        </path>
                                                    </svg>
                                                    <span class="text-gray-700">
                                                        <span
                                                            class="font-bold text-blue-600">{{ $event->registrations()->where('status', 'confirmed')->whereHas('peserta.absensi', function ($q) {$q->where('status_kehadiran', true);})->count() }}</span>
                                                        /{{ $event->registrations()->where('status', 'confirmed')->count() }}
                                                        Hadir
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('admin.lottery.show', $event) }}"
                                        class="bg-purple-500 text-white px-6 py-2.5 rounded-lg hover:bg-purple-600 transition-all font-semibold text-center inline-flex items-center justify-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5">
                                            </path>
                                        </svg>
                                        Mulai Doorprize
                                    </a>

                                    @if ($event->lotteryWinners->count() > 0)
                                        <a href="{{ route('admin.lottery.show', $event) }}#winners"
                                            class="bg-gray-100 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-200 transition-colors font-medium text-center inline-flex items-center justify-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            Lihat Pemenang
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($events->hasPages())
                    <div class="p-6 border-t border-gray-200">
                        {{ $events->links() }}
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Event</h3>
                <p class="text-gray-600 mb-6">Buat event terlebih dahulu untuk memulai doorprize per event</p>
                <a href="{{ route('admin.events.create') }}" class="btn-primary inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Buat Event
                </a>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        // Simple search functionality
        document.getElementById('searchEvent')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const eventItems = document.querySelectorAll('.event-item');

            eventItems.forEach(item => {
                const eventName = item.dataset.eventName;
                if (eventName.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });

            // Show empty state if no results
            const visibleItems = Array.from(eventItems).filter(item => item.style.display !== 'none');
            const eventsList = document.getElementById('eventsList');

            if (visibleItems.length === 0 && searchTerm) {
                if (!document.getElementById('noResults')) {
                    const noResults = document.createElement('div');
                    noResults.id = 'noResults';
                    noResults.className = 'p-12 text-center';
                    noResults.innerHTML = `
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Event tidak ditemukan</h3>
                    <p class="text-gray-600">Coba gunakan kata kunci yang berbeda</p>
                `;
                    eventsList.appendChild(noResults);
                }
            } else {
                document.getElementById('noResults')?.remove();
            }
        });
    </script>
@endpush
