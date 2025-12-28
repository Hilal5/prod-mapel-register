@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600 mt-2">Selamat datang di Sistem Informasi Akademik SMP</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-card hover="true" class="bg-gradient-to-br from-blue-500 to-blue-600 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Mata Pelajaran</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $totalSubjects }}</h3>
                </div>
                <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        </x-card>

        <x-card hover="true" class="bg-gradient-to-br from-green-500 to-green-600 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Total Kelas</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $totalClasses }}</h3>
                </div>
                <svg class="w-12 h-12 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
        </x-card>

        <x-card hover="true" class="bg-gradient-to-br from-purple-500 to-purple-600 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">Total Siswa</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $totalStudents }}</h3>
                </div>
                <svg class="w-12 h-12 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </x-card>

        <x-card hover="true" class="bg-gradient-to-br from-orange-500 to-orange-600 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm">Registrasi Aktif</p>
                    <h3 class="text-3xl font-bold mt-2">{{ $activeRegistrations }}</h3>
                </div>
                <svg class="w-12 h-12 text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </x-card>
    </div>

    <!-- Quick Actions -->
    <x-card title="Quick Actions" class="mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-button href="{{ url('/jadwal') }}" variant="primary" size="lg" class="w-full">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Lihat Jadwal
            </x-button>
            
            <x-button href="{{ url('/registrasi') }}" variant="success" size="lg" class="w-full">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Daftar Mata Pelajaran
            </x-button>
            
            <x-button href="{{ url('/mata-pelajaran') }}" variant="outline" size="lg" class="w-full">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Browse Mata Pelajaran
            </x-button>
        </div>
    </x-card>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-card title="Jadwal Hari Ini" subtitle="{{ now()->translatedFormat('l, d F Y') }}">
            @if($todaySchedules->count() > 0)
                <div class="space-y-3">
                    @foreach($todaySchedules as $schedule)
                        <div class="flex items-center p-3 bg-blue-50 rounded-lg border border-blue-100">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-500 text-white rounded-lg flex items-center justify-center font-bold text-xs">
                                {{ $schedule->start_time->format('H:i') }}
                            </div>
                            <div class="ml-4 flex-1">
                                <h4 class="font-semibold text-gray-800">{{ $schedule->subject->name }}</h4>
                                <p class="text-sm text-gray-600">{{ $schedule->teacher->name }} • {{ $schedule->room }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <x-button href="{{ url('/jadwal') }}" variant="outline" size="sm" class="w-full">
                        Lihat Semua Jadwal
                    </x-button>
                </div>
            @else
                <p class="text-gray-500 text-center py-4">Tidak ada jadwal hari ini</p>
            @endif
        </x-card>

        <x-card title="Pengumuman" subtitle="Update terbaru">
            <div class="space-y-4">
                <div class="border-l-4 border-blue-500 pl-4 py-2">
                    <h4 class="font-semibold text-gray-800">Registrasi Semester Baru</h4>
                    <p class="text-sm text-gray-600 mt-1">Registrasi untuk semester genap dibuka mulai 2 Januari 2026</p>
                    <p class="text-xs text-gray-500 mt-2">25 Desember 2025</p>
                </div>

                <div class="border-l-4 border-green-500 pl-4 py-2">
                    <h4 class="font-semibold text-gray-800">Libur Tahun Baru</h4>
                    <p class="text-sm text-gray-600 mt-1">Sekolah libur pada tanggal 31 Desember - 1 Januari</p>
                    <p class="text-xs text-gray-500 mt-2">23 Desember 2025</p>
                </div>

                <div class="border-l-4 border-yellow-500 pl-4 py-2">
                    <h4 class="font-semibold text-gray-800">UTS Semester Genap</h4>
                    <p class="text-sm text-gray-600 mt-1">Jadwal UTS akan diumumkan minggu depan</p>
                    <p class="text-xs text-gray-500 mt-2">20 Desember 2025</p>
                </div>
            </div>
        </x-card>
    </div>

</div>
@endsection