@extends('layouts.app')
@section('title', 'Control Tower Integrasi API - Disdik Kota Palangka Raya')
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
            <form method="POST" action="{{ route('admin.master-unit.sync') }}">
                @csrf
                <button type="submit"
                    onclick="return confirm('Jalankan pipeline fetching 3 jenjang sekaligus ke sekolah.json?')"
                    class="px-3.5 py-2 text-xs font-semibold bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Jalankan Sync 3 Jenjang Sekarang
                </button>
            </form>
        </div>
    </div>

    <!-- Status Cards Grid -->
    <div class="grid grid-cols-12 gap-4 mb-4">
        <div
            class="col-span-12 md:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Status Connection
                        API</span>
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">HTTP
                        200 OK</span>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">CONNECTED</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Target Host</span>
                <span class="font-mono text-slate-700">kemendikdasmen.go.id</span>
            </div>
        </div>

        <div
            class="col-span-12 md:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Merged
                        Record</span>
                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></div>
                </div>
                <p class="text-xl font-bold text-slate-900 mt-1">{{ $totalData }} Sekolah</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Storage Output</span>
                <span class="font-mono text-emerald-700 font-bold">storage/json/sekolah.json</span>
            </div>
        </div>

        <div
            class="col-span-12 md:col-span-4 bg-white p-4 rounded-xl border border-slate-200 flex flex-col justify-between shadow-sm">
            <div>
                <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Waktu Sync Terakhir</span>
                <p class="text-xl font-bold text-slate-900 mt-1">{{ $lastSync }}</p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Coverage</span>
                <span class="font-medium text-slate-700">PAUD/TK, SD, SMP</span>
            </div>
        </div>
    </div>

    <!-- Configuration & Execution Logs -->
    <div class="grid grid-cols-12 gap-4">
        <div
            class="col-span-12 lg:col-span-4 bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-1">Parameter Pipeline Target</h3>
                <p class="text-[11px] text-slate-500 mb-4">Pengaturan gabungan 3 jenjang pendidikan.</p>

                <div class="space-y-3 text-xs">
                    <div>
                        <label class="font-semibold text-slate-700 block mb-1">Wilayah / Kabupaten</label>
                        <input type="text" value="Kota Palangka Raya" disabled
                            class="w-full px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-slate-600 font-medium">
                    </div>
                    <div>
                        <label class="font-semibold text-slate-700 block mb-1">Jenjang Pendidikan Integrated</label>
                        <input type="text" value="TK (1), SD (5), SMP (6)" disabled
                            class="w-full px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg text-slate-700 font-bold">
                    </div>
                    <div>
                        <label class="font-semibold text-slate-700 block mb-1">Target Storage File</label>
                        <input type="text" value="sekolah.json" disabled
                            class="w-full px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-lg font-mono text-emerald-700 font-bold">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 mt-6">
                <span class="text-[10px] text-slate-400">Data hasil gabungan siap disajikan pada Halaman Aset Sekolah &
                    Snapshot DB.</span>
            </div>
        </div>

        <div
            class="col-span-12 lg:col-span-8 bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm flex flex-col justify-between">
            <div>
                <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <div>
                        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Log Riwayat Pipeline Ingestion
                        </h3>
                        <p class="text-[11px] text-slate-500">Audit trail fetching data Kemendikdasmen ke JSON lokal</p>
                    </div>
                    <span class="text-[11px] font-mono text-slate-400">Log Live: ACTIVE</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="border-b border-slate-100 bg-slate-50/80 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                                <th class="py-3 px-4">Waktu Eksekusi</th>
                                <th class="py-3 px-4">Endpoint Kemendikdasmen</th>
                                <th class="py-3 px-4">Jenjang Target</th>
                                <th class="py-3 px-4">Record Merged</th>
                                <th class="py-3 px-4 text-right">HTTP Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs font-mono">
                            @foreach ($logs as $log)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="py-3 px-4 text-slate-700">{{ $log['timestamp'] }}</td>
                                    <td class="py-3 px-4 text-slate-900 font-semibold">{{ $log['endpoint'] }}</td>
                                    <td class="py-3 px-4 text-slate-600">{{ $log['target'] }}</td>
                                    <td class="py-3 px-4 font-bold text-slate-800">{{ $log['records'] }} Data</td>
                                    <td class="py-3 px-4 text-right">
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
@endsection
