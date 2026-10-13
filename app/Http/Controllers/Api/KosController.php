<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use Illuminate\Http\JsonResponse;

class KosController extends Controller
{
    public function index(): JsonResponse
    {
        $kos = Kos::all();

        return response()->json([
            'status' => 'success',
            'data' => $kos
        ]);
    }

    public function show($id): JsonResponse
    {
        $kos = Kos::find($id);

        if (!$kos) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data kos tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $kos
        ]);
    }
}