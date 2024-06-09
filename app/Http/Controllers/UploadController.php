<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessImport;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/upload",
     *     operationId="uploadCSV",
     *     tags={"Upload"},
     *     security={{"sanctum":{}}},
     *     summary="Upload a CSV",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 allOf={
     *                     @OA\Schema(ref="#components/schemas/AssetStoreRequest"),
     *                     @OA\Schema(
     *                         @OA\Property(
     *                             description="Item CsV",
     *                             property="file",
     *                             type="string", format="binary"
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200,description="successful operation",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     * )
     */
    public function upload(Request $request)
    {
        // Validierung
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:10240', // 10MB max
        ]);

        // Datei speichern
        $path = $request->file('file')->store('uploads');

        // Job dispatchen
        ProcessImport::dispatch($path);

        return response()->json(['message' => 'File uploaded and processing started'], 200);
    }
}
