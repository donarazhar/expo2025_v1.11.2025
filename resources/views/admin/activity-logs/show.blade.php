@extends('admin.layouts.app')

@section('title', 'Detail Activity Log')
@section('page-title', 'Detail Activity Log')
@section('page-subtitle', 'Informasi lengkap aktivitas yang dilakukan')

@section('content')
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.activity-logs.index') }}"
            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Main Content - Left Side -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Aktivitas -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-[#0053C5] px-6 py-4">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informasi Aktivitas
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-5">
                        <!-- Deskripsi -->
                        <div class="flex flex-col sm:flex-row sm:items-start pb-5 border-b border-gray-200">
                            <div class="w-full sm:w-48 font-semibold text-gray-700 mb-2 sm:mb-0 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Deskripsi:
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-900 font-medium">{{ $activity->description }}</p>
                            </div>
                        </div>

                        <!-- Event Type -->
                        @if ($activity->event)
                            <div class="flex flex-col sm:flex-row sm:items-start pb-5 border-b border-gray-200">
                                <div
                                    class="w-full sm:w-48 font-semibold text-gray-700 mb-2 sm:mb-0 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                    Tipe Event:
                                </div>
                                <div class="flex-1">
                                    @php
                                        $eventBadges = [
                                            'created' => [
                                                'bg' => 'bg-green-100',
                                                'text' => 'text-green-800',
                                                'label' => 'Created',
                                            ],
                                            'updated' => [
                                                'bg' => 'bg-blue-100',
                                                'text' => 'text-blue-800',
                                                'label' => 'Updated',
                                            ],
                                            'deleted' => [
                                                'bg' => 'bg-red-100',
                                                'text' => 'text-red-800',
                                                'label' => 'Deleted',
                                            ],
                                        ];
                                        $badge = $eventBadges[$activity->event] ?? [
                                            'bg' => 'bg-gray-100',
                                            'text' => 'text-gray-800',
                                            'label' => ucfirst($activity->event),
                                        ];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badge['bg'] }} {{ $badge['text'] }}">
                                        {{ $badge['label'] }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        <!-- Module/Log Name -->
                        <div class="flex flex-col sm:flex-row sm:items-start pb-5 border-b border-gray-200">
                            <div class="w-full sm:w-48 font-semibold text-gray-700 mb-2 sm:mb-0 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                    </path>
                                </svg>
                                Module:
                            </div>
                            <div class="flex-1">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    {{ ucfirst($activity->log_name) }}
                                </span>
                            </div>
                        </div>

                        <!-- Waktu -->
                        <div class="flex flex-col sm:flex-row sm:items-start pb-5 border-b border-gray-200">
                            <div class="w-full sm:w-48 font-semibold text-gray-700 mb-2 sm:mb-0 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Waktu:
                            </div>
                            <div class="flex-1">
                                <div class="text-gray-900 font-medium">
                                    {{ $activity->created_at->format('d M Y, H:i:s') }}
                                </div>
                                <div class="text-sm text-gray-500 mt-1 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    {{ $activity->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>

                        <!-- User -->
                        <div class="flex flex-col sm:flex-row sm:items-start pb-5 border-b border-gray-200">
                            <div class="w-full sm:w-48 font-semibold text-gray-700 mb-2 sm:mb-0 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                User:
                            </div>
                            <div class="flex-1">
                                @if ($activity->causer)
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="w-10 h-10 bg-[#0053C5] rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                            {{ substr($activity->causer->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-gray-900 font-medium">
                                                {{ $activity->causer->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 mt-0.5">
                                                {{ $activity->causer->email }}
                                            </div>
                                            @if (isset($activity->causer->role))
                                                <span
                                                    class="inline-block mt-1 text-xs px-2 py-0.5 bg-gray-100 text-gray-700 rounded">
                                                    {{ ucfirst($activity->causer->role) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z">
                                            </path>
                                        </svg>
                                        System
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="flex flex-col sm:flex-row sm:items-start">
                            <div class="w-full sm:w-48 font-semibold text-gray-700 mb-2 sm:mb-0 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                    </path>
                                </svg>
                                Subject:
                            </div>
                            <div class="flex-1">
                                @if ($activity->subject)
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-medium text-gray-600">Model Type</span>
                                            <span
                                                class="text-sm text-gray-900 font-mono">{{ class_basename($activity->subject_type) }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-medium text-gray-600">Model ID</span>
                                            <span
                                                class="text-sm text-gray-900 font-mono">{{ $activity->subject_id }}</span>
                                        </div>

                                        {{-- Event Details --}}
                                        @if ($activity->subject instanceof \App\Models\Event)
                                            <div class="mt-3 pt-3 border-t border-gray-200">
                                                <div class="text-sm text-gray-600 mb-1">Event Title:</div>
                                                <div class="text-gray-900 font-medium">{{ $activity->subject->judul }}
                                                </div>
                                            </div>

                                            {{-- Peserta Details --}}
                                        @elseif ($activity->subject instanceof \App\Models\Peserta)
                                            <div class="mt-3 pt-3 border-t border-gray-200">
                                                <div class="text-sm text-gray-600 mb-1">Nama Peserta:</div>
                                                <div class="text-gray-900 font-medium">
                                                    {{ $activity->subject->nama_lengkap }}</div>
                                            </div>

                                            {{-- Feedback Details --}}
                                        @elseif ($activity->subject instanceof \App\Models\Feedback)
                                            <div class="mt-3 pt-3 border-t border-gray-200">
                                                <div class="grid grid-cols-2 gap-3">
                                                    <div>
                                                        <div class="text-xs text-gray-600 mb-1">Peserta:</div>
                                                        <div class="text-sm text-gray-900 font-medium">
                                                            {{ $activity->subject->peserta->nama_lengkap ?? 'Unknown' }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="text-xs text-gray-600 mb-1">Rating:</div>
                                                        <div class="text-sm text-gray-900 font-medium">
                                                            {{ $activity->subject->rating }}/5 ⭐
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="text-xs text-gray-600 mb-1">Event:</div>
                                                    <div class="text-sm text-gray-900 font-medium">
                                                        {{ $activity->subject->event->judul ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">Tidak ada subject</span>
                                @endif
                            </div>
                        </div>

                        <!-- IP Address & User Agent -->
                        @if ($activity->properties && ($activity->properties->has('ip_address') || $activity->properties->has('user_agent')))
                            <div class="mt-5 pt-5 border-t border-gray-200">
                                <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                    Informasi Teknis
                                </h4>
                                <div class="space-y-3">
                                    @if ($activity->properties->has('ip_address'))
                                        <div class="flex items-start gap-3">
                                            <span class="text-sm font-medium text-gray-600 w-24">IP Address:</span>
                                            <code
                                                class="text-sm bg-gray-100 px-2 py-1 rounded text-gray-800">{{ $activity->properties->get('ip_address') }}</code>
                                        </div>
                                    @endif
                                    @if ($activity->properties->has('user_agent'))
                                        <div class="flex items-start gap-3">
                                            <span class="text-sm font-medium text-gray-600 w-24">User Agent:</span>
                                            <span
                                                class="text-sm text-gray-700 flex-1">{{ Str::limit($activity->properties->get('user_agent'), 100) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Perubahan Data -->
            @if ($activity->properties && ($activity->properties->has('attributes') || $activity->properties->has('old')))
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-blue-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                            Perubahan Data
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b-2 border-gray-200">
                                        <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm bg-gray-50">
                                            Field
                                        </th>
                                        <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm bg-gray-50">
                                            Nilai Lama
                                        </th>
                                        <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm bg-gray-50">
                                            Nilai Baru
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $attributes = $activity->properties->get('attributes', []);
                                        $old = $activity->properties->get('old', []);
                                    @endphp

                                    @forelse($attributes as $key => $newValue)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                            <td class="py-3 px-4">
                                                <span class="font-semibold text-gray-900 flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                                        </path>
                                                    </svg>
                                                    {{ ucfirst(str_replace('_', ' ', $key)) }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4">
                                                @if (isset($old[$key]))
                                                    <div class="flex items-start gap-2">
                                                        <svg class="w-4 h-4 text-red-500 mt-0.5 flex-shrink-0"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                        <code
                                                            class="px-2 py-1 bg-red-50 text-red-700 rounded text-sm break-all">{{ $old[$key] }}</code>
                                                    </div>
                                                @else
                                                    <span class="text-gray-400 italic text-sm">-</span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4">
                                                <div class="flex items-start gap-2">
                                                    <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <code
                                                        class="px-2 py-1 bg-green-50 text-green-700 rounded text-sm break-all">{{ $newValue }}</code>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-8 text-center text-gray-500 text-sm">
                                                Tidak ada perubahan data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar - Right Side -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Quick Actions -->
            @if ($activity->subject)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Quick Actions
                        </h3>
                    </div>
                    <div class="p-6 space-y-3">
                        @if ($activity->subject instanceof \App\Models\Event)
                            <a href="{{ route('admin.events.show', $activity->subject) }}"
                                class="flex items-center justify-center w-full px-4 py-2.5 bg-[#0053C5] text-white rounded-lg hover:bg-[#003d94] transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Lihat Event
                            </a>
                            <a href="{{ route('admin.events.edit', $activity->subject) }}"
                                class="flex items-center justify-center w-full px-4 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Event
                            </a>
                        @elseif ($activity->subject instanceof \App\Models\Feedback)
                            <a href="{{ route('admin.feedbacks.show', $activity->subject) }}"
                                class="flex items-center justify-center w-full px-4 py-2.5 bg-[#0053C5] text-white rounded-lg hover:bg-[#003d94] transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Lihat Feedback
                            </a>
                            <a href="{{ route('admin.feedbacks.edit', $activity->subject) }}"
                                class="flex items-center justify-center w-full px-4 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Feedback
                            </a>
                        @elseif ($activity->subject instanceof \App\Models\Peserta)
                            <a href="{{ route('admin.peserta.show', $activity->subject->id_peserta) }}"
                                class="flex items-center justify-center w-full px-4 py-2.5 bg-[#0053C5] text-white rounded-lg hover:bg-[#003d94] transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Lihat Peserta
                            </a>
                            <a href="{{ route('admin.peserta.edit', $activity->subject->id_peserta) }}"
                                class="flex items-center justify-center w-full px-4 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Peserta
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Activity Stats -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg border border-blue-200 p-6">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-gray-900 mb-1">Activity ID</h4>
                        <p class="text-2xl font-bold text-blue-600">#{{ $activity->id }}</p>
                        @if ($activity->batch_uuid)
                            <p class="text-xs text-gray-600 mt-2">Batch: {{ Str::limit($activity->batch_uuid, 20) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Properties -->
            @if ($activity->properties && $activity->properties->count() > 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                            Properties (JSON)
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                            <pre class="text-xs text-green-400 font-mono"><code>{{ json_encode($activity->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</code></pre>
                        </div>
                        <div class="mt-3 flex items-center justify-end">
                            <button onclick="copyToClipboard()"
                                class="text-xs text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Copy JSON
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Activity Timeline Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Timeline Info
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Created -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Created</p>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    {{ $activity->created_at->format('d M Y, H:i:s') }}</p>
                            </div>
                        </div>

                        <!-- Updated (if different from created) -->
                        @if ($activity->updated_at && !$activity->created_at->eq($activity->updated_at))
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Updated</p>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        {{ $activity->updated_at->format('d M Y, H:i:s') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-amber-50 rounded-lg border border-amber-200 p-6">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="text-sm font-semibold text-amber-900 mb-1">Informasi</h4>
                        <p class="text-sm text-amber-800 leading-relaxed">
                            Log ini mencatat semua aktivitas yang dilakukan pada sistem. Data ini tidak dapat diubah atau
                            dihapus dan tersimpan secara permanen untuk keperluan audit.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function copyToClipboard() {
            const jsonText = @json($activity->properties);
            const formattedJson = JSON.stringify(jsonText, null, 2);

            navigator.clipboard.writeText(formattedJson).then(function() {
                // Success notification
                const button = event.target.closest('button');
                const originalText = button.innerHTML;
                button.innerHTML = `
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Copied!
        `;
                button.classList.add('text-green-600');

                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('text-green-600');
                    button.classList.add('text-blue-600');
                }, 2000);
            }, function(err) {
                console.error('Could not copy text: ', err);
                alert('Gagal menyalin ke clipboard');
            });
        }
    </script>
@endpush
