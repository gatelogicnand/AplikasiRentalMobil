<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Rental Mobil') }} - Admin</title>
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <!-- Tambahkan x-data untuk state sidebar dari Alpine.js -->
    <body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex">
            
            <!-- OVERLAY GELAP UNTUK MOBILE (Muncul saat menu dibuka) -->
            <div x-show="sidebarOpen" 
                 @click="sidebarOpen = false" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-20 bg-gray-900 bg-opacity-50 md:hidden" 
                 style="display: none;">
            </div>

            <!-- SIDEBAR ADMIN -->
            <!-- Diubah menjadi 'fixed' untuk mobile dan 'relative' untuk desktop -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
                   class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-700 flex-shrink-0 min-h-screen text-white shadow-xl flex flex-col transition-transform duration-300 ease-in-out md:relative md:translate-x-0 md:flex">
                
                <!-- Header Sidebar dengan Tombol Close untuk Mobile -->
                <div class="p-6 border-b border-slate-600 flex items-center justify-between md:justify-center text-center">
                    <h2 class="text-lg font-bold text-white tracking-wide leading-tight">Aplikasi Rental Mobil</h2>
                    
                    <!-- Tombol Close (X) hanya muncul di Mobile -->
                    <button @click="sidebarOpen = false" class="md:hidden text-gray-300 hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Navigasi Utama (Atas) -->
                <nav class="p-4 space-y-2 mt-4 flex-1">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded-lg transition-colors font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-600 hover:text-white' }}">
                        📊 Dashboard
                    </a>

                    <a href="{{ route('admin.mobils.index') }}" class="block px-4 py-2.5 rounded-lg transition-colors font-medium {{ request()->routeIs('admin.mobils.*') ? 'bg-blue-500 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-600 hover:text-white' }}">
                        🚗 Inventaris Mobil
                    </a>

                    <a href="{{ route('admin.rentals.index') }}" class="block px-4 py-2.5 rounded-lg transition-colors font-medium {{ request()->routeIs('admin.rentals.*') ? 'bg-blue-500 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-600 hover:text-white' }}">
                        📄 Data Rental
                    </a>
                </nav>

                <!-- Navigasi Akun (Bawah) -->
                <div class="p-4 border-t border-slate-600 space-y-2">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 rounded-lg transition-colors font-medium {{ request()->routeIs('profile.edit') ? 'bg-blue-500 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-600 hover:text-white' }}">
                        👤 Profil Saya
                    </a>

                    <!-- Form Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2.5 font-medium text-slate-300 hover:bg-red-500 hover:text-white rounded-lg transition-colors">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </aside>

            <!-- KONTEN UTAMA -->
            <div class="flex-1 flex flex-col min-w-0">
                
                <!-- Header Atas (Putih) -->
                <header class="bg-white shadow-sm border-b border-gray-200 flex items-center">
                    
                    <!-- TOMBOL HAMBURGER MOBILE -->
                    <button @click="sidebarOpen = true" class="p-4 text-gray-500 hover:text-gray-700 focus:outline-none md:hidden">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Judul Header dari Slot -->
                    @if (isset($header))
                        <div class="py-4 px-4 sm:px-6 md:px-8 w-full">
                            {{ $header }}
                        </div>
                    @endif
                </header>

                <!-- Area Main Content -->
                <main class="flex-1 p-4 md:p-6 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>

        </div>
    </body>
</html>