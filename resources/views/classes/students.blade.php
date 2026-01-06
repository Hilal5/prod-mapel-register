@extends('layouts.app')

@section('title', 'Siswa Kelas ' . $class->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ url('/kelas/' . $class->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Detail Kelas
        </a>
    </div>

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Daftar Siswa Kelas {{ $class->name }}</h1>
        <p class="text-gray-600 mt-2">Total {{ $class->students->count() }} siswa</p>
    </div>

    @if($class->students->count() > 0)
        <!-- Students Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach($class->students as $student)
                <x-card hover="true">
                    <div class="flex items-start">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" 
                                     alt="{{ $student->name }}" 
                                     class="w-16 h-16 rounded-full object-cover">
                            @else
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xl">
                                    {{ substr($student->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <!-- Student Info -->
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-bold text-gray-800">{{ $student->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">NIS: {{ $student->nis }}</p>
                            
                            <div class="space-y-1 text-sm text-gray-600">
                                @if($student->email)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span class="truncate">{{ $student->email }}</span>
                                    </div>
                                @endif

                                @if($student->phone)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span>{{ $student->phone }}</span>
                                    </div>
                                @endif

                                @if($student->gender)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>{{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>

        <!-- Students Table (Alternative View) -->
        <x-card class="mt-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Daftar Lengkap</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="text-left p-4 font-semibold text-gray-700">No</th>
                            <th class="text-left p-4 font-semibold text-gray-700">NIS</th>
                            <th class="text-left p-4 font-semibold text-gray-700">Nama</th>
                            <th class="text-left p-4 font-semibold text-gray-700">Jenis Kelamin</th>
                            <th class="text-left p-4 font-semibold text-gray-700">Email</th>
                            <th class="text-left p-4 font-semibold text-gray-700">Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($class->students as $index => $student)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <td class="p-4 text-gray-700">{{ $index + 1 }}</td>
                                <td class="p-4 text-gray-700 font-medium">{{ $student->nis }}</td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        @if($student->photo)
                                            <img src="{{ asset('storage/' . $student->photo) }}" 
                                                 alt="{{ $student->name }}" 
                                                 class="w-8 h-8 rounded-full object-cover mr-2">
                                        @else
                                            <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-xs mr-2">
                                                {{ substr($student->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <span class="font-semibold text-gray-800">{{ $student->name }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-gray-700">
                                    @if($student->gender == 'L')
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">Laki-laki</span>
                                    @elseif($student->gender == 'P')
                                        <span class="px-2 py-1 bg-pink-100 text-pink-700 rounded text-xs">Perempuan</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-gray-600">{{ $student->email }}</td>
                                <td class="p-4 text-sm text-gray-600">{{ $student->phone ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>
    @else
        <x-card>
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum ada siswa</h3>
                <p class="text-gray-500">Belum ada siswa yang terdaftar di kelas ini</p>
            </div>
        </x-card>
    @endif

</div>
@endsection