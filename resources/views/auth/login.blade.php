<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Aplikasi Rental Mobil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-900 antialiased bg-slate-50 selection:bg-blue-100 selection:text-blue-900">
    <div class="min-h-screen flex items-center justify-center p-4">
        
        <!-- Login Card -->
        <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden transition-all">
            
            <!-- Header Section -->
            <div class="bg-blue-600 px-8 py-10 text-center relative overflow-hidden">
                <!-- Dekorasi Background -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500 rounded-full opacity-50 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-blue-700 rounded-full opacity-50 blur-2xl"></div>
                
                <!-- Ikon Aplikasi -->
                <div class="relative z-10 mx-auto w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-5 shadow-lg transform rotate-3">
                    <svg class="w-9 h-9 text-blue-600 -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 002 15v1c0 .6.4 1 1 1h2m14 0a2 2 0 11-4 0 2 2 0 014 0zM9 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                
                <h2 class="relative z-10 text-2xl font-bold text-white mb-1">Selamat Datang!</h2>
                <p class="relative z-10 text-blue-100 text-sm font-medium">Masuk ke sistem Aplikasi Rental Mobil</p>
            </div>

            <!-- Form Section -->
            <div class="p-8">
                <!-- Session Status / Pesan Error Global -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full pl-11 px-4 py-3.5 border border-slate-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm bg-slate-50 focus:bg-white text-slate-900" placeholder="admin@contoh.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full pl-11 px-4 py-3.5 border border-slate-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm bg-slate-50 focus:bg-white text-slate-900" placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Pilihan Tambahan -->
                    <div class="flex items-center justify-between pt-2">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 w-4 h-4 transition-colors">
                            <span class="ml-2 text-sm text-slate-600 font-medium group-hover:text-slate-900 transition-colors">Ingat Saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors" href="{{ route('password.request') }}">
                                Lupa Kata Sandi?
                            </a>
                        @endif
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center items-center py-4 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                            Masuk Sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
                
                <!-- Tautan Register (Opsional, akan muncul jika route register diaktifkan) -->
                @if (Route::has('register'))
                    <div class="mt-8 text-center text-sm text-slate-500">
                        Belum memiliki akun? 
                        <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors">Daftar di sini</a>
                    </div>
                @endif
            </div>
        </div>
        
    </div>
</body>
</html>