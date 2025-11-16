@extends('admin.layouts.app')

@section('title', 'Daftar Events')
@section('page-title', 'Events')
@section('page-subtitle', 'Kelola semua event Al Azhar Expo 2025')

@section('content')
    <div class="space-y-6">

        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Daftar Events</h3>
                    <p class="text-sm text-gray-600">Total: <span class="font-semibold">{{ $events->total() }}</span> event
                    </p>
                </div>
            </div>

            <a href="{{ route('admin.events.create') }}" class="btn-primary inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Event Baru
            </a>
        </div>

        <!-- Filters & Search -->
        <div class="bg-blue rounded-xl shadow-md p-6">
            <form method="GET" action="{{ route('admin.events.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                            🔍 Cari Event
                        </label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            class="input-field" placeholder="Cari judul, deskripsi, atau lokasi...">
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status
                        </label>
                        <select id="status" name="status" class="input-field">
                            <option value="">Semua Status</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published
                            </option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                    </div>

                    <!-- Filter Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori
                        </label>
                        <select id="kategori" name="kategori" class="input-field">
                            <option value="">Semua Kategori</option>
                            <option value="workshop" {{ request('kategori') == 'workshop' ? 'selected' : '' }}>Workshop
                            </option>
                            <option value="seminar" {{ request('kategori') == 'seminar' ? 'selected' : '' }}>Seminar
                            </option>
                            <option value="webinar" {{ request('kategori') == 'webinar' ? 'selected' : '' }}>Webinar
                            </option>
                            <option value="talkshow" {{ request('kategori') == 'talkshow' ? 'selected' : '' }}>Talkshow
                            </option>
                            <option value="kompetisi" {{ request('kategori') == 'kompetisi' ? 'selected' : '' }}>Kompetisi
                            </option>
                            <option value="pameran" {{ request('kategori') == 'pameran' ? 'selected' : '' }}>Pameran
                            </option>
                            <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <button type="submit"
                        class="bg-azhar-blue-500 text-white px-6 py-2 rounded-lg hover:bg-azhar-blue-600 transition-colors font-semibold">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        Filter
                    </button>

                    @if (request()->hasAny(['search', 'status', 'kategori']))
                        <a href="{{ route('admin.events.index') }}"
                            class="bg-gray-500 text-blue px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors font-semibold">
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Events List -->
        @if ($events->count() > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">

                <!-- Table Desktop -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider"
                                    style="width: 30%;">
                                    Event
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider"
                                    style="width: 22%;">
                                    Tanggal & Lokasi
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider"
                                    style="width: 12%;">
                                    Kategori
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider"
                                    style="width: 16%;">
                                    Kapasitas
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider"
                                    style="width: 10%;">
                                    Status
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider"
                                    style="width: 10%;">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($events as $event)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <!-- Event Info -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-start gap-3">
                                            @if ($event->banner_image)
                                                <img src="{{ Storage::url($event->banner_image) }}"
                                                    alt="{{ $event->judul }}"
                                                    class="w-16 h-16 rounded-lg object-cover flex-shrink-0 shadow-sm">
                                            @else
                                                <div
                                                    class="w-16 h-16 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                                                    <svg class="w-8 h-8 text-blue" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <h4 class="text-sm font-bold text-gray-900 line-clamp-1">
                                                        {{ $event->judul }}
                                                    </h4>
                                                    @if ($event->is_featured)
                                                        <span
                                                            class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-bold bg-yellow-100 text-yellow-800 flex-shrink-0">
                                                            ⭐
                                                        </span>
                                                    @endif
                                                </div>
                                                <p class="text-xs text-gray-500 line-clamp-2">
                                                    {{ $event->deskripsi }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Date & Location -->
                                    <td class="px-6 py-4">
                                        <div class="space-y-2">
                                            <div class="flex items-start">
                                                <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0 mt-0.5"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <div class="flex-1 min-w-0">
                                                    <div class="text-sm font-semibold text-gray-900">
                                                        {{ $event->tanggal_mulai->format('d M Y') }}</div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $event->tanggal_mulai->format('H:i') }} -
                                                        {{ $event->tanggal_selesai->format('H:i') }}</div>
                                                </div>
                                            </div>
                                            <div class="flex items-start">
                                                <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0 mt-0.5"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <span
                                                    class="text-gray-700 text-xs line-clamp-2 flex-1 min-w-0">{{ $event->lokasi }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Category -->
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                            {{ ucfirst($event->kategori) }}
                                        </span>
                                    </td>

                                    <!-- Capacity -->
                                    <td class="px-6 py-4">
                                        <div class="text-center">
                                            <div class="text-sm font-bold text-gray-900 mb-2">
                                                {{ $event->registered_count }}/{{ $event->kapasitas == 0 ? '∞' : $event->kapasitas }}
                                            </div>
                                            @if ($event->kapasitas > 0)
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="h-2 rounded-full transition-all {{ $event->registered_count >= $event->kapasitas ? 'bg-red-500' : 'bg-blue-500' }}"
                                                        style="width: {{ min(($event->registered_count / $event->kapasitas) * 100, 100) }}%">
                                                    </div>
                                                </div>
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ $event->kapasitas - $event->registered_count > 0 ? $event->kapasitas - $event->registered_count . ' slot tersisa' : 'Penuh' }}
                                                </div>
                                            @else
                                                <div class="text-xs text-gray-500">Unlimited</div>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4 text-center">
                                        @if ($event->status == 'published')
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                                ✓ Published
                                            </span>
                                        @elseif($event->status == 'draft')
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                                                📝 Draft
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                ✕ Cancelled
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-2 py-1">
                                        <div class="relative" x-data="{ open: false }">
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
                                                <a href="{{ route('admin.events.show', $event) }}"
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
                                                <a href="{{ route('admin.events.edit', $event) }}"
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
                                                    <span class="font-medium">Edit Event</span>
                                                </a>

                                                <!-- Duplicate -->
                                                <form action="{{ route('admin.events.duplicate', $event) }}"
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
                                                        <span class="font-medium">Duplikat Event</span>
                                                    </button>
                                                </form>

                                                <!-- Divider -->
                                                <div class="border-t border-gray-200 my-2"></div>

                                                <!-- Delete -->
                                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus event {{ $event->judul }}?')">
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
                                                        <span class="font-medium">Hapus Event</span>
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
                    @foreach ($events as $event)
                        <div class="p-4 hover:bg-gray-50 transition-colors">
                            <div class="space-y-4">
                                <!-- Header with Image -->
                                <div class="flex gap-3">
                                    @if ($event->banner_image)
                                        <img src="{{ Storage::url($event->banner_image) }}" alt="{{ $event->judul }}"
                                            class="w-20 h-20 rounded-lg object-cover flex-shrink-0 shadow-sm">
                                    @else
                                        <div
                                            class="w-20 h-20 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-2 mb-1">
                                            <h4 class="font-bold text-gray-900 text-sm line-clamp-2">{{ $event->judul }}
                                            </h4>
                                            @if ($event->is_featured)
                                                <span class="text-yellow-500 text-lg flex-shrink-0">⭐</span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500 line-clamp-2">{{ $event->deskripsi }}</p>
                                    </div>
                                </div>

                                <!-- Event Details -->
                                <div class="space-y-2 text-xs">
                                    <div class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-900">
                                                {{ $event->tanggal_mulai->format('d M Y') }}</div>
                                            <div class="text-gray-500">{{ $event->tanggal_mulai->format('H:i') }} -
                                                {{ $event->tanggal_selesai->format('H:i') }}</div>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 text-gray-400 flex-shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                        </svg>
                                        <span class="text-gray-700 flex-1">{{ $event->lokasi }}</span>
                                    </div>
                                </div>

                                <!-- Badges & Progress -->
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span
                                            class="px-2.5 py-1 rounded-full bg-purple-100 text-purple-800 font-semibold text-xs">
                                            {{ ucfirst($event->kategori) }}
                                        </span>
                                        @if ($event->status == 'published')
                                            <span
                                                class="px-2.5 py-1 rounded-full bg-green-100 text-green-800 font-semibold text-xs">
                                                ✓ Published
                                            </span>
                                        @elseif($event->status == 'draft')
                                            <span
                                                class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-800 font-semibold text-xs">
                                                📝 Draft
                                            </span>
                                        @else
                                            <span
                                                class="px-2.5 py-1 rounded-full bg-red-100 text-red-800 font-semibold text-xs">
                                                ✕ Cancelled
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Capacity Progress -->
                                    <div>
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-xs font-semibold text-gray-700">
                                                {{ $event->registered_count }}/{{ $event->kapasitas == 0 ? '∞' : $event->kapasitas }}
                                                peserta
                                            </span>
                                            @if ($event->kapasitas > 0)
                                                <span class="text-xs text-gray-500">
                                                    {{ $event->kapasitas - $event->registered_count > 0 ? $event->kapasitas - $event->registered_count . ' tersisa' : 'Penuh' }}
                                                </span>
                                            @endif
                                        </div>
                                        @if ($event->kapasitas > 0)
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="h-2 rounded-full transition-all {{ $event->registered_count >= $event->kapasitas ? 'bg-red-500' : 'bg-blue-500' }}"
                                                    style="width: {{ min(($event->registered_count / $event->kapasitas) * 100, 100) }}%">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                                    <a href="{{ route('admin.events.show', $event) }}"
                                        class="px-3 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors text-sm font-medium">
                                        Detail
                                    </a>
                                    <a href="{{ route('admin.events.edit', $event) }}"
                                        class="px-3 py-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors text-sm font-medium">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors text-sm font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($events->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
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
                <p class="text-gray-600 mb-6">Mulai buat event pertama untuk Al Azhar Expo 2025</p>
                <a href="{{ route('admin.events.create') }}"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Event Pertama
                </a>
            </div>
        @endif

    </div>
@endsection
