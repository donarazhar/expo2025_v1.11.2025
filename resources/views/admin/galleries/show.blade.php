@extends('admin.layouts.app')

@section('title', 'Detail Foto Gallery')
@section('page-title', 'Detail Foto')
@section('page-subtitle', 'Informasi lengkap foto gallery')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">

        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <a href="{{ route('admin.galleries.index') }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Gallery
            </a>

            <div class="flex gap-3">
                <a href="{{ route('admin.galleries.edit', $gallery) }}"
                    class="bg-yellow-500 text-white px-6 py-2.5 rounded-lg hover:bg-yellow-600 transition-colors font-semibold inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit
                </a>

                <a href="{{ Storage::url($gallery->image_path) }}" download
                    class="bg-green-500 text-white px-6 py-2.5 rounded-lg hover:bg-green-600 transition-colors font-semibold inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download
                </a>

                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline"
                    onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
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

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Image Display -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Full Image -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="relative group">
                        <img src="{{ Storage::url($gallery->image_path) }}" alt="{{ $gallery->judul }}"
                            class="w-full h-auto">

                        <!-- Image Overlay Info -->
                        <div
                            class="absolute inset-0 bg-black/0 group-hover:bg-black/50 transition-all duration-300 flex items-end">
                            <div
                                class="p-6 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-full">
                                <p class="text-sm font-semibold">Click kanan → Save Image As untuk download</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Details -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $gallery->judul }}</h3>

                    @if ($gallery->deskripsi)
                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">📝 Deskripsi</h4>
                            <p class="text-gray-700 leading-relaxed">{{ $gallery->deskripsi }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Kategori</p>
                                <p class="text-gray-900 font-bold">{{ $gallery->kategori }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Urutan</p>
                                <p class="text-gray-900 font-bold">#{{ $gallery->urutan }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Info -->
                @if ($gallery->event)
                    <div class="bg-white rounded-xl shadow-md p-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">📅 Event Terkait</h4>

                        <div class="flex items-start gap-4">
                            @if ($gallery->event->banner_image)
                                <img src="{{ Storage::url($gallery->event->banner_image) }}"
                                    alt="{{ $gallery->event->judul }}"
                                    class="w-24 h-24 rounded-lg object-cover flex-shrink-0">
                            @else
                                <div
                                    class="w-24 h-24 rounded-lg bg-gradient-to-br from-azhar-blue-500 to-azhar-blue-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h5 class="text-lg font-bold text-gray-900 mb-2">{{ $gallery->event->judul }}</h5>
                                <div class="space-y-1 text-sm text-gray-600">
                                    <p>📅 {{ $gallery->event->formatted_date }}</p>
                                    <p>📍 {{ $gallery->event->lokasi }}</p>
                                    <p>📊 {{ $gallery->event->kategori }}</p>
                                </div>
                                <a href="{{ route('admin.events.show', $gallery->event) }}"
                                    class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold text-sm mt-3">
                                    Lihat Event →
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">

                <!-- Thumbnail Preview -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="font-bold text-gray-900 mb-4">🖼️ Thumbnail</h4>
                    @if ($gallery->thumbnail)
                        <img src="{{ Storage::url($gallery->thumbnail) }}" alt="Thumbnail"
                            class="w-full rounded-lg shadow-md">
                        <p class="text-xs text-gray-500 text-center mt-2">300x300px</p>
                    @else
                        <div class="bg-gray-100 rounded-lg p-8 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="text-sm text-gray-500 mt-2">No thumbnail</p>
                        </div>
                    @endif
                </div>

                <!-- Quick Info -->
                <div class="bg-gradient-to-br from-azhar-blue-500 to-azhar-blue-600 rounded-xl shadow-md p-6 text-white">
                    <h4 class="font-bold text-lg mb-4">ℹ️ Info Cepat</h4>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-white/70">ID</p>
                            <p class="font-mono font-semibold">#{{ $gallery->id }}</p>
                        </div>
                        <div>
                            <p class="text-white/70">Dibuat</p>
                            <p class="font-semibold">{{ $gallery->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-white/70">Update Terakhir</p>
                            <p class="font-semibold">{{ $gallery->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-white/70">Selisih Waktu</p>
                            <p class="font-semibold">{{ $gallery->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="font-bold text-gray-900 mb-4">⚡ Quick Actions</h4>
                    <div class="space-y-3">
                        <a href="{{ route('admin.galleries.edit', $gallery) }}"
                            class="block w-full bg-yellow-500 text-white text-center py-2.5 rounded-lg hover:bg-yellow-600 transition-colors font-semibold">
                            Edit Foto
                        </a>

                        <a href="{{ Storage::url($gallery->image_path) }}" download
                            class="block w-full bg-green-500 text-white text-center py-2.5 rounded-lg hover:bg-green-600 transition-colors font-semibold">
                            Download Foto
                        </a>

                        <a href="{{ Storage::url($gallery->image_path) }}" target="_blank"
                            class="block w-full bg-blue-500 text-white text-center py-2.5 rounded-lg hover:bg-blue-600 transition-colors font-semibold">
                            Buka di Tab Baru
                        </a>

                        <button onclick="window.print()"
                            class="block w-full bg-gray-500 text-white text-center py-2.5 rounded-lg hover:bg-gray-600 transition-colors font-semibold">
                            Print Info
                        </button>
                    </div>
                </div>

                <!-- File Info -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="font-bold text-gray-900 mb-4">📊 File Info</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Path</span>
                            <span class="font-mono text-xs text-gray-900">{{ basename($gallery->image_path) }}</span>
                        </div>
                        @if ($gallery->thumbnail)
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Thumbnail</span>
                                <span class="text-green-600 font-semibold">✓ Available</span>
                            </div>
                        @endif
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Storage</span>
                            <span class="font-semibold text-gray-900">Public</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
