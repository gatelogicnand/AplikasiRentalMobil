<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\KatalogController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Mobil;

Route::get('/', function () {
    // Mengambil 6 data mobil terbaru untuk ditampilkan di halaman depan
    $mobils = Mobil::latest()->take(6)->get(); 
    
    return view('welcome', compact('mobils'));
});

Route::middleware('auth')->group(function () {
    
    // Halaman yang menampilkan pesan "Silakan cek email Anda"
    Route::get('/email/verify', function () {
        return view('auth.verify-email'); 
    })->name('verification.notice');

    // Proses ketika user mengklik tautan di kotak masuk Gmail mereka
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill(); 
        return redirect('/dashboard'); 
    })->middleware('signed')->name('verification.verify');

    // Tombol untuk mengirim ulang email verifikasi
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi telah dikirim ulang!');
    })->middleware('throttle:6,1')->name('verification.send');

});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Route Dashboard (Sudah digabungkan)
    Route::get('/dashboard', function () {
        $totalMobil = \App\Models\Mobil::count();
        $mobilTersedia = \App\Models\Mobil::where('status', 'tersedia')->count();
        $totalRental = \App\Models\Rental::count();
        $totalPelanggan = \App\Models\User::where('role', 'user')->count();
        return view('dashboard', compact('totalMobil', 'mobilTersedia', 'totalRental', 'totalPelanggan'));
    })->name('dashboard');

    // Route Katalog & Transaksi User
    Route::get('/katalog', [KatalogController::class, 'index'])->name('mobils.katalog');
    Route::get('/rental/{mobil}/booking', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/rental/{mobil}/booking', [RentalController::class, 'store'])->name('rentals.store');
    Route::get('/riwayat-rental', [RentalController::class, 'riwayatUser'])->name('rentals.riwayat');

    // Route Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route Khusus Admin
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('mobils/export-pdf', [MobilController::class, 'exportPdf'])->name('mobils.export_pdf');
        Route::resource('mobils', MobilController::class);

        Route::put('/rentals/{rental}', [App\Http\Controllers\RentalController::class, 'update'])->name('rentals.update');
        Route::delete('/rentals/{rental}', [App\Http\Controllers\RentalController::class, 'destroy'])->name('rentals.destroy');
        
        // Route Transaksi Admin (Duplikat sebelumnya sudah dihapus dan disatukan di sini)
        Route::get('rentals', [RentalController::class, 'indexAdmin'])->name('rentals.index');
        Route::patch('rentals/{rental}/status', [RentalController::class, 'updateStatus'])->name('rentals.update-status');
    });

});

require __DIR__.'/auth.php';