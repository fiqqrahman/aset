@extends('layouts.app')

@section('title', 'Master Data Aset Sekolah / Unit - Disdik Kota Palangka Raya')

@section('content')
    @include('components.breadcrumb', [
        'items' => [['label' => 'Aset Sekolah / Unit']],
    ])

    <!-- Page Title & Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
        <div>
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Master Unit Sekolah</h2>
            <p class="text-xs text-slate-500">Direktori unit sekolah jenjang TK/PAUD, SD, & SMP Negeri/Swasta di Kota
                Palangka Raya.</p>
        </div>
        <div class="flex items-center gap-2">
            <form method="POST" action="{{ route('admin.aset-sekolah.snapshot') }}">
                @csrf
                <button type="submit"
                    onclick="return confirm('Apakah antum yakin ingin melakukan snapshot/sinkronisasi seluruh data JSON (semua jenjang) ke Database?')"
                    class="px-3 py-1.5 text-xs font-semibold bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors flex items-center gap-1.5 shadow-sm">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Snapshot ke DB
                </button>
            </form>
            <button
                class="px-3 py-1.5 text-xs font-medium bg-white border border-slate-200 rounded-lg text-slate-700 hover:bg-slate-50 transition-colors flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Ekspor Data Unit
            </button>
        </div>
    </div>

    @php
        // Perhitungan Sederhana Statistik Koordinat
        $validCoords = 0;
        $invalidCoords = 0;
        foreach ($sekolah as $item) {
            $lat = (float) ($item['lintang'] ?? ($item['sekolah']['lintang'] ?? 0));
            $lng = (float) ($item['bujur'] ?? ($item['sekolah']['bujur'] ?? 0));
            if ($lat != 0 && $lng != 0) {
                $validCoords++;
            } else {
                $invalidCoords++;
            }
        }
    @endphp

    <!-- Metrics Summary Rows (Bento Cards) -->
    <div class="grid grid-cols-12 gap-4 mb-4">
        <!-- Card 1: Total Unit Terdata -->
        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
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
                <p class="text-xl font-bold text-slate-900 mt-1">{{ $metrics['total_sekolah'] ?? $sekolah->total() }} Unit
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Wilayah Administrasi</span>
                <span class="font-medium text-emerald-600">Kota Palangka Raya</span>
            </div>
        </div>

        <!-- Card 2: Sekolah Negeri -->
        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Sekolah Negeri</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-emerald-600 mt-1">{{ $metrics['negeri'] ?? 0 }} Unit</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Status Kelembagaan</span>
                <span class="font-medium text-emerald-600">Negeri</span>
            </div>
        </div>

        <!-- Card 3: Sekolah Swasta -->
        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Sekolah Swasta</span>
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-blue-600 mt-1">{{ $metrics['swasta'] ?? 0 }} Unit</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Status Kelembagaan</span>
                <span class="font-medium text-blue-600">Swasta</span>
            </div>
        </div>

        <!-- Card 4: Status Pemetaan Koordinat -->
        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Status Pemetaan
                        Koordinat</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">
                    <span class="text-emerald-600">{{ $validCoords }} Valid</span>
                    <span class="text-slate-300 font-normal">/</span>
                    <span class="text-rose-600">{{ $invalidCoords }} Belum</span>
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Posisi Peta GIS</span>
                <span class="font-medium text-slate-700">Valid vs Belum Valid</span>
            </div>
        </div>
    </div>

    <!-- Main Data Table Section -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden flex flex-col justify-between shadow-sm">
        <div>
            <!-- Filters Header -->
            <form method="GET" action="{{ route('admin.aset-sekolah') }}"
                class="p-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-slate-50/50">
                <div class="flex flex-wrap items-center gap-2">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari NPSN atau Nama Unit..."
                            class="w-64 pl-8 pr-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg focus:border-slate-300 focus:outline-none transition-all placeholder:text-slate-400">
                        <svg class="w-3.5 h-3.5 text-slate-400 absolute left-2.5 top-2.5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <select name="jenjang" onchange="this.form.submit()"
                        class="px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 focus:outline-none">
                        <option value="">Semua Jenjang</option>
                        @foreach ($listJenjang as $jnj)
                            <option value="{{ $jnj }}" {{ request('jenjang') == $jnj ? 'selected' : '' }}>
                                {{ strtoupper($jnj) }}
                            </option>
                        @endforeach
                    </select>
                    <select name="kecamatan" onchange="this.form.submit()"
                        class="px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 focus:outline-none">
                        <option value="">Semua Kecamatan</option>
                        @foreach ($listKecamatan as $kec)
                            <option value="{{ $kec }}" {{ request('kecamatan') == $kec ? 'selected' : '' }}>
                                {{ $kec }}
                            </option>
                        @endforeach
                    </select>
                    <select name="status_sekolah" onchange="this.form.submit()"
                        class="px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 focus:outline-none">
                        <option value="">Semua Status</option>
                        <option value="NEGERI" {{ request('status_sekolah') == 'NEGERI' ? 'selected' : '' }}>NEGERI
                        </option>
                        <option value="SWASTA" {{ request('status_sekolah') == 'SWASTA' ? 'selected' : '' }}>SWASTA
                        </option>
                    </select>
                    @if (request()->anyFilled(['search', 'jenjang', 'kecamatan', 'status_sekolah']))
                        <a href="{{ route('admin.aset-sekolah') }}"
                            class="text-xs text-rose-600 hover:underline px-2 py-1">Reset Filter</a>
                    @endif
                </div>
                <div class="text-xs text-slate-500">
                    Menampilkan <strong>{{ $sekolah->count() }}</strong> dari <strong>{{ $sekolah->total() }}</strong>
                    Unit terdata
                </div>
            </form>

            <!-- Table Body -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="border-b border-slate-100 bg-slate-50/80 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="py-3 px-4">NPSN</th>
                            <th class="py-3 px-4">Nama Unit Sekolah</th>
                            <th class="py-3 px-4">Jenjang & Status</th>
                            <th class="py-3 px-4">Kecamatan / Alamat</th>
                            <th class="py-3 px-4">Koordinat (Lat, Lng)</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($sekolah as $item)
                            @php
                                $lat = $item['lintang'] ?? ($item['sekolah']['lintang'] ?? 0);
                                $lng = $item['bujur'] ?? ($item['sekolah']['bujur'] ?? 0);
                                $isValidCoord = (float) $lat != 0 && (float) $lng != 0;
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3.5 px-4 font-mono font-semibold text-slate-700">
                                    {{ $item['npsn'] ?? '-' }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-semibold text-slate-900">{{ $item['nama'] ?? '-' }}</div>
                                    <span class="text-[10px] text-slate-400 font-mono">ID:
                                        {{ $item['sekolah_id'] ?? '-' }}</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        <span
                                            class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-slate-800 text-white">
                                            {{ strtoupper($item['bentuk_pendidikan'] ?? 'UNIT') }}
                                        </span>
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium {{ ($item['status_sekolah'] ?? '') === 'NEGERI' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                                            {{ $item['status_sekolah'] ?? '-' }}
                                        </span>
                                        <span
                                            class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                            Akred {{ $item['akreditasi'] ?? '-' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-medium text-slate-800">{{ $item['kecamatan'] ?? '-' }}</div>
                                    <div class="text-slate-500 truncate max-w-xs text-[11px]">
                                        {{ $item['alamat_jalan'] ?? '-' }}
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 font-mono">
                                    @if ($isValidCoord)
                                        <div class="text-slate-700 text-[11px] font-medium">{{ $lat }},
                                            {{ $lng }}</div>
                                        <span
                                            class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Valid
                                        </span>
                                    @else
                                        <div class="text-rose-500 text-[11px] font-medium">0, 0</div>
                                        <span
                                            class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                            Belum Valid
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <!-- Tombol Edit Data & Koordinat -->
                                        <button type="button" title="Edit Data & Koordinat Sekolah"
                                            onclick="openEditModal('{{ $item['sekolah_id'] }}', {{ json_encode($item) }})"
                                            class="p-1.5 text-amber-700 hover:bg-amber-50 rounded-lg border border-amber-200 transition-colors shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <!-- Tombol Full Detail Sekolah -->
                                        <button type="button" title="Informasi Full Detail Sekolah"
                                            onclick="openDetailModal('{{ $item['sekolah_id'] }}', {{ json_encode($item) }})"
                                            class="p-1.5 text-blue-700 hover:bg-blue-50 rounded-lg border border-blue-200 transition-colors shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-slate-400 text-xs">
                                    Data unit sekolah tidak ditemukan. Coba ubah kata kunci pencarian/filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Table Footer Pagination -->
        <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Halaman {{ $sekolah->currentPage() }} dari {{ $sekolah->lastPage() }}</span>
            <div>
                {{ $sekolah->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Full Detail Sekolah -->
    <div id="schoolDetailModal"
        class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm items-center justify-center p-4">
        <div
            class="bg-white rounded-xl border border-slate-200 shadow-2xl max-w-2xl w-full max-h-[85vh] flex flex-col overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <div>
                    <h3 id="modalTitle" class="text-sm font-bold text-slate-900">Detail Informasi Sekolah</h3>
                    <p id="modalSub" class="text-[11px] text-slate-500 font-mono"></p>
                </div>
                <button onclick="closeDetailModal()"
                    class="text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-200/50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-5 overflow-y-auto text-xs">
                <div id="modalBodyContent"></div>
            </div>
            <div class="p-3 border-t border-slate-100 bg-slate-50 flex justify-end">
                <button onclick="closeDetailModal()"
                    class="px-3 py-1.5 text-xs font-semibold bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data & Koordinat Sekolah -->
    <div id="schoolEditModal"
        class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm items-center justify-center p-4">
        <div class="bg-white rounded-xl border border-slate-200 shadow-2xl max-w-lg w-full overflow-hidden">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Edit Informasi & Koordinat Sekolah</h3>
                    <p id="editModalSub" class="text-[11px] text-slate-500 font-mono"></p>
                </div>
                <button onclick="closeEditModal()"
                    class="text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-200/50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="editSekolahForm" method="POST" action="" class="p-5 space-y-3 text-xs">
                @csrf
                @method('PUT')
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Sekolah / Unit</label>
                    <input type="text" id="edit_nama" name="nama" required
                        class="w-full px-3 py-1.5 border border-slate-200 rounded-lg focus:outline-none focus:border-slate-400">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">NPSN</label>
                        <input type="text" id="edit_npsn" name="npsn" required
                            class="w-full px-3 py-1.5 border border-slate-200 rounded-lg font-mono focus:outline-none focus:border-slate-400">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Kecamatan</label>
                        <input type="text" id="edit_kecamatan" name="kecamatan" required
                            class="w-full px-3 py-1.5 border border-slate-200 rounded-lg focus:outline-none focus:border-slate-400">
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Alamat Jalan</label>
                    <input type="text" id="edit_alamat_jalan" name="alamat_jalan"
                        class="w-full px-3 py-1.5 border border-slate-200 rounded-lg focus:outline-none focus:border-slate-400">
                </div>
                <!-- Input Koordinat Geospasial -->
                <div class="p-3 bg-amber-50/60 rounded-lg border border-amber-200 space-y-2">
                    <span class="block text-[11px] font-bold text-amber-900 uppercase">Perbaikan Titik Koordinat
                        (GIS)</span>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1">Latitude (Lintang)</label>
                            <input type="text" id="edit_lintang" name="lintang" placeholder="-2.2096" required
                                class="w-full px-3 py-1.5 border border-slate-200 rounded-lg font-mono focus:outline-none focus:border-slate-400 bg-white">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1">Longitude (Bujur)</label>
                            <input type="text" id="edit_bujur" name="bujur" placeholder="113.9145" required
                                class="w-full px-3 py-1.5 border border-slate-200 rounded-lg font-mono focus:outline-none focus:border-slate-400 bg-white">
                        </div>
                    </div>
                </div>
                <div class="pt-3 border-t border-slate-100 flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()"
                        class="px-3 py-1.5 font-semibold bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg transition-colors">Batal</button>
                    <button type="submit"
                        class="px-4 py-1.5 font-semibold bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors shadow-sm">Simpan
                        Pembaruan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function openDetailModal(sekolahId, item) {
            const modal = document.getElementById('schoolDetailModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalSub = document.getElementById('modalSub');
            const modalBody = document.getElementById('modalBodyContent');

            modalTitle.textContent = item.nama || 'Detail Sekolah';
            modalSub.textContent = `NPSN: ${item.npsn || '-'} | ID: ${sekolahId}`;

            const s = item.sekolah || {};
            const r = item.ruang || {};
            const p = item.ptk || {};
            const rs = item.rasio_siswa || {};
            const lat = item.lintang || s.lintang || 0;
            const lng = item.bujur || s.bujur || 0;

            modalBody.innerHTML = `             
                <div class="grid grid-cols-2 gap-3 bg-slate-50 p-3 rounded-lg border border-slate-100 mb-3">                 
                    <div><span class="text-slate-400 block text-[10px] uppercase font-bold">Status / Akreditasi</span> <span class="font-semibold text-slate-800">${item.status_sekolah || '-'} / Akred ${item.akreditasi || '-'}</span></div>                 
                    <div><span class="text-slate-400 block text-[10px] uppercase font-bold">Kecamatan</span> <span class="font-semibold text-slate-800">${item.kecamatan || '-'}</span></div>                 
                    <div class="col-span-2"><span class="text-slate-400 block text-[10px] uppercase font-bold">Alamat Jalan</span> <span class="font-semibold text-slate-800">${item.alamat_jalan || '-'}</span></div>             
                </div>             
                
                <!-- Section Detail Koordinat Geospasial (Sudah diberi Spacing mb-3 agar lega) -->
                <div class="p-3.5 bg-slate-100 border border-slate-200 rounded-lg flex items-center justify-between mb-3 shadow-sm">
                    <div>
                        <span class="text-slate-500 block text-[10px] uppercase font-bold tracking-wider mb-0.5">Titik Koordinat Lokasi (GIS)</span>
                        <span class="font-mono font-bold text-xs text-slate-800">${lat}, ${lng}</span>
                    </div>
                    <div>
                        ${((parseFloat(lat) !== 0 && parseFloat(lng) !== 0)) 
                            ? `<span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">Terpetakan Presisi</span>` 
                            : `<span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-200">Belum Ada Titik</span>`
                        }
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3 mb-3">                 
                    <div class="p-2.5 bg-emerald-50/50 rounded-lg border border-emerald-100">                     
                        <span class="text-emerald-600 block text-[10px] font-bold uppercase">Luas Tanah Milik</span>                     
                        <span class="text-sm font-bold text-slate-900">${s.luas_tanah_milik ?? 0} m²</span>                 
                    </div>                 
                    <div class="p-2.5 bg-blue-50/50 rounded-lg border border-blue-100">                     
                        <span class="text-blue-600 block text-[10px] font-bold uppercase">Daya Listrik</span>                     
                        <span class="text-sm font-bold text-slate-900">${s.daya_listrik ?? 0} Watt</span>                 
                    </div>                 
                    <div class="p-2.5 bg-amber-50/50 rounded-lg border border-amber-100">                     
                        <span class="text-amber-600 block text-[10px] font-bold uppercase">Jumlah Peserta Didik</span>                     
                        <span class="text-sm font-bold text-slate-900">${rs.jml_pd ?? 0} Siswa</span>                 
                    </div>             
                </div>             
                
                <div class="mb-3">                 
                    <h4 class="font-bold text-slate-900 mb-1.5 uppercase text-[10px] tracking-wider text-slate-400">Fasilitas Ruang Kelas & PTK</h4>                 
                    <div class="grid grid-cols-2 gap-2 text-[11px]">                     
                        <div class="flex justify-between p-2 bg-slate-50 rounded"><span>Ruang Kelas Baik:</span> <strong class="text-slate-800">${r.ruang_kelas_baik ?? 0}</strong></div>                     
                        <div class="flex justify-between p-2 bg-slate-50 rounded"><span>Ruang Perpustakaan:</span> <strong class="text-slate-800">${r.ruang_perpustakaan_baik ?? 0}</strong></div>                     
                        <div class="flex justify-between p-2 bg-slate-50 rounded"><span>PTK Laki-laki:</span> <strong class="text-slate-800">${p.ptk_guru_l ?? 0} Orang</strong></div>                     
                        <div class="flex justify-between p-2 bg-slate-50 rounded"><span>PTK Perempuan:</span> <strong class="text-slate-800">${p.ptk_guru_p ?? 0} Orang</strong></div>                 
                    </div>             
                </div>             
                
                <div class="pt-2 border-t border-slate-100 flex justify-between text-[11px] text-slate-500">                 
                    <span>Email: <strong class="text-slate-700">${s.email || '-'}</strong></span>                 
                    <span>Telepon: <strong class="text-slate-700">${s.nomor_telepon || '-'}</strong></span>             
                </div>         
            `;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDetailModal() {
            const modal = document.getElementById('schoolDetailModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function openEditModal(sekolahId, item) {
            const modal = document.getElementById('schoolEditModal');
            const editForm = document.getElementById('editSekolahForm');
            const editModalSub = document.getElementById('editModalSub');

            editModalSub.textContent = `ID: ${sekolahId}`;
            editForm.action = `/admin/aset-sekolah/${sekolahId}`;

            document.getElementById('edit_nama').value = item.nama || '';
            document.getElementById('edit_npsn').value = item.npsn || '';
            document.getElementById('edit_kecamatan').value = item.kecamatan || '';
            document.getElementById('edit_alamat_jalan').value = item.alamat_jalan || '';

            const s = item.sekolah || {};
            document.getElementById('edit_lintang').value = item.lintang || s.lintang || '';
            document.getElementById('edit_bujur').value = item.bujur || s.bujur || '';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditModal() {
            const modal = document.getElementById('schoolEditModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>
@endpush
