@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data dan statistik Al Azhar Expo 2025')

@section('content')
    <div class="space-y-6">

        {{-- STATISTICS CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Total Peserta --}}
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-blue">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Peserta</p>
                        <h3 class="text-3xl font-bold mt-2">{{ number_format($stats['total_peserta']) }}</h3>
                        <p class="text-blue-100 text-xs mt-2">
                            <span class="font-semibold">{{ $stats['peserta_hari_ini'] }}</span> hari ini
                        </p>
                    </div>
                    <div class="bg-blue bg-opacity-20 rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                @if (isset($growth_trends['peserta']) && is_array($growth_trends['peserta']))
                    <div class="mt-4 pt-4 border-t border-blue-400">
                        <div class="flex items-center justify-between">
                            <span class="text-xs">Pertumbuhan bulan ini:</span>
                            <span
                                class="text-xs font-bold {{ $growth_trends['peserta']['trend'] == 'up' ? 'text-green-300' : 'text-red-300' }}">
                                <i class="fas fa-arrow-{{ $growth_trends['peserta']['trend'] }}"></i>
                                {{ $growth_trends['peserta']['percentage'] > 0 ? '+' : '' }}{{ $growth_trends['peserta']['percentage'] }}%
                            </span>
                        </div>
                        <div class="text-xs text-blue-100 mt-1">
                            {{ number_format($growth_trends['peserta']['current']) }} vs
                            {{ number_format($growth_trends['peserta']['previous']) }} bulan lalu
                        </div>
                    </div>
                @endif
            </div>

            {{-- Total Kehadiran --}}
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-blue">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Total Kehadiran</p>
                        <h3 class="text-3xl font-bold mt-2">{{ number_format($stats['total_hadir']) }}</h3>
                        <p class="text-green-100 text-xs mt-2">
                            <span class="font-semibold">{{ $stats['persentase_kehadiran'] }}%</span> dari total peserta
                        </p>
                    </div>
                    <div class="bg-blue bg-opacity-20 rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                @if (isset($growth_trends['kehadiran']) && is_array($growth_trends['kehadiran']))
                    <div class="mt-4 pt-4 border-t border-green-400">
                        <div class="flex items-center justify-between">
                            <span class="text-xs">Hadir hari ini:</span>
                            <span class="text-xs font-bold">{{ $stats['hadir_hari_ini'] }} orang</span>
                        </div>
                        <div class="text-xs text-green-100 mt-1">
                            Trend:
                            <span
                                class="{{ $growth_trends['kehadiran']['trend'] == 'up' ? 'text-green-300' : 'text-red-300' }}">
                                {{ $growth_trends['kehadiran']['percentage'] > 0 ? '+' : '' }}{{ $growth_trends['kehadiran']['percentage'] }}%
                            </span>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Total Sertifikat --}}
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-blue">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Sertifikat</p>
                        <h3 class="text-3xl font-bold mt-2">{{ number_format($stats['total_sertifikat']) }}</h3>
                        <p class="text-purple-100 text-xs mt-2">
                            <span class="font-semibold">{{ $stats['sertifikat_terkirim'] }}</span> terkirim
                        </p>
                    </div>
                    <div class="bg-blue bg-opacity-20 rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                </div>
                @if (isset($growth_trends['sertifikat']) && is_array($growth_trends['sertifikat']))
                    <div class="mt-4 pt-4 border-t border-purple-400">
                        <div class="flex items-center justify-between">
                            <span class="text-xs">Pending:</span>
                            <span class="text-xs font-bold">{{ $stats['sertifikat_pending'] }}</span>
                        </div>
                        <div class="text-xs text-purple-100 mt-1">
                            Penerbitan: {{ number_format($growth_trends['sertifikat']['current']) }} bulan ini
                        </div>
                    </div>
                @endif
            </div>

            {{-- Total Events --}}
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-blue">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Total Events</p>
                        <h3 class="text-3xl font-bold mt-2">{{ number_format($stats['total_events']) }}</h3>
                        <p class="text-orange-100 text-xs mt-2">
                            <span class="font-semibold">{{ $stats['events_ongoing'] }}</span> sedang berlangsung
                        </p>
                    </div>
                    <div class="bg-blue bg-opacity-20 rounded-full p-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-orange-400">
                    <div class="flex items-center justify-between">
                        <span class="text-xs">Aktif: {{ $stats['events_aktif'] }}</span>
                        <span class="text-xs">Upcoming: {{ $stats['events_upcoming'] }}</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- ADDITIONAL STATS ROW --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Event Registrations --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Registrasi Event</h3>
                    <div class="bg-indigo-100 rounded-full p-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total</span>
                        <span
                            class="text-lg font-bold text-gray-900">{{ number_format($stats['total_registrations']) }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full"
                            style="width: {{ $stats['total_registrations'] > 0 ? ($stats['registrations_confirmed'] / $stats['total_registrations']) * 100 : 0 }}%">
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Confirmed</span>
                        <span
                            class="text-sm font-semibold text-green-600">{{ number_format($stats['registrations_confirmed']) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Pending</span>
                        <span
                            class="text-sm font-semibold text-yellow-600">{{ number_format($stats['registrations_pending']) }}</span>
                    </div>
                </div>
            </div>

            {{-- Feedback Stats --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Feedback</h3>
                    <div class="bg-yellow-100 rounded-full p-2">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Feedback</span>
                        <span class="text-lg font-bold text-gray-900">{{ number_format($stats['total_feedback']) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Rata-rata Rating</span>
                        <div class="flex items-center">
                            <span class="text-lg font-bold text-yellow-500 mr-1">{{ $stats['average_rating'] }}</span>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Published</span>
                        <span
                            class="text-sm font-semibold text-green-600">{{ number_format($stats['feedback_published']) }}</span>
                    </div>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Info Cepat</h3>
                    <div class="bg-blue-100 rounded-full p-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Peserta Minggu Ini</span>
                        <span
                            class="text-lg font-bold text-gray-900">{{ number_format($stats['peserta_minggu_ini']) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Peserta Bulan Ini</span>
                        <span
                            class="text-sm font-semibold text-blue-600">{{ number_format($stats['peserta_bulan_ini']) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Event Aktif</span>
                        <span
                            class="text-sm font-semibold text-green-600">{{ number_format($stats['events_aktif']) }}</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- CHARTS SECTION --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Registrations Chart --}}
            <div class="bg-blue rounded-xl shadow-md p-6 lg:col-span-2">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pendaftaran 14 Hari Terakhir</h3>
                <canvas id="registrationsChart" height="100"></canvas>
            </div>

            {{-- Rating Distribution --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Distribusi Rating</h3>
                <canvas id="ratingChart" height="200"></canvas>
            </div>

        </div>

        {{-- ATTENDANCE & CERTIFICATES --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Attendance Chart --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kehadiran 14 Hari Terakhir</h3>
                <canvas id="attendanceChart" height="100"></canvas>
            </div>

            {{-- Certificates Chart --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Penerbitan Sertifikat 14 Hari Terakhir</h3>
                <canvas id="certificatesChart" height="100"></canvas>
            </div>

        </div>

        {{-- REGISTRATION STATUS & HOURLY PATTERN --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Registration Status --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Registrasi Event</h3>
                <canvas id="registrationStatusChart" height="100"></canvas>
            </div>

            {{-- Hourly Attendance Pattern --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pola Kehadiran Hari Ini (Per Jam)</h3>
                @if ($hourly_attendance->count() > 0)
                    <canvas id="hourlyAttendanceChart" height="100"></canvas>
                @else
                    <div class="flex items-center justify-center h-40">
                        <p class="text-gray-500">Belum ada data kehadiran hari ini</p>
                    </div>
                @endif
            </div>

        </div>

        {{-- TOP EVENTS & UPCOMING EVENTS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Top Events --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top 5 Event Terpopuler</h3>
                <div class="space-y-3">
                    @forelse($top_events as $index => $event)
                        <div
                            class="flex items-center justify-between p-3 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg hover:from-orange-100 hover:to-orange-200 transition">
                            <div class="flex items-center space-x-3">
                                <span
                                    class="flex items-center justify-center w-8 h-8 bg-orange-500 text-blue rounded-full font-bold text-sm">
                                    {{ $index + 1 }}
                                </span>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $event->judul }}</p>
                                    <p class="text-xs text-gray-600">{{ $event->tanggal_mulai->format('d M Y') }}</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $event->lokasi }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span
                                    class="text-lg font-bold text-orange-600">{{ number_format($event->registrations_count) }}</span>
                                <p class="text-xs text-gray-500">registrasi</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Belum ada data event</p>
                    @endforelse
                </div>
            </div>

            {{-- Upcoming Events --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Event Mendatang</h3>
                <div class="space-y-3">
                    @forelse($upcoming_events as $event)
                        <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-blue-500 rounded-lg flex flex-col items-center justify-center text-blue">
                                <span class="text-xs font-semibold">{{ $event->tanggal_mulai->format('M') }}</span>
                                <span class="text-lg font-bold">{{ $event->tanggal_mulai->format('d') }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $event->judul }}</p>
                                <p class="text-xs text-gray-600 mt-1">
                                    <i class="far fa-calendar mr-1"></i>{{ $event->tanggal_mulai->format('d M Y') }} -
                                    {{ $event->tanggal_selesai->format('d M Y') }}
                                </p>
                                <div class="flex items-center mt-1 space-x-2">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Tidak ada event mendatang</p>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- TOP INSTITUTIONS & RECENT DATA --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Top Institutions --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top 10 Instansi</h3>
                <div class="space-y-3">
                    @forelse($top_institutions as $index => $institution)
                        <div
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center space-x-3">
                                <span
                                    class="flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-600 rounded-full font-bold text-sm">
                                    {{ $index + 1 }}
                                </span>
                                <span class="text-sm font-medium text-gray-900">{{ $institution->asal_instansi }}</span>
                            </div>
                            <div class="text-right">
                                <span
                                    class="text-sm font-bold text-blue-600">{{ number_format($institution->count) }}</span>
                                <p class="text-xs text-gray-500">peserta</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Belum ada data</p>
                    @endforelse
                </div>
            </div>

            {{-- Recent Registrations --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pendaftaran Terbaru</h3>
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @forelse($recent_registrations as $peserta)
                        <div
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">
                                    {{ substr($peserta->nama_lengkap, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $peserta->nama_lengkap }}</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $peserta->email }}</p>
                                    <p class="text-xs text-gray-500">{{ $peserta->asal_instansi }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">{{ $peserta->tgl_registrasi->format('d M Y') }}</p>
                                <p class="text-xs text-gray-400">{{ $peserta->tgl_registrasi->format('H:i') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Belum ada pendaftaran</p>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- RECENT ATTENDANCE & CERTIFICATES --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Recent Attendance --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kehadiran Terbaru</h3>
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @forelse($recent_attendance as $attendance)
                        <div
                            class="flex items-center justify-between p-3 bg-green-50 rounded-lg hover:bg-green-100 transition">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $attendance->peserta->nama_lengkap }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $attendance->peserta->asal_instansi }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">{{ $attendance->waktu_scan->format('d M Y') }}</p>
                                <p class="text-xs text-gray-400">{{ $attendance->waktu_scan->format('H:i') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Belum ada data kehadiran</p>
                    @endforelse
                </div>
            </div>

            {{-- Recent Certificates --}}
            <div class="bg-blue rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Sertifikat Terbaru</h3>
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @forelse($recent_certificates as $certificate)
                        <div
                            class="flex items-center justify-between p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $certificate->peserta->nama_lengkap }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $certificate->status_kirim ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $certificate->status_kirim ? 'Terkirim' : 'Pending' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">{{ $certificate->tgl_penerbitan->format('d M Y') }}</p>
                                <p class="text-xs text-gray-400">{{ $certificate->nomor_sertifikat }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Belum ada sertifikat diterbitkan</p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Chart.js default config
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#6B7280';

            // Registrations Chart
            const regCtx = document.getElementById('registrationsChart').getContext('2d');
            new Chart(regCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_column($registrations_chart, 'label')) !!},
                    datasets: [{
                        label: 'Pendaftaran',
                        data: {!! json_encode(array_column($registrations_chart, 'count')) !!},
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: 'rgb(59, 130, 246)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Attendance Chart
            const attCtx = document.getElementById('attendanceChart').getContext('2d');
            new Chart(attCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_column($attendance_chart, 'label')) !!},
                    datasets: [{
                        label: 'Kehadiran',
                        data: {!! json_encode(array_column($attendance_chart, 'count')) !!},
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: 'rgb(34, 197, 94)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Certificates Chart
            const certCtx = document.getElementById('certificatesChart').getContext('2d');
            new Chart(certCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_column($certificates_chart, 'label')) !!},
                    datasets: [{
                        label: 'Sertifikat',
                        data: {!! json_encode(array_column($certificates_chart, 'count')) !!},
                        backgroundColor: 'rgba(168, 85, 247, 0.8)',
                        borderColor: 'rgb(168, 85, 247)',
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Rating Distribution Chart
            const ratingCtx = document.getElementById('ratingChart').getContext('2d');
            new Chart(ratingCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($rating_distribution->pluck('rating')->map(fn($r) => $r . ' Bintang')->toArray()) !!},
                    datasets: [{
                        data: {!! json_encode($rating_distribution->pluck('count')->toArray()) !!},
                        backgroundColor: [
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(249, 115, 22, 0.8)',
                            'rgba(234, 179, 8, 0.8)',
                            'rgba(34, 197, 94, 0.8)',
                            'rgba(59, 130, 246, 0.8)'
                        ],
                        borderColor: [
                            'rgb(239, 68, 68)',
                            'rgb(249, 115, 22)',
                            'rgb(234, 179, 8)',
                            'rgb(34, 197, 94)',
                            'rgb(59, 130, 246)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: {
                                    size: 11
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed + ' feedback';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // Registration Status Chart
            const regStatusCtx = document.getElementById('registrationStatusChart').getContext('2d');
            new Chart(regStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($registration_status->pluck('status')->map(fn($s) => ucfirst($s))->toArray()) !!},
                    datasets: [{
                        data: {!! json_encode($registration_status->pluck('count')->toArray()) !!},
                        backgroundColor: [
                            'rgba(34, 197, 94, 0.8)',
                            'rgba(234, 179, 8, 0.8)',
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(156, 163, 175, 0.8)'
                        ],
                        borderColor: [
                            'rgb(34, 197, 94)',
                            'rgb(234, 179, 8)',
                            'rgb(239, 68, 68)',
                            'rgb(156, 163, 175)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: {
                                    size: 11
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed + ' registrasi';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            // Hourly Attendance Pattern Chart
            @if ($hourly_attendance->count() > 0)
                const hourlyCtx = document.getElementById('hourlyAttendanceChart').getContext('2d');
                new Chart(hourlyCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode(
                            $hourly_attendance->pluck('hour')->map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ':00')->toArray(),
                        ) !!},
                        datasets: [{
                            label: 'Kehadiran',
                            data: {!! json_encode($hourly_attendance->pluck('count')->toArray()) !!},
                            backgroundColor: 'rgba(59, 130, 246, 0.8)',
                            borderColor: 'rgb(59, 130, 246)',
                            borderWidth: 1,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                padding: 12,
                                displayColors: false,
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.y + ' orang hadir';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            @endif
        </script>
    @endpush
@endsection
