@extends('admin.layouts.app')

@section('title', 'Edit Live Stream')
@section('page-title', 'Edit Live Stream')
@section('page-subtitle', 'Ubah informasi live streaming')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.live-streams.index') }}"
                class="w-10 h-10 bg-white rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors shadow-md">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div
                class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">Edit Live Stream</h3>
                <p class="text-sm text-gray-600">Ubah informasi live streaming</p>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('admin.live-streams.update', $liveStream) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div>
                    <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                        📝 Judul Live Stream <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $liveStream->judul) }}"
                        class="input-field @error('judul') border-red-500 @enderror"
                        placeholder="Contoh: Kajian Tafsir Al-Quran Juz 1" required>
                    @error('judul')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Event (Optional) -->
                <div>
                    <label for="event_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        📅 Event (Opsional)
                    </label>
                    <select id="event_id" name="event_id" class="input-field @error('event_id') border-red-500 @enderror">
                        <option value="">- Pilih Event -</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}"
                                {{ old('event_id', $liveStream->event_id) == $event->id ? 'selected' : '' }}>
                                {{ $event->judul }} - {{ $event->formatted_date }}
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Hubungkan dengan event tertentu (jika ada)</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Platform -->
                    <div>
                        <label for="platform" class="block text-sm font-semibold text-gray-700 mb-2">
                            📺 Platform <span class="text-red-500">*</span>
                        </label>
                        <select id="platform" name="platform"
                            class="input-field @error('platform') border-red-500 @enderror" required>
                            <option value="">- Pilih Platform -</option>
                            <option value="youtube"
                                {{ old('platform', $liveStream->platform) == 'youtube' ? 'selected' : '' }}>
                                YouTube</option>
                            <option value="facebook"
                                {{ old('platform', $liveStream->platform) == 'facebook' ? 'selected' : '' }}>
                                Facebook</option>
                            <option value="instagram"
                                {{ old('platform', $liveStream->platform) == 'instagram' ? 'selected' : '' }}>Instagram
                            </option>
                            <option value="zoom"
                                {{ old('platform', $liveStream->platform) == 'zoom' ? 'selected' : '' }}>Zoom
                            </option>
                            <option value="other"
                                {{ old('platform', $liveStream->platform) == 'other' ? 'selected' : '' }}>
                                Other</option>
                        </select>
                        @error('platform')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            📊 Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status" class="input-field @error('status') border-red-500 @enderror"
                            required>
                            <option value="scheduled"
                                {{ old('status', $liveStream->status) == 'scheduled' ? 'selected' : '' }}>
                                📅 Scheduled</option>
                            <option value="live" {{ old('status', $liveStream->status) == 'live' ? 'selected' : '' }}>🔴
                                Live</option>
                            <option value="ended" {{ old('status', $liveStream->status) == 'ended' ? 'selected' : '' }}>⏹️
                                Ended</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Stream URL -->
                <div>
                    <label for="stream_url" class="block text-sm font-semibold text-gray-700 mb-2">
                        🔗 URL Stream <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-2">
                        <input type="url" id="stream_url" name="stream_url"
                            value="{{ old('stream_url', $liveStream->stream_url) }}"
                            class="input-field flex-1 @error('stream_url') border-red-500 @enderror"
                            placeholder="https://youtube.com/watch?v=..." required>
                        <button type="button" id="generateEmbedBtn"
                            class="px-4 py-2 bg-azhar-blue-500 text-white rounded-lg hover:bg-azhar-blue-600 transition-colors font-semibold whitespace-nowrap">
                            🔄 Generate Embed
                        </button>
                    </div>
                    @error('stream_url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Masukkan URL lengkap live stream</p>
                </div>

                <!-- Embed Code -->
                <div>
                    <label for="embed_code" class="block text-sm font-semibold text-gray-700 mb-2">
                        📺 Embed Code (Opsional)
                    </label>
                    <textarea id="embed_code" name="embed_code" rows="5"
                        class="input-field font-mono text-xs @error('embed_code') border-red-500 @enderror"
                        placeholder="<iframe src='...' width='100%' height='500'></iframe>">{{ old('embed_code', $liveStream->embed_code) }}</textarea>
                    @error('embed_code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Kode iframe untuk embed video (otomatis di-generate atau input
                        manual)</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Jadwal Tayang -->
                    <div>
                        <label for="jadwal_tayang" class="block text-sm font-semibold text-gray-700 mb-2">
                            📅 Jadwal Tayang <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" id="jadwal_tayang" name="jadwal_tayang"
                            value="{{ old('jadwal_tayang', $liveStream->jadwal_tayang->format('Y-m-d\TH:i')) }}"
                            class="input-field @error('jadwal_tayang') border-red-500 @enderror" required>
                        @error('jadwal_tayang')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Viewer Count -->
                    <div>
                        <label for="viewer_count" class="block text-sm font-semibold text-gray-700 mb-2">
                            👁️ Jumlah Viewer
                        </label>
                        <input type="number" id="viewer_count" name="viewer_count"
                            value="{{ old('viewer_count', $liveStream->viewer_count) }}" min="0"
                            class="input-field @error('viewer_count') border-red-500 @enderror" placeholder="0">
                        @error('viewer_count')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Preview Embed (if exists) -->
                @if ($liveStream->embed_code)
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            👁️ Preview Embed Saat Ini
                        </label>
                        <div class="bg-gray-100 rounded-lg p-4">
                            <div class="aspect-video">
                                {!! $liveStream->embed_code !!}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t">
                    <button type="submit"
                        class="btn-primary flex-1 sm:flex-none inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Update Live Stream
                    </button>
                    <a href="{{ route('admin.live-streams.index') }}"
                        class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-colors font-semibold text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('generateEmbedBtn').addEventListener('click', async function() {
            const platform = document.getElementById('platform').value;
            const url = document.getElementById('stream_url').value;
            const embedCodeField = document.getElementById('embed_code');

            if (!platform || !url) {
                alert('Platform dan URL stream harus diisi!');
                return;
            }

            this.disabled = true;
            this.innerHTML = '⏳ Generating...';

            try {
                const response = await fetch('{{ route('admin.live-streams.generate-embed') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        platform: platform,
                        url: url
                    })
                });

                const data = await response.json();

                if (data.success && data.embed_code) {
                    embedCodeField.value = data.embed_code;
                    alert('✅ ' + data.message);
                } else {
                    alert('⚠️ ' + data.message);
                }
            } catch (error) {
                alert('❌ Terjadi kesalahan saat generate embed code');
                console.error(error);
            } finally {
                this.disabled = false;
                this.innerHTML = '🔄 Generate Embed';
            }
        });
    </script>
@endsection
