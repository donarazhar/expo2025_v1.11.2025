@extends('admin.layouts.app')

@section('title', 'Daftar Feedbacks')
@section('page-title', 'Feedbacks')
@section('page-subtitle', 'Kelola feedback dan testimoni peserta')

@section('content')
    <div class="space-y-6">

        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Daftar Feedbacks</h3>
                    <p class="text-sm text-gray-600">Total: <span class="font-semibold">{{ $feedbacks->total() }}</span>
                        feedback</p>
                </div>
            </div>

            <a href="{{ route('admin.feedbacks.create') }}" class="btn-primary inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Feedback Baru
            </a>
        </div>

        <!-- Statistics Cards - 4 Columns -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            <!-- Total Card -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Total Feedback</p>
                        <p class="text-3xl font-black text-gray-900 mt-1">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Published Card -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Published</p>
                        <p class="text-3xl font-black text-green-600 mt-1">{{ $stats['published'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Card -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
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

            <!-- Featured Card -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Featured</p>
                        <p class="text-3xl font-black text-purple-600 mt-1">{{ $stats['featured'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Rating Card - Full Width Premium -->
        <div
            class="bg-gradient-to-r from-azhar-blue-500 to-azhar-blue rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between text-blue-600">
                <div>
                    <p class="text-sm font-semibold opacity-90">Average Rating</p>
                    <div class="flex items-center gap-2 mt-1">
                        <p class="text-4xl font-black">{{ $stats['avg_rating'] }}</p>
                        <div class="flex gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 {{ $i <= floor($stats['avg_rating']) ? 'text-yellow-300' : 'text-blue/30' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-xs opacity-75 mt-1">Based on {{ $stats['total'] }} feedback</p>
                </div>
                <div class="w-16 h-16 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-8 h-8 text-blue" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Filters & Search - 4 Columns Layout -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form method="GET" action="{{ route('admin.feedbacks.index') }}" class="space-y-6">
                <!-- Search Bar - Full Width -->
                <div>
                    <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari Feedback
                    </label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-azhar-blue-500 focus:border-transparent transition-all"
                        placeholder="Cari nama peserta, event, atau komentar...">
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

                    <!-- Filter Rating -->
                    <div>
                        <label for="rating" class="block text-sm font-semibold text-gray-700 mb-2">
                            ⭐ Rating
                        </label>
                        <select id="rating" name="rating"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-azhar-blue-500 focus:border-transparent transition-all appearance-none bg-white">
                            <option value="">Semua Rating</option>
                            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5)</option>
                            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4)</option>
                            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐ (3)</option>
                            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>⭐⭐ (2)</option>
                            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>⭐ (1)</option>
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
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published
                            </option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="featured" {{ request('status') == 'featured' ? 'selected' : '' }}>Featured
                            </option>
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

                        @if (request()->hasAny(['search', 'event_id', 'rating', 'status']))
                            <a href="{{ route('admin.feedbacks.index') }}"
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

        <!-- Feedbacks List -->
        @if ($feedbacks->count() > 0)

            <!-- Bulk Actions -->
            <div class="bg-white rounded-xl shadow-md p-4" x-data="{ selectedIds: [], selectAll: false }" x-init="$watch('selectAll', value => selectedIds = value ? {{ $feedbacks->pluck('id') }} : [])">
                <form action="{{ route('admin.feedbacks.bulk-action') }}" method="POST"
                    class="flex items-center gap-4">
                    @csrf
                    <div class="flex items-center gap-2">
                        <input type="checkbox" x-model="selectAll"
                            class="w-5 h-5 text-azhar-blue-500 border-gray-300 rounded focus:ring-azhar-blue-500">
                        <span class="text-sm font-semibold text-gray-700">
                            Pilih Semua (<span x-text="selectedIds.length"></span>)
                        </span>
                    </div>

                    <select name="action" class="input-field text-sm" style="width: auto;" required
                        x-show="selectedIds.length > 0" x-cloak>
                        <option value="">-- Bulk Action --</option>
                        <option value="publish">Publish</option>
                        <option value="unpublish">Unpublish</option>
                        <option value="feature">Feature</option>
                        <option value="unfeature">Unfeature</option>
                        <option value="delete">Hapus</option>
                    </select>

                    <template x-for="id in selectedIds" :key="id">
                        <input type="hidden" name="feedback_ids[]" :value="id">
                    </template>

                    <button type="submit" x-show="selectedIds.length > 0" x-cloak
                        onclick="return confirm('Yakin ingin menjalankan bulk action ini?')"
                        class="bg-azhar-blue-500 text-white px-4 py-2 rounded-lg hover:bg-azhar-blue-600 transition-colors font-semibold text-sm">
                        Jalankan
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden" x-data="{ selectedIds: [], selectAll: false }">

                <!-- Table Desktop -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 w-12">
                                    <input type="checkbox" x-model="selectAll"
                                        class="w-5 h-5 text-azhar-blue-500 border-gray-300 rounded">
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Peserta
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Event
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Rating
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Komentar
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
                            @foreach ($feedbacks as $feedback)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" :checked="selectedIds.includes({{ $feedback->id }})"
                                            @change="selectedIds.includes({{ $feedback->id }}) ? selectedIds = selectedIds.filter(id => id !== {{ $feedback->id }}) : selectedIds.push({{ $feedback->id }})"
                                            class="w-5 h-5 text-azhar-blue-500 border-gray-300 rounded">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            @if ($feedback->peserta)
                                                <p class="text-sm font-bold text-gray-900">
                                                    {{ $feedback->peserta->nama_lengkap }}</p>
                                                <p class="text-xs text-gray-500">{{ $feedback->peserta->asal_instansi }}
                                                </p>
                                            @else
                                                <p class="text-sm text-gray-500 italic">Peserta tidak ditemukan</p>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($feedback->event)
                                            <p class="text-sm text-gray-900 font-semibold">
                                                {{ Str::limit($feedback->event->judul, 30) }}</p>
                                            <p class="text-xs text-gray-500">{{ $feedback->event->formatted_date }}</p>
                                        @else
                                            <p class="text-sm text-gray-500 italic">Event tidak ditemukan</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            <div class="text-yellow-400 text-lg">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $feedback->rating)
                                                        ★
                                                    @else
                                                        ☆
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="text-sm font-bold text-gray-700">({{ $feedback->rating }})</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-700 line-clamp-2">
                                            {{ Str::limit($feedback->komentar, 100) }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex flex-col gap-2">
                                            <form action="{{ route('admin.feedbacks.toggle-publish', $feedback) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold {{ $feedback->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $feedback->is_published ? '✓ Published' : '📝 Draft' }}
                                                </button>
                                            </form>
                                            @if ($feedback->is_featured)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                                    ⭐ Featured
                                                </span>
                                            @endif
                                        </div>
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
                                                <a href="{{ route('admin.feedbacks.show', $feedback) }}"
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
                                                <a href="{{ route('admin.feedbacks.edit', $feedback) }}"
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
                                                    <span class="font-medium">Edit Feedback</span>
                                                </a>

                                                <!-- Divider -->
                                                <div class="border-t border-gray-200 my-2"></div>

                                                <!-- Delete -->
                                                <form action="{{ route('admin.feedbacks.destroy', $feedback) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus feedback ini?')">
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
                                                        <span class="font-medium">Hapus Feedback</span>
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
                    @foreach ($feedbacks as $feedback)
                        <div class="p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-3">
                                <input type="checkbox" :checked="selectedIds.includes({{ $feedback->id }})"
                                    @change="selectedIds.includes({{ $feedback->id }}) ? selectedIds = selectedIds.filter(id => id !== {{ $feedback->id }}) : selectedIds.push({{ $feedback->id }})"
                                    class="w-5 h-5 text-azhar-blue-500 border-gray-300 rounded mt-1">

                                <div class="flex-1 space-y-3">
                                    <div>
                                        @if ($feedback->peserta)
                                            <h4 class="font-bold text-gray-900 text-sm">
                                                {{ $feedback->peserta->nama_lengkap }}</h4>
                                            <p class="text-xs text-gray-600">{{ $feedback->peserta->asal_instansi }}</p>
                                        @else
                                            <h4 class="font-bold text-gray-500 text-sm italic">Peserta tidak ditemukan</h4>
                                        @endif

                                        @if ($feedback->event)
                                            <p class="text-xs text-gray-500 mt-1">{{ $feedback->event->judul }}</p>
                                        @else
                                            <p class="text-xs text-red-500 mt-1 italic">Event tidak ditemukan</p>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-1 text-yellow-400 text-lg">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $feedback->rating)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                        <span class="text-sm text-gray-700 ml-1">({{ $feedback->rating }})</span>
                                    </div>

                                    <p class="text-sm text-gray-700 line-clamp-2">{{ $feedback->komentar }}</p>

                                    <div class="flex items-center gap-2 flex-wrap">
                                        <form action="{{ route('admin.feedbacks.toggle-publish', $feedback) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="px-2 py-1 rounded-full text-xs font-bold {{ $feedback->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $feedback->is_published ? 'Published' : 'Draft' }}
                                            </button>
                                        </form>
                                        @if ($feedback->is_featured)
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                                Featured
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.feedbacks.show', $feedback) }}"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.feedbacks.edit', $feedback) }}"
                                            class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.feedbacks.destroy', $feedback) }}" method="POST"
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
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($feedbacks->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $feedbacks->links() }}
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Feedback</h3>
                <p class="text-gray-600 mb-6">Mulai tambahkan feedback dari peserta event</p>
                <a href="{{ route('admin.feedbacks.create') }}" class="btn-primary inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Feedback Pertama
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
