<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoCare Pro — Sistem Manajemen Service Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F1F5F9; }
        .tab-active { background-color: #F59E0B; color: #0F172A; font-weight: 700; box-shadow: 0 4px 14px rgba(245, 158, 11, 0.35); }
    </style>
</head>
<body class="text-slate-800 antialiased">

    <!-- Top Navbar -->
    <nav class="bg-slate-900 text-white shadow-lg border-b border-slate-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-slate-900 font-extrabold text-xl shadow">
                    M
                </div>
                <div>
                    <span class="font-bold text-lg tracking-tight">MotoCare<span class="text-amber-400">Pro</span></span>
                    <p class="text-[11px] text-slate-400 -mt-1">Sistem Informasi Service & Bengkel Motor</p>
                </div>
            </div>
            <div class="flex items-center space-x-3 text-xs">
                <span class="px-3 py-1.5 rounded-full bg-slate-800 text-emerald-400 border border-slate-700 font-medium">
                    ● API & MySQL Connected
                </span>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Alert Notifikasi -->
        @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-2">
                <span class="text-emerald-600 font-bold">✓</span>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold">&times;</button>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm shadow-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Navigasi 5 Menu Utama -->
        <div class="bg-slate-900 p-2 rounded-2xl shadow-md mb-8 grid grid-cols-2 md:grid-cols-5 gap-2">
            <button onclick="switchTab('pelanggan')" id="btn-pelanggan" class="tab-btn tab-active py-3 px-4 rounded-xl text-sm transition-all text-center">
                1. Data Pelanggan
            </button>
            <button onclick="switchTab('kendaraan')" id="btn-kendaraan" class="tab-btn text-slate-300 hover:bg-slate-800 py-3 px-4 rounded-xl text-sm transition-all text-center">
                2. Data Kendaraan
            </button>
            <button onclick="switchTab('daftar')" id="btn-daftar" class="tab-btn text-slate-300 hover:bg-slate-800 py-3 px-4 rounded-xl text-sm transition-all text-center">
                3. Daftar Service
            </button>
            <button onclick="switchTab('service')" id="btn-service" class="tab-btn text-slate-300 hover:bg-slate-800 py-3 px-4 rounded-xl text-sm transition-all text-center">
                4. Data Service
            </button>
            <button onclick="switchTab('pembayaran')" id="btn-pembayaran" class="tab-btn text-slate-300 hover:bg-slate-800 py-3 px-4 rounded-xl text-sm transition-all text-center col-span-2 md:col-span-1">
                5. Pembayaran Service
            </button>
        </div>

        <!-- ============================================================== -->
        <!-- MENU 1: DATA PELANGGAN -->
        <!-- ============================================================== -->
        <section id="tab-pelanggan" class="tab-content grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 h-fit">
                <h2 class="text-lg font-bold text-slate-900 mb-1">Input Data Pelanggan</h2>
                <p class="text-xs text-slate-500 mb-5">Lengkapi identitas pelanggan baru bengkel.</p>
                <form action="{{ route('pelanggan.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">a. Id Pelanggan</label>
                        <input type="text" name="id_pelanggan" placeholder="Contoh: PLG-001" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">b. Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">c. No HP</label>
                        <input type="text" name="no_hp" placeholder="08xxxxxxxxxx" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">d. Alamat Pelanggan</label>
                        <textarea name="alamat_pelanggan" rows="2" placeholder="Alamat lengkap domisili" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">e. Pekerjaan</label>
                        <input type="text" name="pekerjaan" placeholder="Contoh: Mahasiswa / Karyawan" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                    </div>
                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-amber-400 font-bold py-3 rounded-xl transition shadow-md text-sm">
                        Simpan Data Pelanggan
                    </button>
                </form>
            </div>

            <div class="lg:col-span-8 bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 overflow-x-auto">
                <h3 class="text-base font-bold text-slate-900 mb-4">Daftar Pelanggan Terdaftar</h3>
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-100 text-slate-600 text-xs uppercase">
                            <th class="p-3 rounded-tl-xl">ID Pelanggan</th>
                            <th class="p-3">Nama Lengkap</th>
                            <th class="p-3">No HP</th>
                            <th class="p-3">Alamat</th>
                            <th class="p-3 rounded-tr-xl">Pekerjaan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pelanggans as $p)
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 font-bold text-amber-600">{{ $p->id_pelanggan }}</td>
                            <td class="p-3 font-medium">{{ $p->nama_lengkap }}</td>
                            <td class="p-3">{{ $p->no_hp }}</td>
                            <td class="p-3 text-slate-600">{{ $p->alamat_pelanggan }}</td>
                            <td class="p-3"><span class="px-2.5 py-1 bg-slate-100 rounded-lg text-xs">{{ $p->pekerjaan }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="p-6 text-center text-slate-400">Belum ada data pelanggan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- MENU 2: DATA KENDARAAN -->
        <!-- ============================================================== -->
        <section id="tab-kendaraan" class="tab-content hidden grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 h-fit">
                <h2 class="text-lg font-bold text-slate-900 mb-1">Input Data Kendaraan</h2>
                <p class="text-xs text-slate-500 mb-5">Registrasi unit kendaraan pelanggan.</p>
                <form action="{{ route('kendaraan.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">a. No Plat Kendaraan</label>
                        <input type="text" name="no_plat" placeholder="Contoh: BL 4521 KAC" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm uppercase">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-2">b. Jenis Kendaraan (Radio Button)</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-amber-50/50">
                                <input type="radio" name="jenis_kendaraan" value="Matic" required class="text-amber-500 focus:ring-amber-400 mr-2">
                                <span class="text-sm font-medium">Matic</span>
                            </label>
                            <label class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-amber-50/50">
                                <input type="radio" name="jenis_kendaraan" value="Manual Transmisi" required class="text-amber-500 focus:ring-amber-400 mr-2">
                                <span class="text-sm font-medium">Manual Transmisi</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">c. No STNK</label>
                        <input type="text" name="no_stnk" placeholder="Nomor Registrasi STNK" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">d. Tahun Pembuatan</label>
                            <input type="number" name="tahun_pembuatan" placeholder="2023" min="1980" max="2026" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">f. Warna Kendaraan</label>
                            <input type="text" name="warna_kendaraan" placeholder="Hitam Doff" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">e. Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" placeholder="Nama sesuai STNK" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                    </div>
                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-amber-400 font-bold py-3 rounded-xl transition shadow-md text-sm">
                        Simpan Data Kendaraan
                    </button>
                </form>
            </div>

            <div class="lg:col-span-8 bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 overflow-x-auto">
                <h3 class="text-base font-bold text-slate-900 mb-4">Daftar Kendaraan Terdaftar</h3>
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-100 text-slate-600 text-xs uppercase">
                            <th class="p-3 rounded-tl-xl">No Plat</th>
                            <th class="p-3">Jenis</th>
                            <th class="p-3">No STNK</th>
                            <th class="p-3">Tahun</th>
                            <th class="p-3">Nama Pemilik</th>
                            <th class="p-3 rounded-tr-xl">Warna</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($kendaraans as $k)
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 font-bold text-slate-900">{{ $k->no_plat }}</td>
                            <td class="p-3"><span class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ $k->jenis_kendaraan == 'Matic' ? 'bg-amber-100 text-amber-800' : 'bg-sky-100 text-sky-800' }}">{{ $k->jenis_kendaraan }}</span></td>
                            <td class="p-3">{{ $k->no_stnk }}</td>
                            <td class="p-3">{{ $k->tahun_pembuatan }}</td>
                            <td class="p-3">{{ $k->nama_pemilik }}</td>
                            <td class="p-3">{{ $k->warna_kendaraan }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="p-6 text-center text-slate-400">Belum ada data kendaraan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- MENU 3: DAFTAR SERVICE -->
        <!-- ============================================================== -->
        <section id="tab-daftar" class="tab-content hidden grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 h-fit">
                <h2 class="text-lg font-bold text-slate-900 mb-1">Pendaftaran Service</h2>
                <p class="text-xs text-slate-500 mb-5">Buat tiket antrean dan keluhan kendaraan.</p>
                <form action="{{ route('daftar-service.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">a. Id Servis Pelanggan</label>
                        <input type="text" name="id_servis" placeholder="Contoh: SRV-001" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">b. No Plat Kendaraan (Dropdown)</label>
                        <select name="no_plat" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm bg-white">
                            <option value="">-- Pilih No Plat Kendaraan --</option>
                            @foreach($kendaraans as $k)
                                <option value="{{ $k->no_plat }}">{{ $k->no_plat }} ({{ $k->jenis_kendaraan }} - {{ $k->warna_kendaraan }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">c. Id Pelanggan (Dropdown)</label>
                        <select name="id_pelanggan" id="select_id_pelanggan" onchange="autoFillPelanggan()" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm bg-white">
                            <option value="" data-nama="">-- Pilih ID Pelanggan --</option>
                            @foreach($pelanggans as $p)
                                <option value="{{ $p->id_pelanggan }}" data-nama="{{ $p->nama_lengkap }}">{{ $p->id_pelanggan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">d. Nama Pelanggan (Otomatis)</label>
                        <input type="text" name="nama_pelanggan" id="auto_nama_pelanggan" readonly placeholder="Otomatis muncul saat ID Pelanggan dipilih" required class="w-full px-3.5 py-2.5 rounded-xl border border-amber-300 bg-amber-50/70 text-slate-800 font-semibold outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">e. Keluhan Kendaraan</label>
                        <textarea name="keluhan_kendaraan" rows="2" placeholder="Contoh: Tarikan berat, ganti oli & kampas rem" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">f. Tanggal Servis</label>
                        <input type="date" name="tanggal_servis" value="{{ date('Y-m-d') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                    </div>
                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-amber-400 font-bold py-3 rounded-xl transition shadow-md text-sm">
                        Daftarkan Service
                    </button>
                </form>
            </div>

            <div class="lg:col-span-8 bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 overflow-x-auto">
                <h3 class="text-base font-bold text-slate-900 mb-4">Antrean Daftar Service</h3>
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-100 text-slate-600 text-xs uppercase">
                            <th class="p-3 rounded-tl-xl">ID Servis</th>
                            <th class="p-3">No Plat</th>
                            <th class="p-3">ID & Nama Pelanggan</th>
                            <th class="p-3">Keluhan</th>
                            <th class="p-3 rounded-tr-xl">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($daftarServices as $ds)
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 font-bold text-amber-600">{{ $ds->id_servis }}</td>
                            <td class="p-3 font-semibold">{{ $ds->no_plat }}</td>
                            <td class="p-3">{{ $ds->id_pelanggan }} — <span class="font-medium">{{ $ds->nama_pelanggan }}</span></td>
                            <td class="p-3 text-slate-600">{{ $ds->keluhan_kendaraan }}</td>
                            <td class="p-3">{{ $ds->tanggal_servis }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="p-6 text-center text-slate-400">Belum ada pendaftaran service.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- MENU 4: DATA SERVICE -->
        <!-- ============================================================== -->
        <section id="tab-service" class="tab-content hidden grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 h-fit">
                <h2 class="text-lg font-bold text-slate-900 mb-1">Input Tindakan & Data Service</h2>
                <p class="text-xs text-slate-500 mb-5">Catatan teknis mekanik & pergantian sparepart.</p>
                <form action="{{ route('data-service.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">a. Id Servis Pelanggan (Dropdown)</label>
                        <select name="id_servis" id="select_id_servis" onchange="autoFillKeluhan()" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm bg-white">
                            <option value="" data-keluhan="">-- Pilih ID Servis Pelanggan --</option>
                            @foreach($daftarServices as $ds)
                                <option value="{{ $ds->id_servis }}" data-keluhan="{{ $ds->keluhan_kendaraan }}">{{ $ds->id_servis }} - {{ $ds->nama_pelanggan }} ({{ $ds->no_plat }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">b. Keluhan Kendaraan (Otomatis)</label>
                        <textarea name="keluhan_kendaraan" id="auto_keluhan_kendaraan" rows="2" readonly placeholder="Otomatis muncul setelah ID Servis dipilih" required class="w-full px-3.5 py-2.5 rounded-xl border border-amber-300 bg-amber-50/70 text-slate-800 font-medium outline-none text-sm"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">c. Estimasi Service</label>
                        <input type="text" name="estimasi_service" placeholder="Contoh: 1 Jam 30 Menit" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">d. Nama Mekanik</label>
                        <input type="text" name="nama_mekanik" placeholder="Nama teknisi yang menangani" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">e. Sparepart Pengganti</label>
                        <textarea name="sparepart_pengganti" rows="2" placeholder="Contoh: Oli Yamalube Matic, Kampas Rem Depan" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-amber-400 font-bold py-3 rounded-xl transition shadow-md text-sm">
                        Simpan Data Service
                    </button>
                </form>
            </div>

            <div class="lg:col-span-8 bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 overflow-x-auto">
                <h3 class="text-base font-bold text-slate-900 mb-4">Riwayat Pengerjaan Service</h3>
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-100 text-slate-600 text-xs uppercase">
                            <th class="p-3 rounded-tl-xl">ID Servis</th>
                            <th class="p-3">Keluhan</th>
                            <th class="p-3">Estimasi</th>
                            <th class="p-3">Mekanik</th>
                            <th class="p-3 rounded-tr-xl">Sparepart Pengganti</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($dataServices as $srv)
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 font-bold text-amber-600">{{ $srv->id_servis }}</td>
                            <td class="p-3">{{ $srv->keluhan_kendaraan }}</td>
                            <td class="p-3"><span class="px-2.5 py-1 bg-slate-100 rounded-lg text-xs">{{ $srv->estimasi_service }}</span></td>
                            <td class="p-3 font-medium">{{ $srv->nama_mekanik }}</td>
                            <td class="p-3 text-slate-600">{{ $srv->sparepart_pengganti }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="p-6 text-center text-slate-400">Belum ada data pengerjaan service.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- MENU 5: PEMBAYARAN SERVICE -->
        <!-- ============================================================== -->
        <section id="tab-pembayaran" class="tab-content hidden grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 h-fit">
                <h2 class="text-lg font-bold text-slate-900 mb-1">Pembayaran Service</h2>
                <p class="text-xs text-slate-500 mb-5">Penyelesaian transaksi & metode pembayaran.</p>
                <form action="{{ route('pembayaran.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">a. Id Servis Pelanggan (Dropdown)</label>
                        <select name="id_servis" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm bg-white">
                            <option value="">-- Pilih ID Servis Pelanggan --</option>
                            @foreach($daftarServices as $ds)
                                <option value="{{ $ds->id_servis }}">{{ $ds->id_servis }} - {{ $ds->nama_pelanggan }} ({{ $ds->no_plat }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">b. Jumlah Biaya Servis (Rp)</label>
                        <input type="number" name="jumlah_biaya" placeholder="Contoh: 150000" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-2">c. Jenis Pembayaran (Radio Button)</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-emerald-50/60">
                                <input type="radio" name="jenis_pembayaran" value="Cash / Tunai" required class="text-emerald-600 focus:ring-emerald-500 mr-2">
                                <span class="text-sm font-medium">Cash / Tunai</span>
                            </label>
                            <label class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-emerald-50/60">
                                <input type="radio" name="jenis_pembayaran" value="Non Tunai" required class="text-emerald-600 focus:ring-emerald-500 mr-2">
                                <span class="text-sm font-medium">Non Tunai</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">d. Keterangan</label>
                        <textarea name="keterangan" rows="2" placeholder="Contoh: Lunas via QRIS / Tunai di kasir" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-400 outline-none text-sm"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition shadow-md text-sm">
                        Proses Pembayaran
                    </button>
                </form>
            </div>

            <div class="lg:col-span-8 bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80 overflow-x-auto">
                <h3 class="text-base font-bold text-slate-900 mb-4">Riwayat Transaksi Pembayaran</h3>
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-100 text-slate-600 text-xs uppercase">
                            <th class="p-3 rounded-tl-xl">ID Servis</th>
                            <th class="p-3">Jumlah Biaya</th>
                            <th class="p-3">Jenis Pembayaran</th>
                            <th class="p-3 rounded-tr-xl">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pembayarans as $pay)
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 font-bold text-amber-600">{{ $pay->id_servis }}</td>
                            <td class="p-3 font-bold text-slate-900">Rp {{ number_format($pay->jumlah_biaya, 0, ',', '.') }}</td>
                            <td class="p-3">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold {{ $pay->jenis_pembayaran == 'Cash / Tunai' ? 'bg-emerald-100 text-emerald-800' : 'bg-indigo-100 text-indigo-800' }}">
                                    {{ $pay->jenis_pembayaran }}
                                </span>
                            </td>
                            <td class="p-3 text-slate-600">{{ $pay->keterangan ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="p-6 text-center text-slate-400">Belum ada riwayat pembayaran.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <script>
        // Navigasi Tab
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('tab-active');
                btn.classList.add('text-slate-300', 'hover:bg-slate-800');
            });

            document.getElementById('tab-' + tabName).classList.remove('hidden');
            const activeBtn = document.getElementById('btn-' + tabName);
            activeBtn.classList.add('tab-active');
            activeBtn.classList.remove('text-slate-300', 'hover:bg-slate-800');
        }

        // Fitur Wajib: Nama Pelanggan muncul otomatis setelah ID Pelanggan dipilih
        function autoFillPelanggan() {
            const select = document.getElementById('select_id_pelanggan');
            const nama = select.options[select.selectedIndex].getAttribute('data-nama');
            document.getElementById('auto_nama_pelanggan').value = nama || '';
        }

        // Fitur Wajib: Keluhan Kendaraan muncul otomatis setelah ID Servis Pelanggan dipilih
        function autoFillKeluhan() {
            const select = document.getElementById('select_id_servis');
            const keluhan = select.options[select.selectedIndex].getAttribute('data-keluhan');
            document.getElementById('auto_keluhan_kendaraan').value = keluhan || '';
        }
    </script>
</body>
</html>