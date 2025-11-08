@extends('admin.layouts.app')

@section('title', 'Terbitkan Sertifikat')
@section('page-title', 'Terbitkan Sertifikat')
@section('page-subtitle', 'Generate e-sertifikat untuk peserta')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.sertifikat.index') }}" class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Sertifikat
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('admin.sertifikat.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Select Peserta -->
            <div>
                <label for="qr_code_token" class="block text-sm font-semibold text-gray-700 mb-2">
                    Pilih Peserta <span class="text-red-500">*</span>
                </label>
                <select 
                    id="qr_code_token" 
                    name="qr_code_token" 
                    class="w-full px-4 py-3 border-2 {{ $errors->has('qr_code_token') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors"
                    required>
                    <option value="">-- Pilih Peserta --</option>
                    @foreach($peserta as $p)
                    <option value="{{ $p->qr_code_token }}" {{ old('qr_code_token') == $p->qr_code_token ? 'selected' : '' }}>
                        {{ $p->id_peserta }} - {{ $p->nama_lengkap }} ({{ $p->email }})
                    </option>
                    @endforeach
                </select>
                @error('qr_code_token')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Hanya peserta yang belum memiliki sertifikat</p>
            </div>

            <!-- Tanggal Penerbitan -->
            <div>
                <label for="tgl_penerbitan" class="block text-sm font-semibold text-gray-700 mb-2">
                    Tanggal Penerbitan
                </label>
                <input 
                    type="date" 
                    id="tgl_penerbitan" 
                    name="tgl_penerbitan" 
                    value="{{ old('tgl_penerbitan', date('Y-m-d')) }}"
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors">
                <p class="mt-1 text-xs text-gray-500">Kosongkan untuk menggunakan tanggal hari ini</p>
            </div>

            <!-- Info Box -->
            <div class="bg-purple-50 border-l-4 border-purple-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-purple-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-sm text-purple-800">
                        <p class="font-semibold mb-1">Informasi:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Nomor sertifikat akan di-generate otomatis</li>
                            <li>Format: CERT-AZEXP25-XXXXX</li>
                            <li>Sertifikat dapat dikirim via email setelah dibuat</li>
                            <li>QR Code verifikasi akan ditambahkan otomatis</li>
                        </ul>
                    </div>
                </div>
            </div>

            @if($peserta->count() == 0)
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <div class="text-sm text-yellow-800">
                        <p class="font-semibold">Tidak ada peserta yang bisa diterbitkan sertifikat</p>
                        <p class="mt-1">Semua peserta sudah memiliki sertifikat atau belum ada peserta yang terdaftar.</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Submit Buttons -->
            <div class="flex gap-4 pt-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-200 transition-all"
                    {{ $peserta->count() == 0 ? 'disabled' : '' }}>
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    Terbitkan Sertifikat
                </button>
                <a href="{{ route('admin.sertifikat.index') }}" 
                   class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition-colors text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Quick Action -->
    @if($peserta->count() > 0)
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-blue-900 mb-3">⚡ Quick Action</h3>
        <p class="text-sm text-blue-800 mb-4">Generate sertifikat untuk semua peserta yang sudah melakukan absensi sekaligus:</p>
        <form action="{{ route('admin.sertifikat.bulk-generate') }}" method="POST" onsubmit="return confirm('Generate sertifikat untuk semua peserta yang sudah absen?')">
            @csrf
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Bulk Generate Sertifikat
            </button>
        </form>
    </div>
    @endif
</div>
@endsection