@extends('admin.layouts.app')

@section('title', 'Data Peserta')
@section('page-title', 'Data Peserta')
@section('page-subtitle', 'Kelola data peserta event')

@section('content')
    <div class="space-y-6">

        <!-- Header & Actions -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Total: {{ $peserta->total() }} peserta</h3>
                @if (request()->hasAny(['search', 'start_date', 'end_date', 'instansi']))
                    <p class="text-sm text-gray-600 mt-1">Hasil filter dari {{ $peserta->total() }} peserta</p>
                @endif
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.peserta.create') }}" class="btn-primary">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Peserta
                </a>
                <a href="{{ route('admin.peserta.export.excel') }}?{{ http_build_query(request()->except('page')) }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Export Excel
                </a>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('admin.peserta.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Peserta</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Nama, email, HP, ID..." class="input-field w-full">
                    </div>

                    <!-- Instansi Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Asal Instansi</label>
                        <input type="text" name="instansi" value="{{ request('instansi') }}"
                            placeholder="Cari instansi..." class="input-field w-full">
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="input-field w-full">
                    </div>

                    <!-- End Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="input-field w-full">
                    </div>
                </div>

                <!-- Sort Options -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan Berdasarkan</label>
                        <select name="sort_by" class="input-field w-full">
                            <option value="tgl_registrasi" {{ request('sort_by') == 'tgl_registrasi' ? 'selected' : '' }}>
                                Tanggal Registrasi</option>
                            <option value="nama_lengkap" {{ request('sort_by') == 'nama_lengkap' ? 'selected' : '' }}>Nama
                            </option>
                            <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="asal_instansi" {{ request('sort_by') == 'asal_instansi' ? 'selected' : '' }}>
                                Instansi</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                        <select name="sort_order" class="input-field w-full">
                            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Terlama</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="bg-azhar-blue-500 text-white px-6 py-2 rounded-lg hover:bg-azhar-blue-600 transition-colors">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Filter
                    </button>
                    @if (request()->hasAny(['search', 'start_date', 'end_date', 'instansi', 'sort_by', 'sort_order']))
                        <a href="{{ route('admin.peserta.index') }}"
                            class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                            Reset Filter
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Active Filters Badge -->
        @if (request()->hasAny(['search', 'start_date', 'end_date', 'instansi']))
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-900 mb-2">Filter Aktif:</p>
                        <div class="flex flex-wrap gap-2">
                            @if (request('search'))
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                    Pencarian: "{{ request('search') }}"
                                    <a href="{{ route('admin.peserta.index', request()->except('search')) }}"
                                        class="ml-2 text-blue-600 hover:text-blue-800">×</a>
                                </span>
                            @endif

                            @if (request('instansi'))
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                    Instansi: "{{ request('instansi') }}"
                                    <a href="{{ route('admin.peserta.index', request()->except('instansi')) }}"
                                        class="ml-2 text-blue-600 hover:text-blue-800">×</a>
                                </span>
                            @endif

                            @if (request('start_date') && request('end_date'))
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                    Periode: {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
                                    <a href="{{ route('admin.peserta.index', request()->except(['start_date', 'end_date'])) }}"
                                        class="ml-2 text-blue-600 hover:text-blue-800">×</a>
                                </span>
                            @elseif(request('start_date'))
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                    Dari: {{ \Carbon\Carbon::parse(request('start_date'))->format('d M Y') }}
                                    <a href="{{ route('admin.peserta.index', request()->except('start_date')) }}"
                                        class="ml-2 text-blue-600 hover:text-blue-800">×</a>
                                </span>
                            @elseif(request('end_date'))
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                    Sampai: {{ \Carbon\Carbon::parse(request('end_date'))->format('d M Y') }}
                                    <a href="{{ route('admin.peserta.index', request()->except('end_date')) }}"
                                        class="ml-2 text-blue-600 hover:text-blue-800">×</a>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID /
                                Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kontak</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal
                                Instansi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Daftar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($peserta as $p)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-azhar-blue-100 rounded-lg flex items-center justify-center text-azhar-blue-600 font-bold mr-3">
                                            {{ substr($p->nama_lengkap, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">{{ $p->nama_lengkap }}</p>
                                            <p class="text-xs text-gray-500">{{ $p->id_peserta }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm text-gray-900">{{ $p->email }}</p>
                                    <p class="text-xs text-gray-500">{{ $p->no_hp }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-900">{{ $p->asal_instansi }}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm text-gray-900">{{ $p->tgl_registrasi->format('d M Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $p->tgl_registrasi->format('H:i') }}</p>
                                </td>

                                {{-- Action --}}
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
                                            <a href="{{ route('admin.peserta.show', $p->id_peserta) }}"
                                                class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors group">
                                                <div
                                                    class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <span class="font-medium">Lihat Detail</span>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('admin.peserta.edit', $p->id_peserta) }}"
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
                                                <span class="font-medium">Edit Peserta</span>
                                            </a>

                                            <!-- Divider -->
                                            <div class="border-t border-gray-200 my-2"></div>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.peserta.destroy', $p->id_peserta) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
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
                                                    <span class="font-medium">Hapus Peserta</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                    <p class="text-lg font-semibold">Tidak ada data peserta</p>
                                    <p class="text-sm mt-2">
                                        @if (request()->hasAny(['search', 'start_date', 'end_date', 'instansi']))
                                            Tidak ada hasil yang sesuai dengan filter. Coba ubah atau reset filter
                                            pencarian.
                                        @else
                                            Belum ada peserta yang terdaftar.
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($peserta->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $peserta->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
