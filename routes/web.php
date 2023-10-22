<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PinjamKembaliController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TipeBarangController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pinjam', [PinjamKembaliController::class, 'pinjamIndex']);
Route::post('/pinjam', [PinjamKembaliController::class, 'pinjamStore']);
Route::get('/pinjam_confirm', [PinjamKembaliController::class, 'pinjamConfirm']);
Route::get('/barang-check', [PinjamKembaliController::class, 'barangCheck']);

Route::get('/kembalikan', [PinjamKembaliController::class, 'kembaliIndex']);
Route::post('/kembalikan', [PinjamKembaliController::class, 'kembaliStore']);
Route::get('/kembalikan_confirm', [PinjamKembaliController::class, 'kembaliConfirm']);

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// Admin Access
Route::middleware('auth')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/admin', [DashboardController::class, 'index']);

    // Barang Gudang Route
    Route::get('/admin/barang-gudang', [BarangController::class, 'index']);
    Route::get('/admin/barang-gudang/cetak', [BarangController::class, 'cetak']);
    Route::post('/admin/barang-gudang/import', [BarangController::class, 'importData']);
    Route::get('/admin/barang-gudang/export', [BarangController::class, 'exportData']);
    Route::post('/admin/barang-gudang', [BarangController::class, 'store']);
    Route::delete('/admin/barang-gudang/{id}', [BarangController::class, 'destroy']);
    Route::get('/admin/barang-gudang/{id}', [BarangController::class, 'show']);
    Route::put('/admin/barang-gudang/{id}', [BarangController::class, 'update']);

    // Data Siswa Route
    Route::get('/admin/data-siswa', [SiswaController::class, 'index']);
    Route::get('/admin/data-siswa/cetak', [SiswaController::class, 'cetak']);
    Route::post('/admin/data-siswa/import', [SiswaController::class, 'importData']);
    Route::get('/admin/data-siswa/export', [SiswaController::class, 'exportData']);
    Route::post('/admin/data-siswa', [SiswaController::class, 'store']);
    Route::delete('/admin/data-siswa/{id}', [SiswaController::class, 'destroy']);
    Route::get('/admin/data-siswa/{id}', [SiswaController::class, 'show']);
    Route::put('/admin/data-siswa/{id}', [SiswaController::class, 'update']);

    Route::get('/admin/kelas', [KelasController::class, 'index']);

    // Tipe Barang
    Route::get('/admin/stok-barang', [TipeBarangController::class, 'webIndex']);
    Route::get('/tipe-barang', [TipeBarangController::class, 'index']);
    Route::post('/tipe-barang', [TipeBarangController::class, 'store']);
    Route::get('/tipe-barang/{id}', [TipeBarangController::class, 'show']);
    Route::put('/tipe-barang/{id}', [TipeBarangController::class, 'update']);
    Route::delete('/tipe-barang/{id}', [TipeBarangController::class, 'destroy']);


    Route::get('/admin/barang-terpinjam', [DashboardController::class, 'terpinjam']);
    Route::get('/admin/barang-kembali', [DashboardController::class, 'kembali']);
});
