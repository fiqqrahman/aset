@extends('layouts.app')

@section('title', 'Control Integrasi API - Disdik Kota Palangka Raya')

@section('content')
    @include('components.breadcrumb', [
        'items' => [['label' => 'Master & Integrasi Unit API']],
    ])

    <!-- Page Title & Primary Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
        <div>
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Pusat Kontrol Integrasi & Pipeline API</h2>
            <p class="text-xs text-slate-500">Monitoring pipeline fetching data Kemendikdasmen (TK, SD, SMP) ke storage JSON
                lokal.</p>
        </div>
        <div class="flex items-center gap-2">
            <button type="button" onclick="startRealtimeSync()"
                class="px-3.5 py-2 text-xs font-semibold bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Jalankan Live Sync Now
            </button>
        </div>
    </div>

    <!-- Status Cards Grid -->
    <div class="grid grid-cols-12 gap-4 mb-4">
        <!-- Card 1: Health Status API -->
        <div
            class="col-span-12 md:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Status Connection
                        API</span>
                    <div
                        class="w-8 h-8 rounded-lg {{ $apiStatus === 'CONNECTED' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-1">
                    <p class="text-xl font-bold {{ $apiStatus === 'CONNECTED' ? 'text-slate-900' : 'text-rose-600' }}">
                        {{ $apiStatus }}
                    </p>
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold {{ $apiStatus === 'CONNECTED' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' }}">
                        HTTP {{ $httpCode }}
                    </span>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Target Host</span>
                <span class="font-mono text-slate-700">kemendikdasmen.go.id</span>
            </div>
        </div>

        <!-- Card 2: Total Merged Record -->
        <div
            class="col-span-12 md:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Merged
                        Record</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">{{ $totalData }} Sekolah</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Storage Output</span>
                <span class="font-mono text-emerald-700 font-bold">storage/json/sekolah.json</span>
            </div>
        </div>

        <!-- Card 3: Last Sync Time -->
        <div
            class="col-span-12 md:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Waktu Sync
                        Terakhir</span>
                    <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">{{ $lastSync }}</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Coverage</span>
                <span class="font-medium text-slate-700">PAUD/TK, SD, SMP</span>
            </div>
        </div>
    </div>

    <!-- Configuration & Execution Logs Grid -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Left Column: Parameter Target & Checkbox Selector Field JSON -->
        <div
            class="col-span-12 lg:col-span-5 bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-1">Parameter Pipeline & Selector
                    Field JSON</h3>
                <p class="text-[11px] text-slate-500 mb-4">Centang properti data yang ingin ditarik dan disimpan ke <code
                        class="font-mono text-emerald-600">sekolah.json</code>.</p>

                <div class="space-y-3 text-xs mb-4">
                    <div>
                        <label class="font-semibold text-slate-700 block mb-1">Wilayah / Kabupaten</label>
                        <input type="text" value="Kota Palangka Raya" disabled
                            class="w-full px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-slate-600 font-medium">
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="font-semibold text-slate-700 block mb-1">Jenjang Integrated</label>
                            <input type="text" value="TK, SD, SMP" disabled
                                class="w-full px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-slate-700 font-bold">
                        </div>
                        <div>
                            <label class="font-semibold text-slate-700 block mb-1">Target Storage File</label>
                            <input type="text" value="sekolah.json" disabled
                                class="w-full px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg font-mono text-emerald-700 font-bold">
                        </div>
                    </div>
                </div>

                <!-- Control Button Quick Select Field -->
                <div class="border-t border-slate-100 pt-3 mb-3">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[11px] font-bold text-slate-800 uppercase tracking-wider">Properti Field
                            Target</span>
                        <div class="flex items-center gap-1.5">
                            <button type="button" onclick="selectPreset('essential')"
                                class="px-2 py-0.5 text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 rounded hover:bg-emerald-100">
                                Preset Penting
                            </button>
                            <button type="button" onclick="selectAllFields(true)"
                                class="px-2 py-0.5 text-[10px] font-semibold bg-slate-100 text-slate-700 border border-slate-200 rounded hover:bg-slate-200">
                                Semua
                            </button>
                            <button type="button" onclick="selectAllFields(false)"
                                class="px-2 py-0.5 text-[10px] font-semibold bg-slate-100 text-slate-500 border border-slate-200 rounded hover:bg-slate-200">
                                Reset
                            </button>
                        </div>
                    </div>

                    <!-- List Checkbox Berdasarkan Sub Group Data JSON -->
                    <form id="fieldSelectorForm" class="space-y-3 max-h-[clac(320px)] overflow-y-auto pr-1">
                        <!-- Group 1: Identitas & Lokasi Dasar -->
                        <div class="p-2.5 bg-slate-50/70 rounded-lg border border-slate-200/80">
                            <span class="text-[10px] font-bold text-slate-500 uppercase block mb-1.5">1. Identitas Utama &
                                Lokasi</span>
                            <div class="grid grid-cols-2 gap-2 text-[11px]">
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="sekolah_id"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked disabled>
                                    <span class="font-mono text-slate-800 font-medium">sekolah_id *</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="nama"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Nama Sekolah</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="npsn"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">NPSN</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="bentuk_pendidikan"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Jenjang/Bentuk</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="status_sekolah"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Status (Negeri/Swasta)</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="akreditasi"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Akreditasi</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="kecamatan"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Kecamatan</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="alamat_jalan"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Alamat Jalan</span>
                                </label>
                            </div>
                        </div>

                        <!-- Group 2: Geospasial & GIS Coordinates -->
                        <div class="p-2.5 bg-slate-50/70 rounded-lg border border-slate-200/80">
                            <span class="text-[10px] font-bold text-slate-500 uppercase block mb-1.5">2. Geospasial (GIS
                                Map)</span>
                            <div class="grid grid-cols-2 gap-2 text-[11px]">
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="lintang"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Lintang (Latitude)</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="bujur"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Bujur (Longitude)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Group 3: Sub-Object Sekolah (KIB A & Utilitas) -->
                        <div class="p-2.5 bg-slate-50/70 rounded-lg border border-slate-200/80">
                            <span class="text-[10px] font-bold text-slate-500 uppercase block mb-1.5">3. Sub-Object
                                `sekolah` (Tanah & Utilitas)</span>
                            <div class="grid grid-cols-2 gap-2 text-[11px]">
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="sekolah.luas_tanah_milik"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Luas Tanah Milik</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="sekolah.luas_tanah_bukan_milik"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Luas Bukan Milik</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="sekolah.daya_listrik"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Daya Listrik</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="sekolah.akses_internet"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Akses Internet</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="sekolah.email"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Email Sekolah</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="sekolah.nomor_telepon"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Nomor Telepon</span>
                                </label>
                            </div>
                        </div>

                        <!-- Group 4: Sub-Object Ruang, PTK, Rasio -->
                        <div class="p-2.5 bg-slate-50/70 rounded-lg border border-slate-200/80">
                            <span class="text-[10px] font-bold text-slate-500 uppercase block mb-1.5">4. Sub-Object
                                Fasilitas, PTK & Siswa</span>
                            <div class="grid grid-cols-2 gap-2 text-[11px]">
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="ruang.ruang_kelas_baik"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Ruang Kelas Baik</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="ruang.ruang_perpustakaan_baik"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Perpustakaan Baik</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="ptk.ptk_guru_l"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">PTK Guru L</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="ptk.ptk_guru_p"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">PTK Guru P</span>
                                </label>
                                <label class="flex items-center gap-1.5 cursor-pointer">
                                    <input type="checkbox" name="field" value="rasio_siswa.jml_pd"
                                        class="field-checkbox rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                        checked>
                                    <span class="text-slate-700">Jumlah Siswa (PD)</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="pt-3 border-t border-slate-100 mt-2">
                <span class="text-[10px] text-slate-400 block">Hanya properti yang dicentang di atas yang akan diproses dan
                    disimpan saat sync streaming dijalankan.</span>
            </div>
        </div>

        <!-- Right Column: Tabel Log Riwayat Pipeline Ingestion (Disesuaikan Lebar Kolomnya) -->
        <div
            class="col-span-12 lg:col-span-7 bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm flex flex-col justify-between">
            <div>
                <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <div>
                        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Log Riwayat Pipeline
                            Ingestion</h3>
                        <p class="text-[11px] text-slate-500">Audit trail fetching data Kemendikdasmen ke JSON lokal</p>
                    </div>
                    <span class="text-[11px] font-mono text-slate-400">Log Live: ACTIVE</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[calc(640px)]">
                        <thead>
                            <tr
                                class="border-b border-slate-100 bg-slate-50/80 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                                <th class="py-3 px-4 w-[22%] whitespace-nowrap">Waktu Eksekusi</th>
                                <th class="py-3 px-4 w-[38%]">Endpoint Kemendikdasmen</th>
                                <th class="py-3 px-4 w-[18%] whitespace-nowrap">Jenjang Target</th>
                                <th class="py-3 px-4 w-[12%] text-center whitespace-nowrap">Record</th>
                                <th class="py-3 px-4 w-[10%] text-right whitespace-nowrap">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs font-mono">
                            @foreach ($logs as $log)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="py-3.5 px-4 text-slate-700 whitespace-nowrap font-medium">
                                        {{ $log['timestamp'] }}
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-900 font-semibold wrap-break-words">
                                        {{ $log['endpoint'] }}
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-600 whitespace-nowrap">
                                        {{ $log['target'] }}
                                    </td>
                                    <td class="py-3.5 px-4 font-bold text-slate-800 text-center whitespace-nowrap">
                                        {{ $log['records'] }} Data
                                    </td>
                                    <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            {{ $log['http_code'] }} {{ $log['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="p-3 border-t border-slate-100 bg-slate-50/30 text-right">
                <span class="text-[11px] text-slate-400">Pipeline siap mengeksekusi data berskala besar.</span>
            </div>
        </div>
    </div>

    <!-- Pop-Up Modal Live Progress Sync (Streaming SSE Indicator) -->
    <div id="syncProgressModal"
        class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-slate-200 shadow-2xl max-w-xl w-full p-6 space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-3 h-3 rounded-full bg-emerald-500 animate-ping"></div>
                    <h3 class="text-sm font-bold text-slate-900">Pipeline Ingestion Streaming</h3>
                </div>
                <span id="syncCounter" class="text-xs font-mono font-bold text-slate-600">0 / 0</span>
            </div>
            <!-- Progress Bar -->
            <div>
                <div class="flex justify-between text-xs mb-1 font-medium">
                    <span id="syncStatusText" class="text-slate-500 truncate max-w-xs">Memulai koneksi ke
                        Kemendikdasmen...</span>
                    <span id="syncPercent" class="text-emerald-600 font-bold">0%</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                    <div id="syncProgressBar" class="bg-emerald-600 h-2.5 rounded-full transition-all duration-300"
                        style="width: 0%"></div>
                </div>
            </div>
            <!-- Console Log Output Box -->
            <div id="syncLogConsole"
                class="bg-slate-900 rounded-lg p-3 text-[11px] font-mono text-emerald-400 h-36 overflow-y-auto space-y-1">
                <div>> [SYSTEM] Initializing SSE Pipeline Connection...</div>
            </div>
            <div class="flex justify-end pt-2">
                <button id="closeSyncBtn" disabled onclick="location.reload()"
                    class="px-4 py-1.5 text-xs font-semibold bg-slate-200 text-slate-400 rounded-lg transition-colors cursor-not-allowed">
                    Harap Tunggu...
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function selectAllFields(status) {
            document.querySelectorAll('.field-checkbox').forEach(cb => {
                if (!cb.disabled) cb.checked = status;
            });
        }

        function selectPreset(type) {
            const essentialFields = [
                'nama', 'npsn', 'bentuk_pendidikan', 'status_sekolah', 'akreditasi', 'kecamatan', 'alamat_jalan',
                'lintang', 'bujur', 'sekolah.luas_tanah_milik', 'sekolah.daya_listrik',
                'ruang.ruang_kelas_baik', 'ruang.ruang_perpustakaan_baik', 'ptk.ptk_guru_l', 'ptk.ptk_guru_p',
                'rasio_siswa.jml_pd'
            ];

            document.querySelectorAll('.field-checkbox').forEach(cb => {
                if (!cb.disabled) {
                    cb.checked = essentialFields.includes(cb.value);
                }
            });
        }

        function startRealtimeSync() {
            // Highlighting field tercentang
            const selectedFields = ['sekolah_id']; // sekolah_id mandatory primary key
            document.querySelectorAll('.field-checkbox:checked').forEach(cb => {
                if (cb.value !== 'sekolah_id') selectedFields.push(cb.value);
            });

            if (selectedFields.length === 1) {
                alert('Pilih setidaknya satu properti selain sekolah_id untuk ditarik!');
                return;
            }

            if (!confirm(`Jalankan sync pipeline dengan ${selectedFields.length} field properti pilihan antum?`)) return;

            const modal = document.getElementById('syncProgressModal');
            const progressBar = document.getElementById('syncProgressBar');
            const percentText = document.getElementById('syncPercent');
            const counterText = document.getElementById('syncCounter');
            const statusText = document.getElementById('syncStatusText');
            const consoleLog = document.getElementById('syncLogConsole');
            const closeBtn = document.getElementById('closeSyncBtn');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // SSE Client Connection dengan Query Param Fields Terpilih
            const fieldsParam = encodeURIComponent(selectedFields.join(','));
            const evtSource = new EventSource(`{{ route('admin.master-unit.sync-stream') }}?fields=${fieldsParam}`);

            evtSource.onmessage = function(e) {
                const data = JSON.parse(e.data);
                if (data.error) {
                    consoleLog.innerHTML += `<div class="text-rose-400">> [ERROR] ${data.error}</div>`;
                    evtSource.close();
                    return;
                }
                if (data.complete) {
                    progressBar.style.width = '100%';
                    percentText.textContent = '100%';
                    statusText.textContent = 'Proses Sync Selesai!';
                    consoleLog.innerHTML +=
                        `<div class="text-emerald-300 font-bold">> [SUCCESS] Ingestion Selesai & File sekolah.json Diperbarui!</div>`;
                    consoleLog.scrollTop = consoleLog.scrollHeight;
                    closeBtn.disabled = false;
                    closeBtn.classList.remove('bg-slate-200', 'text-slate-400', 'cursor-not-allowed');
                    closeBtn.classList.add('bg-emerald-600', 'hover:bg-emerald-700', 'text-white');
                    closeBtn.textContent = 'Selesai & Refresh Data';
                    evtSource.close();
                    return;
                }
                // Update UI Counters & Bar                 
                progressBar.style.width = data.percentage + '%';
                percentText.textContent = data.percentage + '%';
                counterText.textContent = `${data.current} / ${data.total}`;
                statusText.textContent = `Fetching: ${data.nama}`;
                // Append Log Console Modal                 
                consoleLog.innerHTML +=
                    `<div>> [INGEST] (${data.current}/${data.total}) [${data.npsn}] ${data.nama}</div>`;
                consoleLog.scrollTop = consoleLog.scrollHeight;
            };

            evtSource.onerror = function() {
                consoleLog.innerHTML +=
                    `<div class="text-rose-400">> [CONNECTION] SSE Stream Closed / Connection Lost.</div>`;
                evtSource.close();
            };
        }
    </script>
@endpush
