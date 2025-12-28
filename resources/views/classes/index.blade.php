@extends('layouts.app')

@section('title', 'Daftar Kelas')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Daftar Kelas</h1>
        <p class="text-gray-600 mt-2">Informasi kelas di SMP</p>
    </div>

    <!-- Classes by Grade -->
    @foreach([7, 8, 9] as $grade)
        @php
            $gradeClasses = $classes->where('grade', $grade);
        @endphp
        
        @if($gradeClasses->count() > 0)
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Kelas {{ $grade }}</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($gradeClasses as $class)
                        <x-card hover="true" class="relative">
                            <!-- Class Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-bold">
                                    Grade {{ $class->grade }}
                                </span>
                            </div>

                            <!-- Class Name -->
                            <div class="mb-4">
                                <h3 class="text-3xl font-bold text-gray-900 mb-2">Kelas {{ $class->name }}</h3>
                                @if($class->room)
                                    <p class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Ruangan: {{ $class->room }}
                                    </p>
                                @endif
                            </div>

                            <!-- Homeroom Teacher -->
                            <div class="mb-4 pb-4 border-b border-gray-200">
                                <h4 class="text-xs font-semibold text-gray-500 mb-2">WALI KELAS</h4>
                                @if($class->homeroomTeacher)
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold">
                                            {{ substr($class->homeroomTeacher->name, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-semibold text-gray-800">{{ $class->homeroomTeacher->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $class->homeroomTeacher->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-gray-500 italic text-sm">Belum ada wali kelas</p>
                                @endif
                            </div>

                            <!-- Stats -->
                            <div class="space-y-3 mb-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Jumlah Siswa</span>
                                    <span class="font-bold text-lg {{ $class->isFull() ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $class->students_count }}/{{ $class->capacity }}
                                    </span>
                                </div>
                                
                                <!-- Progress Bar -->
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="h-2 rounded-full {{ $class->isFull() ? 'bg-red-500' : 'bg-green-500' }}"
                                         style="width: {{ ($class->students_count / $class->capacity) * 100 }}%">
                                    </div>
                                </div>

                                @if(!$class->isFull())
                                    <p class="text-xs text-gray-500">
                                        Sisa kapasitas: {{ $class->remaining_capacity }} siswa
                                    </p>
                                @else
                                    <p class="text-xs text-red-600 font-medium">
                                        Kelas penuh
                                    </p>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2">
                                <x-button href="{{ url('/kelas/' . $class->id) }}" variant="primary" size="sm" class="flex-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </x-button>
                                <x-button href="{{ url('/kelas/' . $class->id . '/siswa') }}" variant="outline" size="sm" class="flex-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    Siswa
                                </x-button>
                            </div>
                        </x-card>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    @if($classes->count() == 0)
        <x-card>
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Tidak ada kelas</h3>
                <p class="text-gray-500">Belum ada kelas yang terdaftar</p>
            </div>
        </x-card>
    @endif

</div>
@endsection