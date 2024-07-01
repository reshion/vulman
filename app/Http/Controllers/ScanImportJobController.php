<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScanImportJobResource;
use App\Models\ScanImportJob;
use Illuminate\Http\Request;

class ScanImportJobController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/scan-import-jobs",
     *     operationId="listScanImportJobs",
     *     summary="Lists scan import jobs",
     *     tags={"ScanImportJobs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="count",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/ScanImportJobPagingResource")
     *     )
     * )
     */
    public function index(Request $request)
    {
        $count = $request->input('count', 10);
        $companyId = $request->user()->company_id;
        $scanImportJobs = ScanImportJob::where('company_id', $companyId)->orderBy('created_at', 'DESC')->paginate($count);
        return ScanImportJobResource::collection($scanImportJobs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
