@extends('admin.layouts.app')

@section('title', 'Activity Logs')
@section('page-title', 'Activity Logs')
@section('page-subtitle', 'Riwayat aktivitas pada modul Events')

@section('content')

    <!-- Filter Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="p-6">
            <form method="GET" action="{{ route('admin.activity-logs.index') }}">
               <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">

                    <!-- Tanggal Dari -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dari</label>
                        <input type="date" name="date_from"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-transparent transition-colors text-sm"
                            value="{{ request('date_from') }}">
                    </div>

                    <!-- Tanggal Sampai -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Sampai</label>
                        <input type="date" name="date_to"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-transparent transition-colors text-sm"
                            value="{{ request('date_to') }}">
                    </div>

                    <!-- Module -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Module</label>
                        <select name="log_name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-transparent transition-colors text-sm">
                            <option value="all">Semua Module</option>
                            @foreach ($logNames as $logName)
                                <option value="{{ $logName }}" {{ request('log_name') == $logName ? 'selected' : '' }}>
                                    {{ ucfirst($logName) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
                        <div class="flex gap-2">
                            <button type="submit"
                                class="flex-1 bg-[#0053C5] text-white px-4 py-2 rounded-lg hover:bg-[#003d94] transition-colors flex items-center justify-center gap-2 text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                    </path>
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('admin.activity-logs.index') }}"
                                class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center justify-center"
                                title="Reset Filter">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Active Filters Summary (Optional) -->
                @if (request()->hasAny(['date_from', 'date_to', 'log_name', 'search']) &&
                        (request('log_name') !== 'all' || request('date_from') || request('date_to') || request('search')))
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-sm text-gray-600 font-medium">Filter Aktif:</span>

                            @if (request('date_from'))
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                    Dari: {{ \Carbon\Carbon::parse(request('date_from'))->format('d M Y') }}
                                </span>
                            @endif

                            @if (request('date_to'))
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                    Sampai: {{ \Carbon\Carbon::parse(request('date_to'))->format('d M Y') }}
                                </span>
                            @endif

                            @if (request('log_name') && request('log_name') !== 'all')
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">
                                    Module: {{ ucfirst(request('log_name')) }}
                                </span>
                            @endif

                            @if (request('search'))
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                    Pencarian: "{{ Str::limit(request('search'), 30) }}"
                                </span>
                            @endif

                            <a href="{{ route('admin.activity-logs.index') }}"
                                class="text-xs text-red-600 hover:text-red-800 font-medium ml-2 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Hapus Semua
                            </a>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Activity Logs Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <!-- Table Header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Activity Logs</h3>
                <span class="text-sm text-gray-600">Total: {{ $logs->total() }} log</span>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm" style="width: 150px">
                                Waktu
                            </th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm" style="width: 200px">
                                User
                            </th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">
                                Aktivitas
                            </th>
                            <th class="text-center py-3 px-4 font-semibold text-gray-700 text-sm" style="width: 100px">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <!-- Waktu -->
                                <td class="py-4 px-4">
                                    <div class="text-sm text-gray-900 font-medium">
                                        {{ $log->created_at->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $log->created_at->format('H:i:s') }}
                                    </div>
                                </td>

                                <!-- User -->
                                <td class="py-4 px-4">
                                    @if ($log->causer)
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $log->causer->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $log->causer->email }}
                                        </div>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            System
                                        </span>
                                    @endif
                                </td>

                                <!-- Aktivitas -->
                                <td class="py-4 px-4">
                                    <div class="text-sm text-gray-900 mb-2">
                                        {{ $log->description }}
                                    </div>

                                    @if ($log->properties && $log->properties->has('attributes'))
                                        <div class="flex flex-wrap gap-1">
                                            <span class="text-xs text-gray-600">Perubahan:</span>
                                            @foreach ($log->properties->get('attributes') as $key => $value)
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $key }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="py-4 px-4 text-center">
                                    <a href="{{ route('admin.activity-logs.show', $log) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-[#0053C5] text-white text-sm rounded-lg hover:bg-[#003d94] transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 text-sm">Belum ada activity log</p>
                                    @if (request()->hasAny(['date_from', 'date_to', 'event']))
                                        <a href="{{ route('admin.activity-logs.index') }}"
                                            class="inline-block mt-3 text-[#0053C5] hover:text-[#003d94] text-sm font-medium">
                                            Reset Filter
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($logs->hasPages())
                <div class="mt-6 border-t border-gray-200 pt-4">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
