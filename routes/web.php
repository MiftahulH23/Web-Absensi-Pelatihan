<?php

use App\Http\Controllers\AbsenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\DataTableController;


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
Route::get('/dokumentasi', function () {
    return view('dokumentasi');
});



// Route::resource('/absens', \App\Http\Controllers\AbsenController::class);

Route::resource('/home', \App\Http\Controllers\HomeController::class);

Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('actionlogin');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/selesai/{id}', [AcaraController::class, 'selesai'])->name('selesai');
Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('daftar');
Route::post('/daftar', [RegisterController::class, 'register'])->name('actiondaftar');


Route::get('/tambahAcara', function () {
    return view('tambahAcara');
})->name('tambahAcara');

Route::get('/riwayat', function () {
    return view('riwayatPelatihan');
})->name('riwayat');
Route::get('/detilabsen', function () {
    return view('detailAbsens');
})->name('detil');

Route::get('/absens', [AbsenController::class, 'index'])->name('absens.index');

Route::get('/acaras', [AcaraController::class, 'index'])->name('acaras.index');
// Route::get('/acaras/create', [AcaraController::class, 'create'])->name('acaras.create');
Route::post('/acaras', [AcaraController::class, 'store'])->name('acaras.store');
Route::get('/acaras/{id}', [AcaraController::class, 'show'])->name('acaras.show');
Route::get('/acaras/{id}/edit', [AcaraController::class, 'edit'])->name('acaras.edit');
Route::put('/acaras/{id}', [AcaraController::class, 'update'])->name('acaras.update');

Route::get('/download-excel', [DataTableController::class, 'downloadExcel'])->name('download.excel');

Route::get('/acaras/{id}/create', [AbsenController::class, 'create'])->name('acara.absen.create');
Route::post('/acaras/{id}/store', [AbsenController::class, 'store'])->name('acara.absen.store');
Route::post('/simpan-foto', [AbsenController::class, 'simpanFoto'])->name('simpan.foto');

