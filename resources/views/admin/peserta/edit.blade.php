@extends('admin.layouts.app')

@section('title', 'Edit Peserta')
@section('page-title', 'Edit Peserta')
@section('page-subtitle', 'Update data peserta')

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
        
        <!-- ID Peserta Info -->
        <div class="mb-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">ID Peserta</p>
                    <p class="text-lg font-bold text-azhar-blue-500">{{ $peserta->id_peserta }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tgl Registrasi</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $peserta->tgl_registrasi->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.peserta.update', $peserta->id_peserta) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Nama Lengkap -->
            <div>
                <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="nama_lengkap" 
                    name="nama_lengkap" 
                    value="{{ old('nama_lengkap', $peserta->nama_lengkap) }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('nama_lengkap') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors"
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
                    value="{{ old('email', $peserta->email) }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors"
                    required>
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
                    value="{{ old('no_hp', $peserta->no_hp) }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('no_hp') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors"
                    required>
                @error('no_hp')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
                    value="{{ old('asal_instansi', $peserta->asal_instansi) }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('asal_instansi') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:outline-none focus:border-azhar-blue-500 transition-colors"
                    required>
                @error('asal_instansi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Warning Box -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <div class="text-sm text-yellow-800">
                        <p class="font-semibold mb-1">Perhatian:</p>
                        <ul class="list-disc list-inside">
                            <li>QR Code tidak akan berubah setelah update</li>
                            <li>Perubahan email tidak akan mengirim notifikasi otomatis</li>
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
                    Update Data
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