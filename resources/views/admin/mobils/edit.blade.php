<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Mobil: ') }} <span class="text-blue-600">{{ $mobil->merek }} {{ $mobil->tipe }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 border border-gray-100">
                
                <!-- Menampilkan Error Validasi -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                        <div class="font-medium">Terdapat kesalahan pada input Anda:</div>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.mobils.update', $mobil->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Merek -->
                        <div>
                            <label for="merek" class="block text-sm font-medium text-gray-700">Merek Kendaraan</label>
                            <input type="text" name="merek" id="merek" value="{{ old('merek', $mobil->merek) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                        </div>

                        <!-- Tipe -->
                        <div>
                            <label for="tipe" class="block text-sm font-medium text-gray-700">Tipe / Model</label>
                            <input type="text" name="tipe" id="tipe" value="{{ old('tipe', $mobil->tipe) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                        </div>

                        <!-- Nomor Polisi -->
                        <div>
                            <label for="nomor_polisi" class="block text-sm font-medium text-gray-700">Nomor Polisi</label>
                            <input type="text" name="nomor_polisi" id="nomor_polisi" value="{{ old('nomor_polisi', $mobil->nomor_polisi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                        </div>

                        <!-- Harga Sewa -->
                        <div>
                            <label for="harga_sewa_per_hari" class="block text-sm font-medium text-gray-700">Harga Sewa / Hari (Rp)</label>
                            <input type="number" name="harga_sewa_per_hari" id="harga_sewa_per_hari" value="{{ old('harga_sewa_per_hari', $mobil->harga_sewa_per_hari) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" min="0" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status Ketersediaan</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                                <option value="tersedia" {{ old('status', $mobil->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="dirental" {{ old('status', $mobil->status) == 'dirental' ? 'selected' : '' }}>Dirental</option>
                                <option value="maintenance" {{ old('status', $mobil->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </div>

                        <!-- Foto -->
                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-700">Ganti Foto Kendaraan (Opsional)</label>
                            <input type="file" name="foto" id="foto" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti foto.</p>
                            
                            <!-- Preview Foto Lama -->
                            @if($mobil->foto)
                                <div class="mt-3">
                                    <p class="text-xs text-gray-500 mb-1">Foto saat ini:</p>
                                    <img src="{{ asset('storage/' . $mobil->foto) }}" alt="Foto Mobil" class="h-24 w-auto object-cover rounded-md shadow-sm border border-gray-200">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end mt-8 border-t border-gray-100 pt-5 space-x-3">
                        <a href="{{ route('admin.mobils.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>