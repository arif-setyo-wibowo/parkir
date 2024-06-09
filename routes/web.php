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


Route::controller(LoginController::class)->prefix('login')->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/', 'postlogin')->name('postlogin');
});

Route::middleware('user')->group(function () {
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
        Route::get('/cek-data/{id}', 'show')->name('parkir.detail');
        Route::get('/checkout', 'checkout')->name('parkir.checkout');
    });

    Route::controller(LaporanController::class)->prefix('laporan')->group(function () {
        Route::get('/keluar', 'keluar')->name('laporan.keluar');
        Route::get('/keluar-pdf', 'keluar_pdf')->name('laporan.keluar.pdf');
        Route::get('/masuk', 'masuk')->name('laporan.masuk');
        Route::get('/pendapatan', 'pendapatan')->name('laporan.pendapatan');
        Route::get('/pendapatan-user', 'pendapatan_user')->name('laporan.pendapatan.user');
        Route::get('/pendapatan-kategori', 'pendapatan_kategori')->name('laporan.pendapatan.kategori');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::controller(UsersController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('users');
        Route::post('/', 'storeUpdate')->name('users.store.update');
        Route::get('/delete', 'destroy')->name('delete.user');
    });
});
