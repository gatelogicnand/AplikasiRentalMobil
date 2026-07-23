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
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen flex">
            
            <!-- Sidebar Admin (Flex Column agar bisa memisahkan atas & bawah) -->
            <aside class="bg-slate-700 w-64 flex-shrink-0 min-h-screen text-white shadow-xl flex flex-col sticky top-0 h-screen">
                <div class="p-6 border-b border-slate-600 flex items-center justify-center text-center">
                    <h2 class="text-lg font-bold text-white tracking-wide leading-tight">Aplikasi Rental Mobil</h2>
                </div>
                
                <!-- Navigasi Utama (Atas) -->
                <nav class="p-4 space-y-2 mt-4 flex-1">
                    
                    <!-- Menu Dashboard -->
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded-lg transition-colors font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-600 hover:text-white' }}">
                        📊 Dashboard
                    </a>

                    <!-- Menu Inventaris Mobil -->
                    <a href="{{ route('admin.mobils.index') }}" class="block px-4 py-2.5 rounded-lg transition-colors font-medium {{ request()->routeIs('admin.mobils.*') ? 'bg-blue-500 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-600 hover:text-white' }}">
                        🚗 Inventaris Mobil
                    </a>

                    <!-- Menu Data Rental -->
                    <a href="{{ route('admin.rentals.index') }}" class="block px-4 py-2.5 rounded-lg transition-colors font-medium {{ request()->routeIs('admin.rentals.*') ? 'bg-blue-500 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-600 hover:text-white' }}">
                        📄 Data Rental
                    </a>

                </nav>

                <!-- Navigasi Akun (Bawah) -->
                <div class="p-4 border-t border-slate-600 space-y-2">
                    
                    <!-- Menu Profil -->
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

            <!-- Konten Utama -->
            <div class="flex-1 flex flex-col min-w-0">
                <!-- Header Atas (Putih) -->
                @if (isset($header))
                    <header class="bg-white shadow-sm border-b border-gray-200">
                        <div class="py-4 px-6 sm:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Area Main Content -->
                <main class="flex-1 p-6 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>

        </div>
    </body>
</html>