@if(Auth::user()->role === 'admin')
    <!-- TAMPILAN DASHBOARD ADMIN -->
    <x-admin-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Welcome Message Admin -->
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-slate-800">Selamat datang kembali, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-slate-500 mt-1">Berikut adalah ringkasan data rental mobil Anda hari ini.</p>
                </div>

                <!-- Grid Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Card 1: Total Mobil -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-shadow duration-300">
                        <div class="p-4 rounded-xl bg-blue-50 text-blue-600 mr-4">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 17l.867 12.142A2 2 0 0117.138 31H6.862a2 2 0 01-1.995-1.858L4 17h16zM4 17l3-10h10l3 10"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Total Mobil</p>
                            <p class="text-3xl font-bold text-slate-800">{{ $totalMobil }}</p>
                        </div>
                    </div>

                    <!-- Card 2: Mobil Tersedia -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-shadow duration-300">
                        <div class="p-4 rounded-xl bg-green-50 text-green-600 mr-4">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Tersedia</p>
                            <p class="text-3xl font-bold text-slate-800">{{ $mobilTersedia }}</p>
                        </div>
                    </div>

                    <!-- Card 3: Total Transaksi -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-shadow duration-300">
                        <div class="p-4 rounded-xl bg-yellow-50 text-yellow-600 mr-4">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Transaksi</p>
                            <p class="text-3xl font-bold text-slate-800">{{ $totalRental }}</p>
                        </div>
                    </div>

                    <!-- Card 4: Total Pelanggan -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-shadow duration-300">
                        <div class="p-4 rounded-xl bg-purple-50 text-purple-600 mr-4">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider">Pelanggan</p>
                            <p class="text-3xl font-bold text-slate-800">{{ $totalPelanggan }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>

@else
    <!-- TAMPILAN DASHBOARD USER / CUSTOMER -->
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Beranda') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm border border-gray-100 sm:rounded-2xl">
                    <div class="p-10 text-center">
                        <!-- Icon User -->
                        <div class="w-24 h-24 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        
                        <h3 class="text-3xl font-bold text-slate-800 mb-3">Halo, {{ Auth::user()->name }}!</h3>
                        <p class="text-slate-500 mb-8 max-w-lg mx-auto text-lg">
                            Selamat datang di portal layanan kami. Sudah siap untuk memulai perjalanan Anda berikutnya dengan armada terbaik kami?
                        </p>
                        
                        <!-- Call to Action -->
                        <a href="{{ route('mobils.katalog') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 border border-transparent rounded-full font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                            Lihat Katalog Kendaraan
                            <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif