@extends('layouts.app')

@section('title', 'Registrasi Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Page Header -->
    <div class="mb-8">
        <a href="{{ url('/registrasi') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Registrasi
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Registrasi Saya</h1>
        <p class="text-gray-600 mt-2">Daftar mata pelajaran yang sudah kamu daftarkan</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <x-card class="bg-blue-50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-600 font-medium">Total Registrasi</p>
                    <h3 class="text-2xl font-bold text-blue-700 mt-1">{{ $registrations->count() }}</h3>
                </div>
                <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </x-card>

        <x-card class="bg-green-50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-600 font-medium">Disetujui</p>
                    <h3 class="text-2xl font-bold text-green-700 mt-1">{{ $registrations->where('status', 'approved')->count() }}</h3>
                </div>
                <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </x-card>

        <x-card class="bg-yellow-50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-yellow-600 font-medium">Pending</p>
                    <h3 class="text-2xl font-bold text-yellow-700 mt-1">{{ $registrations->where('status', 'pending')->count() }}</h3>
                </div>
                <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </x-card>

        <x-card class="bg-red-50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-red-600 font-medium">Ditolak</p>
                    <h3 class="text-2xl font-bold text-red-700 mt-1">{{ $registrations->where('status', 'rejected')->count() }}</h3>
                </div>
                <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </x-card>
    </div>

    <!-- Registrations List -->
    @if($registrations->count() > 0)
        <x-card>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="text-left p-4 font-semibold text-gray-700">Mata Pelajaran</th>
                            <th class="text-left p-4 font-semibold text-gray-700">Jadwal</th>
                            <th class="text-left p-4 font-semibold text-gray-700">Guru</th>
                            <th class="text-left p-4 font-semibold text-gray-700">Ruangan</th>
                            <th class="text-left p-4 font-semibold text-gray-700">Tanggal Daftar</th>
                            <th class="text-left p-4 font-semibold text-gray-700">Status</th>
                            <th class="text-left p-4 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <div class="font-semibold text-gray-800">{{ $registration->subject->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $registration->subject->code }} • {{ $registration->subject->credits }} SKS</div>
                                </td>
                                <td class="p-4">
                                    <div class="text-sm text-gray-700">{{ $registration->schedule->day }}</div>
                                    <div class="text-xs text-gray-500">{{ $registration->schedule->time_range }}</div>
                                </td>
                                <td class="p-4 text-sm text-gray-700">{{ $registration->schedule->teacher->name }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded text-xs">
                                        {{ $registration->schedule->room }}
                                    </span>
                                </td>
                                <td class="p-4 text-sm text-gray-700">
                                    {{ $registration->registration_date->format('d M Y') }}
                                </td>
                                <td class="p-4">
                                    @if($registration->status == 'approved')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                                            Disetujui
                                        </span>
                                    @elseif($registration->status == 'pending')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">
                                            Pending
                                        </span>
                                    @elseif($registration->status == 'rejected')
                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                            Dibatalkan
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($registration->status == 'pending' || $registration->status == 'approved')
                                        <form method="POST" action="{{ url('/registrasi/' . $registration->id) }}" 
                                              onsubmit="return confirm('Yakin ingin membatalkan registrasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                Batalkan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>

        <!-- Schedule Summary -->
        <div class="mt-8">
            <x-card title="Jadwal Mingguan Saya" subtitle="Jadwal mata pelajaran yang sudah disetujui">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                        @php
                            $daySchedules = $registrations
                                ->where('status', 'approved')
                                ->filter(function($reg) use ($day) {
                                    return $reg->schedule->day === $day;
                                })
                                ->sortBy(function($reg) {
                                    return $reg->schedule->start_time;
                                });
                        @endphp
                        
                        @if($daySchedules->count() > 0)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h4 class="font-bold text-gray-800 mb-3 pb-2 border-b">{{ $day }}</h4>
                                <div class="space-y-2">
                                    @foreach($daySchedules as $reg)
                                        <div class="text-sm">
                                            <div class="font-semibold text-gray-700">{{ $reg->schedule->start_time->format('H:i') }}</div>
                                            <div class="text-gray-600">{{ $reg->subject->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $reg->schedule->room }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </x-card>
        </div>
    @else
        <x-card>
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum ada registrasi</h3>
                <p class="text-gray-500 mb-4">Kamu belum mendaftar mata pelajaran apapun</p>
                <x-button href="{{ url('/registrasi') }}" variant="primary">
                    Daftar Mata Pelajaran
                </x-button>
            </div>
        </x-card>
    @endif

</div>
@endsection