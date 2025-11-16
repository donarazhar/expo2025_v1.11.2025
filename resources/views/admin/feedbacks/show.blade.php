@extends('admin.layouts.app')

@section('title', 'Detail Feedback')
@section('page-title', 'Detail Feedback')
@section('page-subtitle', 'Informasi lengkap feedback')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Header Actions -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <a href="{{ route('admin.feedbacks.index') }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar Feedbacks
            </a>

            <div class="flex gap-3">
                <a href="{{ route('admin.feedbacks.edit', $feedback) }}"
                    class="bg-yellow-500 text-white px-6 py-2.5 rounded-lg hover:bg-yellow-600 transition-colors font-semibold inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit
                </a>

                <form action="{{ route('admin.feedbacks.toggle-publish', $feedback) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-{{ $feedback->is_published ? 'gray' : 'green' }}-500 text-white px-6 py-2.5 rounded-lg hover:bg-{{ $feedback->is_published ? 'gray' : 'green' }}-600 transition-colors font-semibold inline-flex items-center">
                        @if ($feedback->is_published)
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

                <form action="{{ route('admin.feedbacks.toggle-featured', $feedback) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-{{ $feedback->is_featured ? 'gray' : 'purple' }}-500 text-white px-6 py-2.5 rounded-lg hover:bg-{{ $feedback->is_featured ? 'gray' : 'purple' }}-600 transition-colors font-semibold inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        {{ $feedback->is_featured ? 'Unfeature' : 'Feature' }}
                    </button>
                </form>

                <form action="{{ route('admin.feedbacks.destroy', $feedback) }}" method="POST" class="inline"
                    onsubmit="return confirm('Yakin ingin menghapus feedback ini?')">
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

            <!-- Feedback Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Feedback Card -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                @if ($feedback->is_published)
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
                                @if ($feedback->is_featured)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800">
                                        ⭐ Featured
                                    </span>
                                @endif
                            </div>

                            <!-- Rating -->
                            <div class="flex items-center gap-2 mb-6">
                                <div class="flex gap-1 text-yellow-400 text-3xl">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $feedback->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-2xl font-bold text-gray-900">({{ $feedback->rating }}/5)</span>
                            </div>

                            <!-- Comment -->
                            <div class="bg-gray-50 border-l-4 border-azhar-blue-500 p-6 rounded-r-lg mb-6">
                                <p class="text-lg text-gray-900 italic leading-relaxed">
                                    "{{ $feedback->komentar }}"
                                </p>
                            </div>

                            <!-- Peserta Info -->
                            <div class="border-t pt-6">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-azhar-blue-500 to-azhar-blue-600 rounded-full flex items-center justify-center text-white font-bold text-2xl flex-shrink-0">
                                        {{ substr($feedback->peserta->nama_lengkap, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900">{{ $feedback->peserta->nama_lengkap }}
                                        </h4>
                                        <p class="text-gray-600">{{ $feedback->peserta->asal_instansi }}</p>
                                        <p class="text-sm text-gray-500 mt-1">ID: {{ $feedback->peserta->id_peserta }} •
                                            {{ $feedback->peserta->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Info -->
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h4 class="text-lg font-bold text-gray-900 mb-4">📅 Event Terkait</h4>

                    <div class="flex items-start gap-4">
                        @if ($feedback->event->banner_image)
                            <img src="{{ Storage::url($feedback->event->banner_image) }}"
                                alt="{{ $feedback->event->judul }}"
                                class="w-24 h-24 rounded-lg object-cover flex-shrink-0">
                        @else
                            <div
                                class="w-24 h-24 rounded-lg bg-gradient-to-br from-azhar-blue-500 to-azhar-blue-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h5 class="text-lg font-bold text-gray-900 mb-2">{{ $feedback->event->judul }}</h5>
                            <div class="space-y-1 text-sm text-gray-600">
                                <p>📅 {{ $feedback->event->formatted_date }}</p>
                                <p>📍 {{ $feedback->event->lokasi }}</p>
                                <p>📊 {{ $feedback->event->kategori }}</p>
                            </div>
                            <a href="{{ route('admin.events.show', $feedback->event) }}"
                                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold text-sm mt-3">
                                Lihat Event →
                            </a>
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
                            <p class="text-white/70">ID Feedback</p>
                            <p class="font-mono font-semibold">#{{ $feedback->id }}</p>
                        </div>
                        <div>
                            <p class="text-white/70">Dibuat</p>
                            <p class="font-semibold">{{ $feedback->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-white/70">Update Terakhir</p>
                            <p class="font-semibold">{{ $feedback->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-white/70">Selisih Waktu</p>
                            <p class="font-semibold">{{ $feedback->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="font-bold text-gray-900 mb-4">⚡ Quick Actions</h4>
                    <div class="space-y-3">
                        <a href="{{ route('admin.feedbacks.edit', $feedback) }}"
                            class="block w-full bg-yellow-500 text-white text-center py-2.5 rounded-lg hover:bg-yellow-600 transition-colors font-semibold">
                            Edit Feedback
                        </a>

                        <form action="{{ route('admin.feedbacks.toggle-publish', $feedback) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full bg-{{ $feedback->is_published ? 'gray' : 'green' }}-500 text-white text-center py-2.5 rounded-lg hover:bg-{{ $feedback->is_published ? 'gray' : 'green' }}-600 transition-colors font-semibold">
                                {{ $feedback->is_published ? 'Unpublish' : 'Publish' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.feedbacks.toggle-featured', $feedback) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full bg-{{ $feedback->is_featured ? 'gray' : 'purple' }}-500 text-white text-center py-2.5 rounded-lg hover:bg-{{ $feedback->is_featured ? 'gray' : 'purple' }}-600 transition-colors font-semibold">
                                {{ $feedback->is_featured ? 'Unfeature' : 'Feature' }}
                            </button>
                        </form>

                        <button onclick="window.print()"
                            class="block w-full bg-gray-500 text-white text-center py-2.5 rounded-lg hover:bg-gray-600 transition-colors font-semibold">
                            Print Feedback
                        </button>
                    </div>
                </div>

                <!-- Rating Breakdown -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="font-bold text-gray-900 mb-4">⭐ Rating Detail</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Rating</span>
                            <span class="font-bold text-2xl text-yellow-500">{{ $feedback->rating }}/5</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-yellow-400 h-3 rounded-full"
                                style="width: {{ ($feedback->rating / 5) * 100 }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 text-center">{{ ($feedback->rating / 5) * 100 }}% dari maksimal
                        </p>
                    </div>
                </div>

                <!-- Content Stats -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h4 class="font-bold text-gray-900 mb-4">📊 Statistik Konten</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Panjang Komentar</span>
                            <span class="font-bold text-gray-900">{{ strlen($feedback->komentar) }} karakter</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Jumlah Kata</span>
                            <span class="font-bold text-gray-900">{{ str_word_count($feedback->komentar) }} kata</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
