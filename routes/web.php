<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\KatalogController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        $totalMobil = \App\Models\Mobil::count();
        $mobilTersedia = \App\Models\Mobil::where('status', 'tersedia')->count();
        $totalRental = \App\Models\Rental::count();
        $totalPelanggan = \App\Models\User::where('role', 'user')->count();
        return view('dashboard', compact('totalMobil', 'mobilTersedia', 'totalRental', 'totalPelanggan'));
    })->name('dashboard');

    Route::get('/admin/transaksi', [App\Http\Controllers\RentalController::class, 'indexAdmin'])->name('admin.rentals.index');
    Route::patch('/admin/transaksi/{rental}/status', [App\Http\Controllers\RentalController::class, 'updateStatus'])->name('admin.rentals.update-status');

    Route::get('/katalog', [KatalogController::class, 'index'])->name('mobils.katalog');

    Route::get('/rental/{mobil}/booking', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/rental/{mobil}/booking', [RentalController::class, 'store'])->name('rentals.store');

    Route::get('/riwayat-rental', [RentalController::class, 'riwayatUser'])->name('rentals.riwayat');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('mobils/export-pdf', [MobilController::class, 'exportPdf'])->name('mobils.export_pdf');
        Route::resource('mobils', MobilController::class);
        
        Route::get('rentals', [RentalController::class, 'indexAdmin'])->name('rentals.index');
        Route::patch('rentals/{rental}/status', [RentalController::class, 'updateStatus'])->name('rentals.updateStatus');
    });
});

require __DIR__.'/auth.php';