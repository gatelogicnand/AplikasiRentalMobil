<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Tambahkan library Midtrans di sini
use Midtrans\Config;
use Midtrans\Snap;

class RentalController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Mobil $mobil)
    {
        if ($mobil->status !== 'tersedia') {
            return redirect()->route('mobils.katalog')->with('error', 'Mohon maaf, mobil ini sedang tidak tersedia.');
        }
        return view('rentals.create', compact('mobil'));
    }

    public function store(Request $request, Mobil $mobil)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $start = Carbon::parse($request->tanggal_mulai);
        $end = Carbon::parse($request->tanggal_selesai);
        $hari = $start->diffInDays($end) + 1; 
        
        $totalHarga = $hari * $mobil->harga_sewa_per_hari;

        // 1. Simpan ke database tanpa snap_token terlebih dahulu
        $rental = Rental::create([
            'user_id' => Auth::id(),
            'mobil_id' => $mobil->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'total_harga' => $totalHarga,
            'status' => 'menunggu', 
        ]);

        // 2. Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false); // Ambil dari .env
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 3. Siapkan detail transaksi untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'RENT-' . $rental->id . '-' . time(), // ID unik agar Midtrans tidak menolak
                'gross_amount' => $totalHarga,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'item_details' => [
                [
                    'id' => $mobil->id,
                    'price' => $mobil->harga_sewa_per_hari,
                    'quantity' => $hari,
                    'name' => 'Rental ' . $mobil->merek . ' ' . $mobil->tipe,
                ]
            ]
        ];

        // 4. Minta Snap Token ke Midtrans lalu simpan ke database
        try {
            $snapToken = Snap::getSnapToken($params);
            
            $rental->snap_token = $snapToken;
            $rental->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal terhubung ke Midtrans: ' . $e->getMessage());
        }

        return redirect()->route('rentals.riwayat')->with('success', 'Transaksi berhasil! Silakan selesaikan pembayaran.');
    }

    public function show(Rental $rental)
    {
        //
    }

    public function edit(Rental $rental)
    {
        //
    }

    public function update(Request $request, Rental $rental)
    {
        //
    }

    public function destroy(Rental $rental)
    {
        //
    }

    public function riwayatUser()
    {
        $rentals = Rental::where('user_id', Auth::id())
                         ->with('mobil')
                         ->latest()
                         ->get();
                         
        return view('rentals.riwayat', compact('rentals'));
    }

    public function indexAdmin()
    {
        $rentals = Rental::with(['user', 'mobil'])->latest()->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    public function updateStatus(Request $request, Rental $rental)
    {
        $request->validate([
            'status' => 'required|in:menunggu,berjalan,selesai,dibatalkan'
        ]);

        $rental->status = $request->status;
        $rental->save();

        if ($request->status === 'berjalan') {
            $rental->mobil->update(['status' => 'dirental']);
        } elseif ($request->status === 'selesai' || $request->status === 'dibatalkan') {
            $rental->mobil->update(['status' => 'tersedia']);
        }

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui!');
    }
}