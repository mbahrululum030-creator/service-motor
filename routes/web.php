<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceMotorController;

Route::get('/', [ServiceMotorController::class, 'index'])->name('dashboard');
Route::post('/pelanggan', [ServiceMotorController::class, 'storePelanggan'])->name('pelanggan.store');
Route::post('/kendaraan', [ServiceMotorController::class, 'storeKendaraan'])->name('kendaraan.store');
Route::post('/daftar-service', [ServiceMotorController::class, 'storeDaftarService'])->name('daftar-service.store');
Route::post('/data-service', [ServiceMotorController::class, 'storeDataService'])->name('data-service.store');
Route::post('/pembayaran', [ServiceMotorController::class, 'storePembayaran'])->name('pembayaran.store');