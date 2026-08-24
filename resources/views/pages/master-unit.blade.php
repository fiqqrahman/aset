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
                        {{ $apiStatus }}</p>
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
        <!-- Left: Parameter Target -->
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

        <!-- Right: Tabel Log Riwayat Pipeline Ingestion (KEMBALI UTUH) -->
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
        function startRealtimeSync() {
            if (!confirm('Jalankan real-time SSE sync pipeline ke sekolah.json?')) return;

            const modal = document.getElementById('syncProgressModal');
            const progressBar = document.getElementById('syncProgressBar');
            const percentText = document.getElementById('syncPercent');
            const counterText = document.getElementById('syncCounter');
            const statusText = document.getElementById('syncStatusText');
            const consoleLog = document.getElementById('syncLogConsole');
            const closeBtn = document.getElementById('closeSyncBtn');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // SSE Client Connection ke Route Laravel Stream
            const evtSource = new EventSource("{{ route('admin.master-unit.sync-stream') }}");

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
