<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceApiController;

Route::get('/pelanggan', [ServiceApiController::class, 'getPelanggan']);
Route::post('/pelanggan', [ServiceApiController::class, 'postPelanggan']);

Route::get('/kendaraan', [ServiceApiController::class, 'getKendaraan']);
Route::post('/kendaraan', [ServiceApiController::class, 'postKendaraan']);

Route::get('/daftar-service', [ServiceApiController::class, 'getDaftarService']);
Route::post('/daftar-service', [ServiceApiController::class, 'postDaftarService']);

Route::get('/data-service', [ServiceApiController::class, 'getDataService']);
Route::post('/data-service', [ServiceApiController::class, 'postDataService']);

Route::get('/pembayaran', [ServiceApiController::class, 'getPembayaran']);
Route::post('/pembayaran', [ServiceApiController::class, 'postPembayaran']);