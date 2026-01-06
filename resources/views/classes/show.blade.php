@extends('layouts.app')

@section('title', 'Kelas ' . $class->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ url('/kelas') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Kelas
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Class Header -->
            <x-card>
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-sm font-bold">
                            Grade {{ $class->grade }}
                        </span>
                        <h1 class="text-4xl font-bold text-gray-900 mt-3">Kelas {{ $class->name }}</h1>
                        @if($class->room)
                            <p class="text-gray-600 mt-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Ruangan {{ $class->room }}
                            </p>
                        @endif
                    </div>
                    
                    @if($class->isFull())
                        <span class="px-4 py-2 bg-red-100 text-red-700 rounded-lg text-sm font-medium">
                            Kelas Penuh
                        </span>
                    @else
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm font-medium">
                            {{ $class->remaining_capacity }} Slot Tersisa
                        </span>
                    @endif
                </div>

                <!-- Homeroom Teacher -->
                <div class="border-t pt-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Wali Kelas</h3>
                    @if($class->homeroomTeacher)
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-xl">
                                {{ substr($class->homeroomTeacher->name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-gray-800 text-lg">{{ $class->homeroomTeacher->name }}</p>
                                <p class="text-sm text-gray-600">{{ $class->homeroomTeacher->email }}</p>
                                @if($class->homeroomTeacher->phone)
                                    <p class="text-sm text-gray-600">{{ $class->homeroomTeacher->phone }}</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 italic">Belum ada wali kelas</p>
                    @endif
                </div>
            </x-card>

            <!-- Jadwal Kelas -->
            <x-card title="Jadwal Pelajaran" subtitle="Jadwal mingguan kelas {{ $class->name }}">
                @if($class->schedules->count() > 0)
                    <div class="space-y-4">
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                            @php
                                $daySchedules = $class->schedules->where('day', $day)->sortBy('start_time');
                            @endphp
                            
                            @if($daySchedules->count() > 0)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-bold text-gray-800 mb-3 pb-2 border-b">{{ $day }}</h4>
                                    <div class="space-y-2">
                                        @foreach($daySchedules as $schedule)
                                            <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                                <div class="flex items-center">
                                                    <div class="w-16 h-16 bg-blue-500 text-white rounded-lg flex flex-col items-center justify-center">
                                                        <span class="text-xs font-medium">{{ $schedule->start_time->format('H:i') }}</span>
                                                        <span class="text-xs">-</span>
                                                        <span class="text-xs">{{ $schedule->end_time->format('H:i') }}</span>
                                                    </div>
                                                    <div class="ml-4">
                                                        <h5 class="font-bold text-gray-800">{{ $schedule->subject->name }}</h5>
                                                        <p class="text-sm text-gray-600">{{ $schedule->subject->teacher->name ?? 'TBA' }}</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded text-xs">
                                                        {{ $schedule->room }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Belum ada jadwal untuk kelas ini</p>
                @endif
            </x-card>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Statistics -->
            <x-card title="Statistik Kelas">
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Kapasitas Siswa</span>
                            <span class="font-semibold">{{ $class->students_count }}/{{ $class->capacity }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full {{ $class->isFull() ? 'bg-red-500' : 'bg-green-500' }}"
                                 style="width: {{ ($class->students_count / $class->capacity) * 100 }}%">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Total Siswa</span>
                            <span class="text-sm font-bold text-gray-800">{{ $class->students_count }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Kapasitas</span>
                            <span class="text-sm font-bold text-gray-800">{{ $class->capacity }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Sisa Slot</span>
                            <span class="text-sm font-bold {{ $class->remaining_capacity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $class->remaining_capacity }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Jadwal Pelajaran</span>
                            <span class="text-sm font-bold text-gray-800">{{ $class->schedules->count() }}</span>
                        </div>
                    </div>
                </div>
            </x-card>

            <!-- Quick Actions -->
            <x-card>
                <div class="space-y-3">
                    <x-button href="{{ url('/kelas/' . $class->id . '/siswa') }}" variant="primary" size="lg" class="w-full">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Lihat Daftar Siswa
                    </x-button>

                    <x-button href="{{ url('/jadwal?class=' . $class->id) }}" variant="outline" size="lg" class="w-full">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Lihat Jadwal Detail
                    </x-button>
                </div>
            </x-card>

        </div>

    </div>

</div>
@endsection