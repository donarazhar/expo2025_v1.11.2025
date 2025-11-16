@extends('admin.layouts.app')

@section('title', 'Tambah Live Stream')
@section('page-title', 'Tambah Live Stream')
@section('page-subtitle', 'Buat live stream baru')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Back Button -->
        <div>
            <a href="{{ route('admin.live-streams.index') }}"
                class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar Live Streams
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Form Live Stream Baru</h3>
                <p class="text-gray-600">Buat live streaming untuk event</p>
            </div>

            <form action="{{ route('admin.live-streams.store') }}" method="POST" class="space-y-6" x-data="liveStreamForm()">
                @csrf

                <!-- Judul -->
                <div>
                    <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Live Stream <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                        class="input-field {{ $errors->has('judul') ? 'border-red-500' : '' }}"
                        placeholder="Contoh: Live Opening Ceremony Expo 2025" required>
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Event -->
                <div>
                    <label for="event_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Event (Opsional)
                    </label>
                    <select id="event_id" name="event_id"
                        class="input-field {{ $errors->has('event_id') ? 'border-red-500' : '' }}">
                        <option value="">-- Pilih Event (Opsional) --</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->judul }} ({{ $event->formatted_date }})
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Hubungkan live stream dengan event tertentu</p>
                </div>

                <!-- Platform -->
                <div>
                    <label for="platform" class="block text-sm font-semibold text-gray-700 mb-2">
                        Platform <span class="text-red-500">*</span>
                    </label>
                    <select id="platform" name="platform" x-model="platform"
                        class="input-field {{ $errors->has('platform') ? 'border-red-500' : '' }}" required>
                        <option value="">-- Pilih Platform --</option>
                        <option value="youtube" {{ old('platform') == 'youtube' ? 'selected' : '' }}>📺 YouTube</option>
                        <option value="facebook" {{ old('platform') == 'facebook' ? 'selected' : '' }}>📘 Facebook Live
                        </option>
                        <option value="instagram" {{ old('platform') == 'instagram' ? 'selected' : '' }}>📷 Instagram Live
                        </option>
                        <option value="zoom" {{ old('platform') == 'zoom' ? 'selected' : '' }}>💻 Zoom</option>
                        <option value="other" {{ old('platform') == 'other' ? 'selected' : '' }}>🔗 Other</option>
                    </select>
                    @error('platform')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stream URL -->
                <div>
                    <label for="stream_url" class="block text-sm font-semibold text-gray-700 mb-2">
                        URL Stream <span class="text-red-500">*</span>
                    </label>
                    <input type="url" id="stream_url" name="stream_url" x-model="streamUrl"
                        value="{{ old('stream_url') }}"
                        class="input-field {{ $errors->has('stream_url') ? 'border-red-500' : '' }}"
                        placeholder="https://youtube.com/watch?v=..." required>
                    @error('stream_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">
                        <span x-show="platform === 'youtube'">Contoh: https://youtube.com/watch?v=VIDEO_ID</span>
                        <span x-show="platform === 'facebook'">Contoh: https://facebook.com/username/videos/VIDEO_ID</span>
                        <span x-show="platform === 'zoom'">Contoh: https://zoom.us/j/MEETING_ID</span>
                    </p>
                </div>

                <!-- Generate Embed Button -->
                <div x-show="platform && streamUrl" x-cloak>
                    <button type="button" @click="generateEmbed()" :disabled="generating"
                        class="bg-green-500 text-white px-6 py-2.5 rounded-lg hover:bg-green-600 transition-colors font-semibold inline-flex items-center disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                        <span x-text="generating ? 'Generating...' : 'Generate Embed Code'"></span>
                    </button>
                </div>

                <!-- Embed Code -->
                <div>
                    <label for="embed_code" class="block text-sm font-semibold text-gray-700 mb-2">
                        Embed Code (Opsional)
                    </label>
                    <textarea id="embed_code" name="embed_code" x-model="embedCode" rows="6"
                        class="input-field {{ $errors->has('embed_code') ? 'border-red-500' : '' }}"
                        placeholder="<iframe src='...'></iframe>">{{ old('embed_code') }}</textarea>
                    @error('embed_code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Akan di-generate otomatis untuk YouTube. Anda bisa custom untuk
                        platform lain.</p>
                </div>

                <!-- Embed Preview -->
                <div x-show="embedCode" x-cloak class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm font-semibold text-gray-700 mb-3">👁️ Preview Embed:</p>
                    <div class="bg-white rounded-lg overflow-hidden" x-html="embedCode"></div>
                </div>

                <!-- Jadwal Tayang -->
                <div>
                    <label for="jadwal_tayang" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jadwal Tayang <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local" id="jadwal_tayang" name="jadwal_tayang" value="{{ old('jadwal_tayang') }}"
                        class="input-field {{ $errors->has('jadwal_tayang') ? 'border-red-500' : '' }}" required>
                    @error('jadwal_tayang')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status"
                        class="input-field {{ $errors->has('status') ? 'border-red-500' : '' }}" required>
                        <option value="scheduled" {{ old('status', 'scheduled') == 'scheduled' ? 'selected' : '' }}>📅
                            Scheduled (Terjadwal)</option>
                        <option value="live" {{ old('status') == 'live' ? 'selected' : '' }}>🔴 Live (Sedang
                            Berlangsung)</option>
                        <option value="ended" {{ old('status') == 'ended' ? 'selected' : '' }}>⏹️ Ended (Selesai)
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Viewer Count -->
                <div>
                    <label for="viewer_count" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jumlah Viewer (Opsional)
                    </label>
                    <input type="number" id="viewer_count" name="viewer_count" value="{{ old('viewer_count', 0) }}"
                        min="0" class="input-field {{ $errors->has('viewer_count') ? 'border-red-500' : '' }}">
                    @error('viewer_count')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Jumlah viewer yang menonton (default: 0)</p>
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-4 pt-6 border-t">
                    <button type="submit" class="btn-primary flex-1 md:flex-none md:px-8">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Live Stream
                    </button>

                    <a href="{{ route('admin.live-streams.index') }}"
                        class="bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-600 transition-colors text-center font-semibold flex-1 md:flex-none">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Tips Card -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="font-bold text-blue-900 mb-2">💡 Tips Live Streaming</h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Pastikan URL stream sudah benar dan dapat diakses</li>
                        <li>• Gunakan fitur "Generate Embed Code" untuk YouTube</li>
                        <li>• Set status "Scheduled" untuk live stream yang belum dimulai</li>
                        <li>• Ubah status menjadi "Live" saat streaming berlangsung</li>
                        <li>• Test embed code sebelum publikasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function liveStreamForm() {
            return {
                platform: '{{ old('platform', '') }}',
                streamUrl: '{{ old('stream_url', '') }}',
                embedCode: `{{ old('embed_code', '') }}`,
                generating: false,

                async generateEmbed() {
                    if (!this.platform || !this.streamUrl) {
                        alert('Pilih platform dan masukkan URL terlebih dahulu');
                        return;
                    }

                    this.generating = true;

                    try {
                        const response = await fetch('{{ route('admin.live-streams.generate-embed') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                platform: this.platform,
                                url: this.streamUrl
                            })
                        });

                        const data = await response.json();

                        if (data.success && data.embed_code) {
                            this.embedCode = data.embed_code;
                            alert('Embed code berhasil di-generate!');
                        } else {
                            alert(data.message || 'Gagal generate embed code. Silakan masukkan manual.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan masukkan embed code manual.');
                    } finally {
                        this.generating = false;
                    }
                }
            }
        }
    </script>
@endsection
