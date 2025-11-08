@extends('admin.layouts.app')

@section('title', 'Edit Absensi')
@section('page-title', 'Edit Absensi')
@section('page-subtitle', 'Ubah data absensi peserta')

@section('content')
<div class="space-y-6">
    
    <div>
        <a href="{{ route('admin.absensi.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-[#0053C5]">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-[#0053C5] to-[#003D91] px-6 py-4">
            <h3 class="text-xl font-bold text-white">Form Edit Absensi</h3>
        </div>
        
        <form action="{{ route('admin.absensi.update', $absensi->id_absensi) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Peserta</label>
                <input type="text" value="{{ $absensi->peserta->nama_lengkap }}" disabled
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Waktu Absen</label>
                <input type="datetime-local" name="waktu_absen" 
                       value="{{ \Carbon\Carbon::parse($absensi->waktu_absen)->format('Y-m-d\TH:i') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5]">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5]">
                    <option value="hadir" {{ $absensi->status === 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="tidak_hadir" {{ $absensi->status === 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                <textarea name="keterangan" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5]">{{ $absensi->keterangan }}</textarea>
            </div>

            <div class="flex items-center space-x-4 pt-6 border-t">
                <button type="submit" class="bg-[#0053C5] text-white px-6 py-2 rounded-lg hover:bg-[#003D91]">
                    Simpan Perubahan
                </button>
                
                <a href="{{ route('admin.absensi.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection