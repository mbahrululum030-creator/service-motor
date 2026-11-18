<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Pelanggan, Kendaraan, DaftarService, DataService, PembayaranService};

class ServiceApiController extends Controller
{
    // Pelanggan API
    public function getPelanggan() {
        return response()->json(['status' => 'success', 'data' => Pelanggan::all()], 200);
    }
    public function postPelanggan(Request $request) {
        $data = Pelanggan::create($request->all());
        return response()->json(['status' => 'created', 'data' => $data], 201);
    }

    // Kendaraan API
    public function getKendaraan() {
        return response()->json(['status' => 'success', 'data' => Kendaraan::all()], 200);
    }
    public function postKendaraan(Request $request) {
        $data = Kendaraan::create($request->all());
        return response()->json(['status' => 'created', 'data' => $data], 201);
    }

    // Daftar Service API
    public function getDaftarService() {
        return response()->json(['status' => 'success', 'data' => DaftarService::with(['pelanggan', 'kendaraan'])->get()], 200);
    }
    public function postDaftarService(Request $request) {
        $pelanggan = Pelanggan::findOrFail($request->id_pelanggan);
        $payload = $request->all();
        $payload['nama_pelanggan'] = $pelanggan->nama_lengkap; // Otomatis terisi via API juga
        $data = DaftarService::create($payload);
        return response()->json(['status' => 'created', 'data' => $data], 201);
    }

    // Data Service API
    public function getDataService() {
        return response()->json(['status' => 'success', 'data' => DataService::all()], 200);
    }
    public function postDataService(Request $request) {
        $daftar = DaftarService::findOrFail($request->id_servis);
        $payload = $request->all();
        $payload['keluhan_kendaraan'] = $daftar->keluhan_kendaraan; // Otomatis terisi via API
        $data = DataService::create($payload);
        return response()->json(['status' => 'created', 'data' => $data], 201);
    }

    // Pembayaran API
    public function getPembayaran() {
        return response()->json(['status' => 'success', 'data' => PembayaranService::all()], 200);
    }
    public function postPembayaran(Request $request) {
        $data = PembayaranService::create($request->all());
        return response()->json(['status' => 'created', 'data' => $data], 201);
    }
}