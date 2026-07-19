<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class MobilController extends Controller
{
    /**
     * Menampilkan daftar semua mobil (Read)
     */
    public function index()
    {
        // Mengambil semua data mobil dari yang terbaru
        $mobils = Mobil::latest()->get(); 
        return view('admin.mobils.index', compact('mobils'));
    }

    /**
     * Menampilkan form untuk menambah mobil baru
     */
    public function create()
    {
        return view('admin.mobils.create');
    }

    /**
     * Menyimpan data mobil baru ke database (Create)
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari user
        $validated = $request->validate([
            'merek'               => 'required|string|max:255',
            'tipe'                => 'required|string|max:255', // Menyesuaikan dengan modifikasi kamu
            'nomor_polisi'        => 'required|string|unique:mobils,nomor_polisi|max:20',
            'harga_sewa_per_hari' => 'required|numeric|min:0',
            'status'              => 'required|in:tersedia,dirental,maintenance',
            'foto'                => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ]);

        // 2. Logika Upload Foto (Jika ada)
        if ($request->hasFile('foto')) {
            // Menyimpan file ke folder storage/app/public/mobils
            $fotoPath = $request->file('foto')->store('mobils', 'public');
            $validated['foto'] = $fotoPath;
        }

        // 3. Simpan ke Database
        Mobil::create($validated);

        // 4. Arahkan kembali dengan pesan sukses
        return redirect()->route('admin.mobils.index')->with('success', 'Data mobil berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit untuk mobil tertentu
     */
    public function edit(Mobil $mobil)
    {
        return view('admin.mobils.edit', compact('mobil'));
    }

    /**
     * Memperbarui data mobil di database (Update)
     */
    public function update(Request $request, Mobil $mobil)
    {
        $validated = $request->validate([
            'merek'               => 'required|string|max:255',
            'tipe'                => 'required|string|max:255',
            'nomor_polisi'        => 'required|string|max:20|unique:mobils,nomor_polisi,' . $mobil->id,
            'harga_sewa_per_hari' => 'required|numeric|min:0',
            'status'              => 'required|in:tersedia,dirental,maintenance',
            'foto'                => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($mobil->foto) {
                Storage::disk('public')->delete($mobil->foto);
            }
            $fotoPath = $request->file('foto')->store('mobils', 'public');
            $validated['foto'] = $fotoPath;
        }

        $mobil->update($validated);

        return redirect()->route('admin.mobils.index')->with('success', 'Data mobil berhasil diperbarui!');
    }

    /**
     * Menghapus data mobil dari database (Delete)
     */
    public function destroy(Mobil $mobil)
    {
        // Hapus foto dari storage sebelum menghapus data di database
        if ($mobil->foto) {
            Storage::disk('public')->delete($mobil->foto);
        }
        
        $mobil->delete();

        return redirect()->route('admin.mobils.index')->with('success', 'Data mobil berhasil dihapus!');
    }
    /**
     * Export data mobil ke PDF
     */
    public function exportPdf()
    {
        $mobils = Mobil::all();
        
        // Me-load view khusus PDF dan mengirim data mobil
        $pdf = Pdf::loadView('admin.mobils.pdf', compact('mobils'));
        
        // Mengatur ukuran kertas dan orientasi (Opsional)
        $pdf->setPaper('A4', 'landscape');
        
        // Mengunduh file dengan nama tertentu
        return $pdf->download('laporan-inventaris-rental.pdf');
    }
}