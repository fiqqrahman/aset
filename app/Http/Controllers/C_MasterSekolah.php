<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;

class C_MasterSekolah extends Controller
{
    public function index(Request $request)
    {
        $jsonPath = storage_path('json/sekolah.json');

        if (!File::exists($jsonPath)) {
            abort(404, 'File JSON sekolah_smp.json tidak ditemukan di storage/json/');
        }

        $rawJson = File::get($jsonPath);
        $decoded = json_decode($rawJson, true);

        // Ambil array data sekolah
        $allData = collect($decoded['data'] ?? []);

        // --- 1. HITUNG METRIK BENTO CARDS ---
        $totalSMP = $allData->count();
        $totalNegeri = $allData->where('status_sekolah', 'NEGERI')->count();
        $totalSwasta = $allData->where('status_sekolah', 'SWASTA')->count();
        $totalAkredA = $allData->where('akreditasi', 'A')->count();

        // --- 2. FILTER DATA SESUAI INPUT USER ---
        $filtered = $allData->filter(function ($item) use ($request) {
            $matchSearch = true;
            $matchKecamatan = true;
            $matchStatus = true;

            // Filter Pencarian (Nama / NPSN)
            if ($request->filled('search')) {
                $keyword = strtolower($request->search);
                $matchSearch = str_contains(strtolower($item['nama'] ?? ''), $keyword) ||
                    str_contains(strtolower($item['npsn'] ?? ''), $keyword);
            }

            // Filter Kecamatan
            if ($request->filled('kecamatan')) {
                $matchKecamatan = strtolower($item['kecamatan'] ?? '') === strtolower($request->kecamatan);
            }

            // Filter Status Sekolah (NEGERI / SWASTA)
            if ($request->filled('status_sekolah')) {
                $matchStatus = strtoupper($item['status_sekolah'] ?? '') === strtoupper($request->status_sekolah);
            }

            return $matchSearch && $matchKecamatan && $matchStatus;
        });

        // --- 3. PAGINASI MANUAL COLLECTION ---
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $filtered->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $sekolahPaginator = new LengthAwarePaginator(
            $currentPageItems,
            $filtered->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        // Ambil daftar kecamatan unik untuk dropdown filter
        $listKecamatan = $allData->pluck('kecamatan')->filter()->unique()->sort()->values();

        return view('pages.aset-sekolah', [
            'sekolah' => $sekolahPaginator,
            'metrics' => [
                'total_smp' => $totalSMP,
                'negeri' => $totalNegeri,
                'swasta' => $totalSwasta,
                'akred_a' => $totalAkredA,
            ],
            'listKecamatan' => $listKecamatan,
        ]);
    }

    public function masterUnit()
    {
        $jsonDir = storage_path('json');
        $fileSmp = $jsonDir . '/sekolah.json';

        $totalData = 0;
        $lastSync = 'Belum Ada Data';

        if (File::exists($fileSmp)) {
            $rawJson = File::get($fileSmp);
            $decoded = json_decode($rawJson, true);
            $totalData = count($decoded['data'] ?? []);
            $lastSync = date('d M Y - H:i:s \W\I\B', File::lastModified($fileSmp));
        }

        // Mockup Log Eksekusi Pipeline untuk Monitoring
        $logs = [
            [
                'timestamp' => $lastSync,
                'endpoint' => 'full-detail/{sekolah_id}',
                'target' => 'SMP (ID: 6)',
                'records' => $totalData,
                'status' => 'SUCCESS',
                'http_code' => 200,
            ],
            [
                'timestamp' => '24 Aug 2026 - 08:00:00 WIB',
                'endpoint' => 'cari-sekolah',
                'target' => 'Kota Palangka Raya',
                'records' => $totalData,
                'status' => 'SUCCESS',
                'http_code' => 200,
            ]
        ];

        return view('pages.master-unit', [
            'totalData' => $totalData,
            'lastSync' => $lastSync,
            'logs' => $logs
        ]);
    }

    public function syncApi(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | CONFIG & DRAFT HEADER KEMENDIKDASMEN (NON-AKTIF / DRAFT)
        |--------------------------------------------------------------------------
        | $headers = [
        |     'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
        |     'Accept'     => 'application/json',
        |     'Referer'    => 'https://sekolah.data.kemendikdasmen.go.id/',
        | ];
        */

        $bentukPendidikanId = $request->input('bentuk_pendidikan_id', 6); // 6 = SMP

        try {
            // STEP 1 & 2: Pipeline Fetch & Extraction (Draft/Simulasi)
            $sampleSekolahIds = ['80288335-30F5-E011-B17A-27F2F7345112'];
            $cleanData = [];

            foreach ($sampleSekolahIds as $id) {
                // Dummy node sesuai contoh payload Kemendikdasmen antum
                $sekolahNode = [
                    'sekolah_id'        => '80288335-30F5-E011-B17A-27F2F7345112',
                    'nama'              => 'SMP NEGERI 12 PALANGKA RAYA',
                    'npsn'              => '30203472',
                    'status_sekolah'    => 'NEGERI',
                    'bentuk_pendidikan' => 'SMP',
                    'akreditasi'        => 'B',
                    'alamat_jalan'      => 'Jl. Karanggan',
                    'kecamatan'         => 'Kec. Pahandut',
                    'kode_pos'          => '73111',
                ];

                $cleanData[] = $sekolahNode;
            }

            // STEP 3: Tulis ke Storage JSON Local Engine
            $jsonDirectory = storage_path('json');
            if (!File::exists($jsonDirectory)) {
                File::makeDirectory($jsonDirectory, 0755, true);
            }

            File::put(
                $jsonDirectory . '/sekolah_smp.json',
                json_encode(['status' => 'success', 'data' => $cleanData], JSON_PRETTY_PRINT)
            );

            return redirect()->back()->with('success', 'Pipeline Data Sync berhasil dijalankan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Sync Failed: ' . $e->getMessage());
        }
    }
}
