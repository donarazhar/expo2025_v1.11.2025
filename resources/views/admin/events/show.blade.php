@extends('admin.layouts.app')

@section('title', 'Detail Event')
@section('page-title', $event->judul)
@section('page-subtitle', 'Detail informasi event')

@section('content')
    <div class="space-y-6">

        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <a href="{{ route('admin.events.index') }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar Events
            </a>

            <div class="flex gap-3">
                <a href="{{ route('admin.events.edit', $event) }}"
                    class="bg-yellow-500 text-white px-6 py-2.5 rounded-lg hover:bg-yellow-600 transition-colors font-semibold inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Event
                </a>

                <form action="{{ route('admin.events.duplicate', $event) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-green-500 text-white px-6 py-2.5 rounded-lg hover:bg-green-600 transition-colors font-semibold inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                        Duplicate
                    </button>
                </form>

                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline"
                    onsubmit="return confirm('Yakin ingin menghapus event {{ $event->judul }}? Tindakan ini tidak dapat dibatalkan!')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 text-white px-6 py-2.5 rounded-lg hover:bg-red-600 transition-colors font-semibold inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            <!-- Total Registrations -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Total Pendaftar</p>
                        <p class="text-3xl font-black text-gray-900 mt-1">{{ $stats['total_registrations'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Confirmed -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Confirmed</p>
                        <p class="text-3xl font-black text-green-600 mt-1">{{ $stats['confirmed'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Pending</p>
                        <p class="text-3xl font-black text-yellow-600 mt-1">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Cancelled -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Cancelled</p>
                        <p class="text-3xl font-black text-red-600 mt-1">{{ $stats['cancelled'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Available Slots -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Sisa Kuota</p>
                        <p class="text-3xl font-black text-azhar-blue-600 mt-1">
                            {{ $event->kapasitas == 0 ? '∞' : $stats['available_slots'] }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-azhar-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-azhar-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Event Banner -->
                @if ($event->banner_image)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <img src="{{ Storage::url($event->banner_image) }}" alt="{{ $event->judul }}"
                            class="w-full h-80 object-cover">
                    </div>
                @endif

                <!-- Event Details -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-black text-gray-900 mb-2">{{ $event->judul }}</h3>
                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-purple-100 text-purple-800">
                                    {{ ucfirst($event->kategori) }}
                                </span>
                                @if ($event->status == 'published')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800">
                                        ✓ Published
                                    </span>
                                @elseif($event->status == 'draft')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gray-100 text-gray-800">
                                        📝 Draft
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800">
                                        ✕ Cancelled
                                    </span>
                                @endif
                                @if ($event->is_featured)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800">
                                        ⭐ Featured
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-3">📝 Deskripsi</h4>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $event->deskripsi }}</p>
                    </div>

                    <!-- Event Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Tanggal & Waktu</p>
                                <p class="text-gray-900 font-bold">{{ $event->formatted_date }}</p>
                                <p class="text-gray-700">{{ $event->formatted_time }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Lokasi</p>
                                <p class="text-gray-900 font-bold">{{ $event->lokasi }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Kapasitas</p>
                                <p class="text-gray-900 font-bold">
                                    {{ $event->kapasitas == 0 ? 'Unlimited' : number_format($event->kapasitas) . ' peserta' }}
                                </p>
                                @if ($event->kapasitas > 0)
                                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                        <div class="bg-azhar-blue-500 h-2 rounded-full"
                                            style="width: {{ min(($stats['confirmed'] / $event->kapasitas) * 100, 100) }}%">
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1">{{ $stats['confirmed'] }} terdaftar</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Status Event</p>
                                @if ($event->is_upcoming)
                                    <p class="text-gray-900 font-bold">🔜 Upcoming</p>
                                    <p class="text-xs text-gray-600">{{ $event->days_until }} hari lagi</p>
                                @elseif($event->is_ongoing)
                                    <p class="text-green-600 font-bold">🟢 Sedang Berlangsung</p>
                                @else
                                    <p class="text-gray-500 font-bold">✅ Selesai</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Schedules -->
                @if ($event->schedules->count() > 0)
                    <div class="bg-white rounded-xl shadow-md p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">📅 Jadwal Acara</h3>
                            <span class="text-sm text-gray-600">{{ $event->schedules->count() }} sesi</span>
                        </div>

                        <div class="space-y-4">
                            @foreach ($event->schedules as $schedule)
                                <div class="border-l-4 border-azhar-blue-500 pl-4 py-2">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $schedule->judul }}</h4>
                                            <p class="text-sm text-gray-600 mt-1">{{ $schedule->deskripsi }}</p>
                                            @if ($schedule->pembicara)
                                                <p class="text-sm text-azhar-blue-600 font-semibold mt-1">
                                                    <svg class="w-4 h-4 inline-block mr-1" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                        </path>
                                                    </svg>
                                                    {{ $schedule->pembicara }}
                                                </p>
                                            @endif
                                            @if ($schedule->lokasi_detail)
                                                <p class="text-xs text-gray-500 mt-1">📍 {{ $schedule->lokasi_detail }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-gray-900">
                                                {{ $schedule->waktu_mulai->format('H:i') }}</p>
                                            <p class="text-xs text-gray-600">{{ $schedule->waktu_selesai->format('H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Registered Participants -->
                @if ($event->registrations->count() > 0)
                    <div class="bg-white rounded-xl shadow-md p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">👥 Peserta Terdaftar</h3>
                            <span class="text-sm text-gray-600">{{ $event->registrations->count() }} peserta</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Nama</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Instansi
                                        </th>
                                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-700 uppercase">Status
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Tanggal
                                            Daftar</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($event->registrations()->with('peserta')->latest()->take(10)->get() as $registration)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3">
                                                <div>
                                                    <p class="font-semibold text-gray-900">
                                                        {{ $registration->peserta->nama_lengkap }}</p>
                                                    <p class="text-xs text-gray-600">{{ $registration->peserta->email }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-700">
                                                {{ $registration->peserta->asal_instansi }}</td>
                                            <td class="px-4 py-3 text-center">
                                                @if ($registration->status == 'confirmed')
                                                    <span
                                                        class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Confirmed</span>
                                                @elseif($registration->status == 'pending')
                                                    <span
                                                        class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 font-semibold">Pending</span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 font-semibold">Cancelled</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-600">
                                                {{ $registration->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($event->registrations->count() > 10)
                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-600">Menampilkan 10 dari {{ $event->registrations->count() }}
                                    peserta terdaftar</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">

                <!-- Quick Info -->
                <div class="bg-gradient-to-br from-azhar-blue-500 to-azhar-blue-600 rounded-xl shadow-md p-6 text-blue">
                    <h4 class="font-bold text-lg mb-4">ℹ️ Info Cepat</h4>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-blue/70">Slug</p>
                            <p class="font-mono font-semibold">{{ $event->slug }}</p>
                        </div>
                        <div>
                            <p class="text-blue/70">Dibuat</p>
                            <p class="font-semibold">{{ $event->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-blue/70">Update Terakhir</p>
                            <p class="font-semibold">{{ $event->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="font-bold text-gray-900 mb-4">⚡ Quick Actions</h4>
                    <div class="space-y-3">
                        <a href="{{ route('admin.events.edit', $event) }}"
                            class="block w-full bg-yellow-500 text-white text-center py-2.5 rounded-lg hover:bg-yellow-600 transition-colors font-semibold">
                            Edit Event
                        </a>
                        <form action="{{ route('admin.events.duplicate', $event) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full bg-green-500 text-white text-center py-2.5 rounded-lg hover:bg-green-600 transition-colors font-semibold">
                                Duplicate Event
                            </button>
                        </form>
                        <button onclick="window.print()"
                            class="block w-full bg-gray-500 text-white text-center py-2.5 rounded-lg hover:bg-gray-600 transition-colors font-semibold">
                            Print Detail
                        </button>
                    </div>
                </div>

                <!-- Event Status -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="font-bold text-gray-900 mb-4">📊 Status Event</h4>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Publikasi</span>
                            @if ($event->status == 'published')
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">Published</span>
                            @elseif($event->status == 'draft')
                                <span
                                    class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-bold">Draft</span>
                            @else
                                <span
                                    class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">Cancelled</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Featured</span>
                            @if ($event->is_featured)
                                <span class="text-yellow-500 text-xl">⭐</span>
                            @else
                                <span class="text-gray-400 text-xl">☆</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Pendaftar</span>
                            <span
                                class="font-bold text-gray-900">{{ $stats['confirmed'] }}/{{ $event->kapasitas == 0 ? '∞' : $event->kapasitas }}</span>
                        </div>

                        @if ($event->kapasitas > 0)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Persentase</span>
                                <span
                                    class="font-bold text-azhar-blue-600">{{ round(($stats['confirmed'] / $event->kapasitas) * 100) }}%</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
