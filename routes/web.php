<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\AnggotaController;

Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');

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
Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.index');
Route::get('/kunjungan/create', [KunjunganController::class, 'create'])->name('kunjungan.create');
Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');
Route::get('/kunjungan/{id}/edit', [KunjunganController::class, 'edit'])->name('kunjungan.edit');
Route::put('/kunjungan/{id}', [KunjunganController::class, 'update'])->name('kunjungan.update');
Route::delete('/kunjungan/{id}', [KunjunganController::class, 'destroy'])->name('kunjungan.destroy');
Route::get('/kunjungan/cetak', [KunjunganController::class, 'cetak'])->name('kunjungan.cetak');
Route::post('/kunjungan/store', [KunjunganController::class, 'store'])->name('kunjungan.store');

Route::get('/kunjungan/pilih', function () {
    return view('kunjungan.pilih');
})->name('kunjungan.pilih');

Route::get('/kunjungan/anggota', [KunjunganController::class, 'formAnggota'])->name('kunjungan.anggota');
Route::post('/kunjungan/anggota', [KunjunganController::class, 'storeAnggota'])->name('kunjungan.anggota.store');

Route::get('/kunjungan/anggota', [KunjunganController::class, 'createAnggota'])->name('kunjungan.anggota');
Route::post('/kunjungan/anggota/store', [KunjunganController::class, 'storeAnggota'])->name('kunjungan.anggota.store');

Route::get('/kunjungan/create', [KunjunganController::class, 'create'])->name('kunjungan.create');

Route::get('/', function () {
    return view('dashboard');
});

// Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.index');
// Route::get('/kunjungan/create', [KunjunganController::class, 'create'])->name('kunjungan.create');
// Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');


Route::get('/', function () {
    return view('dashboard');
});

Route::resource('kunjungan', KunjunganController::class);


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('kunjungan', KunjunganController::class);
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/kunjungan/report', [KunjunganController::class, 'report'])->name('kunjungan.report');