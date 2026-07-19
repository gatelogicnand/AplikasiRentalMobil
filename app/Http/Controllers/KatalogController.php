<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        // Mengambil semua mobil tanpa memfilter statusnya
        $mobils = Mobil::latest()->get();
        
        return view('katalog.index', compact('mobils'));
    }
}