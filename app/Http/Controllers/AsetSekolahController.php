<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Import class Request
use Illuminate\Support\Facades\File;

class AsetSekolahController extends Controller
{
    public function getMapData()
    {
        $jsonPath = storage_path('json/sekolah.json');

        if (!File::exists($jsonPath)) {
            return response()->json([
                'error' => true,
                'message' => 'File sekolah.json tidak ditemukan di ' . $jsonPath
            ], 404);
        }

        $rawJson = File::get($jsonPath);
        $decoded = json_decode($rawJson, true);
        $data = $decoded['data'] ?? $decoded;

        if (!is_array($data)) {
            return response()->json([
                'error' => true,
                'message' => 'Format isi sekolah.json corrupt / Format tidak valid'
            ], 500);
        }

        return response()->json($data, 200);
    }

    public function update(Request $request, string $id) // Tambahkan type hint 'string' pada $id
    {
        // 1. Validasi input form
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'npsn'         => 'required|string|max:50',
            'kecamatan'    => 'required|string|max:100',
            'alamat_jalan' => 'nullable|string|max:255',
            'lintang'      => 'required|numeric',
            'bujur'        => 'required|numeric',
        ]);

        $jsonPath = storage_path('json/sekolah.json');

        if (!File::exists($jsonPath)) {
            return redirect()->back()->with('error', 'File storage/json/sekolah.json tidak ditemukan!');
        }

        $jsonContent = File::get($jsonPath);
        $dataSekolah = json_decode($jsonContent, true) ?? [];

        // Ambil array data utama jika JSON berstruktur wrapper ['data' => [...]]
        $isWrapped = isset($dataSekolah['data']) && is_array($dataSekolah['data']);
        $listItems = $isWrapped ? $dataSekolah['data'] : $dataSekolah;
        $isUpdated = false;

        // 2. Loop & Update item berdasarkan sekolah_id
        foreach ($listItems as &$item) {
            if (isset($item['sekolah_id']) && $item['sekolah_id'] === $id) {
                // Update properti root
                $item['nama']         = $validated['nama'];
                $item['npsn']         = $validated['npsn'];
                $item['kecamatan']    = $validated['kecamatan'];
                $item['alamat_jalan'] = $validated['alamat_jalan'];
                $item['lintang']      = (float) $validated['lintang'];
                $item['bujur']        = (float) $validated['bujur'];

                // Flag agar tidak tertimpa saat sync API pusat
                $item['is_manual_override'] = true;
                $item['manual_updated_at']  = now()->toDateTimeString();

                // Sinkronkan juga pada sub-node sekolah jika ada
                if (isset($item['sekolah'])) {
                    if (is_array($item['sekolah']) && array_is_list($item['sekolah']) && !empty($item['sekolah'])) {
                        $item['sekolah'][0]['lintang'] = (float) $validated['lintang'];
                        $item['sekolah'][0]['bujur']   = (float) $validated['bujur'];
                    } elseif (is_array($item['sekolah'])) {
                        $item['sekolah']['lintang'] = (float) $validated['lintang'];
                        $item['sekolah']['bujur']   = (float) $validated['bujur'];
                    }
                }

                $isUpdated = true;
                break;
            }
        }

        if (!$isUpdated) {
            return redirect()->back()->with('error', 'Data unit sekolah tidak ditemukan di JSON.');
        }

        // Kembalikan ke struktur awal jika JSON menggunakan wrapper
        if ($isWrapped) {
            $dataSekolah['data'] = $listItems;
            $dataSekolah['updated_at'] = date('Y-m-d H:i:s');
        } else {
            $dataSekolah = $listItems;
        }

        // 3. Write kembali ke sekolah.json
        File::put($jsonPath, json_encode($dataSekolah, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        return redirect()->back()->with('status', 'Data sekolah & koordinat GIS berhasil diperbarui!');
    }
}