@extends('admin.layouts.app')

@section('title', 'Live Streaming')
@section('page-title', 'Live Streaming')
@section('page-subtitle', 'Kelola live streaming event')

@section('content')
    <div class="space-y-6">

        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Live Streaming</h3>
                    <p class="text-sm text-gray-600">Total: <span class="font-semibold">{{ $streams->total() }}</span>
                        stream</p>
                </div>
            </div>

            <a href="{{ route('admin.live-streams.create') }}" class="btn-primary inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Live Stream
            </a>
        </div>

        <!-- Statistics Cards - 4 Columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Card -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Total Streams</p>
                        <p class="text-3xl font-black text-gray-900 mt-1">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Live Card -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Live Now</p>
                        <p class="text-3xl font-black text-red-600 mt-1">{{ $stats['live'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center relative">
                        <div class="w-3 h-3 bg-red-600 rounded-full animate-pulse"></div>
                        <div class="absolute w-5 h-5 bg-red-400 rounded-full animate-ping opacity-75"></div>
                    </div>
                </div>
            </div>

            <!-- Scheduled Card -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Scheduled</p>
                        <p class="text-3xl font-black text-yellow-600 mt-1">{{ $stats['scheduled'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Ended Card -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Ended</p>
                        <p class="text-3xl font-black text-gray-600 mt-1">{{ $stats['ended'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Viewers Card - Full Width -->
        <div
            class="bg-gradient-to-r from-azhar-blue-500 to-azhar-blue-600 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between text-blue-600">
                <div>
                    <p class="text-sm font-semibold opacity-90">Total Viewers</p>
                    <p class="text-4xl font-black mt-1">{{ number_format($stats['total_viewers']) }}</p>
                    <p class="text-xs opacity-75 mt-1">Across all live streams</p>
                </div>
                <div class="w-16 h-16 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Filters & Search - 4 Columns Layout -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form method="GET" action="{{ route('admin.live-streams.index') }}" class="space-y-6">
                <!-- Search Bar - Full Width -->
                <div>
                    <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari Live Stream
                    </label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-azhar-blue-500 focus:border-transparent transition-all"
                        placeholder="Cari judul, URL, atau event...">
                </div>

                <!-- Filters Grid - 4 Columns -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Filter Event -->
                    <div>
                        <label for="event_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            📅 Event
                        </label>
                        <select id="event_id" name="event_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-azhar-blue-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">Semua Event</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}"
                                    {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                    {{ $event->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Platform -->
                    <div>
                        <label for="platform" class="block text-sm font-semibold text-gray-700 mb-2">
                            🎥 Platform
                        </label>
                        <select id="platform" name="platform"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-azhar-blue-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">Semua Platform</option>
                            <option value="youtube" {{ request('platform') == 'youtube' ? 'selected' : '' }}>YouTube
                            </option>
                            <option value="facebook" {{ request('platform') == 'facebook' ? 'selected' : '' }}>Facebook
                            </option>
                            <option value="instagram" {{ request('platform') == 'instagram' ? 'selected' : '' }}>Instagram
                            </option>
                            <option value="zoom" {{ request('platform') == 'zoom' ? 'selected' : '' }}>Zoom</option>
                            <option value="other" {{ request('platform') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            🔴 Status
                        </label>
                        <select id="status" name="status"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-azhar-blue-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">Semua Status</option>
                            <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled
                            </option>
                            <option value="live" {{ request('status') == 'live' ? 'selected' : '' }}>Live</option>
                            <option value="ended" {{ request('status') == 'ended' ? 'selected' : '' }}>Ended</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-end gap-2">
                        <button type="submit"
                            class="flex-1 bg-azhar-blue-500 text-white px-4 py-3 rounded-lg hover:bg-azhar-blue-600 transition-all font-semibold shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            Filter
                        </button>

                        @if (request()->hasAny(['search', 'event_id', 'platform', 'status']))
                            <a href="{{ route('admin.live-streams.index') }}"
                                class="bg-gray-500 text-white px-4 py-3 rounded-lg hover:bg-gray-600 transition-all font-semibold shadow-md hover:shadow-lg flex items-center justify-center"
                                title="Reset Filter">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Streams List -->
        @if ($streams->count() > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">

                <!-- Table Desktop -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Live Stream
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Event
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Platform
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Jadwal
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Viewers
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($streams as $stream)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="text-sm font-bold text-gray-900">{{ $stream->judul }}</p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ Str::limit($stream->stream_url, 50) }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($stream->event)
                                            <p class="text-sm text-gray-900 font-semibold">
                                                {{ Str::limit($stream->event->judul, 30) }}</p>
                                            <p class="text-xs text-gray-500">{{ $stream->event->formatted_date }}</p>
                                        @else
                                            <p class="text-sm text-gray-500 italic">-</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($stream->platform == 'youtube')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                📺 YouTube
                                            </span>
                                        @elseif($stream->platform == 'facebook')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                📘 Facebook
                                            </span>
                                        @elseif($stream->platform == 'instagram')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-pink-100 text-pink-800">
                                                📷 Instagram
                                            </span>
                                        @elseif($stream->platform == 'zoom')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800">
                                                💻 Zoom
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                                                🔗 Other
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-900 font-semibold">
                                            {{ $stream->jadwal_tayang->format('d M Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ $stream->jadwal_tayang->format('H:i') }} WIB
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            <span
                                                class="text-sm font-semibold text-gray-700">{{ number_format($stream->viewer_count) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($stream->status == 'live')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                🔴 Live
                                            </span>
                                        @elseif($stream->status == 'scheduled')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                                📅 Scheduled
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                                                ⏹️ Ended
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="relative inline-block" x-data="{ open: false }">
                                            <!-- Three Dots Button -->
                                            <button @click="open = !open" @click.away="open = false"
                                                class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                                                aria-label="Menu aksi" aria-expanded="false"
                                                x-bind:aria-expanded="open.toString()">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown Menu -->
                                            <div x-show="open" x-transition:enter="transition ease-out duration-150"
                                                x-transition:enter-start="transform opacity-0 scale-95 -translate-y-2"
                                                x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                                                x-transition:leave="transition ease-in duration-100"
                                                x-transition:leave-start="transform opacity-100 scale-100"
                                                x-transition:leave-end="transform opacity-0 scale-95"
                                                class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-50 overflow-hidden"
                                                style="display: none;" @click.away="open = false">

                                                <!-- View -->
                                                <a href="{{ route('admin.live-streams.show', $stream) }}"
                                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors group">
                                                    <div
                                                        class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <span class="font-medium">Lihat Detail</span>
                                                </a>

                                                <!-- Edit -->
                                                <a href="{{ route('admin.live-streams.edit', $stream) }}"
                                                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 transition-colors group">
                                                    <div
                                                        class="flex items-center justify-center w-8 h-8 rounded-lg bg-yellow-50 text-yellow-600 group-hover:bg-yellow-100 transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <span class="font-medium">Edit Stream</span>
                                                </a>

                                                <!-- Duplicate -->
                                                <form action="{{ route('admin.live-streams.duplicate', $stream) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors text-left group">
                                                        <div
                                                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-green-50 text-green-600 group-hover:bg-green-100 transition-colors">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <span class="font-medium">Duplikat Stream</span>
                                                    </button>
                                                </form>

                                                <!-- Divider -->
                                                <div class="border-t border-gray-200 my-2"></div>

                                                <!-- Delete -->
                                                <form action="{{ route('admin.live-streams.destroy', $stream) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus live stream ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors text-left group">
                                                        <div
                                                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 group-hover:bg-red-100 transition-colors">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <span class="font-medium">Hapus Stream</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Cards Mobile -->
                <div class="lg:hidden divide-y divide-gray-200">
                    @foreach ($streams as $stream)
                        <div class="p-4 hover:bg-gray-50 transition-colors">
                            <div class="space-y-3">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900 text-sm mb-1">{{ $stream->judul }}</h4>
                                        <p class="text-xs text-gray-600">
                                            {{ $stream->jadwal_tayang->format('d M Y, H:i') }} WIB</p>
                                        @if ($stream->event)
                                            <p class="text-xs text-gray-500 mt-1">{{ $stream->event->judul }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center justify-between text-xs">
                                    <div class="flex gap-2 flex-wrap">
                                        @if ($stream->platform == 'youtube')
                                            <span
                                                class="px-2 py-1 rounded-full bg-red-100 text-red-800 font-semibold">YouTube</span>
                                        @elseif($stream->platform == 'facebook')
                                            <span
                                                class="px-2 py-1 rounded-full bg-blue-100 text-blue-800 font-semibold">Facebook</span>
                                        @elseif($stream->platform == 'instagram')
                                            <span
                                                class="px-2 py-1 rounded-full bg-pink-100 text-pink-800 font-semibold">Instagram</span>
                                        @elseif($stream->platform == 'zoom')
                                            <span
                                                class="px-2 py-1 rounded-full bg-indigo-100 text-indigo-800 font-semibold">Zoom</span>
                                        @else
                                            <span
                                                class="px-2 py-1 rounded-full bg-gray-100 text-gray-800 font-semibold">Other</span>
                                        @endif

                                        @if ($stream->status == 'live')
                                            <span class="px-2 py-1 rounded-full bg-red-100 text-red-800 font-semibold">🔴
                                                Live</span>
                                        @elseif($stream->status == 'scheduled')
                                            <span
                                                class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 font-semibold">Scheduled</span>
                                        @else
                                            <span
                                                class="px-2 py-1 rounded-full bg-gray-100 text-gray-800 font-semibold">Ended</span>
                                        @endif
                                    </div>

                                    <span class="text-gray-600">👁️ {{ number_format($stream->viewer_count) }}</span>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('admin.live-streams.show', $stream) }}"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.live-streams.edit', $stream) }}"
                                        class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.live-streams.destroy', $stream) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($streams->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $streams->links() }}
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Live Stream</h3>
                <p class="text-gray-600 mb-6">Mulai tambahkan live streaming untuk event</p>
                <a href="{{ route('admin.live-streams.create') }}" class="btn-primary inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Live Stream Pertama
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
