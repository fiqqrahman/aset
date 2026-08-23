<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Inventaris Aset - Disdik Kota Palangka Raya</title>

    <!-- Font Inter & Leaflet CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            600: '#16a34a',
                            700: '#15803d',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        #map {
            height: 100%;
            width: 100%;
            border-radius: 0.5rem;
            z-index: 1;
        }
    </style>
</head>

<body class="h-full text-slate-800 antialiased selection:bg-slate-200">

    <div class="min-h-full flex">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col justify-between shrink-0">
            <div>
                <!-- Header Logo -->
                <div class="h-16 flex items-center px-6 border-b border-slate-800">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded bg-emerald-600 flex items-center justify-center text-white font-bold text-sm">
                            PR
                        </div>
                        <div>
                            <h1 class="text-xs font-bold text-slate-100 uppercase tracking-wider">SIP-ASET</h1>
                            <p class="text-[10px] text-slate-400">Disdik Kota Palangka Raya</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1">
                    <p class="px-3 text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-2">Utama</p>

                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 text-xs font-medium text-white bg-slate-800 rounded-md">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Dashboard Overview
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 text-xs font-medium text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-md transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Aset Sekolah (KIB)
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 text-xs font-medium text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-md transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        Pemetaan & Geospasial
                    </a>

                    <p class="px-3 text-[10px] font-semibold text-slate-500 uppercase tracking-wider mt-6 mb-2">
                        Administrasi</p>

                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 text-xs font-medium text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-md transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        Mutasi & Transfer Aset
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 text-xs font-medium text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-md transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Pelaporan & BA
                    </a>
                </nav>
            </div>

            <!-- User Context Footer -->
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center gap-3">
                    <div
                        class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-semibold text-slate-300">
                        AD
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-medium text-slate-200 truncate">Admin Dinas</p>
                        <p class="text-[10px] text-slate-500 truncate">NIP. 19880312 ...</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            <!-- Top Navbar -->
            <header
                class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center gap-4 w-1/3">
                    <div class="relative w-full">
                        <input type="text" placeholder="Cari Kode Barang, Nama Aset, atau ID Sekolah..."
                            class="w-full pl-9 pr-4 py-1.5 text-xs bg-slate-100 border border-transparent rounded-md focus:bg-white focus:border-slate-300 focus:outline-none transition-all">
                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <select
                        class="text-xs border border-slate-200 rounded-md px-3 py-1.5 bg-white text-slate-600 focus:outline-none font-medium">
                        <option>TA 2026 (Aktif)</option>
                        <option>TA 2025</option>
                    </select>
                    <div class="h-4 w-px bg-slate-200"></div>
                    <button
                        class="px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-medium rounded-md transition-colors flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Input Aset
                    </button>
                </div>
            </header>

            <!-- Dashboard Content (Bento Grid) -->
            <main class="p-6 space-y-6">
                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 tracking-tight">Ringkasan Inventaris & Pemetaan
                            Aset</h2>
                        <p class="text-xs text-slate-500">Monitoring rekapitulasi data barang milik daerah unit
                            pendidikan Kota Palangka Raya.</p>
                    </div>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200 w-max">
                        Sinkronisasi Terakhir: Hari ini 08:00 WIB
                    </span>
                </div>

                <!-- Bento Grid Structure -->
                <div class="grid grid-cols-12 gap-4">

                    <!-- Metric Card 1: Total Aset -->
                    <div
                        class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Nilai
                                Aset KIB</span>
                            <p class="text-xl font-bold text-slate-900 mt-1">Rp 142,85 M</p>
                        </div>
                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span>Aset Tetap & Peralatan</span>
                            <span class="font-medium text-emerald-600">+2.4% yoy</span>
                        </div>
                    </div>

                    <!-- Metric Card 2: Total Unit/Sekolah -->
                    <div
                        class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Unit
                                Terdata</span>
                            <p class="text-xl font-bold text-slate-900 mt-1">214 Unit</p>
                        </div>
                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span>SD Negeri / SMP Negeri / SKB</span>
                            <span class="font-medium text-slate-700">100% Terverifikasi</span>
                        </div>
                    </div>

                    <!-- Metric Card 3: Kondisi Baik -->
                    <div
                        class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Kondisi
                                Baik (Layak)</span>
                            <p class="text-xl font-bold text-emerald-600 mt-1">84,2%</p>
                        </div>
                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span>Total Item</span>
                            <span class="font-medium text-slate-700">18.420 Item</span>
                        </div>
                    </div>

                    <!-- Metric Card 4: Rusak / Perlu Perbaikan -->
                    <div
                        class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Rusak Berat
                                / Penghapusan</span>
                            <p class="text-xl font-bold text-rose-600 mt-1">3,8%</p>
                        </div>
                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span>Usulan Rekonsiliasi</span>
                            <span class="font-medium text-rose-600">821 Item</span>
                        </div>
                    </div>

                    <!-- Bento Row 2: GIS Map (8 Cols) + Breakdown Status (4 Cols) -->

                    <!-- Map Container -->
                    <div
                        class="col-span-12 lg:col-span-8 bg-white p-4 rounded-xl border border-slate-200 flex flex-col h-[420px]">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Sebaran
                                    Geospasial Aset Sekolah</h3>
                                <p class="text-[11px] text-slate-500">Kepadatan dan distribusi aset pada sekolah di
                                    wilayah Palangka Raya</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1 text-[10px] text-slate-500">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Optimal
                                </span>
                                <span class="inline-flex items-center gap-1 text-[10px] text-slate-500">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span> Maintenance
                                </span>
                            </div>
                        </div>
                        <!-- Leaflet Container -->
                        <div
                            class="flex-1 w-full rounded-lg overflow-hidden border border-slate-100 bg-slate-50 relative">
                            <div id="map"></div>
                        </div>
                    </div>

                    <!-- Right Side Widget: Breakdown Category (KIB) -->
                    <div
                        class="col-span-12 lg:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-1">Klasifikasi KIB
                            </h3>
                            <p class="text-[11px] text-slate-500 mb-4">Rincian distribusi aset berdasarkan Kartu
                                Inventaris Barang</p>

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
                                        <span class="font-medium text-slate-700">KIB D (Jalan, Irigasi,
                                            Jaringan)</span>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Bento Row 3: Table Recent Activity/Unit Listing (12 Cols) -->
                    <div class="col-span-12 bg-white rounded-xl border border-slate-200 overflow-hidden">
                        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                            <div>
                                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Aktivitas & Log
                                    Rekonsiliasi Aset Terbaru</h3>
                                <p class="text-[11px] text-slate-500">Pembaruan kondisi fisik dan mutasi barang oleh
                                    pengurus barang sekolah</p>
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
                                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Baik
                                            </span>
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
                                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                                Rusak Ringan
                                            </span>
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
                                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-rose-50 text-rose-700 border border-rose-200">
                                                Rusak Berat
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-right text-slate-500">18 Aug 2026</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <!-- Leaflet JS & Map Initialization Script -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Coordinate Center: Palangka Raya (-2.2096, 113.9145)
            const map = L.map('map', {
                zoomControl: true,
                scrollWheelZoom: false
            }).setView([-2.2096, 113.9145], 12);

            // Tile Layer: OpenStreetMap Clean Style
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            // Mock GeoJSON Points: Unit Sekolah di Palangka Raya
            const schools = [{
                    name: "SDN 1 Pahandut",
                    lat: -2.2130,
                    lng: 113.9210,
                    status: "Baik",
                    totalAset: "Rp 1.2M"
                },
                {
                    name: "SMPN 2 Palangka Raya",
                    lat: -2.2020,
                    lng: 113.9080,
                    status: "Maintenance",
                    totalAset: "Rp 3.4M"
                },
                {
                    name: "SDN 3 Jekan Raya",
                    lat: -2.1950,
                    lng: 113.8990,
                    status: "Baik",
                    totalAset: "Rp 850M"
                },
                {
                    name: "SMPN 1 Palangka Raya",
                    lat: -2.2080,
                    lng: 113.9150,
                    status: "Baik",
                    totalAset: "Rp 4.1M"
                }
            ];

            // Render Markers
            schools.forEach(school => {
                const markerColor = school.status === "Baik" ? "#16a34a" : "#f59e0b";

                const circleMarker = L.circleMarker([school.lat, school.lng], {
                    radius: 7,
                    fillColor: markerColor,
                    color: "#ffffff",
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.9
                }).addTo(map);

                circleMarker.bindPopup(`
                <div style="font-family: 'Inter', sans-serif; font-size: 11px;">
                    <strong style="font-size: 12px; display: block; margin-bottom: 2px;">${school.name}</strong>
                    <span style="color: #64748b;">Total Aset: ${school.totalAset}</span><br>
                    <span style="color: #64748b;">Status: <strong>${school.status}</strong></span>
                </div>
            `);
            });
        });
    </script>

</body>

</html>
