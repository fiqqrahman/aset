<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class C_MasterSekolah extends Controller
{
    /**
     * Halaman View Data Unit Sekolah (Membaca storage/json/sekolah.json)
     */
    public function index(Request $request)
    {
        $jsonPath = storage_path('json/sekolah.json');
        $allData = [];

        if (File::exists($jsonPath)) {
            $jsonContent = File::get($jsonPath);
            $decoded = json_decode($jsonContent, true) ?? [];
            $allData = $decoded['data'] ?? $decoded;
        }

        $collection = collect($allData);

        // Dynamic Lists for Dropdown Filters
        $listKecamatan = $collection->pluck('kecamatan')->filter()->unique()->sort()->values();
        $listJenjang   = $collection->pluck('bentuk_pendidikan')->filter()->unique()->sort()->values();

        // Apply Search & Filters
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $collection = $collection->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['nama'] ?? ''), $search)
                    || str_contains(strtolower($item['npsn'] ?? ''), $search);
            });
        }

        if ($request->filled('kecamatan')) {
            $collection = $collection->where('kecamatan', $request->kecamatan);
        }

        if ($request->filled('status_sekolah')) {
            $collection = $collection->where('status_sekolah', $request->status_sekolah);
        }

        if ($request->filled('jenjang')) {
            $collection = $collection->where('bentuk_pendidikan', $request->jenjang);
        }

        // Calculate Dynamic Metrics for All Levels
        $metrics = [
            'total_sekolah' => $collection->count(),
            'negeri'        => $collection->where('status_sekolah', 'NEGERI')->count(),
            'swasta'        => $collection->where('status_sekolah', 'SWASTA')->count(),
            'akred_a'       => $collection->where('akreditasi', 'A')->count(),
        ];

        // Manual Pagination Logic
        $perPage = 15;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $sekolah = new LengthAwarePaginator(
            $currentItems,
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('pages.aset-sekolah', compact('sekolah', 'metrics', 'listKecamatan', 'listJenjang'));
    }

    /**
     * Halaman Control Tower Monitoring Integrasi API
     */
    public function masterUnit()
    {
        $jsonDir  = storage_path('json');
        $fileFull = $jsonDir . '/sekolah.json';

        $totalData = 0;
        $lastSync  = 'Belum Ada Data';

        if (File::exists($fileFull)) {
            $rawJson   = File::get($fileFull);
            $decoded   = json_decode($rawJson, true);
            $totalData = count($decoded['data'] ?? $decoded);
            $lastSync  = date('d M Y - H:i:s \W\I\B', File::lastModified($fileFull));
        }

        // --- PING HEALTH-CHECK KE SERVER KEMENDIKDASMEN ---
        try {
            $response = Http::timeout(3)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
                ])
                ->get('https://sekolah.data.kemendikdasmen.go.id/');

            $httpCode  = $response->status();
            $apiStatus = $response->successful() ? 'CONNECTED' : 'DEGRADED';
        } catch (\Exception $e) {
            $httpCode  = 500;
            $apiStatus = 'OFFLINE';
        }

        $logs = [
            [
                'timestamp' => $lastSync,
                'endpoint'  => 'cari-sekolah & full-detail (Rate-Limited)',
                'target'    => 'TK (1), SD (5), SMP (6)',
                'records'   => $totalData,
                'status'    => $apiStatus === 'CONNECTED' ? 'SUCCESS' : 'FAILED',
                'http_code' => $httpCode,
            ]
        ];

        return view('pages.master-unit', [
            'totalData' => $totalData,
            'lastSync'  => $lastSync,
            'logs'      => $logs,
            'apiStatus' => $apiStatus,
            'httpCode'  => $httpCode,
        ]);
    }

    /**
     * Real Crawler Pipeline Engine (Based on Seed JSON Files)
     */
    public function syncApi(Request $request)
    {
        set_time_limit(600);
        ini_set('memory_limit', '512M');

        $headers = [
            'User-Agent'   => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
            'Referer'      => 'https://sekolah.data.kemendikdasmen.go.id/',
        ];

        // 1. Cari File Sumber (Prioritas: smp.json -> master_sekolah_base.json -> sekolah.json)
        $jsonDir = storage_path('json');
        $sourceFile = null;

        $candidateFiles = ['smp.json', 'master_sekolah_base.json', 'sekolah.json'];
        foreach ($candidateFiles as $file) {
            if (File::exists($jsonDir . '/' . $file)) {
                $sourceFile = $jsonDir . '/' . $file;
                break;
            }
        }

        if (!$sourceFile) {
            return redirect()->back()->with('error', 'Gagal: File sumber JSON (smp.json) tidak ditemukan di storage/json/');
        }

        // 2. Decode Data Sumber & Ekstrak List Sekolah
        $rawContent = File::get($sourceFile);
        $decoded = json_decode($rawContent, true) ?? [];
        $listSekolah = $decoded['data'] ?? $decoded;

        if (empty($listSekolah) || !is_array($listSekolah)) {
            return redirect()->back()->with('error', 'Gagal: Data pada file ' . basename($sourceFile) . ' kosong atau tidak valid.');
        }

        $masterDataMerged = [];

        try {
            // 3. Batching Rate Limiting per 10 Sekolah
            $batches = array_chunk($listSekolah, 10);

            foreach ($batches as $batch) {
                foreach ($batch as $itemUmum) {
                    $sekolahId = $itemUmum['sekolah_id'] ?? null;
                    if (!$sekolahId) continue;

                    // Baseline node
                    $sekolahNode = [
                        'sekolah_id'        => $sekolahId,
                        'nama'              => $itemUmum['nama'] ?? '-',
                        'npsn'              => $itemUmum['npsn'] ?? '-',
                        'status_sekolah'    => $itemUmum['status_sekolah'] ?? '-',
                        'bentuk_pendidikan' => $itemUmum['bentuk_pendidikan'] ?? '-',
                        'akreditasi'        => $itemUmum['akreditasi'] ?? '-',
                        'alamat_jalan'      => $itemUmum['alamat_jalan'] ?? '-',
                        'kecamatan'         => $itemUmum['kecamatan'] ?? '-',
                        'path_file'         => $itemUmum['path_file'] ?? null,
                        'sekolah'           => [],
                        'ruang'             => [],
                        'ptk'               => [],
                        'rasio_siswa'       => [],
                        'rasio_rombel_ruang_kelas' => []
                    ];

                    // 4. Hit API Full Detail berdasarkan sekolah_id
                    $detailUrl = "https://sekolah.data.kemendikdasmen.go.id/v1/sekolah-service/sekolah/full-detail/{$sekolahId}";
                    $responseDetail = Http::withHeaders($headers)->get($detailUrl);

                    if ($responseDetail->successful()) {
                        $payloadDetail = $responseDetail->json()['data'] ?? [];

                        // Inject node "sekolah" lengkap dari Kemendikdasmen
                        $sekolahNode['sekolah']                  = $payloadDetail['sekolah'][0] ?? [];
                        $sekolahNode['ruang']                    = $payloadDetail['ruang'][0] ?? [];
                        $sekolahNode['ptk']                      = $payloadDetail['ptk'][0] ?? [];
                        $sekolahNode['rasio_siswa']              = $payloadDetail['rasio_siswa'][0] ?? [];
                        $sekolahNode['rasio_rombel_ruang_kelas'] = $payloadDetail['rasio_rombel_ruang_kelas'][0] ?? [];

                        // Update atribut level root dari node sekolah jika tersedia
                        if (isset($payloadDetail['sekolah'][0])) {
                            $d = $payloadDetail['sekolah'][0];
                            $sekolahNode['nama']              = $d['nama'] ?? $sekolahNode['nama'];
                            $sekolahNode['npsn']              = $d['npsn'] ?? $sekolahNode['npsn'];
                            $sekolahNode['status_sekolah']    = $d['status_sekolah'] ?? $sekolahNode['status_sekolah'];
                            $sekolahNode['bentuk_pendidikan'] = $d['bentuk_pendidikan'] ?? $sekolahNode['bentuk_pendidikan'];
                            $sekolahNode['akreditasi']        = $d['akreditasi'] ?? $sekolahNode['akreditasi'];
                            $sekolahNode['alamat_jalan']      = $d['alamat_jalan'] ?? $sekolahNode['alamat_jalan'];
                            $sekolahNode['kecamatan']         = $d['kecamatan'] ?? $sekolahNode['kecamatan'];
                            $sekolahNode['lintang']           = $d['lintang'] ?? null;
                            $sekolahNode['bujur']             = $d['bujur'] ?? null;
                            $sekolahNode['email']             = $d['email'] ?? null;
                            $sekolahNode['nomor_telepon']     = $d['nomor_telepon'] ?? null;
                        }
                    }

                    $masterDataMerged[$sekolahId] = $sekolahNode;
                    usleep(300000); // 300ms delay
                }
                sleep(1); // 1 detik delay per batch
            }

            // 5. Simpan Hasil Gabungan ke storage/json/sekolah.json
            File::put(
                $jsonDir . '/sekolah.json',
                json_encode([
                    'status'     => 'success',
                    'total'      => count($masterDataMerged),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'data'       => array_values($masterDataMerged)
                ], JSON_PRETTY_PRINT)
            );

            return redirect()->back()->with('success', 'Pipeline Sync Berhasil! ' . count($masterDataMerged) . ' Sekolah sukses di-ingest dari ' . basename($sourceFile) . ' ke sekolah.json');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Eksekusi Sync: ' . $e->getMessage());
        }
    }
}
