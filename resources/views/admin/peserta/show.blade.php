@extends('admin.layouts.app')

@section('title', 'Detail Peserta')
@section('page-title', 'Detail Peserta')
@section('page-subtitle', 'Informasi lengkap peserta')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    
    <!-- Back Button -->
    <div>
        <a href="{{ route('admin.peserta.index') }}" class="inline-flex items-center text-azhar-blue-500 hover:text-azhar-blue-600">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Peserta
        </a>
    </div>

    <!-- Main Info Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-azhar-blue to-azhar-blue-600 px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                        <span class="text-azhar-blue text-2xl font-bold">{{ substr($peserta->nama_lengkap, 0, 1) }}</span>
                    </div>
                    <div class="text-white">
                        <h2 class="text-2xl font-bold">{{ $peserta->nama_lengkap }}</h2>
                        <p class="text-azhar-blue-100">{{ $peserta->id_peserta }}</p>
                    </div>
                </div>
                <div class="text-right text-white">
                    <p class="text-sm text-azhar-blue-100">Terdaftar</p>
                    <p class="text-lg font-semibold">{{ $peserta->tgl_registrasi->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Email -->
                <div>
                    <p class="text-sm text-gray-600 mb-1">Email</p>
                    <p class="text-base font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        {{ $peserta->email }}
                    </p>
                </div>

                <!-- Nomor HP -->
                <div>
                    <p class="text-sm text-gray-600 mb-1">Nomor HP</p>
                    <p class="text-base font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        {{ $peserta->no_hp }}
                    </p>
                </div>

                <!-- Asal Instansi -->
                <div>
                    <p class="text-sm text-gray-600 mb-1">Asal Instansi</p>
                    <p class="text-base font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        {{ $peserta->asal_instansi }}
                    </p>
                </div>

                <!-- QR Token -->
                <div>
                    <p class="text-sm text-gray-600 mb-1">QR Code Token</p>
                    <p class="text-sm font-mono bg-gray-100 px-3 py-2 rounded text-gray-700">{{ $peserta->qr_code_token }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 mt-8 pt-6 border-t">
                <a href="{{ route('admin.peserta.edit', $peserta->id_peserta) }}" 
                   class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600 transition-colors">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Data
                </a>
                <form action="{{ route('admin.peserta.destroy', $peserta->id_peserta) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Absensi</p>
                    <p class="text-3xl font-bold text-azhar-blue-500">{{ $peserta->absensi->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Sertifikat</p>
                    <p class="text-3xl font-bold text-{{ $peserta->sertifikat ? 'green' : 'gray' }}-500">
                        {{ $peserta->sertifikat ? '✓' : '✗' }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-{{ $peserta->sertifikat ? 'green' : 'gray' }}-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-{{ $peserta->sertifikat ? 'green' : 'gray' }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
            </div>
            @if($peserta->sertifikat)
            <p class="text-xs text-gray-500 mt-2">{{ $peserta->sertifikat->nomor_sertifikat }}</p>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    <p class="text-lg font-bold text-green-500">Aktif</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Absensi -->
    @if($peserta->absensi->count() > 0)
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Riwayat Absensi</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu Scan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Petugas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($peserta->absensi as $abs)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $abs->waktu_scan->format('d M Y H:i:s') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $abs->petugas_scanner }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Hadir
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Sertifikat Info -->
    @if($peserta->sertifikat)
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Sertifikat</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Nomor Sertifikat</p>
                <p class="text-base font-semibold text-gray-900">{{ $peserta->sertifikat->nomor_sertifikat }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Tanggal Terbit</p>
                <p class="text-base font-semibold text-gray-900">{{ $peserta->sertifikat->tgl_penerbitan->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Status Kirim</p>
                <p class="text-base font-semibold text-{{ $peserta->sertifikat->status_kirim ? 'green' : 'yellow' }}-600">
                    {{ $peserta->sertifikat->status_kirim ? 'Terkirim' : 'Belum Terkirim' }}
                </p>
            </div>
            <div>
                <a href="{{ route('admin.sertifikat.show', $peserta->sertifikat->id_sertifikat) }}" 
                   class="inline-block bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition-colors text-sm">
                    Lihat Sertifikat
                </a>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection