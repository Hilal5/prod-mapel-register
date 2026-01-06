@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Profile Saya</h1>
        <p class="text-gray-600 mt-2">Informasi pribadi dan aktivitas</p>
    </div>

    @if(session('success'))
        <x-alert type="success" :message="session('success')" class="mb-6" />
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <x-card>
                <div class="text-center">
                    <!-- Avatar -->
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full mx-auto flex items-center justify-center text-white text-4xl font-bold shadow-lg">
                        {{ substr($user->name, 0, 1) }}
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900 mt-4">{{ $user->name }}</h2>
                    
                    @if($user->isAdmin())
                        <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium mt-2">
                            Administrator
                        </span>
                    @else
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mt-2">
                            Siswa
                        </span>
                    @endif

                    @if($user->nis)
                        <p class="text-sm text-gray-600 mt-2">NIS: {{ $user->nis }}</p>
                    @endif

                    <div class="mt-6 space-y-2">
                        <x-button href="{{ route('profile.edit') }}" variant="primary" class="w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Profile
                        </x-button>
                        <x-button href="{{ route('profile.settings') }}" variant="outline" class="w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Pengaturan
                        </x-button>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Profile Details -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Personal Information -->
            <x-card title="Informasi Pribadi">
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">No. Telepon</label>
                            <p class="text-gray-900 font-medium">{{ $user->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Jenis Kelamin</label>
                            <p class="text-gray-900 font-medium">{{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Lahir</label>
                            <p class="text-gray-900 font-medium">
                                {{ $user->birth_date ? $user->birth_date->format('d F Y') : '-' }}
                            </p>
                        </div>
                        @if($user->isStudent() && $user->class)
                            <div>
                                <label class="text-sm font-medium text-gray-500">Kelas</label>
                                <p class="text-gray-900 font-medium">{{ $user->class->name }}</p>
                            </div>
                        @endif
                    </div>
                    @if($user->address)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Alamat</label>
                            <p class="text-gray-900">{{ $user->address }}</p>
                        </div>
                    @endif
                </div>
            </x-card>

            <!-- Statistics (For Students) -->
            @if($user->isStudent())
                <x-card title="Statistik Akademik">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-3xl font-bold text-blue-600">
                                {{ $user->registrations->where('status', 'approved')->count() }}
                            </div>
                            <div class="text-sm text-gray-600 mt-1">Mata Pelajaran</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-3xl font-bold text-green-600">
                                {{ $user->registrations->where('status', 'approved')->sum(function($reg) {
                                    return $reg->subject->credits ?? 0;
                                }) }}
                            </div>
                            <div class="text-sm text-gray-600 mt-1">Total SKS</div>
                        </div>
                        <div class="text-center p-4 bg-yellow-50 rounded-lg">
                            <div class="text-3xl font-bold text-yellow-600">
                                {{ $user->registrations->where('status', 'pending')->count() }}
                            </div>
                            <div class="text-sm text-gray-600 mt-1">Pending</div>
                        </div>
                    </div>
                </x-card>

                <!-- Recent Registrations -->
                <x-card title="Registrasi Terbaru" subtitle="5 registrasi terakhir">
                    @if($user->registrations->count() > 0)
                        <div class="space-y-3">
                            @foreach($user->registrations->take(5) as $reg)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800">{{ $reg->subject->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $reg->schedule->day }}, {{ $reg->schedule->time_range }}</p>
                                    </div>
                                    <div>
                                        @if($reg->status == 'approved')
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Approved</span>
                                        @elseif($reg->status == 'pending')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">Pending</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">{{ ucfirst($reg->status) }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <x-button href="{{ url('/registrasi/saya') }}" variant="outline" size="sm" class="w-full">
                                Lihat Semua Registrasi
                            </x-button>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Belum ada registrasi</p>
                    @endif
                </x-card>
            @endif

        </div>

    </div>

</div>
@endsection