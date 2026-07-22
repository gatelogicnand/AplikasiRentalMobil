<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental; // Pastikan model Rental Anda dipanggil
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function store(Request $request)
    {
        // Pastikan validasinya menanyakan mobil_id dan tanggal, BUKAN merek dkk!
        $validated = $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $rental = Rental::create([
            'user_id' => Auth::id(),
            'mobil_id' => $request->mobil_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'menunggu'
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil dibuat',
            'data' => $rental
        ], 201);
    }
}