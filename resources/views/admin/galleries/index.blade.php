@extends('admin.layouts.app')

@section('title', 'Gallery')
@section('page-title', 'Gallery')
@section('page-subtitle', 'Kelola foto-foto event')

@section('content')
    <div class="space-y-6">

        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div
                    class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Gallery Foto</h3>
                    <p class="text-sm text-gray-600">Total: <span class="font-semibold">{{ $galleries->total() }}</span>
                        foto</p>
                </div>
            </div>

            <a href="{{ route('admin.galleries.create') }}" class="btn-primary inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Upload Foto Baru
            </a>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Total Foto</p>
                        <p class="text-3xl font-black text-gray-900 mt-1">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Event dengan Gallery</p>
                        <p class="text-3xl font-black text-purple-600 mt-1">{{ $stats['events_with_gallery'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form method="GET" action="{{ route('admin.galleries.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                            🔍 Cari Foto
                        </label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            class="input-field" placeholder="Cari judul, deskripsi, atau event...">
                    </div>

                    <!-- Filter Event -->
                    <div>
                        <label for="event_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Event
                        </label>
                        <select id="event_id" name="event_id" class="input-field">
                            <option value="">Semua Event</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}"
                                    {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                    {{ $event->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori
                        </label>
                        <select id="kategori" name="kategori" class="input-field">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}"
                                    {{ request('kategori') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
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

                    @if (request()->hasAny(['search', 'event_id', 'kategori']))
                        <a href="{{ route('admin.galleries.index') }}"
                            class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors font-semibold">
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

        <!-- Gallery Grid -->
        @if ($galleries->count() > 0)

            <!-- Bulk Actions -->
            <div class="bg-white rounded-xl shadow-md p-4" x-data="{ selectedIds: [], selectAll: false }" x-init="$watch('selectAll', value => selectedIds = value ? {{ $galleries->pluck('id') }} : [])">
                <form action="{{ route('admin.galleries.bulk-delete') }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <div class="flex items-center gap-2">
                        <input type="checkbox" x-model="selectAll"
                            class="w-5 h-5 text-azhar-blue-500 border-gray-300 rounded focus:ring-azhar-blue-500">
                        <span class="text-sm font-semibold text-gray-700">
                            Pilih Semua (<span x-text="selectedIds.length"></span>)
                        </span>
                    </div>

                    <template x-for="id in selectedIds" :key="id">
                        <input type="hidden" name="gallery_ids[]" :value="id">
                    </template>

                    <button type="submit" x-show="selectedIds.length > 0" x-cloak
                        onclick="return confirm('Yakin ingin menghapus foto yang dipilih?')"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors font-semibold text-sm">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Hapus (<span x-text="selectedIds.length"></span>)
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6" x-data="{ selectedIds: [], selectAll: false }">

                <!-- Grid Gallery -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" x-data="sortable()">
                    @foreach ($galleries as $gallery)
                        <div class="relative group" data-id="{{ $gallery->id }}">
                            <!-- Checkbox -->
                            <div class="absolute top-2 left-2 z-10">
                                <input type="checkbox" :checked="selectedIds.includes({{ $gallery->id }})"
                                    @change="selectedIds.includes({{ $gallery->id }}) ? selectedIds = selectedIds.filter(id => id !== {{ $gallery->id }}) : selectedIds.push({{ $gallery->id }})"
                                    class="w-5 h-5 text-azhar-blue-500 border-gray-300 rounded focus:ring-azhar-blue-500">
                            </div>

                            <!-- Drag Handle -->
                            <div
                                class="absolute top-2 right-2 z-10 drag-handle cursor-move bg-white/90 p-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 8h16M4 16h16"></path>
                                </svg>
                            </div>

                            <!-- Image -->
                            <a href="{{ route('admin.galleries.show', $gallery) }}" class="block">
                                <div class="aspect-square overflow-hidden rounded-lg bg-gray-100">
                                    <img src="{{ Storage::url($gallery->thumbnail ?? $gallery->image_path) }}"
                                        alt="{{ $gallery->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </div>
                            </a>

                            <!-- Info -->
                            <div class="mt-2">
                                <p class="text-sm font-bold text-gray-900 line-clamp-1">{{ $gallery->judul }}</p>
                                <div class="flex items-center justify-between mt-1">
                                    <span
                                        class="text-xs text-gray-600 px-2 py-1 bg-gray-100 rounded">{{ $gallery->kategori }}</span>
                                    <span class="text-xs text-gray-500">#{{ $gallery->urutan }}</span>
                                </div>
                                @if ($gallery->event)
                                    <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $gallery->event->judul }}</p>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-2 flex gap-2">
                                <a href="{{ route('admin.galleries.edit', $gallery) }}"
                                    class="flex-1 bg-yellow-500 text-white text-center py-2 rounded-lg hover:bg-yellow-600 transition-colors text-sm font-semibold">
                                    Edit
                                </a>
                                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST"
                                    class="flex-1" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition-colors text-sm font-semibold">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($galleries->hasPages())
                    <div class="mt-6 border-t pt-6">
                        {{ $galleries->links() }}
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Foto</h3>
                <p class="text-gray-600 mb-6">Mulai upload foto event ke gallery</p>
                <a href="{{ route('admin.galleries.create') }}" class="btn-primary inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Upload Foto Pertama
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function sortable() {
            return {
                init() {
                    const grid = this.$el;
                    new Sortable(grid, {
                        animation: 150,
                        handle: '.drag-handle',
                        onEnd: async (evt) => {
                            const items = Array.from(grid.querySelectorAll('[data-id]')).map((el, index) => ({
                                id: parseInt(el.dataset.id),
                                urutan: index + 1
                            }));

                            try {
                                const response = await fetch('{{ route('admin.galleries.reorder') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({
                                        items
                                    })
                                });

                                const data = await response.json();

                                if (data.success) {
                                    console.log('Urutan berhasil diupdate');
                                }
                            } catch (error) {
                                console.error('Error updating order:', error);
                                alert('Gagal mengupdate urutan. Silakan refresh halaman.');
                            }
                        }
                    });
                }
            }
        }
    </script>
@endsection
