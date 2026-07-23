<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <a href="{{ route('mobils.katalog') }}" class="text-slate-400 hover:text-blue-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Formulir Pemesanan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                        <h3 class="text-sm font-bold text-red-800">Pemesanan gagal diproses:</h3>
                    </div>
                    <ul class="list-disc list-inside text-sm text-red-700 ml-7">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Kolom Kiri: Ringkasan Kendaraan -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                        <div class="h-48 bg-slate-200 overflow-hidden">
                            @if($mobil->foto)
                                <img src="{{ asset('storage/' . $mobil->foto) }}" alt="{{ $mobil->merek }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-100">
                                    <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Kendaraan Terpilih</h3>
                            <h2 class="text-2xl font-bold text-slate-900 mb-2">{{ $mobil->merek }} <span class="text-lg font-medium text-slate-500">{{ $mobil->tipe }}</span></h2>
                            
                            <div class="flex items-center mt-4 p-3 bg-slate-50 rounded-lg border border-slate-100">
                                <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <p class="text-xs text-slate-500 font-medium uppercase">Tarif Sewa</p>
                                    <p class="text-sm font-bold text-slate-800">Rp {{ number_format($mobil->harga_sewa_per_hari, 0, ',', '.') }} <span class="font-normal text-slate-500">/ hari</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Form Input -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h3 class="text-lg font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Detail Peminjaman</h3>
                        
                        <form action="{{ route('rentals.store', $mobil->id) }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Grid Tanggal -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="tanggal_mulai" class="block text-sm font-medium text-slate-700 mb-2">Tanggal Mulai Sewa</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="w-full pl-10 border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm" required min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>

                                <div>
                                    <label for="tanggal_selesai" class="block text-sm font-medium text-slate-700 mb-2">Tanggal Selesai Sewa</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="w-full pl-10 border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm" required min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Peringatan / Informasi Tambahan -->
                            <div class="bg-blue-50 rounded-xl p-4 border border-blue-100 flex items-start mt-6">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-sm text-blue-800 leading-relaxed">
                                    Total harga sewa akan dihitung secara otomatis berdasarkan jumlah hari peminjaman setelah Anda menekan tombol konfirmasi. Harap pastikan tanggal yang Anda masukkan sudah benar.
                                </p>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="pt-6 border-t border-slate-100 mt-8">
                                <button type="submit" class="w-full flex justify-center items-center px-8 py-4 bg-blue-600 border border-transparent rounded-xl font-bold text-white uppercase tracking-widest hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                                    Konfirmasi Pesanan
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>