<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Edit Data Mobil: ') }} <span class="text-blue-600">{{ $mobil->merek }} {{ $mobil->tipe }}</span>
            </h2>
            <a href="{{ route('admin.mobils.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-md font-semibold text-xs text-slate-700 uppercase tracking-widest shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Batal
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-slate-100 sm:rounded-2xl p-8">
                
                <!-- Tampilkan Error Validasi -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-md">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                            <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada input Anda:</h3>
                        </div>
                        <ul class="list-disc list-inside text-sm text-red-700 ml-7">
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
                        <!-- Merek Mobil -->
                        <div>
                            <label for="merek" class="block text-sm font-medium text-slate-700 mb-1">Merek Mobil</label>
                            <input type="text" name="merek" id="merek" value="{{ old('merek', $mobil->merek) }}" class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                        </div>

                        <!-- Tipe Mobil -->
                        <div>
                            <label for="tipe" class="block text-sm font-medium text-slate-700 mb-1">Tipe Mobil</label>
                            <input type="text" name="tipe" id="tipe" value="{{ old('tipe', $mobil->tipe) }}" class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                        </div>

                        <!-- Nomor Polisi -->
                        <div>
                            <label for="nomor_polisi" class="block text-sm font-medium text-slate-700 mb-1">Nomor Polisi</label>
                            <input type="text" name="nomor_polisi" id="nomor_polisi" value="{{ old('nomor_polisi', $mobil->nomor_polisi) }}" class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm font-mono uppercase" required>
                        </div>

                        <!-- Harga Sewa -->
                        <div>
                            <label for="harga_sewa_per_hari" class="block text-sm font-medium text-slate-700 mb-1">Harga Sewa / Hari (Rp)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-slate-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="harga_sewa_per_hari" id="harga_sewa_per_hari" value="{{ old('harga_sewa_per_hari', $mobil->harga_sewa_per_hari) }}" class="w-full pl-10 border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" min="0" required>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Status Kendaraan</label>
                        <select name="status" id="status" class="w-full border-slate-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                            <option value="tersedia" {{ old('status', $mobil->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="dirental" {{ old('status', $mobil->status) == 'dirental' ? 'selected' : '' }}>Dirental</option>
                            <option value="maintenance" {{ old('status', $mobil->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>

                    <!-- Upload Foto & Preview -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Kolom Kiri: Preview Foto Lama -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Foto Mobil Saat Ini</label>
                            @if($mobil->foto)
                                <img src="{{ asset('storage/' . $mobil->foto) }}" alt="Foto {{ $mobil->merek }}" class="w-full h-40 object-cover rounded-xl border border-slate-200 shadow-sm">
                            @else
                                <div class="w-full h-40 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center text-slate-400 text-sm shadow-sm">
                                    Tidak ada foto
                                </div>
                            @endif
                        </div>
                        
                        <!-- Kolom Kanan: Input Foto Baru -->
                        <div>
                            <label for="foto" class="block text-sm font-medium text-slate-700 mb-2">Ganti Foto (Opsional)</label>
                            <div class="flex justify-center items-center px-6 py-5 border-2 border-slate-300 border-dashed rounded-xl hover:border-blue-500 transition-colors bg-slate-50 h-40">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-10 w-10 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-slate-600 justify-center">
                                        <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-2 py-1 shadow-sm border border-slate-200">
                                            <span>Pilih file baru</span>
                                            <input id="foto" name="foto" type="file" class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-2">Kosongkan jika tidak ingin mengubah foto.</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 transition ease-in-out duration-150 shadow-md">
                            Perbarui Data Mobil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>