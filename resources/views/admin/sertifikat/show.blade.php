@extends('admin.layouts.app')

@section('title', 'Detail Sertifikat')
@section('page-title', 'Detail Sertifikat')
@section('page-subtitle', 'Informasi lengkap sertifikat peserta')

@section('content')
<div class="space-y-6">
    
    <div>
        <a href="{{ route('admin.sertifikat.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-[#0053C5]">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-[#0053C5] to-[#003D91] px-6 py-4">
            <h3 class="text-xl font-bold text-white">Informasi Sertifikat</h3>
        </div>
        
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-semibold text-gray-600">Nama Peserta</label>
                    <p class="text-lg text-gray-800 mt-1">{{ $sertifikat->peserta->nama_lengkap }}</p>
                </div>
                
                <div>
                    <label class="text-sm font-semibold text-gray-600">Email</label>
                    <p class="text-lg text-gray-800 mt-1">{{ $sertifikat->peserta->email }}</p>
                </div>
                
                <div>
                    <label class="text-sm font-semibold text-gray-600">Nomor Sertifikat</label>
                    <p class="text-lg text-gray-800 mt-1 font-mono">{{ $sertifikat->nomor_sertifikat }}</p>
                </div>
                
                <div>
                    <label class="text-sm font-semibold text-gray-600">Tanggal Terbit</label>
                    <p class="text-lg text-gray-800 mt-1">{{ \Carbon\Carbon::parse($sertifikat->tanggal_terbit)->format('d M Y') }}</p>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-600">Status</label>
                    <p class="mt-1">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                            {{ $sertifikat->status === 'terbit' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($sertifikat->status) }}
                        </span>
                    </p>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-600">QR Code</label>
                    <div class="mt-2">
                        @if($sertifikat->qr_code)
                        <img src="{{ asset('storage/' . $sertifikat->qr_code) }}" alt="QR Code" class="w-32 h-32">
                        @else
                        <p class="text-gray-500 text-sm">Belum ada QR Code</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-4 pt-6 border-t">
                <a href="{{ route('admin.sertifikat.pdf', $sertifikat->id_sertifikat) }}" target="_blank"
                   class="bg-[#0053C5] text-white px-6 py-2 rounded-lg hover:bg-[#003D91]">
                    Download PDF
                </a>
                
                <a href="{{ route('admin.sertifikat.edit', $sertifikat->id_sertifikat) }}" 
                   class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">
                    Edit
                </a>
                
                <form action="{{ route('admin.sertifikat.destroy', $sertifikat->id_sertifikat) }}" method="POST" 
                      onsubmit="return confirm('Yakin hapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection