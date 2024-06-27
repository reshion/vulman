<?php

namespace App\Http\Controllers;

use App\Business\VulnerabilityImportLogic;
use App\Jobs\ProcessVulnerabilityImport;
use App\Messages\VulnerabilityImportMessage;
use Illuminate\Http\Request;

/** 
 * @OAS\SecurityScheme(      
 *      securityScheme="sanctum",
 *      type="http",
 *      scheme="bearer"
 * )
 */
class ImportController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/import/scan-results",
     *     operationId="importScanResults",
     *     tags={"Import"},
     *     security={{"sanctum":{}}},
     *     summary="Import a CSV",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *                     @OA\Schema(
     *                         @OA\Property(
     *                             description="Item CsV",
     *                             property="file",
     *                             type="string", format="binary"
     *                         )
     *                     )
     *         )
     *     ),
     *     @OA\Response(response=200,description="successful operation",
     *         @OA\MediaType(mediaType="application/json")
     *     ),
     * )
     */
    public function importScanResults(Request $request)
    {
        // Validierung
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:10240', // 10MB max
        ]);

        $user = $request->user();

        // Datei speichern
        $path = $request->file('file')->store('imports');

        $message = new VulnerabilityImportMessage($path, $user->company_id);

        // Job dispatchen wenn productive
        ProcessVulnerabilityImport::dispatch($message);

        // Import logic direkt ausführen dev
        $logic = new VulnerabilityImportLogic($message);
        $logic->importVulnerabilities();

        return response()->json(['message' => 'File imported and processing started'], 200);
    }
}
