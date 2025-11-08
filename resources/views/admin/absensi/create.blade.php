@extends('admin.layouts.app')

@section('title', 'Catat Absensi')
@section('page-title', 'Catat Absensi')
@section('page-subtitle', 'Scan QR Code atau input manual')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Back Button -->
    <div>
        <a href="{{ route('admin.absensi.index') }}" class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Absensi
        </a>
    </div>
    
    <!-- QR Scanner Card -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Scan QR Code</h3>
        <div class="bg-gray-100 rounded-lg p-8 text-center">
            <svg class="w-32 h-32 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
            </svg>
            <p class="text-gray-600 mb-4">QR Code Scanner akan ditampilkan di sini</p>
            <p class="text-sm text-gray-500">Fitur scanner membutuhkan library tambahan (html5-qrcode)</p>
        </div>
    </div>
    
    <!-- OR Divider -->
    <div class="flex items-center">
        <div class="flex-1 border-t border-gray-300"></div>
        <span class="px-4 text-sm text-gray-500 font-medium">ATAU</span>
        <div class="flex-1 border-t border-gray-300"></div>
    </div>
    
    <!-- Manual Input Form -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Input Manual</h3>
        
        <form action="{{ route('admin.absensi.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- QR Code Token -->
            <div>
                <label for="qr_code_token" class="block text-sm font-semibold text-gray-700 mb-2">
                    QR Code Token / ID Peserta <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="qr_code_token" 
                    name="qr_code_token" 
                    value="{{ old('qr_code_token') }}"
                    class="input-field {{ $errors->has('qr_code_token') ? 'border-red-500' : '' }}"
                    placeholder="Masukkan QR Code Token atau cari peserta..."
                    required>
                @error('qr_code_token')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Token QR Code peserta atau gunakan pencarian di bawah</p>
            </div>
            
            <!-- Peserta Search Helper -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm font-medium text-blue-800 mb-2">💡 Tips: Cari Peserta</p>
                <p class="text-xs text-blue-700">Buka <a href="{{ route('admin.peserta.index') }}" target="_blank" class="underline">daftar peserta</a> untuk melihat QR Code Token</p>
            </div>
            
            <!-- Petugas Scanner -->
            <div>
                <label for="petugas_scanner" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Petugas <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="petugas_scanner" 
                    name="petugas_scanner" 
                    value="{{ old('petugas_scanner', Auth::guard('admin')->user()->name) }}"
                    class="input-field {{ $errors->has('petugas_scanner') ? 'border-red-500' : '' }}"
                    placeholder="Nama petugas yang mencatat..."
                    required>
                @error('petugas_scanner')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Waktu Scan (Optional) -->
            <div>
                <label for="waktu_scan" class="block text-sm font-semibold text-gray-700 mb-2">
                    Waktu Scan (Opsional)
                </label>
                <input 
                    type="datetime-local" 
                    id="waktu_scan" 
                    name="waktu_scan" 
                    value="{{ old('waktu_scan') }}"
                    class="input-field">
                <p class="mt-1 text-xs text-gray-500">Kosongkan untuk menggunakan waktu sekarang</p>
            </div>
            
            <!-- Status Kehadiran -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Status Kehadiran
                </label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center">
                        <input 
                            type="radio" 
                            name="status_kehadiran" 
                            value="1" 
                            checked
                            class="w-4 h-4 text-azhar-blue-500 border-gray-300 focus:ring-azhar-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Hadir</span>
                    </label>
                    <label class="flex items-center">
                        <input 
                            type="radio" 
                            name="status_kehadiran" 
                            value="0"
                            class="w-4 h-4 text-azhar-blue-500 border-gray-300 focus:ring-azhar-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Tidak Hadir</span>
                    </label>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex gap-4 pt-4">
                <button 
                    type="submit" 
                    class="btn-primary flex-1">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Absensi
                </button>
                <a href="{{ route('admin.absensi.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-colors text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection