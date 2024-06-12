<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\UsersController;
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


Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/', 'postlogin')->name('postlogin');
});

Route::middleware('petugas')->prefix('petugas')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.petugas');
    });

    Route::controller(ParkirController::class)->prefix('parkir')->group(function () {
        Route::get('/', 'index')->name('parkir');
        Route::post('/', 'store')->name('parkir.tambah');
        Route::get('/cek-data/{id}', 'show')->name('parkir.detail');
        Route::get('/checkout', 'checkout')->name('parkir.checkout');
    });

    Route::get('logout_petugas', [LoginController::class, 'logout_petugas'])->name('logout_petugas');
});

Route::middleware('keuangan')->prefix('keuangan')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.keuangan');
    });

    Route::controller(LaporanController::class)->prefix('laporan')->group(function () {
        Route::get('/keluar', 'keluar')->name('laporan.keluar.keuangan');
        Route::get('/keluar-pdf', 'keluar_pdf')->name('laporan.keluar.pdf.keuangan');
        Route::get('/masuk', 'masuk')->name('laporan.masuk.keuangan');
        Route::get('/masuk-pdf', 'masuk_pdf')->name('laporan.masuk.pdf.keuangan');
        Route::get('/pendapatan', 'pendapatan')->name('laporan.pendapatan.keuangan');
        Route::get('/pendapatan-pdf', 'pendapatan_pdf')->name('laporan.pendapatan.pdf.keuangan');
        Route::get('/pendapatan-user', 'pendapatan_user')->name('laporan.pendapatan.user.keuangan');
        Route::get('/pendapatan-user-pdf', 'pendapatan_user_pdf')->name('laporan.pendapatan.by.user.pdf.keuangan');
        Route::get('/pendapatan-kategori', 'pendapatan_kategori')->name('laporan.pendapatan.kategori.keuangan');
        Route::get('/pendapatan-kategori-pdf', 'pendapatan_kategori_pdf')->name('laporan.pendapatan.by.kategori.keuangan');
    });

    Route::get('logout', [LoginController::class, 'logout_keuangan'])->name('logout.keuangan');

});

Route::middleware('user')->prefix('admin')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.admin');
    });

    Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
        Route::get('/', 'index')->name('kategori');
        Route::post('/', 'storeUpdate')->name('kategori.store.update');
        Route::get('/delete', 'destroy')->name('delete.kategori');
    });

    Route::controller(LaporanController::class)->prefix('laporan')->group(function () {
        Route::get('/keluar', 'keluar')->name('laporan.keluar');
        Route::get('/keluar-pdf', 'keluar_pdf')->name('laporan.keluar.pdf');
        Route::get('/masuk', 'masuk')->name('laporan.masuk');
        Route::get('/masuk-pdf', 'masuk_pdf')->name('laporan.masuk.pdf');
        Route::get('/pendapatan', 'pendapatan')->name('laporan.pendapatan');
        Route::get('/pendapatan-pdf', 'pendapatan_pdf')->name('laporan.pendapatan.pdf');
        Route::get('/pendapatan-user', 'pendapatan_user')->name('laporan.pendapatan.user');
        Route::get('/pendapatan-user-pdf', 'pendapatan_user_pdf')->name('laporan.pendapatan.by.user.pdf');
        Route::get('/pendapatan-kategori', 'pendapatan_kategori')->name('laporan.pendapatan.kategori');
        Route::get('/pendapatan-kategori-pdf', 'pendapatan_kategori_pdf')->name('laporan.pendapatan.by.kategori');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::controller(UsersController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('users');
        Route::post('/', 'storeUpdate')->name('users.store.update');
        Route::get('/delete', 'destroy')->name('delete.user');
    });
});
