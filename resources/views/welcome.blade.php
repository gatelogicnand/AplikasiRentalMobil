<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Mobil - Layanan Rental Terpercaya</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600">Rental Mobil</a>
                </div>
                <div class="flex items-center space-x-4">
                    
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-blue-600 font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md font-medium hover:bg-blue-700 transition">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gray-900 pt-24 pb-32 flex items-center min-h-[80vh]">
        <!-- Background Image Overlay (Opsional, ganti URL dengan gambar Anda jika ada) -->
        <div class="absolute inset-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?q=80&w=2070&auto=format&fit=crop" alt="Car Background" class="w-full h-full object-cover opacity-20">
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Rental Mobil Mudah, Cepat, <br> dan Terpercaya
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                Pilih dari berbagai koleksi armada terbaik kami untuk perjalanan bisnis, liburan keluarga, atau kebutuhan sehari-hari Anda dengan harga terbaik.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="#katalog" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-300">
                    Lihat Mobil Tersedia
                </a>
            </div>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6">
                    <div class="w-12 h-12 mx-auto bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Layanan 24/7</h3>
                    <p class="text-gray-600">Dukungan pelanggan siap sedia kapan pun Anda membutuhkan bantuan selama perjalanan.</p>
                </div>
                <div class="p-6">
                    <div class="w-12 h-12 mx-auto bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Armada Terawat</h3>
                    <p class="text-gray-600">Seluruh mobil kami melewati pengecekan rutin untuk memastikan kenyamanan dan keamanan Anda.</p>
                </div>
                <div class="p-6">
                    <div class="w-12 h-12 mx-auto bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Harga Transparan</h3>
                    <p class="text-gray-600">Tidak ada biaya tersembunyi. Harga yang Anda lihat adalah harga yang Anda bayar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Katalog Mobil Section -->
    <section id="katalog" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Armada Terbaik Kami</h2>
                <p class="text-gray-600 mt-4">Pilih mobil yang sesuai dengan kebutuhan perjalanan Anda.</p>
            </div>

            <!-- Grid Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @forelse ($mobils as $mobil)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100 flex flex-col">
                    <!-- Foto Mobil -->
                    <div class="h-48 overflow-hidden bg-gray-200 group">
                        @if($mobil->foto)
                            <img src="{{ asset('storage/' . $mobil->foto) }}" alt="{{ $mobil->nama_mobil }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                            <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                    </div>
                    
                    <!-- Detail Mobil -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold text-gray-900">{{ $mobil->nama_mobil }}</h3>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $mobil->merek }}</span>
                            </div>
                            <p class="text-gray-500 text-sm mb-4">No. Polisi: {{ $mobil->plat_nomor }}</p>
                        </div>
                        
                        <div class="mt-4 border-t pt-4">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($mobil->harga_sewa, 0, ',', '.') }}</span>
                                <span class="text-gray-500 text-sm">/ hari</span>
                            </div>

                            <!-- Logika Autentikasi: Jika belum login, arahkan ke login. Jika sudah, arahkan ke form pesanan -->
                            @auth
                                <a href="{{ route('rentals.create', $mobil->id) }}" class="block w-full text-center py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold transition-colors duration-200">
                                    Pesan Sekarang
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="block w-full text-center bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded transition">
                                    Login untuk Memesan
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-3 text-center py-10">
                    <p class="text-gray-500 text-lg">Belum ada armada mobil yang tersedia saat ini.</p>
                </div>
                @endforelse

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-2xl font-bold text-white mb-4">Rental Mobil</h3>
                <p class="text-gray-400">Solusi transportasi terbaik dan terpercaya untuk segala kebutuhan perjalanan Anda.</p>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Tautan Cepat</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-blue-400 transition">Tentang Kami</a></li>
                    <li><a href="#katalog" class="hover:text-blue-400 transition">Katalog Armada</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Syarat & Ketentuan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Hubungi Kami</h4>
                <ul class="space-y-2 text-gray-400">
                    <li>📍 Jl. Merdeka No. 123, Jakarta</li>
                    <li>📞 +62 812 3456 7890</li>
                    <li>✉️ support@rentalmobil.com</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500">
            <p>&copy; {{ date('Y') }} Rental Mobil. Corporate Clean Standard. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>