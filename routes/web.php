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

Route::get('/dokumentasi', function () {
    return view('dokumentasi');
});


// Home Controller
Route::middleware('auth')->get('/home', [HomeController::class, 'index'])->name('home.index');

// Login Controller
Route::get('/', [LoginController::class, 'loginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('actionlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Register Controller
Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('daftar');
Route::post('/daftar', [RegisterController::class, 'register'])->name('actiondaftar');

// acara Controller
Route::middleware('auth')->get('/tambahAcara', [AcaraController::class, 'tambahAcara'])->name('tambahAcara');
Route::middleware('auth')->get('/acaras', [AcaraController::class, 'index'])->name('acaras.index');
Route::middleware('auth')->post('/acaras', [AcaraController::class, 'store'])->name('acaras.store');
Route::middleware('auth')->get('/acaras/{id}', [AcaraController::class, 'show'])->name('acaras.show');
Route::middleware('auth')->get('/acaras/{id}/edit', [AcaraController::class, 'edit'])->name('acaras.edit');
Route::middleware('auth')->put('/acaras/{id}', [AcaraController::class, 'update'])->name('acaras.update');
Route::get('/selesai/{id}', [AcaraController::class, 'selesai'])->name('selesai');

// dataTable Controller
Route::get('/acaras/{id}/download-excel', [DataTableController::class, 'downloadExcel'])->name('download.excel');

// absens Controller
Route::get('/acaras/{id}/create', [AbsenController::class, 'create'])->name('acara.absen.create');
Route::post('/acaras/{id}/store', [AbsenController::class, 'store'])->name('acara.absen.store');
Route::get('/acaras/{id}/take-foto', [AbsenController::class, 'takeFoto'])->name('acara.absen.takeFoto');
Route::post('/simpan-foto', [AbsenController::class, 'simpanFoto'])->name('simpan.foto');

