@extends('layouts.app')

@section('title', 'Mata Pelajaran')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Mata Pelajaran</h1>
        <p class="text-gray-600 mt-2">Daftar mata pelajaran yang tersedia</p>
    </div>

    <!-- Filter & Search -->
    <x-card class="mb-6">
        <form method="GET" action="{{ url('/mata-pelajaran') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Mata Pelajaran</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Nama mata pelajaran..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                <select name="semester" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Semua Semester</option>
                    <option value="ganjil" {{ request('semester') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                    <option value="genap" {{ request('semester') == 'genap' ? 'selected' : '' }}>Genap</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div class="flex items-end">
                <x-button type="submit" variant="primary" class="w-full">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Filter
                </x-button>
            </div>
        </form>
    </x-card>

    <!-- Subjects Grid -->
    @if($subjects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach($subjects as $subject)
                <x-card hover="true" class="relative">
                    <!-- Status Badge -->
                    <div class="absolute top-4 right-4">
                        @if($subject->isQuotaFull())
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">
                                Penuh
                            </span>
                        @else
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                                Tersedia
                            </span>
                        @endif
                    </div>

                    <!-- Subject Info -->
                    <div class="mb-4">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-bold">
                                {{ $subject->code }}
                            </span>
                            <span class="ml-2 text-xs text-gray-500">{{ $subject->credits }} SKS</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $subject->name }}</h3>
                        <p class="text-sm text-gray-600 line-clamp-2">{{ $subject->description }}</p>
                    </div>

                    <!-- Teacher Info -->
                    <div class="flex items-center mb-4 pb-4 border-b border-gray-200">
                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-sm text-gray-700">{{ $subject->teacher->name ?? 'Belum ada guru' }}</span>
                    </div>

                    <!-- Quota Progress -->
                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Kuota Pendaftar</span>
                            <span class="font-semibold {{ $subject->isQuotaFull() ? 'text-red-600' : 'text-green-600' }}">
                                {{ $subject->registered_count }}/{{ $subject->quota }}
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full {{ $subject->isQuotaFull() ? 'bg-red-500' : 'bg-green-500' }}"
                                 style="width: {{ ($subject->registered_count / $subject->quota) * 100 }}%">
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <x-button href="{{ url('/mata-pelajaran/' . $subject->id) }}" variant="outline" size="sm" class="flex-1">
                            Detail
                        </x-button>
                        @if($subject->isQuotaFull())
                            <x-button variant="primary" size="sm" class="flex-1" disabled>
                                Daftar
                            </x-button>
                        @else
                            <x-button href="{{ url('/registrasi') }}" variant="primary" size="sm" class="flex-1">
                                Daftar
                            </x-button>
                        @endif
                    </div>
                </x-card>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $subjects->links() }}
        </div>
    @else
        <x-card>
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Tidak ada mata pelajaran</h3>
                <p class="text-gray-500">Belum ada mata pelajaran yang tersedia</p>
            </div>
        </x-card>
    @endif

</div>
@endsection