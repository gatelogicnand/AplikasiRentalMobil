<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MobilController;
use App\Http\Controllers\Api\RentalController;
use App\Http\Controllers\Api\PaymentController;

// Route Publik (Tidak perlu token)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/midtrans-callback', [PaymentController::class, 'callback']);

// Route Terproteksi (Wajib pakai Bearer Token di Postman)
Route::middleware('auth:sanctum')->group(function () {
    
    // Rute untuk melihat dan menambah mobil
    Route::get('/mobils', [MobilController::class, 'index']);
    Route::post('/mobils', [MobilController::class, 'store']);
    
    // Rute untuk membuat transaksi rental
    Route::post('/rentals', [RentalController::class, 'store']);
    
});