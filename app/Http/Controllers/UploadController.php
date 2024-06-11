<?php

namespace App\Http\Controllers;

use App\Business\VulnerabilityImportLogic;
use App\Jobs\ProcessImport;
use App\Messages\VulnerabilityImportMessage;
use Illuminate\Http\Request;

/** 
 * @OAS\SecurityScheme(      
 *      securityScheme="sanctum",
 *      type="http",
 *      scheme="bearer"
 * )
 */
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

        $user = $request->user();

        // Datei speichern
        $path = $request->file('file')->store('uploads');

        $message = new VulnerabilityImportMessage($path, $user->company_id);

        // Job dispatchen wenn productive
        //ProcessImport::dispatch($message);

        // Import logic direkt ausführen dev
        $logic = new VulnerabilityImportLogic($message);
        $logic->importVulnerabilities();

        return response()->json(['message' => 'File uploaded and processing started'], 200);
    }
}
