@extends('layouts.app')

@section('title', 'Master Data Aset Sekolah / Unit (SMP) - Disdik Kota Palangka Raya')

@section('content')
    @include('components.breadcrumb', [
        'items' => [['label' => 'Aset Sekolah / Unit']],
    ])

    <!-- Page Title & Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
        <div>
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Master Unit Sekolah & Pemetaan Aset (SMP)</h2>
            <p class="text-xs text-slate-500">Direktori unit sekolah jenjang SMP Negeri & Swasta di wilayah Kota Palangka
                Raya.</p>
        </div>
        <div class="flex items-center gap-2">
            <button
                class="px-3 py-1.5 text-xs font-medium bg-white border border-slate-200 rounded-lg text-slate-700 hover:bg-slate-50 transition-colors flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Ekspor Data SMP
            </button>
            <button
                class="px-3 py-1.5 text-xs font-semibold bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Unit SMP
            </button>
        </div>
    </div>

    <!-- Metrics Summary Rows (Bento Cards) -->
    <div class="grid grid-cols-12 gap-4 mb-4">
        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total SMP Terdata</span>
                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">53 Unit</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Negeri & Swasta</span>
                <span class="font-medium text-emerald-600">Palangka Raya</span>
            </div>
        </div>

        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">SMP Negeri</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-emerald-600 mt-1">16 Sekolah</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Aset Pemda</span>
                <span class="font-medium text-slate-700">100% Validasi KIB</span>
            </div>
        </div>

        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">SMP Swasta</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-blue-600 mt-1">37 Sekolah</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Hibah / Mandiri</span>
                <span class="font-medium text-slate-700">Terdaftar API</span>
            </div>
        </div>

        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Akreditasi unggulan
                        (A)</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">28 Sekolah</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Rasio Standar Sarpras</span>
                <span class="font-medium text-amber-600">52,8%</span>
            </div>
        </div>
    </div>

    <!-- Main Data Table Section -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden flex flex-col justify-between shadow-sm">
        <div>
            <!-- Filters Header -->
            <div
                class="p-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-slate-50/50">
                <div class="flex flex-wrap items-center gap-2">
                    <div class="relative">
                        <input type="text" placeholder="Cari NPSN atau Nama SMP..."
                            class="w-64 pl-8 pr-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg focus:border-slate-300 focus:outline-none transition-all placeholder:text-slate-400">
                        <svg class="w-3.5 h-3.5 text-slate-400 absolute left-2.5 top-2.5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <select
                        class="px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 focus:outline-none">
                        <option value="">Semua Kecamatan</option>
                        <option value="Pahandut" selected>Kec. Pahandut</option>
                        <option value="Jekan Raya">Kec. Jekan Raya</option>
                        <option value="Sabangau">Kec. Sabangau</option>
                        <option value="Bukit Batu">Kec. Bukit Batu</option>
                        <option value="Rakumpit">Kec. Rakumpit</option>
                    </select>

                    <select
                        class="px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 focus:outline-none">
                        <option value="">Semua Status</option>
                        <option value="NEGERI">NEGERI</option>
                        <option value="SWASTA">SWASTA</option>
                    </select>
                </div>

                <div class="text-xs text-slate-500">
                    Menampilkan <strong>3</strong> dari <strong>53</strong> SMP terdata
                </div>
            </div>

            <!-- Table Body -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="py-3 px-4">NPSN</th>
                            <th class="py-3 px-4">Nama Unit Sekolah</th>
                            <th class="py-3 px-4">Status & Akreditasi</th>
                            <th class="py-3 px-4">Kecamatan / Alamat</th>
                            <th class="py-3 px-4">KIB Aset Terdaftar</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        <!-- Data 1 -->
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-semibold text-slate-700">70051854</td>
                            <td class="py-3.5 px-4">
                                <div class="font-semibold text-slate-900">SMP FILOSOFI ISLAMIC BOARDING SCHOOL</div>
                                <span class="text-[10px] text-slate-400">ID: 9BDEC788-5071-4026-9995-D132421F9A14</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-1.5">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-50 text-blue-700 border border-blue-200">SWASTA</span>
                                    <span
                                        class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">Akred
                                        A</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-medium text-slate-800">Kec. Pahandut</div>
                                <div class="text-slate-500 truncate max-w-xs text-[11px]">JL. Mahir Mahar Km. 5,1</div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                    142 Item Aset
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-1">
                                <button
                                    class="px-2.5 py-1 text-[11px] font-medium text-emerald-700 hover:bg-emerald-50 rounded border border-emerald-200 transition-colors">Detail
                                    Aset</button>
                            </td>
                        </tr>

                        <!-- Data 2 -->
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-semibold text-slate-700">70051387</td>
                            <td class="py-3.5 px-4">
                                <div class="font-semibold text-slate-900">SMP Islam Imam Nawawi</div>
                                <span class="text-[10px] text-slate-400">ID: B90C4146-199C-4F46-BB88-C564A7F93814</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-1.5">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-50 text-blue-700 border border-blue-200">SWASTA</span>
                                    <span
                                        class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">Akred
                                        B</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-medium text-slate-800">Kec. Jekan Raya</div>
                                <div class="text-slate-500 truncate max-w-xs text-[11px]">Jl. Tjilik Riwut KM 8 (Jl. Gajah
                                    Mada)</div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                    98 Item Aset
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-1">
                                <button
                                    class="px-2.5 py-1 text-[11px] font-medium text-emerald-700 hover:bg-emerald-50 rounded border border-emerald-200 transition-colors">Detail
                                    Aset</button>
                            </td>
                        </tr>

                        <!-- Data 3 -->
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-semibold text-slate-700">70051210</td>
                            <td class="py-3.5 px-4">
                                <div class="font-semibold text-slate-900">SMPIT TIARA AZ-ZAHRA</div>
                                <span class="text-[10px] text-slate-400">ID: 78154BA7-8764-40CD-BEB5-DBD93860F3C5</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-1.5">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-50 text-blue-700 border border-blue-200">SWASTA</span>
                                    <span
                                        class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">Akred
                                        C</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-medium text-slate-800">Kec. Pahandut</div>
                                <div class="text-slate-500 truncate max-w-xs text-[11px]">JL. Temanggung Surajayapati, No.
                                    334</div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                    45 Item Aset
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-1">
                                <button
                                    class="px-2.5 py-1 text-[11px] font-medium text-emerald-700 hover:bg-emerald-50 rounded border border-emerald-200 transition-colors">Detail
                                    Aset</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Table Footer Pagination -->
        <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Halaman 1 dari 18</span>
            <div class="flex items-center gap-1">
                <button
                    class="px-2.5 py-1 border border-slate-200 rounded text-slate-600 hover:bg-slate-50 disabled:opacity-50"
                    disabled>Sebelumnya</button>
                <button
                    class="px-2.5 py-1 border border-slate-200 rounded text-slate-600 hover:bg-slate-50">Selanjutnya</button>
            </div>
        </div>
    </div>
@endsection
