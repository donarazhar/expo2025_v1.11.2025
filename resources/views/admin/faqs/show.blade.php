@extends('admin.layouts.app')

@section('title', 'Detail FAQ')
@section('page-title', 'Detail FAQ')
@section('page-subtitle', 'Informasi lengkap FAQ')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <a href="{{ route('admin.faqs.index') }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar FAQs
            </a>

            <div class="flex gap-3">
                <a href="{{ route('admin.faqs.edit', $faq) }}"
                    class="bg-yellow-500 text-white px-6 py-2.5 rounded-lg hover:bg-yellow-600 transition-colors font-semibold inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit FAQ
                </a>

                <form action="{{ route('admin.faqs.toggle-publish', $faq) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-{{ $faq->is_published ? 'gray' : 'green' }}-500 text-white px-6 py-2.5 rounded-lg hover:bg-{{ $faq->is_published ? 'gray' : 'green' }}-600 transition-colors font-semibold inline-flex items-center">
                        @if ($faq->is_published)
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                </path>
                            </svg>
                            Unpublish
                        @else
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            Publish
                        @endif
                    </button>
                </form>

                <form action="{{ route('admin.faqs.duplicate', $faq) }}" method="POST" class="inline">
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

                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline"
                    onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
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

            <!-- FAQ Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Question Card -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-purple-100 text-purple-800">
                                    {{ $faq->kategori }}
                                </span>
                                @if ($faq->is_published)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800">
                                        ✓ Published
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gray-100 text-gray-800">
                                        📝 Draft
                                    </span>
                                @endif
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gray-100 text-gray-800">
                                    #{{ $faq->urutan }}
                                </span>
                            </div>

                            <h3 class="text-2xl font-black text-gray-900 mb-6">
                                <span class="text-azhar-blue-500">Q:</span> {{ $faq->pertanyaan }}
                            </h3>

                            <div class="prose prose-blue max-w-none">
                                <div class="bg-blue-50 border-l-4 border-azhar-blue-500 p-6 rounded-r-lg">
                                    <p class="text-lg text-gray-900 font-semibold mb-2">
                                        <span class="text-azhar-blue-500">A:</span> Jawaban
                                    </p>
                                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $faq->jawaban }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h4 class="text-lg font-bold text-gray-900 mb-6">📊 Statistik</h4>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-3xl font-black text-gray-900">{{ number_format($faq->view_count) }}</p>
                            <p class="text-sm text-gray-600 mt-1">Total Views</p>
                        </div>

                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-3xl font-black text-gray-900">{{ $faq->kategori }}</p>
                            <p class="text-sm text-gray-600 mt-1">Kategori</p>
                        </div>

                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-3xl font-black text-gray-900">{{ $faq->is_published ? 'Ya' : 'Tidak' }}</p>
                            <p class="text-sm text-gray-600 mt-1">Published</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">

                <!-- Quick Info -->
                <div class="bg-gradient-to-br from-azhar-blue-500 to-azhar-blue-600 rounded-xl shadow-md p-6 text-white">
                    <h4 class="font-bold text-lg mb-4">ℹ️ Info Cepat</h4>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-white/70">ID</p>
                            <p class="font-mono font-semibold">#{{ $faq->id }}</p>
                        </div>
                        <div>
                            <p class="text-white/70">Urutan</p>
                            <p class="font-semibold">{{ $faq->urutan }}</p>
                        </div>
                        <div>
                            <p class="text-white/70">Dibuat</p>
                            <p class="font-semibold">{{ $faq->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-white/70">Update Terakhir</p>
                            <p class="font-semibold">{{ $faq->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-white/70">Selisih Waktu</p>
                            <p class="font-semibold">{{ $faq->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="font-bold text-gray-900 mb-4">⚡ Quick Actions</h4>
                    <div class="space-y-3">
                        <a href="{{ route('admin.faqs.edit', $faq) }}"
                            class="block w-full bg-yellow-500 text-white text-center py-2.5 rounded-lg hover:bg-yellow-600 transition-colors font-semibold">
                            Edit FAQ
                        </a>

                        <form action="{{ route('admin.faqs.toggle-publish', $faq) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full bg-{{ $faq->is_published ? 'gray' : 'green' }}-500 text-white text-center py-2.5 rounded-lg hover:bg-{{ $faq->is_published ? 'gray' : 'green' }}-600 transition-colors font-semibold">
                                {{ $faq->is_published ? 'Unpublish' : 'Publish' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.faqs.duplicate', $faq) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full bg-green-500 text-white text-center py-2.5 rounded-lg hover:bg-green-600 transition-colors font-semibold">
                                Duplicate FAQ
                            </button>
                        </form>

                        <button onclick="window.print()"
                            class="block w-full bg-gray-500 text-white text-center py-2.5 rounded-lg hover:bg-gray-600 transition-colors font-semibold">
                            Print FAQ
                        </button>
                    </div>
                </div>

                <!-- Content Length -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="font-bold text-gray-900 mb-4">📏 Panjang Konten</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Pertanyaan</span>
                            <span class="font-bold text-gray-900">{{ strlen($faq->pertanyaan) }}/500 karakter</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-azhar-blue-500 h-2 rounded-full"
                                style="width: {{ (strlen($faq->pertanyaan) / 500) * 100 }}%"></div>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <span class="text-gray-600">Jawaban</span>
                            <span class="font-bold text-gray-900">{{ strlen($faq->jawaban) }} karakter</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Kata</span>
                            <span class="font-bold text-gray-900">{{ str_word_count($faq->jawaban) }} kata</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
