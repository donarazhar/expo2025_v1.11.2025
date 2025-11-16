@extends('admin.layouts.app')

@section('title', 'Daftar FAQs')
@section('page-title', 'FAQs')
@section('page-subtitle', 'Kelola Frequently Asked Questions')

@section('content')
    <div class="space-y-6">

        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Daftar FAQs</h3>
                    <p class="text-sm text-gray-600">Total: <span class="font-semibold">{{ $faqs->total() }}</span> FAQ</p>
                </div>
            </div>

            <a href="{{ route('admin.faqs.create') }}" class="btn-primary inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah FAQ Baru
            </a>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form method="GET" action="{{ route('admin.faqs.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                            🔍 Cari FAQ
                        </label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            class="input-field" placeholder="Cari pertanyaan atau jawaban...">
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

                    <!-- Filter Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status
                        </label>
                        <select id="status" name="status" class="input-field">
                            <option value="">Semua Status</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published
                            </option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
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

                    @if (request()->hasAny(['search', 'kategori', 'status']))
                        <a href="{{ route('admin.faqs.index') }}"
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

        <!-- FAQs List -->
        @if ($faqs->count() > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">

                <!-- Table Desktop -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-20">
                                    Urutan
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Pertanyaan
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Views
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" x-data="sortable()">
                            @foreach ($faqs as $faq)
                                <tr class="hover:bg-gray-50 transition-colors" data-id="{{ $faq->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="cursor-move drag-handle">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 8h16M4 16h16"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-bold text-gray-700">{{ $faq->urutan }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="text-sm font-bold text-gray-900">
                                                {{ Str::limit($faq->pertanyaan, 80) }}</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ Str::limit($faq->jawaban, 100) }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                            {{ $faq->kategori }}
                                        </span>
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
                                                class="text-sm text-gray-700">{{ number_format($faq->view_count) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <form action="{{ route('admin.faqs.toggle-publish', $faq) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $faq->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                @if ($faq->is_published)
                                                    ✓ Published
                                                @else
                                                    📝 Draft
                                                @endif
                                            </button>
                                        </form>
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
                                                <a href="{{ route('admin.faqs.show', $faq) }}"
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
                                                <a href="{{ route('admin.faqs.edit', $faq) }}"
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
                                                    <span class="font-medium">Edit FAQ</span>
                                                </a>

                                                <!-- Duplicate -->
                                                <form action="{{ route('admin.faqs.duplicate', $faq) }}" method="POST">
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
                                                        <span class="font-medium">Duplikat FAQ</span>
                                                    </button>
                                                </form>

                                                <!-- Divider -->
                                                <div class="border-t border-gray-200 my-2"></div>

                                                <!-- Delete -->
                                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
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
                                                        <span class="font-medium">Hapus FAQ</span>
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
                    @foreach ($faqs as $faq)
                        <div class="p-4 hover:bg-gray-50 transition-colors">
                            <div class="space-y-3">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-gray-100 text-gray-800">
                                                #{{ $faq->urutan }}
                                            </span>
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                                {{ $faq->kategori }}
                                            </span>
                                        </div>
                                        <h4 class="font-bold text-gray-900 text-sm mb-1">{{ $faq->pertanyaan }}</h4>
                                        <p class="text-xs text-gray-600 line-clamp-2">{{ Str::limit($faq->jawaban, 100) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between text-xs text-gray-600">
                                    <div class="flex items-center gap-4">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            {{ number_format($faq->view_count) }}
                                        </span>
                                        <form action="{{ route('admin.faqs.toggle-publish', $faq) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="px-2 py-1 rounded-full {{ $faq->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} font-semibold">
                                                {{ $faq->is_published ? 'Published' : 'Draft' }}
                                            </button>
                                        </form>
                                    </div>

                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.faqs.show', $faq) }}"
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
                                        <a href="{{ route('admin.faqs.edit', $faq) }}"
                                            class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                @if ($faqs->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $faqs->links() }}
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada FAQ</h3>
                <p class="text-gray-600 mb-6">Mulai buat FAQ untuk membantu pengunjung</p>
                <a href="{{ route('admin.faqs.create') }}" class="btn-primary inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah FAQ Pertama
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
                    const tbody = this.$el;
                    new Sortable(tbody, {
                        animation: 150,
                        handle: '.drag-handle',
                        onEnd: async (evt) => {
                            const items = Array.from(tbody.querySelectorAll('tr')).map((tr, index) => ({
                                id: parseInt(tr.dataset.id),
                                urutan: index + 1
                            }));

                            try {
                                const response = await fetch('{{ route('admin.faqs.reorder') }}', {
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
                                    // Update urutan numbers in UI
                                    tbody.querySelectorAll('tr').forEach((tr, index) => {
                                        tr.querySelector('.text-sm.font-bold').textContent = index + 1;
                                    });

                                    // Show success notification (optional)
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
