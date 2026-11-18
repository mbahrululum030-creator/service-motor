<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pelanggan, Kendaraan, DaftarService, DataService, PembayaranService};

class ServiceMotorController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'pelanggans' => Pelanggan::latest()->get(),
            'kendaraans' => Kendaraan::latest()->get(),
            'daftarServices' => DaftarService::with(['pelanggan', 'kendaraan'])->latest()->get(),
            'dataServices' => DataService::with('daftarService')->latest()->get(),
            'pembayarans' => PembayaranService::with('daftarService')->latest()->get(),
        ]);
    }

    // 1. Simpan Pelanggan
    public function storePelanggan(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|unique:pelanggans,id_pelanggan',
            'nama_lengkap' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat_pelanggan' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
        ]);
        Pelanggan::create($validated);
        return back()->with('success', 'Data Pelanggan berhasil disimpan!');
    }

    // 2. Simpan Kendaraan
    public function storeKendaraan(Request $request)
    {
        $validated = $request->validate([
            'no_plat' => 'required|unique:kendaraans,no_plat',
            'jenis_kendaraan' => 'required|in:Matic,Manual Transmisi',
            'no_stnk' => 'required|string|max:50',
            'tahun_pembuatan' => 'required|digits:4',
            'nama_pemilik' => 'required|string|max:100',
            'warna_kendaraan' => 'required|string|max:50',
        ]);
        Kendaraan::create($validated);
        return back()->with('success', 'Data Kendaraan berhasil disimpan!');
    }

    // 3. Simpan Daftar Service
    public function storeDaftarService(Request $request)
    {
        $validated = $request->validate([
            'id_servis' => 'required|unique:daftar_services,id_servis',
            'no_plat' => 'required|exists:kendaraans,no_plat',
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'nama_pelanggan' => 'required|string',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date',
        ]);
        DaftarService::create($validated);
        return back()->with('success', 'Daftar Service berhasil dicatat!');
    }

    // 4. Simpan Data Service
    public function storeDataService(Request $request)
    {
        $validated = $request->validate([
            'id_servis' => 'required|exists:daftar_services,id_servis',
            'keluhan_kendaraan' => 'required|string',
            'estimasi_service' => 'required|string',
            'nama_mekanik' => 'required|string',
            'sparepart_pengganti' => 'required|string',
        ]);
        DataService::create($validated);
        return back()->with('success', 'Data Pengerjaan Service berhasil disimpan!');
    }

    // 5. Simpan Pembayaran Service
    public function storePembayaran(Request $request)
    {
        $validated = $request->validate([
            'id_servis' => 'required|exists:daftar_services,id_servis',
            'jumlah_biaya' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|in:Cash / Tunai,Non Tunai',
            'keterangan' => 'nullable|string',
        ]);
        PembayaranService::create($validated);
        return back()->with('success', 'Pembayaran Service berhasil disimpan!');
    }
}