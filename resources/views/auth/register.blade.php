<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Aplikasi Rental Mobil</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50">

    <div class="min-h-screen flex">
        
        <!-- Sisi Kiri: Hero Image & Branding (Hidden di layar kecil) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900 items-center justify-center overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1485291571150-772bcfc10da5?q=80&w=2128&auto=format&fit=crop" class="w-full h-full object-cover opacity-40" alt="Corporate Car">
            </div>
            
            <!-- Overlay Content -->
            <div class="relative z-10 max-w-lg px-8 text-center text-white">
                <div class="mb-6 flex justify-center">
                    <!-- Icon Mobil Minimalis -->
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.8L2 12v4c0 .6.4 1 1 1h2m14 0a2 2 0 11-4 0 2 2 0 014 0zm-10 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="text-4xl font-bold mb-4 tracking-tight leading-tight">Mulai Perjalanan Anda Bersama Kami</h1>
                <p class="text-lg text-gray-300">Buat akun sekarang untuk menikmati kemudahan reservasi armada premium dengan standar pelayanan eksklusif.</p>
            </div>
        </div>

        <!-- Sisi Kanan: Form Registrasi -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 bg-white shadow-xl lg:shadow-none z-10">
            <div class="w-full max-w-md">
                
                <!-- Logo untuk tampilan Mobile -->
                <div class="lg:hidden text-center mb-8">
                    <a href="/" class="text-3xl font-bold text-blue-600">Rental Mobil</a>
                </div>

                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-gray-900">Buat Akun Baru</h2>
                    <p class="text-gray-500 mt-2">Lengkapi form di bawah ini untuk mendaftar.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <div class="mt-1">
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                                class="block w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <div class="mt-1">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                                class="block w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors"
                                placeholder="email@contoh.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="block w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors"
                                placeholder="Minimal 8 karakter">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <div class="mt-1">
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="block w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors"
                                placeholder="Ulangi password Anda">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a class="text-sm text-gray-600 hover:text-blue-600 hover:underline font-medium transition" href="{{ route('login') }}">
                            Sudah punya akun?
                        </a>

                        <button type="submit" class="inline-flex justify-center items-center rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                            Daftar Sekarang
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>

</body>
</html>