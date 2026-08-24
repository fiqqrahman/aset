@extends('layouts.app')

@section('title', 'Master Data Aset Sekolah / Unit - Disdik Kota Palangka Raya')

@section('content')
    @include('components.breadcrumb', [
        'items' => [['label' => 'Aset Sekolah / Unit']],
    ])

    <!-- Page Title & Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
        <div>
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Master Unit Sekolah
            </h2>
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

    <!-- Metrics Summary Rows (Bento Cards Dinamis Lintas Jenjang) -->
    <div class="grid grid-cols-12 gap-4 mb-4">
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
                <p class="text-xl font-bold text-slate-900 mt-1">{{ $metrics['total_sekolah'] }} Unit</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>TK / SD / SMP</span>
                <span class="font-medium text-emerald-600">Palangka Raya</span>
            </div>
        </div>

        <div
            class="col-span-12 md:col-span-3 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Sekolah Negeri</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-emerald-600 mt-1">{{ $metrics['negeri'] }} Sekolah</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Aset Pemda</span>
                <span class="font-medium text-slate-700">Terverifikasi</span>
            </div>
        </div>

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
                <p class="text-xl font-bold text-blue-600 mt-1">{{ $metrics['swasta'] }} Sekolah</p>
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
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Akreditasi Unggulan
                        (A)</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">{{ $metrics['akred_a'] }} Sekolah</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Rasio Standar Sarpras</span>
                <span class="font-medium text-amber-600">
                    {{ $metrics['total_sekolah'] > 0 ? round(($metrics['akred_a'] / $metrics['total_sekolah']) * 100, 1) : 0 }}%
                </span>
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
                            <th class="py-3 px-4">Kode Pos</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs">
                        @forelse($sekolah as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3.5 px-4 font-mono font-semibold text-slate-700">
                                    {{ $item['npsn'] ?? '-' }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-semibold text-slate-900">{{ $item['nama'] ?? '-' }}</div>
                                    <span class="text-[10px] text-slate-400">ID: {{ $item['sekolah_id'] ?? '-' }}</span>
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
                                <td class="py-3.5 px-4 text-slate-600 font-mono">
                                    {{ $item['kode_pos'] ?? '-' }}
                                </td>
                                <td class="py-3.5 px-4 text-right space-x-1">
                                    <button
                                        class="px-2.5 py-1 text-[11px] font-medium text-emerald-700 hover:bg-emerald-50 rounded border border-emerald-200 transition-colors">
                                        Detail Aset
                                    </button>
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
@endsection
