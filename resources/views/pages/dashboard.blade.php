@extends('layouts.app')

@section('title', 'Dashboard Inventaris Aset - Disdik Kota Palangka Raya')

@section('content')
    @include('components.breadcrumb', [
        'items' => [['label' => 'Dashboard Overview']],
    ])

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <div>
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Ringkasan Inventaris & Pemetaan Aset</h2>
            <p class="text-xs text-slate-500">Monitoring rekapitulasi data barang milik daerah unit pendidikan Kota Palangka
                Raya.</p>
        </div>
    </div>

    <!-- Bento Grid Structure -->
    <div class="grid grid-cols-12 gap-4">
        <!-- Bento Row 1: Metric Cards -->
        <div class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Nilai Aset
                        KIB</span>
                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">Rp 142,85 M</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Aset Tetap & Peralatan</span>
                <span class="font-medium text-emerald-600">+2.4% yoy</span>
            </div>
        </div>

        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Unit
                        Terdata</span>
                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">214 Unit</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>SD / SMP / SKB</span>
                <span class="font-medium text-slate-700">100% Verifikasi</span>
            </div>
        </div>

        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Kondisi Baik
                        (Layak)</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-emerald-600 mt-1">84,2%</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Total Item</span>
                <span class="font-medium text-slate-700">18.420 Item</span>
            </div>
        </div>

        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Rusak Berat /
                        Penghapusan</span>
                    <div class="w-8 h-8 rounded-lg bg-rose-50 flex items-center justify-center text-rose-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-rose-600 mt-1">3,8%</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Usulan Rekonsiliasi</span>
                <span class="font-medium text-rose-600">821 Item</span>
            </div>
        </div>

        <!-- Chart Analisis Nilai Perolehan & Penyusutan Aset -->
        <div
            class="col-span-12 lg:col-span-8 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Tren Pertumbuhan & Depresiasi
                        Aset (5 Tahun)</h3>
                    <p class="text-[11px] text-slate-500">Akumulasi pertumbuhan perolehan barang milik daerah unit
                        pendidikan vs beban penyusutan</p>
                </div>
                <div class="flex items-center gap-2 text-xs">
                    <span class="inline-flex items-center gap-1 text-[11px] text-slate-600 font-medium">
                        <span class="w-2.5 h-2.5 rounded bg-slate-800"></span> Nilai Perolehan
                    </span>
                    <span class="inline-flex items-center gap-1 text-[11px] text-slate-600 font-medium">
                        <span class="w-2.5 h-2.5 rounded bg-rose-500"></span> Akumulasi Penyusutan
                    </span>
                </div>
            </div>
            <div class="h-[calc(220px)] w-full pt-2">
                <canvas id="assetGrowthChart"></canvas>
            </div>
        </div>

        <!-- Action Center & Admin Urgent Alerts -->
        <div
            class="col-span-12 lg:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
            <div>
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-1">Action Center Admin</h3>
                <p class="text-[11px] text-slate-500 mb-3">Tugas prioritas & verifikasi yang memerlukan tindakan</p>
                <div class="space-y-2.5">
                    <div class="p-2.5 rounded-lg bg-amber-50/70 border border-amber-200/60 flex items-start gap-2.5">
                        <div class="w-2 h-2 rounded-full bg-amber-500 mt-1 shrink-0"></div>
                        <div class="flex-1 text-xs">
                            <p class="font-semibold text-amber-900">12 Sekolah Belum Rekonsiliasi</p>
                            <p class="text-[10px] text-amber-700 mt-0.5">Batas waktu pelaporan TW II tersisa 5 hari lagi.
                            </p>
                        </div>
                        <a href="#" class="text-[11px] font-bold text-amber-800 hover:underline shrink-0">Cek</a>
                    </div>
                    <div class="p-2.5 rounded-lg bg-rose-50/70 border border-rose-200/60 flex items-start gap-2.5">
                        <div class="w-2 h-2 rounded-full bg-rose-500 mt-1 shrink-0"></div>
                        <div class="flex-1 text-xs">
                            <p class="font-semibold text-rose-900">45 Item Usulan Penghapusan</p>
                            <p class="text-[10px] text-rose-700 mt-0.5">Menunggu verifikasi fisik & SK Pengelola Barang.
                            </p>
                        </div>
                        <a href="#" class="text-[11px] font-bold text-rose-800 hover:underline shrink-0">Review</a>
                    </div>
                    <div class="p-2.5 rounded-lg bg-emerald-50/70 border border-emerald-200/60 flex items-start gap-2.5">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 mt-1 shrink-0"></div>
                        <div class="flex-1 text-xs">
                            <p class="font-semibold text-emerald-900">Jadwal Audit BPK RI</p>
                            <p class="text-[10px] text-emerald-700 mt-0.5">Penilaian sampel KIB B & C dijadwalkan bulan
                                depan.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-3 border-t border-slate-100 mt-3">
                <button
                    class="w-full py-1.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-medium rounded-lg transition-colors flex items-center justify-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Proses Rekonsiliasi Massal
                </button>
            </div>
        </div>

        <!-- Bento Row 3: Log Aktivitas Terbaru & Klasifikasi KIB -->
        <div
            class="col-span-12 lg:col-span-8 bg-white rounded-xl border border-slate-200 overflow-hidden flex flex-col justify-between">
            <div>
                <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Aktivitas & Log Rekonsiliasi
                            Aset Terbaru</h3>
                        <p class="text-[11px] text-slate-500">Pembaruan kondisi fisik dan mutasi barang oleh pengurus barang
                            sekolah</p>
                    </div>
                    <button
                        class="px-2.5 py-1 text-xs border border-slate-200 rounded text-slate-600 hover:bg-slate-50">Ekspor
                        Excel</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="border-b border-slate-100 bg-slate-50/50 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                                <th class="py-3 px-4">Kode Unit / Sekolah</th>
                                <th class="py-3 px-4">Nama Aset / Spesifikasi</th>
                                <th class="py-3 px-4">Kategori KIB</th>
                                <th class="py-3 px-4">Nilai Perolehan</th>
                                <th class="py-3 px-4">Status Kondisi</th>
                                <th class="py-3 px-4 text-right">Tanggal Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs">
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 px-4 font-semibold text-slate-900">SDN 1 Pahandut</td>
                                <td class="py-3 px-4 text-slate-700">Laptop Chromebook M73 (x15)</td>
                                <td class="py-3 px-4 text-slate-500">KIB B - Peralatan</td>
                                <td class="py-3 px-4 font-mono text-slate-700">Rp 105.000.000</td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">Baik</span>
                                </td>
                                <td class="py-3 px-4 text-right text-slate-500">22 Aug 2026</td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 px-4 font-semibold text-slate-900">SMPN 2 Palangka Raya</td>
                                <td class="py-3 px-4 text-slate-700">Gedung Laboratorium IPA</td>
                                <td class="py-3 px-4 text-slate-500">KIB C - Bangunan</td>
                                <td class="py-3 px-4 font-mono text-slate-700">Rp 450.000.000</td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-amber-50 text-amber-700 border border-amber-200">Rusak
                                        Ringan</span>
                                </td>
                                <td class="py-3 px-4 text-right text-slate-500">20 Aug 2026</td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 px-4 font-semibold text-slate-900">SDN 3 Jekan Raya</td>
                                <td class="py-3 px-4 text-slate-700">Meja Kursi Siswa (30 Set)</td>
                                <td class="py-3 px-4 text-slate-500">KIB B - Mebel</td>
                                <td class="py-3 px-4 font-mono text-slate-700">Rp 22.500.000</td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-rose-50 text-rose-700 border border-rose-200">Rusak
                                        Berat</span>
                                </td>
                                <td class="py-3 px-4 text-right text-slate-500">18 Aug 2026</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div
            class="col-span-12 lg:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
            <div>
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-1">Klasifikasi KIB</h3>
                <p class="text-[11px] text-slate-500 mb-4">Rincian distribusi aset berdasarkan Kartu Inventaris Barang</p>
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="font-medium text-slate-700">KIB A (Tanah)</span>
                            <span class="text-slate-500">312 Persil</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5">
                            <div class="bg-slate-800 h-1.5 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="font-medium text-slate-700">KIB B (Peralatan & Mesin)</span>
                            <span class="text-slate-500">12.410 Unit</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5">
                            <div class="bg-emerald-600 h-1.5 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="font-medium text-slate-700">KIB C (Gedung & Bangunan)</span>
                            <span class="text-slate-500">840 Unit</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5">
                            <div class="bg-blue-600 h-1.5 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs mb-1">
                            <span class="font-medium text-slate-700">KIB D (Jalan, Irigasi, Jaringan)</span>
                            <span class="text-slate-500">115 Ruas</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5">
                            <div class="bg-amber-500 h-1.5 rounded-full" style="width: 30%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-4 border-t border-slate-100 mt-4">
                <a href="#"
                    class="text-xs font-semibold text-emerald-700 hover:text-emerald-800 flex items-center justify-between">
                    <span>Lihat Detail Laporan KIB</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Bento Row 2: GIS Map Container dengan Search Overlay -->
        <div class="col-span-12 bg-white p-4 rounded-xl border border-slate-200 flex flex-col h-[calc(600px)]">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Sebaran Geospasial Aset Sekolah</h3>
                    <p class="text-[11px] text-slate-500">Kepadatan dan distribusi aset pada sekolah di wilayah Palangka Raya</p>
                </div>
                <div class="flex items-center gap-3 text-[10px] text-slate-500">
                    <span class="inline-flex items-center gap-1 font-semibold text-emerald-600">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span> TK/PAUD
                    </span>
                    <span class="inline-flex items-center gap-1 font-semibold text-rose-600">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-600"></span> SD
                    </span>
                    <span class="inline-flex items-center gap-1 font-semibold text-blue-900">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-900"></span> SMP
                    </span>
                </div>
            </div>

            <!-- Wrapper Container Peta & Floating Search Overlay -->
            <div class="flex-1 w-full rounded-lg overflow-hidden border border-slate-100 bg-slate-50 relative">
                
                <!-- Floating Map Search Box Control -->
                <div class="absolute top-3 left-3 z-[calc(1000)] w-72 sm:w-80">
                    <div class="relative">
                        <input type="text" id="mapSearchInput" placeholder="Cari nama sekolah / NPSN di peta..."
                            class="w-full pl-8 pr-8 py-2 text-xs bg-white/95 backdrop-blur-md border border-slate-300 rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent font-medium text-slate-800 placeholder:text-slate-400">
                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <button id="clearMapSearch" class="hidden absolute right-2.5 top-2.5 text-slate-400 hover:text-slate-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Autocomplete Dropdown List -->
                    <div id="mapSearchResults" class="hidden mt-1.5 bg-white/95 backdrop-blur-md border border-slate-200 rounded-lg shadow-xl max-h-60 overflow-y-auto divide-y divide-slate-100 text-xs">
                    </div>
                </div>

                <!-- Leaflet Container -->
                <div id="map"></div>
            </div>
        </div>    
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Leaflet GIS Map Init
            const map = L.map('map', {
                zoomControl: false, // Matikan zoom control bawaan di top-left
                scrollWheelZoom: true // AKTIFKAN ZOOM GULIR MOUSE
            }).setView([-2.2096, 113.9145], 12);

            // Pindahkan Tombol Zoom (+) dan (-) ke Pojok Kanan Bawah agar tidak menutupi Search Input
            L.control.zoom({
                position: 'bottomright'
            }).addTo(map);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            // Layer Groups per Jenjang
            const layerTK = L.layerGroup();
            const layerSD = L.layerGroup();
            const layerSMP = L.layerGroup();

            // Array simpan indeks sekolah untuk live search
            let searchIndexData = [];

            function createCustomIcon(bentuk) {
                let badgeBg = '';
                let labelText = '';
                if (['TK', 'PAUD', 'KB', 'SPS', 'TPA'].includes(bentuk)) {
                    badgeBg = '#16a34a';
                    labelText = 'TK';
                } else if (bentuk === 'SD') {
                    badgeBg = '#dc2626';
                    labelText = 'SD';
                } else if (bentuk === 'SMP') {
                    badgeBg = '#1e3a8a';
                    labelText = 'SMP';
                } else {
                    return null;
                }
                return L.divIcon({
                    className: 'custom-map-pin',
                    html: `
                        <div style="
                            background-color: ${badgeBg};
                            color: #ffffff;
                            font-size: 10px;
                            font-weight: 800;
                            padding: 2px 6px;
                            border-radius: 12px;
                            border: 2px solid #ffffff;
                            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
                            display: flex;
                            align-items: center;
                            gap: 3px;
                            white-space: nowrap;
                            font-family: 'Inter', sans-serif;
                            transform: translate(-50%, -100%);
                        ">
                            <svg style="width: 12px; height: 12px; fill: currentColor;" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            <span>${labelText}</span>
                        </div>
                    `,
                    iconSize: [40, 24],
                    iconAnchor: [20, 24],
                    popupAnchor: [0, -26]
                });
            }

            // Fetch Data dari API Controller
            fetch("{{ route('admin.api.map-sekolah') }}")
                .then(async response => {
                    const isJson = response.headers.get('content-type')?.includes('application/json');
                    const data = isJson ? await response.json() : null;
                    if (!response.ok) {
                        const errorMsg = (data && data.message) || response.statusText;
                        throw new Error(`HTTP ${response.status}: ${errorMsg}`);
                    }
                    return data;
                })
                .then(data => {
                    if (!data || !Array.isArray(data)) return;

                    data.forEach(item => {
                        const sekolahNode = (Array.isArray(item.sekolah) && item.sekolah.length > 0) ? item.sekolah[0] : (item.sekolah || {});
                        const ruangNode = (Array.isArray(item.ruang) && item.ruang.length > 0) ? item.ruang[0] : (item.ruang || {});
                        const ptkNode = (Array.isArray(item.ptk) && item.ptk.length > 0) ? item.ptk[0] : (item.ptk || {});
                        const rasioNode = (Array.isArray(item.rasio_siswa) && item.rasio_siswa.length > 0) ? item.rasio_siswa[0] : (item.rasio_siswa || {});
                        
                        const lat = parseFloat(item.lintang || sekolahNode.lintang || 0);
                        const lng = parseFloat(item.bujur || sekolahNode.bujur || 0);

                        if (!isNaN(lat) && !isNaN(lng) && lat !== 0 && lng !== 0) {
                            const bentuk = (item.bentuk_pendidikan || '').toUpperCase();
                            const customIcon = createCustomIcon(bentuk);
                            if (!customIcon) return;

                            const marker = L.marker([lat, lng], { icon: customIcon });

                            const popupContent = `
                                <div style="font-family: 'Inter', sans-serif; width: 280px; max-height: 350px; overflow-y: auto; padding: 2px;">
                                    <div style="border-bottom: 1px solid #e2e8f0; padding-bottom: 8px; margin-bottom: 8px;">
                                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 4px;">
                                            <span style="font-size: 9px; font-weight: 800; background: #0f172a; color: #fff; padding: 1px 6px; border-radius: 4px;">${bentuk}</span>
                                            <span style="font-size: 10px; font-weight: 600; color: #059669;">${item.status_sekolah || '-'}</span>
                                        </div>
                                        <h4 style="font-size: 12px; font-weight: 700; color: #0f172a; margin: 0; line-height: 1.3;">${item.nama || '-'}</h4>
                                        <p style="font-size: 10px; color: #64748b; font-family: monospace; margin: 2px 0 0 0;">NPSN: ${item.npsn || '-'}</p>
                                    </div>
                                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 4px; margin-bottom: 10px; background: #f8fafc; padding: 6px; border-radius: 6px; border: 1px solid #f1f5f9;">
                                        <div style="text-align: center;">
                                            <span style="font-size: 9px; color: #64748b; display: block;">Siswa</span>
                                            <strong style="font-size: 11px; color: #0f172a;">${rasioNode.jml_pd ?? 0}</strong>
                                        </div>
                                        <div style="text-align: center;">
                                            <span style="font-size: 9px; color: #64748b; display: block;">Kelas Baik</span>
                                            <strong style="font-size: 11px; color: #059669;">${ruangNode.ruang_kelas_baik ?? 0}</strong>
                                        </div>
                                        <div style="text-align: center;">
                                            <span style="font-size: 9px; color: #64748b; display: block;">PTK Total</span>
                                            <strong style="font-size: 11px; color: #2563eb;">${(parseInt(ptkNode.ptk_guru_l || 0) + parseInt(ptkNode.ptk_guru_p || 0))}</strong>
                                        </div>
                                    </div>
                                    <div style="font-size: 11px; color: #334155;">
                                        <div style="font-size: 10px; font-weight: 700; text-transform: uppercase; color: #94a3b8; margin-bottom: 6px; letter-spacing: 0.5px;">Struktur Aset Unit (Tree View)</div>
                                        <ul style="list-style: none; padding-left: 0; margin: 0;">
                                            <li style="margin-bottom: 4px;">
                                                <details style="border: 1px solid #e2e8f0; border-radius: 4px; padding: 4px 6px; background: #fff;">
                                                    <summary style="font-weight: 600; cursor: pointer; color: #0f172a; outline: none;">KIB A - Tanah & Lahan</summary>
                                                    <div style="padding-top: 4px; padding-left: 12px; font-size: 10px; color: #475569; border-top: 1px dashed #e2e8f0; margin-top: 4px;">
                                                        <div>Luas Lahan Milik: <strong>${sekolahNode.luas_tanah_milik ?? 0} m²</strong></div>
                                                    </div>
                                                </details>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            `;
                            marker.bindPopup(popupContent, { maxWidth: 300 });

                            // Plot ke Layer Group
                            if (['TK', 'PAUD', 'KB', 'SPS', 'TPA'].includes(bentuk)) {
                                marker.addTo(layerTK);
                            } else if (bentuk === 'SMP') {
                                marker.addTo(layerSMP);
                            } else if (bentuk === 'SD') {
                                marker.addTo(layerSD);
                            }

                            // Simpan ke Search Index Array
                            searchIndexData.push({
                                nama: item.nama || '',
                                npsn: item.npsn || '',
                                bentuk: bentuk,
                                lat: lat,
                                lng: lng,
                                marker: marker
                            });
                        }
                    });

                    // Render Layer ke Peta
                    layerTK.addTo(map);
                    layerSD.addTo(map);
                    layerSMP.addTo(map);

                    const overlayMaps = {
                        "<span style='font-size:11px; font-weight:600;'>Jenjang TK / PAUD</span>": layerTK,
                        "<span style='font-size:11px; font-weight:600;'>Jenjang SD</span>": layerSD,
                        "<span style='font-size:11px; font-weight:600;'>Jenjang SMP</span>": layerSMP
                    };
                    L.control.layers(null, overlayMaps, { collapsed: false, position: 'topright' }).addTo(map);
                })
                .catch(err => console.error("DETAIL ERROR MAP:", err.message));

            // 2. Map Autocomplete Search Interaction
            const searchInput = document.getElementById('mapSearchInput');
            const searchResults = document.getElementById('mapSearchResults');
            const clearBtn = document.getElementById('clearMapSearch');

            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();

                if (query.length > 0) {
                    clearBtn.classList.remove('hidden');
                } else {
                    clearBtn.classList.add('hidden');
                    searchResults.classList.add('hidden');
                    searchResults.innerHTML = '';
                    return;
                }

                const filtered = searchIndexData.filter(item => 
                    item.nama.toLowerCase().includes(query) || 
                    item.npsn.toLowerCase().includes(query)
                ).slice(0, 8);

                if (filtered.length > 0) {
                    searchResults.innerHTML = filtered.map((item, index) => `
                        <div data-index="${index}" class="search-item p-2.5 hover:bg-slate-100/80 cursor-pointer transition-colors flex items-center justify-between">
                            <div>
                                <div class="font-bold text-slate-800">${item.nama}</div>
                                <div class="text-[10px] text-slate-500 font-mono">NPSN: ${item.npsn}</div>
                            </div>
                            <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-slate-800 text-white">${item.bentuk}</span>
                        </div>
                    `).join('');

                    searchResults.classList.remove('hidden');

                    document.querySelectorAll('.search-item').forEach((el, idx) => {
                        el.addEventListener('click', function() {
                            const target = filtered[idx];
                            
                            map.flyTo([target.lat, target.lng], 16, {
                                animate: true,
                                duration: 1.5
                            });

                            setTimeout(() => {
                                target.marker.openPopup();
                            }, 1200);

                            searchResults.classList.add('hidden');
                            searchInput.value = target.nama;
                        });
                    });
                } else {
                    searchResults.innerHTML = `
                        <div class="p-3 text-center text-slate-400 font-medium">
                            Sekolah tidak ditemukan.
                        </div>
                    `;
                    searchResults.classList.remove('hidden');
                }
            });

            clearBtn.addEventListener('click', function() {
                searchInput.value = '';
                searchResults.classList.add('hidden');
                searchResults.innerHTML = '';
                this.classList.add('hidden');
            });

            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });

            // 3. Chart.js Asset Growth Init
            const ctx = document.getElementById('assetGrowthChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['2022', '2023', '2024', '2025', '2026'],
                    datasets: [{
                            label: 'Nilai Perolehan (Miliar)',
                            data: [110.2, 122.5, 131.0, 139.4, 142.85],
                            borderColor: '#1e293b',
                            backgroundColor: 'rgba(30, 41, 59, 0.05)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.35,
                            pointRadius: 3
                        },
                        {
                            label: 'Penyusutan (Miliar)',
                            data: [12.1, 14.8, 18.2, 21.5, 24.1],
                            borderColor: '#f43f5e',
                            borderDash: [4, 4],
                            borderWidth: 2,
                            fill: false,
                            tension: 0.35,
                            pointRadius: 3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: {
                                font: { size: 10, family: 'Inter' },
                                color: '#64748b'
                            }
                        },
                        y: {
                            grid: { color: '#f1f5f9' },
                            ticks: {
                                font: { size: 10, family: 'Inter' },
                                color: '#64748b',
                                callback: function(value) {
                                    return 'Rp ' + value + 'M';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush