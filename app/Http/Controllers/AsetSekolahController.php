<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        // Ambil data baik dalam key 'data' maupun array murni
        $data = $decoded['data'] ?? $decoded;

        if (!is_array($data)) {
            return response()->json([
                'error' => true,
                'message' => 'Format isi sekolah.json corrupt / bukan JSON valid'
            ], 500);
        }

        return response()->json($data, 200);
    }
}
