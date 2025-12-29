@extends('layouts.app')

@section('title', 'Kelola Siswa')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Kelola Siswa</h1>
            <p class="text-gray-600 mt-2">Manajemen data siswa</p>
        </div>
        <x-button href="{{ url('/admin/students/create') }}" variant="primary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Siswa
        </x-button>
    </div>

    @if(session('success'))
        <x-alert type="success" :message="session('success')" class="mb-6" />
    @endif
    @if(session('error'))
        <x-alert type="error" :message="session('error')" class="mb-6" />
    @endif

    <!-- Filter -->
    <x-card class="mb-6">
        <form method="GET" action="{{ url('/admin/students') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari siswa (nama, NIS, email)..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <select name="class_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kelas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <x-button type="submit" variant="primary">
                Filter
            </x-button>
        </form>
    </x-card>

    <!-- Students Table -->
    <x-card>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="p-4 text-left font-semibold text-gray-700">NIS</th>
                        <th class="p-4 text-left font-semibold text-gray-700">Nama</th>
                        <th class="p-4 text-left font-semibold text-gray-700">Email</th>
                        <th class="p-4 text-left font-semibold text-gray-700">Kelas</th>
                        <th class="p-4 text-left font-semibold text-gray-700">Jenis Kelamin</th>
                        <th class="p-4 text-left font-semibold text-gray-700">Telepon</th>
                        <th class="p-4 text-left font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">
                                <span class="font-mono text-sm text-gray-700">{{ $student->nis }}</span>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-xs mr-2">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                    <span class="font-semibold text-gray-800">{{ $student->name }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-gray-600">{{ $student->email }}</td>
                            <td class="p-4">
                                @if($student->class)
                                    <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded text-xs font-medium">
                                        {{ $student->class->name }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs">Belum ada</span>
                                @endif
                            </td>
                            <td class="p-4">
                                @if($student->gender == 'L')
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">Laki-laki</span>
                                @elseif($student->gender == 'P')
                                    <span class="px-2 py-1 bg-pink-100 text-pink-700 rounded text-xs">Perempuan</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="p-4 text-sm text-gray-600">{{ $student->phone ?? '-' }}</td>
                            <td class="p-4">
                                <div class="flex gap-2">
                                    <a href="{{ url('/admin/students/' . $student->id . '/edit') }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ url('/admin/students/' . $student->id) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus siswa ini?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-500">
                                Tidak ada data siswa
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($students->hasPages())
            <div class="mt-4 border-t pt-4">
                {{ $students->links() }}
            </div>
        @endif
    </x-card>

</div>
@endsection