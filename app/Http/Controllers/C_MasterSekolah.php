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

        if (!File::exists($jsonPath)) {
            $allData = collect();
        } else {
            $rawJson = File::get($jsonPath);
            $decoded = json_decode($rawJson, true);
            $allData = collect($decoded['data'] ?? []);
        }

        // 1. Hitung Metrik Bento Cards
        $totalSekolah = $allData->count();
        $totalNegeri  = $allData->where('status_sekolah', 'NEGERI')->count();
        $totalSwasta  = $allData->where('status_sekolah', 'SWASTA')->count();
        $totalAkredA  = $allData->where('akreditasi', 'A')->count();

        // 2. Filter Data
        $filtered = $allData->filter(function ($item) use ($request) {
            $matchSearch    = true;
            $matchKecamatan = true;
            $matchStatus    = true;
            $matchJenjang   = true;

            if ($request->filled('search')) {
                $keyword     = strtolower($request->search);
                $matchSearch = str_contains(strtolower($item['nama'] ?? ''), $keyword) ||
                    str_contains(strtolower($item['npsn'] ?? ''), $keyword);
            }

            if ($request->filled('kecamatan')) {
                $matchKecamatan = strtolower($item['kecamatan'] ?? '') === strtolower($request->kecamatan);
            }

            if ($request->filled('status_sekolah')) {
                $matchStatus = strtoupper($item['status_sekolah'] ?? '') === strtoupper($request->status_sekolah);
            }

            if ($request->filled('bentuk_pendidikan')) {
                $matchJenjang = strtoupper($item['bentuk_pendidikan'] ?? '') === strtoupper($request->bentuk_pendidikan);
            }

            return $matchSearch && $matchKecamatan && $matchStatus && $matchJenjang;
        });

        // 3. Paginasi Manual
        $perPage     = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $filtered->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $sekolahPaginator = new LengthAwarePaginator(
            $currentPageItems,
            $filtered->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $listKecamatan = $allData->pluck('kecamatan')->filter()->unique()->sort()->values();

        return view('pages.aset-sekolah', [
            'sekolah' => $sekolahPaginator,
            'metrics' => [
                'total_smp' => $totalSekolah,
                'negeri'    => $totalNegeri,
                'swasta'    => $totalSwasta,
                'akred_a'   => $totalAkredA,
            ],
            'listKecamatan' => $listKecamatan,
        ]);
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
            $totalData = count($decoded['data'] ?? []);
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

        // PASTIKAN 'apiStatus' DAN 'httpCode' DI-PASS DI SINI BRO!
        return view('pages.master-unit', [
            'totalData' => $totalData,
            'lastSync'  => $lastSync,
            'logs'      => $logs,
            'apiStatus' => $apiStatus,
            'httpCode'  => $httpCode,
        ]);
    }

    /**
     * Real Crawler Pipeline Engine (Rate-Limited Batching)
     */
    public function syncApi(Request $request)
    {
        // Set Max Execution Time & Memory Limit untuk menangani batching skala besar
        set_time_limit(600);
        ini_set('memory_limit', '512M');

        $headers = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Accept'     => 'application/json',
            'Referer'    => 'https://sekolah.data.kemendikdasmen.go.id/',
        ];

        // 1 = TK, 5 = SD, 6 = SMP
        $targetJenjang = [1, 5, 6];
        $masterDataMerged = [];

        try {
            foreach ($targetJenjang as $jenjangId) {

                // STEP 1: Fetch Informasi Umum (cari-sekolah)
                $searchUrl = 'https://sekolah.data.kemendikdasmen.go.id/v1/sekolah-service/sekolah/cari-sekolah';
                $responseSearch = Http::withHeaders($headers)->post($searchUrl, [
                    'keyword'              => 'Palangka Raya',
                    'bentuk_pendidikan_id' => $jenjangId
                ]);

                if (!$responseSearch->successful()) {
                    continue;
                }

                $listSekolah = $responseSearch->json()['data'] ?? [];

                // STEP 2: Batching Rate Limiting (Diisi per 10 sekolah)
                $batches = array_chunk($listSekolah, 10);

                foreach ($batches as $batch) {
                    foreach ($batch as $itemUmum) {
                        $sekolahId = $itemUmum['sekolah_id'] ?? null;
                        if (!$sekolahId) continue;

                        // Structuring Informasi Umum
                        $sekolahNode = [
                            'sekolah_id'        => $sekolahId,
                            'nama'              => $itemUmum['nama'] ?? '-',
                            'npsn'              => $itemUmum['npsn'] ?? '-',
                            'status_sekolah'    => $itemUmum['status_sekolah'] ?? '-',
                            'bentuk_pendidikan' => $itemUmum['bentuk_pendidikan'] ?? '-',
                            'akreditasi'        => $itemUmum['akreditasi'] ?? '-',
                            'alamat_jalan'      => $itemUmum['alamat_jalan'] ?? '-',
                            'kecamatan'         => $itemUmum['kecamatan'] ?? '-',
                            'kode_pos'          => $itemUmum['kode_pos'] ?? '-',
                            // Dynamic Full Detail Nodes Placeholder
                            'ruang'             => [],
                            'ptk'               => [],
                            'rasio_siswa'       => [],
                            'rasio_rombel_ruang_kelas' => []
                        ];

                        // STEP 3: Fetch Full Detail per Sekolah ID
                        $detailUrl = "https://sekolah.data.kemendikdasmen.go.id/v1/sekolah-service/sekolah/full-detail/{$sekolahId}";
                        $responseDetail = Http::withHeaders($headers)->get($detailUrl);

                        if ($responseDetail->successful()) {
                            $payloadDetail = $responseDetail->json();

                            // Injection Nodes Detail Lengkap Sesuai Spec JSON Kemendikdasmen
                            $sekolahNode['ruang'] = $payloadDetail['ruang'][0] ?? [];
                            $sekolahNode['ptk']   = $payloadDetail['ptk'][0] ?? [];
                            $sekolahNode['rasio_siswa'] = $payloadDetail['rasio_siswa'][0] ?? [];
                            $sekolahNode['rasio_rombel_ruang_kelas'] = $payloadDetail['rasio_rombel_ruang_kelas'][0] ?? [];

                            // Lengkapi koordinat & atribut jika tersedia di node detail
                            if (isset($payloadDetail['sekolah'][0])) {
                                $d = $payloadDetail['sekolah'][0];
                                $sekolahNode['lintang'] = $d['lintang'] ?? null;
                                $sekolahNode['bujur']   = $d['bujur'] ?? null;
                                $sekolahNode['email']   = $d['email'] ?? null;
                                $sekolahNode['nomor_telepon'] = $d['nomor_telepon'] ?? null;
                            }
                        }

                        // Gabungkan ke Master Container dengan Primary Key Unique
                        $masterDataMerged[$sekolahId] = $sekolahNode;

                        // Jeda halus 300ms antar-request
                        usleep(300000);
                    }

                    // Sleep 1 detik setelah menyelesaikan 1 batch (10 sekolah)
                    sleep(1);
                }
            }

            // STEP 4: Persist Array Gabungan ke storage/json/sekolah.json
            $jsonDirectory = storage_path('json');
            if (!File::exists($jsonDirectory)) {
                File::makeDirectory($jsonDirectory, 0755, true);
            }

            File::put(
                $jsonDirectory . '/sekolah.json',
                json_encode([
                    'status'     => 'success',
                    'total'      => count($masterDataMerged),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'data'       => array_values($masterDataMerged)
                ], JSON_PRETTY_PRINT)
            );

            return redirect()->back()->with('success', 'Pipeline Crawling Berhasil! ' . count($masterDataMerged) . ' Sekolah berhasil di-ingest ke sekolah.json');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Eksekusi Crawling: ' . $e->getMessage());
        }
    }
}
