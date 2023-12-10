<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BiayaLainController;
use App\Http\Controllers\LabaRugiController;
use App\Http\Controllers\LaporanBiayaLainController;
use App\Http\Controllers\LaporanLabaRugiController;
use App\Http\Controllers\LaporanPembelianController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //menu routes
    Route::resource('/menu', MenuController::class);
    Route::get('/menus/shows', [MenuController::class, 'show']);
    //penjualan routes
    Route::resource('/penjualan', PenjualanController::class);
    Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index']);
    Route::get('/invoice/{penjualan}', function (Penjualan $penjualan) {
        return view('halaman.penjualan.invoice', [
            'data' => $penjualan->with(['transaction_details', 'transaction_details.menu'])->where('id', $penjualan->id)->get()
        ]);
    });
    //pembelian routes
    Route::resource('/pembelian', PembelianController::class);
    Route::get('/pembelians/details', [PembelianController::class, 'show']);
    Route::get('/laporan-pembelian', [LaporanPembelianController::class, 'index']);
    //biaya lainnya
    Route::resource('/biaya-lain', BiayaLainController::class);
    Route::get('/biaya-lains/details', [BiayaLainController::class, 'show']);
    Route::get('/laporan-biaya-lain', [LaporanBiayaLainController::class, 'index']);
    //supplier routes
    Route::resource('/supplier', SupplierController::class);
    Route::get('/suppliers/details', [SupplierController::class, 'show']);
    //pelanggan routes
    Route::resource('/pelanggan', PelangganController::class);
    Route::get('/pelanggans/details', [PelangganController::class, 'show']);
    //laporan laba-rugi routes
    Route::resource('/laba-rugi', LabaRugiController::class);
    Route::get('/laporan-laba-rugi', [LaporanLabaRugiController::class, 'index']);
    //profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
