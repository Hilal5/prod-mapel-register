<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIAKAD SMP') }} - @yield('title')</title>

    <!-- FAVICON/LOGO di browser tab -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <!-- Untuk Apple devices -->
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js untuk interaktivitas -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg sticky top-0 z-50" x-data="{ open: false, userMenu: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo & Brand -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex items-center space-x-3">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <div class="text-white hidden sm:block">
                                <div class="text-xl font-bold">SIAKAD SMP</div>
                                <div class="text-xs text-blue-100">Sistem Informasi Akademik</div>
                            </div>
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex md:items-center md:space-x-1">
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition duration-150 {{ request()->is('dashboard') ? 'bg-blue-700' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ url('/jadwal') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition duration-150 {{ request()->is('jadwal*') ? 'bg-blue-700' : '' }}">
                            Jadwal
                        </a>
                        <a href="{{ url('/mata-pelajaran') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition duration-150 {{ request()->is('mata-pelajaran*') ? 'bg-blue-700' : '' }}">
                            Mata Pelajaran
                        </a>
                        <a href="{{ url('/registrasi') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition duration-150 {{ request()->is('registrasi*') ? 'bg-blue-700' : '' }}">
                            Registrasi
                        </a>
                        <a href="{{ url('/kelas') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition duration-150 {{ request()->is('kelas*') ? 'bg-blue-700' : '' }}">
                            Kelas
                        </a>
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <a href="{{ url('/admin/dashboard') }}" class="px-4 py-2 text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg transition duration-150 {{ request()->is('admin*') ? 'bg-yellow-600' : '' }}">
                                Admin Panel
                            </a>
                        @endif
                    </div>

                    <!-- Right Side (User Menu & Mobile Button) -->
                    <div class="flex items-center space-x-2">
                        <!-- User Menu (Desktop) -->
                        <div class="hidden md:block">
                            @auth
                                <div class="relative">
                                    <button @click="userMenu = !userMenu" @click.away="userMenu = false"
                                            class="flex items-center space-x-2 text-white hover:text-blue-100 transition">
                                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                                        <div class="w-9 h-9 bg-blue-500 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>

                                    <div x-show="userMenu" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100 scale-100"
                                         x-transition:leave-end="opacity-0 scale-95"
                                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50">
                                        <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                        <a href="{{ url('/settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                        <hr class="my-1">
                                        <form method="POST" action="{{ url('/logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center space-x-2">
                                    <a href="{{ url('/login') }}" class="px-4 py-2 text-white hover:text-blue-100 transition">Login</a>
                                    <a href="{{ url('/register') }}" class="px-4 py-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition font-medium">Register</a>
                                </div>
                            @endauth
                        </div>

                        <!-- Mobile menu button -->
                        <button @click="open = !open" class="md:hidden text-white hover:text-blue-100 focus:outline-none p-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="md:hidden bg-blue-700 border-t border-blue-600">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <!-- User Info (Mobile) -->
                    @auth
                        <div class="px-3 py-3 bg-blue-800 rounded-lg mb-2">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-white font-semibold">{{ Auth::user()->name }}</div>
                                    <div class="text-blue-200 text-xs">{{ Auth::user()->role == 'admin' ? 'Administrator' : 'Siswa' }}</div>
                                </div>
                            </div>
                        </div>
                    @endauth

                    <!-- Menu Items -->
                    <a href="{{ url('/dashboard') }}" class="block px-3 py-2 text-white hover:bg-blue-600 rounded-lg {{ request()->is('dashboard') ? 'bg-blue-600' : '' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </div>
                    </a>

                    <a href="{{ url('/jadwal') }}" class="block px-3 py-2 text-white hover:bg-blue-600 rounded-lg {{ request()->is('jadwal*') ? 'bg-blue-600' : '' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Jadwal
                        </div>
                    </a>

                    <a href="{{ url('/mata-pelajaran') }}" class="block px-3 py-2 text-white hover:bg-blue-600 rounded-lg {{ request()->is('mata-pelajaran*') ? 'bg-blue-600' : '' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Mata Pelajaran
                        </div>
                    </a>

                    <a href="{{ url('/registrasi') }}" class="block px-3 py-2 text-white hover:bg-blue-600 rounded-lg {{ request()->is('registrasi*') ? 'bg-blue-600' : '' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Registrasi
                        </div>
                    </a>

                    <a href="{{ url('/kelas') }}" class="block px-3 py-2 text-white hover:bg-blue-600 rounded-lg {{ request()->is('kelas*') ? 'bg-blue-600' : '' }}">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Kelas
                        </div>
                    </a>

                    @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ url('/admin/dashboard') }}" class="block px-3 py-2 text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg {{ request()->is('admin*') ? 'bg-yellow-600' : '' }}">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Admin Panel
                            </div>
                        </a>
                    @endif

                    <!-- Auth Links (Mobile) -->
                    @guest
                        <div class="border-t border-blue-600 mt-2 pt-2">
                            <a href="{{ url('/login') }}" class="block px-3 py-2 text-white hover:bg-blue-600 rounded-lg">Login</a>
                            <a href="{{ url('/register') }}" class="block px-3 py-2 text-white hover:bg-blue-600 rounded-lg">Register</a>
                        </div>
                    @else
                        <div class="border-t border-blue-600 mt-2 pt-2">
                            <a href="{{ url('/profile') }}" class="block px-3 py-2 text-white hover:bg-blue-600 rounded-lg">Profile</a>
                            <a href="{{ url('/settings') }}" class="block px-3 py-2 text-white hover:bg-blue-600 rounded-lg">Settings</a>
                            <form method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-3 py-2 text-red-300 hover:bg-blue-600 rounded-lg">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <x-alert type="success" :message="session('success')" />
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <x-alert type="error" :message="session('error')" />
            </div>
        @endif

        <!-- Page Content -->
        <main class="py-8">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} SIAKAD SMP. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>