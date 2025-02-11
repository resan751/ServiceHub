<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JasaController;
use Illuminate\Support\Facades\Route;

// login, register, dan logout
route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.aunthenticate');
route::get('register', [AuthController::class, 'register'])->name('register');
route::post('register', [AuthController::class, 'store']);
route::post('logout', [AuthController::class, 'logout'])->name('logout');

// layout
route::get('home', [HomeController::class, 'index'])->name('home.index');

// crud

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




















// Route::get('login', function () {
//     return view('login.login');
// });
// Route::get('register', function () {
//     return view('login.register');
// });




// Route::get('home', function () {
//     return view('layout.home');
// });
