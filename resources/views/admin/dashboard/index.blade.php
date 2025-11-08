@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview dan statistik event')

@section('content')
<div class="space-y-6">
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Total Peserta -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-azhar-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Peserta</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_peserta']) }}</p>
                    <p class="text-xs text-gray-500 mt-2">
                        <span class="text-green-600 font-semibold">+{{ $stats['peserta_hari_ini'] }}</span> hari ini
                    </p>
                </div>
                <div class="w-14 h-14 bg-azhar-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-azhar-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Total Hadir -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Hadir</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_hadir']) }}</p>
                    <p class="text-xs text-gray-500 mt-2">
                        {{ $stats['total_peserta'] > 0 ? number_format(($stats['total_hadir'] / $stats['total_peserta']) * 100, 1) : 0 }}% dari total
                    </p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Total Sertifikat -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Sertifikat Diterbitkan</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_sertifikat']) }}</p>
                    <p class="text-xs text-gray-500 mt-2">
                        {{ $stats['sertifikat_terkirim'] }} terkirim
                    </p>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Sertifikat Pending -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-orange-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Belum Terkirim</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_sertifikat'] - $stats['sertifikat_terkirim']) }}</p>
                    <p class="text-xs text-gray-500 mt-2">
                        Perlu dikirim
                    </p>
                </div>
                <div class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Registrations Chart -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Pendaftaran (7 Hari Terakhir)</h3>
            <div class="h-64 flex items-end justify-between space-x-2">
                @forelse($registrations_chart as $data)
                <div class="flex-1 flex flex-col items-center">
                    <div class="w-full bg-azhar-blue-500 rounded-t-lg hover:bg-azhar-blue-600 transition-colors cursor-pointer" 
                         style="height: {{ $registrations_chart->max('count') > 0 ? ($data->count / $registrations_chart->max('count')) * 100 : 0 }}%"
                         title="{{ $data->count }} peserta">
                    </div>
                    <p class="text-xs text-gray-600 mt-2">{{ \Carbon\Carbon::parse($data->date)->format('d/m') }}</p>
                </div>
                @empty
                <p class="text-center text-gray-500 w-full">Belum ada data</p>
                @endforelse
            </div>
        </div>
        
        <!-- Attendance Chart -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Kehadiran (7 Hari Terakhir)</h3>
            <div class="h-64 flex items-end justify-between space-x-2">
                @forelse($attendance_chart as $data)
                <div class="flex-1 flex flex-col items-center">
                    <div class="w-full bg-green-500 rounded-t-lg hover:bg-green-600 transition-colors cursor-pointer" 
                         style="height: {{ $attendance_chart->max('count') > 0 ? ($data->count / $attendance_chart->max('count')) * 100 : 0 }}%"
                         title="{{ $data->count }} hadir">
                    </div>
                    <p class="text-xs text-gray-600 mt-2">{{ \Carbon\Carbon::parse($data->date)->format('d/m') }}</p>
                </div>
                @empty
                <p class="text-center text-gray-500 w-full">Belum ada data</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Recent Activity & Top Institutions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Recent Registrations -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Pendaftaran Terbaru</h3>
                <a href="{{ route('admin.peserta.index') }}" class="text-sm text-azhar-blue-500 hover:text-azhar-blue-600 font-medium">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recent_registrations as $peserta)
                <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-10 h-10 bg-azhar-blue-100 rounded-lg flex items-center justify-center text-azhar-blue-600 font-bold">
                        {{ substr($peserta->nama_lengkap, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $peserta->nama_lengkap }}</p>
                        <p class="text-xs text-gray-600 truncate">{{ $peserta->email }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">{{ $peserta->tgl_registrasi->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500 py-8">Belum ada pendaftaran</p>
                @endforelse
            </div>
        </div>
        
        <!-- Top Institutions -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Top 5 Instansi</h3>
            </div>
            <div class="space-y-4">
                @forelse($top_institutions as $institution)
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <p class="text-sm font-medium text-gray-900">{{ $institution->asal_instansi }}</p>
                        <span class="text-sm font-bold text-azhar-blue-500">{{ $institution->count }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-azhar-blue-500 h-2 rounded-full" 
                             style="width: {{ $top_institutions->max('count') > 0 ? ($institution->count / $top_institutions->max('count')) * 100 : 0 }}%">
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500 py-8">Belum ada data</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.peserta.create') }}" class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-azhar-blue-500 hover:bg-azhar-blue-50 transition-colors group">
                <svg class="w-8 h-8 text-gray-400 group-hover:text-azhar-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700 group-hover:text-azhar-blue-600">Tambah Peserta</span>
            </a>
            
            <a href="{{ route('admin.absensi.create') }}" class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition-colors group">
                <svg class="w-8 h-8 text-gray-400 group-hover:text-green-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700 group-hover:text-green-600">Catat Absensi</span>
            </a>
            
            <a href="{{ route('admin.sertifikat.create') }}" class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition-colors group">
                <svg class="w-8 h-8 text-gray-400 group-hover:text-purple-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700 group-hover:text-purple-600">Terbitkan Sertifikat</span>
            </a>
            
            <a href="{{ route('admin.peserta.export.excel') }}" class="flex flex-col items-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition-colors group">
                <svg class="w-8 h-8 text-gray-400 group-hover:text-orange-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700 group-hover:text-orange-600">Export Data</span>
            </a>
        </div>
    </div>
    
</div>
@endsection