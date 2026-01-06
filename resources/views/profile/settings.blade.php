@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-6">
        <a href="{{ route('profile.show') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Profile
        </a>
    </div>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Pengaturan</h1>
        <p class="text-gray-600 mt-2">Kelola pengaturan akun dan keamanan</p>
    </div>

    @if(session('success'))
        <x-alert type="success" :message="session('success')" class="mb-6" />
    @endif

    @if($errors->any())
        <x-alert type="error" class="mb-6">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    <div class="space-y-6">
        
        <!-- Change Password -->
        <x-card title="Ubah Password" subtitle="Update password akun Anda">
            <form method="POST" action="{{ route('profile.update-password') }}">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Password Saat Ini <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="current_password" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Password Baru <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Minimal 8 karakter">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password Baru <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password_confirmation" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <div class="mt-6">
                    <x-button type="submit" variant="primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Update Password
                    </x-button>
                </div>
            </form>
        </x-card>

        <!-- Account Information -->
        <x-card title="Informasi Akun" subtitle="Detail akun dan status">
            <div class="space-y-4">
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <div>
                        <h4 class="font-medium text-gray-900">Email</h4>
                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                        Verified
                    </span>
                </div>

                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <div>
                        <h4 class="font-medium text-gray-900">Role</h4>
                        <p class="text-sm text-gray-600">{{ $user->isAdmin() ? 'Administrator' : 'Siswa' }}</p>
                    </div>
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">
                        Active
                    </span>
                </div>

                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <div>
                        <h4 class="font-medium text-gray-900">Bergabung Sejak</h4>
                        <p class="text-sm text-gray-600">{{ $user->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </x-card>

        <!-- Notification Preferences -->
        <x-card title="Preferensi Notifikasi" subtitle="Atur notifikasi yang ingin Anda terima">
            <form method="POST" action="{{ route('profile.update-notifications') }}">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <label class="flex items-center justify-between p-4 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                        <div>
                            <h4 class="font-medium text-gray-900">Email Notifikasi</h4>
                            <p class="text-sm text-gray-600">Terima notifikasi melalui email</p>
                        </div>
                        <input type="checkbox" name="email_notifications" checked
                               class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                    </label>

                    <label class="flex items-center justify-between p-4 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                        <div>
                            <h4 class="font-medium text-gray-900">Registrasi Updates</h4>
                            <p class="text-sm text-gray-600">Notifikasi status registrasi mata pelajaran</p>
                        </div>
                        <input type="checkbox" name="registration_notifications" checked
                               class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                    </label>

                    <label class="flex items-center justify-between p-4 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                        <div>
                            <h4 class="font-medium text-gray-900">Jadwal Reminder</h4>
                            <p class="text-sm text-gray-600">Pengingat jadwal pelajaran</p>
                        </div>
                        <input type="checkbox" name="schedule_reminders" checked
                               class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                    </label>

                    <label class="flex items-center justify-between p-4 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                        <div>
                            <h4 class="font-medium text-gray-900">Pengumuman</h4>
                            <p class="text-sm text-gray-600">Notifikasi pengumuman penting dari sekolah</p>
                        </div>
                        <input type="checkbox" name="announcement_notifications" checked
                               class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                    </label>
                </div>

                <div class="mt-6">
                    <x-button type="submit" variant="primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        Simpan Preferensi
                    </x-button>
                </div>
            </form>
        </x-card>

        <!-- Danger Zone -->
        <x-card title="Danger Zone" subtitle="Aksi yang tidak dapat dibatalkan">
            <div class="border-2 border-red-200 rounded-lg p-4 bg-red-50">
                <div class="flex items-start justify-between">
                    <div>
                        <h4 class="font-semibold text-red-900">Hapus Akun</h4>
                        <p class="text-sm text-red-700 mt-1">
                            Setelah akun dihapus, semua data akan hilang secara permanen. Aksi ini tidak dapat dibatalkan.
                        </p>
                    </div>
                    <button onclick="alert('Hubungi administrator untuk menghapus akun')"
                            class="ml-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium whitespace-nowrap">
                        Hapus Akun
                    </button>
                </div>
            </div>
        </x-card>

    </div>

</div>
@endsection