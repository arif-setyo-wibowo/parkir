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
        Route::get('/checkout', 'checkout')->name('parkir.checkout');
    });

    Route::controller(LaporanController::class)->prefix('laporan')->group(function () {
        Route::get('/masuk-harian', 'masukHarian')->name('laporan.masuk.hari');
        Route::get('/masuk-bulanan', 'masukBulanan')->name('laporan.masuk.bulan');
        Route::get('/keluar-harian', 'keluarHarian')->name('laporan.keluar.hari');
        Route::get('/keluar-bulanan', 'keluarBulanan')->name('laporan.keluar.bulan');
        Route::get('/parkir-stay', 'stay')->name('laporan.stay');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::controller(UsersController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->name('users');
        Route::post('/', 'storeUpdate')->name('users.store.update');
        Route::get('/delete', 'destroy')->name('delete.user');
    });
});