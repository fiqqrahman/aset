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

    <div class="grid grid-cols-12 gap-4">

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

        <div class="col-span-12 bg-white p-4 rounded-xl border border-slate-200 flex flex-col h-[400px]">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Sebaran Geospasial Aset Sekolah
                    </h3>
                    <p class="text-[11px] text-slate-500">Kepadatan dan distribusi aset pada sekolah di wilayah Palangka
                        Raya</p>
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
            <div class="flex-1 w-full rounded-lg overflow-hidden border border-slate-100 bg-slate-50 relative">
                <div id="map"></div>
            </div>
        </div>

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

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map', {
                zoomControl: true,
                scrollWheelZoom: false
            }).setView([-2.2096, 113.9145], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

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
@endpush
