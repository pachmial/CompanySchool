<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

Route::get('/kontak', function () {
    return view('kontak.index');
})->name('kontak');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::resource('artikel', AdminArtikelController::class);
        Route::patch('/artikel/{artikel}/toggle', [AdminArtikelController::class, 'toggleTampilkan'])
            ->name('artikel.toggle');

        Route::resource('produk', AdminProdukController::class);
        Route::patch('/produk/{produk}/toggle', [AdminProdukController::class, 'toggleTampilkan'])
            ->name('produk.toggle');

        Route::resource('galeri', AdminGaleriController::class);
        Route::patch('/galeri/{galeri}/toggle', [AdminGaleriController::class, 'toggleTampilkan'])
            ->name('galeri.toggle');
    });

});