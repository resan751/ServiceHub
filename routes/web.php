<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\JasaController;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

// login, register, dan logout
route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.aunthenticate');
route::get('register', [AuthController::class, 'register'])->name('register');
route::post('register', [AuthController::class, 'store']);
route::post('logout', [AuthController::class, 'logout'])->name('logout');

// harus login terlebih dahulu
Route::middleware(['auth'])->group(function () {
    // layout
    route::get('home', [HomeController::class, 'index'])->name('home.index');
    route::get('list', [ListController::class, 'index'])->name('list.index');
    route::get('list/back', [ListController::class, 'back'])->name('list.back');

    // detail
    Route::resource('detail', ServiceController::class)->only(['index', 'create', 'store']);


    // admin
    // User
    Route::resource('dashboard', AuthController::class)->except(['show']);
    Route::get('/dashboard/{id_user}/edit', [AuthController::class, 'edit'])->name('dashboard.edit');
    route::delete('User/{id_user}', [AuthController::class, 'destroy'])->name('destroy');

    // Barang
    route::resource('barang', BarangController::class)->except('show');
    Route::get('adbarang', function () { return view('form.adbarang'); });
    Route::get('barang/{id_barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    route::delete('Barang/{id_Barang}', [BarangController::class, 'destroy'])->name('destroy');

    // Jasa
    route::resource('jasa', JasaController::class)->except('show');
    Route::get('adjasa', function () { return view('form.adjasa'); });
    Route::get('jasa/{id_jasa}/edit', [JasaController::class, 'edit'])->name('jasa.edit');
    route::delete('jasa/{id_jasa}', [BarangController::class, 'destroy'])->name('destroy');

    // API routes untuk harga
    Route::get('/api/barang/{id}/harga', [BarangController::class, 'getHarga']);
    Route::get('/api/jasa/{id}/harga', [JasaController::class, 'getHarga']);
});
