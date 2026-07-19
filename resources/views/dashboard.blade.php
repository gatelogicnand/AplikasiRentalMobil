<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Statistik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Ucapan Selamat Datang -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-100">
                <div class="p-6 text-gray-900 font-medium text-lg">
                    Selamat datang kembali, <span class="text-blue-600 font-bold">{{ Auth::user()->name }}</span>!
                    @if(Auth::user()->role === 'admin')
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            Administrator
                        </span>
                    @endif
                </div>
            </div>

            <!-- Grid Statistik (Hanya muncul jika yang login adalah Admin) -->
            @if(Auth::user()->role === 'admin')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                
                <!-- Card 1: Total Mobil -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600">Total Kendaraan</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalMobil }}</p>
                    </div>
                </div>

                <!-- Card 2: Mobil Tersedia -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600">Mobil Tersedia</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $mobilTersedia }}</p>
                    </div>
                </div>

                <!-- Card 3: Total Transaksi -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600">Total Transaksi</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalRental }}</p>
                    </div>
                </div>

                <!-- Card 4: Total Pelanggan -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600">Pelanggan Aktif</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalPelanggan }}</p>
                    </div>
                </div>

            </div>
            
            <!-- Tempat tombol Export PDF nantinya -->
            <div class="mt-4 flex justify-end">
                <a href="{{ route('admin.mobils.export_pdf') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export Laporan (PDF)
                </a>
            </div>
            @else
            <!-- Area Khusus User/Pelanggan (Jika bukan admin) -->
            <div class="bg-white rounded-lg shadow-sm p-8 text-center border border-gray-100 mt-6">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Mulai Perjalanan Anda</h3>
                <p class="mt-1 text-sm text-gray-500">Silakan menuju halaman Katalog untuk melihat mobil yang tersedia untuk disewa.</p>
                <div class="mt-6">
                    <a href="{{ route('mobils.katalog') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Lihat Katalog Mobil
                    </a>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>