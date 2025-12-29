@extends('layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-6">
        <a href="{{ url('/admin/schedules') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Tambah Jadwal</h1>
        <p class="text-gray-600 mt-2">Lengkapi form untuk menambah jadwal baru</p>
    </div>

    <x-card>
        <form method="POST" action="{{ url('/admin/schedules') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Mata Pelajaran <span class="text-red-500">*</span>
                    </label>
                    <select name="subject_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('subject_id') border-red-500 @enderror">
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }} ({{ $subject->code }})
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Kelas <span class="text-red-500">*</span>
                    </label>
                    <select name="class_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('class_id') border-red-500 @enderror">
                        <option value="">Pilih Kelas</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('class_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Guru Pengajar <span class="text-red-500">*</span>
                    </label>
                    <select name="teacher_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('teacher_id') border-red-500 @enderror">
                        <option value="">Pilih Guru</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Hari <span class="text-red-500">*</span>
                    </label>
                    <select name="day" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('day') border-red-500 @enderror">
                        <option value="">Pilih Hari</option>
                        <option value="Senin" {{ old('day') == 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ old('day') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ old('day') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ old('day') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ old('day') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ old('day') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    </select>
                    @error('day')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Waktu Mulai <span class="text-red-500">*</span>
                    </label>
                    <input type="time" name="start_time" value="{{ old('start_time') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('start_time') border-red-500 @enderror">
                    @error('start_time')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Waktu Selesai <span class="text-red-500">*</span>
                    </label>
                    <input type="time" name="end_time" value="{{ old('end_time') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('end_time') border-red-500 @enderror">
                    @error('end_time')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Ruangan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="room" value="{{ old('room') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('room') border-red-500 @enderror"
                           placeholder="R-101, Lab IPA, dll">
                    @error('room')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Semester <span class="text-red-500">*</span>
                    </label>
                    <select name="semester" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('semester') border-red-500 @enderror">
                        <option value="ganjil" {{ old('semester', 'ganjil') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="genap" {{ old('semester') == 'genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('semester')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tahun Ajaran <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="academic_year" value="{{ old('academic_year', date('Y')) }}" required
                           min="2020" max="2100"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('academic_year') border-red-500 @enderror">
                    @error('academic_year')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                <textarea name="notes" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                          placeholder="Catatan tambahan (opsional)">{{ old('notes') }}</textarea>
            </div>

            <div class="mt-8 flex gap-4">
                <x-button type="submit" variant="primary" size="lg">
                    Simpan Jadwal
                </x-button>
                <x-button href="{{ url('/admin/schedules') }}" variant="outline" size="lg">
                    Batal
                </x-button>
            </div>
        </form>
    </x-card>

</div>
@endsection