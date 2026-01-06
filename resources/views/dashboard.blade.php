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
    <div class="space-y-3">
        <div class="group border-l-4 border-blue-500 pl-4 py-3 hover:bg-blue-50 transition cursor-pointer rounded-r-lg">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-800">Registrasi Semester Baru</h4>
                        <span class="px-2 py-0.5 bg-red-500 text-white text-xs rounded-full font-medium">NEW</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-2 ml-10">Registrasi untuk semester genap dibuka mulai 2 Januari 2026</p>
                    <div class="flex items-center gap-4 mt-2 ml-10">
                        <p class="text-xs text-gray-500">25 Desember 2025</p>
                        <span class="text-xs text-gray-400">• 234 views</span>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </div>

        <div class="group border-l-4 border-green-500 pl-4 py-3 hover:bg-green-50 transition cursor-pointer rounded-r-lg">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-800">Libur Tahun Baru</h4>
                    </div>
                    <p class="text-sm text-gray-600 mt-2 ml-10">Sekolah libur pada tanggal 31 Desember - 1 Januari</p>
                    <div class="flex items-center gap-4 mt-2 ml-10">
                        <p class="text-xs text-gray-500">23 Desember 2025</p>
                        <span class="text-xs text-gray-400">• 156 views</span>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-green-500 transition flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </div>

        <div class="group border-l-4 border-yellow-500 pl-4 py-3 hover:bg-yellow-50 transition cursor-pointer rounded-r-lg">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-8 h-8 bg-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-800">UTS Semester Genap</h4>
                    </div>
                    <p class="text-sm text-gray-600 mt-2 ml-10">Jadwal UTS akan diumumkan minggu depan</p>
                    <div class="flex items-center gap-4 mt-2 ml-10">
                        <p class="text-xs text-gray-500">20 Desember 2025</p>
                        <span class="text-xs text-gray-400">• 89 views</span>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-yellow-500 transition flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </div>
    </div>

    <div class="mt-4 pt-4 border-t">
        <x-button href="#" variant="outline" size="sm" class="w-full">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            Lihat Semua Pengumuman
        </x-button>
    </div>
</x-card>
    </div>

</div>
@endsection