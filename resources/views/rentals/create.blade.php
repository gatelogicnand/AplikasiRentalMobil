<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulir Pemesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 md:p-8 bg-white border-b border-gray-200">
                    
                    <!-- Info Mobil yang Dipilih -->
                    <div class="flex items-center mb-8 pb-8 border-b border-gray-100">
                        <div class="w-32 h-24 bg-gray-200 rounded-md overflow-hidden flex-shrink-0">
                            @if($mobil->foto)
                                <img src="{{ asset('storage/' . $mobil->foto) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Image</div>
                            @endif
                        </div>
                        <div class="ml-6">
                            <h3 class="text-xl font-bold text-gray-900">{{ $mobil->merek }} {{ $mobil->tipe }}</h3>
                            <p class="text-gray-500">{{ $mobil->nomor_polisi }}</p>
                            <p class="text-blue-600 font-bold mt-1">Rp {{ number_format($mobil->harga_sewa_per_hari, 0, ',', '.') }} <span class="text-gray-500 text-sm font-normal">/ hari</span></p>
                        </div>
                    </div>

                    <!-- Form Input Tanggal -->
                    <form method="POST" action="{{ route('rentals.store', $mobil->id) }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Mulai Sewa</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-2" />
                            </div>
                            
                            <div>
                                <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Selesai Sewa</label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('mobils.katalog') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Konfirmasi Pesanan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>