@extends('layouts.app')

@section('title', 'Master & Integrasi Unit API - Disdik Kota Palangka Raya')

@section('content')
    @include('components.breadcrumb', [
        'items' => [['label' => 'Master & Integrasi Unit API']],
    ])

    <!-- Page Title & Quick Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
        <div>
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Master Unit & Integrasi API Sekolah</h2>
            <p class="text-xs text-slate-500">Kelola sinkronisasi data master sekolah dari API eksternal ke database lokal.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <button
                class="px-3 py-1.5 text-xs font-medium bg-white border border-slate-200 rounded-lg text-slate-700 hover:bg-slate-50 transition-colors flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Konfigurasi API
            </button>
            <button
                class="px-3 py-1.5 text-xs font-semibold bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Jalankan Sync Sekarang
            </button>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-12 gap-4">

        <!-- Status Integrasi & Metrics -->
        <div
            class="col-span-12 md:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Unit
                        Terdaftar</span>
                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">214 Sekolah</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Database Lokal</span>
                <span class="font-medium text-emerald-600">Terverifikasi</span>
            </div>
        </div>

        <div
            class="col-span-12 md:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Status Endpoint
                        API</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-1">
                    <p class="text-xl font-bold text-slate-900">Connected</p>
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">HTTP
                        200 OK</span>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Latency</span>
                <span class="font-mono font-medium text-slate-700">142 ms</span>
            </div>
        </div>

        <div
            class="col-span-12 md:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Terakhir
                        Disinkron</span>
                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">Hari ini, 02.00 WIB</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Mode Ingestion</span>
                <span class="font-medium text-slate-700">Cron Scheduler (Daily)</span>
            </div>
        </div>

        <!-- Main Data Table Container -->
        <div class="col-span-12 bg-white rounded-xl border border-slate-200 overflow-hidden flex flex-col justify-between">
            <div>
                <!-- Table Filter Header -->
                <div class="p-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <input type="text" placeholder="Cari NPSN, Nama Sekolah, Alamat..."
                            class="w-64 px-3 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:bg-white focus:border-slate-300 focus:outline-none transition-all">
                        <select
                            class="px-3 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:outline-none">
                            <option value="">Semua Jenjang</option>
                            <option value="SD">SD Negeri / Swasta</option>
                            <option value="SMP">SMP Negeri / Swasta</option>
                            <option value="SKB">SKB / TK</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <span>Menampilkan <strong>1 - 3</strong> dari <strong>214</strong> data</span>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="border-b border-slate-100 bg-slate-50/50 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                                <th class="py-3 px-4">NPSN / ID</th>
                                <th class="py-3 px-4">Nama Unit Sekolah</th>
                                <th class="py-3 px-4">Jenjang / Status</th>
                                <th class="py-3 px-4">Alamat Lengkap</th>
                                <th class="py-3 px-4">Status Sync</th>
                                <th class="py-3 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs">
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 px-4 font-mono font-semibold text-slate-700">30201234</td>
                                <td class="py-3 px-4 font-semibold text-slate-900">SDN 1 Pahandut</td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 border border-slate-200">SD
                                        - NEGERI</span>
                                </td>
                                <td class="py-3 px-4 text-slate-600 truncate max-w-xs">Jl. Ahmad Yani No. 12, Pahandut,
                                    Palangka Raya</td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Synced
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right space-x-1">
                                    <button
                                        class="px-2 py-1 text-[11px] text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded transition-colors">Detail
                                        JSON</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 px-4 font-mono font-semibold text-slate-700">30205678</td>
                                <td class="py-3 px-4 font-semibold text-slate-900">SMPN 2 Palangka Raya</td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 border border-slate-200">SMP
                                        - NEGERI</span>
                                </td>
                                <td class="py-3 px-4 text-slate-600 truncate max-w-xs">Jl. Tjilik Riwut Km. 2.5, Jekan
                                    Raya, Palangka Raya</td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Synced
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right space-x-1">
                                    <button
                                        class="px-2 py-1 text-[11px] text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded transition-colors">Detail
                                        JSON</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 px-4 font-mono font-semibold text-slate-700">30209912</td>
                                <td class="py-3 px-4 font-semibold text-slate-900">SDN 3 Jekan Raya</td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 border border-slate-200">SD
                                        - NEGERI</span>
                                </td>
                                <td class="py-3 px-4 text-slate-600 truncate max-w-xs">Jl. Yos Sudarso No. 45, Jekan Raya,
                                    Palangka Raya</td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending Update
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right space-x-1">
                                    <button
                                        class="px-2 py-1 text-[11px] text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded transition-colors">Detail
                                        JSON</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table Footer Pagination -->
            <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Halaman 1 dari 72</span>
                <div class="flex items-center gap-1">
                    <button
                        class="px-2.5 py-1 border border-slate-200 rounded text-slate-600 hover:bg-slate-50 disabled:opacity-50"
                        disabled>Sebelumnya</button>
                    <button
                        class="px-2.5 py-1 border border-slate-200 rounded text-slate-600 hover:bg-slate-50">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>
@endsection
