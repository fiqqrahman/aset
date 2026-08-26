<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class C_MasterSekolah extends Controller
{
    // Function index
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

        $listKecamatan = $collection->pluck('kecamatan')->filter()->unique()->sort()->values();
        $listJenjang   = $collection->pluck('bentuk_pendidikan')->filter()->unique()->sort()->values();

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

        $metrics = [
            'total_sekolah' => $collection->count(),
            'negeri'        => $collection->where('status_sekolah', 'NEGERI')->count(),
            'swasta'        => $collection->where('status_sekolah', 'SWASTA')->count(),
            'akred_a'       => $collection->where('akreditasi', 'A')->count(),
        ];

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

    //  Master Unit
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
   
    // Live Sync
    public function syncStream(Request $request)
    {
        set_time_limit(600);
        ini_set('memory_limit', '512M');

        // Parse query parameter 'fields' yang dikirim dari UI master-unit.blade.php
        $selectedFields = $request->query('fields') ? explode(',', $request->query('fields')) : [];

        return response()->stream(function () use ($selectedFields) {
            $headers = [
                'User-Agent'   => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'Accept'       => 'application/json',
                'Referer'      => 'https://sekolah.data.kemendikdasmen.go.id/',
            ];

            $jsonDir    = storage_path('json');
            $sourceFile = $jsonDir . '/meta-data.json';
            $targetFile = $jsonDir . '/sekolah.json';

            if (!File::exists($sourceFile)) {
                echo "data: " . json_encode(['error' => 'File meta-data.json tidak ditemukan!']) . "\n\n";
                ob_flush();
                flush();
                return;
            }

            // 1. BACA DATA LOKAL EKSISTING UNTUK CEK FLAG OVERRIDE MANUAL
            $existingData = [];
            if (File::exists($targetFile)) {
                $rawTarget    = File::get($targetFile);
                $decodedTarget = json_decode($rawTarget, true) ?? [];
                $listTarget   = $decodedTarget['data'] ?? $decodedTarget;
                if (is_array($listTarget)) {
                    // Indexing berdasarkan sekolah_id agar pencarian O(1)
                    $existingData = collect($listTarget)->keyBy('sekolah_id')->all();
                }
            }

            $rawContent   = File::get($sourceFile);
            $decoded      = json_decode($rawContent, true) ?? [];
            $listSekolah  = $decoded['data'] ?? $decoded;
            $totalSekolah = count($listSekolah);
            $masterDataMerged = [];
            $processed    = 0;

            foreach ($listSekolah as $index => $itemUmum) {
                $sekolahId = $itemUmum['sekolah_id'] ?? null;
                if (!$sekolahId) continue;

                $sekolahNode = [
                    'sekolah_id'        => $sekolahId,
                    'nama'              => $itemUmum['nama'] ?? '-',
                    'npsn'              => $itemUmum['npsn'] ?? '-',
                    'status_sekolah'    => $itemUmum['status_sekolah'] ?? '-',
                    'bentuk_pendidikan' => $itemUmum['bentuk_pendidikan'] ?? '-',
                    'akreditasi'        => $itemUmum['akreditasi'] ?? '-',
                    'alamat_jalan'      => $itemUmum['alamat_jalan'] ?? '-',
                    'kecamatan'         => $itemUmum['kecamatan'] ?? '-',
                    'lintang'           => (float) ($itemUmum['lintang'] ?? 0),
                    'bujur'             => (float) ($itemUmum['bujur'] ?? 0),
                    'sekolah'           => [],
                    'ruang'             => [],
                    'ptk'               => [],
                    'rasio_siswa'       => [],
                    'rasio_rombel_ruang_kelas' => []
                ];

                try {
                    $detailUrl = "https://sekolah.data.kemendikdasmen.go.id/v1/sekolah-service/sekolah/full-detail/{$sekolahId}";
                    $responseDetail = Http::withHeaders($headers)->timeout(5)->get($detailUrl);

                    if ($responseDetail->successful()) {
                        $payloadDetail = $responseDetail->json()['data'] ?? [];
                        $sekolahNode['sekolah']                  = $payloadDetail['sekolah'][0] ?? [];
                        $sekolahNode['ruang']                    = $payloadDetail['ruang'][0] ?? [];
                        $sekolahNode['ptk']                      = $payloadDetail['ptk'][0] ?? [];
                        $sekolahNode['rasio_siswa']              = $payloadDetail['rasio_siswa'][0] ?? [];
                        $sekolahNode['rasio_rombel_ruang_kelas'] = $payloadDetail['rasio_rombel_ruang_kelas'][0] ?? [];

                        if (isset($payloadDetail['sekolah'][0])) {
                            $d = $payloadDetail['sekolah'][0];
                            $sekolahNode['nama']          = $d['nama'] ?? $sekolahNode['nama'];
                            $sekolahNode['npsn']          = $d['npsn'] ?? $sekolahNode['npsn'];
                            $sekolahNode['status_sekolah'] = $d['status_sekolah'] ?? $sekolahNode['status_sekolah'];
                            $sekolahNode['kecamatan']     = $d['kecamatan'] ?? $sekolahNode['kecamatan'];
                            
                            // Ambil lintang bujur dari detail jika ada
                            if (isset($d['lintang']) && isset($d['bujur'])) {
                                $sekolahNode['lintang'] = (float) $d['lintang'];
                                $sekolahNode['bujur']   = (float) $d['bujur'];
                            }
                        }
                    }
                } catch (\Exception $e) {
                    // Fail gracefully jika API timeout
                }

                // 2. CEK PROTEKSI MANUAL OVERRIDE BILA SUDAH DIEDIT LOKAL
                if (isset($existingData[$sekolahId])) {
                    $localItem = $existingData[$sekolahId];

                    if (!empty($localItem['is_manual_override'])) {
                        // Pertahankan nilai koordinat & data editan manual
                        $sekolahNode['lintang']            = (float) $localItem['lintang'];
                        $sekolahNode['bujur']              = (float) $localItem['bujur'];
                        $sekolahNode['nama']               = $localItem['nama'] ?? $sekolahNode['nama'];
                        $sekolahNode['npsn']               = $localItem['npsn'] ?? $sekolahNode['npsn'];
                        $sekolahNode['kecamatan']          = $localItem['kecamatan'] ?? $sekolahNode['kecamatan'];
                        $sekolahNode['alamat_jalan']       = $localItem['alamat_jalan'] ?? $sekolahNode['alamat_jalan'];
                        $sekolahNode['is_manual_override'] = true;
                        $sekolahNode['manual_updated_at']  = $localItem['manual_updated_at'] ?? null;

                        // Pertahankan juga sub-node sekolah jika ada
                        if (isset($sekolahNode['sekolah']) && is_array($sekolahNode['sekolah'])) {
                            if (array_is_list($sekolahNode['sekolah']) && !empty($sekolahNode['sekolah'])) {
                                $sekolahNode['sekolah'][0]['lintang'] = (float) $localItem['lintang'];
                                $sekolahNode['sekolah'][0]['bujur']   = (float) $localItem['bujur'];
                            } else {
                                $sekolahNode['sekolah']['lintang'] = (float) $localItem['lintang'];
                                $sekolahNode['sekolah']['bujur']   = (float) $localItem['bujur'];
                            }
                        }
                    }
                }

                // 3. FILTER FIELD BERDASARKAN SELECTOR PADA UI MASTER-UNIT
                $finalDataNode = $this->filterFields($sekolahNode, $selectedFields);

                $masterDataMerged[$sekolahId] = $finalDataNode;
                $processed++;
                $percentage = round(($processed / $totalSekolah) * 100);

                echo "data: " . json_encode([
                    'current'    => $processed,
                    'total'      => $totalSekolah,
                    'percentage' => $percentage,
                    'nama'       => $sekolahNode['nama'],
                    'npsn'       => $sekolahNode['npsn'],
                    'status'     => 'INGESTED'
                ]) . "\n\n";

                ob_flush();
                flush();
                usleep(250000); 
            }

            // 4. SIMPAN KEMBALI HASIL SINKRONISASI DENGAN PRESERVED OVERRIDE
            File::put(
                $targetFile,
                json_encode([
                    'status'     => 'success',
                    'total'      => count($masterDataMerged),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'data'       => array_values($masterDataMerged)
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            );

            echo "data: " . json_encode(['complete' => true]) . "\n\n";
            ob_flush();
            flush();
        }, 200, [
            'Cache-Control'     => 'no-cache',
            'Content-Type'      => 'text/event-stream',
            'X-Accel-Buffering' => 'no'
        ]);
    }

    private function filterFields(array $item, array $fields): array
{
    if (empty($fields)) {
        return $item; // Jika tidak ada filter, kembalikan utuh
    }

    $result = [];

    // Pisahkan top-level keys dan nested keys (misal: "sekolah.luas_tanah_milik")
    $topKeys = [];
    $nestedMap = [];

    foreach ($fields as $field) {
        if (str_contains($field, '.')) {
            [$parent, $child] = explode('.', $field, 2);
            $nestedMap[$parent][] = $child;
        } else {
            $topKeys[] = $field;
        }
    }

    // 1. Filter top-level keys
    foreach ($topKeys as $key) {
        if (array_key_exists($key, $item)) {
            $result[$key] = $item[$key];
        }
    }

    // 2. Filter nested-object keys (sekolah, ruang, ptk, rasio_siswa)
    foreach ($nestedMap as $parent => $childKeys) {
        if (isset($item[$parent])) {
            $node = $item[$parent];
            
            // Tangani jika sub-object dalam bentuk array wrapper [0]
            $isAssoc = true;
            if (is_array($node) && array_is_list($node) && !empty($node)) {
                $nodeData = $node[0];
                $isAssoc = false;
            } else {
                $nodeData = $node;
            }

            $filteredSub = [];
            foreach ($childKeys as $ck) {
                if (is_array($nodeData) && array_key_exists($ck, $nodeData)) {
                    $filteredSub[$ck] = $nodeData[$ck];
                }
            }

            $result[$parent] = $isAssoc ? $filteredSub : [$filteredSub];
        }
    }

    return $result;
}

    public function getMapData()
    {
        $jsonPath = storage_path('json/sekolah.json');

        if (!File::exists($jsonPath)) {
            return response()->json([
                'error' => true,
                'message' => 'File sekolah.json tidak ditemukan di storage/json/'
            ], 404);
        }

        $rawJson = File::get($jsonPath);
        $decoded = json_decode($rawJson, true) ?? [];
        $sekolahList = $decoded['data'] ?? $decoded;

        return response()->json($sekolahList, 200);
    }
}
