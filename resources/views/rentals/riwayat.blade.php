<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Transaksi Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- 1. SCRIPT WAJIB MIDTRANS -->
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mobil</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Sewa</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Biaya</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pesanan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($rentals as $rental)
                                    <tr>
                                        <!-- BAGIAN KOLOM MOBIL YANG DIPERBARUI DENGAN GAMBAR -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <!-- Thumbnail Mobil -->
                                                <div class="flex-shrink-0 h-16 w-24 mr-4">
                                                    @if($rental->mobil->foto)
                                                        <img class="h-full w-full rounded-lg object-cover shadow-sm border border-gray-200" 
                                                             src="{{ asset('storage/' . $rental->mobil->foto) }}" 
                                                             alt="{{ $rental->mobil->merek }}">
                                                    @else
                                                        <!-- Fallback jika mobil belum memiliki foto -->
                                                        <div class="h-full w-full rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200 shadow-sm">
                                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        </div>
                                                    @endif
                                                </div>
                                        
                                                <!-- Detail Teks Mobil -->
                                                <div>
                                                    <div class="text-sm font-bold text-gray-900">{{ $rental->mobil->merek }} {{ $rental->mobil->tipe }}</div>
                                                    <div class="text-sm text-gray-500">{{ $rental->mobil->nomor_polisi }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($rental->tanggal_mulai)->format('d M Y') }}</div>
                                            <div class="text-sm text-gray-500">s/d {{ \Carbon\Carbon::parse($rental->tanggal_selesai)->format('d M Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($rental->status === 'menunggu')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Pembayaran</span>
                                            @elseif($rental->status === 'berjalan')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Sedang Dirental</span>
                                            @elseif($rental->status === 'selesai')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                                            @endif
                                        </td>
                                        
                                        <!-- 2. TAMBAHAN KOLOM AKSI (TOMBOL BAYAR) -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($rental->status === 'menunggu' && $rental->snap_token)
                                                <button id="pay-button-{{ $rental->id }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2 px-4 rounded shadow focus:outline-none focus:shadow-outline transition-colors">
                                                    Bayar Sekarang
                                                </button>

                                                <!-- Script Pemanggil Pop-up per Transaksi -->
                                                <script type="text/javascript">
                                                    document.getElementById('pay-button-{{ $rental->id }}').onclick = function(){
                                                        window.snap.pay('{{ $rental->snap_token }}', {
                                                            onSuccess: function(result){
                                                                alert("Pembayaran berhasil! Menunggu verifikasi sistem.");
                                                                window.location.reload();
                                                            },
                                                            onPending: function(result){
                                                                alert("Menunggu pembayaran Anda!");
                                                            },
                                                            onError: function(result){
                                                                alert("Pembayaran gagal atau kadaluarsa!");
                                                            },
                                                            onClose: function(){
                                                                alert('Anda menutup pop-up tanpa menyelesaikan pembayaran.');
                                                            }
                                                        });
                                                    };
                                                </script>
                                            @else
                                                <span class="text-gray-400 text-sm font-medium">-</span>
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 whitespace-nowrap text-sm text-gray-500 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                            Anda belum memiliki riwayat transaksi penyewaan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>