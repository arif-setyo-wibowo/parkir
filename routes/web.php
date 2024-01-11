<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ParkirController;
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

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
});

Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
    Route::get('/', 'index')->name('kategori');
    Route::post('/', 'storeUpdate')->name('kategori.store.update');
    Route::get('/delete', 'destroy')->name('delete.kategori');
});

Route::controller(ParkirController::class)->prefix('parkir')->group(function () {
    Route::get('/', 'index')->name('parkir');
    Route::post('/', 'store')->name('parkir.tambah');
    Route::get('/checkout', 'checkout')->name('parkir.checkout');
});

Route::controller(LaporanController::class)->prefix('laporan')->group(function () {
    Route::get('/masuk-harian', 'masukHarian')->name('laporan.masuk.hari');
    Route::get('/masuk-bulanan', 'masukBulanan')->name('laporan.masuk.bulan');
    Route::get('/keluar-harian', 'keluarHarian')->name('laporan.keluar.hari');
    Route::get('/keluar-bulanan', 'keluarBulanan')->name('laporan.keluar.bulan');
});

Route::get('/ubah-status', [LaporanController::class, 'ubahStatus'])->name('ubahstatus');