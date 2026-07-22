<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil; // Pastikan model Mobil Anda dipanggil

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Inventaris Mobil',
            'data' => $mobils
        ], 200);
    }

    public function store(Request $request)
    {

    $validated = $request->validate([
        'merek' => 'required|string',
        'tipe' => 'required|string',
        'nomor_polisi' => 'required|string',
        'harga_sewa_per_hari' => 'required|numeric',
        'status' => 'required|in:tersedia,dirental,maintenance'
    ]);

        $mobil = Mobil::create($validated);

        return response()->json([
            'message' => 'Mobil berhasil ditambahkan',
            'data' => $mobil
        ], 201);
    }
}