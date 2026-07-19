<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Mobil $mobil)
    {
        if ($mobil->status !== 'tersedia') {
            return redirect()->route('mobils.katalog')->with('error', 'Mohon maaf, mobil ini sedang tidak tersedia.');
        }
        return view('rentals.create', compact('mobil'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Mobil $mobil)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Hitung total hari
        $start = Carbon::parse($request->tanggal_mulai);
        $end = Carbon::parse($request->tanggal_selesai);
        $hari = $start->diffInDays($end) + 1; // +1 agar dihitung per hari kalender (bukan 24 jam)
        
        // Hitung total harga otomatis
        $totalHarga = $hari * $mobil->harga_sewa_per_hari;

        // Simpan ke database dengan status menunggu
        Rental::create([
            'user_id' => Auth::id(),
            'mobil_id' => $mobil->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'total_harga' => $totalHarga,
            'status' => 'menunggu', 
        ]);

        // Arahkan ke halaman riwayat setelah sukses (halaman riwayat akan kita buat di tahap selanjutnya)
        return redirect()->route('rentals.riwayat')->with('success', 'Berhasil! Menunggu konfirmasi Admin.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        //
    }

    public function riwayatUser()
    {
        // Hanya mengambil data rental milik user ini, diurutkan dari yang terbaru
        $rentals = Rental::where('user_id', Auth::id())
                         ->with('mobil') // Eager loading untuk optimasi query
                         ->latest()
                         ->get();
                         
        return view('rentals.riwayat', compact('rentals'));
    }

    public function indexAdmin()
    {
        // Mengambil semua data rental beserta relasi user dan mobil, urut dari terbaru
        $rentals = Rental::with(['user', 'mobil'])->latest()->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    public function updateStatus(Request $request, Rental $rental)
    {
        // 1. Ubah validasi 'batal' menjadi 'dibatalkan'
        $request->validate([
            'status' => 'required|in:menunggu,berjalan,selesai,dibatalkan'
        ]);

        $rental->status = $request->status;
        $rental->save();

        if ($request->status === 'berjalan') {
            $rental->mobil->update(['status' => 'dirental']);
            
        // 2. Ubah juga kondisi elseif-nya
        } elseif ($request->status === 'selesai' || $request->status === 'dibatalkan') {
            $rental->mobil->update(['status' => 'tersedia']);
        }

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui!');
    }
}
