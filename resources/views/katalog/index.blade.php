<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Katalog Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Header / Title Section -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-extrabold text-slate-900 sm:text-4xl">Pilih Armada Terbaik Anda</h1>
                <p class="mt-4 text-lg text-slate-500 max-w-2xl mx-auto">Temukan kendaraan yang tepat untuk kebutuhan perjalanan bisnis maupun liburan Anda. Harga terjangkau, kualitas terjamin.</p>
            </div>

            <!-- Grid Katalog -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($mobils as $mobil)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col group">
                        
                        <!-- Foto Mobil -->
                        <div class="relative h-56 bg-slate-200 overflow-hidden">
                            @if($mobil->foto)
                                <img src="{{ asset('storage/' . $mobil->foto) }}" alt="{{ $mobil->merek }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-100">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm font-medium">Gambar Tidak Tersedia</span>
                                </div>
                            @endif
                            
                            <!-- Badge Status Absolute -->
                            <div class="absolute top-4 right-4 z-10">
                                @if($mobil->status == 'tersedia')
                                    <span class="px-4 py-1.5 bg-green-500 text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-md">Tersedia</span>
                                @elseif($mobil->status == 'dirental')
                                    <span class="px-4 py-1.5 bg-yellow-500 text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-md">Sedang Dirental</span>
                                @else
                                    <span class="px-4 py-1.5 bg-red-500 text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-md">Maintenance</span>
                                @endif
                            </div>
                        </div>

                        <!-- Info Mobil -->
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $mobil->merek }}</h3>
                                    <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded text-xs font-semibold">{{ $mobil->tipe }}</span>
                                </div>
                                <!-- Harga -->
                                <div class="text-right">
                                    <p class="text-xl font-extrabold text-blue-600">Rp {{ number_format($mobil->harga_sewa_per_hari, 0, ',', '.') }}</p>
                                    <p class="text-xs text-slate-400 font-medium mt-1">/ HARI</p>
                                </div>
                            </div>

                            <div class="mt-auto pt-6 border-t border-gray-100">
                                @if($mobil->status == 'tersedia')
                                    <!-- Mengarah ke route booking yang sudah Anda buat di web.php -->
                                    <a href="{{ route('rentals.create', $mobil->id) }}" class="block w-full text-center px-4 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                        Rental Sekarang
                                    </a>
                                @else
                                    <button disabled class="block w-full text-center px-4 py-3 bg-slate-100 text-slate-400 font-bold rounded-xl cursor-not-allowed">
                                        Tidak Tersedia
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- State Jika Kosong -->
                    <div class="col-span-full bg-white rounded-2xl p-16 text-center border border-gray-100 shadow-sm">
                        <svg class="w-20 h-20 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <h3 class="text-xl font-bold text-slate-800">Belum Ada Kendaraan</h3>
                        <p class="mt-2 text-slate-500 max-w-md mx-auto">Katalog armada kami saat ini masih kosong. Silakan cek kembali dalam waktu dekat.</p>
                    </div>
                @endempty
            </div>
        </div>
    </div>
</x-app-layout>