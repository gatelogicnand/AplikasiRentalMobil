<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        // 1. Ambil server key dari .env
        $serverKey = env('MIDTRANS_SERVER_KEY');
        
        // 2. Buat hash dari data yang dikirim Midtrans untuk verifikasi keamanan
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        // 3. Pastikan request ini benar-benar datang dari Midtrans
        if ($hashed == $request->signature_key) {
            
            // 4. Ekstrak ID Rental dari order_id (Format kita sebelumnya: RENT-{id}-{time})
            $orderIdParts = explode('-', $request->order_id);
            $rentalId = $orderIdParts[1]; 
            
            $rental = Rental::find($rentalId);
            
            if (!$rental) {
                return response()->json(['message' => 'Rental not found'], 404);
            }

            // 5. Cek status transaksi dari Midtrans
            $transactionStatus = $request->transaction_status;

            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                // Pembayaran sukses
                $rental->update(['status' => 'berjalan']);
                $rental->mobil->update(['status' => 'dirental']);
                
            } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                // Pembayaran gagal atau kadaluarsa
                $rental->update(['status' => 'dibatalkan']);
                $rental->mobil->update(['status' => 'tersedia']);
                
            } else if ($transactionStatus == 'pending') {
                // Menunggu pembayaran
                $rental->update(['status' => 'menunggu']);
            }

            return response()->json(['message' => 'Callback success']);
        }

        return response()->json(['message' => 'Invalid signature'], 403);
    }
}