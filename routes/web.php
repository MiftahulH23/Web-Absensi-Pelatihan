<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/from', function () {
    return view('form');
})->name('form');
Route::get('/dokumentasi', function () {
    return view('dokumentasi');
});
<<<<<<< HEAD
Route::resource('/absens', \App\Http\Controllers\AbsenController::class);
=======
Route::get('/selesai', function () {
    return view('selesai');
});
>>>>>>> 6f01678027c88c6d1420a7a43af2c26e6b27987f
