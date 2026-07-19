<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Inventaris Mobil') }}
            </h2>
            <a href="{{ route('admin.mobils.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                + Tambah Mobil
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                            <tr>
                                <th scope="col" class="px-6 py-4">Foto</th>
                                <th scope="col" class="px-6 py-4">Kendaraan</th>
                                <th scope="col" class="px-6 py-4">No. Polisi</th>
                                <th scope="col" class="px-6 py-4">Harga/Hari</th>
                                <th scope="col" class="px-6 py-4">Status</th>
                                <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mobils as $mobil)
                                <tr class="bg-white border-b hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4">
                                        @if($mobil->foto)
                                            <img src="{{ asset('storage/' . $mobil->foto) }}" alt="Foto Mobil" class="w-16 h-16 object-cover rounded-md shadow-sm">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center text-gray-400 text-xs">No Image</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <div class="text-base">{{ $mobil->merek }}</div>
                                        <div class="text-xs text-gray-500">{{ $mobil->tipe }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-700">
                                        {{ $mobil->nomor_polisi }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ number_format($mobil->harga_sewa_per_hari, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($mobil->status == 'tersedia')
                                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Tersedia</span>
                                        @elseif($mobil->status == 'dirental')
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Dirental</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Maintenance</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('admin.mobils.edit', $mobil->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1 rounded-md transition">Edit</a>
                                            
                                            <!-- Tombol Delete -->
                                            <form action="{{ route('admin.mobils.destroy', $mobil->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mobil ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md transition">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            <p class="text-lg font-medium">Belum ada data mobil</p>
                                            <p class="text-sm">Mulai tambahkan kendaraan ke inventaris Anda.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endempty
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>