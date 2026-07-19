<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($mobils as $mobil)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                        <!-- Area Foto Mobil -->
                        <div class="h-48 bg-gray-200 overflow-hidden">
                            @if($mobil->foto)
                                <img src="{{ asset('storage/' . $mobil->foto) }}" alt="{{ $mobil->merek }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <span>Tidak ada foto</span>
                                </div>
                            @endif
                        </div>

                        <!-- Area Detail Mobil -->
                        <div class="p-5 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $mobil->merek }} {{ $mobil->tipe }}</h3>
                                    <p class="text-sm text-gray-500">{{ $mobil->nomor_polisi }}</p>
                                </div>
                                
                                <!-- Badge Status -->
                                @if($mobil->status === 'tersedia')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Tersedia
                                    </span>
                                @elseif($mobil->status === 'dirental')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Sedang Dirental
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Maintenance
                                    </span>
                                @endif
                            </div>

                            <div class="mt-2 mb-4">
                                <span class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($mobil->harga_sewa_per_hari, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-500">/ hari</span>
                            </div>

                            <!-- Tombol Aksi (Otomatis menyesuaikan status) -->
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                @if($mobil->status === 'tersedia')
                                    <a href="{{ route('rentals.create', $mobil->id) }}" class="w-full flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                        Rental Sekarang
                                    </a>
                                @else
                                    <button disabled class="w-full flex justify-center items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-500 uppercase tracking-widest cursor-not-allowed">
                                        Tidak Tersedia
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white p-8 rounded-lg shadow-sm text-center border border-gray-100">
                        <p class="text-gray-500">Katalog mobil saat ini masih kosong.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>