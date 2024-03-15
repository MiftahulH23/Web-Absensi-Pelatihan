<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

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



Route::resource('/absens', \App\Http\Controllers\AbsenController::class);

Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('actionlogin');


Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('daftar');
Route::post('/daftar', [RegisterController::class, 'register'])->name('actiondaftar');



Route::get('/home', function () {
    return view('beranda');
})->name('beranda');

Route::get('/riwayat', function () {
    return view('riwayatPelatihan');
})->name('riwayat');