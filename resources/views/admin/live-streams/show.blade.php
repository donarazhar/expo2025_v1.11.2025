@extends('admin.layouts.app')

@section('title', 'Detail Live Stream')
@section('page-title', 'Detail Live Stream')
@section('page-subtitle', 'Informasi lengkap live streaming')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.live-streams.index') }}"
                    class="w-10 h-10 bg-white rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors shadow-md">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div
                    class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Detail Live Stream</h3>
                    <p class="text-sm text-gray-600">{{ $liveStream->judul }}</p>
                </div>
            </div>

            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('admin.live-streams.edit', $liveStream) }}"
                    class="bg-yellow-500 text-white px-4 md:px-6 py-2 md:py-3 rounded-lg hover:bg-yellow-600 transition-colors font-semibold inline-flex items-center text-sm md:text-base">
                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.live-streams.duplicate', $liveStream) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-green-500 text-white px-4 md:px-6 py-2 md:py-3 rounded-lg hover:bg-green-600 transition-colors font-semibold inline-flex items-center text-sm md:text-base">
                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                        Duplicate
                    </button>
                </form>
                <form action="{{ route('admin.live-streams.destroy', $liveStream) }}" method="POST" class="inline"
                    onsubmit="return confirm('Yakin ingin menghapus live stream ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 text-white px-4 md:px-6 py-2 md:py-3 rounded-lg hover:bg-red-600 transition-colors font-semibold inline-flex items-center text-sm md:text-base">
                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <!-- Status Alert -->
        @if ($liveStream->status == 'live')
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg animate-pulse">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-red-800">
                            🔴 Live Stream sedang berlangsung!
                        </p>
                    </div>
                </div>
            </div>
        @elseif($liveStream->status == 'scheduled')
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-yellow-800">
                            📅 Live Stream dijadwalkan pada {{ $liveStream->jadwal_tayang->format('d M Y, H:i') }} WIB
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-gray-50 border-l-4 border-gray-400 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-gray-800">
                            ⏹️ Live Stream telah berakhir
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Video Player / Embed -->
        @if ($liveStream->embed_code)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-azhar-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Player Video
                        </h4>
                        <a href="{{ $liveStream->stream_url }}" target="_blank"
                            class="text-sm text-azhar-blue-600 hover:text-azhar-blue-700 font-semibold inline-flex items-center">
                            Buka di Platform
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="aspect-video bg-gray-900 rounded-lg overflow-hidden">
                        {!! $liveStream->embed_code !!}
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Embed Code Belum Tersedia</h3>
                <p class="text-gray-600 mb-6">Video player akan muncul setelah embed code di-generate</p>
                <a href="{{ $liveStream->stream_url }}" target="_blank"
                    class="inline-flex items-center text-white bg-azhar-blue-600 hover:bg-azhar-blue-700 px-6 py-3 rounded-lg font-semibold">
                    Buka Stream Langsung
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            </div>
        @endif

        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl shadow-md p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 font-semibold">Status</p>
                        @if ($liveStream->status == 'live')
                            <p class="text-lg font-black text-red-600 mt-1">🔴 Live</p>
                        @elseif($liveStream->status == 'scheduled')
                            <p class="text-lg font-black text-yellow-600 mt-1">📅 Scheduled</p>
                        @else
                            <p class="text-lg font-black text-gray-600 mt-1">⏹️ Ended</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 font-semibold">Platform</p>
                        <p class="text-lg font-black text-gray-900 mt-1">
                            @if ($liveStream->platform == 'youtube')
                                📺 YouTube
                            @elseif($liveStream->platform == 'facebook')
                                📘 Facebook
                            @elseif($liveStream->platform == 'instagram')
                                📷 Instagram
                            @elseif($liveStream->platform == 'zoom')
                                💻 Zoom
                            @else
                                🔗 Other
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 font-semibold">Viewers</p>
                        <p class="text-lg font-black text-azhar-blue-600 mt-1">
                            {{ number_format($liveStream->viewer_count) }}</p>
                    </div>
                    <div class="w-10 h-10 bg-azhar-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-azhar-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 font-semibold">ID Stream</p>
                        <p class="text-lg font-black text-gray-900 mt-1">#{{ $liveStream->id }}</p>
                    </div>
                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Main Information -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-azhar-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Informasi Utama
                </h4>
                <div class="space-y-4">
                    <div class="flex items-start gap-3 pb-4 border-b">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 font-semibold mb-1">Judul Live Stream</p>
                            <p class="text-sm font-bold text-gray-900">{{ $liveStream->judul }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 pb-4 border-b">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 font-semibold mb-1">Jadwal Tayang</p>
                            <p class="text-sm font-bold text-gray-900">
                                {{ $liveStream->jadwal_tayang->format('l, d F Y') }}</p>
                            <p class="text-xs text-gray-600">Pukul {{ $liveStream->jadwal_tayang->format('H:i') }} WIB</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 pb-4 border-b">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 font-semibold mb-1">Durasi Waktu</p>
                            <p class="text-sm font-bold text-gray-900">
                                @if ($liveStream->jadwal_tayang->isFuture())
                                    Akan dimulai {{ $liveStream->jadwal_tayang->diffForHumans() }}
                                @elseif($liveStream->status == 'live')
                                    <span class="text-red-600">Sedang Live Sekarang</span>
                                @else
                                    Selesai {{ $liveStream->jadwal_tayang->diffForHumans() }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 font-semibold mb-1">Stream URL</p>
                            <a href="{{ $liveStream->stream_url }}" target="_blank"
                                class="text-sm text-azhar-blue-600 hover:underline break-all">
                                {{ Str::limit($liveStream->stream_url, 60) }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event & Additional Info -->
            <div class="space-y-6">
                <!-- Event Card -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-azhar-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Event Terkait
                    </h4>
                    @if ($liveStream->event)
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 font-semibold mb-1">Judul Event</p>
                                <p class="text-sm font-bold text-gray-900">{{ $liveStream->event->judul }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold mb-1">Tanggal Event</p>
                                <p class="text-sm font-bold text-gray-900">{{ $liveStream->event->formatted_date }}</p>
                            </div>
                            @if ($liveStream->event->lokasi)
                                <div>
                                    <p class="text-xs text-gray-500 font-semibold mb-1">Lokasi</p>
                                    <p class="text-sm font-bold text-gray-900">{{ $liveStream->event->lokasi }}</p>
                                </div>
                            @endif
                            <a href="{{ route('admin.events.show', $liveStream->event) }}"
                                class="inline-flex items-center text-sm text-azhar-blue-600 hover:text-azhar-blue-700 font-semibold mt-2">
                                Lihat Detail Event
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 italic">Tidak terhubung dengan event</p>
                        </div>
                    @endif
                </div>

                <!-- Quick Actions Card -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-azhar-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Quick Actions
                    </h4>
                    <div class="space-y-2">
                        <a href="{{ $liveStream->stream_url }}" target="_blank"
                            class="w-full inline-flex items-center justify-between px-4 py-3 bg-azhar-blue-50 hover:bg-azhar-blue-100 text-azhar-blue-700 rounded-lg font-semibold transition-colors">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                                Buka di Platform
                            </span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>

                        @if ($liveStream->embed_code)
                            <button onclick="copyEmbedCode()"
                                class="w-full inline-flex items-center justify-between px-4 py-3 bg-green-50 hover:bg-green-100 text-green-700 rounded-lg font-semibold transition-colors">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Copy Embed Code
                                </span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        @endif

                        <button onclick="copyStreamUrl()"
                            class="w-full inline-flex items-center justify-between px-4 py-3 bg-purple-50 hover:bg-purple-100 text-purple-700 rounded-lg font-semibold transition-colors">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                    </path>
                                </svg>
                                Copy Stream URL
                            </span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Embed Code Section -->
        @if ($liveStream->embed_code)
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-azhar-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                        Embed Code
                    </h4>
                    <button onclick="copyEmbedCode()"
                        class="text-sm text-azhar-blue-600 hover:text-azhar-blue-700 font-semibold inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                        Copy Code
                    </button>
                </div>
                <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                    <pre class="text-xs text-gray-100"><code id="embedCodeContent">{{ $liveStream->embed_code }}</code></pre>
                </div>
                <p class="text-xs text-gray-500 mt-2">Gunakan code ini untuk embed video di website atau blog</p>
            </div>
        @endif

        <!-- Metadata -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-azhar-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Metadata
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Dibuat</p>
                            <p class="text-sm font-bold text-gray-900">
                                {{ $liveStream->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-600">{{ $liveStream->created_at->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Terakhir Update</p>
                            <p class="text-sm font-bold text-gray-900">
                                {{ $liveStream->updated_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-600">{{ $liveStream->updated_at->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Update Terakhir</p>
                            <p class="text-sm font-bold text-gray-900">{{ $liveStream->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyEmbedCode() {
            const embedCode = document.getElementById('embedCodeContent').textContent;
            navigator.clipboard.writeText(embedCode).then(() => {
                showNotification('✅ Embed code berhasil dicopy!', 'success');
            }).catch(err => {
                showNotification('❌ Gagal copy embed code', 'error');
                console.error(err);
            });
        }

        function copyStreamUrl() {
            const streamUrl = '{{ $liveStream->stream_url }}';
            navigator.clipboard.writeText(streamUrl).then(() => {
                showNotification('✅ Stream URL berhasil dicopy!', 'success');
            }).catch(err => {
                showNotification('❌ Gagal copy stream URL', 'error');
                console.error(err);
            });
        }

        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg font-semibold text-white z-50 animate-fade-in ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transition = 'opacity 0.3s';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
@endsection
