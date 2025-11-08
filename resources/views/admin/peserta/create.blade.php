@extends('admin.layouts.app')

@section('title', 'Tambah Peserta')
@section('page-title', 'Tambah Peserta')
@section('page-subtitle', 'Form pendaftaran peserta baru')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.peserta.index') }}" class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Peserta
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('admin.peserta.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Nama Lengkap -->
            <div>
                <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="nama_lengkap" 
                    name="nama_lengkap" 
                    value="{{ old('nama_lengkap') }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('nama_lengkap') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors"
                    placeholder="Contoh: Ahmad Zainuddin"
                    required>
                @error('nama_lengkap')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors"
                    placeholder="contoh@email.com"
                    required>
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Email akan digunakan untuk mengirim konfirmasi dan sertifikat</p>
            </div>

            <!-- Nomor HP -->
            <div>
                <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nomor HP <span class="text-red-500">*</span>
                </label>
                <input 
                    type="tel" 
                    id="no_hp" 
                    name="no_hp" 
                    value="{{ old('no_hp') }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('no_hp') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors"
                    placeholder="08123456789 atau +6281234567890"
                    required>
                @error('no_hp')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Format: 08xxx atau +628xxx atau 628xxx</p>
            </div>

            <!-- Asal Instansi -->
            <div>
                <label for="asal_instansi" class="block text-sm font-semibold text-gray-700 mb-2">
                    Asal Instansi <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="asal_instansi" 
                    name="asal_instansi" 
                    value="{{ old('asal_instansi') }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('asal_instansi') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors"
                    placeholder="Contoh: SMA Al Azhar Jakarta"
                    required>
                @error('asal_instansi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Informasi:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>ID Peserta akan di-generate otomatis</li>
                            <li>QR Code akan dibuat setelah data disimpan</li>
                            <li>Email konfirmasi akan dikirim ke peserta</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 pt-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-azhar-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-azhar-blue-600 focus:outline-none focus:ring-4 focus:ring-azhar-blue-200 transition-all">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Peserta
                </button>
                <a href="{{ route('admin.peserta.index') }}" 
                   class="bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 transition-colors text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection